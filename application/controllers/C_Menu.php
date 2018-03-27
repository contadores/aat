<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Menu extends CI_Controller {

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
			$data['subSeccion'] = 'INICIO';

			$this->load->view('plantillas/aside.php', $data);
			$this->load->view('core/V_Menu.php');
			$this->load->view('plantillas/footer.php');
			
	}
}