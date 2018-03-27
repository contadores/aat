<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_RegistrosPatronales extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	// Plural
	public function ObtenerRegistrosPatronales()
	{
		$this->db->select('Id, RP, IdEmpresa');
		$this->db->from('RegistrosPatronales');
		return $this->db->get()->result_array();
	}
	// END Plural

	// Singular
	public function ObtenerRegistroPatronal($viewInfo)
	{
		$this->db->select('rp.Id, rp.RP,
							catMun.IdCatEstado, catEst.Elemento as Estado,
							rp.IdCatMunicipio, catMun.Elemento as Municipio,
							rp.Colonia, rp.Calle, rp.Num_ext, rp.Num_int, rp.CP, rp.IdEmpresa');
		$this->db->from('RegistrosPatronales AS rp');
		$this->db->join('CatMunicipios AS catMun', 'catMun.Id = rp.IdCatMunicipio', 'inner');
		$this->db->join('CatEstados AS catEst', 'catEst.Id = catMun.IdCatEstado', 'inner');
		$this->db->where('rp.Id', $viewInfo['Id']);
		return $this->db->get()->result_array()[0];
	}
	// END Singular

	// Guardar
	public function GuardarRegistroPatronal($viewInfo)
	{
		$viewInfo['FA'] = date('Y-m-d H:i:s');
		if ($viewInfo['Id'] == 0) {
			$viewInfo['FR'] = $viewInfo['FA'];
			return ($this->db->insert('RegistrosPatronales', $viewInfo)) ? true : false;
		} else {
			$this->db->where('Id', $viewInfo['Id']);
			return ($this->db->update('RegistrosPatronales', $viewInfo)) ? true : false;
		}
	}
	// END Guardar

	// Eliminar
	public function EliminarRegistroPatronal($viewInfo)
	{
		$this->db->where('Id', $viewInfo['Id']);
		return ($this->db->delete('RegistrosPatronales')) ? true : false;
	}

	public function EliminarRegistrosPatronales($viewInfo)
	{
		$this->db->where('IdEmpresa', $viewInfo['Id']);
		return ($this->db->delete('RegistrosPatronales')) ? true : false;
	}
	// END Eliminar
}

/* End of file M_RegistrosPatronales.php */
/* Location: ./application/models/mi_empresa/M_RegistrosPatronales.php */
