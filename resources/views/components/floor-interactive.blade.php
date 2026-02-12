@props(['floor'])

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Check if there's a room parameter in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const roomId = urlParams.get('room');
    
    if (roomId) {
        // Fetch room details and navigate to it
        fetchRoomAndNavigate(roomId);
    }
    
    // Add click handlers to all room shapes
    addClickHandlersToRooms();

    /**
     * Fetch room data from API and navigate to it
     */
    function fetchRoomAndNavigate(roomId) {
        fetch(`/api/rooms/${roomId}`)
            .then(response => response.json())
            .then(room => {
                if (room && room.floor === {{ $floor }}) {
                    // Room is on this floor, highlight it
                    highlightRoom(room);
                    drawPathToRoom(room);
                    showRoomInfo(room);
                }
            })
            .catch(error => console.error('Error fetching room:', error));
    }

    /**
     * Add click event listeners to all SVG room elements
     */
    function addClickHandlersToRooms() {
        const svg = document.querySelector('.svg-wrapper svg');
        if (!svg) return;

        // Get all rect and path elements with fill colors (rooms) - include ALL colored shapes
        const roomElements = svg.querySelectorAll('rect[fill], path[fill]');
        
        roomElements.forEach(element => {
            const fill = element.getAttribute('fill');
            
            // Skip white, none, black or very light fills (walls/backgrounds)
            if (!fill || fill === 'none' || fill === 'white' || fill === '#FFFFFF' || fill === 'black' || fill === '#000000') return;
            
            // Skip elements with very small areas (likely decorative lines)
            const bbox = element.getBBox();
            if (bbox.width < 30 || bbox.height < 30) return;
            
            // Add hover effect
            element.style.cursor = 'pointer';
            element.addEventListener('mouseenter', function() {
                this.style.opacity = '0.6';
                this.style.filter = 'brightness(1.2)';
            });
            element.addEventListener('mouseleave', function() {
                this.style.opacity = '1';
                this.style.filter = 'none';
            });
            
            // Add click handler
            element.addEventListener('click', function(e) {
                e.stopPropagation();
                const bbox = this.getBBox();
                const centerX = bbox.x + bbox.width / 2;
                const centerY = bbox.y + bbox.height / 2;
                
                // Find nearest room from database based on coordinates
                fetch(`/api/rooms/floor/{{ $floor }}`)
                    .then(response => response.json())
                    .then(rooms => {
                        // Find closest room to clicked position
                        let closestRoom = null;
                        let minDistance = Infinity;
                        
                        rooms.forEach(room => {
                            const dist = Math.sqrt(
                                Math.pow(room.center_x - centerX, 2) + 
                                Math.pow(room.center_y - centerY, 2)
                            );
                            if (dist < minDistance && dist < 100) { // Within 100px
                                minDistance = dist;
                                closestRoom = room;
                            }
                        });
                        
                        if (closestRoom) {
                            highlightRoom(closestRoom);
                            drawPathToRoom(closestRoom);
                            showRoomInfo(closestRoom);
                        } else {
                            // No matching room found, use calculated center
                            const tempRoom = {
                                name: 'Selected Area',
                                center_x: centerX,
                                center_y: centerY,
                                floor: {{ $floor }},
                                type: 'room',
                                description: 'Tap for directions'
                            };
                            highlightRoom(tempRoom);
                            drawPathToRoom(tempRoom);
                            showRoomInfo(tempRoom);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching rooms:', error);
                        const tempRoom = {
                            name: 'Selected Area',
                            center_x: centerX,
                            center_y: centerY,
                            floor: {{ $floor }},
                            type: 'room',
                            description: 'Tap for directions'
                        };
                        highlightRoom(tempRoom);
                        drawPathToRoom(tempRoom);
                        showRoomInfo(tempRoom);
                    });
            });
        });
    }

    /**
     * Highlight the target room with a pulsing red circle
     */
    function highlightRoom(room) {
        const svg = document.querySelector('.svg-wrapper svg');
        if (!svg) return;

        // Remove any existing highlights
        const existingHighlight = svg.querySelector('#room-highlight');
        if (existingHighlight) {
            existingHighlight.remove();
        }

        const centerX = room.center_x;
        const centerY = room.center_y;
        const radius = 25;

        // Create pulsing red circle
        const highlight = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        highlight.setAttribute('id', 'room-highlight');
        highlight.setAttribute('cx', centerX);
        highlight.setAttribute('cy', centerY);
        highlight.setAttribute('r', radius);
        highlight.setAttribute('fill', 'none');
        highlight.setAttribute('stroke', 'red');
        highlight.setAttribute('stroke-width', '3');
        highlight.setAttribute('opacity', '0.8');

        // Add pulsing animation
        const animate = document.createElementNS('http://www.w3.org/2000/svg', 'animate');
        animate.setAttribute('attributeName', 'r');
        animate.setAttribute('values', `${radius};${radius + 10};${radius}`);
        animate.setAttribute('dur', '1.5s');
        animate.setAttribute('repeatCount', 'indefinite');
        
        highlight.appendChild(animate);
        svg.appendChild(highlight);
    }

    /**
     * Draw an animated path from the bottom center to the room
     */
    function drawPathToRoom(room) {
        const svg = document.querySelector('.svg-wrapper svg');
        if (!svg) return;

        // Remove any existing paths
        const existingPath = svg.querySelector('#direction-path');
        const existingArrow = svg.querySelector('#direction-arrow');
        if (existingPath) existingPath.remove();
        if (existingArrow) existingArrow.remove();

        // Get SVG viewBox dimensions
        const viewBox = svg.viewBox.baseVal;
        const startX = viewBox.x + viewBox.width / 2;  // Center bottom
        const startY = viewBox.y + viewBox.height - 50; // Near bottom

        const endX = room.center_x;
        const endY = room.center_y;

        // Create path
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        const pathData = `M ${startX} ${startY} L ${endX} ${endY}`;
        
        path.setAttribute('id', 'direction-path');
        path.setAttribute('d', pathData);
        path.setAttribute('fill', 'none');
        path.setAttribute('stroke', 'red');
        path.setAttribute('stroke-width', '8');
        path.setAttribute('stroke-dasharray', '20,15');
        path.setAttribute('marker-end', 'url(#arrowhead)');

        // Add animation
        const pathLength = path.getTotalLength();
        path.style.strokeDasharray = pathLength + ' ' + pathLength;
        path.style.strokeDashoffset = pathLength;
        
        // Animate the path drawing
        setTimeout(() => {
            path.style.transition = 'stroke-dashoffset 2s ease-in-out';
            path.style.strokeDashoffset = '0';
        }, 100);

        // Create arrowhead marker if it doesn't exist
        let defs = svg.querySelector('defs');
        if (!defs) {
            defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
            svg.insertBefore(defs, svg.firstChild);
        }

        // Remove existing arrowhead if present
        const existingMarker = defs.querySelector('#arrowhead');
        if (existingMarker) existingMarker.remove();

        const marker = document.createElementNS('http://www.w3.org/2000/svg', 'marker');
        marker.setAttribute('id', 'arrowhead');
        marker.setAttribute('markerWidth', '10');
        marker.setAttribute('markerHeight', '10');
        marker.setAttribute('refX', '9');
        marker.setAttribute('refY', '5');
        marker.setAttribute('orient', 'auto');

        const polygon = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
        polygon.setAttribute('points', '0 0, 10 5, 0 10');
        polygon.setAttribute('fill', 'red');

        marker.appendChild(polygon);
        defs.appendChild(marker);

        svg.appendChild(path);
    }

    /**
     * Show room information popup
     */
    function showRoomInfo(room) {
        // Remove existing info box
        const existingInfo = document.querySelector('#room-info-box');
        if (existingInfo) {
            existingInfo.remove();
        }

        // Create info box
        const infoBox = document.createElement('div');
        infoBox.id = 'room-info-box';
        infoBox.className = 'fixed top-20 right-8 bg-white p-6 rounded-xl shadow-2xl border-4 border-red-500 z-50 max-w-sm';
        infoBox.innerHTML = `
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800">${room.name}</h3>
                <button onclick="this.closest('#room-info-box').remove(); document.querySelector('#room-highlight')?.remove(); document.querySelector('#direction-path')?.remove();" 
                        class="text-gray-500 hover:text-red-600 text-2xl leading-none">&times;</button>
            </div>
            <div class="space-y-2 text-gray-700">
                <p><span class="font-semibold">Floor:</span> ${room.floor}</p>
                <p><span class="font-semibold">Type:</span> ${room.type ? room.type.charAt(0).toUpperCase() + room.type.slice(1) : 'N/A'}</p>
                ${room.description ? `<p><span class="font-semibold">Description:</span> ${room.description}</p>` : ''}
            </div>
            <div class="mt-4 pt-3 border-t text-center">
                <span class="text-xs text-gray-500">📍 Follow the red arrow</span>
            </div>
        `;

        document.body.appendChild(infoBox);

        // Auto-remove after 10 seconds
        setTimeout(() => {
            if (document.querySelector('#room-info-box')) {
                infoBox.style.transition = 'opacity 0.5s';
                infoBox.style.opacity = '0';
                setTimeout(() => infoBox.remove(), 500);
            }
        }, 10000);
    }
});
</script>
