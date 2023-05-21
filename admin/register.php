<?php
$current_page = 'register';
include "header.php"
?>

<?php

if (isset($_POST["Register"])) {
  $username = ($_POST["username"]);
  $email = ($_POST["email"]);
  $password = ($_POST["password"]);

  date_default_timezone_set("Asia/Calcutta");
  $DateTime =  date('d-M-Y h:i A');


  $sql = "INSERT INTO user(username,email,password,registered_date) VALUES('$username','$email','$password' , '$DateTime')";
  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Register Successfully Added !!!";
    header ("Location:login.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Something Wrong !!! ";
    header ("Location:register.php");
    exit;
  }

}

 ?>

<body class="hold-transition register-page">
<div class="login-box">
  <?php
    echo ErrorMessage();
    echo SuccessMessage();
  ?>
  <div class="login-logo">
    <a href="register.php"><b>C</b>Panel</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" name="Register" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
