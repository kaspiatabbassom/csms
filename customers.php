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
  <strong>Customer has been successfully deleted!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    elseif(!empty($_GET['action']) && $_GET['action'] =='updated')
    {
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Customer has been successfully updated!</strong>
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
  <strong>Customer has been successfully added!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
?>
<h4 class="m-2 normal-text">Customers <a class="logout-button" style="width:20% ;text-decoration: none;" href="customer.php?action=add"><i class="fa fa-user-plus"></i> Add customer</a></h4>

<?php    $sql = "select id, cname, cemail, cnumber, caddr1, ccity, cstate, ccountry, czcode, ustatus FROM csms_Users order by id desc;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {?>
<div class="card-body">
              <div class="table-responsive" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr class="">
                        <th>Name</th>
                        <!-- <th>Email</th> -->
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip Code</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                 
                        // 
                        while($row = $result->fetch_assoc())
                        {
                            // 
                     ?>
                     
                     <tr class="table-data"><?php
                     
                  

                            echo '<td>'. $row['cname'] .'</td>';
                            // echo '<td>'. $row['cemail'] .'</td>';
                            echo '<td>'. $row['cnumber'] .'</td>';
                            echo '<td>'. $row['caddr1'] .'</td>';
                            echo '<td>'. $row['ccity'] .'</td>';
                            echo '<td>'. $row['cstate'] .'</td>';
                            echo '<td>'. $row['czcode'] .'</td>';
                            echo '<td>'. $row['ccountry'] .'</td>';
                            echo  "<td>"; if($row['ustatus'] == '1'){$status = 'Active';}else{$status = 'De-active';}echo $status; echo "</td>";
                            // echo '<td>'. $row['LAST_NAME'].'</td>';
                            echo '<td align="center">
                            <div class="btn-groups" role="group">
                            <a type="button" class="editbutton" href="customer.php?action=edit&id='.$row['id'] . '"><i class="fas fa-fw fa-edit"></i> </a>

                            </div></td>';
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
  <strong>No customers found!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                <?php    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
</div>
<?php 
include ('footer.php');
?>


<!-- <a type="button" class="deletebutton" id="delete" href="customer.php?action=delete&id='.$row['id'] . '"><i class="fa fa-trash"></i></a> -->