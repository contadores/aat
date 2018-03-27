<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pagos extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{

			$data['paginaActual'] = substr($this->uri->segment(1), 2);
			$this->load->view('plantillas/head.php', $data);
			$this->load->view('plantillas/header.php');

			$data['paginaActual'] = "C_".$data['paginaActual'];
			//$data['mi_menu'] = obtenerMenu();
			$data['subSeccion'] = '>';
			
			$this->load->view('plantillas/aside.php', $data);
			$this->load->view('core/V_Pagos.php');
			$this->load->view('plantillas/footer.php');
			
	}
}