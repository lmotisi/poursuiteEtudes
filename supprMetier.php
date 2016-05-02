<div id="resSuppr">
<?php
	if(isset($_POST['supprimer'])) {
		echo "Suppression demandée.\n";
		
		$idMet = addslashes($_POST['idMet']);
		
		$connexion = pg_connect($connect);
		
		if($connexion) {
			$testreq = "select * from Metier m, Viser v, Formation f where m.idMet=$idMet and m.idMet=v.idMet and v.idFor=f.idFor";
			//echo '$testreq='.$testreq;
			if(pg_num_rows(pg_query($connexion,$testreq)) == 0) {
				$req="delete from Metier where idMet=$idMet";
				//echo '$req='.$req;
				$res=pg_query($connexion,$req);

				if($res){
					echo "Le métier a bien été supprimé de la base de données.";
				} else {
					echo "La suppression du métier de la base a échoué."; 
				}
			} else {
				echo "Des formations sont associées à ce métier. Supprimez-les puis rééssayez.";
			}
		} else {
			echo "Connection au serveur impossible.";
		}
	}
?>
</div>

