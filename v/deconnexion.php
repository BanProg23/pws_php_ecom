<?php
  session_start();
  session_destroy();
  unset($_SESSION['identifie']);
  header('location:index.php');
?>