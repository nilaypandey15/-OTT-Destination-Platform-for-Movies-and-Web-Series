<?php
// Initialize variables
$login_successful = false;
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
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

    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user into database
    $sql = "INSERT INTO signin (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful, set login_successful to true
        $login_successful = true;
    } else {
        // Registration failed, set error message
        $error_message = "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="sig.css">
</head>
<body>
    <div class="animation-container">
        <div class="animation"></div>
    </div>
    <div class="container">
        <div class="login-box">
            <div class="login-header">
                <span>Login</span>
            </div>
            <?php if ($login_successful): ?>
                <div class="success-message">Registration successful! You can now login.</div>
            <?php elseif ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="input-box">
                    Username: <input type="text" name="username" required><br>
                </div>
                <div class="input-box">
                    Password: <input type="password" name="password" required><br>
                </div>
                <div class="input-box">
                    <input type="submit" class="input-submit" value="Register">
                </div>
                <div class="signup">
                    <span>Already have an account? <a href="login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
