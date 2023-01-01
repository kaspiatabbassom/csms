<?php
include('db.php');
session_start();
if (empty($_SESSION['username'])) {
  header('Location:login.php');
}
?>
<?php
include('header.php');
?>

<?php
if (!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
  // echo 'working';
  $sql = "DELETE FROM csms_Product WHERE id = " . $_GET['id'] . ";";
  $result = $conn->query($sql);
  if ($result) {
    // 
?>
    <script>
      window.location.href = 'products.php';
    </script>

  <?php
    //   header('Location:products.php?action=deleted');
  }
  // else
  // {
  //     // 
  //     header('Location:customers.php?action=notdeleted');
  // }
} elseif (!empty($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
  // echo 'not working';
  $sql = "SELECT pname,pdescription,psprice,pcprice,pvat,pqstock,pstatus FROM csms_Product WHERE id = " . $_GET['id'] . ";";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // 
    $row = $result->fetch_row();
    // print_r($row);
    // die();
  }

  ?>

  <!-- product add korte shurute vendor add korte hbe -->
  <div class="container">
    <h4 class="normal-text" style="text-align: center;">Edit Product</h4>
    <hr>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype="multipart/form-data" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
      <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
      <div class="mb-3 row">
        <label for="inputProductname" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputProductname" name="inputProductname" value="<?php echo $row['0'] ?>" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputProductdetails" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="inputProductdetails" name="desc" rows="5" required><?php echo $row['1']  ?></textarea>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputProductSprice" class="col-sm-2 col-form-label">Per Unit Sale Price</label>
        <div class="col-sm-10">
          <input class="form-control" type="number" min="1" max="9999999999" id="inputProductSprice" required name="inputProductSprice" value="<?php echo $row['2'] ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputProductimgp" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
          <input class="form-control" type="file" id="inputProductimg" name="inputProductimg" accept="image/*" required>
          <!-- <input class="form-control" type="number" min="1" max="9999999999" id="inputProductimg" name="inputProductimg"> -->
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputProductCprice" class="col-sm-2 col-form-label">Per Unit Cost Price</label>
        <div class="col-sm-10">
          <input class="form-control" type="number" min="1" max="9999999999" id="inputProductCprice" name="inputProductCprice" value="<?php echo $row['3'] ?>" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputProductvat" class="col-sm-2 col-form-label">VAT %</label>
        <div class="col-sm-10">
          <input class="form-control" type="number" min="1" max="9999999999" id="inputProductvat" name="inputProductvat" value="<?php echo $row['4'] ?>" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputProductquantity" class="col-sm-2 col-form-label">On Hand</label>
        <div class="col-sm-10">
          <input class="form-control" type="number" min="1" max="9999999999" id="inputProductquantity" name="inputProductquantity" value="<?php echo $row['5'] ?>" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select class="form-select" aria-label="Default select" id="inputStatus" name="inputStatus">
            <!-- <option selected>Click here</option> -->
            <?php
            if ($row['6'] == '1') {
              // 
              echo '<option value="active" selected>Active</option><option value="iactive">Deactive</option>';
            } else {
              // 
              echo '<option value="active">Active</option><option value="iactive" selected>Deactive</option>';
            }
            ?>
            <!-- <option value="active" selected>Active</option>
    <option value="iactive">De-Active</option> -->
          </select>
          <!-- <input type="password" class="form-control" id="inputPassword" name="inputPassword"> -->
        </div>
      </div>

      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="submit" class="purchase-submit" style="width: 30%;" name="editbutton"><i class="fa fa-edit fa-fw"></i>Update</button>
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
// elseif(isset($_POST['sbutton']) && !empty($_POST['pid']) && !empty($_POST['inputProductname']) && !empty($_POST['inputProductdetails']) && !empty($_POST['inputProductSprice']) && !empty($_POST['inputProductCprice']) && !empty($_POST['inputProductvat']) && !empty($_POST['inputProductquantity']) && !empty($_POST['inputStatus']))
elseif (isset($_POST['editbutton']) )
// elseif(isset($_POST['sbutton']))
{

  // $pic = $_FILES['inputProductimg']['name'];
 
  // $tpic = $_FILES['inputProductimg']['tmp_name'];
  // $folder = 'uploads/' . $pic;
  // $desc = $_POST['desc'];
  //move_uploaded_file($pic, $folder);
  $targetDir = "uploads/";
  $fileName = basename($_FILES["inputProductimg"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  // echo '<pre>';print_r($_POST);echo '</pre>';die();
  if (!move_uploaded_file($_FILES["inputProductimg"]["tmp_name"], $targetFilePath)) {
    // 
    echo "Sorry, there was an error when uploading your file.";
    die();
  }

  // if (move_uploaded_file($pic, $folder) == false) {
  //   //
  //   echo "Sorry, there was an error when uploading your file.";
  //   die();
  // }
  // 
  if ($_POST['inputStatus'] == 'active') $status = 1;
  if ($_POST['inputStatus'] == 'iactive') $status = 0;
  // print_r($_POST);
  // $sql = "UPDATE csms_Product SET pname = '".$_POST['inputProductname']."', pdescription = '".$_POST['inputProductdetails']."', psprice = '".$_POST['inputProductSprice']."', pcprice = '".$_POST['inputProductCprice']."', pvat = '".$_POST['pvat']."', pqstock = '".$_POST['inputProductquantity']."', pstatus = '".$status."' WHERE id = ".$_POST['pid'].";";
  $sql = "UPDATE csms_Product SET pname = '" . $_POST['inputProductname'] . "', pdescription = '" . $_POST['desc'] . "', psprice = '" . $_POST['inputProductSprice'] . "', pcprice = '" . $_POST['inputProductCprice'] . "', pvat = '" . $_POST['inputProductvat'] . " ',pimg = '" . $fileName . " ', pqstock = '" . $_POST['inputProductquantity'] . "', pstatus = '" . $status . "' WHERE id = " . $_POST['pid'] . ";";

  // die($sql);
  $result = $conn->query($sql);
?>
  <script>
    window.location.href = 'products.php';
  </script>
  <?php
  //  header('Location:products.php?action=updated');
} elseif (!empty($_GET['action']) && $_GET['action'] == 'add') {
  // 
  $sql = "SELECT id,cname FROM csms_Category WHERE parentId IS NULL OR parentId IS NOT NULL;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // 
    //     $row = $result -> fetch_row();
    //     print_r($row);die();
    // }
  ?>
    <div class="container">
      <h4 class="normal-text" style="text-align: center; margin-bottom:25px ;">Add Product</h4>
      <hr>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" style="box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
        <div class="mb-3 row">
          <label for="inputProductname" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputProductname" name="inputProductname" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputProductdetails" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="inputProductdetails" name="inputProductdetails" rows="5" required></textarea>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputProductSprice" class="col-sm-2 col-form-label">Per Unit Sale Price</label>
          <div class="col-sm-10">
            <input class="form-control" type="number" min="1" max="9999999999" id="inputProductSprice" name="inputProductSprice" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputProductCprice" class="col-sm-2 col-form-label">Per Unit Cost Price</label>
          <div class="col-sm-10">
            <input class="form-control" type="number" min="1" max="9999999999" id="inputProductCprice" name="inputProductCprice" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputProductvat" class="col-sm-2 col-form-label">VAT %</label>
          <div class="col-sm-10">
            <input class="form-control" type="number" min="1" max="9999999999" id="inputProductvat" name="inputProductvat" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputProductimg" class="col-sm-2 col-form-label">Image</label>
          <div class="col-sm-10">
            <input class="form-control" type="file" id="inputProductimg" name="inputProductimg" accept="image/*" required>
            <!-- <input class="form-control" type="number" min="1" max="9999999999" id="inputProductimg" name="inputProductimg"> -->
          </div>
        </div>
        <div class="mb-3 row">
          <label for="inputProductcat" class="col-sm-2 col-form-label">Category</label>
          <div class="col-sm-10">
            <select class="form-control" id="inputProductcat" name="inputProductcat">
              <option disabled="" selected="" hidden="">Select Category</option>
              <?php
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['cname'] . '</option>';
                // print_r($row);
              }
            }
            $sql = "SELECT id,vname FROM csms_Vendor;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
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
          <label for="inputProductvendor" class="col-sm-2 col-form-label">Vendor</label>
          <div class="col-sm-10">
            <select class="form-control" id="inputProductvendor" name="inputProductvendor">
              <option disabled="" selected="" hidden="">Select Vendor</option>
            <?php
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['vname'] . '</option>';
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
          <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <select class="form-select" aria-label="Default select" id="inputStatus" name="inputStatus">
              <!-- <option selected>Click here</option> -->
              <option value="active" selected>Active</option>
              <option value="iactive">Deactive</option>
            </select>
            <!-- <input type="password" class="form-control" id="inputPassword" name="inputPassword"> -->
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
// elseif(isset($_POST['sbutton']) && !empty($_POST['inputProductname']) && !empty($_POST['inputProductdetails']) && !empty($_POST['inputProductprice']) && !empty($_POST['inputProductcat']) && !empty($_POST['inputProductvendor']) && !empty($_POST['inputProductquantity']) && !empty($_POST['inputStatus']))
elseif(isset($_POST['sbutton']) && !empty($_POST['inputProductname']) && !empty($_POST['inputProductdetails']) && !empty($_POST['inputProductSprice']) && !empty($_POST['inputProductCprice']) && !empty($_POST['inputProductvat']) && !empty($_POST['inputProductcat']) && !empty($_POST['inputProductvendor']) && !empty($_POST['inputStatus']) && !empty($_FILES["inputProductimg"]["name"]))// elseif(isset($_POST))
{
  // 
  // print_r($_FILES["inputProductimg"]);die();
  if ($_POST['inputStatus'] == 'active') $status = 1;
  if ($_POST['inputStatus'] == 'iactive') $status = 0;
  $targetDir = "uploads/";
  $fileName = basename($_FILES["inputProductimg"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  // echo '<pre>';print_r($_POST);echo '</pre>';die();
  if (!move_uploaded_file($_FILES["inputProductimg"]["tmp_name"], $targetFilePath)) {
    // 
    echo "Sorry, there was an error when uploading your file.";
    die();
  }
  // else
  // {
  //   echo "Sorry, there was an error when uploading your file.";
  //   die();
  // }
  $sql = "INSERT INTO csms_Product (pname,pdescription,psprice,pcprice,pvat,pimg,pcid,pvid,pqstock,pstatus) VALUES ('" . $_POST['inputProductname'] . "','" . $_POST['inputProductdetails'] . "','" . $_POST['inputProductSprice'] . "','" . $_POST['inputProductCprice'] . "','" . $_POST['inputProductvat'] . "','" . $fileName . "','" . $_POST['inputProductcat'] . "','" . $_POST['inputProductvendor'] . "','" . $_POST['inputProductquantity'] . "','" . $status . "');";
  
 
  // die($sql);
  $result = $conn->query($sql);
  ?>
    <script>
      window.location.href = 'products.php';
    </script>
  <?php

} else { ?>
    <script>
      window.location.href = 'products.php';
    </script><?php
              // echo 'not working';
              // header('Location:dashboard.php');
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