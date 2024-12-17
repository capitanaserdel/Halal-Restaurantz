<?php
include "../config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = $_POST['email'];
	$pass = $_POST['password'];


	if (empty($email)) {
		echo 'email is required!';
	} else if (empty($pass)) {
		echo 'Password is required!';
	} else {

		$sql = "SELECT * FROM restaurants WHERE email='$email' AND reg_no='$pass' AND status='0'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$_SESSION['loggedin_restaurant'] = $row['email'];
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
                    Invalid login credientials
                </div> 
            </div>";
			// echo 'Invalid login credentials!';
		}
	}
}
?>