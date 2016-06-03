<?php include('admin/connectionbdd.php'); ?>
<?php include('includes/head.php'); ?>
	<title>Rejoindre ArtEos</title>
	<meta description="Rejoignez l'équipe d'ArtEos, collectif de photographes!">
	<link rel="stylesheet" href="css/screen.css">

	<script type="text/javascript">
		function afficher(){
		    document.getElementById("modeleAPN").style.display = "block";
		}
	                                   
		function cacher(){
		    document.getElementById("modeleAPN").style.display = "none";
		}

	    function afficher2(){
	        document.getElementById("nomgrp").style.display = "block";
	    }

	    function cacher2(){
	        document.getElementById("nomgrp").style.display = "none";
	        document.getElementById("nomgroupe").value = "";

	    }
	</script>

	<script type="text/javascript">
		function affichermatphoto(){
		    if(document.forms['formulaireinscription'].elements['photographe'].checked == true){
		        document.getElementById("checkAPN").style.display = "block";
		    }
		    else{
		         document.getElementById("checkAPN").style.display = "none";
		         document.getElementById("APNmodele").value = "";
		         document.getElementById("objectifs").value = "";
		    }
		}

		function affichermatchroniqueur(){
		    if(document.forms['formulaireinscription'].elements['chroniqueur'].checked == true || document.forms['formulaireinscription'].elements['chroniqueurcd'].checked == true) {
		          		
		        document.getElementById("micro").style.display = "block";

		    }
		    else{
		        document.getElementById("micro").style.display = "none";
		    }
		}


		function afficherexperience(){
		    if(document.forms['formulaireinscription'].elements['checkexp'].checked == true || document.forms['formulaireinscription'].elements['checkexp2'].checked == true || document.forms['formulaireinscription'].elements['checkexp3'].checked == true ) {
		          		
		        document.getElementById("experience").style.display = "block";

		    }
		    else{
		        document.getElementById("experience").style.display = "none";
		        document.getElementById("experience").value = "";
		    }
		}

		document.getElementById('monElementFormulaire').onsubmit = function(){
			if( this.getElementById('nomPersonne').value == '' ) {
				alert('Attention ! Le nom est obligatoire !');
			return false;
			}
		}
		
	</script>
		<script>
	$.validator.setDefaults({
		submitHandler: function() {

			var xmlhttp;
		    var nom = encodeURIComponent(document.getElementById("nom").value);

		    var prenom = encodeURIComponent(document.getElementById("prenom").value);

		    var datenaissance = encodeURIComponent(document.getElementById("datenaissance").value);
		    var ville = encodeURIComponent(document.getElementById("ville").value);
		    var tel = encodeURIComponent(document.getElementById("tel").value);
		    var email = encodeURIComponent(document.getElementById("email").value);
		    var site = encodeURIComponent(document.getElementById("site").value);
		    var musique = encodeURIComponent(document.getElementById("musique").value);

		    var chekgrpdemusique = document.getElementById('checkgrp').checked;
		    var chekgrpdemusique2 = document.getElementById('checkgrp2').checked;

		    var nomgrpdemusique = encodeURIComponent(document.getElementById("nomgroupe").value);
		    var motivations = encodeURIComponent(document.getElementById("motivations").value);

		    var photographe = encodeURIComponent(document.getElementById("checkposte1").checked);

		    var chroniqueurconcerts = encodeURIComponent(document.getElementById("checkposte2").checked);

		    var chroniqueurcd = encodeURIComponent(document.getElementById("checkposte3").checked);

		    var checkapn = document.getElementById("checkapn").checked;
		    var checkapn2 = document.getElementById("checkapn2").checked;

		    var apnmodele = encodeURIComponent(document.getElementById("APNmodele").value);
		    var objectifs = encodeURIComponent(document.getElementById("objectifs").value);

		    var trepied = document.getElementById("trepied").checked;
		    var trepied2 = document.getElementById("trepied2").checked;

		    var micros = document.getElementById("micros").checked;
		    var micros2 = document.getElementById("micros2").checked;

		    var xpchronique = document.getElementById("xpchronique").checked;
		    var xpinterview = document.getElementById("xpinterview").checked;
		    var xpmedia = document.getElementById("xpmedia").checked;
		    var preciseexp = encodeURIComponent(document.getElementById("preciseexp").value);

		    var permisvoiture = document.getElementById("permisvoiture").checked;
		    var permisvoiture2 = document.getElementById("permisvoiture2").checked;

		    var locomotion = document.getElementById("locomotion").checked;
		    var locomotion2 = document.getElementById("locomotion2").checked;

		    var secteur = encodeURIComponent(document.getElementById("secteur").value);
		    var disponibilité = encodeURIComponent(document.getElementById("message").value);


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
		    xmlhttp.open("POST", "traitementformnousjoindre.php", true);
		    // si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
		    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    xmlhttp.send("nom=" + nom + "&prenom=" + prenom + "&datenaissance=" + datenaissance + "&ville=" + ville + "&tel=" + tel + "&email=" + email + "&site=" + site + "&musique=" + musique + "&checkgrp=" + chekgrpdemusique + "&checkgrp2=" + chekgrpdemusique2 + "&nomgroupe=" + nomgrpdemusique + "&motivations=" + motivations + "&checkposte1=" + photographe + "&checkposte2=" + chroniqueurconcerts + "&checkposte3=" + chroniqueurcd + "&checkapn=" + checkapn + "&checkapn2=" + checkapn2 + "&APNmodele=" + apnmodele + "&objectifs=" + objectifs + "&trepied=" + trepied + "&trepied2=" + trepied2 + "&micros=" + micros + "&micros2=" + micros2 + "&xpchronique=" + xpchronique + "&xpinterview=" + xpinterview + "&xpmedia=" + xpmedia + "&preciseexp=" + preciseexp + "&permisvoiture=" + permisvoiture + "&permisvoiture2=" + permisvoiture2 + "&locomotion=" + locomotion + "&locomotion2=" + locomotion2 + "&secteur=" + secteur + "&message=" + disponibilité);

		    alert('Votre mail a bien été envoyé!');

		    document.getElementById("nom").value = '';
		    document.getElementById("prenom").value = '';
		    document.getElementById("datenaissance").value = '';
		    document.getElementById("ville").value = '';
		    document.getElementById("tel").value = '';
		    document.getElementById("email").value = '';
		    document.getElementById("site").value = '';
		    document.getElementById("musique").value = '';

		    document.getElementById("checkgrp").checked = false;
		    document.getElementById("checkgrp2").checked = false;


		    document.getElementById("nomgrp").style.display = 'none';
		    document.getElementById("nomgroupe").value = '';

		    document.getElementById("motivations").value = '';

		    document.getElementById("checkposte1").checked = false;
		    document.getElementById("checkposte2").checked = false;
		    document.getElementById("checkposte3").checked = false;

		    document.getElementById("checkapn").checked = false;
		    document.getElementById("checkapn2").checked = false;

		    document.getElementById("APNmodele").value = '';
		    document.getElementById("objectifs").value = '';


		    document.getElementById("checkAPN").style.display = 'none';

		    document.getElementById("trepied").checked = false;
		    document.getElementById("trepied2").checked = false;

		    document.getElementById("micro").style.display = 'none';

		    document.getElementById("micros").checked = false;
		    document.getElementById("micros2").checked = false;

		    document.getElementById("xpchronique").checked = false;
		    document.getElementById("xpinterview").checked = false;
		    document.getElementById("xpmedia").checked = false;

		    document.getElementById("experience").style.display = 'none';
		    document.getElementById("preciseexp").value = '';

		    document.getElementById("permisvoiture").checked = false;
		    document.getElementById("permisvoiture2").checked = false;

		    document.getElementById("locomotion").checked = false;
		    document.getElementById("locomotion2").checked = false;

		    document.getElementById("secteur").value = '';
		    document.getElementById("message").value = '';
		}
	});

	$().ready(function() {
		// validate the comment form when it is submitted
		$("#commentForm").validate();

		// validate signup form on keyup and submit
		$("#formulaireinscription").validate({
			rules: {
				nom: "required",
				prenom: "required",
								
				email: {
					required: true,
					email: true
				},
				
			},
			messages: {
				nom: "Merci d'entrer votre nom",
				prenom: "Merci d'entrer votre prénom",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
			
				email: "Merci d'entrer une adresse mail valide",
				agree: "Please accept our policy"
			}
		});
		
	});
	</script>

