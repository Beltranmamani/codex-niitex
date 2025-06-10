<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
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
    <title><?=SISTEMA_NOMBRE;?> - Nueva Sucursal </title>
    <link rel="icon" type="image/x-icon" href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico"/>
    <link href="<?=SERVERURL;?>view/assets/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?=SERVERURL;?>view/assets/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/plugins/jquery-step/jquery.steps.css">
    <link href="<?=SERVERURL?>view/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL?>view/assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

   
    <link href="<?= SERVERURL ?>view/assets/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />


    <link href="<?= SERVERURL; ?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />

    <link href="<?= SERVERURL; ?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=SERVERURL;?>view/assets/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.css">
    <link href="<?=SERVERURL;?>view/assets/assets/css/forms/switches.css" rel="stylesheet" type="text/css">
    <link href="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=SERVERURL;?>view/assets/assets/css/elements/alert.css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">

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
                    <div class="col-xl-8 col-12">
                        <div class="widget-content widget-content-area" id="card_producto">
                            <form autocomplete="off" id="circle-basic" action="#" name="formulario_articulo" enctype="multipart/form-data">
                                <h3>Dosificacion</h3>
                                <section>
                                    <div class="form-row">
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="numero">Numero de Autorizacion</label>
                                            <input type="text" maxlength="100" name="numero" id="numero" value="<?= $parametros_sucursal["NOMBRE"]; ?>" class="form-control" id="numero">
                                            <input type="hidden" name="id_sucursal" value="<?= $parametros_sucursal["ID_SUCURSAL"]; ?>" class="form-control" id="id_sucursal">
                                         </div>
                                       
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="llave">Llave de dosificación</label>
                                            <input type="text" name="llave" value="<?= $parametros_sucursal["DIRECCION"]; ?>" class="form-control" maxlength="100" id="llave" required="">
                                        </div>
                                        <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="date">Fecha Limite de emisión</label>
                                            <input type="text" id="date" name="date" class="form-control" >
                                        </div>
                                         <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="l1">Leyenda 1 para facturacion</label>
                                            <input type="text" name="l1" value="<?= $parametros_sucursal["DIRECCION"]; ?>" class="form-control" maxlength="100" id="l1" required="">
                                        </div>
                                         <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="l2">Leyenda 2 para facturacion</label>
                                            <input type="text" name="l2" value="<?= $parametros_sucursal["DIRECCION"]; ?>" class="form-control" maxlength="100" id="l2" required="">
                                        </div>
                                         <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="l3">Leyenda 3 para facturacion</label>
                                            <input type="text" name="l3" value="<?= $parametros_sucursal["DIRECCION"]; ?>" class="form-control" maxlength="100" id="l3" required="">
                                        </div>
                                         <div class="col-xl-6 col-md-12 mb-4">
                                            <label for="l4">Leyenda 4 para facturacion</label>
                                            <input type="text" name="l4" value="<?= $parametros_sucursal["DIRECCION"]; ?>" class="form-control" maxlength="100" id="l4" required="">
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


   
    <script src="<?= SERVERURL; ?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>

    <script src="<?= SERVERURL; ?>view/assets/plugins/table/datatable/datatables.js"></script>

    <script src="<?= SERVERURL; ?>view/assets/plugins/apex/apexcharts.min.js"></script>
    <script src="<?= SERVERURL; ?>view/assets/plugins/table/datatable/datatables.js"></script>
     <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/noUiSlider/nouislider.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/flatpickr/custom-flatpickr.js"></script>



    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function(){
            $("#vista_sucursales , #view_administracion").addClass("active");
            $("#date").flatpickr({
                 dateFormat: "d-m-Y",
                
            });
            verdosificacion();
           
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
                    if($("#nombre_sucursal").val().length<1){
                        Snackbar.show({
                            text: 'Complete el nombre de la sucursal',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#tipo_documento").val() == null){
                        Snackbar.show({
                            text: 'Seleccione el tipo de documento de la sucursal',
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
                    }else if($("#iva").val().length<1){
                        Snackbar.show({
                            text: 'El impuesto no puede estar vacío',
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

                var Form = new FormData(document.forms.namedItem("formulario_articulo"));
                $.ajax({
                    url: "<?= SERVERURL; ?>sucursal/dosificar_sucursal/",
                    type: "post",
                    data: Form,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data == 1){
                            Snackbar.show({
                                text: 'Sucursal dosificada correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                       
                            $(block).unblock(); 
                            verformulario();
                        }else if(data==2){
                            Snackbar.show({
                                text: 'Hubo un proble',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                pos: 'top-right'
                            });
                            $(block).unblock(); 
                        }else if(data==0){
                            Snackbar.show({
                                text: 'Hubo un problema al dosificar, presione F5',
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

                
        let verdosificacion = () => {
            let id = "<?= $parametros_sucursal["ID_SUCURSAL"] ?>";
            $.post("<?= SERVERURL ?>sucursal/dosificacion_sucursal/", {
                id
            }, function(res) {
                let jres = JSON.parse(res);
                $("#llave").val(jres.LLAVE);
                $("#numero").val(jres.NUMERO);
                $("#date").val(jres.FECHA);
                $("#l1").val(jres.L1);
                $("#l2").val(jres.L2);
                $("#l3").val(jres.L3);
                $("#l4").val(jres.L4);
            })
        }
    </script>
</body>
</html>