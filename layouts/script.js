const canvas = document.getElementById('plotCanvas');
const ctx = canvas.getContext('2d');
let selectedVegetable = '';

// Store the positions of the vegetables for drawing
let plants = [];

// Function to select a vegetable
function selectVegetable(vegetable) {
    selectedVegetable = vegetable;
}

// Function to draw the selected vegetable on the canvas
canvas.addEventListener('click', function(event) {
    const rect = canvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    if (selectedVegetable) {
        drawPlant(x, y, selectedVegetable);
    }
});

// Function to draw the vegetable shape on the canvas
function drawPlant(x, y, vegetable) {
    ctx.fillStyle = vegetableColor(vegetable);
    ctx.fillRect(x - 15, y - 15, 30, 30); // Draw a square for simplicity

    // Save the plant information for potential future use
    plants.push({ x, y, vegetable });
}

// Function to get color based on vegetable type
function vegetableColor(vegetable) {
    switch (vegetable) {
        case 'Carrot': return 'orange';
        case 'Tomato': return 'red';
        case 'Lettuce': return 'lightgreen';
        case 'Eggplant': return 'yellow';
        default: return 'gray';
    }
}

// Function to clear the canvas
function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    plants = []; // Reset the plants array
}