<?php include "header-admin.php"; ?>


			<?php
				include("connectionbdd.php");
				$id_event_gp = $_GET["id_event_gp"];
				$sql="SELECT * FROM evenement_groupe WHERE id_event_gp= $id_event_gp";
				$liste = $pdo->query($sql);
				$data = $liste->fetch();
			 ?>

			 <h1>ArtEos - Administration : modifier le regroupement d'événement : <?php echo $data['nom']; ?>'</h1>
				<form class="form" action="traitement-modifier-evenement_groupe.php?id_event_gp=<?php echo $data['id_event_gp']?>" method="POST" enctype="multipart/form-data">

					<p>Nom : <input type="text" placeholder="Nom du nouveau regroupement" name="nom" value="<?php echo $data['nom'] ?>" required /></p>
					<p>Date de début du regroupement d'évènements: <input type="date" placeholder="Date du début du festival" name="date_debut" value="<?php echo $data['date_debut'] ?>" required /></p>
					<p>Date de fin du regroupement d'évènements: <input type="date" placeholder="Date de la fin du festival" name="date_fin" value='<?php echo $data['date_fin'] ?>' required /></p>

					<p>Ce regroupement est un :</p>
					<select required name="_id_type_gp">
						 <?php

								$sql="SELECT * FROM type_groupe WHERE id_type_gp=".$data['_id_type_gp'];
								$liste = $pdo->query($sql);
								$datas = $liste->fetch();
								if($datas['nom']== "Concert"){
									$nom = "Festivals de musique";
									$id= $datas['id_type_gp'];
									echo "<option value='$id'>".$nom."</option>";
								}

								if($datas['nom']=="Sports"){
									$nom = "Evénements sportifs";
									$id= $datas['id_type_gp'];
									echo "<option value='$id'>".$nom."</option>";
								}

								if($datas['nom']=="Arts de la scène"){
									$nom = "Festivals d'arts de la scène";
									$id= $datas['id_type_gp'];
									echo "<option value='$id'>".$nom."</option>";
								}



								$req="SELECT id_type_gp, nom FROM type_groupe";
								$liste = $pdo->query($req);

								while ($datass= $liste->fetch()) {
									if($datass['nom']== "Concert"){
										$nom = "Festivals de musique";
										$id= $datass['id_type_gp'];
										echo "<option value='$id'>".$nom."</option>";
									}

									if($datass['nom']=="Sports"){
										$nom = "Evénements sportifs";
										$id= $datass['id_type_gp'];
										echo "<option value='$id'>".$nom."</option>";
									}

									if($datass['nom']=="Arts de la scène"){
										$nom = "Festivals d'arts de la scène";
										$id= $datass['id_type_gp'];
										echo "<option value='$id'>".$nom."</option>";
									}
								}
							?>
					</select>
					<br />
					<br />
					<textarea class='input-block-level' id='summernote' name='txt' rows='18'><?php echo $data['txt']; ?></textarea>
					<input type="submit" value="Continuer" />




	  		</form>
		</section>
	</div>

<?php include "footer-admin.php"; ?>
