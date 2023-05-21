<?php
$current_page = 'about';
include "header.php"
?>

<?php

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $url = $_POST['url'];
  $message = $_POST['message'];

  date_default_timezone_set("Asia/Calcutta");
  $DateTime =  date('d-M-Y h:i A');

  $role = "contact";

  $sql = "INSERT INTO email(name,email,url,message,role,date) VALUES('$name','$email','$url','$message','$role','$DateTime')";
  if ($con->query($sql) === TRUE) {
    $_SESSION["SuccessMessage"] = "Message send Successfully !!!";
    header ("Location:contact.php");
    exit;
  }else {
    $_SESSION["ErrorMessage"] = "Message could not be send";
    header ("Location:contact.php");
    exit;
  }

}

 ?>

    <div class="overlay-wrapper">

      <?php include "nav.php"; ?>

        <section class="main-content">
            <div class="padding">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                          <?php
                            echo ErrorMessage();
                            echo SuccessMessage();
                          ?>
                            <div class="default-posts">
                              <section class="main-content">
                                  <div class="padding">
                                      <div class="container">
                                          <div class="contact">

                                              <div class="contact-details">
                                                  <div class="details-top text-center">
                                                      <h2 class="section-title">Get in Touch</h2>
                                                  </div>

                                                  <form action="contact.php" method="post" class="wpcf7-form">

                                                      <span class="wpcf7-form-control-wrap your-name">
                                                          <input type="text" name="name" id="name" class="wpcf7-form-control" placeholder="Name*" required>
                                                      </span>
                                                      <span class="wpcf7-form-control-wrap email">
                                                          <input type="email" name="email" id="email" class="wpcf7-form-control" placeholder="Email*" required>
                                                      </span>
                                                      <span class="wpcf7-form-control-wrap url">
                                                          <input type="url" name="url" id="url" class="wpcf7-form-control" placeholder="Website">
                                                      </span>
                                                      <span class="wpcf7-form-control-wrap message">
                                                          <textarea name="message" id="message" class="wpcf7-form-control" placeholder="Your Message*" required></textarea>
                                                      </span>
                                                      <span class="wpcf7-form-control-wrap submit">
                                                          <input type="submit" name="submit" id="submit" class="wpcf7-form-control" value="Submit">
                                                      </span>
                                                  </form>
                                              </div>
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

    <?php include "footer.php" ?>

</div>
