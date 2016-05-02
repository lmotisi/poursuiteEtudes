<?php require_once("global.php") ?>
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
		
		<div class="container">
			<?php include_once("navigation.php") ?>
		
			<div class="content" id="menuPrincipal">
			
				<h1>Bienvenue sur la plateforme PoursuiteEtudes !</h1>
				<p>
				Il s’agit dans ce projet de créer une plateforme de recherche de formation pour l'orientation des étudiants en DUT Informatique. Cette plateforme sera intégrée dans l'intranet de l'IUT et devra recenser des fiches de formations possibles après un dut informatique, les établissements qui proposent ces formations, les métiers pouvant être exercés à la suite de ces formations, ainsi que des témoignages d'anciens élèves ayant effectués les formations et des entretiens de professionnels exerçant les métiers proposés.	
				</p>
			
				<?php include_once("sessionDebug.php") ?>
			
			</div>
		</div>
			
		<?php include_once("footer.php") ?>
	</body>
</html>
