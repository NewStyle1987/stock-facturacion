<style>
table
{
border-collapse: collapse;
}
td, th /* Poner borde en td y th */
{
border: 1px solid black;
}

.color{
background-color:#F66;
}
</style>


<?php  
include("../INVENTARIO/funciones.php"); 
//export.php  
$connect = mysqli_connect("sql311.mipropia.com", "mipc_23207291", "maruydiego4ever", "mipc_23207291_stock");
$output = '';

if(isset($_POST["export"]))
{
	
 $query = "SELECT * FROM facturas ORDER BY fecha_factura DESC";
 
 $result = mysqli_query($connect, $query);
 
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1"> 
   
   					<tr>
					<th colspan="9" align="center" bordercolor="#FF0066">REPORTE FACTURAS - ELECTRICISTAS</th>
					</tr>
					 
                    <tr class="color">  
                         <th>ID_FACTURA</th>  
                         <th>NUMERO_FACTURA</th>  
                         <th>FECHA_FACTURA</th>  
      					 <th>ID_CLIENTE</th>
       					 <th>ID_VENDEDOR</th>
						 <th>CONDICIONES</th>
						 <th class="color">TOTAL_VENTA</th>
						 <th>ESTADO_FACTURA</th>
						 <th>CANAL</th>
						 
						 
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
	$output .= '
    <tr>  
                         <td>'.$row["id_factura"].'</td>  
                         <td>'.$row["numero_factura"].'</td>  
                         <td>'.$row["fecha_factura"].'</td>  
       					 <td>'.$row["id_cliente"].'</td>  
       					 <td>'.$row["id_vendedor"].'</td>
						 <td>'.$row["condiciones"].'</td>  
       					 <td class="color">'.$row["total_venta"].'</td>  
       					 <td>'.$row["estado_factura"].'</td>
						 <td>'.$row["canal"].'</td>
						 				 
						 
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=reporte_facturas.xls');
  echo $output;
 }
}
?>
