	<div class="box">
		<div class="box-header">
<!--
				<div class="col-xs-3 col-xs-offset-2">
						<select class="form-control text-center" id="anio">
							<option value="0" disabled selected>AÑO</option>
							<?php
								for ($i = 0; $i < 10; $i++) {
									echo '<option value="'.$i.'">'. ( 2017 + $i).'</option>';
								}

							?>
						</select>
				</div>

				<div class="col-xs-3 col-xs-offset-0">
						<select class="form-control text-center" id="mes">
							<option value="0" disabled selected>MES</option>
							<?php
								$meses = array(
									'ENERO',			'FEBRERO',
									'MARZO',			'ABRIL',
									'MAYO',				'JUNIO',
									'JULIO',			'AGOSTO',
									'SEPTIEMBRE',	'OCTUBRE',
									'NOVIEMBRE',	'DICIEMBRE'
								);


								for ($i = 0; $i < count($meses); $i++) {
									echo '<option value="'.$i.'">'. $meses[$i] .'</option>';
								}

							?>
						</select>
						</select>
				</div>

				<div class="col-xs-3 col-xs-offset-0">
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#UsuarioNuevo">
						BUSCAR
					</button>
				</div>
-->
		</div>

		<div class="box-body">
				<!-- Historial de Comparativas -->
					<table id="example01" class="table table-bordered table-striped dataTables">
						<thead>
								<tr>
									<th>TITULO</th>
									<th>MES</th>
									<th>AÑO</th>
									<th>OPCIONES</th>
								</tr>
						</thead>
						<!-- /// /// /// /// /// /// /// /// /// -->
						<tbody>
<?php
//echo count($ComparativasGuardadas);
//print_r($ComparativasGuardadas);
?>
						<?php
							for ($i=0; $i < count($ComparativasGuardadas); $i++) {
								echo '<tr>';
								echo 	'<td>'. $ComparativasGuardadas[$i]['Titulo'] .'</td>';
								echo 	'<td>'.$meses[ $ComparativasGuardadas[$i]['Mes'] - 1 ].'</td>';
								echo 	'<td>'. $ComparativasGuardadas[$i]['Anio'] .'</td>';
								
								echo 	'<td width="128px">';
										if( $ComparativasGuardadas[$i]['HC'] == 2 ){
											echo '<a class="btn btn-success descargar_documento" href="C_HistorialComparativas/ComparativaMensual/'. $ComparativasGuardadas[$i]['Id'] .'">';
											echo	'<i class="fa fa-file-text-o"></i>';
											echo	'&nbsp;&nbsp;';
											echo	'<b>MENSUAL</b>';
											echo	'&nbsp;&nbsp;&nbsp;&nbsp;';
										}elseif ( $ComparativasGuardadas[$i]['HC'] == 4 ){
											echo '<a class="btn btn-success descargar_documento" href="C_HistorialComparativas/ComparativaBimestral/'. $ComparativasGuardadas[$i]['Id'] .'">';
											echo	'<i class="fa fa-file-text"></i>';
											echo	'&nbsp;&nbsp;';
											echo	'<b>BIMESTRAL</b>';
										}
											echo '&nbsp;';
											echo '</a>';
											echo '&nbsp;&nbsp;';
								//echo 		'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">';
								/*
								echo 		'<button type="button" class="btn btn-danger">';
								echo 			'<i class="fa fa-close"></i>';
								echo 		'</button>';
								*/
								echo 	'</td>';
								echo '</tr>';
							}
						?>
						</tbody>
						<!-- /// /// /// /// /// /// /// /// /// -->
						<tfoot>
								<tr>
									<th>TITULO</th>
									<th>MES</th>
									<th>AÑO</th>
									<th>OPCIONES</th>
								</tr>
						</tfoot>
					</table>
				<!-- end Historial de Comparativas -->

		</div>
		<!-- /.box-body -->

	</div>

<?php 
function obtenerMes($num_mes){
	$texto_mes = '';


	return $texto_mes;
}

?>