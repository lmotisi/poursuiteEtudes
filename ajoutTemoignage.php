<?php require_once("global.php");
	if($_SESSION['role']==2){
		header('location:menu.php');
	} ?>
<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Ajout d'un témoignage | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div class="container">
			<?php include_once("navigation.php")?>
			
			<div class="content">
			
			<?php
			if(!isset($_POST['valider'])){
			echo'
			
			<h1> Ajouter un témoignage </h1>
			
			<form action="ajoutTemoignage.php" method="post">
			
			<h4>Prénom : <input type="text" name="prenom" size=16 maxlength=32 required /> </br>
			Nom : <input type="text" name="nom" size=16 maxlength=32 required /> </h4>
			
			<h4>Email : <input type="text" name="email" required /> </br>
			
			<h4> Formation associée :';

			$connexion=pg_connect($connect);
			$req="select idFor, intitule, nomEta from formation f, etablissement e where e.idEta=f.idEta";
			$res=pg_exec($connexion,$req);
			echo'<select name="nomFormation">';
			while($row=pg_fetch_array($res)) {
				echo "<option value=$row[0]>$row[1] ($row[2])</options>";
			}
			echo'</select> </h4>
			<h4> Promotion :
				<input type="text" name="promotion" size=4 maxlength=4 required /> </h4>
			
			<h4> Evaluation de la formation : 
				 0<input type="radio" name="eval" value="0" checked />
				 1<input type="radio" name="eval" value="1"/>
				 2<input type="radio" name="eval" value="2" />
				 3<input type="radio" name="eval" value="3"/>
				 4<input type="radio" name="eval" value="4" /> 
				 5<input type="radio" name="eval" value="5" /> </h4>
				 
			<h4> Avis : </br>
			<TEXTAREA name="avis"></TEXTAREA> </h4>
			<input type="submit" name="valider" value="Valider"/>
			<input type="reset" />
			</form>';
			} else {
				echo "<h1> Résultat ajout témoignage </h1>";
				$prenom=htmlspecialchars(addslashes($_POST['prenom']));
				$nom=htmlspecialchars(addslashes($_POST['nom']));
				$email=htmlspecialchars(addslashes($_POST['email']));
				$idfor=htmlspecialchars(addslashes($_POST['nomFormation']));
				$promotion=htmlspecialchars(addslashes($_POST['promotion']));
				$eval=htmlspecialchars(addslashes($_POST['eval']));
				$avis=htmlspecialchars(addslashes($_POST['avis']));
				
				if(empty($prenom)||empty($nom)||empty($promotion)||empty($email)){
					echo "Veuillez entrez un nom, prénom, mail et une année de promotion
					<a href='ajoutTemoignage.php' > Retour </a>";
				}
				
				if(!empty($_POST['promotion']) && !is_numeric($promotion)) {
						echo "
						<p>Veuillez entrez une année de promotion valide.</p>
						<a href='ajoutTemoignage.php' > Retour </a>";
						exit();
				}
				
				$connexion=pg_connect($connect);
				if (pg_num_rows(pg_query($connexion, "select * from ancienetud where prenom='$prenom' and nom='$nom'")) == 0 ){
				 	pg_query($connexion, "insert into ancienetud values (default,'$nom', '$prenom', '$email')");
				}
				
				$req="select idetud from ancienetud where prenom='$prenom' and nom='$nom'";
				$res=pg_query($connexion,$req);
				$row=pg_fetch_array($res);
				$idetud=$row[0];
				
				$req2="insert into suivre values ($idfor,$idetud,$promotion,$eval)";
				$res2=pg_query($connexion,$req2);
				
				if(empty($avis)){
					$avis=null;
				}
				
				$req3="insert into temoignage values (default, '$avis', $idfor, now(), $idetud)";
				$res3=pg_query($connexion,$req3);
				
				if($res3){
					echo"Votre témoignage a bien été ajouté à la base de données.";
				} else {
					echo"L'ajout de votre témoignage a échoué";
				}
			}
			
			?>
			
			
			
			
			
			</div>
	</div>
		
	
	<?php include_once("footer.php") ?>
				
	</body>
</html>	
