<?php 
include "../config.php";
session_start();

$ads_id=$_POST['edit'];

    $books = "SELECT * FROM ads WHERE id='$ads_id'";
        $result = $conn->query($books);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $desc = $row["descriptions"];
                $image = $row["img"];
            }
        }

if(isset($_POST['submit'])){
    $ads = $_POST['ads_id'];
    $ename = $_POST['name'];
    $edesc = $_POST['desc'];

    $update = mysqli_query($conn, "UPDATE ads SET name='$ename', descriptions='$edesc' WHERE id = '$ads'");
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
    <body>
        <form action="edit_ads" method="post" enctype="multipart/form-data" class="p-4 md:p-5">
            <input hidden type="text" name="ads_id" value="<?php echo $ads_id ?>">
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $name ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                </div>
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ads Description</label>
                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Write product description here" value="<?php echo $desc ?>"></textarea>                    
                </div>                     
                <div class="col-span-2 items-center justify-center w-full">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file-1" class="flex items-center px-3 py-3 mx-auto mt-6 text-center bg-white border-2 border-dashed rounded-md cursor-pointer">
                            <h2 class="mx-3 text-gray-400">Click here to upload ads image</h2>
                            <input id="dropzone-file-1" type="file" name="image1" onchange="previewFile(this);" class="hidden" accept="image/*" />
                        </label>
                    </div>
                    <div class="flex flex-col w-full items-center">
                        <img id="previewImg1" src="./ads/<?php echo $image ?>" alt="" class="rounded-full h-44 w-44 mt-4">
                    </div>
                </div> 

            </div>
            <button type="submit" name="submit" class="text-white inline-flex items-center bg-orange-500 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add new Ads
            </button>
        </form>
    </body>
</html>