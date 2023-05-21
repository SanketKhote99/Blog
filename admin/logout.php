<?php
session_start();
session_destroy();
header("location:login.php?msg=Successfully Logged out");
?>
