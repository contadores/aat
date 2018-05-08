<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es" ng-app="myApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $titulo; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?= base_url();?>assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="<?= base_url();?>assets/css/font-awesome.min.css"> -->
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- <link rel="stylesheet" href="<?= base_url();?>assets/css/ionicons.min.css"> -->
	<!-- daterange picker -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/datepicker/datepicker3.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/iCheck/all.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
	<!-- Bootstrap time Picker -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/select2/select2.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url();?>assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= base_url();?>assets/dist/css/skins/_all-skins.min.css">
	
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?= base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

 <script data-require="angular.js@*" data-semver="2.0.0" src="https://code.angularjs.org/1.4.8/angular.js"></script>
    <script data-require="jquery@*" data-semver="2.1.4" src="https://code.jquery.com/jquery-2.1.4.js"></script>
	
	<!-- Estilo Extra -->	
	<link rel="stylesheet" href="<?= base_url();?>assets/css/core.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/mi_empresa.css">
<?php
	switch ($titulo) {
		case 'Usuarios': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/usuarios.css">
			<link rel="stylesheet" href="<?= base_url();?>assets/css/modals/relacion_usuarioempresa.css">
		<?php break;
		case 'Empresas': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/empresas.css">
		<?php break;
		case 'DetalleNomina': ?>
			<link rel="stylesheet" href="<?=base_url();?>assets/css/mi_empresa/detalleNomina.css">							
			<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
		<?php break;
		case 'Comparativa': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/comparativa.css">
		<?php break;
		case 'HistorialComparativas': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/comparativa.css">
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/historialComparativas.css">
		<?php break;
		case 'XmlExcel': ?>
			<!-- <link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/comparativa.css"> -->
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/xmlexcel.css">
		<?php break;

		
		case 'Leyes': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/leyes.css">
		<?php break;
		case 'Formatos': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/formatos.css">
		<?php break;
		case 'Auditores': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/auditores.css">
		<?php break;
		case 'AcumuladoAuditor': ?>
			<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/auditores.css">
		<?php break;
	}
	//echo $titulo;
?>
	<link rel="stylesheet" href="<?= base_url();?>assets/css/mi_empresa/cargando.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<input type="hidden" id="base_url" value="<?= base_url(); ?>">