<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Ejemplo Imágenes</title>
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<style>
			body {
			padding-top: 20px;
			padding-bottom: 20px;
			}
			
			.center {
			position: absolute;
			width: 100%;
			height: 200px;
			top: 50%;
			left: 50%;
			margin-left: -50%; /* margin is -0.5 * dimension */
			margin-top: 100px; 
			padding-left:10px;
			padding-right:10px;
		</style>
	</head>
	
	<body>
		
		    <div class="center" style="text-align:center;">
			<div class="panel panel-primary">
				<div class="panel-body">
					
					<form name="form1" id="form1" method="post" action="<?= base_url();?>C_AcumuladoAuditor/GenerarXLSAcumulado" action="guardaComparativa.php" enctype="multipart/form-data">
						
						<h4 class="text-center">Acumulado SUA</h4>
						<div class="form-group">
							<div class="row">
								<label class="control-label">Periodo</label>					
								<input id="anioPeriodo" name="anioPeriodo" type="number" min="1900" max="2099" step="1" value="<?php echo date("Y"); ?>" />			
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Archivos</label>
							<div class="col-sm-8">
								<input type="file" accept=".xlsx" class="form-control" id="archivo[]" name="archivo[]" multiple="">
							</div>
							
							<button type="submit" class="btn btn-primary">Cargar</button>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
	</body>
</html>