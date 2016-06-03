<?php include("header-admin.php"); ?>

	<?php $id_event_gp = $_GET['id_event_gp']; ?>

	<h1>Administration ArtEos</h1>
	<h2>Nom du regroupement d'événements modifié par : <?php echo $_POST["nom"];?></h2>

	<?php
		print_r($_POST);
		print_r($_GET);

		include('connectionbdd.php');

		$liste_de_filtres = array(
			'nom' => FILTER_SANITIZE_STRING,
			'txt' => FILTER_SANITIZE_STRING,
	    'date_debut' => FILTER_SANITIZE_STRING,
	    'date_fin' => FILTER_SANITIZE_STRING,
	    '_id_type_gp' => FILTER_SANITIZE_NUMBER_INT
		);

		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		$sql = "UPDATE evenement_groupe
				SET nom=:nom, txt=:txt, date_debut=:date_debut, date_fin=:date_fin, _id_type_gp=:_id_type_gp WHERE id_event_gp =".$id_event_gp;
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
		$requete->bindParam(':txt', $data_filtre['txt'], PDO::PARAM_STR);
    $requete->bindParam(':date_debut', $data_filtre['date_debut'], PDO::PARAM_STR);
    $requete->bindParam(':date_fin', $data_filtre['date_fin'], PDO::PARAM_STR);
    $requete->bindParam(':_id_type_gp', $data_filtre['_id_type_gp'], PDO::PARAM_INT);
		$requete->execute();
		//print_r($requete);
	?>
	<a href="gestion-event-gp.php"><button>Retour aux regroupements d'événements</button></a>
<?php include("footer-admin.php"); ?>
