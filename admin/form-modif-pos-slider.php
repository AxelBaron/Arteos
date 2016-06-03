<?php
	include("header-admin.php");
?>
<h1>Gerer l'ordre d'apparition des images du slider :</h1>
<p>Selectionner l'ordre d'apparition des images du slider  grâce aux listes déroulantes :</p>
<?php 

	$sql="SELECT * FROM file_upload WHERE slider=1";
	$req = $pdo->query($sql);
	$position =0;
	$test =0;
	$nb_img =0;
	while($data = $req->fetch()){
		$nb_img ++;
	}

	echo "<form action='traitement-pos-slider.php' method='POST'>";

	$sql="SELECT * FROM file_upload WHERE slider=1";
	$liste=$pdo->query($sql);
	while ($data=$liste->fetch()) {
	$position ++;
		echo $data['f_name']."&#8239; &#8239; &#8239; &#8239;";
		echo "<select class='position' name='position".$position."'>";					
					
					if ($data['sliderplace'] != 0) {
							echo "<option selected value='".$data['sliderplace']."_".$data['fid']."'>".$data['sliderplace']."</option>";
							$test = $data['sliderplace'];
					}else{
						echo "<option></option>";
					}
					

					for($i=1; $i < $nb_img+1; $i++) { 
						if ($test != $i) {
							echo "<option value='".$i."_".$data['fid']."'> $i </option>";
						}
						
					}

					echo "</select> </p> ";

		echo "<br /> <br />";
		echo " <img src='../".$data['f_link']."' alt='".$data['f_name']."' width='30%'/><br /> <br /> <br />";
	};

	echo "<input type='submit'>";
	echo "</form>";

	
?>



<?php
	include_once "footer-admin.php";
?>
