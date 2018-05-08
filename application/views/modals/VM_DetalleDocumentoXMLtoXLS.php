<!-- Modal -->
<div class="modal fade" style="width: 100%;" id="DetalleXMLtoXLS" role="dialog" aria-labelledby="myModalLabel">
	<div class="" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><h1>Exportar a Excel</h1></h4>
			</div>
			<div class="modal-body">
				<body ng-controller="MyCtrl">
					
					<button class="btn btn-link" ng-click="exportToExcel('#box-DetalleXls')">
					<span class="glyphicon glyphicon-share"></span>
					Exportar a Excel
					</button>					
						<div id="areaTablaXLS">																	
							<!--TABLA TO XLS-->
							<div style=" overflow: auto;" id="box-DetalleXls" name="box-DetalleXls" class="col-xs-12 col-xs-offset-0">	
							</div>																									
						</div>
						<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
						</div>							
						<div class="divIconsRight">
							<button type="button" onclick="cerrarModal()" class="btn btn-default " data-dismiss="modal">CERRAR</button>
						</div>
				  </body>
			</div>
		</div>
	</div>
</div>