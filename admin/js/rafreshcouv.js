function loadXMLDoc()
{  
  var xmlhttp;
  var hu = encodeURIComponent(document.getElementById("btn_ajax").value);
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else{
      // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

    xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
    }
  }
  xmlhttp.open("GET","rafreshcouv.php?admin=admin&hu=" +hu,true);
  // si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
  // xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send();
}



function loadXMLDocSlider()
{  
  var xmlhttp;
  var huSlider = encodeURIComponent(document.getElementById("btn_ajax").value);
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else{
      // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("myDivSlider").innerHTML=xmlhttp.responseText;
    //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
    }
  }
xmlhttp.open("GET","rafreshslider.php?admin=admin&huSlider=" +huSlider,true);
// si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}

function loadXMLDocSlider2()
{  
  var xmlhttp;
  var huSlider2 = encodeURIComponent(document.getElementById("btn_ajax").value);
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else{
      // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("myDivSlider2").innerHTML=xmlhttp.responseText;
    //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
    }
  }
xmlhttp.open("GET","rafreshslider.php?admin=admin&huSlider2=" +huSlider2,true);
// si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}

function loadXMLDocSlider3()
{  
  var xmlhttp;
  var huSlider3 = encodeURIComponent(document.getElementById("btn_ajax").value);
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else{
      // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("myDivSlider3").innerHTML=xmlhttp.responseText;
    //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
    }
  }
xmlhttp.open("GET","rafreshslider.php?admin=admin&huSlider3=" +huSlider3,true);
// si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}

function loadXMLDocSlider4()
{  
  var xmlhttp;
  var huSlider4 = encodeURIComponent(document.getElementById("btn_ajax").value);
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else{
      // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("myDivSlider4").innerHTML=xmlhttp.responseText;
    //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
    }
  }
xmlhttp.open("GET","rafreshslider.php?admin=admin&huSlider4=" +huSlider4,true);
// si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}

function loadXMLDocSlider5()
{  
  var xmlhttp;
  var huSlider5 = encodeURIComponent(document.getElementById("btn_ajax").value);
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
  else{
      // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200){
    document.getElementById("myDivSlider5").innerHTML=xmlhttp.responseText;
    //ce qu'on applle en php va pop dans le html, dans la div avec le id"mydiv"
    }
  }
xmlhttp.open("GET","rafreshslider.php?admin=admin&huSlider5=" +huSlider5,true);
// si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
 