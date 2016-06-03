<?php
	include_once "header-admin.php";
	//Boucle pour calculer le nombre pour la case tout cocher
	$sql = "SELECT * FROM artiste ORDER BY nom ASC";
	$resultat = $pdo->query($sql);
	$nbEntre = 0;
	while($donnees = $resultat->fetch()){
		$nbEntre++;
	}
?>
<h1>Artistes</h1>
<!-- Cocher, ajouter et supprimer -->
<div id="gestion-list">
	<input type='checkbox' id="checkbox-tout" onclick="javascript:checkAndUnCheckAll(<?php echo ($nbEntre); ?>)" />
	<label>Tout cocher/décocher</label>
	<a href="form-ajout-artiste.php"><button>Ajouter</button></a>
	<a href="#" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'artiste')"><button>Supprimer</button></a>
	<form class="formu" action="recherche-artiste.php" method="POST">
		<input type="text" placeholder="Rechercher..." name="recherche" class="input-recherche-page-gestion">
		<input type="submit" value="GO" class="btn-recherche">
	</form>
</div>
<!-- Liste des Portfolios -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql = "SELECT * FROM artiste";
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		while($donnees = $resultat->fetch()){
			$pasElements = false;
			$nbEntre++;
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees['id_artiste']."' />");
			echo($donnees["nom"]);
			echo("<a class='btn_modif' href='form-modifier-artiste.php?id_artiste=".$donnees['id_artiste']."'>Modifier</a>");
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
