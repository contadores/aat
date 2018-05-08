<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ParametrosFI extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	// Singular
	public function ObtenerUMA($viewInfo)
	{		
		$queryValidarParametrosFI = $this->db->query('
			select 1
			from parametrosuma AS pu
			where pu.anioPeriodoUMA ='.$viewInfo["anioPeriodoUMA"].'		
		');
		if ($queryValidarParametrosFI->num_rows() > 0)
		{
		$this->db->select('idUMA ,IFNULL(pu.UMA,0) as UMA, anioPeriodoUMA as anioPeriodoUMA
			');
		$this->db->from('parametrosuma AS pu');
		$this->db->where('pu.anioPeriodoUMA', $viewInfo['anioPeriodoUMA']);	
		$reault_array = $this->db->get()->result_array();	
		return $reault_array[0];	
		}
		else
		{
			$this->db->select('
			0 as idUMA 
			,0 as UMA
			,'.$viewInfo["anioPeriodoUMA"].' as anioPeriodoUMA
			');
			$reault_array = $this->db->get()->result_array();	
			return $reault_array[0];		
		}					
	}
	// END Singular
	
	// Singular
	public function ObtenerParametrosFI($viewInfo)
	{		
		$queryValidarParametrosFI = $this->db->query('
			select 1
			from porcentajesfactorintegracionfi AS pfi
			where pfi.IdEmpresa='.$this->session->userdata('IdEmpresa').'
			AND pfi.anioPeriodoPorcentajes ='.$viewInfo['anioPeriodoPorcentajes'].'		
		');
		if ($queryValidarParametrosFI->num_rows() > 0)
		{
			$this->db->select('pfi.IdPorcentajes as IdPorcentajes	
			,pfi.IdEmpresa as IdEmpresa		
			,pfi.diasAguinaldo as diasAguinaldo
			,pfi.anioPeriodoPorcentajes
			,pfi.porcentajePrimaVacacional as porcentajePrimaVacacional
			');
			$this->db->from('porcentajesfactorintegracionfi AS pfi');
			$this->db->where('pfi.IdEmpresa',$this->session->userdata('IdEmpresa'));	
			$this->db->where('pfi.anioPeriodoPorcentajes', $viewInfo['anioPeriodoPorcentajes']);	
			$reault_array = $this->db->get()->result_array();	
			return $reault_array[0];		
		}
		else
		{
			$this->db->select('0 as IdPorcentajes	
			,'.$this->session->userdata('IdEmpresa').' as IdEmpresa		
			,"" as diasAguinaldo
			,'.$viewInfo['anioPeriodoPorcentajes'].' as anioPeriodoPorcentajes
			,"" as porcentajePrimaVacacional
			');
			$reault_array = $this->db->get()->result_array();	
			return $reault_array[0];		
		}			
	}
	// END Singular
	
	// Obtiene los dias de vacaciones, si es personalizado por empresa o los default
	public function ObtenerDiasVacacionesFI($viewInfo)
	{
		
		$this->db->select('count(IdDiasVacaciones) as countDias');
		$this->db->from('diasvacacionesfi AS dvfi');
		$this->db->where('dvfi.IdEmpresa',$this->session->userdata('IdEmpresa'));			
		$result_arrayBusqueda = $this->db->get()->result_array();
	

		if ($result_arrayBusqueda[0]['countDias'] >1 ) {			
			$queryValidarDiasVacaciones = $this->db->query('
				select 1
				from diasvacacionesfi AS dvfi
				where dvfi.IdEmpresa='.$this->session->userdata('IdEmpresa').'
				AND dvfi.anioPeriodoVacaciones ='.$viewInfo['anioPeriodoVacaciones'].'		
			');
			if ($queryValidarDiasVacaciones->num_rows() > 0)
			{
				$this->db->select('dvfi.aniosTrabajados as aniosTrabajados, dvfi.diasVacaciones as diasVacaciones		
					');
				$this->db->from('diasvacacionesfi AS dvfi');
				$this->db->where('dvfi.IdEmpresa',$this->session->userdata('IdEmpresa'));	
				$this->db->where('dvfi.anioPeriodoVacaciones', $viewInfo['anioPeriodoVacaciones']);	
				$reault_array = $this->db->get()->result_array();	
				return $reault_array;
			}
			else
			{
				$this->db->select('dv.aniosTrabajados as aniosTrabajados,dv.diasVacaciones as diasVacaciones		
				');
				$this->db->from('diasvacaciones AS dv');		
				$this->db->order_by('IdDiasVacaciones');
				return $this->db->get()->result_array();
			}
		}
		else
		{				
		$this->db->select('dv.aniosTrabajados as aniosTrabajados,dv.diasVacaciones as diasVacaciones		
			');
		$this->db->from('diasvacaciones AS dv');		
		$this->db->order_by('IdDiasVacaciones');
		return $this->db->get()->result_array();
		}				
	}
	// END Plural

	
	// END Singular	
	
	public function GuardarUMA($viewInfo)
	{			
		if ($viewInfo['idUMA'] == 0) {			
		return ($this->db->insert('parametrosuma', $viewInfo)) ? true : false;
		} else {
			$this->db->where('idUMA', $viewInfo['idUMA']);
			return ($this->db->update('parametrosuma', $viewInfo)) ? true : false;
		}
	}
	// Guardar
	public function GuardarParametrosFI($viewInfo)
	{			

		if ($viewInfo['IdPorcentajes'] == 0) {			
		return ($this->db->insert('porcentajesfactorintegracionfi', $viewInfo)) ? true : false;
		} else {
			$this->db->where('IdPorcentajes', $viewInfo['IdPorcentajes']);
			return ($this->db->update('porcentajesfactorintegracionfi', $viewInfo)) ? true : false;
		}
	}
	// END Guardar

	
	
	
	// Guardar dias vacaciones
	public function GuardarDiasVacacionesFI($viewInfo)
	{		
		foreach ($viewInfo as $record) 
		{
			for ($i=0; $i < count($record); $i++) 
			{   
			$data[$i]['aniosTrabajados'] = $i;		
			$data[$i]['diasVacaciones'] = $record[$i];		
			$data[$i]['IdEmpresa'] =  $this->session->userdata('IdEmpresa');					
			$data[$i]['anioPeriodoVacaciones'] =  $viewInfo['anioPeriodoVacaciones'];					
			}
		}	
		/*$file = fopen("locomia2.txt", "w");							
		foreach ($viewInfo as $record) 
		{
			for ($i=0; $i < count($record); $i++) 
			{   
			$data[$i]['diasVacaciones'] = $record[$i];		
			fwrite($file, $this->session->userdata('IdEmpresa'). PHP_EOL); 	
			fwrite($file, $record[$i]. PHP_EOL); 	
			}
		}
		fclose($file);*/
		$this->db->trans_start();
		$this->db->where('IdEmpresa', $this->session->userdata('IdEmpresa'));
		$this->db->where('anioPeriodoVacaciones',  $viewInfo['anioPeriodoVacaciones']);
		$this->db->delete('diasvacacionesfi');				
		
		//$this->db->set('YOUR_COL_1', 'YOUR_VALUR_1');
		$this->db->insert_batch('diasvacacionesfi', $data);	
		$this->db->trans_complete();	
	}
	// END Guardar
	
}

/* End of file M_Empresas.php */
/* Location: ./application/models/mi_empresa/M_Empresas.php */
