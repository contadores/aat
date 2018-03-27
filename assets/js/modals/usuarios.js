var $formNuevoUsuario = $("form[name=formNuevoUsuario]");

function LimpiarFormNuevoUsuario(){
		LimpiarInputs( $formNuevoUsuario );
		$formNuevoUsuario.find("#Id").val( '0' );
}


// Catalogo
function ObtenerCatSexo( IdCatSexo = 0 ){
		var urlPHP = "C_CatElementos/ObtenerCatSexo/";
		var datos = {	};
		
		AjaxFunction(urlPHP, datos, function(response){
				var select_armado = construirSelect( response, 'Sexo', IdCatSexo );
				$formNuevoUsuario.find("#IdCatSexo").html( select_armado );
		});
}
function ObtenerCatTipoUsuario( IdCatTipoUsuario = 0 ){
		var urlPHP = "C_CatElementos/ObtenerCatTipoUsuario/";
		var datos = {	};
		
		AjaxFunction(urlPHP, datos, function(response){
				var select_armado = construirSelect( response, 'Tipo de Usuario', IdCatTipoUsuario );
				$formNuevoUsuario.find("#IdCatTipoUsuario").html( select_armado );
		});
}



$(document).ready(function(){
		$formNuevoUsuario.find('#VM_UN_Alert').fadeOut();

		$formNuevoUsuario.find("#btnGuardarUsuario").on("click", function(e){
				GuardarUsuario();
				e.preventDefault();
		});

		$("#btnNuevoUsuario").on("click", function(e){
				LimpiarFormNuevoUsuario();
				ObtenerCatSexo();
				ObtenerCatTipoUsuario();
				e.preventDefault();
		});
});


function GuardarUsuario(){
		var elementoRestringidos = null;
		var urlPHP = "C_Usuarios/GuardarUsuario/";
		var datos = FormularioData('formNuevoUsuario');
		$formNuevoUsuario.find('#btnGuardarUsuario').prop('disabled', true);

		if( Validar_VM_UsuarioNuevo( datos ) ){
				AjaxFunction(urlPHP, datos, function(response){
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id']		= 'VM_UN_Alert';
						alert_data['alert_class']	= 'alert-success';

						if(	datos['Id'] == 0 ){
								alert_data['txt']	= 'SE HA GUARDADO CORRECTAMENTE';
								// alert('se ha guardado correctamente');
						}else{
								alert_data['txt']	= 'SE HA ACTUALIZADO CORRECTAMENTE';
								// alert('Se ha actualizado correctamente');
						}

						alert_data['btn']					= '#btnGuardarUsuario';
						Show_Alert( alert_data );

						fnPrincipal();

						if(	datos['Id'] == 0 ){
								$("form[name=formNuevoUsuario]")[0].reset();
						}

						// $('#UsuarioNuevo').modal('toggle');
						// console.log('UsuarioNuevo');
				},function(textStatus){
						var alert_data = [];
						alert_data['alert_id']		= 'VM_UN_Alert';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						alert_data['btn']					= '#btnGuardarUsuario';
						Show_Alert( alert_data );
						console.log(textStatus);
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'VM_UN_Alert';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
				alert_data['btn']					= '#btnGuardarUsuario';
				Show_Alert( alert_data );
		}
}
function ObtenerUsuario( Id, form ){
		var urlPHP = "C_Usuarios/ObtenerUsuario/";
		var datos = { 'Id' : Id	};

		AjaxFunction(urlPHP, datos, function(response){
				if(form == 1){
						LlenarCamposDeFormulario( 'formNuevoUsuario', response );
						ObtenerCatSexo( response['IdCatSexo'] );
						ObtenerCatTipoUsuario( response['IdCatTipoUsuario'] );
				} else {
						LlenarListGroup( response );
				}
		});
}



function Validar_VM_UsuarioNuevo( datos ){
		// console.log( datos );
		var valido = true;
		var form_error  = '#dd4b39';
		var form_valido = '#d2d6de';

		if( datos['Nombre'] == '' ){
				$formNuevoUsuario.find("#Nombre").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#Nombre").css('border-color', form_valido);
		}

		if( datos['Ap_pa'] == '' ){
				$formNuevoUsuario.find("#Ap_pa").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#Ap_pa").css('border-color', form_valido);
		}

		if( datos['Ap_ma'] == '' ){
				$formNuevoUsuario.find("#Ap_ma").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#Ap_ma").css('border-color', form_valido);
		}

		if( datos['IdCatSexo'] == null ){
				$formNuevoUsuario.find("#IdCatSexo").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#IdCatSexo").css('border-color', form_valido);
		}

		if( datos['Correo'] == '' ||  !ValidarEmail( $formNuevoUsuario.find('#Correo').val() )  ){
				$formNuevoUsuario.find("#Correo").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#Correo").css('border-color', form_valido);
		}

		if( datos['Password'] == '' ){
				$formNuevoUsuario.find("#Password").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#Password").css('border-color', form_valido);
		}

		if( datos['IdCatTipoUsuario'] == null ){
				$formNuevoUsuario.find("#IdCatTipoUsuario").css('border-color', form_error);
				valido = false;
		}else{
				$formNuevoUsuario.find("#IdCatTipoUsuario").css('border-color', form_valido);
		}

		// console.log(valido);
		return valido;
}