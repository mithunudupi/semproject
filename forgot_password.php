<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "vendor/autoload.php";

// Assuming you have already established a database connection
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if email is provided
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        // Validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Generate random password reset token
            $token = bin2hex(random_bytes(16));

            // Store token in database
            $stmt = $conn->prepare("INSERT INTO users (email, token) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $token); // "ss" indicates two string parameters
            $stmt->execute([$email, $token]);

            // Send email with password reset link
            $resetLink = "http://example.com/reset_password.php?email=" . urlencode($email) . "&token=" . $token;

            // Instantiate PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'mithunudupi123@gmail.com';
                $mail->Password   = 'Mithun@123';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('mithunudupi123@gmail.com', 'mithun');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body    = 'Click the following link to reset your password: <a href="' . $resetLink . '">Reset Password</a>';

                $mail->send();
                echo "<br>Email sent successfully. Check your inbox.";
            } catch (Exception $e) {
                echo "<br>Failed to send email. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Invalid email address.";
        }
    } else {
        echo "Email not provided.";
    }
}
?>


