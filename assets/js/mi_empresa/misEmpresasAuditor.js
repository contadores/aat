function ArmarTablaAdminUsers( data_set ){
	var html_armado = '';

	var empresas 						= data_set['empresas'];
	var registrosPatronales = data_set['rp'];

					// empresas
	for (var i = 0; i < empresas.length; i++) {
		html_armado += '<tr>';
			html_armado += 	'<td>';
				html_armado +=	'<div class="panel-heading" data-toggle="collapse" href=".rp_collapse' + empresas[i]['Id'] + '">';
					html_armado +=		'<h3 class="panel-title panel-contenido">';

					html_armado +=				'<span class="badge span_empresa">';
					html_armado += 					'<i class="fa fa-cubes"></i> &nbsp;&nbsp;' + 'Empresa';
					html_armado +=				'</span>' + '&nbsp;&nbsp;';
					html_armado +=				empresas[i]['Nombre'] + '&nbsp;&nbsp;';
					html_armado +=				'<b>['+ empresas[i]['nRP'] +']</b>';
					// html_armado += 			'<i class="fa fa-cubes"></i> &nbsp;&nbsp;';
					// html_armado +=			empresas[i]['Nombre'];
					html_armado +=		'</h3>';
					
				html_armado +=	'</div>';				
				html_armado +=	'<div id="rp_collapse' + empresas[i]['Id'] + '" class="panel-collapse collapse  rp_collapse'+empresas[i]['Id']+'">';
					// END empresas

					// registrosPatronales
					var noRP = true;

					for (var j = 0; j < registrosPatronales.length; j++) {
						if( registrosPatronales[j]['IdEmpresa'] == empresas[i]['Id']  ){
							html_armado +=	'<div class="panel-footer">';
								html_armado +=	'<div class="panel-contenido">';
								html_armado +=		'<span class="badge span_rp">';
								html_armado +=			'&nbsp;';
								html_armado +=			'<i class="fa fa-chevron-right"></i> &nbsp;&nbsp;'+ 'RP';
								html_armado +=			'&nbsp;';
								html_armado +=			'</span>' + '&nbsp;&nbsp;';
								html_armado +=			registrosPatronales[j]['RP'];
								html_armado +=	'</div>';
							html_armado +=	'</div>';
							noRP = false;
						}
					}
					if( noRP ){
						html_armado +=		'<div class="panel-footer">';
						html_armado +=				'Sin Registros Patronales';
						html_armado +=		'</div>';
					}
					// noRP = true;
					// END registrosPatronales

					// empresas
				html_armado +=	'</div>';
			html_armado += 	'</td>';

			html_armado += 	'<td>';
			
				html_armado +=	'<div class="panel-footer panel-botones">';

							html_armado +=		'<button type="button" value="' + empresas[i]['Id'] + '" ';
							if( $("#IdEmpresa").val() == empresas[i]['Id']){
									html_armado +=	'class="btn btn-xs btn-block btn-default" onclick="">';
									html_armado +=		'<i class="fa fa-check"></i>';
									html_armado +=		'&nbsp;&nbsp;';
									html_armado +=		'SELECCIONADO';
							}else{
									html_armado +=	'class="btn btn-xs btn-block btn-success" onclick="ObtenerIdEmpresa(this.value);">';
									html_armado +=		'<i class="fa fa-arrow-right"></i>';
									html_armado +=		'&nbsp;&nbsp;';
									html_armado +=		'SELECCIONAR';
							}
							
							html_armado +=		'</button>';
					html_armado +=	'</div>';
			html_armado += 	'</td>';
		html_armado += '</tr>';
	}
	// END empresas

	return html_armado;
}

function fnPrincipal(){
	ObtenerMisEmpresas();
}

$(document).ready(function(){
	//	V_Usuarios				//
	$("#btnNuevaEmpresa").on("click", function(e){
		e.preventDefault();
	});

	
	fnPrincipal();
}); /* END $(document).ready */

function ObtenerIdEmpresa( IdEmpresa ){
	$("#CambiarEmpresasAuditor").val( IdEmpresa );
	$('#formCambiarEmpresasAuditor').submit();	
}


// Se obtiene del archivo modals/empresas.js
function ObtenerMisEmpresas( data_set = {} ){
	var urlPHP = "C_Empresas/ObtenerEmpresas/";
	var datos = {	};

	AjaxFunction(urlPHP, datos, function(response){
		//console.log(response);
		data_set['empresas'] = response;
		data_set['ths'] = [ 
												{'th' : 'NOMBRE', 'width' : '0' }, 
												{'th' : 'OPCIONES', 'width' : '100px'}
											];
		console.log(data_set);
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