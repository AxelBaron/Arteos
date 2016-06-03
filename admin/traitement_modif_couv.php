<?php include'header-admin.php';

	$couv=$_POST['choix_couv'];
	$sql="UPDATE file_upload SET couverture=1 WHERE fid = $couv";
	$liste=$pdo->query($sql);
?>
	<h1>ArtEos - Administration : Modifier l'image de couverture</h1>
	<p> L'image de couverture à bien été modifié.</p>
	<a href="gestion-event-ind.php" ><button>Retour</button></a>
	</div>
