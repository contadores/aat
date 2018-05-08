var $frmAcumularXML = $("form[name=frmAcumularXML]");
$(document).ready(function(){
		/*var modal = document.getElementById('myModal');

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}		*/
		
		/*	$("#myBtn").on("click", function(e){				
		});*/

	
	
		$frmAcumularXML.find("#myBtn").on("click", function(e){		
			GenerarAcumulado();
			e.preventDefault();
		});		

}); /* END $(document).ready */


//Busca los xml por criterios de busqueda
function GenerarAcumulado(){	
data_set = {}	
		var urlPHP = "C_AcumuladoAuditor/GenerarXLSAcumulado/";
		var datos = FormularioData('frmAcumularXML');
		$frmAcumularXML.find('#myBtn').prop('disabled', true);			
				AjaxFunction(urlPHP, datos, function(response){	
				alert("Con resultados");
						data_set['detallexls'] = response;
						var html_armado = '';								
						html_armado += ArmarTablaXLS_Header( data_set['ths'] );
						html_armado += ArmarTablaXLS( data_set );		
						html_armado += ArmarTablaXLS_Footer( data_set['ths'] );						
						$("#box-DetalleXls").html( html_armado );
						document.getElementById("myBtn").disabled=false;						
				},function(textStatus){		
					var html_armado = '';								
					html_armado += ArmarTablaXLS_Header( data_set['ths'] );					
					html_armado += ArmarTablaXLS_Footer( data_set['ths'] );	
					$("#box-DetalleXls").html( html_armado );					
					document.getElementById("myBtn").disabled=false;
				});
}


//Arma la tabla donde muestra los resultados acumulados del filtrado
function ArmarTablaXLS( data_set ){	
	var html_armado = '';

	var detallexls = data_set['detallexls'];
	var detallexls_length			= detallexls.length;

	// Usuarios
	for (var i = 0; i < detallexls_length; i++) {
		html_armado +=	'<tr>';
			html_armado +=	'<td>';											
				html_armado +=	detallexls[i]['nss'] + '&nbsp;&nbsp;';																									
			html_armado +=	'</td>';	
			html_armado +=	'<td>';										
				html_armado +=	detallexls[i]['nombre']+'&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td>';								
				html_armado +=	detallexls[i]['rfc']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td>';								
				html_armado +=	detallexls[i]['uuid']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;" >';								
				html_armado +=	detallexls[i]['c001']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c002']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c003']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c004']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c005']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c006']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c009']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c010']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c011']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c012']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c013']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c014']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c015']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c016']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c017']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c019']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c020']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c021']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c022']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c023']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c024']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c025']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c026']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c027']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c028']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c029']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c030']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c031']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c032']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c033']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c034']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c035']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c036']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c037']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c038']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c039']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c040']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c041']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c042']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c044']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c045']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c046']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c047']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c048']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c049']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td style="display:none;">';								
				html_armado +=	detallexls[i]['c050']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td class="">';								
				html_armado +=	detallexls[i]['totalPercepciones']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td class="">';								
				html_armado +=	detallexls[i]['totalDeducciones']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
			html_armado +=	'<td class="">';								
				html_armado +=	detallexls[i]['total']+ '&nbsp;&nbsp;';													
			html_armado +=	'</td>';	
		html_armado += '</tr>';
	}
	// END Usuarios
	return html_armado;
}

