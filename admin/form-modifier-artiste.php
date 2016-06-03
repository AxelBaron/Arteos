<?php include "header-admin.php"; ?>

			<?php 
				include("connectionbdd.php");
				$id_artiste = $_GET["id_artiste"];
				$sql="SELECT * FROM artiste WHERE id_artiste= $id_artiste";
				$liste = $pdo->query($sql);
				$data = $liste->fetch();
			 ?>

			<form class="form" action="traitement-modifier-artiste.php?id_artiste=<?php echo $data['id_artiste']?>" method="POST" enctype="multipart/form-data">
				<h1>ArtEos - Administration : modifier l'artiste' <?php echo $data['nom']; ?></h1>
  				
      				<p> Nom du musicien/groupe : <input type="text" value="<?php echo $data['nom']; ?>" placeholder="NOM" name="nom" tabindex="1" class="redacted" required /></p>
      				<p> Son site web : <input type="text" value="<?php echo $data['site']; ?>" placeholder="site" name="site" /></p>
	    			<input type="submit" value="Envoyer" tabindex="6" class="redacted" />
	  		</form>
		</section>
	</div>
<?php include "footer-admin.php"; ?>
