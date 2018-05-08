<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_DetalleNomina extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}

	// Filtra por criterios de busqueda y muestra listado de xml resultado
	public function FiltrarXML($viewInfo)
	{			
	$files=fopen("totales.txt","w");
			fwrite($files,$viewInfo['totalMin'].PHP_EOL);
			fwrite($files,$viewInfo['totalMax'].PHP_EOL);
			fclose($files);
		$this->db->select('
		x.IdxmlDocumentos as IdXML
		,IFNULL(x.comprobanteFecha,"Sin fecha")
			as fecha
			,IFNULL(x.comprobanteFolio,"Sin folio")
			as folio	
            ,IFNULL(x.receptorNombre,"Sin nombre")
			as empleado	
	 		,IFNULL(x.nominaReceptorNumSegSocial,"Sin NSS")
			as nss	
            ,IFNULL(x.comrpobanteTotal,"Sin total")
			as total	 		
		');
		$this->db->from('xmldocumentos AS x');		
		//$this->db->where('xd.IdXML',2);
		if ($viewInfo['fechaInicio'] !='')
		{
			$this->db->where('(date(SUBSTRING(x.comprobanteFecha,1,10)))>=',$viewInfo['fechaInicio']);
			$this->db->where('(date(SUBSTRING(x.comprobanteFecha,1,10)))<=',$viewInfo['fechaFin']);	
		}
		if ($viewInfo['folio'] !='')
		{
			$this->db->where('x.comprobantefolio',$viewInfo['folio']);
		}
		if ($viewInfo['empleado'] !='')
		{
			$this->db->like('x.receptorNombre',$viewInfo['empleado']);			
		}
		if ($viewInfo['nss'] !='')
		{
			$this->db->like('x.nominaReceptorNumSegSocial',$viewInfo['nss']);				
		}
		if ($viewInfo['registroPatronal'] !='')
		{
			$this->db->like('x.nominaEmisorRegistroPatronal',$viewInfo['registroPatronal']);						
		}
		if ($viewInfo['totalMin'] !='')
		{
			$this->db->where('x.comrpobanteTotal >=',$viewInfo['totalMin']);					
		}
		if ($viewInfo['totalMax'] !='')
		{
			$this->db->where('x.comrpobanteTotal <=',$viewInfo['totalMax']);	
		}			
		//$this->db->like('sd.empleado',$viewInfo['empleado']);
		$this->db->where('x.nominaVersion','1.2');	
		$this->db->where('x.IdEmpresa',$this->session->userdata('IdEmpresa'));	
		$reault_array = $this->db->get()->result_array();	
		return $reault_array;		
	}
			
			
	// Muestra los datos completos del xml seleccionado del listado de resultados.
	public function ObtenerDetalleXML($viewInfo)
	{
		$this->db->select('
			x.idxmlDocumentos as IdXML
			,IFNULL(NULLIF((x.comprobanteFormaDePago),""),"Sin información")	
			as "formaDePago"	
			,IFNULL(NULLIF((x.comprobanteFecha),""),"Sin información")	
			as "fecha"
			,IFNULL(NULLIF((x.comprobanteLugarExpedicion),""),"Sin información")	
			as "lugarExpedicion"
			,IFNULL(NULLIF((x.comprobanteTipoDeComprobante),""),"Sin información")	
			as "tipoDeComprobante"
			,IFNULL(NULLIF((x.comprobanteMetodoDePago),""),"Sin información")		
			as "metodoDePago"
			,IFNULL(NULLIF((x.emisorNombre),""),"Sin información")		
			as emisorNombre
			,IFNULL(NULLIF((x.emisorRfc),""),"Sin información")		
			as emisorRFC
			,IFNULL(NULLIF((x.emisorRegimenFiscal),""),"Sin información")		
			as emisorRegimen
			,IFNULL(NULLIF((x.ReceptorNombre),""),"Sin información")			
			as receptorNombre
			,IFNULL(NULLIF((x.ReceptorRfc),""),"Sin información")	
			as receptorRFC
			,IFNULL(NULLIF((x.nominaReceptorRiesgoPuesto),""),"Sin información")	
			as riesgoPuesto
			,IFNULL(NULLIF((x.nominaReceptorSalarioDiarioIntegrado),""),"Sin información")	
			as salarioDiarioIntegrado
			,IFNULL(NULLIF((x.nominaReceptorFechaInicioRelLaboral),""),"Sin información")	
			as inicioRelacionLaboral
			,IFNULL(NULLIF((x.nominaReceptorPeriodicidadPago),""),"Sin información")		
			as periodicidadPago
			,IFNULL(NULLIF((x.nominaFechaInicialPAgo),""),"Sin información")		
			as fechaInicialPago
			,IFNULL(NULLIF((x.nominaReceptorCURP),""),"Sin información")		
			as CURP
			,IFNULL(NULLIF((x.nominaReceptorNumSegSocial),""),"Sin información")		
			as NSS
			,IFNULL(NULLIF((x.nominaReceptorTipoJornada),""),"Sin información")				
			as tipoJornada
			,IFNULL(NULLIF((x.nominaReceptorPuesto),""),"Sin información")		
			as puesto
			,IFNULL(NULLIF((x.nominaNumDiasPagados),""),"Sin información")		
			as numeroDiasPagados
			,IFNULL(NULLIF((x.nominaFechaPago),""),"Sin información")						
			as fechaPago
			,IFNULL(NULLIF((x.nominaReceptorNumEmpleado),""),"Sin información")				
			as numeroEmpleado
			,IFNULL(NULLIF((x.nominaEmisorRegistroPatronal),""),"Sin información")			
			as registroPatronal
			,IFNULL(NULLIF((x.nominaReceptorTipoContrato),""),"Sin información")			
			as tipoContrato
			,IFNULL(NULLIF((x.nominaReceptorDepartamento),""),"Sin información")			
			as departamento
			,IFNULL(NULLIF((x.nominaFechaFinalPago),""),"Sin información")		
			as fechaFinalPago
			,IFNULL(NULLIF((x.nominaReceptorTipoRegimen),""),"Sin información")				
			as tipoRegimen
			,IFNULL(NULLIF((x.nominaVersion),""),"Sin información")		
			as version
			,IFNULL(NULLIF((x.timbradoFechaTimbrado),""),"Sin información")
			as fechaTimbrado
			,IFNULL(NULLIF((x.timbradoUUID),""),"Sin información")
			as uuid
			,IFNULL(NULLIF((x.nominaTotalPercepciones),""),"Sin información")						
			as totalPercepcion
			,IFNULL(NULLIF((x.nominaTotalDeducciones),""),"Sin información")			
			as totalDeduccion
			,IFNULL(NULLIF((x.comrpobanteTotal),""),"0")
			as totalNomina
			');
		$this->db->from('xmldocumentos AS x');		
		$this->db->where('x.idxmlDocumentos', $viewInfo['IdXML']);
		return $this->db->get()->result_array()[0];
	}

	//Obtiene las percepciones y lo une al detalle del xml seleccionado en el listado de resultados
	public function ObtenerPercepciones($viewInfo)
	{
		$query = $this->db->query('
			select 			
			IFNULL(NULLIF((p.tipoPercepcion),""),"Sin información")										
			as tipoPercepcion
			,IFNULL(NULLIF((p.clave),""),"Sin información")			
			as clave
			,IFNULL(NULLIF((p.concepto),""),"Sin información")					
			as concepto		
			,IFNULL(NULLIF((p.importeGravado),""),"0.00")			
			as importeGravado			
			,IFNULL(NULLIF((p.importeExento),""),"0.00")		
			as importeExento
			from 		
			percepciones AS p	
			where p.idxmlDocumento='.$viewInfo['IdXML'].'');		
		return $query->result();
	}
	
	//Obtiene las deducciones y lo une al detalle del xml seleccionado en el listado de resultados 
	public function ObtenerDeducciones($viewInfo)
	{
		$query = $this->db->query('
			select 			
			IFNULL(NULLIF((d.clave),""),"Sin información")										
			as clave
			,IFNULL(NULLIF((d.concepto),""),"Sin información")					
			as concepto		
			,IFNULL(NULLIF((d.importe),""),"0.00")			
			as importe			
			,IFNULL(NULLIF((d.tipoDeduccion),""),"Sin información")		
			as tipoDeduccion
			from 		
			deducciones AS d	
			where d.idxmlDocumento='.$viewInfo['IdXML'].'');		
		return $query->result();
	}
	
	//Obtiene los totales de cada concepto de todos los xml filtrados.
	public function ObtenerAcumuladoExcel($viewInfo)
	{			
		$vartmp=round(microtime(true) * 1000);
		
		$queryTempIdsEliminar = $this->db->query('	
		DROP TABLE IF EXISTS  temp_ids'.$vartmp.'
		');	
		
		$queryVacaciones = $this->db->query('
		CREATE TABLE IF NOT EXISTS  temp_ids'.$vartmp.'(ids int)'
		);
		foreach ($viewInfo as $record) 
		{			
			for ($i=0; $i < count($record); $i++) 
			{   
			$data[$i]['ids'] = $record[$i];					
			}
		}						
		$this->db->insert_batch('temp_ids'.$vartmp.'', $data);	
	 
        $sql = 'select 
			xd.IdxmlDocumentos as Ids
			,xd.nominaReceptorNumSegSocial as nss
			,trim(xd.receptorNombre) as nombre
			,xd.receptorRFC as rfc				
			,"NA" as uuid				
			,SUM(CASE WHEN tipoPercepcion="001" THEN p.importeExento+p.importeGravado ELSE 0 END) as c001
			,SUM(CASE WHEN tipoPercepcion="002" THEN p.importeExento+p.importeGravado ELSE 0 END) as c002
			,SUM(CASE WHEN tipoPercepcion="003" THEN p.importeExento+p.importeGravado ELSE 0 END) as c003
			,SUM(CASE WHEN tipoPercepcion="004" THEN p.importeExento+p.importeGravado ELSE 0 END) as c004
			,SUM(CASE WHEN tipoPercepcion="005" THEN p.importeExento+p.importeGravado ELSE 0 END) as c005
			,SUM(CASE WHEN tipoPercepcion="006" THEN p.importeExento+p.importeGravado ELSE 0 END) as c006
			,SUM(CASE WHEN tipoPercepcion="009" THEN p.importeExento+p.importeGravado ELSE 0 END) as c009
			,SUM(CASE WHEN tipoPercepcion="010" THEN p.importeExento+p.importeGravado ELSE 0 END) as c010
			,SUM(CASE WHEN tipoPercepcion="011" THEN p.importeExento+p.importeGravado ELSE 0 END) as c011
			,SUM(CASE WHEN tipoPercepcion="012" THEN p.importeExento+p.importeGravado ELSE 0 END) as c012
			,SUM(CASE WHEN tipoPercepcion="013" THEN p.importeExento+p.importeGravado ELSE 0 END) as c013
			,SUM(CASE WHEN tipoPercepcion="014" THEN p.importeExento+p.importeGravado ELSE 0 END) as c014
			,SUM(CASE WHEN tipoPercepcion="015" THEN p.importeExento+p.importeGravado ELSE 0 END) as c015
			,SUM(CASE WHEN tipoPercepcion="016" THEN p.importeExento+p.importeGravado ELSE 0 END) as c016
			,SUM(CASE WHEN tipoPercepcion="017" THEN p.importeExento+p.importeGravado ELSE 0 END) as c017
			,SUM(CASE WHEN tipoPercepcion="019" THEN p.importeExento+p.importeGravado ELSE 0 END) as c019
			,SUM(CASE WHEN tipoPercepcion="020" THEN p.importeExento+p.importeGravado ELSE 0 END) as c020
			,SUM(CASE WHEN tipoPercepcion="021" THEN p.importeExento+p.importeGravado ELSE 0 END) as c021
			,SUM(CASE WHEN tipoPercepcion="022" THEN p.importeExento+p.importeGravado ELSE 0 END) as c022
			,SUM(CASE WHEN tipoPercepcion="023" THEN p.importeExento+p.importeGravado ELSE 0 END) as c023
			,SUM(CASE WHEN tipoPercepcion="024" THEN p.importeExento+p.importeGravado ELSE 0 END) as c024
			,SUM(CASE WHEN tipoPercepcion="025" THEN p.importeExento+p.importeGravado ELSE 0 END) as c025
			,SUM(CASE WHEN tipoPercepcion="026" THEN p.importeExento+p.importeGravado ELSE 0 END) as c026
			,SUM(CASE WHEN tipoPercepcion="027" THEN p.importeExento+p.importeGravado ELSE 0 END) as c027
			,SUM(CASE WHEN tipoPercepcion="028" THEN p.importeExento+p.importeGravado ELSE 0 END) as c028
			,SUM(CASE WHEN tipoPercepcion="029" THEN p.importeExento+p.importeGravado ELSE 0 END) as c029
			,SUM(CASE WHEN tipoPercepcion="030" THEN p.importeExento+p.importeGravado ELSE 0 END) as c030
			,SUM(CASE WHEN tipoPercepcion="031" THEN p.importeExento+p.importeGravado ELSE 0 END) as c031
			,SUM(CASE WHEN tipoPercepcion="032" THEN p.importeExento+p.importeGravado ELSE 0 END) as c032
			,SUM(CASE WHEN tipoPercepcion="033" THEN p.importeExento+p.importeGravado ELSE 0 END) as c033
			,SUM(CASE WHEN tipoPercepcion="034" THEN p.importeExento+p.importeGravado ELSE 0 END) as c034
			,SUM(CASE WHEN tipoPercepcion="035" THEN p.importeExento+p.importeGravado ELSE 0 END) as c035
			,SUM(CASE WHEN tipoPercepcion="036" THEN p.importeExento+p.importeGravado ELSE 0 END) as c036
			,SUM(CASE WHEN tipoPercepcion="037" THEN p.importeExento+p.importeGravado ELSE 0 END) as c037
			,SUM(CASE WHEN tipoPercepcion="038" THEN p.importeExento+p.importeGravado ELSE 0 END) as c038
			,SUM(CASE WHEN tipoPercepcion="039" THEN p.importeExento+p.importeGravado ELSE 0 END) as c039
			,SUM(CASE WHEN tipoPercepcion="040" THEN p.importeExento+p.importeGravado ELSE 0 END) as c040
			,SUM(CASE WHEN tipoPercepcion="041" THEN p.importeExento+p.importeGravado ELSE 0 END) as c041
			,SUM(CASE WHEN tipoPercepcion="042" THEN p.importeExento+p.importeGravado ELSE 0 END) as c042
			,SUM(CASE WHEN tipoPercepcion="043" THEN p.importeExento+p.importeGravado ELSE 0 END) as c043
			,SUM(CASE WHEN tipoPercepcion="044" THEN p.importeExento+p.importeGravado ELSE 0 END) as c044
			,SUM(CASE WHEN tipoPercepcion="045" THEN p.importeExento+p.importeGravado ELSE 0 END) as c045
			,SUM(CASE WHEN tipoPercepcion="046" THEN p.importeExento+p.importeGravado ELSE 0 END) as c046
			,SUM(CASE WHEN tipoPercepcion="047" THEN p.importeExento+p.importeGravado ELSE 0 END) as c047
			,SUM(CASE WHEN tipoPercepcion="048" THEN p.importeExento+p.importeGravado ELSE 0 END) as c048
			,SUM(CASE WHEN tipoPercepcion="049" THEN p.importeExento+p.importeGravado ELSE 0 END) as c049
			,SUM(CASE WHEN tipoPercepcion="050" THEN p.importeExento+p.importeGravado ELSE 0 END) as c050
			,SUM(xd.nominaTotalSueldos) as totalPercepciones
			,SUM(xd.nominaTotalImpuestosRetenidos+xd.nominaTotalOtrasDeducciones) as totalDeducciones
			,SUM(xd.comrpobanteTotal) as total       			
			from xmldocumentos as xd 
			inner join  temp_ids'.$vartmp.' as t2 on xd.idxmlDocumentos=t2.ids		
			left join percepciones p on p.idxmlDocumento=xd.IdxmlDocumentos
			group by xd.nominaReceptorNumSegSocial
            ';            
        $query = $this->db->query($sql);	

		$queryTempIdsEliminar = $this->db->query('	
		DROP TABLE IF EXISTS  temp_ids'.$vartmp.'
		');	
		
		return $query->result_array();
		
       
	}
		
	//Obtiene los totales de cada concepto de todos los xml filtrados.
	public function ObtenerDetalleExcel($viewInfo)
	{			
		$vartmp=round(microtime(true) * 1000);
		
		$queryTempIdsEliminar = $this->db->query('	
		DROP TABLE IF EXISTS  temp_ids'.$vartmp.'
		');	
		
		$queryVacaciones = $this->db->query('
		CREATE TABLE IF NOT EXISTS  temp_ids'.$vartmp.'(ids int)'
		);
		foreach ($viewInfo as $record) 
		{			
			for ($i=0; $i < count($record); $i++) 
			{   
			$data[$i]['ids'] = $record[$i];					
			}
		}						
		$this->db->insert_batch('temp_ids'.$vartmp.'', $data);	
	 
        $sql = 'select 
			xd.IdxmlDocumentos as Ids
			,xd.nominaReceptorNumSegSocial as nss
			,trim(xd.receptorNombre) as nombre
			,xd.receptorRFC as rfc				
			,xd.timbradoUUID as uuid				
			,SUM(CASE WHEN tipoPercepcion="001" THEN p.importeExento+p.importeGravado ELSE 0 END) as c001
			,SUM(CASE WHEN tipoPercepcion="002" THEN p.importeExento+p.importeGravado ELSE 0 END) as c002
			,SUM(CASE WHEN tipoPercepcion="003" THEN p.importeExento+p.importeGravado ELSE 0 END) as c003
			,SUM(CASE WHEN tipoPercepcion="004" THEN p.importeExento+p.importeGravado ELSE 0 END) as c004
			,SUM(CASE WHEN tipoPercepcion="005" THEN p.importeExento+p.importeGravado ELSE 0 END) as c005
			,SUM(CASE WHEN tipoPercepcion="006" THEN p.importeExento+p.importeGravado ELSE 0 END) as c006
			,SUM(CASE WHEN tipoPercepcion="009" THEN p.importeExento+p.importeGravado ELSE 0 END) as c009
			,SUM(CASE WHEN tipoPercepcion="010" THEN p.importeExento+p.importeGravado ELSE 0 END) as c010
			,SUM(CASE WHEN tipoPercepcion="011" THEN p.importeExento+p.importeGravado ELSE 0 END) as c011
			,SUM(CASE WHEN tipoPercepcion="012" THEN p.importeExento+p.importeGravado ELSE 0 END) as c012
			,SUM(CASE WHEN tipoPercepcion="013" THEN p.importeExento+p.importeGravado ELSE 0 END) as c013
			,SUM(CASE WHEN tipoPercepcion="014" THEN p.importeExento+p.importeGravado ELSE 0 END) as c014
			,SUM(CASE WHEN tipoPercepcion="015" THEN p.importeExento+p.importeGravado ELSE 0 END) as c015
			,SUM(CASE WHEN tipoPercepcion="016" THEN p.importeExento+p.importeGravado ELSE 0 END) as c016
			,SUM(CASE WHEN tipoPercepcion="017" THEN p.importeExento+p.importeGravado ELSE 0 END) as c017
			,SUM(CASE WHEN tipoPercepcion="019" THEN p.importeExento+p.importeGravado ELSE 0 END) as c019
			,SUM(CASE WHEN tipoPercepcion="020" THEN p.importeExento+p.importeGravado ELSE 0 END) as c020
			,SUM(CASE WHEN tipoPercepcion="021" THEN p.importeExento+p.importeGravado ELSE 0 END) as c021
			,SUM(CASE WHEN tipoPercepcion="022" THEN p.importeExento+p.importeGravado ELSE 0 END) as c022
			,SUM(CASE WHEN tipoPercepcion="023" THEN p.importeExento+p.importeGravado ELSE 0 END) as c023
			,SUM(CASE WHEN tipoPercepcion="024" THEN p.importeExento+p.importeGravado ELSE 0 END) as c024
			,SUM(CASE WHEN tipoPercepcion="025" THEN p.importeExento+p.importeGravado ELSE 0 END) as c025
			,SUM(CASE WHEN tipoPercepcion="026" THEN p.importeExento+p.importeGravado ELSE 0 END) as c026
			,SUM(CASE WHEN tipoPercepcion="027" THEN p.importeExento+p.importeGravado ELSE 0 END) as c027
			,SUM(CASE WHEN tipoPercepcion="028" THEN p.importeExento+p.importeGravado ELSE 0 END) as c028
			,SUM(CASE WHEN tipoPercepcion="029" THEN p.importeExento+p.importeGravado ELSE 0 END) as c029
			,SUM(CASE WHEN tipoPercepcion="030" THEN p.importeExento+p.importeGravado ELSE 0 END) as c030
			,SUM(CASE WHEN tipoPercepcion="031" THEN p.importeExento+p.importeGravado ELSE 0 END) as c031
			,SUM(CASE WHEN tipoPercepcion="032" THEN p.importeExento+p.importeGravado ELSE 0 END) as c032
			,SUM(CASE WHEN tipoPercepcion="033" THEN p.importeExento+p.importeGravado ELSE 0 END) as c033
			,SUM(CASE WHEN tipoPercepcion="034" THEN p.importeExento+p.importeGravado ELSE 0 END) as c034
			,SUM(CASE WHEN tipoPercepcion="035" THEN p.importeExento+p.importeGravado ELSE 0 END) as c035
			,SUM(CASE WHEN tipoPercepcion="036" THEN p.importeExento+p.importeGravado ELSE 0 END) as c036
			,SUM(CASE WHEN tipoPercepcion="037" THEN p.importeExento+p.importeGravado ELSE 0 END) as c037
			,SUM(CASE WHEN tipoPercepcion="038" THEN p.importeExento+p.importeGravado ELSE 0 END) as c038
			,SUM(CASE WHEN tipoPercepcion="039" THEN p.importeExento+p.importeGravado ELSE 0 END) as c039
			,SUM(CASE WHEN tipoPercepcion="040" THEN p.importeExento+p.importeGravado ELSE 0 END) as c040
			,SUM(CASE WHEN tipoPercepcion="041" THEN p.importeExento+p.importeGravado ELSE 0 END) as c041
			,SUM(CASE WHEN tipoPercepcion="042" THEN p.importeExento+p.importeGravado ELSE 0 END) as c042
			,SUM(CASE WHEN tipoPercepcion="043" THEN p.importeExento+p.importeGravado ELSE 0 END) as c043
			,SUM(CASE WHEN tipoPercepcion="044" THEN p.importeExento+p.importeGravado ELSE 0 END) as c044
			,SUM(CASE WHEN tipoPercepcion="045" THEN p.importeExento+p.importeGravado ELSE 0 END) as c045
			,SUM(CASE WHEN tipoPercepcion="046" THEN p.importeExento+p.importeGravado ELSE 0 END) as c046
			,SUM(CASE WHEN tipoPercepcion="047" THEN p.importeExento+p.importeGravado ELSE 0 END) as c047
			,SUM(CASE WHEN tipoPercepcion="048" THEN p.importeExento+p.importeGravado ELSE 0 END) as c048
			,SUM(CASE WHEN tipoPercepcion="049" THEN p.importeExento+p.importeGravado ELSE 0 END) as c049
			,SUM(CASE WHEN tipoPercepcion="050" THEN p.importeExento+p.importeGravado ELSE 0 END) as c050
			,xd.nominaTotalSueldos as totalPercepciones
			,SUM(xd.nominaTotalImpuestosRetenidos+xd.nominaTotalOtrasDeducciones) as totalDeducciones
			,xd.comrpobanteTotal as total       			
			from xmldocumentos as xd 
			inner join  temp_ids'.$vartmp.' as t2 on xd.idxmlDocumentos=t2.ids		
			left join percepciones p on p.idxmlDocumento=xd.IdxmlDocumentos
			group by xd.IdxmlDocumentos
			order by nominaReceptorNumSegSocial
            ';            
        $query = $this->db->query($sql);	

		$queryTempIdsEliminar = $this->db->query('	
		DROP TABLE IF EXISTS  temp_ids'.$vartmp.'
		');	
		
		return $query->result_array();
		
       
	}
		
}
/* End of file M_DetalleNomina.php */
/* Location: ./application/models/mi_empresa/M_DetalleNomina.php */