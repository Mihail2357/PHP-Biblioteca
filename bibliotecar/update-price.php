<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update price</h1>

            <br><br>

            <?php
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM books WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $pret = $row['book_price'];
                }
                else
                {
                    header('location:'.SITEURL.'bibliotecar/manage-books.php');
                }
            }

            ?>


            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Pret </td>
                        <td>
                            <input type="text" name="pret" value="<?php echo $pret; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update price" class="btn-secondary">
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
    $pret = $_POST['pret'];

    //Create a SQL Query to Update Admin
    $sql = "UPDATE books SET
        book_price = '$pret' 
        WHERE id='$id'
        ";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==true)
    {
        $_SESSION['update'] = "<div class='success'>Price Updated Successfully.</div>";
        header('location:'.SITEURL.'bibliotecar/manage-books.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to update Price.</div>";
        header('location:'.SITEURL.'bibliotecar/manage-books.php');
    }
}

?>


<?php include('partials/footer.php'); ?>