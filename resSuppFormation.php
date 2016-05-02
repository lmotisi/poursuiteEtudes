<?php include_once("global.php") ?>

<html>	
	<head>
		<meta charset="UTF-8">
		<title>Suppression Formation</title>
		<link rel="stylesheet" type="text/css" href="style.css" >
	</head>
	<body>
		
		<?php include_once("header.html") ?>
		
		<?php
			$connexion = pg_connect($connect);
			$idFor=$_POST['idSupp'];
			if (pg_num_rows(pg_query($connect, "select * from formation f, suivre s where f.idfor=$idFor and f.idfor=s.idfor"))) > 0 ){
			 	pg_query($connect, "delete from suivre s where s.idfor=$idFor");
			}
			
			if (pg_num_rows(pg_query($connect, "select * from formation f, viser v where f.idfor=$idFor and f.idfor=v.idfor"))) > 0 ){
			 	pg_query($connect, "delete from viser v where v.idfor=$idFor");
			}			
			
			$req="delete from formation where idFor=$idFor";
			$res= pg_query($connexion,$req);
			if($res){
				echo "La formation a bien été supprimée";
			} else {
				echo "La suppression de la formation de la base de données a échoué";
			}
			
		?>
		
		<?php include_once("footer.php") ?>
				
	</body>
</html>	
