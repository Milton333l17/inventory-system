
<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar" style="padding:0;">
        <div class="container-fluid" style="padding-left:0;">
            <div class="header-mobile-inner">
                <a class="logo" href="index.php">
                    <img src="images/icon/LOGO2.PNG" style="width:200px;" alt="Inventory Systema" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="has-sub">
                    <a class="js-arrow " href="#" style="color:white;">
                        <i class="fas fa-tachometer-alt"></i>Panel de control</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="index.php">Inicio</a>
                        </li>
                    </ul>
                </li>
                >
                <li>
                
                    <a href="form.php">
                        <i class="far fa-check-square"></i>Registro</a>
                </li>
                   
                <li>
                    <a href="usuarios.php">
                        <i class="fas fa-user"></i>Usuarios </a>
                </li>
                
                <li>
                    <a href="categorias.php">
                        <i class="fas fa-anchor"></i>Categorias</a>
                </li>
                <?php if($user['rol_id'] == 1): ?>
                <li>
                    <a href="proveedores.php">
                        <i class="fas fa-users"></i>Proveedor</a>
                </li>
                <?php endif ?>
                <li>
                    <a href="calendar.php">
                        <i class="fas fa-calendar-alt"></i>Calendario</a>
                </li>
                <li>
                    <a href="productos.php">
                    <i class="fas fa-baby-carriage"></i>Producto</a>
                </li>
                <li>
                    <a href="entradas.php?start=0">
                    <i class="fas fa-arrow-right"></i>Entradas</a>
                </li>
                <li>
                    <a href="salidas.php">
                    <i class="fas fa-shopping-cart"></i>Salidas</a>
                </li> 
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->
<!-- MENU SIDEBAR-->



<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo" style="padding:0px;border-color:#090909;">
        <a href="#">
            <img src="images/icon/LOGO2.png" style="width:500px;margin-top:0px;height:80px;" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1" style="background-color:#090909;">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">

                <li>
                    <a href="index.php" style="color:white;" >
                        <i class="fas fa-tachometer-alt colo" ></i>Inicio </a>
                </li>
                <?php if($user['rol_id'] == 1): ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#" style="color:white;">
                        <i class="fas fa-user colo"></i>Usuario</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li >
                    <a href="form.php" style="color:white;">
                        <i class="fas fa-check-square colo"></i>Registrar</a>
                    </li>

                    <li>
                    <a href="usuarios.php" style="color:white;">
                        <i class="fas fa-user colo"></i>Tabla Usuarios</a>
                    </li>
              
                    </ul>
                </li>
                <?php endif ?>
                
                <li>
                    <a href="categorias.php" style="color:white;">
                        <i class="fas fa-anchor colo"></i>Categorias</a>
                </li>
                <?php if($user['rol_id'] == 1): ?>
                <li>
                    <a href="proveedores.php" style="color:white;">
                        <i class="fas fa-users colo"></i>Proveedor</a>
                </li>
                <?php endif ?>
                <li>
                    <a href="calendar.php"  style="color:white;">
                        <i class="fas fa-calendar-alt colo"></i>Calendario</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#" style="color:white;">
                        <i class="fas fa-glass colo"></i>Productos</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                    <a href="productos.php" style="color:white;">
                    <i class="fas fa-thumb-tack colo"></i>Principal</a>
                </li>
                    
                <li>
                    <a href="entradas.php?start=0" style="color:white;">
                    <i class="fas fa-truck colo"></i>Entradas</a>
                </li>  
                <li >
                    <a href="salidas.php"  style="color:white;">
                    <i class="fas fa-shopping-cart colo"></i>Salidas</a>
                </li>  
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="page-container">


    <!-- HEADER DESKTOP-->
    <header class="header-desktop" style="background-color:#090909;border-color:#090909;" >
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    <form class="form-header" action="" method="POST">

                    </form>
                    <div class="header-button">
                        <div class="noti-wrap">

                            <div class="noti__item js-item-menu">
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                    <img src="uploads/users/<?= $user['imagen_url']?>" alt="John Doe" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" style="color:white;" href="#"><?php echo ucwords($user['nombres'] . " " . $user['apellidos']); ?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="uploads/users/<?= $user['imagen_url']?>" alt="John Doe" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#"><?php echo ucwords($user['nombres'] . " " . $user['apellidos']); ?></a>
                                            </h5>
                                            <span class="email"><?php echo $user['email']; ?></span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="perfil.php">
                                                <i class="zmdi zmdi-account"></i>PERFIL</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="contrasena.php ">
                                                <i class="zmdi zmdi-settings"></i>CAMBIO CONTRASEÑA</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="logout.php">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>