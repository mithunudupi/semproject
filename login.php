<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "shop_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION['uname'])){ 
    header("Location: logout.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    $form_username = $_POST['uname']; 
    $password = $_POST['password'];
    
    // Fetch user from database
    $sql = "SELECT * FROM users WHERE form_username ='$form_username'  AND password='$password'";
    $result=$conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['uname'] = $user;
        header("Location: admin_header.php"); // Redirect to admin page
        exit();
    } else {
        echo "<p style='color:red'>INVALID USERNAME OR PASSWORD</p>";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>--
</head>
<body>
    <div class="wrapper">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" required name="uname">
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" required name="password">
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="forgot_password.html">Forgot password?</a>
            </div>
            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account?<a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
