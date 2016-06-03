<?php
	$token = '';
	if(isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
		include_once "connectionbdd.php";
		$token = $_COOKIE['token']; # Récupération des Cookies & Ou Sessions
		$login_q = $pdo->prepare("SELECT * FROM admin WHERE jeton = :token");
		$login_q->execute(array(
			'token' => $token
		));

		$user = $login_q->fetch(PDO::FETCH_OBJ);

		if(!$user){
			header('Location: index.php'); # Redirection
			exit();
		}else{
			include("menu-admin.php");
		}
	} else {
		header('Location: index.php'); # Redirection
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style_admin.css">
	<title>ArtEos - Administration</title>
	<link rel="shortcut icon" href="../images/favicon.ico">
	<link href="../dropzone/css/dropzone.css" type="text/css" rel="stylesheet" />
	<script src="js/checkbox.js"></script>
	<script src="js/allCheckbox.js"></script>
	<script src="js/script.js"></script>
	<script src="js/classie.js"></script>
	<script src="../dropzone/dropzone.js"></script>
	<script src="../dropzone/dropzone.js"></script>
	<script src="js/rafreshcouv.js"></script>
	<script src="js/modif_couv.js"></script>
	<!-- include libraries(jQuery, bootstrap, fontawesome) -->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

	<!-- include summernote css/js-->
	<link href="../summernote/summernote.css" rel="stylesheet">
	<script src="../summernote/summernote.min.js"></script>
	<script>
         $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);//You can append as many data as you want. Check mozilla docs for this
            $.ajax({
                data: data,
                type: "POST",
                url: '../summernote/savetheuploadedfile.php',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                }
            });
        }
    });
</script>

</head>
<body>
<div class="right">
<section>
