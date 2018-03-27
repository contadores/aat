<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ParametrosFI extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

	public function Obtener_IdsExcelesInfo( $viewInfo ){
		$this->db->select('ex_inf.Id');
		$this->db->from('ExcelesInfo AS ex_inf');
		$this->db->join('RegistrosPatronales AS rp', 'ex_inf.IdRegistroPatronal = rp.Id', 'inner');
		$this->db->join('Empresas AS emp', 'rp.IdEmpresa = emp.Id', 'inner');
		$this->db->where('emp.IdUsuario',					$viewInfo['IdUsuario']);
		$this->db->where('ex_inf.IdComparativa',	$viewInfo['IdComparativa']);
		return $this->db->get()->result_array();
	}
	public function Obtener_ComparativasGuardadas($viewInfo){
		$this->db->select('com.Id, com.Titulo, com.Anio, com.Mes, COUNT(ex_inf.IdComparativa) AS HC');
		$this->db->from('Comparativa AS com');
		$this->db->join('ExcelesInfo AS ex_inf', 'ex_inf.IdComparativa = com.Id', 'inner');
		$this->db->join('RegistrosPatronales AS rp', 'ex_inf.IdRegistroPatronal = rp.Id', 'inner');
		$this->db->join('Empresas AS emp', 'rp.IdEmpresa = emp.Id', 'inner');
		$this->db->where('emp.IdUsuario',	$viewInfo['IdUsuario']);
		$this->db->group_by('ex_inf.IdComparativa');
		return $this->db->get()->result_array();
	}

		///////////////////////////////////////////////////////

		public function Obtener_ExcelData_Mensuales($viewInfo){
				$this->db->select('	
						ex_dat.NSS, ex_dat.Nombre,
						SUM( IF( ex_inf.IdCatTipoExcel IN (6), SBC, 0) ) AS SBC_SUA,
						SUM( IF( ex_inf.IdCatTipoExcel IN (7), SBC, 0) ) AS SBC_IDSE,
						SUM( IF( ex_inf.IdCatTipoExcel IN (6), Total, 0) ) AS Total_SUA,
						SUM( IF( ex_inf.IdCatTipoExcel IN (7), Total, 0) ) AS Total_IDSE
				');
				$this->db->from('ExcelesInfo AS ex_inf');
				$this->db->join('ExcelesData AS ex_dat', 'ex_inf.Id = ex_dat.IdExcelesInfo', 'inner');
							$this->db->join('Comparativa AS comp', 'comp.Id = ex_inf.IdComparativa', 'inner');
				$this->db->where('ex_inf.IdRegistroPatronal',	$this->session->userdata('IdRegistroPatronal') );
						//$this->db->where('ex_inf.seGuardo', 	0);
							$this->db->where('comp.Id',			$viewInfo['IdComparativa']);
				$this->db->group_by('ex_dat.NSS');
				
				return $this->db->get()->result_array();
		}

		public function Obtener_ExcelData_Bimestrales($viewInfo){
				$this->db->select('	
						ex_dat.NSS, ex_dat.Nombre,
						SUM( IF( ex_inf.IdCatTipoExcel IN ( 9, 10), SBC, 0) ) AS SBC_SUA,
						SUM( IF( ex_inf.IdCatTipoExcel IN (11, 12), SBC, 0) ) AS SBC_IDSE,
						SUM( IF( ex_inf.IdCatTipoExcel IN ( 9, 10), Total, 0) ) AS Total_SUA,
						SUM( IF( ex_inf.IdCatTipoExcel IN (11, 12), Total, 0) ) AS Total_IDSE,

						SUM( IF( ex_inf.IdCatTipoExcel IN ( 9, 10), Amortizacion, 0) ) AS Amortizacion_SUA,
						SUM( IF( ex_inf.IdCatTipoExcel IN (11, 12), Amortizacion, 0) ) AS Amortizacion_IDSE

				');
				$this->db->from('ExcelesInfo AS ex_inf');
				$this->db->join('ExcelesData AS ex_dat', 'ex_inf.Id = ex_dat.IdExcelesInfo', 'inner');
							$this->db->join('Comparativa AS comp', 'comp.Id = ex_inf.IdComparativa', 'inner');
				$this->db->where('ex_inf.IdRegistroPatronal',	$this->session->userdata('IdRegistroPatronal') );
						//$this->db->where('ex_inf.seGuardo',		0);
							$this->db->where('comp.Id',			$viewInfo['IdComparativa']);
				$this->db->group_by('ex_dat.NSS');
				$this->db->group_by('ex_dat.NSS');
				$this->db->group_by('ex_dat.NSS');
				
				return $this->db->get()->result_array();
		}

		///////////////////////////////////////////////////////
		
		public function Obtener_ExcelData_Individual($viewInfo){
			if( $viewInfo['IdCatTipoExcel'] == 6 || $viewInfo['IdCatTipoExcel'] == 7 ){
				$this->db->select("ex_dat.NSS, ex_dat.Nombre, ex_dat.SBC, ex_dat.Total, ex_dat.Fila");
			}else{
				$this->db->select("ex_dat.NSS, ex_dat.Nombre, ex_dat.SBC, ex_dat.Total, ex_dat.Amortizacion, ex_dat.Fila");
			}
			
			$this->db->from('ExcelesInfo AS ex_inf');
			$this->db->join('ExcelesData AS ex_dat', 'ex_inf.Id = ex_dat.IdExcelesInfo', 'inner');
						$this->db->join('Comparativa AS comp', 'comp.Id = ex_inf.IdComparativa', 'inner');
			$this->db->where('ex_inf.IdCatTipoExcel',			$viewInfo['IdCatTipoExcel']);
						$this->db->where('comp.Id',	$viewInfo['IdComparativa']);
			
			return $this->db->get()->result_array();
		}

}

/* End of file M_HistorialComparativas.php */
/* Location: ./application/models/mi_empresa/M_HistorialComparativas.php */