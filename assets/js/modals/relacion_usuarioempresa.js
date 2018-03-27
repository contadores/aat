function Obtener_Mis_Empresas( IdUsuario ){
		$("#btnGuardarRelacion_UsuarioEmpresa").val( IdUsuario )

		var urlPHP = "C_Usuarios/Obtener_Mis_Empresas/";
		var datos = {  'IdUsuario' : IdUsuario  };
		
		AjaxFunction(urlPHP, datos, function(response){
				var table_armado = construirTableBody( response, 1 );
				$("#empresas_agregadas").html( table_armado );
		});
}
function Obtener_Empresas_Registradas( IdUsuario ){
		var urlPHP = "C_Usuarios/Obtener_Empresas_Registradas/";
		var datos = {  'IdUsuario' : IdUsuario  };
		
		AjaxFunction(urlPHP, datos, function(response){
				var table_armado = construirTableBody( response, 2 );
				$("#empresas_registradas").html( table_armado );
		});
}
function Relacion_UsuarioEmpresa( IdUsuario ){
		$('#RUE_Alert').fadeOut();
		Obtener_Mis_Empresas( IdUsuario );
		Obtener_Empresas_Registradas( IdUsuario );
}

$(document).ready(function(){
		$('#RUE_Alert').fadeOut();
		$("#btnGuardarRelacion_UsuarioEmpresa").on("click", function(e){
				var IdUsuario = $("#btnGuardarRelacion_UsuarioEmpresa").val();
				GuardarRelacion_UsuarioEmpresa( IdUsuario );
				e.preventDefault();
		});
});

function Remover_Empresa( IdEmpresa ){
		IdEmpresa  = 'VM_RUE_' + IdEmpresa;

		var tr_copiado =	'<tr id="' + IdEmpresa + '" value="1">';
				tr_copiado += 	$('#' + IdEmpresa).html();
				tr_copiado += '</tr>';
				// console.log( tr_copiado );

				tr_copiado = tr_copiado.replace('btn-danger',				'btn-success');
				tr_copiado = tr_copiado.replace('fa-arrow-right',		'fa-arrow-left');
				tr_copiado = tr_copiado.replace('Remover_Empresa',	'Agregar_Empresa');
				// console.log( tr_copiado );

		$('#' + IdEmpresa).remove();
		$("#empresas_registradas").prepend( tr_copiado	);
}
function Agregar_Empresa( IdEmpresa ){
		IdEmpresa	 = 'VM_RUE_' + IdEmpresa;

		var tr_copiado =	'<tr id="' + IdEmpresa + '" value="1">';
				tr_copiado += 	$('#' + IdEmpresa).html();
				tr_copiado += '</tr>';
				// console.log( tr_copiado );

				tr_copiado = tr_copiado.replace('btn-success',			'btn-danger');
				tr_copiado = tr_copiado.replace('fa-arrow-left',		'fa-arrow-right');
				tr_copiado = tr_copiado.replace('Agregar_Empresa',	'Remover_Empresa');
				// console.log( tr_copiado );

		$('#' + IdEmpresa).remove();
		$("#empresas_agregadas").prepend( tr_copiado	);
}
function construirTableBody( data_set, version ){
		var data_set_length = data_set.length;
		var table = '';

		var btnClass = ( version == 1 ) ? 'btn-danger' : 'btn-success';
		var arrow		 = ( version == 1 ) ? 'fa-arrow-right' : 'fa-arrow-left';
		var evento	 = ( version == 1 ) ? 'Remover_Empresa' : 'Agregar_Empresa';

		for(var i = 0; i < data_set_length; i++){
				table += '<tr id="VM_RUE_' + data_set[i]['IdEmpresa'] + '" value="0">';
				table +=	'<td>' + data_set[i]['Empresa'] + '</td>';
				table +=	'<td>';
				table +=		'<button type="button" class="btn ' + btnClass + ' btn-block"';
				table +=			( data_set[i]['Mover'] == 0 ) ? ' disabled ' : '';
				table +=			'onclick="' + evento + '(';
				table +=					data_set[i]['IdEmpresa'];
				table +=			');"';
				table +=		'>';
				table +=			'<i class="fa ' + arrow + '" aria-hidden="true"></i>';
				table +=		'</button>';
				table +=	'</td>';
				table += '</tr>';
		}

		return table;
}

function GuardarRelacion_UsuarioEmpresa( IdUsuario ){
		var agregadas_dt		=	$("#empresas_agregadas");
		var registradas_dt	= $("#empresas_registradas");
		var tr_modificados	=	[]; //new Object(); // creamos un objeto

		// console.log('agregadas_dt');
		agregadas_dt.find("tr").each(function() {
				if( $(this).attr('value') == 1 ){
						var idEmpresa = $(this).attr('id').replace('VM_RUE_', '');

						tr_modificados.push(
								{'Id' : idEmpresa, 'IdUsuario': IdUsuario }
						);
				}
		});

		// console.log('registradas_dt');
		registradas_dt.find("tr").each(function() {
				if( $(this).attr('value') == 1 ){
						var idEmpresa = $(this).attr('id').replace('VM_RUE_', '')

						tr_modificados.push(
								{'Id' : idEmpresa, 'IdUsuario': 0 }
						);
				}
		});

		//console.log( tr_modificados.length );
		if( tr_modificados.length > 0){
				var urlPHP = "C_Usuarios/GuardarRelacion_UsuarioEmpresa/";
				var datos = {  'tr_modificados' : tr_modificados  };
				$('#btnGuardarRelacion_UsuarioEmpresa').prop('disabled', true);

				AjaxFunction(urlPHP, datos, function(response){
						//console.log(response);
						var alert_data = [];
						alert_data['alert_id'] = 'RUE_Alert';
						
						if(response){
								alert_data['alert_class']	= 'alert-success';
								alert_data['txt']					= 'SE HA ACTUALIZADO CORRECTAMENTE';
						}else{
								alert_data['alert_class']	= 'alert-warning';
								alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						}
						alert_data['btn']	= '#btnGuardarRelacion_UsuarioEmpresa';
						Show_Alert( alert_data );

						fnPrincipal();
				},function(textStatus){
						var alert_data = [];
						alert_data['alert_id']		= 'RUE_Alert';
						alert_data['alert_class']	= 'alert-danger';
						alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
						alert_data['btn']					= '#btnGuardarRelacion_UsuarioEmpresa';
						Show_Alert( alert_data );
						console.log(textStatus);
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'RUE_Alert';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'HA OCURRIDO UN PROBLEMA';
				alert_data['btn']					= '';
				Show_Alert( alert_data );
		}
}