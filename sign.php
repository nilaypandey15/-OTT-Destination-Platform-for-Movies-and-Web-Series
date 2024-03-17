<?php
$insert = false;

if(isset($_POST['username'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "watchvibe";

    // Create connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set parameters
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $confirm_password = $_POST['confirm_password'];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO signin (username, password, confirm_password, dt) VALUES (?, ?, ?, current_timestamp())");
    $stmt->bind_param("sss", $username, $password, $confirm_password);

    // Execute statement
    if ($stmt->execute()) {
        $insert = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="sig.css">
    
</head>
<body>


    <div class="animation-container">
        <div class="animation"></div>
    </div>
    <div class="container">
        <div class="register-box">
            <div class="register-header">
                <span>Register</span>
            </div>
            <?php 
            if($insert) { 
               echo '<div class="success-message">Registration successful!</div>';
            }?>
            <form action="sign.php" method="post">
                <div class="input-box">
                    Username: <input type="text" name="username" required><br>
                </div>
                <div class="input-box">
                    Password: <input type="password" name="password" required><br>
                </div>
                <div class="input-box">
                    Confirm Password: <input type="password" name="confirm_password" required><br>
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="Register">
                </div>
                <div class="login">
                    <span>Already have an account? <a href="login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>

