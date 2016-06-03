<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Les sports couverts par ArtEos</title>
	<meta description="Les photographies d'ArtEos prises lors de concerts.">
</head>

<?php include('includes/header.php'); ?>

<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : Photos > <a href="sport.php">Sports</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>
      <div id="rechercheavancee">
		<hr>

		<form id="formavance2" action="resultatsport.php" method="GET">
			<fieldset class="souscat">
				<legend>Rechercher dans les sports :</legend>
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
                        $sql="SELECT id_type_indiv, nom FROM type_indiv";
                        $liste = $pdo->query($sql);
                        while ($data= $liste->fetch()) {
                            if($data['nom']== "Athlétisme"){
                                $nom = "Athlétisme";
                                $id= $data['id_type_indiv'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                            if($data['nom']=="Cyclisme"){
                                $nom = "Cyclisme";
                                $id= $data['id_type_indiv'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                            if($data['nom']=="Sports sur glace"){
                                $nom = "Sports sur glace";
                                $id= $data['id_type_indiv'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                            if($data['nom']=="Sports nautiques"){
                                $nom = "Sports nautiques";
                                $id= $data['id_type_indiv'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                            if($data['nom']=="Autres sports"){
                                $nom = "Autres sports";
                                $id= $data['id_type_indiv'];
                                echo "<option value='$id'>".$nom."</option>";
                            }

                        }

                    ?>

        		</select>

        		<input border='0' src="images/loupe.png" type="image" value="submit" align="middle" />


			</fieldset>
		</form>

	</div>
    <section>
    <a href="sport.php"><div id="btnscrollinfini">Retour à tous les articles de la catégorie "sports"</div></a>
	<?php

        $recherche ="";
        $lettre ="";
        $mois="";
        $annee="";
        $type="";
        $sql="";

        if (isset($_GET["recherche"])){
            $recherche = filter_var($_GET["recherche"],FILTER_SANITIZE_STRING);
            $recherche = $_GET["recherche"];
        }

        if (isset($_GET["lettre"])){
            $lettre = $_GET["lettre"];
        }

        if (isset($_GET["mois"])){
            $mois = $_GET["mois"];
        }

        if (isset($_GET["annee"])){
            $annee =  $_GET["annee"];
        }

        if (isset($_GET["type"])){
            $type =  $_GET["type"];
        }

        if($recherche == null && $lettre==null && $mois==null && $annee==null && $type==null){
            echo '<center><p>Veuillez au moins remplir un champ de recherche.<br/><a href="sport.php">Afficher tout les articles dans la catégorie sport.</a></p><br/><br/></center>';
        }else{
            $sql = "SELECT id_event,_id_type_gp,txt,date,nom FROM evenement_individuel WHERE _id_type_gp=5 AND";


        if($recherche != null){
            $sql.= " nom LIKE '%$recherche%' AND ";
        }

        if($lettre != null){
            $sql.= " nom LIKE '% - $lettre%' AND ";
        }

        if($mois != null){
            $sql.= " nom LIKE '%/$mois%' AND ";
        }

        if($annee != null){
            $sql.= " nom LIKE '%/$annee%' AND ";
        }

        if($type != null){
                $sql.= " _id_type_indiv =$type AND ";
        }

        $sql= rtrim($sql,' AND');
        $sql.= " LIMIT 12";

        //Affichage de la recherche
        $liste = "";
        $liste = $pdo->query($sql);
        if($liste->fetch()){
            $liste = $pdo->query($sql);

            echo "<center><p>Resultat de votre recherche : ";
            if($recherche!=null){
                echo "'".$recherche."'";
            }
            if($lettre!=null){
                echo " pour la lettre ".$lettre;
            }
            if($mois!=null){
                echo " pour le mois numéro ".$mois;
            }
            if($annee!=null){
                echo " pour l'année ".$annee;
            }
            if($type!=null){
                $sql2="SELECT id_type_indiv, nom FROM type_indiv WHERE id_type_indiv = $type";
                        $liste = $pdo->query($sql2);
                        while ($data= $liste->fetch()) {
                            if($data['nom']== "Athlétisme"){
                                $nom = "Athlétisme";
                                echo " pour le type ".$nom;
                            }

                            if($data['nom']=="Cyclisme"){
                                $nom = "Cyclisme";
                                echo " pour le type ".$nom;
                            }

                            if($data['nom']=="Sports sur glace"){
                                $nom = "Sports sur glace";
                                echo " pour le type ".$nom;
                            }

                            if($data['nom']=="Sports nautiques"){
                                $nom = "Sports nautiques";
                                echo " pour le type ".$nom;
                            }

                            if($data['nom']=="Autres sports"){
                                $nom = "Autres sports";
                                echo " pour le type ".$nom;
                            }

                        }
            }
            echo ".";
            echo "</p></center>";

            $liste = "";
            $liste = $pdo->query($sql);
            while ($data= $liste->fetch()) {
            echo"<article>";
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
                                echo'<a href="billet.php?id_event='.$data['id_event'].'">
                                <figcaption>';
                                        echo "<p>".$txt."<br />";
                                        echo'<span id="fauxlien">Lire la suite...</span></p>';
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
        }else{
            echo "<center><p>Resultat de votre recherche : ";
            if($recherche!=null){
                echo "'".$recherche."'";
            }
            if($lettre!=null){
                echo " pour la lettre ".$lettre;
            }
            if($mois!=null){
                echo " pour le mois numéro ".$mois;
            }
            if($annee!=null){
                echo " pour l'année ".$annee;
            }

            if($type!=null){
                    $sql2="SELECT id_type_indiv, nom FROM type_indiv WHERE id_type_indiv = $type";
                        $liste = $pdo->query($sql2);
                        while ($data= $liste->fetch()) {
                            if($data['nom']== "Athlétisme"){
                                $nom = "Athlétisme";
                            }

                            if($data['nom']=="Cyclisme"){
                                $nom = "Cyclisme";
                            }

                            if($data['nom']=="Sports sur glace"){
                                $nom = "Sports sur glace";
                            }

                            if($data['nom']=="Sports nautiques"){
                                $nom = "Sports nautiques";
                            }

                            if($data['nom']=="Autres sports"){
                                $nom = "Autres sports";
                            }

                        }
                    }
                    echo " pour le type ".$nom;
            echo ".</p></center>";
            echo "<center><p> Désolé, aucun résultat ne correspond à votre recherche.</p></center>";
            }
        }
    ?>
</section>
