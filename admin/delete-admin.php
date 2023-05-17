<?php
//include constant.php file here
include('../config/constants.php');

//1.get the id of admin to be deleted
 $id=$_GET['id'];
//2.Create sql query to delete Admin
$sql="DELETE FROM tbl_admin WHERE id=$id";

//exute the query

$res=mysqli_query($conn,$sql);
//check whether the query executed successfully ornot
if($res==true)
{
    //query executed successfully and Admin deleted
    //echo "Admin Deleted";
    //create session variable to display mesage
    $_SESSION['delete']="<div class='success'>Admin deleted successfully</div>";
    //redirect to manage_admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
    //failed to delete 
    //echo "Failled to delete Admin";
    $_SESSION['delete']="<div class='error'>Failed to delete admin.Try again later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3.Redirect to manage


?>