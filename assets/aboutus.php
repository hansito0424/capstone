<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PlantCare : Developers</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: whitesmoke;
    }
    
    .background {
      position: relative;
      width: 100%;
      height: 50vh; 
      background-color: #006A4E;
    }
    
    .header{
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
      font-size: 24px;
    }  
    .header img {
      height: 50px;
      margin-right: 10px;
    }
    
    .header .title{
      display: flex;
      align-items: center;
    }
    
    .settings-btn {
      background-color: #006A4E;
      border: none;
      padding: 10px;
      border-radius: 50%;
      cursor: pointer;
    }
    
    .settings-btn img {
      width: 40px;
      height: 40px;
    }
    .team-card {
  display: flex;
  flex-direction: column;
  align-items: center; 
  justify-content: center; 
}
    
    .team-section {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 5px;
      padding: 20px;
      position: relative;
      top: -230px; 
    }    
   
   .team-section .team-card:nth-child(2) img {
    width: 150px;  
    height: 150px;
    border: 2px solid white; 
  }

  .team-section .team-card:nth-child(2) {
    transform: translateY(-30px);  
  }

    .team-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      background-color: #006A4E;
    }
    
    .team-card h3 {
      margin-top: 10px;
  font-size: 18px;
  text-align: center; 
      color: whitesmoke;
    }
    
    .lower-section {
      padding: 10px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 5px;
      position: relative;
      top: -180px;
          }

.team-section .team-card img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  background-color: #006A4E;
  border: 1px solid white;
}
.lower-section .team-card img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  background-color: whitesmoke;
  border: 1px solid black; 
}
    
  </style>
</head>
<body>

  <div class="background">
    <div class="header">
      <div class="title">
        <img src="assets/plantC.png" alt="PlantCare Logo">
        : Developers
      </div>
      <button class="settings-btn" onclick="goBackToSettings()">
        <img src="assets/minimize.png" alt="Settings">
      </button>
    </div>
  </div>

  <div class="team-section">
    <div class="team-card">
      <img src="assets/caspe2.png" alt="Programmer #1">
      <h3>Lead Programmer<br>Mark Angelo Caspe</h3>
    </div>
    <div class="team-card">
      <img src="assets/yanna2.png" alt="Leader">
      <h3>Leader<br>Yanna Mae Ugay</h3>
    </div>
    <div class="team-card">
      <img src="assets/hans2.png" alt="Programmer #2">
      <h3>Programmer<br>Hans Custodio</h3>
    </div>
  </div>

  <div class="lower-section">
    <div class="team-card">
      <img src="assets/ayz2.png" alt="Graphic Designer">
      <h3 style="color: black;">Secretary<br>Jerone Ayz Del Rosario</h3>
    </div>
    <div class="team-card">
      <img src="assets/jediah2.png" alt="Docu">
      <h3 style="color: black;">Statistician<br>Jediah Romero</h3>
    </div>
    <div class="team-card">
      <img src="assets/jervan2.png" alt="Analyst">
      <h3 style="color: black;">Analyst<br>Jervan Aficial</h3>
    </div>
    <div class="team-card">
      <img src="assets/kenneth2.png" alt="Analyst">
      <h3 style="color: black;">Analyst<br>Kenneth John Bermudez</h3>
    </div>
  </div>

  <script>
    function goBackToSettings() {
      window.location.href = 'settings.php'; 
    }
  </script>

</body>
</html>
