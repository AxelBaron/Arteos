<?php include "header-admin.php"; ?>
	
	<h1>ArtEos - Administration : Créer un nouveau billet - 4</h1>
	<?php include "connectionbdd.php"; 
	
	$id_billet= $_POST['id_billet'];
	
	// Cas Concerts et articles vidéos
	if ($_POST['test_categorie']=="concert" || $_POST['test_categorie']=="live") {
		$btn_radio =$_POST['btn_radio'];
		if ($btn_radio=="0") {
			
			$liste_de_filtres = array(
			'ville' => FILTER_SANITIZE_STRING,
			'choix_artiste' => FILTER_SANITIZE_NUMBER_INT,
			'salle' => FILTER_SANITIZE_STRING
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel 
					SET ville = :ville , _id_artiste=:choix_artiste, salle=:salle
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->bindParam(':choix_artiste', $data_filtre['choix_artiste'], PDO::PARAM_INT);
			$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);

			$requete->execute();

			$sql="SELECT * FROM evenement_individuel 
				  INNER JOIN artiste
				  ON _id_artiste = id_artiste
				  WHERE id_event = $id_billet"; 
			$liste = $pdo->query($sql);
			$data= $liste->fetch();
			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp); 
			$titre = $new_date." - ".$data['nom']." @ ".$data['salle']." - ".$data['ville'];
			$chaine = $titre;
			echo $chaine;
			


			$sql2="SELECT * FROM evenement_individuel";
			$liste = $pdo->query($sql2);
			while ($data= $liste->fetch()) {
				if ($data['nom']==$titre) {
					$sql="DELETE FROM evenement_individuel WHERE id_event=$id_billet";
					$liste = $pdo->query($sql);
					$data= $liste->fetch();
					echo "Désolé, l'article crée existe déjà.";
				}else{
					$sql = "UPDATE evenement_individuel 
					SET nom = '$titre'
					WHERE id_event = $id_billet";
					$liste = $pdo->query($sql); 
				}
			}

		}elseif ($btn_radio=="1") {
			# code...
			$liste_de_filtres = array(
			'ville' => FILTER_SANITIZE_STRING,
			'choix_artiste' => FILTER_SANITIZE_NUMBER_INT,
			'event_gp' => FILTER_SANITIZE_NUMBER_INT,
			
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel 
					SET ville = :ville , _id_artiste=:choix_artiste, _id_event_gp =:event_gp
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->bindParam(':choix_artiste', $data_filtre['choix_artiste'], PDO::PARAM_INT);
			$requete->bindParam(':event_gp', $data_filtre['event_gp'], PDO::PARAM_INT);

			$sql2="SELECT evenement_individuel.nom AS nom_billet, evenement_individuel.date, artiste.nom AS nom_artiste
				  FROM evenement_individuel 
				  INNER JOIN artiste ON evenement_individuel._id_artiste = artiste.id_artiste
				  WHERE id_event=$id_billet";

			$liste2 = $pdo->query($sql2);
			$data2= $liste2->fetch();
			

			$sql3="SELECT evenement_individuel.nom AS nom_bidon, evenement_groupe.nom AS nom_event
				   FROM evenement_individuel 
				   INNER JOIN evenement_groupe ON evenement_individuel._id_event_gp = evenement_groupe.id_event_gp 
				   WHERE id_event=$id_billet";
			$liste3 = $pdo->query($sql3);
			$data3= $liste3->fetch();

			$old_date = $data2['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp); 
			$titre = $new_date." - ".$data2['nom_artiste']." @ ".$data3['nom_event'];
			$chaine = $titre;
			echo $chaine;


			$sql2="SELECT * FROM evenement_individuel";
			$liste = $pdo->query($sql2);
			while ($data= $liste->fetch()) {
				if ($data['nom']==$titre) {
					$sql="DELETE FROM evenement_individuel WHERE id_event=$id_billet";
					$liste = $pdo->query($sql);
					$data= $liste->fetch();
					echo "Désolé, l'article crée existe déjà.";
				}else{
					$sql = "UPDATE evenement_individuel 
					SET nom = '$titre'
					WHERE id_event = $id_billet";
					$liste = $pdo->query($sql); 
				}
			}

		}
	}

	if ($_POST['test_categorie']=="sport") {
		$btn_radio =$_POST['btn_radio'];
		if ($btn_radio=="0") {

			$liste_de_filtres = array(
			'nom_event' => FILTER_SANITIZE_STRING,
			'ville' => FILTER_SANITIZE_STRING,
			'sallle' => FILTER_SANITIZE_STRING
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel 
					SET nom = :nom, ville = :ville
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':nom', $data_filtre['nom_event'], PDO::PARAM_STR);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->execute();



			$sql="SELECT * FROM evenement_individuel WHERE id_event = $id_billet"; 
			$liste = $pdo->query($sql);
			$data= $liste->fetch();
			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp); 
			$titre = $new_date." - ".$data['nom']." @ ".$data['ville'];
			$chaine = $titre;
			


			$sql2="SELECT * FROM evenement_individuel";
			$liste = $pdo->query($sql2);
			while ($data= $liste->fetch()) {
				if ($data['nom']==$titre) {
					$sql="DELETE FROM evenement_individuel WHERE id_event=$id_billet";
					$liste = $pdo->query($sql);
					$data= $liste->fetch();
					echo "Désolé, l'article crée existe déjà.";
				}else{
					$sql = "UPDATE evenement_individuel 
					SET nom = '$titre'
					WHERE id_event = $id_billet";
					$liste = $pdo->query($sql); 
				}
			}

		}elseif ($btn_radio=="1") {

		
			$liste_de_filtres = array(
			'nom_event' => FILTER_SANITIZE_STRING,
			'ville' => FILTER_SANITIZE_STRING,
			'event_gp' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel 
					SET nom = :nom, ville = :ville, _id_event_gp = :event_gp
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':nom', $data_filtre['nom_event'], PDO::PARAM_STR);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->bindParam(':event_gp', $data_filtre['event_gp'], PDO::PARAM_INT);
			$requete->execute();


			$sql="SELECT evenement_individuel.nom AS test, evenement_individuel.ville,evenement_individuel.date, evenement_groupe.nom FROM evenement_individuel
				 INNER JOIN evenement_groupe ON
				 evenement_individuel._id_event_gp = evenement_groupe.id_event_gp
				 WHERE id_event =$id_billet"; 
			$liste = $pdo->query($sql);
			$data= $liste->fetch();
			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp); 
			$titre = $new_date." - ".$data['test']." @ ".$data['nom'];
			$chaine = $titre;

			$sql2="SELECT * FROM evenement_individuel";
			$liste = $pdo->query($sql2);
			while ($data= $liste->fetch()) {
				if ($data['nom']==$titre) {
					$sql="DELETE FROM evenement_individuel WHERE id_event=$id_billet";
					$liste = $pdo->query($sql);
					$data= $liste->fetch();
					echo "Désolé, l'article crée existe déjà.";
				}else{
					$sql = "UPDATE evenement_individuel 
					SET nom = '$titre'
					WHERE id_event = $id_billet";
					$liste = $pdo->query($sql); 
				}
			}

			setlocale(LC_ALL, 'fr_FR');
			$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
			$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
			filter_var($chaine,FILTER_FLAG_ENCODE_HIGH);

			while(strpos($chaine, '__') !== false)
			{
			  $chaine = str_replace('__', '_', $chaine);
			}
			$chaine = trim($chaine, '_');
		}
	}

	// if ($_POST['test_categorie']=="article") {
	// 	$liste_de_filtres = array(
	// 		'nom' => FILTER_SANITIZE_STRING,
	// 		);

	// 		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
	// 		$sql = "UPDATE evenement_individuel 
	// 				SET nom = :nom
	// 				WHERE id_event = $id_billet";
	// 		echo $sql;
	// 		$requete = $pdo->prepare($sql);
	// 		$requete->bindParam(':nom', $data_filtre['nom_event'], PDO::PARAM_STR);
	// 		$requete->execute();
	// }
			
	?>
	
	<form action="traitement-ajouter-event-ind-5.php" method="POST">
		
		<?php 	

		echo "<p>Quel photographe est l'auteur des photos ?</p>";
		echo "<select name='photographe' required>
			<option></option>";
						
			$sql="SELECT * FROM photographe "; 
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
			}
						
		echo"</select>";
		?>

		<input type="hidden" name="titre" value="<?php echo $chaine; ?>"/>
		<input type="hidden" name="id_billet" value="<?php echo $id_billet; ?>"/>
		     <textarea id='edit' name="description" style="margin-top: 30px;"></textarea>
		<input type="submit" >
	</form>
	</section>
	</div>
<?php include "footer-admin.php"; ?>


		
		
