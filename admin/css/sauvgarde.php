<?php include("header-admin.php");
 	$_id_type_indiv = $_POST['_id_type_indiv'];
 	$id_event = $_POST["id_event"];
 	$sauvgardeAncienTitre = $_POST["titre"];


 	// Si le billet à traiter est un concert
 	if ($_POST['_id_type_indiv']==1) {
 		
 		// Et si il ne fait pas parti d'un festival
 		if ($_POST['btn_radio']==0) {
 			
	 		$liste_de_filtres = array(
				'date' => FILTER_SANITIZE_STRING,
				'choix_artiste' => FILTER_SANITIZE_NUMBER_INT,
				'ville' => FILTER_SANITIZE_STRING,
				'salle' => FILTER_SANITIZE_STRING,
				'photographe' => FILTER_SANITIZE_NUMBER_INT,
			);


			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel 
					SET date = :date, _id_artiste=:choix_artiste , ville= :ville, salle=:salle, _id_photographe=:photographe
					WHERE id_event = $id_event";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':date', $data_filtre['date'], PDO::PARAM_INT);
			$requete->bindParam(':choix_artiste', $data_filtre['choix_artiste'], PDO::PARAM_STR);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);
			$requete->bindParam(':photographe', $data_filtre['photographe'], PDO::PARAM_INT);
			$requete->execute();
			
			$sql="SELECT * FROM evenement_individuel 
				  INNER JOIN artiste
				  ON _id_artiste = id_artiste
				  WHERE id_event = $id_event"; 

			$liste = $pdo->query($sql);
			$data= $liste->fetch();
			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp); 
			$titre = $new_date." - ".$data['nom']." @ ".$data['salle']." - ".$data['ville'];
			$chaine = $titre;	

			$sql2 = "UPDATE evenement_individuel 
					SET nom = '$chaine'
					WHERE id_event = $id_event";
			$test2 = $pdo->query($sql2);
			?>

			<h1>ARTEOS - Administration</h1>	
			<h2>Billet modifié : <?php echo $chaine; ?> </h2>
			<?php 


			// TRAITEMENT DE L'ANCIEN TITRE POUR OBTENIR L'ENCIEN NOM DE DOSSIER
			setlocale(LC_ALL, 'fr_FR');
				$sauvgardeAncienTitre = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $sauvgardeAncienTitre);
				$sauvgardeAncienTitre = preg_replace('#[^0-9a-z]+#i', '_', $sauvgardeAncienTitre);
				filter_var($sauvgardeAncienTitre,FILTER_FLAG_ENCODE_HIGH);


				while(strpos($sauvgardeAncienTitre, '__') !== false)
				{
				  $sauvgardeAncienTitre = str_replace('__', '_', $sauvgardeAncienTitre);
				}
				$sauvgardeAncienTitre = trim($sauvgardeAncienTitre, '_');
			// Traitement terminé
			$nomAncienDossier = $sauvgardeAncienTitre;

			//On traite maintenant le titre actuel pour avoir le futur nom de dossier.
			setlocale(LC_ALL, 'fr_FR');
			$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
			$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
			filter_var($chaine,FILTER_FLAG_ENCODE_HIGH);


			while(strpos($chaine, '__') !== false)
			{
			  $chaine = str_replace('__', '_', $chaine);
			}
			$chaine = trim($chaine, '_');



			// Voila, maintenant on renome l'ancien nom de dossier par le nouveau
			$dossierparent = '../dropzone/myuploads/'; 

			if(!is_dir($dossierparent)){
			   mkdir($dossierparent);
			}

			$dossier = $dossierparent.$chaine;
			
			if(!is_dir($dossier)){
			   rename($dossierparent.$nomAncienDossier,$dossier);
			}


			//Maintenant il faut changer les liens stockés dans la bdd des fichiers présents dans le dossier.
			$sql="SELECT f_link FROM file_upload 
				  WHERE _id_event_ind = $id_event";
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				
				// On récupère tout les lien de la BDD. Il faut maintenant les changer.
				$lienComplet= $data['f_link'];

				//On explose les lien au caractères "/", et on les récupères seulement le nom de la photo.
				$tabLienExplose = explode("/", $lienComplet);
				$nomPhoto = $tabLienExplose['3'];
				echo $nomPhoto;

				//On recrée un nouveau lien qu'on va incerer dans la bdd.
				$newLien = $dossier."/".$nomPhoto;
				
				$sql2="UPDATE file_upload SET f_link = '$newLien' WHERE _id_event_ind = $id_event";
				$pile=$pdo->query($sql2);

			};

 		}elseif($_POST['btn_radio']==1) {
	 		$liste_de_filtres = array(
					'date' => FILTER_SANITIZE_STRING,
					'choix_artiste' => FILTER_SANITIZE_NUMBER_INT,
					'ville' => FILTER_SANITIZE_STRING,
					'salle' => FILTER_SANITIZE_STRING,
					'photographe' => FILTER_SANITIZE_NUMBER_INT,
					'event_gp' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel 
					SET date = :date, _id_artiste=:choix_artiste , ville= :ville, salle=:salle, _id_photographe=:photographe,_id_event_gp = :event_gp
					WHERE id_event = $id_event";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':date', $data_filtre['date'], PDO::PARAM_STR);
			$requete->bindParam(':choix_artiste', $data_filtre['choix_artiste'], PDO::PARAM_INT);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);
			$requete->bindParam(':photographe', $data_filtre['photographe'], PDO::PARAM_INT);
			$requete->bindParam(':event_gp', $data_filtre['event_gp'], PDO::PARAM_INT);
			$requete->execute();
 		}

 		$sql="SELECT evenement_individuel.date, evenement_individuel.ville, evenement_groupe.nom AS event_gp_nom, artiste.nom
				  FROM evenement_individuel 
				  INNER JOIN evenement_groupe
				  ON _id_event_gp = id_event_gp
				  INNER JOIN artiste
				  ON _id_artiste = id_artiste
				  WHERE id_event = $id_event"; 
			$liste = $pdo->query($sql);
			$data= $liste->fetch();




			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp); 
			$titre = $new_date." - ".$data['nom']." @ ".$data['event_gp_nom']." - ".$data['ville'];
			$chaine = $titre;		

			$sql2 = "UPDATE evenement_individuel 
					SET nom = '$chaine'
					WHERE id_event = $id_event";
			$test2 = $pdo->query($sql2);
			?>

			<h1>ARTEOS - Administration</h1>	
			<h2>Billet modifié : <?php echo $chaine; ?> </h2>
			<?php 


			// TRAITEMENT DE L4ANCIEN TITRE POUR OBTENIR L'ENCIEN NOM DE DOSSIER
			setlocale(LC_ALL, 'fr_FR');
				$sauvgardeAncienTitre = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $sauvgardeAncienTitre);
				$sauvgardeAncienTitre = preg_replace('#[^0-9a-z]+#i', '_', $sauvgardeAncienTitre);
				filter_var($sauvgardeAncienTitre,FILTER_FLAG_ENCODE_HIGH);


				while(strpos($sauvgardeAncienTitre, '__') !== false)
				{
				  $sauvgardeAncienTitre = str_replace('__', '_', $sauvgardeAncienTitre);
				}
				$sauvgardeAncienTitre = trim($sauvgardeAncienTitre, '_');
			// Traitement terminé
			$nomAncienDossier = $sauvgardeAncienTitre;

			//On traite maintenant le titre actuel pour avoir le futur nom de dossier.
			setlocale(LC_ALL, 'fr_FR');
			$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
			$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
			filter_var($chaine,FILTER_FLAG_ENCODE_HIGH);


			while(strpos($chaine, '__') !== false)
			{
			  $chaine = str_replace('__', '_', $chaine);
			}
			$chaine = trim($chaine, '_');



			// Voila, maintenant on renome l'ancien nom de dossier par le nouveau
			$dossierparent = '../dropzone/myuploads/'; 

			if(!is_dir($dossierparent)){
			   mkdir($dossierparent);
			}

			$dossier = $dossierparent.$chaine;
			
			if(!is_dir($dossier)){
			   rename($dossierparent.$nomAncienDossier,$dossier);
			}


			//Maintenant il faut changer les liens stockés dans la bdd des fichiers présents dans le dossier.
			$sql="SELECT f_link FROM file_upload 
				  WHERE _id_event_ind = $id_event";
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				
				// On récupère tout les lien de la BDD. Il faut maintenant les changer.
				$lienComplet= $data['f_link'];

				//On explose les lien au caractères "/", et on les récupères seulement le nom de la photo.
				$tabLienExplose = explode("/", $lienComplet);
				$nomPhoto = $tabLienExplose['3'];

				//On recrée un nouveau lien qu'on va incerer dans la bdd.
				$newLien = $dossier."/".$nomPhoto;
				
				$sql2="UPDATE file_upload SET f_link = '$newLien' WHERE _id_event_ind = $id_event";
				$pile=$pdo->query($sql2);
		}

	}
	 	?>
	 

	

	<?php 
	?>
	<a href="gestion-event-ind.php"><button>Retour</button></a>
<?php include("footer-admin.php"); ?>
