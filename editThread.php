<?php
if(isset($_GET['edit']))
{
        $editid = $_GET['edit'];
        $sql = "select * from `threads` where `Thread_id` = $editid";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '<div class="container my-3">
        <!-- <a href="askquestion.php" class="btn btn-success">Ask a question</a> -->
        <h1 class="py2">Edit question</h1>
        <form action="threadlist.php?catid='.$id.'&editid='.$editid.'" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Problem Title</label>
        <input type="text" value='.$row['Thread_title'].' name="title" class="form-control" id="title" aria-describedby="usernameHelp">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Problem Description</label>
        <textarea class="form-control" name="desc" id="desc" rows="3">'.$row['Thread_desc'].'</textarea>
    </div>
    <input type="hidden" name="thread_user_id" value="'.$_SESSION['id'].'">
    <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>';
}
?>