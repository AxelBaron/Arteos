<?php
	include("header-admin.php");

	//Boucle pour calculer le nombre pour la case tout cocher
	$nbEntre = 0;
	$sql="SELECT * FROM file_upload WHERE slider = 1";
	$resultat = $pdo->query($sql);
	while($donnees = $resultat->fetch()){
		$nbEntre++;
	}
?>


<h1> Gestion des photos du slider.</h1>
<!-- Cocher, ajouter et supprimer -->
<div id="gestion-list">
	<input type='checkbox' id="checkbox-tout" onclick="javascript:checkAndUnCheckAll(<?php echo ($nbEntre); ?>)" />
	<label>Tout cocher/décocher</label>
	<a class='btn_modif_photo' href="form-modif-pos-slider.php" ><button>Modifier la possition des images</button></a>
	<a class='btn_modif_photo' href="form-ajout-photo-slider.php"><button>Ajouter de nouvelles photos au slider</button></a>
	<a class='btn_modif_photo' href="" onclick="javascript:suppression(<?php echo ($nbEntre); ?>, 'file_upload')"><button>Supprimer des photos du slider</button></a>

</div>
<form class="form-gestion">
<div id="liste-elements">
	<?php
		$pasElements = true;
		$sql="SELECT * FROM file_upload WHERE slider = 1";
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
		echo("Vous n'avez actuellement aucunes photos dans le carousel !");
	}
	?>
<div>
</form>
<?php
	include_once "footer-admin.php";
?>
