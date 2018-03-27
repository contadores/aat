<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/C_Main.php';
class C_Empresas extends C_Main
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mi_empresa/M_Empresas');
	}

	public function index()
	{
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 1 ){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
			$this->load->view('modals/VM_EmpresaDetalles.php');
			$this->load->view('modals/VM_EmpresaNuevo.php');
			$this->load->view('modals/VM_RegistroPatronalDetalles.php');
			$this->load->view('modals/VM_RegistroPatronalNuevo.php');
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}

		$this->mainFooter();
	}

	// Plural
	public function ObtenerEmpresas()
	{
		$viewInfo = $this->input->post();
		$data_set = $this->M_Empresas->ObtenerEmpresas( $viewInfo );
		//return $data_set;
		echo json_encode($data_set);
	}
	// END Plural

	// Singular
	public function ObtenerEmpresa()
	{
		$viewInfo = $this->input->post();
		$data_set = $this->M_Empresas->ObtenerEmpresa($viewInfo);
		//Either you can print value or you can send value to database
		echo json_encode($data_set);
	}
	// END Singular

	// Guardar
	public function GuardarEmpresa()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_Empresas->GuardarEmpresa($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Guardar

	// Eliminar
	public function EliminarEmpresa()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_Empresas->EliminarEmpresa($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Eliminar
}

/* End of file C_Empresas.php */
/* Location: ./application/controllers/C_Empresas.php */
