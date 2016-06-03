<?php
	include_once "header-admin.php";
	//Boucle pour calculer le nombre pour la case tout cocher
	$recherche =$_POST['recherche'];
	$sql="SELECT * FROM photographe WHERE nom LIKE '%$recherche%' OR prenom LIKE '%$recherche%'";
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
	<a href="form-ajout-artiste.php"><button>Ajouter</button></a>
	<a href="#" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'photographe')"><button>Supprimer</button></a>
</div>
<!-- Liste des Portfolios -->
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql="SELECT * FROM photographe WHERE nom LIKE '%$recherche%' OR prenom LIKE '%$recherche%'";	
		$resultat = $pdo->query($sql);
		$nbEntre = 0;
		echo "Résultat(s) pour votre recherche : $recherche <br/> <br/> <a class='btn-retour' href='gestion-photographe.php'>Retour à la liste complète</a><br /><br />";
		while($donnees = $resultat->fetch()){
			$nbEntre++;
			$pasElements = false;
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees['id_photographe']."' />");
			echo($donnees["prenom"]." ".$donnees["nom"]);
			echo("<a class='btn_modif' href='form-modifier-photographe.php?id_photographe=".$donnees['id_photographe']."'>Modifier</a>");
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
