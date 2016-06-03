 <?php
	include_once "header-admin.php";
	//Boucle pour calculer le nombre pour la case tout cocher
	$sql = "SELECT * FROM photographe";
	$resultat = $pdo->query($sql);
	$nbEntre = 0;
	while($donnees = $resultat->fetch()){
		$nbEntre++;
	}
?>
<h1>Photographes</h1>
<!-- Cocher, ajouter et supprimer -->
<div id="gestion-list">
	<input type='checkbox' id="checkbox-tout" onclick="javascript:checkAndUnCheckAll(<?php echo ($nbEntre); ?>)" />
	<label>Tout cocher/décocher</label>
	<a href="form-ajout-photographe.php"><button>Ajouter</button></a>
	<a href="#" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'photographe')"><button>Supprimer</button></a>
	<form class="formu" action="recherche-photographe.php" method="POST">
		<input type="text" placeholder="Rechercher..." name="recherche" class="input-recherche-page-gestion">
		<input type="submit" value="GO" class="btn-recherche">
	</form>
</div>
<!-- Liste des Page -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql = "SELECT * FROM photographe";
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		while($donnees = $resultat->fetch()){
			$pasElements = false;
			$nbEntre++;
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees['id_photographe']."' />");
			echo $donnees["prenom"]." ".$donnees["nom"];
			echo("<a class='btn_modif' href='form-modifier-photographe.php?id_photographe=".$donnees['id_photographe']."'>Modifier</a>");
			
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