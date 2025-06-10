<?php
    session_name('B_POS');
    session_start();
    date_default_timezone_set(ZONEDATE);
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
    <title><?=SISTEMA_NOMBRE;?> - Consulta cotizaciones </title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >
    
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?=SERVERURL;?>view/assets/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .card-header section > div:not(.collapsed) {
            color: #1b55e2;
            font-weight: 600;
        }
        .accordion-icons .accordion-icon {
            display: inline-block;
            margin-right: 10px;
        }
        .accordion-icons div:not(.collapsed) .accordion-icon svg {
            color: #1b55e2;
            fill: rgba(27, 85, 226, 0.23921568627450981);
        }
        .card-header section > div .icons {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            padding: 9px;
        }
        .mtable > thead > tr > th {
            border: 1px solid #7b7b7b5c;
        }
        .text_detalle {
            color: #54596f;
        }
        .dt-button-collection{
            margin-top:100px
        }
        .form-control-w {
    height: auto;
    border: 1px solid #21b73e;
    color: #eff1ff;
    font-size: 15px;
    padding: 8px 10px;
    letter-spacing: 1px;
    height: calc(1.4em + 1.4rem + 2px);
    padding: .75rem 1.25rem;
    border-radius: 6px;
}
.form-control-w {
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #207630;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-control-w {
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #ffffff;
    background-color: #207630;
    background-clip: padding-box;
    border: 2px solid #28a745;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-control-w {
    height: auto;
    border: 1px solid #21b73e;
    color: #eff1ff;
    font-size: 15px;
    padding: 8px 10px;
    letter-spacing: 1px;
    height: calc(1.4em + 1.4rem + 2px);
    padding: .75rem 1.25rem;
}
    </style>
</head>
<body class="alt-menu sidebar-noneoverflow">
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
            
                <div class="row layout-top-spacing justify-content-md-center">
                    <div class="col-12" >
                        <div class="page-header mb-3">
                            <div class="page-title">
                                <h3> Consulta de cotizaciones</h3>
                            </div>
                        </div>
                        <div class="statbox widget box box-shadow" id="card">
                            <div class="widget-content widget-content-area">
                                <div class="row" style="padding: 15px;">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" placeholder='2020-06-13' name="date_1" id="date_1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" placeholder='2020-07-12' name="date_2" id="date_2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-success mb-2 w-100" id="btn_consultar" style="height: 45px;width: 45px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        Consultar
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id='table_compras' class="table w-100">
                                            <thead class='bg-primary'>
                                                <tr>
                                                    <th class='text-white'>Cotizacion</th>
                                                    <th class='text-white'>Fecha</th>
                                                    <th class='text-white'>Tipo de pago</th>
                                                    <th class='text-white'>Total</th>
                                                    <th class='text-white'>Cliente</th>
                                                    <th class='text-white'>Documento Cliente</th>
                                                    <th class='text-white'>Tipo entrega</th>
                                                    <th class='text-white'>Vendedor</th>
                                                    <th class='text-white'>Estado</th>
                                                    <th class='text-white'>Opciones</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody id="body_table">
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Cotizacion</th>
                                                    <th>Fecha</th>
                                                    <th>Tipo de pago</th>
                                                    <th>Total</th>
                                                    <th>Cliente</th>
                                                    <th>Documento</th>
                                                    <th>Tipo entrega</th>
                                                    <th>Vendedor</th>
                                                    <th>Estado</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </tfoot>
                                        </table> 
                                        
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
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    <!-- Modals -->
    <div id="modal_detalle_compra" class="modal animated slideInUp custo-slideInUp" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content"  id='loader_detail' style="zoom: 1;">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de cotizaciòn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="iconsAccordion" class="accordion-icons">
                        <div class="card">
                            <div class="card-header" id="headingOne3">
                                <section class="mb-0 mt-0">
                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionOne" aria-expanded="false" aria-controls="iconAccordionOne">
                                        <div class="accordion-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>                                        
                                        </div>
                                        Información de la cotización 
                                        <div class="icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div id="iconAccordionOne" class="collapse" aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                <div class="card-body">
                                    <table class="table table-bordered mb-4 mtable" >
                                        <thead>
                                            <tr>
                                                <th>Fecha Cotización</th>
                                                <th style="color: #425665;" id="date_detalle"></th>
                                                <th>Forma Pago</th>
                                                <th style="color: #425665;" id="tipo_pago_detalle"></th>
                                            </tr>
                                            <tr>
                                                <th>A Nombre de</th>
                                                <th style="color: #425665;" id="proveedor_detalle"></th>
                                                <th id="tipo_documento_detalle"></th>
                                                <th style="color: #425665;" id="nro_documento_detalle"></th>
                                            </tr>
                                            <tr>
                                                <th>Nro. Cotización</th>
                                                <th style="color: #425665;" id="nro_detalle"></th>
                                                <th>Total</th>
                                                <th style="color: #425665;" id="total_cotizacio_detalle"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped mb-4">
                            <thead class="bg-primary">
                                <tr>
                                    <th class='text-white'>Codigo barra</th>
                                    <th class='text-white'>Producto</th>
                                    <th class='text-white'>Linea</th>
                                    <th class='text-white'>Presentación</th>
                                    <th class='text-white'>Cantidad</th>
                                    <th class='text-white'>Precio</th>
                                    <th class='text-white'>SubTotal</th>
                                    <th class='text-white'>Descuento</th>
                                    <th class='text-white'>Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_detalle_productos">

                            </tbody>
                            <tfoot >
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>SUMAS</th>
                                    <th class='text-center' id="sumas_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>IVA%</th>
                                    <th class='text-center' id="iva_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>SUBTOTAL</th>
                                    <th class='text-center' id="subtotal_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>RET. 1%</th>
                                    <th class='text-center' id="ret_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>T. EXENTO</th>
                                    <th class='text-center' id="exento_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>DESCUENTO</th>
                                    <th class='text-center' id="descuento_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='6' class='text-primary text-right'>TOTAL</th>
                                    <th class='text-center' id="total_detalle">0</th>
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
    <div id="modal_enviar" class="modal animated slideInUp custo-slideInUp" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content"  id='loader_detail' style="zoom: 1;">
                <div class="modal-header">
                    <h5 class="modal-title">Enviar Whatsapp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body" style="
    background: #55cd6c;
