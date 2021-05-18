<?php
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require "_dbconnect.php";
    $username = test_input($_POST['username']);
    $pass = test_input($_POST['password']);
    $sql = "SELECT * FROM `users` WHERE `User_username` = '$username'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1)
    {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['User_password']))
        {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['User_id'];
            $_SESSION['username'] = $username;
            // echo "passed". $username;
            header("location: /forum/index.php?login=true");
            exit();
        }
        else
        {
            $showErr = "Invalid Password";
            header("location: /forum/index.php?login=false&loginerror=$showErr");
        }
    }
    else
    {
        $showErr = "Invalid UserName";
    }
    header("location: /forum/index.php?login=false&loginerror=$showErr");
}
?>