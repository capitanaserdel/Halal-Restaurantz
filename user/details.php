<?php
session_start();
include "../config.php";

if (isset($_GET['food'])) {
    $foodid = base64_decode($_GET['food']);

    $product = "SELECT p.*, r.name AS restaurant_name FROM products p 
                JOIN restaurants r ON p.restaurant_id = r.id 
                WHERE p.id = '$foodid' ";
        $result = $conn->query($product);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $food = $row["id"];
                $res_id = $row["restaurant_id"];
                $name = $row["name"];
                $price = $row["price"];
                $description = $row["descriptions"];
                $image = $row["image"];
                $restaurant_name = $row["restaurant_name"];
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
	
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

</head>
<body class="bg-orange-50">
    <nav class="bg-orange-50 dark:bg-gray-900 fixed w-full pt-8 lg:pt-0 z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="../index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <svg class="h-8 lg:h-4 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
            <img src="../assets/logo.png" class="h-10" alt="Halal Restaurantz Logo">
            <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <span class="self-center text-orange-500 text-2xl font-semibold whitespace-nowrap">Halal Restaurantz</span>
              </div>     
               </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">              
          </button>
        </div>
        </div>
    </nav>
<!-- component -->
<div class="bg-grey-200 flex  mt-16 lg:w-full h-screen flex-col lg:flex-row justify-center  h-screen">
    <!-- Left: Image -->
<div class="lg:w-1/2 h-screen ">
  <img src="./products/<?php echo $image ?>" alt="Placeholder Image" class="object-fit w-full h-full">
</div>
<!-- Right: Login Form -->
<div class= " w-full border border-3 border-red-500">
 
    <!-- Username Input -->
    <div class="p-5 bg-white">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $name ?></h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">&#8358;<?php echo $price ?></p>
   
    </div>
    <div class="p-5 mt-4  bg-white">
        <div class="flex items-center gap-4">
          <img class="w-10 h-10 rounded-full border border-red-500 border-2" src="../assets/me.jpeg" alt="">
          <div class="font-medium dark:text-white">
              <div><?php echo $restaurant_name ?></div>
          </div>
      </div>
      <div class="my-3">More dishes from this Restaurant</div>
      <div class="underline text-orange-500">View more</div>
    </div> 
    <div class="p-5 mt-4  bg-white">
        <div class="flex items-center gap-4">
            <svg class="h-5 mx-4 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z"/></svg>
      
          <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-sm border border-orange-500 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">WHATAPP</button>
          <button type="button" class="text-white bg-orange-500 hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">CHAT</button>
      </div>
      <div class="my-3"></div>
      <div class="underline text-blue-400"></div> 
      </div> 
      <div class="p-5 mt-4  bg-white">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Share this ad</h5>
      
        <div class="flex items-center justify-center w-full mt-6 gap-4">
          <img src="../assets/fa.png" class="h-5 mx-3" alt="">
          <img src="../assets/instagram.png" class="h-5 mx-3" alt="">
          <img src="../assets/x.png" class="h-5 mx-3" alt="">
          <img src="../assets/logo (1).png" class="h-5 mx-3" alt="">
      </div>
      <p class="mt-6 text-sm text-gray-500">Do you find this suspisious or inappropriate</p>
      <div class="underline text-blue-400"></div>
      
      </div> 
  </div>
</div>
</div>
</body>
</html>