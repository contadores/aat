<?php	$data_lenght = count($data_exceles); //print_r($data_exceles);	?>


	<div class="box">
		<div class="nav-tabs-custom">
			<form id="form_descargar_documento" action="<?= base_url();?>" method="POST"> <!--  target="_blank" -->
				<input type="hidden" name="IdComparativa" id="IdComparativa" value="<?= $IdComparativa; ?>">
			</form>

			<ul class="nav nav-tabs pull-right">
				<li class="descargar_documento"><a id="a_ComparativaMensual" href="#"><b> &nbsp;&nbsp; <i class="fa fa-download"></i> &nbsp; DESCARGAR &nbsp;&nbsp; </b></a></li>
				<li><a href="#tab_1" data-toggle="tab"><i class="fa fa-search-plus"></i> &nbsp; VISTA DETALLADA </a></li>
				<li class="active"><a href="#tab_2" data-toggle="tab"><i class="fa fa-search"></i> &nbsp; VISTA SIMPLE </a></li>
				<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-file-text-o"></i> &nbsp; IDSE </a></li>
				<li><a href="#tab_4" data-toggle="tab"><i class="fa fa-file-text-o"></i> &nbsp; SUA </a></li>
			</ul>

			<div class="tab-content">
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane table-responsive" id="tab_1">	<!-- VISTA DETALLADA -->
							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th>  NSS</th>
												<th>  NOMBRE</th>
												<th><small>SBC</small>  SUA</th>
												<th><small>SBC</small>  IDSE</th>
												<!-- 		<th><small>SBC</small><br>NOM</th> -->
												<th><small>TOTAL</small>  SUA</th>
												<th><small>TOTAL</small>  IDSE</th>
										</tr>
									</thead>
									<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < $data_lenght; $i++) {
												echo '<tr>';
													echo 	'<td>'.$data_exceles[$i]['NSS'].'</td>';
													echo 	'<td>'.str_replace(' ', '&nbsp;', $data_exceles[$i]['Nombre']).'</td>';
													echo 	'<td>';
													echo		( $data_exceles[$i]['SBC_SUA'] == null		) ? '0.00' : $data_exceles[$i]['SBC_SUA'];
													echo 	'</td>';
													echo 	'<td>';
													echo		( $data_exceles[$i]['SBC_IDSE'] == null		) ? '0.00' : $data_exceles[$i]['SBC_IDSE'];
													echo 	'</td>';
													echo 	'<td>';
													echo		( $data_exceles[$i]['Total_SUA'] == null	) ? '0.00' : $data_exceles[$i]['Total_SUA'];
													echo 	'</td>';
													echo 	'<td>';
													echo		( $data_exceles[$i]['Total_IDSE'] == null ) ? '0.00' : $data_exceles[$i]['Total_IDSE'];
													echo 	'</td>';
												echo '</tr>';
											}
										?>
									</tbody>

									<tfoot>
										<tr>
												<th>  NSS</th>
												<th>  NOMBRE</th>
												<th><small>SBC</small>  SUA</th>
												<th><small>SBC</small>  IDSE</th>
												<!-- 		<th><small>SBC</small><br>NOM</th> -->
												<th><small>TOTAL</small>  SUA</th>
												<th><small>TOTAL</small>  IDSE</th>
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
												<!-- <th>AMORTIZACIÓN</th> -->
										</tr>
									</thead>
									<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < $data_lenght; $i++) {
												echo '<tr>';
													echo 	'<td>'.$data_exceles[$i]['NSS'].'</td>';
													echo 	'<td>'.$data_exceles[$i]['Nombre'].'</td>';
													echo 	'<td>';
													echo 				($data_exceles[$i]['SBC_SUA'] == $data_exceles[$i]['SBC_IDSE']) ? 'SI' : 'NO';
													echo 	'</td>';
													echo 	'<td>';
													echo 				($data_exceles[$i]['Total_SUA'] == $data_exceles[$i]['Total_IDSE']) ? 'SI' : 'NO';
													echo 	'</td>';
												// echo 	'<td>';
												// echo 				($data_exceles[$i]['Amortizacion1'] == $data_exceles[$i]['Amortizacion2']) ? 'SI' : 'NO';
												// echo 	'</td>';
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
												<!-- <th>AMORTIZACIÓN</th> -->
										</tr>
									</tfoot>
								</table>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
				<div class="tab-pane" id="tab_3">	<!-- IDSE -->
							<?php 
								//echo '<br>'; print_r($data_idse);	echo '<br><br><br>';
								$col_lenght = count( array_keys($data_idse[0]) );
								$data_lenght = count($data_idse);
							?>

							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th>FILA</th>
												<th>NSS</th>
												<th>NOMBRE</th>
												<th>SBC</th>
												<th>TOTAL</th>
												<!-- <th>AMORTIZACIÓN</th> -->
										</tr>
								</thead>
								<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < $data_lenght; $i++) {
												echo '<tr>';
													echo 	'<td>'.$data_idse[$i]['Fila'].'</td>';
													echo 	'<td>'.$data_idse[$i]['NSS'].'</td>';
													echo 	'<td>'.$data_idse[$i]['Nombre'].'</td>';
													echo 	'<td>'.$data_idse[$i]['SBC'].'</td>';
													echo 	'<td>'.$data_idse[$i]['Total'].'</td>';
												// echo 	'<td>'.$data_idse[$i]['Amortizacion'].'</td>';
												echo '</tr>';
											}
										?>
								</tbody>
								<tfoot>
										<tr>
												<th>FILA</th>
												<th>NSS</th>
												<th>NOMBRE</th>
												<th>SBC</th>
												<th>TOTAL</th>
												<!-- <th>AMORTIZACIÓN</th> -->
										</tr>
								</tfoot>
							</table>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane" id="tab_4">	<!-- SUA -->
							<?php 
								//echo '<br>'; print_r($data_sua);	echo '<br><br><br>';
								$col_lenght = count( array_keys($data_sua[0]) );
								$data_lenght = count($data_sua);
							?>

							<table class="table table-bordered table-striped dataTables">
								<thead>
										<tr>
												<th>FILA</th>
												<th>NSS</th>
												<th>NOMBRE</th>
												<th>SBC</th>
												<th>TOTAL</th>
												<!-- <th>AMORTIZACIÓN</th> -->
										</tr>
								</thead>
								<tbody id="empresas-all">
										<?php 
											for ($i = 0; $i < $data_lenght; $i++) {
												echo '<tr>';
													echo 	'<td>'.$data_sua[$i]['Fila'].'</td>';
													echo 	'<td>'.$data_sua[$i]['NSS'].'</td>';
													echo 	'<td>'.$data_sua[$i]['Nombre'].'</td>';
													echo 	'<td>'.$data_sua[$i]['SBC'].'</td>';
													echo 	'<td>'.$data_sua[$i]['Total'].'</td>';
												// echo 	'<td>'.$data_sua[$i]['Amortizacion'].'</td>';
												echo '</tr>';
											}
										?>
								</tbody>
								<tfoot>
										<tr>
												<th>FILA</th>
												<th>NSS</th>
												<th>NOMBRE</th>
												<th>SBC</th>
												<th>TOTAL</th>
												<!-- <th>AMORTIZACIÓN</th> -->
										</tr>
								</tfoot>
							</table>
				</div>

			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			</div> <!-- /.nav nav-tabs pull-right -->
		</div> <!-- /.nav-tabs-custom -->
	</div> <!-- /.box -->