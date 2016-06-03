<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Les lives couverts par ArtEos</title>
	<meta description="Les photographies d'ArtEos prises lors d'articles.">
</head>

<?php include('includes/header.php'); ?>
<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : Articles > <a href="articles.php">Articles</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

<script src="js/scrollPlusArticles.js"></script>

	<div class="clear"></div>
	<div id="rechercheavancee">
		<hr>

		<form id="formavance" action="resultatarticle.php" method="GET">
			<fieldset class="souscat">
				<legend>Rechercher dans les articles</legend>
        		<input type="search" placeholder="Rechercher un live..." name="recherche" />


        		<br />
        		<select name="lettreconcert">
        			<option value="parlettre" selected="selected" disabled="disabled">Par lettre</option>
        			<option value="a">A</option>
        			<option value="b">B</option>
        			<option value="c">C</option>
        			<option value="d">D</option>
        			<option value="e">E</option>
        			<option value="f">F</option>
        			<option value="g">G</option>
        			<option value="h">H</option>
        			<option value="i">I</option>
        			<option value="j">J</option>
        			<option value="k">K</option>
        			<option value="l">L</option>
        			<option value="m">M</option>
        			<option value="n">N</option>
        			<option value="o">O</option>
        			<option value="p">P</option>
        			<option value="q">Q</option>
        			<option value="r">R</option>
        			<option value="s">S</option>
        			<option value="t">T</option>
        			<option value="u">U</option>
        			<option value="v">V</option>
        			<option value="w">W</option>
        			<option value="x">X</option>
        			<option value="y">Y</option>
        			<option value="z">Z</option>
        		</select>

        		<select name="moisconcerts">
        			<option value="parmois" selected="selected" disabled="disabled">Par mois</option>
        			<option value="01">Janvier</option>
        			<option value="02">Février</option>
        			<option value="03">Mars</option>
        			<option value="04">Avril</option>
        			<option value="05">Mai</option>
        			<option value="06">Juin</option>
        			<option value="07">Juillet</option>
        			<option value="08">Août</option>
        			<option value="09">Septembre</option>
        			<option value="10">Octobre</option>
        			<option value="11">Novembre</option>
        			<option value="12">Décembre</option>
        		</select>

        		<select name="anneeconcerts">
        			<option value="parannee" selected="selected" disabled="disabled">Par année</option>
							<option value="2016">2016</option>
							<option value="2015">2015</option>
        			<option value="2014">2014</option>
        			<option value="2013">2013</option>
        			<option value="2012">2012</option>
        			<option value="2011">2011</option>
        			<option value="2010">2010</option>
        		</select>

        		<input border='0' src="images/loupe.png" type="image" value="submit" align="middle" />

			</fieldset>
		</form>
	</div>
	<section class='recepteur'>

		<?php

		$sql="SELECT * FROM evenement_individuel WHERE _id_type_indiv = 4 ORDER BY id_event DESC LIMIT 12";
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo"<article class='item' id='".$data['id_event']."'>";
                        $sql2="SELECT f_link FROM file_upload WHERE couverture = 1 AND _id_event_ind=".$data['id_event'];
                        $test = $pdo->query($sql2);
                        $img = $test->fetch();
                        $txt = $data['txt'];
                        $nbChar = 144;
                        if(strlen($txt) >= $nbChar)
                $txt = substr($txt, 0, $nbChar).' ...<br><br>';
                        echo'<figure class="imagephoto">';
                            if(isset($img['f_link'])){
                                echo '<img src="'.$img['f_link'].'" alt="'.$data['_id_type_indiv'].'" width="640" height="426">';
                            }
                            else{
                                echo '<img src="images/img-indisponible.jpg" alt="image indisponible" width="640" height="426">';
                            }
                                echo'<a href="billet.php?id_event='.$data['id_event'].'"><figcaption>';
                                        echo "<p>".$txt."<br/ >";
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


                        echo "<h3>".$apres."</h3> ";
                        echo "</a></article>";
		}

        $sql="SELECT * FROM evenement_individuel WHERE _id_type_indiv = 4 ORDER BY date DESC";
		$liste = $pdo->query($sql);
        $data= $liste->fetch();
        if($data == null){
            echo "<center><p> Il n'y a pas d'article dans cette catégorie.</p></center>";
        }
		?>
	</section>

	<div class="clear"></div>
	<div id='marchePas'></div>

	<div id="btnscrollinfini" onClick="scrollPlusArticles()">Afficher plus d'articles</div>

<?php include('includes/footer.php'); ?>
