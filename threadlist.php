<?php require "components/_dbconnect.php";?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    $id = test_input($_GET['catid']);
    $sql = "select * from `categories` where `Category_id` = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['Category_Name'];
    $desc = $row['Category_Desc'];
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

    <title>iCode - <?php echo $name; ?></title>
</head>

<body>
    <?php require "components/_nav.php";?>

    <?php 
        $showAlert = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $th_title = test_input($_POST['title']);
            $th_desc = test_input($_POST['desc']);
            $thread_user_id = test_input($_POST['thread_user_id']);
            $sql = "INSERT INTO `threads` (`Thread_title`, `Thread_desc`, `Thread_cat_id`, `Thread_user_id`, `DateTime`) VALUES ('$th_title', '$th_desc', '$id', '$thread_user_id', current_timestamp());";
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
            <h1 class="display-4">Welcome to
                <?php echo $name; ?> thread
            </h1>
            <p class="lead">
                <?php echo $desc; ?>
            </p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>

        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            echo '<div class="container my-3">
            <!-- <a href="askquestion.php" class="btn btn-success">Ask a question</a> -->
            <h1 class="py2">Ask a question</h1>
            <form action="'.htmlspecialchars($_SERVER["REQUEST_URI"]).'" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Problem Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Keep your title short and to the point</div>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Problem Description</label>
            <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
        </div>
        <input type="hidden" name="thread_user_id" value="'.$_SESSION['id'].'">
        <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    else
    {
    echo '<div class="container my-3">
    <h1 class="py2">Ask a question</h1>
    <p class="lead"><b>Login to ask a question</b></p>
</div>';
    }
    ?>

        <div style="min-height: 40vh" class="container">
            <h1 class="py-2">Browse Questions</h1>

            <?php 
                $sql = "select * from `threads` where `Thread_cat_id` = $id";
                $result = mysqli_query($con, $sql);
                $noresult = true;
                while($row = mysqli_fetch_assoc($result))
                {
                    $noresult = false;
                    $thread_id = $row['Thread_id'];
                    $title = $row['Thread_title'];
                    $thread_desc = $row['Thread_desc'];
                    $thread_time = $row['DateTime'];
                    $thread_user_id = $row['Thread_user_id'];
                    $sql2 = "SELECT * FROM `users` WHERE `User_id` = $thread_user_id";
                    $userresult = mysqli_query($con, $sql2);
                    $row2 = mysqli_fetch_assoc($userresult);
                    $thread_user_name = $row2['User_email'];
                    echo '<div class="media my-3 align-items-center">
                            <img src="img/userdefault.jpg" height=75px class="mr-3" alt="...">
                            <div class="media-body my-3">
                                <p class="font-weight-bold my-0">'.$thread_user_name.' at '.$thread_time.'</p>
                                <h5 class="mt-0"><a href="thread.php?threadid='.$thread_id.'&category='.$name.'"> '.$title.'</a> </h5>
                                '.$thread_desc.'
                            </div>
                        </div>';
                }
                if($noresult)
                {
                    echo '<div class="jumbotron jumbotron-fluid p-3">
                        <div class="container">
                            <p class="display-4">No Question Found in this category</p>
                            <p class="lead"><b>Be the first person to ask a question</b></p>
                        </div>
                    </div>';
                }
            ?>





            <!-- <div class="media">
            <img src="img/userdefault.jpg" width=60px class="mr-3" alt="...">
            <div class="media-body my-3">
                <h5 class="mt-0">unable to user math function</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div> -->
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