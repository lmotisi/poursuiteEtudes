<?php
if(!isset($_SESSION['role']) || $_SESSION['role']<2) { header("location:connexion.php"); }

	if(isset($_POST['valider'])) {
	
		echo "<div class='resAjout'>";
		
		if(isset($_POST['idEta'])) {
			$a['idEta'] = (htmlspecialchars(($_POST['idEta'])+1.5)/3);
		}
		$a['nomEta'] = htmlspecialchars(addslashes($_POST['nom']));
		$a['rue'] = htmlspecialchars(addslashes($_POST['rue']));
		$a['cp'] = htmlspecialchars(addslashes($_POST['cp']));
		$a['ville'] = htmlspecialchars(addslashes($_POST['ville']));
		$a['siteWeb'] = htmlspecialchars(addslashes($_POST['siteWeb']));
		$a['anneeCreation'] = htmlspecialchars(addslashes($_POST['anneeCreation']));
		$a['public'] = htmlspecialchars(addslashes($_POST['public']));
		$a['region'] = htmlspecialchars(addslashes($_POST['region']));
		/*foreach($_POST as $e) {
			echo "$e:";
		} echo "<br/> \n";*/
		/*foreach($a as $f => $v) {
			echo "$f>$v; ";
		} echo "<br/> \n";*/

		$connexion = pg_connect($connect);
	
		if($connexion) {
			if(empty($a['nomEta'])){
				echo "Veuillez entrer un nom d'établissement";
			} 
			// We are checking whether the entry already exists in database
			elseif(!empty($a['idEta']) && pg_num_rows(pg_query($connexion,"select * from Etablissement where idEta='".$a['idEta']."'")) > 0) {
			
				$l = array_slice($a,2);
			
				$req = "update Etablissement set nomEta='".$a['nomEta']."'";
				
				foreach($l as $i => $val) {
					if(!empty($val) || gettype($i)==boolean) {
						if(gettype($i)==string) {
							$req .= ",$i='$val'";
						} else {
							$req .= ",$i=$val";
						}
					}
				}
				$req .= " where idEta='".$a['idEta']."'";
				//echo $req;
			
				$res = pg_query($connexion,$req);
			
				if($res){
					echo "Une fiche pour cet établissement existe déjà dans la base. La fiche existante a été mise à jour.";
				} else {
					echo "La modification dans la base de données a échoué.";
				}
			// If not, we add a new row in database
			} else {
				
				$req = "insert into etablissement values(default";
				
				foreach($a as $i => $val) {
					if(!empty($val) || gettype($i)==boolean) {
						if(gettype($i)==string) {
							$req .= ",'$val'";
						} else {
							$req .= ",$val";
						}
					} elseif(empty($val)) {
						if(gettype($i)==string) {
							$req .= ",NULL";
						} else {
							$req .= ",NULL";
						}
					}
				}
				$req .= ")";
				//echo $req;
				
				//$req="insert into Etablissement values(default,'".$a['nomEta']."','".$a['rue']."','".$a['cp']."','".$a['ville']."','".$a['siteWeb']."',".$a['anneeCreation'].",".$a['public'].",'".$a['region']."')";
				//echo '$req='.$req;
				$res=pg_query($connexion,$req);
		
				if($res){
					echo "L'établissement a bien été ajouté à la base de données.";
				} else {
					echo "L'ajout dans la base de données a échoué.";
				}
			}
		} else {
			echo "Connection au serveur impossible.";
		}
		echo "</div>";
	}
?>

