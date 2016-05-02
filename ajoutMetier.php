<?php require_once("global.php") ?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Ajout de métier | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>	
			
			<div class="content">
				<h1>Ajouter/Mettre à jour un métier</h1>
				<p>Les champs marqués d'un '*' sont obligatoires</p>
			
				<form method="POST" action="ajoutMetier.php">
			
					<h4>Nom du métier * : </h4>
					<input type="text" size=40 name="nom" /><br/>
				
					<h4>Domaine professionnel</h4>
					<input type="text" size=60 name="domaine" /><br/><br/>
				
					<input type="submit" name="valider" value="Valider">
					<input type="reset" />
				
				</form>
			
				<?php include_once("ajoutMetier2.php") ?>
			</div>
		</div>
		
		<?php include_once("footer.php") ?>
	</body>
</html>
