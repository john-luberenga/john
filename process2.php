<?php 
session_start();
include('db.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$post_code = $_POST['post_code'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$prefered_contact = $_POST['prefered_contact'];
$prefered_payment = $_POST['prefered_payment'];
$frequency_of_donation = $_POST['frequency_of_donation'];
$comments = $_POST['comments'];
$amount = $_POST['amount'];
$unik = $_POST['unik'];


$submit="UPDATE `users` SET `first_name`='".$first_name."',`last_name`='".$last_name."',`city`='".$city."',`state`='".$state."',`country`='".$country."',`post_code`='".$post_code."',`phone_number`='".$phone_number."',`email`='".$email."',`prefered_contact`='".$prefered_contact."',`prefered_payment`='".$prefered_payment."',`frequency_of_donation`='".$frequency_of_donation."',`comments`='".$comments."',`amount`='".$amount."' WHERE `unik`='".$unik."'";
$query=mysqli_query($conn,$submit);
if($query){
	echo "done";
}else{
	echo "notdone";
}

?>