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
		<?php include("./include/menus.php"); ?>
		<section id="content">
      
      <?php
        //test si le formulaire a été envoyé
        if(isset($_POST['Envoyer'])){
          $erreur = 0;
          //vérifie si les champs sont conformes, s'ils ne le sont pas, $erreur = 1
          if(preg_match('#[0-9]{5}#',$_POST['postal']) != 1 || preg_match('#^0[0-9]{9}#',$_POST['tel']) != 1 || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $erreur = 1;
          }
          //s'il n'y a pas d'erreur, on ajoute le produit à la base de données
          if($erreur == 0){
            $req = $conn -> prepare("INSERT INTO Client VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
            $req->execute(array($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['postal'], $_POST['ville'], $_POST['region'], $_POST['tel'], $_POST['mail']));
            $reqCom = $conn -> prepare("SELECT MAX(idCom) FROM Commande");
            $reqCom->execute();
            $idCom = $reqCom->fetch(PDO::FETCH_NUM);
            $req = $conn -> prepare("UPDATE Commande SET idClient = (SELECT MAX(idClient) FROM Client) WHERE idCom = ?");
            $req->execute(array($idCom[0]));
            $reqCom->closeCursor();
            echo "Commande enregistree !";
          }
        }
        //si le formulaire n'a pas été envoyé ou si une erreur est survenue, on affiche le formulaire
        if(!isset($_POST['Envoyer']) || $erreur == 1){
          echo "<p>Veuillez entrer vos informations personnelles :</p><BR/>";
          echo "<form enctype='multipart/form-data' method='post' action=".$_SERVER['PHP_SELF'].">";
          echo "<p>";   
          echo "Nom  : <input type='text' name='nom' /> <BR/><BR/>";
          echo "Prenom : <input type='text' name='prenom' /> <BR/><BR/>";
          echo "Adresse : <input type='text' name='adresse' /> <BR/><BR/>";
          echo "Code postal : <input type='text' name='postal' /> <BR/><BR/>";
          echo "Ville : <input type='text' name='ville' /> <BR/><BR/>";
          echo "Region : <input type='text' name='region' /> <BR/><BR/>";
          echo "Telephone : <input type='text' name='tel' /> <BR/><BR/>";
          echo "E-mail : <input type='text' name='mail' /> <BR/><BR/>";
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