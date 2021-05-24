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

$submit="INSERT INTO `users`(`first_name`,`last_name`,`city`,`state`,`country`,`post_code`,`phone_number`,`email`,`prefered_contact`,`prefered_payment`,`frequency_of_donation`,`comments`,`amount`, `unik`)VALUES('".$first_name."','".$last_name."','".$city."','".$state."','".$country."','".$post_code."','".$phone_number."','".$email."','".$prefered_contact."','".$prefered_payment."','".$frequency_of_donation."','".$comments."','".$amount."','".$unik."')";
//$submit="INSERT INTO `users`(`first_name`, `last_name`, `city`, `state`, `country`, `post_code`, `phone_number`, `email`, `prefered_contact`, `prefered_payment`, `frequency_of_donation`, `comments`, `amount`, `am`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])";
$query=mysqli_query($conn,$submit);
if($query){
	echo "done";
}else{
	echo "notdone";
}

?>