function modif_couv()
{
  var xmlhttp;
  var hu = encodeURIComponent(document.getElementById("btn_ajax").value);
  var re = []
  re[0] = hu;



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
  xmlhttp.open("GET","../admin/modif-couv.php?re="+re,true);
  // si on passe en post, on ajoute ca. Et on met les valeurs dans le send()
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.send();
}
