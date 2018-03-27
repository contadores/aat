function ArmarTablaAdminUsers( data_set ){
	var html_armado = '';

	var empresas 						= data_set['empresas'];
	var registrosPatronales = data_set['rp'];

	var empresas_length			= empresas.length;
	var rp_length						= registrosPatronales.length;


					// empresas
	for (var i = 0; i < empresas_length; i++) {
		html_armado +=	'<tr>';
			html_armado +=	'<td>';
				html_armado +=	'<div class="panel-heading">';
					html_armado +=	'<h3 class="panel-title panel-contenido" data-toggle="collapse" href=".rp_collapse' + empresas[i]['Id'] + '">';
						html_armado +=	'<span class="badge span_empresa">';
						html_armado +=		'<i class="fa fa-cubes"></i> &nbsp;&nbsp;' + 'Empresa';
						html_armado +=	'</span>' + '&nbsp;&nbsp;';
						html_armado +=	empresas[i]['Nombre'] + '&nbsp;&nbsp;';
						html_armado +=	'<b>['+ empresas[i]['nRP'] +']</b>';
					html_armado +=	'</h3>';
				html_armado +=	'</div>';

				html_armado +=	'<div id="rp_collapse' + empresas[i]['Id'] + '" class="panel-collapse collapse   rp_collapse' + empresas[i]['Id'] + '">';
					// END empresas

					// registrosPatronales
					var noRP = true;

					for (var j = 0; j < rp_length; j++) {
						if( registrosPatronales[j]['IdEmpresa'] == empresas[i]['Id']  ){
							html_armado +=	'<div class="panel-footer">';

								html_armado +=	'<div class="panel-contenido">';
									html_armado +=	'<span class="badge span_rp">';
									html_armado +=		'&nbsp;';
									html_armado +=		'<i class="fa fa-chevron-right"></i> &nbsp;&nbsp;'+ 'RP';
									html_armado +=		'&nbsp;';
									html_armado +=	'</span>' + '&nbsp;&nbsp;';
									html_armado +=	registrosPatronales[j]['RP'];
								html_armado +=	'</div>';
							html_armado +=	'</div>';
							noRP = false;
						}
					}
					if( noRP ){
							html_armado +=	'<div class="panel-footer">';
							html_armado +=			'Sin Registros Patronales';
							html_armado +=	'</div>';
					}
					// noRP = true;
					// END registrosPatronales

					// empresas
				html_armado +=	'</div>';
			html_armado +=	'</td>';

			html_armado +=	'<td>';
				html_armado +=	'<div class="panel-heading panel-botones text-center">';
					html_armado +=	'<button type="button" onclick="SetIdEmpresa(this.value);" class="btn btn-success btn-sm" data-toggle="modal" data-target="#RegistroPatronalNuevo" value="' + empresas[i]['Id'] + '">';
					html_armado +=		'<i class="fa fa-plus"></i>';
					html_armado +=	'</button>';

					html_armado +=	'<button type="button" onclick="ObtenerEmpresa(this.value, 0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#EmpresaDetalles" value="' + empresas[i]['Id'] + '">';
					html_armado +=		'<i class="fa fa-clone"></i>';
					html_armado +=	'</button>';

					html_armado +=	'<button type="button" onclick="ObtenerEmpresa(this.value, 1);" class="btn btn-default btn-sm" data-toggle="modal" data-target="#EmpresaNuevo" value="' + empresas[i]['Id'] + '">';
					html_armado +=		'<i class="fa fa-pencil-square-o"></i>';
					html_armado +=	'</button>';

					html_armado +=	'<button type="button" onclick="EliminarEmpresa(this.value);" class="btn btn-danger btn-sm" value="' + empresas[i]['Id'] + '"   data-toggle="modal" data-target="#VM_Confirm">';
					html_armado +=		'<i class="fa fa-close"></i>';
					html_armado +=	'</button>';
				html_armado +=	'</div>';


				html_armado +=	'<div id="rp_collapse' + empresas[i]['Id'] + '" class="panel-collapse collapse   rp_collapse' + empresas[i]['Id'] + '">';
					for (var j = 0; j < rp_length; j++) {
						if( registrosPatronales[j]['IdEmpresa'] == empresas[i]['Id']  ){
							html_armado +=	'<div class="panel-footer panel-botones">';

									html_armado +=	'<button type="button" onclick="ObtenerRegistroPatronal(this.value, 0);"	class="btn btn-primary btn-sm"	data-toggle="modal" data-target="#RegistroPatronalDetalles" value="' + registrosPatronales[j]['Id'] + '">';
									html_armado +=		'<i class="fa fa-clone"></i>';
									html_armado +=	'</button>';
									html_armado +=	'&nbsp;';

									html_armado +=	'<button type="button" onclick="ObtenerRegistroPatronal(this.value, 1);"	class="btn btn-default btn-sm"	data-toggle="modal" data-target="#RegistroPatronalNuevo" value="' + registrosPatronales[j]['Id'] + '">';
									html_armado +=		'<i class="fa fa-pencil-square-o"></i>';
									html_armado +=	'</button>';
									html_armado +=	'&nbsp;';

									html_armado +=	'<button type="button" onclick="EliminarRegistroPatronal(this.value);"		class="btn btn-danger btn-sm"  value="' + registrosPatronales[j]['Id'] + '"   data-toggle="modal" data-target="#VM_Confirm">';
									html_armado +=		'<i class="fa fa-close"></i>';
									html_armado +=	'</button>';

							html_armado +=	'</div>';
							noRP = false;
						}
					}
					if( noRP ){
							html_armado +=	'<div class="panel-footer">';
							html_armado +=			'&nbsp;';
							html_armado +=	'</div>';
					}
					noRP = true;
				html_armado +=	'</div>';

			html_armado += 	'</td>';
		html_armado += '</tr>';
	}
	// END empresas

	return html_armado;
}
function fnPrincipal(){	ObtenerEmpresas(); }

$(document).ready(function(){
		$('#VE_Alert').fadeOut();
		fnPrincipal();
}); /* END $(document).ready */

function ObtenerEmpresas( data_set = {} ){
		var urlPHP = "C_Empresas/ObtenerEmpresas/";
		var datos = {	};
		
		AjaxFunction(urlPHP, datos, function(response){
				//console.log(response);
				data_set['empresas'] = response;

				ObtenerRegistrosPatronales( data_set );
		});
}
function ObtenerRegistrosPatronales( data_set = {} ){
		var urlPHP = "C_RegistrosPatronales/ObtenerRegistrosPatronales/";
		var datos = {	};
		
		AjaxFunction(urlPHP, datos, function(response){
			//console.log(response);
			data_set['rp'] = response;
			
			var html_armado = '';
			html_armado += ArmarTablaAdminUsers_Header( data_set['ths'] );
			html_armado += ArmarTablaAdminUsers( data_set );
			html_armado += ArmarTablaAdminUsers_Footer( data_set['ths'] );

			$("#box-body").html( html_armado );
			$(".dataTables").DataTable();
		});
}

function EliminarEmpresa( Id ){
		var titulo = "¿DESEA ELIMINAR LA EMPRESA?";
		var comentario = "DICHA ACCIÓN BORRARA LOS REGISTROS PATRONALES DE LA EMPRESA SELECCIONADA";
		var funcionEliminar = function(){
				var urlPHP = "C_Empresas/EliminarEmpresa/";
				var datos = {	
					'Id' : Id
				};
				
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