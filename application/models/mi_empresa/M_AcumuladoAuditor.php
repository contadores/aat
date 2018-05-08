<?php

class M_AcumuladoAuditor extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
public function GenerarXLSAcumulado($viewInfo)
	{		
	error_reporting(E_ALL);
	set_time_limit(0);
	date_default_timezone_set('America/Monterrey');
	/*include 'Classes/PHPExcel/IOFactory.php';*/
	require_once APPPATH."/libraries/PHPExcel-1-8/Classes/PHPExcel.php";
	require_once APPPATH."/libraries/PHPExcel-1-8/Classes/PHPExcel/IOFactory.php";

#region VARIABLES A USAR
		
//Fin

/*Estos datos los debemos tomar de base de datos*/
	$anioPeriodo='1900';		
	$diasAguinaldo=15;
	$porcentajePrimaVacacional=25;
	$rfcEmpresa='';
	$nombreEmpresa='';
	$UMA=0;
	$anioPeriodo=$viewInfo['anioPeriodo'];	
	
	//Obtener diasaguinaldo, porcentaje vacaciones y rfcempresa
	$queryValidarParametrosFI = $this->db->query('
		SELECT 
		pfi.diasAguinaldo as diasAguinaldo
		,pfi.porcentajePrimaVacacional as porcentajePrimaVacacional
		,e.RFC as rfcEmpresa
		,e.Nombre as nombreEmpresa
		from porcentajesfactorintegracionfi  AS pfi
		INNER JOIN empresas AS e on e.Id=pfi.IdEmpresa
		where IdEmpresa='.$this->session->userdata('IdEmpresa').'	
		AND (anioPeriodoPorcentajes='.$anioPeriodo.' OR anioPeriodoPorcentajes=(select max(anioPeriodoPorcentajes) from porcentajesfactorintegracionfi where idEmpresa='.$this->session->userdata('IdEmpresa').')) order by anioPeriodoPorcentajes limit 1	
	');
	if ($queryValidarParametrosFI->num_rows() > 0)
	{
		$queryPocentajesFI = $queryValidarParametrosFI;
	}
	else
	{
		$queryPocentajesFI = $this->db->query('
		select
		e.RFC as  rfcEmpresa
		,e.Nombre as nombreEmpresa
		,p.diasAguinaldo as diasAguinaldo
		,p.porcentajePrimaVacacional as porcentajePrimaVacacional
		from empresas as e,porcentajesfactorintegracion AS p
		');	
	}
	
	//Obtener UMA
	$queryValidarUMA = $this->db->query('
		select 
		puma.UMA as uma
		from parametrosuma AS puma
		Where puma.anioPeriodoUMA='.$anioPeriodo.'
	');
	if ($queryValidarUMA->num_rows() > 0)
	{
		$queryObtenerUMA = $queryValidarUMA;
	}
	else
	{
		$queryObtenerUMA = $this->db->query('
		select
		max(anioPeriodoUMA)	as anioPeriodo
		puma.UMA as uma
		from parametrosuma AS puma		
		');	
	}
	
	$arrayPorcentajesFI = array();
	$iPorcentajes=0;
	foreach ($queryPocentajesFI->result_array() as $row)
	{			
		$diasAguinaldo=$row['diasAguinaldo'];
		$porcentajePrimaVacacional=$row['porcentajePrimaVacacional'];
		$rfcEmpresa=$row['rfcEmpresa'];//'CVI5006072TA'; //Este RFC se debe tomar de la base de datos segun el XLS a acumular.	
		$nombreEmpresa=$row['nombreEmpresa'];
		$iPorcentajes=$iPorcentajes+1;
	}
	
	foreach ($queryObtenerUMA->result_array() as $row)
	{			
		$UMA=$row['uma'];	
	}
	
	
	$queryTempDiasVacacionesEliminar = $this->db->query('	
	DROP TABLE IF EXISTS  temp_DiasVacaciones
	');	
	
	$queryCountVacacionesFI = $this->db->query('
	select count(dvfi.IdDiasVacaciones) as countDias
	from diasvacacionesfi AS dvfi
	Where dvfi.IdEmpresa='.$this->session->userdata('IdEmpresa').'
	AND anioPeriodoVacaciones=(select anioPeriodoVacaciones from diasvacacionesfi where idEmpresa='.$this->session->userdata('IdEmpresa').' AND (anioPeriodoVacaciones='.$anioPeriodo.' OR anioPeriodoVacaciones= (SELECT max(anioPeriodoVacaciones) from diasvacacionesfi where IdEmpresa='.$this->session->userdata('IdEmpresa').')) limit 1)
	order by dvfi.IdDiasVacaciones
	');
	if ($queryCountVacacionesFI->num_rows() > 1)
	{
		$queryVacaciones = $this->db->query('
		CREATE TABLE IF NOT EXISTS 
		temp_DiasVacaciones as ( 
		select dvfi.aniosTrabajados as aniosTrabajados, dvfi.diasVacaciones as diasVacaciones
		from diasvacacionesfi AS dvfi
		Where dvfi.IdEmpresa='.$this->session->userdata('IdEmpresa').'
		AND anioPeriodoVacaciones=(select anioPeriodoVacaciones from diasvacacionesfi where idEmpresa='.$this->session->userdata('IdEmpresa').' AND (anioPeriodoVacaciones='.$anioPeriodo.' OR anioPeriodoVacaciones= (SELECT max(anioPeriodoVacaciones) from diasvacacionesfi where IdEmpresa='.$this->session->userdata('IdEmpresa').')) limit 1)
		order by dvfi.aniosTrabajados	
		)
		');
	}
	else
	{
		$queryVacaciones = $this->db->query('
		CREATE TABLE IF NOT EXISTS 
		temp_DiasVacaciones as ( 
		select dv.aniosTrabajados as aniosTrabajados, dv.diasVacaciones as diasVacaciones
		from diasvacacionesfi AS dv
		order by dv.aniosTrabajados	
		)
	');
	}
	
	//$arrayDiasVacaciones = array();
	//$iVacaciones=0;
	//foreach ($queryVacaciones->result_array() as $row)
	//{	
	//	$arrayDiasVacaciones[$iVacaciones]=$row['diasVacaciones'];
	//	$iVacaciones=$iVacaciones+1;
	//}

/*Variables xls SUA*/	
	$colNSSSUA='A'; //Columna del Numero de seguro social	
	$colUltimoSalarioSUA='H'; //Columna del Numero de seguro social	
	$colPeriodoSUA='F1'; //Columna de periodo del SUA	
	$rfcPatronSUA='D1'; //Columna del RFC del patron del SUA, la cual debe coincidir con $rfcEmpresa.
	$registroPatronalPatronSUA='B1';
//Fin
	
#endregion	

$queryTempSUAEliminar = $this->db->query('	
DROP TABLE IF EXISTS  temp_tablesua 
');
	$queryTempSUA = $this->db->query('	
	CREATE TABLE IF NOT EXISTS 
	  temp_tablesua ( 
		bimestre int
		,regpat VARCHAR(100)  COLLATE utf8_spanish2_ci
		, nssSUA VARCHAR(100)  COLLATE utf8_spanish2_ci
		,salarioCotizacion1 decimal(10,2)
		,salarioCotizacion2 decimal(10,2)
		)
	');
	
			$suas=fopen('suas','w');	
/*CODIGO PARA SUBIR Y COMPARAR ARCHIVOS SUA*/
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
		$nombrebre_orig = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			
			 //see what extension on file image 
			  $array_nombre = explode('.',$nombrebre_orig);
			  $cuenta_arr_nombre = count($array_nombre);
			  $extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
			
			$filename = time().'_'.rand(0,100).'.'.$extension;
			
			$directorio = APPPATH.'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo		
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
				$inputFileNameSUA =APPPATH.'docs/'.$filename;
			//Read spreadsheeet workbook
			try {
				$inputFileTypeSUA = PHPExcel_IOFactory::identify($inputFileNameSUA);
				$objReaderSUA = PHPExcel_IOFactory::createReader($inputFileTypeSUA);
				$objPHPExcelSUA = $objReaderSUA->load($inputFileNameSUA);
			} catch(Exception $e) {
				die($e->getMessage());
			}
			/* Set active sheet index to the first sheet, so Excel opens this as the first sheet*/
			$objPHPExcelSUA->setActiveSheetIndex(3);
			$periodo=$objPHPExcelSUA->getActiveSheet()->getCell($colPeriodoSUA)->getValue();
			$rfcEmpresaSUA=$objPHPExcelSUA->getActiveSheet()->getCell($rfcPatronSUA)->getValue();
			$registroPatronalEmpresaSUA=$objPHPExcelSUA->getActiveSheet()->getCell($registroPatronalPatronSUA)->getValue();
			//Valida si la empresa de acumulado es la misma del archivo que se subio de SUA		
			if((trim ($rfcEmpresaSUA))==(trim ($rfcEmpresa))) 
			{		
				$anioPeriodoSUA=substr($periodo, 0, 4);
				$mesPeriodoSUA=substr($periodo, 4, 5);	
				if ($anioPeriodo==$anioPeriodoSUA)
				{		
					$bimestreSUA=round($mesPeriodoSUA/2);				
					$bimValidacion=0;				
					If(($mesPeriodoSUA%2)==0)
					{$bimValidacion=2;}
					else 
					{$bimValidacion=1;}
					$mesBimestreSUA=$bimValidacion;
					$ultimaFilaSUA = $objPHPExcelSUA->getActiveSheet()->toArray(null,true,true,true);																		
					$sua = 3;						
					while ($sua <= count($ultimaFilaSUA)):  //Recorre el EXCEL de SUA 
						$NSSSUA=$objPHPExcelSUA->getActiveSheet()->getCell(''.$colNSSSUA.''.$sua.'')->getValue();		
						$UltimoSalarioSUA=$objPHPExcelSUA->getActiveSheet()->getCell(''.$colUltimoSalarioSUA.''.$sua.'')->getValue();																
							if ($mesBimestreSUA===1)
							{												
								$queryTempSUALlenado = $this->db->query('
									insert into   temp_tablesua ( 
										bimestre
										,regpat
										, nssSUA
										,salarioCotizacion1
									)
									Values(
										'.$bimestreSUA.'
										,'.$registroPatronalEmpresaSUA.'
										,'.$NSSSUA.'
										,'.$UltimoSalarioSUA.'
									)
								');												
							}
							else
							{										
								$queryTempSUALlenado = $this->db->query('
									insert into   temp_tablesua ( 
										bimestre
										,regpat
										, nssSUA
										,salarioCotizacion2
									)
									Values(
										'.$bimestreSUA.'
										,'.$registroPatronalEmpresaSUA.'
										,'.$NSSSUA.'
										,'.$UltimoSalarioSUA.'
									)
								');
							}																					
						$sua++;
					endwhile;								
				}
			}
			closedir($dir); //Cerramos el directorio de destino
			
			$files = [$directorio.'/'.$filename];

			foreach ($files as $file) {
				if (file_exists($file)) {
					unlink($file);
				} else {
					// File not found.
				}
			}
		}
	}   
}		
	
	$queryNodos = $this->db->query('
	select 
	"Periodo" as bimestre	
	,"2017" as NSS
	,"Empresa" as registroPatronal
	,"La empresa patito mas larga de nombre" as receptorNombre
	,"" as numeroDiasPagados
	,"" as semanasTrabajadas
	,"" as salarioDiario
	,"" as concepto001
	,"" as concepto002
	,"" as concepto003
	,"" as concepto004
	,"" as concepto005
	,"" as concepto006
	,"" as concepto009
	,"" as concepto010
	,"" as concepto011
	,"" as concepto012
	,"" as concepto013
	,"" as concepto014
	,"" as concepto015
	,"" as concepto016
	,"" as concepto017	
	,"" as concepto019
	,"" as concepto020
	,"" as concepto021
	,"" as concepto022
	,"" as concepto023
	,"" as concepto024
	,"" as concepto025
	,"" as concepto026
	,"" as concepto027
	,"" as concepto028
	,"" as concepto029
	,"" as concepto030
	,"" as concepto031
	,"" as concepto032
	,"" as concepto033
	,"" as concepto034
	,"" as concepto035
	,"" as concepto036
	,"" as concepto037
	,"" as concepto038
	,"" as concepto039
	,"" as concepto040
	,"" as concepto041
	,"" as concepto042
	,"" as concepto044
	,"" as concepto045
	,"" as concepto046
	,"" as concepto047
	,"" as concepto048
	,"" as concepto049
	,"" as concepto050
	,"" as inicioRelacionLaboral
	,"" as fechaFinalPago
	,"" as diasTrabajados 
	,"" AS aniosTrabajados
	,"" AS salarioDiario2
	,"" AS factorIntegracion
	,"" AS SDI
	,"" as salarioCotizacion1 
	,"" AS salarioCotizacion2
	,"" as diferencia1 
	,"" AS diferencia2
    UNION ALL
    select 
	"BIM" as bimestre	
	,"NSS" as NSS
	,"Registro patronal" as registroPatronal
	,"Empleado" as receptorNombre
	,"Dias laborados" as numeroDiasPagados
	,"Sem" as semanasTrabajadas
	,"Salario diario" as salarioDiario
	,"Sueldo" as concepto001
	,"Gratificación anual(Aguinaldo)" as concepto002
	,"Participación de los trabajadores en la Utilidad PTU" as concepto003
	,"Reembolso de gastos médicos dentales y Hospitalarios" as concepto004
	,"Fondo de ahorro" as concepto005
	,"Caja de ahorro" as concepto006
	,"Contribuciones a cargo del trabajador pagadas por el patrón" as concepto009
	,"Premios de puntualidad" as concepto010
	,"Prima de seguro de vida" as concepto011
	,"Seguro de gastos médicos mayores" as concepto012
	,"Cuotas sindicales pagadas por el patrón" as concepto013
	,"Subsidio por incapacidad" as concepto014
	,"Becas para trabajadores y/o hijos" as concepto015
	,"Otros" as concepto016
	,"Subsidio para el empleo" as concepto017	
	,"Horas extras" as concepto019
	,"Prima dominical" as concepto020
	,"Prima vacacional" as concepto021
	,"Prima por antigüedad" as concepto022
	,"Pagos por separación" as concepto023
	,"Seguro de retiro" as concepto024
	,"Indemnizaciones" as concepto025
	,"Reembolso por funeral" as concepto026
	,"Cuotas de seguridad social pagadas por el patrón" as concepto027
	,"Comisiones" as concepto028
	,"Vales de despensa" as concepto029
	,"Vales de restaurante" as concepto030
	,"Vales de gasolina" as concepto031
	,"Vales de ropa" as concepto032
	,"Ayuda para renta" as concepto033
	,"Ayuda para artículos escolares" as concepto034
	,"Ayuda para anteojos" as concepto035
	,"Ayuda para transporte" as concepto036
	,"Ayuda para gastos de funeral" as concepto037
	,"Otros ingresos por salarios" as concepto038
	,"Jubilaciones pensiones o haberes de retiro" as concepto039
	,"Ingreso pagado por entidades federativas municipios o demarcaciones territoriales del Distrito Federal organismos" as concepto040
	,"Ingreso por entidades ederativas municipios o demarcaciones territoriales del Distrito Federal organismos" as concepto041
	,"Ingreso pagado por Entidades federativas municipios o demarcaciones territoriales del Distrito Federal organismos" as concepto042
	,"Jubilaciones pensiones o haberes de retiro en parcialidades" as concepto044
	,"Ingresos en acciones o títulos valor que representan bienes" as concepto045
	,"Ingresos asimilados a salarios" as concepto046
	,"Alimentación" as concepto047
	,"Habitación" as concepto048
	,"Premios por asistencia" as concepto049
	,"Viáticos" as concepto050
	,"Inicio relacion laboral" as inicioRelacionLaboral
	,"fecha final de pago" as fechaFinalPago
	,"dias trabajados" as diasTrabajados 
	,"años trabajados" AS aniosTrabajados
	,"Salario diario" AS salarioDiario2
	,"Factor Integración" AS factorIntegracion
	,"Salario Diario Integrado" AS SDI
	,"Cotizacion 1" as salarioCotizacion1
	,"Cotizacion 2" as salarioCotizacion2
	,"Diferencia 1" as diferencia1
	,"Diferencia 2" as diferencia2
	UNION ALL
	select 
	bimestre		
	,NSS	
	,registroPatronal	
	,receptorNombre	
	,numeroDiasPagados	
	,semanasTrabajadas		
	,(concepto001/numeroDiasPagados) as salarioDiario		
	,concepto001		
	,concepto002		
	,concepto003		
	,concepto004		
	,concepto005
	,concepto006	
	,concepto009
	,concepto010
	,concepto011
	,concepto012
	,concepto013
	,concepto014
	,concepto015
	,concepto016
	,concepto017	
	,concepto019
	,concepto020
	,concepto021
	,concepto022
	,concepto023
	,concepto024
	,concepto025
	,concepto026
	,concepto027
	,concepto028
	,concepto029
	,concepto030
	,concepto031
	,concepto032
	,concepto033
	,concepto034
	,concepto035
	,concepto036
	,concepto037
	,concepto038
	,concepto039
	,concepto040
	,concepto041
	,concepto042
	,concepto044
	,concepto045
	,concepto046
	,concepto047
	,concepto048
	,concepto049
	,concepto050
	,inicioRelacionLaboral
	,fechaFinalPago
	,diasTrabajados 
	,aniosTrabajados
	,(concepto001/numeroDiasPagados) as salarioDiario	
	,factorIntegracion
	,(concepto001/numeroDiasPagados)*factorIntegracion as SDI
	,salarioCotizacion1
	,salarioCotizacion2
	,((concepto001/numeroDiasPagados)-salarioCotizacion1) as diferencia1
	,((concepto001/numeroDiasPagados)-salarioCotizacion2) as diferencia2
    from 
    (select 
	CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2) as bimestre	
	,tbl.nominaReceptorNumSegSocial as NSS
	,tbl.nominaEmisorRegistroPatronal as registroPatronal
	,tbl.receptorNombre as receptorNombre
	,SUM(tbl.nominaNumDiasPagados) as numeroDiasPagados
	,(SUM(tbl.nominaNumDiasPagados))/7 as semanasTrabajadas
    ,IFNULL(tblP001.totalPercepcion,0) as concepto001
	,IFNULL(tblP002.totalPercepcion,0) as concepto002
	,IFNULL(tblP003.totalPercepcion,0) as concepto003
	,IFNULL(tblP004.totalPercepcion,0) as concepto004
	,IFNULL(tblP005.totalPercepcion,0) as concepto005
	,IFNULL(tblP006.totalPercepcion,0) as concepto006
	,IFNULL(tblP009.totalPercepcion,0) as concepto009
	,IFNULL(tblP010.totalPercepcion,0) as concepto010
	,IFNULL(tblP011.totalPercepcion,0) as concepto011
	,IFNULL(tblP012.totalPercepcion,0) as concepto012
	,IFNULL(tblP013.totalPercepcion,0) as concepto013
	,IFNULL(tblP014.totalPercepcion,0) as concepto014
	,IFNULL(tblP015.totalPercepcion,0) as concepto015
	,IFNULL(tblP016.totalPercepcion,0) as concepto016
	,IFNULL(tblP017.totalPercepcion,0) as concepto017	
	,IFNULL(tblP019.totalPercepcion,0) as concepto019
	,IFNULL(tblP020.totalPercepcion,0) as concepto020
	,IFNULL(tblP021.totalPercepcion,0) as concepto021
	,IFNULL(tblP022.totalPercepcion,0) as concepto022
	,IFNULL(tblP023.totalPercepcion,0) as concepto023
	,IFNULL(tblP024.totalPercepcion,0) as concepto024
	,IFNULL(tblP025.totalPercepcion,0) as concepto025
	,IFNULL(tblP026.totalPercepcion,0) as concepto026
	,IFNULL(tblP027.totalPercepcion,0) as concepto027
	,IFNULL(tblP028.totalPercepcion,0) as concepto028
	,IFNULL(tblP029.totalPercepcion,0) as concepto029
	,IFNULL(tblP030.totalPercepcion,0) as concepto030
	,IFNULL(tblP031.totalPercepcion,0) as concepto031
	,IFNULL(tblP032.totalPercepcion,0) as concepto032
	,IFNULL(tblP033.totalPercepcion,0) as concepto033
	,IFNULL(tblP034.totalPercepcion,0) as concepto034
	,IFNULL(tblP035.totalPercepcion,0) as concepto035
	,IFNULL(tblP036.totalPercepcion,0) as concepto036
	,IFNULL(tblP037.totalPercepcion,0) as concepto037
	,IFNULL(tblP038.totalPercepcion,0) as concepto038
	,IFNULL(tblP039.totalPercepcion,0) as concepto039
	,IFNULL(tblP040.totalPercepcion,0) as concepto040
	,IFNULL(tblP041.totalPercepcion,0) as concepto041
	,IFNULL(tblP042.totalPercepcion,0) as concepto042
	,IFNULL(tblP044.totalPercepcion,0) as concepto044
	,IFNULL(tblP045.totalPercepcion,0) as concepto045
	,IFNULL(tblP046.totalPercepcion,0) as concepto046
	,IFNULL(tblP047.totalPercepcion,0) as concepto047
	,IFNULL(tblP048.totalPercepcion,0) as concepto048
	,IFNULL(tblP049.totalPercepcion,0) as concepto049
	,IFNULL(tblP050.totalPercepcion,0) as concepto050
	,DATE_FORMAT(tbl.nominaReceptorFechaInicioRelLaboral, "%d/%m/%Y") as inicioRelacionLaboral
	,DATE_FORMAT(max(tbl.nominaFechaFinalPago), "%d/%m/%Y") as fechaFinalPago
	,DATEDIFF(max(tbl.nominaFechaFinalPago),tbl.nominaReceptorFechaInicioRelLaboral) as diasTrabajados 
	,TIMESTAMPDIFF(YEAR,tbl.nominaReceptorFechaInicioRelLaboral,MAX(tbl.nominaFechaFinalPago) ) AS aniosTrabajados
	,((((tmpVacaciones.diasVacaciones*'.($porcentajePrimaVacacional/100).')+'.$diasAguinaldo.')/365)+1) as factorIntegracion	
	,IFNULL(tmpsua2.salarioCotizacion1,0) as salarioCotizacion1
	,IFNULL(tmpsua2.salarioCotizacion2,0) as salarioCotizacion2
	from 
	xmldocumentos as tbl
	left join (select 
          	sum(p2.importegravado+p2.importeexento) as totalPercepcion
          	,p2.tipoPercepcion as tipoPercepcion
			,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre
			,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial
            from percepciones p2
            inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento
            where 
            x2.nominaVersion="1.2"
            AND x2.comprobanteTipoDeComprobante="egreso"
            AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017"
            group by bimestre,p2.tipoPercepcion)
			as tblP001  on tblP001.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP001.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP001.tipoPercepcion="001"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP002  on tblP002.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP002.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP002.tipoPercepcion="002"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP003  on tblP003.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP003.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP003.tipoPercepcion="003"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP004  on tblP004.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP004.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP004.tipoPercepcion="004"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP005  on tblP005.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP005.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP005.tipoPercepcion="005"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP006  on tblP006.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP006.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP006.tipoPercepcion="006"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP009  on tblP009.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP009.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP009.tipoPercepcion="009"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP010  on tblP010.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP010.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP010.tipoPercepcion="010"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP011  on tblP011.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP011.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP011.tipoPercepcion="011"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP012  on tblP012.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP012.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP012.tipoPercepcion="012"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP013  on tblP013.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP013.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP013.tipoPercepcion="013"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP014  on tblP014.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP014.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP014.tipoPercepcion="014"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP015  on tblP015.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP015.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP015.tipoPercepcion="015"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP016  on tblP016.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP016.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP016.tipoPercepcion="016"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP017  on tblP017.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP017.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP017.tipoPercepcion="017"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP019  on tblP019.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP019.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP019.tipoPercepcion="019"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP020  on tblP020.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP020.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP020.tipoPercepcion="020"
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP021  on tblP021.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP021.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP021.tipoPercepcion="021"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP022  on tblP022.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP022.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP022.tipoPercepcion="022"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP023  on tblP023.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP023.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP023.tipoPercepcion="023"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP024  on tblP024.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP024.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP024.tipoPercepcion="024"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP025  on tblP025.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP025.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP025.tipoPercepcion="025"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP026  on tblP026.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP026.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP026.tipoPercepcion="026"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP027  on tblP027.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP027.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP027.tipoPercepcion="027"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP028  on tblP028.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP028.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP028.tipoPercepcion="028"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP029  on tblP029.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP029.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP029.tipoPercepcion="029"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP030  on tblP030.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP030.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP030.tipoPercepcion="030"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP031  on tblP031.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP031.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP031.tipoPercepcion="031"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP032  on tblP032.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP032.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP032.tipoPercepcion="032"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP033  on tblP033.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP033.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP033.tipoPercepcion="033"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP034  on tblP034.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP034.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP034.tipoPercepcion="034"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP035  on tblP035.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP035.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP035.tipoPercepcion="035"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP036  on tblP036.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP036.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP036.tipoPercepcion="036"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP037  on tblP037.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP037.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP037.tipoPercepcion="037"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP038  on tblP038.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP038.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP038.tipoPercepcion="038"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP039  on tblP039.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP039.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP039.tipoPercepcion="039"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP040  on tblP040.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP040.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP040.tipoPercepcion="040"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP041  on tblP041.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP041.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP041.tipoPercepcion="041"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP042  on tblP042.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP042.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP042.tipoPercepcion="042"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP044  on tblP044.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP044.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP044.tipoPercepcion="044"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP045  on tblP045.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP045.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP045.tipoPercepcion="045"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP046  on tblP046.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP046.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP046.tipoPercepcion="046"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP047  on tblP047.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP047.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP047.tipoPercepcion="047"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP048  on tblP048.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP048.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP048.tipoPercepcion="048"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP049  on tblP049.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP049.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP049.tipoPercepcion="049"		
	left join (select sum(p2.importegravado+p2.importeexento) as totalPercepcion,p2.tipoPercepcion as tipoPercepcion,CEIL((SUBSTRING(x2.nominaFechaFinalPago,6,2))/2) as bimestre,x2.nominaReceptorNumSegSocial as nominaReceptorNumSegSocial from percepciones p2 inner join xmldocumentos as x2 on x2.IdxmlDocumentos=p2.idxmldocumento where  x2.nominaVersion="1.2" AND x2.comprobanteTipoDeComprobante="egreso" AND (SUBSTRING(x2.nominaFechaFinalPago,1,4))="2017" group by bimestre,p2.tipoPercepcion) as tblP050  on tblP050.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)
		AND tblP050.nominaReceptorNumSegSocial = tbl.nominaReceptorNumSegSocial AND tblP050.tipoPercepcion="050"		
	left join (select SUM(temp_tablesua.salarioCotizacion1) as salarioCotizacion1,SUM(temp_tablesua.salarioCotizacion2) as salarioCotizacion2,temp_tablesua.nssSUA as nssSUA,temp_tablesua.bimestre as bimestre from temp_tablesua  group by temp_tablesua.nssSUA, temp_tablesua.bimestre) as tmpsua2 on tmpsua2.nssSUA=SUBSTRING(tbl.nominaReceptorNumSegSocial,2,11) AND tmpsua2.bimestre=CEIL((SUBSTRING(tbl.nominaFechaFinalPago,6,2))/2)	
	left join temp_DiasVacaciones as tmpVacaciones on tmpVacaciones.aniosTrabajados=aniosTrabajados
	where 
		tbl.comprobanteTipoDeComprobante="egreso"
		AND tbl.nominaVersion ="1.2"
		AND
		(SUBSTRING(tbl.nominaFechaFinalPago,1,4))="2017"       
	group by bimestre,tbl.nominaReceptorNumSegSocial
	order by bimestre, tbl.nominaReceptorNumSegSocial	) as tblfinal	
    INTO OUTFILE "../../htdocs/contadores/application/controllers/acumulados/filex2.csv"
	FIELDS TERMINATED BY ","
	');	
	
$filename = APPPATH.'controllers/acumulados/filex2.csv';

header("Content-Length: " . filesize($filename));
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=concentrado.csv');

readfile($filename);

$path_user = APPPATH.'controllers/acumulados/filex2.csv';

// Create the user folder if missing
if (!file_exists($path_user)) {
   mkdir( $path_user,0777,false );
}   

// If the user file already exists, delete it
if (file_exists($path_user.$path)) unlink($path_user.$path);
/*
$filename=APPPATH.'controllers/acumulados/filex2.csv';
@header("Content-type: application/csv");
@header("Content-Disposition: attachment; filename=$filename");
echo file_get_contents('attachment.zip');
	*/
}
		
			
}
