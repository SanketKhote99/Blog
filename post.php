<?php
include "header.php"
?>

<?php

if(isset($_POST["Publish"])){
  $name = ($_POST["name"]);
  $email = ($_POST["email"]);
  $comment = ($_POST["comment"]);
  $id = ($_GET['p']);

  date_default_timezone_set("Asia/Calcutta");
  $DateTime =  date('d-M-Y h:i A');

  $sql = "INSERT INTO comments(name,email,comment,date,comment_status,post_id) VALUES('$name','$email','$comment','$DateTime','pending','$id')";
  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Comment Added Successfully !!!";
    header ("Location:post.php?p=$id");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Comment could not be Added";
    header ("Location:post.php?p=$id");
    exit;
  }
}

$id = ($_GET['p']);
$c = "SELECT * FROM comments WHERE post_id = '$id'";
$result = mysqli_query($con,$c);
$totalComment = mysqli_num_rows($result);

$s = "UPDATE posts SET comment_count = '$totalComment' WHERE id = '$id'";
mysqli_query($con, $s);

$query = mysqli_query($con," UPDATE posts SET post_view = post_view + 1 WHERE id = '$id' ");

$tc = "SELECT * FROM comments WHERE post_id = '$id' && comment_status = 'approve'";
$res = mysqli_query($con,$tc);
$tc= mysqli_num_rows($res);

