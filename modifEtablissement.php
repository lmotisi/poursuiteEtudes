<?php require_once("global.php"); 
if(!isset($_SESSION['role']) || $_SESSION['role']<2) { header("location:connexion.php"); }
?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Modification d'établissement | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>	
			
			<div class="content">
				<h1>Modifier un établissement</h1>
				<p>Les champs marqués d'un '*' sont obligatoires</p>
			
				<?php
				
				if(isset($_POST['modifier'])) {
					$connexionModif = pg_connect($connect);
				
					if($connexionModif) {
					
						$idModif = htmlspecialchars($_POST['idEta']+1.5)/3;
						$reqModif = "select * from Etablissement where idEta=$idModif";
						$resModif = pg_query($connexionModif,$reqModif);
					
						// This request always matches, since we come from the database query results list. So we don't need to check whether the query is valid.
					
						$row = pg_fetch_array($resModif);
						$nomModif = $row[1];
						$rueModif = $row[2];
						$cpModif = $row[3];
						$villeModif = $row[4];
						$siteWebModif = $row[5];
						$anneeModif = $row[6];
						$public = $row[7];
						/*foreach($_POST as $i) {
							echo ' i:'.$i;
						}*/
					
						echo "
						<form method='POST' action='ajoutEtablissement.php'>
					
						<input type='hidden' name='idEta' value='".($idModif*3-1.5)."'/>
					
						<h4>Nom de l'établissement * 
						<input type='text' name='nom' size=32 maxlength=32 value=\"$nomModif\"/></h4>
		
						<h4>
						Rue <input type='text' name='rue' size=50 maxlength=64 value=\"$rueModif\" /></br>
						Ville <input type='text' name='ville' size=25 maxlength=32 value=\"$villeModif\" />
						Code Postal <input type='text' size=5 maxlength=5 name='cp' value=\"$cpModif\" />
						</h4>
		
						<h4>Site Web 
						<input type='text' name='siteWeb' size=50 maxlength=64 value=\"$siteWebModif\"/></h4>
		
						<h4>Année de création 
						<input type='text' name='anneeCreation' size=4 maxlength=4 value=\"$anneeModif\"/></h4>
		
						<h4>
						<input type='radio' name='public' value='false' ".(($public=='t')? '' : 'checked')." />Privé
						<input type='radio' name='public' value='true' ".(($public=='t')? 'checked' : '')." />Public<br/>
						</h4>
		
						<h4>Région
						<select name='region' selected='ile de france'>
							<option value='ile de france'>Ile de France</option>
						</select></h4>
		
						<input type='submit' name='valider' value='Valider'>
						<input type='reset' />
		
						</form>";
					
						include_once("ajoutEtablissement2.php");

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
