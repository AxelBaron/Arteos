<?php include"header-admin.php"; ?>
	
	<h1>ArtEos - Administration : Créer un nouveau billet </h1>
	<?php include "connectionbdd.php"; 
		

		// On upload la date et le type de l'article choisi du formulaire précedent
		$liste_de_filtres = array(
			'date' => FILTER_FLAG_ENCODE_HIGH,
		);

		$choix=$_POST['choix'];
		if ($choix == 1  || $choix == 2 || $choix == 8 ) {
			$_id_type_gp = 4;
		}elseif ($choix == 10  || $choix == 11 || $choix == 12 || $choix == 13 || $choix == 14) {
			$_id_type_gp = 5;
		}elseif ($choix == 15  || $choix == 16 || $choix == 17 || $choix == 18) {
			$_id_type_gp = 7;
		}elseif ($choix == 4) {
			$_id_type_gp = 11;
		}
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
		$sql = "INSERT INTO evenement_individuel(date,_id_type_indiv,_id_type_gp ) 
				VALUES(:date,$choix,$_id_type_gp)";
		$requete = $pdo->prepare($sql);
		$requete->bindParam(':date', $data_filtre['date'], PDO::PARAM_STR);
		$requete->execute();


		//On va donc crer les formulaires en fonction du type d'article choisi.
		//On récupère le dernier article uploadé.
		$sql="SELECT * FROM evenement_individuel ORDER BY id_event DESC";
		$liste = $pdo->query($sql);
		$billet= $liste->fetch();

		// Déubut du formuaire
		if ($billet['_id_type_gp']==4 || $billet['_id_type_gp']==5 || $_id_type_gp == 7 || $_id_type_gp == 11) {
			echo '<form action="traitement-ajouter-event-ind-4.php" method="POST">';
			echo "<input type='hidden' name='id_billet' value=".$billet['id_event']." />";
			echo "<input type='hidden' name='_id_type_gp' value='".$billet['_id_type_gp']."'/> ";

			// Liste déroulante du choix de l'artiste, pour tout les type sauf "Article" & "Sport".
			if ($billet['_id_type_gp']!=5 && $_id_type_gp != 11) {
				echo "Nom du Musicien/Groupe/Troupe/Collectif d'artiste :<br />";
				echo "<select name='choix_artiste'>";
				echo "<option></option>";
				$sql="SELECT * FROM artiste WHERE _id_type_artiste=1"; 
				$liste = $pdo->query($sql);
				while ($data= $liste->fetch()) {
					echo "<option value=\"".$data['id_artiste']."\">".$data['nom']."</option>";
				}
				echo"</select> <br/><br/>";
				echo "<a href='#' id='btn_ajax' value ='".$billet['id_event']."' onClick='afficherFormModif5()'>L'artiste n'a pas été créé ? Ajoutez le maintenant !</a>";
				echo "<div id ='affiche'><p>Nom :<br/<br/	><input type='text' name='nom_artiste'/> <p/>";
				echo "<p>Site web :<br/<br/	> <input type='text' name='site_artiste' /></p>";
				echo "<p class='explication-form'><br/>Si vous remplisez ces champs, ces informations seront utilisés pour la créeation du billet.<br/>Si vous avez cliqué par mégarde, laissez ces champs vides et selectionnez un artiste dans la liste. </p></div>";
			}


			// Input nom de billet pour les types "Sport".
			if ($billet['_id_type_gp']==5 ) {
				echo "<p>Insérer le nom de l'évenemement sportif : <br />";
				echo "<p class='explication-form'> (ex: course à pied, lancé de javelot, couse de sky ...)</p>";
				echo "<input type='text' name='nom_event' required/> </p>";
			}


			// Input nom de billet pour les types "Article".
			if ($billet['_id_type_gp']==11 ) {
				echo "<p>Insérer le nom votre article : <br />";
				echo "<input type='text' name='nom_event' required/> </p>";
				echo "<input type='submit' value='Suivant'/>";
				echo "</form>";
			}

			//Input pour la salle/lieu, et du choix du regroupement d'event sauf pour le type "Article".
			if ($_id_type_gp != 11) {
				echo "<p>Dans quelle ville s'est déroulé l'événement ?</p>";
				echo "<p class='explication-form'> (ex: Paris, Reims, Marseille ...)</p>";
				echo "<input type='text' name='ville' required /> </p>";

				//Choix du regroupement d'event.
				echo'<p> L\'événement dont traite ce billet fait-il partie d\'un ensemble ?</p>';
				echo '<p class="explication-form">( ex: course appartenant à une compétition, un concert/spectacle/piece de théâtre ou de danse apartenant à un festival ... )</p>';
				echo '<input type="radio" id="btnTest" name="btn_radio" value="0" onClick="afficher2()"/> Non<br />';
				echo '<input type="radio" id="btnTest" name="btn_radio" value="1" onClick="afficher()" /> Oui  <br />';
				echo "<p id='affiche-p'> Choisissez le nom du regroupement d'évenement : <br />";
				echo "<select name='event_gp'>";
				echo "<option></option>";
				$sql="SELECT * FROM evenement_groupe"; 
				$liste = $pdo->query($sql);
				while ($data= $liste->fetch()) {
					echo "<option value=".$data['id_event_gp'].">".$data['nom']."</option>";
				}
				echo "</select> <br/> <br/>";
				echo "<a href='#' id='btn_ajax' value ='".$billet['id_event']."' onClick='afficherFormModif6()'>L'évenement de groupe n'a pas été créé ? Ajoutez le maintenant !</a>";
				echo "<div id ='affichee'><p>Nom :<br/<br/	><input type='text' name='nom_event_gp'/> <p/>";
				echo "<p class='explication-form'><br/>Si vous remplisez ces champs, ces informations seront utilisés pour la créeation du billet.<br/>Si vous avez cliqué par mégarde, laissez ces champs vides et selectionnez un évenement regroupement d'évenement dans la liste.<br/> A la fin de la création du billet, n'oubliez pas d'assigner une image de couverture à votre nouveau regroupement d'évenement via son menu dédié. </p></div>";
				echo "</p>";
				echo "<p id='affiche-p2'> Dans quelle salle/lieu s'est déroulé l'événement ?</br> <br/>";
				echo "<span class='explication-form'> (ex: Zénith, Rue Pascale, Théâtre de la cité, Gymnase Zola ...)</span><br/>";
				echo "<input type='text' name='salle'/> </p>";
				echo "<p id='affiche-sub'> <input type='submit' value='Suivant'/></p>";
				echo "</form>";
			}
		}

		 ?>
	</section>
	</div>
<?php include "footer-admin.php"; ?>
