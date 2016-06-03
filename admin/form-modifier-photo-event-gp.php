<?php
	include("header-admin.php");
	include('connectionbdd.php');
	$id_event_gp = $_GET['id_event_gp'];

	//SELECT l'IMAGE
	$sql ='SELECT * FROM file_upload WHERE _id_event_gp ='.$id_event_gp;
	$resultat = $pdo->query($sql);
	$image = $resultat->fetch();

	//SELECT L'EVENEMENT DE GROUPE
	$sql ='SELECT * FROM evenement_groupe WHERE id_event_gp ='.$id_event_gp;
	$resultat = $pdo->query($sql);
	$data = $resultat->fetch();
?>


	<h1>ArtEos - Administration</h1>
	<h2>Regroupement d'événement ajouté : <?php echo $data['nom'];?></h2>
	<p>Voici l'affiche actuelle du festival :</p>
	<?php
	if ($image['f_link']!="") {
		echo "<img src='../".$image['f_link']."' alt='image du festival en cours' style='width:500px;margin-bottom:30px;' />";
	}else{
		echo "Il n'y a actuellement aucune image associé au regroupement d'événement !";
	}
	?>
	<p>
		En cliquant sur modifier, l'image actuelle du festival sera supprimé. Il faudra obligatoirement lui en affecter une nouvelle.
	</p>
	<a href='modifier-image-event-gp.php?id_event_gp=<?php echo $id_event_gp; ?>'><button>
		Modifier l'image
	</button></a>
<?php include("footer-admin.php"); ?>
