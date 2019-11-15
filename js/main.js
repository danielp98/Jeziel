$(document).ready(function () {
    var interval = setInterval(buscar_datos,1000);
});

function buscar_datos(consulta){
    $.ajax({
        url: 'App/buscar.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    .done(function(respuesta) {
        $('#datos').html(respuesta);
        
        
    })
    .fail(function() {
        console.log("error");
    })

    //setTimeout(buscar_datos, 5000);

}
