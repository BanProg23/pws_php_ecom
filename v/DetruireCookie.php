<?php
  setcookie('cookIdent', 'Contenu d\'identification', time() - 1);
  header('location:index.php');
?>