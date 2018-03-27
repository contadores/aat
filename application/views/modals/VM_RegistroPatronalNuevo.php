<!-- Modal -->
<div class="modal fade" id="RegistroPatronalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Nuevo Registro Patronal</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevoRegistroPatronal" class="box-body box-profile">

							<input type="hidden" class="form-control" id="Id" name="Id" value="0">

							<input type="hidden" class="form-control" id="IdEmpresa" name="IdEmpresa" value="0">
							<!--
							<h2 class="text-center">Carl's Juniors</h2>
							<p class="text-muted text-center">EMPRESA</p>
							-->
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<input type="text" class="form-control" id="RP" placeholder="Registro Patronal" maxlength="200">
								</li>

								<li class="list-group-item">
									<select class="form-control" id="IdCatEstado2">
									</select>
								</li>

								<li class="list-group-item">
									<select class="form-control" id="IdCatMunicipio2">
									</select>
								</li>

								<li class="list-group-item">
									<input type="text" class="form-control" id="Colonia" placeholder="Colonia" maxlength="200">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="Calle" placeholder="Calle" maxlength="200">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="Num_ext" placeholder="Numero Exterior" maxlength="5">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="Num_int" placeholder="Numero Interior" maxlength="5">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="CP" placeholder="CP" maxlength="5">
								</li>
							</ul>
								<div class="alert" role="alert" id="VM_RP"></div>

								<button type="button" id="btnGuardarRegistroPatronal" class="btn btn-primary btn-block"><b>GUARDAR</b></button>
								<button type="button" class="btn btn-default btn-block" data-dismiss="modal">CERRAR</button>
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
