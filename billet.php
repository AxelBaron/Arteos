<?php include('includes/head.php'); ?>
	<title>

		<?php
		include('admin/connectionbdd.php');
		$id_event = $_GET['id_event'];
		$sql="SELECT * FROM evenement_individuel WHERE id_event = $id_event";
		$liste = $pdo->query($sql);
		$data= $liste->fetch();
		echo $data["nom"] ;?>

	</title>
	<meta description="Les photographies d'ArtEos prises lors de concerts ou autres évènements.">
</head>

<?php include('includes/header.php'); ?>
			
<?php include('includes/slider.php');

//PHOTOGRAPHE
$sql="SELECT evenement_individuel.nom AS billet,evenement_individuel.txt, photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_photographe=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$data= $liste->fetch();

$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_photographe2=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$data2= $liste->fetch();

$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_photographe3=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$data3= $liste->fetch();

$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_photographe4=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$data4= $liste->fetch();


//AUTEUR TEXTE
$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_auteur_txt=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$dadata= $liste->fetch();

$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_auteur_txt2=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$dadata2= $liste->fetch();

$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_auteur_txt3=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$dadata3= $liste->fetch();

$sql="SELECT photographe.nom, photographe.prenom FROM evenement_individuel
	  INNER JOIN photographe 
	  ON _id_auteur_txt4=id_photographe
	  WHERE id_event = $id_event";
$liste = $pdo->query($sql);
$dadata4= $liste->fetch();
?>


<div id="ariane">
	<p>Vous êtes ici : Photos > <a href="concerts.php">Concerts</a> > <a href="billet.php?id_event=<?php echo $id_event; ?>"><?php echo $data["billet"] ;?></a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>
	<div class="clear"></div>

	<section id="article">

	<hr>	
		<?php 

		echo"<h1>".$data['billet']."</h1>";
		echo "<p>".$data['txt']."</p>";
		echo "<p style='text-align:center; margin-top: 30px; margin-bottom:10px;'> © Photographies par ".$data['prenom']." ".$data['nom'];
		if ($data2['prenom'] != null && $data2['prenom']!=null) {
		 	echo ", ".$data2['prenom']." ".$data2['nom'];
		 } 
		 if ($data3['prenom'] != null && $data3['prenom']!=null) {
		 	echo ", ".$data3['prenom']." ".$data3['nom'];
		 } 
		 if ($data4['prenom'] != null && $data4['prenom']!=null) {
		 	echo ", ".$data4['prenom']." ".$data4['nom'];
		 } 

		// Textes
		echo " <br/>© Texte par ".$dadata['prenom']." ".$dadata['nom'];
		if ($dadata2['prenom'] != null && $dadata2['prenom']!=null) {
		 	echo ", ".$dadata2['prenom']." ".$dadata2['nom'];
		 } 
		 if ($dadata3['prenom'] != null && $dadata3['prenom']!=null) {
		 	echo ", ".$dadata3['prenom']." ".$dadata3['nom'];
		 } 
		 if ($dadata4['prenom'] != null && $dadata4['prenom']!=null) {
		 	echo ", ".$dadata4['prenom']." ".$dadata4['nom'];
		 } 
		echo ".</p>";

		?>
		
			<!--BOUTON J'AIME DE FACEBOOK-->        
			<div id="like">
			<?php $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;?>

				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $monUrl; ?>&amp;width&amp;layout=button&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=656793964435391" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:120px" allowTransparency="true"></iframe>				

				<a href="https://twitter.com/share" class="twitter-share-button" data-via="arteos">Tweet</a>

				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div> 
			<!--FIN DU BOUTON J'AIME-->
		</p>
		
	<hr>	
	
	</section>

				<div class="gamma-container gamma-loading" id="gamma-container">

					<ul class="gamma-gallery">
					<?php 
						$sql="SELECT * FROM file_upload WHERE _id_event_ind = $id_event AND couverture = 0";
						$liste = $pdo->query($sql);
						while ($data= $liste->fetch()) {
							echo"<li>
								<div data-alt=\"".$data['f_name']."\"   data-max-width=\"800\" data-max-height=\"800\">								
									<div data-src=\"".$data['f_link']."\"></div>
									<noscript>
										<img src=\"".$data['f_link']."\" alt=\"".$data['f_name']."\"/>
									</noscript>
								</div>
							</li>";
						}	
					?>	
					</ul>

					<div class="gamma-overlay"></div>

					<!-- ICI ON FAIT LE BOUTON POUR LOADER PLUS D'IMAGES -->
					
				</div>

	<div class="clear"></div>

<?php include('includes/footer.php'); ?>

