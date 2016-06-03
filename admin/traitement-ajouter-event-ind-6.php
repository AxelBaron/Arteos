<?php
	include "header-admin.php";
	
	$choix_couv = $_POST['choix_couv'];
	$sql="UPDATE file_upload SET couverture = 1 WHERE fid = $choix_couv";
	$resultat = $pdo->query($sql);
		
	?>
	<h1>ArtEos - Administration : Créer un nouveau billet</h1>
	

	<p> Votre article a bien été créé! Il est désormais disponible sur le site!</p>
	<a href="gestion-event-ind.php" ><button>Retour</button></a>
	</div>
	</section>
	<?php include "footer-admin.php"; ?>
