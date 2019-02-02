
<style>
  .zoom{
        /* Aumentamos la anchura y altura durante 2 segundos */
        transition: width 2s, height 2s, transform 2s;
        -moz-transition: width 2s, height 2s, -moz-transform 2s;
        -webkit-transition: width 2s, height 2s, -webkit-transform 2s;
        -o-transition: width 2s, height 2s,-o-transform 2s;
    }
    .zoom:hover{
        /* tranformamos el elemento al pasar el mouse por encima al doble de
           su tamaño con scale(2). */
        transform : scale(2);
        -moz-transform : scale(2);      /* Firefox */
        -webkit-transform : scale(2);   /* Chrome - Safari */
        -o-transform : scale(2);        /* Opera */
    }
	
	#container{
  width:  200px; /*or 70%, or what you want*/
  height: 150px; /*or 70%, or what you want*/
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  -webkit-box-shadow: 0 0 13px 3px rgba(246, 149, 150, 0.5);
  -moz-box-shadow:    0 0 13px 3px rgba(246, 149, 150,  0.5);
  box-shadow:         0 0 13px 3px rgba(246, 149, 150,  0.5);
}

	.img:focus{
  
  		transform : scale(2);
        -moz-transform : scale(2);      /* Firefox */
        -webkit-transform : scale(2);   /* Chrome - Safari */
        -o-transform : scale(2);        /* Opera */
}

	#img-tam{
		height:150px;
		width:300px;
	
	}


</style>
<?php
	
	
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_producto=intval($_GET['id']);
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
			
		 
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		
		 $id_categoria =intval($_REQUEST['id_categoria']);
		 //$id_estado =intval($_REQUEST['id_estado']);
		 $aColumns = array('codigo_producto', 'nombre_producto', 'codigo_barras');//Columnas de busqueda
		 //$sStock = "stock";
		 $sTable = "products";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
		if ($id_categoria>0){
			$sWhere .=" and id_categoria='$id_categoria'";
			
			
			}
			
		$sWhere.=" order by stock desc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 18; //how much records you want to show
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
			  
				<?php
				$nums=1;
				while ($row=mysqli_fetch_array($query)){
						$id_producto=$row['id_producto'];
						$codigo_producto=$row['codigo_producto'];
						$nombre_producto=$row['nombre_producto'];
						$precio_producto=$row['precio_producto'];
						$stock=$row['stock'];
						
						
						if($row['stock']<='0'){
							$img='https://cdn6.f-cdn.com/contestentries/362029/18770436/56d4e5c13c891_thumb900.jpg';
							
						}else
						if(empty($row['img'])){
							$img='https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/article/59d4b0ae5bafe8824b5c70e2/lisozima_0.jpg';
							
						} else if($row['stock']<='0'){
							$img='https://estaticos.muyinteresante.es/media/cache/760x570_thumb/uploads/images/article/59d4b0ae5bafe8824b5c70e2/lisozima_0.jpg';
							
						}else{
							
							?> <div class="img" media="(max-width: 10px)" ><?php
							$img=$row['img'];
							?> </div><?php
						}
					?>
					
					<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 thumb text-center ng-scope" ng-repeat="item in records">
						  <a class="thumbnail" href="producto.php?id=<?php echo $id_producto;?>">
							  <span title="Current quantity" class="badge badge-default stock-counter ng-binding"><?php echo number_format($stock,0); ?></span>
							  <span title="Low stock" class="low-stock-alert ng-hide" ng-show="item.current_quantity <= item.low_stock_threshold"><i class="fa fa-exclamation-triangle"></i></span>
							  <!-- ACÁ ESTÁ LA IMAGEN DEL CENTRO --><img  id="img-tam" src="<?php echo $img;?>"  alt="<?php echo $nombre_producto;?>">
						  </a>
						  <span class="thumb-name"><strong><?php echo $nombre_producto;?></strong></span>
						  <span class="thumb-code ng-binding"><?php echo $codigo_producto;?></span><br />
                          <span class="thumb-code ng-binding"><strong><?php echo '$ ' .$precio_producto;?></span></strong>
                          
					</div>
					<?php
					if ($nums%6==0){
						echo "<div class='clearfix'></div>";
					}
					$nums++;
				}
				?>
				<div class="clearfix"></div>
				<div class='row text-center'>
					<div ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></div>
				</div>
                
             <form method="post" action="export_products.php">
     		 <input type="submit" name="export" class="btn btn-success" value="EXPORTAR XLS" />
    		 </form>
			
			<?php
		}
	}
?>
