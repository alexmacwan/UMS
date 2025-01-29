<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="log.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <div class="login-photo">
            <img src="C:\Users\alexm\Downloads\L_79486.gif" alt="Profile Photo">
        </div>
        <div class="login-form">
            <form method="POST" action="login.php">
                <h2>Login</h2>
                <label for="enrollment">Email: </label>
                <input type="text" id="enrollment" name="enrollment" placeholder="Enter your enrollment number" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <a href="http://localhost/php/register/dash.php#">
                <button type="submit"><a href="http://localhost/php/register/lab.php">Login</button> </a>
                
            </form>
        </div>
    </div>
</body>
</html>

<?php


session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ums";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enrollment = mysqli_real_escape_string($conn, $_POST['enrollment']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    $sql = "SELECT * FROM student WHERE enrollment_no = '$enrollment'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['enrollment'] = $enrollment;
        header('Location: dash.php');
        exit();
    } else {
        echo "<p style='color:red;'>SUCCESSUFULLY</p>";
    }
}

mysqli_close($conn);
?>
