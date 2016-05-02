<?php require_once("global.php"); 
if(!isset($_SESSION['role']) || $_SESSION['role']<2) { header("location:connexion.php"); }
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Ajout d'établissement | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>	
			
			<div class="content">
				
				<h1>Ajouter/Mettre à jour un établissement</h1>				
				<p>Les champs marqués d'un '*' sont obligatoires</p>
				
				<form method="POST" action="ajoutEtablissement.php">
			
					<h4>Nom de l'établissement * 
					<input type="text" name="nom" size=32 maxlength=32 /></h4>
				
					<h4>
					Rue <input type="text" name="rue" size=50 maxlength=64 /><br/>
					Ville <input type="text" name="ville" size=25 maxlength=32 />
					Code Postal <input type="text" size=5 maxlength=5 name="cp" />
					</h4>
				
					<h4>Site Web
					<input type="text" name="siteWeb" size=50 maxlength=64 /></h4>
				
					<h4>Année de création 
					<input type="text" name="anneeCreation" size=4 maxlength=4 /></h4>
				
					<h4>
					<input type="radio" name="public" value="false" checked/>Privé
					<input type="radio" name="public" value="true" />Public<br/>
					</h4>
				
					<h4>Région
					<select name="region" selected="ile de france">
						<option value="ile de france">Ile de France</option>
					</select></h4>
				
					<input type="submit" name="valider" value="Valider">
					<input type="reset" />
				
				</form>
				
				<?php include_once("ajoutEtablissement2.php") ?>
				
			</div>
			
			<?php include_once("footer.php") ?>
		</div>
	</body>
</html>
