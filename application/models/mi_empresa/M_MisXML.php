<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_MisXML extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	
public function CargarXML($viewInfo)
	{		
	error_reporting(E_ALL);
	set_time_limit(0);
	date_default_timezone_set('America/Monterrey');

/*CODIGO PARA SUBIR Y COMPARAR ARCHIVOS SUA*/
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
		$nombrebre_orig = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			
			 //see what extension on file image 
			  $array_nombre = explode('.',$nombrebre_orig);
			  $cuenta_arr_nombre = count($array_nombre);
			  $extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
			
			$filename = time().'_'.rand(0,100).'.'.$extension;
			
			$directorio = APPPATH.'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
			$inputFileNameXML =APPPATH.'docs\\'.$filename;	
			$sql = "insert into nomina (IdEmpresa,FA,FR,UUID,XML) values(9,CURRENT_DATE(),CURRENT_DATE(),'',LOAD_FILE('". str_replace('\\','/',$inputFileNameXML)."'))";
			$this->db->query($sql);						
			
			//$rfcEmpresaSUA=$objPHPExcelSUA->getActiveSheet()->getCell($rfcPatronSUA)->getValue();
			//Valida si la empresa de acumulado es la misma del archivo que se subio de SUA		
			//if((trim ($rfcEmpresaSUA))==(trim ($rfcEmpresa))) 
			//{		
			//
			//}
			closedir($dir); //Cerramos el directorio de destino
			
			$files = [$directorio.'/'.$filename];

			foreach ($files as $file) {
				if (file_exists($file)) {
					unlink($file);
				} else {
					// File not found.
				}
			}
		}
	}   
}

#endregion

	
	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="' . $inputFileName . '"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
}
		
}