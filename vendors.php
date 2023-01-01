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
  <strong>Vendor has been successfully deleted!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    elseif(!empty($_GET['action']) && $_GET['action'] =='updated')
    {
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Vendor has been successfully updated!</strong>
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
  <strong>Vendor has been successfully added!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
?>
<h4 class="normal-text ">Vendors <a class="logout-button" href="vendor.php?action=add" style="width: 20%;text-decoration: none;"><i class="fa-solid fa-plus"></i> Add vendor</a></h4>
<?php    $sql = "select id, vname, vaddress, vmobile, vemail FROM csms_Vendor order by id desc;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0)
                    {?>
<div class="card-body">
              <div class="table-responsive" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
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
                       <tr class="table-data">
                       <?php
                            echo '<td>'. $row['vname'] .'</td>';
                            echo '<td>'. $row['vaddress'] .'</td>';
                            echo '<td>'. $row['vmobile'] .'</td>';
                            echo '<td>'. $row['vemail'] .'</td>';
                            // echo  "<td>"; if($row['ustatus'] == '1'){$status = 'Active';}else{$status = 'Not active';}echo $status; echo "</td>";
                            // echo '<td>'. $row['LAST_NAME'].'</td>';
                            echo '<td align="center">
                            <div class="btn-groups" role="group">
                            <a type="button" class="editbutton" href="vendor.php?action=edit&id='.$row['id'] . '"><i class="fas fa-fw fa-edit"></i> </a>
                            <a type="button" class="deletebutton" href="vendor.php?action=delete&id='.$row['id'] . '"><i class="fa fa-trash"></i> </a>
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
  <strong>No vendors found!</strong>
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