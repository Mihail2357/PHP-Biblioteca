<?php include('partials/menu.php'); ?>


    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Books</h1>

            <br />

            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Displaying Session Message
                unset($_SESSION['add']); //REmoving Session Message
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            ?>
            <br><br><br>

            <!-- Button to Add Appointment -->
            <a href="add-book.php" class="btn-primary">Add Book</a>

            <br /><br /><br />

            <table class="tbl-full">
                <tr>
                    <th>Nr. Crt.</th>
                    <th>ID</th>
                    <th>Book name</th>
                    <th>Autor name</th>
                    <th>Price</th>
                </tr>


                <?php
                $sql = "SELECT * FROM books";
                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //CHeck whether the Query is Executed of Not
                if($res==TRUE)
                {
                    // Count Rows to CHeck whether we have data in database or not
                    $count = mysqli_num_rows($res); // Function to get all the rows in database

                    $sn=1; //Create a Variable and Assign the value

                    //CHeck the num of rows
                    if($count>0)
                    {
                        //WE HAve data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //Using While loop to get all the data from database.
                            //And while loop will run as long as we have data in database

                            //Get individual DAta
                            $id=$rows['id'];
                            $name=$rows['book_name'];
                            $price=$rows['book_price'];
                            $autor=$rows['book_autor'];
                            //Display the Values in our Table
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $autor; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>bibliotecar/update-price.php?id=<?php echo $id; ?>" class="btn-secondary">Change Price</a>
                                    <a href="<?php echo SITEURL; ?>bibliotecar/delete-book.php?id=<?php echo $id; ?>" class="btn-danger">Delete Book</a>
                                </td>
                            </tr>

                            <?php

                        }
                    }
                    else
                    {
                        //We Do not Have Data in Database
                    }
                }

                ?>



            </table>

        </div>
    </div>
    <!-- Main Content Setion Ends -->

<?php include('partials/footer.php'); ?>