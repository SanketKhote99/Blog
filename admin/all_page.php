<?php
$current_page = 'all_page';
include "header.php"
?>

<?php Login(); ?>

<?php

$all = "SELECT * FROM posts WHERE post_status NOT IN ('trash') && type = 'page'";
$result = mysqli_query($con,$all);
$TotalPost = mysqli_num_rows($result);

$publish = "SELECT * FROM posts WHERE post_status = 'publish'  && type = 'page'";
$result = mysqli_query($con,$publish);
$PublishPost = mysqli_num_rows($result);

$draft = "SELECT * FROM posts WHERE post_status = 'draft'  && type = 'page'";
$result = mysqli_query($con,$draft);
$DraftPost = mysqli_num_rows($result);

$trash = "SELECT * FROM posts WHERE post_status = 'trash'  && type = 'page'";
$result = mysqli_query($con,$trash);
$TrashPost = mysqli_num_rows($result);



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
      <h1>
        Page
        <a href="new_page.php">
          <span class="btn btn-default btn-flat btn-sm"><i class="fa fa-file-text-o"></i> Add New</span>
        </a>
      </h1>
    </section>
    <section class="content">
      <div class="row">
       <div class="col-md-12">
         <div class="nav-tabs-custom">
           <ul class="nav nav-tabs">
             <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo "All($TotalPost)"; ?></a></li>
             <li><a href="#tab_2" data-toggle="tab"><?php echo "Published($PublishPost)"; ?></a></li>
             <li><a href="#tab_3" data-toggle="tab"><?php echo "Draft($DraftPost)"; ?></a></li>
             <li><a href="#tab_4" data-toggle="tab"><?php echo "Trash($TrashPost)"; ?></a></a></li>
           </ul>
           <div class="tab-content">
             <div class="tab-pane active" id="tab_1">
               <table id="example1" class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th style="width:50%">Title</th>
                     <th>Author</th>
                     <th>Category</th>
                     <th>Comment</th>
                     <th>Views</th>
                     <th>Date & Time</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                    $sr = 0;
                    $sql = "SELECT * FROM posts WHERE post_status NOT IN ('trash')  && type = 'page' ORDER BY id DESC";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $author = $row['author'];
                      $category = $row['category'];
                      $post_view = $row['post_view'];
                      $comment_count = $row['comment_count'];
                      $date = $row['date'];
                      $sr++;

                   ?>
                  <tr>
                    <td><?php echo "$sr"; ?></td>
                    <td class="titleHover">
                    <a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">
                       <b>
                        <?php
                          if (strlen($title)>40) {$title = substr($title,0,40)."...";}
                           echo $title
                        ?>
                      </b><br>
                        <p>
                          <a class="text-aqua" href="edit_post.php?p=<?php echo "$id"; ?>&action=edit">Edit</a> |
                          <a class="text-green" href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">Preview</a> |
                          <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="all_post.php?p=<?php echo "$id"; ?>&action=trash">Trash</a></button>
                        </p>
                    </a>
                    </td>
                    <td><a href="#"><?php echo $author ?></a></td>
                    <td><a href="#"><?php echo $category ?></a></td>
                    <td>
                      <a href="comment.php">
                        <span class="pull-right-container">
                          <small class="label bg-blue"><?php echo $comment_count; ?></small>
                          <?php
                            $con = new mysqli("localhost","root","","blog");
                            $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'approve'";
                            $r = mysqli_query($con,$s);
                            $ApproveComment = mysqli_num_rows($r);
                           ?>
                           <small class="label bg-green"><?php echo $ApproveComment; ?></small>
                           <?php
                             $con = new mysqli("localhost","root","","blog");
                             $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'pending'";
                             $r = mysqli_query($con,$s);
                             $PendingComment = mysqli_num_rows($r);
                            ?>
                            <small class="label bg-yellow"><?php echo $PendingComment; ?></small>
                        </span>
                      </a>
                    </td>
                    <td><?php echo "$post_view";?>
                    </td>
                    <td>
                      <?php
                        if (strlen($date)>11) {$date = substr($date,0,11);}
                        echo $date
                      ?>
                    </td>
                    </tr>
                    <?php
                      }
                      mysqli_close($con);
                    ?>
                  </tbody>
                </table>
             </div>
             <div class="tab-pane" id="tab_2">
               <table id="example1" class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th style="width:50%">Title</th>
                     <th>Author</th>
                     <th>Category</th>
                     <th>Comment</th>
                     <th>Views</th>
                     <th>Date & Time</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                    $sr = 0;
                    $con = new mysqli("localhost","root","","blog");
                    $sql = "SELECT * FROM posts WHERE post_status='publish' && type = 'page' ORDER BY id DESC";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $author = $row['author'];
                      $category = $row['category'];
                      $post_view = $row['post_view'];
                      $comment_count = $row['comment_count'];
                      $date = $row['date'];
                      $sr++;

                   ?>
                  <tr>
                    <td><?php echo "$sr"; ?></td>
                    <td class="titleHover">
                    <a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">
                       <b>
                        <?php
                          if (strlen($title)>40) {$title = substr($title,0,40)."...";}
                           echo $title
                        ?>
                      </b><br>
                      <p>
                        <a class="text-aqua" href="edit_post.php?p=<?php echo "$id"; ?>&action=edit">Edit</a> |
                        <a class="text-green" href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">Preview</a> |
                        <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="all_post.php?p=<?php echo "$id"; ?>&action=trash">Trash</a></button>
                      </p>
                    </a>
                    </td>
                    <td><a href="#"><?php echo $author ?></a></td>
                    <td><a href="#"><?php echo $category ?></a></td>
                    <td>
                      <a href="comment.php">
                        <span class="pull-right-container">
                          <small class="label bg-blue"><?php echo $comment_count; ?></small>
                          <?php
                            $con = new mysqli("localhost","root","","blog");
                            $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'approve'";
                            $r = mysqli_query($con,$s);
                            $ApproveComment = mysqli_num_rows($r);
                           ?>
                           <small class="label bg-green"><?php echo $ApproveComment; ?></small>
                           <?php
                             $con = new mysqli("localhost","root","","blog");
                             $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'pending'";
                             $r = mysqli_query($con,$s);
                             $PendingComment = mysqli_num_rows($r);
                            ?>
                            <small class="label bg-yellow"><?php echo $PendingComment; ?></small>
                        </span>
                      </a>
                    </td>
                    <td><?php echo "$post_view";?>
                    <td>
                      <?php
                        if (strlen($date)>11) {$date = substr($date,0,11);}
                        echo $date
                      ?>
                    </td>
                    </tr>
                    <?php
                      }
                      mysqli_close($con);
                    ?>
                  </tbody>
                </table>
             </div>
             <div class="tab-pane" id="tab_3">
               <table id="example1" class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th style="width:50%">Title</th>
                     <th>Author</th>
                     <th>Category</th>
                     <th>Comment</th>
                     <th>Views</th>
                     <th>Date & Time</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                    $sr = 0;
                    $con = new mysqli("localhost","root","","blog");
                    $sql = "SELECT * FROM posts WHERE post_status='draft' && type = 'page' ORDER BY id DESC";
                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $author = $row['author'];
                      $category = $row['category'];
                      $post_view = $row['post_view'];
                      $comment_count = $row['comment_count'];
                      $date = $row['date'];
                      $sr++;

                   ?>
                  <tr>
                    <td><?php echo "$sr"; ?></td>
                    <td class="titleHover">
                    <a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">
                       <b>
                        <?php
                          if (strlen($title)>40) {$title = substr($title,0,40)."...";}
                           echo $title
                        ?>
                      </b><br>
                      <p>
                        <a class="text-aqua" href="edit_post.php?p=<?php echo "$id"; ?>&action=edit">Edit</a> |
                        <a class="text-green" href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">Preview</a> |
                        <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="all_post.php?p=<?php echo "$id"; ?>&action=trash">Trash</a></button>
                      </p>
                    </a>
                    </td>
                    <td><a href="#"><?php echo $author ?></a></td>
                    <td><a href="#"><?php echo $category ?></a></td>
                    <td>
                      <a href="comment.php">
                        <span class="pull-right-container">
                          <small class="label bg-blue"><?php echo $comment_count; ?></small>
                          <?php
                            $con = new mysqli("localhost","root","","blog");
                            $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'approve'";
                            $r = mysqli_query($con,$s);
                            $ApproveComment = mysqli_num_rows($r);
                           ?>
                           <small class="label bg-green"><?php echo $ApproveComment; ?></small>
                           <?php
                             $con = new mysqli("localhost","root","","blog");
                             $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'pending'";
                             $r = mysqli_query($con,$s);
                             $PendingComment = mysqli_num_rows($r);
                            ?>
                            <small class="label bg-yellow"><?php echo $PendingComment; ?></small>
                        </span>
                      </a>
                    </td>
                    <td><?php echo "$post_view";?>
                    <td>
                      <?php
                        if (strlen($date)>11) {$date = substr($date,0,11);}
                        echo $date
                      ?>
                    </td>
                    </tr>
                    <?php
                      }
                      mysqli_close($con);
                    ?>
                  </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab_4">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th style="width:50%">Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Comment</th>
                    <th>Views</th>
                    <th>Date & Time</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
                   $sr = 0;
                   $con = new mysqli("localhost","root","","blog");
                   $sql = "SELECT * FROM posts WHERE post_status='trash' && type = 'page' ORDER BY id DESC";
                   $result = mysqli_query($con,$sql);
                   while ($row = mysqli_fetch_array($result)) {
                     $id = $row['id'];
                     $title = $row['title'];
                     $author = $row['author'];
                     $category = $row['category'];
                     $post_view = $row['post_view'];
                     $comment_count = $row['comment_count'];
                     $date = $row['date'];
                     $sr++;

                  ?>
                 <tr>
                   <td><?php echo "$sr"; ?></td>
                   <td class="titleHover">
                   <a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank">
                      <b>
                       <?php
                         if (strlen($title)>40) {$title = substr($title,0,40)."...";}
                          echo $title
                       ?>
                     </b><br>
                     <p>
                       <button class="linkbtn" type="submit" name="Restore"><a class="text-green" href="all_post.php?r=<?php echo "$id"; ?>&action=restore">Restore</a></button> |
                       <button class="linkbtn" type="submit" name="Delete"><a class="text-red" href="all_post.php?d=<?php echo "$id"; ?>&action=delete">Permantly Delete</a></button>
                     </p>
                   </a>
                   </td>
                   <td><a href="#"><?php echo $author ?></a></td>
                   <td><a href="#"><?php echo $category ?></a></td>
                   <td>
                     <a href="comment.php">
                       <span class="pull-right-container">
                         <small class="label bg-blue"><?php echo $comment_count; ?></small>
                         <?php
                           $con = new mysqli("localhost","root","","blog");
                           $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'approve'";
                           $r = mysqli_query($con,$s);
                           $ApproveComment = mysqli_num_rows($r);
                          ?>
                          <small class="label bg-green"><?php echo $ApproveComment; ?></small>
                          <?php
                            $con = new mysqli("localhost","root","","blog");
                            $s = "SELECT * FROM comments WHERE post_id = '$id' AND comment_status = 'pending'";
                            $r = mysqli_query($con,$s);
                            $PendingComment = mysqli_num_rows($r);
                           ?>
                           <small class="label bg-yellow"><?php echo $PendingComment; ?></small>
                       </span>
                     </a>
                   </td>
                   <td><?php echo "$post_view";?>
                   <td>
                     <?php
                       if (strlen($date)>11) {$date = substr($date,0,11);}
                       echo $date
                     ?>
                   </td>
                   </tr>
                   <?php
                     }
                     mysqli_close($con);
                   ?>
                 </tbody>
               </table>
           </div>
          </div>
        </div>
      </div>
    </div>
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
