function checkAndUnCheckAll(nbEntre){
	//Regarde s'il doit mettre à true ou false (Selon le Check Tout)
	var checkOrUnCheck = document.getElementById('checkbox-tout').checked
	//Boucle dans tous pour cocher/décocher
	for(i = 1; i < nbEntre+1; i++){
		document.getElementById(i).checked = checkOrUnCheck;
	}
}
