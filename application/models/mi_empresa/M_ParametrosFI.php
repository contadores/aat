<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ParametrosFI extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	// Singular
	public function ObtenerParametrosFI()
	{		
		$this->db->select('pfi.IdPorcentajes as IdPorcentajes	
			,pfi.IdEmpresa as IdEmpresa		
			,pfi.diasAguinaldo as diasAguinaldo
			,pfi.porcentajePrimaVacacional as porcentajePrimaVacacional
			');
		$this->db->from('porcentajesfactorintegracionfi AS pfi');
		$this->db->where('pfi.IdEmpresa',$this->session->userdata('IdEmpresa'));	
		$reault_array = $this->db->get()->result_array();	
		return $reault_array[0];
		
	}
	// END Singular
	
	// Obtiene los dias de vacaciones, si es personalizado por empresa o los default
	public function ObtenerDiasVacacionesFI()
	{
		
		$this->db->select('count(IdDiasVacaciones) as countDias');
		$this->db->from('diasvacacionesfi AS dvfi');
		$this->db->where('dvfi.IdEmpresa',$this->session->userdata('IdEmpresa'));	
		$result_arrayBusqueda = $this->db->get()->result_array();
	

		if ($result_arrayBusqueda[0]['countDias'] >1 ) {			
		
		$this->db->select('dvfi.aniosTrabajados as aniosTrabajados, dvfi.diasVacaciones as diasVacaciones		
			');
		$this->db->from('diasvacacionesfi AS dvfi');
		$this->db->where('dvfi.IdEmpresa',$this->session->userdata('IdEmpresa'));	
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
	// END Plural

	
	// END Singular	
	
	
	// Guardar
	public function GuardarParametrosFI($viewInfo)
	{			

		if ($viewInfo['IdPorcentajes'] == 0) {			
		return ($this->db->insert('porcentajesfactorintegracionfi', $viewInfo)) ? true : false;
		} else {
			$this->db->where('IdPorcentajes', $viewInfo['IdPorcentajes']);
			return ($this->db->update('porcentajesfactorintegracionfi', $viewInfo)) ? true : false;
		}
		
		//Iniciamos la transacción.    
			/*
			
			
			
			$this->db->select('pfi.IdEmpresa as IdEmpresa');
		$this->db->from('porcentajesfactorintegracionfi AS pfi');
		$this->db->where('pfi.IdEmpresa',$this->session->userdata('IdEmpresa'));	
		$reault_array = $this->db->get()->result_array();		

		if ($reault_array[0]['IdEmpresa'] < 1) {			
			return ($this->db->insert('porcentajesfactorintegracionfi', $viewInfo)) ? true : false;
		} else {
			$this->db->where('IdPorcentajes', $viewInfo['IdPorcentajes']);
			return ($this->db->update('porcentajesfactorintegracionfi', $viewInfo)) ? true : false;
		}
			
			$this->db->trans_begin();  
				$sql = "insert into porcentajesfactorintegracionfi (idEmpresa,diasAguinaldo, porcentajePrimaVacacional)
					values (10,15 ,0.25)";
				$this->db->query($sql);
			if(	$this->db->trans_status() === FALSE ){
					//Hubo errores en la consulta, entonces se cancela la transacción.
					$this->db->trans_rollback();
					return false;
			}else{
					//Todas las consultas se hicieron correctamente.
					$this->db->trans_commit();
					return true;
			}*/
	}
	// END Guardar

	
	
	
	// Guardar dias vacaciones
	public function GuardarDiasVacacionesFI($viewInfo)
	{			
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
		
		$this->db->where('IdEmpresa', $this->session->userdata('IdEmpresa'));
		$this->db->delete('diasvacacionesfi');	
		
		foreach ($viewInfo as $record) 
		{
			for ($i=0; $i < count($record); $i++) 
			{   
			$data[$i]['aniosTrabajados'] = $i;		
			$data[$i]['diasVacaciones'] = $record[$i];		
			$data[$i]['IdEmpresa'] =  $this->session->userdata('IdEmpresa');					
			}
		}
		
		//$this->db->set('YOUR_COL_1', 'YOUR_VALUR_1');
		$this->db->insert_batch('diasvacacionesfi', $data);	
		
		return true;		
	}
	// END Guardar
	
}

/* End of file M_Empresas.php */
/* Location: ./application/models/mi_empresa/M_Empresas.php */
