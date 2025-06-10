<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Pagos de creditos </title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>
    <link href="<?=SERVERURL;?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/pos.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets//plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
    <!-- DATATABLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_miscellaneous.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .code-bar .btn{
            font-size: smaller;
        }
        .code-bar .btn svg {
            width: 14px;
            height: 17px;
            vertical-align: bottom;
        }
        .searchable-container .searchable-items.grid .items {
            margin-bottom: 30px;
            border-radius: 6px;
            width: 100%;
            color: #0e1726;
            transition: all 0.35s ease;
            width: 32%;
            -ms-flex: 0 0 5%;
            flex: 0 50%;
            max-width: 50%;
            position: relative;
            width: 100%;
            padding-right: 1px;
            padding-left: 15px;
        }
    </style>
</head>
<body class="alt-menu sidebar-noneoverflow" id="precessing">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require_once 'view/components/cmp_navbar.php';?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php require_once 'view/components/cmp_topbar.php';?>
        <!--  END TOPBAR  -->
        
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">               
                <div class="row layout-spacing layout-top-spacing mt-4" id="cancel-row" style="margin-top: 0;">
                    <div class="col-xl-8 col-12 layout-spacing" id='content_credit'>                   
                        <div class="widget widget-card-four">
                            <div class="container p-3">
                                <label for="Proveedor">Proveedor</label>
                                <select name="proveedor" id="proveedor" class='form-control'>
                                    <?=$this->listaproveedores?>
                                </select>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>CLIENTE</th>
                                        <th>FECHA PAGO</th>
                                        <th>COMPRA</th>
                                        <th>CREDITO</th>
                                        <th>PENDIENTE</th>
                                        <th>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table_responsive">
                                </tbody>
                            </table>
                            <div class="container p-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="n_credito">CREDITO</label>
                                        <input type="text" id="n_credito" class="form-control" disabled>
                                        <input type="hidden" id="id_credito" class="form-control" disabled>
                                    </div>
                                    <div class="col-3">
                                        <label for="n_compra">COMPRA</label>
                                        <input type="text" id="n_compra" class="form-control" disabled>
                                    </div>
                                    <div class="col-3">
                                        <label for="total_credito">TOTAL DE CREDITO</label>
                                        <input type="text" id="total_credito" class="form-control" disabled>
                                    </div>
                                    <div class="col-3">
                                        <label for="credito_pagado">CREDITO PAGADO</label>
                                        <input type="text" id="credito_pagado" class="form-control" disabled>
                                    </div>
                                    <div class="col-3">
                                        <label for="credito_pendiente"> CREDITO PENDIENTE </label>
                                        <input type="text" id="credito_pendiente" class="form-control" disabled>
                                        <input type="hidden" id="credito_pendiente_2" class="form-control" disabled>
                                    </div>
                                    <div class="col-9">
                                        <label for="razon_proveedor"> PROVEEDOR  </label>
                                        <input type="text" id="razon_proveedor" class="form-control" disabled>
                                    </div>
                                    <div class="col-3">
                                        <label for="monto_abono"> MONTO DE ABONO  </label>
                                        <input type="text" id="monto_abono" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for="pago_con"> PAGO CON  </label>
                                        <input type="text" id="pago_con" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <label for="cambio"> CAMBIO  </label>
                                        <input type="text" id="cambio" class="form-control" disabled>
                                    </div>
                                    <div class="col-12 mt-2 text-center">
                                        <!-- Limpiar -->
                                        <button class="btn btn-danger mb-2 p-2" id="btn_limpar" onclick="clean_windows()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            Limpiar
                                        </button>

                                        <!-- Precesar -->
                                        <button class="btn btn-success mb-2 p-2" id="btn_procesar_pago">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                            Procesar Pago
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="card-pos col-lg-4" id="table-card">
                        <!-- INPUT SEARCH -->
                        <div class="widget-content searchable-container grid">
                            <div class="row mt-2">
                                <div class="col-md-12 filtered-list-search mb-2">
                                    <form autocomplete="off" class="" id="form-product-search" action="#">
                                        <div class="" style="width: -webkit-fill-available;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control" id="input-search" placeholder="Buscar los productos creditados...">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ITEMS -->
                        <div class="widget-content searchable-container mt-3 list">
                            <div class="searchable-items grid " id="items_widgets" style="height: 70vh;overflow-y: scroll;">
                                
                            <!--============================================
                                            Items de la compra
                                ============================================-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                require_once 'view/components/cmp_footer.php';
            ?>     
        </div>
        <!--  END CONTENT PART  -->
        <!-- MODALS -->
        <div class="modal fade animated fadeInDown" id="modals_productos" tabindex="-1" role="dialog" aria-labelledby="Modal_extralarge_productos" aria-modal="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Modal_extralarge_productos">Lista de productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mt-4 mb-4" >
                            <table id="productos_stock" class="table style-2 table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Cod/Barra</th>
                                        <th>Imagen</th>
                                        <th>Producto</th>
                                        <th>Costo</th>
                                        <th>U.M</th>
                                        <th>Linea</th>
                                        <th>Presentacion</th>
                                        <th>Cantidad</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_de_productos">
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>N°</th>
                                        <th>Cod/Barra</th>
                                        <th class="invisible">Imagen</th>
                                        <th>Producto</th>
                                        <th>Costo</th>
                                        <th>U.M</th>
                                        <th>Presentación</th>
                                        <th>Linea</th>
                                        <th>Cantidad</th>
                                        <th class="invisible">Accion</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="modal_no_sucursal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                   <img src="<?=SERVERURL;?>archives/assets/pos/sucursal.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <a href="<?=SERVERURL;?>sucursal/sucursales/" class="btn btn-primary mb-4">Abrir Sucursal</a>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="modal_no_caja" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="<?=SERVERURL;?>archives/assets/pos/no_caja.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <a href="<?=SERVERURL;?>caja/arqueosporcaja/" class="btn btn-primary mb-4">Abrir Caja</a>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    
     <!-- MODALS -->
     <div class="modal fade" id="modal_comprobante" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="<?=SERVERURL;?>archives/assets/pos/factura.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <div class="btn-group mb-4" role="group" aria-label="Basic example">
                        <a id="formato_a4" href="#" target='_blank' class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            Ticket
                        </a>
                       
                        <a href="#" class="btn btn-success" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-cw"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>                            
                            Continuar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/popper.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/app.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/blockui/jquery.blockUI.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/blockui/custom-blockui.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/apps/contact.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_miscellaneous.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/scrollspyNav.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->  
    <script>

