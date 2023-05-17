<?php

include('../config/constants.php');
//echo "Delete Page";
if(isset($_GET['id'])and ISSET($_GET['image_name']))
{
    //echo "Get value and Delete";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove the physical image file is available

    if($image_name!="")
    {
        $path="../images/category".$image_name;

        //remove the imge
        $remove=unlink($path);

        if($remove==false)
        {
            $_SESSION['remove']="<div class='error'>Failed to remove Category image.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');

            die();
        }
    }

    //delete data from database
    $sql="DELETE FROM tbl_category where id=$id ";

    //execute the query
    $res=mysqli_query($conn,$sql);

    //check whether the data is deleted from database or not

    if($res==true)
    {
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete']="<div class='error'>Failed to Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
else
{
    header('location:',SITEURL.'admin/manage-category.php');
}

?>