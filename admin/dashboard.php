<?php
session_start();
include "../config.php";
if(!isset($_SESSION['loggedin_admin'])){
    header("location:./");
?>
<script type="text/javascript">
    window.location.href="./";
</script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="fixed top-0 z-50 w-full bg-red-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 mt-8 lg:mt-0  lg:pl-3">
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
                <a href="./dashboard.php" class="flex items-center p-2 rounded-lg text-white hover:bg-red-300 dark:hover:bg-red-200 bg-red-500 group">
                    <svg class="w-4 h-3 text-white transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                    <span class="ms-3 text-white">Home</span>
                </a>
            </li>
            <!-- Product Item -->
            <li>
                <a href="./restaurants.php" class="flex items-center p-2 rounded-lg text-gray-900  hover:bg-red-300 dark:hover:bg-red-200 group">
                    <svg class="w-4 h-3 text-white transition duration-75 hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
                    <span class="ms-3 text-gray-900 hover:text-white">Manage Restaurants</span>
                </a>
            </li>
            <!-- Product Item -->
            <li>
                <a href="./manageads.php" class="flex items-center p-2 rounded-lg text-gray-900  hover:bg-red-300 dark:hover:bg-red-200 group">
                    <svg class="w-4 h-3 text-white transition duration-75 hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
                    <span class="ms-3 text-gray-900 hover:text-white">Manage Ads</span>
                </a>
            </li>
            <!-- Logout Item -->
            <li>
                <a href="./logout.php" class="flex items-center p-2 rounded-lg text-gray-900  hover:text-white hover:bg-red-300 group">
                    <svg class="w-4 h-3 text-gray-900  hover:text-white transition duration-75  hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
                    <span data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="ms-3 text-gray-900 hover:text-white" type="button">
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64 mt-24">
    <div class="p-4 rounded-lg dark:border-gray-700">
        <div class="grid lg:grid-cols-2 gap-6 mb-4">
            <div class="flex flex-col items-center justify-center h-28 rounded bg-red-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Restaurans</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">56</p>
            </div>
            <div class="flex flex-col items-center justify-center h-28 rounded bg-red-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Products</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">48</p>
            </div>
            <div class="flex flex-col items-center justify-center h-28 rounded bg-red-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Ads</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">8,006</p>
            </div>
            <div class="flex flex-col items-center justify-center h-28 rounded bg-red-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Sales</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">596</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>
