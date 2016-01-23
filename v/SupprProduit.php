<?php
	// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
	// donc le script renvoie vers l'index
	if (!isset($_SESSION['identifie'])) {
		header('location:index.php');
	}
  require_once("connect.inc.php");
  $result = $conn -> prepare("DELETE FROM Proposer WHERE (idProd1 = :idP OR idProd2 = :idP) AND :idP NOT IN (SELECT idProd FROM DetailCommande)");
  $result->execute(array(":idP" => $_GET["idProd"]));
  $result = $conn -> prepare("DELETE FROM Produit WHERE idProd = :idP AND :idP NOT IN (SELECT idProd FROM DetailCommande)");
  $result->execute(array(":idP" => $_GET["idProd"]));
  unlink("images/produits/prod$_GET[idProd].gif");
  header('location:ListeProduit.php');