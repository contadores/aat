//Arreglo que se usa para saber los id de los xml que se filtraron y encontraron
function ArmarTablaFiltroXML( data_set ){	
	var html_armadoXML = '';

	var usuarios 						= data_set['usuarios'];
	var usuarios_length			= usuarios.length;

	// Usuarios
	for (var i = 0; i < usuarios_length; i++) {
		arrayIdXML [i] = usuarios[i]['IdXML'];
		html_armadoXML +=	'<tr>';
			html_armadoXML +=	'<td>';											
						html_armadoXML +=	usuarios[i]['fecha'] + '&nbsp;&nbsp;';																									
			html_armadoXML +=	'</td>';	
			html_armadoXML +=	'<td>';		
						html_armadoXML +=	'<a href="" onclick="ObtenerDetalleXML(' + usuarios[i]['IdXML'] + ');" data-toggle="modal" data-target="#DetalleXML" >';	
						html_armadoXML +=	'<i class="glyphicon glyphicon-search icons" ></i>';								
						html_armadoXML +=	usuarios[i]['folio'] + '&nbsp;&nbsp;';													
						html_armadoXML +=	'</a>';	
			html_armadoXML +=	'</td>';	
			html_armadoXML +=	'<td>';								
				html_armadoXML +=	usuarios[i]['empleado'] + '&nbsp;&nbsp;';													
			html_armadoXML +=	'</td>';	
			html_armadoXML +=	'<td>';								
				html_armadoXML +=	usuarios[i]['nss'] + '&nbsp;&nbsp;';													
			html_armadoXML +=	'</td>';	
			html_armadoXML +=	'<td>';								
				html_armadoXML +=	usuarios[i]['total'] + '&nbsp;&nbsp;';													
			html_armadoXML +=	'</td>';	
		html_armadoXML += '</tr>';
	}
	// END Usuarios
	return html_armadoXML;
}

function ArmarTablaFiltroXML_Header( ths = null ){
	var html_armadoXML = '';
		html_armadoXML +=	'<table id= "tblXMLFiltrado" class="table table-bordered table-striped dataTables">';
		html_armadoXML += 		'<thead>';
		html_armadoXML +=			'<tr>';	

		if(ths == null){
			html_armadoXML +=			'<th>FECHA</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >FOLIO</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >EMPLEADO</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >NSS</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >TOTAL</th>';
		}else{
			for (var i = 0; i < ths.length; i++) {
				html_armadoXML +=		'<th';
				html_armadoXML +=  	(ths[i]['width'] != 0) ? ' width="'+ths[i]['width']+'px">' : '>'; 
				html_armadoXML +=		ths[i]['th']+'</th>';
			}
		}

		html_armadoXML +=			'</tr>';
		html_armadoXML +=		'</thead>';
		html_armadoXML +=		'<tbody id="empresas-all">';
	return html_armadoXML;
}

function ArmarTablaFiltroXML_Footer( ths = null ){
	var html_armadoXML = '';
		html_armadoXML	+=		'</tbody>';
		html_armadoXML	+=		'<tfoot>';
		html_armadoXML	+=				'<tr>';

		if(ths == null){
			html_armadoXML +=			'<th>FECHA</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >FOLIO</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >EMPLEADO</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >NSS</th>';
			html_armadoXML +=			'<th class="th_table_opciones" >TOTAL</th>';
		}else{
			for (var i = 0; i < ths.length; i++) {
				html_armadoXML +=		'<th';
				html_armadoXML +=  	(ths[i]['width'] != 0) ? ' width="'+ths[i]['width']+'px">' : '>'; 
				html_armadoXML +=		ths[i]['th']+'</th>';
			}
		}

		html_armadoXML	+=				'</tr>';
		html_armadoXML	+=		'</tfoot>';
		html_armadoXML	+=	'</table>';

	return html_armadoXML;
}
//Arma la tabla donde muestra los resultados acumulados del filtrado
$(document).ready(function(){	
		$formFiltroXML.find('#VM_EN_Alert').fadeOut();

		OnlyNumbers("#totalMin",						$formFiltroXML);		
		OnlyNumbers("#totalMax",						$formFiltroXML);	
		OnlyNumbers("#nss",						$formFiltroXML);				
		
		$formFiltroXML.find("#btnFiltrarXML").on("click", function(e){	
		
				FiltrarXML();
				e.preventDefault();
		});						
		
		$("#btnDescargarAcumulado").on("click", function(e){	
		
			DescargarAcumulado();
			e.preventDefault();
		});		
		
		inicializargrid();		
});

