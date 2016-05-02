<?php 
	session_start();
	//echo 'session='.$_SESSION['login'];
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Poursuite d'études | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
	
		<?php include_once("header.html") ?>
		
		<div id="accueil">
			
			<div class="breadcrumb"><a href="/">Accueil</a> » <a href="/Intranet/VieScolaire" class="active">Intranet</a></div>
			<ul>
				<li><a>Emploi du temps</a></li>
				<li><a>Absences</a></li>
				<li><a>Moodle</a></li>
				<li><a>Calendriers</a></li>
				<li><a>Bibliothèque</a></li>
				<li><a>Trombinoscopes</a></li>
				<li><a>Webmail</a></li>
				<li><a>GLPI (demande au CCRI)</a></li>
				<li><a>Changer son mot de passe</a></li>
				<li><a>Configurations courriel et internet</a></li>
				<li><a href="connexion.php">Poursuite d'études</a></li>
			</ul>
		</div>
	
		<?php include_once("footer.php") ?>
	</body>
</html>


