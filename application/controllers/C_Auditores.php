<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/C_Main.php';
class C_Auditores extends C_Main
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//$this->load->library('campus_party');
	/*	$this->load->library('PHPExcel/Classes/PHPExcel');*/
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 2 ){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}
		$this->mainFooter();
	}
}

/* End of file C_Auditores.php */
/* Location: ./application/controllers/C_Auditores.php */
