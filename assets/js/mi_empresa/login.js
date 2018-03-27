function IniciarSession(){
		var urlPHP = "C_Usuarios/ObtenerUsuario_Logueado/";
		var datos = {
				"Correo"		:	$('#Correo').val(),
				"Password"	:	$('#Password').val()
		};


		AjaxFunction(urlPHP, datos, function(response){
				//console.log(response);
				if( response != false ){
						$("#IdUsuario").val(				response['IdUsuario']					);
						$("#IdCatTipoUsuario").val( response['IdCatTipoUsuario']	);
						$("#Nombre").val(						response['Nombre']						);

						switch ( response['IdCatTipoUsuario'] ) {
								// Administrador
								case '1':
									$('#formLogin').attr('action', 'C_Usuarios' );
									$('#formLogin').submit();
								break;

								// Auditor
								case '2':
									$('#formLogin').attr('action', 'C_Auditores' );
									$('#formLogin').submit();
								break;

								// Común
								case '3':
									$('#formLogin').attr('action', 'C_MisEmpresas' );
									$('#formLogin').submit();
								break;
						}

				}else{
					alert('USUARIO NO ENCONTRADO');
				}
			
		});
}

$(document).ready(function(){
	$('#Correo').val('');
	$('#Password').val('');
	$('#Correo').focus();

	$("#IniciarSession").on("click", function(e){
			IniciarSession();
	});

	$('#Correo').keyup(function(e){
			if(e.keyCode == 13){
					IniciarSession();
			}
	});

	$('#Password').keyup(function(e){
			if(e.keyCode == 13){
					IniciarSession();
			}
	});

}); /* END $(document).ready */