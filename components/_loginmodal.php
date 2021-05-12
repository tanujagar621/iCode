<?php 
echo "
<!-- Modal -->
<div class='modal fade' id='loginmodal' tabindex='-1' role='dialog' aria-labelledby='loginmodalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='loginmodalLabel'>Login to iCode</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <form action='/forum/components/_handleLogin.php' method='POST'>
        <div class='modal-body'>
          <div class='form-group'>
          <label for='email '>email</label>
          <input type='text' class='form-control' name='email' id='email' aria-describedby='emailHelp'
          placeholder='email'>
        </div>
        <div class='form-group '>
          <label for='password'>Password</label>
          <input type='password' class='form-control' name='password' id='password' placeholder='Password'>
        </div>
        <button type='submit' class='btn btn-primary'>Login</button>
      </div>
    </form>
  <div class='modal-footer'>
  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
</div> 
</div>
</div>
</div>";
?>