<?php
session_start();
include "../config.php";
if (!isset($_SESSION['loggedin_restaurant'])) {
    header("location:./");
?>
    <script type="text/javascript">
        window.location.href = "./";
    </script>
<?php
}
$userid = $_SESSION['loggedin_restaurant'];
$user = "SELECT * FROM restaurants WHERE email='$userid' ";
$result2 = $conn->query($user);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $name = $row2["name"];
        $email = $row2["email"];
        $res_id = $row2["id"];
        $no_of_upload = $row2["number_of_upload"];
    }
}

$productQuery = "SELECT * FROM products WHERE restaurant_id='$res_id' ORDER BY ID DESC";
$product = $conn->query($productQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload food</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <script>
        function previewFile(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg1').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>

<body>
    <nav class="fixed top-0 z-50 w-full bg-orange-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 mt-8 lg:mt-0 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-white rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="../assets/logo.png" class="h-8 me-3" alt="Halal Restaurantz" />
                        <span class="self-center text-xl text-white font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Halal Restaurantz</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 mt-8 lg:mt-0 w-64 h-screen mr-0 lg:mr-32 pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <!-- Home Item -->
                <li>
                    <a href="../user/dashboard.php" class="flex items-center p-2 rounded-lg text-gray-900  hover:bg-red-300 group">
                        <svg class="w-4 h-3 text-white transition duration-75 hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                        </svg>
                        <span class="ms-3 text-gray-900 hover:text-white">Home</span>
                    </a>
                </li>
                <!-- Product Item -->
                <li>
                    <a href="../user/upload.php" class="flex items-center p-2 rounded-lg text-gray-900 dark:text-white bg-orange-500 group">
                        <svg class="w-4 h-3 text-white transition duration-75 hover:text-red-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                        </svg>
                        <span class="ms-3 hover:text-gray-900 text-white">Product</span>
                    </a>
                </li>
                <!-- Logout Item -->
                <li>
                    <a href="logout.php" class="flex items-center p-2 rounded-lg text-gray-900 hover:bg-red-300 group">
                        <svg class="w-4 h-3 text-gray-900 transition duration-75  hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>
                        <span data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="ms-3 text-gray-900 hover:text-white" type="button">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-orange-500 w-12 h-12 dark:text-orange-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to logout?</h3>
                <button data-modal-hide="popup-modal" type="button" class="text-white bg-orange-500 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-500 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div> -->
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Create New Product
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="aform" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
                    <input type="text" name="res_id" value="<?php echo $res_id ?>" hidden>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div class="col-span-2 ">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                        </div>
                        <div class="col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Write product description here"></textarea>
                        </div>
                        <div class="col-span-2 items-center justify-center w-full">
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file-1" class="flex items-center px-3 py-3 mx-auto mt-6 text-center bg-white border-2 border-dashed rounded-md cursor-pointer">
                                    <h2 class="mx-3 text-gray-400">Click here to upload food image</h2>
                                    <input id="dropzone-file-1" type="file" name="image1" onchange="previewFile(this);" class="hidden" accept="image/*" />
                                </label>
                            </div>
                            <div class="flex flex-col w-full items-center">
                                <img id="previewImg1" src="image/up.jpg" alt="" class="rounded-full h-44 w-44 mt-4">
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-orange-500 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="p-4 sm:ml-64">
        <div class="p-4  rounded-lg dark:border-gray-700">
            <?php
            $count = mysqli_num_rows($product);
            if ($count >= $no_of_upload) {
            ?>
                <div class="lg:ml-3 mt-6 flex flex-col self-start rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                    <a class="ml-4" type="button">
                        <div class="flex items-start justify-start">
                            <button onclick="onGooglePayClicked()" class="flex flex-col items-start justify-start mt-12 border-2 border-green-300 rounded-lg cursor-pointer bg-green-50 hover:bg-green-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center p-5">
                                    <span class="text-lg font-bold">Pay with Google Pay</span>
                                </div>
                            </button>

                        </div>
                    </a>
                </div>
            <?php
            } else {
            ?>
                <div class="lg:ml-3 mt-6 flex flex-col self-start rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                    <a class="ml-4" type="button">
                        <div class="flex items-start justify-start">
                            <label data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="flex flex-col items-start justify-start mt-12 border-2 border-red-300 border-dashed rounded-lg cursor-pointer bg-orange-50 hover:bg-red-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center p-5">
                                    <img src="../assets/add.png" class="h-12" alt="">
                                </div>
                            </label>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 max-w-5xl ml-0 lg:ml-3">
                <!-- product grid -->
                <?php
                // $product = "SELECT * FROM products WHERE restaurant_id='$res_id' ORDER BY ID DESC ";
                $result = $conn->query($productQuery);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $food_id = $row["id"];
                        $name = $row["name"];
                        $price = $row["price"];
                        $description = $row["descriptions"];
                        $image = $row["image"];
                ?>
                        <div class="mx-3 mt-6 flex flex-col self-start rounded-lg bg-white text-surface shadow-secondary-1  dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                            <a href="#!">
                                <img class="rounded-lg h-44 w-full" src="./products/<?php echo $image ?>" alt="Palm Springs Road" />
                            </a>
                            <div class="pt-3 flex items-center justify-between">
                                <p class="font-bold text-lg"><?php echo $name ?></p>
                                <div class="inline-flex">
                                    <button data-id=<?php echo $food_id; ?> data-modal-target="popup-modal" data-modal-toggle="popup-modal1" class="edit">
                                        <svg class="h-6 w-6 mx-5 fill-current text-red-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z" />
                                        </svg>
                                    </button>
                                    <button data-id=<?php echo $food_id; ?> data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="delete">
                                        <svg class="h-6 w-6 fill-current text-red-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="pt-1 text-orange-500 font-bold">&#8358;<?php echo $price ?></p>
                        </div>
                <?php

                    }
                }
                ?>
            </div>
            <!-- Delete Modal -->
            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="delete-body p-6 text-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://pay.google.com/gp/p/js/pay.js"></script>
    <script>
        let paymentsClient = null;

        function getGooglePaymentsClient() {
            if (paymentsClient === null) {
                paymentsClient = new google.payments.api.PaymentsClient({
                    environment: 'TEST'
                }); // Change to 'PRODUCTION' when ready
            }
            return paymentsClient;
        }

        const googlePayConfig = {
            apiVersion: 2,
            apiVersionMinor: 0,
            allowedPaymentMethods: [{
                type: 'CARD',
                parameters: {
                    allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
                    allowedCardNetworks: ['MASTERCARD', 'VISA']
                },
                tokenizationSpecification: {
                    type: 'PAYMENT_GATEWAY',
                    parameters: {
                        gateway: 'example', // Change this to your payment processor like 'stripe', 'adyen', etc.
                        gatewayMerchantId: 'exampleMerchantId'
                    }
                }
            }],
            merchantInfo: {
                merchantId: '12345678901234567890', // optional for TEST
                merchantName: 'Your Business Name'
            },
            transactionInfo: {
                totalPriceStatus: 'FINAL',
                totalPriceLabel: 'Total',
                totalPrice: '10.00',
                currencyCode: 'USD',
                countryCode: 'US'
            }
        };

        function onGooglePayClicked() {
            const paymentsClient = getGooglePaymentsClient();
            const paymentDataRequest = Object.assign({}, googlePayConfig);

            paymentsClient.loadPaymentData(paymentDataRequest)
                .then(function(paymentData) {
                    // handle the response
                    console.log(paymentData);
                    // send paymentData.paymentMethodData to your backend for processing
                })
                .catch(function(err) {
                    console.error(err);
                });
        }
    </script>

    <script>
        $(document).ready(function() {
            // submit add book

            $("#aform").submit(function(e) {
                e.preventDefault();

                $("#resp").html("");
                var formData = new FormData(this);

                $.ajax({
                    url: 'addproduct.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        if (data == 'yes') {
                            window.location.href = "upload.php";
                        } else {
                            $("#resp").html(data);
                        }
                        // $("#aform")[0].reset();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            //fetch modal details to edit with id
            $('.delete').click(function() {
                var approve = $(this).data('id');
                $.ajax({
                    url: 'delete_food.php',
                    type: 'post',
                    data: {
                        delete: approve
                    },
                    success: function(response) {
                        $('.delete-body').html(response);
                        $('#empModal').modal('.show');
                    }
                });
            });

        });
    </script>
    <?php
    if (isset($_SESSION['status'])) {
    ?>
        <script>
            swal({
                title: "<?php if ($_SESSION['code'] == "success") {
                            echo "Success";
                        } else {
                            echo "Oops";
                        } ?>",
                text: "<?php echo $_SESSION['status'] ?>!",
                icon: "<?php echo $_SESSION['code'] ?>",
                button: "OK!",
            });
        </script>
    <?php
        unset($_SESSION['status']);
        unset($_SESSION['code']);
    }
    ?>
</body>

</html>