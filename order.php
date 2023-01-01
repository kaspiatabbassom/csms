<?php
include('db.php');
session_start();
if (empty($_SESSION['username'])) {
    header('Location:login.php');
}
?>
<?php
include ('header.php');
?>

<?php
if (!empty($_GET['action']) && $_GET['action'] == 'cancel' && !empty($_GET['id'])) {
    // echo 'working';
    // $sql = "DELETE FROM csms_Product WHERE id = ".$_GET['id'].";";
    // $result = $conn->query($sql);
    // if($result)
    // {
    //     // 
    //     header('Location:products.php?action=deleted');
    // }
    // else
    // {
    //     // 
    //     header('Location:customers.php?action=notdeleted');
    // }
} elseif (!empty($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
    // echo 'not working';
    // $sql = "SELECT pname,pdescription,pprice,pqstock FROM csms_Product WHERE id = ".$_GET['id'].";";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0)
    // {
    //     //
    //     $row = $result -> fetch_row();
    //     // print_r($row);
    //     // die();
    // }
    die();

    ?>
    <div class="container">
        <h4 class="m-2 font-weight-bold text-primary text-center">Edit Product</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
            <div class="mb-3 row">
                <label for="inputProductname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputProductname" name="inputProductname"
                           value="<?php echo $row['0'] ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputProductdetails" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputProductdetails" name="inputProductdetails"
                              rows="5"><?php echo $row['1'] ?></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputProductprice" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" min="1" max="9999999999" id="inputProductprice"
                           name="inputProductprice" value="<?php echo $row['2'] ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputProductquantity" class="col-sm-2 col-form-label">On Hand</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" min="1" max="9999999999" id="inputProductquantity"
                           name="inputProductquantity" value="<?php echo $row['3'] ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select" id="inputStatus" name="inputStatus">
                        <!-- <option selected>Click here</option> -->
                        <option value="active" selected>Active</option>
                        <option value="iactive">Not active</option>
                    </select>
                    <!-- <input type="password" class="form-control" id="inputPassword" name="inputPassword"> -->
                </div>
            </div>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="submit" class="btn btn-success btn-block" name="sbutton"><i class="fa fa-edit fa-fw"></i>Update
                </button>
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
} elseif (isset($_POST['sbutton']) && !empty($_POST['pid']) && !empty($_POST['inputProductname']) && !empty($_POST['inputProductdetails']) && !empty($_POST['inputProductprice']) && !empty($_POST['inputProductquantity']) && !empty($_POST['inputStatus'])) // elseif(isset($_POST['sbutton']))
{
    // 
    if ($_POST['inputStatus'] == 'active') $status = 1;
    if ($_POST['inputStatus'] == 'iactive') $status = 0;
    // print_r($_POST);
    $sql = "UPDATE csms_Product SET pname = '" . $_POST['inputProductname'] . "', pdescription = '" . $_POST['inputProductdetails'] . "', pprice = '" . $_POST['inputProductprice'] . "', pqstock = '" . $_POST['inputProductquantity'] . "', pstatus = '" . $status . "' WHERE id = " . $_POST['pid'] . ";";
    $result = $conn->query($sql);
    header('Location:products.php?action=updated');
} elseif (!empty($_GET['action']) && $_GET['action'] == 'new') {
    // 
    $sql = "SELECT id,cname FROM csms_Users;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // 
        //     $row = $result -> fetch_row();
        //     print_r($row);die();
        // }
        ?>
        <div class="container">
        <h4 class="normal-text" style="text-align: center;">New Order</h4>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
        <label for="inputCustomerid" class="col-sm-2 col-form-label">Customer</label>
        <div class="col-sm-10">
        <select class="form-control" id="inputCustomerid" name="inputCustomerid">
        <option disabled="" selected="" hidden="">Select Customer</option>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['cname'] . '</option>';
            // print_r($row);
        }
    }
    $sql = "SELECT * FROM csms_Product WHERE pqstock > 0;";
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
    <!-- <select onchange="this.form.submit()" class="form-control" id="inputProductid" name="inputProductid"> -->
    <select class="form-control" id="inputProductid" name="inputProductid">
    <option disabled="" selected="" hidden="">Select Product</option>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['pname'] . '</option>';
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
    <?php
    // if(isset($_POST['inputProductid']))
    // {
    //   //
    //   print_r($_POST['inputProductid']);die();
    // }
    ?>
    <!-- <div class="mb-3 row">
      <label for="inputProductquantity" class="col-sm-2 col-form-label">Quantity</label>
      <div class="col-sm-10">
          <input class="form-control" type="number" min="1" max="9999999999" id="inputProductquantity" name="inputProductquantity">
      </div>
    </div> -->
    <!-- <div class="mb-3 row">
      <label for="inputProductprice" class="col-sm-2 col-form-label">Price</label>
      <div class="col-sm-10">
          <input class="form-control" type="number" min="1" max="9999999999" id="inputProductprice" name="inputProductprice">
      </div>
    </div> -->

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
        <button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton">Next <i
                    class="fa-solid fa-arrow-right"></i></button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
    </div>
    </form>
    </div>
    <?php
} elseif (isset($_POST['sbutton']) && !empty($_POST['inputCustomerid']) && !empty($_POST['inputProductid'])) {
    //
    $_SESSION['cart'] = array('customer' => $_POST['inputCustomerid'], 'product' => $_POST['inputProductid']);

    ?>

<script>
window.location.href = 'order.php?action=step1';
</script>
    <?php
  //  header('Location:order.php?action=step1');
} elseif (!empty($_GET['action']) && $_GET['action'] == 'step1') {
    //
    $sql = "SELECT * FROM csms_Product WHERE id = " . $_SESSION['cart']['product']. ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // 
        $row = $result->fetch_row();
        // print_r($row);
        // die();
    }
    // print_r($_SESSION['cart']);die();
    ?>
    <div class="container">
        <h4 class="normal-text" style="text-align: center;">New Order</h4>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
            <div class="card mb-3">
                <div class="card-header">
                    <!-- Featured -->
                    <h5 class="card-title"><?php echo $row['1'];
                        $_SESSION['cart']['ptitle'] = $row['1']; ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $row['1'];
                        $_SESSION['cart']['pdesc'] = $row['1']; ?></p>
                    <span class="badge text-bg-dark">Stock : <?php echo $row['9'] ?></span>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
                <div class="card-footer">
                    <h6 class="card-title">Price : <?php echo $row['3'];
                        $_SESSION['cart']['price'] = $row['3']; ?></h6>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputProductquantity" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" min="1" max="<?php echo $row['9'] ?>" id="inputProductquantity"
                           name="inputProductquantity">
                </div>
            </div>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton">Next <i
                            class="fa-solid fa-arrow-right"></i></button>
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
            </div>
        </form>
    </div>
    <?php
