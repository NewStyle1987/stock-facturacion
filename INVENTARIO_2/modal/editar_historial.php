	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar historial</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_historial" name="editar_historial">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nota" class="col-sm-3 control-label">Nota</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nota" name="mod_nota"  required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   
			  
			 
			  <div class="form-group">
				<label for="mod_referencia" class="col-sm-3 control-label">Referencia</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="mod_referencia" name="mod_referencia" ></textarea>
				</div>
			  </div>
              
              <div class="form-group">
				<label for="#mod_cantidad" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="#mod_cantidad" name="#mod_cantidad" ></textarea>
				</div>
			  </div>
              
              <div class="form-group">
				<label for="mod_canal" class="col-sm-3 control-label">Canal</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="mod_canala" name="mod_canal" ></textarea>
				</div>
			  </div>
              
              <div class="form-group">
				<label for="mod_f_pago" class="col-sm-3 control-label">Forma de Pago</label>
				<div class="col-sm-8">
				  <textarea class="form-control" id="mod_f_pago" name="mod_f_pago" ></textarea>
				</div>
			  </div>
              
             
			 
			 
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>