">
                    <div class="row">
                        <div class="col-12  text-center">
                            <img src="<?=SERVERURL;?>view/assets/svg/whatsapp-2.svg" style="width: 50px" alt="">
                        </div>
                        <div class="col-sm-4 col-12 ">
                           <div class="form-group">
                            <label for="" class="text-white">Codigo</label>
                            <input id="codigo" value="591" type="text" class="form-control-w">
                           </div>
                        </div>
                        <div class="col-sm-8 col-12 ">
                           <div class="form-group">
                            <label for="" class="text-white">Telefono</label>
                            <input id="telefono" type="text" class="form-control-w">
                           </div>
                        </div>
                        <div class="col-sm-12 col-12 ">
                          <button  class="btn btn-dark w-100 " id="btn_enviar">ENVIAR</button>
                        </div>
                    </div>
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
    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
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
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/ui-accordions.js"></script>
       <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/assets/js/scrollspyNav.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/pdfmake.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>
    
     <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
     <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function(){
            let modal = "<?=$_SESSION["sucursal"]?>";
            var f1 = flatpickr(document.getElementById('date_1'));
            var f2 = flatpickr(document.getElementById('date_2'));
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            mytable();
            $("#view_cotizacion, #vista_ver_cotizacion").addClass("active");

        });

/* ========================================================================== */
/*                               Lista de compras                             */
/* ========================================================================== */

        let mytable = function(){
            var block = $("#card");
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
            let sucursal = "<?=$_SESSION["sucursal"]?>";
            $.post("<?=SERVERURL;?>cotizacion/lista_cotizaciones/",{sucursal},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay cotizaciones disponibles',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    $(block).unblock();
                }else{
                    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                        var found = false;

                        var table = $("#table_compras").DataTable();
                        var row = table.row(dataIndex).node();
                        var checked = $('input[name="chk_box"]').prop("checked");

                        if (checked && $(row).find("input").prop("checked")) {
                        return false;
                        }

                        return true;
                    });
                    let table = $("#table_compras").DataTable();
                    table.destroy();
                    
                    $("#body_table").html(response);

                    c2 = $('#table_compras').DataTable({
                        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                        buttons: {
                            buttons: [
                                { 
                                    extend: 'csv', 
                                    className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{ 
                                    extend: 'excel', 
                                    className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{ 
                                    extend: 'pdfHtml5', 
                                    title : "REPORTE DE COTIZACIONES - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
                                    className: 'btn',
                                    orientation :'landscape',
                                    pageSize:'A4',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{
                                    extend: 'colvis',
                                    className:'btn'}
                            ]
                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api();
                            n_columnas = api.columns().nodes().length;
                            var j = 3;
                            while(j < n_columnas){
                                var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0 );
                            //Actualizar Footer
                            $( api.column( j ).footer() ).html("Total <?=$_SESSION['moneda']?> "+total_filtro.toFixed(2));
                                j++;
                            } 


                            $(api.column(0).footer()).html("");
                            $(api.column(1).footer()).html("");
                            $(api.column(2).footer()).html("");
                            $(api.column(4).footer()).html("");
                            $(api.column(5).footer()).html("");
                            $(api.column(6).footer()).html("");
                            $(api.column(7).footer()).html("");
                            $(api.column(8).footer()).html("");
                            $(api.column(9).footer()).html("");

                            
                        },

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
                        "lengthMenu": [500, 1000, 2000, 5000],
                        "pageLength": 500,
                    });
                    $(block).unblock(); 
                    multiCheck(c2);
                }
            });
        }
    </script>
    <script>

