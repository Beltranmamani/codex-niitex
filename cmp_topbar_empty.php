<?php
    $permiso = $_SESSION["modulos_access"];
?>
<div class="topbar-nav header navbar" role="banner">
    <nav id="topbar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="<?=SERVERURL;?>dashboard/">
                    <img src="<?=SERVERURL;?>view/assets/assets/img/logo2.svg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="<?=SERVERURL;?>dashboard/" class="nav-link"> <?=SISTEMA_NOMBRE?> </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories" id="topAccordion">
            <!-- Bloque Dashboard -->
            <li id="view_dashboard" class="menu single-menu active">
                <a href="javascript:void(0)">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>


            
        </ul>
    </nav>
</div>