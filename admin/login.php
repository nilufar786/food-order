<?php include('../config/constants.php') ?>


<html>
    <head>
        <title>Login-Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-msg']))
        {
            echo $_SESSION['no-login-msg'];
            unset($_SESSION['no-login-msg']);
        }

        ?>

        <br><br>

        <!--Login form starts here-->
            <form action="" method="post" class="text-center">
                Username:
                <br>
                <input type="text" name="username" placeholder="Enter username">
                <br><br>
                Password:
                <br>
                <input type="password" name="password" placeholder="Enter password">
                <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>

            </form>


        <!-- Login form ends here -->


        <p class="text-center">Created By-<a href="#">Shake&Take Group</a></p>
    </div>
        
    </body>
</html>

<?php
//check whether the submit button is cliked or not

if(isset($_POST['submit']))
{
     $username=$_POST['username'];
     $password=md5($_POST['password']);

     $sql="SELECT * FROM tbl_admin where username='$username' AND password='$password'";

     $res=mysqli_query($conn,$sql);

     $count=mysqli_num_rows($res);

     if($count==1)
     {
        $_SESSION['login']="<div class='success'>Login Successful.</div>";

        $_SESSION['user']=$username; //to check whether the user is loged in or not and logout will unset it

        header('location:'.SITEURL.'admin/');
     }
     else
     {
        $_SESSION['login']="<div class='error text-center'>Username or Password did not match.</div>";

        header('location:'.SITEURL.'admin/login.php');
     }

}
?>