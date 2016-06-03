<?php include("header-admin.php"); ?>

	<?php $page_id = $_GET['page_id']; ?>

	<h1>Administration #TIM Matane</h1>	
	<h2>Page modifié : <?php echo $_POST["titre"] ;?></h2>

	<?php

		include('connectionbdd.php');
		
		$liste_de_filtres = array(
		'titre' => FILTER_SANITIZE_STRING,
		'resume' => FILTER_SANITIZE_STRING
		);
		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);



		$sql="SELECT * FROM page WHERE page_id=$page_id";
		$liste = $pdo->query($sql);
		$data = $liste -> fetch();

		//Upload de l'image + lien dans la base de donnée
		if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"] != "" && $_FILES["fileToUpload"] != null && $_FILES["fileToUpload"]["size"] != 0){
			include('test_upload.php');
			uploadImage($_FILES["fileToUpload"]);
			$image = "/upload/".$_FILES["fileToUpload"]["name"];
			
			$sql = "UPDATE page 
			SET titre =:titre, resume =:resume, image =:image
			WHERE page_id =$page_id;";
			$requete =$pdo->prepare($sql);
			$requete->bindParam(':titre', $data_filtre['titre'], PDO::PARAM_STR);
			$requete->bindParam(':resume', $data_filtre['resume'], PDO::PARAM_STR);
			$requete->bindParam(':image', $image ,PDO::PARAM_STR);
			$requete->execute();
		}else{
			//S'il y a pas d'image
			$sql = "UPDATE page 
			SET titre =:titre, resume =:resume
			WHERE page_id =$page_id;";
			$requete =$pdo->prepare($sql);
			$requete->bindParam(':titre', $data_filtre['titre'], PDO::PARAM_STR);
			$requete->bindParam(':resume', $data_filtre['resume'], PDO::PARAM_STR);
			$requete->execute();	
		}

		
		$nb_contenu = $_POST["nb_contenu"];
		
		//Création des variables dynamic
		 for ($i=1; $i < $nb_contenu+1 ; $i++) { 
			$varContainer = "position".$i."EtIDcontenu";
			$$varContainer = explode("_",$_POST["position$i"]);
		 }
		 $deuxIdentique = false;
	 
		//Condition pour les contenu
		for ($i=1; $i < $nb_contenu+1 ; $i++) { 
			for ($y=$i+1; $y < $nb_contenu+1 ; $y++) { 
				//Vérifie Si le Varcontainer n'est pas identique
				//ex: "$position1EtIDmenu" != "$position2EtIDmenu"
				$varContainer1 = "position".$i."EtIDcontenu";
				$varContainer2 = "position".$y."EtIDcontenu";
				
				if($varContainer1 != $varContainer2){
					//Retire les variables pour les emmagasiner
					$varContainer1Position = array_shift($$varContainer1);
					$varContainer2Position = array_shift($$varContainer2);
					//Remet les variables dans le tableau (OBLIGÉ?)
					array_unshift($$varContainer1, $varContainer1Position);
					array_unshift($$varContainer2, $varContainer2Position);
					
					//Vérifie si les positions sont identiques
					//ex:$position1EtIDmenu[0] == $position2EtIDmenu[0]
					if($varContainer1Position == $varContainer2Position){
					
						/*echo("<div>$$varContainer1 == $$varContainer2</div>");
						echo("<div>$varContainer1Position == $varContainer2Position</div>");
						echo("<div>Deux identique</div>");*/
						$deuxIdentique = true;
					}
				}
			}
		}
		
		//S'il y a deux positions identiques
		if($deuxIdentique == false){
			for ($i=1; $i < $nb_contenu+1; $i++) { 
				$varContainer = "position".$i."EtIDcontenu";
				$position = array_shift($$varContainer);
				$id = array_shift($$varContainer);
				$sql ="UPDATE contenu SET position = $position WHERE contenu_id = $id";
				$pdo->exec($sql);
				//echo "<div>".$sql."</div>";
			}
			echo("<a href='gestion-page.php'><button>Retour</button></a>");
		}else{
			echo("Vous avez deux positions de contenu identique!");
			
			echo("<a href='form-modifier-page.php?page_id=".$page_id."'><button>Retour</button></a>");
		} 			
	?>
<?php include("footer-admin.php"); ?>
