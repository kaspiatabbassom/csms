<?php
include('db.php');
session_start();
if (!empty($_SESSION['username'])) {
  // echo '<h1>welcome '.$_SESSION['username'].', to dashboard</h1>';
} else {
  // echo '<h1>not logined!</h1>';
  header('Location:login.php');
}

?>
<?php
include('header.php') ?>
<!-- <table>
  <tr>
    <th>options</th>
    <th>button</th>
  </tr>
  <tr>
    <td>change password</td>
    <td><button type="button" onclick="location.href='changepassword.php';">Click Me!</button></td>
  </tr>
  <tr>
    <td>add user</td>
    <td><button type="button" onclick="location.href='adduser.php';">Click Me!</button></td>
  </tr>
  <tr>
    <td>show all user</td>
    <td><button type="button" onclick="location.href='showuser.php';">Click Me!</button></td>
  </tr>
  <tr>
    <td>add category</td>
    <td><button type="button" onclick="location.href='addcategory.php';">Click Me!</button></td>
  </tr>
  <tr>
    <td>show all category</td>
    <td><button type="button" onclick="location.href='showcategory.php';">Click Me!</button></td>
  </tr>
</table>
<br>
<br>
<button type="button" onclick="location.href='logout.php';">log out</button> -->

  <section class="dashboard">
     <div class="" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);padding:60px"> 
      <div class="box-container">
        <a href="profile.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_superadmin;";

            $result = $conn->query($query);

            // 
            $admin = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $admin ?> </h3>

            <p>Admins </p>

          </div>
        </a>
        <a href="customers.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_users;";

            $result = $conn->query($query);

            // 
            $customer = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $customer ?> </h3>

            <p>Customers </p>

          </div>
        </a>

        <a href="categories.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_category;";

            $result = $conn->query($query);

            // 
            $category = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $category ?></h3>
            <p>Categories</p>
          </div>

        </a>
        <a href="products.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_product;";

            $result = $conn->query($query);

            // 
            $product = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $product ?></h3>
            <p>Products</p>
          </div>

        </a>
        <a href="vendors.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_vendor;";

            $result = $conn->query($query);

            // 
            $vendor = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $vendor ?></h3>
            <p>Vendors</p>
          </div>

        </a>


        <a href="orders.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_orders;";

            $result = $conn->query($query);

            // 
            $order = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $order ?></h3>
            <p>Orders</p>
          </div>

        </a>
        <a href="service.php">
          <div class="box">
            <?php

            $query = "SELECT * FROM csms_services;";

            $result = $conn->query($query);

            // 
            $service = mysqli_num_rows($result);
            ?>
            <h3 style="font-weight:550"><?php echo $service ?></h3>
            <p>Services</p>
          </div>

        </a>





      </div>
     </div> 
  </section>

<div class="container">
  <footer class="py-3 my-4">
    <div class="justify-content-center border-bottom pb-3 mb-3"></div>
    <p class="text-center text-muted">&copy; CSMS 2022</p>
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>