<div class="box">

<!-- EXTRA -->
<!-- 	<div class="row">
	<form action="<?= base_url();?>C_Comparativa/XML_prueba" class='was-validated' method="POST" id="formSubirArticulo" name="formSubirArticulo" enctype="multipart/form-data">
	<div class="col-xs-4">
				<div class="box box-success">
						<div class="box-header">
							<i class="fa fa-file-excel-o"></i>
							<h3 class="box-title"><b>SUA</b> MENSUAL EN EXCEL</h3>
						</div>

						<div class="box-footer">
							<div class="input-group">
								<div class='file-input'>
									<input type='file' id="bnt1_sua" name="bnt1_sua">
									<span class='button'>SELECCIONAR ARCHIVO</span>
									<span class='label' data-js-label>Ningún archivo seleccionado</label>
								</div>
							</div>
						</div>

				</div>
				<input type="submit" id="btnSubirArticulo" class="btn btn-primary col-sm-12" value="Subir Artículo">
	</div>
	</form>
	</div> -->
<!-- EXTRA -->
	
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
				<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-file-o"></i><i class="fa fa-file-o"></i> &nbsp; BIMESTRAL </a></li>
				<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-file-o"></i> &nbsp; MENSUAL </a></li>

			</ul>
			<div class="tab-content">
			<br>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// target='_blank' enctype="multipart/form-data" ?>
				<div class="tab-pane active" id="tab_1">
					<!--<form class="box-body" id="formComparativa1" name="formComparativa1" method="post" action="<?=base_url();?>" >-->
					<?php
						//$formInfo = array( 'class' => 'box-body', 'id' => 'formComparativa1', 'name' => 'formComparativa1' );
						//echo form_open_multipart('C_Comparativa/ComparativaMensual', $formInfo);
					?>
					<form action="<?=base_url();?>C_Comparativa/ComparativaMensual" class="box-body" id="formComparativa1" name="formComparativa1" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<div class="col-xs-12">
								<div class="box box-success">
									<div class="box-header">
										<i class="fa fa-file-excel-o"></i>
										<h3 class="box-title"><b>SUA</b> MENSUAL EN EXCEL</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt1_sua" name="bnt1_sua">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12">
								<div class="box box-success">
									<div class="box-header">
										<i class="fa fa-file-excel-o"></i>
										<h3 class="box-title"><b>IDSE</b> MENSUAL EN EXCEL</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt2_idse" name="bnt2_idse">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12">
								<div class="box box-primary">
									<div class="box-header">
										<i class="fa fa-file-text"></i>
										<h3 class="box-title"><b>XML</b> NOMINA</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt3_xml" name="bnt3_xml">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 text-center">
								<button id="btnCompararComparativa1" type="button" class="btn btn-primary btn-block"><b>COMPARAR</b></button>
							</div>

						</form>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
				<div class="tab-pane" id="tab_2">
						<form action="<?=base_url();?>C_Comparativa/ComparativaBimestral" class="box-body" id="formComparativa2" name="formComparativa2" enctype="multipart/form-data" method="post" accept-charset="utf-8">

							<div class="col-xs-6">
								<div class="box box-success">
									<div class="box-header">
										<i class="fa fa-file-excel-o"></i>
										<h3 class="box-title"><b>SUA</b> MENSUAL EN EXCEL</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt4_sua" name="bnt4_sua">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-6">
								<div class="box box-success">
									<div class="box-header">
										<i class="fa fa-file-excel-o"></i>
										<h3 class="box-title"><b>SUA</b> BIMESTRAL EN EXCEL</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt5_sua" name="bnt5_sua">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-6">
								<div class="box box-success">
									<div class="box-header">
										<i class="fa fa-file-excel-o"></i>
										<h3 class="box-title"><b>IDSE</b> MENSUAL EN EXCEL</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt6_idse" name="bnt6_idse">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

<!-- 							<div class="col-xs-6">
								<div class="box box-success">
									<div class="box-header">
										<i class="fa fa-file-excel-o"></i>
										<h3 class="box-title"><b>IDSE</b> BIMESTRAL EN EXCEL</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt7_idse" name="bnt7_idse">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div> -->

							<div class="col-xs-12">
								<div class="box box-primary">
									<div class="box-header">
										<i class="fa fa-file-text"></i>
										<h3 class="box-title"><b>XML</b> NOMINA</h3>
									</div>

									<div class="box-footer">
										<div class="input-group">

											<div class='file-input'>
												<input type='file' id="bnt8_xml" name="bnt8_xml">
												<span class='button'>SELECCIONAR ARCHIVO</span>
												<span class='label' data-js-label>Ningún archivo seleccionado</label>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="col-xs-12 text-center">
								<button id="btnCompararComparativa2" type="button" class="btn btn-primary btn-block"><b>COMPARAR</b></button>
							</div>

						</form>
				</div>
			<?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
			</div>
		</div>



		<!-- /.box-body -->
	</div>