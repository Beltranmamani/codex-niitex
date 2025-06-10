<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
    $nombre_pagina = "Pedidos con pago completado";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE?> - Pendidos con pago completado</title>
    <link rel="icon" type="image/x-icon" href="<?=SERVERURL?>view/assets/assets/img/favicon.ico"/>
    <link href="<?=SERVERURL?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >

    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >
    

    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">

    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">

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
        .table-responsive{
            overflow-x:auto;
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
                <div class="row layout-top-spacing">
                    <div class="col-12 layout-spacing">
                        <div class="widget-four card p-2" id='card'>
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
                            <div class="widget-content">
                                <div class="table-responsive mb-4 mt-2" id="table-card">
                                    <table id="tb_compras" class="table style-2 ">
                                        <thead class="bg-primary">
                                            <tr>
                                                <td>PEDIDO</td>
                                                <td>TITULO</td>
                                                <td>FECHA</td>
                                                <td>TOTAL</td>
                                                <td>P. ENVIO</td>
                                                <td>CLIENTE</td>
                                                <td>DIRECCION</td>
                                                <td>PROVINCIA</td>
                                                <td>DEPARTAMENTO</td>
                                                <td>ESTADO</td>
                                                <td>OPCIONES</td>
                                            </tr>
                                        </thead>
                                        <tbody id='tb_pedidos'>

                                        </tbody>
                                        <tfoot >
                                            <tr>
                                                <td>PEDIDO</td>
                                                <td>TITULO</td>
                                                <td>FECHA</td>
                                                <td>TOTAL</td>
                                                <td>P. ENVIO</td>
                                                <td>CLIENTE</td>
                                                <td>DIRECCION</td>
                                                <td>PROVINCIA</td>
                                                <td>DEPARTAMENTO</td>
                                                <td>ESTADO</td>
                                                <td>OPCIONES</td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    <div id="modal_detalle_compra" class="modal animated slideInUp custo-slideInUp" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content"  id='loader_detail' style="zoom: 1;">
                <div class="modal-header">
                    <h5 class="modal-title">Detalle de pedido</h5>
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
                                        Información del Pedido 
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
                                                <th>Fecha Pedido</th>
                                                <th style="color: #425665;" id="date_detalle"></th>
                                                <th>Codigo Pedido</th>
                                                <th style="color: #425665;" id="tipo_pago_detalle"></th>
                                            </tr>
                                            <tr>
                                                <th>Estado Pedido</th>
                                                <th style="color: #425665;" id="proveedor_detalle"></th>
                                                <th >Cliente</th>
                                                <th style="color: #425665;" id="nro_documento_detalle"></th>
                                            </tr>
                                            <tr>
                                                <th>Direccion</th>
                                                <th style="color: #425665;" id="nro_detalle"></th>
                                                <th>Provincia</th>
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
                                    <th class='text-white'>Precio</th>
                                    <th class='text-white'>Cantidad</th>
                                    
                                    <th class='text-white'>Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_detalle_productos">

                            </tbody>
                            <tfoot >

                                <tr>
                                    <th colspan='5' class='text-primary text-right'>ENVIO</th>
                                    <th class='text-center' id="envio_detalle">0</th>
                                </tr>
                                <tr>
                                    <th colspan='5' class='text-primary text-right'>TOTAL</th>
                                    <th class='text-center' id="total_detalle">0</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_estado_pedido" class="modal animated slideInUp custo-slideInUp" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-xs">
            <!-- Modal content-->
            <div class="modal-content"  id='loader_detail' style="zoom: 1;">
                <div class="modal-header">
                    <h5 class="modal-title">Estado de pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control form-control-lg" id="select_estado_pedido">
                        
                    </select>
                    <button class='btn btn-block btn-success mt-2' type="button" id_pedido="" id="btn_actualizar_estado">ACTUALIZAR</button>
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
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/blockui/jquery.blockUI.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/blockui/custom-blockui.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/custom.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->

    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/pdfmake.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>
    
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function() {
            $("#view_tienda, #vista_pedido_pago_completado").addClass("active");
            App.init();
            var f1 = flatpickr(document.getElementById('date_1'));
            var f2 = flatpickr(document.getElementById('date_2'));
            lista_pedidos();
        });
        
        function check(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros y letras
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
        let lista_pedidos = ()=>{
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
            let token = "s";
            let usuario = "<?=$_SESSION['usuario']?>";
            let estado = 2;
            $.post("<?=SERVERURL?>pedidostienda/pedidosestadousuario/",{token,usuario,estado},function(res){
                let table = $('#tb_compras').DataTable();
                table.destroy();
                $("#tb_pedidos").html(res);

                c2 = $('#tb_compras').DataTable({
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
                                title : "REPORTE DE COMPRAS - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
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
                        $( api.column( j ).footer() ).html("TOTAL " +total_filtro.toFixed(2));
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
                        $(api.column(10).footer()).html("");
                        

                        
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
                    "lengthMenu": [20, 50, 100, 200],
                    "pageLength": 500
                });
                $(block).unblock(); 
                multiCheck(c2);
            });
        }
        $(document).on('click','#btn_consultar',function(){
            let fecha_1 = $("#date_1").val();
            let fecha_2 = $("#date_2").val();
            let usuario = "<?=$_SESSION['usuario']?>";
            let estado = 2;
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
                    $.post("<?=SERVERURL;?>pedidostienda/pedidosestadousuario_fecha/",{estado,fecha_1,fecha_2,usuario},function(response){
                        let table = $('#tb_compras').DataTable();
                        table.destroy();
                        $("#tb_pedidos").html(response);

                        c2 = $('#tb_compras').DataTable({
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
                                        title : "REPORTE DE PEDIDOS CON PAGO COMPLETADO - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
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
                                $( api.column( j ).footer() ).html("TOTAL " +total_filtro.toFixed(2));
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
                                $(api.column(10).footer()).html("");
                                

                                
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
                            "lengthMenu": [20, 50, 100, 200],
                            "pageLength": 500
                        });
                        $(block).unblock(); 
                        multiCheck(c2);
                    });
                }
            }
        });
        $(document).on('click','.btn_detalle',function(){
            let id_pedido = $(this).attr('id_pedido');
            $.post("<?=SERVERURL?>pedidostienda/detalle_pedido/",{id_pedido},function(response){
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
                        $("#tipo_pago_detalle").text(resd[1]);
                        $("#date_detalle").text(resd[2]);
                        $("#proveedor_detalle").text(resd[3]);
                        $("#nro_documento_detalle").text(resd[4]);
                        $("#nro_detalle").text(resd[6]);
                        $("#total_detalle").text(resd[5]);
                        $("#envio_detalle").text(resd[9]);
                        $("#total_cotizacio_detalle").text(resd[7]+", "+resd[8]);

                        $.post("<?=SERVERURL?>pedidostienda/items_pedido_modal/",{id_pedido},function(respuesta){
                                $("#tbody_detalle_productos").html(respuesta);
                                // $(block).unblock();
                                $("#modal_detalle_compra").modal('show');
                        
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
        $(document).on('click','.btn_estado',function(){
            let id_pedido = $(this).attr('id_pedido');
            $("#btn_actualizar_estado").attr('id_pedido',id_pedido)
            $.post("<?=SERVERURL?>pedidostienda/estado_pedido/",{id_pedido},function(response){
                $("#select_estado_pedido").html(response);
                $("#modal_estado_pedido").modal('show');
            });
        });
        $(document).on('click','#btn_actualizar_estado',function(){
            let id_pedido = $(this).attr('id_pedido');
            let usuario = "<?=$_SESSION["usuario"]?>";
            let estado = $("#select_estado_pedido").val();
            $.post("<?=SERVERURL?>pedidostienda/cambiar_estado_pedido/",{id_pedido,usuario,estado},function(response){
                if(response==1){
                    lista_pedidos();
                    $("#modal_estado_pedido").modal('hide');
                    Snackbar.show({
                        text: 'El Pedido actualizado',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });

                }else{
                    Snackbar.show({
                        text: 'Hubo un problema, al procesar la petición',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            });
        });
    </script>
</body>
</html>