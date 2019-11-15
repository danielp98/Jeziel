$(document).ready(function () {
    var interval = setInterval(buscar_datos,2000);
});

function buscar_datos(consulta){
    $.ajax({
        url: 'App/led.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    .done(function(respuesta) {
        $('#led').html(respuesta);
        
        
    })
    .fail(function() {
        console.log("error");
    })

    //setTimeout(buscar_datos, 5000);

}


