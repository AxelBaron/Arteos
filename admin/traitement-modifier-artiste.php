<?php include("header-admin.php"); ?>	

	<?php $id_artiste = $_GET['id_artiste']; ?>
	
	<h1>Administration ArtEos</h1>	
	<h2>Artiste modifié :  <?php echo $_POST["nom"];?></h2>

	<?php 

		include('connectionbdd.php');

		$liste_de_filtres = array(
		'nom' => FILTER_FLAG_ENCODE_LOW,
		'site' => FILTER_SANITIZE_URL
		);
		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		$sql = "UPDATE artiste
				SET nom=:nom, site=:site WHERE id_artiste =$id_artiste";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
		$requete->bindParam(':site', $data_filtre['site'], PDO::PARAM_STR);
		$requete->execute();
		
		
	?>
	<a href="gestion-artiste.php"><button>Retour aux artistes</button></a>
<?php include("footer-admin.php"); ?>