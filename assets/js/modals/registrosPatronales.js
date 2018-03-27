var $formNuevoRP = $("form[name=formNuevoRegistroPatronal]");

function SetIdEmpresa( IdEmpresa ){
		LimpiarFormNuevoRegistroPatronal();
		$formNuevoRP.find("#IdEmpresa").val( IdEmpresa );
		ObtenerCatEstados_RP();
		ObtenerCatMunicipios_RP();
}
function LimpiarFormNuevoRegistroPatronal(){
		// console.log('LimpiarFormNuevoRegistroPatronal');
		LimpiarInputs( $formNuevoRP );
		$formNuevoRP.find("#Id").val( '0' );
}


// Catalogo
function ObtenerCatEstados_RP( IdCatEstado = 0 ){
		// console.log('ObtenerCatEstados2');
		var urlPHP = "C_CatElementos/ObtenerCatEstados/";
		var datos = { };
		
		AjaxFunction(urlPHP, datos, function(response){
				var select_armado = construirSelect( response, 'Estado', IdCatEstado );
				$formNuevoRP.find("#IdCatEstado2").html( select_armado );
		});
}
function ObtenerCatMunicipios_RP( IdCatEstado = $("#IdCatEstado2").val(), IdCatMunicipio = 0 ){
		// console.log('ObtenerCatMunicipios2');
		var urlPHP = "C_CatElementos/ObtenerCatMunicipios/";
		var datos = {  'Id' : IdCatEstado  };
		
		AjaxFunction(urlPHP, datos, function(response){
				var select_armado = construirSelect( response, 'Municipio', IdCatMunicipio );
				$formNuevoRP.find("#IdCatMunicipio2").html( select_armado );
		});
}



$(document).ready(function(){
		$formNuevoRP.find('#VM_RP').fadeOut();

		OnlyCharactersAndNumbers("#RFC",	$formNuevoRP );
		OnlyNumbers( "#Num_ext",					$formNuevoRP );
		OnlyNumbers( "#Num_int",					$formNuevoRP );
		OnlyNumbers( "#CP",								$formNuevoRP );

		$formNuevoRP.find("#IdCatEstado2").change(function(){
				ObtenerCatMunicipios_RP();
		});
		$formNuevoRP.find("#btnGuardarRegistroPatronal").on("click", function(e){
				GuardarRegistroPatronal();
				e.preventDefault();
		});
});


function GuardarRegistroPatronal(){
		// console.log('GuardarRegistroPatronal');
		var elementoRestringidos = ['IdCatEstado'];
		var urlPHP = "C_RegistrosPatronales/GuardarRegistroPatronal/";
		var datos = FormularioData('formNuevoRegistroPatronal', elementoRestringidos);
		$formNuevoRP.find('#btnGuardarRegistroPatronal').prop('disabled', true);

		datos['IdCatMunicipio']	= datos['IdCatMunicipio2'];

		delete datos['IdCatEstado2'];
		delete datos['IdCatMunicipio2'];
		//console.log(datos);
		
		//if( Validar_VM_EmpresaNueva(  FormularioData('formNuevaEmpresa')  ) ){
		if( Validar_RP(  FormularioData('formNuevoRegistroPatronal')  ) ){
				AjaxFunction(urlPHP, datos, function(response){
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id']		= 'VM_RP';
						alert_data['alert_class']	= 'alert-success';

						if(	datos['Id'] == 0 ){
								alert_data['txt']	= 'SE HA GUARDADO CORRECTAMENTE';
						}else{
								alert_data['txt']	= 'SE HA ACTUALIZADO CORRECTAMENTE';
						}

						alert_data['btn']					= '#btnGuardarRegistroPatronal';
						Show_Alert( alert_data );

						fnPrincipal();

						if(	datos['Id'] == 0 ){
								$formNuevoRP[0].reset();
						}

				},function(textStatus){
						var alert_data = [];
						alert_data['alert_id']		= 'VM_RP';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						alert_data['btn']					= '#btnGuardarRegistroPatronal';
						Show_Alert( alert_data );
						console.log(textStatus);
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'VM_RP';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
				alert_data['btn']					= '#btnGuardarRegistroPatronal';
				Show_Alert( alert_data );
		}
}

function ObtenerRegistroPatronal( Id, modal ){
		//console.log(modal 0 / 1);
		var urlPHP = "C_RegistrosPatronales/ObtenerRegistroPatronal/";
		var datos = {	 'Id' : Id  };
	
		AjaxFunction(urlPHP, datos, function(response){

				if(modal == 1){
						LlenarCamposDeFormulario( 'formNuevoRegistroPatronal', response );
						ObtenerCatEstados_RP( response['IdCatEstado'] );
						ObtenerCatMunicipios_RP( response['IdCatEstado'], response['IdCatMunicipio'] );
				} else {
						LlenarListGroup( response );
				}
		});
}

function EliminarRegistroPatronal( Id ){
		var titulo = "¿DESEA ELIMINAR EL REGISTRO PATRONAL?";
		var comentario = "<br>";
		var funcionEliminar = function(){
				var urlPHP = "C_RegistrosPatronales/EliminarRegistroPatronal/";
				var datos = { 'Id' : Id };
				
				AjaxFunction(urlPHP, datos, function(response){
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id'] = 'VE_Alert';

						if (response){
								alert_data['alert_class']	= 'alert-success';
								alert_data['txt']					= '<b>ELIMINADO CORRECTAMENTE</b>';
						}else{
								alert_data['alert_class']	= 'alert-danger';
								alert_data['txt']					= '<b>HA OCURRIDO UN PROBLEMA</b>';
						}
						alert_data['btn']			 = '';
						Show_Alert( alert_data );

						fnPrincipal();
				});
		};

		Modal_Confirm( titulo, comentario, funcionEliminar );
}



function Validar_RP( datos ){	// console.log( datos );
		// console.log(datos);
		var valido = true;
		var form_error  = '#dd4b39';
		var form_valido = '#d2d6de';


		if( datos['RP'] == "" ){
				$formNuevoRP.find('#RP').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#RP').css('border-color', form_valido);
		}
		if( datos['IdCatEstado2'] == null ){
				$formNuevoRP.find('#IdCatEstado2').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#IdCatEstado2').css('border-color', form_valido);
		}
		if( datos['IdCatMunicipio2'] == null ){
				$formNuevoRP.find('#IdCatMunicipio2').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#IdCatMunicipio2').css('border-color', form_valido);
		}


		if( datos['Colonia'] == "" ){
				$formNuevoRP.find('#Colonia').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#Colonia').css('border-color', form_valido);
		}
		if( datos['Calle'] == "" ){
				$formNuevoRP.find('#Calle').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#Calle').css('border-color', form_valido);
		}


		if( datos['Num_ext'] == "" ){
				$formNuevoRP.find('#Num_ext').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#Num_ext').css('border-color', form_valido);
		}
		if( datos['Num_int'] == "" ){
				$formNuevoRP.find('#Num_int').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#Num_int').css('border-color', form_valido);
		}
		if( datos['CP'] == "" ){
				$formNuevoRP.find('#CP').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoRP.find('#CP').css('border-color', form_valido);
		}

		// console.log(valido);
		return valido;
}