// print_r($_SESSION['cart']);die();
} elseif (isset($_POST['sbutton']) && !empty($_POST['inputProductquantity'])) {

    print $_SESSION['cart']['tprice'];
    $_SESSION['cart']['quantity'] = $_POST['inputProductquantity'];
    $_SESSION['cart']['tprice'] = $_SESSION['cart']['price'] * $_SESSION['cart']['quantity'];
    ?>
      <script>
window.location.href = 'order.php?action=step2';
</script>
    
    <?php
  //  header('Location:order.php?action=step2');
} elseif (!empty($_GET['action']) && $_GET['action'] == 'step2') {
    //
    $sql = "SELECT * FROM csms_Users WHERE id = " . $_SESSION['cart']['customer'] . ";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // 
        $row = $result->fetch_row();
        // print_r($row);
        // die();
    }
    ?>
    <div class="container">
        <h4 class="normal-text" style="text-align: center;">Overview</h4>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
            <input type="hidden" name="cid" value="<?php echo $_SESSION['cart']['customer']; ?>">
            <div class="card mb-3">
                <div class="card-header">
                    <!-- Featured -->
                    <h5 class="card-title py-1">Customer</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Name : <?php echo $row['1']; ?></p>
                    <p class="card-text">Email : <?php echo $row['2']; ?></p>
                    <p class="card-text">Phone : <?php echo $row['3']; ?></p>
                    <p class="card-text"><?php echo $row['4']; ?></p>
                    <!-- <span class="badge text-bg-dark">Stock : </span> -->
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
                <!-- <div class="card-footer">
                  <h6 class="card-title">Price : </h6>
                </div> -->
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <!-- Featured -->
                    <h5 class="card-title py-1">Product</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $_SESSION['cart']['ptitle']; ?></p>

                    <!-- <span class="badge text-bg-dark">Stock : </span> -->
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
                <!-- <div class="card-footer">
                  <h6 class="card-title">Price : </h6>
                </div> -->
            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Quantity
                                <span><?php echo $_SESSION['cart']['quantity'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Price
                                <span><?php echo $_SESSION['cart']['price'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                    <strong>
<!--                                        <p class="mb-0">(including VAT)</p>-->
                                    </strong>
                                </div>
                                <span><strong><?php echo $_SESSION['cart']['tprice'] ?></strong></span>
                            </li>
                        </ul>

                        <!-- <button type="button" class="btn btn-primary btn-lg btn-block">
                          Go to checkout
                        </button> -->
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="submit" class="purchase-submit" style="width:30%" name="sbutton">Confirm Order <i
                            class="fa-solid fa-arrow-right"></i></button>
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
            </div>
        </form>
    </div>
    <?php
    // print_r($_SESSION);die();
}
// elseif(isset($_POST['inputProductid']))
//   {
//     // 
//     print_r($_POST['inputProductid']);die();
//   }
// elseif(isset($_POST['sbutton']) && !empty($_POST['inputCustomerid']) && !empty($_POST['inputProductid']) && !empty($_POST['inputProductquantity']))
elseif (isset($_POST['sbutton']) && !empty($_POST['cid'])) // elseif(isset($_POST))
{
    // 
    if ($_POST['cid'] == $_SESSION['cart']['customer']) {
        //
        $sql = "INSERT INTO csms_Orders (ocid,opid,oquantity) VALUES ('" . $_SESSION['cart']['customer'] . "','" . $_SESSION['cart']['product'] . "','" . $_SESSION['cart']['quantity'] . "');";
        $result = $conn->query($sql);
        $gpssql = "SELECT pqstock FROM csms_Product WHERE id='" . $_SESSION['cart']['product'] . "';";
        // die($sql);
        $gpsresult = $conn->query($gpssql);
        $gpsobj = $gpsresult->fetch_object();
        $nps = $gpsobj->pqstock - $_SESSION['cart']['quantity'];
        // die($gpsobj->pqstock);
        $upssql = "UPDATE csms_Product SET pqstock = '" . $nps . "' WHERE id = '" . $_SESSION['cart']['product'] . "';";
        // die($sql);
        $upsresult = $conn->query($upssql);
        // $upsobj = $upsresult -> fetch_object();
        ?>
          <script>
window.location.href = 'orders.php';
</script>
        
        <?php
        //header('Location:orders.php?action=complete');
    }
     print_r($_POST);die();
     if($_POST['inputStatus'] == 'active') $status = 1;
     if($_POST['inputStatus'] == 'iactive') $status = 0;
     $sql = "INSERT INTO csms_Orders (ocid,opid,oquantity) VALUES ('".$_POST['inputCustomerid']."','".$_POST['inputProductid']."','".$_POST['inputProductquantity']."');";
     // die($sql);
     $result = $conn->query($sql);
     $gpssql = "SELECT pqstock FROM csms_Product WHERE id='".$_POST['inputProductid']."';";
     // die($sql);
     $gpsresult = $conn->query($gpssql);
     $gpsobj = $gpsresult -> fetch_object();
     $nps = $gpsobj->pqstock - $_POST['inputProductquantity'];
     // die($gpsobj->pqstock);
     $upssql = "UPDATE csms_Product SET pqstock = '".$nps."' WHERE id = '".$_POST['inputProductid']."';";
     // die($sql);
     $upsresult = $conn->query($upssql);
     // $upsobj = $upsresult -> fetch_object();


    // header('Location:orders.php?action=complete');
} else {
    // echo 'not working';
    header('Location:dashboard.php');
}

?>

<div class="container">
    <footer class="py-3 my-4">
        <div class="justify-content-center border-bottom pb-3 mb-3"></div>
        <p class="text-center text-muted">&copy; CSMS 2022</p>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>