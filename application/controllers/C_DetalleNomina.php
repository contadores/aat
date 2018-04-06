<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_DetalleNomina extends C_Main {

	public function __construct() {
		parent::__construct();
		$this->load->model('mi_empresa/M_DetalleNomina');
	}

	public function index(){
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){			
			$this->load->view('modals/VM_FiltroDetalleNomina.php');
			$this->load->view('modals/VM_AcumuladoDetalleNomina.php');
			$this->load->view('modals/VM_DetalleDocumentoXML.php');
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}
		$this->mainFooter();
	}
 // // // // // // // // // // // // // // //
}

/* End of file C_HistorialComparativas.php */
/* Location: ./application/controllers/C_HistorialComparativas.php */