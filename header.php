<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | CSMS</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- DataTables -->
  <link href="js/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="js/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


  <style>
    /* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
} */
    .form-control-dark {
      border-color: var(--bs-gray);
    }

    .form-control-dark:focus {
      border-color: #fff;
      box-shadow: 0 0 0 .25rem rgba(255, 255, 255, .25);
    }

    .text-small {
      font-size: 85%;
    }

    .dropdown-toggle {
      outline: 0;
    }
  </style>
</head>

<body style="background-color: #EFF3F6;">
  <div class="container">
    <div class="heading">
      <div class="name">
        <p style="text-align: center;"> Computer Shop Management System</p>
      </div>
    </div>
    <div class="logout">
      <a class="logout-button" href="logout.php"><span>Sign Out</span></a>
    </div>
    <div class="nav-items">
      <header class="d-flex flex-wrap align-items-center justify-content-center mb-5">
        <!-- <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
      </a> -->

        <ul class="nav col-md-auto mb-2 justify-content-center">
          <li><a href="dashboard.php" class="nav-link px-2 link-dark"><i class="fas fa-fw fa-home"></i> Dashboard</a></li>
          <li><a href="profile.php" class="nav-link px-2 link-dark"><i class="fas fa-fw fa-user"></i> Profile</a></li>
          <li><a href="customers.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-users"></i> Customers</a></li>
          <li><a href="products.php" class="nav-link px-2 link-dark"><i class="fa-brands fa-product-hunt"></i> Products</a></li>
          <li><a href="stock.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-square-poll-horizontal"></i> Stock</a></li>
          <li><a href="categories.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-sort"></i> Categories</a></li>
          <li><a href="vendors.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-industry"></i> Vendors</a></li>
          <li><a href="purchases.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-cart-shopping"></i> Purchases</a></li>
          <li><a href="orders.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-share"></i> Orders</a></li>
          <li><a href="service.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-rotate-left"></i> Services</a></li>
          <!-- <li><a href="orders.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-share"></i> Repair</a></li> -->
          <li><a href="purchase_report.php" class="nav-link px-2 link-dark"><i class="fa-solid fa-file-lines" style="margin-right: 4px;font-size: 19px;"></i></i>Net Profit</a></li>

        </ul>


      </header>
    </div>
  </div>

