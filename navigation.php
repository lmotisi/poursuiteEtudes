<div id="navigation">
	<h1>Navigation</h1>
	<nav>
		<ul>
			<?php

			if($_SESSION['role']==1) {
				echo"
				<li><a href='listeEtablissement.php'>Liste des établissements</a></li>
				<li><a href='listeMetier.php'>Liste des métiers</a></li>
				<li><a href='listeFormation.php'>Liste des formations</a></li>
				<li><a href='selectFormation.php'>Rechercher une formation</a></li>
				<li><a href='ajoutFormation.php'>Ajouter une formation</a></li>
				<li><a href='ajoutTemoignage.php'>Ajouter un témoignage</a></li>
				<li><a href='ajoutMetier.php'>Ajouter un métier</a></li>
				";
			}
			if($_SESSION['role']==2) {
				echo"
				<li><a href='listeEtablissement.php'>Liste des établissements</a></li>
				<li><a href='listeMetier.php'>Liste des métiers</a></li>
				<li><a href='listeFormation.php'>Liste des formations</a></li>
				<li><a href='selectFormation.php'>Rechercher une formation</a></li>
				<li><a href='ajoutEtablissement.php'>Ajouter un établissement</a></li>
				<li><a href='ajoutFormation.php'>Ajouter une formation</a></li>
				<li><a href='ajoutMetier.php'>Ajouter un métier</a></li>
				";
			}
			if($_SESSION['role']==3) {
				echo"
				<li><a href='listeEtablissement.php'>Liste des établissements</a></li>
				<li><a href='listeMetier.php'>Liste des métiers</a></li>
				<li><a href='listeFormation.php'>Liste des formations</a></li>
				<li><a href='selectFormation.php'>Rechercher une formation</a></li>
				<li><a href='ajoutEtablissement.php'>Ajouter un établissement</a></li>
				<li><a href='ajoutFormation.php'>Ajouter une formation</a></li>
				<li><a href='ajoutTemoignage.php'>Ajouter un témoignage</a></li>
				<li><a href='ajoutMetier.php'>Ajouter un métier</a></li>
				";
			}
			?>
			<li><a href='menu.php'>Menu Principal</a></li>
					
		</ul>
	</nav>
</div>

