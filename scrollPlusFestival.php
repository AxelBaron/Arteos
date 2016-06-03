<?php
    include('admin/connectionbdd.php');
    if($_GET['lastid']){
        $lastid = $_GET['lastid'];
        $sql="SELECT * FROM evenement_groupe WHERE id_event_gp < ".$lastid." ORDER BY id_event_gp DESC LIMIT 12";
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
        					echo "<p>".$txt;
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
    }
    
?>