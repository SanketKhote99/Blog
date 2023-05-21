<?php
$current_page = 'new_post';
include "header.php"
?>

<?php Login(); ?>

<?php

if(isset($_POST["Publish"]) || isset($_POST["Draft"])){
  $title = ($_POST["title"]);
  $Category = ($_POST["category"]);
  $detail = ($_POST["detail"]);
  $sampleText = ($_POST["sampleText"]);
  $type = "post";

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
  $Image = $_FILES["Image"]["name"];
  $Target = "upload/".basename($_FILES["Image"]["name"]);
  move_uploaded_file($_FILES["Image"]["tmp_name"] , $Target);


  if(empty($title && $detail && $Admin && $Category && $sampleText)){
    $_SESSION["ErrorMessage"] = "Filled the Field";
    header ("Location:edit_post.php");
    exit;
  }elseif (strlen($title)<5) {
    $_SESSION["ErrorMessage"] = "Title should be at least 5 Characters";
    header ("Location:edit_post.php");
    exit;
  }else {
    $s = "SELECT id AS cat_id FROM category WHERE name = '$Category'";
    $result = mysqli_query($con,$s);
    $row = mysqli_fetch_array($result);
    $cat_id = $row['cat_id'];

    $edit = ($_GET['p']);
    $sql = "UPDATE posts SET date = '$DateTime' , title = '$title' , category = '$Category' , author = '$Admin' , img = '$Image' , post = '$detail' , sampleText = '$sampleText' , post_status = '$status' , type = '$type' , category_id = '$cat_id' WHERE id = '$edit'";
    if ($con->query($sql) === TRUE) {
      $_SESSION["SuccessMessage"] = "Post Updated Successfully !!!";
      header ("Location:all_post.php");
      exit;
    }else {
      $_SESSION["ErrorMessage"] = "Post could not be Updated";
      header ("Location:edit_post.php");
      exit;
    }
  }

}

if(isset($_POST["Submit"])){
  $Category = ($_POST["Category"]);
  $slug = strtolower("$Category");

  if (empty($Category)) {
    $_SESSION["ErrorMessage"] = "Enter Category";
    header ("Location:edit_post.php");
    exit;
  }else {
    $sql = "INSERT INTO category(name,slug) VALUES('$Category','$slug')";
    if ($con->query($sql) === TRUE) {
      $_SESSION["SuccessMessage"] = "Category Added Successfully !!!";
      header ("Location:edit_post.php");
      exit;
    }else {
      $_SESSION["ErrorMessage"] = "Category could not be Added";
      header ("Location:edit_post.php");
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
      <?php
        global $con;
        $edit = $_GET['p'];
        $sql = "SELECT * FROM posts WHERE id = '$edit'";
        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_array($result)) {
          $title = $row['title'];
          $post = $row['post'];
          $sampleText = $row['sampleText'];
          $img = $row['img'];
         }
     ?>
      <h1>
        Edit Post
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <form role="form" action="edit_post.php?p=<?php echo "$edit"; ?>&action=edit" method="post" enctype="multipart/form-data">
        <div class="col-md-8">
          <div class="box">
           <div class="box-body">
             <div class="box-body">
               <div class="form-group">
                 <input value="<?php echo "$title"; ?>" type="text" name="title" class="form-control" placeholder="Enter Title Name">
                 <span class="help-block">*The name is how it appears on your site.</span>
               </div>
                 <div class="form-group">
                   <textarea id="text" style="resize:none" rows="10" name="detail" class="form-control tinymce" placeholder="Place some text here">
                     <?php echo "$post"; ?>
                   </textarea>
                 </div>
                 <div class="form-group">
                   <input value="<?php echo "$sampleText"; ?>" type="text" onkeyup="cnt(this.value)" name="sampleText" class="form-control" placeholder="Write Here ...">
                   <span class="help-block">*This text show on main page post.</span>
                 </div>
                 <div class="form-group">
                   <label>Profile Picture :</label><br>
                   <span class="btn btn-app btn-file" style="padding:50px;">
                     <i class="fa fa-file-image-o"></i> Add Image
                     <input id="file" type="file" onchange="imgPreview(event)" class="form-control" name="Image">
                   </span>
                   <span style="padding:50px;">
                     <img id="preview" src="upload/<?php echo "$img"; ?>" style="width:200px;">
                   </span>
                 </div>
               </div>
               <div class="box-footer">
                 <p>characters Count <span id=charcount></span></p>
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
          <div class="col-md-4">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Category</h3>
              </div>
             <div class="box-body">
                  <div class="form-group">
                    <select name="category" class="form-control">
                      <?php
                        $sql = "SELECT * FROM category ORDER BY id DESC";
                        $result = mysqli_query($con,$sql);
                        $sr = 0;
                          while ($row = mysqli_fetch_array($result)) {
                            $no = $row['id'];
                            $name = $row['name'];
                            $sr++;
                        ?>

                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>

                        <?php
                            }
                             mysqli_close($con);
                        ?>
                    </select>
                  </div>
                  <h4 class="box-title col-md-offset-3">
                    <a data-toggle="collapse" data-parent="#accordion" href="#cat">
                      + Add New Category
                    </a>
                  </h4>
              </div>

              <div id="cat" class="panel-collapse collapse">
                <div class="box-body">
                  <form role="form" action="edit_post.php" method="post">
                    <div class="box-body">
                      <div class="form-group">
                        <input type="text" name="Category" class="form-control" placeholder="Enter Category Name">
                      </div>
                      <button type="submit" name="Submit" class="btn btn-flat btn-sm btn-primary col-md-3 col-md-offset-4">Submit</button>
                    </div>
                  </form>
                </div>
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

  <script>
    function cnt(str) {
      document.getElementById("charcount").innerHTML =' ' + str.length;
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

  <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
  <script type="text/javascript" src="tinymce/init-tinymce.js"></script>
</body>
