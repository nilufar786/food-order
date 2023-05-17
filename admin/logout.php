<?php

//Include constants.php for siteurl
include('../config/constants.php');
//1.destroy the session 
session_destroy();

//2.Redirect to its login page
header('location:'.SITEURL.'admin/login.php');

?>