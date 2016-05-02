<?php require_once("global.php") ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Recherche de Formation | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>
		
			<div class="content">
				<h1>Recherche de formation</h1>
				<h4> Choisissez des critères de recherche :</h4>	
		
				<form action="affichFormation.php" method="post">
					
					<div class=rechercheFormation>
					<h2> Etablissement </h2>
					<input type="radio" name="etablissement" value="false" checked/> <h3 class='resItem'> Privé </h3> <br/>
					<input type="radio" name="etablissement" value="true"/> <h3 class='resItem'> Public </h3> <br/>
					</div>
					
					<div class=rechercheFormation>
					<h2> Formation </h2>
						<h3 class='resItem' >Alternance : </h3> Oui <input type="radio" name="alternance" value="true"/> 
								     Non <input type="radio" name="alternance" value="false" checked /> </br>
						<h3 class='resItem'> Formation CTI ou RNCP :</h3> 
						CTI<input type="radio" name="cti" value="cti" />
						RNCP<input type="radio" name="cti" value="rncp" checked /><br/>
					</div>
					
					<div class=rechercheFormation>
					<h2> Niveau d'étude <h2>
					<select name="niveau">
						<option value=3>Bac +3</options>
						<option value=4>Bac +4</options>
						<option value=5>Bac +5</options>
						<option value=8>Bac +8</options>
					</select>
					</div>
					
					<div class=rechercheFormation>
					<h2> Région <h2>
					<select name="region">
						<option value="ile de france">Ile de France</options>
					</select>
					</div> </br>
					
					<input type="submit" name="valider" value="Valider"/>
					<input type="reset" />

				</form>
			</div>
		</div>
		
		<?php include_once("footer.php") ?>
		
	</body>
</html>	
