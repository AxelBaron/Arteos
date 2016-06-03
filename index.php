<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Actualités d'ArtEos</title>
	<meta description="Les dernières photographies d'évènement du collectif de photographes ArtEos.">
</head>

<?php include('includes/header.php'); ?>
<?php include('includes/slider.php'); ?>
<?php include('includes/ariane.php'); ?>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>
<script src='js/scrollPlusIndex.js'></script>


	<div class="clear"></div>

	<section class='recepteur'>

		<?php 
		$sql="SELECT * FROM evenement_individuel ORDER BY id_event DESC LIMIT 8";
		$liste = $pdo->query($sql);
        
		while ($data= $liste->fetch()) {
			
			echo"<article class='item' id='".$data['id_event']."'>";
				$sql2="SELECT f_link FROM file_upload WHERE couverture = 1 AND _id_event_ind=".$data['id_event'];
				$test = $pdo->query($sql2);
				$img = $test->fetch();
				$txt = $data['txt'];
				$nbChar = 200;
				if(strlen($txt) >= $nbChar)
	    		$txt = substr($txt, 0, $nbChar);
	    		$txt = explode("</p>", $txt);
	    		$txt =$txt["0"]." ...<br><br>";

				echo'<figure class="imagephoto">';

						if(isset($img['f_link'])){
							echo '<img src="'.$img['f_link'].'" alt="'.$data['_id_type_indiv'].'" width="640" height="426">';
						}
						else{
							echo '<img src="images/img-indisponible.jpg" alt="image indisponible" width="640" height="426">';
						}

				
					echo'<a href="billet.php?id_event='.$data['id_event'].'">
					<figcaption>';
	                    echo "<p>".$txt;
	                    echo'<span id="fauxlien">Lire la suite...</span></p>';
	                echo"</figcaption></a>
				</figure>";
				$mystring = $data['nom'];
				$taille = strlen ($mystring);
				$pos = strpos($mystring, '@');
				$avant = substr($mystring, 0, $pos);
				$apres = substr($mystring, $pos+1, $taille);
				echo"<a href='billet.php?id_event=".$data['id_event']."'>";

				if(strlen($avant) > 40 && strlen($avant) < 50){

					echo "<h2 id='minititre'>".$avant."</h2>";

				}
				elseif(strlen($avant) >= 45){
					echo "<h2 id='microtitre'>".$avant."</h2>";
				}
				else{
					echo "<h2>".$avant."</h2>";
				}
				
				echo "<h3>".$apres."</h3>";
				echo "</a>
			</article>";
		}
        
        $sql="SELECT * FROM evenement_individuel ORDER BY date DESC LIMIT 11";
		$liste = $pdo->query($sql);
        $data= $liste->fetch();
        if($data == null){
            echo "<center><p> Il n'y a pas d'article dans cette catégorie.</p></center>";
        }


		$sql="SELECT * FROM evenement_individuel ORDER BY RAND() LIMIT 1";
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo"<article>";
				$sql2="SELECT f_link FROM file_upload WHERE couverture = 1 && _id_event_ind=".$data['id_event'];
				$liste = $pdo->query($sql2);
				$img= $liste->fetch();
				$txt = $data['txt'];
				$nbChar = 200;
				if(strlen($txt) >= $nbChar)
	    		$txt = substr($txt, 0, $nbChar);
	    		$txt = explode("</p>", $txt);
	    		$txt =$txt["0"]." ...<br><br>";
				echo'<figure class="imagephoto">';

						if(isset($img['f_link'])){
							echo '<img src="'.$img['f_link'].'" alt="'.$data['_id_type_indiv'].'" width="640" height="426">';
						}
						else{
							echo '<img src="images/img-indisponible.jpg" alt="image indisponible" width="640" height="426">';
						}

					echo'<a href="billet.php?id_event='.$data['id_event'].'"><figcaption id="lastchild">';
	                    echo "<p>".$txt."<br/ >";
	                    echo'<span id="fauxlien">Lire la suite...</span></p>';
	                echo"</figcaption></a>
				</figure>";
				
				$mystring = $data['nom'];
				$taille = strlen ($mystring);
				$pos = strpos($mystring, '@');
				$avant = substr($mystring, 0, $pos);
				$apres = substr($mystring, $pos+1, $taille);
				echo"<a href='billet.php?id_event=".$data['id_event']."'>
					<h2>".$avant."</h2>
					<h3>".$apres."</h3>
				</a>
			</article>";
		}
	?>		
	</section>

	<div class="clear"></div>
	<div id='marchePas'></div>
	
	<div id="btnscrollinfini" onClick="scrollPlusIndex()">Afficher plus d'articles</div>

<?php include('includes/footer.php'); ?>


