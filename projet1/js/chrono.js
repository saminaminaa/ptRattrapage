function decrementerChrono() {
 
    /* On récupère la valeur de la div chrono (20) */
    var secondes = document.getElementById("chrono").innerHTML;
    //alert(secondes);
    /* Si elle est plus grande que 0 on la décrémente
     * et on rappelle la fonction */
    if (secondes > 0) {
        secondes --;
        document.getElementById("chrono").innerHTML = secondes;
        //alert(document.getElementById("chrono").innerHTML = secondes);
        var ok = window.setTimeout("decrementerChrono()", 1000);
        //alert("ok = " + ok);
    } else {
        document.getElementById("chrono").innerHTML = "Ça y est c'est fini gros, t'as perdu " + "<br />";
        stopChrono();
    }
}