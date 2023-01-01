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

<div class="container">
    <?php
    if(!empty($_GET['action']) && $_GET['action'] =='deleted')
    {
    ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Purchase has been successfully deleted!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    elseif(!empty($_GET['action']) && $_GET['action'] =='updated')
    {
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Purchase has been successfully updated!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    elseif(!empty($_GET['action']) && $_GET['action'] =='complete')
    {
        // 
    // }
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Order has been successfully completed!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
?>
<h4 class="normal-text">Orders History <a class="logout-button" href="order.php?action=new" style="width: 20%;text-decoration: none;"><i class="fa-solid fa-plus"></i> New Order</a></h4> 


<?php

$sql = "select * FROM csms_Orders order by id desc;";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
?>
<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Date & Time</th>
                        <!-- <th>Price</th> -->
                        <!-- <th>Information</th> -->
                        <!-- <th>Phone Number</th> -->
<!--                         <th>Action</th>-->
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                
                        // 
                        while($row = $result->fetch_assoc())
                        {
                            // 
                            $vsql = "SELECT * FROM csms_Users WHERE id='".$row['ocid']."';";
                            // 
                            $vresult = $conn->query($vsql);
                            $vobj = $vresult -> fetch_object();
                            $psql = "SELECT * FROM csms_Product WHERE id='".$row['opid']."';";
                            // 
                            $presult = $conn->query($psql);
                            $pobj = $presult -> fetch_object();
                           ?>
                           <tr class="table-data">
                           <?php
                            echo '<td>'. $row['id'] .'</td>';
                            echo '<td>'. $vobj->cname .'</td>';
                            echo '<td>'. $pobj->pname .'</td>';
                            echo '<td>'. $row['oquantity'] .'</td>';
                            echo '<td>'. $row['odate'] .'</td>';
//                             echo  "<td>"; if($row['pstatus'] == '1'){$status = 'Active';}else{$status = 'Not active';}echo $status; echo "</td>";
//                             echo '<td>'. $row['LAST_NAME'].'</td>';
                             echo '<td align="center">
                             <div class="btn-groups" role="group">
                        <!--    <a type="button" class="btn btn-success" href="order.php?action=edit&id='.$row['id'] . '"><i class="fas fa-fw fa-edit"></i> Edit</a>
                       <a type="button" class="btn btn-warning" href="order.php?action=cancel&id='.$row['id'] . '"><i class="fa-solid fa-ban"></i> Cancel</a> -->
                             </div></td>';
                         ?>
                         </tr>
                         <?php
                        }
                    }
                    else
                    {
                        // 
                        // echo "<tr><td>0</td><td>0</td><td>0</td></tr>";
                        ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
  <strong>No order history found!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                <?php    }
                    ?>
                  </tbody>
                </table>
              </div>
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