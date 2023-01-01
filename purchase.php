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
    $sql = "DELETE FROM csms_Purchases WHERE id = ".$_GET['id'].";";
    // die($sql);
    $result = $conn->query($sql);
    if($result)
    {
      ?>
        <script>
window.location.href = 'purchases.php';
</script>
      <?php
        // 
       // header('Location:purchases.php?action=deleted');
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
    $sql = "SELECT pvid,pid,pstock,vprice,pdate FROM csms_Purchases WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // 
        $row = $result -> fetch_row();
        // print_r($row);
        // die();
    }

?>
<div class="container">
<h4 class="normal-text" style="text-align: center;">Edit Purchases</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
              <input type="hidden" name="pid" value="<?php echo $_GET['id'];?>">
              <input type="hidden" name="pit" value="<?php echo $row['2'];?>">
    <div class="mb-3 row">
    <label for="inputVendorid" class="col-sm-2 col-form-label">Vendor</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputVendorid" name="inputVendorid">
            <!-- <option disabled="" selected="" hidden="">Select Vendor</option> -->
            <?php
            $vsql = "SELECT id,vname FROM csms_Vendor;";
            $vresult = $conn->query($vsql);
            if ($vresult->num_rows > 0)
            {
              while($vrow = $vresult->fetch_assoc())
              {
                if($vrow['id'] == $row['0'])
                {
                  echo '<option selected="" value="'.$vrow['id'].'">'.$vrow['vname'].'</option>';
                }
                else
                {
                  // 
                  echo '<option value="'.$vrow['id'].'">'.$vrow['vname'].'</option>';
                }
                // echo '<option value="'.$vrow['id'].'">'.$vrow['vname'].'</option>';
                // print_r($row);
              }
            }
            // $sql = "SELECT id,pname FROM csms_Product;";
            // $result = $conn->query($sql);
            // if ($result->num_rows > 0)
            // {
                // 
            //     $row = $result -> fetch_row();
            //     print_r($row);die();
            // 
            ?>
            <!-- <option value="7">CPU</option>
            <option value="6">Headset</option>
            <option value="0">Keyboard</option>
            <option value="2">Monitor</option> -->
        </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductid" class="col-sm-2 col-form-label">Product</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputProductid" name="inputProductid">
            <!-- <option disabled="" selected="" hidden="">Select Product</option> -->
            <?php
            $psql = "SELECT id,pname FROM csms_Product;";
            $presult = $conn->query($psql);
            if ($presult->num_rows > 0)
            {
              while($prow = $presult->fetch_assoc())
              {
                if($prow['id'] == $row['1'])
                {
                  echo '<option selected="" value="'.$prow['id'].'">'.$prow['pname'].'</option>';
                }
                else
                {
                  // 
                  echo '<option value="'.$prow['id'].'">'.$prow['pname'].'</option>';
                }
                // echo '<option value="'.$vrow['id'].'">'.$vrow['vname'].'</option>';
                // print_r($row);
              }
            }
            // }
            ?>
            <!-- <option value="7">CPU</option>
            <option value="6">Headset</option>
            <option value="0">Keyboard</option>
            <option value="2">Monitor</option> -->
        </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductquantity" class="col-sm-2 col-form-label">Quantity</label>
    <div class="col-sm-10">
        <input class="form-control" type="number" min="1" max="9999999999" id="inputProductquantity" name="inputProductquantity" value="<?php echo $row['2']?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductprice" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
        <input class="form-control" type="number" min="1" max="9999999999" id="inputProductprice" name="inputProductprice" value="<?php echo $row['3']?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductpdate" class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-10">
        <input class="form-control" type="date" id="inputProductpdate" name="inputProductpdate" value="<?php echo $row['4']?>">
    </div>
  </div>

  

