<?php require_once("global.php") ?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Modification de formation | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		
		<div class="container">
			<?php include_once("navigation.php") ?>	
			
			<div class="content">
			
			
			<?php 
			
			if(!isset($_POST['valider'])){
			
			$idFor=$_GET['modifFor'];
			
			$connexion=pg_connect($connect);
				$req="select * from formation where idFor=$idFor";
				$res= pg_query($connexion,$req);
				$row= pg_fetch_array($res);
				
				$intitule=$row[1];
				$condition=$row[2];
				$typFormation=$row[3];
				$niveau=$row[4];
				$cout=$row[5];
				$alternance=$row[6];
				$cti=$row[7];
				$rncp=$row[8];
				$contenu=$row[9];
				$datcreation=$row[10];
				$datemodif=$row[11];
				
			echo "<h1> Modification de la formation $intitule </h1>
			<p>Les champs marqués d'un '*' sont obligatoires</p>
			<form method='POST' action='modifFormation.php'>
			
			<h4> Nom de la formation * :
				<input type='text' name='intitule' size=32 maxlength=32 value='$intitule' required /></h4>
				
			<h4> Conditions d'admission (dossier,entretien) :
				<input type='text' name='condition' value='$condition' /></h4>
				
			<h4> Type de Formation : </h4>
				 Licence professionnelle<input type='radio' name='typformation' value='licence pro' ".(($typFormation=='licence pro')? 'checked' : '')." />
				 Master<input type='radio' name='typformation' value='master' ".(($typFormation=='master')? 'checked' : '')." />
				 Ecole d'ingénieur<input type='radio' name='typformation' value='ecole' ".(($typFormation=='ecole')? 'checked' : '')." />
				 Doctorat<input type='radio' name='typformation' value='doctorat' ".(($typFormation=='doctorat')? 'checked' : '')." />
				 Autre<input type='radio' name='typformation' value='autre' ".(($typFormation=='autre')? 'checked' : '')." /></br>
		
				
			<h4> Coût de la formation (par an) : 
			<input type='text' name='cout' value='$cout'>€ <br/> </h4>
			
			<h4> Alternance :<input type='radio' name='alternance' value='true' ".(($alternance=='t')? 'checked' : '')." />Oui
						<input type='radio' name='alternance' value='false' ".(($alternance=='t')? '' : 'checked')." />Non<br/> </h4>
						
			<h4> CTI<input type='radio' name='cti' value='cti' ".(($cti=='t')? 'checked' : '')." />
			RNCP<input type='radio' name='cti' value='rncp' ".(($rncp='t')? 'checked' : '')." /> </br> </h4>
			
			<h4> Contenu :</br> <TEXTAREA name='contenu'>$contenu</TEXTAREA> </br> </h4>
			
			<input type='hidden' name='idModif' value=$idFor>
			
			<input type='submit' name='valider' value='Envoyer'/>
			<input type='reset'/>
			</form>";
			 } else {
				$connexion=pg_connect($connect);
				$idFor=htmlspecialchars(addslashes($_POST['idModif']));
				$intitule=htmlspecialchars(addslashes($_POST['intitule']));
				$condition=htmlspecialchars(addslashes($_POST['condition']));
				$typFormation=htmlspecialchars(addslashes($_POST['typformation']));
				$niveau=htmlspecialchars(addslashes($_POST['niveau']));
				$cout=htmlspecialchars(addslashes($_POST['cout']));
				$alternance=htmlspecialchars(addslashes($_POST['alternance']));
				$cti=htmlspecialchars(addslashes($_POST['cti']));
				$rncp=('false');
				$contenu=htmlspecialchars(addslashes($_POST['contenu']));
				
				if(!empty($_POST['cout']) && !is_numeric($_POST['cout'])) {
					echo "<h1> Résultat Modification Formation </h1> 
					<p> Veuillez entrez un coût de formation valide. </p> 
					<a href=modifFormation.php?modifFor=$idFor > Retour </a>";
					exit();
				}
				
				if($cti=='cti'){
					$cti='true';
					} else {
						$cti='false';
						$rncp='true';
					}
					
				if ($typFormation=='ecole' || $typFormation=='master'){
					$niveau=5;
					} elseif($typFormation=='licence pro'){
						$niveau=3;
					} elseif($typFormation=='doctorat'){
						$niveau=8;
					} else {
						$niveau=4;
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
				
				$req="update formation set intitule='$intitule', conditionadmin='$condition', typformation='$typFormation',
				niveau=$niveau, cout=$cout, alternance=$alternance, cti=$cti, rncp=$rncp, contenu='$contenu', datemodif=now(), valide=false where idFor=$idFor";
				$res=pg_query($connexion,$req);
				if($res){
					echo "<h1> Résultat Modification Formation </h1> 
					<p> La formation a bien été modifiée </p>";
				} else {
					echo "<h1> Résultat Modification Formation </h1> 	
					<p> La modification de la formation a échoué</p>";
				}
					
			}
				
				
				
			?>
			
			</div>
			<?php include_once("footer.php") ?>
			
		</div>
	</body>
</html>

				
				
				
				
				
