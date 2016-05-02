<?php require_once("global.php") ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Résultat d'ajout d'une formation | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php") ?>
			
			<div class="content">
			<?php
				$connexion = pg_connect($connect);
				if(isset($_POST["valider"])){
					
					$intitule=addslashes($_POST['intitule']);
					$ideta=addslashes($_POST['nometa']);
					$condition=addslashes($_POST['condition']);
					$typformation=addslashes($_POST['typformation']);
					$cout=addslashes($_POST['cout']);
					$alternance=addslashes($_POST['alternance']);
					$cti=addslashes($_POST['cti']);
					$rncp=addslashes($_POST['rncp']);
					$contenu=addslashes($_POST['contenu']);
					
					if(empty($_POST['intitule'])){
						echo "<h1> Résultat Ajout Formation </h1> 
						<p>Veuillez entrer un nom de formation.</p>
						<a href='ajoutFormation.php' > Retour </a>";	
						exit();
					}
						
					if(!empty($_POST['cout']) && !is_numeric($cout)) {
						echo "<h1> Résultat Ajout Formation </h1> 
						<p>Veuillez entrez un coût de formation valide.</p>
						<a href='ajoutFormation.php' > Retour </a>";
						exit();
					}
						
					
					if ($typformation=='ecole' || $typformation=='master'){
						$niveau=5;
					} else {
						if($typformation=='licence pro'){
								$niveau=3;
						} else {
							if($typformation=='doctorat'){
								$niveau=8;
							} else {
								$niveau=4;
							}
						}
					}
										
					
					if($cti=='cti'){
						$cti='true';
						$rncp='false';
					} else {
						$cti='false';
						$rncp='true';
					}
			
					if(empty($_POST['condition'])){
						$condition='null';
					}
					
					if(empty($_POST['cout'])) {
						$cout='null';
					}
					
					if(empty($_POST['contenu'])){
						$contenu='null';
					}
					echo'<h1> Résultat Ajout Formation </h1>';
					$connexion = pg_connect($connect);
					$req="insert into formation values(default,'$intitule','$condition','$typformation',$niveau,$cout,$alternance,$cti,$rncp,'$contenu',now(),now(),$ideta,false)";
					$res=pg_query($connexion,$req);
					if($res){
						echo "<p> La formation a bien été ajoutée à la base de données. </p>";
					} else {
						"<p> La suppression de la formation de la base de données a échoué </p>";
					}
						
					
				}
				
					
			?>
			</div>
		</div>	
		<?php include_once("footer.php") ?>
				
	</body>
</html>	
