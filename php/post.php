<?php

Class Post {
    private $user_obj;
    private $con;

    public function __construct($con, $username) {
        $this->con = $con;        
        $this->user_obj = new User($this->con, $username);
    }

    public function submitPost($body, $image, $user_to) {
        $body = strip_tags($body); // remove html tags
        $body = mysqli_real_escape_string($this->con, $body); // Escape single quotes. i.e. I'm going.

        if(trim($body) != '') {
            $date_added = date("Y-m-d H:i:s");

            $added_by = $this->user_obj->getUserName();

            // Added Part 2 
            $sql = "INSERT INTO posts VALUES('','$body','$added_by','$date_added',false,'0')";

            $query = mysqli_query($this->con, $sql);

            $returned_id = mysqli_insert_id($this->con);

            // update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
        }        
    }

    public function getAllPosts($special="") {
        $posts = [];
        $data = mysqli_query($this->con, "SELECT * FROM posts where deleted=0 $special ORDER BY id DESC");
        
        while($row = mysqli_fetch_array($data)) {
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by']; //author of post
            $date_time = $row['date_added'];
            
            $added_by_obj = new User($this->con, $added_by);
            $user_author = $added_by_obj->getDetails();
            
            $time_message = "";
            $date_time_now = date('Y-m-d H:i:s');
            $start_date = new Datetime($date_time);
            $end_date   = new Datetime($date_time_now);
            $interval   = $start_date->diff($end_date);

            if($interval->y == 1) {
                $time_message = $interval->y . " year ago";
            } else if ($interval->y > 1) {
                $time_message = $interval->y . " years ago";
            } else if ($interval->m >= 1) {
                $time_message = $interval->m . " month ago";
                $days = "";
                if ($interval->d == 0) {
                    $days = " ago";
                } 
                else if ($interval->d > 1) {
                    $days  = $interval->d . " days ago";
                } else if ($interval->d == 1) {
                    $days = $interval->d . " day ago";
                } 

                if ($interval->m == 1) {
                    $time_message = $interval->m . " month " . $days;
                } else {
                    $time_message = $interval->m . " months " . $days;
                }
            }  else if($interval->d >= 1) {
                if ($interval->d == 1) {
                    $time_message = " yesterday";
                } else if ($interval->d > 1) {
                    $time_message = $interval->d . " days ago";
                } 
            } else if($interval->h >= 1) {
                if ($interval->h == 1) {
                    $time_message = " hour ago";
                } else if ($interval->h > 1) {
                    $time_message = $interval->h . " hours ago";
                } 
            } else if($interval->i >= 1) {
                if ($interval->i == 1) {
                    $time_message = " minute ago";
                } else if ($interval->i > 1) {
                    $time_message = $interval->i . " minutes ago";
                } 
            } else {
                if ($interval->s < 30) {
                    $time_message = " just now";
                } else if ($interval->s > 1) {
                    $time_message = $interval->s . " seconds ago";
                } 
            }
            
            //adding the posts
            $str = 
"<div class=\"ments\" data-id=\"$id\">
    <div class=\"pfp\"> 
        <a href=\"\"><img src=\"pics/default_icon.jpg\" alt=\"\"></a>
    </div>

    <div class=\"un-post\">
        <ul>
            <li class=\"un_user\"><a href=\"\">".$user_author["firstname"]." ".$user_author["lastname"]."</a> <a id=\"uname\" href=\"\">@$added_by - $time_message</a></li>
            <li class=\"post\"><br>".nl2br($body)."</li>
        </ul>
        <div class=\"icons\">
            <i class=\"far fa-comment\"></i>
            <i class=\"fas fa-retweet\"></i>
            <i class=\"far fa-heart\"></i>
            <i class=\"fas fa-external-link-alt\"></i>
        </div>
    </div>
</div>";
            array_push($posts, $str);
        }
        return $posts;
    }

    public function loadPosts($getFromUser=false) {
        $posts = [];

        if($getFromUser)
            $this->getAllPosts("AND added_by='".$this->user_obj->getUserName()."' ");
        else
            $this->getAllPosts();


        //pag walang laman ang posts table
        if(empty($posts)){
            echo "<div><h1>What? No tweet yet?</h1>
                </div>";
        }
        else{
            foreach($posts as $post) {
                echo $post;
            }
        }
    }

}


?>