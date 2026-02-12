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
        const svg = document.querySelector('.floor-svg');
        if (!svg) return;

        // Get all rect and path elements (rooms)
        const roomElements = svg.querySelectorAll('rect, path');
        
        roomElements.forEach(element => {
            const roomId = element.id;
            
            // Skip if no ID or if it's a special element
            if (!roomId || roomId.includes('arrow') || roomId.includes('path')) return;
            
            // Add hover effect
            element.style.cursor = 'pointer';
            element.addEventListener('mouseenter', function() {
                this.style.opacity = '0.7';
            });
            element.addEventListener('mouseleave', function() {
                this.style.opacity = '1';
            });
            
            // Add click handler
            element.addEventListener('click', function() {
                // Try to find room in database by SVG ID
                fetch(`/api/rooms/search?q=${roomId}&floor={{ $floor }}`)
                    .then(response => response.json())
                    .then(rooms => {
                        if (rooms && rooms.length > 0) {
                            const room = rooms[0];
                            highlightRoom(room);
                            drawPathToRoom(room);
                            showRoomInfo(room);
                        }
                    })
                    .catch(error => console.error('Error fetching room:', error));
            });
        });
    }

    /**
     * Highlight the target room with a pulsing red circle
     */
    function highlightRoom(room) {
        const svg = document.querySelector('.floor-svg');
        if (!svg) return;

        // Remove any existing highlights
        const existingHighlight = svg.querySelector('#room-highlight');
        if (existingHighlight) {
            existingHighlight.remove();
        }

        // Get the room element to highlight
        const roomElement = svg.querySelector(`#${room.svg_id}`);
        if (!roomElement) {
            console.warn('Room element not found:', room.svg_id);
            return;
        }

        // Get the bounding box of the room
        const bbox = roomElement.getBBox();
        const centerX = bbox.x + bbox.width / 2;
        const centerY = bbox.y + bbox.height / 2;
        const radius = Math.max(bbox.width, bbox.height) / 2 + 10;

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

        // Scroll the room into view
        roomElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    /**
     * Draw an animated path from the bottom center to the room
     */
    function drawPathToRoom(room) {
        const svg = document.querySelector('.floor-svg');
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

        // Get room element
        const roomElement = svg.querySelector(`#${room.svg_id}`);
        if (!roomElement) return;

        const bbox = roomElement.getBBox();
        const endX = bbox.x + bbox.width / 2;
        const endY = bbox.y + bbox.height / 2;

        // Create path with smooth curve
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        const controlX = (startX + endX) / 2;
        const controlY = Math.min(startY, endY) - 100;
        
        const pathData = `M ${startX} ${startY} Q ${controlX} ${controlY} ${endX} ${endY}`;
        
        path.setAttribute('id', 'direction-path');
        path.setAttribute('d', pathData);
        path.setAttribute('fill', 'none');
        path.setAttribute('stroke', 'red');
        path.setAttribute('stroke-width', '4');
        path.setAttribute('stroke-dasharray', '10,5');
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
        marker.setAttribute('refY', '3');
        marker.setAttribute('orient', 'auto');

        const polygon = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
        polygon.setAttribute('points', '0 0, 10 3, 0 6');
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
        infoBox.className = 'fixed top-4 right-4 bg-white p-6 rounded-lg shadow-2xl z-50 max-w-sm border-2 border-red-500';
        infoBox.innerHTML = `
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800">${room.name}</h3>
                <button onclick="this.closest('#room-info-box').remove()" class="text-gray-500 hover:text-red-600 text-2xl leading-none">&times;</button>
            </div>
            <div class="space-y-2 text-gray-700">
                <p><span class="font-semibold">Floor:</span> ${room.floor}</p>
                <p><span class="font-semibold">Type:</span> ${room.type.charAt(0).toUpperCase() + room.type.slice(1)}</p>
                ${room.description ? `<p><span class="font-semibold">Description:</span> ${room.description}</p>` : ''}
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
