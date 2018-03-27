<!-- Modal -->
<div class="modal fade" id="EmpresaNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Nueva Empresa</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevaEmpresa" class="box-body box-profile">
							<input type="hidden" class="form-control" id="Id" name="Id" value="0">
							<input type="hidden" class="form-control" id="IdUsuario" name="IdUsuario" value="0">

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<input type="text" class="form-control" id="Nombre" placeholder="Nombre de la empresa" maxlength="200">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="RFC" placeholder="RFC" maxlength="12">
								</li>

								<li class="list-group-item">
									<select class="form-control" id="IdCatEstado">
									</select>
								</li>

								<li class="list-group-item">
									<select class="form-control" id="IdCatMunicipio">
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
								<div class="alert" role="alert" id="VM_EN_Alert"></div>

								<button type="button" id="btnGuardarEmpresa" class="btn btn-primary btn-block"><b>GUARDAR</b></button>
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
