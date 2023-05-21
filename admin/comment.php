<?php
$current_page = 'Comment';
include "header.php"
?>

<?php Login(); ?>

<?php

$all = "SELECT * FROM comments WHERE Comment_status NOT IN ('trash')";
$result = mysqli_query($con,$all);
$TotalComment = mysqli_num_rows($result);

$approve = "SELECT * FROM comments WHERE Comment_status = 'approve'";
$result = mysqli_query($con,$approve);
$ApproveComment = mysqli_num_rows($result);

$pending = "SELECT * FROM comments WHERE Comment_status = 'pending'";
$result = mysqli_query($con,$pending);
$PendingComment = mysqli_num_rows($result);

$trash = "SELECT * FROM comments WHERE Comment_status = 'trash'";
$result = mysqli_query($con,$trash);
$TrashComment = mysqli_num_rows($result);

if (isset($_GET['t']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $t = $_GET['t'];
  ($action = $_GET['action']) == "trash";
  $sql = "UPDATE comments SET comment_status = 'trash' WHERE id = '$t'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Comment Added into Trash Successfully !!!";
    header ("Location:comment.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Comment could not be Added into Trash";
    header ("Location:comment.php");
    exit;
  }

}

if (isset($_GET['a']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $a = $_GET['a'];
  ($action = $_GET['action']) == "approve";
  $sql = "UPDATE comments SET comment_status = 'approve' WHERE id = '$a'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Comment Approveed !!!";
    header ("Location:comment.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Comment could not be Approveed";
    header ("Location:comment.php");
    exit;
  }

}

if (isset($_GET['p']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $p = $_GET['p'];
  ($action = $_GET['action']) == "pending";
  $sql = "UPDATE comments SET comment_status = 'pending' WHERE id = '$p'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Comment Unapproveed !!!";
    header ("Location:comment.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Comment could not be Unapproveed";
    header ("Location:comment.php");
    exit;
  }

}

if (isset($_GET['d']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $d = $_GET['d'];
  ($action = $_GET['action']) == "delete";
  $sql = "DELETE FROM comments WHERE id = '$d'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Comment Deleted Successfully !!!";
    header ("Location:comment.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Comment could not be Deleted";
    header ("Location:comment.php");
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
      <h1>Comments</h1>
    </section>
    <section class="content">
      <div class="row">
       <div class="col-md-12">
         <div class="nav-tabs-custom">
           <ul class="nav nav-tabs">
             <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo "All($TotalComment)"; ?></a></li>
             <li><a href="#tab_2" data-toggle="tab"><?php echo "Approve($ApproveComment)"; ?></a></li>
             <li><a href="#tab_3" data-toggle="tab"><?php echo "Pending($PendingComment)"; ?></a></li>
             <li><a href="#tab_4" data-toggle="tab"><?php echo "Trash($TrashComment)"; ?></a></a></li>
           </ul>
           <div class="tab-content">
             <div class="tab-pane active" id="tab_1">
               <table class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th style="width:20%">Author</th>
                     <th style="width:40%">Comment</th>
                     <th style="width:25%">Title</th>
                     <th style="width:10%">Date & Time</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                  $sr = 0;
                  $con = new mysqli("localhost","root","","blog");
                  $sql = "SELECT c.id,c.name,c.email,c.comment,c.comment_status,c.date,p.title FROM comments AS c INNER JOIN posts AS p ON c.post_id = p.id WHERE comment_status NOT IN ('trash') ORDER BY id DESC";                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $name = $row['name'];
                      $comment = $row['comment'];
                      $date = $row['date'];
                      $email = $row['email'];
                      $status = $row['comment_status'];
                      $sr++;

                   ?>
                  <tr>
                    <td><?php echo "$sr"; ?></td>
                    <td>
                      <img class="img-circle pull-left" src="upload/user.png" style="margin-right: 10px; width:50px;">
                      <div class="">
                        <a style="margin-top:5px;" href="#"><?php echo "$name"; ?></a><br>
                        <a href="#">
                          <?php
                            if (strlen($email)>11) {$email = substr($email,0,11);}
                            echo "$email ...";
                           ?>
                        </a>
                      </div>
                    </td>
                    <td class="titleHover">
                    <a>
                       <b>
                        <?php echo $comment; ?>
                      </b><br>
                        <p>
                          <?php
                            if ($status == "pending") {
                            ?>
                          <a class="text-green" href="comment.php?a=<?php echo "$id"; ?>&action=edit">Approve</a> |
                          <?php }else {
                          ?>
                          <a class="text-yellow" href="comment.php?p=<?php echo "$id"; ?>&action=edit">Unapprove</a> |
                          <?php  } ?>
                          <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="comment.php?t=<?php echo "$id"; ?>&action=trash">Trash</a></button>
                        </p>
                    </a>
                    </td>
                    <td><a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank"><?php echo "$title"; ?></a></td>
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
               <table class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th style="width:20%">Author</th>
                     <th style="width:40%">Comment</th>
                     <th style="width:25%">Title</th>
                     <th style="width:10%">Date & Time</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                  $sr = 0;
                  $con = new mysqli("localhost","root","","blog");
                  $sql = "SELECT c.id,c.name,c.email,c.comment,c.date,p.title FROM comments AS c INNER JOIN posts AS p ON c.post_id = p.id WHERE comment_status = 'approve' ORDER BY id DESC";                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $name = $row['name'];
                      $comment = $row['comment'];
                      $date = $row['date'];
                      $email = $row['email'];
                      $sr++;

                   ?>
                  <tr>
                    <td><?php echo "$sr"; ?></td>
                    <td>
                      <img class="img-circle pull-left" src="upload/user.png" style="margin-right: 10px; width:50px;">
                      <div class="">
                        <a style="margin-top:5px;" href="#"><?php echo "$name"; ?></a><br>
                        <?php
                          if (strlen($email)>11) {$email = substr($email,0,11);}
                          echo "$email ...";
                         ?>
                      </div>
                    </td>
                    <td class="titleHover">
                    <a>
                      <b>
                       <?php echo $comment; ?>
                     </b><br>
                        <p>
                          <a class="text-yellow" href="comment.php?p=<?php echo "$id"; ?>&action=edit">Unapprove</a> |
                          <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="comment.php?t=<?php echo "$id"; ?>&action=trash">Trash</a></button>
                        </p>
                    </a>
                    </td>
                    <td><a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank"><?php echo "$title"; ?></a></td>
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
               <table class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>No</th>
                     <th style="width:20%">Author</th>
                     <th style="width:40%">Comment</th>
                     <th style="width:25%">Title</th>
                     <th style="width:10%">Date & Time</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                  $sr = 0;
                  $con = new mysqli("localhost","root","","blog");
                  $sql = "SELECT c.id,c.name,c.email,c.comment,c.date,p.title FROM comments AS c INNER JOIN posts AS p ON c.post_id = p.id WHERE comment_status = 'pending' ORDER BY id DESC";                    $result = mysqli_query($con,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      $name = $row['name'];
                      $comment = $row['comment'];
                      $date = $row['date'];
                      $email = $row['email'];
                      $sr++;

                   ?>
                  <tr>
                    <td><?php echo "$sr"; ?></td>
                    <td>
                      <img class="img-circle pull-left" src="upload/user.png" style="margin-right: 10px; width:50px;">
                      <div class="">
                        <a style="margin-top:5px;" href="#"><?php echo "$name"; ?></a><br>
                        <?php
                          if (strlen($email)>11) {$email = substr($email,0,11);}
                          echo "$email ...";
                         ?>
                      </div>
                    </td>
                    <td class="titleHover">
                    <a>
                      <b>
                       <?php echo $comment; ?>
                     </b><br>
                        <p>
                          <a class="text-green" href="comment.php?a=<?php echo "$id"; ?>&action=edit">Approve</a> |
                          <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="comment.php?t=<?php echo "$id"; ?>&action=trash">Trash</a></button>
                        </p>
                    </a>
                    </td>
                    <td><a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank"><?php echo "$title"; ?></a></td>
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
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th style="width:20%">Author</th>
                    <th style="width:40%">Comment</th>
                    <th style="width:25%">Title</th>
                    <th style="width:10%">Date & Time</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
                 $sr = 0;
                 $con = new mysqli("localhost","root","","blog");
                 $sql = "SELECT c.id,c.name,c.email,c.comment,c.date,p.title FROM comments AS c INNER JOIN posts AS p ON c.post_id = p.id WHERE comment_status = 'trash' ORDER BY id DESC";                    $result = mysqli_query($con,$sql);
                   while ($row = mysqli_fetch_array($result)) {
                     $id = $row['id'];
                     $title = $row['title'];
                     $name = $row['name'];
                     $comment = $row['comment'];
                     $date = $row['date'];
                     $email = $row['email'];
                     $sr++;

                  ?>
                 <tr>
                   <td><?php echo "$sr"; ?></td>
                   <td>
                     <img class="img-circle pull-left" src="upload/user.png" style="margin-right: 10px; width:50px;">
                     <div class="">
                       <a style="margin-top:5px;" href="#"><?php echo "$name"; ?></a><br>
                       <?php
                         if (strlen($email)>11) {$email = substr($email,0,11);}
                         echo "$email ...";
                        ?>
                     </div>
                   </td>
                   <td class="titleHover">
                   <a>
                     <b>
                      <?php echo $comment; ?>
                    </b><br>
                       <p>
                         <a class="text-green" href="comment.php?a=<?php echo "$id"; ?>&action=edit">Approve</a> |
                         <button class="linkbtn" type="submit" name="Delete"><a class="text-red" href="comment.php?d=<?php echo "$id"; ?>&action=delete">Delete</a></button>
                       </p>
                   </a>
                   </td>
                   <td><a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank"><?php echo "$title"; ?></a></td>
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




  <?php include "footer.php" ?>
</body>
