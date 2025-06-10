<?php
    session_name('B_POS');
    session_start();
    if (!isset($_SESSION["usuario"])) {
        echo '<script> window.location.href="' . SERVERURL . 'login/" ;</script>';
    }
    $preventa_informacion = $this->preventa_informacion;
    $datos_cliente = $this->datos_cliente;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Devolucion </title>
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
    
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=SERVERURL;?>view/assets/assets/css/elements/tooltip.css" rel="stylesheet" type="text/css" />
    
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
                    <div class="card-pos col-lg-8" id="table-card">
                        <!-- INPUT SEARCH -->
                        <div class="widget-content searchable-container grid">
                            <div class="row mt-2">
                                <div class="col-xl-9 col-lg-7 col-md-7 col-sm-8 filtered-list-search mb-2">
                                    <form autocomplete="off" class="" id="form-product-search" action="#">
                                        <div class="" style="width: -webkit-fill-available;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <input type="text" class="form-control" id="input-search" placeholder="Buscar los productos">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-3 col-lg-5 col-md-5 col-sm-4 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                       
                                    </div>
                               </div>
                            </div>
                        </div>
                        <!-- ITEMS -->
                        <div class="widget-content searchable-container mt-3 list">
                            <div class="searchable-items grid " id="items_widgets" style="height: 100vh;overflow-y: scroll;">

                               <!-- ============================================
                                                  Items de la compra
                                    ============================================-->

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-12 layout-spacing">
                        <div class="widget widget-card-four_2">
                            <div class="widget-content">
                                <div class="row p-4">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary w-100 mb-2 p-3 bs-tooltip" data-toggle="tooltip" data-html="true" title="Cualquier modificación ha esta preventa, obligatoriamente debe ser sincronizada." onclick="abrir_modal_detalle()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                            GUARDAR DEVOLUCION
                                        </button>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content">
                                            <div class="w-info mb-2">
                                                <h6 class="value"><span>$</span><span id="suma_price"><?=$preventa_informacion["SUMAS"]?></span></<h6>
                                                <p class="">SUMAS</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content">
                                            <div class="w-info mb-2">
                                                <h6 class="value"><span>$</span><span id="cant_iva"><?=$preventa_informacion["IVA"]?></span></<h6>
                                                <p class="">IVA%</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-percent"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content">
                                            <div class="w-info mb-2">
                                                <h6 class="value"><span>$</span><span id="sub_total_price"><?=$preventa_informacion["SUBTOTAL"]?></span></<h6>
                                                <p class="">SUBTOTAL</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content">
                                            <div class="w-info mb-2">
                                                <h6 class="value"><span>$</span><span id="retencion_price"><?=$preventa_informacion["RETENIDO"]?></span></<h6>
                                                <p class="">RET. 1%(-)</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg>                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content">
                                            <div class="w-info mb-2">
                                                <h6 class="value"><span>$</span><span id="exento_price"><?=$preventa_informacion["EXENTO"]?></span></<h6>
                                                <p class="">EXENTO</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content">
                                            <div class="w-info mb-2">
                                                <h6 class="value"><span id="n_exento"><?=$preventa_informacion["PROD_EXENTOS"]?></span></<h6>
                                                <p class="">PROD. EXENTOS</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content mb-2">
                                            <div class="w-info">
                                                <h6 class="value"><span>$</span><span id="precio_descuento"><?=$preventa_informacion["DESCUENTO"]?></span></<h6>
                                                <p class="">DESCUENTO</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-percent"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 pt-2" style="border: 1px dashed #2196F3;border-radius: 6px;">
                                        <div class="w-content mb-2">
                                            <div class="w-info">
                                                <h6 class="value"><span>$</span><span id="total_price"><?=$preventa_informacion["TOTAL"]?></span></<h6>
                                                <p class="">TOTAL</p>
                                            </div>
                                            <div class="">
                                                <div class="w-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12 mt-2">
                                        <div class="form-group almacen">
                                            <label for="descuento_global">Descuento</label>
                                            <input type="text" name="descuento_global" class = 'touchs' value='<?=$preventa_informacion["DESCUENTO_PERCENT"]?>' id="descuento_global">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mt-2 almacen">
                                            <label for="almacen">Almacén</label>
                                            <select class="form-control  basic" id="almacen">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h6 style="color: #b5b8c9;">Precios disponibles</h6>
                                        <div class="row justify-content-center">
                                            <?php
                                                for ($i=1; $i <=7 ; $i++) { 
                                            ?>
                                            <div class="col-3">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio new-radio-text radio-classic-info">
                                                        <input type="radio" class="new-control-input rb_precios" <?php $checked = ($preventa_informacion["PRECIO_RADIO"]==$i) ? "checked" : "" ; echo $checked; ?>  value='<?=$i?>'name="precios_venta">
                                                        <span class="new-control-indicator"></span>
                                                        <span class="new-radio-content text-center">Precio <?=$i?></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
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
    <div class="modal animated fadeInDown" id="modals_productos" tabindex="-1" role="dialog" aria-labelledby="Modal_extralarge_productos" aria-modal="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Modal_extralarge_productos">Lista de productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body" id='md_productos'>
                    <div class="table-responsive mt-4 mb-4" >
                        <table id="productos_stock" class="table style-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Cod/Barra</th>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>U.M</th>
                                    <th>Linea</th>
                                    <th>Presentacion</th>
                                    <th class="text-center">Precio 4</th>
                                    <th>Stock</th>
                                    <th>Lote</th>
                                    <th>Fecha</th>
                                    <th>Cant.</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="lista_de_productos">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cod/Barra</th>
                                    <th class="invisible">Imagen</th>
                                    <th>Producto</th>
                                    <th>UM</th>
                                    <th>Linea</th>
                                    <th>Presentacion</th>
                                    <th>Precio 4</th>
                                    <th>Stock</th>
                                    <th>Lote</th>
                                    <th>Fecha</th>
                                    <th class="invisible">> Cant.</th>
                                    <th class="invisible">Accion</th>
                                </tr>
                            </tfoot>
                        </table>
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
                            A4
                        </a>
                       <a id="formato_qr" href="#" target='_blank' class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            FACTURA
                        </a>
                        <a id="formato_a5" href="#" target='_blank' class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            A5
                        </a>
                        <a id="membrete" href="#" target='_blank' class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>    
                            MEMBRETE
                        </a>
                        <a href="<?=SERVERURL?>preventa/consultapreventas/" class="btn btn-success" >
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
                        Seleccionar un almacén
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="modal_procesar_venta" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-12" id="observacion_2222">
                            <div class="form-group">
                                <label for="observacion">Observacion</label>
                                <textarea class="form-control form-control-sm" id="observacion" >SIN DATO</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                    <button type="button" class="btn btn-success" onclick="sincronizar_preventa()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        Guardar
                    </button>
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
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/input-mask.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>

/* ------------------------ Almacen general for modal ----------------------- */
    let id_almacen_page = "";
/* ========================================================================== */
/*                   Verificar si la pagina ya esta cargada                   */
/* ========================================================================== */
        $(document).ready(function(){
            cargar_producto_preventa()
            $("#view_preventa, #vista_consulta_preventas").addClass("active");
            let modal = "<?=$_SESSION["sucursal"]?>";
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            let caja = "<?=$_SESSION["caja"]?>";
            if(caja == 0){
                $("#modal_no_caja").modal('show');
            }

            /* ----------- Traer lista de almacenes disponibles en la sucursal ---------- */
            listaalmacenes();
            var s1 = $("#almacen").select2({
                tags: true,
            });
            lista_de_tirajes_de_comprobante();
            lista_clientes();
            option_metodo_pago();
            $("#descuento_global").TouchSpin({
                step:0.1,
                decimals:2,
                prefix: '%',
            });
            let valor = $("#venta_facturar").val();
            if(valor==1){
                $("#venta_facturar").css('background','red'); 
                $("#venta_facturar").css('color','white'); 
            }else{
                $("#venta_facturar").css('background','green'); 
                $("#venta_facturar").css('color','white'); 
            }
        });
         $(document).on('change','#venta_facturar',function(){
            let valor = $("#venta_facturar").val();
            if(valor==1){
                $(this).css('background','red'); 
                $(this).css('color','white'); 
            }else{
                $(this).css('background','green'); 
                $(this).css('color','white'); 
            }
           
        });
        function abrir_modal_detalle(){
            $("#modal_procesar_venta").modal('show');
        }
/* ========================================================================== */
/*                         Agregar producto a la venta                        */
/* ========================================================================== */

        $(document).on('click','.btn_agregar',function(){
            let id = $(this).val();
            let stock = $(this).attr('stock');
            let cantidad = $("#txt_"+id).val();
            if(document.getElementById("item_"+id)){
                Snackbar.show({
                    text: 'El producto ya esta agregado a la lista',
                    actionTextColor: '#fff',
                    backgroundColor: '#5c1ac3',
                    pos: 'top-right'
                });
                return false;
            }else{
                if(cantidad.length <= 0 || isNaN(cantidad)){
                    Snackbar.show({
                        text: 'Agrega un valor válido',
                        actionTextColor: '#fff',
                        backgroundColor: '#5c1ac3',
                        pos: 'top-right'
                    });
                }else{
                    cantidad = parseInt(cantidad);
                    stock = parseInt(stock);
                    if(cantidad>stock){
                        Snackbar.show({
                            text: 'El stock de este producto es insuficiente para su petición',
                            actionTextColor: '#fff',
                            backgroundColor: '#5c1ac3',
                            pos: 'top-right'
                        });
                        return false;
                    }else{
                        var block = $("#table-card");
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
                        $.post("<?=SERVERURL;?>ventas/buscarproducto_venta/",{id,cantidad},function(response){
                            Snackbar.show({
                                text: 'Producto agregado a la lista de venta',
                                actionTextColor: '#fff',
                                backgroundColor: '#f79628',
                                pos: 'top-right'
                            });
                            $("#txt_"+id).val("");
                            $('#items_widgets').prepend(response);
                            $(".touchs_precios").TouchSpin({
                                step:0.01,
                                decimals:2,
                                max : 99999999999999999999999999
                            });
                            $("#cantidad_"+id).TouchSpin({
                                min: 0,
                                max : stock
                            });
                            $("#descuento_"+id).TouchSpin({
                                step:0.1,
                                decimals:2,
                                prefix: '%',
                            });
                            sumarprecio();
                            $(block).unblock();
                        });
                    }
                }
            }
        });

        let option_metodo_pago = function(){
            let metodo_pago = $("#metodo_pago").val();
            let montoa_a_pagar = $("#monto_a_pagar").val();
            if(metodo_pago == 1){
                $("#cont_monto_a_pagar").fadeIn();
                $("#efectivo_recibido").prop('disabled',false);
                $("#cont_efectivo_recibido").fadeIn();
                $("#cont_cambio_venta").fadeIn();
                $("#cont_tarjeta_debito_credito").fadeOut();
                $("#cont_tarjetahabitante").fadeOut();
                $("#cont_monotodebitado").fadeOut();
                $("#efectivo_recibido").val("0.00");
                $("#cambio_venta").val("0.00");
                $("#monotodebitado").val("0.00");
                $("#tarjetahabitante").val("");
                $("#tarjeta_debito_credito").val("");
            }else if(metodo_pago == 2){
                $("#efectivo_recibido").prop('disabled',true);
                $("#cont_monto_a_pagar").fadeIn();
                $("#cont_efectivo_recibido").fadeIn();
                $("#cont_cambio_venta").fadeIn();
                $("#cont_tarjeta_debito_credito").fadeIn();
                $("#cont_tarjetahabitante").fadeIn();
                $("#cont_monotodebitado").fadeIn();
                $("#monotodebitado").prop('disabled',true);
                $("#monotodebitado").val(montoa_a_pagar);
                $("#efectivo_recibido").val("0.00");
                $("#tarjetahabitante").val("");
                $("#cambio_venta").val("0.00");
                $("#tarjeta_debito_credito").val("");
            }else if(metodo_pago == 3){
                $("#tarjetahabitante").val("");
                $("#cont_monto_a_pagar").fadeIn();
                $("#cont_efectivo_recibido").fadeIn();
                $("#cont_cambio_venta").fadeIn();
                $("#cont_tarjeta_debito_credito").fadeIn();
                $("#cont_tarjetahabitante").fadeIn();
                $("#cont_monotodebitado").fadeIn();
                $("#monotodebitado").prop('disabled',false);
                $("#efectivo_recibido").prop('disabled',false);
                $("#monotodebitado").val("0.00");
                $("#efectivo_recibido").val("0.00");
                $("#cambio_venta").val("0.00");
                $("#tarjeta_debito_credito").val("");
            }
        }
        $("#metodo_pago").change(function(){
            option_metodo_pago();
        });
/* ========================================================================== */
/*                         Lista almacenes disponibles                        */
/* ========================================================================== */

        let listaalmacenes = function(){
            let sucursal = "<?=$_SESSION["sucursal"]?>";
            $.post('<?=SERVERURL;?>ventas/lista_almacenes/',{sucursal},function(response){
                $("#almacen").html(response);
            });
        }

/* ========================================================================== */
/*                    Detectar el cambio de precios y sumar                   */
/* ========================================================================== */

        $(".rb_precios").click(function(){
            sumarprecio();
        });

/* ========================================================================== */
/*               Funcion sumar precios de los articulos en lista              */
/* ========================================================================== */

        let sumarprecio = function(){
            let precio_radio = $('input:radio[name=precios_venta]:checked').val();
            var items = $('#items_widgets .items').length;
            var suma = 0;
            var exentos = 0;
            var exentos_price = 0;
            var porcentajeiva = 18;
            var iva = 0;
            var subtotal = 0;
            var retencion = 0;
            var total = 0;
            //recorrer los items de la caja
            for (i = 1; i < items + 1; i++){

                // capturar el id del producto
                var id_item = $('#items_widgets .items:nth-child('+i+')').attr('id_item');
                var exento = $('#items_widgets .items:nth-child('+i+')').attr('exento');
                var cantidad = $('#cantidad_'+id_item).val();
                var descuento = $('#descuento_'+id_item).val();
                cantidad = parseFloat(cantidad);
                descuento = parseFloat(descuento);
                var total_producto = 0;
                var subtotal_producto = 0;
                if(cantidad<1){
                    $("#item_"+id_item).remove();
                }else{
                    var precio = $("#precio_"+precio_radio+"_"+id_item).val();
                    if(exento==1){
                        exentos++;
                        precio = parseFloat(precio);
                        subtotal_producto = parseFloat(cantidad*precio);
                        
                        total_producto = parseFloat(subtotal_producto-descuento);
                        exentos_price += parseFloat(total_producto);
                        $("#descuento_producto_"+id_item).text(descuento.toFixed(2));
                        $("#sub_total_producto_"+id_item).text(subtotal_producto.toFixed(2));
                        $("#total_producto_"+id_item).text(total_producto.toFixed(2));
                    }else{
                        precio = parseFloat(precio);
                        subtotal_producto = parseFloat(cantidad*precio);
                       
                        total_producto = parseFloat(subtotal_producto-descuento);
                        suma += parseFloat(total_producto);
                        $("#descuento_producto_"+id_item).text(descuento.toFixed(2));
                        $("#sub_total_producto_"+id_item).text(subtotal_producto.toFixed(2));
                        $("#total_producto_"+id_item).text(total_producto.toFixed(2));
                    }
                }
            };
            if(suma>0){
                iva = parseFloat(suma*porcentajeiva/100);
            }
            exentos_price = parseFloat(exentos_price)
            subtotal = suma+iva;
            retencion = subtotal-suma;
            let descuento_porcentaje = parseFloat($("#descuento_global").val());
            total = parseFloat(subtotal+exentos_price-retencion);
           
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
/*          Sumar precios si se aumento la cantidad de algun producto         */
/* ========================================================================== */

        $(document).on('click','.bootstrap-touchspin-up',function(){
            sumarprecio();
        });

/* ========================================================================== */
/*           Sumar precios si se resto la cantidad de algun producto          */
/* ========================================================================== */

        $(document).on('click','.bootstrap-touchspin-down',function(){
            sumarprecio();
        });

/* ========================================================================== */
/*                     Evitar el refrezcamiento de pagina                     */
/* ========================================================================== */

        $("#form-product-search").submit(function(e){
            e.preventDefault();
        });

/* ========================================================================== */
/*                          Abrir modal de productos                          */
/* ========================================================================== */
    $("#btn_productos").click(function(){
        let id = $("#almacen").val();
        if(id_almacen_page == id){
            $("#modals_productos").modal('show');
        }else{
            var block = $("#md_productos");
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
            $.post('<?=SERVERURL;?>ventas/productos_almacen/',{id},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay productos disponibles, cambie de almacén',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });

                    let table = $("#productos_stock").DataTable();
                    table.destroy();
                    $("#lista_de_productos").html("");
                    $('#productos_stock tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    } );
                    let c2 = $('#productos_stock').DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sZeroRecords": "No hay coincidencias",
                            "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                            "sSearch": '',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultados :  _MENU_",
                            "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered":   "(filtrado de _MAX_ entradas totales)",
                        },
                        "lengthMenu": [5, 10, 20, 50,100],
                        "pageLength": 20
                    });
                    // Aplicar la busqueda
                    c2.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                    $('.bs-tooltip').tooltip();
                    $(block).unblock();
                    id_almacen_page = id;
                }else{
                    let table = $("#productos_stock").DataTable();
                    table.destroy();
                    $("#lista_de_productos").html(response);
                    $('#productos_stock tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    } );
                    let c2 = $('#productos_stock').DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sZeroRecords": "No hay coincidencias",
                            "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                            "sSearch": '',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultados :  _MENU_",
                            "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered":   "(filtrado de _MAX_ entradas totales)",
                        },
                        "lengthMenu": [5, 10, 20, 50,100],
                        "pageLength": 20
                    });
                    // Aplicar la busqueda
                    c2.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                    $('.bs-tooltip').tooltip();
                    $(block).unblock();
                    $("#modals_productos").modal('show');
                    id_almacen_page = id;
                }
            });
        }
    });

