<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "icode";
    $con = mysqli_connect($server, $username, $password, $database);
    if(!$con)
    {
        die("connection to server failed due to ". mysqli_connect_error());
    }
    // echo "connected successfully";
?>