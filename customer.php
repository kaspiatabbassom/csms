<?php
include('db.php');
session_start();
if(empty($_SESSION['username']))
{
    header('Location:login.php');
}
include('header.php');
?>


<?php
if(!empty($_GET['action']) && $_GET['action'] =='delete' && !empty($_GET['id']))
{
    // echo 'working';
    $sql = "DELETE FROM csms_Users WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if($result)
    {
        // 
        ?>
      <script>
window.location.href = 'customers.php?action=deleted';
</script>
        
        <?php
        // header('Location:customers.php?action=deleted');
    }
    // else
    // {
    //     // 
    //     header('Location:customers.php?action=notdeleted');
    // }
}
elseif(!empty($_GET['action']) && $_GET['action'] =='edit' && !empty($_GET['id']))
{
    // echo 'not working';
    $sql = "SELECT cname,cemail,cnumber,caddr1,caddr2,ccity,cstate,ccountry,czcode,ustatus FROM csms_Users WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // 
        $row = $result -> fetch_row();
        // print_r($row);die();
    }

?>
<div class="container">
<h4 class="normal-text" style="text-align: center;">Edit Customer</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
              <input type="hidden" name="cid" value="<?php echo $_GET['id'];?>">
  <div class="mb-3 row">
    <label for="inputUsername" class="col-sm-2 col-form-label">Name :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsername" name="inputUsername" value="<?php echo $row['0']?>" required>
      <div class="invalid-feedback">Name is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUseremail" class="col-sm-2 col-form-label">Email Address :</label>
    <div class="col-sm-10">
    <input type="email" class="form-control" id="inputUseremail" name="inputUseremail" value="<?php echo $row['1']?>" required>
    <div class="invalid-feedback">Email address is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUsernumber" class="col-sm-2 col-form-label">Mobile Number :</label>
    <div class="col-sm-10">
    <input type="number" class="form-control" id="inputUsernumber" name="inputUsernumber" value="<?php echo $row['2']?>" required>
    <div class="invalid-feedback">Mobile number is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUseraddr1" class="col-sm-2 col-form-label">Address 1 :</label>
    <div class="col-sm-10">
    <textarea class="form-control" id="inputUseraddr1" name="inputUseraddr1" rows="3" required><?php echo $row['3']?></textarea>
    <div class="invalid-feedback">Address 1 is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUseraddr2" class="col-sm-2 col-form-label">Address 2 :</label>
    <div class="col-sm-10">
    <textarea class="form-control" id="inputUseraddr2" name="inputUseraddr2" rows="3"><?php echo $row['4']?></textarea>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUsercity" class="col-sm-2 col-form-label">City :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsercity" name="inputUsercity" value="<?php echo $row['5']?>" required>
      <div class="invalid-feedback">City is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUserstate" class="col-sm-2 col-form-label">State :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUserstate" name="inputUserstate" value="<?php echo $row['6']?>" required>
      <div class="invalid-feedback">State is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUsercountry" class="col-sm-2 col-form-label">Country :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsercountry" name="inputUsercountry" value="<?php echo $row['7']?>" required>
      <div class="invalid-feedback">Country is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUserzcode" class="col-sm-2 col-form-label">Zip Code :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUserzcode" name="inputUserzcode" value="<?php echo $row['8']?>" required>
      <div class="invalid-feedback">Zip code is required!</div>
    </div>
  </div>
  <!-- <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password :</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" name="inputPassword" value="" required>
      <div class="invalid-feedback">Password is required!</div>
    </div>
  </div> -->
  <div class="mb-3 row">
    <label for="inputStatus" class="col-sm-2 col-form-label">Status :</label>
    <div class="col-sm-10">
    <select class="form-select" id="inputStatus" name="inputStatus" required>
      <?php
      if($row['9'] == '1')
      {
        echo '<option value="1" selected>Active</option><option value="0">De-active</option>';
      }
      else
      {
        echo '<option value="1">Active</option><option value="0" selected>De-active</option>';
      }
      ?>
      <!-- <option selected disabled value="" hidden="">Choose Status</option>
      <option option selected disabled>Select Status</option>
      <option value="1" >Active</option>
      <option value="0">De-active</option> -->
    </select>
    <div class="invalid-feedback">Status is required!</div>
      <!-- <input type="password" class="form-control" id="inputPassword" name="inputPassword"> -->
    </div>
  </div>

<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;border-radius: 2px;" name="sbutton"><i class="fa fa-edit fa-fw"></i>Update</button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
      </div>
</form>
</div>
<?php
// if(!empty($_GET['action']) && $_GET['action'] =='edit' && !empty($_GET['id']))
// {
    // echo 'working';
?>

