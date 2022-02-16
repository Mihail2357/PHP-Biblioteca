<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">


            <table class="tbl-full">
                <tr>
                    <th>Nr. Crt.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Book Name</th>
                    <th>Librarian Name</th>
                </tr>


                <?php
                if (isset($_SESSION['user'])) {
                    $loggenOnUser = $_SESSION['user'];
                } else {
                    $loggenOnUser = " a public user";
                }
                $sql = "SELECT * FROM users WHERE username=?";
                //Execute the Query
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $loggenOnUser);
                $stmt->execute();
                $res = $stmt->get_result();
                while($rows=mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                }

                //Query to Get all app
                $sql = "SELECT * FROM rents WHERE user_name =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $loggenOnUser);
                $stmt->execute();
                $res = $stmt->get_result();

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
                            $user_name=$rows['user_name'];
                            $book_name=$rows['book_name'];
                            $librarian_name = $rows['librarian_name'];
                            //Display the Values in our Table
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $user_name; ?></td>
                                <td><?php echo $book_name; ?></td>
                                <td><?php echo $librarian_name; ?></td>
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

<?php include('partials/footer.php') ?>