function Validar_GuardarComparativa(){
	if( $("#Titulo").val()	== ''	){ return false; }
	if( $("#Titulo").val()	== null ){ return false; }
	if( $("#Anio").val()	== 0	){ return false; }
	if( $("#Anio").val()	== null ){ return false; }
	if( $("#Mes").val()		== ''	){ return false; }
	if( $("#Mes").val()		== null ){ return false; }
	return true;
}
$(document).ready(function(){
	$("#a_ComparativaMensual").on("click", function(e){
		//alert('a_ComparativaMensual');
		$('#btnGuardarComparativaBimestral').hide();
		e.preventDefault();
	});
	$("#a_ComparativaBimestral").on("click", function(e){
		//alert('a_ComparativaBimestral');
		$('#btnGuardarComparativaMensual').hide();
		e.preventDefault();
	});

	//	VM_EmpresaNuevo				//
	$("#btnGuardarComparativaMensual").on("click", function(e){
		if( Validar_GuardarComparativa() ){
			GuardarComparativaMensual();
			$("#btnGuardarComparativaMensual").prop("disabled", true);
			$("li.guardar_comparativa a").prop("disabled", true);
			$("li.guardar_comparativa a").css("background-color", '#888');
		}
		e.preventDefault();
	});

	$("#btnGuardarComparativaBimestral").on("click", function(e){
		if( Validar_GuardarComparativa() ){
			GuardarComparativaBimestral();
			$("#btnGuardarComparativaBimestral").prop("disabled", true);
			$("li.guardar_comparativa a").prop("disabled", true);
			$("li.guardar_comparativa a").css("background-color", '#888');
		}
		e.preventDefault();
	});


}); /* END $(document).ready */

	function GuardarComparativaMensual(){
		var urlPHP = "GuardarComparativaMensual/";
		var datos = {
			'Titulo' : $("#Titulo").val(),
			'Anio' : $("#Anio").val(),
			'Mes' : $("#Mes").val(),
			'IdRegistroPatronal' : $("#IdRegistroPatronal").val()
		};

		AjaxFunction(urlPHP, datos, function(response){
				var base_url = $('#div-box').attr('value');

				//$("#IdComparativa").val( response );
				//var url = $('#btn_descargar_documento').attr('href');
				$('#btn_descargar_documento').attr('href', base_url + 'C_HistorialComparativas/Generar_ExcelesMensual/' + response );
			
				if(response != 0){
					//console.log(response);
					alert('SE HA GUARDADO CORRECTAMENTE');
					$('#VM_ComparativaNueva').modal('toggle');
				}
		});
	}
	function GuardarComparativaBimestral(){
		var urlPHP = "GuardarComparativaBimestral/";
		var datos = {
			'Titulo' : $("#Titulo").val(),
			'Anio' : $("#Anio").val(),
			'Mes' : $("#Mes").val(),
			'IdRegistroPatronal' : $("#IdRegistroPatronal").val()
		};

		AjaxFunction(urlPHP, datos, function(response){
				var base_url = $('#div-box').attr('value');

				//$("#IdComparativa").val( response );
				//var url = $('#btn_descargar_documento').attr('href');
				$('#btn_descargar_documento').attr('href', base_url + 'C_HistorialComparativas/Generar_ExcelesBimestral/' + response );
				
				if(response != 0){
					//console.log(response);
					alert('SE HA GUARDADO CORRECTAMENTE');
					$('#VM_ComparativaNueva').modal('toggle');
				}
		});
		
	}