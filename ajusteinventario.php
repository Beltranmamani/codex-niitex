<?php
    session_name('B_POS');
    session_start();
    if (!isset($_SESSION["usuario"])) {
        echo '<script> window.location.href="' . SERVERURL . 'login/" ;</script>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Ajuste de inventarios </title>
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
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/contacts2.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/apps/pos.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">
    <!-- DATATABLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_miscellaneous.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .select2-container{
            z-index: 100000;
        }
        .almacen .select2-container{
            z-index: 1000;
        }
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
            flex: 0 32%;
            max-width: 32%;
            position: relative;
            width: 100%;
            padding-right: 1px;
            padding-left: 15px;
        }
        .x_td:hover{
            background-color: #ff0000a8;
            color:#fff!important;
            transition: all 0.5s;
            cursor: pointer;
        }
        @media only screen and (max-width: 600px) {
             .searchable-container .searchable-items.grid .items {
                    margin-bottom: 30px;
                    border-radius: 6px;
                    width: 100%;
                    color: #0e1726;
                    transition: all 0.35s ease;
                    width: 32%;
                    -ms-flex: 0 0 5%;
                    flex: 0 50%;
                    max-width: 100%;
                    position: relative;
                    width: 100%;
                    padding-right: 1px;
                    padding-left: 15px;
                }
                td .bootstrap-touchspin-injected{
                    width: 100px;
                }
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
                    <div class="card-pos col-lg-7" id="table-card">
                        <!-- INPUT SEARCH -->
                        <div class="widget-content searchable-container grid">
                            <div class="row mt-2">
                                <div class="col-xl-6 col-lg-7 col-md-7 col-sm-8 filtered-list-search  mt-2">
                                    <form autocomplete="off" class="" id="form-product-search" action="#">
                                        <div class="" style="width: -webkit-fill-available;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control" id="input-search" placeholder="Buscar los productos">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6 col-lg-5 col-md-5 col-sm-4 text-sm-right text-center layout-spacing align-self-center mt-2">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-lg btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                Presentacion
                                            </button>
                                            <div class="dropdown-menu" style='height: 45vh;overflow-y: scroll;'>
                                                <a class="dropdown-item filtro_categoria" id_categoria='TODO' href="javascript:void(0);">TODO</a>
                                                <?=$this->listar_presentacion;?>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" id="btndefault"  class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                <span class="sr-only">Toggle Dropdown</span>
                                                Lineas
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btndefault" style='height: 45vh;overflow-y: scroll;'>
                                                <a class="dropdown-item filtro_lineas" id_linea='TODO' href="javascript:void(0);">TODO</a>
                                                <?=$this->listar_lineas;?>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                            </div>
                        </div>
                        <!-- ITEMS -->
                        <div class="widget-content searchable-container mt-3 list">
                            <div class="searchable-items grid " id="items_widgets" style="height: 70vh;overflow-y: scroll;">
                               

                               <!-- ============================================
                                                  Items de la compra
                                    ============================================-->

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-12 layout-spacing widget widget-card-four_2">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                            <tr>
                                                <th>Detalle Producto</th>
                                                <th>Stock Actual</th>
                                                <th>Stock Nuevo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_productos">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row m-2">
                                    <div class="col-sm-12 col-md-4 ">
                                        <button class="btn btn-outline-danger  mb-4 mr-2 btn-lg btn-block" onclick="limpiar_venta()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                             Limpiar
                                        </button>
                                    </div>
                                    <div class="col-sm-12 col-md-8 ">
                                        <button class="btn btn-success mb-4 mr-2 btn-lg btn-block" onclick="procesar_traspaso()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>    
                                            Ajustar
                                        </button>
                                    </div>
                                </div>
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
    </div>
    <!-- END MAIN CONTAINER -->
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
    <div class="modal fade" id="modal_comprobante" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="<?=SERVERURL;?>archives/assets/pos/factura.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <div class="btn-group mb-4" role="group" aria-label="Basic example">
                        <a href="#" id="formato_a4" target="_blank" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            A4
                        </a>
                        <a href="#" id="formato_a5" target="_blank" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            A5
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
    <!-- MODALS -->
    <div class="modal fade" id="modal_no_almacen" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <img src="<?=SERVERURL;?>archives/assets/pos/no_almacen.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary mb-4" data-dismiss="modal" aria-label="Close">
                        Seleccionar un almac��n
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="modal_procesas_ajuste" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group mb-4 col-sm-12">
                            <label for="razon_social">Motivo (*)</label>
                            <textarea class="form-control" name="motivo" id="motivo" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                    <button type="button" class="btn btn-success" id='btn_ajustar'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>    
                        Ajustar
                    </button>
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
    <!-- MODAL -->
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

    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
    <script>

/* ------------------------ Almacen general for modal ----------------------- */
        let id_almacen_page = "";
/* ========================================================================== */
/*                   Verificar si la pagina ya esta cargada                   */
/* ========================================================================== */
        $(document).ready(function(){
            $("#view_inventario, #vista_ajuste_inventario").addClass("active");
            let modal = "<?=$_SESSION["sucursal"]?>";
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            // $("#view_pos").addClass("active");
            listaproductos();
            var s2 = $("#cliente").select2({
                tags: true,
            });
            
            lista_de_tirajes_de_comprobante();
            $("#descuento_global").TouchSpin({
                min: 0,
                max : 100,
                step:0.1,
                decimals:2
            });
            let caja = "<?=$_SESSION["caja"]?>";
            if(caja == 0){
                $("#modal_no_caja").modal('show');
            }
        });

/* ========================================================================== */
/*                       Listar productos de la sucursal                      */
/* ========================================================================== */

        let listaproductos = function(){
            let id = "<?=$_SESSION['sucursal']?>";
            var block = $("#items_widgets");
            $(block).block({ 
                message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Cargando Productos...</span>',
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
            $.post("<?=SERVERURL;?>ventas/lista_productos_sucursal/",{id},function(respuesta){
                if(respuesta != ""){
                    $("#items_widgets").html(respuesta);
                    $(".touchs").TouchSpin({
                        min: 0,
                        max : 99999999999,
                        step:0.1,
                        decimals:2
                    });
                    $(".touchs_discounts").TouchSpin({
                        min: 0,
                        max : 100,
                        step:0.1,
                        decimals:2
                    });
                }else{
                    let templeate = `
                        <div class="alert alert-arrow-right alert-icon-right alert-light-info mb-4" role="alert" style="width: 90%;height: 50px;margin: auto;margin-top: 10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                            <strong>SIN STOCK!</strong> No hay productos en esa presentacion.
                        </div>
                    `;
                    $("#items_widgets").html(templeate);
                }
            });
        }

/* ========================================================================== */
/*               Funcion agregar producto al carrito de compras               */
/* ========================================================================== */

        $(document).on('click','.btn_agregar',function(){
            let id_item = $(this).val();
            if(document.getElementById("item_list"+id_item)){
                Snackbar.show({
                    text: 'El producto ya esta en la lista',
                    actionTextColor: '#fff',
                    backgroundColor: '#e91e63',
                    pos: 'top-right'
                });
                return false;
            }else{
                let articulo = $("#item_"+id_item).attr('articulo');
                let presentacion = $("#item_"+id_item).attr('presentacion');
                let producto = $("#item_"+id_item).attr('producto');
                let almacen = $("#item_"+id_item).attr('almacen');
                let lote = $("#item_"+id_item).attr('lote');
                let linea = $("#item_"+id_item).attr('linea');
                let stock = $("#item_"+id_item).attr('stock');
                let exento = $("#item_"+id_item).attr('exento');
                let precio = $("#PRICE_"+id_item).val();
                let descuento = $("#DESCU_"+id_item).val();
                let value_descuento = precio*descuento/100;
                let total = precio-value_descuento
                htmlproducto(id_item,articulo,1,precio,descuento,total.toFixed(2),linea,stock,exento,producto,almacen,lote);
            }
        });

/* ========================================================================== */
/*                 Funcion de estrucutura de lista de carrito                 */
/* ========================================================================== */

        let htmlproducto=function(id_item,articulo,cantidad,precio,descuento,total,linea,stock,exento,producto,almacen,lote){
            let tr = "\
                <tr id='item_list"+id_item+"' class='items_tr' id_item='"+id_item+"' stock='"+stock+"' exento='"+exento+"' producto='"+producto+"' almacen='"+almacen+"'>\
                    <td>"+articulo+" | <span style='color: #03a9f4;font-weight: 600;'>"+linea+"</span> | <span style='color: #FF9800;font-weight: 600;'>"+lote+"</span></td>\
                    <td class='text-center'>"+stock+"</td>\
                    <td><input id='"+id_item+"cantidad_nueva' type='text' value='"+stock+"'></td>\
                    <td class='x_td' item='"+id_item+"' style='cursor: pointer;transition: all 0.5s; font-weight: bolder;color: #1b55e2;padding: 10px;border-radius: 10px;'>X</td>\
                </tr>\
            ";
            $("#body_productos").prepend(tr);
            $("#"+id_item+"cantidad_nueva").TouchSpin({
                min:0,
                max:9999999999999
            });
            sumarprecios_carrito();
        }

/* ========================================================================== */
/*          Funcion sumar precios de los items del carrito de compras         */
/* ========================================================================== */

        function sumarprecios_carrito(){
            var items = $('#body_productos .items_tr').length;

            var suma = 0;
            var exentos = 0;
            var exentos_price = 0;
            var porcentajeiva = 18;
            var iva = 0;
            var subtotal = 0;
            var retencion = 0;
            var total = 0;
            for (i = 1; i < items + 1; i++){
                var id_item = $('#body_productos .items_tr:nth-child('+i+')').attr('id_item');
                var exento = $('#body_productos .items_tr:nth-child('+i+')').attr('exento');
                var cantidad = $('#'+id_item+'_carrito_cantidad').val();
                var descuento = $('#'+id_item+"_carrito_descuento").val();
                cantidad = parseFloat(cantidad);
                descuento = parseFloat(descuento);
                var total_producto = 0;
                var subtotal_producto = 0;
                if(cantidad<1){
                    $("#item_list"+id_item).remove();
                }else{
                    var precio = $("#"+id_item+"_carrito_precio").val();
                    if(exento==1){
                        exentos++;
                        precio = parseFloat(precio);
                        subtotal_producto = parseFloat(cantidad*precio);
                        descuento = parseFloat(subtotal_producto*descuento/100);
                        total_producto = parseFloat(subtotal_producto-descuento);
                        exentos_price += parseFloat(total_producto);
                        $("#descuento_producto_"+id_item).text(descuento.toFixed(2));
                        $("#sub_total_producto_"+id_item).text(subtotal_producto.toFixed(2));
                        $("#precio_item_total_"+id_item).text(total_producto.toFixed(2));
                    }else{
                        precio = parseFloat(precio);
                        subtotal_producto = parseFloat(cantidad*precio);
                        descuento = parseFloat(subtotal_producto*descuento/100);
                        total_producto = parseFloat(subtotal_producto-descuento);
                        suma += parseFloat(total_producto);
                        $("#descuento_producto_"+id_item).text(descuento.toFixed(2));
                        $("#sub_total_producto_"+id_item).text(subtotal_producto.toFixed(2));
                        $("#precio_item_total_"+id_item).text(total_producto.toFixed(2));
                    }
                }
            };
            if(suma>0){
                iva = parseFloat(suma*porcentajeiva/100);
            }
            exentos_price = parseFloat(exentos_price)
            subtotal = suma+iva;
            retencion = subtotal-suma;
            let descuento_porcentaje = $("#descuento_global").val();
            total = parseFloat(subtotal+exentos_price-retencion);
            descuento_porcentaje = total*descuento_porcentaje/100;
            total = total-descuento_porcentaje;
            $("#precio_descuento").text(descuento_porcentaje.toFixed(2));
            $('#total_price').text(total.toFixed(2));
            $('#sub_total_price').text(subtotal.toFixed(2));
            $('#retencion_price').text(retencion.toFixed(2));
            $('#exento_price').text(exentos_price.toFixed(2));
            $('#n_exento').text(exentos);
            $('#cant_iva').text(iva.toFixed(2));
            $("#suma_price").text(suma.toFixed(2));
        }

/* ========================================================================== */
/*                           Funcion  procesar venta                          */
/* ========================================================================== */
        function procesar_traspaso (){
            var items = $('#body_productos .items_tr').length;
            if(items < 1){
                Snackbar.show({
                    text: 'No hay productos para proceder en el ajuste de inventarios',
                    actionTextColor: '#fff',
                    backgroundColor: '#e91e63',
                    pos: 'top-right'
                });
                return false;
            }else{
                $('#modal_procesas_ajuste').modal('show');
            }
        }

/* ========================================================================== */
/*            Detectar presion de tecla "Enter" para procesar venta           */
/* ========================================================================== */

        $(document).on('keypress',function(e){
            if(e.which == 13) {
                procesar_traspaso();
            }
        });

/* ========================================================================== */
/*      Evitar refrescamiento de pagina a travez de la busqueda producto      */
/* ========================================================================== */

        $("#form-product-search").submit(function(e){
            e.preventDefault();
        });

/* ========================================================================== */
/*                        Lista de tirajes disponibles                        */
/* ========================================================================== */

        let lista_de_tirajes_de_comprobante = function(){
            let token = "<?=$_SESSION["sucursal"]?>";
            $.post("<?=SERVERURL;?>ventas/lista_de_tirajes_de_comprobante/",{token},function(response){
                $("#tipo_comprobante").html(response);
            });
        }

/* ========================================================================== */
/*                              Realizar traspaso                             */
/* ========================================================================== */

        $("#btn_ajustar").click(function(){
            let motivo = $("#motivo").val();
            if(motivo.length == 0){
                Snackbar.show({
                    text: 'El motivo del ajuste es necesario',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $("#motivo").focus();
            }else{
                let productos =  lista_productos_carrito();
                $.post("<?=SERVERURL?>inventario/ajustarinventarios/",{
                    productos,motivo
                },function(response){
                    if(response == 0){
                        Snackbar.show({
                            text: 'No se pudo realizar el ajuste',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                    }else{
                        let resd = response.split("|");
                        if(resd[0]== 1){
                            Snackbar.show({
                                text: 'Ajuste de inventario realizado correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            limpiar_venta();
                            $("#modal_procesas_ajuste").modal("hide");
                            $("#formato_a4").attr('href',"<?=SERVERURL;?>inventario/ajusteformatoA4/"+resd[1]);
                            $("#formato_a5").attr('href',"<?=SERVERURL;?>inventario/ajusteformatoA5/"+resd[1]);
                            $("#modal_comprobante").modal('show');
                        }else{
                            Snackbar.show({
                                text: 'Hubo un problema, al procesar el ajuste de inventarios',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                    }
                });
            }
        });

/* ========================================================================== */
/*                       Obtener el cambio de la compra                       */
/* ========================================================================== */

        $(document).on('blur','#efectivo_recibido',function(){
            let efectivo_recibido = $("#efectivo_recibido").val();
            let monto_a_pagar = parseFloat($("#monto_a_pagar").val());
            if( efectivo_recibido.length == 0){
                Snackbar.show({
                    text: 'Monto recibido invalido',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $("#efectivo_recibido").val("");
                return false;
            }else{
                efectivo_recibido = parseFloat(efectivo_recibido);
                if(efectivo_recibido >= monto_a_pagar){
                    let cambio = parseFloat(efectivo_recibido - monto_a_pagar);
                    let valor = parseFloat($(this).val());
                    $("#efectivo_recibido").val(valor.toFixed(2));
                    $("#cambio_venta").val(cambio.toFixed(2));
                }else{
                    Snackbar.show({
                        text: 'Monto recibido invalido',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    $("#efectivo_recibido").val("");
                    return false;
                }
            }
        })
        $(document).on('blur','#descuento_global',function(){
            sumarprecios_carrito();
        });

/* ========================================================================== */
/*                        Lista de productos en carrito                       */
/* ========================================================================== */

        const lista_productos_carrito = ()=>{
            let data = "";
            var items = $('#body_productos .items_tr').length;
            for (i = 1; i < items + 1; i++){
                let id_item = $('#body_productos .items_tr:nth-child('+i+')').attr('id_item');
                let stock = $('#body_productos .items_tr:nth-child('+i+')').attr('stock');
                let cantidad = $("#"+id_item+"cantidad_nueva").val();
                data += id_item+'|'+stock+'|'+cantidad+',';
            };
            return data;
        }

/* ========================================================================== */
/*                         Funcion de limipar ventana                         */
/* ========================================================================== */

        function limpiar_venta(){
            listaproductos();
            let cambio = $("#cambio_venta").val("0.00");
            let suma_price = $("#suma_price").text("0.00");
            let motivo = $("#motivo").text("");
            let descuento_percent = $("#descuento_global").val("0.00");
            let precio_descuento = $("#precio_descuento").text("0.00");
            let n_exento = $("#n_exento").text("0");
            let exento_price = $("#exento_price").text("0.00");
            let retencion_price = $("#retencion_price").text("0.00");
            let sub_total_price = $("#sub_total_price").text("0.00");
            let cant_iva = $("#cant_iva").text("0.00");
            let total_price = $("#total_price").text("0.00");
            let table_carrito = $("#body_productos").html("");
        }

/* ========================================================================== */
/*                           Filtro por presentacion                          */
/* ========================================================================== */

        $(document).on('click','.filtro_categoria',function(){
            let categoria = $(this).attr("id_categoria");
            let sucursal = "<?=$_SESSION['sucursal']?>";
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
            $.post('<?=SERVERURL;?>ventas/listar_items_sucursal_presentacion/',{sucursal,categoria},function(response){
                if(response != ""){
                    $("#items_widgets").html(response);
                    $(".touchs").TouchSpin({
                        min: 0,
                        max : 999999999999999999,
                        step:0.1,
                        decimals:2
                    });
                    $(".touchs_discounts").TouchSpin({
                        min: 0,
                        max : 100,
                        step:0.1,
                        decimals:2
                    });
                }else{
                    let templeate = `
                        <div class="alert alert-arrow-right alert-icon-right alert-light-info mb-4" role="alert" style="width: 90%;height: 50px;margin: auto;margin-top: 10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                            <strong>SIN STOCK!</strong> No hay productos en esa presentacion.
                        </div>
                    `;
                    $("#items_widgets").html(templeate);
                }
            });
        })
        $(document).on('click','.filtro_lineas',function(){
            let linea = $(this).attr("id_linea");
            let sucursal = "<?=$_SESSION['sucursal']?>";
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
            $.post('<?=SERVERURL;?>ventas/listar_items_sucursal_linea/',{sucursal,linea},function(response){
                if(response != ""){
                    $("#items_widgets").html(response);
                    $(".touchs").TouchSpin({
                        min: 0,
                        max : 9999999999999,
                        step:0.1,
                        decimals:2
                    });
                    $(".touchs_discounts").TouchSpin({
                        min: 0,
                        max : 100,
                        step:0.1,
                        decimals:2
                    });
                }else{
                    let templeate = `
                        <div class="alert alert-arrow-right alert-icon-right alert-light-info mb-4" role="alert" style="width: 90%;height: 50px;margin: auto;margin-top: 10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                            <strong>SIN STOCK!</strong> No hay productos en esa linea.
                        </div>
                    `;
                    $("#items_widgets").html(templeate);
                }
            });
        })
        $(document).on('click','.x_td',function(){
            let item = $(this).attr('item');
            if($("#item_list"+item).remove()){
                sumarprecios_carrito();
            }
            
        });
    </script>


</body>
</html>