<?php 
	include"connectionbdd.php";
	$slider = $_GET["huSlider"];
	$slider2 = $_GET["huSlider2"];
	$slider3 = $_GET["huSlider3"];
	$slider4 = $_GET["huSlider4"];
	$slider5 = $_GET["huSlider5"];

	if ($slider) {
		echo '<p><select name="choix_slider">';
		echo  '<option></option>';
		$sql="SELECT * FROM file_upload WHERE slider = 1"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
		}
		echo "</select></p>";
		$sql ="UPDATE file_upload SET sliderplace = $slider WHERE fid = $data['fid']";
		$pdo->exec($sql); 
	}
	elseif ($slider2) {
		echo '<p><select name="choix_slider">';
		echo  '<option></option>';
		$sql="SELECT * FROM file_upload WHERE slider = 1"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
		}
		echo "</select></p>"; 
		$sql ="UPDATE file_upload SET sliderplace = $slider2 WHERE fid = $data['fid']";
		$pdo->exec($sql);
	}
	elseif ($slider3) {
		echo '<p><select name="choix_slider">';
		echo  '<option></option>';
		$sql="SELECT * FROM file_upload WHERE slider = 1"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
		}
		echo "</select></p>";
		$sql ="UPDATE file_upload SET sliderplace = $slider3 WHERE fid = $data['fid']";
		$pdo->exec($sql); 
	}
	elseif ($slider4) {
		echo '<p><select name="choix_slider">';
		echo  '<option></option>';
		$sql="SELECT * FROM file_upload WHERE slider = 1"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
		}
		echo "</select></p>"; 
		$sql ="UPDATE file_upload SET sliderplace = $slider4 WHERE fid = $data['fid']";
		$pdo->exec($sql);
	}
	elseif ($slider5) {
		echo '<p><select name="choix_slider">';
		echo  '<option></option>';
		$sql="SELECT * FROM file_upload WHERE slider = 1"; 
		$liste = $pdo->query($sql);
		while ($data= $liste->fetch()) {
			echo "<option value=\"".$data['fid']."\">".$data['f_name']."</option>";
		}
		echo "</select></p>"; 
		$sql ="UPDATE file_upload SET sliderplace = $slider5 WHERE fid = $data['fid']";
		$pdo->exec($sql);
	}

 ?>
