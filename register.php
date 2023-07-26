<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$servername = "localhost";
$username = "root";
$password = "";
$database = "projo";

// Connect to the database

$conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieving the portal creation credentials from the form
$Password = $_POST["password"];
$ConfirmPassword = $_POST["confirm"];
$Username = $_POST["username"];
$default = "form.php";

// Check if the passwords match
if ($Password !== $ConfirmPassword) {
    $portalCreationMessage = "Passwords do not match.";
} else {
    $sql = "INSERT INTO proj (Username, password, code)
    VALUES ('$Username',  '$Password', '$default')";

// Execute the query
if ($conn->query($sql) === TRUE) {
echo "Data inserted successfully!";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the database connection
mysqli_close($conn);
}
?>
<html>
<head>
<title>FORM</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<section id="form">
<h1>Contact Details</h1>
<br>
<fieldset>
    <form method="post">
        <input type="text" name="username" placeholder="Enter Username">
        <br><br>
        <input type="password" name="password" placeholder="Enter Password">
        <br><br>
        <input type="password"  name="confirm" placeholder="Enter Confirm Password">
        <br><br>
        <button id="btn1">REGISTER</button>
        <br>
        <h5>Already Registered?  <a href="login.php">Login</a></h5>
       <br><br>
    </form>
</fieldset>
</section>
</body>
</html>