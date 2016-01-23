<?php
  // si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
	// donc le script renvoie vers l'index
	if (!isset($_SESSION['identifie'])) {
		header('location:index.php');
	}
  require_once("connect.inc.php");
  if(isset($_POST['name'])) {
    if(!empty($_POST['name'])) {    
      $result = $conn -> prepare("UPDATE Categorie SET nomCat = ? WHERE idCat = ?");
      $result->execute(array($_POST["name"], $_GET["idCat"]));
    }
  }
  header('location:ListeCategories.php');