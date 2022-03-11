<?php
 
    if (isset($_POST["verify_email"]))
    {
        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
 
        // connect with database
        $conn = mysqli_connect("localhost", "root", "", "otpverification");
 
        // mark email as verified
        $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
        $result  = mysqli_query($conn, $sql);
 
        if (mysqli_affected_rows($conn) == 0)
        {
            die("Verification code failed.");
        }
        echo '
        <script>
        window.location = "../routes/dashboard.php";
        </script>
    ';  
        exit();
    }
 
?>
<html>
    <head>
        <title>E-voting-system</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>
    <body>

        <style>
            #code{
                font-size: 1.3rem;
                border-radius: 20px;
                padding: 7px 25px;
                border: 20px solid white;
                background: rgb(255, 255, 255);
            }
            #btn{
                font-size: 1.3rem;
                align-self: center;
                border-radius: 20px;
                padding: 7px 113px;
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
    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required><br><br><br><br>
    <input id="code" type="text" name="verification_code" placeholder="Enter verification code" required /><br><br><br><br><br>
 
    <input id="btn" type="submit" name="verify_email" value="Verify Email">
</form>
    
    </div>
        </body>
    </center>
</html>
