<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_CatElementos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function ObtenerCatSexo()
	{
		$this->db->select('Id, Elemento');
		$this->db->from('CatElementos');
		$this->db->where('Catalogo', 'CatSexo');
		return $this->db->get()->result_array();
	}

	public function ObtenerCatTipoUsuario()
	{
		$this->db->select('Id, Elemento');
		$this->db->from('CatElementos');
		$this->db->where('Catalogo', 'CatTipoUsuario');
		return $this->db->get()->result_array();
	}

	public function ObtenerCatEstados()
	{
		$this->db->select('Id, Elemento');
		$this->db->from('CatEstados');
		return $this->db->get()->result_array();
	}

	public function ObtenerCatMunicipios($viewInfo = array('Id' => 28))
	{
		$this->db->select('Id, Elemento');
		$this->db->from('CatMunicipios');
		$this->db->where('IdCatEstado', $viewInfo['Id']);
		return $this->db->get()->result_array();
	}

	public function ObtenerEmpresa_RegistroPatronal( $viewInfo )
	{
		$this->db->select('emp.Id AS IdEmpresa, emp.Nombre AS Empresa, rp.RP');
		$this->db->from('RegistrosPatronales AS rp');
		$this->db->join('Empresas AS emp', 'emp.Id = rp.IdEmpresa', 'inner');
		$this->db->where('rp.Id', $viewInfo['IdRegistroPatronal']);
		return $this->db->get()->result_array()[0];
	}

}

/* End of file M_CatElementos.php */
/* Location: ./application/models/mi_empresa/M_CatElementos.php */