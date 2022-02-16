<?php

//Include constants.php file here
include('../config/constants.php');

// 1. get the ID of librarian to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete librarian
$sql = "DELETE FROM librarians WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if($res==true)
{
    //Query Executed Successully and librarian Deleted
    //echo "librarian Deleted";
    //Create SEssion Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Librarian Deleted Successfully.</div>";
    //Redirect to Manage Doctor Page
    header('location:'.SITEURL.'admin/manage-librarian.php');
}
else
{
    

    $_SESSION['delete'] = "<div class='error'>Failed to Delete Librarian. Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-librarian.php');
}


?>