<?php

	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action1 = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id_historial'])){
		$id_historial=intval($_GET['id_historial']);
		$query=mysqli_query($con, "select * from historial where id_historial='".$id_historial."'");
		$count1=mysqli_num_rows($query);
		
		
		
		
		if ($count1==0){
			if ($delete1=mysqli_query($con,"DELETE FROM historial WHERE id_historial='".$id_historial."'")){
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
			  <strong>Error!</strong> No se pudo eliminar éste historial. Existen productos vinculados a éste historial. 
			</div>
			<?php
		}
		
		
		
	}
	if($action1 == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('fecha');//Columnas de busqueda
		 $sTable = "historial";
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
		$sWhere.=" order by fecha DESC";
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
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<!--<th>ID Historial</th>
					<th>ID Producto</th>
					<th>User ID</th>-->
                    <th>Fecha</th>
					<th>Nota</th>
                    <th>Referencia</th>
                    <th>Cantidad</th>
                    <th>Canal</th>
					<!--<th class='text-right'>Acciones</th>-->
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_historial=$row['id_historial'];
						$id_producto=$row['id_producto'];
						
						
						$resultado_producto=$id_producto;
		
						
						$user_id=$row['user_id'];
						$fecha= date('Y-m-d  H:i', strtotime($row['fecha']));
						$nota=$row['nota'];
						$referencia=$row['referencia'];
						$cantidad=$row['cantidad'];
						$canal=$row['canal'];
						
					?>
                    
                    
					<tr>
						<!--<td><?php /*echo $id_historial; ?></td>
						<td ><?php echo $resultado_producto; ?></td>
						<td><?php echo $user_id;*/?></td>-->
                        <td><?php echo $fecha;?></td>
						<td><?php echo $nota; ?></td>
						<td ><?php echo $referencia; ?></td>
						<td><?php echo $cantidad;?></td>
                        <td><?php echo $canal;?></td>
						
											
					</tr>
                    
                    
                    
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
            <form method="post" action="export_historial.php">
     		<input type="submit" name="export" class="btn btn-success" value="EXPORTAR XLS" />
    		</form>
			<?php
			
		}
	}
?>