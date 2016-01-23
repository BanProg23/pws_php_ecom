<?php session_start(); ?>
<!Doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Hello</title>
		<link rel="stylesheet" type="text/css" href="./include/styles.css" />
	</head>
	<body>
		<?php
			include("./include/header.php");
	    if (isset($_SESSION['identifie'])) {
		    include("./include/menusA.php");
	    } elseif(isset($_SESSION['admin'])) {
        include("./include/menusAdmin.php");
      } else {
			  include("./include/menus.php");
      }
			include("./include/footer.php");?>
		
	</body>
</html>