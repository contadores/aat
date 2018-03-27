<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_XmlExcel extends C_Main {

		public function __construct() {
				parent::__construct();
				$this->load->library('excel');
				$this->load->model('mi_empresa/M_HistorialComparativas');
		}

		public function index(){
				$data = $this->mainHeader();
				if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){
						$this->Borrar_XML();
						$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
				}else{
						$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
				}
				$this->mainFooter();
		}

		// Guardar
		public function GenerarXML()
		{
				// echo json_encode($_FILES['attachments']);
				$IdUsuario = intval( $this->session->userdata('IdUsuario') );

				// Guardar XMLs
				$path = 'assets/uploads/'.$IdUsuario;
				if( !file_exists($path) ){
						mkdir( $path, 0777 );
						chmod( $path, 0777 ); #Permisos a directorios/ficheros
				}

				$xml_subidos	= array();
				$name					=	$_FILES['attachments']['name'][0];
				if(	strpos($name, 'xml') !== false	){
						$tmp_name			=	$_FILES['attachments']['tmp_name'][0];
						$path_file		=	$path.'/'.$name;

						if( !file_exists($path_file) ){
								if( move_uploaded_file( $tmp_name, $path_file ) ){
										//'Subido sin problemas!'
										$xml_subidos['status'] = 0;
								}else{
										//'ERROR - Subido CON problemas!'
										$xml_subidos['status'] = 2;
								}
						}else{
								//'El Archivo Ya Existe!'
								$xml_subidos['status'] = 1;
						}

						$xml_subidos['file_name']	= $name;
						$xml_subidos['tmp_name']	= $tmp_name;
				}
				echo json_encode($xml_subidos);

				// print_r( $xml_subidos );
				// echo json_encode($xml_subidos);

				// echo json_encode('TACOS');
				// $jojo = $_FILES['attachments'];
				// echo json_encode($jojo);
		}
		// END Guardar

		public function Borrar_XML( ){
				if( $this->input->post() == null ){

						// Se borran todos en dicha carpeta
						$path = 'assets/uploads/'. intval( $this->session->userdata('IdUsuario') ) .'/*';

						// get all file names
						$files = glob( $path );

						// iterate files
						foreach($files as $file){
								if(	is_file( $file ) ){
										// delete file
										unlink( $file );
										// print_r($file);
								}
						}
				}else{
						// Se borra uno en especifico
						$path = 'assets/uploads/'. intval( $this->session->userdata('IdUsuario') ) .'/'.$this->input->post('xml_name');
						// echo json_encode( $path );
						unlink( $path );
				}
		}

		public function Obtener_XMLGuardados(){
				$xml_src = array();
				$path = 'assets/uploads/'. intval( $this->session->userdata('IdUsuario') ) .'/*';
				$files = glob( $path ); // get all file names

				foreach($files as $file){ 		// iterate files
						if(	is_file( $file ) ){
								array_push( $xml_src, $file);
						}
				}

				$array_xml_json = array();
				$xml_src_lenght = count($xml_src);
				for($i=0; $i < $xml_src_lenght; $i++){ 
						array_push( $array_xml_json, $this->XML_Contenido( $xml_src[$i] ) );
				}
				echo json_encode($array_xml_json);

				// echo $this->XML_Contenido( $xml_src[0] );
				// echo json_encode($this->XML_Contenido( $xml_src[0] ));
		}

		//////////////////////////////////////////////////////////////////////////
		//
		// Manejo de XMLs
		//
		//////////////////////////////////////////////////////////////////////////
		
		public function XML_Contenido( $xml_url ){
				// $xml_url = $_FILES['bnt1_sua']['tmp_name'];

				// Obtener el contenido del xml
				$xml_contenido	= file_get_contents( $xml_url );

				// Identificar prefijos
				$prefijos = $this->Obtener_PrefijosXML( $xml_url );
				//print_r($prefijos);

				// Filtrar contenido
				$xml_contenido	= str_replace( $prefijos, '', $xml_contenido);
				$xml_contenido	= preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xml_contenido);
				$xml_contenido	= simplexml_load_string($xml_contenido);
				// $xml_json 	=	json_encode($xml_contenido);
				// return $xml_json;

				// $xml_json 	=	json_encode($xml_contenido);
				return $xml_contenido;
		}

		private function Obtener_PrefijosXML( $xml_url ){
				//$prefijos	= array('cfdi:', 'nomina12:', 'tfd:');
				$prefijos	= array();
				$xmlObj = new XMLReader();
				$xmlObj->open( $xml_url );

				while ($xmlObj->read() ) {
						$prefijo_guardado = false;
						for( $i=0; $i < count($prefijos) ; $i++ ){ 
								if( $prefijos[$i] == $xmlObj->prefix.':' ){
										$prefijo_guardado = true;
								}
						}

						if( $prefijo_guardado == false ){
								array_push($prefijos,	$xmlObj->prefix.':' );
						}
				}
				$xmlObj->close();
				return $prefijos;
		}

}

/* End of file C_XmlExcel.php */
/* Location: ./application/controllers/C_XmlExcel.php */