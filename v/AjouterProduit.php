<?php
  session_start();
  // si la session n'est pas enregistrÃ© alor on n'a pas le droit d'Ãªtre dans l'espace sÃ©curisÃ©
	// donc le script renvoie vers l'index
	if (!isset($_SESSION['identifie'])) {
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="./include/styles.css" />
	<title>Mon site !</title>
</head>
<body>
	<?php 
		include("./include/header.php");
    require_once("connect.inc.php");
	?>
	<div class="wrapper">
		<?php include("./include/menusA.php"); ?>
		<section id="content">
      
      <?php
        //test si le formulaire a été envoyé
        if(isset($_POST['Envoyer'])){
          $erreur = 0;
          //vérifie si les champs sont conformes, s'ils ne le sont pas, $erreur = 1
          if((preg_match('#[0-9]{1,5}#',$_POST['idProd']) != 1 || preg_match('#0{0,}#',$_POST['idProd']) != 1) || preg_match('#[A-Z a-z0-9]{1,20}#',$_POST['nomProd']) != 1 || preg_match('#[A-Z a-z]{1,20}#',$_POST['detailProd']) != 1 || !isset($_FILES['imageProd']) || preg_match('#[0-9]{1,3}#',$_POST['poidsProd']) != 1 || preg_match('#[0-9]{1,3}#',$_POST['delaiProd']) != 1 || preg_match('#[0-9]{1,5}\.[0-9]{2}#',$_POST['prixHTprod']) != 1 || preg_match('#[0-9]{1,5}\.[0-9]{2}#',$_POST['prixHTpromoProd']) != 1 || preg_match('#[0-9]{1,2}\.[0-9]{1}#',$_POST['tauxTVAprod']) != 1){
            $erreur = 1;
          }
          //s'il n'y a pas d'erreur, on ajoute le produit à la base de données
          if($erreur == 0){
            $_POST['delaiProd'] += " jours";
            $req = $conn -> prepare("INSERT INTO Produit VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $req->execute(array($_POST['idProd'], $_POST['categories'], $_POST['nomProd'], $_POST['detailProd'], 'prod'.$_POST['idProd'].'.gif',  $_POST['estNouveauProd'], $_POST['estPromoProd'], $_POST['estSelectProd'], $_POST['poidsProd'], $_POST['estDispoProd'], $_POST['delaiProd']." jours",  $_POST['prixHTprod'], $_POST['prixHTpromoProd'], $_POST['tauxTVAprod']));
            $dest = "./images/produits/prod".$_POST['idProd'].".gif";
            move_uploaded_file($_FILES['imageProd']['tmp_name'], $dest);
            header('location:ListeProduit.php');
          }
        }
        //si le formulaire n'a pas été envoyé ou si une erreur est survenue, on affiche le formulaire
        if(!isset($_POST['Envoyer']) || $erreur == 1){
          echo "<p>Veuillez entrer les informations du nouveau produit :</p><BR/>";
          echo "<form enctype='multipart/form-data' method='post' action=".$_SERVER['PHP_SELF'].">";
          echo "<p>";
		      echo "Id du produit : <input type='text' name='idProd' /> <BR/><BR/>";
		      echo "Categorie : ";
          echo "<select name='categories'>";
          $result = $conn -> prepare("Select idCat, nomCat FROM Categorie");
          $result->execute();
          while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
		        echo "<option value='".$donnees['idCat']."'>".$donnees['nomCat']."</option>";	
          }
          $result->closeCursor();
		      echo "</select><br/><br/>";
                
          echo "Nom du produit : <input type='text' name='nomProd' /> <BR/><BR/>";
          echo "Details du produit : <input type='text' name='detailProd' /> <BR/><BR/>";
          echo "Image du produit : <input type='file' name='imageProd' accept='.gif' /> <BR/><BR/>";
          echo "Produit nouveau ? <input type='radio' name='estNouveauProd' value='1'> Oui    ";
          echo "<input type='radio' name='estNouveauProd' value='0' checked> Non <BR/><BR/>";
          echo "Produit en promo ? <input type='radio' name='estPromoProd' value='1'> Oui    ";
          echo "<input type='radio' name='estPromoProd' value='0' checked> Non <BR/><BR/>";
          echo "Produit coup de coeur ? <input type='radio' name='estSelectProd' value='1'> Oui    ";
          echo "<input type='radio' name='estSelectProd' value='0' checked> Non <BR/><BR/>";
          echo "Poids du produit : <input type='number' name='poidsProd' step='1' value='1' min='1' max='999'/> <BR/><BR/>";
          echo "Produit disponible ? <input type='radio' name='estDispoProd' value='1'> Oui    ";
          echo "<input type='radio' name='estDispoProd' value='0' checked> Non <BR/><BR/>";
          echo "Delai de livraison du produit (en jours): <input type='number' name='delaiProd' step='1' value='1' min='1' max='999'/> <BR/><BR/>";
          echo "Prix HT du produit : <input type='text' name='prixHTprod' value='100.00'/> <BR/><BR/>";
          echo "Prix HT en promo du produit : <input type='text' name='prixHTpromoProd' value='100.00' /> <BR/><BR/>";
          echo "Taux de la TVA : <input type='text' name='tauxTVAprod' value='20.0' /> <BR/><BR/>";
		      echo "<input type='submit' name='Envoyer' value='Valider' />";
          echo "</p>";
          echo "</form>";
        }
      ?>
        
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>