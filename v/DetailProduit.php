<?php
  // si la session n'est pas enregistré alor on n'a pas le droit d'être dans l'espace sécurisé
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
        <h1>Detail Produit</h1>
        <BR/><BR/>
        <?php
              echo "<center><table align='center' border='2' >";
  						echo "<tr>";
              $result = $conn -> prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'Produit'");
              $result->execute();
              while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
                echo"<th>".$donnees['COLUMN_NAME']."</th>";
              }
              $result->closeCursor();
              echo "</tr>";
                $result = $conn -> prepare("SELECT * FROM Produit WHERE idProd = ?");
                $result->execute(array($_GET["idProd"]));
                $donnees = $result->fetch(PDO::FETCH_ASSOC);
		              echo "<tr>";
                  echo "<td>".$donnees['idProd']."</td>";
                  echo "<td>".$donnees['idCat']."</td>";
                  echo "<td>".$donnees['nomProd']."</td>";
                  echo "<td>".$donnees['detailProd']."</td>";
                  echo "<td>".$donnees['imageProd']."</td>";
                  echo "<td>".$donnees['estNouveauProd']."</td>";
                  echo "<td>".$donnees['estPromoProd']."</td>";
                  echo "<td>".$donnees['estSelectProd']."</td>";
                  echo "<td>".$donnees['poidsProd']."</td>";
                  echo "<td>".$donnees['estDispoProd']."</td>";
                  echo "<td>".$donnees['delaiProd']."</td>";
                  if($donnees['estPromoProd'] == 1){
                    echo "<td><s>".$donnees['prixHTprod']."</s></td>";
                    echo "<td><b>".$donnees['prixHTpromoPro']."</b></td>";
                  } else {
                    echo "<td>".$donnees['prixHTprod']."</td>";
                    echo "<td>".$donnees['prixHTpromoPro']."</td>";
                  }
                  echo "<td>".$donnees['tauxTVAprod']."</td>";
                  echo"</tr>";
              echo "</table></center>";
              if($donnees['estNouveauProd'] == 1){
                echo"<img src=\"images/new.jpg\" border=\"0\" />";
              }
              if($donnees['estPromoProd'] == 1){
                echo"<img src=\"images/promotion.png\" border=\"0\" />";
              }
              if($donnees['estSelectProd'] == 1){
                echo"<img src=\"images/selection.png\" border=\"0\" />";
              }
              $result->closeCursor();
              echo "<BR/><BR/>";
              
              if(isset($_POST['submit'])){
                echo "<form method='post'>";
                echo"<input type=\"submit\" name='cache' value='Cacher les produits proposes avec cet article'/>";
                echo"</form>";
                echo "<BR/><BR/>";
                echo "<center><table align='center' border='2' >";
  						  echo "<tr><th>Id Produit</th><th>Nom Produit</th><th>Image Produit</th></tr>";	
                $result = $conn -> prepare("SELECT idProd, nomProd, imageProd FROM Produit, Proposer WHERE idProd = idProd2 AND idProd1 = ? ORDER BY nbFois DESC, idProd2");
                $result->execute(array($_GET["idProd"]));
						    while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
		              echo "<tr>";
                  echo "<td>".$donnees['idProd']."</td>";
                  echo "<td>".$donnees['nomProd']."</td>";
                  echo "<td><a href=\"DetailProduit.php?idProd=$donnees[idProd]\"><img src=\"images/produits/".$donnees['imageProd']."\" border=\"0\" /></a></td>";
                }
                $result->closeCursor();
                echo "</table></center>";	
                echo "<BR/><BR/>";
              } else {
                echo "<form method='post'>";
                echo"<input type=\"submit\" name='submit' value='Afficher les produits proposes avec cet article'/>";
                echo"</form>";
              }
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>