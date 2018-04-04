<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_AcumuladoAuditor extends C_Main {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{	
		$data = $this->mainHeader();
		
		if( $data['IdCatTipoUsuario'] == 2 ){
			if( $this->session->userdata('IdEmpresa')>0){
			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
			}
			else
			{
			$this->load->view('mi_empresa/V_NoEmpresa.php', $data);			
			}
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}
		$this->mainFooter();
	}

	
	public function GenerarXLSAcumulado()
	{
		error_reporting(E_ALL);
set_time_limit(0);
date_default_timezone_set('America/Monterrey');
/*include 'Classes/PHPExcel/IOFactory.php';*/
require_once APPPATH."/libraries/PHPExcel-1-8/Classes/PHPExcel.php";


/*Variables xls acumulado*/
	$filaClavesOcultas=3; //Fila donde estan las claves de los conceptos, con los que se identificaran donde agregar columnas y formulas.
	$filaEncabezados=4; //Fila de los encabezados de cada columna
	$filaInicial=5; //Fila donde se inicia a listar los empleados
	$ultimaFila=5;//Poner como valor inicial de var ultimafila a partir de donde se muestran los empleados.
	$claveConcepto=array();
	$claveAdicionales=array();
	$claveSueldo= '001';//Sueldo; No se pone como array por que no se aplica formula
	
	//Conceptos que se aplicara formula
	$claveConcepto['HorExt']= '019';//Horas extras
	$claveConcepto['PreAsi']= '049';//Premio asistencia
	$claveConcepto['PrePun']= '010';//Premio puntualidad
	$claveConcepto['Aguina']= '002';//Aguinaldo
	$claveConcepto['Despen']= '029';//Despensa
	$claveConcepto['Alimen']= '047';//Alimentacion
	$claveConcepto['Habita']= '048';//Habitacion
	$claveConcepto['DesEfe']= '038';//Despensa efectivo
	$claveAdicionales['anios']= '999999';//Años laborados
	$colBim='A'; //Columna del bimestre
	$colNSS='B'; //Columna del Numero de seguro social
	$colRegistroPatronal='C';//Es el registro patronal de la empresa, ya que el excel puede contener varios registros patronales.
	$colEmpleado='D'; //Columna de nombre del empleado
	$colDiasLaborados='E'; //Columna de Dias laborados por el empleado
	$colSem='F'; //Solumna de semanas trabajadas por el empleado
	$colSalarioDiario='G';	//Columna de Salario diario del empleado.
	$colCotizacion1=999; //Columna de cotizacion mes 1 del bimestre SUA, se asigna al cargar los archivos SUA
	$colCotizacion2=999; //Columna de cotizacion mes 2 del bimestre SUA, se asigna al cargar los archivos SUA
	$colDiferencia1=999; //Columna de diferencia mes 1 del bimestre SUA, se asigna al cargar los archivos SUA
	$colDiferencia2=999; //Columna de diferencia mes 2 del bimestre SUA, se asigna al cargar los archivos SUA
		
//Fin
/*Estos datos los debemos tomar de base de datos*/
	$anioPeriodo='2018';	
	$diasAguinaldo=15;
	$porcentajePrimaVacacional=0.10;
	$arrayDiasVacaciones=array();
	$arrayDiasVacaciones[0]= 0;
	$arrayDiasVacaciones[1]= 6;
	$arrayDiasVacaciones[2]= 8;
	$arrayDiasVacaciones[3]= 10;
	$arrayDiasVacaciones[4]= 12;
	$arrayDiasVacaciones[5]= 14;
	$arrayDiasVacaciones[6]= 14;
	$arrayDiasVacaciones[7]= 14;
	$arrayDiasVacaciones[8]= 14;
	$arrayDiasVacaciones[9]= 14;
	$arrayDiasVacaciones[10]= 16;
	$arrayDiasVacaciones[11]= 16;
	$arrayDiasVacaciones[12]= 17;
	$arrayDiasVacaciones[13]= 18;
	$rfcEmpresa='CVI5006072TA'; //Este RFC se debe tomar de la base de datos segun el XLS a acumular.
//Fin

/*Variables xls SUA*/	
	$colNSSSUA='A'; //Columna del Numero de seguro social	
	$colUltimoSalarioSUA='H'; //Columna del Numero de seguro social	
	$colPeriodoSUA='F1'; //Columna de periodo del SUA	
	$rfcPatronSUA='D1'; //Columna del RFC del patron del SUA, la cual debe coincidir con $rfcEmpresa.
//Fin
	
/*Obtener excel acumulado del periodo*/
	//NOTA: El filename se deberia obtener de base de datos. Por ahora es en duro.	
	$inputFileName =APPPATH.'Controllers/acumulados/RFCEMP2017.xlsx';
	try 
	{
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	}
	catch(Exception $e) 
	{
			die($e->getMessage());
    }
//Fin


/*Variables obtenidas del XLSX*/
$ultimaFila = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$colSueldo='H';
	$s = 1;
	while ($claveSueldo != $objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($s).''.$filaClavesOcultas.'')->getValue()):   			
		$s++;
	endwhile;
	$colSueldo=PHPExcel_Cell::stringFromColumnIndex($s);
//Fin


/*Insertar columnas y agregar formulas*/
	$objPHPExcel->setActiveSheetIndex(0);	
	$objPHPExcel->getActiveSheet()->freezePane('H5');
	foreach ($claveConcepto as $clave=>$valor)
   		{
			$i = 1;
			while ($valor != $objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).''.$filaClavesOcultas.'')->getValue()):   			
				$i++;
			endwhile;					
			
		//Columna Excenta
			$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($i+1), 1);
				$objPHPExcel->getActiveSheet() //Pone titulo a columna
				->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$filaEncabezados.'','Excenta')
				;					
			switch ($valor) {
			case "019": //Horas extras		
				for ($f = $filaInicial; $f < count($ultimaFila); $f++) {	
					$objPHPExcel->getActiveSheet()				
					->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$f.'', '=(((('.$colSalarioDiario.''.$f.'/8)*2)*9)*'.$colSem.''.$f.')')					
					;
				}    
			break;
			case "049": //Premio asistencia		
				for ($f = $filaInicial; $f < count($ultimaFila); $f++) {	
					$objPHPExcel->getActiveSheet()				
					->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$f.'', '=('.$colSueldo.''.$f.'*0.1)')					
					;
				}    
			break;
			case "010": //Premio puntualidad		
				for ($f = $filaInicial; $f < count($ultimaFila); $f++) {	
					$objPHPExcel->getActiveSheet()				
					->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$f.'', '=('.$colSueldo.''.$f.'*0.1)')					
					;
				}    
			break;
			case "002": //Aguinaldo	
				for ($f = $filaInicial; $f < count($ultimaFila); $f++) {	
					$objPHPExcel->getActiveSheet()				
					->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$f.'', '=('.$colSalarioDiario.''.$f.'*15)')					
					;
				}    
			break;
			case "029": //Despensa	
				for ($f = $filaInicial; $f < count($ultimaFila); $f++) {	
					$objPHPExcel->getActiveSheet()				
					->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$f.'', '=(73.04*0.4)*'.$colDiasLaborados.$f.'')					
					;
				}    
			break;				
			}
			$objPHPExcel->getActiveSheet()
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($i+1).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($i+1).''.(count($ultimaFila)-1).')')
			;	
			$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)';
			$textFormat='@';//'General','0.00','@'
			$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($i+1).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);											

		//Columna Gravada
			$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($i+2), 1); //Agrega columna
			$objPHPExcel->getActiveSheet() //Pone titulo a columna
				->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+2).''.$filaEncabezados.'','Gravada')
				;
			for ($f = $filaInicial; $f < count($ultimaFila); $f++) {//Agrega formula a cada fila
				$objPHPExcel->getActiveSheet()
				->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+2).''.$f.'', '=IF(('.PHPExcel_Cell::stringFromColumnIndex($i).$f.'-'.PHPExcel_Cell::stringFromColumnIndex($i+1).$f.')<=0,"0.00",('.PHPExcel_Cell::stringFromColumnIndex($i).$f.'-'.PHPExcel_Cell::stringFromColumnIndex($i+1).$f.'))')
				;
			}    
			$objPHPExcel->getActiveSheet() //Agrega suma al final de la columna
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($i+2).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($i+2).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($i+2).''.(count($ultimaFila)-1).')')
			;	
			$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
			$textFormat='@';//'General','0.00','@'
			$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($i+2).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);						
		}	
