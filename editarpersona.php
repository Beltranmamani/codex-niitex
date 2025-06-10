<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
    $parametros_persona = $this->parametros_persona;
    $lista_documentos = $this->lista_documentos;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?=SISTEMA_NOMBRE;?> - Actualizar Persona </title>
    <link rel="icon" type="image/x-icon" href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico"/>
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />

    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />

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
                        <div class="user-profile layout-spacing" id="ver_persona">
                            
                        </div>
                    </div>
                    <div class="col-xl-8 col-12">
                        <div class="widget-content widget-content-area" id="card_producto">
                            <form autocomplete="off" id="circle-basic" action="#" name="formulario_articulo" enctype="multipart/form-data">
                                <h3>Datos Personales</h3>
                                <section>
                                    <div class="form-row">
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="nombre">Nombres</label>
                                            <input type="text" name="nombre" value="<?=$parametros_persona["NOMBRE"];?>" class="form-control" maxlength="100" id="nombre" required>
                                            <input type="hidden" name="id_persona" value="<?=$parametros_persona["ID_PERSONA"];?>" class="form-control" maxlength="100" id="id_persona" required>

                                        </div>
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="apellidos">Apellidos</label>
                                            <input type="text" name="apellidos" value="<?=$parametros_persona["APELLIDO"];?>" class="form-control" maxlength="100" id="apellidos" required>
                                        </div>
                                        <div class="col-xl-4  col-md-12 mb-4">
                                            <label for="tipo_documento">Documento</label>
                                            <select id="tipo_documento" name="tipo_documento" class="form-control">
                                            <?php
                                                    foreach($lista_documentos as $lista){
                                                        if($lista["ID_DOCUMENTO"] === $parametros_persona["ID_DOCUMENTO"]){
                                                            echo "<option value='{$lista["ID_DOCUMENTO"]}' selected='true'>{$lista["DOCUMENTO"]} </option>";
                                                        }else{
                                                            echo "<option value='{$lista["ID_DOCUMENTO"]}'>{$lista["DOCUMENTO"]}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-md-12 mb-4">
                                            <label for="numero_doc">N° Documento</label>
                                            <input type="text" name="numero_doc" value="<?=$parametros_persona["NUMERO"];?>" class="form-control" maxlength="15" minlength="10" id="numero_doc" required>
                                        </div>
                                        <div class="col-xl-5 col-md-12 mb-4">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" name="direccion" value="<?=$parametros_persona["DIRECCION"];?>" class="form-control" id="direccion" maxlength="100" required>
                                        </div>
                                        <div class="col-xl-3 col-md-12 mb-4">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" name="telefono" value="<?=$parametros_persona["TELEFONO"];?>" class="form-control" id="telefono" maxlength="20" required>
                                        </div>
                                        <div class="form-group mb-4 col-xl-1 col-md-12 ">
                                            <label for="estado" class="d-flex mb-3">Estado </label>
                                            <label class="d-flex  switch s-icons s-outline s-outline-info  mr-2">
                                            <?php 
                                                    if($parametros_persona["ESTADO"] == 1){
                                                ?>
                                                    <input id="estado" name="estado" style="display:none;" type="checkbox" checked>        
                                                <?php	
                                                    }else{
                                                ?>
                                                        <input id="estado" name="estado" style="display:none;" type="checkbox">
                                                <?php        
                                                    }
                                                ?> 
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </section>
                                <h3>Perfil</h3>
                                <section>
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Subir logo de la sucursal <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                        <input type="file" id="file" type="file" name="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </section>
                            </form>
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
            verformulario();
            var ss = $("#tipo_documento").select2({
                tags: true,
            });
            $('#numero_doc').inputmask("999999999999999");
            $('#nombre').maxlength({
                alwaysShow: true,
                threshold: 15,
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-warning"
            });
            $('#direccion').maxlength({
                alwaysShow: true,
                threshold: 15,
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-warning"
            });
            $('#telefono').maxlength({
                alwaysShow: true,
                threshold: 15,
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-warning"
            });
            $('#apellidos').maxlength({
                alwaysShow: true,
                threshold: 15,
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-warning"
            });
            var firstUpload = new FileUploadWithPreview('myFirstImage');
        });
        var form = $("#circle-basic");
        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            cssClass: 'circle wizard',
            onStepChanging:function(event,currentIndex,newIndex){
                if(currentIndex == 0){
                    // VALIDAR SI LOS CAMPOS ESTAN VACIOS
                    if($("#nombre").val().length<1 || $("#apellidos").val().length<1){
                        Snackbar.show({
                            text: 'Complete los nombre y apellidos de la persona',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#tipo_documento").val() == null){
                        Snackbar.show({
                            text: 'Seleccione el tipo de documento',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#numero_doc").val().length<1){
                        Snackbar.show({
                            text: 'El número de documento no puede estar vacío',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#direccion").val().length<1){
                        Snackbar.show({
                            text: 'La direccíon no puede estar vacía',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }
                }
                return true;
            },
            onFinished:function(event,currentIndex){
                var block = $("#card_producto");
                $(block).block({ 
                    message: '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Guandando...</span>',
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
               

/* -------------------------------------------------------------------------- */
/*                              Actulizar Persona                             */
/* -------------------------------------------------------------------------- */
                var Form = new FormData(document.forms.namedItem("formulario_articulo"));
                $.ajax({
                    url: "<?=SERVERURL;?>personal/actualizar_persona/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data == 1){
                            Snackbar.show({
                                text: 'Persona actualizado correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            var firstUpload = new FileUploadWithPreview('myFirstImage');
                            firstUpload.clearPreviewPanel();
                            $(block).unblock(); 
                            verformulario();
                        }else if(data==2){
                            Snackbar.show({
                                text: 'Hubo un proble al guardar imagen',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            $(block).unblock(); 
                        }else if(data==0){
                            Snackbar.show({
                                text: 'Hubo un problema al actualizar, presione F5',
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

/* -------------------------------------------------------------------------- */
/*                           Ver Formulario Persona                           */
/* -------------------------------------------------------------------------- */

        let verformulario = () =>{
           let id = "<?=$parametros_persona["ID_PERSONA"]?>";
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
            $.post("<?=SERVERURL?>personal/form_persona/",{id},function(respuesta){
                if($("#ver_persona").html(respuesta)){
                    $(block).unblock();
                }
            })
       }
        
    </script>
</body>
</html>