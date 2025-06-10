<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
    $nombre_pagina = "Productos recomendados";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE?> - Productos recomendados</title>
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
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >
    

    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <style >
        .table-responsive {
            overflow-x: auto;
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
                        <div class="widget-four card p-2">
                            <div class="row justify-content-md-center" style="padding: 15px;">
                                <div class="col-sm-6">
                                    <button class="btn btn-success btn-block mb-4 mr-2" id="btn_importar" data-toggle="modal" data-target="#modal_importar" >IMPORTAR PRODUCTOS</button>
                                    <div class="modal fade" id="modal_importar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content" name="importe_productos">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Importar productos a la tienda</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body table-responsive" id="modal_load">
                                                    <table id="style-2" class="table">
                                                        <thead class="bg-primary">
                                                            <tr>
                                                                <th class='text-white'>Barra</th>
                                                                <th class='text-white' class="text-center">Imagen</th>
                                                                <th class='text-white'>Producto</th>
                                                                
                                                                <th class='text-white'>Linea</th>
                                                                <th class='text-white'>Presentacion</th>
                                                                
                                                                
                                                                <th class='text-white'>Stock</th>
                                                                <th class='text-white'>P.Venta</th>
                                                                <th class='text-white'>(%) Desc.</th>
                                                                
                                                                <th class='text-white'>Opcion</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table">
                                                            
                                                        </tbody>
                                                        
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content">
                                <div class="table-responsive mb-4" id="table-card">
                                    <table id='productos_tb' class="table style-2 table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <td>N°</td>
                                                <td>NOMBRE</td>
                                                <td>IMAGEN</td>
                                                <td>LINEA</td>
                                                <td>PRESENTACION</td>
                                                <td>PRECIO</td>
                                                <td>STOCK</td>
                                                <td>DESCUENTO(-%)</td>
                                                <td>OPCION</td>
                                            </tr>
                                        </thead>
                                        <tbody id="productos_tienda">

                                        </tbody>
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
            $("#view_tienda, #vista_productos_recomendados_tienda").addClass("active");
            App.init();
            productos_tienda();
            productos_tienda_modal();
        });
        let productos_tienda_modal=()=>{
            var block = $("#modal_load");
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
            let sucursal =  "<?=$this->id_sucursal?>";
            $.post('<?=SERVERURL;?>productostienda/productos_tienda/',{sucursal},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay productos disponibles',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    $(block).unblock(); 
                }else{
                    $("#table").html(response);
                    let table = $("#style-2").DataTable({
                            
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
                        "pageLength": 200
                    });
                                       
                    $(block).unblock(); 
                }
            });
        }
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
        $(document).on('click','.btn_importar',function(){
            let id_item = $(this).attr("id_item");
            let desc_item = $("#txt_"+id_item).val();

            $.post("<?=SERVERURL?>productostienda/agregar_producto_recomendado",{id_item,desc_item},function(res){
                if(res==1){
                    productos_tienda();
                    Snackbar.show({
                        text: 'Producto agregado correctamente',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                    $("#txt_"+id_item).val("");
                }else{
                    Snackbar.show({
                        text: 'No se pudo agregar el producto porque ya esta en la tienda',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            });
        });
        let productos_tienda = () =>{
            let sucursal =  "<?=$this->id_sucursal?>";
            $.post('<?=SERVERURL;?>productostienda/lista_productosrecomendados_sucursal/',{sucursal},function(response){
                let table = $("#productos_tb").DataTable();
                table.destroy();
                $("#productos_tienda").html(response);
                c2 = $('#productos_tb').DataTable({
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
                                title : "PRODUCTOS EN TIENDA",
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
                    "lengthMenu": [200, 500, 1000, 2000],
                    "pageLength": 500
                });
            });
        }
        $(document).on('click','.btn_eliminar',function(){
            let id = $(this).val();
            swal({
                title: 'Estas seguro?',
                text: "Tu quieres eliminar este producto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.post('<?=SERVERURL?>productostienda/eliminar_productorecomendado_tienda/',{id},function(response){                        // if(response != 0){
                        if(response==1){
                            swal(
                                'Eliminado!',
                                'Tu producto ha sido eliminado.',
                                'success'
                                );
                            productos_tienda();
                        }else{
                            Snackbar.show({
                                text: 'No se pudo eliminar el producto',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>