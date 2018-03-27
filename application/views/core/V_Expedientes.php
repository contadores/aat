<!-- form start -->
<form role="form">
<div class="row">
<!-- <div class="col-md-10 col-md-offset-1"> -->
<div class="col-md-12">

					
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
			<li><a href="#tab_8" data-toggle="tab" onclick="cambiarTituloExpediente(8);"><i class="fa fa-clone"></i></a></li>
			<li><a href="#tab_7" data-toggle="tab" onclick="cambiarTituloExpediente(7);"><i class="fa fa-truck"></i></a></li>
			<li><a href="#tab_6" data-toggle="tab" onclick="cambiarTituloExpediente(6);"><i class="fa fa-dollar"></i></a></li>
			<li><a href="#tab_5" data-toggle="tab" onclick="cambiarTituloExpediente(5);"><i class="fa fa-legal"></i></a></li>
			<li><a href="#tab_4" data-toggle="tab" onclick="cambiarTituloExpediente(4);"><i class="fa fa-institution"></i></a></li>
			<li><a href="#tab_3" data-toggle="tab" onclick="cambiarTituloExpediente(3);"><i class="fa fa-file-text"></i></a></li>
			<li><a href="#tab_2" data-toggle="tab" onclick="cambiarTituloExpediente(2);"><i class="fa fa-file-text-o"></i></a></li>
			<li class="active"><a href="#tab_1" data-toggle="tab" onclick="cambiarTituloExpediente(1);"><i class="fa fa-book"></i></a></li>
			<li class="pull-left header" id="tituloExpediente"><i class="fa fa-book"></i> Datos de identificación del expediente</li>
		</ul>
		<div class="tab-content">
		<br>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane active" id="tab_1">
					<div class="box-body">
							<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label for="wwww">Número de expediente</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="wwww">Junta</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="wwww">Año</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="wwww">Lugar</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="tipo_demanda">Tipo de demanda</label>
											<select class="form-control" id="tipo_demanda">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha que fue presentada la demanda</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de radicación de la demanda</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="abogado_upapl">Abogado de UPAPL</label>
											<select class="form-control" id="abogado_upapl">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="wwww">Despacho</label>
											<input type="text" class="form-control" id="wwww" placeholder="wwww">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha que fue recibida la demanda</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="persona_recibio_demanda">Persona que recibio la demanda</label>
																								<?php //Demandada ?>
											<select class="form-control" id="persona_recibio_demanda">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="exampleInputFile">Adjuntar expediente</label>
											<input type="file" id="exampleInputFile">
											<p class="help-block">Achivos en formato PDF.</p>
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_2">
					<div class="box-body">
							<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de audiencia principal</label>
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
											<label for="datepicker">Fecha de acuerdo de cierre de instrucción</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de contestación de la audiencia principal</label>
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
											<label for="datepicker">Fecha de audiencia de incidentes</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de audencia de pruebas</label>
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
											<label for="datepicker">Fecha de las pruebas confesional</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de escritorio de pruebas</label>
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
											<label for="datepicker">Fecha de la inspección ocular</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de desahogo de pruebas</label>
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
											<label for="datepicker">Fecha del cotejo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

							</div>
								<br>
							<div class="row">

									<div class="col-md-3 col-md-offset-3">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Documental pública
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Documental privada
											</label>
										</div>
									</div>
									<div class="col-md-3 col-md-offset-3">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Informe de autoridad
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Peritaje
											</label>
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
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Actualización
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono de 20 años
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Nivelación salarial
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Aguinaldos
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono de 25 años
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Nombramiento
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Aguinaldo durante el proceso
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono de 30 años
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Nulidad de convenio
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Alto riesgo de trabajo
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Compensación por baja
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Pago de cuantas al IPSSET
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Aplicación de codiciones generales de trabajo
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Cumpleaños
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Pago del día 31 de cada mes
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Asignación bruta
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Descanso anual extraordinario
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Pensión
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Ayuda económica
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Despensa
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Prima antigüedad
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Ayuda de servicios
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Devolución de cuotas al fovissste
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Prima dominical
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Base
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Días festivos
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Prima vacacional
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono asistencia perfecta
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Diferencias salariales
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Prima vacacional durante el proceso
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono asistencia y permanencia
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Horas extras al doble
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Quinquenios
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono de puntualidad
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Horas extras al triple
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Reconocimiento de antigüedad
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono de productividad
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Incapacidad
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Reinstalación
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono de fin de año durante el proceso
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Inclusión en nómina
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Salarios caidos
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono del día de las madres
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Indemnización constitucional
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Salarios devengados
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono del día de reyes
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Intereses moratorios
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Transporte
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono del día del trabajador
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Jubilación
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Vacaciones
											</label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Bono del día del trabajador durante el proceso
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Mediano riesgo de trabajo
											</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>
												<input type="checkbox" class="flat-red">&nbsp;&nbsp;Vacaciones durante el proceso
											</label>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Otras</label>
											<textarea class="form-control" rows="4" placeholder="Otras.."></textarea>
										</div>
									</div>

							</div>
					</div>
			</div>
			<!-- /.tab-pane -->
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_4">
					<div class="box-body">
							<div class="row">

									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de 1er laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación del laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="estado">Personal que recibió el laudo</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha del amparo directo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de 2do laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación del laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="estado">Personal que recibió el laudo</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha del amparo directo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de 3er laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación del laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="estado">Personal que recibió el laudo</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha del amparo directo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de 4to laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación del laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="estado">Personal que recibió el laudo</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha del amparo directo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de 5to laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación del laudo</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="estado">Personal que recibió el laudo</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="datepicker">Fecha del amparo directo</label>
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
			<div class="tab-pane" id="tab_5">
					<div class="box-body">
							<h4>a)</h4>
							<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de planilla de liquidación para actora</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Cantidad de planilla de liquidación parte actora</label>
											<input type="text" class="form-control" id="cp" placeholder="CP">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de planilla de liquidación OPD</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Cantidad de planilla de liquidación OPD</label>
											<input type="text" class="form-control" id="cp" placeholder="CP">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de incidente de liquidación</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de resolución de interlocutoria de incidente de liquidación</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación de interlocutoria</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de amparo indirecto</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="estado">Personal que recibio notificación de interlocutoria</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>

							</div>
								<br><hr><br>
							<h4>b)</h4>
							<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de planilla de liquidación para actora</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Cantidad de planilla de liquidación parte actora</label>
											<input type="text" class="form-control" id="cp" placeholder="CP">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de planilla de liquidación OPD</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Cantidad de planilla de liquidación OPD</label>
											<input type="text" class="form-control" id="cp" placeholder="CP">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de incidente de liquidación</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de resolución de interlocutoria de incidente de liquidación</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de notificación de interlocutoria</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="datepicker">Fecha de amparo indirecto</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="estado">Personal que recibio notificación de interlocutoria</label>
											<select class="form-control" id="estado">
												<option>Masculino</option>
												<option>Femenino</option>
												<option>Otro</option>
											</select>
										</div>
									</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_6">
					<div class="box-body">
							<div class="row">

								<div class="col-md-8">
										<table id="example2" class="table table-bordered table-hover table-striped">
											<thead>
												<tr>
													<th>Cheque de caja</th><th>Cantidad de pago</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
												<tr>
													<td>X</td><td>4</td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<th>Cheque de caja</th>
													<th>Cantidad de pago</th>
												</tr>
											</tfoot>
										</table>
								</div>
								
								<div class="col-md-2">
									<div class="form-group">
										<label for="datepicker">Fecha de convenio</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="datepicker" placeholder="">
										</div>
									</div>
								</div>

								<div class="col-md-2">
										<div class="form-group">
											<label for="cp">Monto</label>
											<input type="text" class="form-control" id="cp" placeholder="$">
										</div>
								</div>

								<div class="col-md-4">
									<hr>

									<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">
									  Agregar pagos realizados
									</button>

								<br><br><br><br>
									<h3>Total pagado</h3>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="text" class="form-control">
									</div>
									<h3>Ahorro</h3>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="text" class="form-control">
									</div>
								</div>

							</div>
					</div>
			</div>
		<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			<div class="tab-pane" id="tab_7">
					<div class="box-body">
							
							<div class="row">
									<div class="col-md-3">
										<br><br>
										<div class="info-box">
										  <span class="info-box-icon bg-muted"><i class="fa fa-truck"></i></span>
										  <div class="info-box-content">
										    <span class="info-box-text">Primer</span>
										    <span class="info-box-number">Embargo</span>
										  </div>
										</div>

									</div>
									<div class="col-md-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha de requerimiento de pago</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha del embargo</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Bienes embargados</label>
											<textarea class="form-control" rows="5" id="cp" placeholder="Bienes embargados.."></textarea>
										</div>
									</div>
							</div>

									<hr>

							<div class="row">
									<div class="col-md-3">
										<br><br>
										<div class="info-box">
										  <span class="info-box-icon bg-muted"><i class="fa fa-truck"></i></span>
										  <div class="info-box-content">
										    <span class="info-box-text">Segundo</span>
										    <span class="info-box-number">Embargo</span>
										  </div>
										</div>

									</div>
									<div class="col-md-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha de requerimiento de pago</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha del embargo</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Bienes embargados</label>
											<textarea class="form-control" rows="5" id="cp" placeholder="Bienes embargados.."></textarea>
										</div>
									</div>
							</div>

									<hr>

							<div class="row">
									<div class="col-md-3">
										<br><br>
										<div class="info-box">
										  <span class="info-box-icon bg-muted"><i class="fa fa-truck"></i></span>
										  <div class="info-box-content">
										    <span class="info-box-text">Tercer</span>
										    <span class="info-box-number">Embargo</span>
										  </div>
										</div>

									</div>
									<div class="col-md-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha de requerimiento de pago</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha del embargo</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Bienes embargados</label>
											<textarea class="form-control" rows="5" id="cp" placeholder="Bienes embargados.."></textarea>
										</div>
									</div>
							</div>

									<hr>

							<div class="row">
									<div class="col-md-3">
										<br><br>
										<div class="info-box">
										  <span class="info-box-icon bg-muted"><i class="fa fa-truck"></i></span>
										  <div class="info-box-content">
										    <span class="info-box-text">Cuarto</span>
										    <span class="info-box-number">Embargo</span>
										  </div>
										</div>

									</div>
									<div class="col-md-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha de requerimiento de pago</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha del embargo</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Bienes embargados</label>
											<textarea class="form-control" rows="5" id="cp" placeholder="Bienes embargados.."></textarea>
										</div>
									</div>
							</div>

									<hr>

							<div class="row">
									<div class="col-md-3">
										<br><br>
										<div class="info-box">
										  <span class="info-box-icon bg-muted"><i class="fa fa-truck"></i></span>
										  <div class="info-box-content">
										    <span class="info-box-text">Quinto</span>
										    <span class="info-box-number">Embargo</span>
										  </div>
										</div>

									</div>
									<div class="col-md-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha de requerimiento de pago</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="datepicker">Fecha del embargo</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="datepicker">
													</div>
												</div>
											</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="cp">Bienes embargados</label>
											<textarea class="form-control" rows="5" id="cp" placeholder="Bienes embargados.."></textarea>
										</div>
									</div>
							</div>

									<hr>

							<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha del recurso de revisión</label>
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
											<label for="datepicker">Fecha del recurso de queja</label>
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
											<label for="datepicker">Fecha del recurso de nulidad de actuaciones</label>
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
			<div class="tab-pane" id="tab_8">
					<div class="box-body">
							<div class="row">

									<div class="col-md-4">
										<div class="form-group">
											<label for="datepicker">Fecha de reinstalacion</label>
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
											<label for="datepicker">Fecha de nombramiento</label>
											<div class="input-group date">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control pull-right" id="datepicker">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label>Acciones pendientes por finiquitar</label>
											<textarea class="form-control" rows="4" placeholder="Acciones pendientes por finiquitar.."></textarea>
										</div>
									</div>

							</div>
					</div>


			</div>
			<!-- /.tab-pane -->
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