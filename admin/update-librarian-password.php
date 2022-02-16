<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>

        <br><br>

        <?php
        //1. Get the ID of Selected doctor
        $id=$_GET['id'];

        //2. Create SQL Query to Get the Details
        $sql="SELECT * FROM doctors WHERE id=$id";

        //Execute the Query
        $res=mysqli_query($conn, $sql);

        //Check whether the query is executed or not
        if($res==true)
        {
            // Check whether the data is available or not
            $count = mysqli_num_rows($res);
            //Check whether we have doctor data or not
            if($count==1)
            {
                // Get the Details
                //echo "doctor Available";
                $row=mysqli_fetch_assoc($res);
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-librarian.php');
            }
        }

        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="text" name="new-password" value="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update librarian" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

//Check whether the Submit Button is Clicked or not
if(isset($_POST['submit']))
{
    //echo "Button CLicked";
    //Get all the values from form to update
    $id = $_POST['id'];
    $raw_password = md5($_POST['new-password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    //Create a SQL Query to Update 
    $sql = "UPDATE doctors SET
        password = '$password'
        WHERE id='$id'
        ";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true)
    {
        $_SESSION['update'] = "<div class='success'>Librarian Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-librarian.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to update.</div>";
        header('location:'.SITEURL.'admin/manage-librarian.php');
    }
}

?>


<?php include('partials/footer.php'); ?>
