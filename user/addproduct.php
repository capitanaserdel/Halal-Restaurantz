<?php
include "../config.php";
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $res_id = $_POST['res_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $date=time();

    $user = "SELECT * FROM restaurants WHERE id='$res_id' ";
    $result2 = $conn->query($user);
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $numberOfUpload = $row2["number_of_upload"];
        }
    }

    // Count the number of products uploaded by the restaurant
    $countProductQuery = "SELECT COUNT(*) as count FROM products WHERE restaurant_id='$res_id'";
    $countResult = $conn->query($countProductQuery);
    $countProduct = 0; // Initialize countProduct
    if ($countResult->num_rows > 0) {
        $countRow = $countResult->fetch_assoc();
        $countProduct = $countRow['count'];
    }

    // Check if the number of uploads exceeds the allowed limit
    if ($numberOfUpload == $countProduct) {
        // Handle the case where the limit is reached
        echo "Upload limit reached.";
        exit; // Stop further execution
    }

    // Uploads files
    // name of the uploaded file
    $filename1 = $_FILES['image1']['name'];
    
    // get the file extension
    $extension1 = pathinfo($filename1, PATHINFO_EXTENSION);

    // Generate a new unique name for the file
    $filename1 = uniqid().'.'.$extension1;

    // destination of the file on the server
    $destination1 = './products/' . $filename1;

    // the physical file on a temporary uploads directory on the server
    $file1 = $_FILES['image1']['tmp_name'];

    $size = $_FILES['image1']['size'];
    if (move_uploaded_file($file1, $destination1)) {

        $insert=mysqli_query($conn,"INSERT INTO products (restaurant_id, name, price, descriptions, image, status, date)
                VALUES('$res_id','$name','$price','$description','$filename1','0','$date')");
        if($insert == true){
            $_SESSION['status'] = "New Product has been successfully uploaded";
            $_SESSION['code'] = "success";
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