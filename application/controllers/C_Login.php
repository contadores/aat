<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login/V_Login.php');
		/*
		$data['mi_menu'] = obtenerMenu();
		$data['paginaActual'] = "C".substr($this->uri->segment(1), 1);
		$this->load->view('sections/header.php');
		$this->load->view('sections/nav.php',$data);
		$this->load->view('sections/aside.php');
		$this->load->view('tablilocas/V_Inicio.php');
		$this->load->view('sections/footer.php');
		*/
	}

/*
	public function Usuario()
	{
		$data['mi_menu'] = obtenerMenu();
		$data['paginaActual'] = "C".substr($this->uri->segment(1), 1);
		$this->load->view('sections/header.php');
		$this->load->view('sections/nav.php',$data);
		$this->load->view('sections/aside.php');
		$this->load->view('tablilocas/V_Inicio.php');
		$this->load->view('sections/footer.php');
	}

	public function Contrasenia()
	{
		$data['mi_menu'] = obtenerMenu();
		$data['paginaActual'] = "C".substr($this->uri->segment(1), 1);
		$this->load->view('sections/header.php');
		$this->load->view('sections/nav.php',$data);
		$this->load->view('sections/aside.php');
		$this->load->view('tablilocas/V_Inicio.php');
		$this->load->view('sections/footer.php');
	}
*/
	/*
	function index(){
		$this->load->library('menu', array('Inicio', 'Contacto', 'Curso'));
		$data['mi_menu'] = $this->menu->construirMenu();

		$this->load->view('codigofacilito/headers.php');
		$this->load->view('codigofacilito/bienvenido.php', $data);
	}
	*/
}
