<?php
require "vendor/autoload.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["email"]) && isset($_GET["token"])) {
        $email = $_GET["email"];
        $token = $_GET["token"];

        // Here you would verify the token against the database (or any persistent storage)
        // If the token is valid, display the password reset form
        // If the token is invalid or expired, show an error message

        // For demonstration purposes, let's assume the token is valid
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Reset Password</title>
        </head>
        <body>
            <h2>Reset Your Password</h2>
            <form action="reset_password_process.php" method="post">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br>
                <button type="submit">Reset Password</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Invalid request. Please provide email and token.";
    }
} else {
    echo "Invalid request method.";
}
?>
