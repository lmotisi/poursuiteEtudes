<?php
if($_SESSION['role'] == 3) {
	echo isset($_SESSION['login']).sizeof($_SESSION)." ".$_SESSION['role']." ".$_SESSION['login']."<br />\n";
	
	$connexion = pg_connect($connect);
	$req= "select * from Etablissement";
	$res = pg_exec($connexion, $req);

	/*$row=pg_fetch_array($res, $row);
	echo $row[3];*/
	// ou

	while ($row = pg_fetch_array($res)) {
		echo "[ $row[0], $row[1], $row[2], $row[3], $row[4], $row[6], $row[7], $row[8] ]";
		echo "<br />\n";
	}
	pg_freeresult($res);
	pg_close($connexion);
}
?>
