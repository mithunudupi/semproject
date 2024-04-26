<?php
require "vendor/autoload.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["email"]) && isset($_POST["token"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        $email = $_POST["email"];
        $token = $_POST["token"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Here you would validate the password and confirm_password fields
        // For demonstration purposes, let's assume they pass validation
        if ($password === $confirm_password) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Update the user's password in the database (or any persistent storage) using the email and token
            // Remember to verify the token against the database to ensure it's valid and matches the email
            // Once the password is updated, you can redirect the user to a login page or any other appropriate page

            // For demonstration purposes, let's assume the password is updated successfully
            echo "Password reset successfully. You can now <a href='login.php'>login</a> with your new password.";
        } else {
            echo "Passwords do not match.";
        }
    } else {
        echo "Incomplete form data. Please provide email, token, password, and confirm password.";
    }
} else {
    echo "Invalid request method.";
}
?>
