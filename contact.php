<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Contactez l'équipe d'ArtEos</title>
	<meta description="Contactez l'équipe ArtEos pour toutes vos questions.">
	<link rel="stylesheet" href="css/screen.css">

		<script>
		$.validator.setDefaults({
			submitHandler: function() {
				var xmlhttp;
			    var nomprenom = encodeURIComponent(document.getElementById("nomprenom").value);
			    var mail = encodeURIComponent(document.getElementById("mail").value);
			    var sujet = encodeURIComponent(document.getElementById("sujet").value);
			    var messagecontact = encodeURIComponent(document.getElementById("messagecontact").value);

			    if (window.XMLHttpRequest) {
			        // code for IE7+, Firefox, Chrome, Opera, Safari
			        xmlhttp = new XMLHttpRequest();
			    } else {
			        // code for IE6, IE5
			        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			    }

			    xmlhttp.onreadystatechange = function() {
			        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			            document.getElementById("reception").innerHTML = xmlhttp.responseText;
			            //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
			        }
			    }
			    xmlhttp.open("POST", "traitementformcontact.php", true);
			    // si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
			    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    xmlhttp.send("nomprenom=" + nomprenom + "&mail=" + mail + "&sujet=" + sujet + "&messagecontact=" + messagecontact);

			    alert('Votre mail a bien été envoyé!');

			    document.getElementById("nomprenom").value = '';
			    document.getElementById("mail").value = '';
			    document.getElementById("sujet").value = '';
			    document.getElementById("messagecontact").value = '';
			}
		});

		$().ready(function() {
			// validate the comment form when it is submitted
			$("#commentForm").validate();
		});

		</script>

</head>

<?php include('includes/header.php'); ?>
			
<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : <a href="contact.php">Contact</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>

	<h1 class="titre">Contact</h1>

	<section id="articletextecontact">
		<div id="gauche">
			<img src="images/logo.png" alt="logoArtEos" width="100%" height="auto">
			<p><span>Mail : </span>collectif.arteos@gmail.com</p>
			<p><span>Téléphone : </span>06.01.96.95.03</p>
		</div>

		<div id="droit">
			
			<form method="post" id="commentForm" method="get" action="">
				<fieldset>
					<legend><h2>Nous contacter :</h2></legend>
						<div id="nomprenomnom">
							<input name="nomprenom" id="nomprenom" type="text" placeholder="Votre nom et prénom..." required minlength="2">
						</div>
						<div id="mailmail">
							<input name="mail" id="mail" type="email" placeholder="Votre adresse Email..." required>
						</div>
						<div class="clear"></div>
						<input class="objet" type="text" name="sujet" id="sujet" placeholder="Sujet de votre message" required="required">
						<textarea name="messagecontact" id="messagecontact" placeholder="Votre message..." required="required"></textarea>
						<!-- <div onClick="divlapin()" style="margin-left:10px; width:90%; height:30px; line-height:30px; text-align:center; background-color:#ff7000; color:black; margin-top:20px; cursor:pointer;">Envoyer</div> -->
						<input class="submit" type="submit" value="Submit">
				</fieldset>
			</form>

			<div id="reception"></div>
		</div>		
	</section>
	
	<div class="clear"></div>

<?php include('includes/footer.php'); ?>