/* ========================================================================== */
/*                              Procesar la venta                             */
/* ========================================================================== */
    $("#btn_procesar_compra").click(function(){
        var items = $('#items_widgets .items').length;
        if(items < 1){
            Snackbar.show({
                text: 'No hay producto para proceder en la venta',
                actionTextColor: '#fff',
                backgroundColor: '#e91e63',
                pos: 'top-right'
            });
            return false;
        }else{
            sincronizar_preventa();
            let total = $("#total_price").text();
            $("#monto_a_pagar").val(total);
            $('#modal_procesar_venta').modal('show');
        }
    });
/* ========================================================================== */
/*                    Limpiar pantalla para una nueva venta                   */
/* ========================================================================== */
        let clean_windows = function(){
            $("#suma_price").text("0.00");
            $("#cant_iva").text("0.00");
            $("#sub_total_price").text("0.00");
            $("#retencion_price").text("0.00");
            $("#precio_descuento").text("0.00");
            $("#exento_price").text("0.00");
            $("#n_exento").text("0");
            $("#descuento_global").val("0");
            $("#observaciones").val("");
            $("#total_price").text("0.00");
            $("#items_widgets").html("");
            $("#cliente").prop('selectedIndex',0);

            let id = $("#almacen").val();
            $.post('<?=SERVERURL;?>ventas/productos_almacen/',{id},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay productos disponibles, cambie de almacen',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });

                    let table = $("#productos_stock").DataTable();
                    table.destroy();
                    $("#lista_de_productos").html("");
                    $('#productos_stock tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    } );
                    let c2 = $('#productos_stock').DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sZeroRecords": "No hay coincidencias",
                            "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                            "sSearch": '',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultados :  _MENU_",
                            "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered":   "(filtrado de _MAX_ entradas totales)",
                        },
                        "lengthMenu": [5, 10, 20, 50,100],
                        "pageLength": 20
                    });
                    // Aplicar la busqueda
                    c2.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                    $('.bs-tooltip').tooltip();
                    // $(block).unblock();
                    id_almacen_page = id;
                }else{
                    let table = $("#productos_stock").DataTable();
                    table.destroy();
                    $("#lista_de_productos").html(response);
                    $('#productos_stock tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    } );
                    let c2 = $('#productos_stock').DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sZeroRecords": "No hay coincidencias",
                            "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                            "sSearch": '',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultados :  _MENU_",
                            "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered":   "(filtrado de _MAX_ entradas totales)",
                        },
                        "lengthMenu": [5, 10, 20, 50,100],
                        "pageLength": 20
                    });
                    // Aplicar la busqueda
                    c2.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                    $('.bs-tooltip').tooltip();
                    $(block).unblock();
                    id_almacen_page = id;
                }
            });
        }

