<?php include("header-admin.php"); ?>	
	
	<h1>ArtEos - ADministration</h1>	
	<h2>Billet ajouté : <?php echo $_POST['nom'] ?></h2>

	<?php 

		
		$liste_de_filtres = array(
		'ville' => FILTER_SANITIZE_STRING,
		'date' => FILTER_SANITIZE_STRING,
		'salle' => FILTER_SANITIZE_STRING,
		'txt' => FILTER_SANITIZE_STRING,
		'_id_type' => FILTER_SANITIZE_NUMBER_INT,
		'_id_event_gp' => FILTER_SANITIZE_NUMBER_INT,
		'_id_artiste' => FILTER_SANITIZE_NUMBER_INT,
		'_id_photographe' => FILTER_SANITIZE_NUMBER_INT,
		);

		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		print_r($data_filtre);

		$sql = "INSERT INTO evenement_individuel(ville,date,salle,txt,_id_type,_id_event_gp,_id_artiste,_id_photographe) 
				VALUES(:ville,:date,:salle,:txt,:_id_type,:_id_event_gp,:_id_artiste,:_id_photographe)";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
		$requete->bindParam(':date', $data_filtre['date'], PDO::PARAM_STR);
		$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);
		$requete->bindParam(':txt', $data_filtre['txt'], PDO::PARAM_STR);
		$requete->bindParam(':_id_type', $data_filtre['_id_type'], PDO::PARAM_INT);
		$requete->bindParam(':_id_event_gp', $data_filtre['_id_event_gp'], PDO::PARAM_INT);
		$requete->bindParam(':_id_artiste', $data_filtre['_id_artiste'], PDO::PARAM_INT);
		$requete->bindParam(':_id_photographe', $data_filtre['_id_photographe'], PDO::PARAM_INT);
		$requete->execute();


	?>
<a href="gestion-event-ind.php"><button>Retour</button></a>
<?php include("footer-admin.php"); ?>
