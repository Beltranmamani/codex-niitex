<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
    $nombre_pagina = "Producto";
    $parametros_producto = $this->parametros_producto;
    $lista_unidades = $this->lista_unidades;
    $lista_presentacion = $this->lista_presentacion;
    $lista_linea = $this->listar_linea;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Caracteristicas producto </title>
    <link rel="icon" type="image/x-icon" href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico"/>
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css">

    <link href="<?= SERVERURL; ?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= SERVERURL; ?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?= SERVERURL; ?>view/assets/plugins/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

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
                    <div class="col-xl-4 col-12" id="form_layout">
                        <div class="user-profile layout-spacing" id="ver_producto">
                            
                        </div>
                    </div>
                    <div class="col-xl-8 col-12">
                        <div class="widget-content widget-content-area" id="card_producto">
                            <button class="btn btn-success btn-block mb-4" data-toggle="modal" data-target="#exampleModal">
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-list'><line x1='8' y1='6' x2='21' y2='6'></line><line x1='8' y1='12' x2='21' y2='12'></line><line x1='8' y1='18' x2='21' y2='18'></line><line x1='3' y1='6' x2='3.01' y2='6'></line><line x1='3' y1='12' x2='3.01' y2='12'></line><line x1='3' y1='18' x2='3.01' y2='18'></line></svg>                                
                                AGREGAR CARACTERISITICAS
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form class="modal-content" id="importe_productos" name="importe_productos">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Agregar caracteristica</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="caracteristica">Caracteristica</label>
                                                    <textarea class='form-control' name="caracteristica" id="caracteristica" cols="20" rows="10"></textarea>
                                                    <input type="hidden" value='<?=$this->id_producto?>' class='form-control' name="id_producto" id="id_producto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                Agregar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal fade" id="md_actualizar_caracteristica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form class="modal-content" id="actualizar-caracteristica" name="actualizar_caracteristica">
                                        
                                    </form>
                                </div>
                            </div>
                            <table class="table">
                                <thead class="bg-primary">
                                    <tr>
                                        <td>N°</td>
                                        <td>CARACTERISTICA</td>
                                        <td>ACCION</td>
                                    </tr>
                                </thead>
                                <tbody id="img_productos">

                                </tbody>
                            </table>
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
    <script src="<?=SERVERURL;?>view/source/plugins/notification/snackbar/snackbar.min.js"></script>
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

    <script src="<?= SERVERURL; ?>view/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function(){
            $("#view_producto, #vista_productos").addClass("active");

            verformulario();

           
            table_caracteristicas();
        });

        
/* -------------------------------------------------------------------------- */
/*                            Formulario productos                            */
/* -------------------------------------------------------------------------- */

        let verformulario = () =>{
            let id = "<?=$parametros_producto["ID_PRODUCTO"]?>";
            var block = $("#form_layout");
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
                $.post("<?=SERVERURL?>productos/form_producto/",{id},function(respuesta){
                    if($("#ver_producto").html(respuesta)){
                        $(block).unblock();
                    }
                })
        }
        let table_caracteristicas = () =>{
            let id = "<?=$this->id_producto?>";
                $.post("<?=SERVERURL?>productos/caracteristicas_producto/",{id},function(response){
                    $("#img_productos").html(response);

                });
        }
        $("#importe_productos").submit(function(e){
            e.preventDefault();
            let caracteristicas = $("#caracteristica").val();
            var block = $("#importe_productos");
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
            if(caracteristicas.length <1){
                Snackbar.show({
                    text: 'Complete los campos',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $(block).unblock(); 
                return false;
            }else{
                var Form = new FormData(document.forms.namedItem("importe_productos"));
                $.ajax({
                    url: "<?=SERVERURL;?>productos/agregar_caracteristicas/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data==1){
                            Snackbar.show({
                                text: 'Caracteristica agregada correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            table_caracteristicas();
                            $("#caracteristica").val("");
                        }else{
                            Snackbar.show({
                                text: 'No se pudo agregar_caracteristicas',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                        
                            $(block).unblock(); 
                    }
                }); 
            }
        });

        $(document).on('click', '.btn_eliminar', function() {
            let id = $(this).val();
            swal({
                title: 'Estas seguro?',
                text: "Tu quieres eliminar esta caracteristica!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.post('<?= SERVERURL; ?>productos/eliminar_caracteristica/', {
                        id
                    }, function(response) {
                        if (response != 0) {
                            swal(
                                'Eliminado!',
                                'Tu caracteristica ha sido eliminado.',
                                'success'
                            );
                            table_caracteristicas();
                        } else {
                            Snackbar.show({
                                text: 'No se pudo eliminar la caracteristica',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                    });
                }
            });
        });


        $(document).on('click','.btn_actualizar',function(){
            let id = $(this).val();
            var block = $("#actualizar-caracteristica");
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
            $.post('<?=SERVERURL;?>productos/form_caracteristica/',{id},function(response){
                if(response != 0){
                    $("#actualizar-caracteristica").html(response);
                    $("#md_actualizar_caracteristica").modal("show");
                }else{
                    Snackbar.show({
                        text: 'No se pudo mostrar el caracteristica',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            });
        });


        $("#actualizar-caracteristica").submit(function(e){
            e.preventDefault();
            var block = $("#actualizar_provincia");
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
            var Form = new FormData(document.forms.namedItem("actualizar_caracteristica"));
            $.ajax({
                url: "<?=SERVERURL;?>productos/actualizar_caracteristica/",
                type: "post",
                data : Form,
                processData: false,
                contentType: false,
                success: function(data)
                {  
                    if(data == 0){
                        Snackbar.show({
                            text: 'No se pudo actualizar la caracteristica',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        $(block).unblock(); 
                    }else if(data==1){
                        Snackbar.show({
                            text: 'Caracteristica actualizado correctamente',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42',
                            pos: 'top-right'
                        });
                        table_caracteristicas();
                        $(block).unblock(); 
                        $("#md_actualizar_caracteristica").modal("hide");
                    }else{
                        alert(data);
                    }
                }
            }); 
        });

        
    </script>
</body>
</html>