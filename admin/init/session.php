<?php

  session_start();

  function ErrorMessage(){
    if (isset($_SESSION["ErrorMessage"])) {
      $Output = "<div class=\"alert alert-danger\" role=\"alert\">";
      $Output.=htmlentities($_SESSION["ErrorMessage"]);
      $Output.="</div>";
      $_SESSION["ErrorMessage"] = null;
      return $Output;
    }
  }

  function SuccessMessage(){
    if (isset($_SESSION["SuccessMessage"])) {
      $Output = "<div class=\"alert alert-success\" role=\"alert\">";
      $Output.=htmlentities($_SESSION["SuccessMessage"]);
      $Output.="</div>";
      $_SESSION["SuccessMessage"] = null;
      return $Output;
    }
  }

function Login(){
  if (!isset($_SESSION["User_Id"])) {
    header ("Location:login.php");
    exit;
  }
}

 ?>
