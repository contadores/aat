/*
function cambiarTituloComparativa(tab){
	var tituloTab = '<i class="fa fa-'
	switch(tab) {
		case 2: 	tituloTab += 'file-o""></i><i class="fa fa-file-o""></i> Comparativa Bimestral';	break;
		case 1:		tituloTab += 'file-o""></i> 1111Comparativa Mensual';	break;
	}

	$("#tituloComparativa").html( tituloTab );
}
*/

function cambiarTituloDatosGenerales(tab){
	var tituloTab = '<i class="fa fa-'
	switch(tab) {
		case 3:		tituloTab += 'archive"></i> Datos de archivo';								break;
		case 2: 	tituloTab += 'map-o"></i> Domicilio';													break;
		case 1:		tituloTab += 'book"></i> Datos de identificación del actor';	break;
	}

	document.getElementById('tituloExpediente').innerHTML = tituloTab;
}

function cambiarTituloExpediente(tab){
	var tituloTab = '<i class="fa fa-'
	switch(tab) {
		case 8: 	tituloTab += 'clone"></i> Otros';																	break;
		case 7:		tituloTab += 'truck"></i> Embargos';															break;
		case 6: 	tituloTab += 'dollar"></i> Pagos';																break;
		case 5:		tituloTab += 'legal"></i> Interlocutoria';												break;
		case 4: 	tituloTab += 'institution"></i> Laudos';													break;
		case 3:		tituloTab += 'file-text"></i> Prestaciones reclamadas';						break;
		case 2: 	tituloTab += 'file-text-o"></i> Proceso de la demanda';						break;
		case 1:		tituloTab += 'book"></i> Datos de identificación del expediente';	break;
	}

	document.getElementById('tituloExpediente').innerHTML = tituloTab;
}

function cambiarTituloPagos(tab){
	var tituloTab = '<i class="fa fa-'
	switch(tab) {
		case 5:		tituloTab += 'clone"></i> Otros';																		break;
		case 4: 	tituloTab += 'calendar-check-o"></i> Devoluciones de polizas';			break;
		case 3:		tituloTab += 'file-text"></i> Datos de identificación del cheque';	break;
		case 2: 	tituloTab += 'file-text-o"></i> Solicitud de cheque a finanzas';		break;
		case 1:		tituloTab += 'dollar"></i> Pagos';																	break;
	}

	document.getElementById('tituloExpediente').innerHTML = tituloTab;
}

function cambiarTituloPagosModal(tab){
	var tituloTab = '<i class="fa fa-'
	switch(tab) {
		case 5:		tituloTab += 'clone"></i> Otros';																		break;
		case 4: 	tituloTab += 'calendar-check-o"></i> Devoluciones de polizas';			break;
		case 3:		tituloTab += 'file-text"></i> Datos de identificación del cheque';	break;
		case 2: 	tituloTab += 'file-text-o"></i> Solicitud de cheque a finanzas';		break;
		case 1:		tituloTab += 'dollar"></i> Pagos';																	break;
	}

	document.getElementById('tituloExpedienteModal').innerHTML = tituloTab;
}