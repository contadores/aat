$(document).ready(function(){
	ConfigurarFileInput();

	$("#btnCompararComparativa1").on("click", function(e){
		ValidarComparativa( 1 );
		e.preventDefault();
	});

	$("#btnCompararComparativa2").on("click", function(e){
		ValidarComparativa( 2 );
		e.preventDefault();
	});


}); /* END $(document).ready */

function ValidarComparativa( comparativa )
{
	if( comparativa == 1){
		if( $('#bnt1_sua').val() == ''){
			alert("Suba un archivo sua");
			$('#bnt1_sua').focus()
			return false;
		}

		if( $('#bnt2_idse').val() == ''){
			alert("Suba un archivo idse");
			$('#bnt2_idse').focus()
			return false;
		}

		/*
		if( $('#bnt3_xml').val() == ''){
			alert("Suba un archivo xml");
			$('#bnt3_xml').focus()
			return false;		
		}
		*/
	}
	else if ( comparativa == 2){
		if( $('#bnt4_sua').val() == ''){
			alert("Suba un archivo sua");
			$('#bnt4_sua').focus()
			return false;		
		}
		if( $('#bnt5_sua').val() == ''){
			alert("Suba un archivo sua");
			$('#bnt5_sua').focus()
			return false;		
		}

		if( $('#bnt6_idse').val() == ''){
			alert("Suba un archivo idse");
			$('#bnt6_idse').focus()
			return false;		
		}
		if( $('#bnt7_idse').val() == ''){
			alert("Suba un archivo idse");
			$('#bnt7_idse').focus()
			return false;		
		}

		/*
		if( $('#bnt8_xml').val() == ''){
			alert("Suba un archivo xml");
			$('#bnt8_xml').focus()
			return false;		
		}
		*/
	}
	Cargando_Show();
	$('#formComparativa' + comparativa).submit();
	//var $form = $('#formComparativa' + comparativa);
	//var actionForm = $form.attr('action');
	//$form.attr('action', actionForm + 'C_Comparativa/ComparativaMensual' );
	//$form.submit();
	//$form.attr('action', actionForm );
}

function ConfigurarFileInput(){
	// Choser
	var inputs = document.querySelectorAll('.file-input')

	for (var i = 0, len = inputs.length; i < len; i++) {
	  customInput(inputs[i])
	}
}

function customInput (el) {
  const fileInput = el.querySelector('[type="file"]')
  const label = el.querySelector('[data-js-label]')
  
  fileInput.onchange =
  fileInput.onmouseout = function () {
	if (!fileInput.value) return
	
	var value = fileInput.value.replace(/^.*[\\\/]/, '')
	el.className += ' -chosen'
	label.innerText = value
  }
}