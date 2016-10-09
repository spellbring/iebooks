<!-- sidebar panel -->
<div class="sidebar-panel offscreen-left">

    <div class="brand">

        <!-- logo -->
        <div class="brand-logo">
            <img src="<?php echo base_url('assets/images/buho_mediano.png'); ?>" style="height: 40px; margin-top:-13px; margin-left: 40px;" alt="">
        </div>
        <!-- /logo -->

        <!-- toggle small sidebar menu -->
        <a href="javascript:;" class="toggle-sidebar hidden-xs hamburger-icon v3" data-toggle="layout-small-menu">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </a>
        <!-- /toggle small sidebar menu -->

    </div>

    <!-- main navigation -->
    <nav role="navigation">

        <ul class="nav">

            <!-- inicio -->
            <li <?php if ($current_menu == 1) { ?>class="open"<?php } ?>>
                <a href="<?php echo base_url('home'); ?>">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <!-- /inicio -->
			
			<!-- Usuario -->
            <li <?php if ($current_menu == 2) { ?>class="open"<?php } ?>>
                <a href="<?php echo base_url('usuario'); ?>">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <!-- /Usuario -->
			
			<!-- Clases -->
            <li <?php if ($current_sub_menu == 3) { ?>class="active"<?php } ?>>
                <a href="<?php echo base_url('clases'); ?>">
                    <i class="fa fa-book"></i>
                    <span>Crear Clase</span>
                </a>
            </li>
            <!-- /Clases -->	
			
			
<!--             tarjetas 
            <li <?php if ($current_menu == 2) { ?>class="open"<?php } ?>>
                <a href="javascript:;">
                    <i class="fa fa-credit-card"></i>
                    <span>Mis Tarjetas</span>
                </a>
                <ul class="sub-menu">
                    <li <?php if ($current_sub_menu == 21) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('tarjeta'); ?>">
                            <span>Ver</span>
                        </a>
                    </li>
                    <li <?php if ($current_sub_menu == 22) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('tarjeta/crear'); ?>">
                            <span>Crear Tarjeta</span>
                        </a>
                    </li>
                </ul>
            </li>
             /tarjetas 

             descuentos 
            <li <?php if ($current_menu == 3) { ?>class="open"<?php } ?>>
                <a href="javascript:;">
                    <i class="fa fa-tags"></i>
                    <span>Mis Descuentos</span>
                </a>
                <ul class="sub-menu">
                    <li <?php if ($current_sub_menu == 31) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('descuento'); ?>">
                            <span>Ver</span>
                        </a>
                    </li>
                    <li <?php if ($current_sub_menu == 32) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('descuento/agregar'); ?>">
                            <span>Agregar</span>
                        </a>
                    </li>

                </ul>
            </li>
             /descuentos 

             solicitud 
            <li <?php if ($current_menu == 4) { ?>class="open"<?php } ?>>
                <a href="javascript:;">
                    <i class="fa fa-file-text"></i>
                    <span>Solicitudes</span>
                </a>
                 <ul class="sub-menu">
                 <li <?php if ($current_sub_menu == 41) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('solicitud'); ?>">
                            <span>Solicitudes Pendientes</span>
                        </a>
                    </li>
                    <li <?php if ($current_sub_menu == 42) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('solicitud/procesadas'); ?>">
                            <span>Solicitudes Finalizadas</span>
                        </a>
                    </li>
                  </ul>
            </li>
             /solicitud 

             Graficos 
            <li <?php if ($current_menu == 5) { ?>class="open"<?php } ?>>
                <a href="javascript:;">
                    <i class="fa fa-pie-chart"></i>
                    <span>Gráficos</span>
                </a>
                <ul class="sub-menu">
                    <li <?php if ($current_sub_menu == 51) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('grafico/descuento'); ?>">
                            <span>Descuentos</span>
                        </a>
                    </li>
                    <li <?php if ($current_sub_menu == 52) { ?>class="active"<?php } ?>>
                        <a href="<?php echo base_url('grafico/solicitud'); ?>">
                            <span>Solicitudes</span>
                        </a>
                    </li>

                </ul>
            </li>
             /Graficos -->

            

        </ul>
    </nav>
    <!-- /main navigation -->

</div>
<!-- /sidebar panel -->