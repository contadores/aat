//Arreglo que se usa para saber los id de los xml que se filtraron y encontraronvar arrayIdXML = [];//Arma la tabla body donde muestra los resultados del filtrado
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
//Arma la tabla header donde muestra los resultados del filtrado
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
//Arma la tabla footer donde muestra los resultados del filtrado
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
//Arma la tabla donde muestra los resultados acumulados del filtradofunction ArmarTablaXLS( data_set ){		var html_armadoXLS = '';	var detallexls = data_set['detallexls'];	var detallexls_length			= detallexls.length;	// Usuarios	for (var i = 0; i < detallexls_length; i++) {		html_armadoXLS +=	'<tr>';			html_armadoXLS +=	'<td>';															html_armadoXLS +=	detallexls[i]['nss'] + '&nbsp;&nbsp;';																												html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td>';														html_armadoXLS +=	detallexls[i]['nombre']+'&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td>';												html_armadoXLS +=	detallexls[i]['rfc']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td>';												html_armadoXLS +=	detallexls[i]['uuid']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;" >';												html_armadoXLS +=	detallexls[i]['c001']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c002']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c003']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c004']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c005']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c006']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c009']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c010']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c011']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c012']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c013']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c014']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c015']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c016']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c017']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c019']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c020']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c021']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c022']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c023']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c024']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c025']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c026']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c027']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c028']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c029']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c030']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c031']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c032']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c033']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c034']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c035']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c036']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c037']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c038']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c039']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c040']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c041']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c042']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c044']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c045']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c046']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c047']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c048']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c049']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td style="display:none;">';												html_armadoXLS +=	detallexls[i]['c050']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td class="">';												html_armadoXLS +=	detallexls[i]['totalPercepciones']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td class="">';												html_armadoXLS +=	detallexls[i]['totalDeducciones']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';				html_armadoXLS +=	'<td class="">';												html_armadoXLS +=	detallexls[i]['total']+ '&nbsp;&nbsp;';																html_armadoXLS +=	'</td>';			html_armadoXLS += '</tr>';	}	// END Usuarios	return html_armadoXLS;}//Arma la tabla header donde muestra los resultados acumulados del filtradofunction ArmarTablaXLS_Header( ths = null ){	var html_armadoXLS = '';		html_armadoXLS +=	'<table id="tblXLS" class="table table-bordered table-striped dataTables">';		html_armadoXLS += 		'<thead>';		html_armadoXLS +=			'<tr>';			if(ths == null){			html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones">NSS</th>';			html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones  ">EMPLEADO</th>';			html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones  " >RFC</th>';			html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones  " >UUID</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SUELDO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >AGUINALDO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PTU</th>';						html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >REEMB GTS MED</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >FONDO AHORRO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CAJA AHORRO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CONTRIBUCIONES POR PATRON</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PREMIO PUNTUALIDAD</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRM SEG VIDA</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SEG GTS MED</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CUOT SIND POR PATRON</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SUBS INCAPACIDAD</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >BECAS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >OTROS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SUBS EMPLEO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >HORAS EXTRAS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRIMA DOMINICAL</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRIMA VACACIONAL</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRIMA ANTIGUEDAD</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PAGOS SEPARACION</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SEGURO RETIRO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INDEMNIZACIONES</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >REEMBOLSO FUNERAL</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CUOT SS POR PATRON</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >COMISIONES</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >DESPENSA</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >RESTAURANTE</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >GASOLINA</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >ROPA</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >AYUDA RENTA</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >AYUDA ART ESC</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >ANTEOJOS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >TRANSPORTE</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >GTOS FUNERARIOS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >OTROS INGRESOS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >JUBILACIONES RETIRO</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS PROPIOS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS FEDERALES</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS PROPIOS FEDERALES</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >JUBILACION RETIRO PARCIALES</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >TITULAS ACCIONES</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS ASIMILADOS</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >ALIMENTACION</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >HABITACION</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PREMIOS ASISTENCIA</th>';			html_armadoXLS +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >VIATICOS</th>';						html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones " >TOTAL PERCEPCIONES</th>';						html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones " >TOTAL DEDUCCIONES</th>';				html_armadoXLS +=			'<th style="background-color:#ffff66;" class="th_table_opciones " >TOTAL</th>';			}else{			for (var i = 0; i < ths.length; i++) {				html_armadoXLS +=		'<th';				html_armadoXLS +=  	(ths[i]['width'] != 0) ? ' width="'+ths[i]['width']+'px">' : '>'; 				html_armadoXLS +=		ths[i]['th']+'</th>';			}		}		html_armadoXLS +=			'</tr>';		html_armadoXLS +=		'</thead>';		html_armadoXLS +=		'<tbody id="empresas-all">';	return html_armadoXLS;}//Arma la tabla footer donde muestra los resultados acumulados del filtradofunction ArmarTablaXLS_Footer( ths = null ){	var html_armadoXLS = '';		html_armadoXLS	+=		'</tbody>';		html_armadoXLS	+=		'<tfoot>';		html_armadoXLS	+=				'<tr>';			html_armadoXLS +=			'<th></th>';			html_armadoXLS +=			'<th class="th_table_opciones" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;"></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" style="display:none;" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" ></th>';			html_armadoXLS +=			'<th class="th_table_opciones" ></th>';						html_armadoXLS	+=				'</tr>';		html_armadoXLS	+=		'</tfoot>';		html_armadoXLS	+=	'</table>';	return html_armadoXLS;}
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
//Se inicializa la tabla de resultado filtrado para no mostrar vacia la pantalla, solo se muestran el encabezado y footer de la tabla.
function inicializargrid(data_set = {}){
	var html_armadoXML = '';								
	html_armadoXML += ArmarTablaFiltroXML_Header( data_set['ths'] );						
	html_armadoXML += ArmarTablaFiltroXML_Footer( data_set['ths'] );	
	$("#box-filtrado").html( html_armadoXML );
	$(".dataTables").DataTable();	
}
//Busca los xml por criterios de busqueda
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
							console.log(response);							document.getElementById("btnFiltrarXML").disabled=false;	
						}											
						else				
						{
							alert_data['alert_id']		= 'VM_EN_Alert';
							alert_data['alert_class']	= 'alert-warning';
							alert_data['txt']					= 'NO SE ENCONTRARON RESULTADOS';
							alert_data['btn']					= '#btnFiltrarXML';
							Show_Alert( alert_data );
							console.log(response);								document.getElementById("btnFiltrarXML").disabled=false;
						}							
				},function(textStatus){				
						var alert_data = [];
						alert_data['alert_id']		= 'VM_EN_Alert';
						alert_data['alert_class']	= 'alert-warning';
						alert_data['txt']					= 'NO SE ENCONTRARON RESULTADOS';
						alert_data['btn']					= '#btnFiltrarXML';
						Show_Alert( alert_data );
						console.log(textStatus);								document.getElementById("btnFiltrarXML").disabled=false;
				});
		}else{
				var alert_data = [];
				alert_data['alert_id']		= 'VM_EN_Alert';
				alert_data['alert_class']	= 'alert-danger';
				alert_data['txt']					= 'DEBE FILTRAR AL MENOS UN CRITERIO';
				alert_data['btn']					= '#btnFiltrarXML';
				Show_Alert( alert_data );				document.getElementById("btnFiltrarXML").disabled=false;
		}
}
//Valida que al menos un criterio de busqueda exista
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
//Obtiene los datos completos del xml a mostrar
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
//Consulta las percepciones del xml a mostrar
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
//Consulta las deducciones del xml a mostrar
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
//Arma la tabla base body de Percepciones y deducciones en el xml de detalle.
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
//Arma la tabla base header de Percepciones y deducciones en el xml de detalle.
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
//Arma la tabla base footer de Percepciones y deducciones en el xml de detalle.
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
//Permite seleccionar si mostrará el excel acumulado o a detalle y abre el modal que muestra la informacion y descargara el excel
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
	}else if(document.getElementById('op2').checked){		data_set = {}			$('#DetalleXMLtoXLS').modal('show');		var urlPHP = "C_DetalleNomina/ObtenerDetalleExcel/";		var datos = { 'arrayIdXML' : arrayIdXML};		AjaxFunction(urlPHP, datos, function(response){					data_set['detallexls'] = response;			var html_armadoXLS = '';												html_armadoXLS += ArmarTablaXLS_Header();												html_armadoXLS += ArmarTablaXLS( data_set );												/*html_armadoXLS += ArmarTablaXLS_Footer();												*/			$("#box-DetalleXls").html( html_armadoXLS );			});
		rate_value = '1';
	}  	
}//Imprime el contenido del DIV proporcionado.function printDiv(nombreDiv) {		var contenido= document.getElementById(nombreDiv).innerHTML;		var contenidoOriginal= document.body.innerHTML;		document.body.innerHTML = contenido;		window.print();		document.body.innerHTML = contenidoOriginal;		}			//Cierra el modal de Detalle XML por que por evento directo dismiss no cierra cuando imprime	function cerrarModal() {	$('#DetalleXML').modal().hide();	$('#DetalleXML').modal('hide');	$('#DetalleXML').modal('hide');	$('body').removeClass('modal-open');	$('.modal-backdrop').remove();	}		//Exporta la tabla de Detalle XML to XLS	var myApp=angular.module("myApp",[]);myApp.factory('Excel',function($window){        var uri='data:application/vnd.ms-excel;base64,',            template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',            base64=function(s){return $window.btoa(unescape(encodeURIComponent(s)));},            format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};        return {            tableToExcel:function(tableId,worksheetName){                var table=$(tableId),                    ctx={worksheet:worksheetName,table:table.html()},                    href=uri+base64(format(template,ctx));                return href;            }        };    })    .controller('MyCtrl',function(Excel,$timeout,$scope){      $scope.exportToExcel=function(tableId){ // ex: '#my-table'            var exportHref=Excel.tableToExcel(tableId,'WireWorkbenchDataExport');            $timeout(function(){location.href=exportHref;},100); // trigger download        }    });