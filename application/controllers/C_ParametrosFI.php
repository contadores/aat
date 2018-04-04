<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/C_Main.php';
class C_ParametrosFI extends C_Main
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mi_empresa/M_ParametrosFI');
	}

	public function index()
	{
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 2 ){
			if( $this->session->userdata('IdEmpresa')>0){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
			}
			else
			{
			$this->load->view('mi_empresa/V_NoEmpresa.php', $data);			
			}
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}

		$this->mainFooter();
	}

	// END Plural

	// Singular
	public function ObtenerParametrosFI()
	{	
		$data_set = $this->M_ParametrosFI->ObtenerParametrosFI();
		//Either you can print value or you can send value to database
		echo json_encode($data_set);
	}
	// END Singular
	
	
	public function ObtenerDiasVacacionesFI()
	{	
		$data_set = $this->M_ParametrosFI->ObtenerDiasVacacionesFI();
		//Either you can print value or you can send value to database
		echo json_encode($data_set);
	}
	// END Singular	

	// Guardar
	public function GuardarParametrosFI()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_ParametrosFI->GuardarParametrosFI($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Guardar
	
	
	public function GuardarDiasVacacionesFI()
	{		
		$file = fopen("locomia.txt", "w");					
		fwrite($file, $_POST['diasVacaciones'][0]. PHP_EOL); 	
		fwrite($file, $_POST['diasVacaciones'][1]. PHP_EOL); 	
		fwrite($file, $_POST['diasVacaciones'][2]. PHP_EOL); 	
		fwrite($file, $_POST['diasVacaciones'][3]. PHP_EOL); 	
		fwrite($file, $this->input->post('diasVacaciones')[4]. PHP_EOL); 	
		fclose($file);
		
		$viewInfo  = $this->input->post();
		$resultado = $this->M_ParametrosFI->GuardarDiasVacacionesFI($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	// END Guardar
	}
}

/* End of file C_Empresas.php */
/* Location: ./application/controllers/C_Empresas.php */
