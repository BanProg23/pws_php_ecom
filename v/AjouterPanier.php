 <?php
   if(isset($_COOKIE['panier'][$_GET['idProd']])){
     $value = intval($_COOKIE['panier'][$_GET['idProd']]) + 1;
     setcookie("panier[".$_GET['idProd']."]", $value, (time() + 3600));
   } else {
     setcookie("panier[".$_GET['idProd']."]", 1, (time() + 3600));
   }
   echo $_COOKIE['panier'][$_GET['idProd']];
   header('location:VoirPanier.php');