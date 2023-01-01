<?php
include('db.php');
session_start();
if(empty($_SESSION['username']))
{
    header('Location:login.php');
}
?>
<?php
include ('header.php');
?>

<?php
if(!empty($_GET['action']) && $_GET['action'] =='delete' && !empty($_GET['id']))
{
    // echo 'working';
    $sql = "DELETE FROM csms_Vendor WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if($result)
    {?>
    <script>
window.location.href = 'vendors.php?action=deleted';
</script>
    
    <?php
        // 
      //  header('Location:vendors.php?action=deleted');
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
    $sql = "SELECT id, vname, vaddress, vmobile, vemail FROM csms_Vendor WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // 
        $row = $result -> fetch_row();
        // print_r($row);
    }

?>
<div class="container">
<h4 class="normal-text" style="text-align: center;margin-bottom:25px">Edit Vendor</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
              <input type="hidden" name="vid" value="<?php echo $_GET['id'];?>">
  <div class="mb-3 row">
    <label for="inputVendorname" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputVendorname" name="inputVendorname" value="<?php echo $row['1']?> ">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="<?php echo $row['2']?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputMobile" name="inputMobile" value="<?php echo $row['3']?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $row['4']?>">
    </div>
  </div>

<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;"  name="sbutton"><i class="fa fa-edit fa-fw"></i>Update</button>
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
elseif(isset($_POST['sbutton']) && !empty($_POST['vid']) && !empty($_POST['inputVendorname']) && !empty($_POST['inputAddress']) && !empty($_POST['inputMobile']) && !empty($_POST['inputEmail']))
// elseif(isset($_POST['sbutton']))
{
    // 
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    // print_r($_POST);
    $sql = "UPDATE csms_Vendor SET vname = '".$_POST['inputVendorname']."', vaddress = '".$_POST['inputAddress']."', vmobile = '".$_POST['inputMobile']."', vemail = '".$_POST['inputEmail']."' WHERE id = ".$_POST['vid'].";";
    $result = $conn->query($sql);
    ?>
    <script>
window.location.href = 'vendors.php?action=update';
</script>
    <?php
  //  header('Location:vendors.php?action=updated');
}
elseif(!empty($_GET['action']) && $_GET['action'] =='add')
{
    // 
?>
<div class="container">
<h4 class="normal-text" style="text-align: center;">Add Vendor</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
  <div class="mb-3 row">
    <label for="inputVendorname" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputVendorname" name="inputVendorname">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputAddress" name="inputAddress">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputMobile" class="col-sm-2 col-form-label">Mobile</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputMobile" name="inputMobile">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail" name="inputEmail">
    </div>
  </div>

<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton"><i class="fa-solid fa-plus"></i> Add</button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
      </div>
</form>
</div>
<?php
}
elseif(isset($_POST['sbutton']) && !empty($_POST['inputVendorname']) && !empty($_POST['inputAddress']) && !empty($_POST['inputMobile']) && !empty($_POST['inputEmail']))
{
    // 
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    $sql = "INSERT INTO csms_Vendor (vname,vaddress,vmobile,vemail) VALUES ('".$_POST['inputVendorname']."','".$_POST['inputAddress']."','".$_POST['inputMobile']."','".$_POST['inputEmail']."');";
    // die($sql);
    $result = $conn->query($sql);
    ?>
    <script>
window.location.href = 'vendors.php?action=added';
</script>
    <?php
   // header('Location:vendors.php?action=added');
}
else
{?>
 <script>
window.location.href = 'vendors.php';
</script>
<?php
    // echo 'not working';
//    header('Location:vendors.php');
}

?>
    
<div class="container">
  <footer class="py-3 my-4">
    <div class="justify-content-center border-bottom pb-3 mb-3"></div>
    <p class="text-center text-muted">&copy; CSMS 2022</p>
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>