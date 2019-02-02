<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_producto=mysqli_real_escape_string($con,(strip_tags($_POST["id_producto"],ENT_QUOTES)));
		$user_id=mysqli_real_escape_string($con,(strip_tags($_POST["user_id"],ENT_QUOTES)));
		$fecha=date("Y-m-d H:i:s");
		$nota=mysqli_real_escape_string($con,(strip_tags($_POST["nota"],ENT_QUOTES)));
		$referencia=mysqli_real_escape_string($con,(strip_tags($_POST["referencia"],ENT_QUOTES)));
		$cantidad=mysqli_real_escape_string($con,(strip_tags($_POST["cantidad"],ENT_QUOTES)));
		$canal=mysqli_real_escape_string($con,(strip_tags($_POST["canal"],ENT_QUOTES)));
		$f_pago=mysqli_real_escape_string($con,(strip_tags($_POST["f_pago"],ENT_QUOTES)));
		
		$sql="INSERT INTO historial (id_producto , user_id, fecha, nota, referencia, cantidad, canal, f_pago) VALUES ($id_producto , $user_id, $fecha, $nota, $referencia, $cantidad, $canal, $f_pago )";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Historial ingresado exitosamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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