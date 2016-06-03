<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Les festivals couverts par ArtEos</title>
	<meta description="Les photographies d'ArtEos prises lors de concerts.">
</head>

<?php include('includes/header.php'); ?>
			
<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : Photos > <a href="festivals.php">Festivals</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>

    <section id="article">
    <hr />
    
    <?php
        $id= $_GET['id_event'];
        $sql="SELECT * FROM evenement_groupe WHERE id_event_gp = $id";
        $liste = $pdo->query($sql);
        $data= $liste->fetch();
        
        echo "<h1>".$data['nom']." - ".$data['date_debut']." au ".$data['date_fin']."</h1>";
        echo "<p>".$data['txt']."</p>"; ?>

        <!--BOUTON J'AIME DE FACEBOOK-->        
            <div id="like">
                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.arteos.fr&amp;width&amp;layout=button&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=656793964435391" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:120px" allowTransparency="true"></iframe>               <a href="https://twitter.com/share" class="twitter-share-button" data-via="arteos">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div> 
        <!--FIN DU BOUTON J'AIME-->

        <?php echo "<hr />"; ?>

        

            <?php $sql2="SELECT f_link FROM file_upload WHERE _id_event_gp=".$data['id_event_gp'];
            $test = $pdo->query($sql2);
            $img = $test->fetch();
            
            echo "<p id='festivalimg'><img src='".$img["f_link"]."' alt='image du festival'/></p>";
            ?>

        </section>

    <section id="article">
       <h1>Liste des billets liés à cet évenement :</h1>
        <?php
            $sql="SELECT * FROM evenement_individuel WHERE _id_event_gp = $id";
            $liste = $pdo->query($sql);
            while ($data= $liste->fetch()) {
                echo"<article>";
                $sql2="SELECT f_link FROM file_upload WHERE couverture = 1 AND _id_event_ind=".$data['id_event'];
                $test = $pdo->query($sql2);
                $img = $test->fetch();
                $txt = $data['txt'];
                $nbChar = 200;
                if(strlen($txt) >= $nbChar)
                $txt = substr($txt, 0, $nbChar);
                $txt = explode("</p>", $txt);
                $txt =$txt["0"]." ...<br><br>";
                echo'<figure class="imagephoto">
                        <img src="'.$img['f_link'].'" alt="'.$data['_id_type_indiv'].'" width="640" height="426">';
                    echo'<figcaption>';
                        echo '<p>'.$txt;
                        echo'<a href="billet.php?id_event='.$data['id_event'].'">Lire la suite...</a></p>';
                    echo"</figcaption>
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

<?php include('includes/footer.php'); ?>


