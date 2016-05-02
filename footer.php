<footer>
	<ul>
		<li class="first"><a href="index.php">Accueil</a></li>
		<li><a href="www.iut.univ-paris8.fr/mentions-legales">Mentions Légales</a></li>
		<li><a href="www.iut.univ-paris8.fr/a-propos" title="L&#039;IUT">L&#039;IUT</a></li>
		<?php if (isset($_SESSION['login'])) {
		echo"<li><a href=\"deconnexion.php\">Déconnexion</a></li>";
		}
		?>
	</ul>
	<!--
	<p><a href="http://jigsaw.w3.org/css-validator/check/referer">
	<img style="border:0;width:88px;height:31px"
		src="http://jigsaw.w3.org/css-validator/images/vcss"
		alt="CSS Valide !" />
	</a></p>
	-->	
</footer>
