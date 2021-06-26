/* On récupère la valeur de la div chrono (20) */
var temps = document.getElementById("chrono");
var hms = temps.innerHTML;
var btChrono = document.getElementById("btChrono");
var splitTime = hms.split(':'); // split it at the colons
var secondes = (+splitTime[0]) * 60 * 60 + (+splitTime[1]) * 60 + (+splitTime[2]); 
var support = document.getElementById("support");
var Arendu = document.getElementsByClassName("eleveRendu");
var dateRendu = document.getElementsByClassName("dateRendu")
var buttonPressed = false;
var epreuveTerminee = false;
btChrono.addEventListener("click",lockButton)

for (let nbitem = 0; nbitem < Arendu.length ; nbitem++) {
    Arendu[nbitem].addEventListener("click",function(){
        if(Arendu[nbitem].checked){
            var currentdate = new Date(); 
            console.log(nbitem)
            dateRendu[nbitem].value = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
        }else{
            dateRendu[nbitem].value = "";
        }
        console.log(dateRendu)
    })

}

function lockButton(){
    if(!buttonPressed){
        buttonPressed = true
        decrementerChrono()
    }
}

function secondsToHms(secondes){

    heures = Math.floor(secondes / 3600)
    minutes = Math.floor((secondes % 3600) / 60)
    secondes = (secondes % 3600) % 60

    return heures + ":" + minutes +":" +secondes    
}


function decrementerChrono() {

        //alert(secondes);
    /* Si elle est plus grande que 0 on la décrémente
     * et on rappelle la fonction */
    if (secondes > 0) {
        secondes --;
        if((secondes == 3600 ||secondes == 1800 || secondes == 900 || secondes == 300)&& support.checked == "1"){
            PlaySound();
        }
        if(epreuveTerminee){
            temps.innerHTML= "L'épreuve est terminée. " + secondsToHms(secondes) + " restantes pour finir l'appel"+ "<br />";
        }else{
            temps.innerHTML = secondsToHms(secondes);
        }
        //alert(document.getElementById("chrono").innerHTML = secondes);
        var ok = window.setTimeout("decrementerChrono()", 1000);
        //alert("ok = " + ok);
    } else {
        if(support.checked == "1"){
            PlaySound();
        }

        temps.innerHTML = "L'épreuve est terminée. " + "<br />";
        secondes = 300;
        epreuveTerminee = true;
        var ok = window.setTimeout("decrementerChrono()", 1000);
    }
}

function PlaySound() {
    document.getElementById('alert').play();
}