<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton"><i class="fa fa-edit fa-fw"></i>Update</button>
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
elseif(isset($_POST['sbutton']) && !empty($_POST['pid']) && !empty($_POST['inputVendorid']) && !empty($_POST['inputProductid']) && !empty($_POST['inputProductquantity']) && !empty($_POST['inputProductprice']) && !empty($_POST['inputProductpdate']))
// elseif(isset($_POST['sbutton']))
{
    // 
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    $gpssql = "SELECT pqstock FROM csms_Product WHERE id='".$_POST['inputProductid']."';";
    // die($sql);
    $gpsresult = $conn->query($gpssql);
    $gpsobj = $gpsresult -> fetch_object();
    $tps = $gpsobj->pqstock - $_POST['pit'];
    $nps = $tps + $_POST['inputProductquantity'];
    // die($gpsobj->pqstock);
    $upssql = "UPDATE csms_Product SET pqstock = '".$nps."' WHERE id = '".$_POST['inputProductid']."';";
    // die($sql);
    $upsresult = $conn->query($upssql);
    // print_r($_POST);
    $sql = "UPDATE csms_Purchases SET pvid = '".$_POST['inputVendorid']."', pid = '".$_POST['inputProductid']."', pstock = '".$_POST['inputProductquantity']."', vprice = '".$_POST['inputProductprice']."', pdate = '".$_POST['inputProductpdate']."' WHERE id = ".$_POST['pid'].";";
    $result = $conn->query($sql);
    ?>
     <script>
window.location.href = 'purchases.php';
</script>
    <?php
   // header('Location:purchases.php?action=updated');
}
elseif(!empty($_GET['action']) && $_GET['action'] =='add')
{
    // 
    $sql = "SELECT id,vname FROM csms_Vendor;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // 
    //     $row = $result -> fetch_row();
    //     print_r($row);die();
    // }
?>
<div class="container">
<h4 class="normal-text" style="text-align: center;">Add Purchase</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  style="box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;" >
  <!-- <div class="mb-3 row">
    <label for="inputProductname" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputProductname" name="inputProductname">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductdetails" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="inputProductdetails" name="inputProductdetails" rows="5"></textarea>
    </div>
  </div> -->
  <div class="mb-3 row">
    <label for="inputVendorid" class="col-sm-2 col-form-label">Vendor</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputVendorid" name="inputVendorid" required>
            <option disabled="" selected="" hidden="">Select Vendor</option>
            <?php
            while($row = $result->fetch_assoc())
            {
              echo '<option value="'.$row['id'].'">'.$row['vname'].'</option>';
              // print_r($row);
            }
            }
            $sql = "SELECT id,pname FROM csms_Product;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                // 
            //     $row = $result -> fetch_row();
            //     print_r($row);die();
            // }
            ?>
            <!-- <option value="7">CPU</option>
            <option value="6">Headset</option>
            <option value="0">Keyboard</option>
            <option value="2">Monitor</option> -->
        </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductid" class="col-sm-2 col-form-label">Product</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputProductid" name="inputProductid" required>
            <option disabled="" selected="" hidden="">Select Product</option>
            <?php
            while($row = $result->fetch_assoc())
            {
              echo '<option value="'.$row['id'].'">'.$row['pname'].'</option>';
              // print_r($row);
            }
            }
            ?>
            <!-- <option value="7">CPU</option>
            <option value="6">Headset</option>
            <option value="0">Keyboard</option>
            <option value="2">Monitor</option> -->
        </select>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductquantity" class="col-sm-2 col-form-label">Quantity</label>
    <div class="col-sm-10">
        <input class="form-control" type="number" min="1" max="9999999999" id="inputProductquantity" name="inputProductquantity" required>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductprice" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
        <input class="form-control" type="number" min="1" max="9999999999" id="inputProductprice" name="inputProductprice" required>
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputProductpdate" class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-10">
        <input class="form-control" type="date"  id="inputProductpdate" name="inputProductpdate" required>
    </div>
  </div>
  
  <!-- <div class="mb-3 row">
    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
    <select class="form-select" aria-label="Default select" id="inputStatus" name="inputStatus">
  <option value="active" selected>Active</option>
    <option value="iactive">Not active</option>
</select>
    </div>
  </div> -->

<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton"><i class="fa-brands fa-usps"></i> Submit</button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
      </div>
</form>
</div>
<?php
}
elseif(isset($_POST['sbutton']) && !empty($_POST['inputVendorid']) && !empty($_POST['inputProductid']) && !empty($_POST['inputProductquantity']) && !empty($_POST['inputProductprice']) && !empty($_POST['inputProductpdate']))
// elseif(isset($_POST))
{
    // 
    // print_r($_POST);die();
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    $sql = "INSERT INTO csms_Purchases (pvid,pid,pstock,vprice,pdate) VALUES ('".$_POST['inputVendorid']."','".$_POST['inputProductid']."','".$_POST['inputProductquantity']."','".$_POST['inputProductprice']."','".$_POST['inputProductpdate']."');";
    // die($sql);
    $result = $conn->query($sql);
    $gpssql = "SELECT pqstock FROM csms_Product WHERE id='".$_POST['inputProductid']."';";
    // die($sql);
    $gpsresult = $conn->query($gpssql);
    $gpsobj = $gpsresult -> fetch_object();
    $nps = $gpsobj->pqstock + $_POST['inputProductquantity'];
    // die($gpsobj->pqstock);
    $upssql = "UPDATE csms_Product SET pqstock = '".$nps."' WHERE id = '".$_POST['inputProductid']."';";
    // die($sql);
    $upsresult = $conn->query($upssql);
    // $upsobj = $upsresult -> fetch_object();

?>

<script>
window.location.href = 'purchases.php';
</script>
<?php
  //  header('Location:purchases.php?action=added');
}
else
{
    ?>
    
    <script>
window.location.href = 'purchases.php';
</script> 
    <?php
  

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