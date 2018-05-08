var $formFiltroXML = $("form[name=formFiltroXML]");
var $formResultadoFiltro = $("form[name=formResultadoFiltro]");

function LimpiarFormFiltroXML(){
		LimpiarInputs( $formFiltroXML );		
}

$(document).ready(function(){	
		$("#divXMLFiltrados").hide();
		$('#divSinFiltro').show();	
		
		$( "#iconFiltro" ).click(function() {
		  LimpiarFormFiltroXML();
		});
		
});
