<?php include("header-admin.php"); ?>	

	
	<h1>ArtEos - Administration</h1>	
	<h2>Artiste ajouté : <?php echo $_POST["nom"];?></h2>

	<?php 

		include('connectionbdd.php');

		$liste_de_filtres = array(
		'nom' => FILTER_SANITIZE_STRING,
		'site'=> FILTER_SANITIZE_URL
		);
		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		$sql = "INSERT INTO artiste(nom,site) VALUES (:nom,:site)";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
		$requete->bindParam(':site', $data_filtre['site'], PDO::PARAM_STR);
		$requete->execute();
		
		
	?>
	<a href="gestion-artiste.php"><button>Retour aux artistes</button></a>
<?php include("footer-admin.php"); ?>

