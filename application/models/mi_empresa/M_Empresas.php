<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Empresas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// Plural
	public function ObtenerEmpresas( $viewInfo = null )
	{
		$this->db->select('
				e.Id,
				e.Nombre, 
				SUM( IF( rp.RP IS NULL, 0, 1) ) AS nRP,
				e.IdUsuario
		');
		$this->db->from('Empresas AS e');
		$this->db->join('RegistrosPatronales AS rp', 'rp.IdEmpresa = e.Id', 'LEFT');
		$this->db->group_by('e.Id, e.Nombre, e.IdUsuario');
		
		//if( $viewInfo['IdCatTipoUsuario'] != 1 ){
		if( $this->session->userdata('IdCatTipoUsuario') == 2 ||
				$this->session->userdata('IdCatTipoUsuario') == 3 ){
				$this->db->where('IdUsuario', $this->session->userdata('IdUsuario'));
		}
		
		return $this->db->get()->result_array();
	}
	// END Plural

	// Singular
	public function ObtenerEmpresa($viewInfo)
	{
		$this->db->select('emp.Id, emp.Nombre, emp.RFC,
						catMun.IdCatEstado, catEst.Elemento as Estado,
						emp.IdCatMunicipio, catMun.Elemento as Municipio,
						emp.Colonia, emp.Calle, emp.Num_ext, emp.Num_int, emp.CP, emp.IdUsuario');
		$this->db->from('Empresas AS emp');
		$this->db->join('CatMunicipios AS catMun', 'catMun.Id = emp.IdCatMunicipio', 'inner');
		$this->db->join('CatEstados AS catEst', 'catEst.Id = catMun.IdCatEstado', 'inner');
		$this->db->where('emp.Id', $viewInfo['Id']);
		return $this->db->get()->result_array()[0];
	}
	// END Singular

	// Guardar
	public function GuardarEmpresa($viewInfo)
	{
		$viewInfo['FA'] = date('Y-m-d H:i:s');
		if ($viewInfo['Id'] == 0) {
			$viewInfo['FR'] = $viewInfo['FA'];
			return ($this->db->insert('Empresas', $viewInfo)) ? true : false;
		} else {
			$this->db->where('Id', $viewInfo['Id']);
			return ($this->db->update('Empresas', $viewInfo)) ? true : false;
		}
	}
	// END Guardar

	// Eliminar
	public function EliminarEmpresa($viewInfo)
	{
		require_once 'M_RegistrosPatronales.php';
		$tmp = new M_RegistrosPatronales();

		if ($tmp->EliminarRegistrosPatronales($viewInfo)) {
			return ($this->db->delete('Empresas', $viewInfo)) ? true : false;
		} else {
			return false;
		}
	}

	// END Eliminar
}

/* End of file M_Empresas.php */
/* Location: ./application/models/mi_empresa/M_Empresas.php */
