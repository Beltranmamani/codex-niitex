<?php
    $parametros_persona = $this->parametros_persona;
    $parametros_usuario = $this->parametros_usuario;
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

    <!-- MODALS -->
    <link href="<?=SERVERURL;?>view/assets/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
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
                                <h3>Configuración de mi cuenta</h3>
                                <section>
                                    <div class="form-row">
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="nombre">Correo </label>
                                            <input type="email" class="form-control"  value="<?=$parametros_usuario['EMAIL']?>" id="correo1" name="correo" placeholder="correoexample@gmail.com" required>
                                            <input type="hidden" class="form-control"  value="<?=$_SESSION['usuario']?>" id="usuario" name="id_usuario" placeholder="correoexample@gmail.com" required>
                                       </div>
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="nombre">Password </label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD..." >
                                        </div>
                                        
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
    <!-- MODALS -->
    <div class="modal fade profile-modal" id="profileModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-header justify-content-center" id="profileModalLabel">
                <div class="modal-profile mt-4 text-center">
                    <img alt="avatar" src="<?=SERVERURL;?>archives/avatars/<?=$_SESSION['perfil_persona']?>" class="rounded-circle" style="width: 50%;background-color: white;">
                </div>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-2"><b><?php echo strtoupper($_SESSION["nombre_persona"]);?></b>, ingrese su contraseña actual para continuar.</p>
                    <input type="password" class="form-control" id="revisar_password" placeholder="Ingrese su contraseña...">
                </div>
                <div class="modal-footer justify-content-center mb-4">
                <button type="button" id="btn_continuar" class="btn btn-success">Continuar</button>
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

/* ========================================================================== */
/*                                Validar email                               */
/* ========================================================================== */

        var form = $("#circle-basic");
        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            cssClass: 'circle wizard',
            onFinished:function(event,currentIndex){
                let correo = $("#correo1").val();
                if(correo.length>1){
                    if (/^\w+([\.-]?\w+)*@(?:|hotmail|outlook|yahoo|live|gmail)\.(?:|com|es)+$/.test(correo)){
                        $("#profileModal").modal("show");
                    } else {
                        Snackbar.show({
                            text: 'El correo es incorrecto',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false
                    }
                }else{
                    Snackbar.show({
                        text: 'El correo no puede estar vacio',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a',
                        pos: 'top-right'
                    });
                    return false
                }
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
        $("#btn_continuar").click(function(){
            if($("#revisar_password").val() === "<?php echo mainModel::decryption($parametros_usuario['PASSWORD']);?>"){
                var Form = new FormData(document.forms.namedItem("formulario_articulo"));       
                $.ajax({
                    url: "<?=SERVERURL;?>personal/actualizar_cuenta/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data == 1){

                            Snackbar.show({
                                text: 'Cuenta actualizado correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            $("#profileModal").modal("hide");
                            var block = $("#container");
                            var message = '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Cerrando sesion por temas de seguridad.</span>';
                            $(block).block({ 
                                message: message,
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
                            window.setTimeout(function () {
                                var message = '<span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin position-left"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg></i>&nbsp; Espere un momento...</span>';
                                $(block).block({ 
                                    message: message,
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
                            }, 2000); 

                            setTimeout("redireccionar()", 5000); //tiempo expresado en milisegundos
                        }else{
                            Snackbar.show({                          
                                text: 'No se pudo actualizar.',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                        }
                    }
                });   
            }else{
                Snackbar.show({
                    text: 'Contraseña incorrecta,intente nuevamente',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right'
                });
                $("#revisar_password").val("");
                return false;
            }
        });
        function redireccionar(){
            window.location="<?=SERVERURL;?>login/cerrar_sesion/";
        } 
    </script>
</body>
</html>