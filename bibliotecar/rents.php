<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
        <h1>Carti inchiriate</h1>
        <br />
        <br><br><br>


        <a href="add-rent.php" class="btn-primary">Add Rent</a>

<br /><br /><br />


            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Book Name</th>
                    <th>Librarian Name</th>
                    <th>Actions</th>
                </tr>


                <?php
                if (isset($_SESSION['user'])) {
                    $loggenOnUser = $_SESSION['user'];
                } else {
                    $loggenOnUser = " a public user";
                }
                $sql = "SELECT * FROM librarians WHERE username=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $loggenOnUser);
                $stmt->execute();
                $res = $stmt->get_result();
                while($rows=mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                }
                //Query to Get all app
                $sql = "SELECT * FROM rents WHERE librarian_name =?";
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
                    { //echo $count;
                        //WE HAve data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {

                            //Get individual DAta
                            $id=$rows['id'];
                            $patient_id=$rows['user_name'];
                            $doctor_id=$rows['book_name'];
                            $date = $rows['librarian_name'];
                            //Display the Values in our Table
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $patient_id; ?></td>
                                <td><?php echo $doctor_id; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>bibliotecar/delete-rent.php?id=<?php echo $id; ?>" class="btn-danger">Return book</a>
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

<?php include('partials/footer.php') ?>