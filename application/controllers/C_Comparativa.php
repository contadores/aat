<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/C_Main.php';
class C_Comparativa extends C_Main
{
		public function __construct(){
				parent::__construct();
				$this->load->library('excel');
				$this->load->model('mi_empresa/M_Comparativa');
		}
		public function index(){
				$data = $this->mainHeader();
				if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){
						$this->load->view('mi_empresa/V_' . $data['titulo'] . '.php', $data);
				}else{
						$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
				}
				$this->mainFooter();
		}


		//////////////////////////////////////////////////////////////////////////
		//
		// Leer Exceles.
		//
		//////////////////////////////////////////////////////////////////////////

		// Método que obtiene la información guardada en el archivo SUA
		private function ObtenerContenido_SUA( $excel_sua, $bimestral ){
				$data_individual = array();
				$data_sua			= array();
				$indices_sua	= array();
				$indices_sua['NSS']				= 'A';
				$indices_sua['Nombre']		= 'F';
				$indices_sua['SBC']				= 'D';
				$indices_sua['Total']			= 'T';
				if( $bimestral == 'bimestral' ){
						$indices_sua['Total']			= 'P';
						$indices_sua['Amortizacion']	= 'O';
				}

				$NSS_Bandera = '';
				$NSS = '';
				$Nombre = '';

				for($row = 1; $row <= $excel_sua['ultima_fila']; $row++) {
						// Si encuentra un NSS (Quitando los guiones medios & que su longitud sea igual a 11) guardar:
						// NSS y Nombre
						$NSS_tmp = str_replace('-','',$excel_sua['hoja']->getCell($indices_sua['NSS'] . $row)->getValue());
						if( strlen($NSS_tmp) == 11 ){
								$NSS			=	str_replace('-','',$excel_sua['hoja']->getCell($indices_sua['NSS'] . $row)->getValue());
								$Nombre		= $excel_sua['hoja']->getCell($indices_sua['Nombre'] . $row)->getValue();
						}

						// Si encuentra un SBC (Validando que sea un numero) guardar:
						// SBC, Total, Amortización, pushear.
						$SBC = $excel_sua['hoja']->getCell($indices_sua['SBC'] . $row)->getValue();
						if( is_numeric( $SBC ) ){
								$data_individual['Fila']		= $row;
								$data_individual['NSS']			= $NSS;
								$data_individual['Nombre']	= $Nombre;

								$data_individual['SBC']			= $excel_sua['hoja']->getCell($indices_sua['SBC'] . $row)->getValue();
								$data_individual['Total']		= $excel_sua['hoja']->getCell($indices_sua['Total'] . $row)->getValue();

								if( $bimestral == 'bimestral' ){
										$data_individual['Amortizacion'] = $excel_sua['hoja']->getCell($indices_sua['Amortizacion'] . $row)->getValue();
								}

								array_push($data_sua, $data_individual);
						}
				}

				return $data_sua;
		}

		// Método que obtiene la información guardada en el archivo IDSE
		private function ObtenerContenido_IDSE( $excel_idse, $bimestral ){
				$data_individual	= array();
				$data_idse				= array();
				$indices_idse			= array();
				$indices_idse['NSS']			= 'A';
				$indices_idse['Nombre']		= 'B';
				$indices_idse['SBC']			= 'G';
				$indices_idse['Total']		= 'S';
				if( $bimestral == 'bimestral' ){
						$indices_idse['Total']		= 'R';
						$indices_idse['Amortizacion']	= 'P';
				}
				

				for ($row = 6; $row <= $excel_idse['ultima_fila']; $row++) {
						$data_individual['Fila']	= $row;
						$data_individual['NSS']	= $excel_idse['hoja']->getCell($indices_idse['NSS'] . $row)->getValue();

						if( substr( $data_individual['NSS'], 0, 1 ) == 'A' ){
								$data_individual['NSS'] = substr( $data_individual['NSS'], 1, strlen($data_individual['NSS']) );
						}
						
						$data_individual['Nombre']	= $excel_idse['hoja']->getCell($indices_idse['Nombre'] . $row)->getValue();
						$data_individual['SBC']		= $excel_idse['hoja']->getCell($indices_idse['SBC'] . $row)->getValue();
						$data_individual['Total']	= $excel_idse['hoja']->getCell($indices_idse['Total'] . $row)->getValue();
						if( $bimestral == 'bimestral' ){
								$data_individual['Amortizacion'] = $excel_idse['hoja']->getCell($indices_idse['Amortizacion'] . $row)->getValue();
						}

						array_push($data_idse, $data_individual);
				}

				return $data_idse;
		}



		//////////////////////////////////////////////////////////////////////////
		//
		// Cargar información de los exceles en una nueva COMPARATIVA
		//
		//////////////////////////////////////////////////////////////////////////

		// Método que se carga en la vista => C_Comparativa/ComparativaMensual
		// Una vez que se cargaron los archivos SUA e IDSE - MENSUALES
		public function ComparativaMensual( ){
				$data = $this->mainHeader();
				if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){

						if( $this->session->has_userdata('IdRegistroPatronal') ){

								if ( count($_FILES) > 0 ) {
										$tmp_eliminar = array();
										$tmp_eliminar['IdRegistroPatronal']	=	intval( $this->session->userdata('IdRegistroPatronal') );
										$tmp_eliminar[0]	= 6;
										$tmp_eliminar[1]	=	7;

										if ( $this->Eliminar_Exceles( $tmp_eliminar ) ){

												$data['data_sua'] = $this->ObtenerContenido_SUA( 
														$this->excel->ObtenerContenido_Exceles( array( 
																'hoja_num' => 0,
																'archivo' => $_FILES['bnt1_sua']['tmp_name']
														)), 'mensual' );
												$data['data_idse'] = $this->ObtenerContenido_IDSE( 
														$this->excel->ObtenerContenido_Exceles( array( 
																'hoja_num' => 1,
																'archivo' => $_FILES['bnt2_idse']['tmp_name']
														)), 'mensual' );

												$tmp_array = array();
												$tmp_array['IdRegistroPatronal'] = intval( $this->session->userdata('IdRegistroPatronal') );

												$tmp_array['IdCatTipoExcel'] = 6;
												$this->Guardar_ExcelData( $data['data_sua'], 
														$this->Guardar_ExcelInfo( $tmp_array )
												);

												$tmp_array['IdCatTipoExcel'] = 7;
												$this->Guardar_ExcelData( $data['data_idse'], 
														$this->Guardar_ExcelInfo( $tmp_array )
												);

												unset( $tmp_array['IdCatTipoExcel'] );

												$data['data_exceles'] = $this->Obtener_ExcelData_Mensuales( $tmp_array );

												$this->load->view('support/VS_ComparativaMensual.php', $data);
												$this->load->view('modals/VM_ComparativaNueva.php', $data);
												
										} else {
												$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
										}
								} else {
										$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
								}
						}else{
								$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
						}
				}else{
						$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
				}
				$this->mainFooter();
		}

		// Método que se carga en la vista => C_Comparativa/ComparativaBimestral
		// Una vez que se cargaron los archivos SUA e IDSE - BIMESTRALES
		public function ComparativaBimestral( ){
				$data = $this->mainHeader();
				if( $data['IdCatTipoUsuario'] == 2 || $data['IdCatTipoUsuario'] == 3 ){

						if( $this->session->has_userdata('IdRegistroPatronal') ){

								if ( count($_FILES) > 0 ) {
										$tmp_eliminar = array();
										$tmp_eliminar['IdRegistroPatronal']	=	intval( $this->session->userdata('IdRegistroPatronal') );
										$tmp_eliminar[0] = 9;
										$tmp_eliminar[1] = 10;
										$tmp_eliminar[2] = 11;
										$tmp_eliminar[3] = 12;

										if ( $this->Eliminar_Exceles( $tmp_eliminar ) ){
												$data['data_sua1'] = $this->ObtenerContenido_SUA( 
													$this->excel->ObtenerContenido_Exceles( array( 
															'hoja_num' => 0,
															'archivo' => $_FILES['bnt4_sua']['tmp_name']
													)), 'mensual' );

												$data['data_sua2'] = $this->ObtenerContenido_SUA( 
													$this->excel->ObtenerContenido_Exceles( array( 
															'hoja_num' => 0,
															'archivo' => $_FILES['bnt5_sua']['tmp_name']
													)), 'bimestral' );

												$data['data_idse1'] = $this->ObtenerContenido_IDSE( 
													$this->excel->ObtenerContenido_Exceles( array( 
															'hoja_num' => 1,
															'archivo' => $_FILES['bnt6_idse']['tmp_name']
													)), 'mensual' );

												$data['data_idse2'] = $this->ObtenerContenido_IDSE( 
													$this->excel->ObtenerContenido_Exceles( array( 
															'hoja_num' => 2,
															'archivo' => $_FILES['bnt6_idse']['tmp_name']
													)), 'bimestral' );


												$tmp_array = array();
												$tmp_array['IdRegistroPatronal'] = intval( $this->session->userdata('IdRegistroPatronal') );

												$tmp_array['IdCatTipoExcel'] = 9;
												$Idsua1 = $this->Guardar_ExcelInfo( $tmp_array );
												$this->Guardar_ExcelData( $data['data_sua1'], $Idsua1 );

												$tmp_array['IdCatTipoExcel'] = 10;
												$Idsua2 = $this->Guardar_ExcelInfo( $tmp_array );
												$this->Guardar_ExcelData( $data['data_sua2'], $Idsua2 );
	
												$tmp_array['IdCatTipoExcel'] = 11;
												$Ididse1 = $this->Guardar_ExcelInfo( $tmp_array );
												$this->Guardar_ExcelData( $data['data_idse1'], $Ididse1 );

												$tmp_array['IdCatTipoExcel'] = 12;
												$Ididse2 = $this->Guardar_ExcelInfo( $tmp_array );
												$this->Guardar_ExcelData( $data['data_idse2'], $Ididse2 );


												unset( $tmp_array['IdCatTipoExcel'] );
												$data['data_exceles'] = $this->Obtener_ExcelData_Bimestrales( $tmp_array );

												$this->load->view('support/VS_ComparativaBimestral.php', $data);
												$this->load->view('modals/VM_ComparativaNueva.php', $data);
										} else {
												$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
										}

								} else {
										$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
								}
						}else{
								$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
						}
				}else{
						$this->load->view('support/VS_PaginaNoEncontrada.php', $data);
				}
				$this->mainFooter();
		}

		private function Obtener_ExcelData_Individual(	$viewInfo	){	return $this->M_Comparativa->Obtener_ExcelData_Individual($viewInfo);		}
		private function Obtener_ExcelData_Mensuales (	$viewInfo	){	return $this->M_Comparativa->Obtener_ExcelData_Mensuales($viewInfo);		}
		private function Obtener_ExcelData_Bimestrales( $viewInfo	){	return $this->M_Comparativa->Obtener_ExcelData_Bimestrales($viewInfo);	}

		// Método que se carga en la vista => C_Comparativa/ (ComparativaMensual - ComparativaBimestral)
		// Borra las comparativas no guardadas que pertenecen al RegistroPatronal Actual.
		private function Eliminar_Exceles( $Info ){
				$resultado = $this->M_Comparativa->Eliminar_Exceles( $Info );
				//Either you can print value or you can send value to database
				return json_encode($resultado);
		}



		//////////////////////////////////////////////////////////////////////////
		//
		// Guardar comparativas
		//
		//////////////////////////////////////////////////////////////////////////

		// Método que guarda la comparativa Mensual
		public function GuardarComparativaMensual(){
			$viewInfo  = $this->input->post();
			$resultado = $this->M_Comparativa->GuardarComparativaMensual($viewInfo);

			//Either you can print value or you can send value to database
			echo json_encode($resultado);
		}

		// Método que guarda la comparativa Bimestral
		public function GuardarComparativaBimestral(){
			$viewInfo  = $this->input->post();
			$resultado = $this->M_Comparativa->GuardarComparativaBimestral($viewInfo);

			//Either you can print value or you can send value to database
			echo json_encode($resultado);
		}

		// Método que se carga en la vista => C_Comparativa
		// Una vez que se oprime el botón de COMPARAR (MENSUALE & BIMESTRAL)
		private function Guardar_ExcelInfo( $viewInfo ){
				$resultado = $this->M_Comparativa->Guardar_ExcelInfo($viewInfo);
				//Either you can print value or you can send value to database
				return json_encode($resultado);
		}

		// Método que se carga en la vista => C_Comparativa
		// Una vez que se oprime el botón de COMPARAR (MENSUALE & BIMESTRAL)
		private function Guardar_ExcelData( $viewInfo, $IdExcelesInfo ){
				$tmp_array_lenght = count($viewInfo);

				for ($i = 0; $i < $tmp_array_lenght; $i++) {
					$viewInfo[$i]['IdExcelesInfo'] = $IdExcelesInfo;
				}
				
				$resultado = $this->M_Comparativa->Guardar_ExcelData($viewInfo);
				//Either you can print value or you can send value to database
				return json_encode($resultado);
		}



		//////////////////////////////////////////////////////////////////////////
		//
		// PHP-Exceles
		//
		//////////////////////////////////////////////////////////////////////////

		// Método que genera un excel con la comparativa Mensual
		public function Generar_ExcelesMensual( ){
				$excel_style = $this->excel->Generar_Excel_Header();

				$tmp_array = array();
				$tmp_array['IdRegistroPatronal'] = intval( $this->session->userdata('IdRegistroPatronal') );

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

				$this->excel->Generar_Excel_Footer( 'Comparativa_Mensual.xls' );
		}

		// Método que genera un excel con la comparativa Bimestral
		public function Generar_ExcelesBimestral(){
				$excel_style = $this->excel->Generar_Excel_Header();

				$tmp_array = array();
				//$tmp_array['IdUsuario'] = intval( $this->session->userdata('IdUsuario') );
				$tmp_array['IdRegistroPatronal'] = intval( $this->session->userdata('IdRegistroPatronal') );

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


				$this->excel->Generar_Excel_Footer( 'Comparativa_Bimestral.xls' );
		}
}

/* End of file C_Comparativa.php */
/* Location: ./application/controllers/C_Comparativa.php */