<?php

//Authorization -Access control
//check whether the user is logged in or not
if(!isset($_SESSION['user'])) //if user session is not set
{
    //user is not logged in
    $_SESSION['no-login-msg']="<div class=error>please login to access Admin Panel.</div>";

    header('location:'.SITEURL.'admin/login.php');
}

?>