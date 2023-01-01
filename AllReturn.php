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
<div class="container">
  <?php
  if (!empty($_GET['action']) && $_GET['action'] == 'deleted') {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Customer has been successfully deleted!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  } elseif (!empty($_GET['action']) && $_GET['action'] == 'updated') {
  ?>

  <?php
  } elseif (!empty($_GET['action']) && $_GET['action'] == 'added') {
    // 
    // }
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Return product is successfully added!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  ?>


  <h4 class="m-2 normal-text">Returned Product <a class="logout-button" style="width:20% ;text-decoration: none;" href="AddReturnProduct.php"><i class="fa-solid fa-plus"></i> Add Product</a></h4>

  <?php

  $sql = "SELECT * from csms_services JOIN csms_users ON csms_services.cid=csms_users.id JOIN csms_product ON csms_services.pid=csms_product.id JOIN csms_orders ON csms_orders.id=csms_services.oid;";
  $result = $conn->query($sql);

  $array = array();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $array[] = $row;
      }
  
  } else {
    //  echo "No product";
  }


  ?>
 
  <div class="card-body">
    <div class="table-responsive" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
    <?php   
  if(!empty($array)){


  
  
  ?>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="">
           
            <!-- <th>Email</th> -->
            <th>Customer Details</th>
            <th>Product Details</th>
            <th>Product Quantity</th>

            <th>Order Date</th>
            <th>Return Date</th>
            <!-- <th>State</th>
                        <th>Zip Code</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach($array as $arrayData){
          ?>
          <tr class="table-data">
            <td>
              <div> Customer ID:<?php echo $arrayData['cid']?></div>
              <div>Customer Name:<?php echo $arrayData['cname']?></div>
           </td>
           <td>
              <div>Product ID:<?php echo $arrayData['pid']?></div>
              <div>Product Name:<?php echo $arrayData['pname']?></div>
           </td>
           <td>
            <?php echo $arrayData['pquantity']?></div>
             
           </td>
            <td><?php echo $arrayData['odate']?></td>
            <td><?php echo $arrayData['return_date']?></td>
          </tr>

          <?php }?>
        </tbody>
        <?php }
        
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
    </div>
  </div>

  <?php

  ?>
</div>
<div class="container">
  <footer class="py-3 my-4">
    <div class="justify-content-center border-bottom pb-3 mb-3"></div>
    <p class="text-center text-muted">&copy; CSMS 2022</p>
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>