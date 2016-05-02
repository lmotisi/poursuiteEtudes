<?php include_once("global.php") ?>

<?php 

	$connexion=pg_connect($connect);
	$req="select * from Etablissement order by nometa ASC";
	$res=pg_exec($connexion,$req);
	
	while($row=pg_fetch_array($res)) {
		echo "<option value=$row[0]>$row[1]</options>";
	}
?>
		
