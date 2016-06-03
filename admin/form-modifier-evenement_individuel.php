<?php include('header-admin.php') ?>

			<?php
				include("connectionbdd.php");
				$id_event = $_GET["id_event"];
				$sql="SELECT * FROM evenement_individuel WHERE id_event= $id_event";
				$stock = $pdo->query($sql);
				$reponse = $stock->fetch();
				$_id_type_ind = $reponse['_id_type_indiv'];
			 ?>

			<h1>ArtEos - Administration</h1>
			<h2>Modifier le billet : <?php echo $reponse['nom']; ?> </h2>

			 <?php
			 		// Form pour modif de tout type
			 		if ($_GET['_id_type_gp'] == 4 || $_GET['_id_type_gp'] == 5 || $_GET['_id_type_gp'] == 7 || $_GET['_id_type_gp'] == 11 ) {
			 			echo '<form action="traitement-modifier-event-ind.php" method="POST">';
							echo "<input type='hidden' name='id_event' value='".$id_event."'/> ";
							echo "<input type='hidden' name='_id_type_indiv' value='".$_id_type_ind."'/>";
							echo "<input type='hidden' name='titre' value='".$reponse['nom']."' />";
							echo "<input type='hidden' name='_id_type_gp' value='".$_GET['_id_type_gp']."' />";

							// Input pour tout tout les types sauf "Article"
							if ($_GET['_id_type_gp'] != 11) {
								echo "<p> Titre du billet : AUTOMATIQUE </p>";
								echo "<p class='explication-form'>Le titre sera crée automatiquement pour ce type de billet, en combinant la date, le nom de l'artiste et les autres données pour eviter un maximum d'erreurs.<br />
									(ex de titre : 14/04/2005 Les Fatals Picards @ La Cartonnerie - Reims) </p>";
							}

							// Input du titre du billet pour les Articles.
							if ($_GET['_id_type_gp'] == 11) {
								echo "<p>Nom de votre article : </p>";
								echo "<input type='text' class='form' name='nom_article' value='".$reponse['nom']."'/> ";
							}

							//Input du titre du billet pour les Articles.
							if ($_GET['_id_type_gp'] == 5) {
								echo "<p>Nom de votre événement sportif : </p>
								<p class='explication-form'> (ex: course à pied, lancé de javelot, couse de sky ...)</p>";
								$nom = substr($reponse['nom'],13);
								$nom = substr($nom, 0, strpos($nom, "@"));
								$nom = substr($nom,0,-1);
								echo "<input type='text' class='form' name='nom_article' value='".$nom."'/> ";
							}

							// Input Date pour tout le monde
							echo '<p> Date : </p> <input class="form" type="date" name="date" value="'.$reponse["date"].'" required />';

							// Affiche les Artistes sauf pour les sports et les Articles
							if ($_GET['_id_type_gp'] != 5 && $_GET['_id_type_gp'] != 11 ) {
								echo "<p>Musicien/groupe/troupe de théâtre : </p><select name='choix_artiste' required>";
								$sql="SELECT evenement_individuel.id_event, evenement_individuel._id_artiste, artiste.nom, artiste.id_artiste FROM evenement_individuel INNER JOIN artiste ON _id_artiste=id_artiste WHERE id_event = $id_event";
								$liste = $pdo->query($sql);
								$i= $liste->fetch();
								echo "<option value='".$i['_id_artiste']."'required >".$i['nom']."</option>";
								$sql="SELECT * FROM artiste WHERE _id_type_artiste=1";
								$liste = $pdo->query($sql);
								while ($req= $liste->fetch()) {
									echo "<option value=\"".$req['id_artiste']."\" required >".$req['nom']."</option>";
								}
								echo"</select>";
							}


							// Affiche les champs ville sauf pour article
							if ($_GET['_id_type_gp'] != 11) {

							echo '<p> Salle/Lieu : </p> <input class="form"type="text" name="salle" value="'.$reponse["salle"].'"required/>';
							echo '<p> Ville : </p> <input class="form"type="text" name="ville" value="'.$reponse['ville'].'" required/>';
							}

							// Si le concert/sport/Art du spectacle n'est pas associé à un billet
							if ($_GET['_id_event_gp'] == 0) {
								echo "<p> Ce billet n'est actuellement pas lié à un regroupement d'évenement, voulez-vous l'associer à un regroupement d'événements ?</p>";
								echo "<input type='radio' name='btn_radio' value ='0' onClick='afficherFormModif2()' checked /> Non &nbsp; &nbsp;&nbsp;&nbsp;";
								echo "<input type='radio' name='btn_radio' value ='1' onClick='afficherFormModif()' /> Oui";
								echo "<p id='affiche-p'> Choisissez le nom du regroupement d'événement : <br /><br /><select name='event_gp'>";
								$sql="SELECT * FROM evenement_individuel INNER JOIN evenement_groupe ON _id_event_gp=id_event_gp";
								$a = $pdo->query($sql);
								$b= $a->fetch();
								echo "<option value='".$b['id_event_gp']."'>".$b['nom']."</option>";
								$sql="SELECT * FROM evenement_groupe";
								$c = $pdo->query($sql);
								while ($d= $c->fetch()) {
									echo "<option value='".$d['id_event_gp']."''>".$d['nom']."</option>";
								}
								echo"</select></p>";

							}else{
								$sql="SELECT evenement_groupe.nom FROM evenement_individuel
									  INNER JOIN evenement_groupe ON id_event_gp = _id_event_gp
									  WHERE id_event= $id_event";
								$a = $pdo->query($sql);
								$b= $a->fetch();

								echo "<p> Ce billet est actuellement lié à un regroupement d'évenement <br/>";
								echo "Evénement associé actuel : ".$b['nom']."</p>";
								echo "<p>Voulez-vous le dissocier de cet évenement ? ";
								echo "<input type='radio' name='btn_radio' value ='0' onClick='afficherFormModif2()' checked /> Non &nbsp; &nbsp;&nbsp;&nbsp;";
								echo "<input type='radio' name='btn_radio' value ='1' onClick='afficherFormModif()' /> Oui";
								echo "</p>";
								echo "<p id='affiche-p'> L'évenement sera disocié à l'envoi du formulaire.<br /> <br />";
								echo "Voulez-vous associer de cet évenement à un autre regroupement d'évenement ? ";
								echo "<input type='radio' name='btn_radio2' value ='0' onClick='afficherFormModif4()' checked /> Non &nbsp; &nbsp;&nbsp;&nbsp;";
								echo "<input type='radio' name='btn_radio2' value ='1' onClick='afficherFormModif3()' /> Oui";
								echo "</p>";
								echo "<p id='sous_check'>À quel nouvel évenement voulez-vous l'associer ? <br /> <br/>";
								echo "<select name='event_gp'>";
								$sql="SELECT * FROM evenement_individuel INNER JOIN evenement_groupe ON _id_event_gp=id_event_gp";
								$a = $pdo->query($sql);
								$b= $a->fetch();
								echo "<option value='".$b['id_event_gp']."'>".$b['nom']."</option>";
								$sql="SELECT * FROM evenement_groupe";
								$c = $pdo->query($sql);
								while ($d= $c->fetch()) {
								  echo "<option value='".$d['id_event_gp']."''>".$d['nom']."</option>";
								}
								echo"</select>";
								echo "</p>";


							}


							// Affichage du premier photographe
							echo "<p> Photographe(s) : </p>";
							echo "<p class='explication-form'>Laissez les champs vides si vous ne voulez modifier/supprimer certains photographes liées au billet.</p>";
							echo "<select name='photographe'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_photographe=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";


							// Affichage du deuxieme photographe
							echo "<select name='photographe2'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_photographe2=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";

							// Affichage du troisième photographe
							echo "<select name='photographe3'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_photographe3=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";

							// Affichage du quatrième photographe
							echo "<select name='photographe4'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_photographe4=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";



							// Affichage du premier redacteur
							echo "<p> Auteur(s) du texte : </p>";
							echo "<p class='explication-form'>Laissez les champs vides si vous ne voulez modifier/supprimer certains redacteurs liées au billet.</p>";
							echo "<select name='redacteur'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_auteur_txt=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";


							// Affichage du deuxieme redacteur
							echo "<select name='redacteur2'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_auteur_txt2=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";

							// Affichage du troisième redacteur
							echo "<select name='redacteur3'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_auteur_txt3=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";

							// Affichage du quatrième redacteur
							echo "<select name='redacteur4'>";
							$sql="SELECT * FROM evenement_individuel INNER JOIN photographe ON _id_auteur_txt4=id_photographe WHERE id_event = $id_event";
							$liste = $pdo->query($sql);
							$i= $liste->fetch();
							echo "<option value='".$i['id_photographe']."' required>".$i['prenom']." ".$i['nom']."</option>";
							$sql="SELECT * FROM photographe ";
							$liste = $pdo->query($sql);
							while ($photo= $liste->fetch()) {
								echo "<option value=\"".$photo['id_photographe']."\">".$photo['prenom']." ".$photo['nom']."</option>";
							}
							echo"</select> <br/><br/>";?>

						 <?php
							echo"<p> Texte : </p>
							<textarea class='input-block-level' id='summernote' name='txt' rows='18' required>".$reponse['txt']."</textarea>";

							echo "<br>";
							echo "<input type='submit'/>";
							echo '</form>';
			 		}
				 ?>

	</div>
