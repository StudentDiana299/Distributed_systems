<?php
session_start();
// Assuming your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "projo";



// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Function to handle login
function login($Username, $Password, $conn) {
    // Query to fetch the stored values from the validation table
    $query = "SELECT * FROM proj WHERE username ='$Username' AND password = '$Password'";
    $result = mysqli_query($conn, $query);
    if ($result === false) {
        // Query execution failed
        echo "Error executing SQL query: " . mysqli_error($conn);
    } else {
        // Proceed with further processing

    // Check if a row is returned
    if (mysqli_num_rows($result) > 0) {
         // Fetch the portal value from the validation table
         $row = mysqli_fetch_assoc($result);
         $portal = $row['code'];
         
        // Redirect to the desired page
        header("Location: $portal");
        exit();
    } else {
        // Invalid reg.no or password
        echo '<link rel="stylesheet" href="portaldef.css">';
    echo '<div id="warning-message" class="warning-message"><span class="warning-icon">&#9888;</span>Invalid reg.no or password.</div>';
    echo '<script>
    // Show the warning message
    var warningMessage = document.getElementById("warning-message");
    warningMessage.style.display = "block";
            // Automatically hide the warning message after 5 seconds
            setTimeout(function() {
                var warningMessage = document.getElementById("warning-message");
                warningMessage.style.display = "none";
            }, 5000);
          </script>';
}
    }
}


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Retrieve the values entered in the form
    $Username = $_POST["Username"];
    $Password = $_POST['password'];
    // Store values in the session
$_SESSION["username"] = $Username;

    // Call the login function
    login($Username, $Password, $conn);
}
// Close the database connection
mysqli_close($conn);
?>
<html>
<head>
<title>LOGIN</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<section id="form">
<h1>LOGIN</h1>
<fieldset>
    <form  method="post">
        <input type="text" id="username1" name="Username" placeholder="Enter Username" required="text">
        <br><br>
        <input type="password" name="password" placeholder="Enter Password" required="password">
        <br><br>
        <button id="btn1">LOGIN</button>
        <br>
        <h5>Not Registered?<a href="register.php">Register</a></h5>
       <br><br>
       <h5 id="h5">Forgot Password?  <a href="reset.html">Reset Password</a></h5>
       <h5 id="h5"><a href="get.php">Search User Information</a></h5>
    </form>
</fieldset>
</section>
</body>
</html>