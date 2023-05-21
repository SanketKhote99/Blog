<?php
$current_page = 'new_page';
include "header.php"
?>

<?php Login(); ?>

<?php

if(isset($_POST["Publish"]) || isset($_POST["Draft"])){
  $title = ($_POST["title"]);
  $detail = ($_POST["detail"]);

  if (isset($_POST["Publish"])) {
    $status = "publish";
  }
  if (isset($_POST["Draft"])) {
    $status = "draft";
  }

  date_default_timezone_set("Asia/Calcutta");
  $DateTime =  date('d-M-Y h:i A');

  $sql = "SELECT * FROM user";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $Admin = $row['fname'];

  $type = "page";


  if(empty($title && $detail)){
    $_SESSION["ErrorMessage"] = "Filled the Field";
    header ("Location:new_page.php");
    exit;
  }elseif (strlen($title)<5) {
    $_SESSION["ErrorMessage"] = "Title should be at least 5 Characters";
    header ("Location:new_page.php");
    exit;
  }else {

    $sql = "INSERT INTO posts(date,title,author,post,post_status,type) VALUES('$DateTime','$title','$Admin','$detail','$status','$type')";
    if ($con->query($sql) === TRUE) {
      $_SESSION["SuccessMessage"] = "Page Created Successfully !!!";
      header ("Location:new_page.php");
      exit;
    }else {
      $_SESSION["ErrorMessage"] = "Page could not be create";
      header ("Location:new_page.php");
      exit;
    }
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
        Add New Page
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <form role="form" action="new_page.php" method="post" enctype="multipart/form-data">
        <div class="col-md-8">
          <div class="box">
           <div class="box-body">
              <div class="box-body">
                <div class="form-group">
                  <input type="text" name="title" class="form-control" placeholder="Enter Page Name">
                  <span class="help-block">*The name is how it appears on your site.</span>
                </div>
                <div class="form-group">
                  <textarea style="resize:none" rows="10" name="detail" class="form-control tinymce" placeholder="Place some text here"></textarea>
                </div>
              </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Publish</h3>
              </div>
              <div class="box-body">
                   <button type="submit" name="Draft" class="btn btn-default">Save Draft</button>
                   <button type="submit" name="Preview" class="btn btn-default pull-right">Preview</button>
              </div>
              <div class="box-footer">
                  <button type="submit" name="Publish" class="btn btn-primary pull-right">Publish</button>
              </div>
            </div>
          </div>
        </form>
        </div>
      </div>
     </div>
   </div>
  </div>

  <?php include "footer.php" ?>

  <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
  <script type="text/javascript" src="tinymce/init-tinymce.js"></script>
</body>
