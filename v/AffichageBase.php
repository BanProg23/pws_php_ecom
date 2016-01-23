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
        <h1>Afficher la base</h1>
        <BR/><BR/>
        <p>Selectionner les tables a afficher</p>
        <BR/>
        <form method='post'>
        <?php
          $result = $conn -> prepare("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'base48'");
          $result->execute();
          while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
            echo"<input type=\"checkbox\" name=\"tables[]\" value=\"".$donnees['TABLE_NAME']."\"/>".$donnees['TABLE_NAME']."</br></br>";
          }
          echo"<input type=\"submit\" name='submit' value='Valider'/>";
          echo"</form>";
          echo "<BR/><BR/>";	
          
          if(isset($_POST['tables'])){
            foreach($_POST['tables'] as $nom){
            
              echo "$nom :";
              echo "<BR/>";	
              echo "<center><table align='center' border='2' >";
  						echo "<tr>";
              $result = $conn -> prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$nom'");
              $result->execute();
              while($donnees = $result->fetch(PDO::FETCH_ASSOC)){
                echo"<th>".$donnees['COLUMN_NAME']."</th>";
              }
              echo "</tr>";
                $result2 = $conn -> prepare("SELECT * FROM $nom");
                $result2->execute();
                while($donnees2 = $result2->fetch(PDO::FETCH_ASSOC)){
		              echo "<tr>";
                  foreach($donnees2 as $attribut => $valeur) {
								    echo "<td>".$valeur."</td>";
                  }
                  echo"</tr>";
			  	      }	
              $result->closeCursor();
              echo "</table></center>";	
              echo "<BR/><BR/>";
            }
          }	
			?>
		</section>
	</div>
	<?php include("./include/footer.php"); ?>
</body>
</html>