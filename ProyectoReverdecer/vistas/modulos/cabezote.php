<header class="main-header"> 
    <a href="inicio" class="logo">
        <!-- logo normal -->
        <span class="logo-lg">
            <img src="vistas/img/sistema/logo_large.png" class="img-responsive" style="padding:10px 0px">
        </span>
        <!-- logo mini -->
        <span class="logo-mini">
            <img src="vistas/img/sistema/logo_small_icon_only.png" class="img-responsive" style="padding: 3px">
        </span>
    </a>

    <!-- Barra de navegaciòn -->

    <nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Menú de navagación</span>
        </a>

        <!-- perfil del usuario -->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs" style="padding-bottom: 0px;">
                            <?php 
                                echo $_SESSION["Nombre"].'  |  '.$_SESSION["nombreCargo"];
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-body"> 
                            <div class="pull-right">
                                <a href="MANUAL _DE_USUARIO.pdf" class="btn btn-info" target="_blank">
                                    <i class="fa fa-question-circle-o"></i>
                                    <span>Ayuda</span>
                                </a>
                            </div>
                        </li>
                        <li class="user-body"> 
                            <div class="pull-right">
                                <a href="salir" class="btn btn-danger"> 
                                    
                                    <i class="fa fa-sign-out"></i>
                                    <span> Salir </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
