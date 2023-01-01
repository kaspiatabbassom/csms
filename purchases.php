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
      <strong>Purchase has been successfully deleted!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  } elseif (!empty($_GET['action']) && $_GET['action'] == 'updated') {
  ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Purchase has been successfully updated!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  } elseif (!empty($_GET['action']) && $_GET['action'] == 'added') {
    // 
    // }
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Purchase has been successfully added!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  ?>
  <h4 class="normal-text">Purchases History <a class="logout-button" style="width: 20%;text-decoration: none;" href="purchase.php?action=add"><i class="fa-solid fa-plus"></i> Add Purchase</a></h4>
  <?php $sql = "select id, pvid, pid, pstock, vprice, pdate FROM csms_Purchases order by id desc;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { ?>

    <div class="card-body" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Purchase ID</th>
              <th>Vendor</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Date</th>
              <!-- <th>Information</th> -->
              <!-- <th>Phone Number</th> -->
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php

            // 
            while ($row = $result->fetch_assoc()) {
              // 
              $vsql = "SELECT vname FROM csms_Vendor WHERE id='" . $row['pvid'] . "';";
              // 
              $vresult = $conn->query($vsql);
              $vobj = $vresult->fetch_object();
              $psql = "SELECT pname FROM csms_Product WHERE id='" . $row['pid'] . "';";
              // 
              $presult = $conn->query($psql);
              $pobj = $presult->fetch_object();
            ?>
              <tr class="table-data"><?php
                                      echo '<td>' . $row['id'] . '</td>';
                                      echo '<td>' . $vobj->vname . '</td>';
                                      echo '<td>' . $pobj->pname . '</td>';
                                      echo '<td>' . $row['pstock'] . '</td>';
                                      echo '<td>' . $row['vprice'] . '</td>';
                                      echo '<td>' . $row['pdate'] . '</td>';
                                      // echo  "<td>"; if($row['pstatus'] == '1'){$status = 'Active';}else{$status = 'Not active';}echo $status; echo "</td>";
                                      // echo '<td>'. $row['LAST_NAME'].'</td>';
                                      echo '<td align="center">
                            <div class="btn-groups" role="group">
                            <a type="button" class="editbutton" href="purchase.php?action=edit&id=' . $row['id'] . '"><i class="fas fa-fw fa-edit"></i> </a>
                            <a type="button" id="delete" class="deletebutton" id="deletealert" href="purchase.php?action=delete&id=' . $row['id'] . '"><i class="fa fa-trash"></i> </a>
                            </div></td>';
                                      ?>
              </tr><?php
                  }
                } else {
                  // 
                  // echo "<tr><td>0</td><td>0</td><td>0</td></tr>";
                    ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
              <strong>No purchase history found!</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php    }
          ?>
          </tbody>
        </table>
      </div>
    </div>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script> -->
<!-- <script>


  function ConfirmDelete() {
    var x = confirm("Are you sure you want to delete?");
    if (x)
      return true;
    else
      return false;
  }
</script> -->

<script>
      function ConfirmDelete()
{
  var x = confirm("Are you sure you want to delete?");
  if (x)
      return true;
  else
    return false;
}
</script>

<?php include 'footer.php'?>