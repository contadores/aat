<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>XML2JSON</title>
</head>
<body>
<?php 
	Dibujar_SimpleXML();
	Dibujar_Tabla();
?>

<?php 

?>
</body>
</html>



<?php 
	function Dibujar_SimpleXML(){
		$xml_file = simplexml_load_file( $_FILES['xml']['tmp_name'] );
		$json = json_encode($xml_file);
		echo $json;
		echo '<br><br><br>';

		$array = json_decode($json, TRUE);
		print_r( $array );
		echo '<br><br><br>';		
	}
?>

<?php function Dibujar_Tabla(){	?>
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 200%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) { background-color: #dddddd; }
	</style>


	<table>
		<tr>
			<th>name</th>						<th>prefix / localName</th>	<th>hasAttributes</th>
			<th>attributeCount</th>	<th>depth</th>							<th>hasValue</th>
			<th>nodeType</th>				<th>value</th>							<th>xmlLang</th>
			<th>isDefault</th>			<th>isEmptyElement</th>			<th>namespaceURI</th>
			<th>baseURI</th>				
		</tr>
		<tr>
			<td>El nombre calificado del nodo</td>
			<td>El prefijo del namespace asociado con el nodo /<br> El nombre local del nodo</td>
			<td>Indica si el nodo tiene atributos</td>
			<td>El número de atributos en el nodo</td>
			<td>La profundidad del nodo en el árbol, empezando en 0</td>
			<td>Indica si el nodo tiene un valor de texto</td>
			<td>El tipo de nodo para el nodo</td>
			<td>El valor de texto del nodo</td>
			<td>El xml: El lang scope el cual el nodo reside</td>
			<td>Indica si el atributo está por defecto del DTD</td>
			<td>Indica si el nodo es un elemento vacio de etiqueta</td>
			<td>El URI del namespace asociado con el nodo</td>
			<td>La base URI del nodo</td>
		</tr>

<?php
			/*
			//$xml = $_FILES['xml']['tmp_name'];
			$xml = simplexml_load_string($_FILES['xml']['tmp_name']);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			*/

			$xml = XMLReader::open( $_FILES['xml']['tmp_name'] );
			//$xml_array = array();		$contador = 0;

			while ($xml->read() ) {
				//if($xml->nodeType == XMLReader::ELEMENT && $xml->name == 'libro'){
					//echo $contador.'<br>';	$contador++;

					echo '<tr>';
						echo '<td>' . $xml->name .'</td>';
						echo '<td>' . $xml->prefix . ':' . $xml->localName .'</td>';
						echo '<td>' . $xml->hasAttributes .'</td>';
						echo '<td>' . $xml->attributeCount .'</td>';
						echo '<td>' . $xml->depth .'</td>';
						echo '<td>' . $xml->hasValue .'</td>';
						echo '<td>' . $xml->nodeType .'</td>';
						echo '<td>' . $xml->value .'</td>';
						echo '<td>' . $xml->xmlLang .'</td>';
						echo '<td>' . $xml->isDefault .'</td>';
						echo '<td>' . $xml->isEmptyElement .'</td>';
						echo '<td>' . $xml->namespaceURI .'</td>';
						echo '<td>' . $xml->baseURI .'</td>';
					echo '</tr>';

					/*
					array_push($xml_array, array(
						
						'nombre'	=> $xml->getAttribute('nombre'),
						'autor'		=> $xml->getAttribute('autor'),
						'editorial'	=> $xml->getAttribute('editorial'),
						'precio'	=> $xml->getAttribute('precio'),
						'fecha'		=> $xml->getAttribute('fecha'),
						'paginas'	=> $xml->getAttribute('paginas')
						
						'LugarExpedicion'	=> $xml->getAttribute('LugarExpedicion'),
						'tipoDeComprobante'	=> $xml->getAttribute('tipoDeComprobante'),
						'xsi'				=> $xml->getAttribute('xsi'),
						'sello'				=> $xml->getAttribute('sello'),
						'formaDePago'		=> $xml->getAttribute('formaDePago'),
						'noCertificado'		=> $xml->getAttribute('noCertificado'),
						'fecha'				=> $xml->getAttribute('fecha'),
						'version'			=> $xml->getAttribute('version'),
						'serie'				=> $xml->getAttribute('serie'),
						'certificado'		=> $xml->getAttribute('certificado'),
						'Moneda'			=> $xml->getAttribute('Moneda'),
						'TipoCambio'		=> $xml->getAttribute('TipoCambio'),
						'total'				=> $xml->getAttribute('total'),
						'subTotal'			=> $xml->getAttribute('subTotal'),
						'descuento'			=> $xml->getAttribute('descuento'),
						'folio'				=> $xml->getAttribute('folio'),
						'xmlns'				=> $xml->getAttribute('xmlns'),
						'xmlns'				=> $xml->getAttribute('xmlns'),
						'xmlns'				=> $xml->getAttribute('xmlns'),
						'fecha'				=> $xml->getAttribute('fecha'),
						'metodoDePago'		=> $xml->getAttribute('metodoDePago')
					));
					*/
				//}
			}
			//		print_r($xml_array);								echo '<br><br><br>';
			//$xml_json = json_encode($xml_array);		print_r($xml_json);
			//		echo '<br><br><br>';
			//$array = json_decode($xml_json,TRUE);		print_r($array);
			$xml->close();
		?>

		</table>
<?php
	}

	////////////// EXTRAS
	function XML_prueba(){
		$xml_url = $_FILES['bnt1_sua']['tmp_name'];		//print_r( $xml_url );
		
		//$xml_tmp = str_replace(array('cfdi:', 'msdata:'), '', $xml);
		//$xml_tmp = '<package>'.$xml_tmp.'</package>';
		//$xml_string = simplexml_load_string($xml_tmp);

		$xml_array 	= simplexml_load_file($xml_url);		//print_r($xml_array);
		$xml_json 	=	json_encode($xml_array);					//echo $xml_json;

		///$total_alumnos = count($alumnos->alumno);

		$xmlObj = new XMLReader();
		$xmlObj->open( $xml_url );	


		$loadArchivoXml = file_get_contents( $xml_url );
		$loadArchivoXml = str_replace(array('cfdi:', 'nomina12:', 'tfd:'), '', $loadArchivoXml);
		$loadArchivoXml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $loadArchivoXml);
		
		$loadArchivoXml = simplexml_load_string($loadArchivoXml);	//print_r( $loadArchivoXml );
		$xml_json 	=	json_encode($loadArchivoXml);
		//echo $xml_json;

		//foreach($loadArchivoXml->hostVirtualHost as $virtualHost) {
		//	echo "El valor de la propiedad name es: ".$virtualHost['name'];
		//}

		/*
		$tmp_array = array();
		while ($xmlObj->read() ) {
			//if($xml->nodeType == XMLReader::ELEMENT && $xml->name == 'libro'){
				//echo $contador.'<br>';	$contador++;
				array_push($tmp_array, array(
					'name'						=> $xmlObj->name,
					'prefix'					=> $xmlObj->prefix,
					'localName'				=> $xmlObj->localName,
					'hasAttributes'		=> $xmlObj->hasAttributes,
					'attributeCount'	=> $xmlObj->attributeCount,

					'depth'						=> $xmlObj->depth,
					'hasValue'				=> $xmlObj->hasValue,
					'nodeType'				=> $xmlObj->nodeType,
					'value'						=> $xmlObj->value,
					'xmlLang'					=> $xmlObj->xmlLang,

					'isDefault'				=> $xmlObj->isDefault,
					'isEmptyElement'	=> $xmlObj->isEmptyElement,
					'namespaceURI'		=> $xmlObj->namespaceURI,
					'baseURI'					=> $xmlObj->baseURI
				));

				//array_push($xml_array, array(
				//	'nombre'	=> $xml->getAttribute('nombre'),
				//	'autor'		=> $xml->getAttribute('autor'),
				//	'editorial'	=> $xml->getAttribute('editorial'),
				//	'precio'	=> $xml->getAttribute('precio'),
				//	'fecha'		=> $xml->getAttribute('fecha'),
				//	'paginas'	=> $xml->getAttribute('paginas')
					
				//	'LugarExpedicion'	=> $xml->getAttribute('LugarExpedicion'),
				//	'tipoDeComprobante'	=> $xml->getAttribute('tipoDeComprobante'),
				//	'xsi'				=> $xml->getAttribute('xsi'),
				//	'sello'				=> $xml->getAttribute('sello'),
				//	'formaDePago'		=> $xml->getAttribute('formaDePago'),
				//	'noCertificado'		=> $xml->getAttribute('noCertificado'),
				//	'fecha'				=> $xml->getAttribute('fecha'),
				//	'version'			=> $xml->getAttribute('version'),
				//	'serie'				=> $xml->getAttribute('serie'),
				//	'certificado'		=> $xml->getAttribute('certificado'),
				//	'Moneda'			=> $xml->getAttribute('Moneda'),
				//	'TipoCambio'		=> $xml->getAttribute('TipoCambio'),
				//	'total'				=> $xml->getAttribute('total'),
				//	'subTotal'			=> $xml->getAttribute('subTotal'),
				//	'descuento'			=> $xml->getAttribute('descuento'),
				//	'folio'				=> $xml->getAttribute('folio'),
				//	'xmlns'				=> $xml->getAttribute('xmlns'),
				//	'xmlns'				=> $xml->getAttribute('xmlns'),
				//	'xmlns'				=> $xml->getAttribute('xmlns'),
				//	'fecha'				=> $xml->getAttribute('fecha'),
				//	'metodoDePago'		=> $xml->getAttribute('metodoDePago')
				//));
			//}
		//}
		}
		*/

		//print_r($tmp_array);

		$xmlObj->close();

		//header('content-type: application/json; charset=utf-8');
		$eee = array('hála', 'héla', 'híla', 'hóla', 'húla');
		$iii = json_encode($eee);
		echo $iii;

		print_r( json_decode($iii, TRUE) );
	}
?>