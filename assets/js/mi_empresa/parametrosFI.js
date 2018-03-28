var $formNuevaEmpresa = $("form[name=formNuevaEmpresa]");

function LimpiarFormNuevaEmpresa(){
		LimpiarInputs( $formNuevaEmpresa );
		$formNuevaEmpresa.find("#Id").val( '0' );
}

$(document).ready(function(){
		$formNuevaEmpresa.find('#VM_EN_Alert').fadeOut();

		OnlyNumbers("#diasaguinaldo",						$formNuevaEmpresa);
		OnlyNumbers("#porcentajevacaciones",						$formNuevaEmpresa);	

		$formNuevaEmpresa.find("#btnGuardarEmpresa").on("click", function(e){
				GuardarEmpresa();
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


		if( datos['diasaguinaldo'] == '' ){
				$formNuevaEmpresa.find('#diasaguinaldo').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#diasaguinaldo').css('border-color', form_valido);
		}
		if( datos['porcentajevacaciones'] == '' ){
				$formNuevaEmpresa.find('#porcentajevacaciones').css('border-color', form_error);
				valido = false;
		}else{
				$formNuevaEmpresa.find('#porcentajevacaciones').css('border-color', form_valido);
		}

		// console.log(valido);
		return valido;
}