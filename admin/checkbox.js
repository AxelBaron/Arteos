
		function afficher(){
			document.getElementById('affiche-p').style.display = "block";
			document.getElementById('salle').setAttribute("none","none");
			document.getElementById('fest').setAttribute("required","required");
			document.getElementById('affiche-sub').style.display = "block";
			document.getElementById('affiche-p2').style.display = "none";
			
			
		}

		function afficher2(){
			document.getElementById('affiche-p').style.display = "none";
			document.getElementById('affiche-sub').style.display = "block";
			document.getElementById('fest').setAttribute("none","none");
			document.getElementById('salle').setAttribute("required","required");
			document.getElementById('affiche-p2').style.display = "block";
		}
