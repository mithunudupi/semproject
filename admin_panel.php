<?php
include 'connection.php';

session_start();
$admin_id = $_SESSION['admin_name'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit(); // Make sure to exit after redirection
}

if (isset($_POST['logout'])) { // Changed to check if 'logout' is set
    session_destroy();
    header('location:login.php');
    exit(); // Make sure to exit after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
<?php include 'admin_header.php'; ?>
</body>
</html>
