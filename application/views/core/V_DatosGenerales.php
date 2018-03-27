<form role="form">
<div class="row">
<!-- <div class="col-md-10 col-md-offset-1"> -->
<div class="col-md-12">

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
			<li><a href="#tab_3" data-toggle="tab" onclick="cambiarTituloDatosGenerales(3);"><i class="fa fa-archive"></i></a></li>
			<li><a href="#tab_2" data-toggle="tab" onclick="cambiarTituloDatosGenerales(2);"><i class="fa fa-map-o"></i></a></li>
			<li class="active"><a href="#tab_1" data-toggle="tab" onclick="cambiarTituloDatosGenerales(1);"><i class="fa fa-book"></i></a></li>
			<li class="pull-left header" id="tituloExpediente"><i class="fa fa-book"></i> Datos de identificación del actor</li>
		</ul>
		<div class="tab-content">
		<br>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane active" id="tab_1">
					<div class="box-body">
							<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label for="nombre">Nombre (s)</label>
											<input type="text" class="form-control" id="nombre" placeholder="Nombre (s)">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="ap_pa">Apellido paterno</label>
											<input type="text" class="form-control" id="ap_pa" placeholder="Apellido paterno">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="ap_ma">Apellido materno</label>
											<input type="text" class="form-control" id="ap_ma" placeholder="Apellido materno">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="genero">Genero</label>
											<select class="form-control" id="genero">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de nacimiento</label>

											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

							<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_2">
					<div class="box-body">
							<div class="row">
							<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
									<div class="col-md-4">
										<div class="form-group">
											<label for="estado">Estado</label>
											<select class="form-control" id="estado">
												<option>Oaxaca</option>
												<option >Tamaulipas</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="municipio">Municipio</label>
											<select class="form-control" id="municipio">
												<option>Mante</option>
												<option>Xico</option>
												<option>Victoria</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="colonia">Colonia</label>
											<input type="text" class="form-control" id="colonia" placeholder="Colonia">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="calle_numero">Calle y número</label>
											<input type="text" class="form-control" id="calle_numero" placeholder="Calle y número">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="cp">CP</label>
											<input type="text" class="form-control" id="cp" placeholder="CP">
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_3">
					<div class="box-body">
							<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label for="curp">CURP</label>
											<input type="text" class="form-control" id="curp" placeholder="CURP">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="rfc">RFC</label>
											<input type="text" class="form-control" id="rfc" placeholder="RFC">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="ine">INE</label>
											<input type="text" class="form-control" id="ine" placeholder="INE">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de ingreso a la SSA</label>

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
	</div>

	<button type="submit" class="btn btn-primary btn-lg pull-right">Guardar</button>
	<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
	<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
</div>
</div>
</form>