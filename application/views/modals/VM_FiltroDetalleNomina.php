<!-- Modal -->
<div class="modal fade" id="FiltroDetalleNomina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Filtros</h4>
			</div>
			<div class="modal-body">


					<!-- Profile Image -->
					<div class="box box-primary">
						<form name="formNuevoUsuario" class="box-body box-profile">
							<input type="hidden" class="form-control" id="Id" name="Id" value="0">

							<div style="text-align:right;" class="col-xs-3 col-xs-offset-0">
								<label>Fecha</label>
							</div >
							<div class="col-xs-4 col-xs-offset-0">								
								<input class="form-control"  type="date"></input>								
							</div>
							<div  class="col-xs-1 col-xs-offset-0">
								<label> - </label>
							</div>
							<div class="col-xs-4 col-xs-offset-0">								
								<input class="form-control"  type="date"></input>
							</div>
							
							<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
							</div>
							
							<div style="text-align:right;" class="col-xs-3 col-xs-offset-0">
								<label>Folio</label>
							</div >
							<div  class="col-xs-9 col-xs-offset-0">								
								<input placeholder="" class="form-control"  type="text"></input>								
							</div>
							<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
							</div>
							
							<div style="text-align:right;" class="col-xs-3 col-xs-offset-0">
								<label>Empleado</label>
							</div >
							<div  class="col-xs-9 col-xs-offset-0">								
								<input placeholder="Nombre empleado" class="form-control"  type="text"></input>								
							</div>
							
							<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
							</div>
							
							<div style="text-align:right;" class="col-xs-3 col-xs-offset-0">
								<label>NSS</label>
							</div >
							<div  class="col-xs-9 col-xs-offset-0">								
								<input placeholder="Número Seguridad Social" class="form-control"  type="text"></input>								
							</div>
							
							<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
							</div>
							
							<div style="text-align:right;" class="col-xs-3 col-xs-offset-0">
								<label>Registro patronal</label>
							</div >
							<div  class="col-xs-9 col-xs-offset-0">								
								<input placeholder="Registro patronal" class="form-control"  type="text"></input>								
							</div>
							
							<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
							</div>
							
							<div style="text-align:right;" class="col-xs-3 col-xs-offset-0">
								<label>Total</label>
							</div >
							<div class="col-xs-4 col-xs-offset-0">								
								<input placeholder="mínimo" class="form-control"  type="text"></input>								
							</div>
							<div  class="col-xs-1 col-xs-offset-0"><label> - </label></div>
							<div class="col-xs-4 col-xs-offset-0">								
								<input placeholder="máximo" class="form-control"  type="text"></input>
							</div>
							
							<div class="col-xs-12 col-xs-offset-0" style="margin-bottom:10px;">							
							</div>
							
							<div class="alert" role="alert" id="VM_UN_Alert"></div>
							<div class="divIconsRight">
							<button type="button" id="btnGuardarUsuario" class="btn btn-primary "><b>BUSCAR</b></button>
							<button type="button" class="btn btn-default " data-dismiss="modal">CERRAR</button>
							</div>
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