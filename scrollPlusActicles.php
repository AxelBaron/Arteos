<?php
    include('admin/connectionbdd.php');
    if($_GET['lastid']){
        $lastid = $_GET['lastid'];
        $sql="SELECT * FROM evenement_individuel WHERE _id_type_indiv = 4 AND id_event < ".$lastid." ORDER BY id_event DESC LIMIT 12";
        
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
    }
    
?>