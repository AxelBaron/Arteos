<?php
	include("header-admin.php");
	include('connectionbdd.php');
	$id_event_gp = $_GET['id_event_gp'];

	//DELETE DE L'ANCIENNE l'IMAGE
  $sql='DELETE FROM file_upload WHERE _id_event_gp ='.$id_event_gp;
  $resultat = $pdo->query($sql);
	$image = $resultat->fetch();

	//SELECT L'EVENEMENT DE GROUPE
	$sql ='SELECT * FROM evenement_groupe WHERE id_event_gp ='.$id_event_gp;
	$resultat = $pdo->query($sql);
	$data = $resultat->fetch();
?>


<h1>ArtEos - Administration</h1>
<h2>Regroupement d'événement ajouté : <?php echo $data['nom'];?></h2>
<p>L'ancienne affiche a été supprimé. Veuillez déposer la nouvelle affiche :</p>

<form action="../dropzone/file_upload_gp.php" class="dropzone">
</form>
<br />
<br />
<a href="gestion-event-gp.php"><button>Envoyer l'image</button></a>
<?php include("footer-admin.php"); ?>
