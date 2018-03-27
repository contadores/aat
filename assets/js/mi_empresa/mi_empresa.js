function LimpiarInputs( $formData ){
	// Función que limpia todos los inputs del formulario enviado.
	$formData.find("input").each(function() {
		$(this).val("");
	});
	// Fin
}

function construirSelect( data_set, titulo_select = 'bla', indice_seleccionado ){
	// Se agrega un elemento al comienzo del arreglo con el titulo que tendra el select.
	var new_data_set = [{ 'Id':'0' , 'Elemento': titulo_select }];
	var data_set_length = data_set.length;
	for(var i = 0; i < data_set_length; i++){
			new_data_set.push( data_set[i] );
	}
	// Fin


	// Se crea un select con la información que trae el new_data_set
	var select_armado = '';

	for(var i = 0; i < data_set_length + 1; i++){
			select_armado +=	'<option value="' + new_data_set[i]['Id'] + '"';
			
			if( new_data_set[i]['Id'] == 0 ){
					select_armado +=	' disabled ';
			}
			
			if( new_data_set[i]['Id'] == indice_seleccionado ){
					select_armado +=	' selected ';
			}
			//console.log( new_data_set[i]['Id'] + ' == ' + indice_seleccionado );

			select_armado +=	'>';
			select_armado +=	  new_data_set[i]['Elemento'];
			select_armado +=	'</option>';
	}

	if( data_set_length == 0 ){
			select_armado +=	'<option value="-1" disabled>';
			select_armado +=	'- Sin información -';
			select_armado +=	'</option>';
	}
	// Fin


	return select_armado;
}

function FormularioData( formName, elementoRestringido = null) {
	var $formData = $("form[name=" + formName + "]");
	var myArray = new Object(); // creamos un objeto

	$formData.find(".form-control").each(function() {

			if( elementoRestringido != null ){
					guardar = true;
					for(var i = 0; i < elementoRestringido.length; i++) {
							if( elementoRestringido[i] == $(this).attr('id') ){
									guardar = false;
							}
					}
					if( guardar ){
							var valor = $(this).val();
							
							if( $(this).val() != null ){
									valor = valor.trim();
							}
							myArray[ $(this).attr('id') ] = valor;
					}
			}else{
					var valor = $(this).val();

					if( $(this).val() != null ){
							valor = valor.trim();
					}
					myArray[ $(this).attr('id') ] = valor;
			}

	});
	// Transofmra a un objeto raro JSON de 2 dimesiones QUE SI JALA.
	return jQuery.makeArray(myArray)[0];

	// Convierte en un JSON plano igual a un simple string
	//return JSON.stringify(myArray);
}

function ArmarTablaAdminUsers_Header( ths = null ){
	var html_armado = '';
		html_armado +=	'<table class="table table-bordered table-striped dataTables">';
		html_armado += 		'<thead>';
		html_armado +=			'<tr>';	

		if(ths == null){
			html_armado +=			'<th>NOMBRE</th>';
			html_armado +=			'<th class="th_table_opciones" >OPCIONES</th>';
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

function ArmarTablaAdminUsers_Footer( ths = null ){
	var html_armado = '';
		html_armado	+=		'</tbody>';
		html_armado	+=		'<tfoot>';
		html_armado	+=				'<tr>';

		if(ths == null){
			html_armado +=			'<th>NOMBRE</th>';
			html_armado +=			'<th class="th_table_opciones" >OPCIONES</th>';
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


function LlenarCamposDeFormulario( formName, data_set ){
		var $formData = $("form[name=" + formName + "]");

		$formData.find(".form-control").each(function() {
				// switch ( formName ) {
				// 	case 'formNuevaEmpresa':
				// 			if( $(this).attr('id') != 'IdCatEstado' &&
				// 			 		$(this).attr('id') != 'IdCatMunicipio'
				// 			){
				// 					$(this).val( data_set[ $(this).attr('id') ] );
				// 			}
				// 	break;

				// 	default:
							$(this).val( data_set[ $(this).attr('id') ] );
				// 	break;
				// }
		});
}

function LlenarListGroup( data_set ){
		var $ListGrup = $(".li-control");

		$ListGrup.each(function() {
				$(this).html( data_set[ $(this).attr('id') ] );
		});
}



function Show_Alert( alert_data ){
		var fadeIn_Time	 = 700;
		var fadeOut_Time = 500;
		var delay_Time	 = 2000;

		$('#' + alert_data['alert_id'] ).addClass( alert_data['alert_class'] );
		$('#' + alert_data['alert_id']).prepend( '<p>'+ alert_data['txt'] +'</p>' );

		$('#' + alert_data['alert_id']).fadeIn( fadeIn_Time, function() {
				$('#' + alert_data['alert_id']).delay( delay_Time ).fadeOut( fadeOut_Time, function(){
						$('#' + alert_data['alert_id']).find('p').remove();
						$('#' + alert_data['alert_id']).removeClass( alert_data['alert_class'] );

						// desbloquea el botón que pases
						if( alert_data['btn'] != ''){
								$( alert_data['btn'] ).prop('disabled', false);
						}
						
				});
		});
}

function Modal_Confirm( titulo, comentario, fn ){
// function Modal_Confirm( titulo = null, comentario = null ){
		$("#VM_Confirm").find("#Confirm_titulo").html( titulo );
		$("#VM_Confirm").find("#Confirm_comentario").html( comentario );

		$("#VM_Confirm").find("#btnConfirm").off();
		$("#VM_Confirm").find("#btnConfirm").on("click", function(e){
				fn();
				$('#VM_Confirm').modal('toggle');
				e.preventDefault();
		});

		return false;
		//return confirm( titulo );
}


$(document).ready(function(){
	Cargando_Hidden();
}); /* END $(document).ready */

function Cargando_Show(){
	var $cargando = $('#contenedor_carga');
	$cargando.css('visibility', 'visible');
	$cargando.css('opacity', '1.0');	
}

function Cargando_Hidden(){
	var $cargando = $('#contenedor_carga');
	$cargando.css('visibility', 'hidden');
	$cargando.css('opacity', '0.0');
}