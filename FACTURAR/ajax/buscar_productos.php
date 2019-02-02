<?php

	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_producto=intval($_GET['id']);
		$query=mysqli_query($con, "select * from products where id_producto='".$id_producto."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM products WHERE id_producto='".$id_producto."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  producto. Existen datos vinculados a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_producto', 'nombre_producto', 'codigo_barras');//Columnas de busqueda
		 $sTable = "products";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by stock desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './productos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Código</th>
					<th>Producto</th>
					<th>Estado</th>
					<th>Fecha</th>
                    <th class='text-right'>Precio</th>
                    <th class='text-left' >Stock</th>
					<!--<th>Categoria</th>
					<th>Talle</th>
					<th>Modelo</th>
                    <th>Detalle</th>
                    <th>Img</th>
                    <th>Estado_2</th>-->
					
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_producto=$row['id_producto'];
						$codigo_producto=$row['codigo_producto'];
						$nombre_producto=$row['nombre_producto'];
						$status_producto=$row['id_estado'];
						if ($status_producto==1){$estado="Activo";}
						else {$estado="Inactivo";}
						$date_added= date('Y-m-d', strtotime($row['date_added']));
						$precio_producto=$row['precio_producto'];
						
						$stock=$row['stock'];
						//$id_categoria=$row['id_categoria'];
//						$id_talle=$row['id_talle'];
//						$modelo=$row['modelo'];
//						$detalle=$row['detalle'];
//						$codigo_barras=$row['codigo_barras'];
//						$img=$row['img'];
						//$id_estado=$row['id_estado'];
						
					?>
					
					<input type="hidden" value="<?php echo $codigo_producto;?>" id="codigo_producto<?php echo $id_producto;?>">
					<input type="hidden" value="<?php echo $nombre_producto;?>" id="nombre_producto<?php echo $id_producto;?>">
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id_producto;?>">
					<input type="hidden" value="<?php echo number_format($precio_producto,0,'.','');?>" id="precio_producto<?php echo $id_producto;?>">
                    <input type="hidden" value="<?php echo $stock;?>" id="stock<?php echo $stock;?>">
					<?php /*?><input type="hidden" value="<?php echo $id_categoria;?>" id="id_categoria<?php echo $id_categoria;?>">
                    <input type="hidden" value="<?php echo $id_talle;?>" id="id_talle<?php echo $id_talle;?>">
					<input type="hidden" value="<?php echo $modelo;?>" id="modelo<?php echo $modelo;?>">
                    <input type="hidden" value="<?php echo $detalle;?>" id="detalle<?php echo $detalle;?>">
					<input type="hidden" value="<?php echo $codigo_barras;?>" id="codigo_barras<?php echo $codigo_barras;?>">
                    <input type="hidden" value="<?php echo $img;?>" id="img<?php echo $img;?>"><?php */?>
					<tr>
						
						<td><?php echo $codigo_producto; ?></td>
						<td ><?php echo $nombre_producto; ?></td>
						<td><?php echo $estado;?></td>
						<td><?php echo $date_added;?></td>
						<td>$<span class='pull-right'><?php echo number_format($precio_producto,0);?></span></td>
                        <td><?php echo $stock; ?></td>
						<?php /*?><td ><?php echo $id_categoria; ?></td>
						<td><?php echo $id_talle;?></td>
						<td><?php echo $modelo;?></td>
                        <td><?php echo $detalle; ?></td>
						<td ><?php echo $codigo_barras; ?></td>
						<td><?php echo $img;?></td><?php */?>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id_producto;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id_producto; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					 <tr>
					<td colspan=7 align="center"><span>
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
					</tr>
                    
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>