//Arma la tabla header donde muestra los resultados acumulados del filtrado
function ArmarTablaXLS_Header( ths = null ){
	var html_armado = '';
		html_armado +=	'<table id="tblXLS" class="table table-bordered table-striped dataTables">';
		html_armado += 		'<thead>';
		html_armado +=			'<tr>';	

		if(ths == null){
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones">NSS</th>';
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones  ">EMPLEADO</th>';
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones  " >RFC</th>';
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones  " >UUID</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SUELDO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >AGUINALDO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PTU</th>';			
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >REEMB GTS MED</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >FONDO AHORRO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CAJA AHORRO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CONTRIBUCIONES POR PATRON</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PREMIO PUNTUALIDAD</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRM SEG VIDA</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SEG GTS MED</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CUOT SIND POR PATRON</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SUBS INCAPACIDAD</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >BECAS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >OTROS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SUBS EMPLEO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >HORAS EXTRAS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRIMA DOMINICAL</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRIMA VACACIONAL</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PRIMA ANTIGUEDAD</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PAGOS SEPARACION</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >SEGURO RETIRO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INDEMNIZACIONES</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >REEMBOLSO FUNERAL</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >CUOT SS POR PATRON</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >COMISIONES</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >DESPENSA</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >RESTAURANTE</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >GASOLINA</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >ROPA</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >AYUDA RENTA</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >AYUDA ART ESC</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >ANTEOJOS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >TRANSPORTE</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >GTOS FUNERARIOS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >OTROS INGRESOS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >JUBILACIONES RETIRO</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS PROPIOS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS FEDERALES</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS PROPIOS FEDERALES</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >JUBILACION RETIRO PARCIALES</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >TITULAS ACCIONES</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >INGRESOS ASIMILADOS</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >ALIMENTACION</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >HABITACION</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >PREMIOS ASISTENCIA</th>';
			html_armado +=			'<th style="background-color:#ff9933;display:none;" class="th_table_opciones  " >VIATICOS</th>';			
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones " >TOTAL PERCEPCIONES</th>';			
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones " >TOTAL DEDUCCIONES</th>';	
			html_armado +=			'<th style="background-color:#ffff66;" class="th_table_opciones " >TOTAL</th>';	
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

//Arma la tabla footer donde muestra los resultados acumulados del filtrado
function ArmarTablaXLS_Footer( ths = null ){
	var html_armado = '';
		html_armado	+=		'</tbody>';
		html_armado	+=		'<tfoot>';
		html_armado	+=				'<tr>';

		if(ths == null){
			html_armado +=			'<th></th>';
			html_armado +=			'<th class="th_table_opciones" ></th>';
			html_armado +=			'<th class="th_table_opciones" ></th>';
			html_armado +=			'<th class="th_table_opciones" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;"></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" style="display:none;" ></th>';
			html_armado +=			'<th class="th_table_opciones" ></th>';
			html_armado +=			'<th class="th_table_opciones" ></th>';
			html_armado +=			'<th class="th_table_opciones" ></th>';
			
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

//Permite seleccionar si mostrará el excel acumulado o a detalle y abre el modal que muestra la informacion y descargara el excel
function DescargarAcumulado(){		
	arrayIdXML.length	
	var rates = document.getElementById('tipoAcumulado').value;
	var rate_value='0';
	if (document.getElementById('op1').checked) {	
		data_set = {}	
		$('#DetalleXMLtoXLS').modal('show')
		var urlPHP = "C_DetalleNomina/ObtenerAcumuladoExcel/";
		var datos = { 'arrayIdXML' : arrayIdXML};
		AjaxFunction(urlPHP, datos, function(response){		
			data_set['detallexls'] = response;
			var html_armado = '';									
			html_armado += ArmarTablaXLS_Header();									
			html_armado += ArmarTablaXLS( data_set );									
			html_armado += ArmarTablaXLS_Footer();													
			$("#box-DetalleXls").html( html_armado );	
		});
		rate_value = '0';
	}else if(document.getElementById('op2').checked){
		data_set = {}	
		$('#DetalleXMLtoXLS').modal('show')
		var urlPHP = "C_DetalleNomina/ObtenerDetalleExcel/";
		var datos = { 'arrayIdXML' : arrayIdXML};
		AjaxFunction(urlPHP, datos, function(response){		
			data_set['detallexls'] = response;
			var html_armado = '';									
			html_armado += ArmarTablaXLS_Header();									
			html_armado += ArmarTablaXLS( data_set );									
			html_armado += ArmarTablaXLS_Footer();													
			$("#box-DetalleXls").html( html_armado );	
		});
		rate_value = '1';
	}  	
}

//Exporta la tabla de Detalle XML to XLS	
var myApp=angular.module("myApp",[]);
myApp.factory('Excel',function($window){
        var uri='data:application/vnd.ms-excel;base64,',
            template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64=function(s){return $window.btoa(unescape(encodeURIComponent(s)));},
            format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
        return {
            tableToExcel:function(tableId,worksheetName){
                var table=$(tableId),
                    ctx={worksheet:worksheetName,table:table.html()},
                    href=uri+base64(format(template,ctx));
                return href;
            }
        };
    })
    .controller('MyCtrl',function(Excel,$timeout,$scope){
      $scope.exportToExcel=function(tableId){ // ex: '#my-table'
            var exportHref=Excel.tableToExcel(tableId,'WireWorkbenchDataExport');
            $timeout(function(){location.href=exportHref;},100); // trigger download
        }
    });
