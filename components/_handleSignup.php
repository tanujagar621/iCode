<?php
$showErr = false;
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
        $cpass = test_input($_POST['cpassword']);
        $existsql = "SELECT * FROM `users` WHERE `User_username` = '$username'";
        $result = mysqli_query($con, $existsql);
        $num = mysqli_num_rows($result);
    if($num == 0)
    {
        if($pass == $cpass)
        {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`User_username`, `User_password`, `Date`) VALUES ('$username','$hash',current_timestamp())";
            $result = mysqli_query($con, $sql);
            if($result)
            {
                $showAlert = true;
                header("location: /forum/index.php?signup=true");
                exit;
            } 
        }
        else
        { 
            $showErr = "Passwords don't match!";
        }
    }
    else
    {
        $showErr = "username already in use!";
    }
    header("location: /forum/index.php?signup=false&error=$showErr");
}
?>