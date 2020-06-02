window.onload = function(){
    innerCounter('messagesCenter','a','popupMessages');
    innerCounter('alertsCenter','a','popupAlerts');
};

/**
 * Function that is used for notification center's pop ups that have a counter.
 * @param divId the div that contains the lists
 * @param tagName the kind of tag that contains each row
 * @param popUpId the id of the popup
 */
function innerCounter(divId,tagName,popUpId) {
    var num = $("#"+divId).find(tagName).length;
    if (num > 1) {
        document.getElementById(popUpId).innerHTML = num-1;
    }
}
var listaFalta = [];
function addToList(id){
    var estaEnLista = false;
    var posicionEnLista = 0;
    for(var i = 0; i < listaFalta.length; i++){
        if(listaFalta[i] == id){
            estaEnLista = true;
            posicionEnLista = i;
        }
    }
    if(estaEnLista){
        listaFalta.splice(posicionEnLista,1);
    }
    else{
        listaFalta.push(id);
    }
};

function sendList(){
    alert(listaFalta);
    $.ajax({
        url: 'site/controller/ClasesController.php',
        type: 'post',
        data: {listaFalta: listaFalta},
        success: function (response) {
            if (response == 0) {
                var msg = "Error";
                $("#message").html(msg);
                var div = document.getElementById("message");
                div.classList.remove("d-none");
            } else if (response == 1) {
                window.location = "../Listar.php";
            }

        }

    });
};