//Fin

//Crea columnas de comparativa del SUA
	$ultimaColumna=$objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
	$ultimaColumnaInt=PHPExcel_Cell::columnIndexFromString($ultimaColumna)-1;
	
	//Crea columna Salario diario
	
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.$filaEncabezados.'','Salario diario')
		;
		$colSD2=$ultimaColumnaInt;
		
		for ($f = $filaInicial; $f < count($ultimaFila); $f++) {//Agrega formula a cada fila
			$objPHPExcel->getActiveSheet()
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.$f.'', '='.$colSalarioDiario.''.$f.'');
			
			$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
			$textFormat='@';//'General','0.00','@'
			$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.$f.'')->getNumberFormat()->setFormatCode($currencyFormat);									
			;
		}    
		
		$objPHPExcel->getActiveSheet() //Agrega suma al final de la columna Salario diario
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.(count($ultimaFila)-1).')')
		;	
		$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
		$textFormat='@';//'General','0.00','@'
		$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);						
	
	//Crea columna Factor de integración
	
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+1), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+1).''.$filaEncabezados.'','Factor de integración')
		;
		$colFI=$ultimaColumnaInt+1;
		
		$colAnio = 1;
			while ($claveAdicionales['anios'] != $objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($colAnio).''.$filaClavesOcultas.'')->getValue()):   			
				$colAnio++;
			endwhile;			
		
		for ($f = $filaInicial; $f < count($ultimaFila); $f++) {//Agrega formula a cada fila
			$aniosTrabajados=$objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($colAnio).$f)->getValue();
			if($aniosTrabajados === NULL){$aniosTrabajados=0;}
			$objPHPExcel->getActiveSheet()
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colFI).''.$f.'', '='.$arrayDiasVacaciones[$aniosTrabajados].'')
			;
		}    
		
		$objPHPExcel->getActiveSheet() //Agrega suma al final de la columna Salario diario
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colFI).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($colFI).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($colFI).''.(count($ultimaFila)-1).')')
		;	
		$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
		$textFormat='@';//'General','0.00','@'
		$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($colFI).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);						
	
	
	
	//Crea columna Salario Diario Integrado
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+2), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+2).''.$filaEncabezados.'','Salario Diario Integrado')
		;
		$colSDI=$ultimaColumnaInt+2;
		
		for ($f = $filaInicial; $f < count($ultimaFila); $f++) {//Agrega formula a cada fila
			$objPHPExcel->getActiveSheet()
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colSDI).''.$f.'', '='.PHPExcel_Cell::stringFromColumnIndex($colSD2).''.$f.'*'.PHPExcel_Cell::stringFromColumnIndex($colFI).''.$f.'')
			;
		}    
		
		$objPHPExcel->getActiveSheet() //Agrega suma al final de la columna Salario diario
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colSDI).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($colSDI).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($colSDI).''.(count($ultimaFila)-1).')')
		;	
		$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
		$textFormat='@';//'General','0.00','@'
		$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($colSDI).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);						
	
	
		
	//Crea columna Salario Diario Base Cotización
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+3), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+3).''.$filaEncabezados.'','Salario Diario Base Cotización')
		;
		$colSDBC=$ultimaColumnaInt+3;
		
	//Crea columna Cotizacion 1
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+4), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+4).''.$filaEncabezados.'','Cotización 1')
		;
		$colCotizacion1=$ultimaColumnaInt+4;
	
	//Crea columna Cotizacion 2
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+5), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+5).''.$filaEncabezados.'','Cotización 2')
		;
		$colCotizacion2=$ultimaColumnaInt+5;
	
	//Crea columna Diferencia 1
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+6), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+6).''.$filaEncabezados.'','Diferencia 1')
		;
		$colDiferencia1=$ultimaColumnaInt+6;
	
		for ($f = $filaInicial; $f < count($ultimaFila); $f++) {//Agrega formula a cada fila
			$objPHPExcel->getActiveSheet()
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colDiferencia1).''.$f.'', '='.PHPExcel_Cell::stringFromColumnIndex($colSD2).''.$f.'-'.PHPExcel_Cell::stringFromColumnIndex($colCotizacion1).''.$f.'')
			;
		}    
		
		$objPHPExcel->getActiveSheet() //Agrega suma al final de la columna Salario diario
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colDiferencia1).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($colDiferencia1).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($colDiferencia1).''.(count($ultimaFila)-1).')')
		;	
		$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
		$textFormat='@';//'General','0.00','@'
		$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($colDiferencia1).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);						
	
	
	//Crea columna Diferencia 2
		$objPHPExcel->getActiveSheet()->insertNewColumnBefore(PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+7), 1); //Agrega columna
		$objPHPExcel->getActiveSheet() //Pone titulo a columna
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($ultimaColumnaInt+7).''.$filaEncabezados.'','Diferencia 2')
		;
		$colDiferencia2=$ultimaColumnaInt+7;
		
		for ($f = $filaInicial; $f < count($ultimaFila); $f++) {//Agrega formula a cada fila
			$objPHPExcel->getActiveSheet()
			->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colDiferencia2).''.$f.'', '='.PHPExcel_Cell::stringFromColumnIndex($colSD2).''.$f.'-'.PHPExcel_Cell::stringFromColumnIndex($colCotizacion2).''.$f.'')
			;
		}    
		
		$objPHPExcel->getActiveSheet() //Agrega suma al final de la columna Salario diario
		->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colDiferencia2).''.count($ultimaFila).'','=SUM('.PHPExcel_Cell::stringFromColumnIndex($colDiferencia2).''.$filaInicial.':'.PHPExcel_Cell::stringFromColumnIndex($colDiferencia2).''.(count($ultimaFila)-1).')')
		;	
		$currencyFormat = '_($* #,##0.00_);_($* (#,##0.00);_($* "-"??_);_(@_)'; //Da formato a final de columna como dinero
		$textFormat='@';//'General','0.00','@'
		$objPHPExcel->getActiveSheet()->getStyle(''.PHPExcel_Cell::stringFromColumnIndex($colDiferencia2).''.count($ultimaFila).'')->getNumberFormat()->setFormatCode($currencyFormat);						
	
