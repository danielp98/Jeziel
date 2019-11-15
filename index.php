
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

        while($fila = mysqli_fetch_array($resultado)){

            $chart_data .= "{ id:'".$fila["id"]."', dato:".$fila['dato']."}, ";

        }

        $chart_data = substr($chart_data, 0, -2);

    }
    
    $query = "SELECT * FROM datos";

    $resultado = $mysqli->query($query);

    if(isset($_POST['led1'])){
    
        $SQL = "INSERT INTO Ledcontrolweb values (null, 1)";
        $result = $mysqli->query($SQL);

    }
    if(isset($_POST['led0'])){
    
        $SQL = "INSERT INTO Ledcontrolweb values (null, 0)";
        $result = $mysqli->query($SQL);

    }

    if(isset($_POST['controlweb'])){

        $SQL = "INSERT INTO control values (null, 1)";
        $result = $mysqli->query($SQL);

    }
    if(isset($_POST['controllabview'])){

        $SQL = "INSERT INTO control values (null, 0)";
        $result = $mysqli->query($SQL);

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gráfica IoT</title>
    <link rel="stylesheet" href="css/morris.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">

        <div>

            <div>

            <form method="post">

                <input class="btn btn-primary" type="submit" name="led1" value="submt1"/>
                <input class="btn btn-primary" type="submit" name="led0" value="submt0"/>
                <input class="btn btn-success" type="submit" name="controlweb" value="control-web"/>
                <input class="btn btn-success" type="submit" name="controllabview" value="control-labview"/>

            </form>

            </div>

            <div id="led">

                
            
            </div>

            <div id="datos">

            </div>

            <div id="chart">

            </div>
            
        </div>

    </div>

    <?php

    ?>
    
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/mainled.js"></script>
    <script src="js/raphael.min.js"></script>
    <script src="js/morris.min.js"></script>
</body>
</html>
<script>

    

    //function chart(){

    var morrisLine;
    //initMorris();
    //getMorris(); 
    //getMorrisOffline();
    
    initMorris();
    
    $(document).ready(function () {
    //    initMorris;
        var interval = setInterval(update,2000);
    })
    
    //setInterval(getMorris, 5000);
    function update() {
        morrisLine.setData([<?php echo $chart_data; ?>]);
    }
    
    //setInterval(update, 1000);

    function initMorris() {
        morrisLine = Morris.Line({
        element: 'chart',
        //data: [<?php echo $chart_data; ?>],
        xkey: 'id',
        ykeys: ['dato'],
        labels: ['dato'],
        xLabelAngle: 60,
        parseTime: false,
        resize: true,
        lineColors: ['#32c5d2', '#c03e26']
        });
    }
    
    function setMorris(data) {
        morrisLine.setData(data);
        //morrisLine.setData([<?php echo $chart_data; ?>]);
    }

    function getMorris() {
        $.ajax({
            url: 'App/chart.php',
            data: form_data,
            type: 'POST',
            dataType: 'json',
            success: function(data){
                morrisLine.setData(data);
            }     
        });
    }
    
    //Morris.Line({
        //element : 'chart', 
        //data:[<?php echo $chart_data; ?>], 
        //xkey:['id'], 
        //ykeys:['dato'], 
        //labels:['dato'], 
        //hideHover:'auto'
    //});
    
    //}

</script>
