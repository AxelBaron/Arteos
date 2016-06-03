<?php  
include"connectionbdd.php";
	$id_billet = $_GET["hu"];

	$sql="DELETE FROM evenement_individuel WHERE id_event = $id_billet"; 
	$liste = $pdo->query($sql); 

	
?>