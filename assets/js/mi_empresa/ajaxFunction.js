// Funcion principal de AJAX
function AjaxFunction(urlPHP, datos, functionDone = null, functionFail = null){
	var request;
	if( request ){ request.abort(); }

	request = $.ajax({
		// En data puedes utilizar un objeto JSON, un array o un query string
		data		: datos,
		//Cambiar a type: POST si necesario
		type		: "POST",
		// Formato de datos que se espera en la respuesta
		dataType: "json",
		// URL a la que se enviará la solicitud Ajax
		url			: urlPHP
	});

	request.done(function (response, textStatus, jqXHR){
		(functionDone != null) ? functionDone(response) : console.log("Done! : " + response);
	});

	request.fail(function(jqXHR, textStatus, thrown){
		(functionFail != null) ? functionFail(textStatus) : console.log("Error! : " + textStatus);
	});

	//request.always(function(){ console.log('Termino la ejecucion de ajax');	});
}


/////////////////////////////////////////// V2

// Funcion principal de AJAX
function AjaxFunction2( ajaxData, functionDone = null, functionFail = null){
	var request;
	if( request ){ request.abort(); }

	ajaxData['type']		= 'POST';
	ajaxData['dataType']	= ( ajaxData['dataType'] == undefined ) ? 'json' : ajaxData['dataType'];

	// Info extra para que funcione el multipart/form-data
	//	ajaxData['cache']		= ( ajaxData['cache']		== undefined ) ? true : false;
	//	ajaxData['contentType']	= ( ajaxData['contentType']	== undefined ) ? true : false;
	//	ajaxData['processData']	= ( ajaxData['processData']	== undefined ) ? true : false;

	if( ajaxData['dataType'] == 'json' ){
		// OSIEL
		request = $.ajax({
			// En data puedes utilizar un objeto JSON, un array o un query string
			data			:	ajaxData['datos'],
			//Cambiar a type: POST si necesario
			type			:	ajaxData['type'],
			// Formato de datos que se espera en la respuesta
			dataType		:	'json',
			// URL a la que se enviará la solicitud Ajax
			url				:	ajaxData['urlPHP']
		});
	}else{
		// YEYO
		request = $.ajax({
			// En data puedes utilizar un objeto JSON, un array o un query string
			data			:	ajaxData['datos'],
			//Cambiar a type: POST si necesario
			type			:	ajaxData['type'],
			// Formato de datos que se espera en la respuesta
			dataType		:	'html',
			// URL a la que se enviará la solicitud Ajax
			url				:	ajaxData['urlPHP'],

			// Info extra para que funcione el multipart/form-data
			cache			:	false,
			contentType		:	false,
			processData		:	false
		});
	}


	request.done(function (response, textStatus, jqXHR){
		(functionDone != null) ? functionDone(response) : console.log("Done! : " + response);
	});

	request.fail(function(jqXHR, textStatus, thrown){
		(functionFail != null) ? functionFail(textStatus) : console.log("Error! : " + textStatus);
	});

	//request.always(function(){ console.log('Termino la ejecucion de ajax');	});
}
