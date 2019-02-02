<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	include("../../INVENTARIO/funciones.php");
	$id_factura= $_SESSION['id_factura'];
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_cliente'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['id_vendedor'])) {
           $errors[] = "Selecciona el vendedor";
        } else if (empty($_POST['condiciones'])){
			$errors[] = "Selecciona forma de pago";
		} else if ($_POST['estado_factura']==""){
			$errors[] = "Selecciona el estado de la factura";
		} else if (
			!empty($_POST['id_cliente']) &&
			!empty($_POST['id_vendedor']) &&
			!empty($_POST['condiciones']) &&
			!empty($_POST['condiciones2']) &&
			$_POST['estado_factura']!="" 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_cliente=intval($_POST['id_cliente']);
		$id_vendedor=intval($_POST['id_vendedor']);
		$condiciones=intval($_POST['condiciones']);
		$condiciones2=intval($_POST['condiciones2']);

		$estado_factura=intval($_POST['estado_factura']);
		
		$sql="UPDATE facturas SET id_cliente='".$id_cliente."', id_vendedor='".$id_vendedor."', condiciones='".$condiciones."', estado_factura='".$estado_factura."', canal='".$condiciones2."' WHERE id_factura='".$id_factura."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Factura ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		
		
		

		// DOY DE BAJA PRODUCTO *********************************
		$sql5=mysqli_query($con, "select * from products, facturas, detalle_factura where facturas.numero_factura=detalle_factura.numero_factura and  facturas.id_factura='$id_factura' and products.id_producto=detalle_factura.id_producto");
		while ($row=mysqli_fetch_array($sql5))
				{
				$id_detalle=$row["id_detalle"];
				$codigo_producto=$row['codigo_producto'];
				$cantidad=$row['cantidad'];
				$nombre_producto=$row['nombre_producto'];
				
				
				$precio_venta=$row['precio_venta'];
				$precio_venta_f=number_format($precio_venta,2);//Formateo variables
				$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
				$precio_total=$precio_venta_r*$cantidad;
				$precio_total_f=number_format($precio_total,2);//Precio total formateado
				$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
				

				 }
		$sql4=mysqli_query($con, "select * from products, facturas, detalle_factura where facturas.numero_factura=detalle_factura.numero_factura and  facturas.id_factura='$id_factura' and products.id_producto=detalle_factura.id_producto");
	
		while ($row=mysqli_fetch_array($sql4))
	    {
		
		
		//$row=mysqli_fetch_array($sql2);
		$id_producto=$row["id_producto"];
		eliminar_stock($id_producto,$cantidad);
		// GUARDO HISTORIAL *************************************
		$quantity=$cantidad;
		$reference="FACTURA";
		$user_id=$_SESSION['user_id'];
		$firstname=$_SESSION['firstname'];
		
		$fecha=date("Y-m-d H:i:s");
		$canal= $row["canal"];
		//$f_pago= $row["f_pago"];
		
		if ($canal==1){$canal= "Contado";}
				elseif ($canal==2){$canal= "Mercadopagos";}
				elseif ($canal==3){$canal= "Débito";}
				elseif ($canal==4){$canal= "Crédito";}
				elseif ($canal==3){$canal= "Abitab";}
				elseif ($canal==4){$canal= "Brou";}
		
		$nota="$firstname eliminO por FACTURA Nro $id_factura: $quantity producto(s) al inventario - ref $codigo_producto ";
		
		guardar_historial($id_producto,$user_id,$fecha,$nota,$reference,$quantity, $canal);

		$est_sql3=1;
		$id_prod=$id_producto;

		$sql6=mysqli_query($con, "SELECT stock, id_producto FROM products WHERE id_producto = '" . $id_prod. "'");


			while ($row=mysqli_fetch_array($sql6))
				{
				$cant_actualizada=$row["stock"];
				 }

				$cant_active=$cant_actualizada;
				 /*tomar la id del producto que combine con la ref*/

				$sql2="UPDATE pps_stock_available s, pps_product p SET s.quantity ='".$cant_active."' WHERE s.id_stock_available ='".$id_prod."'";
				$query_update2 = mysqli_query($con2,$sql2);

				$sql3="UPDATE pps_product_shop a SET a.active ='".$est_sql3."' WHERE a.id_product ='".$id_prod."'";
				$query_update3 = mysqli_query($con2,$sql3);

				/*--------------------------*/
	
	    }
		//********************************************************
		/*--- - - - - - - - - - -- - - -*/
		


			if ($query_update2){
				$messages[] = "Factura ha sido actualizada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con2);
				}
			} else {
				$errors []= "Error desconocido.";
		}



		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>