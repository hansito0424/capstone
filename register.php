<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $fname =$_POST['fname'];
    $mname =$_POST['mname'];
    $lname =$_POST['lname'];
    $sex =$_POST['sex'];

    $sql = "INSERT INTO users (firstname, middlename, lastname, sex, username, password) VALUES ('$fname', '$mname', '$lname', '$sex', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<body>

<div class="background"></div>

  <div class="container">
    <div class="left-section">
      <img src="assets/reg2.png" alt="Plant Logo">
    </div>

    <div class="right-section">
      <h2 style="color: Green;">Register</h2>
      <form action="register.php" method="POST">
                <p>First Name:</p>
                <input type="text" name="fname" placeholder="" required> <br>
                <p>Middle Name:</p>
                <input type="text" name="mname" placeholder=""> <br>
                <p>Last Name:</p>
                <input type="text" name="lname" placeholder="" required> <br>
                <div class="gender-section">
                    <label for="male">Male</label>
                    <input type="radio" id="male" value="Male" name="sex">
                    <label for="female">Female</label>
                    <input type="radio" id="female" value="Female" name="sex">
                </div>   
                <p style="color: white;">Email:</p>
                <input type="text" name="username" placeholder="" required> <br>
                <div class="password-container">
                    <p style="color: white;">Password</p>
                    <input type="password" id="password" name="password" placeholder="" required>
                    <span class="toggle-password">
                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                    </span>
                </div>
                <div class="password-container">
                    <p style="color: white;">Confirm Password</p>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="" required>
                    <span class="toggle-password">
                        <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
                    </span>
                </div><br>
                <button type="submit">Register</button>
            </form>
            
      <div class="footer">
        <p style="color: white;">Already have an account? <span class="footer-separator">|</span> <a href="login.php">Log In</a></p>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.toggle-password').addEventListener('click', function() {
      const passwordField = document.getElementById('password');
      const icon = document.getElementById('togglePasswordIcon');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });

    document.querySelector('.toggle-password').addEventListener('click', function() {
      const confirmPasswordField = document.getElementById('confirmPassword');
      const confirmIcon = document.getElementById('toggleConfirmPasswordIcon');
      if (confirmPasswordField.type === 'password') {
        confirmPasswordField.type = 'text';
        confirmIcon.classList.remove('fa-eye');
        confirmIcon.classList.add('fa-eye-slash');
      } else {
        confirmPasswordField.type = 'password';
        confirmIcon.classList.remove('fa-eye-slash');
        confirmIcon.classList.add('fa-eye');
      }
    });
  </script>

</body>
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #E5E5E5;
}
.background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: whitesmoke;
    padding: 0;
}
.background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 50%;
     /* background-color: green; */
  background-size: cover; 
  background-position: center; 
  background-image: url('assets/green.png');
  background-repeat: no-repeat;
}
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 80%;
    max-width: 1200px;
    z-index: 1;
}

.left-section {
    margin-top: -72px;
}

.left-section img {
    width: 400px;
}

.right-section {
    background-color: white;
    padding: 20px;
    box-shadow: 5px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    width: 320px;
    /* height: 530px; */
    /* background-image: linear-gradient(to bottom, transparent 50%, white 50%), 
                    url('assets/top2.png'); */
                    background-image: linear-gradient(to bottom, white 50%, transparent 50%), 
                    url('assets/plantita.png');
  
  background-repeat: no-repeat;
  background-position: center bottom;
  background-size: contain;
    /* background-size: 100% 50%; 
   background-size: 150px auto; */
}

.right-section h2 {
    color: darkgreen;
    text-align: center;
}

.right-section input {
    width: 100%;
    padding: 8px;
    margin: 2px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
  border: 1px solid green;
}

.right-section p {
    margin: 0;
}

.password-container {
    position: relative;
}

.password-container input {
    padding-right: 30px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 65%;
    transform: translateY(-50%);
    cursor: pointer;
}

.right-section button {
    background-color: green;
    color: white;
    padding: 10px;
    width: 50%;
    margin: 0 80px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.right-section .footer {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.right-section .footer p {
    margin: 0;
    font-size: 14px;
}

.footer-separator {
    margin: 0 8px;
    font-weight: bold;
}

.right-section .footer a {
    color: #4CAF50;
    text-decoration: none;
}

.right-section .footer a:hover {
    text-decoration: underline;
}

.gender-section {
    display: flex;
    justify-content: space-between;
}

.gender-section input[type="radio"] {
    margin-right: 5px;
}

.gender-section label {
    margin-left: 10px;
}
</style>