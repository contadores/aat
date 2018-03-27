<!-- Modal -->
<div class="modal fade" id="VM_ComparativaNueva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Guardar Nueva Comparativa</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevaComparativa" class="box-body box-profile">
							<input type="hidden" class="form-control" id="IdComparativa"	name="IdComparativa"	value="0">
							<!--
							<h3 class="profile-username text-center"><i class="fa fa-save"></i> GUARDAR</h3>
							-->
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<input type="text" class="form-control" id="Titulo" placeholder="TITULO">
								</li>

								<li class="list-group-item">
									<select class="form-control" id="Anio">
										<option value="0" disabled selected>AÑO</option>
										<?php
											for( $i = 2017; $i <= date('Y'); $i++ ){
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
										?>
									</select>
								</li>
								<li class="list-group-item">
									<select class="form-control" id="Mes">
										<option value="0" disabled selected>MES</option>
										<?php
											$meses = array();
											$meses[1]  = 'ENERO';		$meses[2]  = 'FEBRERO';		$meses[3]  = 'MARZO';
											$meses[4]  = 'ABRIL';		$meses[5]  = 'MAYO';			$meses[6]  = 'JUNIO';
											$meses[7]  = 'JULIO';		$meses[8]  = 'AGOSTO';		$meses[9]  = 'SEPTIEMBRE';
											$meses[10] = 'OCTUBRE';	$meses[11] = 'NOVIEMBRE';	$meses[12] = 'DICIEMBRE';

											for( $i = 1; $i <= 12; $i++ ){
												echo '<option value="'.$i.'">'.$meses[$i].'</option>';
											}
										?>
									</select>
								</li>

							</ul>
								<button type="button" class="btn btn-primary btn-block"	
												id="btnGuardarComparativaMensual"><b>GUARDAR COMPARATIVA MENSUAL</b>
								</button>
								<button type="button" class="btn btn-primary btn-block"	
												id="btnGuardarComparativaBimestral"><b>GUARDAR COMPARATIVA BIMESTRAL</b>
								</button>
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal"	>CERRAR</button>
						</form>
						<!-- /.box-body -->
					</div>
			</div>
			<!--
			<div class="modal-footer">

			</div>
			-->
		</div>
	</div>
</div>
