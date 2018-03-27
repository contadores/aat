<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_CatElementos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mi_empresa/M_CatElementos');
	}

	public function index()
	{
	}

	public function ObtenerCatSexo()
	{
		$data_set = $this->M_CatElementos->ObtenerCatSexo();
		echo json_encode($data_set);
	}

	public function ObtenerCatTipoUsuario()
	{
		$data_set = $this->M_CatElementos->ObtenerCatTipoUsuario();
		echo json_encode($data_set);
	}

	public function ObtenerCatEstados()
	{
		$data_set = $this->M_CatElementos->ObtenerCatEstados();
		echo json_encode($data_set);
	}

	public function ObtenerCatMunicipios()
	{
		$viewInfo = $this->input->post();
		$data_set = $this->M_CatElementos->ObtenerCatMunicipios($viewInfo);
		echo json_encode($data_set);
	}

}

/* End of file C_CatElementos.php */
/* Location: ./application/controllers/C_CatElementos.php */
