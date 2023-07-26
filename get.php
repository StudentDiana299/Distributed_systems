<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "projo";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$Name = $Phone = $Email = $Reg = $Address = "";

// Check if the 'reg' key exists in the $_POST array
if (isset($_POST["reg"])) {
    // Fetch the data from the form
    $Reg_no = $_POST["reg"];

    // SQL query to fetch data from the "proj" table based on the 'Reg_no'
    $sql = "SELECT * FROM proj WHERE Reg_no = '$Reg_no'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Fetch the first row from the result as we are expecting only one record with a unique Reg_no
        $row = $result->fetch_assoc();

        // Extract data from the row
        $Name = $row["Name"];
        $Phone = $row["Phone_number"];
        $Email = $row["Email"];
        $Reg = $row["Reg_no"];
        $Address = $row["Address"];
    } else {
        // If no matching record is found, set an error message
        $error_message = "No record found for Reg_no: $Reg_no";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="form">
    <h1>Display User Information</h1>
    <fieldset>
        <form method="post">
            <input type="text" name="reg" placeholder="Enter Reg_No" required="text">
            <br><br>
            <button id="btn1">Search</button>
            <br>
        </form>
    </fieldset>

    <?php
    // Check if there are any results to display
    if (isset($Name) && isset($Phone) && isset($Email) && isset($Reg) && isset($Address)) {
        // Display the information
        echo "<fieldset>";
        echo "<h2>User Information</h2>";
        echo "Name: $Name<br>";
        echo "Phone: $Phone<br>";
        echo "Email: $Email<br>";
        echo "Reg_no: $Reg<br>";
        echo "Address: $Address<br>";
        echo "</fieldset>";
    }

    // Display the error message, if any
    if (isset($error_message)) {
        echo "<fieldset>";
        echo "<h2>Error</h2>";
        echo $error_message;
        echo "</fieldset>";
    }
    ?>

</section>
</body>
</html>
