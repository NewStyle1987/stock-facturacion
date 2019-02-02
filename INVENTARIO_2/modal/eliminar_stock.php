<form class="form-horizontal"  method="post">
<!-- Modal -->
<div id="remove-stock" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Eliminar Stock</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Cantidad</label>
             <div class="col-sm-6">
              <input list="quantity_remove" min="1" name="quantity_remove" class="form-control" id="list"  required=""  autocomplete="off">
            	              
						<datalist id="quantity_remove">
				 		<option value="1"> 	<option value="2">
      					<option value="3">  <option value="4">
                        <option value="5">  <option value="6">
      					<option value="7">	<option value="8">
                        <option value="9">  <option value="10">
      					<option value="11"> <option value="12">
      					<option value="13">	<option value="14">
                        <option value="15">	<option value="16">
      					<option value="17"> <option value="18">
                        <option value="19"> <option value="20">
                        <option value="21"> <option value="22">
      					<option value="23"> <option value="24">
                        <option value="25"> <option value="26">
      					<option value="27">	<option value="28">
                        <option value="29"> <option value="30">
						</datalist>
            
            
            </div>
          </div>
          <div class="form-group">
            <label for="reference" class="col-sm-2 control-label">Referencia</label>
            <div class="col-sm-6">
              <input type="text" name="reference_remove" class="form-control" id="reference_remove" value="" placeholder="Referencia">
            </div>
          </div>
          
          <div class="form-group">
            <label for="canal" class="col-sm-2 control-label">Canal</label>
            <div class="col-sm-6">
              <input list="canal_remove" name="canal_remove" class="form-control" id="list" maxlength="100" autocomplete="off">
              
						<datalist id="canal_remove">
                        <option value="Mercadolibre">
                        <option value="Local">
				 		<option value="Facebook">
                        <option value="Instagram">
                        <option value="Celu_WhatsApp">
      					<option value="Pedidos_Web">
                        <option value="Otros">
                       	</datalist>
            </div>
          </div>
          
          
          
          <div class="form-group">
            <label for="canal" class="col-sm-2 control-label">Canal</label>
            <div class="col-sm-6">
              <input list="f_pago_remove" name="f_pago_remove" class="form-control" id="list" maxlength="100" autocomplete="off">
              
						<datalist id="f_pago_remove">
                        <option value="MERCADOPAGOS">
                        <option value="DEBITO">
				 		<option value="CREDITO">
                        <option value="CONTADO">
                        <option value="BROU">
      					<option value="ABITAB">
                        <option value="OTROS">
                       	</datalist>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="submit" class="btn btn-primary">Guardar datos</button>
      </div>
    </div>

  </div>
</div>
</form>