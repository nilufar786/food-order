<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
        //1.get the id of selected admin
        $id=$_GET['id'];

        //2.create sql query to create the details
        $sql="SELECT * FROM tbl_admin where id=$id";
        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not
        if($res==true)
        {
            $count=mysqli_num_rows($res);

        //check whether we have admin data or not

        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);
            $full_name=$row['full_name'];
            $username=$row['username'];

        }
        else
        {
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
        ?>

<form action=""method="post">
    <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td><input type="text"name="full_name" value="<?php echo $full_name ?>"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text"name="username" value="<?php echo $username ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="update admin" class="btn-secondary">
            </td>
        </tr>

    </table>
</form>

    </div>
</div>
<?php
    if(isset($_POST['id']))
    {
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];

        //create a sql query to update admin

        $sql="UPDATE tbl_admin set
        full_name='$full_name',
        username='$username' 
        where id='$id'
        ";
        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query executed successfully or not
        if($res==true)
        {
            $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
            //redirect to manage_admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        
        }
        else
        {
            //failed to update 
            //echo "Failled to update Admin";
            $_SESSION['update']="<div class='error'>Failed to update admin.Try again later.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        
    }
?>


<?php include('partials/footer.php');?>