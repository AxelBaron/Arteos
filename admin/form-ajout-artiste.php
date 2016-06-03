<?php include("header-admin.php"); ?>	
<h1>ArtEos - Administration : Ajouter un artiste</h1>
	<form action="traitement-ajouter-artiste.php" method="POST" enctype="multipart/form-data">
			
		<?php include "connectionbdd.php"; ?>
		
						<p> Nom du musicien/groupe/troupe/collectif : </p> <br/>
						<input type="text" name="nom" placeholder="Nom du musicien/groupe"></input>
						<p> Son site web : </p> <br/><input type="text" name="site" placeholder="site web"></input><br/><br/>
					
				<input type="submit" value="Envoyer" tabindex="6" class="redacted" />
				
		</section>

	</form>
<?php include("footer-admin.php"); ?>

