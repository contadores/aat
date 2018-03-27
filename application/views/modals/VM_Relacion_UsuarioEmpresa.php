<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="Relacion_UsuarioEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">RELACIÓN: <b>Usuarios - Empresas</b></h4>
			</div>

			<div class="modal-body"><div class="row">

					<div class="col-xs-6 col-xs-offset-0">
							<div class="panel panel-primary">
									<div class="panel-heading">
											<h3 class="panel-title">Mis Empresas Añadidas</h3>
									</div>
									<!-- <div class="panel-body"> -->
									<div class="tabla_body">
											<table class="table table-bordered table-hover">
												<thead>
													<tr class="active">
														<!-- <th scope="col">#</th> -->
														<th scope="col">EMPRESA</th>
														<th scope="col" class="text-center" width="78px">REMOVER</th>
													</tr>
												</thead>
												<tbody id="empresas_agregadas">

												</tbody>
											</table>
									</div>
							</div>
					</div>

					<div class="col-xs-6 col-xs-offset-0">
							<div class="panel panel-primary">
									<div class="panel-heading">
											<h3 class="panel-title">Todas las Empresas Registradas</h3>
									</div>
									<!-- <div class="panel-body"> -->
									<div class="tabla_body">
											<table class="table table-bordered table-hover">
												<thead>
													<tr class="active">
														<!-- <th scope="col">#</th> -->
														<th scope="col">EMPRESA</th>
														<th scope="col" class="text-center" width="78px">AÑADIR</th>
													</tr>
												</thead>
												<tbody id="empresas_registradas">

												</tbody>
											</table>
									</div>
									<!-- </div> -->
							</div>
					</div>

					<div class="col-xs-12 col-xs-offset-0">
						<div class="alert" role="alert" id="RUE_Alert"></div>
					</div>

					<div class="col-xs-12 col-xs-offset-0">
						<button type="button" id="btnGuardarRelacion_UsuarioEmpresa" class="btn btn-primary btn-block"><b>GUARDAR RELACIÓN</b></button>
						<button type="button" class="btn btn-default btn-block" data-dismiss="modal">CERRAR</button>
					</div>
			</div></div>
			<!--
			<div class="modal-footer">

			</div>
			-->
		</div>
	</div>
</div>
