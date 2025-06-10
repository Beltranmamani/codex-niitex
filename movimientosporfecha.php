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
    <title><?=SISTEMA_NOMBRE;?> - Movimientos por fecha </title>
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

    <!-- SELECT 2 -->
    <link href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
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
                                <h3>Movimientos por fechas</h3>
                            </div>
                        </div>
                        <div class="statbox widget box box-shadow" id="card">
                            <div class="widget-content widget-content-area">
                                <div class="row" style="padding: 15px;">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            Desde
                                            <input type="text" placeholder='2020-06-13' name="date_1" id="date_1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            Hasta
                                            <input type="text" placeholder='2020-07-12' name="date_2" id="date_2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 ">
                                        <button class="btn btn-success mb-2 w-100" style="margin-top:21px;padding:10px;" id="btn_consultar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            Consultar
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <div class="widget-content widget-content-area underline-content">
                                            <table id='table_compras' class="table">
                                                <thead class='bg-primary'>
                                                    <tr>
                                                        <th class='text-white'>FECHA MOVIMIENTO</th>
                                                        <th class='text-white'>CAJA</th>
                                                        <th class='text-white'>VENDEDOR</th>
                                                        <th class='text-white'>TIPO</th>
                                                        <th class='text-white'>MONTO</th>
                                                        <th class='text-white'>DESCRIPCION</th>
                                                        <th class='text-white'>MEDIO PAGO</th>
                                                    </tr>
                                                    <tr>
                                                        <th class='thead2'></th>
                                                        <th class='thead2 filterhead'></th>
                                                        <th class='thead2 filterhead'></th>
                                                        <th class='thead2 filterhead'></th>
                                                        <th class='thead2'></th>
                                                        <th class='thead2'></th>
                                                        <th class='thead2'></th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody id="body_table">
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                       
                                                        <th>LINEA</th>
                                                        <th>PRESENTACION</th>
                                                        <th>LOTE</th>
                                                        <th>PRECIO</th>
                                                        <th>CANTIDAD</th>
                                                        <th>SUB TOTAL</th>
                                                       
                                                    </tr>
                                                </tfoot>
                                            </table> 
                                           
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
    
    <!-- DATATABLES -->
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/pdfmake.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>

    <!-- SELECT2 -->
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/custom-select2.js"></script>
     <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>

/* ========================================================================== */
/*              verificar si la pagina esta completamente cargada             */
/* ========================================================================== */

        $(document).ready(function(){
            let modal = "<?=$_SESSION["sucursal"]?>";
            var f1 = flatpickr(document.getElementById('date_1'));
            var f2 = flatpickr(document.getElementById('date_2'));
            
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            c2 = $('#table_compras').DataTable({
                'orderCellsTop': true,
                'pageLength': 100,
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
                            title : "REPORTE DE PRODUCTOS COTIZADOS - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
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
                    var j = 7;
                    while(j < n_columnas){
                        var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0 );
                        if(j == 8){
                            $( api.column( j ).footer() ).html("Total "+total_filtro);
                        }else{
                            $( api.column( j ).footer() ).html("Total <?=$_SESSION['moneda']?>"+total_filtro.toFixed(2));
                        }
                        j++;
                    } 


                    $(api.column(0).footer()).html("");
                    $(api.column(1).footer()).html("");
                    $(api.column(2).footer()).html("");
                    $(api.column(3).footer()).html("");
                    $(api.column(4).footer()).html("");
                    $(api.column(5).footer()).html("");
                    $(api.column(6).footer()).html("");

                    
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
                "pageLength": 500
            });
            multiCheck(c2);
            $("#view_caja, #vista_movimientos_por_fecha,#dp_reporte_caja").addClass("active");

        });
    </script>
    <script>
