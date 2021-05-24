<?php
session_start();
include('db.php');

$toedit=$_GET['edit'];

$qq="SELECT * FROM `users` WHERE `unik`='".$toedit."'";
$query=mysqli_query($conn,$qq);
$num=mysqli_num_rows($query);

$row=mysqli_fetch_array($query);

$fname=$row['first_name'];
$lname=$row['last_name'];
$unik=$row['unik'];
$prefered_payment=$row['prefered_payment'];
$prefered_contact=$row['prefered_contact'];
$country=$row['country'];
$ncity = $row['city'];
$nstate = $row['state'];
$npost_code = $row['post_code'];
$nphone_number = $row['phone_number'];
$nemail = $row['email'];
$frequency_of_donation = $row['frequency_of_donation'];
$ncomments = $row['comments'];
$namount = $row['amount'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reg Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<?php
if($toedit=="" || $num<0){

echo '<div class="alert alert-danger" role="alert">
                    Invalid Access!!
                </div> ';	
	
}else{


?>
    <div class="container" style="margin-top: 10vh; margin-bottom: 10vh;">
        <div class="offset-md-2 col-md-8">
            <?php if(isset($_SESSION['error']) and !empty($_SESSION['error']) and $_SESSION['error'] == true){?>
                <div class="alert alert-danger" role="alert">
                    Form validation failed
                </div>                
            <?php 
        unset($_SESSION["error"]);
        } ?>
            <form method="post" action="review2.php">
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="First name" aria-label="First name" value="<?php echo $fname; ?>">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last name" aria-label="Last name" value="<?php echo $lname; ?>">
						<input type="hidden" name="unik" class="form-control" value="<?php echo $unik; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="City" aria-label="City" value="<?php echo $ncity; ?>">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">State/Region</label>
                        <input type="text" name="state" class="form-control" placeholder="State/Region" aria-label="State/Region" value="<?php echo $nstate; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Country</label>						
						<select name="country" class="form-control" id="country">
							  <?php echo '<option value="'.$country.'">'.$country.'</option>'; ?>
							<?php
							require_once "db.php";
							$result = mysqli_query($conn,"SELECT * FROM countries");
							while($row = mysqli_fetch_array($result)) {
							?>
							<option value="<?php echo $row['name'];?>"><?php echo $row["name"];?></option>
							<?php
							}
							?>
						</select>                        
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Post Code</label>
                        <input type="text" name="post_code" class="form-control" placeholder="Post Code" aria-label="Post Code" value="<?php echo $npost_code; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" aria-label="Phone Number" value="<?php echo $nphone_number; ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="<?php echo $nemail; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Prefered form of contact</label>						
                        <select name="prefered_contact" class="form-control" id="prefered_contact">
						<?php
						echo '<option value="'.$prefered_contact.'" selected>'.$prefered_contact.'</option>';
						?>
							  <option value="phone">Phone</option>
							  <option value="email">Email</option>							  						  
						</select>
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Prefered form of payment</label>                       
						<select name="prefered_payment" class="form-control" id="prefered_payment">
						<?php
						echo '<option value="'.$prefered_payment.'" selected>'.$prefered_payment.'</option>';
						?>
							  <option value="USD">USD</option>
							  <option value="Euro">Euro</option>
							  <option value="Bitcoin">Bitcoin</option>							  
						</select>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-12 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Frequency of donation</label>						
                        <select name="frequency_of_donation" class="form-control" id="frequency_of_donation">
							  <option value="monthly">Monthly</option>
							  <option value="yearly">Yearly</option>
							  <option value="one-time">One Time</option>							  
						</select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Amount of Donation</label>
                        <input type="text" name="amount" class="form-control" placeholder="Amount" aria-label="Amount of Donation" value="<?php echo $namount; ?>">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="exampleInputEmail1" class="form-label">Comments</label>
                    <textarea class="form-control" name="comments" id="" cols="30" rows="10" ><?php echo $ncomments; ?></textarea>
                </div>
                <div class="row my-3">
                    <button type="submit" class="btn btn-primary">Review then Update</button>
                </div>
            </form>
        </div>
    </div>
	
	
<?php } ?>
</body>
</html>

