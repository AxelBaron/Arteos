<?php include("header-admin.php"); ?>		
	<h1>Administration #TIM Matane</h1>	
	<h2>Menu ajouté</h2>

	<?php 

		$nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
		$nom_lien = filter_var($_POST['nom_lien'],FILTER_SANITIZE_URL);
	
		include('connectionbdd.php');
		for($i = 1; $i < 9; $i++){
		
			//Création des varaibles avec une valeur Vide par défaut
			$varContainer = "sm_nom_".$i;
			$$varContainer = "";
			$varContainer = "sm_lien_".$i;
			$$varContainer = "";
			
			if(isset($_POST["sm_nom_$i"])){
				//Met les bonne valeurs s'ils existent à leur variable respective: sm_nom_1, sm_nom_2....
				$varContainer = "sm_nom_".$i;
				$$varContainer = filter_var($_POST["sm_nom_$i"], FILTER_SANITIZE_STRING);
				$varContainer = "sm_lien_".$i;
				$$varContainer = filter_var($_POST["sm_lien_$i"], FILTER_SANITIZE_URL);
			}
		}
		
		$sql = "INSERT INTO menu(nom,nom_lien,sm_nom_1,sm_lien_1,sm_nom_2,sm_lien_2,sm_nom_3,sm_lien_3,sm_nom_4,sm_lien_4,sm_nom_5,sm_lien_5,sm_nom_6,sm_lien_6,sm_nom_7,sm_lien_7,sm_nom_8,sm_lien_8) VALUES('$nom','$nom_lien','$sm_nom_1','$sm_lien_1','$sm_nom_2','$sm_lien_2','$sm_nom_3','$sm_lien_3','$sm_nom_4','$sm_lien_4','$sm_nom_5','$sm_lien_5','$sm_nom_6','$sm_lien_6','$sm_nom_7','$sm_lien_7','$sm_nom_8','$sm_lien_8')";
		$requete =$pdo->prepare($sql);
		$requete->execute();
	?>
	<a href="gestion-menu.php"><button>Retour</button></a>
<?php include("footer-admin.php"); ?>
