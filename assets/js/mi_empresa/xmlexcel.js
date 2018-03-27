var $Page = $("#xmlexcel");

function Eliminar_XML_Tablero( xml_id, xml_name ){
		$Page.find('#'+ xml_id ).fadeOut().remove(); //.append( lista_XML );
		Borrar_XML( xml_name );
}

function Borrar_XML( xml_name ){
		// console.log( xml_name );

		var urlPHP = "C_XmlExcel/Borrar_XML/";
		var datos = {	'xml_name' : xml_name	}

		AjaxFunction(urlPHP, datos, function(response){
				console.log(response);
		},function(textStatus){

		});
}

$(document).ready(function(){
		var xml_id = 1;

		$Page.find("#fileupload").fileupload({
					url					: $(this).attr('action'),
					dropZone		: '#dropZone',
					dataType		: 'html',
					autoUpload	: false
		}).on('fileuploadadd', function (e, data){		// console.log('fileuploadadd');
					
					// console.log(data.originalFiles);

					var files_lenght = data.originalFiles.length;

					for(	var i = 0; i < files_lenght; i++	){
								var fileName = data.originalFiles[i]['name'];
								var fileSize = data.originalFiles[i]['size'];
								// var fileTypeAllowed = /.\.(gif|jpg|png|jpeg)$/i;
								var fileTypeAllowed = /.\.(xml)$/i;

								if(!fileTypeAllowed.test(fileName)){
										$Page.find('#progress').html('Solo archivos <b>XML</b> son permitidos');
										// $('#error').html('Solo archivos .XML son permitidos');
								// }else if( fileSize > 500000){
										// $('#error').html('Tus archivos son muy grandes');
								}else{
										$('#error').html('');
										data.submit();
								}
					}

		}).on('fileuploaddone', function (e, data){  // console.log('fileuploaddone');
					var response = jQuery.parseJSON(data.result);

					if(	response != '' ){
							if( response['status'] == 0 ){
									var lista_XML = '';
									var base_url = $("#base_url").val();

									lista_XML += '<div id="xml_'+xml_id+'" class="text-center';
									lista_XML += ' col-xs-12 col-xs-offset-0 ';
									lista_XML += ' col-sm-6 col-sm-offset-0 ';
									lista_XML += ' col-md-4 col-md-offset-0 ';
									lista_XML += ' col-lg-3 col-lg-offset-0 ';
									lista_XML += '">';
									lista_XML += '<div class="thumbnail">';
											lista_XML += '<div class="xml-header text-right">';
												// lista_XML += '<button onclick="Eliminar_XML_Tablero(\''+ response['file_name'] +'\');" id="xml_'+xml_id+'" class="btnTacos">';
												lista_XML += '<button onclick="Eliminar_XML_Tablero(\'xml_' + xml_id +'\', \'' + response['file_name'] +'\');" class="btnTacos">';
												lista_XML += 		'<i class="fa fa-times" aria-hidden="true"></i>';  xml_id++;
												lista_XML += '</button>';
											lista_XML += '</div>';

											lista_XML += '<h3>';
												lista_XML += '<i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;<b>XML</b>';
											lista_XML += '</h3>';

											lista_XML += '<h6>';
									 // lista_XML +=		'<a href="'+ response['tmp_name'] +'" target="_blank">';
											lista_XML +=		response['file_name'];
									 // lista_XML +=		'</a>';
											lista_XML += '</h6>';
									lista_XML += '</div>';
									lista_XML += '</div>';


									$Page.find('#xml_subidos').fadeIn().append( lista_XML );
									$('#btn_GenerarXML').prop('disabled', false);

									// notificaciones('success', null, 'Artículo agregado correctamente', 'this');
									// $('#btn_GenerarXML').prop('disabled', false);

							}else if( response['status'] == 1 ){
									console.log('El archivo ya existe');
							}else{
									console.log('Error al agregar el archivo');
							}
					}








					// console.log(e);
					// var status = data.jqXHR.responseJSON.status;
					// var msg = data.jqXHR.responseJSON.msg;

					// console.log(status);
					// console.log(msg);
					/*
					

					if(status == 1){
							var path = data.jqXHR.responseJSON.path;
							$('#files').fadeIn().append('<p><img src="'+path+'" alt="tmp img"></p>');
					}else{
							$('#error').html(msg);
					}
					// console.log(data);
					*/
		}).on('fileuploadprogressall', function (e, data){   // console.log('fileuploadprogressall');
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$Page.find('#progress').html('Completed: ' +  progress + '%');
		});

		///////////////////////////////////////////////////////////////

		$("#btn_GenerarXML").click(function(e) {
				e.preventDefault();
				Obtener_XMLGuardados();
		});

		$("#btn_descargar_xml").fadeOut('fast');
		// $("#btn_descargar_xml").click(function(e) {
		// 		console.log('btn_descargar_xml');
		// });
		///////////////////////////////////////////////////////////////

		$('#formSubirArticulo').submit(function(e) {
				e.preventDefault();

				$('#btnSubirArticulo').prop('disabled', true);

				var ajaxData = [];
				ajaxData['urlPHP']			= $(this).attr('action');
				ajaxData['datos']				= new FormData( document.getElementById('formSubirArticulo') );
				ajaxData['dataType']		= 'html';
				ajaxData['cache']				= false;
				ajaxData['contentType']	= false;
				ajaxData['processData']	= false;

				AjaxFunction2( ajaxData, function(response){
						console.log(response);
						//notificaciones('success', null, 'Artículo agregado correctamente', 'this');
						$('#btnSubirArticulo').prop('disabled', false);
				},function(textStatus){
						//notificaciones('fail', null, '¡Error al tratar de agregar el artículo!', null);
						console.log(textStatus);
						$('#btnSubirArticulo').prop('disabled', false);
				});
		});

		///////////////////////////////////////////////////////////////

}); /* END $(document).ready */

function Obtener_XMLGuardados(){
		var urlPHP = "C_XmlExcel/Obtener_XMLGuardados/";
		var datos = {	/*'xml_name' : xml_name*/	}

		AjaxFunction(urlPHP, datos, function(response){
				console.log(response);
		},function(textStatus){

		});
}