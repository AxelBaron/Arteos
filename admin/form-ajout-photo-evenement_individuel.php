	<?php include "header-admin.php"; 
	$id_event =$_GET['id_event'];

	$sql="UPDATE evenement_individuel SET modif_en_cours = 1 WHERE id_event = $id_event";
	$liste=$pdo->query($sql);
	$data=$liste->fetch();

	$sql="SELECT nom FROM evenement_individuel WHERE id_event = $id_event";
	$liste=$pdo->query($sql);
	$data=$liste->fetch();
?>

<h1>ArtEos - Administration : Ajouter des photos: </h1>
<p>Vous êtes en train d'ajouter des photos au billet : <?php echo $data['nom']; ?></p>
	
	<p class="explication-form"> La mise en page dépendra du nombre d'image de votre billet !<br/>
	 Même si vous ecrivez un article avec une vidéo live ou acoustique, ou d'un autre type, 
	 il est impératif de choisir une image qui servira de couverture à votre article.</p>
	<form action="../dropzone/file-upload4.php?id_event=<?php echo $id_event; ?>" class="dropzone">
	</form><br/>
	<a href="traitement-ajout-photo-evenement_individuel.php"><button>Envoyer les photos suplémentaires !</button></a>