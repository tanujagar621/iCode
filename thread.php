<?php require "components/_dbconnect.php";?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    $id = test_input($_GET['threadid']);
    $cat_name = $_GET['category'];
    $sql = "select * from `threads` where `Thread_id` = $id";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $title = $row['Thread_title'];
        $desc = $row['Thread_desc'];
        $thread_user_id = $row['Thread_user_id'];
        $sql = "select * from `users` where `User_id` = $thread_user_id";
        $result1 = mysqli_query($con, $sql);
        $row1 = mysqli_fetch_assoc($result1);
        $thread_user_name = $row1['User_email'];
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>iCode - <?php echo $title .' '. $cat_name; ?> </title>
</head>

<body>
    <?php require "components/_nav.php";?>
    <?php 
        $showAlert = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $comm_content = test_input($_POST['content']);
            $user_id = test_input($_POST['user_id']);
            $sql = "INSERT INTO `comments` (`Comment_content`, `Thread_id`,  `Comment_by`, `Comment_time`) VALUES ('$comm_content', '$id', '$user_id' , current_timestamp());";
            $result = mysqli_query($con, $sql);
            if($result)
            {
                $showAlert = true;
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your question has been posted successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }

        }
    ?>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p><b>Posted By: <?php echo $thread_user_name; ?></b></p>
            <p>No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
        </div>
        <div class="container my-3">
            <!-- <a href="askquestion.php" class="btn btn-success">Ask a question</a> -->
            <h1 class="py2">Post a comment</h1>
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
                echo '<form action="'.htmlspecialchars($_SERVER["REQUEST_URI"]).'" method="POST">
                <div class="mb-3">
                    <label for="content" class="form-label">Type your comment</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                    <input type="hidden" name="user_id" value="'.$_SESSION['id'].'">
                </div>
                <button type="submit" class="btn btn-success">Post</button>
                </form>';
            }
            else
            {
                echo '<p class="lead"><b>Login to post a comment</b></p>';
            }
            ?>
        </div>
        <div style="min-height: 35vh" class="container">
            <h1 class="py-2">Discussions</h1>
            <?php 
                $sql = "select * from `comments` where `Thread_id` = $id";
                $result = mysqli_query($con, $sql);
                $noresult = true;
                while($row = mysqli_fetch_assoc($result))
                {
                    $noresult = false;
                     $comm_id = $row['Comment_id'];
                    // $title = $row['Thread_title'];
                    $content = $row['Comment_content'];
                    $comm_time = $row['Comment_time'];
                    $comment_user_id = $row['Comment_by'];
                    $sql2 = "SELECT * FROM `users` WHERE `User_id` = $comment_user_id";
                    $userresult = mysqli_query($con, $sql2);
                    $row2 = mysqli_fetch_assoc($userresult);
                    $comment_user_name = $row2['User_email'];
                    echo '<div class="media my-3 align-items-center">
                    <img src="img/userdefault.jpg" width=60px class="mr-3" alt="...">
                    <div class="media-body my-3">
                    <p class="font-weight-bold my-0"><a href="profile.php?id='.$comment_user_id.'">'.$comment_user_name.'</a> at '.$comm_time.'</p>
                    '.$content.'
                    </div>
                    </div>';
                }
                if($noresult)
                {
                    echo '<div class="jumbotron jumbotron-fluid p-3">
                    <div class="container">
                    <p class="display-4">No Replies Found in this category</p>
                    <p class="lead"><b>Be the first person to Reply</b></p>
                        </div>
                    </div>';
                }
            
                ?>
        </div>

    </div>


    <?php require "components/_footer.php";?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>