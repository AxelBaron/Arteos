<?php include("header-admin.php"); ?>

	<h1>ArtEos - Adsministration</h1>

	<?php
		include('connectionbdd.php');

			$liste_de_filtres = array(
			'nom' => FILTER_SANITIZE_STRING,
			'prenom' => FILTER_SANITIZE_STRING,
			'telephone' => FILTER_SANITIZE_NUMBER_INT ,
			'mail' => FILTER_SANITIZE_EMAIL ,
			'ville' => FILTER_SANITIZE_STRING ,
			'site' => FILTER_SANITIZE_URL ,
			'content' => FILTER_FLAG_ENCODE_LOW
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

			$sql = "INSERT INTO photographe(nom,prenom,telephone,mail,description,ville,site) VALUES(:nom,:prenom,:telephone,:mail,:content,:ville,:site)";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
			$requete->bindParam(':prenom', $data_filtre['prenom'], PDO::PARAM_STR);
			$requete->bindParam(':telephone', $data_filtre['telephone'], PDO::PARAM_INT);
			$requete->bindParam(':mail', $data_filtre['mail'], PDO::PARAM_STR);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->bindParam(':site', $data_filtre['site'], PDO::PARAM_STR);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->execute();
			echo "Le photographe a bien été ajouté !";
	?>
		<a href="gestion-photographe.php"><button>Retour aux photographes</button></a>
<?php include("footer-admin.php"); ?>
