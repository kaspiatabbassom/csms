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
$sql = "SELECT * FROM csms_product;";
$vresult = $conn->query($sql);

$array = array();
if ($vresult->num_rows > 0) {
    while ($row = $vresult->fetch_assoc()) {
        $array[] = $row;
    }
} else {
    echo "No product";
}

//get customer
$sqlc = "SELECT * FROM csms_users;";          //cname
$vresult = $conn->query($sqlc);

$carray = array();
if ($vresult->num_rows > 0) {
    while ($row = $vresult->fetch_assoc()) {
        $carray[] = $row;
    }
} else {
    echo "No customer";
}

if (isset($_POST['nextbutton']) || !empty($_POST['pid']) || !empty($_POST['cid']) || !empty($_POST['quantity']) ||!empty($_POST['price'])) {
    $cid = $_POST['cid'];
    $pid = $_POST['pid'];
    $qty=$_POST['quantity'];
    $price=$_POST['price'];
    $repair_price=$qty*$price;
    $currentDate = date("d-m-y h:i:s");
    $repairinsert = "INSERT INTO csms_services (pid,pquantity,cid,repair_price,repair_date,repaired) VALUES ('".$pid."', '".$qty."', '".$cid."','".$repair_price."','".$currentDate."',1);";
    $serviceRepairInsert = $conn->query($repairinsert);

?>
    <script>
    window.location.href = 'AllRepair.php?action=added';
  </script>

<?php
}


?>
    <div class="container">
        <h4 class="normal-text" style="text-align: center;">Repair Product Details</h4>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
            <input type="hidden" name="cid" value="<?php #echo $_GET['id'];
                                                    ?>">
            <div class="mb-3 row">
                <label for="inputCategory" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10" class="retproductname">
                    <label for="inputProductpdate" class="col-sm-2 col-form-label">Product Name</label>
                    <select class="form-control select1" style="  margin-top: 13px;
  font-size: 16px; width:98%;
  margin-bottom: 20px;height:50px" id="" name="pid" required="" oninvalid="this.setCustomValidity('please select product name ')" oninput="setCustomValidity('')">
                        <?php

                        ?>
                        <!-- <select name="category" id=""> -->
                        <option value="">Product Name</option>
                        <?php foreach ($array as $arrdata) {
                        ?>

                            <option value="<?php echo $arrdata['id'] ?>"><?php echo $arrdata['pname'] ?></option>


                        <?php

                        }   ?>





                    </select>
                </div>

                <div class="col-sm-10" class="retproductname">
                    <label for="inputProductpdate" class="col-sm-2 col-form-label">Customer Name</label>
                    <select class="form-control select1" style="  margin-top: 13px;
font-size: 16px;width:98%;
margin-bottom: 20px;height:50px" id="" name="cid" required="" oninvalid="this.setCustomValidity('please select customer name ')" oninput="setCustomValidity('')">
                        <?php

                        ?>
                        <!-- <select name="category" id=""> -->
                        <option value="">Customer Name</option>
                        <?php foreach ($carray as $arrdata) {
                        ?>

                            <option value="<?php echo $arrdata['id'] ?>"><?php echo $arrdata['cname'] ?></option>


                        <?php

                        }   ?>





                    </select>
                </div>


                <div class="mb-3 row">
                    <label for="inputProductpdate" class="col-sm-2 col-form-label">Product Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" min="1" max="" id="quanity" name="quantity" placeholder="Enter quantity" required>
                        <div class="invalid-feedback">Repair quanitiy is required!!</div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputProductpdate" class="col-sm-2 col-form-label">Repair Price(per unit)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" min="1"  id="" name="price" placeholder="Enter Price(per unit)" required>
                        <div class="invalid-feedback">Price is required!!</div>
                    </div>
                </div>



            </div>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="submit" class="purchase-submit" style="width: 30%;" name="nextbutton"><i class="fa fa-edit fa-fw"></i>Next</button>
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
            </div>
        </form>
    </div>




<script>
    var loadFile = function(event) {
        var picture = document.getElementById('output');
        picture.src = URL.createObjectURL(event.target.files[0]);

        var icon = document.getElementById("icon").style.display = "none";
    };
</script>