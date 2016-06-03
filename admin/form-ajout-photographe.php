<?php include('header-admin.php') ?>

			<form class="form" action="traitement-ajouter-photographe.php" method="POST" enctype="multipart/form-data">
				<h1>ArtEos - Administration : ajouter un photographe</h1>
        <p> Prenom : </p>
        <input type="text" name="prenom" required />
        <p> Nom : </p>
        <input type="text"  name="nom" required />
        <p> Telephone : </p>
        <input type="number" name="telephone">
        <p> Ville(s) :</p>
        <input  type="text" placeholder="Ville(s) ( exemple : Paris / Reims )" name="ville" required />
        <p> Site Web personnel : </p>
        <input  type="text"  name="site"  />
        <p> Adresse mail : </p>
        <input type="text"name="mail" />
        <p> Description : </p>
				<textarea class='input-block-level' id='summernote' name='content'></textarea>
        <input type="submit" value="Envoyer"/>
	  	</form>
<?php include "footer-admin.php"; ?>
