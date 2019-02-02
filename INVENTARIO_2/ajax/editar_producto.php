<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_codigo'])) {
           $errors[] = "Código vacío";
        } else if (empty($_POST['mod_nombre'])){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['mod_categoria']==""){
			$errors[] = "Selecciona la categoría del producto";
		} else if (empty($_POST['mod_precio'])){
			$errors[] = "Precio de venta vacío";
		} else if ($_POST['mod_talle']==""){
			$errors[] = "Selecciona el talle del producto";
		} else if (empty($_POST['mod_modelo'])){
			$errors[] = "Modelo vacío";
		} else if (empty($_POST['mod_detalle'])){
			$errors[] = "Detalle vacío";
		} else if (empty($_POST['mod_codigo_barras'])){
			$errors[] = "Código de Barras vacío";
		} else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_codigo']) &&
			!empty($_POST['mod_nombre']) &&
			$_POST['mod_categoria']!="" &&
			!empty($_POST['mod_precio']) &&
			!empty($_POST['mod_talle']) 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$categoria=intval($_POST['mod_categoria']);
		$stock=intval($_POST['mod_stock']);
		$precio_venta=floatval($_POST['mod_precio']);
		$id_producto=intval($_POST['mod_id']);
		
		$talle=intval($_POST['mod_talle']);
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_modelo"],ENT_QUOTES)));
		
		$detalle=mysqli_real_escape_string($con,(strip_tags($_POST['mod_detalle'],ENT_QUOTES)));
		$codigo_barras=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo_barras"],ENT_QUOTES)));
		$img=mysqli_real_escape_string($con,(strip_tags($_POST["mod_img"],ENT_QUOTES)));
			
		
		
		
		$sql="UPDATE products SET codigo_producto='".$codigo."', 
		nombre_producto='".$nombre."', id_categoria='".$categoria."', 
		precio_producto='".$precio_venta."', stock='".$stock."', 
		id_talle='".$talle."', modelo='".$modelo."', detalle='".$detalle."', 
		 codigo_barras='".$codigo_barras."', img='".$img."' WHERE id_producto='".$id_producto."'";
		 
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Producto ha sido actualizado satisfactoriamente.";
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