<body>
<div class="sidebar">
<div class="logo">
                <img src="assets/plantC.png" alt="PlantCare Logo">
            </div>
    <a href="index.php">Home</a>
    <a href="about-plant.php">About Plant</a>
    <a href="water-trigger.php">Water Trigger</a>
    <a href="water-history.php">Water History</a>
    <a href="settings.php">Settings</a>
    <div class="bottom-links">
        <a href="logout.php">Logout</a>
    </div>
</div>
<script>
    function activatePage() {
  const currentURL = window.location.href;
  const sidebarLinks = document.querySelectorAll('.sidebar a');

  sidebarLinks.forEach(link => {
    if (link.href === currentURL) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
}

activatePage(); // Activate the current page on initial load
</script>
</body>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
}
.logo {
    text-align: center;
    margin-bottom: 10px;
}

.logo img {
    max-width: 150%;
    height: auto;
    padding-left: 20px;
    object-fit: cover; 
}

.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: green; /* Dark green */
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sidebar a {
    padding: 15px 20px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    font-weight: bold;
}

.sidebar a:hover {
    background-color: #008000; /* Green on hover */
}

.sidebar a.active {
    background-color: white; /* Forest green */
    color: darkgreen;
}

.bottom-links {
    margin-top: auto;
    padding-bottom: 20px;
}

.content {
    margin-left: 250px;
    padding: 20px;
}

h1 {
    font-size: 36px;
    color: #006400; /* Dark green for headings */
}

</style>