<?php
	// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
	// donc le script renvoie vers l'index
	if (!isset($_SESSION['identifie'])) {
		header('location:index.php');
	}
  require_once("connect.inc.php");
  
  $sql = file_get_contents("RazBase.sql");
  $sql_array = explode(";\r",$sql);
  foreach ($sql_array as $val) { 
    $conn->query($val);
  }
  
  header('location:index.php');