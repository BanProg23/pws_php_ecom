<?php
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
          //vérifie si l'id et le nom sont conformes, s'ils ne le sont pas, $erreur = 1
          if(preg_match('#[4-9]00#',$_POST['idCat']) != 1 || preg_match('#[A-Za-z]{3,25}#',$_POST['nomCat']) != 1){
            $erreur = 1;
          }
          //s'il n'y a pas d'erreur, on ajoute la table à la base de données
          if($erreur == 0){
            $req = $conn -> prepare("INSERT INTO Categorie VALUES(:pIdCat, :pNomCat)");
            $req->execute(array('pIdCat' => $_POST['idCat'], 'pNomCat' => $_POST['nomCat']));
            header('location:ListeCategories.php');
          }
        }
        //si le formulaire n'a pas été enoyé ou si une erreur est survenue, on affiche le formulaire
        if(!isset($_POST['Envoyer']) || $erreur == 1){
          echo "<p>Veuillez entrer les informations de la nouvelle categorie :</p><BR/>";
          echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
          echo "<p>";
		      echo "Id de la categorie : <input type='text' name='idCat' /> <BR/><BR/>";
		      echo "Nom de la categorie : <input type='text' name='nomCat' /><BR/><BR/>";
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