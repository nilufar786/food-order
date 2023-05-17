<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br><br>


        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                       <textarea name="description"  cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >

                        <?php

                            //create php code to display categories from database

                            //1.create sql to get all acive categories from database
                            $sql="SELECT * FROM tbl_category where active='Yes' ";

                            //executing query
                            $res=mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not
                            $count=mysqli_num_rows($res);



                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>

                                          <option value="<?php echo $id; ?>"><?php echo $title;?></option>

                                    <?php
                                }


                            }
                            else
                            {
                                ?>
                                 <option value="0">No Categories Found</option>


                                <?php
                            }




                            //2.display the drop box


                            
                        ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Featured:
                    </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        Active:
                    </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


        <?php

                    //check whether the button is clicked  or not
                    if(isset($_POST['submit']))
                    {
                       // echo "clicked";
                       $title=$_POST['title'];
                       $description=$_POST['description'];
                       $price=$_POST['price'];
                       $category=$_POST['category'];


                        if(isset($_POST['featured']))
                        {
                            $featured=$_POST['featured'];
                        }
                        else
                        {
                            $featured="No";
                        }
                        if(isset($_POST['active']))
                        {
                            $active=$_POST['active'];
                        }
                        else
                        {
                            $active="No";
                        }

                        //check whether the select image is clicked or not and upload the image if it is selected
                        if(isset($_FILES['image']['name']))
                        {
                            $image_name=$_FILES['image']['name'];
                            //check whether the image is selected or not and upload image only if selected
                            if($image_name!="")
                            {
                                $ext=end(explode('.',$image_name));


                                $image_name="Food-Name-".rand(0000,9999).".".$ext; //new image may be like "Food-Name-657.jpg"

                                //upload the image
                                //Get the source path and Destination path

                                //source path is the current location of the image

                                $src=$_FILES['image']['tmp_name'];

                                //destination path for the image to be uploaded
                                $dst="../images/food/".$image_name;

                                //finally upload the image
                                $upload=move_uploaded_file($src,$dst);

                                //check whether image uploaded or not
                                if($upload==false)
                                {
                                    //failed to upload image

                                    //Redirect to add food page with error message
                                    $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                                    header('location:'.SITEURL.'admin/add-food.php');
                                    //stop the process
                                    die();
                                }
                            }


                        
                        }
                        else
                        {
                            $image_name="";
                        }
                        //create a sql queryto save or add food

                        $sql2="INSERT INTO tbl_food set 
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id=$category,
                        featured='$featured',
                        active='$active'
                        ";

                        //execute the query
                        $res2=mysqli_query($conn,$sql2);

                        //check ehether the data inserted or not
                        if($res2==true)
                        {
                            $_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');


                        }
                        else
                        {
                            $_SESSION['add']="<div class='error'>Failed To Add Food.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }


                    }

    ?>
    </div>
</div>



<?php include('partials/footer.php');?>