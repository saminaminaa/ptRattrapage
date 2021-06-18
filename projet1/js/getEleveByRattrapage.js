let idRattrapage = document.getElementById("idRattrapage");

idRattrapage = idRattrapage.value

function ajaxEleveByRattrapage(idRattrapage){
    var request= $.ajax({
        url: "http://serveur1.arras-sio.com/symfony4-4061/ptRattrapage/projet1/public/api/rattrapages/"+ idRattrapage, 
        method:"GET",
        dataType: "json",
        beforeSend: function( xhr ) {
            xhr.overrideMimeType( "application/json; charset=utf-8" );
        }});
    request.done(function( msg ) {

        $.each(msg.eleves, function(index,e){
            console.log(e);
            ajaxEleveByLink(e);
            
                });
    });
    // Fonction qui se lance lorsque l’accès au web service provoque une erreur
    request.fail(function( jqXHR, textStatus ) {
        alert ('erreur sur Tests');
    });
}

function ajaxEleveByLink(e){
    var request= $.ajax({
        url: "http://serveur1.arras-sio.com"+ e, 
        method:"GET",
        dataType: "json",
        beforeSend: function( xhr ) {
            xhr.overrideMimeType( "application/json; charset=utf-8" );
        }});
    request.done(function( msg ) {
        console.log(msg);
        $.each(msg, function(index,e){

                });
    });
    // Fonction qui se lance lorsque l’accès au web service provoque une erreur
    request.fail(function( jqXHR, textStatus ) {
        alert ('erreur sur Tests');
    });
}

ajaxEleveByRattrapage();