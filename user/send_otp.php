<?php
include "../config.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Generate a random OTP (6-digit)
$otp = rand(1000, 9999);

// Set OTP and expiration time in the session
$_SESSION['otp'] = $otp;
$_SESSION['otp_expiration'] = time() + (5 * 60); // OTP valid for 5 minutes


if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = $_POST['email'];

	if (empty($email)) {
		echo 'email is required!';
	}else{
		$sql = "SELECT * FROM restaurants WHERE email='$email' AND status='0'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$_SESSION['loggedin_restaurant'] = $row['email'];
				$name = $row['email'];

				$mail = new PHPMailer(true);
				$mail->isSMTP();
				$mail->Host = 'www.halalrestaurantz.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'admin@halalrestaurantz.com';
				$mail->Password = '0z~vDvM2[ln^';
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;

				$mail->setFrom('admin@halalrestaurantz.com');

				$mail->addAddress($_POST["email"]);
				$mail->isHTML(true);
				$mail->Subject = 'Your OTP Code';
				$mail->Body    = "Hello <b>$name</b>,<br><br>Your OTP is: <b>$otp</b><br><br>Thank you!<br>Team Halal Restauranz";
    			$mail->AltBody = "Hello $name,\n\nYour OTP is: $otp\n\nThank you!\nTeam Halal Restauranz";


				$mail->send();
				echo 'success';
			}
		} else {
            echo "
            <div class='w-full flex justify-center text-center'> 
                <div class='mb-3 inline-flex w-full items-center rounded-lg bg-red-100 p-4 text-base text-red-700' role='alert'> 
                <span class='mr-2'>
                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='h-5 w-5'>
                    <path fill-rule='evenodd' d='M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z' clip-rule='evenodd' />
                    </svg>
                </span>
                    Invalid email address
                </div> 
            </div>";
		}

	}
}
