<?php

Class Post {
    private $user_obj;
    private $con;

    public function __construct($con, $username) {
        $this->con = $con;        
        $this->user_obj = new User($this->con, $username);
    }

    public function submitPost($body, $user_to) {
        $body = strip_tags($body); // remove html tags
        $body = mysqli_real_escape_string($this->con, $body); // Escape single quotes. i.e. I'm going.

        if(trim($body) != '') {
            $date_added = date("Y-m-d H:i:s");

            $added_by = $this->user_obj->getUserName();

            // Added Part 2 
            $sql = "INSERT INTO posts VALUES('','$body','$added_by','$user_to','$date_added',false,false,'0')";

            $query = mysqli_query($this->con, $sql);

            $returned_id = mysqli_insert_id($this->con);

            // update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
        }        
    }
}


?>