<?php $idTipoUsuario = 4;?>

	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel -->
			<div class="user-panel">
				<img id="logo_login" src="<?=base_url();?>assets/img/logo-empresa-AAT.jpg" alt="Logo de la empresa">
			</div>

			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header">NAVEGACIÓN PRINCIPAL</li>

				<?php
							$class = null;
							$seccion = null;
							$mi_menu = array();

							if ( $this->session->userdata('IdCatTipoUsuario') == 1 ){
									array_push($mi_menu, array('seccion' => 'Usuarios',
											'href'                               => 'C_Usuarios',
											'class'                              => 'fa fa-user',
											'multilevel'                         => null,
									));
									array_push($mi_menu, array('seccion' => 'Empresas',
											'href'                               => 'C_Empresas',
											'class'                              => 'fa fa-cubes',
											'multilevel'                         => null,
									));
							}

							if ( $this->session->userdata('IdCatTipoUsuario') == 2 || 
									 $this->session->userdata('IdCatTipoUsuario') == 3 ){
									if ( $this->session->userdata('IdCatTipoUsuario') == 2 ){											
											array_push($mi_menu, array('seccion' => 'Auditores',
													'href'                               => 'V_Auditores',
													'class'                              => 'fa fa-balance-scale',
													'multilevel'                         => array(
													array('seccion' => 'Mis Empresas',
													//array('seccion' => 'Registros Patronales',
															'href'          => 'C_MisEmpresasAuditor',
															'class'         => 'fa fa-object-ungroup',
															'multilevel'    => null,
													), array('seccion' => 'Acumulado',
															'href'             => 'C_AcumuladoAuditor',
															'class'            => 'fa fa-files-o',
															'multilevel'       => null,
													), array('seccion' => 'Consultar nómina',
													//), array('seccion' => 'Historico',
															'href'             => 'C_DetalleNomina',
															'class'            => 'fa fa-header',
															'multilevel'       => null,
													), array('seccion' => 'Parametros de factor integral',
													//), array('seccion' => 'Historico',
															'href'             => 'C_ParametrosFI',
															'class'            => 'fa fa-file-excel-o',
															'multilevel'       => null,
													), array('seccion' => 'MisXML',
															'href'             => 'C_MisXML',
															'class'            => 'fa fa-files-o',
															'multilevel'       => null,
													)),
											));
									}
									if ( $this->session->userdata('IdCatTipoUsuario') == 3 ){											
									array_push($mi_menu, array('seccion' => 'Registros Patronales',
									//array_push($mi_menu, array('seccion' => 'Mis Empresas',
											'href'                               => 'C_RegistrosPatronales',
											'class'                              => 'fa fa-cubes',
											'multilevel'                         => array(
													array('seccion' => 'Mis Empresas',
													//array('seccion' => 'Registros Patronales',
															'href'          => 'C_MisEmpresas',
															'class'         => 'fa fa-object-ungroup',
															'multilevel'    => null,
													), array('seccion' => 'Comparativa',
															'href'             => 'C_Comparativa',
															'class'            => 'fa fa-files-o',
															'multilevel'       => null,
													), array('seccion' => 'Historial de Comparativas',
													//), array('seccion' => 'Historico',
															'href'             => 'C_HistorialComparativas',
															'class'            => 'fa fa-header',
															'multilevel'       => null,
													), array('seccion' => 'XML a Excel',
													//), array('seccion' => 'Historico',
															'href'             => 'C_XmlExcel',
															'class'            => 'fa fa-file-excel-o',
															'multilevel'       => null,
													), array('seccion' => 'MisXML',
															'href'             => 'C_MisXML',
															'class'            => 'fa fa-files-o',
															'multilevel'       => null,
													)),
									));
/*
									array_push($mi_menu, array('seccion' => 'Leyes',
											'href'                               => 'C_Leyes',
											'class'                              => 'fa fa-legal',
											'multilevel'                         => null,
									));
									array_push($mi_menu, array('seccion' => 'Formatos',
											'href'                               => 'C_Formatos',
											'class'                              => 'fa fa-file-text-o',
											'multilevel'                         => null,
									));
*/
							}
	}

							foreach ($mi_menu as $elementoMenu) {
									if ($paginaActual == $elementoMenu['href']) {
											$class   = $elementoMenu['class'];
											$seccion = $elementoMenu['seccion'];
											echo '<li class="active">';
									} else {
											echo '<li>';
									}

									if ($elementoMenu['multilevel'] != null) {
											$subNiveles = count($elementoMenu['multilevel']);

											// Navega entre los Sub elementos de la lista (Mis Empresas, Comparativa, Historial de Comparativa)
											for ($i = 0; $i < $subNiveles; $i++) {
													if ($paginaActual == $elementoMenu['multilevel'][$i]['href']) {
															$class   = $elementoMenu['multilevel'][$i]['class'];
															$seccion = $elementoMenu['multilevel'][$i]['seccion'];
															echo '<li class="active">';
													}
											}

											// Coloca el Icono y Nombre del elemento de la lista.
											echo	'<a href="' . base_url() . $elementoMenu['href'] . '">';
											echo		'<i class="' . $elementoMenu['class'] . '"></i>';
											echo			'&nbsp;&nbsp;';
											echo		'<span>' . $elementoMenu['seccion'] . '</span>';
											echo	'</a>';

											echo '<ul class="treeview-menu">';

											// Navega entre los Sub elementos de la lista (Mis Empresas, Comparativa, Historial de Comparativa)
											for ($i = 0; $i < $subNiveles; $i++) {
													echo	'<li>';
													echo	'<a href="' . base_url() . $elementoMenu['multilevel'][$i]['href'] . '">';
													echo			'<i class="' . $elementoMenu['multilevel'][$i]['class'] . '"></i>';
													echo			'&nbsp;&nbsp;';
													echo			$elementoMenu['multilevel'][$i]['seccion'];
													echo	'</a>';
													echo	'</li>';
											}
											echo '</ul>';
									} else {
											// Coloca el Icono y Nombre del elemento de la lista.
											echo	'<a href="' . base_url() . $elementoMenu['href'] . '">';
											echo		'<i class="' . $elementoMenu['class'] . '"></i>';
											echo			'&nbsp;&nbsp;';
											echo		'<span>' . $elementoMenu['seccion'] . '</span>';
											echo	'</a>';
									}
									echo '</li>';
							}
				?>

			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->

		<?php 
			if ($class != null) {
		?>
					<section class="content-header">
						<h1 id="seccion">
							<i class="<?=$class;?>"></i>

							<?=$seccion;?>
							<small><?=$subSeccion;?></small>
						</h1>
					</section>
		<?php
//			} else {
//					header ("Location: " . base_url() );
					//echo base_url().'C_Login/PaginaNoEncontrada';

					//echo "NO";
					//echo $_SERVER['HTTP_REFERER'];
					//header ("Location: " . $_SERVER['HTTP_REFERER'] );
			}
		?>

		<!-- Main content -->
		<section class="content">