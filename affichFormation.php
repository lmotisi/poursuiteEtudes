<?php require_once("global.php") ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Résultats de la recherche | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>
			
			<div class="content">
			<?php
				if(isset($_POST["valider"])){
					$etablissement =htmlspecialchars(addslashes($_POST["etablissement"]));
					$formation =htmlspecialchars(addslashes($_POST['formation']));
					$alternance=htmlspecialchars(addslashes($_POST['alternance']));
					$cti=htmlspecialchars(addslashes($_POST['cti']));
					$rncp='false';
					$niveau=htmlspecialchars(addslashes($_POST["niveau"]));
					$region=htmlspecialchars(addslashes($_POST["region"]));
				
					if($cti=='cti'){
						$cti='true';
						} else {
							$cti='false';
							$rncp='true';
					}
					
					$connexion = pg_connect($connect);
					$req="select f.idFor, intitule, nometa, region from formation f, etablissement e where e.ideta=f.ideta and public=$etablissement and region='$region' and alternance=$alternance and cti=$cti and rncp=$rncp and niveau=$niveau";
					$res= pg_query($connexion,$req);
					echo"<h1> Résultats de la Recherche </h1>";
					if (pg_num_rows($res) > 0) {
					echo "
						<table>
							<tr>
								<th>Intitulé de la formation </th>
								<th>Nom de l'établissement </th>
								<th>Région </th>
								<th>Moyenne des avis </th>
							</tr>";
					while ($row = pg_fetch_array($res)) {
						$idFor=$row[0];
						$req2="select round(avg(avis),2) from formation, suivre where formation.idFor=$idFor and formation.idFor=suivre.idFor";
						$res2=pg_query($connexion,$req2);
						$row2=pg_fetch_array($res2);
						echo "<tr> 
								 <td><a href=affichDetailsFormation.php?idFor=$row[0]>$row[1]</a></td> 
								 <td>$row[2]</td> 
								 <td>$row[3]</td>
								 <td>";
								if(pg_num_rows(pg_query($connexion, "select avis from formation f, suivre s where f.idFor=$idFor and f.idFor=s.idFor"))>0){
									echo"$row2[0]";
								} else {
									echo"Pas d'avis";
								}
								echo	"</td>
							  </tr>";
					
					}	
					echo" </table> </br>
					<p> Cliquez sur le nom de la formation pour plus de détails... </p>";
					} else {
					echo "Aucune formation ne correspond à vos critères de recherche. </br>
					<a href='selectFormation.php' > Retour </a>";
					}
				
				}
			?>
			</div>
		</div>
		
		<?php include_once("footer.php") ?>
				
	</body>
</html>	

