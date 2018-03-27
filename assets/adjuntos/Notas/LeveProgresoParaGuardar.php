<?php 
	require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel.php';

	$archivo1 = $_FILES['bnt2_idse']['tmp_name'];
	$archivo2 = $_FILES['bnt1_sua']['tmp_name'];

	$inputFileType1 = PHPExcel_IOFactory::identify($archivo1);
	$inputFileType2 = PHPExcel_IOFactory::identify($archivo2);

	$objReader1 = PHPExcel_IOFactory::createReader($inputFileType1);
	$objReader2 = PHPExcel_IOFactory::createReader($inputFileType2);

	$objPHPExcel1 = $objReader1->load($archivo1);
	$objPHPExcel2 = $objReader2->load($archivo2);

	$sheet1 = $objPHPExcel1->getSheet(1);
	$sheet2 = $objPHPExcel2->getSheet(0);

	$highestRow1 = $sheet1->getHighestRow();
	$highestRow2 = $sheet2->getHighestRow();

	$highestColumn1 = $sheet1->getHighestColumn();
	$highestColumn2 = $sheet2->getHighestColumn();

	//	===== SUA =====	//
	$indices_sua = array( 
		'NSS' 					=> 'A',
		'NOMBRE' 				=> 'G',
		'SBC' 					=> 'E',
		'TOTAL' 				=> 'U',
		'AMORTIZACIÓN' 	=> 'U'
	);

	$data_sua = array();
	$tmpArray = array();

	$tmp_tope = 'Total de Días cotizados para el calculo de trabajadores promedio expuestos al riesgo';
	for ($row = 23; $row < $highestRow2; $row+=2) {

			if( $sheet2->getCell($indices_sua['NSS'] . $row)->getValue() != '' && 
					$sheet2->getCell($indices_sua['NSS'] . $row)->getValue() != 'M/S' ){

					$tmpArray['F'] = $row;
					$tmpArray['NSS'] = str_replace('-','',$sheet2->getCell($indices_sua['NSS'] . $row)->getValue());
					$tmpArray['NOMBRE'] = $sheet2->getCell($indices_sua['NOMBRE'] . $row)->getValue();
			}

			if ( $sheet2->getCell($indices_sua['SBC'] . $row)->getValue() != '' ) {
					if( count( $tmpArray ) == 3 ){
							$tmpArray['SBC'] = $sheet2->getCell($indices_sua['SBC'] . $row)->getValue();
							$tmpArray['TOTAL'] = $sheet2->getCell($indices_sua['TOTAL'] . $row)->getValue();
							$tmpArray['AMORTIZACIÓN'] = $sheet2->getCell($indices_sua['AMORTIZACIÓN'] . $row)->getValue();
					}else{
							$tmpArray['F'] = $data_sua[count($data_sua)-1][ 'F' ];
							$tmpArray['NSS'] = $data_sua[count($data_sua)-1]['NSS'];
							$tmpArray['NOMBRE'] = $data_sua[count($data_sua)-1]['NOMBRE'];

							$tmpArray['SBC'] = $sheet2->getCell($indices_sua['SBC'] . $row)->getValue();
							$tmpArray['TOTAL'] = $sheet2->getCell($indices_sua['TOTAL'] . $row)->getValue();
							$tmpArray['AMORTIZACIÓN'] = $sheet2->getCell($indices_sua['AMORTIZACIÓN'] . $row)->getValue();
					}

					array_push($data_sua, $tmpArray);
					//print_r($tmpArray);
					//echo '<br>';
					$tmpArray = array();

					// ENTRA SOLO HASTA ENCONTRAR EL TOPE
					if( $sheet2->getCell('A' . ($row+5))->getValue() ==  $tmp_tope ){
							break;
					}
			} // end IF
	} // end FOR
	//	===== end SUA =====	//
	//print_r($data_sua);


	//	===== IDSE =====	//
	$indices_idse = array( 
		'NSS' 					=> 'A',
		'NOMBRE' 				=> 'B',
		'SBC' 					=> 'G',
		'TOTAL' 				=> 'S',
		'AMORTIZACIÓN' 	=> 'S'
	);

	$data_idse = array();

	for ($row = 6; $row <= $highestRow1; $row++) {
		$tmpArray['F'] = $row;
		$tmpArray['NSS'] = $sheet1->getCell($indices_idse['NSS'] . $row)->getValue();
		$tmpArray['NOMBRE'] = $sheet1->getCell($indices_idse['NOMBRE'] . $row)->getValue();
		$tmpArray['SBC'] = $sheet1->getCell($indices_idse['SBC'] . $row)->getValue();
		$tmpArray['TOTAL'] = $sheet1->getCell($indices_idse['TOTAL'] . $row)->getValue();
		$tmpArray['AMORTIZACIÓN'] = $sheet1->getCell($indices_idse['AMORTIZACIÓN'] . $row)->getValue();

		array_push($data_idse, $tmpArray);
		print_r($tmpArray);
		echo '<br>';
	}
	//	===== end IDSE =====	//
?>

09088934832
	<div class="box">
		<div class="nav-tabs-custom">

			<ul class="nav nav-tabs pull-right">
				<li><a href="#tab_1" data-toggle="tab"><i class="fa fa-search-plus"></i> &nbsp; VISTA DETALLADA </a></li>
				<li class="active"><a href="#tab_2" data-toggle="tab"><i class="fa fa-search"></i> &nbsp; VISTA SIMPLE </a></li>
				<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-file-text-o"></i> &nbsp; SUA </a></li>
				<li><a href="#tab_4" data-toggle="tab"><i class="fa fa-file-text-o"></i> &nbsp; IDSE </a></li>
			</ul>
			<div class="tab-content">
			<br>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane table-responsive" id="tab_1">	<!-- VISTA DETALLADA -->

				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane active" id="tab_2">	<!-- VISTA SIMPLE -->

				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane" id="tab_3">	<!-- SUA -->

				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
				<div class="tab-pane" id="tab_4">	<!-- IDSE -->

				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			</div> <!-- /.nav nav-tabs pull-right -->
		</div> <!-- /.nav-tabs-custom -->
	</div> <!-- /.box -->