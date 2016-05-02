<?php require_once("global.php"); 
	if($_SESSION['role']<2){
			header('location:menu.php');
	} 		
?>

<!doctype html>
<html>	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Suppression de formation | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		
		<div class="container">
			<?php include_once("navigation.php") ?>
			
			<div class="content">
			
			<?php $idFor=$_GET['suppFor']; 
			
			if(!isset($_POST['valider'])){
			echo " <h1> Confirmation de suppression </h1>
			<p> Voulez vous supprimer cette formation ? </br> 
				Attention, tous les avis  et témoignages associés seront supprimés.</p>
			<form action='supprFormation.php' method='post'>
				<input type='hidden' name='idSupp' value=$idFor />
				<input type='submit' name='valider' value='Valider'/>
				<input type='button' name='submit' value='Annuler' onclick=\"self.location='listeFormation.php'\" />
			</form>";
			
			} else {
				$connexion = pg_connect($connect);
				$idFor=htmlspecialchars($_POST['idSupp']);
				if (pg_num_rows(pg_query($connexion, "select * from formation f, suivre s where f.idfor=$idFor and f.idfor=s.idfor")) > 0 ){
				 	pg_query($connexion, "delete from suivre s where s.idfor=$idFor");
				}
			
				if (pg_num_rows(pg_query($connexion, "select * from formation f, viser v where f.idfor=$idFor and f.idfor=v.idfor")) > 0 ){
				 	pg_query($connexion, "delete from viser v where v.idfor=$idFor");
				}
				
				if (pg_num_rows(pg_query($connexion, "select * from formation f, temoignage t where f.idfor=$idFor and f.idfor=t.idfor")) > 0 ){
				 	pg_query($connexion, "delete from temoignage t where t.idfor=$idFor");
				}
				
				$req="delete from formation where idFor=$idFor";
				$res=pg_query($connexion,$req);
				if($res){
					echo "<h1> Résultat de suppression </h1>
						  <p> La formation a bien été supprimée. </p>";
				} else {
					echo "<h1> Résultat de suppression </h1>
						  <p>La suppression de la formation de la base de données a échoué.</p>";
				}
			}
					
			?>
			</div>
		</div>
		
		<?php include_once("footer.php") ?>
				
	</body>
</html>	
