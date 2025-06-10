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
    <title><?=SISTEMA_NOMBRE?> - Usuarios </title>
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
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/dt-global_style.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_custom.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/custom_dt_html5.css" rel="stylesheet" type="text/css" >
    <link href="<?=SERVERURL;?>view/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/table/datatable/buttons.dataTables.min.css" rel="stylesheet" type="text/css" >

    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .select2-container{
            z-index: 100000;
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
                        <h3> Lista de Usuarios</h3>
                    </div>
                </div>

                <div class="row layout-top-spacing">
                    <div class="col-12 layout-spacing">
                        <div class="widget-four">
                            <div class="widget-heading text-right">
                                <button class="btn btn-success mb-2 mr-2 " data-toggle="modal" data-target="#nuevo_usuario"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Nuevo
                                </button>
                            </div>
                            <div class="widget-content ">
                                <div class="mb-4 table-responsive" id="table-card">
                                    <table id="style-2" class="table style-3">
                                        <thead>
                                            <tr>
                                                <th class="checkbox-column"> N° </th>
                                                <th class="text-center">Perfil</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Correo</th>
                                                <th>Fecha Registro</th>
                                                <th >Estado</th>
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
     <div id="nuevo_usuario" class="modal animated fadeIn custo-fadeInLeft" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modal-unidad-new-reload">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-justify"><line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                     Nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-white"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </button>
                </div>
                <form id="agregar_usuario" name="agregar_usuario">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group mb-4 col-sm-12">
                                <label for="nombre">Persona </label>
                                <select class="form-control  basic" id="persona" name="persona">
                                    <?=$this->personas;?>
                                </select>
                            </div>
                            <div class="form-group mb-4 col-sm-12">
                                <label for="nombre">Correo </label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="correoexample@gmail.com" required>
                            </div>
                            <div class="form-group mb-4 col-sm-12">
                                <label for="nombre">Password </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD..." required>
                            </div>
                            <div class="form-group mb-2 col-sm-12">
                                <label for="estado">Estado</label>
                            </div>
                            <div class="form-group mb-4 col-sm-12 d-flex">
                                <label class="switch s-icons s-outline s-outline-info  mr-2">
                                    <input id="estado" name="estado" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
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
    <div id="md_actualizar_usuario" class="modal animated fadeIn custo-fadeInLeft" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="modal-unidad-new-reload">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <form id="actualizar-usuario" name="actualizar_usuario">
                    
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
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/table/datatable/button-ext/buttons.colVis.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>



    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function() {
            App.init();
            mytable();
            var s2 = $("#persona").select2({
                tags: true,
            });
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
            let token = "ListarMinUnidades";
            $.post('<?=SERVERURL;?>personal/lista_usuarios/',{token},function(response){
                if(response == 0){
                    Snackbar.show({
                        text: 'No hay usuarios disponibles',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    let table = $("#style-2").DataTable();
                    table.destroy();
                    $("#table").html(response);
                    c2 = $('#style-2').DataTable({
                        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                        buttons: {
                            buttons: [
                                { extend: 'csv', className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{ extend: 'excel', className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{ extend: 'print', className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{extend: 'colvis',className:'btn'}
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
                }else{
                    let table = $("#style-2").DataTable();
                    table.destroy();
                    $("#table").html(response);
                    c2 = $('#style-2').DataTable({
                        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                        buttons: {
                            buttons: [
                                { extend: 'csv', className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{ extend: 'excel', className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{ extend: 'print', className: 'btn',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },footer:true
                                },{extend: 'colvis',className:'btn'}
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
                }
            });
        }

/* ========================================================================== */
/*                 Funcion para enviar datos y guardar usuario                */
/* ========================================================================== */
        $("#agregar_usuario").submit(function(e){
            e.preventDefault();
            let persona =  $("#persona").val();
            let correo =  $("#correo").val();
            let password =  $("#password").val();
            if(persona.length <= 0 || persona == null){
                Snackbar.show({
                    text: 'Seleccione una persona',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(correo.length <= 0 ){
                Snackbar.show({
                    text: 'El correo es obligatorio',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else if(password.length <= 0 ){
                Snackbar.show({
                    text: 'El password es obligatorio',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
            }else{
                var block = $("#agregar_usuario");
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
                var Form = new FormData(document.forms.namedItem("agregar_usuario"));
                $.ajax({
                    url: "<?=SERVERURL?>personal/guardar_usuario/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data == 1){
                            Snackbar.show({
                                text: 'Producto agregado correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            $("#agregar_usuario")[0].reset();
                            $(block).unblock();
                            mytable();
                        }else if(data==2){
                            Snackbar.show({
                                text: 'Revise que el correo y la persona no tenga un usuario existente',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            $(block).unblock(); 
                        }else if(data==0){
                            Snackbar.show({
                                text: 'No se pudo agregar, Presione F5',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                    }
                });     
            }
        });

/* -------------------------------------------------------------------------- */
/*                             Actualizar Usuario                             */
/* -------------------------------------------------------------------------- */

        $(document).on('click','.btn_actualizar',function(){
            let id = $(this).attr("usuario_id");
            var block = $("#actualizar-ususario");
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
            $.post('<?=SERVERURL;?>personal/form_usuario/',{id},function(response){
                if(response != 0){
                    $("#actualizar-usuario").html(response);
                    $("#md_actualizar_usuario").modal("show");
                }else{
                    Snackbar.show({
                        text: 'No se pudo mostrar el usuario',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            });
        });


        $("#actualizar-usuario").submit(function(e){
            e.preventDefault();
            var block = $("#actualizar_usuario");
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
            var Form = new FormData(document.forms.namedItem("actualizar_usuario"));

            $.ajax({
                url: "<?=SERVERURL;?>personal/actualizar_usuario/",
                type: "post",
                data : Form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    if(data == 0){
                        Snackbar.show({
                            text: 'No se pudo actualizar el usuario',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        $(block).unblock(); 
                    }else if(data==1){
                        Snackbar.show({
                            text: 'Usuario actualizado correctamente',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42',
                            pos: 'top-right'
                        });
                        mytable();
                        $(block).unblock(); 
                        $("#md_actualizar_usuario").modal("hide");
                    }
                }
            });     
        });

/* -------------------------------------------------------------------------- */
/*                              ELiminar usuario                              */
/* -------------------------------------------------------------------------- */

    $(document).on('click','.btn_eliminar',function(){
            let id = $(this).attr("usuario_id");
            swal({
                title: 'Estas seguro?',
                text: "Tu quieres eliminar este usuario!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.post('<?=SERVERURL;?>personal/eliminar_usuario/',{id},function(response){
                        if(response != 0){
                            swal(
                            'Eliminado!',
                            'Tu usuario ha sido eliminado.',
                            'success'
                            );
                            mytable();
                        }else{
                            Snackbar.show({
                                text: 'No se pudo eliminar el usuario',
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