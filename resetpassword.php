<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
    // Display the password reset form
    ?>

<html>
<head>
<title>Password Reset</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<section id="form">
<h1>Reset Your Password</h1>
<fieldset>
    <form action="update_password.php" method="post">
    <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
        <input type="password" name="new_password" placeholder="Enter Password" required="password">
        <br><br>
        <input type="password" name="password" placeholder="Confirm Password" required="password">
        <br><br>
        <button  id="btn1">Reset Password</button>
        <br>
    </form>
</fieldset>
</section>

</body>
</html>

<?php
} else {
    echo "Invalid request.";
}
?>
