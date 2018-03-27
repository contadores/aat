<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mi Empresa</title>
<link rel="stylesheet" href="<?= base_url();?>assets/css/login.css">

</head>
<body>

	<div class="login-page">
		<div class="form">
			<img id="logo_login" src="<?= base_url();?>assets/img/logo.png" alt="Logo de la empresa">
			<form action="" method="post" id="formLogin">
					<input	type="email"		id="Correo"		name="Correo"		placeholder="Usuario"			autocomplete="off">
					<input	type="password"	id="Password"	name="Password"	placeholder="Contraseña"	autocomplete="off">
					
					<input  type="hidden"		id="IdUsuario"	 			name="IdUsuario"				value="0">
					<input  type="hidden"		id="IdCatTipoUsuario"	name="IdCatTipoUsuario"	value="0">
					<input  type="hidden"		id="Nombre"						name="Nombre"						value="">
					
					<button type="button" class="btn btn-primary" id="IniciarSession">Iniciar</button>
			</form>
		</div>
	</div>

</body>
	<script src="<?= base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?= base_url();?>assets/js/login.js" type="text/javascript"></script>
	<script src="<?= base_url();?>assets/js/mi_empresa/ajaxFunction.js" type="text/javascript"></script>
	<script src="<?= base_url();?>assets/js/mi_empresa/login.js" type="text/javascript"></script>
</html>