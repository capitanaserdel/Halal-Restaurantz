<?php
session_start();
include "../config.php";
if(!isset($_SESSION['loggedin_restaurant'])){
    header("location:./");
?>
<script type="text/javascript">
    window.location.href="./";
</script>
<?php
}
$userid=$_SESSION['loggedin_restaurant'];
$user = "SELECT * FROM restaurants WHERE email='$userid' ";
    $result2 = $conn->query($user);
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $name = $row2["name"];
            $email = $row2["email"];
            $res_id = $row2["id"];
        }
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
    <nav class="fixed top-0 z-50 w-full bg-orange-500 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
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
                <a href="../user/dashboard.php" class="flex items-center p-2 rounded-lg text-white hover:bg-orange-300 dark:hover:bg-orange-200 bg-orange-500 group">
                    <svg class="w-4 h-3 text-white transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>
                    <span class="ms-3 text-white">Home</span>
                </a> 
            </li>
            <!-- Product Item -->
            <li>
                <a href="../user/upload.php" class="flex items-center p-2 rounded-lg text-gray-900  hover:bg-red-300 dark:hover:bg-orange-200 group">
                    <svg class="w-4 h-3 text-white transition duration-75 hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
                    <span class="ms-3 text-gray-900 hover:text-white">Product</span>
                </a>
            </li>
            <!-- Logout Item -->
            <li>
                <a href="logout.php" class="flex items-center p-2 rounded-lg text-gray-900  hover:text-white hover:bg-red-300 group">
                    <svg class="w-4 h-3 text-gray-900  hover:text-white transition duration-75  hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>
                    <span data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="ms-3 text-gray-900 hover:text-white" type="button">
                        Logout
                    </span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
</div>

<div class="p-4 sm:ml-64 mt-24">
    <div class="p-4 rounded-lg dark:border-gray-700">
        <div class="grid lg:grid-cols-2 gap-6 mb-4">
            <div class="flex flex-col items-center justify-center h-28 rounded bg-orange-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Product</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">
                    <?php
                    $query = "SELECT * FROM products WHERE restaurant_id='$res_id'";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    $count = mysqli_num_rows($result);
                    echo $count;
                    ?>
                </p>
            </div>
            <div class="flex flex-col items-center justify-center h-28 rounded bg-orange-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Views</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">48</p>
            </div>
            <div class="flex flex-col items-center justify-center h-28 rounded bg-orange-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Views</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">8,006</p>
            </div>
            <div class="flex flex-col items-center justify-center h-28 rounded bg-orange-500 dark:bg-gray-800">
                <p class="text-md text-white dark:text-gray-500">Numbers of Sales</p>
                <p class="text-3xl font-extrabold text-white dark:text-gray-500">596</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>
