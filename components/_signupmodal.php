<?php 
echo "
<!-- Modal -->
<div class='modal fade' id='signupmodal' tabindex='-1' role='dialog' aria-labelledby='signupmodalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='signupmodalLabel'>SignUp for an iCode account</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button> 
      </div>
      <form action='/forum/components/_handleSignup.php' method='POST'>
        <div class='modal-body'>
            <div class='form-group'>
        <label for='email '>email</label>
        <input type='text' maxlength='25' class='form-control' name='email' id='email'
          aria-describedby='emailHelp' placeholder='email'>
      </div>
      <div class='form-group '>
        <label for='password'>Password</label>
        <input type='password' maxlength='15' class='form-control' name='password' id='password' placeholder='Password'>
      </div>
      <div class='form-group '>
        <label for='cpassword'>Confirm Password</label>
        <input type='password' maxlength='15' class='form-control' name='cpassword' id='cpassword'
          placeholder='Confirm Password'>
        <small id='emailHelp' class='form-text text-muted'>Make sure to type the same password</small>
        </div>
            <button type='submit' class='btn btn-primary'>SignUp</button>
        </div>
        </div>
        </form>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
      </div>
    </div>
  </div>
</div>";
?>