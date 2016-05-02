<?php require_once("global.php") ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Ajout d'une formation | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>
			
			<div class="content">
		
			<h1> Ajouter une Formation </h1>
			
				<p>Les champs marqués d'un '*' sont obligatoires</p>
				
				<form action="resAjoutFormation.php" method="post">
				<h4> Intitulé de la Formation * :
				<input type="text" name="intitule" size=20 maxlength=40 required> </h4> 
				<h4> Nom Etablissement : 
				<select name="nometa">
				<?php include_once("champEtablissement.php") ?>
				</select>  </h4>
				<h4> Conditions d'admission (dossier,entretien,concours) :
				<input type="text" name="condition">  </h4>
				<h4> Type de formation : </h4>
				Licence professionnelle<input type="radio" name="typformation" value="licence pro" checked/>
				Master<input type="radio" name="typformation" value="master"/>
				Ecole d'ingénieur<input type="radio" name="typformation" value="ecole" />
				Doctorat<input type="radio" name="typformation" value="doctorat"/>
				Autre<input type="radio" name="typformation" value="autre" /> 
				
				<h4> Coût de la formation (par an): <input type="text" name="cout" size=5 maxlength=5 value="0"> € </h4>   
				<h4> Alternance :</h4> 
				Oui<input type="radio" name="alternance" value="true" />
				Non<input type="radio" name="alternance" value="false" checked/>
				
				<h4> Formation CTI ou RNCP </h4>
				CTI  <input type="radio" name="cti" value="cti"/>
				RNCP <input type="radio" name="cti" value="rncp" checked/>  
				<h4> Contenu : </br> <TEXTAREA name="contenu">Text</TEXTAREA> </h4>
				<input type="submit" name="valider" value="Envoyer"/>
				<input type="reset"/>
				</form>
			</div>
		</div>
		
		<?php include_once("footer.php") ?>
				
	</body>
</html>	
