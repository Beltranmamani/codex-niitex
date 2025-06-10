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
    <title><?=SISTEMA_NOMBRE?> - Inventario General</title>
    <link rel="icon" type="image/x-icon" href="<?=SERVERURL?>view/assets/assets/img/favicon.ico"/>
    <link href="<?=SERVERURL?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >
    
    
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/tagInput/tags-input.css" rel="stylesheet" type="text/css" />

    <link href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">


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
                        <h3> Inventario General</h3>
                    </div>
                </div>

                <div class="row layout-top-spacing">
                    <div class="col-12 layout-spacing">
                        <div class="widget-four">
                            <div class="widget-heading text-right">    
                               
                            </div>
                            <div class="widget-content">
                            <div class="table-responsive mb-4" id="table-card">
                                    <table id="style-2" class="table">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class='text-white'>Barra</th>
                                                <th class='text-white' class="text-center">Imagen</th>
                                                <th class='text-white'>Producto</th>
                                                <th class='text-white'>U.M</th>
                                                <th class='text-white'>Linea</th>
                                                <th class='text-white'>Presentación</th>
                                                <th class='text-white'>Lote</th>
                                                <th class='text-white'>P.Compra </th>
                                                <th class='text-white'>P.Venta 1</th>
                                                <th class='text-white'>P.Venta 2</th>
                                                <th class='text-white'>P.Venta 3</th>
                                                <th class='text-white'>P.Venta 4</th>
                                                <th class='text-white'>Stock</th>
                                                <th class='text-white'>Lote</th>
                                                <th class='text-white'>Fecha Ven.</th>
                                                <th class='text-white'>Almacen</th>
                                                
                                            </tr>
                                            <tr>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2 filterhead'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2 filterhead'></th>
                                                <th class='thead2 filterhead'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2'></th>
                                                <th class='thead2 filterhead'></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="table">
                                            
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                                <th>Barra</th>
                                                <th class="text-center">Imagen</th>
                                                <th>Producto</th>
                                                <th>U.M</th>
                                                <th>Linea</th>
                                                <th>Presentación</th>
                                                <th>P.Compra</th>
                                                <th>P.Venta</th>
                                                <th>P.Venta</th>
                                                <th>P.Venta</th>
                                                <th>P.Venta</th>
                                                <th>Stock</th>
                                                <th>Lote</th>
                                                <th>Fecha Ven.</th>
                                                <th>Almacen</th>
                                               
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
    <!-- MODALS -->
    <div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >

                <div class="modal-header" id="loginModalLabel">
                    <h4 class="modal-title">Agregar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body" id="modal_1">
                    <form class="mt-0" id="detalle_producto_1">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade login-modal" id="loginModal2" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >

                <div class="modal-header" id="loginModalLabel">
                    <h4 class="modal-title">Agregar producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body" id="modal_2">
                    <form class="mt-0" id="detalle_producto_2">
                        
                    </form>
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
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/pdfmake.min.js"></script>    
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/vfs_fonts.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>
    
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/custom-select2.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>

/* ========================================================================== */
/*                    Detectar si la pagina esta recargada                    */
/* ========================================================================== */

        $(document).ready(function() {
            App.init();
            mytable();
            $("#view_inventario, #vista_inventariogeneral").addClass("active");
        });

/* ========================================================================== */
/*                        Listar productos disponibles                        */
/* ========================================================================== */


/* ========================================================================== */
/*                        Listar productos del almacen                        */
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
            let sucursal =  "<?=$_SESSION['sucursal']?>";
            $.post('<?=SERVERURL;?>inventario/lista_productos_sucursal/',{sucursal},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay productos disponibles',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    $(block).unblock(); 
                }else{
                    let table = $("#style-2").DataTable();
                    table.destroy();
                    $("#table").html(response);
                    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                        var found = false;

                        var table = $("#style-2").DataTable();
                        var row = table.row(dataIndex).node();
                        var checked = $('input[name="chk_box"]').prop("checked");

                        if (checked && $(row).find("input").prop("checked")) {
                        return false;
                        }

                        return true;
                    });
                    c2 = $('#style-2').DataTable({
                        'orderCellsTop': true,
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
                                    title : "REPORTE DE VENTAS - <?=$_SESSION["nombre_sucursal"]?> - <?=date('Y-m-d H:i:s')?>",
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
                                    '<select id="' + title + '" class="select2"></select>'
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
                                    placeholder: "Seleccionar ",
                                });

                                //initially clear select otherwise first option is selected
                                $(".select2").val(null).trigger("change");
                                }
                            });
                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api();
                            n_columnas = api.columns().nodes().length;
                            var j = 8;
                            while(j < n_columnas){
                                var total_filtro = api.column( j, { page: 'current'} ).data().reduce( function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0 );
                            //Actualizar Footer
                            $( api.column( j ).footer() ).html("TOTAL "+total_filtro);
                                j++;
                            } 

                            $(api.column(0).footer()).html("");
                            $(api.column(1).footer()).html("");
                            $(api.column(2).footer()).html("");
                            $(api.column(3).footer()).html("");
                            $(api.column(4).footer()).html("");
                            $(api.column(5).footer()).html("");
                            $(api.column(6).footer()).html("");
                            $(api.column(7).footer()).html("");
                            $(api.column(8).footer()).html("");
                            $(api.column(9).footer()).html("");
                            $(api.column(10).footer()).html("");
                            $(api.column(12).footer()).html("");
                            $(api.column(13).footer()).html("");
                            $(api.column(14).footer()).html("");


                            
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
                        "lengthMenu": [200, 500, 1000, 2000],
                        "pageLength": 500
                    });
                    $(block).unblock(); 
                    multiCheck(c2);
                }
            });
        }
    </script>
    
</body>
</html>