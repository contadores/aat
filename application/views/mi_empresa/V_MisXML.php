<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
			
			/* The Modal (background) */
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
				position: relative;
				background-color: #fefefe;
				margin: auto;
				padding: 0;
				border: 1px solid #888;
				width: 80%;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
				-webkit-animation-name: animatetop;
				-webkit-animation-duration: 0.4s;
				animation-name: animatetop;
				animation-duration: 0.4s
			}

			/* Add Animation */
			@-webkit-keyframes animatetop {
				from {top:-300px; opacity:0} 
				to {top:0; opacity:1}
			}

			@keyframes animatetop {
				from {top:-300px; opacity:0}
				to {top:0; opacity:1}
			}

			/* The Close Button */
			.close {
				color: white;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}

			.modal-header {
				padding: 2px 16px;
				background-color: #5cb85c;
				color: white;
			}

			.modal-body {padding: 2px 16px;}

			.modal-footer {
				padding: 2px 16px;
				background-color: #5cb85c;
				color: white;
			}
		</style>
	</head>
	
	<body>
		
		    <div class="center" style="text-align:center;">
			<div class="panel panel-primary">
				<div class="panel-body">
					
					<form name="form1" id="form1" method="post" action="<?= base_url();?>C_MisXML/CargarXML" enctype="multipart/form-data">
						
						<h4 class="text-center">Subir XML Nómina</h4>
						<!--<div class="form-group">
							<div class="row">
								<label class="control-label">Periodo</label>					
								<input id="anioPeriodo" name="anioPeriodo" type="number" min="1900" max="2099" step="1" value="<?php echo date("Y"); ?>" />			
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-sm-2 control-label">Archivos</label>
							<div class="col-sm-8">
								<input type="file" accept=".xml" class="form-control" id="archivo[]" name="archivo[]" multiple="">
							</div>
							
							<button id="myBtn" type="submit" class="btn btn-primary">Cargar</button>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
		
		<!-- The Modal -->
		<div id="myModal" class="modal">

		  <!-- Modal content -->
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
		  </div>

		</div>

		<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		btn.onclick = function() {
			modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
			modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		</script>
	</body>
</html>