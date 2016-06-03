<?php include "header-admin.php"; ?>

	<h1> ArtEos - Administration : Créer un nouveau billet </h1>
	<?php include "connectionbdd.php";

	// Récupération de la page précédente.
	$id_billet= $_POST['id_billet'];


	// Traitement des donnée fournis à la page précédente.


	// Traitement pout le type "Article" & "Sport".
	if ($_POST['_id_type_gp'] == 11 || $_POST['_id_type_gp'] == 5) {
		$liste_de_filtres = array(
			'nom_event' => FILTER_FLAG_ENCODE_HIGH
		);
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
		$sql = "UPDATE evenement_individuel
				SET nom=:nom_event
				WHERE id_event = $id_billet";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':nom_event', $data_filtre['nom_event'], PDO::PARAM_STR);
		$requete->execute();
	}

	// Traitement du nom de l'artiste & du salle/lieu pour les autres types.
	if ($_POST['_id_type_gp'] != 11 && $_POST['_id_type_gp'] != 5) {
		$test=$_POST['nom_artiste'];

		// Si l'utilisateur n'as pas cliqué sur "Ajouter un artiste".
		if ($test== null) {
			$liste_de_filtres = array(
				'choix_artiste' => FILTER_SANITIZE_NUMBER_INT,
				'salle' => FILTER_FLAG_ENCODE_HIGH
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel
					SET _id_artiste = :choix_artiste, salle = :salle
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':choix_artiste', $data_filtre['choix_artiste'], PDO::PARAM_INT);
			$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);
			$requete->execute();
		}else{
		// Si l'utilisateur a cliqué sur "Ajouter un artiste".
			$liste_de_filtres = array(
				'nom_artiste' => FILTER_FLAG_ENCODE_HIGH,
				'site_artiste' => FILTER_SANITIZE_URL
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "INSERT INTO artiste (nom, site) VALUES (:nom_artiste,:site_artiste)";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':nom_artiste', $data_filtre['nom_artiste'], PDO::PARAM_INT);
			$requete->bindParam(':site_artiste', $data_filtre['site_artiste'], PDO::PARAM_STR);
			$requete->execute();

			$sql="SELECT * FROM artiste WHERE nom='".$_POST['nom_artiste']."'";
			$liste=$pdo->query($sql);
			$data = $liste->fetch();
			$id_artiste = $data['id_artiste'];

			$liste_de_filtres = array(
				'salle' => FILTER_FLAG_ENCODE_HIGH
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel
					SET _id_artiste = $id_artiste, salle = :salle
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);
			$requete->execute();
		}



		// Traitement de la ville si l'évenement groupe n'existe pas.
		if ($_POST['btn_radio']==0) {
			$liste_de_filtres = array(
				'ville' => FILTER_FLAG_ENCODE_HIGH
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel
					SET ville = :ville
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->execute();
		}

		//Traitement de l'évenement groupe si il existe
		if ($_POST['btn_radio']==1) {

			$test=$_POST['nom_event_gp'];
			// Si l'utilisateur n'as pas cliqué sur "Ajouter un Regroupement d'évenement".
			if ($test==null) {

				$liste_de_filtres = array(
				'event_gp' => FILTER_SANITIZE_NUMBER_INT,
				'ville' => FILTER_FLAG_ENCODE_HIGH
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel
					SET _id_event_gp = :event_gp, ville = :ville
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':event_gp', $data_filtre['event_gp'], PDO::PARAM_STR);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->execute();
			}else{
			// Si l'utilisateur n'as pas cliqué sur "Ajouter un Regroupement d'évenement".

				$liste_de_filtres = array(
				'nom_event_gp' => FILTER_FLAG_ENCODE_HIGH
				);
				$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
				$sql = "INSERT INTO evenement_groupe (nom) VALUES (:nom_event_gp)";
				$requete = $pdo->prepare($sql);
				$requete->bindParam(':nom_event_gp', $data_filtre['nom_event_gp'], PDO::PARAM_STR);
				$requete->execute();

				$sql="SELECT * FROM evenement_groupe WHERE nom='".$_POST['nom_event_gp']."'";
				$liste=$pdo->query($sql);
				$data = $liste->fetch();
				$id_event_gp = $data['id_event_gp'];


				$liste_de_filtres = array(
					'ville' => FILTER_FLAG_ENCODE_HIGH
				);
				$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
				$sql = "UPDATE evenement_individuel
						SET _id_event_gp = $id_event_gp, ville = :ville
						WHERE id_event = $id_billet";
				$requete = $pdo->prepare($sql);
				$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
				$requete->execute();
				}

		}
	}

	// Traitement salle/lieu pour sport.
	if ($_POST['_id_type_gp'] == 5) {
		$liste_de_filtres = array(
			'salle' => FILTER_FLAG_ENCODE_HIGH
		);
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
		$sql = "UPDATE evenement_individuel
				SET salle = :salle
				WHERE id_event = $id_billet";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':salle', $data_filtre['salle'], PDO::PARAM_STR);
		$requete->execute();

		// Traitement de la ville si l'évenement groupe n'existe pas.
		if ($_POST['btn_radio']==0) {
			$liste_de_filtres = array(
				'ville' => FILTER_FLAG_ENCODE_HIGH
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel
					SET ville = :ville
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->execute();
		}

		//Traitement de l'évenement groupe si il existe
		if ($_POST['btn_radio']==1) {
			$liste_de_filtres = array(
				'event_gp' => FILTER_SANITIZE_NUMBER_INT,
				'ville' => FILTER_FLAG_ENCODE_HIGH
			);
			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = "UPDATE evenement_individuel
					SET _id_event_gp = :event_gp, ville = :ville
					WHERE id_event = $id_billet";
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':event_gp', $data_filtre['event_gp'], PDO::PARAM_STR);
			$requete->bindParam(':ville', $data_filtre['ville'], PDO::PARAM_STR);
			$requete->execute();
		}
	}




	//Creation du titre selon les informations récupéré précedements.
	// Creation du titre pour tous les types sauf pour les types "Article" et "Sport".
	if ($_POST['_id_type_gp'] != 11 && $_POST['_id_type_gp'] != 5) {

		//Si l'évent groupe n'existe pas
		if ($_POST['btn_radio']==0) {
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
		}

		//Si l'évent groupe n'existe existe
		if ($_POST['btn_radio']==1) {
			$sql3="SELECT evenement_individuel.ville, evenement_individuel.date, evenement_groupe.nom AS nom_event, artiste.nom AS nom_artiste
				   FROM evenement_individuel
				   INNER JOIN evenement_groupe ON evenement_individuel._id_event_gp = evenement_groupe.id_event_gp
				   INNER JOIN artiste ON evenement_individuel._id_artiste = artiste.id_artiste
				   WHERE id_event=$id_billet";
			$liste3 = $pdo->query($sql3);
			$data3= $liste3->fetch();

			$old_date = $data3['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp);
			$titre = $new_date." - ".$data3['nom_artiste']." @ ".$data3['nom_event']." - ".$data3['ville'];
			$chaine = $titre;
			echo $chaine;
		}
	}

	//Création du titre pour le type "Sport"
	if ($_POST['_id_type_gp'] == 5) {

		// Si il ne fait pas parti d'un évenement
		if ($_POST['btn_radio']==0) {
			$sql="SELECT * FROM evenement_individuel WHERE id_event = $id_billet";
			$liste = $pdo->query($sql);
			$data= $liste->fetch();
			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp);
			$titre = $new_date." - ".$data['nom']." @ ".$data['salle']." - ".$data['ville'];
			$chaine = $titre;
		}

		if ($_POST['btn_radio']==1) {
			$sql="SELECT evenement_individuel.nom AS nom_event, evenement_individuel.ville,evenement_individuel.date, evenement_groupe.nom FROM evenement_individuel
				 INNER JOIN evenement_groupe ON
				 evenement_individuel._id_event_gp = evenement_groupe.id_event_gp
				 WHERE id_event =$id_billet";
			$liste = $pdo->query($sql);
			$data= $liste->fetch();
			$old_date = $data['date'];
			$old_date_timestamp = strtotime($old_date);
			$new_date = date('d/m/Y', $old_date_timestamp);
			$titre = $new_date." - ".$data['nom_event']." @ ".$data['nom']." - ".$data['ville'];;
			$chaine = $titre;
		}
	}

	//Creation du titre pour les type 'Article'
	if ($_POST['_id_type_gp'] == 11) {
		$sql="SELECT * FROM evenement_individuel WHERE id_event = $id_billet";
		$liste = $pdo->query($sql);
		$data= $liste->fetch();
		$old_date = $data['date'];
		$old_date_timestamp = strtotime($old_date);
		$new_date = date('d/m/Y', $old_date_timestamp);
		$titre = $new_date." - ".$data['nom'];
		$chaine = $titre;
	}

	// Update du titre de l'article
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


	// Creation du nom de dossier à créer, à partir du titre.
	setlocale(LC_ALL, 'fr_FR');
	$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
	$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
	filter_var($chaine,FILTER_FLAG_ENCODE_HIGH);
	while(strpos($chaine, '__') !== false){
	  $chaine = str_replace('__', '_', $chaine);
	}
	$chaine = trim($chaine, '_');




	// Formulaire pour remplir la suite du billet.
	// Photographes
	echo '<form action="traitement-ajouter-event-ind-5.php" method="POST">';
	echo "<p>Quel photographe est l'auteur des photos ?</p>";
	echo "<select name='photographe'>
		<option></option>";

		$sql="SELECT * FROM photographe ";
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
		}

	echo"</select>";
	?>
	<p><a href="#" id="btn_ajax" value="873" onclick="afficherFormModif5()">Plusieurs photographes ont couvert l'évènement ? Cliquez pour en ajouter !</a></p>
	<div id="affiche">
		<?php
			echo "<p> Deuxième photographe :</p>";
			echo "<select name='photographe2'>";
			echo "<option></option>";
			$sql="SELECT * FROM photographe ";
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
			}
			echo"</select>";


			echo "<p> Troisième photographe :</p>";
			echo "<select name='photographe3'>";
			echo "<option></option>";
			$sql="SELECT * FROM photographe ";
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
			}
			echo"</select>";

			echo "<p> Quatrième photographe :</p>";
			echo "<select name='photographe4'>";
			echo "<option></option>";
			$sql="SELECT * FROM photographe ";
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
			}
			echo"</select> <br/><br/>";
			echo "<p class='explication-form'> Laissez les listes vides pour pour les photographes 3 et 4 si seulement 2 photographes on couvert l'évenement.<br/> Dans le même principe, laissez la liste 4 vide si seulement 3 photographes ont couvert l'évenement.</p>"
		 ?>
	</div>


	<?php
		// Formulaire pour remplir la suite du billet.
		// Textes
		echo "<p>Quel photographe est l'auteur des textes ?</p>";
		echo "<select name='_id_auteur_txt'>
			<option></option>";

			$sql="SELECT * FROM photographe ";
			$liste = $pdo->query($sql);
			while ($data= $liste->fetch()) {
				echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
			}

		echo"</select>";
		?>
		<p><a href="#" id="btn_ajax" value="873" onclick="afficherFormModif7()">Plusieurs photographes ont écrit les textes ? Cliquez pour en ajouter !</a></p>
		<div id="affiche_again">
			<?php
				echo "<p> Deuxième photographe :</p>";
				echo "<select name='_id_auteur_txt2'>";
				echo "<option></option>";
				$sql="SELECT * FROM photographe ";
				$liste = $pdo->query($sql);
				while ($data= $liste->fetch()) {
					echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
				}
				echo"</select>";


				echo "<p> Troisième photographe :</p>";
				echo "<select name='_id_auteur_txt3'>";
				echo "<option></option>";
				$sql="SELECT * FROM photographe ";
				$liste = $pdo->query($sql);
				while ($data= $liste->fetch()) {
					echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
				}
				echo"</select>";

				echo "<p> Quatrième photographe :</p>";
				echo "<select name='_id_auteur_txt4'>";
				echo "<option></option>";
				$sql="SELECT * FROM photographe ";
				$liste = $pdo->query($sql);
				while ($data= $liste->fetch()) {
					echo "<option value=\"".$data['id_photographe']."\">".$data['prenom']." ".$data['nom']."</option>";
				}
				echo"</select> <br/><br/>";
				echo "<p class='explication-form'> Laissez les listes vides pour pour les photographes 3 et 4 si seulement 2 photographes on écrit les textes.<br/> Dans le même principe, laissez la liste 4 vide si seulement 3 photographes ont écrit les textes.</p>"
		 ?>
	</div>

	<input type="hidden" name="titre" value="<?php echo $chaine; ?>"/>
	<input type="hidden" name="id_billet" value="<?php echo $id_billet; ?>"/>

    <textarea class="input-block-level" id="summernote" name="content" rows="18"></textarea>
	<input type="submit" >
	</form>
	</section>
	</div>
<?php include "footer-admin.php"; ?>
<img src="" alt="">