</head>

<?php include('includes/header.php'); ?>
			
<?php include('includes/slider.php'); ?>

<div id="ariane">
	<p>Vous êtes ici : <a href="nousrejoindre.php">Nous rejoindre</a></p>
</div>
<?php include('includes/reseauxsociaux.php'); ?>
<?php include('includes/champrecherche.php'); ?>

	<div class="clear"></div>

	<section id="nousjoindre">
		
		<div id="articletexte">
			<h1>Nous rejoindre</h1>
			<h2>Vous souhaitez intégrer l'équipe ArtEos ?</h2>

			<p>
			
				Nous recherchons sur la France entière :
				<ul>
					<li> Des photographes </li>
					<li> Des chroniqueurs concerts</li>
					<li> Des chroniqueurs cd </li>
				</ul>
			</p>
			<p>

				Les photographes ne s'occupent pratiquement de rien. Ils ont juste à shooter le jour de l’événement.
				C'est le collectif qui se charge des demandes de pass, d’accréditations photos et de la mise en ligne sur le site.
				Nous demandons en contrepartie que les photographes soient équipés en Reflex de bonne qualité et d'objectifs à grande ouverture, adéquat pour les obscures salle de concert...

			</p>
			<p>

				Les photographes doivent aussi avoir une excellente maîtrise de leur matériel. Avoir de l'expérience en photos de concerts serait évidemment un plus.
			</p>
			<p>
				Les photos faites dans le cadre du webzine restant la propriété de leurs auteurs, ceux-ci se réservent le droit de mettre en ligne leurs photos sur leur(s) site(s) web personnel(s). Nous ne pourrons évidement accepter de les retrouver sur un autre site d'information.
			</p>

			<p>
				Les chroniqueurs peuvent être amenés à faire des interviews d’artiste lors des concerts.
			</p>
			<p>
				Nous demandons que les chroniqueurs aient un niveau de français plus que correct et un style rédactionnel propre, ainsi que de bonnes connaissances musicales dans les styles qui les intéressent.
				Nous acceptons les débutants à partir du moment où ils sont capables de rédiger une bonne chronique.
			</p>

			<p>
				Petite précision, nous sommes, bien entendu, tous bénévoles, au sein du collectif.
				Nous travaillons pour le plaisir de découvrir de nouveaux groupes, en studio ou en live. Le collectif a pour but aussi s'entraider et partager notre vécu de la prise de vue.
				Nous avons la passion de la musique, nous sommes sérieux, motivés et nous voulons promouvoir la scène locale...
			</p>


			<p>
				Merci de compléter le formulaire ci-dessous, puis, envoyez à notre adresse mail collectif.arteos@gmail.com plusieurs images pour les photographes ou un article cd pour les chroniqueurs.

			</p>

			<p>

				Les photographes ne s'occupent pratiquement de rien. Ils ont juste à shooter le jour de l’événement.
				C'est le collectif qui se charge des demandes de pass, d’accréditations photos et de la mise en ligne sur le site.
				Nous demandons en contrepartie que les photographes soient équipés en Reflex de bonne qualité et d'objectifs à grande ouverture, adéquat pour les obscures salle de concert...

			</p>
			<p>

				Les photographes doivent aussi avoir une excellente maîtrise de leur matériel. Avoir de l'expérience en photos de concerts serait évidemment un plus.
			</p>
			<p>
				Les photos faites dans le cadre du webzine restant la propriété de leurs auteurs, ceux-ci se réservent le droit de mettre en ligne leurs photos sur leur(s) site(s) web personnel(s). Nous ne pourrons évidement accepter de les retrouver sur un autre site d'information.
			</p>

			<p>
				Les chroniqueurs peuvent être amenés à faire des interviews d’artiste lors des concerts.
			</p>
			<p>
				Nous demandons que les chroniqueurs aient un niveau de français plus que correct et un style rédactionnel propre, ainsi que de bonnes connaissances musicales dans les styles qui les intéressent.
				Nous acceptons les débutants à partir du moment où ils sont capables de rédiger une bonne chronique.
			</p>

			<p>
				Petite précision, nous sommes, bien entendu, tous bénévoles, au sein du collectif.
				Nous travaillons pour le plaisir de découvrir de nouveaux groupes, en studio ou en live. Le collectif a pour but aussi s'entraider et partager notre vécu de la prise de vue.
				Nous avons la passion de la musique, nous sommes sérieux, motivés et nous voulons promouvoir la scène locale...
			</p>


			<p>
				Merci de compléter le formulaire ci-dessous, puis, envoyez à notre adresse mail collectif.arteos@gmail.com plusieurs images pour les photographes ou un article cd pour les chroniqueurs.

			</p>
			
			<form name="formulaireinscription" id="formulaireinscription" method="get" action="" class="STYLE-NAME">
			    <h1>Formulaire d'inscription 
			        <span>Merci de compléter tous les champs.</span>
			    </h1>

			    <div id="partgauche">
			    <label>
			        <span>Nom :</span>
			        <input id="nom" type="text" name="nom" placeholder="Votre nom" required />
			    </label>

			    <label>
			        <span>Prénom :</span>
			        <input id="prenom" type="text" name="prenom" placeholder="Votre prénom" required />
			    </label>

			    <label>
			        <span>Date de naissance :</span>
			        <input type="date" name="date" placeholder="au format 19/02/1993" id="datenaissance" required="required" />
			    </label>

			    <label>
			        <span>Ville :</span>
			        <input id="ville" type="text" name="ville" placeholder="Ville où vous vivez" id="ville" required="required" />
			    </label>

			    <label>
			        <span>Téléphone (portable) :</span>
			        <input id="tel" type="tel" name="tel" placeholder="0102030405" id="tel" required />
			    </label>

			    <label>
			        <span>Email :</span>
			        <input id="email" type="email" name="email" placeholder="votre.adresse@mail.fr" id="email" required="required" />
			    </label>

			    <label>
			        <span>Site internet :</span>
			        <input id="site" type="url" name="site" placeholder="url de votre site" id="site" />
			    </label>

			    <label>
				    <span>Style(s) de musique que vous appréciez :</span>
				    <input type="text" id="musique" name="musique" placeholder="Le(s) style(s) de musique vous appréciez : hard-rock, pop, metal, etc..." required>
			   	</label>

			   	<label>
			        <span>Jouez-vous un groupe de musique :</span>

			        <label class="radio">
			        	<input type="radio" name="grp" id="checkgrp" onClick="afficher2()" required> Oui
			        </label>

			        <label class="radio">
			        	<input type="radio" name="grp" id="checkgrp2" onClick="cacher2()" required> Non
					</label>
				</label>

				<label id="nomgrp">
					<span>Quel est le nom de votre groupe :</span>
			        <input type="text" name="site" placeholder="Nom de votre groupe" id="nomgroupe" />
			    </label>

				
				    <label id="motivation">
						<span>Quelles sont vos motivations pour rejoindre ArtEos ?</span>
						<textarea id="motivations" name="motivation" placeholder="Expliquez-nous pourquoi vous souhaitez nous rejoindre, dans quel but..." required="required"></textarea>
					</label>

			   	</div>


			   	<div id="partdroite">
			   	<fieldset class="souscat">
			   		<legend>Poste</legend>
			   		<label>
			   			<span>Poste(s) pour le(s)quel(s) vous postulez :</span>
			   			<label>
			   				<input type="checkbox" name="photographe" value="Photographe" onClick="affichermatphoto()" id="checkposte1"> Photographe 
			   				<br />
			   			</label>
			   			<label>
							<input type="checkbox" name="chroniqueur" value="Chroniqueurconcerts" onClick="affichermatchroniqueur()" id="checkposte2" > Chroniqueur concerts 
							<br />
						</label>
						<label>
							<input type="checkbox" name="chroniqueurcd" value="ChroniqueurCDs" onClick="affichermatchroniqueur()" id="checkposte3"> Chroniqueur CDs 
							<br />
						</label>
			   		</label>

			   		<!-- PARTIE SUR LE MATÉRIEL PHOTO -->

			   		<label id="checkAPN" >
			   			<fieldset>
				   			<legend>Matériel photo :</legend>

				   			<span>Appareil photo numérique :</span>
			   			
			   				<label class="radio">
				   				<input type="radio" name="apn" id="checkapn" onClick="afficher()"> Oui
				   			</label>
				   			<label class="radio">

				   				<input type="radio" name="apn" id="checkapn2" onClick="cacher()"> Non
				   			</label>
			   			

				   			<label id="modeleAPN">
				   				<span>Modèle de votre appareil photo :</span>

				   				<input type="text" id="APNmodele" name="APNmodele" placeholder="Modèle de votre appareil">

				   				<span>Votre/vos objectif(s) :</span>

				   				<input type="text" id="objectifs" name="objectifs" placeholder="Vos/votre objectif(s), séparés par une virgule">
				   			</label>

			   				<span>Un trépied :</span>
			   			
			   				<label class="radio">
				   				<input type="radio" name="trepied" id="trepied"> Oui
				   			</label>

				   			<label class="radio">
				   				<input type="radio" name="trepied" id="trepied2"> Non
				   			</label>
				   		</fieldset>
				   	</label>
				   	
					<!-- PARTIE SUR LE MATÉRIEL AUDIO -->
				   	
			   		<label id="micro">
			   			<fieldset>
			   				<legend>Matériel audio</legend>
			   				<span>Un micro/dictaphone :</span>
			   			
			   				<label class="radio">
				   				<input type="radio" name="micro" id="micros"  > Oui
				   			</label>

				   			<label class="radio">
				   				<input type="radio" name="micro" id="micros2"  > Non
				   			</label>
				   		</fieldset>
				   	</label>
				</fieldset>
			   		
					<!-- FIN MATÉRIEL AUDIO -->
			   		
			   		<fieldset class="souscat">
				   		<legend>Expérience</legend>
						<label>

							<span>Avez-vous déjà :</span>
							<label>
								<input type="checkbox" name="checkexp" onClick="afficherexperience()" id="xpchronique"> Fait des chroniques
							</label>
							<label>
								<input type="checkbox" name="checkexp2" onClick="afficherexperience()" id="xpinterview"> Fait des interviews
							</label>
							<label>
								<input type="checkbox" name="checkexp3" onClick="afficherexperience()" id="xpmedia"> Eu une expérience dans un média <span class="description">(presse écrite, webzine, radio...)</span>
							</label>

						</label>

						<label id="experience">
							<br />
						    <span>Précisez vos/votre expérience(s) :</span>
						    <textarea id="preciseexp" name="experience" placeholder="Précisez votre expérience..."></textarea>
						</label>
					</fieldset>
			   			
						
					
					<fieldset class="souscat">
						<legend>Mobilité</legend>
				   		<label>
				   			<span>Possédez-vous le permis de conduire :</span>
				   			<label class="radio">
				   				<input type="radio" name="permis" id="permisvoiture" required> Oui 
				   			</label>
				   			<label class="radio">
								<input type="radio" name="permis" id="permisvoiture2" required > Non 
							</label>

				   		</label>

				   		<label>
				   			<span>Un moyen de locomotion :</span>
				   			<label class="radio">
				   				<input type="radio" name="locomotion" id="locomotion" required > Oui 
				   			</label>
				   			<label class="radio">
								<input type="radio" name="locomotion" id="locomotion2" required> Non 
							</label>

				   		</label>

				   		<label>
					        <span>Secteur(s) géographique(s) que vous souhaitez couvrir :</span>
					        <input type="text" id="secteur" name="secteur" placeholder="Reims, Troyes, Lyon..." required></textarea>
				   		</label>
					</fieldset>
					<fieldset class="souscat">
						<legend>Disponibilités</legend>
						<label>
				        	<span>Vos disponibilités :</span>
				        	<textarea id="message" name="message" placeholder="Êtes-vous très disponible, avez-vous des périodes où vous ne pourrez pas être dispo, dispo quelques jours dans la semaine seulement, etc..." required></textarea>
				    	</label> 
				    </fieldset>

				    <label>
			        <input class="submit" type="submit" value="Submit">
			        <!-- <div onClick="divnousjoindre()" style="margin-left:15px; width:75%; height:30px; line-height:30px; text-align:center; background-color:#ff7000; color:black; margin-top:20px; cursor:pointer;">Envoyer</div> -->
			    </label> 
			   	</div> 
			</form>
			<div id="reception"></div>
		</div>
		
	</section>

	<div class="clear"></div>

<?php include('includes/footer.php'); ?>




