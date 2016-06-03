<?php include("header-admin.php"); ?>


	<h1>ArtEos - Administration</h1>
	<h2>Regroupement d'événement ajouté : <?php echo $_POST["nom"];?></h2>
	<p>Veuillez ajouter l'affiche du festival</p>

	<?php

		include('connectionbdd.php');
		$liste_de_filtres = array(
		'nom' => FILTER_SANITIZE_STRING,
		'txt' => FILTER_SANITIZE_STRING,
        'date_debut' => FILTER_SANITIZE_STRING,
        'date_fin' => FILTER_SANITIZE_STRING,
        '_id_type_gp' => FILTER_SANITIZE_NUMBER_INT
		);

		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		$sql = "INSERT INTO evenement_groupe(nom,txt,date_debut,date_fin,_id_type_gp) VALUES (:nom,:txt,:date_debut,:date_fin,:_id_type_gp)";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
		$requete->bindParam(':txt', $data_filtre['txt'], PDO::PARAM_STR);
        $requete->bindParam(':date_debut', $data_filtre['date_debut'], PDO::PARAM_STR);
        $requete->bindParam(':date_fin', $data_filtre['date_fin'], PDO::PARAM_STR);
        $requete->bindParam(':_id_type_gp', $data_filtre['_id_type_gp'], PDO::PARAM_INT);
		$requete->execute();


	?>
	<form action="../dropzone/file_upload_gp.php" class="dropzone">
	</form>
	<br />
	<br />
	<a href="gestion-event-gp.php"><button>Envoyer l'image</button></a>
<?php include("footer-admin.php"); ?>
