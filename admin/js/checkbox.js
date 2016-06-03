
		function afficher(){
			document.getElementById('affiche-sub').style.display = "block";
			document.getElementById('affiche-p2').style.display = "none";
			document.getElementById('affiche-p').style.display = "block";
			document.getElementById('fest').setAttribute("required","required");
			document.getElementById('salle').removeAttribute("required");
			
			
		}

		function afficher2(){
			document.getElementById('affiche-sub').style.display = "block";
			document.getElementById('affiche-p2').style.display = "block";
			document.getElementById('affiche-p').style.display = "none";
			document.getElementById('fest').removeAttribute("required");
			document.getElementById('salle').setAttribute("required","required");
			
			
		}

		function afficherFormModif(){
			document.getElementById('affiche-p').style.display = "block";
		}

		function afficherFormModif2(){
			document.getElementById('affiche-p').style.display = "none";
		}

		function afficherFormModif3(){
			document.getElementById('sous_check').style.display = "block";
		}

		function afficherFormModif4(){
			document.getElementById('sous_check').style.display = "none";
		}

		function afficherFormModif5(){
			document.getElementById('affiche').style.display = "block";
		}

		function afficherFormModif6(){
			document.getElementById('affichee').style.display = "block";
		}

		function afficherFormModif7(){
			document.getElementById('affiche_again').style.display = "block";
		}
