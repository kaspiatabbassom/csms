<?php
include('db.php');
session_start();
if(empty($_SESSION['username']))
{
    header('Location:login.php');
}
?>
<?php
include('header.php');
?>
</div>
<?php
if(!empty($_GET['action']) && $_GET['action'] =='delete' && !empty($_GET['id']))
{
    // echo 'working';
    $sql = "DELETE FROM csms_Category WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if($result)
    {
        // 
        ?>
         <script>
window.location.href = 'categories.php';
</script>
        <?php
     //   header('Location:categories.php?action=deleted');
    }
    // else
    // {
    //     // 
    //     header('Location:customers.php?action=notdeleted');
    // }
}
elseif(!empty($_GET['action']) && $_GET['action'] =='edit' && !empty($_GET['id']))
{
    // echo 'not working';
    $sql = "SELECT cname FROM csms_Category WHERE id = ".$_GET['id'].";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // 
        $row = $result -> fetch_row();
        // print_r($row);
    }

?>
<div class="container">
<h4 class="normal-text" style="text-align: center;">Edit Category</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
              <input type="hidden" name="cid" value="<?php echo $_GET['id'];?>">
  <div class="mb-3 row">
    <label for="inputCategory" class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCategory" name="inputCategory" value="<?php echo $row['0']?>">
    </div>
  </div>
<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton"><i class="fa fa-edit fa-fw"></i>Update</button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
      </div>
</form>
</div>
<?php
// if(!empty($_GET['action']) && $_GET['action'] =='edit' && !empty($_GET['id']))
// {
    // echo 'working';
?>

<?php
}
elseif(isset($_POST['sbutton']) && !empty($_POST['cid']) && !empty($_POST['inputCategory']))
// elseif(isset($_POST['sbutton']))
{
    // // 
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    // print_r($_POST);
    $sql = "UPDATE csms_Category SET cname = '".$_POST['inputCategory']."' WHERE id = ".$_POST['cid'].";";
    $result = $conn->query($sql);
    ?>
     <script>
window.location.href = 'categories.php';
</script>
    <?php
   // header('Location:categories.php?action=updated');
}
elseif(!empty($_GET['action']) && $_GET['action'] =='add')
{
    // 
    $sql = "SELECT id, cname FROM csms_Category WHERE parentId IS NULL AND childId IS NULL;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // 
        // $row = $result -> fetch_row();
        // while($row = $result->fetch_assoc())
        // {
        //   print_r($row);
        // }
        // die();
    
?>
<div class="container">
<h4 class="normal-text" style="text-align: center;margin:25px">Add Category</h4>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
<div class="mb-3 row">
    <label for="inputCategory" class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputCategory" name="inputCategory">
    </div>
</div>
<div class="mb-3 row">
<label for="inputSubcategory" class="col-sm-2 col-form-label">Subcategory of</label>
<div class="col-sm-10">
  <select class="form-select" name="inputSubcategory">
    <option selected>Click and select!</option>
    <?php
    while($row = $result->fetch_assoc())
    {
      echo '<option value="'.$row['id'].'">'.$row['cname'].'</option>';
      // print_r($row);
    }
    }
    // die();
    ?>
    <!-- <option selected>Click and select!</option>
    <option value="1">One</option> -->
  </select>
</div>
<!-- <select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select> -->
</div>
<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
<button type="submit" class="purchase-submit" style="width: 30%;" name="sbutton"><i class="fa-solid fa-plus"></i> Add</button>
        <!-- <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button> -->
      </div>
</form>
</div>
<?php
}
elseif(isset($_POST['sbutton']) && !empty($_POST['inputCategory']))
{
    //
    // print_r($_POST);die(); 
    // if($_POST['inputStatus'] == 'active') $status = 1;
    // if($_POST['inputStatus'] == 'iactive') $status = 0;
    if($_POST['inputSubcategory'] == 'Click and select!')
    {
      // die('empty');
      $sql = "INSERT INTO csms_Category (cname) VALUES ('".$_POST['inputCategory']."');";
    }
    else
    {
      // die('not empty');
      $sql = "INSERT INTO csms_Category (parentId,cname) VALUES ('".$_POST['inputSubcategory']."','".$_POST['inputCategory']."');";
    }
    // $sql = "INSERT INTO csms_Category (parentId,cname) VALUES ('".$_POST['inputSubcategory']."','".$_POST['inputCategory']."');";
    // die($sql);
    $result = $conn->query($sql);
    ?>
     <script>
window.location.href = 'categories.php';
</script>
    
    <?php
   // header('Location:categories.php?action=added');
}
else
{
    // echo 'not working';
    header('Location:dashboard.php');
}

?>
<div class="container">
  <footer class="py-3 my-4">
    <div class="justify-content-center border-bottom pb-3 mb-3"></div>
    <p class="text-center text-muted">&copy; CSMS 2022</p>
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>