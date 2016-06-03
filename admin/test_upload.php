<?php

	function uploadImage($files){
		$target_dir = "/home/tim/public_html/prod/2014/efc/eq3/admin/upload/";
	$target_file = $target_dir . basename($files["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($files["tmp_name"]);
	    if($check !== false) {
	        echo "Le fichier image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "Le fichier n'est pas une image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Désolé, le fichier existe déjà.\n";
	    $uploadOk = 0;
	}
	// Check file size
	if ($files["size"] > 5000000) {
	    echo "Désolé, votre fichier est trop volumineux.\n";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Désolé, seulement les fichiers JPG, JPEG, PNG & GIF sont autorisés.\n";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Désolé, votre fichier n'a pas été téléchargé.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($files["tmp_name"], $target_file)) {
	        echo "Le fichier". basename( $files["name"]). " a été téléchargé.\n";
	    } else {
	        echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.\n";
	    }
	}
}
	
?>
