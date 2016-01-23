<?php
include_once("Produit.php");
include_once("Connect.inc.php");

class ModeleProduit {
	// methode qui renvoie un tableau d'objets Produits
	// ce tableau est construit à partir d'une requête SQL sur la table Produit de la BD
    public function getListeProduits() {
		// cette instruction permet d'utiliser dans cette fonction la variable $conn 
		// qui a été initialisée dans le script connect.inc.php
		global $conn;
		$res = $conn->prepare("Select * from Produit");
		$res->execute();			
		foreach($res as $prod) {
		    $ListeProd[] = new Produit($prod["idProd"], $prod["idCat"], $prod["nomProd"], $prod["detailProd"], $prod["imageProd"], $prod["estNouveauProd"], $prod["estPromoProd"], $prod["estSelectProd"], $prod["poidsProd"], $prod["estDispoProd"], $prod["delaiProd"], $prod["prixHTprod"], $prod["prixHTpromoPro"], $prod["tauxTVAprod"]);
 		}
		return $ListeProd; 
    }
	
    public function getProduit($idProduit) {
		global $conn;
		$res = $conn->prepare("Select * from Produit where idEtudiant = :pIdProduit");
		$res->execute(array('pIdProduit' => $idProduit));
		$etu = $res->fetch();
		$unProduit = new Produit($prod["idProd"], $prod["idCat"], $prod["nomProd"], $prod["detailProd"], $prod["imageProd"], $prod["estNouveauProd"], $prod["estPromoProd"], $prod["estSelectProd"], $prod["poidsProd"], $prod["estDispoProd"], $prod["delaiProd"], $prod["prixHTprod"], $prod["prixHTpromoPro"], $prod["tauxTVAprod"]);
        return $unProduit;
    }	
	
	public function getListeProduitsByCategorie($idCat) {
		global $conn;
		$res = $conn->prepare("Select * from Produit where idCat = :pIdCat");
		$res->execute( array ('pIdCat' => $idCat) );			
		foreach($res as $prod) {
		    $ListeProdCat[] = new Produit($prod["idProd"], $prod["idCat"], $prod["nomProd"], $prod["detailProd"], $prod["imageProd"], $prod["estNouveauProd"], $prod["estPromoProd"], $prod["estSelectProd"], $prod["poidsProd"], $prod["estDispoProd"], $prod["delaiProd"], $prod["prixHTprod"], $prod["prixHTpromoPro"], $prod["tauxTVAprod"]);
 		}
		return $ListeProdCat; 
    }		
    
    public function supprProduit($idProd) {
      global $conn;
      $result = $conn -> prepare("DELETE FROM Proposer WHERE (idProd1 = :idP OR idProd2 = :idP) AND :idP NOT IN (SELECT idProd FROM DetailCommande)");
      $result->execute(array(":idP" => $_GET["idProd"]));
      $result = $conn -> prepare("DELETE FROM Produit WHERE idProd = :idP AND :idP NOT IN (SELECT idProd FROM DetailCommande)");
      $result->execute(array(":idP" => $_GET["idProd"]));
    }
    
}
