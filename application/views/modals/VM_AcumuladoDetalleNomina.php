<!-- Modal -->
<div class="modal fade" id="AcumuladoDetalleNomina" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Descargar como excel</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevoUsuario" class="box-body box-profile">
							<input type="hidden" class="form-control" id="Id" name="Id" value="0">
							<div id="tipoAcumulado">
							<input type="radio" id="op1" name="tipoAcumulado" value="0" checked="checked" > Acumulado<br>
							<input type="radio" id="op2" name="tipoAcumulado" value="1"> Detalle<br>
							</div>
							<div class="alert" role="alert" id="VM_UN_Alert"></div>

								<button type="button" id="btnDescargarAcumulado" name="btnDescargarAcumulado" class="btn btn-primary btn-block"><b>ACEPTAR</b></button>
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