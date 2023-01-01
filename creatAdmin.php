<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Admin | CSMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      max-width: 40%;
      padding: 15px;
    }

    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>

<body class="">
  <main class="form-signin  m-auto" style="width: 70%;">
    <form action="creatAdminAction.php" method="post" style="text-align:left">
      <!-- <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
     
      <div class="heading">
        <div class="name">
          <p style="text-align: center;">Please Give Admin Info</p>
        </div>
      </div>

   
      <div class="container" style=" box-shadow: 3px 3px #565d66, -1em 0 0.4em #bac5e1;">
        <label for="" class="float:left">usernane</label>
        <div class="form-floating">

          <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username" required>
          <!-- <label for="floatingInput">Username</label> -->
        </div>
        <label for="">Password</label>
        <div class="form-floating mt-2">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
          <!-- <label for="floatingPassword">Password</label> -->
        </div>
        <label for="">Confirm password</label>
        <div class="form-floating">
          <input type="password" name="cpassword" class="form-control" id="floatingPassword" placeholder="Confirm Password" required>
          <!-- <label for="floatingPassword">Password</label> -->
        </div>


        <button class="purchase-submit" type="submit" name="login">Sign up</button>
        <p class="mt-5 mb-3 text-muted">&copy; CSMS 2022</p>
    </form>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>