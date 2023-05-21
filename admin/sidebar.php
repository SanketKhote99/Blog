<?php
$con = new mysqli("localhost","root","","blog");
$pending = "SELECT * FROM comments WHERE Comment_status = 'pending'";
$result = mysqli_query($con,$pending);
$PendingComment = mysqli_num_rows($result);
 ?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="<?php if ($current_page == 'admin'){echo 'active';} ?>">
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($current_page == 'all_post'){echo 'active';} ?>"><a href="all_post.php"><i class="fa fa-circle-o"></i> All Posts</a></li>
            <li class="<?php if ($current_page == 'new_post'){echo 'active';} ?>"><a href="new_post.php"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li class="<?php if ($current_page == 'category'){echo 'active';} ?>"><a href="category.php"><i class="fa fa-circle-o"></i> Category</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($current_page == 'all_page'){echo 'active';} ?>"><a href="all_page.php"><i class="fa fa-circle-o"></i> All Pages</a></li>
            <li class="<?php if ($current_page == 'new_page'){echo 'active';} ?>"><a href="new_page.php"><i class="fa fa-circle-o"></i> Add New</a></li>
          </ul>
        </li>
        <li class="<?php if ($current_page == 'comment'){echo 'active';} ?>">
          <a href="comment.php">
            <i class="fa fa-comment"></i> <span>Comments</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow"><?php echo $PendingComment; ?></small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-o"></i>
            <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($current_page == 'inbox'){echo 'active';} ?>"><a href="inbox.php"><i class="fa fa-circle-o"></i> Inbox</a></li>
            <li class="<?php if ($current_page == 'compose'){echo 'active';} ?>"><a href="compose.php"><i class="fa fa-circle-o"></i> Compose</a></li>
            <li class="<?php if ($current_page == 'read'){echo 'active';} ?>"><a href="read.php"><i class="fa fa-circle-o"></i> Read</a></li>
          </ul>
        </li>
        <li class="<?php if ($current_page == 'index'){echo 'active';} ?>">
          <a href="../index.php" target="_blank">
            <i class="fa fa-external-link"></i> <span>Live Site</span>
          </a>
        </li>
        <li class="header"></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gear"></i>
            <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($current_page == 'general'){echo 'active';} ?>"><a href="general.php"><i class="fa fa-circle-o"></i> General</a></li>
          </ul>
        </li>
    </ul>
  </section>
</aside>
