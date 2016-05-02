<?php require_once("global.php"); ?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Liste des établissements | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
	
	<?php include_once("header.html") ?>
	
	<div class="container">
		<?php include_once("navigation.php") ?>	
		
		<div class="content">
			<h1>Liste des établissements</h1>
		
			<?php
			
			if(isset($_POST['supprimer'])) { include_once("supprEtablissement.php"); }
			
			$connexion = pg_connect($connect);
			
			if($connexion) {
				
				$req="select * from Etablissement order by nomEta ASC";
				$res = pg_query($connexion,$req);
			
				if($res) {
					while($row=pg_fetch_array($res)) {
				
						$public = (($row[7]=='t')? 'public' : 'privé' );
				
						echo "
						<div class='resultat'>
						<h2>$row[1]</h2>
						<h3 class='resItem'>Etablissement $public</h3><br/>
						<h3 class='resItem'>Adresse : </h3>$row[2], $row[3] $row[4]<br/>
						<h3 class='resItem'>Année de création : </h3>$row[6]<br/>
						<h3 class='resItem'>Région : </h3>$row[8]<br/>
						<h3 class='resItem'>Site Web : </h3>$row[5]<br/><br/>";
						if($_SESSION['role'] > 1) {
						echo "
						<form class='hidden' method='POST' action='modifEtablissement.php'>
						<input type='hidden' name='idEta' value=".($row[0]*3-1.5).">
						<input type='submit' name='modifier' value='Modifier'>
						</form>
						<form class='hidden' method='POST' action='listeEtablissement.php'>
						<input type='hidden' name='idEta' value=".($row[0]*3-1.5).">
						<input type='submit' name='supprimer' value='Supprimer'>
						</form>";
						}
						echo "</div>";	
					}	
				} else {
					echo "Le chargement de la liste a échoué.";
				}
			} else {
				echo "Connection au serveur impossible.";
			}
			?>
		</div>
	</div>
			
	<?php include_once("footer.php") ?>
			
	</body>
</html>
