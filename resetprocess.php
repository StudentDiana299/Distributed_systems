<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "projo";
    
    
    // Get the submitted email
    $email = $_POST["Email"];

    // Connect to the database
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Check if the email exists in the database
    $query = "SELECT * FROM proj WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Generate a password reset token
        $token = bin2hex(random_bytes(2));
        
        // Save the token in the database
        $query = "UPDATE proj SET tokens = '$token' WHERE Email = '$email'";
        mysqli_query($conn, $query);
        $query = "SELECT Name FROM proj WHERE Email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["Name"];
        }
      
        // Send an email to the user with the password reset link
        $resetLink = "http://localhost/mueni/resetpassword.php?token=" . urlencode($token);
        $message = "Hello $name,Kindly click $resetLink reset your password.";
        $subject = "RESET YOUR PASSWORD";
        $senderName = "moriangomomanyi02@gmail.com"; // Replace with your name

        // Load PHPMailer
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        // Create a new PHPMailer instance
        $mailer = new PHPMailer(true);

        try {
            // Enable SMTP debugging (optional)
            // $mailer->SMTPDebug = SMTP::DEBUG_SERVER;

            // Set SMTP parameters
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'MORIANGOMOMANYI02@GMAIL.COM'; // Replace with your Gmail email address
            $mailer->Password = 'lesglfsaqlllbger'; // Replace with your Gmail password
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port = 587;

            // Set the sender and recipient
            $mailer->setFrom( $senderName);
            $mailer->addAddress($email);

            // Set email content
            $mailer->Subject = $subject;
            $mailer->Body = $message;
            $mailer->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            

            // Send the email
            $mailer->send();

            // Email sent successfully
            header("Location: emailsent.php");
            exit();
        } catch (Exception $e) {
            // Failed to send email
            echo "Failed to send password reset email. Error: {$mailer->ErrorInfo}";
        }
    } else {
        // Email not found in the database
        echo '<link rel="stylesheet" href="portaldef.css">';
        echo '<div id="warning-message" class="warning-message"><span class="warning-icon">&#9888;</span>Invalid Email Address.</div>';
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

    // Close the database connection
    mysqli_close($conn);
}
?>
