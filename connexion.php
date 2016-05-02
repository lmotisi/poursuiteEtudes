<?php session_start();
	if(!isset($_SESSION['login'])){
		header("location:menu.php");
		exit();
	}
	if($_SESSION['role'] == 3) { echo 'session='.$_SESSION['login'].isset($_POST['valider']); }
	$connect="host=localhost port=5432 dbname=poursuiteEtudes password=root"; 
?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="fr" />
		<title>Connexion | IUT de Montreuil</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php include_once("header.html") ?>
		
		<div id="connexion">
		
			<form method="POST" action="connexion.php">
				<h1>Connexion à la plateforme PoursuiteEtudes</h1>
				Login : <input type="varchar" name="login"><br/>
				Mot de passe : <input type="password" name="motDePasse"><br/><br/>
				<input type="submit" name="valider" value="Valider">
				<input type="reset">
			</form>
	
			<?php
				if(isset($_POST['valider'])) {
					if(!empty($_POST['login']) && !empty($_POST['motDePasse'])) {
						
						$login = addslashes($_POST['login']);
						$motDePasse = sha1(sha1($_POST['motDePasse']));
						//echo $_POST['motDePasse'].$motDePasse;
						
						$connexion = pg_connect($connect);
						$req="select * from Users where login='$login' and motDePasse='$motDePasse'";
						//echo $req;
						$res=pg_query($connexion,$req);
						
						if(pg_num_rows($res) > 0) {
							$_SESSION['login'] = $login;
							$resarray = pg_fetch_array($res);
							$_SESSION['role'] = $resarray[2];
							//echo $_SESSION['role'].$_SESSION['login'];
							
							header("location:menu.php");
							exit();
						}
						else {
							echo "Ce compte n'existe pas.";
						}
					}
					else{
						echo "Veuillez entrer un login et un mot de passe.";
					}						
				}
			?>	
			
			</div>
		
		<?php include_once("footer.php") ?>
	</body>
</html>


