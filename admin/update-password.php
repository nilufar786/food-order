<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>


        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan=2>

                    <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        //create a sql query to update password

        $sql="SELECT * FROM tbl_admin where id='$id'
         and password='$current_password'
         ";


        //execute the query
        $res=mysqli_query($conn,$sql);

        //check whether the query executed successfully or not
        if($res==true)
        {
           $count=mysqli_num_rows($res);
           if($count==1)
           {
                //echo "User Found"
                //check whether the new  password and confirm password match or not

                if($new_password==$confirm_password)
                {
                  $sql2="UPDATE tbl_admin set
                  password='$new_password' 
                  where id=$id 
                  ";
                  $res2=mysqli_query($conn,$sql2);
                  
                  //check whwther the query executed or not

                  if($res2==true)
                  {
                    $_SESSION['change-pwd']="<div class='success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php'); 
                  }
                  else
                  {
                    $_SESSION['change-pwd']="<div class='error'>Failed To Change Password.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php'); 
                  }
                }
                else{
                    $_SESSION['user-not-found']="<div class='error'>Password didnot match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php'); 
                }

           }
           else
           {
            $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
           }
        
        }
        
        
    }
?>




<?php include('partials/footer.php'); ?>


