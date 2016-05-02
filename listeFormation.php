<?php require_once("global.php") ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Liste des formations | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>
			
			<div class="content">
		
			<?php 
				
				$connexion = pg_connect($connect);
				$req = "select idFor, intitule, typFormation, niveau, dateModif, valide from formation";
				$res = pg_query($connexion,$req);
				
				if($res){
				
				echo "<h1> Liste des formations </h1>
					<table>
						<tr>
							<th>Intitulé de la formation </th>
							<th>Type de formation</th>
							<th>Niveau</th>
							<th>Dernière modification</th>
							<th>Modification</th>";
				if($_SESSION['role']>1){
					echo"			
							<th>Suppression</th>
							<th>Validation</th>
						</tr>";
				}
				while ($row = pg_fetch_array($res)) {
					if( $row[2]== 'ecole') {
						$typFormation="école d'ingénieur";
					} else {
						$typFormation=$row[2];
					}
					if ($row[5]=='f'){
						$valide='<a href=validFormation.php?validFor='.$row[0].'> non validée </a>';
					} else {
						$valide='validée';
					}
					echo "<tr>	
							<td> $row[1] </td>
							<td> $typFormation </td>
							<td> bac+$row[3] </td>
							<td> $row[4] </td>
							<td> <a href=modifFormation.php?modifFor=$row[0]> modifier </a> </td>";
							if($_SESSION['role']>1){
								echo"
							<td> <a href=supprFormation.php?suppFor=$row[0]> supprimer </a> </td>
							<td> $valide </td>";
							}
					echo "</tr>";
				}
				echo "</table>";
				} else {
				  echo "Le chargement de la liste a échoué.";
				}
			?>
				
			</div>
		</div>	
		<?php include_once("footer.php") ?>
				
	</body>
</html>	

