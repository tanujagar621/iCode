<?php
$id = $_GET['id'];
// session_start();
if(isset($_SESSION['id']) && $id == $_SESSION['id'])
header("location: selfprofile.php");
require "components/_dbconnect.php";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>iCode - Online coding Forum</title>
    <style>
    .profilePic {
        border-radius: 50%;
        height: 250px;
        width: 250px;
    }
    </style>
</head>

<body>
    <?php require "components/_nav.php";?>
    <div style="min-height: 85vh;" class="container">
        <div class="username">
            <?php
            // if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            // {
            //     if($id == $_SESSION['id'])
            //     header("location: selfProfile.php");
            // }
            $sql = "select * from `users` where `User_id` = '$id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $username = $row['User_username'];
            echo '<div class="jumbotron">
            <img src="img/userdefault.jpg" class="profilePic" alt="">
                <h1 class="display-4">'. $username .'</h1>
                <p class="lead"></p>
                <hr class="my-4">
                <p></p>
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
                </div>
                <div class="questions">
                <h2>Questions Posted:</h2>';
                $sql = "select * from `threads` where `Thread_user_id` = '$id'";
                $result = mysqli_query($con, $sql);
                $noresult = true;
                while($row = mysqli_fetch_assoc($result))
                {
                    $noresult = false;
                    $thread_id = $row['Thread_id'];
                    $title = $row['Thread_title'];
                    $thread_desc = $row['Thread_desc'];
                    $thread_time = $row['DateTime'];
                    $cat = $row['Thread_cat_id'];
                    $sql1 = "select * from `categories` where `Category_id` = '$cat'";
                    $result1 = mysqli_query($con, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    echo '<div class="media my-3 align-items-center">
                            <img src="img/userdefault.jpg" height=75px class="mr-3" alt="...">
                            <div class="media-body my-3">
                            <h5 class="mt-0"><a href="thread.php?threadid='.$thread_id.'&category='.$row1['Category_Name'].'"> '.$title.'</a> </h5>
                            '.$thread_desc.'
                            <p class="font-weight-bold my-0">'.$thread_time.'</p>
                            </div>
                        </div>';
                }
                if($noresult)
                {
                    echo '<div class="jumbotron jumbotron-fluid p-3">
                        <div class="container">
                            <p class="display-4">No Question Posted</p>
                            <p class="lead"><b>Be the first person to ask a question</b></p>
                        </div>
                    </div>';
                }
                echo '</div>
                <div class="comments">
                <h2>Comments Posted:</h2>';
                $sql = "select * from `comments` where `Comment_by` = '$id'";
                $result = mysqli_query($con, $sql);
                $noresult = true;
                while($row = mysqli_fetch_assoc($result))
                {
                    $noresult = false;
                    $comm_id = $row['Comment_id'];
                    // $title = $row['Thread_title'];
                    $content = $row['Comment_content'];
                    $comm_time = $row['Comment_time'];
                    $thread_id = $row['Thread_id'];
                    $sql1 = "select * from `threads` where `Thread_id` = '$thread_id'";
                    $result1 = mysqli_query($con, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $cat_id = $row1['Thread_cat_id'];
                    $sql1 = "select * from `categories` where `Category_id` = '$cat_id'";
                    $result1 = mysqli_query($con, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    echo '<div class="media my-3 align-items-center">
                    <img src="img/userdefault.jpg" width=60px class="mr-3" alt="...">
                    <div class="media-body my-3">
                    '.$content.'
                    <p class="font-weight-bold my-0">At '.$comm_time.'</p>
                    </div>
                    <a href="thread.php?threadid='.$row['Thread_id'].'&category='.$row1['Category_Name'].'" class="btn btn-success">Go to thread</a>
                    </div>';
                }
                if($noresult)
                {
                    echo '<div class="jumbotron jumbotron-fluid p-3">
                        <div class="container">
                            <p class="display-4">No Comments Posted</p>
                            <p class="lead"><b>Be the first person to ask a question</b></p>
                        </div>
                    </div>';
                }
                echo '</div>
                </div>';
            ?>
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