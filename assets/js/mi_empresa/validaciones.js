function isNumeric(n) {
  	return !isNaN(parseFloat(n)) && isFinite(n);
}

function OnlyNumbers(idElemento, formName = null){
		var elemento = (formName != null) ? formName.find(idElemento) : $(idElemento);

		elemento.on("keypress", function(e){
				return event.charCode > 47 && event.charCode < 58;
		});
}

function OnlyCharacters(idElemento, formName = null){
		var elemento = (formName != null) ? formName.find(idElemento) : $(idElemento);
		
		elemento.on("keypress", function(e){
				return (event.charCode > 64 && event.charCode < 91) || 	// Mayusculas
							 (event.charCode > 96 && event.charCode < 123) || // Minusculas
							 (event.charCode == 241) ||	// eñe
							 (event.charCode == 209) ||	// EÑE
							 (event.charCode == 32)	 ||	// Espacio
							 (event.charCode == 180) ||	// Acento
							 (event.charCode == 225) || // á
							 (event.charCode == 233) ||	// é
							 (event.charCode == 237) || // í
							 (event.charCode == 243) || // ó
							 (event.charCode == 250);   // ú
		});
}

function OnlyCharactersAndNumbers(idElemento, formName = null){
		var elemento = (formName != null) ? formName.find(idElemento) : $(idElemento);

		elemento.on("keypress", function(e){
				return (event.charCode > 47 && event.charCode < 58) ||  // Numeros
							 (event.charCode > 64 && event.charCode < 91) || 	// Mayusculas
							 (event.charCode > 96 && event.charCode < 123) || // Minusculas
							 (event.charCode == 241) ||	// eñe
							 (event.charCode == 209) ||	// EÑE
							 (event.charCode == 32)	 ||	// Espacio
							 (event.charCode == 180) ||	// Acento
							 (event.charCode == 225) || // á
							 (event.charCode == 233) ||	// é
							 (event.charCode == 237) || // í
							 (event.charCode == 243) || // ó
							 (event.charCode == 250);   // ú
		});
}

// Funcion que valida que el correo electronico este bien escrito.
function ValidarEmail( elemento_val ){
		var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return ( expr.test( elemento_val ) ) ? true : false;
}