<?php
	$fonction = $_POST['fonction'];
	
	//Regarde quel fonction est appelé par l'AJAX
	switch($fonction){

		case "suppression":
			$idPost = $_POST['id'];
			$categoriePost = $_POST['categorie'];
			suppression($idPost, $categoriePost);
		break;
		
		case "listAffichage":
			$categoriePost = $_POST['categorie'];
			listAffichage($categoriePost);
		break;
		
		case "listGestion":
			$categoriePost = $_POST['categorie'];
			listGestion($categoriePost);
		break;
		
		case "writeHeader":
			writeHeader();
		break;
	}
			
	function suppression($idPost, $categorie) {
		include "connectionbdd.php";
		
		switch($categorie){

			case "artiste":
				$id = "id_artiste=";
			break;

			case "photographe":
				$id = "id_photographe=";
			break;

			case "evenement_individuel":
				$id = "id_event=";
			break;

			case "evenement_groupe":
				$id = "id_event_gp=";
			break;

			case "file_upload";
				$id = "fid=";
			break;
		}

		if ($categorie == "evenement_individuel") {
			
			$id .= $idPost;
			//suprimer les fichier  img de la bdd
			$sql2 = "DELETE FROM file_upload WHERE _id_event_ind = $idPost";
			$data = $pdo->query($sql2);

			// $id .= $idPost;

			$sql2 = "SELECT nom FROM evenement_individuel WHERE id_event = $idPost";
			$data = $pdo->query($sql2);
			$liste = $data->fetch();
			$chaine = $liste['nom'];
			
			if ($chaine != null) {
				setlocale(LC_ALL, 'fr_FR');
				$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
				$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
				while(strpos($chaine, '__') !== false)
				{
				  $chaine = str_replace('__', '_', $chaine);
				}
				$chaine = trim($chaine, '_');
				echo $chaine."<br>";
				$dossier = '../dropzone/myuploads/'.$chaine;
				$dir = ''.$dossier.''; 
				advRmDir($dir);
			}

			$sql2 = "DELETE FROM evenement_individuel WHERE id_event = $idPost";
			$data = $pdo->query($sql2);
			
		
		}elseif ($categorie == "file_upload") {
			$id .= $idPost;
			$sql="SELECT f_link, f_name FROM file_upload WHERE fid =$idPost";
			$resultat = $pdo->query($sql);
			$data = $resultat -> fetch();
			
			$lien=$data['f_link'];
			$nom=$data['f_name'];
			$explose= explode("/", $lien);
			$chaine = $explose[2];
			
			// On translate le titre pour coller avec le nomage dossier
			
			setlocale(LC_ALL, 'fr_FR');
			$chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);
			$chaine = preg_replace('#[^0-9a-z]+#i', '_', $chaine);
			while(strpos($chaine, '__') !== false){
				$chaine = str_replace('__', '_', $chaine);
			}
			$chaine = trim($chaine, '_');
			echo $chaine."<br>";
			$dossier = '../dropzone/myuploads/'.$chaine."/".$nom;
			$dir = ''.$dossier.''; 
			echo $dir;
			effacefichier($dir);

				
			// On supprime de la BDD
			$sql2 = "DELETE FROM file_upload WHERE fid =$idPost";
			$resultat = $pdo->query($sql2);
		}else{

		$id .= $idPost;
		$sql = "DELETE FROM $categorie WHERE $id";
		$resultat = $pdo->query($sql);
		}

	}
	
	//Fonction de MAJ de la liste
	function listAffichage($categorie) {
		include "connectionbdd.php";
		$pasElements = true;
		$nbEntre = 0;
		$sql = "SELECT * FROM $categorie";
		 $resultat = $pdo->query($sql);
		 while($donnees = $resultat->fetch()){
		 	$nbEntre++;
		 }

		$sql = "SELECT * FROM $categorie";
		$resultat = $pdo->query($sql);
		
		while($donnees = $resultat->fetch()){
			$pasElements = false;
			switch($categorie){
				case "photographe":
					$id = "id_photographe";
					$entre = $donnees["nom"]." ".$donnees["prenom"];
				break;
				
				case "artiste":
					$id = "id_artiste";
					$entre = $donnees["nom"];
				break;

				case "evenement_individuel":
					$id = "id_event";
					$entre = $donnees["nom"];
				break;

				case "evenement_groupe":
					$id = "id_event_gp";
					$entre = $donnees["nom"];
				break;

				case "file_upload";
					$id = "fid";
					$entre = $donnees["f_name"];
				break;
			}
			
			echo("<div class='list_gestion'>");
			echo("<input type='checkbox' id='$nbEntre' name='".$donnees[$id]."' />");
			echo($entre);
			
			if ($categorie == "evenement_individuel") {
				echo("<a class='btn_modif' href='form-modifier-".$categorie.".php?".$id."=".$donnees[$id]."&_id_type_gp=".$donnees['_id_type_gp']."&_id_event_gp=".$donnees['_id_event_gp']."'>Modifier les infos</a>");
				echo "<a class='btn_modif_photo' href='form-modifier-photo-".$categorie.".php?".$id."=".$donnees[$id]."'>Modifier les photos</a>";
			}else{
				echo("<a class='btn_modif' href='form-modifier-".$categorie.".php?".$id."=".$donnees[$id]."'>Modifier</a>");
				echo "test";
			}
			echo("</div>");
		}

		//Si il n'y a aucun entrées

		if($pasElements == true){
			echo("Vous n'avez aucun éléments dans cette page.");
		}
		
		
	}
	
	function listGestion($categorie) {
		include "connectionbdd.php";
		$pasElements = true;
		$nbEntre = 0;
		//Boucle pour calculer le nombre pour la case tout cocher
		$sql = "SELECT * FROM $categorie";
		$resultat = $pdo->query($sql);
		
		
		while($donnees = $resultat->fetch()){
			$nbEntre++;
			$pasElements = false;

			
			switch($categorie){
				case "photographe":
					$newCategorie = '"photographe"';
                    $page = "gestion-photographe.php";
				break;
				
				case "artiste":
					$newCategorie = '"artiste"';
                    $page = "gestion-artiste.php";
				break;
				
				case "evenement_individuel":
					$newCategorie = '"evenement_individuel"';
                    $page = "gestion-event-ind.php";
				break;

				case "evenement_groupe":
					$newCategorie = '"evenement_groupe"';
                    $page = "gestion-event-gp.php";
				break;

				case "file_upload";
					$newCategorie = '"file_upload"';
                    
				break;
			}
			
            
		}
        
        
        
		
		if($pasElements == true){
			switch($categorie){
				case "photographe":
					$newCategorie = '"photographe"';
                    $page = "gestion-photographe.php";
				break;
				
				case "artiste":
					$newCategorie = '"artiste"';
                    $page = "gestion-artiste.php";
				break;
				
				case "evenement_individuel":
					$newCategorie = '"evenement_individuel"';
                    $page = "gestion-event-ind.php";
				break;

				case "evenement_groupe":
					$newCategorie = '"evenement_groupe"';
                    $page = "gestion-event-gp.php";
				break;

				case "file_upload";
					$newCategorie = '"file_upload"';
				break;
			}
			
		}
        
        echo("<input type='checkbox' id='checkbox-tout' onclick='javascript:checkAndUnCheckAll(".$nbEntre.")' />");
			echo("<label>Tout cocher/décocher</label>");
			echo("<a href='form-ajout-".$categorie.".php'><button>Ajouter</button></a>");
			echo("<a href ='#' onclick='javascript:suppression(".$nbEntre.",".$newCategorie.")'><button>Supprimer</button></a>");
			if ($categorie != "file_upload") {
			echo '<form class="formu" action="recherche-'.$categorie.'.php" method="POST">';
				echo '<input type="text" placeholder="Rechercher ..." name="recherche" class="input-recherche-page-gestion">';
				echo '<input type="submit" value="GO" class="btn-recherche">';
				echo '</form>';
			}
        //header('location:'.$page);
	}
		
	

	function advRmDir( $dir ){
 
	 // ajout du slash a la fin du chemin s'il n'y est pas
	 if( !preg_match( "/^.*\/$/", $dir ) ) $dir .= '/';
	 
	 // Ouverture du repertoire demande
	 $handle = @opendir( $dir );
	 
	 // si pas d'erreur d'ouverture du dossier on lance le scan
	 if( $handle != false )
	 {
	 
	  // Parcours du repertoire
	  while( $item = readdir($handle) )
	  {
	   if($item != "." && $item != "..")
	   {
	    if( is_dir( $dir.$item ) )
	     advRmDir( $dir.$item );
	    else unlink( $dir.$item );
	   }
	  }
	 
	  // Fermeture du repertoire
	  closedir($handle);
	 
	  // suppression du repertoire
	  $res = rmdir( $dir );
	 
	 }
	 else $res = false;
	 
	 return $res;
	 
	}


	function effacefichier( $dir ){
  		unlink($dir);
  	}
?>
