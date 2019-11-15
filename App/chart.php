<?php

    $mysqli = new mysqli("localhost", "root", "root", "arduino");

    if(!$mysqli){
        echo "Error: no se pudo conectar a MySQL";
    }

    echo "Éxito: se realizó una conexión apropiada a MySQL";

    $chart_data = "";
    $query = "SELECT * FROM datos";

    $resultado = $mysqli->query($query);

    if($resultado->num_rows > 0){

        while($fila = $resultado->fetch_assoc()){

            $chart_data .= "{ id:'".$fila['id']."', dato:'".$fila['dato']."' }";

        }

        $chart_data = substr($chart_data, 0, -2);

    } else {
        $salida = "No hay datos";

    }

    echo json_encode($chart_data);

    $mysqli->close();

?>