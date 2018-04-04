function ArmarTablaAdminUsers( data_set ){
	var html_armado = '';

	var usuarios 						= data_set['usuarios'];
	var empresas 						= data_set['empresas'];
	var registrosPatronales = data_set['rp'];

	var usuarios_length			= usuarios.length;
	var empresas_length			= empresas.length;
	var rp_length						= registrosPatronales.length;


	// Usuarios
	for (var i = 0; i < usuarios_length; i++) {
		html_armado +=	'<tr>';
			html_armado +=	'<td>';
				html_armado +=	'<div class="panel-heading">';
					
					html_armado +=	'<h3 class="panel-title panel-contenido" data-toggle="collapse" href=".empresas_collapse' + usuarios[i]['Id'] + '">';
						html_armado +=	'<span class="badge span_user">';
							html_armado +=	'<i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;'+ usuarios[i]['TipoUsuario'];
						html_armado +=	'</span>' + '&nbsp;&nbsp;';
						html_armado +=	usuarios[i]['Nombre'] + '&nbsp;&nbsp;';
						html_armado +=	'<b>['+ usuarios[i]['nEmpresas'] +']</b>';
					html_armado +=	'</h3>';
															
				html_armado +=	'</div>';
				html_armado +=	'<div id="empresas_collapse' + usuarios[i]['Id'] + '" class="panel-collapse collapse   empresas_collapse' + usuarios[i]['Id'] + '">';
					// END Usuarios

					// Empresas
					var noEmpresa = true;
					for (var j = 0; j < empresas_length; j++) {
						if( empresas[j]['IdUsuario'] == usuarios[i]['Id']  ){

							html_armado +=	'<div class="panel-footer">';
								html_armado +=	'<div class="panel-contenido" data-toggle="collapse" href=".rp_collapse' + empresas[j]['Id'] + '">';
									html_armado +=	'<span class="badge span_empresa">';
										html_armado +=	'<i class="fa fa-cubes"></i> &nbsp;&nbsp;' + 'Empresa';
									html_armado +=	'</span>' + '&nbsp;&nbsp;';
									html_armado +=	empresas[j]['Nombre'] + '&nbsp;&nbsp;';
									html_armado +=	'<b>['+ empresas[j]['nRP'] +']</b>';
								html_armado +=	'</div>';
							html_armado +=	'</div>';

							html_armado +=	'<div id="rp_collapse' + empresas[j]['Id'] + '" class="panel-collapse collapse   rp_collapse' + empresas[j]['Id'] + '">';
								// END Empresas

								// RP
								var noRP = true;
								for (var k = 0; k < rp_length; k++) {
									if( registrosPatronales[k]['IdEmpresa'] == empresas[j]['Id'] ){
										html_armado +=	'<div class="panel-footer">';
											html_armado +=	'<span class="badge span_rp">';
												html_armado +=	'&nbsp;';
												html_armado +=	'<i class="fa fa-chevron-right"></i> &nbsp;&nbsp;'+ 'RP';
												html_armado +=	'&nbsp;';
											html_armado +=	'</span>' + '&nbsp;&nbsp;';
											html_armado +=	registrosPatronales[k]['RP'];
										html_armado +=	'</div>';
										noRP = false;
									}
								}
								if( noRP ){
									html_armado +=	'<div class="panel-footer">';
									html_armado +=		'Sin Registros Patronales';
									html_armado +=	'</div>';
								}
								noRP = true;
								// END RP

								// Empresas
							html_armado +=	'</div>';
							noEmpresa = false;
						}
					}
					if( noEmpresa ){
							html_armado +=	'<div class="panel-footer">';
							html_armado +=		'Sin Empresas';
							html_armado +=	'</div>';
					}
					noEmpresa = true;
					// END Empresas

					// Usuarios
				html_armado +=	'</div>';

				
			html_armado +=	'</td>';

			html_armado +=	'<td>';
				html_armado +=	'<div class="panel-heading panel-botones text-center">';
					html_armado +=	'<button ';
					if(usuarios[i]['TipoUsuario'] == 'Admin'){	html_armado += 'disabled'; }
					html_armado +=	' type="button" onclick="Relacion_UsuarioEmpresa(' + usuarios[i]['Id'] + ');" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Relacion_UsuarioEmpresa" value="' + usuarios[i]['Id'] + '">';
						html_armado +=	'<i class="fa fa-plus"></i>';
					html_armado +=	'</button>';

					html_armado +=	'<button type="button" onclick="ObtenerUsuario(this.value, 0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#UsuarioDetalles" value="' + usuarios[i]['Id'] + '">';
						html_armado +=	'<i class="fa fa-clone"></i>';
					html_armado +=	'</button>';

					html_armado +=	'<button type="button" onclick="ObtenerUsuario(this.value, 1);" class="btn btn-default btn-sm" data-toggle="modal" data-target="#UsuarioNuevo" value="' + usuarios[i]['Id'] + '">';
						html_armado +=	'<i class="fa fa-pencil-square-o"></i>';
					html_armado +=	'</button>';

					html_armado +=	'<button type="button" onclick="EliminarUsuario(this.value);" class="btn btn-danger btn-sm" value="' + usuarios[i]['Id'] + '"   data-toggle="modal" data-target="#VM_Confirm">';
						html_armado +=	'<i class="fa fa-close"></i>';
					html_armado +=	'</button>';
				html_armado +=	'</div>';

				// ///// AQUI
				// html_armado +=	'<div id="empresas_collapse' + usuarios[i]['Id'] + '" class="panel-collapse collapse   empresas_collapse' + usuarios[i]['Id'] + '">';
				// 		html_armado +=	'<div class="panel-footer">';
				// 		html_armado +=			'&nbsp;';
				// 		html_armado +=	'</div>';
				// html_armado +=	'</div>';
				// ///// AQUI

			html_armado +=	'</td>';
		html_armado += '</tr>';
	}
	// END Usuarios

	return html_armado;
}


