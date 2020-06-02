<script>
    var listaFalta = [];
    function aLaLista(id){
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

    function mandarLista(){
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




</script>