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
?>
<!-- for customer -->
<?php

$sql6 = "SELECT id FROM csms_orders;";   //order id

$oresult = $conn->query($sql6);

$oarray = array();
if ($vresult->num_rows > 0) {

    while ($row = $oresult->fetch_assoc()) {
       
        $oarray[] = $row;
    }

} else {
    echo "No Order!!";
}





$sql = "SELECT * FROM csms_users;";          //cname
$vresult = $conn->query($sql);

$carray = array();
if ($vresult->num_rows > 0) {
    while ($row = $vresult->fetch_assoc()) {
        $carray[] = $row;
    }
} else {
    echo "No customer";
}
?>



<?php
if (isset($_POST['nextbutton']) || !empty($_POST['pid']) || !empty($_POST['cid']) || !empty($_POST['oid'])) {
    $cid = $_POST['cid'];
    $pid = $_POST['pid'];
    $oid= $_POST['oid'];

$count=1;
$real=0;
    $quantity = $_POST['quanity'];
    $quan=0;


 




    $sql3 = "SELECT * from csms_orders WHERE ocid='$cid' AND opid='$pid'";



    $oresult = $conn->query($sql3);

    if ($oresult->num_rows == 0) {
        $count=0;
?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>This customer didnot purchase this product!!</strong>
            
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    <?php
    }


//check order id
if($count==1){
$sql8 = "SELECT * from csms_orders WHERE ocid='$cid' AND opid='$pid' AND id='$oid'";

$oidResult=$conn->query($sql8);
if ($oidResult->num_rows == 0) {
$count=0;
    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Order Id doesnot match!!</strong>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
            </div>
        <?php
        }

   }




if($count==1){
    // checl customer buy this minimum product
    $sql4 = "SELECT * from csms_orders WHERE ocid='$cid' AND opid='$pid' AND id='$oid'";




    $qresult = $conn->query($sql4);

    if ($qresult->num_rows > 0) {
        $real=1;
        while ($row = $qresult->fetch_assoc()) {
            $quan = $row['oquantity'];
        }
    }
    // echo "select:" .$quantity;
    // echo  "ahce:". $quan;
}
if($quantity>$quan && $real==1){


    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>This customer purchased <?php echo $quan?> product(s)!!Please select equal to or below the quantity of this purchased product</strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
<?php
}
if($quantity<=$quan && $real==1){
// insert order service table
        $currentDate = date("d-m-y h:i:s");
        $sqlinsert = "INSERT INTO csms_services (pid,pquantity,cid,oid,return_date) VALUES ('".$pid."', '".$quantity."', '".$cid."','".$oid."','".$currentDate."');";
        $serviceReturnInsert = $conn->query($sqlinsert);

        // update stock in product table

       $sqlstockQuantity="SELECT * from csms_product where id='$pid'";
       $sqResult=$conn->query($sqlstockQuantity);
       if ($sqResult->num_rows > 0) {
       
        while ($row = $sqResult->fetch_assoc()) {

          $stockProduct = $row['pqstock'];
          echo $stockProduct;
      
        }
    }
        $stockupdate = "UPDATE  csms_product set pqstock =$quantity+$stockProduct WHERE id='$pid';";
      
        $qresult = $conn->query($stockupdate);

 // update order in order table

 $orderedQty="SELECT * from csms_orders where id='$oid'";
 $orderedProduct=$conn->query($orderedQty);
 if ($orderedProduct->num_rows > 0) {
 
  while ($row = $orderedProduct->fetch_assoc()) {

    $orderProductQty = $row['oquantity'];
  

  }
}
  $orderQtyUpdate = "UPDATE  csms_orders set oquantity =$orderProductQty-$quantity WHERE id='$oid';";

  $updateOrderqty = $conn->query($orderQtyUpdate);


?>
    
        <script>
      window.location.href = 'AllReturn.php?action=added';
    </script>
 <?php   }   








}

?>





<?php
// if (!empty($array)) {
?>
    <div class="container">
        <h4 class="normal-text" style="text-align: center;">Return Product Details</h4>
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
                    <label for="inputProductpdate" class="col-sm-2 col-form-label">Order ID</label>
                    <select class="form-control select1" style="  margin-top: 13px;
font-size: 16px;width:98%;
margin-bottom: 20px;height:50px" id="" name="oid" required oninvalid="this.setCustomValidity('please select customer name ')" oninput="setCustomValidity('')">
                        <?php

                        ?>
                        <!-- <select name="category" id=""> -->
                        <option value="">Order ID</option>
                        <?php foreach ($oarray as $arrdata) {
                        ?>

                            <option value="<?php echo $arrdata['id'] ?>"><?php echo $arrdata['id'] ?></option>


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
                        <input type="number" class="form-control" min="1" max="999999" id="quanity" name="quanity" placeholder="Enter quantity" required>
                        <div class="invalid-feedback">Return quanitiy is required!!</div>
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
<?php 
//}

// else {
// ?>
<!-- //     <div class="display-nothing" style=" "> -->
        <?php
//         echo "No products!";
//         ?>


     <!-- </div> -->

<?php
//}
?>
<script>
    var loadFile = function(event) {
        var picture = document.getElementById('output');
        picture.src = URL.createObjectURL(event.target.files[0]);

        var icon = document.getElementById("icon").style.display = "none";
    };
</script>