function inicializargrid(data_set = {}){
	var html_armadoXML = '';								
	html_armadoXML += ArmarTablaFiltroXML_Header( data_set['ths'] );						
	html_armadoXML += ArmarTablaFiltroXML_Footer( data_set['ths'] );	
	$("#box-filtrado").html( html_armadoXML );
	$(".dataTables").DataTable();	
}

function FiltrarXML(data_set = {}){	
		var urlPHP = "C_DetalleNomina/FiltrarXML/";
		var datos = FormularioData('formFiltroXML');
		$formFiltroXML.find('#btnFiltrarXML').prop('disabled', true);
		if( Validar_VM_FiltroXML(  FormularioData('formFiltroXML')  ) ){
				if (datos['fechaInicio'] != '' && datos['fechaFin'] == '' )
				{
					$('#fechaFin').val(datos['fechaInicio']);					
				}
				if (datos['fechaFin'] != '' && datos['fechaInicio'] == '' )
				{
					$('#fechaInicio').val(datos['fechaFin']);					
				}			
				AjaxFunction(urlPHP, datos, function(response){				
						var alert_data = [];
						data_set['usuarios'] = response;
						var html_armadoXML = '';								
						html_armadoXML += ArmarTablaFiltroXML_Header( data_set['ths'] );
						html_armadoXML += ArmarTablaFiltroXML( data_set );		
						html_armadoXML += ArmarTablaFiltroXML_Footer( data_set['ths'] );						
						$("#box-filtrado").html( html_armadoXML );
						$(".dataTables").DataTable();
						
						if (data_set['usuarios'].length>0 )
						{
							alert_data['alert_id']		= 'VM_EN_Alert';
							alert_data['alert_class']	= 'alert-success';
							alert_data['txt']					= 'SE ENCONTRARON RESULTADOS';
							alert_data['btn']					= '#btnFiltrarXML';
							Show_Alert( alert_data );
							console.log(response);
						}											
						else				
						{
							alert_data['alert_id']		= 'VM_EN_Alert';
							alert_data['alert_class']	= 'alert-warning';
							alert_data['txt']					= 'NO SE ENCONTRARON RESULTADOS';
							alert_data['btn']					= '#btnFiltrarXML';
							Show_Alert( alert_data );
							console.log(response);	
						}							
				},function(textStatus){				
						var alert_data = [];
						alert_data['alert_id']		= 'VM_EN_Alert';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'NO SE ENCONTRARON RESULTADOS';
						alert_data['btn']					= '#btnFiltrarXML';
						Show_Alert( alert_data );
						console.log(textStatus);			
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'VM_EN_Alert';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'DEBE FILTRAR AL MENOS UN CRITERIO';
				alert_data['btn']					= '#btnFiltrarXML';
				Show_Alert( alert_data );
		}
}

function Validar_VM_FiltroXML( datos ){	// console.log( datos );
		//console.log(datos);
		var valido = false;
		var form_error  = '#dd4b39';
		var form_valido = '#d2d6de';


		if( 	
			datos['fechaInicio'] != '' && datos['fechaInicio'] != ' '
			|| datos['fechaFin'] != '' && datos['fechaFin'] != ' '		
			|| datos['folio'] != '' && datos['folio'] != ' '
			|| datos['empleado'] != '' && datos['empleado'] != ' '
			|| datos['nss'] != '' && datos['nss'] != ' '
			|| datos['registroPatronal'] != '' && datos['registroPatronal'] != ' '
			|| datos['totalMin'] != '' && datos['totalMin'] != ' '
			|| datos['totalMax'] != '' && datos['totalMax'] != ' '
		){				
				valido = true;
		}else{
				valido = false;
		}	

		// console.log(valido);
		return valido;
}

function ObtenerDetalleXML( IdXML){					
	var urlPHP = "C_DetalleNomina/ObtenerDetalleXML/";
	var datos = { 'IdXML' : IdXML};
	AjaxFunction(urlPHP, datos, function(response){
		document.getElementById("lblFormaDePago").innerHTML=response['formaDePago'];	
		document.getElementById("lblFecha").innerHTML=response['fecha'];	
		document.getElementById("lblLugarExpedicion").innerHTML=response['lugarExpedicion'];	
		document.getElementById("lblTipoComprobante").innerHTML=response['tipoDeComprobante'];	
		document.getElementById("lblMetodoDePago").innerHTML=response['metodoDePago'];				
		document.getElementById("lblEmisorNombre").innerHTML=response['emisorNombre'];	
		document.getElementById("lblEmisorRFC").innerHTML=response['emisorRFC'];	
		document.getElementById("lblEmisorRegimen").innerHTML=response['emisorRegimen'];	
		document.getElementById("lblReceptorNombre").innerHTML=response['receptorNombre'];	
		document.getElementById("lblReceptorRFC").innerHTML=response['receptorRFC'];			
		document.getElementById("lblRiesgoPuesto").innerHTML=response['riesgoPuesto'];	
		document.getElementById("lblSalarioDiarioIntegrado").innerHTML=response['salarioDiarioIntegrado'];	
		document.getElementById("lblInicioRelacionLaboral").innerHTML=response['inicioRelacionLaboral'];	
		document.getElementById("lblPeriodicidadPago").innerHTML=response['periodicidadPago'];				
		document.getElementById("lblFechaInicialPago").innerHTML=response['fechaInicialPago'];	
		document.getElementById("lblCURP").innerHTML=response['CURP'];	
		document.getElementById("lblNSS").innerHTML=response['NSS'];	
		document.getElementById("lblTipoJornada").innerHTML=response['tipoJornada'];	
		document.getElementById("lblPuesto").innerHTML=response['puesto'];	
		document.getElementById("lblNumeroDiasPagados").innerHTML=response['numeroDiasPagados'];	
		document.getElementById("lblFechaPago").innerHTML=response['fechaPago'];	
		document.getElementById("lblNumeroEmpleado").innerHTML=response['numeroEmpleado'];	
		document.getElementById("lblRegistroPatronal").innerHTML=response['registroPatronal'];				
		document.getElementById("lblTipoContrato").innerHTML=response['tipoContrato'];	
		document.getElementById("lblDepartamento").innerHTML=response['departamento'];	
		document.getElementById("lblFechaFinalPago").innerHTML=response['fechaFinalPago'];	
		document.getElementById("lblTipoRegimen").innerHTML=response['tipoRegimen'];	
		document.getElementById("lblVersion").innerHTML=response['version'];	
		document.getElementById("lblFechaTimbrado").innerHTML=response['fechaTimbrado'];	
		document.getElementById("lblUUID").innerHTML=response['uuid'];				
		ObtenerPercepciones(IdXML);			
		ObtenerDeducciones(IdXML);
		document.getElementById("lblPercepcionesTotales").innerHTML=response['totalPercepcion'];	
		document.getElementById("lblDeduccionesTotales").innerHTML=response['totalDeduccion'];	
		document.getElementById("lblTotales").innerHTML=response['totalNomina'];	
	});
	
}

function ObtenerPercepciones(IdXML){	
	data_set = {}
	var urlPHP = "C_DetalleNomina/ObtenerPercepciones/";
	var datos = { 'IdXML' : IdXML};
	AjaxFunction(urlPHP, datos, function(response){
		data_set['conceptos'] = response;
		var html_armadoCONCEPTOS = '';									
		html_armadoCONCEPTOS += ArmarTabla_Header();									
		html_armadoCONCEPTOS += ArmarTablaDetalleXML( data_set );									
		html_armadoCONCEPTOS += ArmarTabla_Footer();													
		$("#box-Percepciones").html( html_armadoCONCEPTOS );	
	});
}	

function ObtenerDeducciones(IdXML){
		data_set = {}
		var urlPHP = "C_DetalleNomina/ObtenerDeducciones/";
		var datos = { 'IdXML' : IdXML};
		AjaxFunction(urlPHP, datos, function(response){
			data_set['conceptos'] = response;
			var html_armadoCONCEPTOS = '';									
			html_armadoCONCEPTOS += ArmarTabla_Header();									
			html_armadoCONCEPTOS += ArmarTablaDetalleXML( data_set );									
			html_armadoCONCEPTOS += ArmarTabla_Footer();													
			$("#box-Deducciones").html( html_armadoCONCEPTOS );	
		});
}	

function ArmarTablaDetalleXML( data_set ){
	var html_armadoCONCEPTOS = '';

	var conceptos 						= data_set['conceptos'];
	var conceptos_length			= conceptos.length;

	// conceptos
	for (var i = 0; i < conceptos_length; i++) {
		html_armadoCONCEPTOS +=	'<tr>';
			html_armadoCONCEPTOS +=	'<td>';											
						html_armadoCONCEPTOS +=	conceptos[i]['tipoPercepcion'] + '&nbsp;&nbsp;';																									
			html_armadoCONCEPTOS +=	'</td>';	
			html_armadoCONCEPTOS +=	'<td>';															
						html_armadoCONCEPTOS +=	conceptos[i]['clave'] + '&nbsp;&nbsp;';																			
			html_armadoCONCEPTOS +=	'</td>';	
			html_armadoCONCEPTOS +=	'<td>';								
				html_armadoCONCEPTOS +=	conceptos[i]['concepto'] + '&nbsp;&nbsp;';													
			html_armadoCONCEPTOS +=	'</td>';	
			html_armadoCONCEPTOS +=	'<td>';								
				html_armadoCONCEPTOS +=	conceptos[i]['importeGravado'] + '&nbsp;&nbsp;';													
			html_armadoCONCEPTOS +=	'</td>';	
			html_armadoCONCEPTOS +=	'<td>';								
				html_armadoCONCEPTOS +=	conceptos[i]['importeExento'] + '&nbsp;&nbsp;';													
			html_armadoCONCEPTOS +=	'</td>';	
		html_armadoCONCEPTOS += '</tr>';
	}
	// END conceptos

	return html_armadoCONCEPTOS;
}

function ArmarTabla_Header(){
	var html_armadoCONCEPTOS = '';
		html_armadoCONCEPTOS +=	'<table class="table table-bordered table-striped dataTables">';
		html_armadoCONCEPTOS += 		'<thead>';
		html_armadoCONCEPTOS +=			'<tr>';
			html_armadoCONCEPTOS +=			'<th style="width:20%">Tipo</th>';
			html_armadoCONCEPTOS +=			'<th style="width:20%">Clave</th>';
			html_armadoCONCEPTOS +=			'<th style="width:40%">Concepto</th>';
			html_armadoCONCEPTOS +=			'<th style="width:20%">Importe Gravado</th>';
			html_armadoCONCEPTOS +=			'<th style="width:20%">Importe Exento</th>';
		html_armadoCONCEPTOS	+=				'</tr>';
		html_armadoCONCEPTOS +=		'</thead>';
		html_armadoCONCEPTOS +=		'<tbody id="empresas-all">';			
		return html_armadoCONCEPTOS;
}

function ArmarTabla_Footer(){
	var html_armadoCONCEPTOS = '';
		html_armadoCONCEPTOS	+=		'</tbody>';
	//	html_armadoCONCEPTOS	+=		'<tfoot>';
	//	html_armadoCONCEPTOS	+=				'<tr>';
			//html_armadoCONCEPTOS +=			'<th style="width:20%">Tipo</th>';
			//html_armadoCONCEPTOS +=			'<th style="width:20%">Clave</th>';
			//html_armadoCONCEPTOS +=			'<th style="width:40%">Concepto</th>';
			//html_armadoCONCEPTOS +=			'<th style="width:20%">Importe Gravado</th>';
			//html_armadoCONCEPTOS +=			'<th style="width:20%">Importe Exento</th>';
		//html_armadoCONCEPTOS	+=				'</tr>';
		//html_armadoCONCEPTOS	+=		'</tfoot>';
		html_armadoCONCEPTOS	+=	'</table>';
	return html_armadoCONCEPTOS;
}

function DescargarAcumulado(){
	arrayIdXML.length	
	var rates = document.getElementById('tipoAcumulado').value;
	var rate_value='0';
	if (document.getElementById('op1').checked) {	
		data_set = {}	
		$('#DetalleXMLtoXLS').modal('show');
		var urlPHP = "C_DetalleNomina/ObtenerAcumuladoExcel/";
		var datos = { 'arrayIdXML' : arrayIdXML};
		AjaxFunction(urlPHP, datos, function(response){		
			data_set['detallexls'] = response;
			var html_armadoXLS = '';									
			html_armadoXLS += ArmarTablaXLS_Header();							
			html_armadoXLS += ArmarTablaXLS( data_set );									
			/*html_armadoXLS += ArmarTablaXLS_Footer();												*/
			$("#box-DetalleXls").html( html_armadoXLS );	
		});
		rate_value = '0';
	}else if(document.getElementById('op2').checked){
		rate_value = '1';
	}  	
}