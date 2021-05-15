<?php
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
    <link rel="stylesheet" href="style.css">

    <title>iCode - Online coding Forum</title>
</head>

<body>
    <?php require "components/_nav.php";?>
    <?php
    $id = $_SESSION['id'];
    $showAlert = false;
    $showErr = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $sql = "select * from `users` where `User_email` = '$username'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        if($num == 0)
        {
            $sql = "update `users` set `User_email` = '$username' where `User_id` = '$id'";
            $result = mysqli_query($con, $sql);
            if($result)
            {
                $showAlert = true;
            }
        }
        else{
            $showErr = "UserName Already Exists";
        }
    }

    if($showErr)
    {
        echo '
        <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong>'.$showErr.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    if($showAlert)
    {
        echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success! </strong> your username has been updated successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    ?>
    <?php
        echo "
            <!-- Modal -->
            <div class='modal fade' id='editModal' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='editModalLabel'>Modal title</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                </div>
                <div class='modal-body'>
                    <form action='selfProfile.php' method='post'>
                        <div class='mb-3'>
                            <label for='username' class='form-label'>Enter New UserName</label>
                            <input type='text' class='form-control' name='username' id='username' aria-describedby='emailHelp'>
                        </div>
                        <button type='submit' class='btn btn-primary'>Submit</button>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    <button type='button' class='btn btn-primary'>Save changes</button>
                </div>
                </div>
            </div>
            </div>"
    ?>
    <div style="min-height: 85vh;" class="container">
        <div class="username">
            <?php
            $sql = "select * from `users` where `User_id` = '$id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $email = $row['User_email'];
            echo '<div class="jumbotron">
                <h1 class="display-4">'. $email .'</h1>
                <p class="lead"></p>
                <hr class="my-4">
                <p></p>
                <a class="btn btn-success btn-lg" href="#" data-bs-toggle="modal" data-bs-target="#editModal" role="button">Edit Details</a>
                <a class="btn btn-success btn-lg" href="components/_logout.php" role="button">LogOut</a>
                </div>
                <div class="questions">
                <h2>Questions Posted By You:</h2>';
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
                <h2>Comments Posted By You:</h2>';
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
                    echo '<div class="media my-3 align-items-center">
                    <img src="img/userdefault.jpg" width=60px class="mr-3" alt="...">
                    <div class="media-body my-3">
                    '.$content.'
                    <p class="font-weight-bold my-0">At '.$comm_time.'</p>
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
</body>

</html>