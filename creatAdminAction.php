<?php
require_once 'db.php';
if ($_SERVER["REQUEST_METHOD"]=="POST"){

    $name=$_POST['username'];
//    $email=$_POST['mail'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
//    echo $name.$email.$pass.$cpass;

if(empty($name) || empty($pass) || empty($cpass)){
    header('Location:creatAdmin.php');
}
    $sql="SELECT * FROM `csms_superadmin` WHERE `username`='$name'";
    $result=$conn->query($sql);
    if ($result->num_rows==1)
    {
        echo '<script type ="text/JavaScript">';  
echo 'alert("Username already taken")';  
echo '</script>';  
      //  header('Location:creatAdmin.php');
    }
    else
    {
//        INSERT INTO `csms_superadmin`(`id`, `username`, `passwd`) VALUES
        if ($pass==$cpass){
            $sql="INSERT INTO `csms_superadmin`( `username`, `passwd`) 
                VALUES ( '$name',md5('$pass'))";
            $result=$conn->query($sql);
            header('Location:dashboard.php');
        }else
        {

           $_SESSION['alert'];
//            echo "  <script>alert ('Password not match')</script>" ;

              header('Location:creatAdmin.php');
        }
    }









}

