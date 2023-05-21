<?php
$current_page = 'category';
include "header.php"
?>

<?php Login(); ?>

<?php

if(isset($_POST["Submit"])){
  $Category = ($_POST["Category"]);
  $slug = strtolower("$Category");

  if(empty($Category)){
    $_SESSION["ErrorMessage"] = "Filled the Category";
    header ("Location:category.php");
    exit;
  }elseif (strlen($Category)>15) {
    $_SESSION["ErrorMessage"] = "Name is too long";
    header ("Location:category.php");
    exit;
  }else {
    $sql = "SELECT * FROM category WHERE name  = '$Category'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) > 0)
    {
      $_SESSION["ErrorMessage"] = "Category already exit";
      header ("Location:category.php");
      exit;
    }else {
      $sql = "INSERT INTO category(name,slug) VALUES('$Category','$slug')";
      if ($con->query($sql) === TRUE) {
        $_SESSION["SuccessMessage"] = "Category Successfully Added !!!";
        header ("Location:category.php");
        exit;
      }else {
        $_SESSION["ErrorMessage"] = "Category could not be Added";
        header ("Location:category.php");
        exit;
    }
  }
 }
}


if (isset($_GET['d']) && isset($_GET['action'])) {
  $con = new mysqli("localhost","root","","blog");
  $d = $_GET['d'];
  ($action = $_GET['action']) == "delete";
  $sql = "DELETE FROM category WHERE id = '$d'";

  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Category Deleted Successfully !!!";
    header ("Location:category.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Category could not be Deleted";
    header ("Location:category.php");
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
      <h1>
        Categories
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Category</h3>
           </div>
           <div class="box-body">
             <div class="row">
               <div class="col-md-12">

                  <form role="form" action="category.php" method="post">
                   <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="Category" class="form-control" id="categoryname" placeholder="Enter Category Name">
                      <span class="help-block">*The name is how it appears on your site.</span>
                    </div>
                  </div>

                  <div class="box-footer">
                    <button type="submit" name="Submit" class="btn btn-primary col-md-offset-4">Submit</button>
                  </div>
                </form>

               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Category</h3>
            </div>
            <div class="box-body">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Count</th>
                </tr>
              </thead>
              <tbody>
                          <?php
                            $sr = 0;
                            $sql = "SELECT * FROM category ORDER BY id DESC";
                            $result = mysqli_query($con,$sql);
                            while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $slug = $row['slug'];

                            $sq = "SELECT count(*) as total FROM posts WHERE category_id = '$id'";
                            $res = mysqli_query($con,$sq);
                            $row = mysqli_fetch_array($res);
                            $total = $row['total'];
                            $sr++;

                          ?>
                        <tr>
                          <td><?php echo "$sr"; ?></td>
                          <td class="titleHover">
                          <a href="#">
                             <b>
                              <?php echo $name ?>
                            </b><br>
                              <p>
                                <button class="linkbtn" type="submit" name="Trash"><a class="text-red" href="category.php?d=<?php echo "$id"; ?>&action=delete">Delete</a></button>
                              </p>
                          </a>
                          </td>
                          <td><?php echo "$slug"; ?></td>
                          <td><?php echo "$total"; ?></td>
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
  </div>

  <?php include "footer.php" ?>

</body>
