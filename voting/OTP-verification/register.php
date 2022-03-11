<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require 'vendor/autoload.php';
 
    if (isset($_POST["register"]))
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
 
        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
 
        try {
            //Enable verbose debug output
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
 
            //Send using SMTP
            $mail->isSMTP();
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = "seenu502siddarth@gmail.com";
 
            //SMTP password
            $mail->Password = "siddarth0508";
 
            //Enable TLS encryption;
            $mail->SMTPSecure = 'ssl';
 
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 465;
 
            //Recipients
            $mail->setFrom("seenu502siddarth@gmail.com", "OTP-VERIFICATION");
 
            //Add a recipient
            $mail->addAddress($email, $name);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
 
            $mail->send();
            // echo 'Message has been sent';
 
            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
 
            // connect with database
            $conn = mysqli_connect("localhost", "root", "", "otpverification");
 
            // insert in users table
            $sql = "INSERT INTO users(name, email, password, verification_code, email_verified_at) VALUES ('" . $name . "', '" . $email . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
            mysqli_query($conn, $sql);
 
            header("Location: email-verification.php?email=" . $email);
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
<html>
    <head>
        <title>E-voting-system</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>
    <body>

        <style>
            #name{
                font-size: 1rem;
                border-radius: 20px;
                padding: 7px 25px;
                border: 10px solid white;
                background: rgb(255, 255, 255);
                
            }
            #email{
                font-size: 1rem;
                border-radius: 20px;
                padding: 7px 25px;
                border: 10px solid white;
                background: rgb(255, 255, 255);
            }
            #password{
                font-size: 1rem;
                border-radius: 20px;
                padding: 7px 25px;
                border: 10px solid white;
                background: rgb(255, 255, 255);
            }
            #btn{
                font-size: 1.5rem;
                align-self: center;
                border-radius: 20px;
                padding: 7px 73px;
                border: 2px solid white;
                background:blueviolet;
                }
        </style>

        <div id="mainSection">
            
        <div id="headerSection">
            <center>
                <h1>OTP-VERIFICATION</h1>
        </div>
        
    <hr>
    <div id="bodySection">
    <form method="POST">
    <input id="name" type="text" name="name" placeholder="Enter Name" required /><br><br><br><br>
    <input id="email" type="email" name="email" placeholder="Enter Email" required /><br><br><br><br>
    <input id="password" type="password" name="password" placeholder="Enter Password" required /><br><br><br><br>
 
    <input id="btn" type="submit" name="register" value="VERIFY">
</form>
    
    </div>
        </body>
    </center>
</html>
