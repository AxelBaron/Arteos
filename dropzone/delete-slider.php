<?php 
include 'connectionbdd.php';
$delete_slider = $_POST['delete_slider'];
$sql="SELECT * FROM file_upload WHERE fid = $delete_slider"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
		$nom = $data['fname'];
		$fichier = 'dropzone/slider/'.$nom.'';
		echo $fichier;
	   	if( file_exists ( $fichier))
	    	unlink( $fichier ) ;
		}
$sql="DELETE FROM file_upload WHERE fid=$delete_slider";
$liste = $pdo->query($sql);
$data= $liste->fetch();

  /* Fichier à supprimer */
   
?>