/* ========================================================================== */
/*                       Consulta detalle de cotizacion                       */
/* ========================================================================== */

        $(document).on('click','.btn_detalle',function(){
            let id = $(this).attr('id_c');
            var block = $("#loader_detail");
            $(block).block({ 
                message: '',
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
            $.post("<?=SERVERURL?>cotizacion/detalle_cotizacion/",{id},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'Hubo un problema presione F5',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }else{
                    let resd = response.split("|");
                    if(resd[0]== 1){
                        $("#date_detalle").text(resd[1]);
                        $("#tipo_pago_detalle").text(resd[2]);
                        $("#proveedor_detalle").text(resd[3]);
                        $("#tipo_documento_detalle").text(resd[4]);
                        $("#nro_documento_detalle").text(resd[5]);
                        $("#nro_detalle").text(resd[6]);
                        $("#total_cotizacio_detalle").text(resd[12]);
                        $("#sumas_detalle").text(resd[7]);
                        $("#iva_detalle").text(resd[8]);
                        $("#subtotal_detalle").text(resd[9]);
                        $("#ret_detalle").text(resd[10]);
                        $("#exento_detalle").text(resd[11]);
                        $("#total_detalle").text(resd[12]);
                        $("#descuento_detalle").text(resd[13]);
                        $.post("<?=SERVERURL?>cotizacion/detallecotizacion_item/",{id},function(respuesta){
                            if(response != 0 ){
                                $("#tbody_detalle_productos").html(respuesta);
                                $(block).unblock();
                                $("#modal_detalle_compra").modal('show');
                            }
                        });
                    }else{
                        Snackbar.show({
                            text: 'Hubo un problema, al procesar la petición',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                    }
                }
            });
        });

/* ========================================================================== */
/*                          Consulta de cotizaciones                          */
/* ========================================================================== */

        $("#btn_consultar").click(function(){
            let fecha_1 = $("#date_1").val();
            let fecha_2 = $("#date_2").val();
            let sucursal = "<?=$_SESSION["sucursal"]?>";
            if(fecha_1.length <1 || fecha_2.length <1){
                Snackbar.show({
                    text: 'Las 2 fechas son obligatorias',
                    actionTextColor: '#fff',
                    backgroundColor: '#1b55e2',
                    pos: 'top-right'
                });
                return false;
            }else{
                if(fecha_2<fecha_1 || fecha_1>fecha_2){
                    Snackbar.show({
                        text: 'El rango de fechas no es valida',
                        actionTextColor: '#fff',
                        backgroundColor: '#1b55e2',
                        pos: 'top-right'
                    });
                    return false;
                }else{
                    var block = $("#card");
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
                    $.post("<?=SERVERURL;?>cotizacion/lista_cotizaciones_fecha/",{fecha_1,fecha_2,sucursal},function(response){
                        if(response == 0 ){
                            Snackbar.show({
                                text: 'No hay cotizaciones disponibles en ese rango de fechas',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            let table = $("#table_compras").DataTable();
                            table.destroy();
                            $("#body_table").html("");
                            c2 = $('#table_compras').DataTable({
                                dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                buttons: {
                                    buttons: [
                                        { 
                                            extend: 'csv', 
                                            className: 'btn',
                                            exportOptions: {
                                                columns: [ 0, ':visible' ]
                                            },footer:true
                                        },{ 
                                            extend: 'excel', 
                                            className: 'btn',
                                            exportOptions: {
                                                columns: [ 0, ':visible' ]
                                            },footer:true
                                        },{ 
                                            extend: 'pdfHtml5', 
                                            title : "REPORTE DE COTIZACIONES - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
                                            className: 'btn',
                                            orientation :'landscape',
                                            pageSize:'A4',
                                            exportOptions: {
                                                columns: [ 0, ':visible' ]
                                            },footer:true
                                        },{
                                            extend: 'colvis',
                                            className:'btn'}
                                    ]
                                },
                                "footerCallback": function ( row, data, start, end, display ) {
                                    var api = this.api();
                                    n_columnas = api.columns().nodes().length;
                                    var j = 3;
                                    while(j < n_columnas){
                                        var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                        return parseFloat(a) + parseFloat(b);
                                    }, 0 );
                                    //Actualizar Footer
                                    $( api.column( j ).footer() ).html("Total <?=$_SESSION['moneda']?> "+total_filtro.toFixed(2));
                                        j++;
                                    } 


                                    $(api.column(0).footer()).html("");
                                    $(api.column(1).footer()).html("");
                                    $(api.column(2).footer()).html("");
                                    $(api.column(4).footer()).html("");
                                    $(api.column(5).footer()).html("");
                                    $(api.column(6).footer()).html("");
                                    $(api.column(7).footer()).html("");
                                    $(api.column(8).footer()).html("");
                                    $(api.column(9).footer()).html("");
                                    
                                },

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
                                "lengthMenu": [500, 1000, 2000, 5000],
                                "pageLength": 500,
                            });
                            $(block).unblock(); 
                            multiCheck(c2);
                        }else{
                            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                                var found = false;

                                var table = $("#example").DataTable();
                                var row = table.row(dataIndex).node();
                                var checked = $('input[name="chk_box"]').prop("checked");

                                if (checked && $(row).find("input").prop("checked")) {
                                return false;
                                }

                                return true;
                            });
                            let table = $("#table_compras").DataTable();
                            table.destroy();
                            $("#body_table").html(response);
                            c2 = $('#table_compras').DataTable({
                                dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                                buttons: {
                                    buttons: [
                                        { 
                                            extend: 'csv', 
                                            className: 'btn',
                                            exportOptions: {
                                                columns: [ 0, ':visible' ]
                                            },footer:true
                                        },{ 
                                            extend: 'excel', 
                                            className: 'btn',
                                            exportOptions: {
                                                columns: [ 0, ':visible' ]
                                            },footer:true
                                        },{ 
                                            extend: 'pdfHtml5', 
                                            title : "REPORTE DE COTIZACIONES - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
                                            className: 'btn',
                                            orientation :'landscape',
                                            pageSize:'A4',
                                            exportOptions: {
                                                columns: [ 0, ':visible' ]
                                            },footer:true
                                        },{
                                            extend: 'colvis',
                                            className:'btn'}
                                    ]
                                },
                                "footerCallback": function ( row, data, start, end, display ) {
                                    var api = this.api();
                                    n_columnas = api.columns().nodes().length;
                                    var j = 3;
                                    while(j < n_columnas){
                                        var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                        return parseFloat(a) + parseFloat(b);
                                    }, 0 );
                                    //Actualizar Footer
                                    $( api.column( j ).footer() ).html("Total <?=$_SESSION['moneda']?> "+total_filtro.toFixed(2));
                                        j++;
                                    } 


                                    $(api.column(0).footer()).html("");
                                    $(api.column(1).footer()).html("");
                                    $(api.column(2).footer()).html("");
                                    $(api.column(4).footer()).html("");
                                    $(api.column(5).footer()).html("");
                                    $(api.column(6).footer()).html("");
                                    $(api.column(7).footer()).html("");
                                    $(api.column(8).footer()).html("");
                                    $(api.column(9).footer()).html("");

                                    
                                },

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
                                "lengthMenu": [500, 1000, 2000, 5000],
                                "pageLength": 500,
                            });
                            $(block).unblock(); 
                            multiCheck(c2);
                        }
                    });
                }
            }
        });

