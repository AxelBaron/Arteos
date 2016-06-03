<?php include "header-admin.php"; ?>
	
	
	<h1>ArtEos - Administration : Créer un nouveau billet</h1>
	<?php include "connectionbdd.php"; ?>


	<form action="traitement-ajouter-event-ind-2.php" method="POST" enctype="multipart/form-data">
			
				<p> Titre du billet : AUTOMATIQUE </p>
				<p class="explication-form">Le titre sera crée automatiquement pour ce type de billet, en combinant la date, le nom de l'artiste et les autres données pour eviter un maximum d'erreur.<br />
					(ex de titre : 14/04/2005 Les Fatals Picards @ La Cartonnerie - Reims) </p>
				<p> Date : </p> <input class="form" type="date" name="date" value="aaaa-mm-jj" required/></p>


				<p> Type : <br />
				<p class="explication-form">Détermine dans quel menu sera votre article</p>
					<select name="choix" required>
						<option></option>
						<?php 
							$sql="SELECT * FROM type_indiv"; 
							$liste = $pdo->query($sql);
							while ($data= $liste->fetch()) {
								echo "<option value=\"".$data['id_type_indiv']."\">".$data['nom']."</option>";
							}
						?>
					</select>
				</p> 
				
				<input type="submit" name="enregistrer" id="enregistrer" value="Suivant" />
	</form>
	
	</section>
	</div>
	
<?php include "footer-admin.php"; ?>
