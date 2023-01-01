<?php
include('db.php');
session_start();
if(empty($_SESSION['username']))
{
    header('Location:login.php');
}
// print_r($_POST);die();
?>
<?php
include ('header.php');
?>
    <!--  -->
    <div class="container">
      <h3 class="m-2 font-weight-bold text-center normal-text">Profile</h3>
      <?php
        if(isset($_POST['sbutton']) && !empty($_POST['inputCpassword']) && !empty($_POST['inputNpassword']) && !empty($_POST['inputCNpassword']))
        {
          // 
//           print_r($_SESSION);die();
          $sql = 'SELECT * FROM csms_SuperAdmin WHERE username = "'.$_SESSION ['username'].'";';
         


          $result = $conn->query($sql);

        
            if ($result->num_rows > 0) {
              // 
              $row = $result -> fetch_row();
              // print_r($row);die();
              if ($row['2'] == md5($_POST['inputCpassword']))
              {
                // echo 'Password is valid!';
                $sql = "UPDATE csms_SuperAdmin SET passwd = '".md5($_POST['inputNpassword'])."' WHERE id=".$row['0'].";";
               
                // die($sql);
                if($conn->query($sql) == true)
                {
                  // echo 'passwored update success!';
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Password has been successfully updated!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                else
                {
                  // echo 'passwoed update failed!';
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Password update failed!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                  // die();
                }
              }
              else
              {
                  // echo 'Invalid password.';
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Current password does not match!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                  // die();
              }
              // die();
          }
        } 
      ?>
        <!-- <h1 class="m-2 font-weight-bold text-primary text-center">Profile</h4> -->



        
        <h4 class="m-2 font-weight-bold  text-center normal-text">Account Management</h4>
<div class="container form-submit">
  <hr><hr>
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" novalidate>
          <div class="mb-3 row">
            <label for="inputCpassword" class="col-sm-2 col-form-label">Current Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputCpassword" name="inputCpassword" required>
              <div class="invalid-feedback">Please provide your current password.</div>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputNpassword" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputNpassword" name="inputNpassword" required>
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please provide a new password.</div>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputCNpassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputCNpassword" name="inputCNpassword" onkeyup="checkPass(this);" required>
              <div class="invalid-feedback">Please provide the same new password.</div>
              <div id="cnpm" style="display:none;" ></div>
            </div>
          </div>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="submit" class="purchase-submit btn-block" id="sbutton" name="sbutton" style="width: 30%;border-radius:3px"><i class="fa-brands fa-usps"></i> Update Profile</button>
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->

              </div>
        </form>
        </div>
        <a href="creatAdmin.php" class="purchase-submit" style="width:20%;font-size:15px;border-radius:3px;margin-top:20px">Create New Admin</a>
    </div>

    <!--  -->
    <div class="container">
      <footer class="py-3 my-4">
        <div class="justify-content-center border-bottom pb-3 mb-3">
        </div> <p>Login as <b>
          <?php print_r($_SESSION['username']) ?> </b>
        <p class="text-center text-muted">&copy; CSMS 2022</p>
      </footer>
    </div>
    <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>