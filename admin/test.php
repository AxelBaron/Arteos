 <?php 
	include("header-admin.php");
 	$sql="SELECT f_link, f_name FROM file_upload WHERE fid =313";
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
			$sql2 = "DELETE FROM file_upload WHERE fid =313";
			$resultat = $pdo->query($sql2);


	function effacefichier( $dir )
{
  unlink($dir);
 
}

  ?>