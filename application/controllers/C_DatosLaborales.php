<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_DatosLaborales extends CI_Controller {

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
			$data['subSeccion'] = 'AGREGAR';
			
			$this->load->view('plantillas/aside.php', $data);
			//$this->load->view('core/V_DatosLaborales.php');
			//$this->load->view('plantillas/footer.php');
			
	}
}