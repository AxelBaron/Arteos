<?php include("header-admin.php"); ?>

	<?php $id_photographe = $_GET['id_photographe'];?>

	<h1>ArtEos - Administration</h1>
	<h2>Photographe modifié : <?php echo $_POST["prenom"]." ".$_POST["nom"] ;?></h2>

	<?php

		include('connectionbdd.php');
		// include('test_upload.php');

		$liste_de_filtres = array(
			'nom' => FILTER_SANITIZE_STRING,
			'prenom' => FILTER_SANITIZE_STRING,
			'tel' => FILTER_SANITIZE_NUMBER_INT,
			'mail' => FILTER_SANITIZE_EMAIL,
			'ville' => FILTER_SANITIZE_STRING,
			'site' => FILTER_SANITIZE_URL,
			'content' => FILTER_FLAG_ENCODE_LOW
		);

		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		$sql = "UPDATE photographe
		SET nom=:nom,prenom=:prenom,telephone=:tel,mail=:mail,ville=:ville,site=:site,description=:content
		WHERE id_photographe=$id_photographe";
		$requete =$pdo->prepare($sql);
		$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
		$requete->bindParam(':prenom', $data_filtre['prenom'], PDO::PARAM_STR);
		$requete->bindParam(':tel', $data_filtre['tel'], PDO::PARAM_INT);
		$requete->bindParam(':mail', $data_filtre['mail'], PDO::PARAM_STR);
		$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
		$requete->bindParam(':site', $data_filtre['site'], PDO::PARAM_STR);
		$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
		$requete->execute();
	?>
	<a href="gestion-photographe.php"><button>Retour aux photographes</button></a>
<?php include("footer-admin.php"); ?>
