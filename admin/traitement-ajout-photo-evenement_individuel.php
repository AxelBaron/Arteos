<?php include "header-admin.php";

	// On récup l'id du billet
	$sql="SELECT * FROM evenement_individuel WHERE modif_en_cours = 1";
	$liste=$pdo->query($sql);
	$data=$liste->fetch();
	$id_event = $data['id_event'];

?>
<h1>Les photos on bien étés ajoutés au billet : <?php echo $data['nom']; ?></h1>

<?php

	// On dit qu'il n'est plus en cours de modif.
	$sql = "UPDATE evenement_individuel SET modif_en_cours=0 WHERE id_event=$id_event";
	$liste=$pdo->query($sql);
	$data=$liste->fetch();
?>
<a href="form-modifier-photo-evenement_individuel.php?id_event=<?php echo $id_event; ?>"><button>Retour</button></a>
