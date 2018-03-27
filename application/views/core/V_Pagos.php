<!-- form start -->
<form role="form">
<div class="row">
<!-- <div class="col-md-10 col-md-offset-1"> -->
<div class="col-md-12">


	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
			<li><a href="#tab_5" data-toggle="tab" onclick="cambiarTituloPagos(5);"><i class="fa fa-clone"></i></a></li>
			<li><a href="#tab_4" data-toggle="tab" onclick="cambiarTituloPagos(4);"><i class="fa fa-calendar-check-o"></i></a></li>
			<li><a href="#tab_3" data-toggle="tab" onclick="cambiarTituloPagos(3);"><i class="fa fa-file-text"></i></a></li>
			<li><a href="#tab_2" data-toggle="tab" onclick="cambiarTituloPagos(2);"><i class="fa fa-file-text-o"></i></a></li>
			<li class="active"><a href="#tab_1" data-toggle="tab" onclick="cambiarTituloPagos(1);"><i class="fa fa-dollar"></i></a></li>
			<li class="pull-left header" id="tituloExpediente"><i class="fa fa-dollar"></i> Pagos</li>
		</ul>
		<div class="tab-content">
		<br>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane active" id="tab_1">
					<div class="box-body">
							<div class="row">
								<div class="col-md-6">
										<div class="col-md-6">
											<div class="form-group">
												<label for="tipo_demanda">Número de expediente</label>
												<select class="form-control" id="tipo_demanda">
													<option>Masculino</option>
													<option>Femenino</option>
													<option>Otro</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="wwww">&nbsp;</label>
												<input type="text" class="form-control" id="wwww" placeholder="wwww">
											</div>
										</div>
								</div>


								<div class="col-md-6">
										
										<div class="col-md-5 col-md-offset-1">
											<div class="form-group">
												<label>
													<input type="checkbox" class="flat-red" checked>&nbsp;&nbsp;Documental pública
												</label>
												<label>
													<input type="checkbox" class="flat-red">&nbsp;&nbsp;Documental privada
												</label>
												<label>
													<input type="checkbox" class="flat-red">&nbsp;&nbsp;Informe de autoridad
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="wwww">Cantidad de pago</label>
												<input type="text" class="form-control" id="wwww" placeholder="wwww">
											</div>
										</div>

								</div>
							</div>
							<br>
							<br>
							Nota: en caso de que el banco envió el cheque y no el organismo anotar datos.
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_2">
					<div class="box-body">
							<div class="row">

									<div class="col-md-5 col-md-offset-1">
										<div class="form-group">
											<label for="wwww">Oficio de solicitud de cheque a finanzas	</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label for="datepicker">Fecha de la solicitud de cheque a finanzas</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_3">
					<div class="box-body">
							<div class="row">

									<div class="col-md-5 col-md-offset-1">
										<div class="form-group">
											<label for="wwww">Número de cheque</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>

									<div class="col-md-5">
										<div class="form-group">
											<label for="wwww">Concepto de pago</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_4">
					<div class="box-body">
							<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label for="wwww">Oficio de devolución de póliza del cheque</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de devolución de póliza de cheque</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="wwww">Número de póliza</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_5">
					<div class="box-body">
							<div class="row">

									<div class="col-md-4 col-md-offset-1">
										<div class="form-group">
											<label for="datepicker">Fecha que el beneficiario recibió el cheque</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
		</div>
		<!-- /.tab-content -->
	</div>
	<!-- nav-tabs-custom -->

	<button type="submit" class="btn btn-primary btn-lg pull-right">Guardar</button>
	<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
	<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>

</div>
</div>
</form>