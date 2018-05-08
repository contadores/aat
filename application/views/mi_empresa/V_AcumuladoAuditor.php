<div class="center" style="text-align:center;">
	<div class="panel panel-primary">
		<div class="panel-body">				
		
			<form name="frmAcumularXML" id="frmAcumularXML" method="post" action="<?= base_url();?>C_AcumuladoAuditor/GenerarXLSAcumulado" enctype="multipart/form-data">		
				<h4 class="text-center">Acumulado SUA</h4>
				<div class="form-group">
					<div class="row">
						<label class="control-label">Periodo</label>					
					<input  class="form-control" id="anioPeriodo" name="anioPeriodo" placeholder="0" type="number" step="1" min="1900" max="2099" maxlength="10" value="<?php echo date("Y"); ?>" >																	
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Archivos</label>
					<div class="col-sm-8">
						<input type="file" accept=".xlsx" class="form-control" id="archivo[]" name="archivo[]" multiple="">
					</div>					
					<button id="myBtn" name="myBtn" type="submit" class="btn btn-primary">Cargar</button>
				</div>					
			</form>				
		</div>
		<div>
			<body ng-controller="MyCtrl">				
				<button class="btn btn-link" ng-click="exportToExcel('#box-DetalleXls')">
					<span class="glyphicon glyphicon-share"></span>
					Exportar a Excel
				</button>					
					<div id="areaTablaXLS">																	
						<!--TABLA TO XLS-->
						<div id="box-DetalleXls" name="box-DetalleXls" class="col-xs-12 col-xs-offset-0">	
						</div>																									
					</div>										
			 </body>
		</div>
	</div>
</div>
	
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content
	<div class="modal-content">
		<div class="modal-header">
			<span class="close">&times;</span>
			<h2>Resultados</h2>
		</div>
		<div class="modal-body">
			<p>Some text in the Modal Body</p>
			<p>Some other text...</p>
		</div>
		<div class="modal-footer">
			<h3></h3>
		</div>
	</div>-->
</div>