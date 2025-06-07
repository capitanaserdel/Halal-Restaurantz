<?php
session_start(); // Start the session

// Get the OTP entered by the user
$userOtp = $_POST['otp1'].$_POST['otp2'].$_POST['otp3'].$_POST['otp4']; // Replace with your input handling method

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiration'])) {
        if (time() <= $_SESSION['otp_expiration']) {
            if ($userOtp == $_SESSION['otp']) {
                echo "success";

                unset($_SESSION['otp']);
                unset($_SESSION['otp_expiration']);
            } else {
                echo "Invalid OTP. Please try again.";
            }
        } else {
            echo "OTP has expired. Please request a new one.";
            
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiration']);
        }
    } else {
        echo "OTP has been used. Please request a new one.";
    }
}
?>