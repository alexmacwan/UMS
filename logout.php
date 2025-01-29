<?php
// Start the session
session_start();

// Destroy the session to log the user out
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logout.css">
    <title>Logged Out</title>
</head>
<body>
    <div class="container">
        <h1>You have been logged out</h1>
        <p>Thank you for visiting! We hope to see you again soon.</p>
        <a href="login.php" class="btn">Log In Again</a>
        <a href="home.php" class="btn">Return to Home</a>
    </div>
</body>
</html>