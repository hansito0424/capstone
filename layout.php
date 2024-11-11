<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetable Plot Layout Designer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        h1, h2 {
            text-align: center;
        }

        .vegetable-options {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .vegetable {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: 0 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .canvas-container {
            position: relative;
            border: 1px solid #ccc;
            width: 500px;
            height: 500px;
            margin: 20px auto;
            background-color: #A9A9A9;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            z-index: 1;
        }

        .grid-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            pointer-events: none;
        }

        .grid-cell {
            border: 2px solid #ccc;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vegetable Plot Layout Designer</h1>
        <div class="vegetable-options">
            <h2>Select Vegetables:</h2>
            <div class="vegetable" onclick="selectVegetable('Carrot')">Carrot</div>
            <div class="vegetable" onclick="selectVegetable('Tomato')">Tomato</div>
            <div class="vegetable" onclick="selectVegetable('Lettuce')">Lettuce</div>
            <div class="vegetable" onclick="selectVegetable('Pepper')">Pepper</div>
        </div>
        <div class="canvas-container">
            <canvas id="plotCanvas" width="500" height="500"></canvas>
            <div class="grid-overlay">
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
                <div class="grid-cell"></div>
            </div>
        </div>
        <button onclick="clearCanvas()">Clear Canvas</button>
    </div>
    <script>
        const canvas = document.getElementById('plotCanvas');
        const ctx = canvas.getContext('2d');
        let selectedVegetable = '';
        const carrotImage = new Image();
        carrotImage.src = 'http://localhost/capstone/carrot.png'; // Adjust the path as needed

        function selectVegetable(vegetable) {
            selectedVegetable = vegetable;
        }

        canvas.addEventListener('click', function(event) {
            if (selectedVegetable === 'Carrot') {
                const rect = canvas.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;
                ctx.drawImage(carrotImage, x - 25, y - 25, 50, 50); // Draw the image at clicked position
            }
            // You can add more conditions for other vegetables here
        });

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    </script>
</body>
</html>
