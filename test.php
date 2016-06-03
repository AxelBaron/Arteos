<?php 
	include('admin/connectionbdd.php');
	// je me connecte
	$sql = "SELECT * FROM photographe";
	// j'écris et je stock ma requête
	$liste = $pdo -> query($sql);
	// dans ma variable $liste, je pose la question au serveur avec ma requête "query($sql)"
	$resultat = $liste -> fetch();
	// je transforme ma liste en tableau via fetch et je la stock dans resultat
	
	while($resultat = $liste -> fetch()){ ?>
		<p>NOM : </p> <?php echo $resultat['nom'];?> et PRENOM : <?php echo $resultat['prenom'];?><br /> 
	<?php } ?>


