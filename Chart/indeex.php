<?php
   include_once("../Utilerias/BaseDatos.php");
   $data = consultastatgraf();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grafica de Barra y Lineas con PHP y PostgreSQL</title>
    <script src="chart.js"></script>
</head>
<body>
<h1>Grafica de Barra y Lineas con PHP y MySQL</h1>
<canvas id="chart1" style="width:100%;" height="400"></canvas>
<script>
var ctx = document.getElementById("chart1");
var data = {
        labels: [ 
        <?php foreach($data as $d):?>
        "<?php echo $d['stat'];?>", 
        <?php endforeach; ?>
        ],
        datasets: [{
            label: 'Valor Sensado',
            data: [
        <?php foreach($data as $d):?>
        <?php echo $d['res'];?>, 
        <?php endforeach; ?>
            ],
            backgroundColor: "#3898db",
            borderColor: "#9b59b6",
            borderWidth: 2
        }]
    };
var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    };
var chart1 = new Chart(ctx, {
    type: 'line', /* valores: line, bar*/
    data: data,
    options: options
});
</script>
</body>
</html>