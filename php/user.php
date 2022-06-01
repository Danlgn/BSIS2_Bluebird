<?php

Class User {
    private $user;
    private $con;

    public function __construct($con, $username) {
        $this->con = $con;

        $user_details_query = mysqli_query($con, "SELECT * FROM users where username='{$username}'");
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function getFullname() {
        $username = $this->user['username'];
        $user_details_query = mysqli_query($this->con, "SELECT firstname,lastname FROM users where username='{$username}'");
        $row = mysqli_fetch_array($user_details_query);
        return $row['firstname'] . ' ' . $row['lastname'];
    }
    
    public function getUsername() {
        return $this->user['username'];
    }

    public function getNumPosts() {
        return $this->user['num_posts'];
    }

    public function updatePosts($num_posts) {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' where username='$username'");
    }

    public function getDetails() {
        return $this->user;
    }
}
?>