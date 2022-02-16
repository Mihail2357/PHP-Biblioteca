<?php

//Include constants.php file here
include('../config/constants.php');

// 1. get the ID of appointment to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin
if($_SESSION['user'])
{
    $sql = "DELETE FROM books WHERE id=$id";

}

//Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if($res==true)
{
    //Query Executed Successully and appointment Deleted
    //echo "appointment Deleted";
    //Create SEssion Variable to Display Message
    $_SESSION['delete'] = "<div class='success'>Book Deleted Successfully.</div>";
    //Redirect to Manage appointments Page
    header('location:'.SITEURL.'admin/manage-books.php');
}
else
{
    
    $_SESSION['delete'] = "<div class='error'>Failed to Delete book. Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-books.php');
}



?>