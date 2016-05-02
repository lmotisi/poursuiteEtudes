<?php
	session_start();
	$connect="host=localhost port=5432 dbname=poursuiteEtudes password=root";
	if(!isset($_SESSION['login']) && pg_num_rows(pg_query($connect, "select * from users where login='".$_SESSION['login']."'"))==0){
		header("location:connexion.php");
	}
?>
