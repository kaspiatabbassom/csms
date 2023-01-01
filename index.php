<?php

// code is silent

session_start();
if(!empty($_SESSION['username']))
{
    // echo '<h1>welcome to home page</h1>';
    header('Location:dashboard.php');
}
else
{
    // echo '<h1>not logined!</h1>';
    header('Location:login.php');
}

?>