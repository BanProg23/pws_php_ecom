<?php
include_once("./m/ModeleProduit.php");
class ControleurProduit {
	
    private $modeleProd;
	
    public function __construct() {
          $this->modeleProd = new ModeleProduit();
    }
	
	public function getListeProduits() {
        $vListeProduits = $this->modeleProd->getListeProduits();
        include '/v/ListeProduit.php';
	} 
	
    public function getProduit($idProd) {
		$vProd = $this->modeleProd->getProduit($idProd);
        include '/v/VueProduit.php';
    }
    
    public function supprProduit($idProd) {
        $vProd = $this->modeleProd->getProduit($idProd);
        include '/v/VueProduit.php';
    }
	   
}
