<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>L'équipe d'ArtEos</title>
	<meta description="Les photographes du collectif ArtEos.">
</head>

<?php include('includes/header.php'); ?>

<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : <a href="lequipe.php">L'équipe</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>

	<section>

		<div id="articletexte">
			<h1>Le collectif ArtEos</h1>
			<h2>Qu'est-ce que le collectif ArtEos? </h2>
			<p>
				Le collectif <a href="actualites.php">_ArtEos_</a> est une association de photographes amateurs et semi-professionnels qui partagent leur passion pour la photographie autour de projets communs et variés.
				Il  a été crée en 2006 à Reims par 3 compères photographes attentifs du cadrage soigné, de la lumière adéquate et du moment opportun.
				Le collectif avait pour but premier de partager et promouvoir, via un site internet, le paysage culturel local, la <a href="concerts.php">scène musicale</a> et les <a href="artderue.php">arts de rue</a>.

			</p>
			<p>

				Basé sur Reims, Le collectif couvre à présent principalement la Champagne-Ardenne, la région Lyonnaise et également Paris. Il est aussi présent dans quelques autres villes en France.
				Nos domaines se sont également étendus puisque nous couvrons aussi bien les <a href="concerts.php">concerts</a>, les <a href="festivals.php">festivals</a>, les <a href="artderue.php">spectacles vivants</a>, le <a href="theatre.php">théâtre</a>, que les <a href="sport.php">événements sportifs</a>.

				<br />

				Nous réalisons également des vidéos musicales acoustiques ainsi que des prestations Live.

			</p>
			<p>

				Vous souhaitez intégrer l'équipe ArtEos ? <a href="nousrejoindre.php">Rejoignez-Nous</a> !
			</p>

			<hr />

			<h2>Les photographes d'ArtEos</h2>

			<?php
				$count ="SELECT COUNT(id_photographe) FROM photographe";
				$res = $pdo->query($count);
				$resultat= $res->fetch();
				$resultat = $resultat[0];

				$test="SELECT * FROM photographe ORDER BY id_photographe ASC";
				$li = $pdo->query($test);
				while ($data= $li->fetch()) {
					$li++;
					echo "<div class='photographe-equipe'>";
					echo"<h3>".$data['prenom']." ".$data['nom']." - ".$data['ville']."</h3>";
					if ($data['img'] != "") {
						echo "<img src='images/photographes/".strtolower($data['prenom']).strtolower($data['nom']).".jpg'/>";
					}else{
						echo "<img src='images/photographes/default.jpg'/>";
					}
					echo"<div>".$data['description']."</div>";
					echo "</div>";

					 if ($li < $resultat) {
						echo "<hr>";
					 }


				}
			?>

		</div>

	</section>

	<div class="clear"></div>

<?php include('includes/footer.php'); ?>
