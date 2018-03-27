<!-- Modal -->
<div class="modal fade" id="UsuarioDetalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Detalles de Usuario</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">

							<div class="col-xs-12 col-xs-offset-0">
									<!-- <img class="profile-user-img img-responsive img-circle" src="<?=base_url();?>assets/img/usuarios/user4-128x128.jpg" alt="User profile picture"> -->
									<br>
									<h2 class="profile-username text-center li-control" id="NombreCompleto">--</h2>
									<p class="text-muted text-center" id="TipoUsuario">Usuario</p>
							</div>

							<div class="col-xs-12 col-xs-offset-0">
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b>GENERO</b> <a class="pull-right li-control" id="Sexo">--</a>
										</li>
										<li class="list-group-item">
											<b>CORREO</b> <a class="pull-right li-control" id="Correo">--</a>
										</li>
										<li class="list-group-item">
											<b>CONTRASEÑA</b> <a class="pull-right li-control" id="Password">--</a>
										</li>
										<!-- <li class="list-group-item"> -->
											<!-- <b>TIPO DE USUARIO</b> <a class="pull-right li-control" id="TipoUsuario">--</a> -->
										<!-- </li> -->
									</ul>
										<button type="button" class="btn btn-default btn-block" data-dismiss="modal">CERRAR</button>
							</div>
						</div>
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