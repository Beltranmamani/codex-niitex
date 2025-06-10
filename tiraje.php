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
    <title><?=SISTEMA_NOMBRE;?> - Tiraje de comprobantes </title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >

    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!-- DATE PICKER -->
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" >
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
                    <div class="col-10">
                        <div class="page-header mb-3">
                            <div class="page-title">
                                <h3> Tiraje de Comprobantes</h3>
                            </div>
                        </div>
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-md-12" >
                                        <h4></h4>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-success mb-2 mr-2 " data-toggle="modal" data-target="#new-unidad"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Nuevo
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive mb-4" id="table-card">
                                    <table id="style-2" class="table style-3  table-hover">
                                        <thead>
                                            <tr>
                                                <th class="checkbox-column"> Record Id </th>
                                                <th> N°</th>
                                                <th> Fecha Resolucion </th>
                                                <th> Comprobante </th>
                                                <th> Serie </th>
                                                <th> Disponibles </th>
                                                <th> Utilizados </th>
                                                <th> Estado </th>
                                                <th class="text-center">Accion</th>
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

               <?php 
                require_once 'view/components/cmp_footer.php';
               ?>

            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->
    <!-- MODALS -->
    <div id="new-unidad" class="modal animated fadeInDown custo-fadeInLeft" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modal-unidad-new-reload">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify"><line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                     Nuevo Comprobante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </button>
                </div>
                <form id="form_tiraje" name="form_tiraje" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group mb-4 col-sm-7">
                                <label for="comprobante">Comprobante</label>
                                <select name="comprobante" id="comprobante" class="form-control">
                                    <?=$this->lista_comprobantes?>
                                </select>
                            </div>
                            <div class="form-group mb-4 col-sm-5">
                                <label for="date_1">Fecha Tiraje(*)</label>
                                <input type="text" name="date_1" id="date_1" class="form-control">
                            </div>
                            <div class="form-group mb-4 col-sm-8">
                                <label for="n_resolucion_factura">Número Dosificacion Facturas(*)</label>
                                <input type="text" name="n_resolucion_factura" placeholder="2019-1-1999999" id="n_resolucion_factura" class="form-control">
                            </div>
                            <div class="form-group mb-4 col-sm-6">
                                <label for="n_resolucion">Numero Dosificacion(*)</label>
                                <input type="text" name="n_resolucion" id="n_resolucion"  placeholder="2019-1-1900999" class="form-control">
                            </div>
                            <div class="form-group mb-4 col-sm-6">
                                <label for="serie">Serie(*)</label>
                                <input type="text" name="serie" id="serie" placeholder="SERIE A" class="form-control">
                            </div>
                            <div class="form-group mb-4 col-sm-6">
                                <label for="correlativo_del">Del(*)</label>
                                <input type="text" name="correlativo_del" id="correlativo_del" value="1" class="form-control">
                            </div>
                            <div class="form-group mb-4 col-sm-6">
                                <label for="correlativo_al">Al(*)</label>
                                <input type="text" name="correlativo_al" id="correlativo_al" value="20" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer md-button">
                        <button class="btn btn-danger" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="md_actualizar_tiraje" class="modal animated fadeInDown custo-fadeInLeft" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modal-unidad-new-reload">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Comprobante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <form id="actualizar-tiraje" name="actualizar_tiraje">
                    
                </form>
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
    <script src="<?=SERVERURL;?>view/assets/assets/js/scrollspyNav.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/input-mask.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/datatables.js"></script>

    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- DATE PICKER -->
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/custom-nouiSlider.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function(){
            mytable();
            var f1 = flatpickr(document.getElementById('date_1'));
            $("#correlativo_del").TouchSpin({
                min: 0,
                max: 99999999999999999999999999999999999999999
            });
            $("#correlativo_al").TouchSpin({
                min: 0,
                max : 9999999999999999999999999999999999999999
            });
        });
        let mytable = function(){
            var block = $("#table-card");
            $(block).block({ 
                message: '<span class="text-semibold"> Cargando...</span>',
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
            let token = "<?=$_SESSION["sucursal"]?>";
            $.post('<?php echo SERVERURL;?>comprobante/lista_tirajes/',{token},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay comprobantes disponibles',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                     $(block).unblock(); 
                }else{
                    let table = $("#style-2").DataTable();
                    table.destroy();
                    $("#table").html(response);
                    c2 = $('#style-2').DataTable({
                        headerCallback:function(e, a, t, n, s) {
                            e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                        },
                        columnDefs:[ {
                            targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                                return'<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                            }
                        }],
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
                }
            });
        }
        $(document).on('click','.btn_estado_update ',function(){
            let id = $(this).attr('id_tiraje');
            let estado = $(this).attr('estado');
            $.post('<?=SERVERURL;?>comprobante/actualizar_estado_tiraje/',{id,estado},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No se pudo actualizar el tiraje',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    
                }else if(response==1){
                    Snackbar.show({
                        text: 'Tiraje actualizado correctamente',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                    mytable();
                }
            });
            
        });
    </script>
    <script>

/* ========================================================================== */
/*                           Enviar datos de tiraje                           */
/* ========================================================================== */

        $("#form_tiraje").submit(function(e){
            e.preventDefault();
            let comprobante = $("#comprobante").val();
            let date_1 = $("#date_1").val();
            let n_resolucion_factura = $("#n_resolucion_factura").val();
            let n_resolucion = $("#n_resolucion").val();
            let serie = $("#serie").val();
            let correlativo_del = $("#correlativo_del").val();
            let correlativo_al = $("#correlativo_al").val();

            if(comprobante.length < 1 || comprobante == null){
                Snackbar.show({
                    text: 'Seleccione un comprobante',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(date_1.length < 1 || date_1 == null){
                Snackbar.show({
                    text: 'Seleccione la fecha de tiraje',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(n_resolucion_factura.length < 1 || n_resolucion_factura == null){
                Snackbar.show({
                    text: 'Digite el número de resolución de factura',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(n_resolucion.length < 1 || n_resolucion == null){
                Snackbar.show({
                    text: 'Digite el número de resolución',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(serie.length < 1 || serie == null){
                Snackbar.show({
                    text: 'Digite la serie',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(correlativo_del.length < 1 || correlativo_del == null || correlativo_del < 1){
                Snackbar.show({
                    text: 'Digite el correlativo del',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(correlativo_al.length < 1 || correlativo_al == null || correlativo_al < 2){
                Snackbar.show({
                    text: 'Digite el correlativo al',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else{
                var block = $("#modal-unidad-new-reload");
                $(block).block({ 
                    message: '<span class="text-semibold"><i class="fa fa-save"></i> Guardando...</span>',
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
                var Form = new FormData(document.forms.namedItem("form_tiraje"));
                $.ajax({
                    url: "<?=SERVERURL;?>comprobante/guardar_tiraje/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data == 1){
                            Snackbar.show({
                                text: 'El tiraje se agrego correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            $("#form_tiraje")[0].reset();
                            $(block).unblock();
                            mytable();
                        }else{
                            Snackbar.show({
                                text: 'No se pudo agregar el tiraje',
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
/*                                Buscar tiraje                               */
/* ========================================================================== */

        $(document).on('click','.btn_actualizar',function(){
            let id = $(this).attr("tiraje_id");
            var block = $("#actualizar-tiraje");
            $(block).block({ 
                message: '<span class="text-semibold"><i class="fa fa-save"></i> Cargando...</span>',
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
            $.post('<?=SERVERURL;?>comprobante/form_tiraje/',{id},function(response){
                if(response != 0){
                    $("#actualizar-tiraje").html(response);
                    $("#md_actualizar_tiraje").modal("show");
                    var f1 = flatpickr(document.getElementById('fecha1_'+id));
                    $("#correlativo_del_"+id).TouchSpin({
                        min: 0,
                        max: 99999999999999999999999999999
                    });
                    $("#correlativo_al_"+id).TouchSpin({
                        min: 0,
                        max : 99999999999999999999999999999
                    });
                }else{
                    Snackbar.show({
                        text: 'No se pudo mostrar el tiraje',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            });
        });

/* ========================================================================== */
/*                              Actualizar tiraje                             */
/* ========================================================================== */

        $("#actualizar-tiraje").submit(function(e){
            e.preventDefault();
            var block = $("#actualizar_tiraje");
            $(block).block({ 
                message: '<span class="text-semibold"><i class="fa fa-save"></i> Guardando...</span>',
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
            var Form = new FormData(document.forms.namedItem("actualizar_tiraje"));

            $.ajax({
                url: "<?=SERVERURL;?>comprobante/actualizar_tiraje/",
                type: "post",
                data : Form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    if(data == 0){
                        Snackbar.show({
                            text: 'No se pudo actualizar el tiraje',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        $(block).unblock(); 
                    }else if(data==1){
                        Snackbar.show({
                            text: 'Tiraje actualizado correctamente',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42',
                            pos: 'top-right'
                        });
                        mytable();
                        $(block).unblock(); 
                        $("#md_actualizar_tiraje").modal("hide");
                    }
                }
            });     
        });

/* -------------------------------------------------------------------------- */
/*                               ELiminar tiraje                              */
/* -------------------------------------------------------------------------- */

    $(document).on('click','.btn_eliminar',function(){
            let id = $(this).attr("tiraje_id");
            swal({
                title: 'Estas seguro?',
                text: "Tu quieres eliminar este tiraje!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.post('<?=SERVERURL;?>comprobante/eliminar_tiraje/',{id},function(response){
                        if(response != 0){
                            swal(
                            'Eliminado!',
                            'Tu tiraje ha sido eliminado.',
                            'success'
                            );
                            mytable();
                        }else{
                            Snackbar.show({
                                text: 'No se pudo eliminar el tiraje',
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