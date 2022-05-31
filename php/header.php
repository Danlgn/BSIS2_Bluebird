<?php
    session_start();
    require('db.php');
    if(isset($_SESSION["username"])) {
        $userLoggedIn = $_SESSION["username"];
        $user_details = mysqli_query($con, "SELECT * FROM users where username='{$userLoggedIn}'");
        $user = mysqli_fetch_array($user_details);
    } else {
        echo "<div>hello?".$_SESSION['username']."</div>";
        //exit(header("Location: login.php"));
    }
    
?>