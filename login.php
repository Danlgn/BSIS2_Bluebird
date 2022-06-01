<?php
    session_start();
    if(isset($_SESSION["username"])) {
        exit(header("Location: index.php"));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fe34a0cc3.js" crossorigin="anonymous"></script>
    
    <title>Login/Bluebird</title>
</head>
<body>
    <main class="Navbar">
        <div class="Text">
            <div class="catchphrase">
                <ul>
                    <li><i class="fa fa-twitter fa-3x"></i></li>
                    <li><h1>What's Happening?</h1></li>
                    <li><h2>Join Bluebird Today </h2></li>
                    <li><h3>#HashtagandTweet</h3></li>
                </ul>
            </div>          
            <div class="Sign">
                <?php
                    require('./php/db.php');
                                        
                    if (isset($_POST['username'])){
                        $username = stripslashes($_REQUEST['username']);
                        $username = mysqli_real_escape_string($con,$username);
                        $password = stripslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($con,$password);
                        $query = "SELECT * FROM `users` WHERE username='$username'
                            and password='".md5($password)."'";
                        $result = mysqli_query($con,$query) or die(mysqli_error($con));
                        $rows = mysqli_num_rows($result);
                        
                        if($rows==1){
                            $_SESSION["username"] = $username;
                            exit(header("Location: index.php"));
                        }
                        else{
                            echo "
                            <div class='form'>
                                <h3>Username/password is incorrect.</h3>
                                <a href='login.php'>Click here to Login</a>
                            </div>
                            <br>";
                        }
                    }else{
                ?>
                <form action="" method="post" nae="login">
                    <input type="text" name="username" placeholder="Username"  required/>
                    <input type="password" name="password" placeholder="Password"required />
                    <input name="submit" class="btn" type="submit" value="Login" />
                </form>
                <?php } ?>

                <a href="signup.php">Create an Account</a>

            </div>
        </div>
    </main> 
</body>
</html>