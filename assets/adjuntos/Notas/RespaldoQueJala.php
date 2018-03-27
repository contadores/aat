<?php require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel.php';?>
<?php
	$archivo1 = $_FILES['bnt2_idse']['tmp_name'];
	$archivo2 = $_FILES['bnt1_sua']['tmp_name'];

	//require_once 'PHPExcel/Classes/PHPExcel.php';

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

	/*
	$i      = 0;
	$libro1 = array();
	for ($row = 2; $row <= $highestRow1; $row++) {
			if ($sheet1->getCell("B" . $row)->getValue() == '' ||
					$sheet1->getCell("C" . $row)->getValue() == '') {
					break;
			} else {
					array_push($libro1,
							array(
									$sheet1->getCell("B" . $row)->getValue(),
									$sheet1->getCell("C" . $row)->getValue(),
							)
					);
			}
			$i++;
	}

	$i      = 0;
	$libro2 = array();
	for ($row = 2; $row <= $highestRow2; $row++) {
			if ($sheet2->getCell("B" . $row)->getValue() == '' ||
					$sheet2->getCell("C" . $row)->getValue() == '') {
					break;
			} else {
					array_push($libro2,
							array(
									$sheet2->getCell("B" . $row)->getValue(),
									$sheet2->getCell("C" . $row)->getValue(),
							)
					);
			}
			$i++;
	}
	*/

	//	===== SUA =====	//
	$indices_sua = array( 
		array( 'col_index' => 'A',	'name' => 'NSS'					),
		array( 'col_index' => 'G',	'name' => 'NOMBRE'			),
		array( 'col_index' => 'E',	'name' => 'SBC'					),
		array( 'col_index' => 'U',	'name' => 'TOTAL'				),
		array( 'col_index' => 'U',	'name' => 'AMORTIZACIÓN')
	);
	$lenght_indices_sua = count($indices_sua);
	$data_sua = array();
	$tmpArray = array();

	$tmp_tope = 'Total de Días cotizados para el calculo de trabajadores promedio expuestos al riesgo';
	for ($row = 23; $row < $highestRow2; $row+=2) {
			if( $sheet2->getCell($indices_sua['0']['col_index'] . $row)->getValue() != '' && 
					$sheet2->getCell($indices_sua['0']['col_index'] . $row)->getValue() != 'M/S' ){

					if( count( $tmpArray ) > 0 ){
							array_push($data_sua, $tmpArray);
							//print_r($tmpArray);
							//echo '<br>';
							$tmpArray = array();
					}

					$tmpArray['F'] = $row;
					$tmpArray[$indices_sua['0']['name'] ] = str_replace('-','',$sheet2->getCell($indices_sua['0']['col_index'] . $row)->getValue());
					$tmpArray[$indices_sua['1']['name'] ] = $sheet2->getCell($indices_sua['1']['col_index'] . $row)->getValue();
			}
			// end IF

			if ( $sheet2->getCell($indices_sua['2']['col_index'] . $row)->getValue() != '' ) {
					if( count( $tmpArray ) == 3 ){
							$tmpArray[$indices_sua['2']['name']][0] = $sheet2->getCell($indices_sua['2']['col_index'] . $row)->getValue();
							$tmpArray[$indices_sua['3']['name']][0] = $sheet2->getCell($indices_sua['3']['col_index'] . $row)->getValue();
							$tmpArray[$indices_sua['4']['name']][0] = $sheet2->getCell($indices_sua['4']['col_index'] . $row)->getValue();
					}else{
							$tmpIndexChild = count( $tmpArray[$indices_sua['2']['name']] );
							$tmpArray[$indices_sua['2']['name']][$tmpIndexChild] = $sheet2->getCell($indices_sua['2']['col_index'] . $row)->getValue();
							$tmpArray[$indices_sua['3']['name']][$tmpIndexChild] = $sheet2->getCell($indices_sua['3']['col_index'] . $row)->getValue();
							$tmpArray[$indices_sua['4']['name']][$tmpIndexChild] = $sheet2->getCell($indices_sua['4']['col_index'] . $row)->getValue();
					}

					// ENTRA SOLO HASTA ENCONTRAR EL TOPE
					if( $sheet2->getCell('A' . ($row+5))->getValue() ==  $tmp_tope ){
							array_push($data_sua, $tmpArray);
							//print_r($tmpArray);
							//echo '<br>';
							//echo 'HASTA AQUI';
							//echo '<br>';
							$tmpArray = array();
							break;
					}
					// end ENTRA SOLO HASTA ENCONTRAR EL TOPE
			}
			// end IF
	}
	// end FOR
	//	===== end SUA =====	//



	//	===== IDSE =====	//
			$indices_idse = array( 
				array( 'col_index' => 'A',	'name' => 'NSS'					),
				array( 'col_index' => 'B',	'name' => 'NOMBRE'			),
				array( 'col_index' => 'G',	'name' => 'SBC'					),
				array( 'col_index' => 'S',	'name' => 'TOTAL'				),
				array( 'col_index' => 'S',	'name' => 'AMORTIZACIÓN')
			);
			$lenght_indices_idse = count($indices_idse);
			$data_idse = array();
			$tmpArray = array();

			for ($row = 6; $row <= $highestRow1; $row++) {
				//echo 	'F'.$row.' ';
				
				if( count($data_idse) > 0 ){
					
					if( $sheet1->getCell($indices_idse[0]['col_index'] . $row)->getValue() !=
							$sheet1->getCell($indices_idse[0]['col_index'] . ($row -1))->getValue() ){
					
							$tmpArray['F'] = $row;
							$tmpArray[ $indices_idse[0]['name'] ] = $sheet1->getCell($indices_idse[0]['col_index'] . $row)->getValue();
							$tmpArray[ $indices_idse[1]['name'] ] = $sheet1->getCell($indices_idse[1]['col_index'] . $row)->getValue();

							$tmpArray[ $indices_idse[2]['name']][0] = $sheet1->getCell($indices_idse[2]['col_index'] . $row)->getValue();
							$tmpArray[ $indices_idse[3]['name']][0] = $sheet1->getCell($indices_idse[3]['col_index'] . $row)->getValue();
							$tmpArray[ $indices_idse[4]['name']][0] = $sheet1->getCell($indices_idse[4]['col_index'] . $row)->getValue();
							array_push($data_idse, $tmpArray);
							//print_r($tmpArray);
							////echo '<br>';
							$tmpArray = array();
					
					}else{
						array_push($data_idse[ count($data_idse)-1 ][ $indices_idse[2]['name'] ], 
							$sheet1->getCell($indices_idse[2]['col_index'] . $row)->getValue()
						);

						array_push($data_idse[ count($data_idse)-1 ][ $indices_idse[3]['name'] ], 
							$sheet1->getCell($indices_idse[3]['col_index'] . $row)->getValue()
						);

						array_push($data_idse[ count($data_idse)-1 ][ $indices_idse[4]['name'] ], 
							$sheet1->getCell($indices_idse[4]['col_index'] . $row)->getValue()
						);
					}
				}else{
					$tmpArray['F'] = $row;
					$tmpArray[ $indices_idse[0]['name'] ] = $sheet1->getCell($indices_idse[0]['col_index'] . $row)->getValue();
					$tmpArray[ $indices_idse[1]['name'] ] = $sheet1->getCell($indices_idse[1]['col_index'] . $row)->getValue();

					$tmpArray[ $indices_idse[2]['name']][0] = $sheet1->getCell($indices_idse[2]['col_index'] . $row)->getValue();
					$tmpArray[ $indices_idse[3]['name']][0] = $sheet1->getCell($indices_idse[3]['col_index'] . $row)->getValue();
					$tmpArray[ $indices_idse[4]['name']][0] = $sheet1->getCell($indices_idse[4]['col_index'] . $row)->getValue();
					array_push($data_idse, $tmpArray);
					//print_r($tmpArray);
					////echo '<br>';
					////
					$tmpArray = array();
				}
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
							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th><br>NSS</th>
												<th><br>NOMBRE</th>
												<th><small>SBC</small><br>IDSE</th>
												<th><small>SBC</small><br>SUA</th>
														<th><small>SBC</small><br>NOM</th>
												<th><small>TOTAL</small><br>IDSE</th>
												<th><small>TOTAL</small><br>SUA</th>
												<th><small>AMORTIZACIÓN</small><br>IDSE</th>
												<th><small>AMORTIZACIÓN</small><br>SUA</th>
														<th><small>AMORTIZACIÓN</small><br>NOM</th>
												<th><small>TIPOS&nbsp;DE&nbsp;RESTRICCIÓN</small> IDSE</th>
												<th><small>TIPOS&nbsp;DE&nbsp;RESTRICCIÓN</small> SUA</th>
										</tr>
									</thead>
									<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < count($data_sua); $i++) {
												echo '<tr>';
												echo 	'<td>'.$data_sua[$i]['NSS'].'</td>';
												echo 	'<td>'.str_replace(' ', '&nbsp;', $data_sua[$i]['NOMBRE']).'</td>';

													$tmpCountSBC = count($data_sua[$i]['SBC']);
													$tmp1 = 0;	$tmp2 = 0;	$tmp3 = 0;
													$tmp4 = 0;	$tmp5 = 0;	$tmp6 = 0;
													
													for ($j = 0; $j < $tmpCountSBC; $j++) {
														$tmp1 += $data_sua[$i]['SBC'][$j];
														$tmp2 += $data_sua[$i]['TOTAL'][$j];
														$tmp3 += $data_sua[$i]['AMORTIZACIÓN'][$j];
													}

													$tmpCountSBC = count($data_idse[$i]['SBC']);
													for ($j = 0; $j < $tmpCountSBC; $j++) {
														$tmp4 += $data_idse[$i]['SBC'][$j];
														$tmp5 += $data_idse[$i]['TOTAL'][$j];
														$tmp6 += $data_idse[$i]['AMORTIZACIÓN'][$j];
													}
												
												echo 	'<td>'.$tmp1.'</td>';
												echo 	'<td>'.$tmp4.'</td>';
												echo 	'<td>&nbsp;</td>';
												echo 	'<td>'.$tmp2.'</td>';
												echo 	'<td>'.$tmp5.'</td>';
												echo 	'<td>'.$tmp3.'</td>';
												echo 	'<td>'.$tmp6.'</td>';
												echo 	'<td>&nbsp;</td>';
												echo 	'<td>182</td>';
												echo 	'<td>182</td>';
												echo '</tr>';
											}
										?>
									</tbody>

									<tfoot>
										<tr>
												<th><br>NSS</th>
												<th><br>NOMBRE</th>
												<th><small>SBC</small><br>IDSE</th>
												<th><small>SBC</small><br>SUA</th>
														<th><small>SBC</small><br>NOM</th>
												<th><small>TOTAL</small><br>IDSE</th>
												<th><small>TOTAL</small><br>SUA</th>
												<th><small>AMORTIZACIÓN</small><br>IDSE</th>
												<th><small>AMORTIZACIÓN</small><br>SUA</th>
														<th><small>AMORTIZACIÓN</small><br>NOM</th>
												<th><small>TIPOS DE RESTRICCIÓN</small> IDSE</th>
												<th><small>TIPOS DE RESTRICCIÓN</small> SUA</th>
										</tr>
									</tfoot>
								</table>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane active" id="tab_2">	<!-- VISTA SIMPLE -->
							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th>NSS</th>
												<th>NOMBRE</th>
												<th>SBC</th>
												<th>TOTAL</th>
												<th>AMORTIZACIÓN</th>
										</tr>
									</thead>
									<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < count($data_sua); $i++) {
												echo '<tr>';
												echo 	'<td>'.$data_sua[$i]['NSS'].'</td>';
												echo 	'<td>'.$data_sua[$i]['NOMBRE'].'</td>';

													$tmpCountSBC = count($data_sua[$i]['SBC']);
													$tmp1 = 0;	$tmp2 = 0;	$tmp3 = 0;
													$tmp4 = 0;	$tmp5 = 0;	$tmp6 = 0;
													
													for ($j = 0; $j < $tmpCountSBC; $j++) {
														$tmp1 += $data_sua[$i]['SBC'][$j];
														$tmp2 += $data_sua[$i]['TOTAL'][$j];
														$tmp3 += $data_sua[$i]['AMORTIZACIÓN'][$j];
													}

													$tmpCountSBC = count($data_idse[$i]['SBC']);
													for ($j = 0; $j < $tmpCountSBC; $j++) {
														$tmp4 += $data_idse[$i]['SBC'][$j];
														$tmp5 += $data_idse[$i]['TOTAL'][$j];
														$tmp6 += $data_idse[$i]['AMORTIZACIÓN'][$j];
													}

												echo 	'<td>'.( ( $tmp1 == $tmp4 ) ? 'SI' : 'NO' ).'____'.$tmp1.'____'.$tmp4.'</td>';
												echo 	'<td>'.( ( $tmp2 == $tmp5 ) ? 'SI' : 'NO' ).'____'.$tmp2.'____'.$tmp5.'</td>';
												echo 	'<td>'.( ( $tmp3 == $tmp6 ) ? 'SI' : 'NO' ).'____'.$tmp3.'____'.$tmp6.'</td>';

												//echo 	'<td>'.( ( $tmp1 == $tmp4 ) ? 'SI' : 'NO' ).'</td>';
												//echo 	'<td>'.( ( $tmp2 == $tmp5 ) ? 'SI' : 'NO' ).'</td>';
												//echo 	'<td>'.( ( $tmp3 == $tmp6 ) ? 'SI' : 'NO' ).'</td>';
												
												//echo 	'<td>'.$tmp1.'  '.$tmp4.'</td>';
												//echo 	'<td>'.$tmp2.'  '.$tmp5.'</td>';
												//echo 	'<td>'.$tmp3.'  '.$tmp6.'</td>';
												echo '</tr>';
											}
										?>
									</tbody>

									<tfoot>
										<tr>
												<th>NSS</th>
												<th>NOMBRE</th>
												<th>SBC</th>
												<th>TOTAL</th>
												<th>AMORTIZACIÓN</th>
										</tr>
									</tfoot>
								</table>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane" id="tab_3">	<!-- SUA -->
					<?php //print_r($data_sua);	echo '<br><br><br>';?>
							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th>FILA</th>
												<?php
													for ($i=0; $i < $lenght_indices_sua; $i++) {
														echo '<th>'.$indices_sua[$i]['name'].'</th>';
													}
												?>
										</tr>
									</thead>
									<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < count($data_sua); $i++) {
												echo '<tr>';
												echo 	'<td>'.$data_sua[$i]['F'].'</td>';
												echo 	'<td>'.$data_sua[$i]['NSS'].'</td>';
												echo 	'<td>'.$data_sua[$i]['NOMBRE'].'</td>';

													$tmpCountSBC = count($data_sua[$i]['SBC']);
													$tmp1 = 0;	$tmp2 = 0;	$tmp3 = 0;
													
													for ($j = 0; $j < $tmpCountSBC; $j++) {
														$tmp1 += $data_sua[$i]['SBC'][$j];
														$tmp2 += $data_sua[$i]['TOTAL'][$j];
														$tmp3 += $data_sua[$i]['AMORTIZACIÓN'][$j];
													}

												echo 	'<td>'.$tmp1.'</td>';
												echo 	'<td>'.$tmp2.'</td>';
												echo 	'<td>'.$tmp3.'</td>';
												echo '</tr>';
											}
										?>
									</tbody>

									<tfoot>
										<tr>
												<th>FILA</th>
												<?php
													for ($i=0; $i < $lenght_indices_sua; $i++) {
														echo '<th>'.$indices_sua[$i]['name'].'</th>';
													}
												?>
										</tr>
									</tfoot>
								</table>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
				<div class="tab-pane" id="tab_4">	<!-- IDSE -->
					<?php /*for ($i = 0; $i < count($data_idse); $i++) {
						if( $data_idse[$i]['NSS'] == '09088934832'){
							//echo count($data_idse);
							print_r( $data_idse[$i] );
							echo '<br>';
						}
						
					} */?>
					<?php //echo '<br>'; print_r($data_idse);	echo '<br><br><br>';?>

							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th>FILA</th>
												<?php
													for ($i=0; $i < $lenght_indices_idse; $i++) {
														echo '<th>';
														echo $indices_idse[$i]['name'];
														echo '</th>';
													}
												?>
										</tr>
								</thead>
								<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < count($data_idse); $i++) {
												echo '<tr>';
												echo 	'<td>'.$data_idse[$i]['F'].'</td>';
												echo 	'<td>'.$data_idse[$i]['NSS'].'</td>';
												echo 	'<td>'.$data_idse[$i]['NOMBRE'].'</td>';


													$tmpCountSBC = count($data_idse[$i]['SBC']);
													$tmp1 = 0;	$tmp2 = 0;	$tmp3 = 0;
													
													for ($j = 0; $j < $tmpCountSBC; $j++) {
														$tmp1 += $data_idse[$i]['SBC'][$j];
														$tmp2 += $data_idse[$i]['TOTAL'][$j];
														$tmp3 += $data_idse[$i]['AMORTIZACIÓN'][$j];
													}

												echo 	'<td>'.$tmp1.'</td>';
												echo 	'<td>'.$tmp2.'</td>';
												echo 	'<td>'.$tmp3.'</td>';


												echo '</tr>';
											}
										?>
								</tbody>

								<tfoot>
										<tr>
												<th>FILA</th>
												<?php
													for ($i=0; $i < $lenght_indices_idse; $i++) {
														echo '<th>';
														echo $indices_idse[$i]['name'];
														echo '</th>';
													}
												?>
										</tr>
								</tfoot>
							</table>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			</div> <!-- /.nav nav-tabs pull-right -->
		</div> <!-- /.nav-tabs-custom -->
	</div> <!-- /.box -->