function ArmarTablaDiasVacaciones( data_set ){
	var html_armado = '';

	var usuarios 						= data_set['usuarios'];


	var usuarios_length			= usuarios.length;



	// Usuarios
	for (var i = 0; i < usuarios_length; i++) {
						html_armado += '<div class="form-group">'
						html_armado +=	'<label>' + usuarios[i]['aniosTrabajados'] + ' años: </label>';
						html_armado +=	'<input type="number" class="form-control" id="diasVacaciones[' + usuarios[i]['aniosTrabajados'] + ']" name="diasVacaciones[' + usuarios[i]['aniosTrabajados'] + ']" value="' + usuarios[i]['diasVacaciones'] + '">';
						html_armado +=	'</div>'
						//html_armado +=	'<input ';				
					//html_armado +=	'id="diasVacaciones[' + usuarios[i]['aniosTrabajados'] + ']" name="diasVacaciones[' + usuarios[i]['aniosTrabajados'] + ']" type="number" step="1" min="0" max="100" maxlength="3" value="' + usuarios[i]['diasVacaciones'] + '">';						
					//html_armado +=	'</input>';
			
	}
	// END Usuarios

	return html_armado;
}


function ArmarTablaDiasVacaciones_Header( ths = null ){
	var html_armado = '';
		html_armado +=	'<table class="table table-bordered table-striped dataTables">';
		html_armado += 		'<thead>';
		html_armado +=			'<tr>';	

		if(ths == null){
			html_armado +=			'<th>AÑOS</th>';
			html_armado +=			'<th class="th_table_opciones" >DIAS</th>';
		}else{
			for (var i = 0; i < ths.length; i++) {
				html_armado +=		'<th';
				html_armado +=  	(ths[i]['width'] != 0) ? ' width="'+ths[i]['width']+'px">' : '>'; 
				html_armado +=		ths[i]['th']+'</th>';
			}
		}

		html_armado +=			'</tr>';
		html_armado +=		'</thead>';
		html_armado +=		'<tbody id="empresas-all">';
	return html_armado;
}

function ArmarTablaDiasVacaciones_Footer( ths = null ){
	var html_armado = '';
		html_armado	+=		'</tbody>';
		html_armado	+=		'<tfoot>';
		html_armado	+=				'<tr>';

		if(ths == null){
			html_armado +=			'<th>AÑOS</th>';
			html_armado +=			'<th class="th_table_opciones" >DIAS</th>';
		}else{
			for (var i = 0; i < ths.length; i++) {
				html_armado +=		'<th';
				html_armado +=  	(ths[i]['width'] != 0) ? ' width="'+ths[i]['width']+'px">' : '>'; 
				html_armado +=		ths[i]['th']+'</th>';
			}
		}

		html_armado	+=				'</tr>';
		html_armado	+=		'</tfoot>';
		html_armado	+=	'</table>';

	return html_armado;
}




var $formDiasVacaciones = $("form[name=formDiasVacaciones]");


var $formNuevaEmpresa = $("form[name=formNuevaEmpresa]");

function LimpiarFormNuevaEmpresa(){
		LimpiarInputs( $formNuevaEmpresa );
		$formNuevaEmpresa.find("#IdPorcentajes").val( '0' );
}


function fnPrincipal(){ ObtenerDiasVacacionesFI(); }


$(document).ready(function(){	
		$formNuevaEmpresa.find('#VM_EN_Alert').fadeOut();

		OnlyNumbers("#diasAguinaldo",						$formNuevaEmpresa);		
		OnlyNumbers("#porcentajePrimaVacacional",						$formNuevaEmpresa);		
		
		fnPrincipal();
		ObtenerParametrosFI();
		
		$formNuevaEmpresa.find("#btnGuardarPorcentajes").on("click", function(e){				
				GuardarPorcentajesFI();
				e.preventDefault();
		});		
		
		$formDiasVacaciones.find("#btnGuardarDiasVacaciones").on("click", function(e){				
				GuardarDiasVacacionesFI();
				e.preventDefault();
		});		
		
});


