<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/C_Main.php';
class C_Usuarios extends C_Main
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mi_empresa/M_Usuarios');
	}

	public function index()
	{
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 1 ){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
			$this->load->view('modals/VM_UsuarioDetalles.php');
			$this->load->view('modals/VM_UsuarioNuevo.php');
			$this->load->view('modals/VM_Relacion_UsuarioEmpresa.php');
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}

		$this->mainFooter();
	}

	// Plural
	public function ObtenerUsuarios()
	{
		$data_set = $this->M_Usuarios->ObtenerUsuarios();
		echo json_encode($data_set);
	}
	// END Plural

	// Singular
	public function ObtenerUsuario()
	{
		$viewInfo = $this->input->post();
		$data_set = $this->M_Usuarios->ObtenerUsuario($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($data_set);
	}
	// END Singular

	// Guardar
	public function GuardarUsuario()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_Usuarios->GuardarUsuario($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Guardar

	// Eliminar
	public function EliminarUsuario()
	{
		$viewInfo  = $this->input->post();
		$resultado = $this->M_Usuarios->EliminarUsuario($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}
	// END Eliminar

	public function ObtenerUsuario_Logueado(){
		$viewInfo  = $this->input->post();
		$resultado = $this->M_Usuarios->ObtenerUsuario_Logueado($viewInfo);

		//Either you can print value or you can send value to database
		echo json_encode($resultado);
	}


	// Relacion_UsuarioEmpresa
	public function Obtener_Mis_Empresas(){
			$data_set = $this->M_Usuarios->Obtener_Mis_Empresas( $this->input->post() );
			echo json_encode($data_set);
	}
	public function Obtener_Empresas_Registradas(){
			$data_set = $this->M_Usuarios->Obtener_Empresas_Registradas( $this->input->post() );
			echo json_encode($data_set);
	}

	public function GuardarRelacion_UsuarioEmpresa(){
 			$data_set	= $this->M_Usuarios->GuardarRelacion_UsuarioEmpresa( $this->input->post('tr_modificados') );
			echo json_encode( $data_set );

			//
			// try{
			// 		$this->db->trans_begin();

			// 		$agregadas		= $this->input->post('agregadas');
			// 		$registradas	= $this->input->post('registradas');

			// 		$data_set1 = (count($agregadas) > 0) 		? $this->M_Usuarios->GuardarRelacion_UsuarioEmpresa( $agregadas ) : true;
			// 		$data_set2 = (count($registradas) > 0) 	? $this->M_Usuarios->GuardarRelacion_UsuarioEmpresa( $registradas ) : true;

			// 		// echo json_encode( $data_set1 && $data_set2 );
			// 		echo json_encode( array('agregadas' => $data_set1, 'registradas' => $data_set2) );

			// 		$this->db->trans_commit();
			// }catch(PDOException $ex){
			// 		$this->db->trans_rollback();
			// 		die('No se pudo guardar el usuario');
			// }
	}

}

/* End of file C_Usuarios.php */
/* Location: ./application/controllers/C_Usuarios.php */
