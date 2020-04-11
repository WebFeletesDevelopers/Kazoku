<script>
    var AssistanceList = [];

    /**
     * Adds the selected judoka to the list
     */
    function addToList(id){
        var isAtList = false;
        var position = 0;
        for(var i = 0; i < AssistanceList.length; i++){
            if(AssistanceList[i] == id){
                isAtList = true;
                position = i;
            }
        }
        if(isAtList){
            AssistanceList.splice(position,1);
        }
        else{
            AssistanceList.push(id);
        }
    };

    /**
     * Sends the assistance with POST method with AJAX
     */
    function sendList(){

        if (confirm('¿Confirmar faltas?')) {
            var id = document.getElementById('cod').value;
            $.ajax({
                url: 'site/controller/AsistenciaController.php',
                type: 'post',
                data: {listaFalta: AssistanceList,CodClase:id},
                success: function (response) {
                    if (response == 0) {

                    } else if (response == 1) {

                    }
                }
            });
        } else {
            // Do nothing!
        }


    };




</script>