<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Adauga Bibliotecar</h1>

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
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Your Name">
                        </td>
                    </tr>

                    <tr>
                        <td>Speciality: </td>
                        <td>
                            <input type="text" name="speciality" placeholder="Enter Speciality">
                        </td>
                    </tr>

                    <tr>
                        <td>Phone Number: </td>
                        <td>
                            <input type="text" name="phone_number" placeholder="Enter Phone Number">
                        </td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Your Username">
                        </td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Your Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Librarian" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>


        </div>
    </div>

<?php include('partials/footer.php'); ?>


<?php
//Process the Value from Form and Save it in Database

//Check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    // Button Clicked
    //echo "Button Clicked";

    //1. Get the Data from form
    $full_name = $_POST['full_name'];
    $speciality = $_POST['speciality'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5

    //2. SQL Query to Save the data into database
    $sql = "INSERT INTO librarians SET 
            full_name='$full_name',
            speciality='$speciality',
            phone_number='$phone_number',
            username='$username',
            password='$password'
        ";

    //3. Executing Query and Saving Data into Datbase
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Doctor Added Successfully.</div>";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-librarian.php');
    }
    else
    {
        //FAiled to Insert DAta
        //echo "Faile to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Failed to Add librarian.</div>";
        //Redirect Page to Add Doctor
        header("location:".SITEURL.'admin/add-librarian.php');
    }

}

?>