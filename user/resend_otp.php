<?php
include "../config.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_SESSION['loggedin_restaurant'];
    // Generate a new OTP (you can customize this logic)
    $otp = rand(1000, 9999); // Example: 4-digit OTP
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expiration'] = time() + (5 * 60); // OTP valid for 5 minutes

    // Send the OTP to the user's email
    $mail = new PHPMailer(true);
    $mail->isSMTP(); 
    $mail->Host = 'www.halalrestaurantz.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'admin@halalrestaurantz.com';
    $mail->Password = '0z~vDvM2[ln^';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('admin@halalrestaurantz.com');

    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = "Hello <b>$email</b>,<br><br>Your OTP is: <b>$otp</b><br><br>Thank you!<br>Team Halal Restauranz";
    $mail->AltBody = "Hello $email,\n\nYour OTP is: $otp\n\nThank you!\nTeam Halal Restauranz";


    $mail->send();
    echo 'success';
} else {
    echo 'Invalid request method'; // Handle invalid request method
}
