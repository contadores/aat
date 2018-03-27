<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/libraries/PHPExcel-1-8/Classes/PHPExcel.php";
 
class Excel extends PHPExcel { 
	public function __construct() { 
		parent::__construct(); 
	}

	public function ObtenerContenido_Exceles( $excel ){
		$inputFileType = PHPExcel_IOFactory::identify( $excel['archivo'] );

		$objReader = PHPExcel_IOFactory::createReader($inputFileType);

		$objPHPExcel = $objReader->load( $excel['archivo'] );

		$sheet = $objPHPExcel->getSheet( $excel['hoja_num'] );

		$highestRow = $sheet->getHighestRow();

		$highestColumn = $sheet->getHighestColumn();

		return array(
				'hoja' => $sheet,
				'ultima_fila' => $highestRow,
				'ultima_columna' => $highestColumn
		);
	}

	public function Generar_Excel_Carnita( $estiloEncabezadosColumnas, $estiloCuerpoColumnas, $sheet_title, $data_set ){
			$data_lenght = count($data_set);
			$last_col_let = 'A';

			for ($i=0; $i < count($data_set[0]); $i++) { 
				if( $i != count($data_set[0])-1 ){
						$last_col_let++;
				}
			}


			$this->setActiveSheetIndex(0);
			// Aplica el diseño a todas las columnas
			$this->getActiveSheet()->getStyle('A1:'.$last_col_let.'1')->applyFromArray($estiloEncabezadosColumnas);
			$last_col_let++;
			//nombre de la hoja
			$this->getActiveSheet()->setTitle( $sheet_title );
			// $this->getActiveSheet()->setCellValue('A'.$filaEncabezados, 'Fila');

			
			$filaContenido = 2;
			for ($i=0; $i < $data_lenght; $i++) {
					$col_index = 0;
					for($letra = 'A'; $letra < $last_col_let; $letra++) {
							$this->getActiveSheet()->setCellValue($letra.$filaContenido, 
									$data_set[$i][
											array_keys($data_set[0])[$col_index]
									]
							);
							$col_index++;
							//$this->getActiveSheet()->setCellValue($letra.$filaContenido, $data_set[$i]['Fila']);
					}
					$filaContenido++;
					//$this->getActiveSheet()->setCellValue('A'.$filaContenido, $data_set[$i]['Fila']);
			}
			

			$col_index = 0;
			$filaEncabezados = 1;
			for($i = 'A'; $i < $last_col_let; $i++) {
					// Encabezados de la tabla
					$this->getActiveSheet()->setCellValue($i.$filaEncabezados, array_keys($data_set[0])[$col_index]);
					$col_index++;
					//$this->getActiveSheet()->setCellValue($i.$filaEncabezados, $last_col_let );

					// Auto Size
					$this->getActiveSheet()->getColumnDimension( $i )->setAutoSize(true);	
					$this->getActiveSheet()->getStyle( $i.'2:'.$i.($filaContenido-1) )->applyFromArray($estiloCuerpoColumnas);
			}
	}

	public function Generar_Excel_Header(){
		$this->getActiveSheet()->getPageMargins()->setHeader(0);
		$this->getActiveSheet()->getPageMargins()->setTop(1.2);

		$this->getActiveSheet()->getHeaderFooter()->setOddFooter('Página &P de &N');

		$estiloEncabezadosColumnas = array(
			'font' => array(
					'name'   => 'Verdana',
					'bold'   => true,
					'italic' => false,
					'strike' => false,
					'size'	 => 10,
					'color' => array(
						'rgb'	=> 'FFFFFF'
					)
			 ),

			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN                    
				)
			),

			'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => '217346')
			)
		);
		$estiloCuerpoColumnas = array(
			'font' => array(
				'name'      => 'Arial',
				'bold'      => false,                          
				'color'     => array(
					'rgb'   => '000000'
				)
			),
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN                    
				),
			)
		);

		return array(
			'estiloEncabezadosColumnas' => $estiloEncabezadosColumnas,
			'estiloCuerpoColumnas'			=> $estiloCuerpoColumnas
		);
	}

	public function Generar_Excel_Footer( $filename ){
			//$filename = 'Comparativa_Mensual.xls'; //nombre del archivo
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //nombre del archivo
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output'); 
	}

}