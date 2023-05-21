<?php
$current_page = 'compose';
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


if (isset($_POST['send'])) {
  $to = ($_POST['to']);
  $sub = ($_POST['sub']);
  $message = ($_POST['message']);

  if (mail($to,$sub,$message)) {
    $_SESSION["SuccessMessage"] = "Mail send Successfully !!!";
    header ("Location:compose.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Mail could not be send";
    header ("Location:compose.php");
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
      <h1>Compose</h1>
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
              <h3 class="box-title">Compose New Message</h3>
            </div>
             <form action="compose.php" method="post">
               <div class="box-body">
                 <div class="form-group">
                   <input class="form-control" name="to" placeholder="To:">
                 </div>
                 <div class="form-group">
                   <input class="form-control" name="sub" placeholder="Subject:">
                 </div>
                 <div class="form-group">
                   <textarea id="compose-textarea" name="message" class="form-control tinymce" style="height: 300px">
                   </textarea>
                 </div>
               </div>
               <div class="box-footer">
                 <div class="pull-right">
                   <button type="submit" name="send" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                 </div>
               </div>
             </form>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>
<?php include "footer.php" ?>

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

<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="tinymce/init-tinymce.js"></script>
</body>
