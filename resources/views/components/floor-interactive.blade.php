@props(['floor'])

<script>
document.addEventListener('DOMContentLoaded', function () {
    const svg = document.querySelector('.svg-wrapper svg');
    if (!svg) return;
    
    // State: null = no selection, object = from location selected
    let fromLocation = null;
    
    // Check if there's a room parameter in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const roomId = urlParams.get('room');
    
    if (roomId) {
        fetchRoomAndNavigate(roomId);
    }
    
    // Add click handlers to SVG
    svg.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Get click position relative to SVG
        const pt = svg.createSVGPoint();
        pt.x = e.clientX;
        pt.y = e.clientY;
        const svgP = pt.matrixTransform(svg.getScreenCTM().inverse());
        
        const clickX = svgP.x;
        const clickY = svgP.y;
        
        // Find closest room to click position
        fetch(`/api/rooms/floor/{{ $floor }}`)
            .then(response => response.json())
            .then(rooms => {
                let closestRoom = null;
                let minDistance = Infinity;
                
                rooms.forEach(room => {
                    const dist = Math.sqrt(
                        Math.pow(room.center_x - clickX, 2) + 
                        Math.pow(room.center_y - clickY, 2)
                    );
                    if (dist < minDistance) {
                        minDistance = dist;
                        closestRoom = room;
                    }
                });
                
                if (closestRoom && minDistance < 150) {
                    handleRoomClick(closestRoom);
                }
            });
    });

    function fetchRoomAndNavigate(roomId) {
        fetch(`/api/rooms/${roomId}`)
            .then(response => response.json())
            .then(room => {
                if (room && room.floor === {{ $floor }}) {
                    fromLocation = null;
                    highlightRoom(room, 'to');
                    showRoomInfo(room, 'destination');
                }
            })
            .catch(error => console.error('Error fetching room:', error));
    }

    function handleRoomClick(room) {
        if (!fromLocation) {
            // First click - set FROM location
            fromLocation = room;
            clearPath();
            highlightRoom(room, 'from');
            showRoomInfo(room, 'from');
        } else {
            // Second click - set TO location and draw path
            highlightRoom(room, 'to');
            drawPath(fromLocation, room);
            showPathInfo(fromLocation, room);
            fromLocation = null; // Reset for next selection
        }
    }

    function highlightRoom(room, type) {
        // Remove existing highlight of same type
        const existingHighlight = svg.querySelector(`#highlight-${type}`);
        if (existingHighlight) existingHighlight.remove();

        const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        circle.setAttribute('id', `highlight-${type}`);
        circle.setAttribute('cx', room.center_x);
        circle.setAttribute('cy', room.center_y);
        circle.setAttribute('r', '20');
        circle.setAttribute('fill', 'none');
        circle.setAttribute('stroke', type === 'from' ? '#00FF00' : '#FF0000');
        circle.setAttribute('stroke-width', '4');
        
        svg.appendChild(circle);
    }

    function clearPath() {
        const existingPath = svg.querySelector('#direction-path');
        const existingFrom = svg.querySelector('#highlight-from');
        const existingTo = svg.querySelector('#highlight-to');
        if (existingPath) existingPath.remove();
        if (existingFrom) existingFrom.remove();
        if (existingTo) existingTo.remove();
    }

    function drawPath(from, to) {
        const existingPath = svg.querySelector('#direction-path');
        if (existingPath) existingPath.remove();

        // Simple straight line
        const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        line.setAttribute('id', 'direction-path');
        line.setAttribute('x1', from.center_x);
        line.setAttribute('y1', from.center_y);
        line.setAttribute('x2', to.center_x);
        line.setAttribute('y2', to.center_y);
        line.setAttribute('stroke', '#FF0000');
        line.setAttribute('stroke-width', '4');
        line.setAttribute('stroke-dasharray', '10,5');
        
        svg.appendChild(line);
    }

    function showRoomInfo(room, type) {
        removeInfoBox();
        
        const label = type === 'from' ? 'FROM' : 'TO';
        const color = type === 'from' ? 'green' : 'red';
        
        const infoBox = document.createElement('div');
        infoBox.id = 'room-info-box';
        infoBox.className = 'fixed top-20 right-8 bg-white p-4 rounded-lg shadow-xl z-50 max-w-xs';
        infoBox.style.borderLeft = `4px solid ${color}`;
        infoBox.innerHTML = `
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-${color}-600">${label}</span>
                <button onclick="this.closest('#room-info-box').remove();" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <h3 class="font-bold text-gray-800">${room.name}</h3>
            <p class="text-sm text-gray-600">${room.type}</p>
            <p class="text-xs text-gray-500 mt-2">${type === 'from' ? 'Now click your destination' : 'Click anywhere to start new route'}</p>
        `;
        document.body.appendChild(infoBox);
    }

    function showPathInfo(from, to) {
        removeInfoBox();
        
        const infoBox = document.createElement('div');
        infoBox.id = 'room-info-box';
        infoBox.className = 'fixed top-20 right-8 bg-white p-4 rounded-lg shadow-xl z-50 max-w-xs border-l-4 border-red-500';
        infoBox.innerHTML = `
            <div class="flex justify-between items-start mb-2">
                <span class="text-xs font-bold text-gray-600">ROUTE</span>
                <button onclick="this.closest('#room-info-box').remove(); document.querySelector('#direction-path')?.remove(); document.querySelector('#highlight-from')?.remove(); document.querySelector('#highlight-to')?.remove();" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="mb-2">
                <span class="text-xs text-green-600 font-semibold">FROM:</span>
                <p class="font-bold text-gray-800">${from.name}</p>
            </div>
            <div>
                <span class="text-xs text-red-600 font-semibold">TO:</span>
                <p class="font-bold text-gray-800">${to.name}</p>
            </div>
            <p class="text-xs text-gray-500 mt-3">Click anywhere to start new route</p>
        `;
        document.body.appendChild(infoBox);
    }

    function removeInfoBox() {
        const existing = document.querySelector('#room-info-box');
        if (existing) existing.remove();
    }
});
</script>
