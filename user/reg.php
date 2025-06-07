<?php
include "../config.php";
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name = $_SESSION['name'];
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email']; 
    $country = $_SESSION['country'];
    $state = $_SESSION['state'];
    $city = $_SESSION['city'];
    
    $date=time();

    // Uploads files
    // name of the uploaded file
    $filename1 = $_FILES['image1']['name'];
    $filename2 = $_FILES['image2']['name'];
    $filename3 = $_FILES['image3']['name'];
    $filename4 = $_FILES['image4']['name'];
    
    // get the file extension
    $extension1 = pathinfo($filename1, PATHINFO_EXTENSION);
    $extension2 = pathinfo($filename2, PATHINFO_EXTENSION);
    $extension3 = pathinfo($filename3, PATHINFO_EXTENSION);
    $extension4 = pathinfo($filename4, PATHINFO_EXTENSION);

    // Generate a new unique name for the file
    $filename1 = uniqid().'.'.$extension1;
    $filename2 = uniqid().'.'.$extension2;
    $filename3 = uniqid().'.'.$extension3;
    $filename4 = uniqid().'.'.$extension4;

    // destination of the file on the server
    $destination1 = './restaurants/' . $filename1;
    $destination2 = './restaurants/' . $filename2;
    $destination3 = './restaurants/' . $filename3;
    $destination4 = './restaurants/' . $filename4;

    // the physical file on a temporary uploads directory on the server
    $file1 = $_FILES['image1']['tmp_name'];
    $file2 = $_FILES['image2']['tmp_name'];
    $file3 = $_FILES['image3']['tmp_name'];
    $file4 = $_FILES['image4']['tmp_name'];

    $size = $_FILES['image1']['size'];
    if (move_uploaded_file($file1, $destination1) && 
    move_uploaded_file($file2, $destination2) && 
    move_uploaded_file($file3, $destination3) && 
    move_uploaded_file($file4, $destination4)) {

        $insert=mysqli_query($conn,"INSERT INTO restaurants (name, phone, country, state, city, email, number_of_upload, img1, img2, img3, img4, status, date)
                VALUES('$name','$phone','$country','$state','$city','$email','7','$filename1','$filename2','$filename3','$filename4','0','$date')");
        if($insert == true){
            $_SESSION['loggedin_restaurant'] = $email;
            echo "yes";
        }else{
            echo '
            <div class="mt-3 px-2 py-4 bg-red-400 text-white flex justify-between rounded">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p>Error! Network Problem, Please Try again later!</p>
        </div>
        <button class="text-red-100 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
            ';
        }
    }else{
        echo '
        <div class="mt-3 px-2 py-4 bg-red-400 text-white flex justify-between rounded">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p>Your Picture is Required!</p>
        </div>
        <button class="text-red-100 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
        ';
    }

}
?>