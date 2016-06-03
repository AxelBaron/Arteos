<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Les concerts couverts par ArtEos</title>
	<meta description="Les photographies d'ArtEos prises lors de concerts.">
</head>

<?php include('includes/header.php'); ?>
			
<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : Photos > Art de la scène > <a href="artderue.php">Art de rue</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>

	<section>
				<?php 
		
		$sql="SELECT * FROM evenement_individuel WHERE _id_type_indiv = 16 ORDER BY date DESC";
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {	
			echo"<article>";
			$sql2="SELECT f_link FROM file_upload WHERE couverture = 1 AND _id_event_ind=".$data['id_event'];
			$test = $pdo->query($sql2);
			$img = $test->fetch();
			echo'<figure class="imagephoto">';
				if(isset($img['f_link'])){
                    echo '<img src="'.$img['f_link'].'" alt="'.$data['_id_type_indiv'].'" width="640" height="426">';
                }
                else{
                    echo '<img src="images/img-indisponible.jpg" alt="image indisponible" width="640" height="426">';
                }
				echo'<a href="billet.php?id_event='.$data['id_event'].'"><figcaption>';
					echo"<p><span id='textelien'>Maxim Nucci, alias Yodelice, c'était LA star de la soirée. Celui que toutes<br/ ></span>"; 
					echo'<a href="billet.php?id_event='.$data['id_event'].'">Lire la suite...</a></p>';
				echo"</figcaption></a>
			</figure>";
			$mystring = $data['nom'];
			$taille = strlen ($mystring);
			$pos = strpos($mystring, '@');
			$avant = substr($mystring, 0, $pos);
			$apres = substr($mystring, $pos+1, $taille);
			echo"<a href='billet.php?id_event=".$data['id_event']."'><h2>".$avant."</h2>
			<h3>".$apres."</h3></a>	
			</article>";
		}
		?>	
		
	</section>

	<div class="clear"></div>

<?php include('includes/footer.php'); ?>


