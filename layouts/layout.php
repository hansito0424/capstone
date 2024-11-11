<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetable Plot Layout Designer</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(to bottom, #f9f9f9, #e6e6e6);
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .options {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .option {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            position: relative;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .option:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .option.selected {
            border: 2px solid #333;
            background-color: #3e8e41;
        }

        .canvas-container {
            position: relative;
            border: 1px solid #ccc;
            margin: 20px auto;
            background-color: #A9A9A9;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            border: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        #colorPicker {
            margin: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .options {
                overflow-x: auto;
                display: flex;
                white-space: nowrap;
                justify-content: flex-start;
            }
            .canvas-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vegetable Plot Layout Designer</h1>
        <div class="options" id="optionContainer">
            <div class="option" aria-label="Carrot" onclick="selectItem('Carrot')">Carrot</div>
            <div class="option" aria-label="Tomato" onclick="selectItem('Tomato')">Tomato</div>
            <div class="option" aria-label="Lettuce" onclick="selectItem('Lettuce')">Lettuce</div>
            <div class="option" aria-label="Eggplant" onclick="selectItem('Eggplant')">Eggplant</div>
            <div class="option" aria-label="Arduino" onclick="selectItem('Arduino')">Arduino</div>
            <div class="option" aria-label="Start Wiring" onclick="startWiring()">Start Wiring</div>
        </div>
        <input type="color" id="colorPicker" value="#000000">
        <div class="canvas-container" id="canvasContainer" style="width: 500px; height: 500px;">
            <canvas id="plotCanvas" width="500" height="500"></canvas>
        </div>
        <button onclick="clearCanvas()">Clear Canvas</button>
        <button onclick="undo()">Undo</button>
        <button onclick="resizeCanvas()">Resize Canvas</button>
    </div>
    <script>
        const canvas = document.getElementById('plotCanvas');
        const container = document.getElementById('canvasContainer');
        const ctx = canvas.getContext('2d');
        const colorPicker = document.getElementById('colorPicker');
        let selectedItem = '';
        let positions = [];
        let isDrawing = false;
        let isWiring = false;
        let startX, startY;

        const images = {
            Carrot: loadImage('http://localhost/capstone/layouts/carrot.png'),
            Tomato: loadImage('http://localhost/capstone/layouts/tomato.png'),
            Lettuce: loadImage('http://localhost/capstone/layouts/lettuce.png'),
            Eggplant: loadImage('http://localhost/capstone/layouts/eggplant.png'),
            Arduino: loadImage('http://localhost/capstone/layouts/uno.png'),
            defaultLayout: loadImage('http://localhost/capstone/layouts/canvas2.jpg')
        };

        images.defaultLayout.onload = function() {
            ctx.drawImage(images.defaultLayout, 0, 0, canvas.width, canvas.height);
            redrawCanvas();
        };

        function loadImage(src) {
            const img = new Image();
            img.src = src;
            img.onerror = () => console.error(`Failed to load image: ${src}`);
            return img;
        }

        function selectItem(item) {
            selectedItem = item;
            isWiring = false;
            document.querySelectorAll('.option').forEach(option => option.classList.remove('selected'));
            document.querySelector(`[aria-label="${item}"]`).classList.add('selected');
        }

        function startWiring() {
            selectedItem = '';
            isWiring = true;
            document.querySelectorAll('.option').forEach(option => option.classList.remove('selected'));
        }

        canvas.addEventListener('click', function(event) {
            if (selectedItem) {
                placeItem(event);
            } else if (event.shiftKey) {
                deleteItem(event);
            }
        });

        function placeItem(event) {
            const { x, y } = getCanvasCoordinates(event);
            const image = images[selectedItem];
            if (image) {
                ctx.drawImage(image, x - 25, y - 25, 50, 50);
                addLabel(selectedItem, x, y);
                positions.push({ type: selectedItem, x, y });
            }
        }

        function deleteItem(event) {
            const { x, y } = getCanvasCoordinates(event);
            positions = positions.filter(pos => {
                const withinItem = x > pos.x - 25 && x < pos.x + 25 && y > pos.y - 25 && y < pos.y + 25;
                return !withinItem;
            });
            redrawCanvas();
        }

        function getCanvasCoordinates(event) {
            const rect = canvas.getBoundingClientRect();
            return { x: event.clientX - rect.left, y: event.clientY - rect.top };
        }

        function addLabel(text, x, y) {
            ctx.font = '12px Arial';
            ctx.fillStyle = '#000';
            ctx.fillText(text, x - 20, y + 35);
        }

        canvas.addEventListener('mousedown', function(event) {
            if (isWiring) {
                const { x, y } = getCanvasCoordinates(event);
                startX = x;
                startY = y;
                isDrawing = true;
            }
        });

        canvas.addEventListener('mousemove', function(event) {
            if (isDrawing && isWiring) {
                const { x, y } = getCanvasCoordinates(event);
                drawTemporaryLine(startX, startY, x, y);
            }
        });

        canvas.addEventListener('mouseup', function(event) {
            if (isDrawing && isWiring) {
                const { x, y } = getCanvasCoordinates(event);
                isDrawing = false;
                drawFinalLine(startX, startY, x, y);
                positions.push({ type: 'line', startX, startY, endX: x, endY: y, color: colorPicker.value });
            }
        });

        function drawTemporaryLine(x1, y1, x2, y2) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(images.defaultLayout, 0, 0, canvas.width, canvas.height);
            positions.forEach(pos => {
                if (pos.type === 'line') {
                    ctx.strokeStyle = pos.color || '#000';
                    drawFinalLine(pos.startX, pos.startY, pos.endX, pos.endY);
                } else {
                    const img = images[pos.type];
                    ctx.drawImage(img, pos.x - 25, pos.y - 25, 50, 50);
                    addLabel(pos.type, pos.x, pos.y);
                }
            });

            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.strokeStyle = colorPicker.value;
            ctx.lineWidth = 2;
            ctx.stroke();
        }

        function drawFinalLine(x1, y1, x2, y2) {
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.strokeStyle = colorPicker.value;
            ctx.lineWidth = 2;
            ctx.stroke();
        }

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(images.defaultLayout, 0, 0, canvas.width, canvas.height);
            positions = [];
        }

        function undo() {
            positions.pop();
            redrawCanvas();
        }

        function resizeCanvas() {
            const newWidth = prompt('Enter new width:');
            const newHeight = prompt('Enter new height:');
            if (newWidth && newHeight && !isNaN(newWidth) && !isNaN(newHeight)) {
                canvas.width = newWidth;
                canvas.height = newHeight;
                container.style.width = newWidth + 'px';
                container.style.height = newHeight + 'px';
                redrawCanvas();
            }
        }

        function redrawCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(images.defaultLayout, 0, 0, canvas.width, canvas.height);
            positions.forEach(pos => {
                if (pos.type === 'line') {
                    ctx.strokeStyle = pos.color || '#000';
                    drawFinalLine(pos.startX, pos.startY, pos.endX, pos.endY);
                } else {
                    const img = images[pos.type];
                    ctx.drawImage(img, pos.x - 25, pos.y - 25, 50, 50);
                    addLabel(pos.type, pos.x, pos.y);
                }
            });
        }
    </script>
</body>
</html>
