<?php include('../config/constants.php');?>
<script src="https://www.google.com/recaptcha/api.js"></script>



    <html>
    <head>
        <title>Signup </title>
        <link rel="stylesheet" href="../css/user.css">
    </head>

    <body>

    <div class="signup">
        <h1 class="text-center">Signup</h1>
        <br><br>
        <form method="POST" action="" class="text-center">

            Full Name: <br>
            <input type="text" name="full_name" placeholder="full_name"><br><br>
            Username: <br>
            <input type="text" name="username" placeholder="Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Parola"><br><br>
            Recaptcha: <br>
            <div class="g-recaptcha" data-sitekey="6LcE1v8ZAAAAAAtQcSVNJTxkPJzg-neQYVjygHtM" ></div> <br>
            <input type="submit" name = "submit" value="Sign Up">
        </form>

        <?php
        if(isset($_SESSION['signup']))
        {
            echo $_SESSION['signup'];
            unset($_SESSION['signup']);
        }

        if(isset($_SESSION['no-signup-message']))
        {
            echo $_SESSION['no-signup-message'];
            unset($_SESSION['no-signup-message']);
        }
        ?>
    </div>
<div class="wrapper-button1">
    <a href="login.php" class="button1">Login</a>
    </a>
</div>

</body>
</html>

<?php

require_once('../includes/functions.php');

if (isset($_POST['submit']) && isset($_POST['g-recaptcha-response'])) {
    $response_key = $_POST["g-recaptcha-response"];
    $user_ip = $_SERVER["REMOTE_ADDR"];

    if (!rezultat_recaptcha($response_key, $user_ip)) {
        $_SESSION['signup'] = "<div class='error text-center'> recaptcha not filled</div>";
        header('location:' . SITEURL . 'user/signup.php'); }

    else {


if (!empty($_POST['full_name']) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['password'])) {

    $full_name = test_input(mysqli_real_escape_string($conn,$_POST['full_name']));
    $username = test_input(mysqli_real_escape_string($conn,strtolower($_POST['username'])));
    $password = $_POST['password'];

    $password_hashed = md5(test_input(mysqli_real_escape_string($conn,$_POST['password']))); //Password Encryption with MD5

    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();


    $check = mysqli_num_rows($result);

    if ($check > 0) {
        $_SESSION['signup'] = "<div class='error text-center'>Username exists.</div>";
        header('location:'.SITEURL.'user/signup.php');
    } else {

        $sql = "INSERT INTO users (full_name, username, password) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $full_name, $username, $password_hashed);
        $stmt->execute();
        $res = $stmt->get_result();
        $_SESSION['signup'] = "<div class='error text-center'>Username registered sucsesfully.</div>";
        header ('location:'.SITEURL.'user/signup.php');

    }

}
    }
}