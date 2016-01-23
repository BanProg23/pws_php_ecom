<?php
//session_start();
  // si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
	// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
	/*if (!isset($_SESSION['identifie']) AND !isset($_SESSION['admin'])) {
		header('location:v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!');
	}*/
require_once './c/ControleurProduit.php';
require_once './c/ControleurCategorie.php';

class Routeur {
 
    // Route une requête entrante : exécution la bonne méthode de contrôleur en fonction de l'URL 
    public function routerRequete() {
		// s'il y a un parametre 'entite'
        if (isset($_GET['entite'])) {
			// on détermine avec quelle entité on veut travailler
			switch($_GET['entite']) {
				case 'produit' : 
					// on détermine quelle action (CRUD) on veut effectuer sur l'entité choisie 
					switch($_GET['action']) {
						case 'C' :  // 'C' = Create = ajout d'un produit...
									// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
									// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
									if (!isset($_SESSION['identifie'])) {
										include 'v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!';
									}
									break;
						case 'R' : 	// 'R' = Read = lecture des étudiants ou d'un seul s'il y a un parametre id
									if (isset($_GET['id'])) {
										$ctrlProd = new ControleurProduit();
										$ctrlProd->getProduit($_GET['id']);
									}
									else {
										$ctrlProd = new ControleurProduit();
										$ctrlProd->getListeProduit();
									}
									break;
						case 'U' : 	// 'U' = Update = modification d'un étudiant à partir de son id
									// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
									// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
									if (!isset($_SESSION['identifie'])) {
										include 'v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!';
									}
									break;
						case 'D' : 	// 'D' = Delete = suppression d'un étudiant à partir de son id
									// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
									// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
									if (!isset($_SESSION['identifie'])) {
										include 'v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!';
									}
                   $ctrlProd = new ControleurProduit();
									$ctrlProd->supprProduit($_GET['id']);
									break;
						default: 	// pour toutes les autres valeurs du parametre 'action', on affiche la liste des produits 
									$ctrlProd = new ControleurProduit();
									$ctrlProd->getListeProduits();
									break;			
					}
					break;
					
				case 'categorie' : 
					switch($_GET['action']) {
						case 'C' :  // 'C' = Create = ajout d'un groupe...
									// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
									// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
									if (!isset($_SESSION['identifie'])) {
										include 'v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!';
									}
									break;
						case 'R' : 	// 'R' = Read = lecture des groupes ou d'un seul s'il y a un parametre id
									if (isset($_GET['id'])) {
										$ctrlCat = new ControleurCategorie();
										$ctrlCat->getListeProduitsByCategorie($_GET['id']);
									}
									else {
										$ctrlCat = new ControleurCategorie();
										$ctrlCat->getListeCategorie();
									}
									break;

						case 'U' : 	// 'U' = Update = modification d'un groupe à partir de son id
									// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
									// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
									if (!isset($_SESSION['identifie'])) {
										include 'v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!';
									}
									break;
						case 'D' : 	// 'D' = Delete = suppression d'un groupe à partir de son id
									// si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
									// donc le script renvoie vers le formulaire de connexion avec un message d'erreur à afficher
									if (!isset($_SESSION['identifie'])) {
										include 'v/formConnexion.php?msgErreur=Interdiction d\'acceder à l\'espace sécurisé sans identification !!!';
									}
                  $ctrlCat = new ControleurCategorie();
									$ctrlCat->supprCategorie($_GET['id']);
									break;
						default: 	// pour toutes les autres valeurs, on affiche la liste des groupes 
									$ctrlCat = new ControleurCategorie();
									$ctrlCat->getListeCategorie();
									break;			
					}
					break;
					
					
				default: 	// pour toutes les autres valeurs du parametre 'entite', on affiche la liste des groupes 
							$ctrlCat = new ControleurCategorie();
							$ctrlCat->getListeCategorie();
							break;			
			}
		}
		// aucune paramètre 'entite' : on va � la page index.php de la vue.
        else {  
			    include './v/index.php' ;
        }          
    }
}
