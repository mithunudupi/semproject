<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="registerstyle.css">
  <title>Register Page</title>
</head>
<body>
  <section class="form-container">
    <form method="post" action="register.php">  <h1>Register Now</h1>
      <input type="text" name="name" placeholder="Enter your name (required)">
      <input type="email" name="email" placeholder="Enter your email (required)">
      <input type="password" name="password" placeholder="Enter your password (required)" required>
      <input type="password" name="cpassword" placeholder="Confirm your password (required)" required>
      <input type="submit" name="submit-btn" value="Register Now" class="btn">
      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
  </section>
</body>
</html>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $form_username = $_POST['name']; // Changed variable name to avoid conflict
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    // Check if password and confirm password match
    if ($password !== $cpassword) {
        // Passwords don't match, display error message
        $error_message = "Password and confirm password do not match.";
    } else {
        // Passwords match, continue with registration process
        
        // Your additional validation code here (e.g., check if email is unique, etc.)
        
        // If all validations pass, proceed with registration
        // For simplicity, let's assume we insert the user into a database
        
        // Database connection code (replace with your actual database connection code)
        $servername = "localhost";
        $username = "root"; // Changed variable name to avoid conflict
        $password = "";
        $database = "shop_db";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database); // Changed variable name
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        // Prepare and execute SQL statement to insert user into the database
        $sql = "INSERT INTO users (form_username, email, password) VALUES ('$form_username', '$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registered Successfully";
            header("Location: login.php");
            exit();
        } else {
            // If something went wrong with the database insertion
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // Close database connection
        $conn->close();
    }
}
?>



