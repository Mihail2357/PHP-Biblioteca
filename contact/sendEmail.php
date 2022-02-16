<?php

require 'C:\xampp\htdocs\Biblioteca\includes/PHPMailer.php';
require 'C:\xampp\htdocs\Biblioteca\includes/SMTP.php';
require 'C:\xampp\htdocs\Biblioteca\includes/Exception.php';
require 'C:\xampp\htdocs\Biblioteca\includes/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$response_key = $_POST["g-recaptcha-response"];
$user_ip = $_SERVER["REMOTE_ADDR"];
$status = "failed";
$response = "Something is wrong: <br>";


if (!rezultat_recaptcha($response_key, $user_ip))

    header("contact/error.php");
else
{
    $fields = ["first_name", "last_name", "email", "message"];

    $complet = true;
    foreach ($fields as $field)
        if (!isset($_POST[$field]) || empty($_POST[$field]))
            $complet = false;

    if (!$complet)
        header('location:'.SITEURL.'contact/error.php');
    else
    {
        $first_name = $_POST["first_name"];
        if (!ctype_alpha($first_name))
            $invalid = "first_name";
        $last_name = $_POST["last_name"];
        if (!ctype_alpha($last_name))
            $invalid = "last_name";
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $invalid = "email";
            echo $email;
            die;
        }

        if (isset($invalid))
            header('location:'.SITEURL.'contact/error.php' . $invalid);
        else
        {
            $message = htmlspecialchars($_POST["message"]);
            $body = "message: ". $message. "\n from:\n".'email: '. $email. "\n". "full name: " .$first_name . ' ' .$last_name;

            $mail = new PHPMailer();

            //smtp settings
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "mihail.mihai@my.fmi.unibuc.ro";
            $mail->Password = 'parola.fmi123';
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";

            //email settings
            $mail->isHTML(true);
            $mail->setFrom("mihail.mihai@my.fmi.unibuc.ro");
            $mail->addAddress("mihail.mihai@my.fmi.unibuc.ro");
            $mail->Subject = ("Test email using PHPMAILER");
            $mail->Body = $body;

            if ($mail->send())
            {
                $status = "success";
                $response = "Email is sent!";
                echo "Email sent";
            }
            else
            {
                $status = "failed";
                $response = "Something is wrong: <br>" . $mail->ErrorInfo;
                echo "Email not sent";
            }
        }
    }
}
exit(json_encode(array("status" => $status, "response" => $response)));


?>
