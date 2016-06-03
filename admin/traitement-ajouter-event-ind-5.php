	<?php
		include "header-admin.php";
		if ($_POST['photographe2']==null && $_POST['photographe3']==null && $_POST['photographe4']==null) {

			$liste_de_filtres = array(

				'content' => FILTER_FLAG_ENCODE_HIGH,
				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'photographe' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_photographe = :photographe, txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':photographe', $data_filtre['photographe'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];
		}elseif ($_POST['photographe3']==null && $_POST['photographe4']==null) {

			$liste_de_filtres = array(

				'content' => FILTER_FLAG_ENCODE_HIGH,
				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'photographe' => FILTER_SANITIZE_NUMBER_INT,
				'photographe2' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_photographe = :photographe, _id_photographe2 = :photographe2, txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':photographe', $data_filtre['photographe'], PDO::PARAM_INT);
			$requete->bindParam(':photographe2', $data_filtre['photographe2'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];

		}elseif ($_POST['photographe4']==null) {

			$liste_de_filtres = array(

				'content' => FILTER_FLAG_ENCODE_HIGH,

				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'photographe' => FILTER_SANITIZE_NUMBER_INT,
				'photographe2' => FILTER_SANITIZE_NUMBER_INT,
				'photographe3' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_photographe = :photographe, _id_photographe2 = :photographe2, _id_photographe3 = :photographe3, txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':photographe', $data_filtre['photographe'], PDO::PARAM_INT);
			$requete->bindParam(':photographe2', $data_filtre['photographe2'], PDO::PARAM_INT);
			$requete->bindParam(':photographe3', $data_filtre['photographe3'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];

		}else{

			$liste_de_filtres = array(
				'content' => FILTER_FLAG_ENCODE_HIGH,
				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'photographe' => FILTER_SANITIZE_NUMBER_INT,
				'photographe2' => FILTER_SANITIZE_NUMBER_INT,
				'photographe3' => FILTER_SANITIZE_NUMBER_INT,
				'photographe4' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_photographe = :photographe, _id_photographe2 = :photographe2, _id_photographe3 = :photographe3, _id_photographe4 = :photographe4,txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':photographe', $data_filtre['photographe'], PDO::PARAM_INT);
			$requete->bindParam(':photographe2', $data_filtre['photographe2'], PDO::PARAM_INT);
			$requete->bindParam(':photographe3', $data_filtre['photographe3'], PDO::PARAM_INT);
			$requete->bindParam(':photographe4', $data_filtre['photographe4'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];
		}

		// A MODIFIERRRRRRRRRRRRRRRRR.

		if ($_POST['_id_auteur_txt2']==null && $_POST['_id_auteur_txt3']==null && $_POST['_id_auteur_txt4']==null) {

			$liste_de_filtres = array(
				'content' => FILTER_FLAG_ENCODE_HIGH,

				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);

			$sql = 'UPDATE evenement_individuel SET _id_auteur_txt = :_id_auteur_txt, txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt', $data_filtre['_id_auteur_txt'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];

		}elseif ($_POST['_id_auteur_txt3']==null && $_POST['_id_auteur_txt4']==null) {

			$liste_de_filtres = array(
				'content' => FILTER_FLAG_ENCODE_HIGH,

				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt2' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_auteur_txt = :_id_auteur_txt, _id_auteur_txt2 = :_id_auteur_txt2, txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt', $data_filtre['_id_auteur_txt'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt2', $data_filtre['_id_auteur_txt2'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];

		}elseif ($_POST['_id_auteur_txt4']==null) {

			$liste_de_filtres = array(
				'content' => FILTER_FLAG_ENCODE_HIGH,

				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt2' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt3' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_auteur_txt = :_id_auteur_txt, _id_auteur_txt2 = :_id_auteur_txt2, _id_auteur_txt3 = :_id_auteur_txt3, txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt', $data_filtre['_id_auteur_txt'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt2', $data_filtre['_id_auteur_txt2'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt3', $data_filtre['_id_auteur_txt3'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];

		}else{

			$liste_de_filtres = array(
				'content' => FILTER_FLAG_ENCODE_HIGH,

				'id_billet' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt2' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt3' => FILTER_SANITIZE_NUMBER_INT,
				'_id_auteur_txt4' => FILTER_SANITIZE_NUMBER_INT
			);

			$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
			$sql = 'UPDATE evenement_individuel SET _id_auteur_txt = :_id_auteur_txt, _id_auteur_txt2 = :_id_auteur_txt2, _id_auteur_txt3 = :_id_auteur_txt3, _id_auteur_txt4 = :_id_auteur_txt4,txt = :content  WHERE id_event = :id_billet';
			$requete = $pdo->prepare($sql);
			$requete->bindParam(':content', $data_filtre['content'], PDO::PARAM_STR);
			$requete->bindParam(':id_billet', $data_filtre['id_billet'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt', $data_filtre['_id_auteur_txt'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt2', $data_filtre['_id_auteur_txt2'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt3', $data_filtre['_id_auteur_txt3'], PDO::PARAM_INT);
			$requete->bindParam(':_id_auteur_txt4', $data_filtre['_id_auteur_txt4'], PDO::PARAM_INT);
			$requete->execute();

			$titre = $_POST['titre'];
		}

		creationdossier($titre);
		function creationdossier ($chaine)
		{
			setlocale(LC_ALL, 'fr_FR');
			$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
			$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
			filter_var($chaine,FILTER_FLAG_ENCODE_HIGH);


			while(strpos($chaine, '__') !== false)
			{
			  $chaine = str_replace('__', '_', $chaine);
			}
			$chaine = trim($chaine, '_');


			$dossierparent = '../dropzone/myuploads';

			if(!is_dir($dossierparent)){
			   mkdir($dossierparent);
			}

			$dossier = '../dropzone/'.$dossierparent."/".$chaine;


			if(!is_dir($dossier)){
			   mkdir($dossier);
			}
			return $chaine;
		}

		$photographe = $_POST['photographe'];
		$id_billet = $_POST['id_billet'];
		$sql = "UPDATE evenement_individuel SET _id_photographe = $photographe WHERE id_event = $id_billet";
		$liste = $pdo->query($sql);
	?>

	<h1>ArtEos - Administration : Créer un nouveau billet - 5</h1>

	<p class="explication-form"> <br/>La mise en page dépendra du nombre d'image de votre billet !<br/>
	 Même si vous ecrivez un article avec une vidéo live ou acoustique, ou d'un autre type,
	 il est impératif de choisir une image qui servira de couverture à votre article.</p>
	 <p>
	 	Attention, l'image de couverture n'apparaitera pas dans votre billet. Si vous voulez
		faire apparaitre l'image de couverture dans votre billet, vous devez la dupliquer, et de préférence la nomer differenement. (ex: couv.jpg). 
	 </p>
	<form action="../dropzone/file-upload.php" class="dropzone">
	</form>


	<form action="traitement-ajouter-event-ind-6.php" method="POST">
		<input type="hidden" name="id_billet" value="<?php echo $id_billet; ?>">

		<p> Quelle image apparaitera en couverture des articles ?<p>
		<p class="explication-form"> Attention, choisir une image format paysage ! format conseillé : 800 x 530 pixels</p>
		<button id="btn_ajax" type="button" onclick="loadXMLDoc()" value="<?php echo $id_billet; ?>">Choisir une image de couverture</button><br/><br/>
		<div id="myDiv"></div>

		<input type="submit" value="Envoyer l'article">
	</form>
	</div>
	</section>
<?php include "footer-admin.php"; ?>
