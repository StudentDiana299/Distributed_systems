<?php
session_start();
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
     $Name = $_POST["Name"];
     $Phone = $_POST["Phone"];
     $Email = $_POST["Email"];
     $Reg = $_POST["Reg"];
     $Address = $_POST["Address"];

$username=$_SESSION["username"] ;
      // SQL query to insert data into the "proj" table
    $sql = "UPDATE proj 
    SET Name = '$Name', Phone_number = '$Phone', Email = '$Email', Reg_no = '$Reg', Address = '$Address'
    WHERE Username = '$username'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    // Data updated successfully!
    // Redirect to login.php
    header("Location: login.php");
    exit; // It's important to add the exit statement to stop further execution
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
       // Close the database connection
mysqli_close($conn);
}
?>
<html>
<head>
<title>FORM</title>
<style>
    *{
margin:0;
padding:0;
}
body{
background:#800080 blue;
}
#form h1{
    color: #101010;
    text-align: center;
    font-size: 25px;
    margin-top: 10%;
    font-family: 'Times New Roman', Times, serif;
    font-weight: bold;
}
fieldset{
    justify-content: center;
    margin-left: 30%;
    width: 40%;
    background-color: rgb(128, 103, 145);
    border: 2px solid black;
    box-shadow: 2px 4px 4px 5px maroon;
}
form{
    justify-content: center;
    margin: 20px;
}
input{
    margin-left: 35%;
    padding: 10px 20px;
    background-color: transparent;
}
input::placeholder{
    color: #fff;
}
input#username1{
    margin-top: 10%;
}
#btn1{
    border: 1px solid black;
   padding: 5px 20px;
   border-radius: 10px;
   background-color: midnightblue;
   color: #fff;
   margin-left: 45%;
   margin-right: 30%;
}
#btn1:hover{
    border: 1px solid black;
   padding: 5px 20px;
   border-radius: 10px;
   background-color: transparent;
   color: #101010;
   text-transform: capitalize;
  
}
h5{
    margin-left: 40%;
    margin-right: 30%;
}
#h5{
    margin-left: 30%;
    margin-right: 30%;
}
</style>
</head>
<body>
<section id="form">
<h1>Contact Details</h1>
<br>
<fieldset>
    <form method="post">
        <input type="text" name="Name" placeholder="Name">
        <br><br>
        <input type="number" name="Phone" placeholder="Phone Number">
        <br><br>
        <input type="text" name="Email" placeholder="Email">
        <br><br>
        <input type="text" name="Address" placeholder="Address">
        <br><br>
        <input type="text" name="Reg" placeholder="Registration Number">
        <br><br>
        <button id="btn1">SUBMIT</button>
    </form>
</fieldset>
</section>
</body>
</html>