<div class="box" id="parametrosFI">
	<div class="box">
		<div class="box-header">		
<!-- Profile Image -->
			<h3>PORCENTAJES</h3>
			<div class="box box-primary">
				<form name="formNuevaEmpresa" class="box-body box-profile">
					<input type="hidden" class="form-control" id="IdEmpresa" name="IdEmpresa" value="<?php echo $this->session->userdata('IdEmpresa');?>">
					<input type="hidden" class="form-control" id="IdPorcentajes" name="IdPorcentajes" value="0">							
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<label>DÍAS AGUINALDO</label>
							<input class="form-control" id="diasAguinaldo" name="diasAguinaldo" placeholder="Días de aguinaldo"  type="number" step="1" min="0" max="1000" maxlength="3" >
						</li>
						<li class="list-group-item">
							<label>PORCENTAJE PRIMA VACACIONAL</label>
							<input  class="form-control" id="porcentajePrimaVacacional" name="porcentajePrimaVacacional" placeholder="0%" type="number" step="1" min="0" max="100" maxlength="3" >
						</li>
					</ul>							
						<div class="alert" role="alert" id="VM_EN_Alert"></div>
						<button type="button" id="btnGuardarPorcentajes" class="btn btn-primary btn-block"><b>GUARDAR</b></button>								
				</form>					
			</div>
							<h3>DÍAS DE VACACIONES</h3>
			<div class="box box-primary">
				<div class="col-xs-12 col-xs-offset-0">	
					<form name="formDiasVacaciones" class="box-body box-profile">
						<!--<input type="hidden" class="form-control" id="IdEmpresa" name="IdEmpresa" value="<?php echo $this->session->userdata('IdEmpresa');?>">						-->
						<div class="" id="box-body">
						<!-- EMPRESAS -->

						<!-- end EMPRESAS -->
						</div>
						<div class="alert" role="alert" id="DV_EN_Alert"></div>
						<button type="button" id="btnGuardarDiasVacaciones" class="btn btn-primary btn-block"><b>GUARDAR</b></button>								
					</form>		
				</div>
			<!-- /.box-body -->
			</div>
		</div>
	</div>
</div>
