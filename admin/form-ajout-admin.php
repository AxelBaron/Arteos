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
	
	<h1>Administration #TIM Matane</h1>	
	<h2>Ajouter un administrateur</h2>

	<form action="traitement-ajouter-admin.php" method="POST" enctype="multipart/form-data">
	
		<fieldset>
			<legend>Formulaire</legend>
			
			<div>
				<label for="usager">Pseudo de connexion usager / login : </label>
				<input class="form" type="text" name="usager"/>
			</div>
			
			<div>
				<label for="mdp">Mot de passe : </label>
				<input class="form" type="text" name="mdp" />
			</div>
			
			<div>
				<label for="nom">Nom : </label>
				<input class="form" type="text" name="nom" />
			</div>
			
			<div>
				<label for="prenom">Prénom : </label>
				<input class="form" type="text" name="prenom" />
			</div>

			<div>
				<label for="courriel">Courriel : </label>
				<input class="form" type="text" name="courriel" />
			</div>

		</fieldset>
		
	
		<input type="submit" name="enregistrer" id="enregistrer" value="Enregistrer"/>
	</form>
	</section>
	</div>
	</body>
</html>