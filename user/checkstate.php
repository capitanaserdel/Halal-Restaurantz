<?php
session_start();
include '../config.php';

$result="";

if ($_SERVER['REQUEST_METHOD']==="POST" ) {
$state=$_POST['state'];
// echo $country;

$doc=mysqli_query($conn, "SELECT * FROM cities WHERE state_id='$state'");
$dcount = mysqli_num_rows($doc);
if ($dcount > 0) {
?>

<?php

    while ($dcs=mysqli_fetch_assoc($doc)) {
        $city_name=$dcs['name'];
        $city_id=$dcs['id'];


$result .= "<option value='".$city_id."'>".$city_name."</option>";

}
?>

<?php

}else{
    $result .= "<option value='' selected='selected'>Choose City</option>";
}


echo $result;

}
?>