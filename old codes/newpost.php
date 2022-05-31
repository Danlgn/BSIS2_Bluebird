<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="base.css">
    <style>
        body{
            margin: 0;
            display: grid;
        }
        #post-container{
            display: flex;
            justify-content: center;
            margin-top: 100px;
        }
        #post-form{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 30px;
            background-color: #e7d03a;
        }
        #post-form div {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        label{
            font-size: 16px;
        }
        #title {
            width: 285px;
        }
        textarea{
            width: 300px;
            height: 300px;
            resize: none;
        }

        
    </style>
</head>
<body>
    <main>
        <div id="post-container">
            <form id="post-form" action="">
                <div>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title">
                </div> 
                <div>
                    <label for="content">Content:</label> 
                    <textarea id="content" name="content"></textarea>
                </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <input type="submit" value="Post">
            </form>
        </div>
    </main>
</body>
