<?php
include('db.php');
session_start();

if (empty($_SESSION['username'])) {
    header('Location:login.php');
}
include('header.php');
$profit=0;
if (isset($_POST['search']) || !empty($_POST['start_date']) || !empty($_POST['end_date'])) {
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];
    $sql = "SELECT * FROM `csms_orders` JOIN csms_product ON csms_product.id=csms_orders.opid WHERE csms_orders.odate between '$startDate' AND '$endDate' AND csms_orders.oquantity>0";

    $result = $conn->query($sql);
    $array = array();
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {

           $array[]=$row;
        } 

    }

   
}
?>




<div class="container">
<?php if (!empty($array)) {
  
    ?>
       
    <h4 class="card-title purchase-header">Net Profit</h4>
    <hr>
 
    <table class="table table-hover" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
        <thead>
            <tr>
                <th scope="col" class="">Date</th>
                <th scope="col">Product Name</th>
                <th scope="col">Selling Quantity</th>
                <th scope="col">Purchase Price(Tk)</th>
                <th scope="col">Sale Price(Tk)</th>
                <th scope="col">Profit/Loss</th>
            </tr>
        </thead>
        <tbody>
            <?php 
          
        foreach ($array as $arrData) {
           
  $profit+=( $arrData['psprice']*$arrData['oquantity']-$arrData['pcprice']*$arrData['oquantity']);

            ?> 
            <tr style="text-shadow: center;" class="table-data">
                <th scope="row"><?php echo $arrData['odate']?></th>
                <td><?php echo $arrData['pname']?></td>
                <td><?php echo $arrData['oquantity']?></td>
            
                <td><?php echo $arrData['pcprice']*$arrData['oquantity']?> </td>
                <td><?php echo $arrData['psprice']*$arrData['oquantity']?></td>
                <td><?php echo $arrData['psprice']*$arrData['oquantity']-$arrData['pcprice']*$arrData['oquantity']?></td>
            </tr>



        </tbody>
  
  
        <?php }}
else {
    ?>
                        <div class="display-nothing" style=" ">
                            <?php
echo "No products!";
    ?>


                        </div>

                        <?php
}

?>

</table>
<div class="net-profit">
      Net Profit: <?php echo $profit ?>Tk
    </div>
   
 </div>




 
<?php 
include 'footer.php';

?>