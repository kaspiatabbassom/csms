<?php
include('db.php');
session_start();
if (empty($_SESSION['username'])) {
    header('Location:login.php');
}
include('header.php');

?>

<?php

//count return product
$query = "SELECT * FROM csms_services where repaired=0;";

$result = $conn->query($query);

// 
$return_product = mysqli_num_rows($result);


//count repaired product
$query1 = "SELECT * FROM csms_services where repaired=1;";

$result1 = $conn->query($query1);

// 
$repair_product = mysqli_num_rows($result1);



?>
<!-- <div class="container"> -->
<!-- <div class="col-md-12 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                        <div class="normal-text" style="font-size: 20px;color:#3150a1;">
                          <a href="AllReturn.php">Return</a>  </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-0">
                        <div class="normal-text" style="font-size: 20px;color:#3150a1;">
                           <a href="AllRepair.php">Repair</a> </div>

                    </div>

                </div>
            </div>
        </div>

    </div> -->

<section class="dashboard">
    <div class="container" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);padding:60px">
        <div class="box-container">
            <a href="AllReturn.php">
                <div class="box">

                    <h3 style="font-weight:550"><?php echo $return_product ?>  </h3>

                    <p>Returned </p>

                </div>
            </a>

            <a href="AllRepair.php">
                <div class="box">
                    <h3 style="font-weight:550"><?php echo $repair_product ?></h3>
                    <p>Repaired</p>
                </div>

            </a>







        </div>
    </div>
</section>
<!-- </div> -->

<?php include 'footer.php'?>