<?php

    $mysqli = new mysqli('localhost', 'root', 'root', 'arduino');
    

    if(!$mysqli){
        echo "Error: no se pudo conectar a MySQL";
    }

    echo "Éxito: Se realizó una conexión apropiada a MySQL!";

    //mysqli::_construct([string $host = ini_get("")])

    $salida = "";
    $query = "SELECT * FROM datos";

    //if(isset($_POST['consulta'])){
    //    $q = $mysqli->real_escape_string($POST['consulta']);
    //}

    $resultado = $mysqli->query($query);

    $chart_data = '';
    
    if($resultado->num_rows > 0){

        $salida.="<table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>Dato</th>
                        </tr>
                    </thead>
                    <tbody>";
        
        while($fila = $resultado->fetch_assoc()){

            $chart_data .= "{ id:'".$fila['id']."', dato:'".$fila['dato']."' }";

            $salida.="<tr>
                    <td>".$fila['id']."</td>
                    <td>".$fila['dato']."</td>
            </tr>";
        }

        $salida.="</tbody></table>";

        $chart_data = substr($chart_data, 0, -2);
        
    } else {
        $salida.="No hay datos";

    }

    echo $salida;
    //echo $chart_data;

    $mysqli->close();

?>