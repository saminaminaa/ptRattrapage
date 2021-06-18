/* On récupère la valeur de la div chrono (20) */
var temps = document.getElementById("chrono");
var hms = temps.innerHTML;
var btChrono = document.getElementById("btChrono")
var splitTime = hms.split(':'); // split it at the colons
var secondes = (+splitTime[0]) * 60 * 60 + (+splitTime[1]) * 60 + (+splitTime[2]); 
var support = document.getElementById("support")
var buttonPressed = false

btChrono.addEventListener("click",lockButton)

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
        if((secondes == 3600 ||secondes == 1800 || secondes == 900 || secondes == 300)&& support.value == "1"){
            PlaySound();
        }
       temps.innerHTML = secondsToHms(secondes);
        //alert(document.getElementById("chrono").innerHTML = secondes);
        var ok = window.setTimeout("decrementerChrono()", 1000);
        //alert("ok = " + ok);
    } else {
        temps.innerHTML = "L'épreuve est terminée. " + "<br />";
    }
}

function PlaySound() {
    document.getElementById('alert').play();
}




