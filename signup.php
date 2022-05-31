<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="signup.css">
</head>
<body>
<?php
require('db.php');

// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);

        $firstname = stripslashes($_REQUEST['firstname']);
        $firstname = mysqli_real_escape_string($con,$firstname);

        
        $lastname = stripslashes($_REQUEST['lastname']);
        $lastname = mysqli_real_escape_string($con,$lastname);

        $email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);

        $salutation = stripslashes($_REQUEST['salutation']);
        $salutation = mysqli_real_escape_string($con,$salutation);

        $suffix = stripslashes($_REQUEST['suffix']);
        $suffix = mysqli_real_escape_string($con,$suffix);

        $addressline1 = stripslashes($_REQUEST['addressline1']);
        $addressline1 = mysqli_real_escape_string($con,$addressline1);

        $addressline2 = stripslashes($_REQUEST['addressline2']);
        $addressline2 = mysqli_real_escape_string($con,$addressline2);

        $region = stripslashes($_REQUEST['region']);
        $region = mysqli_real_escape_string($con,$region);

        $brgy = stripslashes($_REQUEST['brgy']);
        $brgy = mysqli_real_escape_string($con,$brgy);

        $zip = stripslashes($_REQUEST['zip']);
        $zip = mysqli_real_escape_string($con,$zip);

        $entrydate = date('Y-m-d H:i:s');

        $query = "INSERT into `users` (username, password, firstname,lastname, email, suffix,addressline1,addressline2,region, brgy, zip,entrydate)
VALUES ('$username', '".md5($password)."', '$firstname','$lastname','$email', '$suffix', '$addressline1','$addressline2','$region','$brgy','$zip','$entrydate')";
        try {
                $result = mysqli_query($con,$query);
                if($result){
                        echo "<div class='form'>
                        <h3>You are registered successfully.</h3>
                        <br/>Click here to <a href='login.php'>Login</a></div>";
                }
        }catch(Exception $error){
                echo "<div class='form'>
                <h3>Error encountered.</h3>
                <br/>$error</div>";
        }
}else{
?>
<div class = "wrap">
<div class="form">
<h1>Signup</h1>
<form name="registration" action="" method="post">
<label for="firstname">First name</label>
<input type="text" id="firstname" name="firstname" placeholder="First Name" required />
<label for="lastname">Last name</label>
<input type="text" id="lastname" name="lastname" placeholder="Last Name" required />
<label for="email">Email</label>
<input type="email" id="email" name="email" placeholder="Email Address" required />
<label for="salutation">Salutation</label>
<input type="text" id="salutation" name="salutation" placeholder="Salutation" required />
<label for="suffix">Suffix</label>
<input type="text" id="suffix" name="suffix" placeholder="Suffix" required />
<label for="addressline1">Address Line 1</label>
<input type="text" id="addressline1" name="addressline1" placeholder="Address Line" required />
<label for="addressline2">Address Line 2</label>
<input type="text"id="addressline2"  name="addressline2" placeholder="" required />
<label for="region">Region</label>
<input type="text" id="region" name="region" placeholder="Region" required />
<label for="brgy">Barangay</label>
<input type="text" id="brgy" name="brgy" placeholder="Barangay" required />
<label for="zip">Zip Code</label>
<input type="text" id="zip" name="zip" placeholder="ZIP" required />
<label for="username">Username</label>
<input type="text" id="username" name="username" placeholder="Username" required />
<label for="password">Password</label>
<input type="password" id="password" name="password" placeholder="Password" required />

<input type="submit" name="submit" value="Register" />
</form>
</div>
</div>
<?php } ?>
</body>
</html>