<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_DetalleNomina extends C_Main {

	public function __construct() {
		parent::__construct();
		$this->load->model('mi_empresa/M_DetalleNomina');
	}

	public function index(){
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){		
			if( $this->session->userdata('IdEmpresa')>0){		
				$this->load->view('modals/VM_FiltroDetalleNomina.php');
				$this->load->view('modals/VM_AcumuladoDetalleNomina.php');
				$this->load->view('modals/VM_DetalleDocumentoXML.php');
				$this->load->view('modals/VM_DetalleDocumentoXML.php');
				$this->load->view('modals/VM_DetalleDocumentoXMLtoXLS.php');
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
	
	// Filtra por criterios de busqueda y muestra listado de xml resultado
	public function FiltrarXML()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_DetalleNomina->FiltrarXML($viewInfo);
		echo json_encode($resultado);
	}
	
	// Muestra los datos completos del xml seleccionado del listado de resultados.
	public function ObtenerDetalleXML()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_DetalleNomina->ObtenerDetalleXML($viewInfo);
		echo json_encode($resultado);
	}		
	
	//Obtiene las percepciones y lo une al detalle del xml seleccionado en el listado de resultados 
	public function ObtenerPercepciones()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_DetalleNomina->ObtenerPercepciones($viewInfo);
		echo json_encode($resultado);
	}
	
	//Obtiene las deducciones y lo une al detalle del xml seleccionado en el listado de resultados 
	public function ObtenerDeducciones()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_DetalleNomina->ObtenerDeducciones($viewInfo);
		echo json_encode($resultado);
	}
			
	//Obtiene los totales de cada concepto de todos los xml filtrados.
	public function ObtenerAcumuladoExcel()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_DetalleNomina->ObtenerAcumuladoExcel($viewInfo);
		echo json_encode($resultado);
	}
	
	//Obtiene los totales de cada concepto de todos los xml filtrados.
	public function ObtenerDetalleExcel()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_DetalleNomina->ObtenerDetalleExcel($viewInfo);
		echo json_encode($resultado);
	}
}
/* End of file C_DetalleNomina.php */
/* Location: ./application/controllers/mi_empresa/M_DetalleNomina.php */