<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Grafico Facturas | ELECTRICISTAS";

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$con2 =mysqli("localhost","root","","simple_stock");

	$sql_factura=mysqli_query($con2,"select id_factura, fecha_factura, total_venta, condiciones from facturas");
	$rw= $con2->query($sql_factura);
		

	?>


<!DOCTYPE html>
  <head>
  <?php include("head.php");?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Fecha', 'Ventas'],

          <?php while($fila = $rw->fetch_assoc()){
          	echo "['".$fila["total_venta"]."',".$fila["condiciones"]."],"; 
          	?>
          }
        ]);

        var options = {
          title: 'Grafico de ventas'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
  
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    
  </body>
</html>