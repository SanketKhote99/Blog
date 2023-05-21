<?php
$current_page = 'inbox';
include "header.php"
?>

<?php Login(); ?>

<?php

$all = "SELECT * FROM email";
$result = mysqli_query($con,$all);
$inbox = mysqli_num_rows($result);

$publish = "SELECT * FROM email WHERE role = 'subscribe'";
$result = mysqli_query($con,$publish);
$subscribe = mysqli_num_rows($result);

$draft = "SELECT * FROM email WHERE role = 'contact'";
$result = mysqli_query($con,$draft);
$feedback = mysqli_num_rows($result);



if (isset($_GET['p']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $t = $_GET['p'];
  ($action = $_GET['action']) == "trash";
  $sql = "UPDATE posts SET post_status = 'trash' WHERE id = '$t'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Post Added into Trash Successfully !!!";
    header ("Location:all_page.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Post could not be Added into Trash";
    header ("Location:all_page.php");
    exit;
  }

}

if (isset($_GET['r']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $r = $_GET['r'];
  ($action = $_GET['action']) == "restore";
  $sql = "UPDATE posts SET post_status = 'publish' WHERE id = '$r'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Post Published Successfully !!!";
    header ("Location:all_page.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Post could not be Published";
    header ("Location:all_page.php");
    exit;
  }

}

if (isset($_GET['d']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $r = $_GET['d'];
  ($action = $_GET['action']) == "delete";
  $sql = "DELETE FROM posts WHERE id = '$r'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Post Deleted Successfully !!!";
    header ("Location:all_page.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Post could not be Deleted";
    header ("Location:all_page.php");
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
      <h1>Inbox</h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="compose.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="inbox.php"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo $inbox ?></span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent <span class="label label-info pull-right"><?php echo "5"; ?></span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger pull-right"><?php echo "2"; ?></span></a></li>
                <li><a href="#"><i class="fa fa-archive"></i> Subscribe <span class="label label-warning pull-right"><?php echo $subscribe ?></span></a></li>
                <li><a href="#"><i class="fa fa-bullhorn"></i> Feedback <span class="label label-success pull-right"><?php echo $feedback ?></span></a></li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash <span class="label label-danger pull-right"><?php echo "7"; ?></span></a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>
            </div>
            <div class="box-body no-padding">
              <div class="mailbox-controls">
              </div>
              <div class="table-responsive mailbox-messages">
                <table id="example1" class="table table-bordered table-hover">
                  <?php
                    $sr = 0;
                    $sql = "SELECT * FROM email ORDER BY id DESC";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $name = $row['name'];
                      $email= $row['email'];
                      $message = $row['message'];
                      $role = ucfirst($row['role']);
                      $date = $row['date'];
                      $sr++;

                   ?>
                  <tbody>
                  <tr>
                    <td><?php echo $sr ?></td>
                    <td class="mailbox-name"><a href="read.php?e=<?php echo $id ?>"><?php echo "$name"; ?></a></td>
                    <td class="mailbox-subject"><?php echo $message ?></td>
                    <td class="mailbox-role"><?php echo $role ?></td>
                    <td class="mailbox-date">
                      <?php
                        if (strlen($date)>11) {$date = substr($date,0,11);}
                        echo $date
                      ?>
                  </td>
                  </tr>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>


  <?php include "footer.php" ?>
</body>
