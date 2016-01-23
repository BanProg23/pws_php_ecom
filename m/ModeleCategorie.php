<?php
include_once("Categorie.php");
include_once("Connect.inc.php");

class ModeleCategorie {
	// methode qui renvoie un tableau d'objets Categories
	// ce tableau est construit à partir d'une requête SQL sur la table Categorie de la BD
    public function getListeProduit() {
		// cette instruction permet d'utiliser dans cette fonction la variable $conn 
		// qui a été initialisée dans le script connect.inc.php
		global $conn;
		$res = $conn->prepare("Select * from Categorie");
		$res->execute();			
		foreach($res as $cat) {
		    $ListeCat[] = new Categorie($prod["idCat"], $prod["nomCat"]);
 		}
		return $ListeCat; 
    }
		
   public function supprCategorie($idCat) {
      global $conn;
      $result = $conn -> prepare("DELETE FROM Categorie WHERE idCat = ? AND idCat NOT IN (SELECT idCat FROM Produit)");
      $result->execute(array($idCat));
   }
}
