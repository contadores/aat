<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/C_Main.php';
class C_RegistrosPatronales extends C_Main
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mi_empresa/M_RegistrosPatronales');
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

	// Plural
	public function ObtenerRegistrosPatronales()
	{
		$data_set = $this->M_RegistrosPatronales->ObtenerRegistrosPatronales();
		//return $data_set;
		echo json_encode($data_set);
	}
	// END Plural

	// Singular
	public function ObtenerRegistroPatronal()
	{
		$viewInfo = $this->input->post();
		$data_set = $this->M_RegistrosPatronales->ObtenerRegistroPatronal($viewInfo);
		//Either you can print value or you can send value to database
		echo json_encode($data_set);
	}
	// END Singular

	// Guardar
	public function GuardarRegistroPatronal()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_RegistrosPatronales->GuardarRegistroPatronal($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Guardar

	// Eliminar
	public function EliminarRegistroPatronal()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_RegistrosPatronales->EliminarRegistroPatronal($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Eliminar
}

/* End of file C_RegistrosPatronales.php */
/* Location: ./application/controllers/C_RegistrosPatronales.php */
