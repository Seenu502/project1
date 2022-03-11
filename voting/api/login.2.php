<?php
     
    if (isset($_POST["login"]))
    {
        $name = $_POST["name"];
        $password = $_POST["password"];
 
        // connect with database
        $conn = mysqli_connect("localhost", "root", "", "voting system");
 
        // check if credentials are okay, and email is verified
        $sql = "SELECT * FROM admin WHERE name = '$name' AND password ='$password' ";
        $result = mysqli_query($conn, $sql);
 
        if (mysqli_num_rows($result) == 0)
        {
            die("Admin not found or invalid password");
        }
 
        $user = mysqli_fetch_object($result);
 
        echo '
        <script>
        window.location = "../routes/result.php";
        </script>
    ';   ;
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
            #name{
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
                padding: 7px 80px;
                border: 2px solid white;
                background:blueviolet;
                }
        </style>

        <div id="mainSection">
            
        <div id="headerSection">
            <center>
                <h1>ADMIN LOGIN</h1>
        </div>
        
    <hr>
    <div id="bodySection">
    <form method="POST">
    <input id="name" type="name" name="name" placeholder="Admin Name" required /><br><br><br><br>
    <input id="password" type="password" name="password" placeholder="Enter password" required /><br><br><br><br>
 
    <input id="btn" type="submit" name="login" value="SIGN UP"><br><br>
</form>
    
    </div>
        </body>
    </center>
</html>

