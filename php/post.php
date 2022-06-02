<?php

Class Post {
    private $user_obj;
    private $con;
    //location of user uploads
    private $targetDir = "uploads/"; 

    public function __construct($con, $username) {
        $this->con = $con;        
        $this->user_obj = new User($this->con, $username);
    }

    public function submitPost($body, $image) {
        $body = strip_tags($body); // remove html tags
        $body = mysqli_real_escape_string($this->con, $body); // Escape single quotes. i.e. I'm going.

        if(trim($body) != '') {
            $date_added = date("Y-m-d H:i:s");
            $added_by = $this->user_obj->getUserName();

            $image_name = "";
            if(!empty($image["name"])){
                //creates a FILE with unique name for the image 
                //to prevent duplicate images
                $filename = tempnam($this->targetDir, '');
                //deletes the created FILE, what matters is the unique name
                unlink($filename);
                //move the user uploaded image to the upload folder
                //it automatically renames it to the unique name
                move_uploaded_file($image['tmp_name'], $filename);
                //get the unique name of the image to store it in the database
                $image_name = basename($filename);
            }
            
            // Added Part 2 
            $sql = "INSERT INTO posts VALUES('','$body', '$image_name', '$added_by','$date_added',false,'0')";
            mysqli_query($this->con, $sql);
            // $returned_id = mysqli_insert_id($this->con);

            
            // update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
        }        
    }

    public function submitReply($postID, $body, $image) {
        $body = strip_tags($body); // remove html tags
        $body = mysqli_real_escape_string($this->con, $body); // Escape single quotes. i.e. I'm going.

        if(trim($body) != '') {
            $date_added = date("Y-m-d H:i:s");
            $posted_by = $this->user_obj->getUserName();

            $image_name = "";
            if(!empty($image["name"])){
                $filename = tempnam($this->targetDir, '');
                unlink($filename);
                move_uploaded_file($image['tmp_name'], $filename);
                $image_name = basename($filename);
            }
            
            // Added Part 2 
            $sql = "INSERT INTO post_comments VALUES('','$body', '$image_name', '$posted_by','$date_added','$postID')";
            mysqli_query($this->con, $sql);            
        }        
    }

    //helper function
    function makeDir($path)
    {
        return is_dir($path) || mkdir($path);
    }

    public function time_elapsed_string($date_time)
    {
        $time_message= "";
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
        return $time_message;
    }

    public function countComments($postID) {
        $sql = "SELECT * FROM post_comments WHERE post_id='$postID'";
        $query = mysqli_query($this->con, $sql);
        $result = mysqli_num_rows($query);
        if($result > 0) {
            return $result;
        } else {
            return "";
        }
    }

    public function getAllPosts($special="") {
        $posts = [];
        $data = mysqli_query($this->con, "SELECT * FROM posts where deleted=0 $special ORDER BY id DESC");
        
        while($row = mysqli_fetch_array($data)) {
            $id = $row['id'];

            $body = $row['body'];
            $this->makeDir($this->targetDir);
            $image_path = $this->targetDir . $row['image'];
            $image_html = "";
            if(!empty($row['image'])){
                $image_html = "<li class=\"post-img\"><img src=\"$image_path\"></li>";
            }

            $added_by = $row['added_by']; //author of post
            $date_time = $row['date_added'];

            $added_by_obj = new User($this->con, $added_by);
            $user_author = $added_by_obj->getDetails();
            
            $time_message = $this->time_elapsed_string($date_time);
            $comments_num = $this->countComments($id);

            //adding the posts
            $str = 
"<div class=\"ments\" data-id=\"$id\">
    <div class=\"pfp\"> 
        <a href=\"\"><img src=\"pics/default_icon.jpg\" alt=\"\"></a>
    </div>

    <div class=\"un-post\">
        <ul>
            <li class=\"un_user\"><a style='font-weight: bold' href=\"\">".$user_author["firstname"]." ".$user_author["lastname"]."</a> <a id=\"uname\" href=\"\">@$added_by - $time_message</a></li>
            <li class=\"post\"><br>".nl2br($body)."</li>
            $image_html
        </ul>
        <div class=\"icons\">
            <div style='display:flex;align-items:center;gap:3px;'>
                <i class=\"far fa-comment\"></i>
                <p style='font-size: 15px;'>$comments_num</p>
            </div>
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

    public function getAllComments($postID) {
        $posts = [];
        $data = mysqli_query($this->con, "SELECT * FROM post_comments where post_id=$postID ORDER BY id DESC");
        
        while($row = mysqli_fetch_array($data)) {
            $id = $row['id'];

            $body = $row['body'];
            $this->makeDir($this->targetDir);
            $image_path = $this->targetDir . $row['image'];
            $image_html = "";
            if(!empty($row['image'])){
                $image_html = "<li class=\"post-img\"><img src=\"$image_path\"></li>";
            }

            $posted_by = $row['posted_by']; //author of post
            $date_time = $row['date_added'];

            $posted_by_obj = new User($this->con, $posted_by);
            $user_commenter = $posted_by_obj->getDetails();
            
            $time_message = $this->time_elapsed_string($date_time);

            //adding the posts
            $str = 
"<div class=\"ments\" data-id=\"$id\">
    <div class=\"pfp\"> 
        <a href=\"\"><img src=\"pics/default_icon.jpg\" alt=\"\"></a>
    </div>

    <div class=\"un-post\">
        <ul>
            <li class=\"un_user\"><a style='font-weight: bold' href=\"\">".$user_commenter["firstname"]." ".$user_commenter["lastname"]."</a> <a id=\"uname\" href=\"\">@$posted_by - $time_message</a></li>
            <li class=\"post\"><br>".nl2br($body)."</li>
            $image_html
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
            $posts = $this->getAllPosts("AND added_by='".$this->user_obj->getUserName()."' ");
        else
            $posts = $this->getAllPosts();


        //pag walang laman ang posts array
        if(empty($posts)){
            echo "<div class='nopost'>
                <h1>What? No post yet?</h1>
                <p>Create your first post now!</p>
            </div>";
        }
        else{
            foreach($posts as $post) {
                echo $post;
            }
        }
    }

    public function loadComments($postID) {
        $comments = $this->getAllComments($postID);

        //pag walang laman ang comments array
        if(empty($comments)){
            echo "<div class='nopost'>
                <h1>No comments yet.</h1>
                <p>Be the first person to reply now!</p>
            </div>";
        }
        else{
            foreach($comments as $comment) {
                echo $comment;
            }
        }
    }
    
    public function loadPostFromID($id)
    {
        $post = $this->getAllPosts("AND id='$id'");
        if(empty($post))
            exit(header("Location: index.php"));
        else
            echo $post[0];        
    }

}


?>