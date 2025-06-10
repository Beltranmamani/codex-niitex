<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
    date_default_timezone_set(ZONEDATE);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE?> - Historial de Acceso </title>
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
    <link href="<?=SERVERURL?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">
    
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >
    
    <link href="<?=SERVERURL;?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .select2-container{
            z-index: 100000;
        }
        .widget-four .widget-heading{
            margin: 0;
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

                <div class="page-header">
                    <div class="page-title">
                        <h3> Historial de acceso</h3>
                    </div>
                </div>

                <div class="row layout-top-spacing">
                    <div class="col-12 layout-spacing">
                        <div class="widget-four">
                            
                            <div class="widget-content ">
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
                                        <button class="btn btn-success mb-2 w-100" style="margin-top:21px;padding:12px;" id="btn_consultar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            Consultar
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-4 table-responsive" id="table-card">
                                            <table id="style-2" class="table style-3  table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>FECHA DE ACCESO</th>
                                                        <th>PERSONA</th>
                                                        <th>EMAIL</th>
                                                        <th>SUCURSAL</th>
                                                        <th>IP</th>
                                                        <th>NAVEGADOR</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table">
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>FECHA DE ACCESO</th>
                                                        <th>PERSONA</th>
                                                        <th>EMAIL</th>
                                                        <th>SUCURSAL</th>
                                                        <th>IP</th>
                                                        <th>NAVEGADOR</th>
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
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->

    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/pdfmake.min.js"></script>    
    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>
    
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function() {
            $("#view_administracion, #vista_historial").addClass("active");
            let modal = "<?=$_SESSION["sucursal"]?>";
            var f1 = flatpickr(document.getElementById('date_1'));
            var f2 = flatpickr(document.getElementById('date_2'));
            if(modal == 0){
                $("#modal_no_sucursal").modal('show');
            }
            App.init();
            mytable();
        });

/* ========================================================================== */
/*                              Lista de usuarios                             */
/* ========================================================================== */

        let mytable = function(){
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
            let sucursal = "<?=$_SESSION["sucursal"]?>";
            $.post('<?=SERVERURL;?>personal/bitacora_de_sesiones/',{sucursal},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay movimientos disponibles',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    response = " ";
                }
                let table = $("#style-2").DataTable();
                table.destroy();
                $("#table").html(response);
                c2 = $('#style-2').DataTable({
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
                                title : "REPORTE DE HISTORIAL DE ACCESOS - <?=$_SESSION['nombre_sucursal']?> - <?=date('Y-m-d')?>",
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
                    "pageLength": 20
                });
                $(block).unblock(); 
                multiCheck(c2);
            });
        }


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
                    $.post("<?=SERVERURL;?>personal/bitacora_fechas/",{fecha_1,fecha_2,sucursal},function(response){
                        if(response == 0){
                            Snackbar.show({
                                text: 'No hay movimientos disponibles',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            response = " ";
                        }
                        let table = $("#style-2").DataTable();
                        table.destroy();
                        $("#table").html(response);
                        c2 = $('#style-2').DataTable({
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
                                        title : "REPORTE DE HISTORIAL DE ACCESOS - <?=$_SESSION['nombre_sucursal']?> - <?=date('Y-m-d')?>",
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
                            "pageLength": 20
                        });
                        $(block).unblock(); 
                        multiCheck(c2);
                    });
                }
            }
        });
    </script>
</body>
</html>