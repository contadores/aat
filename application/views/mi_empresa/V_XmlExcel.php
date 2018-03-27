<div class="box" id="xmlexcel">
		<div class="box-header">
			<!-- <h3 class="box-title">-</h3> -->
		</div>

		<div class="box-body" id="box-body"><div class="jumbotron">

			<!-- EXTRA -->
<!-- 			<form action="<?= base_url();?>C_XmlExcel/XML_prueba" class='was-validated' method="POST" id="formSubirArticulo" name="formSubirArticulo" enctype="multipart/form-data">
					<div class="box-footer">
						<div class="input-group">
							<div class='file-input'>
								<input type='file' id="bnt1_sua" name="bnt1_sua">
								<span class='button'>SELECCIONAR ARCHIVO</span>
								<span class='label' data-js-label>Ningún archivo seleccionado</label>
							</div>
						</div>
					</div>
					<input type="submit" id="btnSubirArticulo" class="btn btn-primary col-sm-12" value="Subir Artículo">
			</form>
			<hr><hr><hr><hr> -->
			<!-- EXTRA -->


		<form action="<?= base_url();?>C_XmlExcel/GenerarXML" class='was-validated' method="POST" id="formGenerarXML" name="formGenerarXML" enctype="multipart/form-data">
		<div class="row">

<!-- 					<div class="w-100"><br></div>
						<div class="col-12 col-md-3 text-right">
							<label class="text-secondary" for="input_doc">Cargar Documento del Artículo:
							<br>Extensiones permitidas:	<strong>.doc, .docx</strong>
							</label>
						</div>

						<div class="col-12 col-md-7">
						<div class="card card-footer">
								<label class="custom-file">
									<input	id="input_doc"			name="input_doc" class="custom-file-input form-control"	type="file" required>
									<span		id="span_input_doc"	class="custom-file-control"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Cargar
									&nbsp;-&nbsp;(Peso máximo 80 kb.)
									</span>
								</label>
						</div>
						</div> -->
					

<!-- 					<div class="col-xs-4 col-xs-offset-4  text-center">
							<div class="input-group input-file" name="Fichier1">
									<input type="text" id="btn_GenerarXML2" class="form-control" placeholder='SELECCIONA ARCHIVOS XML XML...' />			
									<span class="input-group-btn">
											<button class="btn btn-default btn-choose" type="button">
													<i class="fa fa-fw fa-upload"></i>&nbsp;&nbsp;SUBIR XMLS
											</button>
									</span>
							</div>
					</div> -->

					<!-- ////////////////////////////////// -->
							 
					<div id="dropZone" class="text-center   col-xs-10 col-xs-offset-1   col-sm-8 col-sm-offset-2   col-md-6 col-md-offset-3   col-lg-4 col-lg-offset-4">
							<input type="file" id="fileupload" name="attachments[]" multiple>
					</div>

								<div class="col-xs-12 col-xs-offset-0"><br></div>

					<div class="text-center   col-xs-10 col-xs-offset-1   col-sm-8 col-sm-offset-2   col-md-6 col-md-offset-3   col-lg-3 col-lg-offset-4">
							<button id="btn_GenerarXML"	class="btn btn-success btn-lg btn-block" disabled>
								<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;<b>GENERAR EXCEL</b>
							</button>
					</div>

					<div class="text-center   col-xs-10 col-xs-offset-1   col-sm-8 col-sm-offset-2   col-md-6 col-md-offset-3   col-lg-1 col-lg-offset-0">
							<a id="btn_descargar_xml"		class="btn btn-success btn-lg btn-block" href="http://localhost/miempresa/C_Comparativa/Generar_ExcelesMensual" disabled>
									<i class="fa fa-download"></i>
							</a>
					</div>

					<div class="text-center   col-xs-10 col-xs-offset-1   col-sm-8 col-sm-offset-2   col-md-6 col-md-offset-3   col-lg-4 col-lg-offset-4">
							<br>
							<h4 id="progress"></h4>
					</div>
					
		</div>
		</form>
		</div></div>

		<div id="xmls_lista" class=""><div id="xml_subidos" class="row">

				<!-- 
				<div class="col-xs-3 col-xs-offset-0 text-center">
				<div class="thumbnail">
						<div class="xml-header text-right">
								<button class="btnTacos">
										<i class="fa fa-times" aria-hidden="true"></i>
								</button>
						</div>
						<h3>
							<i class="fa fa-fw fa-file"></i>&nbsp;&nbsp;<b>XML</b>
						</h3>
						<h6>
				 -->
								<!-- <a href="tmp_name" target="_blank"> -->
									<!-- lista_XML -->
								<!-- </a> -->
				<!-- 
						</h6>
				</div>
				</div>
				 -->
		</div></div>
</div>