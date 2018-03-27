<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'core/C_Main.php';
class C_HistorialComparativas extends C_Main {

	public function __construct() {
		parent::__construct();
		$this->load->library('excel');
		$this->load->model('mi_empresa/M_HistorialComparativas');
	}

	public function index(){
		$data = $this->mainHeader();
		if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){
			$tmp_array = array();
			$tmp_array['IdUsuario'] = intval( $this->session->userdata('IdUsuario') );
			$data['ComparativasGuardadas'] = $this->Obtener_ComparativasGuardadas($tmp_array);

			$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
		}else{
			$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
		}
		$this->mainFooter();
	}

	private function Obtener_IdsExcelesInfo($viewInfo){
		$IdsExcelesInfo = array();
		$tmp_array = $this->M_HistorialComparativas->Obtener_IdsExcelesInfo($viewInfo);

		for ($i = 0; $i < count($tmp_array); $i++) {
			$IdsExcelesInfo[$i] = $tmp_array[$i]['Id'];
		}
		return $IdsExcelesInfo;
	}

		public function ComparativaMensual( $IdComparativa ){
				$data = $this->mainHeader();
				if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){
				
						$tmp_array = array();
						$tmp_array['IdComparativa'] = $IdComparativa;
						$tmp_array['IdUsuario'] 	= intval( $this->session->userdata('IdUsuario') );
						$tmp_array['IdExcelesInfo'] = $this->Obtener_IdsExcelesInfo($tmp_array);

						if( count( $tmp_array['IdExcelesInfo'] ) > 0 ){
							$data['data_exceles'] = $this->Obtener_ExcelData_Mensuales( $tmp_array );

							$tmp_array['IdCatTipoExcel'] = 6;
							$data['data_sua']	= $this->Obtener_ExcelData_Individual( $tmp_array );
							unset( $tmp_array['IdCatTipoExcel'] );

							$tmp_array['IdCatTipoExcel'] = 7;
							$data['data_idse']	= $this->Obtener_ExcelData_Individual( $tmp_array );
							unset( $tmp_array['IdCatTipoExcel'] );

							$data['IdComparativa'] = $IdComparativa;
				
							$this->load->view('support/VS_HistorialComparativaMensual.php', $data);
						}else{
							$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
						}
				}else{
					$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
				}
				$this->mainFooter();
			
		}

		public function ComparativaBimestral( $IdComparativa ){
				$data = $this->mainHeader();
				if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){

					$tmp_array = array();
					$tmp_array['IdComparativa'] = $IdComparativa;
					$tmp_array['IdUsuario']		= intval( $this->session->userdata('IdUsuario') );
					$tmp_array['IdExcelesInfo'] = $this->Obtener_IdsExcelesInfo($tmp_array);


					if( count( $tmp_array['IdExcelesInfo'] ) > 0 ){

						$data['data_exceles'] = $this->Obtener_ExcelData_Bimestrales( $tmp_array );

						$tmp_array['IdCatTipoExcel'] = 9;
						$data['data_sua1']	= $this->Obtener_ExcelData_Individual( $tmp_array );
						unset( $tmp_array['IdCatTipoExcel'] );

						$tmp_array['IdCatTipoExcel'] = 10;
						$data['data_sua2']	= $this->Obtener_ExcelData_Individual( $tmp_array );
						unset( $tmp_array['IdCatTipoExcel'] );

						$tmp_array['IdCatTipoExcel'] = 11;
						$data['data_idse1']	= $this->Obtener_ExcelData_Individual( $tmp_array );
						unset( $tmp_array['IdCatTipoExcel'] );

						$tmp_array['IdCatTipoExcel'] = 12;
						$data['data_idse2']	= $this->Obtener_ExcelData_Individual( $tmp_array );
						unset( $tmp_array['IdCatTipoExcel'] );

						$data['xml'] = array();
						
						$data['IdComparativa'] = $IdComparativa;
						$this->load->view('support/VS_HistorialComparativaBimestral.php', $data);
/*						*/
					}else{
						$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
					}
				}else{
					$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
				}
				$this->mainFooter();
		}


	// // // //
	private function Obtener_ComparativasGuardadas($viewInfo){
		return $this->M_HistorialComparativas->Obtener_ComparativasGuardadas($viewInfo);
	}

	///////////////////////////////////////
	private function Obtener_ExcelData_Individual( $viewInfo ){	return $this->M_HistorialComparativas->Obtener_ExcelData_Individual($viewInfo);	}
	private function Obtener_ExcelData_Mensuales(	 $viewInfo ){	return $this->M_HistorialComparativas->Obtener_ExcelData_Mensuales($viewInfo);	}
	private function Obtener_ExcelData_Bimestrales(	 $viewInfo ){	return $this->M_HistorialComparativas->Obtener_ExcelData_Bimestrales($viewInfo);	}

	// // // // // // // // // // // // // // // // // // // // // // // //

		public function Generar_ExcelesMensual( $IdComparativa = 0 ){
				$excel_style = $this->excel->Generar_Excel_Header();

				$tmp_array = array();
				$tmp_array['IdRegistroPatronal'] = intval( $this->session->userdata('IdRegistroPatronal') );

				$tmp_array['IdComparativa'] = intval($IdComparativa);
				$data_simple = $this->Obtener_ExcelData_Mensuales( $tmp_array );
				
						$this->excel->Generar_Excel_Carnita(
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'],
									'Vista Detallada',	$data_simple 
						);
				
						$this->excel->createSheet(0);
						$data_detallada = array();
						for ($i=0; $i < count($data_simple); $i++) {
								$data_detallada[$i]['NSS']		=	$data_simple[$i]['NSS'];
								$data_detallada[$i]['Nombre']	= $data_simple[$i]['Nombre'];
								$data_detallada[$i]['SBC']		=	( $data_simple[$i]['SBC_SUA']		== $data_simple[$i]['SBC_IDSE']		) ? 'SI' : 'NO';
								$data_detallada[$i]['Total']	=	( $data_simple[$i]['Total_SUA']	== $data_simple[$i]['Total_IDSE']	) ? 'SI' : 'NO';
						}
						$this->excel->Generar_Excel_Carnita( 
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'Vista Simple', 		$data_detallada
						);
				
						$this->excel->createSheet(0);
						$tmp_array['IdCatTipoExcel'] = 6;
						$this->excel->Generar_Excel_Carnita( 
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'SUA Mensual', 			$this->Obtener_ExcelData_Individual($tmp_array)
						);


						$this->excel->createSheet(0);			
						$tmp_array['IdCatTipoExcel'] = 7;
						$this->excel->Generar_Excel_Carnita( 
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'IDSE Mensual',			$this->Obtener_ExcelData_Individual($tmp_array)
						);
				
				unset( $tmp_array['IdComparativa'] );
				$this->excel->Generar_Excel_Footer( 'Comparativa_Mensual.xls' );
		}
		public function Generar_ExcelesBimestral( $IdComparativa = 0 ){
				$excel_style = $this->excel->Generar_Excel_Header();

				$tmp_array = array();
				$tmp_array['IdRegistroPatronal'] = intval( $this->session->userdata('IdRegistroPatronal') );

				$tmp_array['IdComparativa'] = intval($IdComparativa);
				$data_simple = $this->Obtener_ExcelData_Bimestrales( $tmp_array );


						$this->excel->Generar_Excel_Carnita(
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'],
									'Vista Detallada',		$data_simple
						);
				
						$this->excel->createSheet(0);

						$data_detallada = array();
						for ($i=0; $i < count($data_simple); $i++) {
								$data_detallada[$i]['NSS']					=	$data_simple[$i]['NSS'];
								$data_detallada[$i]['Nombre']				= $data_simple[$i]['Nombre'];
								$data_detallada[$i]['SBC']					=	( $data_simple[$i]['SBC_SUA']		== $data_simple[$i]['SBC_IDSE']		) ? 'SI' : 'NO';
								$data_detallada[$i]['Total']				=	( $data_simple[$i]['Total_SUA']	== $data_simple[$i]['Total_IDSE']	) ? 'SI' : 'NO';
								$data_detallada[$i]['Amortizacion']	=	( $data_simple[$i]['Amortizacion_SUA']	== $data_simple[$i]['Amortizacion_IDSE']	) ? 'SI' : 'NO';
						}
						$this->excel->Generar_Excel_Carnita( 
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'Vista Simple',				$data_detallada
						);


						$this->excel->createSheet(0);
						$tmp_array['IdCatTipoExcel'] = 9;
						$this->excel->Generar_Excel_Carnita(
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'SUA Bimestral 1',		$this->Obtener_ExcelData_Individual($tmp_array)
						);


						$this->excel->createSheet(0);
						$tmp_array['IdCatTipoExcel'] = 10;
						$this->excel->Generar_Excel_Carnita(
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'SUA Bimestral 2', 		$this->Obtener_ExcelData_Individual($tmp_array)
						);


						$this->excel->createSheet(0);
						$tmp_array['IdCatTipoExcel'] = 11;
						$this->excel->Generar_Excel_Carnita(
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'IDSE Bimestral 1',		$this->Obtener_ExcelData_Individual($tmp_array)
						);


						$this->excel->createSheet(0);
						$tmp_array['IdCatTipoExcel'] = 12;
						$this->excel->Generar_Excel_Carnita(
									$excel_style['estiloEncabezadosColumnas'],		$excel_style['estiloCuerpoColumnas'], 
									'IDSE Bimestral 2', 		$this->Obtener_ExcelData_Individual($tmp_array)
						);
				
				unset( $tmp_array['IdComparativa'] );
				$this->excel->Generar_Excel_Footer( 'Comparativa_Bimestral.xls' );
		}

	// // // // // // // // // // // // // // // // // // // // // // // //
}

/* End of file C_HistorialComparativas.php */
/* Location: ./application/controllers/C_HistorialComparativas.php */