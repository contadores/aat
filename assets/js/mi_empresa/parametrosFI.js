var $formNuevaEmpresa = $("form[name=formNuevaEmpresa]");

function LimpiarFormNuevaEmpresa(){
		LimpiarInputs( $formNuevaEmpresa );
		$formNuevaEmpresa.find("#Id").val( '0' );
}


// Catalogo
function ObtenerCatEstados( IdCatEstado = 0 ){
		var urlPHP = "C_CatElementos/ObtenerCatEstados/";
		var datos = { };
		
		AjaxFunction(urlPHP, datos, function(response){
				var select_armado = construirSelect( response, 'Estado', IdCatEstado );
				$formNuevaEmpresa.find("#IdCatEstado").html( select_armado );
		});
}
function ObtenerCatMunicipios( IdCatEstado = $("#IdCatEstado").val(), IdCatMunicipio = 0 ){
		var urlPHP = "C_CatElementos/ObtenerCatMunicipios/";
		var datos = {  'Id' : IdCatEstado  };
		
		AjaxFunction(urlPHP, datos, function(response){
				var select_armado = construirSelect( response, 'Municipio', IdCatMunicipio );
				$formNuevaEmpresa.find("#IdCatMunicipio").html( select_armado );
		});
}



$(document).ready(function(){
		$formNuevaEmpresa.find('#VM_EN_Alert').fadeOut();

		OnlyCharactersAndNumbers("#RFC",	$formNuevaEmpresa);
		OnlyNumbers("#Num_ext",						$formNuevaEmpresa);
		OnlyNumbers("#Num_int",						$formNuevaEmpresa);
		OnlyNumbers("#CP",								$formNuevaEmpresa);

		$formNuevaEmpresa.find("#IdCatEstado").change(function(){
				ObtenerCatMunicipios();
		});
		$formNuevaEmpresa.find("#btnGuardarEmpresa").on("click", function(e){
				GuardarEmpresa();
				e.preventDefault();
		});

		$("#btnNuevaEmpresa").on("click", function(e){
				LimpiarFormNuevaEmpresa();
				ObtenerCatEstados();
				ObtenerCatMunicipios();
				e.preventDefault();
		});
});


function GuardarEmpresa(){
		var elementoRestringidos = ['IdCatEstado'];
		var urlPHP = "C_Empresas/GuardarEmpresa/";
		var datos = FormularioData('formNuevaEmpresa', elementoRestringidos);
		$formNuevaEmpresa.find('#btnGuardarEmpresa').prop('disabled', true);

		if( Validar_VM_EmpresaNueva(  FormularioData('formNuevaEmpresa')  ) ){
				AjaxFunction(urlPHP, datos, function(response){
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id']		= 'VM_EN_Alert';
						alert_data['alert_class']	= 'alert-success';

						if(	datos['Id'] == 0 ){
								alert_data['txt']	= 'SE HA GUARDADO CORRECTAMENTE';
								// alert('se ha guardado correctamente');
						}else{
								alert_data['txt']	= 'SE HA ACTUALIZADO CORRECTAMENTE';
								// alert('Se ha actualizado correctamente');
						}

						alert_data['btn']					= '#btnGuardarEmpresa';
						Show_Alert( alert_data );

						fnPrincipal();

						if(	datos['Id'] == 0 ){
								$("form[name=formNuevaEmpresa]")[0].reset();
						}

				},function(textStatus){
						var alert_data = [];
						alert_data['alert_id']		= 'VM_EN_Alert';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						alert_data['btn']					= '#btnGuardarEmpresa';
						Show_Alert( alert_data );
						console.log(textStatus);
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'VM_EN_Alert';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
				alert_data['btn']					= '#btnGuardarEmpresa';
				Show_Alert( alert_data );
		}
}

function ObtenerEmpresa( Id, modal ){
		var urlPHP = "C_Empresas/ObtenerEmpresa/";
		var datos = { 'Id' : Id };
	
		AjaxFunction(urlPHP, datos, function(response){
				if(modal == 1){
						LlenarCamposDeFormulario( 'formNuevaEmpresa', response );
						ObtenerCatEstados( response['IdCatEstado'] );
						ObtenerCatMunicipios( response['IdCatEstado'], response['IdCatMunicipio'] );
				} else {
						LlenarListGroup( response );
				}
		});
		
}



function Validar_VM_EmpresaNueva( datos ){	// console.log( datos );
		//console.log(datos);
		var valido = true;
		var form_error  = '#dd4b39';
		var form_valido = '#d2d6de';


		if( datos['Nombre'] == '' ){
				$formNuevaEmpresa.find('#Nombre').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#Nombre').css('border-color', form_valido);
		}
		if( datos['RFC'] == '' ){
				$formNuevaEmpresa.find('#RFC').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#RFC').css('border-color', form_valido);
		}


		if( datos['IdCatEstado'] == null ){
				$formNuevaEmpresa.find('#IdCatEstado').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#IdCatEstado').css('border-color', form_valido);
		}
		if( datos['IdCatMunicipio'] == null ){
				$formNuevaEmpresa.find('#IdCatMunicipio').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#IdCatMunicipio').css('border-color', form_valido);
		}
		

		if( datos['Colonia'] == '' ){
				$formNuevaEmpresa.find('#Colonia').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#Colonia').css('border-color', form_valido);
		}
		if( datos['Calle'] == '' ){
				$formNuevaEmpresa.find('#Calle').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#Calle').css('border-color', form_valido);
		}
		if( datos['Num_ext'] == '' ){
				$formNuevaEmpresa.find('#Num_ext').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#Num_ext').css('border-color', form_valido);
		}
		if( datos['Num_int'] == '' ){
				$formNuevaEmpresa.find('#Num_int').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#Num_int').css('border-color', form_valido);
		}
		if( datos['CP'] == '' ){
				$formNuevaEmpresa.find('#CP').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#CP').css('border-color', form_valido);
		}

		// console.log(valido);
		return valido;
}