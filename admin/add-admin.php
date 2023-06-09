<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

        <?php
            if(isset($_SESSION['add']))//checking whether the session is set or not
            {
                echo $_SESSION['add'];//display the msg if set
                unset($_SESSION['add']);//remove session msg
            }
        
        ?>

        <form action=""method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text"name="full_name" placeholder="Enter your name"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text"name="username" placeholder="Enter your username"></td>
                
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password"name="password" placeholder="Enter your password"></td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit"name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>



<?php include('partials/footer.php'); ?>



<?php   
//process the value from form and save it in Database


//Check whether the button is clicked or not

if(isset($_POST['submit']))
{
    //Button clicked
   // echo "Button Clicked";

   //1.Get data from form.

    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);//password encryption with md5

    //2.sql query to save the data into database

    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";

    //3.Executing query and saving data into database

    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    //4.Check whether data is inserted or not and display appropriate message

    if($res==TRUE)
    {
        ///data inserted
      //  echo "Data Inserted";
      //create session variable to display msg
      $_SESSION['add']="Admin added succesfully";
      //Redirect Page
      header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
       // echo "Failed to insert data";

             //create session variable to display msg
      $_SESSION['add']="Failed to add admin";
      //Redirect Page to add admin
      header("location:".SITEURL.'admin/add-admin.php');
    }
}


?>