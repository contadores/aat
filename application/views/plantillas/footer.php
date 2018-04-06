		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<footer class="main-footer">

		<div class="hidden-xs">
			<!-- <b>Version</b> 2.3.8 -->
			<b>Version</b> 1.0.0
		</div>
	<!--	
		<strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
		reserved.
	-->
	</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?=base_url();?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?=base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?=base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?=base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url();?>assets/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Page script -->
<script>
	$(function () {
		$(".dataTables").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});
</script>
<script>
	$(function () {
		//Initialize Select2 Elements
		$(".select2").select2();

		//Datemask dd/mm/yyyy
		$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
		//Datemask2 mm/dd/yyyy
		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
		//Money Euro
		$("[data-mask]").inputmask();

		//Date range picker
		$('#reservation').daterangepicker();
		//Date range picker with time picker
		$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
		//Date range as a button
		$('#daterange-btn').daterangepicker(
				{
					ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					startDate: moment().subtract(29, 'days'),
					endDate: moment()
				},
				function (start, end) {
					$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				}
		);

		//Date picker
		$('#datepicker').datepicker({
			autoclose: true
		});

		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
		//Red color scheme for iCheck
		$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			checkboxClass: 'icheckbox_minimal-red',
			radioClass: 'iradio_minimal-red'
		});
		//Flat red color scheme for iCheck
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass: 'iradio_flat-green'
		});

		//Colorpicker
		$(".my-colorpicker1").colorpicker();
		//color picker with addon
		$(".my-colorpicker2").colorpicker();

		//Timepicker
		$(".timepicker").timepicker({
			showInputs: false
		});
	});
</script>


<!-- Funciones extra -->
<script src="<?=base_url();?>assets/js/core.js"></script>
<script src="<?=base_url();?>assets/js/mi_empresa/ajaxFunction.js"></script>
<script src="<?=base_url();?>assets/js/mi_empresa/validaciones.js"></script>
<script src="<?=base_url();?>assets/js/mi_empresa/mi_empresa.js"></script>
<script src="<?=base_url();?>assets/js/modals/confirm.js"></script>

<?php
// echo $titulo;
switch ($titulo) {
		case 'Usuarios': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/usuarios.js"></script>
			<script src="<?=base_url();?>assets/js/modals/usuarios.js"></script>
			<script src="<?=base_url();?>assets/js/modals/relacion_usuarioempresa.js"></script>
		<?php break;
		case 'Empresas': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/empresas.js"></script>
			<script src="<?=base_url();?>assets/js/modals/empresas.js"></script>
			<script src="<?=base_url();?>assets/js/modals/registrosPatronales.js"></script>
		<?php break;
		case 'MisEmpresas': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/misEmpresas.js"></script>
			<!-- <script src="<?=base_url();?>assets/js/mi_empresa/empresas.js"></script> -->
			<!-- <script src="<?=base_url();?>assets/js/modals/empresas.js"></script> -->
			<!-- <script src="<?=base_url();?>assets/js/modals/registrosPatronales.js"></script> -->
		<?php break;


		case 'Comparativa': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/comparativa.js"></script>
			<script src="<?=base_url();?>assets/js/modals/comparativa.js"></script>
		<?php break;
		case 'HistorialComparativas': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/historialComparativas.js"></script>
		<?php break;
		case 'XmlExcel': ?>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/vendor/jquery.ui.widget.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.iframe-transport.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.fileupload.js"></script>
				<script src="<?=base_url();?>assets/js/mi_empresa/xmlexcel.js"></script>
		<?php break;
		case 'ParametrosFI': ?>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/vendor/jquery.ui.widget.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.iframe-transport.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.fileupload.js"></script>
				<script src="<?=base_url();?>assets/js/mi_empresa/parametrosFI.js"></script>
		<?php break;
		case 'DetalleNomina': ?>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/vendor/jquery.ui.widget.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.iframe-transport.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.fileupload.js"></script>				
		<?php break;
		case 'MisEmpresasAuditor': ?>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/vendor/jquery.ui.widget.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.iframe-transport.js"></script>
				<script src="<?=base_url();?>assets/js/jquery_file_upload/jquery.fileupload.js"></script>
				<script src="<?=base_url();?>assets/js/mi_empresa/misEmpresasAuditor.js"></script>
		<?php break;
		case 'Leyes': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/leyes.js"></script>
		<?php break;
		case 'Formatos': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/formatos.js"></script>
		<?php break;
		case 'Auditores': ?>
			<script src="<?=base_url();?>assets/js/mi_empresa/auditores.js"></script>
		<?php break;
}
//echo $titulo;
?>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?=base_url();?>assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>assets/plugins/knob/jquery.knob.js"></script>
<!-- datepicker -->
<script src="<?=base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--
<script src="<?=base_url();?>assets/dist/js/pages/dashboard.js"></script>
-->
</body>
</html>