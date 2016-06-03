function scrollPlusAutres(){
    $.ajax({
        url : "scrollPlusAutres.php?lastid=" + $(".item:last").attr("id"),
        success: function(html){
            if(html){
                $(".recepteur").append(html);
            }else{
                document.getElementById('marchePas').innerHTML ='<center><p>Désolé, il n\'y a plus d\'article à afficher ! </p></center>';
            }
        }
    });
}