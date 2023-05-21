<?php

$con = new mysqli("localhost","root","","blog");
$sql = "SELECT * FROM user";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_array($result);
$bio = $data['bio'];
$img= $data['img'];

if (isset($_POST['Subscribe'])) {
  $email = $_POST['email'];
  $name = $_POST['name'];


  date_default_timezone_set("Asia/Calcutta");
  $DateTime =  date('d-M-Y h:i A');

  $role = "subscribe";
  $message = "Got New subscription";

  $sql = "INSERT INTO email(name,email,message,role,date) VALUES('$name','$email','$message','$role','$DateTime')";
  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Subscribe Successfully !!!";
    header ("Location:index.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Could not be Subscribe";
    header ("Location:index.php");
    exit;
  }

}

 ?>

<div class="col-sm-4">
 <aside class="sidebar text-center">
     <div class="widget widget_about_author">
         <h3 class="widget-title">About me</h3>
         <div class="widget-details">
           <?php if (!empty("$img")): ?>
             <div class="author-avatar"><img src="admin/upload/<?php echo "$img"; ?>" alt="Avatar" class="img-circle"></div>
           <?php endif; ?>
           <?php if (empty("$img")): ?>
             <div class="author-avatar"><img src="admin/upload/user.png" alt="Avatar" class="img-circle"></div>
           <?php endif; ?>
             <p>
               <?php echo "$bio"; ?>
             </p>
             <div class="author-social">
                 <a href="https://twitter.com/sanketkhote99" target="_blank"><i class="fa fa-twitter"></i></a>
                 <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                 <a href="https://www.instagram.com/sanket.khote/" target="_blank"><i class="fa fa-instagram"></i></a>
             </div>
         </div>
     </div>

     <div class="widget widget_newsletter">
         <h3 class="widget-title">Newsletter</h3>
         <div class="widget-details">
           <h2>Subscribe Us!</h2>
           <p style="font-size:13px;">Get Awesome updates delivered directly in your inbox .
           <br/>Just Type Your Email Address Below And Click Subscribe!</p>
             <form class="mc4wp-form" method="post" action="sidebar.php">
                 <div class="mc4wp-form-fields">
                    <input class="form-control" type="text" name="name" placeholder="Enter Name" required><br>
                    <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                    <input type="submit" class="form-control" name="Subscribe" value="Subscribe">
                 </div>
                 <div class="mc4wp-response"></div>
             </form>
         </div>
     </div>

     <div class="widget widget_recent_posts">
         <h3 class="widget-title">Category</h3>
         <?php
            $con = new mysqli("localhost","root","","blog");
            $sql = "SELECT * FROM posts GROUP BY category";
             $result = mysqli_query($con,$sql);
             while ($row = mysqli_fetch_array($result)) {
               $category = $row['category'];
          ?>
         <div class="widget-details">
           <p><a class="pull-left" href="category.php?cat=<?php echo strtolower("$category"); ?>"><i class="fa fa-angle-double-right"></i> <?php echo "$category"; ?></a><br></p>
         </div>
         <?php
          }
          mysqli_close($con);
        ?>
     </div>

     <div class="widget widget_recent_posts">
         <h3 class="widget-title">Recent Posts</h3>
         <?php
            $con = new mysqli("localhost","root","","blog");
             $sql = "SELECT * FROM posts ORDER BY id DESC limit 5";
             $result = mysqli_query($con,$sql);
             while ($row = mysqli_fetch_array($result)) {
               $id = $row['id'];
               $title = $row['title'];
               $img = $row['img'];
               $date = $row['date'];
          ?>
         <div class="widget-details">
             <article class="post type-post media">
               <?php if (!empty($img)): ?>
                 <div class="entry-thumbnail media-left pull-left"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumb Image"></div>
               <?php endif; ?>
               <?php if (empty($img)): ?>
                 <div class="entry-thumbnail media-left pull-left"><img src="admin/upload/default.jpg" alt="Thumb Image"></div>
               <?php endif; ?>
                 <div class="entry-content media-body">
                     <h3 class="entry-title">
                       <a href="post.php?p=<?php echo "$id"; ?>">
                        <?php echo "$title"; ?>
                      </a>
                     </h3>
                     <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                 </div>
             </article>
         </div>
         <?php
          }
          mysqli_close($con);
        ?>
     </div>

     <div class="widget widget_recent_posts">
         <h3 class="widget-title"> Most Viewed Posts</h3>
         <?php
            $con = new mysqli("localhost","root","","blog");
            $sql = "SELECT * FROM posts ORDER BY post_view DESC limit 5";
             $result = mysqli_query($con,$sql);
             while ($row = mysqli_fetch_array($result)) {
               $id = $row['id'];
               $title = $row['title'];
               $img = $row['img'];
          ?>
         <div class="widget-details">
             <article class="post type-post media">
               <?php if (!empty($img)): ?>
                 <div class="entry-thumbnail media-left pull-left"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumb Image"></div>
               <?php endif; ?>
               <?php if (empty($img)): ?>
                 <div class="entry-thumbnail media-left pull-left"><img src="admin/upload/default.jpg" alt="Thumb Image"></div>
               <?php endif; ?>
                 <div class="entry-content media-body">
                     <h3 class="entry-title">
                       <a href="post.php?p=<?php echo "$id"; ?>">
                        <?php echo "$title"; ?>
                      </a>
                     </h3>
                     <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                 </div>
             </article>
         </div>
         <?php
          }
          mysqli_close($con);
        ?>
     </div>

     <div class="widget widget_ad">
         <div class="widget-details">
           <?php
             $con = new mysqli("localhost","root","","blog");
             $sql = "SELECT * FROM pictures WHERE status = 'ad'";
             $result = mysqli_query($con,$sql);
             while ($data = mysqli_fetch_array($result)) {
                $ad= $data['img'];
                $link= $data['link'];
            ?>
             <a href="<?php echo $link ?>" class="ad-banner"><img src="admin/upload/<?php echo $ad ?>" alt="Ad Banner"></a><hr>
           <?php  } ?>
         </div>
     </div>
 </aside>
</div>
