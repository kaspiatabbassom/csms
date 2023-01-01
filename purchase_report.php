<?php
 include('db.php');
 session_start();
 if (empty($_SESSION['username'])) {
     header('Location:login.php');
 }
include('header.php');

?>

<div class="container">

    <!-- start page title -->

    <!-- end page title -->
<form action="display_purchase_report.php" method="POST" style=" box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);">
    <div class="row">
        <div class="col-16">
            <div class="card">
            <h4 class="card-title purchase-header">Date Range</h4>
                <div class="card-body date-display">
              
                    <div class="start">
              
                        <label for="example-text-input" class="form-label">Start Date</label>
                        <input type="date" class="form-control example-date-input" name="start-date" id="date" required>



                    </div>
                    <div class="end">
                      
                        <label for="example-text-input" class="form-label">End Date</label>
                        <input type="date" class="form-control example-date-input" name="end-date" id="date" required>



                    </div>

                </div>
            </div> <!-- end col -->
            <input type="submit" class="purchase-submit" value="search" name="search">
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
    </form>


<?php 
include 'footer.php';

?>