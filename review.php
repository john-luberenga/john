<?php 
session_start();
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
$uniqueid=uniqid();



if($first_name!="" && $last_name!="" && $city!="" && $state !="" && $country!="" && $post_code!="" && $phone_number!="" && $email!="" && $prefered_contact!="" && $prefered_payment!="" && $frequency_of_donation!="" && $comments!="" && $amount!=""){
    //echo "it worked";
	$projected=0;
	if($frequency_of_donation=="one-time"){
		$projected=0;
	}else if($frequency_of_donation=="monthly"){
		$projected=$amount*12;
	}else if($frequency_of_donation=="yearly"){
		$projected=$amount;
	}
	
	if($prefered_payment=="Bitcoin"){
		$from="BTC";
	}else if($prefered_payment=="Euro"){
		$from="EUR";
	}else{
		$from="USD";
	}
	
	$to="USD";
	
	 $currencyDetails = file_get_contents("https://free.currconv.com/api/v7/convert?q=".$from."_".$to."&compact=ultra&apiKey=af2e63a8ca9313e170fb");
	function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
	}

 $conv=getBetween($currencyDetails,":","}");
 $newamountinusd=$amount*$conv;
	//echo $currencyData = preg_split('/\D\s(.*?)\s=\s/',$currencyDetails);
	
 
 
}else{
    $_SESSION["error"] = true;
    header("Location: index.php");
    exit();
}
//echo "we are here";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 10vh; margin-bottom: 10vh;">
        <div class="offset-md-2 col-md-8">            
			<p>Full Name: <?php echo "{$first_name} {$last_name}"; ?></p>
            <p>City: <?php echo $city; ?></p>
			<p>State: <?php echo $state; ?></p>
			<p>Country: <?php echo $country; ?></p>
            <p>Post Code: <?php echo $post_code; ?></p> 
			<p>Phone Number: <?php echo $phone_number; ?></p>
			<p>Email: <?php echo $email; ?></p> 			
			<p>Preferred Contact: <?php echo $prefered_contact; ?></p>
            <p>Preferred Payment: <?php echo $prefered_payment; ?></p> 
			<p>Frequency: <?php echo $frequency_of_donation; ?></p>
			<p>Comments: <?php echo $comments; ?></p>
			<p>Amount: <?php echo $from; ?> <?php echo $amount; ?> <p>
			<p>Total Projected Donation of the Year: <?php echo $to; ?> <?php echo number_format($newamountinusd, 2, '.', ','); ?><p>
        </div>
        <!--<div class="row my-3">
            <button type="submit" onclick="dosubmit()" class="btn btn-primary">Confirm</button>
			<button type="cancel" onclick="dosubmit()" class="btn btn-primary">Cancel</button>
        </div>-->		
		<div class="modal-footer">
			<button type="submit" onclick="dosubmit()" class="btn btn-primary" id="confirm">Confirm</button>
			<button type="cancel" onclick="docancel()" data-dismiss="modal" class="btn btn-danger">Cancel</button>
		</div>
    </div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	
	function docancel(){
		Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Thank you for your Consideration'
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
	  window.location.href = "index.php";
   // Swal.fire('Saved!', '', 'success')
  } else if (result.isDenied) {
    //Swal.fire('Changes are not saved', '', 'info')
  }
});
	}

function dosubmit(){
    var formData = {
        first_name: '<?php echo $first_name; ?>',
        last_name: '<?php echo $last_name; ?>',
		city: '<?php echo $city; ?>',
		state: '<?php echo $state; ?>',
		country: '<?php echo $country; ?>',
		post_code: '<?php echo $post_code; ?>',
		phone_number: '<?php echo $phone_number; ?>',
		email: '<?php echo $email; ?>',
		prefered_contact: '<?php echo $prefered_contact; ?>',
		prefered_payment: '<?php echo $prefered_payment; ?>',
		frequency_of_donation: '<?php echo $frequency_of_donation; ?>',
		comments: '<?php echo $comments; ?>',
		amount: '<?php echo $amount; ?>',
		unik: '<?php echo $uniqueid; ?>',
		  
    };

    $.ajax({
      type: "POST",
      url: "process.php",
      data: formData,
	  cache: false,
	  success: function (data) {
		
		//alert(data);	

var res=data.trim();	
		
		if(res=="done"){
			//alert("Thank You for your Donation! Someone will be in contact with you soon.");
			Swal.fire({
  icon: 'success',
  title: 'Great',
  text: 'Thank You for your Donation! Someone will be in contact with you soon.',
  footer: '<a href="edit.php?edit=<?php echo $uniqueid; ?>">Edit Information</a>'
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
	  window.location.href = "index.php";
   // Swal.fire('Saved!', '', 'success')
  } else if (result.isDenied) {
    //Swal.fire('Changes are not saved', '', 'info')
  }
});;
		}else{
			Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Thank you for your Consideration'
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
	  window.location.href = "index.php";
   // Swal.fire('Saved!', '', 'success')
  } else if (result.isDenied) {
    //Swal.fire('Changes are not saved', '', 'info')
  }
});
		}
      console.log(data);
	  }
    });
}
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>


