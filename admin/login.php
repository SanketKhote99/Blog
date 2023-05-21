<?php
$current_page = 'login';
include "header.php"
?>

<?php

$sql = "SELECT * FROM user";
$result = mysqli_query($con,$sql);
$cnt = mysqli_num_rows($result);


if ($cnt<1) {
  header ("Location:register.php");
}

 ?>

<?php

if(isset($_POST["Login"])){
  $username = ($_POST["username"]);
  $password = ($_POST["password"]);

  if(empty($username || $password)){
    $_SESSION["ErrorMessage"] = "Filled the Username or Password";
    header ("Location:login.php");
    exit;
  }else {
    $sql = "SELECT * FROM user WHERE (username = '$username' || email = '$username') AND password = '$password'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['User_Id'] = $row['id'];
    $f = $row['fname'];
    $l = $row['lname'];

    if ($row) {
      $_SESSION["SuccessMessage"] = "Welcome {$f} {$l}";
      header ("Location:index.php");
      exit;
    }else {
      $_SESSION["ErrorMessage"] = "Wrong Username / Password";
      header ("Location:login.php");
      exit;
    }
  }
}

 ?>




<body class="hold-transition login-page">
<div class="login-box">
  <?php
    echo ErrorMessage();
    echo SuccessMessage();
  ?>
  <div class="login-logo">
    <a href="login.php"><b>C</b>Panel</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Enter Username or Email" required>
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
		<a href="#">Forget Password</a>
      </div>
      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" name="Login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
