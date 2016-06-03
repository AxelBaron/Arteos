<?php
	include("header-admin.php");
	$id_event = $_GET['id_event'];
	//Boucle pour calculer le nombre pour la case tout cocher
	$sql="SELECT * FROM file_upload WHERE _id_event_ind = $id_event";
	$resultat = $pdo->query($sql);
	$nbEntre = 0;
	while($donnees = $resultat->fetch()){
		$nbEntre++;
	}

	$sql="SELECT * FROM evenement_individuel WHERE id_event = $id_event";
	$liste = $pdo->query($sql);
	$data = $liste->fetch();
	$id_billet=$data['id_event'];
?>

<?php
	$sql="SELECT * FROM file_upload WHERE _id_event_ind = $id_billet AND couverture=1";
	$resultat = $pdo->query($sql);
	$donnees = $resultat->fetch();
?>
<p> Voici les photos associées à l'article : <?php echo $data['nom']; ?>  </p>
<p class='explication-form'> Attention, certaines photos de votre article ne peuvent pas apparaitre ici car elle ont été ajoutées directement dans le corps de l'article par l'éditeur de texte.Pour modifier ces photos, <a href='gestion-event-ind.php'>cliquez ici </a>et selectionnez 'Modifier les infos'.</p><br/><br/>
<p>Cette page est un peu caprisieuse, si vous venez de supprimer des photos et qu'elle apparaissent encore, veillez attendre quelques secondes et actualiser cette page. (Ctr+R / Cmd+R)</p>
<!-- Cocher, ajouter et supprimer -->
<div id="gestion-list">
	<input type="hidden" name="id_event" value="<?php echo $id_event;?>">
	<input type='checkbox' id="checkbox-tout" onclick="javascript:checkAndUnCheckAll(<?php echo ($nbEntre); ?>)" />
	<label>Tout cocher/décocher</label>
	<a class='btn_modif_photo' href="form-ajout-photo-evenement_individuel.php?id_event=<?php echo $id_event;?>"><button>Ajouter de nouvelles photos</button></a>
	<a class='btn_modif_photo' href="" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'file_upload')"><button>Supprimer</button></a>
</div>
<p>Image de couverture actuelle : <?php
	if (isset($donnees['f_name'])) {
		echo $donnees['f_name'];
	}else{
		echo 'Aucune.';
	} ?></P>
<button id="btn_ajax" type="button" onclick="modif_couv()" value="<?php echo $id_billet; ?>">Modifier/choisir une image de couverture</button><br/><br/>
<div id="myDiv"></div>
<!-- Liste des Photos -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql = "SELECT * FROM file_upload WHERE _id_event_ind = $id_event";
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		while($donnees = $resultat->fetch()){
			$pasElements = false;
			$nbEntre++;
			echo "<div class='modif_photo'>";
			echo "<input type='checkbox' id='$nbEntre' name='".$donnees['fid']."' />";
			echo $donnees["f_name"]."<br/>";
			echo "<img src='../".$donnees['f_link']."' width='30%'/>";
			echo("</div>");
		}

	//Si il n'y a aucun entrées
	if($pasElements == true){
		echo("Vous n'avez aucune photo liés à ce billet !");
	}
	?>
<div>
</form>
<?php
	include_once "footer-admin.php";
?>
