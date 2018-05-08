<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_MisXML extends C_Main {

	function __construct() {
		parent::__construct();
		$this->load->model('mi_empresa/M_MisXML');
	}

	public function index()
	{	
		$data = $this->mainHeader();
		
		if( $data['IdCatTipoUsuario'] == 2 ||  $data['IdCatTipoUsuario'] == 3 ){
			if( $this->session->userdata('IdEmpresa')>0){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
			}
			else
			{
			$this->load->view('mi_empresa/V_NoEmpresa.php', $data);			
			}
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}
		$this->mainFooter();
	}

	
	public function CargarXML()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_MisXML->CargarXML($viewInfo);
		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}

}


/* End of file C_MisEmpresas.php */
/* Location: ./application/controllers/C_MisEmpresas.php */