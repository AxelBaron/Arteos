<?php include("header-admin.php"); ?>

	<?php $menu_id = $_GET['menu_id']; ?>

	<h1>Administration #TIM Matane</h1>	
	<h2>Menu modifié : <?php echo $_POST["nom"] ;?></h2>

	<?php 
		
		$liste_de_filtres = array(
		'nom' => FILTER_SANITIZE_STRING,
		'nom_lien' => FILTER_SANITIZE_URL,
		'sm_nom_1' => FILTER_SANITIZE_STRING,	
		'sm_lien_1' => FILTER_SANITIZE_URL,	
		'sm_nom_2' => FILTER_SANITIZE_STRING,	
		'sm_lien_2' => FILTER_SANITIZE_URL,	
		'sm_nom_3' => FILTER_SANITIZE_STRING,	
		'sm_lien_3' => FILTER_SANITIZE_URL,	
		'sm_nom_4' => FILTER_SANITIZE_STRING,	
		'sm_lien_4' => FILTER_SANITIZE_URL,
		'sm_nom_5' => FILTER_SANITIZE_STRING,	
		'sm_lien_5' => FILTER_SANITIZE_URL,	
		'sm_nom_6' => FILTER_SANITIZE_STRING,	
		'sm_lien_6' => FILTER_SANITIZE_URL,	
		'sm_nom_7' => FILTER_SANITIZE_STRING,	
		'sm_lien_7' => FILTER_SANITIZE_URL,
		'sm_nom_8' => FILTER_SANITIZE_STRING,	
		'sm_lien_8' => FILTER_SANITIZE_URL,
		);
		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

		
		$sql = "UPDATE menu 
		  		SET nom =:nom, nom_lien =:nom_lien, sm_nom_1 =:sm_nom_1, sm_lien_1 =:sm_lien_1, sm_nom_2 =:sm_nom_2, sm_lien_2 =:sm_lien_2, sm_nom_3 =:sm_nom_3, sm_lien_3 =:sm_lien_3, sm_nom_4 =:sm_nom_4, sm_lien_4 =:sm_lien_4,  sm_nom_5 =:sm_nom_5, sm_lien_5 =:sm_lien_5, sm_nom_6 =:sm_nom_6, sm_lien_6 =:sm_lien_6, sm_nom_7 =:sm_nom_7, sm_lien_7 =:sm_lien_7, sm_nom_8 =:sm_nom_8, sm_lien_8 =:sm_lien_8
		  		WHERE menu_id =$menu_id;";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
		$requete->bindParam(':nom_lien', $data_filtre['nom_lien'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_1', $data_filtre['sm_nom_1'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_1', $data_filtre['sm_lien_1'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_2', $data_filtre['sm_nom_2'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_2', $data_filtre['sm_lien_2'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_3', $data_filtre['sm_nom_3'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_3', $data_filtre['sm_lien_3'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_4', $data_filtre['sm_nom_4'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_4', $data_filtre['sm_lien_4'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_5', $data_filtre['sm_nom_5'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_5', $data_filtre['sm_lien_5'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_6', $data_filtre['sm_nom_6'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_6', $data_filtre['sm_lien_6'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_7', $data_filtre['sm_nom_7'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_7', $data_filtre['sm_lien_7'], PDO::PARAM_STR);
		$requete->bindParam(':sm_nom_8', $data_filtre['sm_nom_8'], PDO::PARAM_STR);
		$requete->bindParam(':sm_lien_8', $data_filtre['sm_lien_8'], PDO::PARAM_STR);
		$requete->execute();
	?>
	<a href="gestion-menu.php"><button>Retour</button></a>
<?php include("footer-admin.php"); ?>
