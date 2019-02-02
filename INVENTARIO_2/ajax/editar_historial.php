<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_user_id'])) {
           $errors[] = "ID USUARIO vacío";
        }else if (empty($_POST['mod_cantidad'])) {
           $errors[] = "Cantidad vacío";
        }  else if (
			!empty($_POST['mod_user_id']) &&
			!empty($_POST['mod_fecha'])&&
			!empty($_POST['mod_canal'])&&
			!empty($_POST['mod_f_pago'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$user_id=mysqli_real_escape_string($con,(strip_tags($_POST["mod_user_id"],ENT_QUOTES)));
		$fecha=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fecha"],ENT_QUOTES)));
		$nota=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nota"],ENT_QUOTES)));
		$referencia =mysqli_real_escape_string($con,(strip_tags($_POST["mod_referencia"],ENT_QUOTES)));
		$cantidad=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cantidad"],ENT_QUOTES)));
		$canal=mysqli_real_escape_string($con,(strip_tags($_POST["mod_canal"],ENT_QUOTES)));
		$f_pago=mysqli_real_escape_string($con,(strip_tags($_POST["mod_f_pago"],ENT_QUOTES)));
		
		
		$id_talle=intval($_POST['mod_id']);
		$sql="UPDATE historial SET user_id='".$user_id."', fecha='".$fecha."', nota='".$nota."', referencia='".$referencia."', cantidad='".$cantidad."', canal='".$canal."',  f_pago='".$f_pago."' WHERE id_historial='".$id_historial."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Historial ha sido actualizada satisfactoriamente.";
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