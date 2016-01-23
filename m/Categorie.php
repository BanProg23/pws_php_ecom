<?php
// Cette classe servira à transferer, en mode objet, des données entre le modèle, le contrôleur et la vue
class Categorie {
	public $idCat;
    public $nomCat;

    public function __construct($idCat, $nomCat) {
        $this->idCat = $idCat;
        $this->nomCat = $nomCat;
    }
}
