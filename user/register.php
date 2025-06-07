<?php
include "../config.php";
session_start();

// Check if the form is submitted
if (isset($_POST['next'])) {
  // Save input fields in session
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['phone'] = $_POST['phone'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['country'] = $_POST['country'];
  $_SESSION['state'] = $_POST['state'];
  $_SESSION['city'] = $_POST['city'];

  // Redirect to registration completion page
  header("Location: complete.php");
  exit(); // Ensure no further code is executed after the redirect
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>registration</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/sweetalert.min.js"></script>

</head>

<body class="bg-red-500">
  <nav class="bg-orange-50 dark:bg-gray-900 fixed w-full pt-8 lg:pt-0 z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="../index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
        <svg class="h-8 lg:h-4 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
          <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
        </svg>
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
  <div
    class="lg:mx-auto mx-8 lg:max-w-4xl rounded-lg bg-white p-6 shadow-4 lg:mt-24 mt-32 dark:bg-surface-dark">
    <form action="register.php" method="post">
      <div class="lg:grid grid-cols-2 gap-4">
        <!--First name input-->
        <div class="relative mb-12" data-twe-input-wrapper-init>
          <div>
            <label for="small-input" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Restaurant Name</label>
            <input required type="text" name="name" autocomplete="off" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
          </div>
        </div>
        <!--Last name input-->
        <div class="relative mb-12" data-twe-input-wrapper-init>
          <div>
            <label for="small-input" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
            <input required type="text" name="phone" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
          </div>
        </div>
      </div>
      <div class="lg:grid grid-cols-2 gap-4">
        <div class="relative mb-12" data-twe-input-wrapper-init>
          <div>
            <label for="small-input" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
            <input required type="text" name="email" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
          </div>
        </div>
        <!--Last name input-->
        <div class="relative mb-12" data-twe-input-wrapper-init>
          <label for="small-input" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Choose Country</label>
          <select id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected="selected">Choose a Country</option>
            <?php
            $country = "SELECT * FROM countries";
            $result = $conn->query($country);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $country_name = $row['name'];
                $country_id = $row['id'];
            ?>
                <option value="<?php echo $country_id ?>"> <?php echo $country_name ?> </option>
            <?php
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="lg:grid grid-cols-2 gap-4">

        <div class="relative mb-12" data-twe-input-wrapper-init>
          <label for="small-input" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Select State</label>
          <select id="resps" name="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected="selected">Select State</option>
          </select>
        </div>

        <div class="relative mb-12" data-twe-input-wrapper-init>
          <label for="small-input" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Select City</label>
          <select id="resps2" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="" selected="selected">Select City</option>
          </select>
        </div>


      </div>
      <button
        type="submit" name="next"
        class="flex w-full justify-center items-center rounded bg-red-300 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
        data-twe-ripple-init
        data-twe-ripple-color="light">
        Next
      </button>
    </form>
  </div>
</body>
<script>
  $(document).ready(function() {

    $("#country").change(function() {
      $("#resps").html("");
      var formData = {
        country: $("#country").val(),
      };
      $.ajax({
        type: "POST",
        url: "checkcountry.php",
        data: formData,
      }).done(function(data) {

        $("#resps").html(data);
      });
    });


    $("#resps").change(function() {
      $("#resps2").html("");
      var formData = {
        state: $("#resps").val(),
      };
      $.ajax({
        type: "POST",
        url: "checkstate.php",
        data: formData,
      }).done(function(data) {

        $("#resps2").html(data);
      });
    });

  });
</script>

</html>