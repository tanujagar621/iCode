<?php
class player
{
    public $name;
    public $speed = 5;
    function set_name($name)
    {
        this->name = $name;
    }
    function get_name()
    {
        return this->name;
    }
}
$player1 = new player;
$player1->set_name("tanuj");
echo $player1 . get_name();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>