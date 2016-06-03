function divnousjoindre() {
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