//Fin

/*CODIGO PARA SUBIR Y COMPARAR ARCHIVOS SUA*/
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
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
				$objPHPExcelSUA = $objReader->load($inputFileNameSUA);
			} catch(Exception $e) {
				die($e->getMessage());
			}
			
			/* Set active sheet index to the first sheet, so Excel opens this as the first sheet*/
			$objPHPExcelSUA->setActiveSheetIndex(3);
			$periodo=$objPHPExcelSUA->getActiveSheet()->getCell($colPeriodoSUA)->getValue();
			$rfcEmpresaSUA=$objPHPExcelSUA->getActiveSheet()->getCell($rfcPatronSUA)->getValue();
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
						$xlsComp =$filaInicial;							
						while ($xlsComp <= count($ultimaFila)-1):   //Recorre el EXCEL de acumulado
							$BimXlsComp=$objPHPExcel->getActiveSheet()->getCell(''.$colBim.''.$xlsComp.'')->getValue();		
							$NSSXlsComp=$objPHPExcel->getActiveSheet()->getCell(''.$colNSS.''.$xlsComp.'')->getValue();																																		
					if((trim($NSSXlsComp))==(trim($NSSSUA)) && (trim($BimXlsComp))==(trim($bimestreSUA)))
							{						
								if ($mesBimestreSUA===1)
								{									
									$objPHPExcel->getActiveSheet() //Pone titulo a columna
									->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colCotizacion1).''.$xlsComp.'',$UltimoSalarioSUA)
									;	
								}
								else
								{									
									$objPHPExcel->getActiveSheet() //Pone titulo a columna
									->setCellValue(''.PHPExcel_Cell::stringFromColumnIndex($colCotizacion2).''.$xlsComp.'',$UltimoSalarioSUA)
									;	
								}											
								break;
							}						
							$xlsComp++;
						endwhile;						
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

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $inputFileName . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
	}
}

/* End of file C_MisEmpresas.php */
/* Location: ./application/controllers/C_MisEmpresas.php */