<?php
}
elseif(isset($_POST['sbutton']) && !empty($_POST['cid']) && !empty($_POST['inputUsername']) && !empty($_POST['inputUseremail']) && !empty($_POST['inputUsernumber']) && !empty($_POST['inputUseraddr1']) && !empty($_POST['inputUsercity']) && !empty($_POST['inputUserstate']) && !empty($_POST['inputUsercountry']) && !empty($_POST['inputUserzcode']) && isset($_POST['inputStatus']))
// elseif(isset($_POST['sbutton']))
{
    // 
    // if(!empty($_POST['inputStatus']))
    // {
    //   $status = 1;
    // }
    // else
    // {
    //   $status = 0;
    // }
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    // print_r($_POST);die();
    $sql = "UPDATE csms_Users SET cname = '".$_POST['inputUsername']."', cemail = '".$_POST['inputUseremail']."', cnumber = '".$_POST['inputUsernumber']."', caddr1 = '".$_POST['inputUseraddr1']."', caddr2 = '".$_POST['inputUseraddr2']."', ccity = '".$_POST['inputUsercity']."', cstate = '".$_POST['inputUserstate']."', ccountry = '".$_POST['inputUsercountry']."', czcode = '".$_POST['inputUserzcode']."', ustatus = '".$_POST['inputStatus']."' WHERE id = ".$_POST['cid'].";";
    $result = $conn->query($sql);
    ?>
      <script>
window.location.href = 'customers.php';
</script>
    <?php
  //  header('Location:customers.php?action=updated');
}
elseif(!empty($_GET['action']) && $_GET['action'] =='add')
{
    // 
?>
<div class="container">
<h4 class="normal-text" style="text-align: center;">Add Customer</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;" novalidate  >
  <div class="mb-3 row">
    <label for="inputUsername" class="col-sm-2 col-form-label">Name :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsername" name="inputUsername" required>
      <div class="invalid-feedback">Name is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUseremail" class="col-sm-2 col-form-label">Email Address :</label>
    <div class="col-sm-10">
    <input type="email" class="form-control" id="inputUseremail" name="inputUseremail" required>
    <div class="invalid-feedback">Email address is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUsernumber" class="col-sm-2 col-form-label">Mobile Number :</label>
    <div class="col-sm-10">
    <input type="number" class="form-control" id="inputUsernumber" name="inputUsernumber" required>
    <div class="invalid-feedback">Mobile number is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUseraddr1" class="col-sm-2 col-form-label">Address 1 :</label>
    <div class="col-sm-10">
    <textarea class="form-control" id="inputUseraddr1" name="inputUseraddr1" rows="3" required></textarea>
    <div class="invalid-feedback">Address 1 is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUseraddr2" class="col-sm-2 col-form-label">Address 2 :</label>
    <div class="col-sm-10">
    <textarea class="form-control" id="inputUseraddr2" name="inputUseraddr2" rows="3"></textarea>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUsercity" class="col-sm-2 col-form-label">City :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsercity" name="inputUsercity" required>
      <div class="invalid-feedback">City is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUserstate" class="col-sm-2 col-form-label">State :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUserstate" name="inputUserstate" required>
      <div class="invalid-feedback">State is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUsercountry" class="col-sm-2 col-form-label">Country :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsercountry" name="inputUsercountry" required>
      <div class="invalid-feedback">Country is required!</div>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputUserzcode" class="col-sm-2 col-form-label">Zip Code :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUserzcode" name="inputUserzcode" required>
      <div class="invalid-feedback">Zip code is required!</div>
    </div>
  </div>

  <div class="mb-3 row">
    <label for="inputStatus" class="col-sm-2 col-form-label">Status :</label>
    <div class="col-sm-10">
    <select class="form-select" id="inputStatus" name="inputStatus" required>
      <option selected disabled value="" hidden="">Choose Status</option>
      <!-- <option option selected disabled>Select Status</option> -->
      <option value="1" >Active</option>
      <option value="0">De-active</option>
    </select>
    <div class="invalid-feedback">Status is required!</div>
      <!-- <input type="password" class="form-control" id="inputPassword" name="inputPassword"> -->
    </div>
  </div>

<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;border-radius: 2px;" name="sbutton"><i class="fa fa-user-plus"></i> Add</button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
      </div>
</form>
</div>
<?php
}
// elseif($_POST)
elseif(isset($_POST['sbutton']) && !empty($_POST['inputUsername']) && !empty($_POST['inputUseremail']) && !empty($_POST['inputUsernumber']) && !empty($_POST['inputUseraddr1']) && !empty($_POST['inputUsercity']) && !empty($_POST['inputUserstate']) && !empty($_POST['inputUsercountry']) && !empty($_POST['inputUserzcode']) && !empty($_POST['inputStatus']))
{
    // 
    // print_r($_POST);die();
    // if(empty)
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    $sql = "INSERT INTO csms_Users (cname,cemail,cnumber,caddr1,caddr2,ccity,cstate,ccountry,czcode,ustatus) VALUES ('".$_POST['inputUsername']."','".$_POST['inputUseremail']."','".$_POST['inputUsernumber']."','".$_POST['inputUseraddr1']."','".$_POST['inputUseraddr2']."','".$_POST['inputUsercity']."','".$_POST['inputUserstate']."','".$_POST['inputUsercountry']."','".$_POST['inputUserzcode']."','".$_POST['inputStatus']."');";
    // die($sql);
    $result = $conn->query($sql);
    ?>
    <script>
window.location.href = 'customers.php?action=added';
</script>
    <?php
  //  header('Location:customers.php?action=added');
}
else
{
    // echo 'not working';
    ?>
    <script>
window.location.href = 'dashboard.php';
</script>
    <?php
   // header('Location:dashboard.php');
}

?>
    
<div class="container">
  <footer class="py-3 my-4">
    <div class="justify-content-center border-bottom pb-3 mb-3"></div>
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