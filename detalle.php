<?php
if (!isset($_SESSION["usuario"])) {
    echo '<script> window.location.href="' . SERVERURL . 'login/" ;</script>';
}
$parametros_sucursal = $this->parametros_sucursal;
$lista_documentos = $this->lista_documentos;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= SISTEMA_NOMBRE ?> - Sucursal </title>
    <link rel="icon" type="image/x-icon" href="<?= SERVERURL ?>view/assets/assets/img/favicon.ico" />
    <link href="<?= SERVERURL ?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?= SERVERURL ?>view/assets/assets/js/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= SERVERURL; ?>view/assets/plugins/jquery-step/jquery.steps.css">


    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?= SERVERURL ?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= SERVERURL ?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?= SERVERURL ?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?= SERVERURL ?>view/assets/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />

    <link href="<?= SERVERURL; ?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">

    <link href="<?= SERVERURL; ?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= SERVERURL; ?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require_once 'view/components/cmp_navbar.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <?php require_once 'view/components/cmp_topbar.php'; ?>
        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <div class="page-title">
                        <h3> Mi sucursal</h3>
                    </div>
                </div>

                <div class="row layout-spacing">
                    <!-- Content -->
                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
                        <div class="user-profile layout-spacing" id="ver_sucursal">
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                        <div class="skills layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <form autocomplete="off" id="circle-basic" action="#" name="formulario_articulo" enctype="multipart/form-data">
                                    <h3 class="">Detalle </h3>
                                    <section>
                                        <div class="form-row">
                                            <div class="col-xl-8 col-md-12 mb-4">
                                                <label for="nombre_sucursal">Nombre de Sucursal (*)</label>
                                                <input type="text" name="nombre_sucursal" value="<?= $parametros_sucursal["NOMBRE"]; ?>" class="form-control" id="nombre_sucursal">
                                                <input type="hidden" name="id_sucursal" value="<?= $parametros_sucursal["ID_SUCURSAL"]; ?>" class="form-control" maxlength="15" minlength="10" id="id_sucursal" required="">

                                            </div>
                                            <div class="col-xl-4  col-md-12 mb-4">
                                                <label for="tipo_documento">Tipo de documento (*)</label>
                                                <select id="option_um" name="tipo_documento" class="form-control">
                                                    <?php
                                                    foreach ($lista_documentos as $lista) {
                                                        if ($lista["ID_DOCUMENTO"] === $parametros_sucursal["ID_DOCUMENTO"]) {
                                                            echo "<option value='{$lista["ID_DOCUMENTO"]}' selected='true'>{$lista["DOCUMENTO"]} </option>";
                                                        } else {
                                                            echo "<option value='{$lista["ID_DOCUMENTO"]}'>{$lista["DOCUMENTO"]}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-12 mb-4">
                                                <label for="numero">Número de documento (*)</label>
                                                <input type="text" name="numero_doc" value="<?= $parametros_sucursal["NUMERO"]; ?>" class="form-control" id="numero" required="">
                                            </div>
                                            <div class="col-xl-8 col-md-12 mb-4">
                                                <label for="direccion">Direccíon</label>
                                                <input type="text" name="direccion" value="<?= $parametros_sucursal["DIRECCION"]; ?>" class="form-control" maxlength="100" id="direccion" required="">
                                            </div>
                                            <div class="col-xl-2 col-md-12 mb-4">
                                                <label for="iva">IVA (*)</label>
                                                <input type="text" name="iva" value="<?= $parametros_sucursal["IVA"]; ?>" class="form-control" id="iva" required="">
                                            </div>
                                            <div class="col-xl-2 col-md-12 mb-4">
                                                <label for="moneda">MONEDA (*)</label>
                                                <input type="text" name="moneda" value="<?= $parametros_sucursal["MONEDA"]; ?>" class="form-control" id="moneda" required="">
                                            </div>
                                            <div class="col-xl-3 col-md-12 mb-4">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" name="telefono" value="<?= $parametros_sucursal["TELEFONO"]; ?>" class="form-control" maxlength="100" id="telefono" required="">
                                            </div>
                                            <div class="col-xl-4 col-md-12 mb-4">
                                                <label for="email">E-mail (*)</label>
                                                <input type="text" name="email" value="<?= $parametros_sucursal["EMAIL"]; ?>" class="form-control" maxlength="100" id="email" required="">
                                            </div>
                                            <div class="col-xl-9 col-md-12 mb-4">
                                                <label for="representante">Representante (*)</label>
                                                <input type="text" name="representante" value="<?= $parametros_sucursal["REPRESENTANTE"]; ?>" class="form-control" maxlength="100" id="representante" required="">
                                            </div>   
                                            <div class="form-group mb-4 col-xl-1 col-md-12 ">
                                                <label for="estado" class="d-flex mb-3">Estado </label>
                                                <label class="d-flex  switch s-icons s-outline s-outline-info  mr-2">
                                                <?php
                                                    if ($parametros_sucursal["ESTADO"] == 1) {
                                                    ?>
                                                        <input id="estado" name="estado" style="display:none;" type="checkbox" checked>
                                                    <?php
                                                    } else {
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
                                    <h3>Imagen</h3>
                                    <section>
                                        <div class="custom-file-container" data-upload-id="myFirstImage">
                                            <label>Subir imagen referencial del articulo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file">
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
                    <img src="<?= SERVERURL; ?>archives/assets/pos/sucursal.png" alt="sucursal" style="width: 100%;">
                </div>
                <div class="text-center">
                    <a href="<?= SERVERURL; ?>sucursal/sucursales/" class="btn btn-primary mb-4">Abrir Sucursal</a>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= SERVERURL; ?>view/assets/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/bootstrap/js/popper.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/assets/js/app.js"></script>

    <!--SNAKBARS-->
    <script src="<?= SERVERURL; ?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>

    <script src="<?= SERVERURL; ?>view/assets/plugins/blockui/jquery.blockUI.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/plugins/blockui/custom-blockui.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/assets/js/custom.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/plugins/jquery-step/jquery.steps.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="<?= SERVERURL; ?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/plugins/table/datatable/datatables.js"></script>


    <!-- FILEUPLOAD -->
    <script src="<?= SERVERURL; ?>view/assets/plugins/file-upload/file-upload-with-preview.min.js"></script>

    <script>
        $(document).ready(function() {
            verformulario();
            let modal = "<?= $_SESSION["sucursal"] ?>";
            if (modal == 0) {
                $("#modal_no_sucursal").modal('show');
            }
            var firstUpload = new FileUploadWithPreview('myFirstImage');

        });

/* -------------------------------------------------------------------------- */
/*                             Formulario Sucursal                            */
/* -------------------------------------------------------------------------- */

        let verformulario = () => {
            let id = "<?= $parametros_sucursal["ID_SUCURSAL"] ?>";
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
            $.post("<?= SERVERURL ?>sucursal/form_sucursal/", {
                id
            }, function(respuesta) {
                if ($("#ver_sucursal").html(respuesta)) {
                    $(block).unblock();
                }
            })
        }

/* -------------------------------------------------------------------------- */
/*                               Validar Campos                               */
/* -------------------------------------------------------------------------- */

        var form = $("#circle-basic");
        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            cssClass: 'circle wizard',
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex == 0) {
                    if ($("#nombre_sucursal").val().length < 1) {
                        Snackbar.show({
                            text: 'Complete el nombre de sucursal',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    } else if ($("#numero").val().length < 1) {
                        Snackbar.show({
                            text: 'Complete el numero',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    } else if ($("#iva").val().length < 1) {
                        Snackbar.show({
                            text: 'Complete el iva',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    } else if ($("#moneda").val().length < 1) {
                        Snackbar.show({
                            text: 'Complete la moneda',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    } else if ($("#email").val().length < 1) {
                        Snackbar.show({
                            text: 'Complete el email',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;

                    } else if ($("#representante").val().length < 1) {
                        Snackbar.show({
                            text: 'Complete el representante',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }
                }
                return true;
            },
            onFinished: function(event, currentIndex) {
                var block = $("#card_producto");
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

/* -------------------------------------------------------------------------- */
/*                            Actualizar Surcursal                            */
/* -------------------------------------------------------------------------- */

                var Form = new FormData(document.forms.namedItem("formulario_articulo"));
                $.ajax({
                    url: "<?= SERVERURL; ?>sucursal/actualizar_sucursal/",
                    type: "post",
                    data: Form,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data == 1){
                            Snackbar.show({
                                text: 'Sucursal actualizado correctamente',
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
    </script>
</body>