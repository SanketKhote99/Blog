<?php
$current_page = 'admin';
include "header.php"
?>

<?php Login(); ?>

<?php

$sql = "SELECT * FROM posts WHERE post_status NOT IN ('trash')  && type = 'post'";
$result = mysqli_query($con,$sql);
$TotalPost = mysqli_num_rows($result);

$sql = "SELECT * FROM comments";
$result = mysqli_query($con,$sql);
$TotalComment = mysqli_num_rows($result);

$sql = "SELECT sum(post_view) as TotalPostView FROM posts";
$result = mysqli_query($con,$sql);
$data = mysqli_fetch_array($result);

$sql = "SELECT * FROM category";
$result = mysqli_query($con,$sql);
$TotalCategory = mysqli_num_rows($result);

?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "nav.php" ?>

  <?php include "sidebar.php" ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php
          echo SuccessMessage();
          echo ErrorMessage();
        ?>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo "$TotalPost"; ?></h3>

              <p>Total Posts</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <a href="all_post.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo "$TotalComment"; ?></h3>

              <p>Total Comments</p>
            </div>
            <div class="icon">
              <i class="fa fa-comment"></i>
            </div>
            <a href="comment.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php
                  if (($data['TotalPostView'])>0) {
                    echo $data['TotalPostView'];
                  }else {
                    echo "0";
                  }
              ?>
            </h3>

              <p>Total Views</p>
            </div>
            <div class="icon">
              <i class="fa fa-eye"></i>
            </div>
            <a href="all_post.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo "$TotalCategory"; ?></h3>

              <p>Total Categories</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="all_user.php" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>
            </div>
            <div class="box-body">
              <div id="canvas-holder">
          			<canvas id="chart-area"  style="height:230px"/>
          		</div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-pie-chart"></i>  Most Viewed Posts</h3>
            </div>
            <?php
            $con = new mysqli("localhost","root","","blog");
             $sql = "SELECT * FROM posts WHERE type = 'post' ORDER BY post_view DESC limit 5";
             $result = mysqli_query($con,$sql);
             while ($row = mysqli_fetch_array($result)) {
               $id = $row['id'];
               $title = $row['title'];
               $sampleText= $row['sampleText'];
               $img = $row['img'];
               $post_view = $row['post_view'];

            ?>
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <?php if (!empty($img)): ?>
                      <img src="upload/<?php echo "$img"; ?>">
                    <?php endif; ?>
                    <?php if (empty($img)): ?>
                      <img src="upload/default.jpg">
                    <?php endif; ?>
                  </div>
                  <div class="product-info">
                    <a href="/blog/post.php?p=<?php echo "$id"; ?>" target="_blank" class="product-title">
                      <?php echo "$title"; ?>
                      <span class="pull-right"><?php echo "($post_view)"; ?></span>
                    </a>
                    <span class="product-description">
                      <?php echo "$sampleText"; ?>.
                    </span>
                  </div>
                </li>
              </ul>
            </div>
            <?php
              }
              mysqli_close($con);
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-file-text"></i> Recently Added Post</h3>
            </div>
            <?php
            $con = new mysqli("localhost","root","","blog");
             $sql = "SELECT * FROM posts WHERE type = 'post' ORDER BY id DESC limit 5";
             $result = mysqli_query($con,$sql);
             while ($row = mysqli_fetch_array($result)) {
               $id = $row['id'];
               $title = $row['title'];
               $sampleText= $row['sampleText'];
               $img = $row['img'];
            ?>
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <?php if (!empty($img)): ?>
                      <img src="upload/<?php echo "$img"; ?>">
                    <?php endif; ?>
                    <?php if (empty($img)): ?>
                      <img src="upload/default.jpg">
                    <?php endif; ?>
                  </div>
                  <div class="product-info">
                    <a href="/blog/post.php?p=<?php echo "$id"; ?>" target="_blank" class="product-title">
                      <?php echo "$title"; ?>
                    </a>
                    <span class="product-description">
                      <?php echo "$sampleText"; ?>.
                    </span>
                  </div>
                </li>
              </ul>
            </div>
            <?php
              }
              mysqli_close($con);
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-comment"></i>
              <h3 class="box-title">Latest Comments</h3>
            </div>
            <?php
              $con = new mysqli("localhost","root","","blog");
              $sql = "SELECT c.id,c.name,c.comment,p.title FROM comments AS c INNER JOIN posts AS p ON (c.post_id = p.id) ORDER BY id DESC limit 5";
              $result = mysqli_query($con,$sql);
              while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $comment = $row['comment'];
                $title = $row['title'];

             ?>
            <div class="box-body">
              <img class="img-circle pull-left" src="upload/user.png" style="margin-right: 10px; width:50px;">
                <p>
                  From <b><?php echo "$name"; ?></b> on <a href="../post.php?p=<?php echo "$id"; ?>&Preview=true" target="_blank"><?php echo "$title"; ?></a><br>
                  <?php
                    if (strlen($comment)>40) {$comment = substr($comment,0,40)."...";}
                    echo $comment;
                   ?>
                </p>
            </div>
            <?php
              }
              mysqli_close($con);
            ?>
          </div>
        </div>
      </div>
    </section>

  </div>

  <?php include "footer.php" ?>
  <script src="chart/Chart.js"></script>

<script>
<?php $TotalViews = $data['TotalPostView'] ?>
  var doughnutData = [
      {
        value: <?php echo "$TotalPost"; ?>,
        color:"#00c0ef",
        highlight: "#00A7D0",
        label: "Post"
      },
      {
        value: <?php echo "$TotalComment"; ?>,
        color: "#00a65a",
        highlight: "#008D4C",
        label: "Comments"
      },
      {
        value: <?php echo "$TotalViews"; ?>,
        color: "#f56954",
        highlight: "#D33724",
        label: "Views"
      }

    ];

    window.onload = function(){
      var ctx = document.getElementById("chart-area").getContext("2d");
      window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
    };

</script>

</body>