function GuardarPorcentajesFI(){	
		var urlPHP = "C_ParametrosFI/GuardarParametrosFI/";
		var datos = FormularioData('formNuevaEmpresa');
		$formNuevaEmpresa.find('#btnGuardarPorcentajes').prop('disabled', true);

		if( Validar_VM_EmpresaNueva(  FormularioData('formNuevaEmpresa')  ) ){
				AjaxFunction(urlPHP, datos, function(response){				
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id']		= 'VM_EN_Alert';
						alert_data['alert_class']	= 'alert-success';

						if(	datos['IdPorcentajes'] == 0 ){
								alert_data['txt']	= 'SE HA GUARDADO CORRECTAMENTE';
								// alert('se ha guardado correctamente');
								ObtenerParametrosFI();
						}else{
								alert_data['txt']	= 'SE HA ACTUALIZADO CORRECTAMENTE';
								// alert('Se ha actualizado correctamente');
						}

						alert_data['btn']					= '#btnGuardarPorcentajes';
						Show_Alert( alert_data );

						fnPrincipal();

						if(	datos['IdPorcentajes'] == 0 ){
								$("form[name=formNuevaEmpresa]")[0].reset();
						}

				},function(textStatus){				
						var alert_data = [];
						alert_data['alert_id']		= 'VM_EN_Alert';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						alert_data['btn']					= '#btnGuardarPorcentajes';
						Show_Alert( alert_data );
						console.log(textStatus);
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'VM_EN_Alert';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA ';
				alert_data['btn']					= '#btnGuardarPorcentajes';
				Show_Alert( alert_data );
		}
}


function GuardarDiasVacacionesFI(){	
		var urlPHP = "C_ParametrosFI/GuardarDiasVacacionesFI/";
		var datos = FormularioData('formDiasVacaciones');
		$formDiasVacaciones.find('#btnGuardarDiasVacaciones').prop('disabled', true);
			AjaxFunction(urlPHP, datos, function(response){				
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id']		= 'DV_EN_Alert';
						alert_data['alert_class']	= 'alert-success';
						alert_data['txt']	= 'SE HA GUARDADO CORRECTAMENTE';						
						alert_data['btn']					= '#btnGuardarDiasVacaciones';
						Show_Alert( alert_data );

				},function(textStatus){				
						var alert_data = [];
						alert_data['alert_id']		= 'DV_EN_Alert';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						alert_data['btn']					= '#btnGuardarDiasVacaciones';
						Show_Alert( alert_data );
						console.log(textStatus);
				});		
}


function ObtenerParametrosFI(){		
		var urlPHP = "C_ParametrosFI/ObtenerParametrosFI/";
		var datos = {};		
		AjaxFunction(urlPHP, datos, function(response){			
			LlenarCamposDeFormulario( 'formNuevaEmpresa', response );								
		});		
}



function Validar_VM_EmpresaNueva( datos ){	// console.log( datos );
		//console.log(datos);
		var valido = true;
		var form_error  = '#dd4b39';
		var form_valido = '#d2d6de';


		if( datos['diasAguinaldo'] == '' ||  datos['diasAguinaldo'] == null || datos['diasAguinaldo'] == ' '){
				$formNuevaEmpresa.find('#diasAguinaldo').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#diasAguinaldo').css('border-color', form_valido);
		}
		if(datos['porcentajePrimaVacacional'] == '' || datos['porcentajePrimaVacacional'] == null || datos['porcentajePrimaVacacional'] == ' '){
				$formNuevaEmpresa.find('#porcentajePrimaVacacional').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#porcentajePrimaVacacional').css('border-color', form_valido);
		}

		// console.log(valido);
		return valido;
}



function Validar_VM_DiasVacaciones( datos ){	// console.log( datos );
		//console.log(datos);
		var valido = true;
		var form_error  = '#dd4b39';
		var form_valido = '#d2d6de';


		if( datos['diasVacacionesAnio'] == '' ||  datos['diasVacacionesAnio'] == null || datos['diasVacacionesAnio'] == ' '){
				$formDiasVacaciones.find('#diasVacacionesAnio').css('border-color', form_error);
				valido = false;
		}else{
				$formDiasVacaciones.find('#diasVacacionesAnio').css('border-color', form_valido);
		}	

		// console.log(valido);
		return valido;
}



// Se obtiene del archivo modals/usuarios.js
function ObtenerDiasVacacionesFI( data_set = {} ){
		var urlPHP = "C_ParametrosFI/ObtenerDiasVacacionesFI/";
		var datos = {	};
		
		AjaxFunction(urlPHP, datos, function(response){
			data_set['usuarios'] = response;
		var html_armado = '';
								
								html_armado += ArmarTablaDiasVacaciones( data_set );
								

								$("#box-body").html( html_armado );
							/*	$(".dataTables").DataTable();*///Se quito por que la ordenacion la daba incorrecta.
		});
}	