/* ========================================================================== */
/*                      Buscar un cambio en los touchspin                     */
/* ========================================================================== */
        $(document).on('blur','.touchs',function(){
            sumarprecio();
        })
/* ========================================================================== */
/*                     Enviar y agregar datos del cliente                     */
/* ========================================================================== */
        $("#modal_cliente").submit(function(e){
            e.preventDefault();
            let razon_social = $("#razon_social").val();
            let nro_documento = $("#nro_documento").val();
            let nro_cuenta = $("#nro_cuenta").val();
            let limite_crediticio = $("#limite_crediticio").val();
            let creditos_activos = $("#creditos_activos").val();
            if(razon_social.length<1){
                Snackbar.show({
                    text: 'Complete la razón social',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                return false;
            }else if($("#tipo_documento").val() == null){
                Snackbar.show({
                    text: 'Seleccione el tipo de documento',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(nro_documento.length<1){
                Snackbar.show({
                    text: 'El número de documento no puede estar vacío',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(isNaN(limite_crediticio) || limite_crediticio.length<1){
                Snackbar.show({
                    text: 'El limite crediticio es obligatorio',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(isNaN(creditos_activos) || creditos_activos.length<1){
                Snackbar.show({
                    text: 'El número de creditos activos es obligatorio',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else{
                var block = $("#modal_cliente_load");
                $(block).block({
                    message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Guardando...</span>',
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
                var Form = new FormData(document.forms.namedItem("form_cliente"));
                $.ajax({
                    url: "<?=SERVERURL;?>cliente/guardar_cliente/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data == 1){
                            Snackbar.show({
                                text: 'El cliente se agrego correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            $("#modal_cliente")[0].reset();
                            $(block).unblock();
                            lista_clientes();
                        }else{
                            Snackbar.show({
                                text: 'No se pudo agregar el cliente',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            $(block).unblock();
                        }
                    }
                });
            }
        });

/* ========================================================================== */
/*                         Lista de clientes en select                        */
/* ========================================================================== */
        let lista_clientes = function(){
            let tocken = "Lista mis clientes";
            $.post("<?=SERVERURL;?>cliente/listaclientesselect/",{tocken},function(response){
                $("#cliente").html(response);
            });
        }
/* ========================================================================== */
/*                               Facturar venta                               */
/* ========================================================================== */
        $("#btn_facturar").click(function(){
            let id_cliente = $("#id_cliente_venta").val();
            let id_cliente_creditos_venta = $("#id_cliente_creditos_venta").val();
            let id_cliente_creditolimite_venta = $("#id_cliente_creditolimite_venta").val();
            let limite_credito_venta = $("#limite_credito_venta").val();
            let monto_a_pagar = parseFloat($("#monto_a_pagar").val());
            let tipo_pago = $("#tipo_pago").val();
            let tipo_comprobante = $("#tipo_comprobante").val();
            let metodo_pago = $("#metodo_pago").val();
            let fecha_limite = $("#fecha_limite").val();
            let venta_facturar = $("#venta_facturar").val();
            if(id_cliente.length <1 || id_cliente_creditos_venta.length<1 || id_cliente_creditolimite_venta.length <1 || limite_credito_venta.length <1){
                Snackbar.show({
                    text: 'No se encontró un cliente seleccione uno',
                    actionTextColor: '#fff',
                    backgroundColor: '#e91e63',
                    pos: 'top-right'
                });
                return false;
            }else if(tipo_pago == null){
                Snackbar.show({
                    text: 'Seleccionar un tipo de pago',
                    actionTextColor: '#fff',
                    backgroundColor: '#e91e63',
                    pos: 'top-right'
                });
                return false;
            }else{
                let efectivo_recibido = parseFloat($("#efectivo_recibido").val());
                let tarjeta_debito_credito = $("#tarjeta_debito_credito").val();
                let tarjetahabitante = $("#tarjetahabitante").val();
                let monotodebitado = $("#monotodebitado").val();
                if(tipo_pago == 2){
                    if(id_cliente_creditolimite_venta<1 || monto_a_pagar > limite_credito_venta){
                        Snackbar.show({
                            text: 'El cliente no cumple con los requisitos para la venta a credito',
                            actionTextColor: '#fff',
                            backgroundColor: '#e91e63',
                            pos: 'top-right'
                        });
                        return false;
                    }else if(id_cliente_creditos_venta>=id_cliente_creditolimite_venta ){
                        Snackbar.show({
                            text: 'El cliente excedió el límite de ventas a credito',
                            actionTextColor: '#fff',
                            backgroundColor: '#e91e63',
                            pos: 'top-right'
                        });
                        return false;
                    }
                    if(fecha_limite.length <= 0){
                        Snackbar.show({
                            text: 'La fecha límite es obligatoria',
                            actionTextColor: '#fff',
                            backgroundColor: '#e91e63',
                            pos: 'top-right'
                        });
                        return false;
                    }
                }else if(tipo_pago == 1){
                    if(metodo_pago == 1){
                        if(efectivo_recibido.length<1 || isNaN(efectivo_recibido) || efectivo_recibido < monto_a_pagar){
                            Snackbar.show({
                                text: 'El efectivo recibido es obligatorio',
                                actionTextColor: '#fff',
                                backgroundColor: '#e91e63',
                                pos: 'top-right'
                            });
                            return false;
                        }
                    }else if(metodo_pago == 2){
                        if(tarjeta_debito_credito.length <1 || tarjetahabitante.length <1){
                            Snackbar.show({
                                text: 'Los datos de la tarjeta son obligatorias',
                                actionTextColor: '#fff',
                                backgroundColor: '#e91e63',
                                pos: 'top-right'
                            });
                            return false;
                        }
                    }else if(metodo_pago == 3){
                        if (tarjeta_debito_credito.length <1 || tarjetahabitante.length <1){
                            Snackbar.show({
                                text: 'Los datos de la tarjeta son obligatorias',
                                actionTextColor: '#fff',
                                backgroundColor: '#e91e63',
                                pos: 'top-right'
                            });
                            return false;
                        }else if(efectivo_recibido >= monto_a_pagar || monotodebitado <= 0){
                            Snackbar.show({
                                text: 'El efectivo recivido y el monto debitado deben ser validos',
                                actionTextColor: '#fff',
                                backgroundColor: '#e91e63',
                                pos: 'top-right'
                            });
                            return false;
                        }
                    }
                }
                if(tipo_comprobante == null){
                    Snackbar.show({
                        text: 'El comprobante es obligatorio',
                        actionTextColor: '#fff',
                        backgroundColor: '#e91e63',
                        pos: 'top-right'
                    });
                    return false;
                }else{
                    id_cliente = "<?=$datos_cliente["ID_CLIENTE"]?>";
                    let id_preventa = "<?=$this->id_preventa;?>";
                    let cambio = $("#cambio_venta").val();
                    let descuento_percent = $("#descuento_global").val();
                    let precio_descuento = $("#precio_descuento").text();
                    let n_exento = $("#n_exento").text();
                    let exento_price = $("#exento_price").text();
                    let retencion_price = $("#retencion_price").text();
                    let sub_total_price = $("#sub_total_price").text();
                    let cant_iva = $("#cant_iva").text();
                    let suma_price = $("#suma_price").text();
                    var items = $('#items_widgets .items').length;
                    var data = '';
                    let precio_radio = $('input:radio[name=precios_venta]:checked').val();
                    let observacion = $('#observacion').val();

                    for (i = 1; i < items + 1; i++){
                        let id_item = $('#items_widgets .items:nth-child('+i+')').attr('id_item');
                        let almacen = $('#items_widgets .items:nth-child('+i+')').attr('almacen');
                        let stock = $('#items_widgets .items:nth-child('+i+')').attr('stock');
                        let producto = $('#items_widgets .items:nth-child('+i+')').attr('producto');
                        let cantidad = $("#cantidad_"+id_item).val();
                        let descuento = $("#descuento_"+id_item).val();
                        let precio = $("#precio_"+precio_radio+"_"+id_item).val();
                        let descuento_producto = $("#descuento_producto_"+id_item).text();
                        let sub_total_producto_ = $("#sub_total_producto_"+id_item).text();
                        let total_producto = $("#total_producto_"+id_item).text();
                        data += id_item+'|'+almacen+'|'+cantidad+'|'+descuento+'|'+precio+'|'+descuento_producto+'|'+sub_total_producto_+'|'+total_producto+'|'+stock+'|'+producto+',';
                    };
                    let nrofactura = $("#nrofactura").val();
                    let nombrepromotor = $("#nombrepromotor").val();
                    $.post("<?=SERVERURL;?>preventa/hacer_venta/",{
                    venta_facturar,id_preventa,id_cliente,monto_a_pagar,efectivo_recibido,cambio,descuento_percent,
                    precio_descuento,n_exento,exento_price,retencion_price,sub_total_price,
                    cant_iva,suma_price,tarjeta_debito_credito,tarjetahabitante,monotodebitado,
                    tipo_comprobante,tipo_pago,metodo_pago,data,fecha_limite,observacion,precio_radio,nrofactura,nombrepromotor
                    },function(response){
                        if(response == 3){
                            swal({
                                title: 'Preventa ya procesada!',
                                text: 'La preventa no puede ser modificada',
                                imageUrl: '<?=SERVERURL;?>archives/assets/pos/error_preventa.jpg',
                                imageWidth: 400,
                                imageHeight: 200,
                                imageAlt: 'Error preventa',
                                animation: false,
                                padding: '2em',
                                animation: false,
                                customClass: 'animated tada',
                                padding: '2em'
                            });
                        }else{
                            let resd = response.split("|");
                            if(resd[0]== 1){
                                Snackbar.show({
                                    text: 'Venta realizada correctamente',
                                    actionTextColor: '#fff',
                                    backgroundColor: '#8dbf42',
                                    pos: 'top-right'
                                });
                                $("#modal_procesar_venta").modal("hide");
                                $("#formato_a4").attr('href',"<?=SERVERURL;?>ventas/formatoA4/"+resd[1]);
                                $("#formato_qr").attr('href',"<?=SERVERURL;?>ventas/ticketqr/"+resd[1]);
                                $("#formato_a5").attr('href',"<?=SERVERURL;?>ventas/formatoA5/"+resd[1]);
                                $("#membrete").attr('href',"<?=SERVERURL;?>ventas/membrete/"+resd[1]);
                                $("#modal_comprobante").modal('show');
                              
                            }else{
                                Snackbar.show({
                                    text: 'Hubo un problema, al procesar la venta',
                                    actionTextColor: '#fff',
                                    backgroundColor: '#e7515a',
                                    pos: 'top-right'
                                });
                            }
                        }
                    });
                }
            }
        });

/* ========================================================================== */
/*                        Cargar productos prevnedidos                        */
/* ========================================================================== */

        let cargar_producto_preventa = ()=>{
            let id_preventa = "<?=$this->id_preventa;?>";
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
            $.post("<?=SERVERURL?>preventa/lista_items_preventa/",{id_preventa},function(response){
                if($('#items_widgets').html(response)){
                    agregar_spinner_prevendidos();
                    sumarprecio();
                }   
            });
        }

/* ========================================================================== */
/*                   Agregar sppiner a productos prevendidos                  */
/* ========================================================================== */

        let agregar_spinner_prevendidos = () =>{
            let precio_radio = $('input:radio[name=precios_venta]:checked').val();
            var items = $('#items_widgets .items').length;
            //recorrer los items de la caja
            for (i = 1; i < items + 1; i++){
                // capturar el id del producto
                var id_item = $('#items_widgets .items:nth-child('+i+')').attr('id_item');
                var stock = $('#items_widgets .items:nth-child('+i+')').attr('stock');

                $('#cantidad_'+id_item).TouchSpin({
                    min: 1,
                    max : stock
                });
                $('#descuento_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    prefix: '%',
                });
                $('#precio_1_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 9999999999999999999999999999999999999999
                });
                $('#precio_2_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 99999999999999999999999999999999999999
                });
                $('#precio_3_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 99999999999999999999999999999999
                });
                $('#precio_4_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 999999999999999
                });
                $('#precio_5_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 999999999999999
                });
                $('#precio_6_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 999999999999999
                });
                $('#precio_7_'+id_item).TouchSpin({
                    step:0.10,
                    decimals:2,
                    max : 999999999999999
                });
            };
        }

/* ========================================================================== */
/*                        Eliminar producto prevendido                        */
/* ========================================================================== */
let self = this
        $(document).on('click','.btn_eliminar_producto_prevendido',function(){
            let cantidad_prevendida = $(this).attr("cantidad_prevendida");
            let id_preventa = $(this).attr("id_preventa");
            let id_detalle = $(this).attr("id_detalle");
            let id_item = $(this).attr("id_item");
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success btn-rounded',
                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                buttonsStyling: false,
            });

            swalWithBootstrapButtons({
                title: 'Estas seguro?',
                text: "Este cambio no es reversible!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminarlo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true,
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.post("<?=SERVERURL?>preventa/eliminar_producto_prevendido_2/",{id_item,id_preventa,id_detalle,cantidad_prevendida},function(response){
                        if(response == 3){
                            swal({
                                title: 'Preventa ya procesada!',
                                text: 'La preventa no puede ser modificada',
                                imageUrl: '<?=SERVERURL;?>archives/assets/pos/error_preventa.jpg',
                                imageWidth: 400,
                                imageHeight: 200,
                                imageAlt: 'Error preventa',
                                animation: false,
                                customClass: 'animated tada',
                                padding: '2em'
                            });
                        }else if(response == 2){
                            swalWithBootstrapButtons(
                                'No se pudo eliminar!',
                                'Debes eliminar por completo la preventa',
                                'success'
                            );
                        }else{
                            swalWithBootstrapButtons(
                                'Eliminado!',
                                'El producto regreso a inventario',
                                'success'
                            );
                            cargar_producto_preventa();
                        }
                    });
                }else if (
                result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelado',
                        'Todo en orden :)',
                        'error'
                )
                }
            });
        });

/* ========================================================================== */
/*                            Sincronizar preventa                            */
/* ========================================================================== */

        let sincronizar_preventa = ()=>{
            let suma_price = $("#suma_price").text();
            let cant_iva = $("#cant_iva").text();
            let sub_total_price = $("#sub_total_price").text();
            let retencion_price = $("#retencion_price").text();
            let precio_descuento = $("#precio_descuento").text();
            let exento_price = $("#exento_price").text();
            let n_exento = $("#n_exento").text();
            let descuento_global = $("#descuento_global").val();
            let observacion = $("#observacion").val();
            let total_price = $("#total_price").text();
            let id_preventa = "<?=$this->id_preventa;?>";
            let precio_radio = $('input:radio[name=precios_venta]:checked').val();
            var items = $('#items_widgets .items').length;
            //recorrer los items de la caja
            let data = "";
            for (i = 1; i < items + 1; i++){
                // capturar el id del producto
                var producto_preventa = $('#items_widgets .items:nth-child('+i+')').attr('producto_preventa');
                let id_item = $('#items_widgets .items:nth-child('+i+')').attr('id_item');
                let almacen = $('#items_widgets .items:nth-child('+i+')').attr('almacen');
                let stock = $('#items_widgets .items:nth-child('+i+')').attr('stock');
                let producto = $('#items_widgets .items:nth-child('+i+')').attr('producto');
                let cantidad = $("#cantidad_"+id_item).val();
                let descuento = $("#descuento_"+id_item).val();
                let precio_1 = $("#precio_1_"+id_item).val();
                let precio_2 = $("#precio_2_"+id_item).val();
                let precio_3 = $("#precio_3_"+id_item).val();
                let precio_4 = $("#precio_4_"+id_item).val();
                let descuento_producto = $("#descuento_producto_"+id_item).text();
                let sub_total_producto_ = $("#sub_total_producto_"+id_item).text();
                let total_producto = $("#total_producto_"+id_item).text();
                data += id_item+'|'+almacen+'|'+cantidad+'|'+descuento+'|'+precio_1+'|'+precio_2+'|'+precio_3+'|'+precio_4+'|'+descuento_producto+'|'+sub_total_producto_+'|'+total_producto+'|'+stock+'|'+producto+'|'+producto_preventa+',';
            };
            $.post("<?=SERVERURL?>preventa/actualizar_preventa_2/",
                {data,id_preventa,suma_price,cant_iva,sub_total_price,retencion_price,observacion,
                precio_descuento,exento_price,n_exento,descuento_global,total_price,
                precio_radio},function(response){
                    if(response==1){
                        Snackbar.show({
                            text: 'Preventa sincronizada con exito!',
                            actionTextColor: '#fff',
                            backgroundColor: '#8BC34A',
                            pos: 'top-right'
                        });
                        productos_almacen();
                        cargar_producto_preventa();
                        window.location.href = '<?=SERVERURL;?>preventa/consultapreventas/';
                    }else if(response == 3){
                        swal({
                            title: 'Preventa ya procesada!',
                            text: 'La preventa no puede ser modificada',
                            imageUrl: '<?=SERVERURL;?>archives/assets/pos/error_preventa.jpg',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Error preventa',
                            animation: false,
                            customClass: 'animated tada',
                            padding: '2em'
                        });
                        
                    }else{
                        Snackbar.show({
                            text: 'Hubo un error',
                            actionTextColor: '#fff',
                            backgroundColor: '#e91e63',
                            pos: 'top-right'
                        });
                    }
            });
        }
        let lista_de_tirajes_de_comprobante = function(){
            let token = "<?=$_SESSION["sucursal"]?>";
            $.post("<?=SERVERURL;?>ventas/lista_de_tirajes_de_comprobante/",{token},function(response){
                $("#tipo_comprobante").html(response);
            });
        }
        $(document).on('blur','#efectivo_recibido',function(){
            var metodo_pago = $("#metodo_pago").val();
            var tipo_pago = $("#tipo_pago").val();
            if(metodo_pago == 1 && tipo_pago == 1){
                let efectivo_recibido = parseFloat($("#efectivo_recibido").val());
                let monto_a_pagar = parseFloat($("#monto_a_pagar").val());
                if(efectivo_recibido.length < 1 || isNaN(efectivo_recibido) || efectivo_recibido<monto_a_pagar){
                    Snackbar.show({
                        text: 'El efectivo recibido no es validó',
                        actionTextColor: '#fff',
                        backgroundColor: '#e91e63',
                        pos: 'top-right'
                    });
                    $("#efectivo_recibido").val("0.00");
                    return false;
                }else{
                    let valor = parseFloat($(this).val());
                    $("#efectivo_recibido").val(valor.toFixed(2));
                    let cambio = parseFloat(efectivo_recibido - monto_a_pagar);
                    $("#cambio_venta").val(cambio.toFixed(2));
                }
            }else if(metodo_pago==3){
                let efectivo_recibido = parseFloat($("#efectivo_recibido").val());
                let monto_a_pagar = parseFloat($("#monto_a_pagar").val());
                if(efectivo_recibido.length < 1 || isNaN(efectivo_recibido) || efectivo_recibido > monto_a_pagar){
                    Snackbar.show({
                        text: 'El efectivo recibido no es validó',
                        actionTextColor: '#fff',
                        backgroundColor: '#e91e63',
                        pos: 'top-right'
                    });
                    $("#efectivo_recibido").val("0.00");
                    $("#monotodebitado").val("0.00");
                    $("#cambio_venta").val("0.00");
                    return false;
                }else{
                    let efectivo_recibido = parseFloat($("#efectivo_recibido").val());
                    let monto_a_pagar = parseFloat($("#monto_a_pagar").val());
                    let cambio = parseFloat( monto_a_pagar-efectivo_recibido);
                    let valor = parseFloat($(this).val());
                    $("#efectivo_recibido").val(valor.toFixed(2));
                    $("#monotodebitado").val(cambio.toFixed(2));
                    $("#cambio_venta").val("0.00");
                }
            }
        });
        $("#tipo_pago").change(function(){
            let valor = $(this).val();
            if(valor == 1){
                $(".efectivo").prop('disabled',false);
                $("#metodo_pago").prop('disabled',false);
                $("#fecha_limite").prop('disabled',true);
                $("#efectivo_recibido").val("0.00");
                $("#monotodebitado").val("0.00");
            }else if(valor == 2){
                $("#fecha_limite").prop('disabled',false);
                $(".efectivo").prop('disabled',true);
                $("#metodo_pago").prop('disabled',true);
                $("#efectivo_recibido").val("0.00");
                $("#cont_monto_a_pagar").fadeIn();
                $("#efectivo_recibido").prop('disabled',true);
                $("#cont_efectivo_recibido").fadeIn();
                $("#cont_cambio_venta").fadeIn();
                $("#cont_tarjeta_debito_credito").fadeOut();
                $("#cont_tarjetahabitante").fadeOut();
                $("#cont_monotodebitado").fadeOut();
                $("#monotodebitado").val("0.00");
                $("#tarjetahabitante").val("");
                $("#tarjeta_debito_credito").val("");
            }
        });
        let productos_almacen = () =>{
            let id = $("#almacen").val();
            $.post('<?=SERVERURL;?>ventas/productos_almacen/',{id},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay productos disponibles, cambie de almacen',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });

                    let table = $("#productos_stock").DataTable();
                    table.destroy();
                    $("#lista_de_productos").html("");
                    $('#productos_stock tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    } );
                    let c2 = $('#productos_stock').DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sZeroRecords": "No hay coincidencias",
                            "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                            "sSearch": '',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultados :  _MENU_",
                            "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered":   "(filtrado de _MAX_ entradas totales)",
                        },
                        "lengthMenu": [5, 10, 20, 50,100],
                        "pageLength": 20
                    });
                    // Aplicar la busqueda
                    c2.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                    $('.bs-tooltip').tooltip();
                    // $(block).unblock();
                    id_almacen_page = id;
                }else{
                    let table = $("#productos_stock").DataTable();
                    table.destroy();
                    $("#lista_de_productos").html(response);
                    $('#productos_stock tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    } );
                    let c2 = $('#productos_stock').DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sZeroRecords": "No hay coincidencias",
                            "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                            "sSearch": '',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultados :  _MENU_",
                            "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                            "sInfoEmpty":      "Mostrando 0 a 0 de 0 entradas",
                            "sInfoFiltered":   "(filtrado de _MAX_ entradas totales)",
                        },
                        "lengthMenu": [5, 10, 20, 50,100],
                        "pageLength": 20
                    });
                    // Aplicar la busqueda
                    c2.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );
                    $('.bs-tooltip').tooltip();
                    $(block).unblock();
                    id_almacen_page = id;
                }
            });
        }
    </script>


</body>
</html>