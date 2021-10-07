<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "temp";
    $con = mysqli_connect($server, $username, $password, $database);
    if(!$con)
    {
        die("connection to server failed due to ". mysqli_connect_error());
    }
    $sql = "CREATE TABLE IF NOT EXISTS `temp`.`categories` ( `Category_id` INT NOT NULL AUTO_INCREMENT , `Category_Name` VARCHAR(25) NOT NULL , `Category_Desc` VARCHAR(255) NOT NULL , `DateTime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`Category_id`)) ENGINE = InnoDB;";
    $result = mysqli_query($con, $sql);
    
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0) {
        $sql = "INSERT INTO `categories` (`Category_Name`, `Category_Desc`) VALUES ('Python', 'Python is an interpreted high-level general-purpose programming language. Python\'s design philosophy emphasizes code readability with its notable use of significant indentation.')";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `categories` (`Category_Name`, `Category_Desc`) VALUES ('JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-or')";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `categories` (`Category_Name`, `Category_Desc`) VALUES ('PHP', 'PHP is a general-purpose scripting language especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group.')";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `categories` (`Category_Name`, `Category_Desc`) VALUES ('C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language, or \"C with Classes\".')";
        $result = mysqli_query($con, $sql);
        
        $sql = "INSERT INTO `categories` (`Category_Name`, `Category_Desc`) VALUES ('Java', 'Java is a class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.')";
        $result = mysqli_query($con, $sql);
    }

    $sql = "CREATE TABLE IF NOT EXISTS `temp`.`comments` ( `Comment_id` INT NOT NULL AUTO_INCREMENT , `Comment_content` VARCHAR(255) NOT NULL , `Thread_id` INT NOT NULL , `Comment_time` DATETIME NOT NULL , `Comment_by` INT NOT NULL , PRIMARY KEY (`Comment_id`)) ENGINE = InnoDB;";
    $result = mysqli_query($con, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS `temp`.`threads` ( `Thread_id` INT NOT NULL AUTO_INCREMENT , `Thread_title` VARCHAR(255) NOT NULL , `Thread_desc` TEXT NOT NULL , `Thread_cat_id` INT NOT NULL , `Thread_user_id` INT NOT NULL , `DateTime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`Thread_id`)) ENGINE = InnoDB;";
    $result = mysqli_query($con, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS `temp`.`users` ( `User_id` INT NOT NULL AUTO_INCREMENT , `User_username` VARCHAR(25) NOT NULL , `User_email` VARCHAR(30) NOT NULL , `User_password` VARCHAR(255) NOT NULL , `Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`User_id`)) ENGINE = InnoDB;";
    $result = mysqli_query($con, $sql);

    
    // echo "connected successfully";
?>