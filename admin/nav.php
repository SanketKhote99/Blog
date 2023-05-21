
<?php
$con = new mysqli("localhost","root","","blog");
$i = $_SESSION['User_Id'];
$sql = "SELECT * FROM user WHERE id = '$i'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$id = $row['id'];
$user = $row['username'];
$img = $row['img'];

 ?>
 <?php Login(); ?>


<header class="main-header">
  <a href="index.php" class="logo">
    <span class="logo-lg"><b>B</b>log</span>
  </a>
  <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <i class="fa fa-bell-o"></i>
             <span class="label label-warning">40</span>
           </a>
           <ul class="dropdown-menu">
             <li class="header">You have 40 notifications</li>
             <li>
               <ul class="menu">
                 <li>
                   <a href="#">
                     <i class="fa fa-comment text-aqua"></i> 5 new comments
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-users text-yellow"></i> 17 New Visitors
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-bullhorn text-red"></i> 2 new Feedback
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-archive text-green"></i> 15 New Subscribtion
                   </a>
                 </li>
                 <li>
                   <a href="#">
                     <i class="fa fa-user text-red"></i> You changed your username
                   </a>
                 </li>
               </ul>
             </li>
             <li class="footer"><a href="#">View all</a></li>
           </ul>
         </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if (!empty($img)): ?>
                <img src="upload/<?php echo "$img"; ?>" class="user-image" alt="User Image">
              <?php endif; ?>
              <?php if (empty($img)): ?>
                <img src="upload/user.png" class="user-image" alt="User Image">
              <?php endif; ?>
              <span class="hidden-xs"><?php echo "$user"; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <?php if (!empty($img)): ?>
                  <img src="upload/<?php echo "$img"; ?>" class="img-circle" alt="User Image">
                <?php endif; ?>
                <?php if (empty($img)): ?>
                  <img src="upload/user.png" class="img-circle" alt="User Image">
                <?php endif; ?>

                <p>
                  Sanket Khote - Web Developer
                  <small>Member since Nov. 2022</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php?profile=<?php echo "$id"; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>
