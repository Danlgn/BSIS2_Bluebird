<?php
    require('./php/header.php');
    require('./php/user.php');
    require('./php/post.php');

    if(isset($_POST['body'])){
        $post = new Post($con, $userLoggedIn);
        $post->submitReply($_GET['postID'], $_POST['body'], $_FILES['image'], 'none');
        exit(header("Location: viewpost.php?postID=".$_GET['postID']));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>

    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/viewpost.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/60795c9a44.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="main-cont">
        <div class="Sidebar">
            <div class="menu-nav">
                <ul>
                    <li class="logo"><a href="index.php"><i class="fab fa-twitter fa-3x"></i></a></li>
                    <li class="menu1"><i class="fas fa-home"></i><a href="index.php">Home</a></li>
                    <li class="menu1"><i class="fa fa-hashtag"></i><a href="explore.html">Explore</a></li>
                    <li class="menu1"><i class="fas fa-bell"></i><a href="notif.html">Notification</a></li>
                    <li class="menu1"><i class="fa fa-envelope-o"></i><a href="messages.html">Messages</a></li>
                    <li class="menu1"><i class="fa fa-bookmark-o"></i><a href="topics.html">Topics</a></li>
                    <li class="menu1"><i class="fa fa-list-alt"></i><a href="lists.html">Lists</a></li>
                    <li class="menu1"><i class="fa fa-user-o"></i><a href="profile.php">Profile</a></li>
                    <li class="menu1"><i class="fas fa-chart-line"></i><a href="analytics.html" target="_blank">Analytics</a></li>
                    <li class="menubtn"><button class="btn" onclick="window.location.href='./profile.php'">Tweet</button></li>
                </ul>
                <a href="./php/logout.php" class="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
            </div>
        </div>
        <div class="notifs">
            <div class="notifs2">
                <h2>Tweet</h2>
                <?php
                    $post = new Post($con, $userLoggedIn);
                    $post->loadPostFromID($_GET["postID"]);
                ?>
                <div id="reply-container" class="Post">
                        <div class="pfp"> 
                            <a href=""><img src="pics/default_icon.jpg" alt=""></a>
                        </div>
            
                        <div class="Postbox">
                            <form action="" id="postForm" name="post" method="post" enctype="multipart/form-data">
                                <textarea type="text" name="body" id="body" placeholder="What's Happening?"></textarea>
                                <input type="file" id="image" name="image" accept="image/*">
                            </form>
                        </div>
                        <div class="btn-tweet">
                            <button type="submit" form="postForm">Reply</button>
                        </div>
                        
                    </div>
            <?php
                $post->loadComments($_GET['postID']);
            ?>
            </div>
        </div>
        <div class="trend-container">
            <div class="search">
                <p> 🔍Search Twitter</p>
            </div>
            
            <div class="phtrend">
                <h2>Philippines Trends</h2>
            
                <div class="trnds">
                    <ul>
                        <li class="trendin">Trending in the Philippines</li>
                        <li class="tags">#TwoPointsParaKay</li>
                        <li class="ntwts">32.9K Tweets</li>
                    </ul>
                </div>
                <div class="trnds">
                    <ul>
                        <li class="trendin">Trending in the Philippines</li>
                        <li class="tags">#ShareTheLove</li>
                        <li class="ntwts">61.8K Tweets</li>
                    </ul>
                </div>
                <div class="trnds">
                    <ul>
                        <li class="trendin">Trending in the Philippines</li>
                        <li class="tags">#Pfizer</li>
                        <li class="ntwts">5,763K Tweets</li>
                    </ul>
                </div>
                <div class="trnds">
                    <ul>
                        <li class="trendin">Music - Trending</li>
                        <li class="tags">REST WELL</li>
                        <li class="ntwts">79.7K Tweets</li>
                    </ul>
                </div>
    
                <div class="trnds">
                    <a href="">Show more</a>
                </div>
                 
            </div>
        
    
            <div class="Follow">
                <h2> Who to follow </h2>

                <div class="follow-container">
                    <div class="propic">
                        <img src="pics/Sb19.jpg" alt="" id="img"> 
                    </div>
                    <div class="proname">
                        <p> <a href="https://twitter.com/SB19Official">SB19</a></p>
                        <h3>@SB19Official</h3>
                    </div>
                    <div class="flw">
                        <button class="btn-Follow"> Follow</button>
                    </div>
                </div>

                <div class="follow-container">
                    <div class="propic">
                        <img src="pics//3.jpg" alt="" id="img"> 
                    </div>
                    <div class="proname">
                        <p> <a href="https://twitter.com/AngDatingDaanTV">Ang Dating Daan</a></p>
                        <h3>@AngDatingDaanTV</h3>
                    </div>
                    <div class="flw">
                        <button class="btn-Follow"> Follow</button>
                    </div>
                </div>

                <div class="follow-container">
                    <div class="propic">
                        <img src="pics/day6.png" alt="" id="img"> 
                    </div>
                    <div class="proname">
                        <p> <a href="https://twitter.com/day6official">Day6</a></p>
                        <h3>@day6official</h3>
                    </div>
                    <div class="flw">
                        <button class="btn-Follow"> Follow</button>
                    </div>
                </div>


            </div>
        </div>
</div>
    
</body>