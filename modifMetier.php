<?php require_once("global.php") ?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Modification de métier | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>	
			
			<div class="content">
				<h1>Mettre à jour un métier</h1>
				<p>Les champs marqués d'un '*' sont obligatoires</p>
			
				<?php
			
				if(isset($_POST['modifier'])) {
					$connexionModif = pg_connect($connect);
				
					if($connexionModif) {
					
						$idModif = htmlspecialchars($_POST['idMet']);
						$reqModif = "select * from Metier where idMet=$idModif";
						$resModif = pg_query($connexionModif,$reqModif);
					
						// This request always matches, since we come from the database query results list. So we don't need to check whether the query is valid.
					
						$row = pg_fetch_array($resModif);
						$nomModif = $row[1];
						$domaineModif = $row[2];
					
						echo "
						<form method='POST' action='ajoutMetier.php'>
					
						<input type='hidden' name='idMet' value='".($idModif*3-1.5)."'/>
					
						<h4>Nom du métier * : 
						<input type='text' name='nom' size=50 maxlength=64 value='$nomModif'/></h4>
		
						<h4>Domaine Professionnel
						<input type='text' name='domaine' size=32 maxlength=32 value='$domaineModif' /></h4><br/>
					
						<input type='submit' name='valider' value='Valider'>
						<input type='reset' />
		
						</form>";
					
						include_once("ajoutMetier2.php");

					} else {
						echo "Connection au serveur impossible.";
					}
				}
			
				?>
			</div>
		</div>	
			
			<?php include_once("footer.php") ?>
	</body>
</html>
