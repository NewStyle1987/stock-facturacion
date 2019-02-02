		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_historial.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	
		
	function eliminar (id)
		{
		var q= $("#q").val();
		if (confirm("¿Realmente deseas eliminar el historial?")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_historial.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}
		
		
	
$( "#guardar_historial" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_historial.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_historial" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_historial.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	
	$('#myModal3').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var nota = button.data('nota') 
	  var referencia = button.data('referencia') 
	  var cantidad = button.data('cantidad') 
	  var canal = button.data('canal') 
	  var f_pago = button.data('f_pago') 
	  var id = button.data('id') 
	  var modal = $(this)
	  modal.find('.modal-body #mod_nota').val(nota)
	  modal.find('.modal-body #mod_referencia').val(referencia) 
	  modal.find('.modal-body #mod_cantidad').val(cantidad)
	  modal.find('.modal-body #mod_canal').val(canal)
	  modal.find('.modal-body #mod_f_pago').val(f_pago)
	  modal.find('.modal-body #mod_id').val(id)
	})
		

