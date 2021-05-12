<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/forum">iCode</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Top Categories
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">';
                    require "_dbconnect.php";
                    $sql = "select * from `categories` limit 3";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<a class="dropdown-item text-light" href="threadlist.php?catid='.$row['Category_id'].'">'.$row['Category_Name'].'</a>';
                    }
                    echo '</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
                </li>
            </ul>
            <div class="mx-2 row  position-relative">
            <form class="form-inline my-2 my-lg-0  method="get" action="/forum/search.php">
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                </form>';
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
            {
                echo '
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Welcome '.$_SESSION['email'].'
                    </a>
                    <div class="dropdown-menu bg-dark dropdown-menu-right" style="min-width=25rem;" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-light"  href="selfProfile.php">Profile</a>
                        <a class="dropdown-item text-light" href="components/_logout.php">LogOut</a>
                    </div>
                </form>';
            }
            else
            {
                echo '
                
                <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginmodal">Login</button>
                <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupmodal">SignUp</button>';
            }
            echo'
            </div>
        </div>
    </nav>';
include "components/_loginmodal.php";
if(isset($_GET['loginerror'])) { 
    echo '
    <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong>'.$_GET['loginerror'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
else if(isset($_GET['login']) && $_GET['login'] == true)
{
    echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success! </strong> You are logged in successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
include "components/_signupmodal.php";
if(isset($_GET['error']))
{
    echo '
        <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong>'.$_GET['error'].'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
else if(isset($_GET['signup']) && $_GET['signup'] == true)
{
    echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Your account has been created successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
?>