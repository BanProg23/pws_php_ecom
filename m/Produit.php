<?php
// Cette classe servira à transferer, en mode objet, des données entre le modèle, le contrôleur et la vue
class Produit {
	public $idProd;
    public $idCat;
    public $nomProd;
    public $detailProd;
	public $imageProd;
	public $estNouveauProd;
	public $estPromoProd;
	public $estSelectProd;
	public $poidsProd;
	public $estDispoProd;
	public $delaiProd;
	public $prixHTprod;
	public $prixHTpromoPro;
	public $tauxTVAprod;

    public function __construct($idProd, $idCat, $nomProd, $detailProd, $imageProd, $estNouveauProd, $estPromoProd, $estSelectProd, $poidsProd, $estDispoProd, $delaiProd, $prixHTprod, $prixHTpromoPro, $tauxTVAprod) {
        $this->idProd = $idProd;
        $this->idCat = $idCat;
        $this->nomProd = $nomProd;
		$this->detailProd = $detailProd;
		$this->imageProd = $imageProd;
		$this->estNouveauProd = $estNouveauProd;
		$this->estPromoProd = $estPromoProd;
		$this->estSelectProd = $estSelectProd;
		$this->poidsProd = $poidsProd;
		$this->estDispoProd = $estDispoProd;
		$this->delaiProd = $delaiProd;
		$this->prixHTprod = $prixHTprod;
		$this->prixHTpromoPro = $prixHTpromoPro;
		$this->tauxTVAprod = $tauxTVAprod;
    }
}
