<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title></title>
	<meta description="Les photographies d'ArtEos prises lors de concerts.">
</head>

<?php include('includes/header.php'); ?>			
<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : <a href="resultat.php">Recherche</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>
	<section>

	<?php 
if($_GET != null && $_GET['recherche']){
	
	$recherche = filter_var($_GET["recherche"],FILTER_SANITIZE_STRING);
	
	//Recherche événements individuel
	$liste = "";
	$sql="SELECT id_event,_id_type_indiv,nom,ville,salle,date FROM evenement_individuel WHERE nom LIKE '%$recherche%' OR ville LIKE '%$recherche%' OR salle LIKE '%$recherche%' OR date LIKE '%$recherche%'";
    
    $sql2="SELECT id_event_gp,nom,txt,_id_type_gp,date_debut,date_fin FROM evenement_groupe WHERE nom LIKE '%$recherche%' OR date_debut LIKE '%$recherche%' OR date_fin LIKE '%$recherche%' OR txt LIKE '%$recherche%'";
    
	$liste = $pdo->query($sql);
    $liste2 = $pdo->query($sql2);
    
	if($liste->fetch()){
		$liste = $pdo->query($sql);
        echo("<center><p>Resultat de votre recherche : $recherche</p></center>");
		while ($data= $liste->fetch()) {	
			echo"<article>";
			$sql2="SELECT f_link FROM file_upload WHERE couverture = 1 AND _id_event_ind=".$data['id_event'];
			$test = $pdo->query($sql2);
                        while ($img = $test->fetch()) {
        			echo'<figure class="imagephoto">
        					<img src="'.$img['f_link'].'" alt="'.$data['_id_type_indiv'].'" width="640px" height="426px">';
        				echo'<a href="billet.php?id_event='.$data['id_event'].'"><figcaption>';
        					echo"<p><span id='textelien'>Maxim Nucci, alias Yodelice, c'était LA star de la soirée. Celui que toutes<br/ ></span>"; 
        					echo'<a href="billet.php?id_event='.$data['id_event'].'">Lire la suite...</a></p>';
        				echo"</figcaption></a>
        			</figure>";
                        }
			$mystring = $data['nom'];
			$taille = strlen ($mystring);
			$pos = strpos($mystring, '@');
			$avant = substr($mystring, 0, $pos);
			$apres = substr($mystring, $pos+1, $taille);
			echo"<a href='billet.php?id_event=".$data['id_event']."'><h2>".$avant."</h2>
			<h3>".$apres."</h3></a>	
			</article>";
		}
	}elseif($liste2->fetch()){
            $liste2 = $pdo->query($sql2);
            echo("<center><p>Resultat de votre recherche : $recherche</p></center>");
            while ($data= $liste2->fetch()) {	
                echo"<article>";
                $sql2="SELECT f_link FROM file_upload WHERE _id_event_gp=".$data['id_event_gp'];
                $test = $pdo->query($sql2);
                $img = $test->fetch();
                $txt = $data['txt'];
                $nbChar = 200;
                if(strlen($txt) >= $nbChar)
                $txt = substr($txt, 0, $nbChar);
                $txt = explode("</p>", $txt);
                $txt =$txt["0"]." ...<br><br>";
                echo'<figure class="imagephoto">
                        <img src="'.$img['f_link'].'" alt="'.$data['_id_type_gp'].'" width="640" height="426">';
                    echo'<figcaption>';
                        echo $txt;
                        echo'<a href="billet.php?id_event='.$data['id_event_gp'].'">Lire la suite...</a></p>';
                    echo"</figcaption>
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
    }else{
        echo "<center><p> Désolé, aucun résultat ne correspond à votre recherche : ".$recherche.".<br/><a href='index.php'>Retour</a></center>";
    }

}else{
    echo "<center><p>Rien n'a été indiqué dans le champ de recherche<br/><a href='index.php'>Retour</a></p></center>";
}
?>	
	</section>

	<div class="clear"></div>

<?php include('includes/footer.php'); ?>