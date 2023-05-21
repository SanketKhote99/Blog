
<?php


function menu(){
  $con = new mysqli("localhost","root","","blog");
  $sql = "SELECT * FROM posts WHERE type = 'page' && post_status NOT IN('trash')";
  $result = mysqli_query($con,$sql);
  while ($row = mysqli_fetch_array($result)) {
    $title = $row['title'];
    $url = strtolower($title);

  echo "<li class=\"menu-item\"><a href=\"page.php?page=$url\">$title</a></li>";

  }
}

 ?>


<header class="masthead">
    <div class="header-top">
        <div class="container">
            <div class="side-menu-trigger"><span class="trigger-icon"><i class="icon_menu"></i></span></div>
            <a class="navbar-brand hidden-xs" href="./"><img src="admin/upload/logo.png" alt="Site Logo"></a>
            <!-- <a class="navbar-brand hidden-xs" href="./">Coding Script</a> -->
            <div class="menu-search">
                <div class="form-trigger"><i class="icon_search"></i></div>
                <form role="form" action="index.php" method="post">
                    <input type="text" name="search" id="search" placeholder="Search here..">
                    <button hidden="hidden" type="submit" name="searchbtn"></button>
                </form>
            </div>

            <nav class="sidebar-menu">
                <a class="navbar-brand" href="./"><img src="admin/upload/logo.png" alt="Site Logo"></a>
                <span class="menu-close"><i class="icon_close"></i></span>

                <ul class="nav navbar-nav">
                  <?php menu(); ?>


                <li class="menu-item"><a href="contact.php">Contact</a></li>


                </ul>

                <div class="menu-social">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </nav>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <nav class="navbar navbar-default">
                <div id="main-menu" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <?php menu(); ?>

                      <li class="menu-item"><a href="contact.php">Contact</a></li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