$con = new mysqli("localhost","root","","blog");
$sql = "SELECT * FROM user";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_array($result);
$bio = $data['bio'];
$i = $data['img'];

 ?>

    <div class="overlay-wrapper">
      <?php
        echo ErrorMessage();
        echo SuccessMessage();
      ?>
      <?php include "nav.php"; ?>

        <section class="main-content">
            <div class="padding">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="single-post">

                              <?php
                                $id = $_GET["p"];
                                $sql = "SELECT * FROM posts WHERE id = '$id'";
                                $result = mysqli_query($con,$sql);
                                while ($row = mysqli_fetch_array($result)) {
                                  $id = $row['id'];
                                  $date = $row['date'];
                                  $title = $row['title'];
                                  $category = $row['category'];
                                  $author = $row['author'];
                                  $img = $row['img'];
                                  $post = $row['post'];
                                  $sampleText = $row['sampleText'];
                                  $current_post = $title;
                                  $current_cat = $category;
                                 ?>

                                <div class="type-standard">
                                    <article class="post type-post">
                                        <div class="top-content text-center">
                                          <span class="category"><a href="category.php?cat=<?php echo strtolower("$category"); ?>"><?php echo strtoupper("$category"); ?></a></span>
                                          <h2 class="entry-title"><a href="post.php?p=<?php echo "$id"; ?>"><?php echo "$title"; ?></a></h2>
                                          <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                                        </div>

                                        <?php if (!empty($img)): ?>
                                          <div class="entry-thumbnail"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumbnail Image"></div>
                                        <?php endif; ?>
                                        <?php if (empty($img)): ?>
                                          <div class="entry-thumbnail"><img src="admin/upload/default.jpg" alt="Thumbnail Image"></div>
                                        <?php endif; ?>

                                        <div class="entry-content">
                                            <p>
                                              <?php echo "$post";?>
                                            </p>

                                            <div class="post-meta">
                                                <span class="comments pull-left"><i class="icon_comment_alt"></i> <a href="#"><?php echo "$tc"; ?> Comments</a></span>
                                            </div>
                                        </div>
                                    </article>
                                </div>

                                <?php
                                    }
                                     mysqli_close($con);
                                ?>

                                <div class="author-bio media">
                                  <?php if (!empty($i)): ?>
                                    <div class="author-avatar media-left pull-left"><img class="img-circle" src="admin/upload/<?php echo "$i"; ?>" alt="Avatar"></div>
                                  <?php endif; ?>
                                  <?php if (empty($i)): ?>
                                    <div class="author-avatar media-left pull-left"><img class="img-circle" src="admin/upload/user.png" alt="Avatar"></div>
                                  <?php endif; ?>
                                    <div class="author-details media-body">
                                        <h3 class="name"><a href="#">Sanket Khote</a></h3>
                                        <p>
                                          <?php echo "$bio"; ?>
                                        </p>
                                        <div class="social">
                                          <a href="https://twitter.com/sanketkhote99" target="_blank"><i class="fa fa-twitter"></i></a>
                                          <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                          <a href="https://www.instagram.com/sanket.khote/" target="_blank"><i class="fa fa-instagram"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <nav class="post-navigation" role="navigation">
                                  <?php
                                  $con = new mysqli("localhost","root","","blog");
                                  $id = $_GET["p"];
                                  $sql = "SELECT * FROM posts WHERE id < '$id' ORDER BY id DESC LIMIT 1";
                                  $result = mysqli_query($con,$sql);
                                  while ($row = mysqli_fetch_array($result)) {
                                    $id = $row['id'];
                                    $date = $row['date'];
                                    $title = $row['title'];
                                    $img = $row['img'];
                                   ?>
                                    <div class="nav-links prev pull-left">
                                        <span class="meta-nav"><i class="fa fa-angle-left"></i></span>

                                        <article class="post type-post media">
                                            <div class="entry-thumbnail media-left pull-left">
                                              <?php if (!empty($img)): ?>
                                                <a href="post.php?p=<?php echo "$id"; ?>"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumb Image"></a>
                                              <?php endif; ?>
                                              <?php if (empty($img)): ?>
                                                <a href="post.php?p=<?php echo "$id"; ?>"><img src="admin/upload/default.jpg" alt="Thumb Image"></a>
                                              <?php endif; ?>
                                            </div>
                                            <div class="entry-content media-body">
                                                <h3 class="entry-title"><a href="post.php?p=<?php echo "$id"; ?>"><?php echo "$title"; ?></a></h3>
                                                <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                                            </div>
                                        </article>
                                    </div>
                                    <?php
                                        }
                                         mysqli_close($con);
                                    ?>

                                    <?php
                                    $con = new mysqli("localhost","root","","blog");
                                    $id = $_GET["p"];
                                    $sql = "SELECT * FROM posts WHERE id > '$id' ORDER BY id DESC LIMIT 1";
                                    $result = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                      $id = $row['id'];
                                      $date = $row['date'];
                                      $title = $row['title'];
                                      $img = $row['img'];
                                     ?>
                                     <div class="nav-links next pull-right">
                                          <span class="meta-nav"><i class="fa fa-angle-right"></i></span>

                                          <article class="post type-post media text-right">
                                            <div class="entry-thumbnail media-left pull-right">
                                                <?php if (!empty($img)): ?>
                                                  <a href="post.php?p=<?php echo "$id"; ?>"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumb Image"></a>
                                                <?php endif; ?>
                                                <?php if (empty($img)): ?>
                                                  <a href="post.php?p=<?php echo "$id"; ?>"><img src="admin/upload/default.jpg" alt="Thumb Image"></a>
                                                <?php endif; ?>
                                              </div>
                                              <div class="entry-content media-body">
                                                  <h3 class="entry-title"><a href="post.php?p=<?php echo "$id"; ?>"><?php echo "$title"; ?></a></h3>
                                                  <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                                              </div>
                                          </article>
                                      </div>
                                      <?php
                                          }
                                           mysqli_close($con);
                                      ?>

                                </nav>

                                <div class="widget widget_related_posts text-center">
                                    <h3 class="widget-title">YOU MAY ALSO LIKE</h3>
                                    <?php
                                      $con = new mysqli("localhost","root","","blog");
                                      $id = $_GET["p"];
                                      global $current_post;
                                      $sql = "SELECT * FROM posts WHERE category LIKE '%$current_cat%' ORDER BY id DESC LIMIT 3";
                                      $result = mysqli_query($con,$sql);
                                      while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['id'];
                                        $date = $row['date'];
                                        $title = $row['title'];
                                        $img = $row['img'];
                                     ?>
                                    <div class="widget-details">
                                        <div class="col-sm-4">
                                            <article class="post type-post">
                                                <?php if (!empty($img)): ?>
                                                  <a href="post.php?p=<?php echo "$id"; ?>"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumb Image"></a>
                                                <?php endif; ?>
                                                <?php if (empty($img)): ?>
                                                  <a href="post.php?p=<?php echo "$id"; ?>"><img src="admin/upload/default.jpg" alt="Thumb Image"></a>
                                                <?php endif; ?>
                                                <div class="entry-content">
                                                    <h3 class="entry-title"><a href="post.php?p=<?php echo "$id"; ?>"><?php echo "$title"; ?></a></h3>
                                                    <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                         mysqli_close($con);
                                    ?>
                                </div>


                                <?php if (!empty($tc)): ?>

                                <div class="comments text-center">
                                    <h3 class="comment-title"><?php echo "$tc"; ?> comments</h3>
                                    <?php
                                      $con = new mysqli("localhost","root","","blog");
                                      $id = $_GET["p"];
                                      $sql = "SELECT * FROM comments WHERE post_id = '$id' && comment_status = 'approve' ORDER BY id DESC";
                                      $result = mysqli_query($con,$sql);
                                      while ($row = mysqli_fetch_array($result)) {
                                        $date = $row['date'];
                                        $name= $row['name'];
                                        $comment = $row['comment'];
                                    ?>
                                    <ul class="comment-list">
                                        <li class="comment parent media">
                                            <div class="author-avatar media-left pull-left">
                                                <img class="img-circle" src="admin/upload/user.png" alt="Avatar">
                                            </div>
                                            <div class="comment-details media-body">
                                                <h3 class="name"><a href="#"><?php echo "$name"; ?></a></h3>
                                                <p>
                                                  <?php echo "$comment"; ?>
                                                </p>
                                                <a href="#" class="btn reply">Reply</a>
                                                <time datetime="PT04H0M"><?php echo "$date"; ?></time>
                                            </div>
                                        </li>
                                    </ul>
                                    <?php
                                        }
                                         mysqli_close($con);
                                    ?>
                                </div>
                              <?php endif; ?>

                                <div class="respond text-center">
                                    <h3 class="respond-title">Leave a reply</h3>

                                    <form action="post.php?p=<?php echo "$id"; ?>" method="post" class="comment-form">

                                        <span class="comment-form-control-wrap your-name">
                                            <input type="text" name="name" id="name" class="comment-form-control" placeholder="Name" required>
                                        </span>
                                        <span class="comment-form-control-wrap email">
                                            <input type="email" name="email" id="email" class="comment-form-control" placeholder="Email" required>
                                        </span>
                                        <span class="comment-form-control-wrap message">
                                            <textarea name="comment" id="message" rows="10" class="comment-form-control" placeholder="Your Message" required></textarea>
                                        </span>
                                        <span class="comment-form-control-wrap submit">
                                            <input type="submit" name="Publish" id="submit" class="comment-form-control" value="Publish">
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                      <?php include "sidebar.php"; ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
<script type="text/javascript">
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 1000);
</script>
