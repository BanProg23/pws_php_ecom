<?php
// ControleurCategorie.php
include_once("./m/ModeleCategorie.php");
include_once("./m/ModeleProduit.php");
class ControleurCategorie {  
	private $modeleCat;
	private $modeleProd;
    
	public function __construct() {
        $this->modeleCat = new ModeleCategorie();
		$this->modeleProd = new ModeleProduit();  
    }
	
	public function getlisteCategories() {
        $vListeCategories = $this->modeleCat->getListeCategories();
        include 'v/VueListeCategories.php';
    }
	
	public function getListeProduitsByCategorie($idCat) {
		$vListeProduits = $this->modeleProd->getListeProduitsByCategorie($idCat);
        include 'v/VueListeProduits.php';
    }
    
  public function supprCategorie($idCat) {
    $this->modeleCat->supprCategorie($idCat);
    include 'v/ListeCategories.php';
  }
}
