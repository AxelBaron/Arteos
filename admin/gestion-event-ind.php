<?php
	include("header-admin.php");
	//Boucle pour calculer le nombre pour la case tout cocher
	$sql = "SELECT * FROM evenement_individuel";
	$resultat = $pdo->query($sql);
	$nbEntre = 0;
	while($donnees = $resultat->fetch()){
		$nbEntre++;
	}
?>
<h1>Billets</h1>
<!-- Cocher, ajouter et supprimer -->
<div id="gestion-list">
	<input type='checkbox' id="checkbox-tout" onclick="javascript:checkAndUnCheckAll(<?php echo ($nbEntre); ?>)" />
	<label>Tout cocher/décocher</label>
	<a href="form-ajout-evenement_individuel.php"><button>Ajouter</button></a>
	<a href="#" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'evenement_individuel')"><button>Supprimer</button></a>
	<form class="formu" action="recherche-evenement_individuel.php" method="POST">
		<input type="text" placeholder="Rechercher..." name="recherche" class="input-recherche-page-gestion">
		<input type="submit" value="GO" class="btn-recherche">
	</form>
</div>
<!-- Liste des Actualités -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql = "SELECT * FROM evenement_individuel ORDER BY date DESC";
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		while($donnees = $resultat->fetch()){
			$pasElements = false;
			$nbEntre++;
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees['id_event']."' />");
			echo($donnees["nom"]);
			echo "<a class='btn_modif' href='form-modifier-evenement_individuel.php?id_event=".$donnees['id_event']."&_id_type_gp=".$donnees['_id_type_gp']."&_id_event_gp=".$donnees['_id_event_gp']."'>Modifier les infos</a>";
			echo "<a class='btn_modif_photo' href='form-modifier-photo-evenement_individuel.php?id_event=".$donnees['id_event']."'/>Modifier les photos</a>";
			echo("</div>");
		}

	//Si il n'y a aucun entrées
	if($pasElements == true){
		echo("Vous n'avez aucun éléments dans cette page.");
	}
	?>
<div>
</form>
<?php
	include_once "footer-admin.php";
?>
