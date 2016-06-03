<?php include("header-admin.php"); ?>
	
	<?php $portfolio_id = $_GET['prof_id']; ?>
	
	<h1>Administration #TIM Matane</h1>	
	<h2>Professeur modifié</h2>

	<?php 

		include('connectionbdd.php');
		
		$liste_de_filtres = array(
		'prenom' => FILTER_SANITIZE_STRING,
		'nom' => FILTER_SANITIZE_STRING,
		'role' => FILTER_SANITIZE_STRING,
		'courriel' => FILTER_SANITIZE_EMAIL,
		'tel_poste' => FILTER_SANITIZE_NUMBER_INT,
		'bureau' => FILTER_SANITIZE_STRING,
		'site' => FILTER_SANITIZE_URL
		);
		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
		
		//Upload de l'image + lien dans la base de donnée
		if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"] != "" && $_FILES["fileToUpload"] != null && $_FILES["fileToUpload"]["size"] != 0){
			include('test_upload.php');
			uploadImage($_FILES["fileToUpload"]);
			$image = "/upload/".$_FILES["fileToUpload"]["name"];
			
			$sql = "UPDATE prof SET prenom=:prenom, nom=:nom, role=:role, courriel=:courriel, tel_poste=:tel_poste ,bureau=:bureau,site=:site,image=:image
					WHERE prof_id=$portfolio_id";
			$requete =$pdo->prepare($sql);
			$requete->bindParam(':prenom', $data_filtre['prenom'], PDO::PARAM_STR);
			$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
			$requete->bindParam(':role', $data_filtre['role'],PDO::PARAM_STR);
			$requete->bindParam(':courriel', $data_filtre['courriel'],PDO::PARAM_STR);
			$requete->bindParam(':tel_poste', $data_filtre['tel_poste'],PDO::PARAM_INT);
			$requete->bindParam(':bureau', $data_filtre['bureau'],PDO::PARAM_STR);
			$requete->bindParam(':site', $data_filtre['site'],PDO::PARAM_STR);
			$requete->bindParam(':image', $image, PDO::PARAM_STR);
			$requete->execute();
		}else{
			
			$sql = "UPDATE prof SET prenom=:prenom, nom=:nom, role=:role, courriel=:courriel, tel_poste=:tel_poste ,bureau=:bureau,site=:site
					WHERE prof_id=$portfolio_id";
			$requete =$pdo->prepare($sql);
			$requete->bindParam(':prenom', $data_filtre['prenom'], PDO::PARAM_STR);
			$requete->bindParam(':nom', $data_filtre['nom'], PDO::PARAM_STR);
			$requete->bindParam(':role', $data_filtre['role'],PDO::PARAM_STR);
			$requete->bindParam(':courriel', $data_filtre['courriel'],PDO::PARAM_STR);
			$requete->bindParam(':tel_poste', $data_filtre['tel_poste'],PDO::PARAM_INT);
			$requete->bindParam(':bureau', $data_filtre['bureau'],PDO::PARAM_STR);
			$requete->bindParam(':site', $data_filtre['site'],PDO::PARAM_STR);
			$requete->execute();
		}
		
	?>
	<a href="gestion-prof.php"><button>Retour</button></a>
<?php include("footer-admin.php"); ?>
