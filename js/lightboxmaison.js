function lightbox(id){
  // Calcule le nb d'image total et le met dans le HTML
  var nbImgTotal = $(".img").length;
  $('#nbImgTotal').text(nbImgTotal);

  // Calcule la lightbox avec la bonne image
  var img  = $('#'+id+'>img').attr('src');
  $('#img_lightbox').attr('src',img);
  $('#img_lightbox').attr('alt',id);

  // Renseigne à quelle image on est dans le HTML
  $('#nbImg').text(id);

  // Affiche le tout
  $('.mask').css('display','block');
  $('.lightboxPack').css('display','block');
}

function precedent(){

  //Caclcule
  var nbImg = $(".img").length;
  var id= $('#img_lightbox').attr('alt');
  console.log(id);
  if (id > 1) {
    var newImage = id - 1;
  }
  var img  = $('#'+newImage+'>img').attr('src');

  //Affiche
  $('#img_lightbox').attr('src',img);
  $('#img_lightbox').attr('alt',newImage);
  $('#nbImg').text(newImage);
}

function suivant(){

  //Calcule
  var nbImg = $(".img").length;
  var id= $('#img_lightbox').attr('alt');
  id = parseInt(id);
  if(id < nbImg){
    var newImage = id + 1;
  }
  var img  = $('#'+newImage+'>img').attr('src');

  //Affiche
  $('#img_lightbox').attr('src',img);
  $('#img_lightbox').attr('alt',newImage);
  $('#nbImg').text(newImage);
}

function fermer(){
  $('.mask').css('display','none');
  $('.lightboxPack').css('display','none');
}
