<?php include("header-admin.php");?>

			<?php
				include("connectionbdd.php");
				$id_photographe = $_GET["id_photographe"];
				$sql="SELECT * FROM photographe WHERE id_photographe= $id_photographe";
				$liste = $pdo->query($sql);
				$data = $liste->fetch();
			 ?>

 			<form class="form" action="traitement-modifier-photographe.php?id_photographe=<?php echo $data['id_photographe']?>" method="POST" enctype="multipart/form-data">
 				<h1>ArtEos - Administration : ajouter un photographe</h1>
         <p> Prenom : </p>
         <input type="text" name="prenom" value="<?php echo $data['prenom']; ?>" required />
         <p> Nom : </p>
         <input type="text"  name="nom" value="<?php echo $data['nom']; ?>" required />
         <p> Telephone : </p>
         <input type="number" name="tel" value="<?php echo $data['telephone']; ?>">
         <p> Ville(s) :</p>
         <input  type="text" value="<?php echo $data['ville']; ?>" name="ville" required />
         <p> Site Web personnel : </p>
         <input  type="text"  name="site" value="<?php echo $data['site']; ?>"/>
         <p> Adresse mail : </p>
         <input type="text"name="mail" />
         <p> Description : </p>
 				<textarea class='input-block-level' id='summernote' name='content'>
 					<?php echo $data['description']; ?>
 				</textarea>
         <input type="submit" value="Envoyer"/>
 	  	</form>
			<?php include "footer-admin.php"; ?>
		</section>