/* ========================================================================== */
/*                Detectar si la pagina se cargo completamente                */
/* ========================================================================== */
        $(document).ready(function(){
            $("#view_compras, #vista_pagar_cuentas").addClass("active");
            let modal = "<?=$_SESSION["sucursal"]?>";
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            let caja = "<?=$_SESSION["caja"]?>";
            if(caja == 0){
                $("#modal_no_caja").modal('show');
            }
            var s2 = $("#proveedor").select2({
                tags: true,
            });
        });
/* ========================================================================== */
/*                        Prevenir refrezcar la pagina                        */
/* ========================================================================== */
        $("#form-product-search").submit(function(e){
            e.preventDefault();
        });

        $(document).on('change','#proveedor',function(){
            let id_proveedor = $(this).val();
            let sucursal = "<?=$_SESSION["sucursal"]?>";
            var block1 = $("#content_credit");
            $(block1).block({ 
                message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Cargando...</span>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    '-webkit-border-radius': 2,
                    '-moz-border-radius': 2,
                    backgroundColor: '#0e1726'
                }
            });
            $.post("<?=SERVERURL?>compras/buscar_credito_proveedor/",{id_proveedor,sucursal},function(response){
                $("#table_responsive").html(response);
                $(block1).unblock();
            });
        }); 
        $(document).on('click','.btn_credito',function(){
            let id_credito = $(this).attr("id_credito");
            let id_compra = $(this).attr("id_compra");
            var block1 = $("#content_credit");
            $(block1).block({ 
                message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Cargando...</span>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    '-webkit-border-radius': 2,
                    '-moz-border-radius': 2,
                    backgroundColor: '#0e1726'
                }
            });
            $.post("<?=SERVERURL?>compras/infopagocredito/",{id_credito},function(response){
                if(response==0){
                    Snackbar.show({
                        text: 'No se pudo cargar los datos',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }else{
                    let resd = response.split("|");
                    if(resd[0]== 1){
                        Snackbar.show({
                            text: 'Datos correctamente cargados',
                            actionTextColor: '#fff',
                            backgroundColor: '#8BC34A',
                            pos: 'top-right'
                        });

                        $("#id_credito").val(resd[1]);
                        $("#n_credito").val(resd[2]);
                        $("#n_compra").val(resd[3]);
                        $("#total_credito").val(resd[4]);
                        $("#credito_pagado").val(resd[5]);
                        $("#credito_pendiente").val(resd[6]);
                        $("#credito_pendiente_2").val(resd[6]);
                        $("#razon_proveedor").val(resd[7]);
                        $(block1).unblock();
                    }else{
                        Snackbar.show({
                            text: 'Hubo un error al cargar datos',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                    }
                }
            });
            var block = $("#items_widgets");
            $(block).block({ 
                message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Cargando...</span>',
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    '-webkit-border-radius': 2,
                    '-moz-border-radius': 2,
                    backgroundColor: '#0e1726'
                }
            });
            $.post("<?=SERVERURL?>compras/lista_items_compra/",{id_compra},function(res){
                $("#items_widgets").html(res);
            })
        });
        $(document).on('click','#btn_procesar_pago',function(){
            let id_credito = $("#id_credito").val();
            let monto_abono = $("#monto_abono").val();
            let credito = $("#credito_pendiente_2").val();
            if(id_credito.length >0){
                if(!isNaN(monto_abono) && monto_abono.length > 0){
                    let pago_con = $("#pago_con").val();
                    if(!isNaN(pago_con) && pago_con.length > 0 && pago_con > 0){
                        monto_abono = parseFloat(monto_abono);
                        pago_con = parseFloat(pago_con);
                        credito = parseFloat(credito);
                        if(monto_abono>credito){
                            monto_abono = credito;
                        }
                        $("#monto_abono").val(monto_abono.toFixed(2));
                        pago_con = parseFloat(pago_con);
                        if(monto_abono<=pago_con){
                            let cambio = pago_con - monto_abono;
                            $("#cambio").val(cambio.toFixed(2));
                            $("#pago_con").val(pago_con.toFixed(2))
                            var block1 = $("#content_credit");
                            $(block1).block({ 
                                message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Cargando...</span>',
                                overlayCSS: {
                                    backgroundColor: '#fff',
                                    opacity: 0.8,
                                    cursor: 'wait'
                                },
                                css: {
                                    border: 0,
                                    padding: '10px 15px',
                                    color: '#fff',
                                    width: 'auto',
                                    '-webkit-border-radius': 2,
                                    '-moz-border-radius': 2,
                                    backgroundColor: '#0e1726'
                                }
                            });
                            $.post("<?=SERVERURL?>compras/pago_cuentas_pagar/",{
                                id_credito,pago_con,monto_abono,cambio
                                },function(response){
                                    const toast = swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        padding: '2em'
                                    });
                                    if(response == 2){
                                        toast({
                                            type: 'error',
                                            title: 'Credito ya completado',
                                            padding: '2em',
                                        });
                                    }else{
                                        let resd = response.split("|");
                                        if(resd[0]== 1){
                                            toast({
                                                type: 'success',
                                                title: 'Pago realizado con exito',
                                                padding: '2em',
                                            });
                                            clean_windows();
                                            $(block1).unblock();
                                            $("#formato_a4").attr('href',"<?=SERVERURL;?>compras/ticketpago/"+resd[1]);
                                            $("#modal_comprobante").modal('show');
                                        }else{
                                            toast({
                                                type: 'error',
                                                title: 'Hubo un error al procesar pago',
                                                padding: '2em',
                                            });
                                        }
                                    }
                            });
                        }else{  
                            Snackbar.show({
                                text: 'El pago no puede ser menor al monto del abono',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            $("#cambio").val("0.00")
                            $("#pago_con").val("0.00")
                            return false;
                        }
                    }else{
                        Snackbar.show({
                            text: 'Agrege un monto con la cual se esta pagando',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                    }
                }else{
                    Snackbar.show({
                        text: 'Agregue un abono valido',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            }else{
                Snackbar.show({
                    text: 'Seleccione una cuenta por pagar',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }
        });
        $(document).on('blur','#pago_con',function(){
            let monto_abono = $("#monto_abono").val();
            let credito = $("#credito_pendiente_2").val();
            if(!isNaN(credito) && credito.length > 0 && credito>0){
                if(!isNaN(monto_abono) && monto_abono.length > 0 && monto_abono>0){
                    let pago_con = $("#pago_con").val();
                    if(!isNaN(pago_con) && pago_con.length > 0 && pago_con.length >0){
                        monto_abono = parseFloat(monto_abono);
                        pago_con = parseFloat(pago_con);
                        if(monto_abono<=pago_con){
                            let cambio = pago_con - monto_abono;
                            $("#cambio").val(cambio.toFixed(2));
                            $("#pago_con").val(pago_con.toFixed(2))
                        }else{  
                            Snackbar.show({
                                text: 'El pago no puede ser menor al monto del abono',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            $("#cambio").val("0.00")
                            $("#pago_con").val("0.00")
                            return false;
                        }
                    }else{
                        Snackbar.show({
                            text: 'El efectivo con la cual se esta pagando es necesario',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        $("#pago_con").val("");
                    }
                }else{
                    Snackbar.show({
                        text: 'Monto de abono no válido',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    $("#monto_abono").val("");
                    return false;
                }
            }else{
                Snackbar.show({
                    text: 'No has seleccionado una cuenta por pagar',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $("#monto_abono").val("");
                return false;
            }
        });
        $(document).on('blur','#monto_abono',function(){
            let monto_abono = $("#monto_abono").val();
            let credito = $("#credito_pendiente_2").val();
            if(!isNaN(credito) && credito.length > 0 && credito>0){
                if(!isNaN(monto_abono) && monto_abono.length > 0 && monto_abono>0){
                    monto_abono = parseFloat(monto_abono);
                    credito = parseFloat(credito);
                    if(monto_abono>credito){
                        monto_abono = credito;
                    }
                    $("#monto_abono").val(monto_abono.toFixed(2));
                }else{
                    Snackbar.show({
                        text: 'Abono no valido',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    $("#monto_abono").val("");
                    return false; 
                }
            }else{
                Snackbar.show({
                    text: 'No has seleccionado una cuenta por pagar',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $("#monto_abono").val("");
                return false; 
            }
        });
        let clean_windows = ()=>{
            $("#n_credito").val("");
            $("#n_compra").val("");
            $("#id_credito").val("");
            $("#monto_abono").val("");
            $("#total_credito").val("");
            $("#credito_pagado").val("");
            $("#credito_pendiente_2").val("");
            $("#credito_pendiente").val("");
            $("#razon_proveedor").val("");
            $("#monto_abono").val("");
            $("#pago_con").val("");
            $("#cambio").val("0.00");
            $("#table_responsive").html("");
            $("#items_widgets").html("");
        }
    </script>
</body>
</html>