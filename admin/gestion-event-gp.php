 <?php
	include "header-admin.php";
	//Boucle pour calculer le nombre pour la case tout cocher
	$sql = "SELECT * FROM evenement_groupe";
	$resultat = $pdo->query($sql);
	$nbEntre = 0;
	while($donnees = $resultat->fetch()){
		$nbEntre++;
	}
?>
<h1>Regroupements d'événements</h1>
<!-- Cocher, ajouter et supprimer -->
<div id="gestion-list">
	<input type='checkbox' id="checkbox-tout" onclick="javascript:checkAndUnCheckAll(<?php echo ($nbEntre); ?>)" />
	<label>Tout cocher/décocher</label>
	<a href="form-ajout-evenement_groupe.php"><button>Ajouter</button></a>
	<a href="#" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'evenement_groupe')"><button>Supprimer</button></a>
	<form class="formu" action="recherche-evenement_groupe.php" method="POST">
		<input type="text" placeholder="Rechercher..." name="recherche" class="input-recherche-page-gestion">
		<input type="submit" value="GO" class="btn-recherche">
	</form>
</div>
<!-- Liste des regroupement d'evenements -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql = "SELECT * FROM evenement_groupe";
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		while($donnees = $resultat->fetch()){
			$pasElements = false;
			$nbEntre++;
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees['id_event_gp']."' />");
			echo($donnees["nom"]);
			echo("<a class='btn_modif' href='form-modifier-evenement_groupe.php?id_event_gp=".$donnees['id_event_gp']."'>Modifier les infos</a>");
      echo("<a class='btn_modif' style='margin-right:10px;' href='form-modifier-photo-event-gp.php?id_event_gp=".$donnees['id_event_gp']."'> Modifier l'affiche</a>");

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
