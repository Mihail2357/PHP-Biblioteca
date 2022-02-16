<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add book</h1>

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
                        <td>book_price: </td>
                        <td>
                            <input type="text" name="book_price" placeholder="Enter book_price">
                        </td>
                    </tr>

                    <tr>
                        <td>book_name </td>
                        <td>
                            <input type="text" name="book_name" placeholder="Enter book_name">
                        </td>
                    </tr>

                    <tr>
                        <td>Writer name: </td>
                        <td>
                            <input type="text" name="autor_name" placeholder="autor_name">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add book" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>


        </div>
    </div>

<?php include('partials/footer.php'); ?>


<?php


if(isset($_POST['submit']) )
{
  
    $book_price= $_POST['book_price'];
    $book_name = $_POST['book_name'];
    $autor = $_POST['autor_name'];
    echo $book_price;

    if($book_price<0)
    {
        $_SESSION['add'] = "<div class='error'>Failed to Add book. Price is not positive </div>";
        
        
    }
    else{

    

    $sql = "INSERT INTO books SET 
            book_price='$book_price',
            book_name='$book_name',
            book_autor='$autor'
        ";


    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if($res==TRUE)
    {
        
        $_SESSION['add'] = "<div class='success'>Book Added Successfully.</div>";
        header("location:".SITEURL.'admin/manage-books.php');
    }
    
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to Add book.</div>";

        header("location:".SITEURL.'admin/add-book.php');
    }

}}

?>