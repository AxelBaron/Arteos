<?php 

	include"connectionbdd.php";
	$id_billet = $_GET["hu"];

	if ($id_billet) {
		echo '<p><select name="choix_couv">';
		echo  '<option></option>';
		$sql="SELECT * FROM file_upload WHERE _id_event_ind = $id_billet"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
		}
		echo "</select></p>"; 
	}

 ?>
