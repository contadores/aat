<div class="box" id="parametrosFI">
	<div class="box">
		<div class="box-header">
		
<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevaEmpresa" class="box-body box-profile">
							<input type="hidden" class="form-control" id="Id" name="Id" value="0">
							<input type="hidden" class="form-control" id="IdUsuario" name="IdUsuario" value="0">							
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<label>DÍAS AGUINALDO</label>
									<input type="text" class="form-control" id="diasaguinaldo" placeholder="Días de aguinaldo" maxlength="200">
								</li>
								<li class="list-group-item">
									<label>PORCENTAJE PRIMA VACACIONAL</label>
									<input type="text" class="form-control" id="porcentajevacaciones" placeholder="Porcentaje de prima vacacional" maxlength="12">
								</li>
							</ul>							
								<div class="alert" role="alert" id="VM_EN_Alert"></div>
								<button type="button" id="btnGuardarEmpresa" class="btn btn-primary btn-block"><b>GUARDAR</b></button>
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal">CERRAR</button>
						</form>					
					</div>
										<div class="box box-primary">
		<div class="box-body">
				<!-- Historial de Comparativas -->
					<table id="example01" class="table table-bordered table-striped dataTables">
						<thead>
								<tr>
									<th>AÑOS TRABAJADOS</th>
									<th>DÍAS VACACIONES</th>
								</tr>
						</thead>
						<!-- /// /// /// /// /// /// /// /// /// -->
						<tbody>
<?php
//echo count($ComparativasGuardadas);
//print_r($ComparativasGuardadas);
?>
						</tbody>
						<!-- /// /// /// /// /// /// /// /// /// -->
						<tfoot>
								<tr>
									<th>AÑOS TRABAJADOS</th>
									<th>DÍAS VACACIONES</th>
								</tr>
						</tfoot>
					</table>
				<!-- end Historial de Comparativas -->

		</div>
		<!-- /.box-body -->
	</div>
	</div>
</div>
