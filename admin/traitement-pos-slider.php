<?php include("header-admin.php");?>
<h1>Traitement des ordres d'apparitions des images du slider</h1>
<?php 
	
	//Calcule le nombre de menu
	$sql="SELECT * FROM file_upload WHERE slider=1";
	$req = $pdo->query($sql);
	$nb_img=0;
	while($data = $req->fetch()){
		$nb_img ++;
	}
	
	//Création des variables
	 for ($i=1; $i < $nb_img+1 ; $i++) { 
		$varContainer = "position".$i."EtIDmenu";
		$$varContainer = explode("_",$_POST["position$i"]);
	 }
	 
	 $deuxIdentique = false;
	 
	 for ($i=1; $i < $nb_img+1 ; $i++) { 
		for ($y=$i+1; $y < $nb_img+1 ; $y++) { 
			//Vérifie Si le Varcontainer n'est pas identique
			//ex: "$position1EtIDmenu" != "$position2EtIDmenu"
			$varContainer1 = "position".$i."EtIDmenu";
			$varContainer2 = "position".$y."EtIDmenu";
			
			if($varContainer1 != $varContainer2){
				//Retire les variables pour les emmagasiner
				$varContainer1Position = array_shift($$varContainer1);
				$varContainer2Position = array_shift($$varContainer2);
				//Remet les variables dans le tableau (OBLIGÉ?)
				array_unshift($$varContainer1, $varContainer1Position);
				array_unshift($$varContainer2, $varContainer2Position);
				
				//Vérifie si les positions sont identiques
				//ex:$position1EtIDmenu[0] == $position2EtIDmenu[0]
				if($varContainer1Position == $varContainer2Position){
				
					/*echo("<div>$$varContainer1 == $$varContainer2</div>");
					echo("<div>$varContainer1Position == $varContainer2Position</div>");
					echo("<div>Deux identique</div>");*/
					$deuxIdentique = true;
				}
			}
		}
	}
	
	if($deuxIdentique == false){
		for ($i=1; $i < $nb_img+1; $i++) { 
			$varContainer = "position".$i."EtIDmenu";
			$position = array_shift($$varContainer);
			$id = array_shift($$varContainer);
			$sql ="UPDATE file_upload SET sliderplace = $position WHERE fid = $id";
			$pdo->exec($sql);
			//echo "<div>".$sql."</div>";
		}
		echo"<p> La position d'apparition des slider à bien été modifié</p>";
		echo "<a href='gestion-slider.php'><button>Retour</button></a>";
	}else{
		echo" / ! \  Vous avez des ordres d'apparitions identiques pour plusieurs images !<br/>L'ordre d'apparition n'a pas été modifié, veuillez cliquer sur le bouton ci-dessous pour ressayer<br/><br/>";
		
		echo("<a href='form-modif-pos-slider.php'><button>Retour</button></a>");
	}
?>
<?php include("footer-admin.php"); ?>
