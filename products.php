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
<h4 class="normal-text">Products <a href="product.php?action=add" class="logout-button" style="width: 20%;text-decoration: none;"><i class="fa-solid fa-plus"></i> Add product</a></h4> 

<?php
  $sql = "SELECT * FROM csms_Product order by id desc;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
?>
<div class="card-body" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Product Image</th>

                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                  
                        // 
                        while($row = $result->fetch_assoc())
                        {$row['pvat'];
                            // 
                            $csql = "SELECT cname FROM csms_Category WHERE id='".$row['pcid']."';";
                            // print_r($row);die();
                            // die($csql);
                            $cresult = $conn->query($csql);
                            $cobj = $cresult -> fetch_object();
                        ?>
                        <tr class="table-data">
                        <?php
                            echo '<td>'. $row['pname'] .'</td>';
                            echo '<td> <img src=./uploads/'  .$row['pimg'].    ' width=175 height=150> </td>';
                            echo '<td>'. $cobj->cname .'</td>';
                            echo  "<td>"; if($row['pstatus'] == '1'){$status = 'Active';}else{$status = 'Deactive';}echo $status; echo "</td>";
                            // echo '<td>'. $row['LAST_NAME'].'</td>';
                            echo '<td align="center">
                            <div class="btn-groups" role="group">
                            <a type="button" class="editbutton" href="product.php?action=edit&id='.$row['id'] . '"><i class="fas fa-fw fa-edit"></i></a>
                            <a type="button" class="deletebutton"   style="padding: "href="product.php?action=delete&id='.$row['id'] . '"><i class="fa fa-trash"></i> </a>
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
<?php 
include 'footer.php';
?>