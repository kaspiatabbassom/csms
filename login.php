<?php
include('db.php');
session_start();
if(!empty($_SESSION['username'])) header('Location:dashboard.php');

if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
{
    // print_r($_POST);die();
    // $sql = "select * FROM csms_admins WHERE (username = '". $_POST['username'] . "' AND passwd = '" . $_POST['password'] ."');";
    $sql = "select username, passwd FROM csms_SuperAdmin WHERE (username = '". $_POST['username'] . "' AND passwd = '" . md5($_POST['password']) ."');";
  //  $sql = "select username, passwd FROM csms_SuperAdmin WHERE (username = '". $_POST['username'] . "' AND passwd = '".($_POST['password']) ."');";

    $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
     if($row['username'] == $_POST['username'] && $row['passwd'] == md5($_POST['password']))
  //  if($row['username'] == $_POST['username'] && $row['passwd'] == ($_POST['password']))
 
    {
        //echo "Success";
	    // session_start();
	    $_SESSION['username']=$row['username'];
	    // $_SESSION['password']=$row[passwd];
        // print_r($_SESSION);die();
	    //echo $_SESSION['student_id'];
	    header('Location:dashboard.php');
    }
    // echo '<pre>';print_r($row);echo '</pre>';
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
//   echo "0 results";
echo  "<script>alert ('Id and Password Incorrect')</script>" ;
}
$conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login | CSMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
  max-width: 60%;
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
<body>
  
<main class="form-signin  m-auto">
<div class="heading">
        <div class="name">
       <p style="text-align: center;"> Computer Shop Management System</p>
        </div>
</div>
    <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post" style=" box-shadow: 1px 2px #565d66, -.3em 0 0.4em #bac5e1;padding: 15px;">
    <!-- <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
   
    <h4 class="normal-text" style="text-align: center; ;">Please sign in</h4>

    <div class="form-floating">
      <p class="normal-text">User Name</p>
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
      <!-- <label for="floatingInput">Username</label> -->
    </div>
    <div class="form-floating">
      <p class="normal-text" style="margin-top: 16px;">Password</p>
      <input type="password" name = "password" class="form-control" id="floatingPassword" placeholder="Password">
      <!-- <label for="floatingPassword">Password</label> -->
    </div>

    <div class="checkbox mb-3">
      <!-- <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label> -->
    </div>
    <button class="purchase-submit" type="submit" name = "login">Sign in</button>

    </form>
    <p class="mt-5 mb-3 text-muted text-center">&copy; CSMS 2022</p>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
