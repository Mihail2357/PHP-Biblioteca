<?php include('../config/constants.php');?>

    <html>
    <head>
        <title>Login - Hospital</title>
        <link rel="stylesheet" href="../css/user.css">
    </head>

    <body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <!-- Login Form Starts HEre -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            
        </form>
        <!-- Login Form Ends HEre -->

    </div>

    </body>
    </html>

<?php


if(isset($_POST['submit']))
{
    
    $username = test_input(mysqli_real_escape_string($conn, $_POST['username']));

    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    //2. SQL to check whether the user with username and password exists or not
       $sql = "SELECT * FROM admins WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();


    //4. COunt rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //User AVailable and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

        //REdirect to HOme Page/Dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
     
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

}

?>