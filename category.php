<?php
include "header.php"
?>

<?php $cat = $_GET['cat']; ?>

    <div class="overlay-wrapper">

      <?php include "nav.php"; ?>
      <?php include "banner.php"; ?>

        <section class="main-content">
            <div class="padding">
                <div class="container">
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="categories text-center">
                            <div class="details-top">
                            <h2 class="section-title">Category - <?php echo $cat ?></h2>
                            </div>
                              <?php
                                if (isset($_POST['searchbtn']) || empty($_POST['searchbtn'])) {
                                  if (isset($_POST['searchbtn'])) {
                                    $Search = $_POST['search'];
                                    $sql = "SELECT * FROM posts WHERE title LIKE '%$Search%' ORDER BY id DESC";
                                }else {
                                    $sql = "SELECT * FROM posts WHERE post_status = 'Publish' && category = '$cat' ORDER BY id DESC";
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
                              <div class="col-sm-4">
                                <article class="post type-post">
                                  <?php if (!empty($img)): ?>
                                    <div class="entry-thumbnail"><img src="admin/upload/<?php echo "$img"; ?>" alt="Thumbnail Image"></div>
                                  <?php endif; ?>
                                  <?php if (empty($img)): ?>
                                    <div class="entry-thumbnail"><img src="admin/upload/default.jpg" alt="Thumbnail Image"></div>
                                  <?php endif; ?>
                                  <div class="entry-content">
                                    <h2 class="entry-title"><a href="post.php?p=<?php echo "$id"; ?>"><?php echo "$title"; ?></a></h2>
                                        <p>
                                          <?php echo "$sampleText";?>
                                        </p>

                                        <a href="post.php?p=<?php echo "$id"; ?>">
                                          <span type="submit" name="ReadMore" class="btn">Read More</span>
                                        </a>
                                    </div>
                                </article>
                              </div>

                              <?php
                                  }
                                }
                                   mysqli_close($con);
                              ?>
                        </div>
                    </div>
                    <?php include "sidebar.php"; ?>
                  </div>
                </div>
            </div>
        </section>

        <?php include "footer.php" ?>

    </div>
