<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
        <?php
        require('./php/db.php');

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
                                <a href='login.php'>Click here to Login</a>
                                </div>";
                        }
                }catch(Exception $error){
                        echo "<div class='form'>
                        <h3>Error encountered.</h3>
                        <br/>$error</div>";
                }
        }else{
        ?>
        <div class="form">
                <h1>Signup</h1>
                <form name="registration" action="" method="post">
                <div>
                        <div>
                                <label for="firstname">First name</label>
                                <input type="text" id="firstname" name="firstname" placeholder="First Name" required />
                        </div>
                        <div>
                                <label for="lastname">Last name</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Last Name" required />
                        </div>
                </div>
                <div class="single-input">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" required />
                </div>
                <div>
                        <div>
                                <label for="salutation">Salutation</label>
                                <input type="text" id="salutation" name="salutation" placeholder="Salutation" required />
                        </div>
                        <div>
                                <label for="suffix">Suffix</label>
                                <input type="text" id="suffix" name="suffix" placeholder="Suffix" />
                        </div>
                </div>
                <div class="single-input">
                        <label for="addressline1">Address Line 1</label>
                        <input type="text" id="addressline1" name="addressline1" placeholder="Address Line" required />
                </div>
                <div class="single-input">
                        <label for="addressline2">Address Line 2</label>
                        <input type="text"id="addressline2"  name="addressline2" placeholder="Address Line 2"/>
                </div>
                <div class="single-input">
                        <label for="region">Region</label>
                        <input type="text" id="region" name="region" placeholder="Region" required />
                </div>
                <div>
                        <div>
                                <label for="brgy">Barangay</label>
                                <input type="text" id="brgy" name="brgy" placeholder="Barangay" required />
                        </div>
                        <div>
                                <label for="zip">Zip Code</label>
                                <input type="text" id="zip" name="zip" placeholder="ZIP" required />
                        </div>
                </div>
                <div>
                        <div>
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" placeholder="Username" required />
                        </div>
                        <div>
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" required />
                        </div>
                </div>
                <input type="submit" name="submit" class="btn" value="Register" />
                </form>
        </div>
        <?php } ?>
</body>
</html>