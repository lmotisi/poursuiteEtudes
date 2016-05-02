<p>
<?php
if(!isset($_SESSION['role']) || $_SESSION['role']<2) { header("location:connexion.php"); }

	if(isset($_POST['supprimer'])) {
		echo "Suppression demandée.</br>";
		
		$idEta = htmlspecialchars($_POST['idEta']+1.5)/3;
		
		$connexion = pg_connect($connect);
		
		if($connexion) {
			$testreq = "select * from Etablissement e, Formation f where e.idEta=$idEta and e.idEta=f.idEta";
			//echo '$testreq='.$testreq;
			if(pg_num_rows(pg_query($connexion,$testreq)) == 0) {
				$req="delete from Etablissement where idEta=$idEta";
				//echo '$req='.$req;
				$res=pg_query($connexion,$req);
				
				if($res){
					
					echo "L'établissement a bien été supprimé de la base de données.";
				} else {
					echo "La suppression de l'établissement de la base a échoué."; 
				}
			} else {
				echo "Des formations sont associées à cet établissement. Supprimez-les puis rééssayez.";
			}
		} else {
			echo "Connection au serveur impossible.";
		}
	} else {
		
	}
?>
</p>

