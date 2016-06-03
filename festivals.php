<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Les concerts couverts par ArtEos</title>
	<meta description="Les photographies d'ArtEos prises lors de concerts.">
</head>

<?php include('includes/header.php'); ?>

<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : Photos > <a href="festivals.php">Festivals</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>
<script src="js/scrollPlusFestivals.js"></script>

	<div class="clear"></div>

      <div id="rechercheavancee">
		<hr>

		<form id="formavance2" action="resultatfestival.php" method="GET">
			<fieldset class="souscat">
				<legend>Rechercher dans les regroupements d'évenements :</legend>

        		<input type="search" placeholder="Rechercher un regroupement d'évenement..." name="recherche" />

        		<br />
        		<select name="lettre">
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

        		<select name="mois">
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

        		<select name="annee">
        			<option value="parannee" selected="selected" disabled="disabled">Par année</option>
							<option value="2016">2016</option>
        			<option value="2015">2015</option>
        			<option value="2014">2014</option>
        			<option value="2013">2013</option>
        			<option value="2012">2012</option>
        			<option value="2011">2011</option>
        			<option value="2010">2010</option>
        		</select>

        		<select name="type">
        			<option value="partype" selected="selected" disabled="disabled">Par type</option>
        			<?php
                        $sql="SELECT id_type_gp, nom FROM type_groupe";
                        $liste = $pdo->query($sql);
                        while ($data= $liste->fetch()) {
                            if($data['nom']== "Concert"){
                                $nom = "Festivals de musique";
                            }

                            if($data['nom']=="Sports"){
                                $nom = "Evénements sportifs";
                            }

                            if($data['nom']=="Arts de la scène"){
                                $nom = "Festivals d'arts de la scène";
                            }

                            $id= $data['id_type_gp'];
                            echo "<option value='$id'>".$nom."</option>";
                        }

                    ?>

        		</select>

        		<input border='0' src="images/loupe.png" type="image" value="submit" align="middle" />

			</fieldset>
		</form>
	</div>
    <section class='recepteur'>

       <?php
            $sql="SELECT * FROM evenement_groupe ORDER BY id_event_gp DESC LIMIT 12";
            $liste = $pdo->query($sql);
            while ($data= $liste->fetch()) {

    			echo"<article class='item' id='".$data['id_event_gp']."'>";
        			$sql2="SELECT f_link FROM file_upload WHERE _id_event_gp=".$data['id_event_gp'];
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
        				 echo'<a href="event_gp.php?id_event='.$data['id_event_gp'].'">
                         <figcaption>';
        					echo "<p>".$txt."<br />";
        					echo'<span id="fauxlien">Lire la suite...</span></p>';
        				echo"</figcaption></a>
        			</figure>";
                    $avant = $data['nom'];

                    $old_date_debut = $data['date_debut'];
        			$old_date_debut_timestamp = strtotime($old_date_debut);
        			$new_date_debut = date('d/m/Y', $old_date_debut_timestamp);

                    $old_date_fin = $data['date_fin'];
        			$old_date_fin_timestamp = strtotime($old_date_fin);
        			$new_date_fin = date('d/m/Y', $old_date_fin_timestamp);

        			$apres = $new_date_debut. " au ".$new_date_fin;
        			echo"<a href='event_gp.php?id_event=".$data['id_event_gp']."'>
        				<h2>".$avant."</h2>
        				<h3>".$apres."</h3>
        			</a>
    			</article>";
            }


        $sql="SELECT * FROM evenement_groupe ORDER BY id_event_gp DESC LIMIT 12";
		$liste = $pdo->query($sql);
        $data= $liste->fetch();
        if($data == null){
            echo "<center><p> Il n'y a pas d'article dans cette catégorie.</p></center>";
        }

        ?>
    </section>


	<div class="clear"></div>
	<div id='marchePas'></div>

	<div id="btnscrollinfini" onClick="scrollPlusFestivals()">Afficher plus d'articles</div>

<?php include('includes/footer.php'); ?>
