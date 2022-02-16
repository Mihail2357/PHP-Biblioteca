<?php

//Include constants.php file here
include('../config/constants.php');

// 1. get the ID of appointment to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM rents WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if($res==true)
{
   
    $_SESSION['delete'] = "<div class='success'>Rent Deleted Successfully.</div>";
    header('location:'.SITEURL.'admin/manage-rents.php');
}
else
{
    

    $_SESSION['delete'] = "<div class='error'>Failed to Return . Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-rents.php');
}


?>