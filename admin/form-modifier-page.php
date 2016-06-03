<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style_admin.css">
	<title>#TIM Matane - Administration principale</title>
</head>
<body>

	<?php include("menu-admin.php");?>

	<div class="right">

		<section>
			<?php 
				include("connectionbdd.php");
				$page_id = $_GET["page_id"];
				$sql="SELECT * FROM page 
					  WHERE page_id= $page_id";
				$liste = $pdo->query($sql);
				$data = $liste->fetch();
			 ?>
			
			<h1>#TIM Matane administration</h1>	
			<h2>Modifier la page: <?php echo $data['titre']; ?> </h2>
			 
		<form action="traitement-modifier-page.php?page_id= <?php echo $data['page_id']; ?>" method="POST" enctype="multipart/form-data">
	
		<fieldset>
			<legend>Formulaire de modification : </legend>
			
			<div>
				<label for="Titre">Titre de la page : </label>
				<input class="form" type="text" name="titre" value="<?php echo $data['titre']; ?>"/>
			</div>

			<div>
				<label for="Resumé">Resumé en haut de page : </label>
				<textarea class="form" type="text" name="resume"><?php echo $data['resume']; ?></textarea>
			</div>


			<?php 
				include('connectionbdd.php');
				$sql ="SELECT * FROM page WHERE page_id=$page_id";
				$liste=$pdo->query($sql);
				$data=$liste->fetch();

				if ($data['image']=="") {
					echo "<div>";
					echo "<label for='image-preview'>Image située en haut de page.</label><br/>";
					echo "<p> Attention ! Veuillez télécharger une image de 300 pixels x 312 pixels.</p>";
					echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
					echo "</div>";
				}else{
					echo "<div>";
					echo "<label for='image-preview'>Image située en haut de page.</label><br/>";
					echo "<p class='rouge'> Attention ! Une image existe déjà, si vous en téléchargez une nouvelle, l'ancienne sera ecrasée !</p>";
					echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
					echo "</div>";
				}


			 ?>
			

			<fieldset>
			<legend>Gérez la position des contenus : </legend>
				<label for="resume">Choisisez dans quelle ordre s'afficheront les contenus dans votre page. (1 = haut de page) : </label><br /><br />
					<?php 
					 	$sql2="SELECT * FROM contenu WHERE id_page_ = $page_id";
					 	$liste = $pdo->query($sql2);
					 	$position =0;
					 	$nb_contenu = 0;
					 	while ($contenu = $liste->fetch()) {
							$nb_contenu ++;
					 	}

					 	$sql2="SELECT * FROM contenu WHERE id_page_ = $page_id";
					 	$liste = $pdo->query($sql2);
					 	while ($contenu = $liste->fetch()) {
							$position ++;
							echo "<p class='border-deroulant'>".$contenu['titre']." <select class='select' name='position".$position."'>";
							for ($i=1; $i < $nb_contenu+1; $i++) { 
								if ($contenu['position'] == $i) {
									echo "<option selected value='".$i."_".$contenu['contenu_id']."'> $i </option>";
								}else{
									echo "<option value='".$i."_".$contenu['contenu_id']."'> $i </option>";
								}
					 		}
					 		echo "</select> </p>";
					 	}
					?>
				
	    			<input type="hidden" name="nb_contenu" value="<?php echo $nb_contenu ?>"/>

			</fieldset>

		
		<input type="submit" name="enregistrer" id="enregistrer" value="Enregistrer" />
		</form>
		</section>
	</div>

</body>
</html>
