<?php
$current_page = 'page';
include "header.php"
?>


<div class="overlay-wrapper">

  <?php include "nav.php"; ?>

    <section class="main-content">
        <div class="padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                          <section class="main-content">
                                  <div class="container">
                                      <div class="page" style="height:25vh;">
                                        <?php
                                        $name = $_GET['page'];
                                        $sql = "SELECT * FROM posts WHERE type = 'page' && title = '$name' && post_status NOT IN('trash')";
                                        $result = mysqli_query($con,$sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                          $title = $row['title'];
                                          $detail = $row['post'];
                                         ?>
                                          <div class="details">
                                            <div class="details-top text-center">
                                                <h2 class="section-title"><?php echo $title ?></h2>
                                            </div>
                                             <p>
                                                <?php echo $detail ?>
                                             </p>
                                          </div>
                                        <?php } ?>
                                      </div>
                                  </div>
                              </div>
                          </section>
                      </div>
                 </div>
            </div>
        </div>
    </div>
</section>

</div>
