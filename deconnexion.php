<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Déconnexion</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div id="deconnexion">
			
			<?php
				session_start();
				session_destroy();
				unset($_SESSION);
			?>
		
			<p> Vous avez bien été déconnecté. </p>
			
		</div>
		
		<?php include_once("footer.php") ?>
	</body>
</html>
