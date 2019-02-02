	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" enctype="multipart/form-data" method="post" id="guardar_producto" name="guardar_producto">
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required maxlength="255" ></textarea>
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
			 
              <div class="form-group">
				<label for="stock" class="col-sm-3 control-label">Stock</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="stock" name="stock" placeholder="stock" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
              
              
              <div class="form-group">
				<label for="categoria" class="col-sm-3 control-label">Categoría</label>
				<div class="col-sm-8">
					<select class='form-control' name='id_categoria' id='id_categoria' required>
						<option value="">Selecciona una categoría</option>
							<?php 
							$query_categoria=mysqli_query($con,"select * from categorias order by nombre_categoria");
							while($rw=mysqli_fetch_array($query_categoria))	{
								?>
							<option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option>			
								<?php
							}
							?>
					</select>					</div>
			  </div>
              
              
              
               <div class="form-group">
				<label for="talle" class="col-sm-3 control-label">Talle</label>
				<div class="col-sm-8">
					<select class='form-control' name='id_talle' id='id_talle' required>
						<option value="">Selecciona un talle</option>
							<?php 
							$query_categoria=mysqli_query($con,"select * from talles order by id_talle");
							while($rw=mysqli_fetch_array($query_categoria))	{
								?>
							<option value="<?php echo $rw['id_talle'];?>"><?php echo $rw['nombre_talle'];?></option>			
								<?php
							}
							?>
					</select>				</div>
			  </div>
              
              <div class="form-group">
				<label for="detalle" class="col-sm-3 control-label">Detalle</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="detalle" name="detalle" placeholder="Detalle del producto" required maxlength="500" ></textarea>
				  
				</div>
			  </div>
              
              <div class="form-group">
				<label for="modelo" class="col-sm-3 control-label">Modelo</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="modelo" name="modelo" placeholder="Modelo del producto" required maxlength="50" ></textarea>
				  
				</div>
			  </div>
              
              <div class="form-group">
				<label for="codigo_barras" class="col-sm-3 control-label">Código de Barras</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="codigo_barras" name="codigo_barras" placeholder="Código del producto" required maxlength="50" ></textarea>
				  
				</div>
			  </div>
              
              
              <div class="form-group">
				<div class="col-sm-8">
					<input type="hidden" id="id_estado" name="id_estado" placeholder="Ingrese un dato adicional" value="1" ></input>
				  
				</div>
			  </div>
			 
             <div class="form-group">
				<label for="img" class="col-sm-3 control-label">Ruta img</label>
				<div class="col-sm-8">
			
					<textarea class="form-control" id="img" name="img" placeholder="Ruta img" required maxlength="500" ></textarea>
				  	
                  	
				</div>
			  </div>
              

             
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>