let buttonNote = document.getElementById("noter");
let note = document.getElementById("note");
let idELeve = document.getElementById("idEleve");

buttonNote.addEventListener("click", function () {
    alert(note.value);
    alert(idEleve)
    ajaxNoterEleve(idEleve);
},false);

function ajaxNoterEleve(idEleve){
    var request= $.ajax({
        url: "http://serveur1.arras-sio.com/symfony4-4061/ptRattrapage/projet1/public/api/eleve_rattrapages/"+ idEleve, 
        method:"GET",
        dataType: "json",
        beforeSend: function( xhr ) {
            xhr.overrideMimeType( "application/json; charset=utf-8" );
        }});
    request.done(function( msg ) {

        $.each(msg, function(index,e){
            console.log(e);
            
                });
    });
    // Fonction qui se lance lorsque l’accès au web service provoque une erreur
    request.fail(function( jqXHR, textStatus ) {
        alert ('erreur sur Eleves');
    });
}
