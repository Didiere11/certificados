<?php
   include_once("../Utilerias/BaseDatos.php");
   $data = consultacarrgraf();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />
<title>Certificados</title>
</head>
<body>

<?php
     include_once("../Utilerias/BaseDatos.php");
       $idopc = "opcGrs";
       $res = ValidaOpcion($idopc);
       if ($res == "")
            header("location:../Acceso/");
       else
            include_once("../resources/html/header.php");       
?>


<h1 align="center">Estadisticas</h1>
<h4 align="center">Cantidad de CErtificados por carrera</h4>
<canvas id="myChart" style="width:10%;" height="40"></canvas>
<script src="chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php foreach($data as $d):?>
        "<?php echo $d['carr'];?>", 
        <?php endforeach; ?>],
        datasets: [{
            label: 'Certificados',
            backgroundColor: '#42a5f5',
            borderColor: 'gray',
            data: [<?php foreach($data as $d):?>
        <?php echo $d['res'];?>, 
        <?php endforeach; ?>]
        }		
		]},
    options: {responsive: true}
});

</script>
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>     
    <script type="text/javascript" src="../resources/js/Cursos.js"></script>
    <script type="text/javascript" src="./Valida.js"></script> 
<script type="text/javascript">
        $(document).ready(function(){
            $('select').formSelect();
            $('.sidenav').sidenav();
            $(".dropdown-trigger").dropdown();
        });
    </script> 
</body>
</html> 