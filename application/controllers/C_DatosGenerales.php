<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_DatosGenerales extends C_Main {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$data = $this->mainHeader();
			$data['paginaActual'] = substr($this->uri->segment(1), 2);
			$this->load->view('plantillas/head.php', $data);
			$this->load->view('plantillas/header.php');

			$data['paginaActual'] = "C_".$data['paginaActual'];
			//$data['mi_menu'] = obtenerMenu();
			$data['subSeccion'] = 'AGREGAR';
			
			$this->load->view('plantillas/aside.php', $data);


			$this->load->view('core/V_DatosGenerales.php');
			//$this->load->view('plantillas/footer.php');
		$this->mainFooter();
	}
}