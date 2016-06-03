<?php include("header-admin.php"); ?>	
	
	<h1>Administration #TIM Matane</h1>	
	<h2>Page ajoutée</h2>

	<?php 

		include('connectionbdd.php');
		
		$liste_de_filtres = array(
		'titre' => FILTER_SANITIZE_STRING,
		'resume' => FILTER_SANITIZE_STRING,
		);
		
		$data_filtre = filter_input_array(INPUT_POST,$liste_de_filtres);
		$image = "";
		if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"] != "" && $_FILES["fileToUpload"] != null && $_FILES["fileToUpload"]["size"] != 0){
			include('test_upload.php');
			uploadImage($_FILES["fileToUpload"]);
			$image = "/upload/".$_FILES["fileToUpload"]["name"];
		}
		
		$sql = "INSERT INTO page(titre,resume,image) VALUES(:titre,:resume,:image)";
		$requete =$pdo->prepare($sql);
		$requete->bindParam(':titre', $data_filtre['titre'], PDO::PARAM_STR);
		$requete->bindParam(':resume', $data_filtre['resume'], PDO::PARAM_STR);
		$requete->bindParam(':image', $image ,PDO::PARAM_STR);
		$requete->execute();
		
		//Création de la page
		
		function writeHeader() {
			include("connectionbdd.php");
			
			//INUTILE
			//Requete pour avoir l'ID de la page
			$sql = "SELECT * FROM page ORDER BY page_id DESC";
			$liste = $pdo->query($sql);
			$contenu = $liste->fetch();
			$id = $contenu['page_id'];
			
			//Requete pour trouver les contenus associés à la page
			$sql = "SELECT * FROM contenu WHERE id_page_=".$id;
			$resultat = $pdo->query($sql);
			while($donnees = $resultat->fetch()){
				
			}
			
			$header = "";
			$header = "<?php include('morceaux/header.php');
							include('admin/connectionbdd.php')	?>
						<!-- content -->
						<div class='wrapper row2'>
						  <div id='container'>
							<!-- Slider -->
							<?php include('morceaux/slider.php') ?>
							<!-- main content -->
							<div id='homepage'>
								  <section>
								  <article id='proweb'>";
									
									//Insère le résumé et le titre
									$header .= '<?php 
												$sql = "SELECT * FROM page WHERE page_id='.$id.'";
												$resultat = $pdo->query($sql);
												$contenu = $resultat->fetch();
												
												echo "<img src=\'admin/".$contenu[\'image\']."\' alt=\'Image de description\' title=\'Image de description\' width=\'312\' height=\'300\'>";
												echo "</article>";
												echo "<article id=\'descriptionproweb\'>";
												
												echo "<h2>".$contenu[\'titre\']."</h2>";
												if($contenu[\'resume\'] != "" && isset($contenu[\'resume\'])){
													echo "<li><p>".$contenu[\'resume\']."</p></li>";
												}else{
													echo "<li><p>Il n\'y a pas de résumé disponible pour cette page.</p></li>";
												}
												?>';	
								
									//Insère les titres de Contenues
									$header .= '<?php 
												$sql = "SELECT * FROM contenu WHERE id_page_='.$id.'";
												$resultat = $pdo->query($sql);
												while($donnees = $resultat->fetch()){
													echo ("<h2 id=\'lienancre\'><a href=\'#".$donnees[\'titre\']."\'>".$donnees[\'titre\']."</a></h2>");
												}
												?>';	
									
						$header .= "</article>
								  </section>
								  
								</div>
							</section>
							<!-- main content -->
							<div id='content'>

							  <div id='conteneurprincipal'>";
							  
						$header .= '<?php
						$sql = "SELECT * FROM contenu WHERE id_page_='.$id.'";
						$resultat = $pdo->query($sql);
						while($donnees = $resultat->fetch()){
							echo("<h1 id=\'".$donnees[\'titre\']."\'>".$donnees[\'titre\']."</h1>");
							echo("<div class=\'conteneursecondaire\'>");
							echo($donnees[\'contenu\']);
							echo("</div>");
						} ?>';
			return $header;
		}
		
		function writeFooter(){
		$footer = "";
		$footer = "</div>
				<!-- content body -->
				</div>
			  <div class='clear'></div> 
			  <div id='citations'>
				<p class='cita'>\"Une formation qui a de l'avenir...\"</p>
			  </div><!-- FIN CITATIONS -->  
			  <?php include('morceaux/footer.php') ?>
			</div>
			</div>
			</body>
			</html>";
		return $footer;
		}
		
		$file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', $data_filtre['titre']);
		// Remove any runs of periods (thanks falstro!)
		$file = preg_replace("([\.]{2,})", '', $file);
		
		$nomDuFichier = $file;
		$thePage = fopen("../".$nomDuFichier.".php", "w");
		$header = writeHeader();
		fwrite($thePage, $header);
		$footer = writeFooter();
		fwrite($thePage, $footer);
		fclose($thePage);

	?>
	<a href="gestion-page.php"><button>Retour</button></a>
<?php include("footer-admin.php"); ?>
