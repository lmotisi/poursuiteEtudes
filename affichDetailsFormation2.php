<?php require_once("global.php") ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Détails de la formation| IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>
			
			<div class="content">
			<?php
				if(isset($_GET['idFor'])) {
					$idFor=$_GET['idFor'];
					$connexion = pg_connect($connect);
					$req1="select intitule, nomEta, conditionAdmin, typFormation, cout, alternance, cti, rncp, contenu, siteweb, rue, cp, ville from formation f, etablissement e where e.ideta=f.ideta and f.idFor=$idFor";
					$res1= pg_query($connexion,$req1);
					$row1= pg_fetch_array($res1);
					
					echo "<h1> Détails de la formation $row1[0]</h1>
					<div class='rechercheFormation' >
					<h2> Informations Etablissement </h2>
					<h3 class=resItem> Nom : </h3> $row1[1] </br>
					<h3 class=resItem> Adresse : </h3> $row1[10], $row1[11] $row1[12] </br>
					<h3 class=resItem> Site Web : </h3>";
					if($row1[9]) {
						echo "$row1[9]";
					} else {
						echo"A compléter..";
					}
					echo"</br>
					</div>
					
					<div class='rechercheFormation'>
					<h2> Caractéristiques de la formation </h2>
					<h3 class=resItem> Conditions d'admission : </h3>";
					if($row1[2]!='null') {
						echo "$row1[2]";
					} else {
						echo"A compléter..";
					}
					echo"</br>";
						if ($row1[3]=='ecole'){
							$typFormation='Ecole d\'ingénieur';
							echo "<h3 class=resItem>Type de formation : </h3>$typFormation </br>";
						} else {
							echo "<h3 class=resItem> Type de formation : </h3> $row1[3] </br>";
						}
						
					echo"<h3 class=resItem> Coût de la formation (par an) : </h3> $row1[4]€</br>";
						if($row1[5]=='f'){
							$alternance='non';
						} else {
							$alternance='oui';
						}
					echo "<h3 class=resItem> Formation disponible en alternance : </h3> $alternance </br>";
						if($row1[6]=='f'){
							$cti='non';
						} else {
							$cti='oui';
						}
					echo "<h3 class=resItem> Habilitation CTI : </h3> $cti </br>";
						if($row1[7]=='f'){
								$rncp='non';
							} else {
								$rncp='oui';
							}
					echo "<h3 class=resItem> RNCP : </h3> $rncp </br>
					</div>
					
					<div class='rechercheFormation'>
						 <h2> Description de la formation </h2> </br>
						 $row1[8] </br>
					</div>";
					
						 
					$req2="select nommet from formation f, viser v, metier m where f.idFor=v.idFor and v.idMet=m.idMet and f.idFor=$idFor";
					$res2=pg_query($connexion,$req2); 
					$i=1;
					
					
					echo "
						<div class=rechercheFormation>
						<h2> Autres </h2>
						<h3 class=resItem> Métiers visés : </h3> ";
						if(pg_num_rows($res2)>0){
							while($row2=pg_fetch_array($res2)){
								if($i<pg_num_rows($res2)){
									echo "$row2[0], ";
								} else {
									echo "$row2[0]";
								}
							$i++;	
							 }
						} else {
							echo "A compléter...";
						}
						
					echo"</br>"; 
					
					$req3="select nom, prenom, email, fichiertem, dattem from suivre s, ancienetud a, temoignage t where s.idEtud=a.idEtud and s.idfor=t.idfor and s.idetud=t.idetud and t.idfor=$idfor";
					$res3=pg_query($connexion,$req3);	
					
					echo "<h3 class=resItem> Anciens étudiants ayant effectués la formation : </h3> </br>";
					if (pg_num_rows($res3)>0){
						 while($row3=pg_fetch_array($res3)){
							echo "$row3[0] $row3[1], $row3[2] </br>";
						 }
					} else {
						echo"A compléter...";
					}
					echo'</div>';
					
			}
			?>
			</div>
		</div>
		
		<?php include_once("footer.php") ?>
				
	</body>
</html>	