/* ========================================================================== */
/*                          Ver detalle de cotizacion                         */
/* ========================================================================== */

        $(document).on('click','.btn_detalle',function(){
            let id = $(this).attr('id_c');
            var block = $("#loader_detail");
            $(block).block({ 
                message: '',
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
            $.post("<?=SERVERURL?>cotizacion/detalle_cotizacion/",{id},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'Hubo un problema presione F5',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }else{
                    let resd = response.split("|");
                    if(resd[0]== 1){
                        $("#date_detalle").text(resd[1]);
                        $("#tipo_pago_detalle").text(resd[2]);
                        $("#proveedor_detalle").text(resd[3]);
                        $("#tipo_documento_detalle").text(resd[4]);
                        $("#nro_documento_detalle").text(resd[5]);
                        $("#nro_detalle").text(resd[6]);
                        $("#total_cotizacio_detalle").text(resd[12]);
                        $("#sumas_detalle").text(resd[7]);
                        $("#iva_detalle").text(resd[8]);
                        $("#subtotal_detalle").text(resd[9]);
                        $("#ret_detalle").text(resd[10]);
                        $("#exento_detalle").text(resd[11]);
                        $("#total_detalle").text(resd[12]);
                        $("#descuento_detalle").text(resd[13]);
                        $.post("<?=SERVERURL?>cotizacion/detallecotizacion_item/",{id},function(respuesta){
                            if(response != 0 ){
                                $("#tbody_detalle_productos").html(respuesta);
                                $(block).unblock();
                                $("#modal_detalle_compra").modal('show');
                            }
                        });
                    }else{
                        Snackbar.show({
                            text: 'Hubo un problema, al procesar la petición',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                    }
                }
            });
        });
        $(document).on('click','.btn_anular',function(){
            let id_cotizacion = $(this).attr("id_cotizacion");
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success btn-rounded',
                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                buttonsStyling: false,
            });

            swalWithBootstrapButtons({
                title: 'Estas seguro?',
                text: "Es irrevertible el cambio si anulas la cotizacion!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, anular!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true,
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.post("<?=SERVERURL?>cotizacion/eliminar_cotizacion/",{id_cotizacion},function(response){
                        const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            padding: '2em'
                        });
                        if(response == 1){
                            toast({
                                type: 'success',
                                title: 'Cotizacion anulada correctamente',
                                padding: '2em',
                            });
                            mytable();
                        }else{
                            toast({
                                type: 'error',
                                title: 'Lo siento, no se pudo anular la preventa',
                                padding: '2em',
                            });
                        }
                    });
                }
            });
        });
        $(document).on('click','.btn_enviar',function(){
            url = $(this).attr('url');
            $("#telefono").val($(this).attr('telefono')) 
            $("#modal_enviar").modal('show')
        })
        $(document).on('click','#btn_enviar',function(){
            let codigo = $("#codigo").val()
            let telefono = $("#telefono").val()
           window.open("https://wa.me/"+codigo+telefono+"?text=Revise%20su%cotizacion%20en%20este%20enlace%20"+url)
        })
    </script>
</body>
</html>