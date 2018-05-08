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
						<form name="formFiltroXML" class="box-body box-profile">							
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<label>Fecha Inicio</label>
									<input class="form-control" id="fechaInicio" name="fechaInicio" type="date"></input>								
									<label>Fecha Fin</label>
									<input class="form-control" id="fechaFin" name="fechaFin" type="date"></input>								
								</li>							
								<li class="list-group-item">
									<label>Folio</label>
									<input placeholder="Folio" id="folio" name="folio" class="form-control"  type="text"></input>																	
								</li>
								<li class="list-group-item">
									<label>Empleado</label>
									<input placeholder="Nombre empleado" id="empleado" name="empleado" class="form-control"  type="text"></input>								
								</li>
								<li class="list-group-item">
									<label>NSS</label>
									<input placeholder="Número Seguridad Social" id="nss" name="nss" class="form-control"  type="text"></input>								
								</li>			
								<li class="list-group-item">
									<label>Registro patronal</label>
									<input placeholder="Registro patronal" id="registroPatronal" name="registroPatronal" class="form-control"  type="text"></input>								
								</li>			
								<li class="list-group-item">
									<label>Total Mínimo</label>
									<input placeholder="mínimo" id="totalMin" name="totalMin" class="form-control"  type="text"></input>								
									<label>Total Máximo</label>
									<input placeholder="máximo" id="totalMax" name="totalMax" class="form-control"  type="text"></input>
								</li>											
							</ul>									
							<div class="alert" role="alert" id="VM_EN_Alert"></div>
							<div class="divIconsRight">							
							<button type="button" id="btnFiltrarXML" class="btn btn-primary "><b>BUSCAR</b></button>
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