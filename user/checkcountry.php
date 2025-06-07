<?php
session_start();
include '../config.php';

$result="";

if ($_SERVER['REQUEST_METHOD']==="POST" ) {
$country=$_POST['country'];
// echo $country;

$doc=mysqli_query($conn, "SELECT * FROM states WHERE country_id='$country'");
$dcount = mysqli_num_rows($doc);
if ($dcount > 0) {
?>

<?php

    while ($dcs=mysqli_fetch_assoc($doc)) {
        $state_name=$dcs['name'];
        $state_id=$dcs['id'];


$result .= "<option value='".$state_id."'>".$state_name."</option>";

}
?>

<?php

}else{
    $result .= "<option value='' selected='selected'>Choose States</option>";
}


echo $result;

}
?>