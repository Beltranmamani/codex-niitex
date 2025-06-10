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
    <title><?=SISTEMA_NOMBRE;?> - Actualizar producto </title>
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
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg>
                                IMPORTAR IMAGENES
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form class="modal-content" id="importe_productos" name="importe_productos">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Importar imagen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="custom-file-container" data-upload-id="myFirstImage">
                                                <label>Seleccionar imagen <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                                <label class="custom-file-container__custom-file" >
                                                    <input type="file" id="file" name="file" class="custom-file-container__custom-file__custom-file-input" >
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <input type="hidden" name="id_producto" value="<?=$this->id_producto?>" />
                                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                Importar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table">
                                <thead class="bg-primary">
                                    <tr>
                                        <td>N°</td>
                                        <td>IMAGEN</td>
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
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function(){
            $("#view_producto, #vista_productos").addClass("active");

            verformulario();
            var ss = $("#option_um").select2({
                tags: true,
            });
            var s1 = $("#option_marca").select2({
                tags: true,
            });
            var s2 = $("#option_categoria").select2({
                tags: true,
            });
           
            var firstUpload = new FileUploadWithPreview('myFirstImage');
            table_imagenes();
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
        let table_imagenes = () =>{
            let id = "<?=$this->id_producto?>";
                $.post("<?=SERVERURL?>productos/lista_imagenes_productos/",{id},function(response){
                    $("#img_productos").html(response);

                });
        }
        $("#importe_productos").submit(function(e){
            e.preventDefault();
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
            if(document.getElementById('file').files.length == 0){
                Snackbar.show({
                    text: 'No se ha cargado ninguna imagen',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $(block).unblock(); 
                return false;
            }else{
                Snackbar.show({
                    text: 'Importando...',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42',
                    pos: 'top-right'
                });
                var Form = new FormData(document.forms.namedItem("importe_productos"));
                $.ajax({
                    url: "<?=SERVERURL;?>productos/agregar_imagenes_producto/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data==1){
                            Snackbar.show({
                                text: 'Imagen subida correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            table_imagenes();
                        }else{
                            Snackbar.show({
                                text: 'No se pudo subir la imagen',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                        // alert(data);
                        // const toast = swal.mixin({
                        //         toast: true,
                        //         position: 'top-end',
                        //         showConfirmButton: false,
                        //         timer: 5000,
                        //         padding: '2em'
                        //     });
                        // let resd = data.split("|");
                        // if(resd[0]== 1){
                        //    let cantidad = resd[1];
                        //    toast({
                        //         type: 'success',
                        //         title: cantidad+' productos importados correctamente',
                        //         padding: '2em',
                        //     });
                        //     mytable();
                            $(block).unblock(); 
                        //     $("#exampleModal").modal('hide');
                        // }else{
                        //     Snackbar.show({
                        //         text: 'Hubo un problema al importar productos, revise si el documento esta correctamente llenado',
                        //         actionTextColor: '#fff',
                        //         backgroundColor: '#e7515a',
                        //         pos: 'top-right'
                        //     });
                        //     $(block).unblock(); 
                        // }
                    }
                }); 
            }
        });
        $(document).on('click','.btn_eliminar',function(){
            let id = $(this).val();
            let img = $(this).attr('img');
            $.post("<?=SERVERURL?>productos/eliminar_imagen/",{id,img},function(res){
                if(res==1){
                    Snackbar.show({
                        text: 'Imagen eliminada correctamente',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42',
                        pos: 'top-right'
                    });
                    table_imagenes();
                }else{
                    Snackbar.show({
                        text: 'No se ha eliminado ninguna imagen',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                }
            });
        })
    </script>
</body>
</html>