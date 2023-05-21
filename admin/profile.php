<?php
$current_page = 'profile';
include "header.php"
?>

<?php Login(); ?>

<?php

if(isset($_POST["Update"])){
  $fname = ($_POST["fname"]);
  $lname = ($_POST["lname"]);
  $email = ($_POST["email"]);
  $website = ($_POST["website"]);
  $bio = ($_POST["bio"]);
  $password = ($_POST["password"]);

  $id = $_GET['profile'];

  $Image = $_FILES["Image"]["name"];
  $Target = "upload/".basename($_FILES["Image"]["name"]);
  move_uploaded_file($_FILES["Image"]["tmp_name"] , $Target);


    $sql = "UPDATE user SET email = '$email', website = '$website' , fname  = '$fname' , lname = '$lname' , bio = '$bio' , password = '$password' , img = '$Image' , registered_date = '$DateTime' WHERE id = '$id'";
    if ($con->query($sql) === TRUE) {
      $_SESSION["SuccessMessage"] = "Profile Updated Successfully !!!";
      header ("Location:index.php");
      exit;
    }else {
      $_SESSION["ErrorMessage"] = "Profile could not be Updated";
      header ("Location:profile.php");
      exit;
    }

}


 ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "nav.php" ?>

  <?php include "sidebar.php" ?>

  <div class="content-wrapper">
    <section class="content-header">
      <?php
        echo ErrorMessage();
        echo SuccessMessage();
      ?>
      <h1>
        Profile
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <?php
          global $con;
          $id = $_GET['profile'];
          $s = "SELECT * FROM user WHERE id = '$id'";
          $r = mysqli_query($con,$s);
          $row = mysqli_fetch_array($r);
          $username = $row['username'];
          $fname = $row['fname'];
          $lname = $row['lname'];
          $email = $row['email'];
          $website = $row['website'];
          $bio = $row['bio'];
          $password = $row['password'];
          $image = $row['img'];
         ?>
        <form role="form" action="profile.php?profile=<?php echo "$id"; ?>" method="post" enctype="multipart/form-data">
          <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                  <h3 class="box-title">Name</h3>
                  <div class="form-group">
                    <label>Username :</label>
                    <input type="text" name="username" class="form-control" value="<?php echo "$username"; ?>" disabled>
                    <span class="help-block">*Username cannot be changed.</span>
                  </div>
                  <div class="form-group">
                    <label>First Name :</label>
                    <input type="text" name="fname" class="form-control" value="<?php echo "$fname"; ?>">
                    <span class="help-block">*It is Display  Name.</span>
                  </div>
                  <div class="form-group">
                    <label>Last Name :</label>
                    <input type="text" name="lname" class="form-control" value="<?php echo "$lname"; ?>">
                  </div>
                  <hr>
                  <h3 class="box-title">Contact Info</h3>
                  <div class="form-group">
                    <label>Email :</label>
                    <input type="email" name="email" class="form-control" value="<?php echo "$email"; ?>">
                  </div>
                  <div class="form-group">
                    <label>website :</label>
                    <input type="text" name="website" class="form-control" value="<?php echo "$website"; ?>">
                  </div>
                  <hr>
                  <h3 class="box-title">About Yourself </h3>
                  <div class="form-group">
                    <label>Biographical Info :</label>
                    <textarea style="resize:none" rows="10" name="bio" class="form-control">
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label>Profile Picture :</label><br>
                    <span class="btn btn-app btn-file" style="padding:50px;">
                      <i class="fa fa-file-image-o"></i> Add Image
                      <input id="file" type="file" onchange="imgPreview(event)" class="form-control" name="Image">
                    </span>
                    <span style="padding:50px;">
                      <?php if (!empty("$image")): ?>
                        <img id="preview" src="upload/<?php echo "$image"; ?>" class="img-circle" style="width:100px;">
                      <?php endif; ?>
                      <?php if (empty("$image")): ?>
                        <img id="preview" src="upload/user.png" class="img-circle" style="width:100px;">
                      <?php endif; ?>
                    </span>
                  </div>
                  <hr>
                  <h3 class="box-title">Account Management</h3>
                  <div class="form-group">
                    <label>New Password	 :</label>
                    <input id="visible" type="password" name="password" class="form-control" value="<?php echo "$password"; ?>">
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" onclick="PasswordVisibility()">Show Password
                    </label>
                  </div>
                  </div>
                  <div class="box-footer">
                      <button type="submit" name="Update" class="btn btn-primary pull-right">Update</button>
                  </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>

  <?php include "footer.php" ?>
<script type="text/javascript">
function PasswordVisibility() {
  var x = document.getElementById("visible");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function imgPreview(event) {
  var reader = new FileReader();
  var preview = document.getElementById("preview")

  reader.onload = function(){

    if (reader.readyState = 2) {
      preview.src = reader.result;
    }
  }

  reader.readAsDataURL(event.target.files[0]);

}
</script>
</body>
