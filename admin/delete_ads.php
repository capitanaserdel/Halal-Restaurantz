<?php 
include "../config.php";
session_start();

$ads_id=$_POST['delete'];

    $books = "SELECT * FROM ads WHERE id='$ads_id'";
        $result = $conn->query($books);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row["name"];
            }
        }

if(isset($_POST['submit'])){
    $ads = $_POST['ads_id'];

    $update = mysqli_query($conn, "DELETE FROM ads WHERE id = '$ads'");
    if($update == true){
        $_SESSION['status'] = "You have successfully deleted an Ads";
        $_SESSION['code'] = "success";
        header("location:manageads.php");
    }else{
        $_SESSION['status'] = "Unable to delete an Ads";
        $_SESSION['code'] = "error";
        header("location:manageads.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="delete_ads.php" method="post">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <input hidden type="text" name="ads_id" value="<?php echo $ads_id ?>">
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this Ads?</h3>
            <button type="submit" name="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
        </form>                
    </body>
</html>