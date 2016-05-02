
<?php
	if(isset($_POST['valider'])){
		
		echo "<div class='resAjout'>";
		
		if(isset($_POST['idMet'])) {
			$idMet = (htmlspecialchars($_POST['idMet'])+1.5)/3;
		}
		$nom = htmlspecialchars($_POST['nom']);
		$domaine = htmlspecialchars($_POST['domaine']);

		$connexion = pg_connect($connect);
		
		if(empty($nom)){
			echo "Veuillez entrer un nom de métier";
			
		} elseif(!empty($idMet) && pg_num_rows(pg_query($connexion,"select * from Metier where idMet='$idMet'")) > 0) {
			$req = "update Metier set nomMet='$nom'".((empty($domaine))? "" : ",domainPro='$domaine'")." where idMet='$idMet'";
			echo '$req='.$req;
			$res=pg_query($connexion,$req);
			
			if(!empty($res)){
				echo "Une fiche pour ce métier existe déjà dans la base. La fiche existante a été mise à jour.";
			} else { echo "La mise à jour dans la base de données a échoué."; }
			
		} else {
			
			$req="insert into Metier values(default,'$nom','$domaine')";
			//echo '$req='.$req;
			$res=pg_query($connexion,$req);
			
			if(!empty($res)){
				echo "Le métier a bien été ajouté à la base de données.";
			} else { echo "L'ajout dans la base de données a échoué."; }
		}
		echo "</div>";
	}
?>

