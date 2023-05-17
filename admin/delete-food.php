<?php 
//include constants page
include('../config/constants.php');

//echo "delete food";
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //get id and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the image if available
        if($image_name!="")
        {
            $path="../images/food/".$image_name;

            //remove image file from folder
            $remove=unlink($path);

            //check whether the image is removed or not
            if($remove==false)
            {
                $_SESSION['upload']="<div class='error'>Failed To Remove Image.</div>";

                header('location:'.SITEURL.'admin/manage-food.php');

                die();//stop the procee of deleting food.

            }
        }
        //delete food from database
        $sql="DELETE FROM tbl_food where id=$id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whehther the query executed or not and set the session msg respecively
        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        else
        {
            $_SESSION['delete']="<div class='error'>Failed To Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }

    }
    else
    {
        $_SESSION['unauthorized']="<div class='error'>Unauthorizes Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>