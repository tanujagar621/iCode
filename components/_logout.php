<?php
session_start();
echo "loggin you out...";
session_destroy();
header("location: /forum/index.php");
?>