function fnPrincipal(){ ObtenerUsuarios(); }

$(document).ready(function(){
		$('#VU_Alert').fadeOut();
		// $('#VU_Alert').css('display', 'none');
		fnPrincipal();
}); /* END $(document).ready */

// Se obtiene del archivo modals/usuarios.js
function ObtenerUsuarios( data_set = {} ){
		var urlPHP = "C_Usuarios/ObtenerUsuarios/";
		var datos = {	};
		
		AjaxFunction(urlPHP, datos, function(response){
			data_set['usuarios'] = response;
			ObtenerEmpresas( data_set );
		});
}
		function ObtenerEmpresas( data_set = {} ){
				var urlPHP = "C_Empresas/ObtenerEmpresas/";
				var datos = {	};
				
				AjaxFunction(urlPHP, datos, function(response){
					data_set['empresas'] = response;
					ObtenerRegistrosPatronales( data_set );
				});
		}
				function ObtenerRegistrosPatronales( data_set = {} ){
						var urlPHP = "C_RegistrosPatronales/ObtenerRegistrosPatronales/";
						var datos = {	};
						
						AjaxFunction(urlPHP, datos, function(response){
								data_set['rp'] = response;
								var html_armado = '';
								html_armado += ArmarTablaAdminUsers_Header( data_set['ths'] );
								html_armado += ArmarTablaAdminUsers( data_set );
								html_armado += ArmarTablaAdminUsers_Footer( data_set['ths'] );

								$("#box-body").html( html_armado );
								$(".dataTables").DataTable();
						});
				}

function EliminarUsuario( Id ){
		var titulo = "¿DESEA ELIMINAR EL USUARIO?";
		var comentario = "DICHA ACCIÓN QUITARA LA RELACIÓN ENTRE DE DICHO USUARIO Y LAS EMPRESAS PREVIAMENTE RELACIONADAS";
		var funcionEliminar = function(){
				var urlPHP = "C_Usuarios/EliminarUsuario/";
				var datos = { 'Id' : Id };

				AjaxFunction(urlPHP, datos, function(response){
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id'] = 'VU_Alert';

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