/* ========================================================================== */
/*                             Consulta de compras                            */
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
                    $.post("<?=SERVERURL;?>caja/movimientos_por_fecha/",{fecha_1,fecha_2,sucursal},function(response){
                        if(response == 0 || response == ""){
                            Snackbar.show({
                                text: 'No hay movimietnos disponibles en ese rango de fechas',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
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
                            $("#body_table").html("");
                            c2 = $('#table_compras').DataTable({
                                'orderCellsTop': true,
                                'pageLength': 100,
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
                                            title : "REPORTE DE PRODUCTOS COTIZADOS - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
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
                                initComplete: function () {
                                    var api = this.api();
                                    count = 0;
                                    $(".thead2", api.table().header()).each(function (i) {
                                        if ($(this).hasClass("filterhead")) {
                                        var column = api.column(i);
                                        var title = column.header();
                                        //replace spaces with dashes
                                        title = $(title).html().replace(/[W]/g, "-");

                                        var select = $(
                                            '<select id="' + title + '" class="select2" ></select>'
                                        )
                                            .appendTo($(this).empty())
                                            .on("change", function () {
                                            //Get the "text" property from each selected data
                                            //regex escape the value and store in array
                                            var data = $.map($(this).select2("data"), function (value, key) {
                                                return value.text
                                                ? "^" + $.fn.dataTable.util.escapeRegex(value.text) + "$"
                                                : null;
                                            });

                                            //if no data selected use ""
                                            if (data.length === 0) {
                                                data = [""];
                                            }

                                            //join array into string with regex or (|)
                                            var val = data.join("|");

                                            //search for the option(s) selected
                                            column.search(val ? val : "", true, false).draw();
                                            });

                                        column
                                            .data()
                                            .unique()
                                            .sort()
                                            .each(function (d, j) {
                                            select.append('<option value="' + d + '">' + d + "</option>");
                                            });

                                        //use column title as selector and placeholder
                                        $("#" + title).select2({
                                            multiple: true,
                                            closeOnSelect: false,
                                            placeholder: "Select a " + title,
                                        });

                                        //initially clear select otherwise first option is selected
                                        $(".select2").val(null).trigger("change");
                                        }
                                    });
                                },
                                "footerCallback": function ( row, data, start, end, display ) {
                                    var api = this.api();
                                    n_columnas = api.columns().nodes().length;
                                    var j = 4;
                                    while(j < n_columnas){
                                        var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                            return parseFloat(a) + parseFloat(b);
                                        }, 0 );
                                            $( api.column( j ).footer() ).html("Total <?=$_SESSION['moneda']?> "+total_filtro.toFixed(2));
                                        j++;
                                    } 


                                    $(api.column(0).footer()).html("");
                                   
                                    
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
                                "lengthMenu": [5, 10, 20, 50],
                                "pageLength": 20,
                            });
                            $(block).unblock(); 
                            multiCheck(c2)
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
                                'orderCellsTop': true,
                                'pageLength': 100,
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
                                            title : "REPORTE DE MOVIMIETOS - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
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
                                initComplete: function () {
                                    var api = this.api();
                                    count = 0;
                                    $(".thead2", api.table().header()).each(function (i) {
                                        if ($(this).hasClass("filterhead")) {
                                        var column = api.column(i);
                                        var title = column.header();
                                        //replace spaces with dashes
                                        title = $(title).html().replace(/[W]/g, "-");

                                        var select = $(
                                            '<select id="' + title + '" class="select2" ></select>'
                                        )
                                            .appendTo($(this).empty())
                                            .on("change", function () {
                                            //Get the "text" property from each selected data
                                            //regex escape the value and store in array
                                            var data = $.map($(this).select2("data"), function (value, key) {
                                                return value.text
                                                ? "^" + $.fn.dataTable.util.escapeRegex(value.text) + "$"
                                                : null;
                                            });

                                            //if no data selected use ""
                                            if (data.length === 0) {
                                                data = [""];
                                            }

                                            //join array into string with regex or (|)
                                            var val = data.join("|");

                                            //search for the option(s) selected
                                            column.search(val ? val : "", true, false).draw();
                                            });

                                        column
                                            .data()
                                            .unique()
                                            .sort()
                                            .each(function (d, j) {
                                            select.append('<option value="' + d + '">' + d + "</option>");
                                            });

                                        //use column title as selector and placeholder
                                        $("#" + title).select2({
                                            multiple: true,
                                            closeOnSelect: false,
                                            placeholder: "Seleccionar  " + title,
                                        });

                                        //initially clear select otherwise first option is selected
                                        $(".select2").val(null).trigger("change");
                                        }
                                    });
                                },
                                "footerCallback": function ( row, data, start, end, display ) {
                                    var api = this.api();
                                    n_columnas = api.columns().nodes().length;
                                    var j = 4;
                                    while(j < n_columnas){
                                        var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                            return parseFloat(a) + parseFloat(b);
                                        }, 0 );
                                            $( api.column( j ).footer() ).html("Total <?=$_SESSION['moneda']?> "+total_filtro.toFixed(2));
                                        j++;
                                    } 


                                    $(api.column(0).footer()).html("");
                                    $(api.column(5).footer()).html("");
                                    
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

    </script>
</body>
</html>