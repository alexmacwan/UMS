<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="container">
        <div class="profile-section">
            <h1 style="text-align:center">Dashboard</h1>
            <img src="" alt="Profile Photo" class="profile-photo">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="enrollmentNo">Enrollment no:</label>
                <input type="text" id="enrollmentNo" name="enrollmentNo" required><br><br>
                
                <label for="studentContactNo">Student Contact No:</label>
                <input type="text" id="studentContactNo" name="studentContactNo" required><br><br>
                
                <label for="parentContactNo">Parent Contact No:</label>
                <input type="text" id="parentContactNo" name="parentContactNo"><br><br>
                
                <button> <a href="lab.php"> SUBMIT</a></button> 
                <input type="reset" value="Reset">
            </form>
        </div>
        <div class="notification-section">
            <div class="notification-pop-up">
                <h2>Notifications</h2>
                <nav>
                    <a href="#">Circular</a>
                    <a href="#">LMS Information</a>
                    <a href="#">Students' </a>
                    <h1> Nothing to show</h1>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ums";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have a way to identify the user, e.g., through session
$userId = 1; // Replace with the actual user ID from session or other means



// Update user data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $division = mysqli_real_escape_string($conn, $_POST['division']);
    $email_id = mysqli_real_escape_string($conn, $_POST['email']);
    $parentcontact_no = mysqli_real_escape_string($conn, $_POST['parents_contact']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $religion = mysqli_real_escape_string($conn, $_POST['religion']);
    $cast = mysqli_real_escape_string($conn, $_POST['cast']);
    $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
    $bloodgroup = mysqli_real_escape_string($conn, $_POST['bloodgroup']);
    $aadhar = mysqli_real_escape_string($conn, $_POST['aadhar']);
    $mother_tongue = mysqli_real_escape_string($conn, $_POST['motherTongue']);
    $present_address = mysqli_real_escape_string($conn, $_POST['address']);
    $permanent_address = mysqli_real_escape_string($conn, $_POST['parmenent']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);

    // SQL query to update data
    $sql = "UPDATE student SET 
        First_name = '$first_name',
        Middle_name = '$middle_name',
        Last_name = '$last_name',
        Branch = '$branch',
        Semester = '$semester',
        Division = '$division',
        Email_id = '$email_id',
        parentcontact_no = '$parentcontact_no',
        Gender = '$gender',
        Birthdate = '$birthdate',
        Religion = '$religion',
        Cast = '$cast',
        Nationality = '$nationality',
        BloodGroup = '$bloodgroup',
        AadharCardNO = '$aadhar',
        MotherTounge = '$mother_tongue',
        Present_Address = '$present_address',
        Parmenant_Address = '$permanent_address',
        District = '$district',
        Pincode = '$pincode',
        State = '$state',
        Country = '$country'
    WHERE id = $userId"; // Change 'id' to your primary key

    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>