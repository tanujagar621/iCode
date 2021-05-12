<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>iCode - Online coding Forum</title>
</head>

<body>
    <?php require "components/_dbconnect.php";?>
    <?php require "components/_nav.php";?>
    <style>
    #mainContainer {
        min-height: 86.3vh;
    }
    </style>
    <!-- Search results -->
    <div class="container" id="mainContainer">
        <h1>Search Results For <em>"<?php echo $_GET['search'] ?>"</em></h1>
        <?php
        $query = $_GET['search'];
            $sql = "SELECT * FROM `threads` WHERE MATCH (Thread_title, Thread_desc) against ('$query')";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            if($num)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $title = $row['Thread_title'];
                    $desc = $row['Thread_desc'];
                    $thread_id = $row['Thread_id'];
                    $url = "thread.php?threadid=".$thread_id;
                    echo '<div class="results my-3 border border-dark p-2">
                        <a href="'.$url.'" class="text-dark">
                            <h3>'.$title.'</h3>
                        </a>
                        <p>'.$desc.'</p>
                    </div>';
                }
            }
            else
            {
                // echo "No results found";
                echo '<div class="jumbotron jumbotron-fluid p-3">
                    <div class="container">
                    <p style="font-size: 35px;">Your search - '.$query.' - did not match any document.</p>
                    <p class="lead"><b>
                        Suggestions:
                        <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</li>
                        </ul>
                    </b></p>
                        </div>
                    </div>';
            }
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