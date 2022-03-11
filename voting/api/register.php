<?php
    include("connect.php");

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $aadhaar = $_POST['aadhaar'];
    $voterid = $_POST['voterid'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $role = $_POST['role'];

    if($password==$cpassword){
        move_uploaded_file($tmp_name, "../uploads/$image");
        $insert = mysqli_query($connect, "INSERT INTO user (name,mobile,address,password,photo,role,status,votes,aadhaar,voterid) VALUES ('$name','$mobile','$address','$password','$image','$role',0,0,'$aadhaar','$voterid' )");
        if($insert){
            echo '
            <script>
                alert("registration successfull!");
                window.location = "../";
            </script>    
        ';
        }
        else{
            echo '
                <script>
                    alert("some error occured!");
                    window.location = "../routes/register.html";
                </script>
        ';  
    }
}
    else{
        echo '
            <script>
                alert("password and conform password doesnot match!");
                window.location = "../routes/register.html";
            </script>    
        
        ';
    }
?>