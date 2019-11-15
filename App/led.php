<?php

    $mysqli = new mysqli('localhost', 'root', 'root', 'arduino');

    if(!$mysqli){
        //echo "Error: no se pudo conectar a MySQL";
    }

    echo "Éxito: Se realizó una conexión apropiada a MySQL!";

    $led = "";
    $query = "SELECT * FROM Led ORDER BY id DESC LIMIT 1";

    $resultado = $mysqli->query($query);

    if($resultado->num_rows > 0){

        //$led.= "<img src='imagenes/led0.jpg'>";

        while($fila = $resultado->fetch_assoc()){

            //$led.=$fila['led'].".jpg>'";
            if($fila['led'] == 0){
                $led.="<img src='imagenes/led0.jpg'>";
            }
            if($fila['led'] == 1){
                $led.="<img src='imagenes/led1.jpg'>";
            }

        }
        
    } else {
        $led.="No hay datos";

    }

    echo $led;

    $mysqli->close();

?>
