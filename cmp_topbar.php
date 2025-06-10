<?php
    $permiso = $_SESSION["modulos_access"];
?>
<style>
    .sub-submenu {
        right: unset !important;
        left: 100% !important;
        width: auto !important;
    }
</style>
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
            <?php
                if($permiso["DASHBOARD"] == 1){
            ?>
                <li id="view_dashboard" class="menu single-menu">
                    <a href="<?=SERVERURL?>dashboard/">
                        <div class="">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            <span>Escritorio</span>
                        </div>
                    </a>
                </li>
            <?php
                }
            ?>
            <!-- Bloque POS -->
            <?php
                if($permiso["POS"] == 1){
            ?>
                <li id="view_pos" class="menu single-menu">
                    <a href="<?=SERVERURL?>ventas/pos/">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                            <span>POS</span>
                        </div>
                    </a>
                </li>
            <?php
                }
            ?>
            <!-- Bloque Administrador -->
            <li id="view_administracion" class="menu single-menu">
                <a href="#administracio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <span>Admin</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="administracio" data-parent="#topAccordion">
                    <?php
                        if($permiso["CONFIGURACION"] == 1){
                    ?>
                    <li class="sub-sub-submenu-list">
                        <a href="#sucursal" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Configuracíon <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="sucursal" data-parent="#datatable">
                            <li>
                                <a href="<?=SERVERURL;?>sucursal/configuracion/"> Sucursal</a>
                            </li>
                            <hr>
                            <li>
                                <a href="<?=SERVERURL;?>almacen/"> Almacenes  </a>
                            </li>
                            <hr>
                            <li>
                                <a href="<?=SERVERURL;?>comprobante/tiraje/"> Tiraje de comprobante </a>
                            </li>
                        </ul>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["SUCURSALES"] == 1){
                    ?>
                    <li id="vista_sucursales">
                        <a href="<?=SERVERURL;?>sucursal/"> Sucursales</a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["DOCUMENTOS"] == 1){
                    ?>
                    <li id="vista_documentos">
                        <a href="<?=SERVERURL;?>documento/"> Documentos</a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["COMPROBANTES"] == 1){
                    ?>
                    <li id="vista_metodopagos">
                        <a href="<?=SERVERURL;?>metodopago/"> Metodos de pago  </a>
                    </li>
                    <li id="vista_comprobantes">
                        <a href="<?=SERVERURL;?>comprobante/"> Comprobantes  </a>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["PERSONAL"] == 1){
                    ?>
                        <li class="sub-sub-submenu-list">
                            <a href="#personal" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Personal <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                            <ul class="collapse list-unstyled sub-submenu" id="personal" data-parent="#personal">
                                    <li>
                                        <a href="<?=SERVERURL;?>personal/personas/"> Personas</a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="<?=SERVERURL;?>personal/usuarios/"> Usuarios  </a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="<?=SERVERURL;?>personal/usuariosxsucursal/"> Usuarios x Sucursal  </a>
                                    </li>
                                    <hr>
                                    <li id="vista_historial">
                                        <a href="<?=SERVERURL;?>personal/historial/"> Historial de Acceso  </a>
                                    </li>
                                </ul>
                           
                        </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["FACTURA"] == 1){
                    ?>
                    <li class="sub-sub-submenu-list">
                        <a href="#factura" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Facturacion <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="factura" data-parent="#factura">
                            <li id="vista_ventas_libro">
                                <a href="<?=SERVERURL;?>ventas/libroventas/"> Libro de ventas IVA </a>
                            </li>
                                   
                            <li id="vista_consulta_compra">
                                <a href="<?=SERVERURL;?>compras/librocompra/">Libro de compras </a>
                            </li>
                            <li id="vista_validadcodigo">
                                <a href="<?=SERVERURL;?>ventas/validarcodigo/">Validar codigo de control</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["TIENDA"] == 1){
                    ?>
                    <li class="sub-sub-submenu-list">
                        <a href="#tiendavirtual" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Tienda <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="tiendavirtual" data-parent="#tiendavirtual">
                            <li>
                                <a href="<?=SERVERURL;?>pedidostienda/dashboard/"> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?=SERVERURL;?>departamento/"> Departamentos</a>
                            </li>
                            <li>
                                <a href="<?=SERVERURL;?>provincia/"> Provincias</a>
                            </li>
                            <li>
                               <a href="<?=SERVERURL;?>secciones/"> Secciones</a>
                            </li>
                            
                            <li>
                               <a href="<?=SERVERURL;?>productostienda/"> Productos en tienda</a>
                            </li>
                            <li>
                               <a href="<?=SERVERURL;?>productostienda/cuentabancaria/"> Cuenta bancaria</a>
                            </li>
                            <li>
                               <a href="<?=SERVERURL;?>productostienda/recomendados/"> Productos recomendados</a>
                            </li>
                            
                           <li >
                                <a href="<?=SERVERURL;?>promociones/"> Promociones</a>
                            </li>
                           <li >
                                <a href="<?=SERVERURL;?>pedidostienda/"> Pedidos recientes </a>
                            </li>
                           <li id="vista_pedido_pago_completado">
                                <a href="<?=SERVERURL;?>pedidostienda/pedidosconpagoscompletados/"> Pagos completados </a>
                            </li>
                            <li id="vista_pedido_ependiente">
                                <a href="<?=SERVERURL;?>pedidostienda/pedidosenviospendientes/"> Envios Pendientes </a>
                            </li>
                            <li id="vista_pedido_enenvio">
                                <a href="<?=SERVERURL;?>pedidostienda/pedidosenenvio/"> En envios </a>
                            </li>
                            <li id="vista_pedido_completado">
                                <a href="<?=SERVERURL;?>pedidostienda/pedidosenviados/"> Envios completados </a>
                            </li>
                            <li id="vista_pedido_anulado">
                                <a href="<?=SERVERURL;?>pedidostienda/pedidosanulados/"> Anulados </a>
                            </li>
                            <li id="vista_estado_productos">
                                <a href="<?=SERVERURL;?>pedidostienda/estado_productos/"> Estado de Productos </a>                        
                            </li>
                            <li id="vista_pedidos_reporte">
                                <a href="<?=SERVERURL;?>pedidostienda/reporte_pedidos/"> Reporte de pedidos </a>                        
                            </li>
                        </ul>
                        
                    </li>
                    <?php
                        }
                    ?>
                    <li class="sub-sub-submenu-list">
                        <a href="#Backup" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Database <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                            <ul class="collapse list-unstyled sub-submenu" id="Backup" data-parent="#datatable">
                                <li>
                                    <a href="<?=SERVERURL;?>backup/backup/"> Backup</a>
                                </li>
                                <hr>
                                <li>
                                    <a href="<?=SERVERURL;?>backup/restore/"> Restore  </a>
                                </li>
                                <hr>
                                
                            </ul>
                        </li>
                    </li>
                </ul>
            </li>
            <!-- Bloque de Productos -->
            <li id="view_producto" class="menu single-menu">
                <a href="#productos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <span>Producto</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="productos" data-parent="#topAccordion">
                    <?php
                        if($permiso["PRODUCTOS"] == 1){
                    ?>  
                    <li id="vista_productos">
                        <a href="<?=SERVERURL?>productos/"> Productos  </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["PRESENTACION"] == 1){
                    ?>  
                    <li id="vista_presentacion">
                        <a href="<?=SERVERURL;?>presentacion/">Presentación </a>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["UNIDAD_MEDIDA"] == 1){
                    ?>  
                    <li id="vista_unidades_medida">
                        <a href="<?=SERVERURL;?>unidadmedida/"> Unidad Medida </a>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["LINEAS"] == 1){
                    ?>
                    <li id="vista_lineas">
                        <a href="<?=SERVERURL;?>lineas/">Líneas </a>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["PERCEDEROS"] == 1){
                    ?>
                    <li>
                        <a href="<?=SERVERURL;?>inventario/perecederos/"> Perecederos </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["ALMACEN"] == 1){
                    ?>
                    <li class="sub-sub-submenu-list">
                        <a href="#datatable" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Almacén <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="datatable" data-parent="#datatable">
                        <?php
                            if(isset($_SESSION["almacenes"])){
                                $almacenes = $_SESSION["almacenes"];
                                $array_almacen = explode("|",$almacenes);
                                foreach($array_almacen as $clave => $valor){
                                    if($valor != ""){
                                        $valor = explode(",",$valor);
                        ?>
                            <li>
                                <a href="<?=SERVERURL;?>almacen/productos/<?=$valor[0]?>"> <?php echo substr($valor[1],0,15);?> </a>
                            </li>
                        <?php
                                    }
                                }
                        ?>
                        <?php
                            }
                        ?>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <!-- Bloque de compras -->
            <li id="view_compras" class="menu single-menu">
                <a href="#uiKit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>                       
                        <span>Compras</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="uiKit" data-parent="#topAccordion">
                    <?php
                        if($permiso["PROVEEDORES"] == 1){
                    ?>
                    <li id="vista_proveedores">
                        <a href="<?=SERVERURL;?>proveedores/"> Proveedores </a>                        
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["COMPRAS"] == 1){
                    ?>
                    <li id="vista_compras">
                        <a href="<?=SERVERURL;?>compras/"> Compras </a>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_COMPRAS"] == 1){
                    ?>
                    <li id="vista_consulta_compra">
                        <a href="<?=SERVERURL;?>compras/consultacompras/"> Consulta de compras </a>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["HISTORICO_PRECIOS"] == 1){
                    ?>
                    <li id="vista_historico_precios">
                        <a href="<?=SERVERURL;?>compras/historicoprecios/"> Historico Precios </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CUENTAS_PAGAR"] == 1){
                    ?>
                    <li  id="vista_cuentas_por_pagar">
                        <a href="<?=SERVERURL;?>compras/cuentasporpagar/"> Cuentas por pagar </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["REPORTE_COMPRAS"] == 1){
                    ?>
                    <li class="sub-sub-submenu-list" id="dp_compras">
                        <a href="#reporte_compras" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reporte Compras <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="reporte_compras" data-parent="#reporte_compras"> 
                            <li id="vista_proveedor">
                                <a href="<?=SERVERURL;?>compras/comprasporproveedor/"> Compras por proveedor </a>
                            </li>
                            <li id="vista_compras_fecha">
                                <a href="<?=SERVERURL;?>compras/comprasporfecha/"> Compras por fecha </a>
                            </li>
                            <li id="vista_compras_detalle">
                                <a href="<?=SERVERURL;?>compras/compraspordetalle/"> Compras por detalle </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CREDITOS"] == 1){
                    ?>
                    <li class="sub-sub-submenu-list" id='dp_creditos'>
                        <a href="#creditos_reporte" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Creditos <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="creditos_reporte" data-parent="#creditos_reporte"> 
                            <li id='vista_credito_proveedor'>
                                <a href="<?=SERVERURL;?>compras/creditosporproveedor/"> Creditos por proveedor </a>
                            </li>
                            <li id='vista_credito_fecha'>
                                <a href="<?=SERVERURL;?>compras/creditosporfecha/"> Creditos por  fecha </a>
                            </li>
                            <li id='vista_credito_detalle'>
                                <a href="<?=SERVERURL;?>compras/creditospordetalle/"> Creditos por  detalle </a>
                            </li>
                        </ul>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["PAGAR_CREDITOS"] == 1){
                    ?>
                    <li  id="vista_pagar_cuentas">
                        <a href="<?=SERVERURL;?>compras/pagarcreditos/"> Pagar creditos </a>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_PAGOS"] == 1){
                    ?>
                    <li  id="vista_pagos_realizados">
                        <a href="<?=SERVERURL;?>compras/pagosrealizados/"> Consulta de pagos </a>
                    </li>
                    <?php
                        }
                    ?>
                   
                </ul>
            </li>
            <!-- Bloque de caja -->
            <li id="view_caja" class="menu single-menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>                        
                        <span>Caja</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#topAccordion">
                    <?php
                        if($permiso["ASIGNACION_CAJA"] == 1){
                    ?>
                    <li id="vista_asignacion_cajas">
                        <a href="<?=SERVERURL;?>caja/"> Asignacion de cajas </a>                        
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["ARQUEOS_CAJA"] == 1){
                    ?>
                    <li id="vista_arqueo_cajas">
                        <a href="<?=SERVERURL;?>caja/arqueosporcaja/"> Arqueos de Cajas </a>                        
                    </li >
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["MOVIMIENTOS_CAJA"] == 1){
                    ?>
                    <li id="vista_movimientos_cajas">
                        <a href="<?=SERVERURL;?>caja/movimientosporcaja/"> Movimientos de cajas </a>                        
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["REPORTE_CAJA"] == 1){
                    ?>
                    <li id="dp_reporte_caja" class="sub-sub-submenu-list">
                        <a href="#cajas_repor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reporte de cajas <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="cajas_repor" data-parent="#cajas_repor"> 
                            <li id="vista_arqueos_por_fecha">
                                <a href="<?=SERVERURL;?>caja/arqueosporfecha/"> Reportes de cajas </a>                        
                            </li>
                            <li id="vista_movimientos_por_fecha">
                                <a href="<?=SERVERURL;?>caja/movimientosporfecha/"> Reporte de movimientos </a>                        
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <!-- Bloque de cotizacion -->
            <li id="view_cotizacion" class="menu single-menu">
                <a href="#cotizacion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                        <span>Cotización</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="cotizacion"  data-parent="#topAccordion">
                    <?php
                        if($permiso["COTIZACION"] == 1){
                    ?>
                    
                    <li id="vista_cotizacion">
                        <a href="<?=SERVERURL;?>cotizacion/"> Cotización</a>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["CONSULTA_COTIZACION"] == 1){
                    ?>
                    <li id="vista_ver_cotizacion">
                        <a href="<?=SERVERURL;?>cotizacion/consultacotizacion/"> Consulta Cotizaciones</a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["REPORTE_COTIZACION"] == 1){
                    ?>
                    <li id="dp_reporte_cotizacion" class="sub-sub-submenu-list">
                        <a href="#reporte_cotizacion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reporte cotización <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="reporte_cotizacion" data-parent="#reporte_cotizacion"> 
                            <li id="vista_cotizaciones_fecha">
                                <a href="<?=SERVERURL;?>cotizacion/cotizacionporfecha/"> Cotización por fechas </a>
                            </li>
                            <li id="vista_productos_cotizados">
                                <a href="<?=SERVERURL;?>cotizacion/productoscotizados/"> Productos Cotizados </a>
                            </li>
                            <li id="vista_cotizacion_vendedor">
                                <a href="<?=SERVERURL;?>cotizacion/cotizacionporvendedor/"> Cotización por vendedor </a>
                            </li>
                            <li id="vista_cotizacion_vendedores">
                                <a href="<?=SERVERURL;?>cotizacion/cotizacionporvendedores/"> Cotización x vendedores </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <!-- Bloque de Preventa -->
            <li id="view_preventa" class="menu single-menu">
                <a href="#preventa" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
                        <span>Preventa</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="preventa"  data-parent="#topAccordion">
                    <?php
                        if($permiso["PREVENTA"] == 1){
                    ?>
                    <li id="vista_preventa">
                        <a href="<?=SERVERURL;?>preventa/"> Preventa</a>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["CONSULTA_PREVENTA"] == 1){
                    ?>
                    <li id="vista_consulta_preventas">
                        <a href="<?=SERVERURL;?>preventa/consultapreventas/"> Consulta preventa</a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["REPORTE_PREVENTA"] == 1){
                    ?>
                    <li id="dp_reporte_preventa" class="sub-sub-submenu-list">
                        <a href="#reporte_pre_venta" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reporte preventa <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="reporte_pre_venta" data-parent="#reporte_pre_venta"> 
                            <li id="vista_preventa_fecha">
                                <a href="<?=SERVERURL;?>preventa/preventaporfecha/"> Preventa por fechas </a>
                            </li>
                            <li id="vista_productos_prevendidos">
                                <a href="<?=SERVERURL;?>preventa/productosprevendidos/"> Productos Prevendidos </a>
                            </li>
                            <li id="vista_prventaxvendedor">
                                <a href="<?=SERVERURL;?>preventa/preventaporvendedor/"> Preventa por vendedor </a>
                            </li>
                            <li id="vista_prventaxvendedores">
                                <a href="<?=SERVERURL;?>preventa/preventaporvendedores/"> Preventa por vendedores </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["REPORTE_PREVENTA"] == 1){
                    ?>
                    <li id="dp_reporte_preventa1" class="sub-sub-submenu-list">
                        <a href="#reporte_devo_pre_venta" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reporte devoluciones <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="reporte_devo_pre_venta" data-parent="#reporte_devo_pre_venta"> 
                            <li id="vista_preventa_fecha_dev">
                                <a href="<?=SERVERURL;?>preventa/devoluciongeneral/"> Devoluciones generales </a>
                            </li>
                            <li id="vista_productos_prevendidos_dev">
                                <a href="<?=SERVERURL;?>preventa/devolucionporvendedores/"> Devoluciones x vendedor </a>
                            </li>
                            <li id="vista_prventaxvendedor_dev">
                                <a href="<?=SERVERURL;?>preventa/preventadevolucionesporvendedores/"> Devoluciones x vendedores </a>
                            </li>

                            

                        </ul>
                    </li>
                    <?php
                        }
                    ?>

                </ul>
            </li>
            <!-- Bloque de ventas -->
            <li id="view_ventas" class="menu single-menu">
                <a href="#ventas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span>Ventas</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="ventas"  data-parent="#topAccordion">
                    <?php
                        if($permiso["VENTA"] == 1){
                    ?>  
                    <li id="vista_nueva_venta">
                        <a href="<?=SERVERURL;?>ventas/puntoventa/"> Nueva venta </a>
                    </li>
                    <li id="vista_nueva_venta">
                        <a href="<?=SERVERURL;?>ventas/v2/"> POS V2 </a>
                    </li>
                    <li id="vista_nueva_venta">
                        <a href="<?=SERVERURL;?>ventas/v3/"> POS V3 </a>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CLIENTE"] == 1){
                    ?> 
                    <li id="vista_clientes">
                        <a href="<?=SERVERURL;?>cliente/"> Clientes </a>
                    </li >
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_VENTA"] == 1){
                    ?> 
                    <li id="vista_consulta_ventas">
                        <a href="<?=SERVERURL;?>ventas/consultaventas/"> Consulta ventas </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CUENTAS_COBRAR"] == 1){
                    ?> 
                    <li id="vista_cuentasxcobrar">
                        <a href="<?=SERVERURL;?>ventas/cuentasxcobrar/"> Cuentas por cobrar </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["REPORTE_VENTAS"] == 1){
                    ?> 
                    <li class="sub-sub-submenu-list">
                        <a href="#ventas_reporte" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Reporte ventas <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="ventas_reporte" data-parent="#ventas_reporte"> 
                            <li id="vista_ventas_fecha">
                                <a href="<?=SERVERURL;?>ventas/reportecc/"> Reporte Historial al Contado y Credito </a>
                            </li>
                            <li id="vista_ventas_fecha">
                                <a href="<?=SERVERURL;?>ventas/ventasporfecha/"> Ventas por fechas </a>
                            </li>
                            <li id="vista_productos_vendidos">
                                <a href="<?=SERVERURL;?>ventas/productosvendidos/"> Productos vendidos </a>
                            </li>
                            <li>
                                <a href="<?=SERVERURL;?>ventas/ventasvendedor/"> Ventas por vendedor </a>
                            </li>
                            
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CREDITOS_VENTAS"] == 1){
                    ?> 
                    <li class="sub-sub-submenu-list">
                        <a href="#creditos_venta" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Creditos <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="creditos_venta" data-parent="#ventas_reporte"> 
                            <li>
                                <a href="<?=SERVERURL;?>ventas/creditoscliente/"> Creditos por cliente </a>
                            </li>
                           
                            
                        </ul>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["ABONAR_CREDITOS"] == 1){
                    ?> 
                    <li id="vista_nuevo_abono">
                        <a href="<?=SERVERURL;?>ventas/abonarcredito/">Abonar creditos</a>
                    </li>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_ABONO"] == 1){
                    ?> 
                    <li id="vista_consulta_abono">
                        <a href="<?=SERVERURL;?>ventas/consultaabonos/">Consulta de abono</a>
                    </li>
                    
                    <?php
                        }
                        if($permiso["PAGOS_PENDIENTES"] == 1){
                    ?>
                    <li >
                        <a href="<?=SERVERURL;?>ventas/consultapagospendientes/">Pagos pendientes</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <!-- Bloque inventario -->
            <li id="view_inventario" class="menu single-menu">
                <a href="#inventario" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>                        
                        <span>Inventario</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="inventario"  data-parent="#topAccordion">
                    <?php
                        if($permiso["INVENTARTIO_GENERAL"] == 1){
                    ?>  
                    <li id="vista_inventariogeneral">
                        <a href="<?=SERVERURL;?>inventario/inventariogeneral/"> Inventario General </a>
                    </li>
                    <hr>
                    <li id="vista_inventariogeneral">
                        <a href="<?=SERVERURL;?>inventario/gananciaxalmacen/"> Ganancia almacen </a>
                    </li>
                    <li id="view_kardex_valorizado">
                        <a href="<?=SERVERURL;?>kardex/kardexGeneral/"> Kardex General </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_PRODUCTOS"] == 1){
                    ?>
                    <li id="vista_consulta_producto">
                        <a href="<?=SERVERURL;?>inventario/consultaproducto/"> Consulta de productos </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["NUEVO_TRASPASO"] == 1){
                    ?>
                    <li id="vista_nuevo_traspaso">
                        <a href="<?=SERVERURL;?>inventario/nuevotraspaso/"> Nuevo traspaso </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                         <?php
                        if($permiso["PEDIDO_TRASPASO"] == 1){
                    ?>
                    <li id="vista_nuevo_pedido_traspaso">
                        <a href="<?=SERVERURL;?>inventario/nuevopedidotraspaso/"> Nuevo Pedido traspaso </a>
                    </li>
                    
                    <?php
                    }
                    if($permiso["PEDIDO_TRASPASO_LISTA"] == 1){
                    ?>
                    <li id="vista_lista_pedido_traspaso">
                        <a href="<?=SERVERURL;?>inventario/listapedidotraspasos/"> Lista Pedido traspaso </a>
                    </li>
                    
                    <?php
                    }
                    if($permiso["PEDIDO_TRASPASO_PENDIENTES"] == 1){
                    ?>
                    <li id="vista_pedido_traspaso">
                        <a href="<?=SERVERURL;?>inventario/pedidotraspasos/"> Pedido traspaso Pendientes </a>
                    </li>
                    <hr>
                    
                     <?php
                    }
                
                        if($permiso["AJUSTE_INVENTARIO"] == 1){
                    ?>
                    <li id="vista_ajuste_inventario">
                        <a href="<?=SERVERURL;?>inventario/ajustedeinventarios/"> Ajuste de inventario </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_TRASPASO"] == 1){
                    ?>
                    <li id="vista_traspaso">
                        <a href="<?=SERVERURL;?>inventario/consultatraspasos/"> Consulta de traspasos</a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                     <?php
                        if($permiso["CONSULTA_AJUSTES"] == 1){
                    ?>
                    <li>
                        <a href="<?=SERVERURL;?>inventario/consultaajustes/"> Consulta de ajustes</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <!-- Bloque de kardex -->
            <li id="view_kardex" class="menu single-menu">
                <a href="#kardex" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg>
                        <span>Kardex</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="kardex" data-parent="#topAccordion">
                    <?php
                        if($permiso["KARDEX_PRODUCTOS"] == 1){
                    ?>
                    <li id="view_kardex_productos">
                        <a href="<?=SERVERURL;?>kardex/"> Kardex de productos </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["KARDEX_VALORIZADO"] == 1){
                    ?>
                    <li id="view_kardex_valorizado">
                        <a href="<?=SERVERURL;?>kardex/kardexvalorizado/"> Kardex de valorizado </a>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["KARDEX_GENERAL"] == 1){
                    ?>
                    <li id="view_kardex_valorizado">
                        <a href="<?=SERVERURL;?>kardex/general/"> Kardex General </a>
                    </li>
                    
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["K_VALO_FECHA"] == 1){
                    ?>
                    <li id="view_kardex_valorizado_fecha">
                        <a href="<?=SERVERURL;?>kardex/valorizadoporfecha/"> K. Valorizado. x fecha </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </li>
            <!-- Bloque de kardex -->
            <li id="view_distribucion" class="menu single-menu">
                <a href="#kardex" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>                        
                    <span>Distribucion</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </a>
                <ul class="collapse submenu list-unstyled" id="kardex" data-parent="#topAccordion">
                    <?php
                        if($permiso["KARDEX_PRODUCTOS"] == 1){
                    ?>
                    <li id="view_kardex_productos">
                        <a href="<?=SERVERURL;?>distribucion/">Mapa de entrega </a>
                    </li>
                    <hr>
                    <?php
                        }
                    ?>
                    <?php
                        if($permiso["KARDEX_VALORIZADO"] == 1){
                    ?>
                    <li id="view_kardex_valorizado">
                        <a href="<?=SERVERURL;?>distribucion/entregaspendientes/">Entregas pendientes </a>
                    </li>
                    <?php
                        }
                    ?>
                    
                </ul>
            </li>
        </ul>
    </nav>
</div>