<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Main extends CI_Controller {

	private $data;

	function __construct() {
			parent::__construct();
			$this->data = array();
	}
	
	public function index() {
			/*$this->load->view('campus_party/V_'.$data['titulo'].'.php', $data);*/
	}

	public function mainHeader(){
			// Configura el IdUsuario
			if( isset( $_POST['IdCatTipoUsuario'] ) ){
					$this->AsignarUsuario_Logueado(array(
						'IdUsuario'					=>	$_POST['IdUsuario'],
						'IdCatTipoUsuario'	=>	$_POST['IdCatTipoUsuario'],
						'Nombre' 						=>	$_POST['Nombre']
					));
			}
			
			// Configura el IdRegistroPatronal
			if( isset( $_POST['IdRegistroPatronal'] ) ){
					$this->ObtenerEmpresa_RegistroPatronal( $_POST['IdRegistroPatronal'] );
			}

			// Configura el IdEmpresa
			if( isset( $_POST['CambiarEmpresasAuditor'] ) ){		
					$this->ObtenerEmpresa( $_POST['CambiarEmpresasAuditor'] );
				
			}

			// Existe
			$this->data['CambiarEmpresas'] = ( isset( $_POST['CambiarEmpresas'] ) ) ? true : false;
			$this->data['IdEmpresa'] = ( isset( $_POST['CambiarEmpresasAuditor'] ) ) ?  $_POST['CambiarEmpresasAuditor']  : 0;
			$this->data['titulo'] = substr($this->uri->segment(1), 2);
			$this->load->view('plantillas/head.php', $this->data);
			$this->load->view('plantillas/cargando.php');
			$this->load->view('plantillas/header.php', $this->data);

			$this->data['paginaActual'] = "C_".$this->data['titulo'];
			$this->data['subSeccion'] = '';

			$this->load->view('plantillas/aside.php', $this->data);
			$this->load->view('plantillas/content_top.php');

			// Variable de sessión;
			$this->data['IdCatTipoUsuario'] = $this->session->userdata('IdCatTipoUsuario');
			return $this->data;
	}

	public function mainFooter(){
			$this->load->view('plantillas/content_bottom.php');
			$this->load->view('modals/VM_Confirm.php');
			$this->load->view('plantillas/footer.php');
	}

	private function AsignarUsuario_Logueado( $viewInfo ){
			$this->session->set_userdata('IdUsuario',					$viewInfo['IdUsuario']				);
			$this->session->set_userdata('IdCatTipoUsuario',	$viewInfo['IdCatTipoUsuario']	);
			$this->session->set_userdata('Nombre',						$viewInfo['Nombre']						);
	}

	private function ObtenerEmpresa_RegistroPatronal( $IdRegistroPatronal ){
			$this->load->model('mi_empresa/M_CatElementos');
			$data_set = $this->M_CatElementos->ObtenerEmpresa_RegistroPatronal(  
					array( 
						'IdRegistroPatronal' => $IdRegistroPatronal
					)
			);
			$this->session->set_userdata('Empresa',						 $data_set['Empresa']		);
			$this->session->set_userdata('IdRegistroPatronal', $IdRegistroPatronal		);
			$this->session->set_userdata('RP',								 $data_set['RP']				);
	}
	
	private function ObtenerEmpresa( $IdEmpresa ){
			$this->load->model('mi_empresa/M_EmpresasAuditor');
			$data_set = $this->M_EmpresasAuditor->ObtenerEmpresa(  
					array( 
						'IdEmpresa' => $IdEmpresa
					)
			);

			$this->session->set_userdata('IdEmpresa', $IdEmpresa		);
			$this->session->set_userdata('Empresa',	 $data_set['Empresa']	);
	}

}

/* End of file C_Main.php */
/* Location: ./application/core/C_Main.php */