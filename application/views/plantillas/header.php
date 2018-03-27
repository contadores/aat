<div class="wrapper">
	<header class="main-header">
		<!-- Logo -->
		<a href="" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>AAT</b></span>
			<!-- logo for regular state and mobile devices -->
			<!--<span class="logo-lg"></span>-->
			<h4><b>A</b>sistencia <b>A</b>dministrativa de <b>T</b>amaulipas</h4>
		</a>

		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<?php
							if( $CambiarEmpresas ){
									$this->session->unset_userdata(array(
										//'IdEmpresa',
										'Empresa',
										'IdRegistroPatronal',
										'RP'
									));
							}
					?>

					<?php		if( $this->session->has_userdata('IdRegistroPatronal') ){		?>
									<!-- Empresa_RP: style can be found in dropdown.less -->
									<li class="dropdown user user-menu">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">

											<i class="fa fa-cubes"></i>
											<span class="hidden-xs">
												&nbsp;
												<?= $this->session->userdata('Empresa'); ?>
											</span>
												&nbsp;
											<i class="fa fa-chevron-right"></i>
											<span class="hidden-xs">
												&nbsp;
												<?= $this->session->userdata('RP'); ?>
											</span>

										</a>
										<ul class="dropdown-menu">
											<!-- Menu Footer-->
											<li class="user-footer">
												<form action="<?=base_url();?>C_MisEmpresas" class="box-body" id="formCambiarEmpresas" name="formCambiarEmpresas" enctype="multipart/form-data" method="post" accept-charset="utf-8">
													<input type="hidden" name="CambiarEmpresas" id="CambiarEmpresas" value="true">
													<button type="submit" class="btn btn-default btn-block" data-dismiss="modal">CAMBIAR EMPRESA</button>
												</form>
												<!--<a href="<?=base_url();?>/C_MisEmpresas" class="btn btn-default btn-block">CAMBIAR EMPRESA</a>-->
											</li>
										</ul>
									</li>
					<?php		}		?>

					<?php		if( $this->session->has_userdata('IdUsuario') ){		?>
									<!-- User Account: style can be found in dropdown.less -->
									<li class="dropdown user user-menu">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<img src="<?=base_url();?>assets/img/usuarios/user4-128x128.jpg" class="user-image" alt="User Image">
											<!-- <img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
											<span class="hidden-xs"><?= $this->session->userdata('Nombre'); ?></span>
										</a>
										<ul class="dropdown-menu">
											<!-- User image -->
											<li class="user-header">
												<img src="<?=base_url();?>assets/img/usuarios/user4-128x128.jpg" class="img-circle" alt="User Image">
												<!-- <img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
												<p>
													<?= $this->session->userdata('Nombre'); ?>
													<small>
														Usuario 
													<?php
															switch ( $this->session->userdata('IdCatTipoUsuario') ) {
																case '1':		echo 'Administrador';	break;
																case '2':		echo 'Auditor';				break;
																case '3':		echo 'Común';					break;
															}
													?>
													</small>
												</p>
											</li>
											<!-- Menu Footer-->
											<li class="user-footer">
												<a href="<?=base_url();?>" class="btn btn-default btn-block">CERRAR SESIÓN</a>

													<!--			IdRegistroPatronal			-->
													<form action="<?=base_url();?>C_MisEmpresas" class="box-body" id="formMisEmpresas" name="formMisEmpresas" enctype="multipart/form-data" method="post" accept-charset="utf-8">
															<?php	$tmpIdRegistroPatronal = ( $this->session->has_userdata('IdRegistroPatronal')  ) ? $this->session->userdata('IdRegistroPatronal') : 0;	?>			
															<input type="hidden" name="IdRegistroPatronal" id="IdRegistroPatronal" value="<?php echo $tmpIdRegistroPatronal; ?>">

													</form>
													<!-- <input type="hidden" name="IdUsuario" id="IdUsuario" value="<?php echo $this->session->userdata('IdUsuario'); ?>"> -->
													<!-- <input type="hidden" name="IdCatTipoUsuario" id="IdCatTipoUsuario" value="<?php echo $this->session->userdata('IdCatTipoUsuario'); ?>"> -->
													<!--			IdRegistroPatronal			-->

											</li>
										</ul>
									</li>
					<?php		
									}else{
											header ("Location: " . base_url() );
									}		
					?>
				</ul>
			</div>
		</nav>
	</header>