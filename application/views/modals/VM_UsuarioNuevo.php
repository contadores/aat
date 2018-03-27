<!-- Modal -->
<div class="modal fade" id="UsuarioNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevoUsuario" class="box-body box-profile">
							<input type="hidden" class="form-control" id="Id" name="Id" value="0">

							<!-- <img class="profile-user-img img-responsive img-circle" src="<?=base_url();?>assets/img/usuarios/user4-128x128.jpg" alt="User profile picture"> -->
							<!-- <h3 class="profile-username text-center">Foto</h3> -->

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<input type="text" class="form-control" id="Nombre" placeholder="Nombre (s)" maxlength="200">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="Ap_pa" placeholder="Apellido paterno" maxlength="100">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="Ap_ma" placeholder="Apellido materno" maxlength="100">
								</li>
								<li class="list-group-item">
									<select class="form-control" id="IdCatSexo">
									</select>
								</li>

								<li class="list-group-item">
									<input type="text" class="form-control" id="Correo" placeholder="Correo Electronico" maxlength="100">
								</li>
								<li class="list-group-item">
									<input type="text" class="form-control" id="Password" placeholder="Contraseña" maxlength="100">
								</li>
								<li class="list-group-item">
									<select class="form-control" id="IdCatTipoUsuario">
									</select>
								</li>
							</ul>
								<div class="alert" role="alert" id="VM_UN_Alert"></div>

								<button type="button" id="btnGuardarUsuario" class="btn btn-primary btn-block"><b>GUARDAR</b></button>
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