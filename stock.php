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
  <strong>Product has been successfully deleted!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    elseif(!empty($_GET['action']) && $_GET['action'] =='updated')
    {
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Product has been successfully updated!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    elseif(!empty($_GET['action']) && $_GET['action'] =='added')
    {
        // 
    // }
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Product has been successfully added!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
?>
<h4 class="normal-text" style="text-align:center">Stock Balance</h4> 
<hr>
<?php    $sql = "select pname, psprice, pcprice, pcid, pvid, pqstock FROM csms_Product ORDER BY pqstock ASC;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    { ?>
<div class="card-body">
              <div class="table-responsive" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >        
                  <thead>
                      <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Vendor</th>
                        <th>Sale Price</th>
                        <th>Purchase Price</th>
                        <th>On Hand</th>
                        <!-- <th>Phone Number</th> -->
                        <!-- <th>Action</th> -->
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                 
                        // 
                        while($row = $result->fetch_assoc())
                        {
                            // 
                            $csql = "SELECT cname FROM csms_Category WHERE id='".$row['pcid']."';";
                            // print_r($row);die();
                            // die($csql);
                            $cresult = $conn->query($csql);
                            $cobj = $cresult -> fetch_object();
                            $vsql = "SELECT vname FROM csms_Vendor WHERE id='".$row['pvid']."';";
                            // print_r($row);die();
                            // die($csql);
                            $vresult = $conn->query($vsql);
                            $vobj = $vresult -> fetch_object();
                         ?>
                         <tr class="table-data">
                          <?php
                            echo '<td>'. $row['pname'] .'</td>';
                            echo '<td>'. $cobj->cname .'</td>';
                            echo '<td>'. $vobj->vname .'</td>';
                            echo '<td>'. $row['psprice'] .'</td>';
                            echo '<td>'. $row['pcprice'] .'</td>';
                            if($row['pqstock'] > 0)
                            {
                              // echo '<td><span class="badge text-bg-info">'. $row['pqstock'] .'</td></span>';
                              echo '<td>'. $row['pqstock'] .'</td>';
                            }
                            else
                            {
                              // 
                              echo '<td><span class="badge text-bg-warning">Out of Stock</span></td>';
                            }
                            // echo '<td>'. $row['pqstock'] .'</td>';
                            // echo  "<td>"; if($row['pstatus'] == '1'){$status = 'Active';}else{$status = 'Not active';}echo $status; echo "</td>";
                            // echo '<td>'. $row['LAST_NAME'].'</td>';
                            // echo '<td align="center">
                            // <div class="btn-groups" role="group">
                            // <a type="button" class="btn btn-success" href="product.php?action=edit&id='.$row['id'] . '"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            // <a type="button" class="btn btn-danger" href="product.php?action=delete&id='.$row['id'] . '"><i class="fa fa-trash"></i> Delete</a>
                            // </div></td>';
                           ?>
                           
                           </tr><?php
                        }
                    }
                    else
                    {
                        // 
                        // echo "<tr><td>0</td><td>0</td><td>0</td></tr>";
                        ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
  <strong>No products found!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                <?php    }
                    ?>
                  </tbody>
                </table>
              </div>
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