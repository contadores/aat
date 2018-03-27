$(document).ready(function(){

	$("#a_ComparativaMensual").on("click", function(e){
		//alert('a_ComparativaMensual');
		var IdComparativa = $('#IdComparativa').val();
		var Action = $('#form_descargar_documento').attr('action');

		$('#form_descargar_documento').attr('action', Action + 'C_HistorialComparativas/Generar_ExcelesMensual/' + IdComparativa );
		$('#form_descargar_documento').submit();

		$('#form_descargar_documento').attr('action', Action);
		e.preventDefault();
	});

	$("#a_ComparativaBimestral").on("click", function(e){
		//alert('a_ComparativaBimestral');
		var IdComparativa = $('#IdComparativa').val();
		var Action = $('#form_descargar_documento').attr('action');

		$('#form_descargar_documento').attr('action', Action + 'C_HistorialComparativas/Generar_ExcelesBimestral/' + IdComparativa );
		$('#form_descargar_documento').submit();

		$('#form_descargar_documento').attr('action', Action);
		e.preventDefault();
	});

//<?= base_url();?>C_Comparativa/Generar_ExcelesMensual
}); /* END $(document).ready */