<?php
$current_page = 'general';
include "header.php"
?>

<?php Login(); ?>

<?php

if(isset($_POST["Update"])){
  $value = ($_POST["value"]);

    $sql = "UPDATE options SET value  = '$value'";
    if ($con->query($sql) === TRUE) {
      $_SESSION["SuccessMessage"] = "Setting Updated Successfully !!!";
      header ("Location:general.php");
      exit;
    }else {
      $_SESSION["ErrorMessage"] = "Setting could not Update";
      header ("Location:general.php");
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
        General Settings
      </h1>
    </section>
    <section class="content">
      <div class="row">

        <form action="general.php" method="post">
          <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                  <?php

                      $con = new mysqli("localhost","root","","blog");
                      $s = "SELECT * FROM options";
                      $r = mysqli_query($con,$s);
                      while ( $row = mysqli_fetch_array($r)) {
                        $id = $row['id'];
                        $name = ucwords(str_replace('_', ' ', $row['name']));
                        $value = $row['value'];

                   ?>
                  <div class="form-group">
                    <label><?php echo $name ?> :</label>
                    <input type="text" name="value" class="form-control" value="<?php echo "$value"; ?>">
                  </div>
                  <?php } ?>
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
</body>
