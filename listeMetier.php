<?php require_once("global.php"); ?>
<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Liste des métiers | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
	
	<?php include_once("header.html") ?>
	
	<div class="container">
		<?php include_once("navigation.php") ?>	
		
		<div class="content">
			<h1>Liste des métiers</h1>
		
			<?php
			
			if(isset($_POST['supprimer'])) {
				include_once("supprMetier.php");
			}
			
			$connexion = pg_connect($connect);
			
			if($connexion) {
				
				$req="select * from Metier order by nomMet ASC";
				$res = pg_query($connexion,$req);
			
				if($res) {
					while($row=pg_fetch_array($res)) {
				
						echo "
						<div class='resultat'>
						<h2>$row[1]</h2>
						<h3 class='resItem'>Domaine Professionnel : </h3>$row[2]<br/><br/>";
						if($_SESSION['role'] > 1) {
						echo "
						<form class='hidden' method='POST' action='modifMetier.php'>
						<input type='hidden' name='idMet' value=$row[0]>
						<input type='submit' name='modifier' value='Modifier'>
						</form>
						<form class='hidden' method='POST' action='listeMetier.php'>
						<input type='hidden' name='idMet' value=$row[0]>
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
