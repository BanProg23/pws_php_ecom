<?php
// Cette classe servira � transferer, en mode objet, des donn�es entre le mod�le, le contr�leur et la vue
class Categorie {
	public $idCat;
    public $nomCat;

    public function __construct($idCat, $nomCat) {
        $this->idCat = $idCat;
        $this->nomCat = $nomCat;
    }
}
