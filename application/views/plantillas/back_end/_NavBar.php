<!-- top header -->
    <header class="header navbar">

      <div class="brand visible-xs">
        <!-- toggle offscreen menu -->
        <div class="toggle-offscreen">
          <a href="#" class="hamburger-icon visible-xs" data-toggle="offscreen" data-move="ltr">
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
        <!-- /toggle offscreen menu -->

        <!-- logo -->
       
        <!-- /logo -->

        <!-- toggle chat sidebar small screen-->
        <div class="toggle-chat">
          <a href="javascript:;" class="hamburger-icon v2 visible-xs" data-toggle="layout-chat-open">
            <span></span>
            <span></span>
            <span></span>
          </a>
        </div>
        <!-- /toggle chat sidebar small screen-->
      </div>

      <ul class="nav navbar-nav hidden-xs">
        <li>
          <p class="navbar-text">
            Bienvenido!
          </p>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right hidden-xs">
        <!-- <li>
          <a href="javascript:;" data-toggle="quick-launch-panel">
            <i class="fa fa-circle-thin"></i>
          </a>
        </li> -->

        <li>
          <a href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>

            <div class="status bg-danger border-danger animated bounce"></div>
         
          </a>
          <ul class="dropdown-menu notifications">
            <li class="notifications-header">
                <p class="text-muted small">Usted tiene nuevas solicitudes</p>
            </li>
            <li>
              <ul class="notifications-list">
                 

              </ul>
            </li>
            <li class="notifications-footer">
              <a href="<?php echo base_url('solicitud'); ?>">Ver todas las solicitudes</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript:;" data-toggle="dropdown" >
             
            <img src="<?php echo base_url('assets/images/userimg/user_3.jpg'); ?>" class="header-avatar img-circle ml10" alt="user" title="user">
            <span class="pull-left"><?php echo $this->session->userdata('sess_nombre_admin') . ' ' . $this->session->userdata('sess_apellido_admin') ?></span>
          </a>
          <ul class="dropdown-menu">

            <li>
                <a href="<?php echo base_url('login/salir'); ?>">Salir</a>
            </li>
          </ul>

        </li>

      </ul>
    </header>
    <!-- /top header -->