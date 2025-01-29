<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="register-form">
        <h1>Registration Form</h1>
        <form method="post" action="lab.php"<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <label for="profilePhoto">Upload Profile Photo:</label>
            <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" required>
            
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="branch">Branch:</label>
            <select id="branch" name="branch">
                <option value="BCA">BCA</option>
                <option value="B. Tech">B. Tech.</option>
                <option value="DIPLOMA">Diploma (CSE)</option>
                <option value="BBA">BBA</option>
            </select>

            <label for="semester">Select Semester:</label>
            <select id="semester" name="semester">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
            </select>

            <label for="division">Select Division:</label>
            <select id="division" name="division">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>

            <label for="mobile_no">Mobile No.:</label>
            <input type="tel" id="mobile_no" name="mobile_no" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="parents_contact">Parents Contact No.:</label>
            <input type="tel" id="parents_contact" name="parents_contact" required><br>

            <label for="gender">Select Gender:</label>
            <select id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
                <option value="prefer_not_to_say">Prefer not to say</option>
            </select>

            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" required><br>

            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion" required><br>

            <label for="cast">Cast:</label>
            <input type="text" id="cast" name="cast" required><br>

            <label for="nationality">Nationality:</label>
            <input type="text" id="nationality" name="nationality" placeholder="Enter your nationality" required>

            <label for="bloodgroup">Blood Group:</label>
            <select id="bloodgroup" name="bloodgroup" required>
                <option value="">Select your blood group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>

            <label for="aadhar">Aadhar Card Number:</label>
            <input type="text" id="aadhar" name="aadhar" placeholder="Enter your Aadhar card number" required>

            <label for="motherTongue">Mother Tongue:</label>
            <input type="text" id="motherTongue" name="motherTongue" placeholder="Enter your mother tongue" required>

            <label for="address">Present Address:</label>
            <textarea id="address" name="address" placeholder="Enter your address" rows="4" cols="50" required></textarea>

            <label for="parmenent">Permanent Address:</label>
            <input type="text" id="parmenent" name="parmenent" placeholder="Enter your permanent address" required>

            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" placeholder="Enter your pincode" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" placeholder="Enter your state" required>

            <label for="district">District:</label>
            <input type="text" id="district" name="district" placeholder="Enter your district" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" placeholder="Enter your country" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <button type="submit" href="lab.php">Register (Sign Up)</button><br><br> 

            <a href="login.php">
                <button type="button">Sign In (Login)</button>
            </a>
        </form>
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

// Handling form submission     
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    $Cast = mysqli_real_escape_string($conn, $_POST['Cast']);
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

    // Insert data into the database
    $sql = "INSERT INTO student (
         First_name, Middle_name, Last_name, Branch, Semester, Division, Email_id, parentcontact_no,
        Gender, Birthdate, Religion, Cast, Nationality, BloodGroup, AadharCardNO, MotherTounge, Present_Address,
        Parmenant_Address, District, Pincode, State, Country
    ) VALUES (
     '$first_name', '$middle_name', '$last_name', '$branch', '$semester', '$division', '$email_id',
        '$parentcontact_no', '$gender', '$birthdate', '$religion', '$Cast', '$nationality', '$bloodgroup', '$aadhar',
        '$mother_tongue', '$present_address', '$permanent_address', '$district', '$pincode', '$state', '$country'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

 
}
?>
