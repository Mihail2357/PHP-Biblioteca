<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Rent</h1>

            <br><br>

            <?php
            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>User Name</td>
                        <td>
                            <input type="text" name="user_name" placeholder="Enter user_name">
                        </td>
                    </tr>

                    <tr>
                        <td>Book name </td>
                        <td>
                            <input type="text" name="book_name" placeholder="Enter book_name">
                        </td>
                    </tr>

                   

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Rent" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>


        </div>
    </div>

<?php include('partials/footer.php'); ?>


<?php

if(isset($_POST['submit']))
{
    // Button Clicked
    //echo "Button Clicked";
    $loggenOnUser = $_SESSION['user'];
    //1. Get the Data from form
    $user_name= $_POST['user_name'];
    $book_name = $_POST['book_name'];
    
    $sql = "SELECT * FROM books WHERE book_name =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $book_name);
    $stmt->execute();
    $rest = $stmt->get_result();
    $count = mysqli_num_rows($rest);

    $sql = "SELECT * FROM users WHERE username =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();
    $rest = $stmt->get_result();
    $count2 = mysqli_num_rows($rest);

    if($count>0 and $count2>0)
    
{
    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO rents SET 
           user_name='$user_name',
            book_name='$book_name',
            librarian_name='$loggenOnUser'
        ";

    //3. Executing Query and Saving Data into Datbase
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Rent Added Successfully.</div>";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'bibliotecar/rents.php');
    }
    else
    {
        //FAiled to Insert DAta
        //echo "Faile to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Failed to Add rent.</div>";
        header("location:".SITEURL.'bibliotecar/add-rent.php');
    }
}
    else
    {
        $_SESSION['add'] = "<div class='error'>Book or user doesn't exist!! </div>";
        header("location:".SITEURL.'bibliotecar/add-rent.php');
    }


}

?>