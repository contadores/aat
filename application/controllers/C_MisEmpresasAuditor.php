<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_MisEmpresasAuditor extends C_Main {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{	
		$data = $this->mainHeader();
		
		if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}
		$this->mainFooter();
	}

}

/* End of file C_MisEmpresas.php */
/* Location: ./application/controllers/C_MisEmpresas.php */