<?php
session_start();
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
    <div class="container" style="margin-top: 10vh; margin-bottom: 10vh;">
        <div class="offset-md-2 col-md-8">
            <?php if(isset($_SESSION['error']) and !empty($_SESSION['error']) and $_SESSION['error'] == true){?>
                <div class="alert alert-danger" role="alert">
                    Form validation failed
                </div>                
            <?php 
        unset($_SESSION["error"]);
        } ?>
            <form method="post" action="review.php">
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="First name" aria-label="First name">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Last name" aria-label="Last name">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="City" aria-label="City">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">State/Region</label>
                        <input type="text" name="state" class="form-control" placeholder="State/Region" aria-label="State/Region">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Country</label>						
						<select name="country" class="form-control" id="country" required>
							  <option value="">Select</option>
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
                        <input type="text" name="post_code" class="form-control" placeholder="Post Code" aria-label="Post Code">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" aria-label="Phone Number">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Prefered form of contact</label>						
                        <select name="prefered_contact" class="form-control" id="prefered_contact">
							  <option value="phone">Phone</option>
							  <option value="email">Email</option>							  						  
						</select>
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Prefered form of payment</label>                       
						<select name="prefered_payment" class="form-control" id="prefered_payment">
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
                        <input type="text" name="amount" class="form-control" placeholder="Amount" aria-label="Amount of Donation">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="exampleInputEmail1" class="form-label">Comments</label>
                    <textarea class="form-control" name="comments" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="row my-3">
                    <button type="submit" class="btn btn-primary">Review</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

