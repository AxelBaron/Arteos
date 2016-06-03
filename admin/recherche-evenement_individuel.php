<?php
	include"header-admin.php";
	//Boucle pour calculer le nombre pour la case tout cocher
	$recherche =$_POST['recherche'];
	$sql="SELECT * FROM evenement_individuel WHERE nom LIKE '%$recherche%'";
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
</div>
<!-- Liste des Portfolios -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql="SELECT * FROM evenement_individuel WHERE nom LIKE '%$recherche%'";	
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		echo "Résultat(s) pour votre recherche : $recherche <br/> <br/> <a class='btn-retour' href='gestion-event-ind.php'>Retour à la liste complète</a><br /><br />";
		while($donnees = $resultat->fetch()){
			$nbEntre++;
			$pasElements = false;
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees['id_event']."' />");
			echo($donnees["nom"]);
			echo("<a class='btn_modif' href='form-modifier-evenement_individuel.php?id_event=".$donnees['id_event']."'>Modifier</a>");
			echo("</div>");
		}
		
	//Si il n'y a aucun entrées
	if($pasElements == true){
		echo("Aucuns résultats.");
	}
	?>
<div>
</form>
<?php
	include_once "footer-admin.php";
?>
