<?php
$current_page = 'index';
include "header.php"
?>

<?php
$showRecordPerPage = 2;
if(isset($_GET['page']) && !empty($_GET['page'])){
$currentPage = $_GET['page'];
}else{
$currentPage = 1;
}
$startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
$con = new mysqli("localhost","root","","blog");
$totalEmpSQL = "SELECT * FROM posts";
$allEmpResult = mysqli_query($con, $totalEmpSQL);
$totalEmployee = mysqli_num_rows($allEmpResult);
$lastPage = ceil($totalEmployee/$showRecordPerPage);
$firstPage = 1;
$nextPage = $currentPage + 1;
$previousPage = $currentPage - 1;
?>

    <div class="overlay-wrapper">

      <?php include "nav.php"; ?>

        <section class="main-content">
            <div class="padding">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                          <?php
                              if (isset($_POST['searchbtn']) || empty($_POST['searchbtn'])) {
                                if (isset($_POST['searchbtn'])) {
                                  $Search = $_POST['search'];
                                  $sql = "SELECT * FROM posts WHERE title LIKE '%$Search%' && type = 'post' ORDER BY id DESC LIMIT $startFrom, $showRecordPerPage";
                              }else {
                                  $sql = "SELECT * FROM posts WHERE post_status = 'Publish' && type = 'post' ORDER BY id DESC LIMIT $startFrom, $showRecordPerPage";
                              }

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
                               ?>
                            <div class="default-posts">
                                <article class="post type-post col-sm-6 full-width">
                                  <?php if (!empty($img)): ?>
                                    <div class="entry-thumbnail"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumbnail Image"></div>
                                  <?php endif; ?>
                                  <?php if (empty($img)): ?>
                                    <div class="entry-thumbnail"><img src="admin/upload/default.jpg" alt="Thumbnail Image"></div>
                                  <?php endif; ?>
                                    <div class="entry-content">
                                        <span class="category"><a href="category.php?cat=<?php echo strtolower("$category"); ?>"><?php echo strtoupper("$category"); ?></a></span>
                                        <h2 class="entry-title"><a href="post.php?p=<?php echo "$id"; ?>"><?php echo "$title"; ?></a></h2>
                                        <span class="time"><?php if (strlen($date)>11) {$date = substr($date,0,11);} echo $date ?></span>
                                        <p>
                                          <?php echo "$sampleText";?>
                                        </p>

                                        <a href="post.php?p=<?php echo "$id"; ?>">
                                          <span type="submit" name="ReadMore" class="btn">Read More</span>
                                        </a>
                                        <div class="post-meta">
                                          <?php

                                          $tc = "SELECT * FROM comments WHERE post_id = '$id' && comment_status = 'approve'";
                                          $res = mysqli_query($con,$tc);
                                          $tc= mysqli_num_rows($res);

                                           ?>
                                            <span class="comments pull-left"><i class="icon_comment_alt"></i> <a href="#"><?php echo "$tc"; ?> Comments</a></span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php
                                }
                              }
                                 mysqli_close($con);
                            ?>
                            <ul class="pagination" style="display: flex;justify-content: center;">
                            <?php if($currentPage != $firstPage) { ?>
                            <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                            </a>
                            </li>
                            <?php } ?>
                            <?php if($currentPage >= 2) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
                            <?php } ?>
                            <li class="page-item active"><a class="page-link" href="index.php?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
                            <?php if($currentPage != $lastPage) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
                            <li class="page-item">
                            <a class="page-link" href="index.php?page=<?php echo $lastPage ?>" aria-label="Next">
                            <span aria-hidden="true">Last</span>
                            </a>
                            </li>
                            <?php } ?>
                            </ul>
                       </div>
                    <?php include "sidebar.php"; ?>
                </div>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?>

</div>
