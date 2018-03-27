<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Comparativa extends CI_Model
{
		public function __construct(){
				parent::__construct();
		}

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
				$this->db->where('ex_inf.IdRegistroPatronal',	$this->session->userdata('IdRegistroPatronal') );
				$this->db->where('ex_inf.seGuardo',		0);
				$this->db->group_by('ex_dat.NSS, ex_dat.Nombre');
				
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
				$this->db->where('ex_inf.IdRegistroPatronal',	$this->session->userdata('IdRegistroPatronal') );
				$this->db->where('ex_inf.seGuardo',		0);
				$this->db->group_by('ex_dat.NSS, ex_dat.Nombre');

				
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
				$this->db->join('ExcelesData AS ex_dat',			'ex_inf.Id = ex_dat.IdExcelesInfo', 'inner');
				$this->db->where('ex_inf.IdCatTipoExcel',			$viewInfo['IdCatTipoExcel']);
				$this->db->where('ex_inf.IdRegistroPatronal',	$viewInfo['IdRegistroPatronal']);
				$this->db->where('ex_inf.seGuardo',						0);
				
				return $this->db->get()->result_array();
		}

		///////////////////////////////////////////////////////

		// Guardar
		public function Guardar_ExcelInfo( $viewInfo ){
				$viewInfo['FR'] = date('Y-m-d H:i:s');
				return ($this->db->insert('ExcelesInfo', $viewInfo)) ? $this->db->insert_id() : 0;
		}
		public function Guardar_ExcelData( $viewInfo ){
				return ($this->db->insert_batch('ExcelesData', $viewInfo)) ? true : false;
		}


		// Eliminar
		public function Eliminar_Exceles( $Info ){
				$this->db->select('Id');
				$this->db->from('ExcelesInfo');
				$this->db->where('IdRegistroPatronal', $this->session->userdata('IdRegistroPatronal') );
				//$this->db->where('IdRegistroPatronal',	$Info['IdRegistroPatronal']	);
				$this->db->where('SeGuardo', 0);
						unset( $Info['IdRegistroPatronal'] );
				// $this->db->where_in('IdCatTipoExcel', $Info );
				$data_set = $this->db->get()->result_array();

				if( $data_set ){

						$IdsExcelesInfo = array();
						for ($i=0; $i < count($data_set); $i++) { 
								$IdsExcelesInfo[$i] = intval( $data_set[$i]['Id'] );
						}

						if( $this->Eliminar_ExcelInfo( $IdsExcelesInfo ) ){
								return $this->Eliminar_ExcelData( $IdsExcelesInfo );
						}else{
								return false;
						}
						
				}else{
						return false;
				}
		}


		private function Eliminar_ExcelData( $IdsExcelesInfo ){
				$this->db->where_in('IdExcelesInfo', $IdsExcelesInfo );
				return ($this->db->delete('ExcelesData')) ? true : false;
		}
		private function Eliminar_ExcelInfo( $IdsExcelesInfo ){
				$this->db->where_in('Id', $IdsExcelesInfo );
				return ($this->db->delete('ExcelesInfo')) ? true : false;
		}

		public function GuardarComparativaMensual($viewInfo)
		{
				$IdRegistroPatronal = $viewInfo['IdRegistroPatronal'];
				unset( $viewInfo['IdRegistroPatronal'] );

				$tmpExcelesInfo = array(
					'IdComparativa' => ( $this->db->insert('Comparativa', $viewInfo) ) ? $this->db->insert_id() : false,
					'SeGuardo' => 1
				);
				//$IdComparativa = ( $this->db->insert('Comparativa', $viewInfo) ) ? $this->db->insert_id() : false;
				if( $tmpExcelesInfo['IdComparativa'] != false ){
						$this->db->where_in('IdCatTipoExcel', array(6, 7) );
						$this->db->where('IdRegistroPatronal', $IdRegistroPatronal);
						$this->db->where('SeGuardo', 0);
						return ( $this->db->update('ExcelesInfo', $tmpExcelesInfo) ) ? $tmpExcelesInfo['IdComparativa'] : 0;
				}else{
					return false;
				}
		}

		public function GuardarComparativaBimestral($viewInfo)
		{
				$IdRegistroPatronal = $viewInfo['IdRegistroPatronal'];
				unset( $viewInfo['IdRegistroPatronal'] );

				$tmpExcelesInfo = array(
					'IdComparativa' => ( $this->db->insert('Comparativa', $viewInfo) ) ? $this->db->insert_id() : false,
					'SeGuardo' => 1
				);
				//$IdComparativa = ( $this->db->insert('Comparativa', $viewInfo) ) ? $this->db->insert_id() : false;
				if( $tmpExcelesInfo['IdComparativa'] != false ){
						$this->db->where_in('IdCatTipoExcel', array(9, 10, 11, 12) );
						$this->db->where('IdRegistroPatronal', $IdRegistroPatronal);
						$this->db->where('SeGuardo', 0);
						return ( $this->db->update('ExcelesInfo', $tmpExcelesInfo) ) ? $tmpExcelesInfo['IdComparativa'] : 0;
				}else{
					return false;
				}
		}
}

/* End of file M_Comparativa.php */
/* Location: ./application/models/mi_empresa/M_Comparativa.php */
