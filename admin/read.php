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
      <h1>Read</h1>
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
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <?php
              $e = $_GET["e"];
              $sql = "SELECT * FROM email WHERE id = '$e'";
              $result = mysqli_query($con,$sql);
              while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $m = $row['message'];
                $email = $row['email'];
             ?>
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>Website Feedback</h3>
                <h5>From: <?php echo "$email"; ?>
                  <span class="mailbox-read-time pull-right">5 May. 2023 11:03 PM</span></h5>
              </div>
              <div class="mailbox-read-message">
                <p><?php echo $m ?></p>
              </div>
            </div>

          <?php } ?>

            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
              </div>
              <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
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
