<?php
    session_name('B_POS');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
    }
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
                            <form autocomplete="off" id="circle-basic" action="#" name="formulario_articulo" enctype="multipart/form-data">
                                <h3>Información</h3>
                                <section>
                                    <div class="form-row">
                                        <div class="col-xl-3 col-md-12 mb-4">
                                            <label for="cod_barra">Codigo de Barra</label>
                                            <input type="text" name="code_barra" value="<?=$parametros_producto["BARRA"];?>" class="form-control" maxlength="15" minlength="10" id="cod_barra" required>
                                            <input type="hidden" name="id_producto" value="<?=$parametros_producto["ID_PRODUCTO"];?>" class="form-control" maxlength="15" minlength="10" id="id_producto" required>
                                        </div>
                                        <div class="col-xl-9 col-md-12 mb-4">
                                            <label for="producto">Producto</label>
                                            <input type="text" name="producto" value="<?=$parametros_producto["ARTICULO"];?>"  class="form-control" maxlength="100" id="producto" required>
                                        </div>
                                        <div class="col-xl-4 col-md-12 mb-4">
                                            <label for="complemento">Complemento</label>
                                            <input type="text" name="complemento" value="<?=$parametros_producto["COMPLEMENTO"];?>" class="form-control" id="complemento" required>
                                        </div>
                                        <div class="col-xl-4  col-md-12 mb-4">
                                            <label for="option_um">Unidad de medida</label>
                                            <select id="option_um" name="unidad" class="form-control">
                                                <?php
                                                    foreach($lista_unidades as $lista){
                                                        if($lista["ID_UNIDAD"] === $parametros_producto["ID_UNIDAD"]){
                                                            echo "<option value='{$lista["ID_UNIDAD"]}' selected='true'>{$lista["UNIDAD"]} - {$lista["PREFIJO"]}</option>";
                                                        }else{
                                                            echo "<option value='{$lista["ID_UNIDAD"]}'>{$lista["UNIDAD"]} - {$lista["PREFIJO"]}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 col-md-12 mb-4">
                                            <label for="precio_compra">Precio Compra</label>
                                            <input type="text" name="precio_compra" value="<?=$parametros_producto["PRECIO_COSTO"];?>" class="form-control" id="precio_compra" required>
                                        </div>
                                        <div class="col-10">
                                            <div class="row">    
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="precio_venta_3">Precio Venta 7</label>
                                                    <input type="text" name="precio_venta_7" class="form-control"  value="<?=$parametros_producto["PRECIO_VENTA_7"];?>"   maxlength="100" id="precio_venta_7" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="precio_venta_2">Precio Venta 6</label>
                                                    <input type="text" name="precio_venta_6" class="form-control"  value="<?=$parametros_producto["PRECIO_VENTA_6"];?>"   maxlength="100" id="precio_venta_6" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="precio_venta">Precio Venta 5</label>
                                                    <input type="text" name="precio_venta_5" class="form-control"   value="<?=$parametros_producto["PRECIO_VENTA_5"];?>"   maxlength="100" id="precio_venta_5" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="precio_venta_4">Precio Venta 4</label>
                                                    <input type="text" name="precio_venta_4" class="form-control"   value="<?=$parametros_producto["PRECIO_VENTA_4"];?>"   maxlength="100" id="precio_venta_4" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="precio_venta_3">Precio Venta 3</label>
                                                    <input type="text" name="precio_venta_3" class="form-control"  value="<?=$parametros_producto["PRECIO_VENTA_3"];?>"   maxlength="100" id="precio_venta_3" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="precio_venta_2">Precio Venta 2</label>
                                                    <input type="text" name="precio_venta_2" class="form-control"  value="<?=$parametros_producto["PRECIO_VENTA_2"];?>"   maxlength="100" id="precio_venta_2" required>
                                                </div>    
                                            </div>
                                        </div>                         
                                        <div class="col-2">
                                            <div class="row"> 
                                                <div class="col-md-12 mb-4">
                                                    <label for="precio_venta">Precio Venta 1</label>
                                                    <input type="text" name="precio_venta" class="form-control"  value="<?=$parametros_producto["PRECIO_VENTA_1"];?>"    maxlength="100" id="precio_venta" required>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-10">
                                            <div class="row">   
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="medida_3">Medida 7</label>
                                                    <input type="text" name="medida_7" class="form-control" value="<?=$parametros_producto["MEDIDA_7"];?>"   maxlength="100" id="medida_7" required>
                                                </div> 
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="medida_2">Medida 6</label>
                                                    <input type="text" name="medida_6" class="form-control" value="<?=$parametros_producto["MEDIDA_6"];?>"   maxlength="100" id="medida_6" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="medida_1">Medida 5</label>
                                                    <input type="text" name="medida_5" class="form-control" value="<?=$parametros_producto["MEDIDA_5"];?>"   maxlength="100" id="medida_5" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="medida_4">Medida 4</label>
                                                    <input type="text" name="medida_4" class="form-control" value="<?=$parametros_producto["MEDIDA_4"];?>"   maxlength="100" id="medida_4" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="medida_3">Medida 3</label>
                                                    <input type="text" name="medida_3" class="form-control" value="<?=$parametros_producto["MEDIDA_3"];?>"   maxlength="100" id="medida_3" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="medida_2">Medida 2</label>
                                                    <input type="text" name="medida_2" class="form-control" value="<?=$parametros_producto["MEDIDA_2"];?>"   maxlength="100" id="medida_2" required>
                                                </div>     
                                            </div>
                                        </div>                         
                                        <div class="col-2">
                                            <div class="row"> 
                                                <div class="col-md-12 mb-4">
                                                    <label for="medida_1">Medida 1</label>
                                                    <input type="text" name="medida_1" class="form-control" value="<?=$parametros_producto["MEDIDA_1"];?>"   maxlength="100" id="medida_1" required>
                                                </div>
                                            </div>
                                        </div>
                                       
    
                                        <div class="col-10">
                                            <div class="row"> 
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="stock_3">Stock 7</label>
                                                    <input type="text" name="stock_7" class="form-control" value="<?=$parametros_producto["STOCK_7"];?>"   maxlength="100" id="stock_7" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="stock_2">Stock 6</label>
                                                    <input type="text" name="stock_6" class="form-control" value="<?=$parametros_producto["STOCK_6"];?>"   maxlength="100" id="stock_6" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="stock_1">Stock 5</label>
                                                    <input type="text" name="stock_5" class="form-control" value="<?=$parametros_producto["STOCK_5"];?>"   maxlength="100" id="stock_5" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="stock_4">Stock 4</label>
                                                    <input type="text" name="stock_4" class="form-control" value="<?=$parametros_producto["STOCK_4"];?>"   maxlength="100" id="stock_4" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="stock_3">Stock 3</label>
                                                    <input type="text" name="stock_3" class="form-control" value="<?=$parametros_producto["STOCK_3"];?>"   maxlength="100" id="stock_3" required>
                                                </div>
                                                <div class="col-xl-2 col-md-12 mb-4">
                                                    <label for="stock_2">Stock 2</label>
                                                    <input type="text" name="stock_2" class="form-control" value="<?=$parametros_producto["STOCK_2"];?>"   maxlength="100" id="stock_2" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="row"> 
                                                <div class="col-md-12 mb-4">
                                                    <label for="stock_1">Stock 1</label>
                                                    <input type="text" name="stock_1" class="form-control" value="<?=$parametros_producto["STOCK_1"];?>"    maxlength="100" id="stock_1" required>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </section>
                                <h3>Caracterisitcas</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="option_marca">Línea</label>
                                            <select id="option_marca" name="linea" class="form-control">
                                            <?php
                                                    foreach($lista_linea as $lista){
                                                        if($lista["ID_LINEA"] === $parametros_producto["ID_LINEA"]){
                                                            echo "<option value='{$lista["ID_LINEA"]}' selected='true'>{$lista["LINEA"]} </option>";
                                                        }else{
                                                            echo "<option value='{$lista["ID_LINEA"]}'>{$lista["LINEA"]} </option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="option_categoria">Presentación</label>
                                            <select id="option_categoria" name="presentacion" class="form-control">
                                            <?php
                                                    foreach($lista_presentacion as $lista){
                                                        if($lista["ID_PRESENTACION"] === $parametros_producto["ID_PRESENTACION"]){
                                                            echo "<option value='{$lista["ID_PRESENTACION"]}' selected='true'>{$lista["NOMBRE"]} </option>";
                                                        }else{
                                                            echo "<option value='{$lista["ID_PRESENTACION"]}'>{$lista["NOMBRE"]}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4 col-sm-4">
                                            <label for="stock3">Stock Minimo</label>
                                            <input type="text" class="form-control" name="stock1" value="<?=$parametros_producto["STOCK_MINIMO"];?>" id="stock1" placeholder="EJ. 30" required>
                                        </div>
                                        <div class="form-group mb-4 col-sm-4">
                                            <label for="stock2">Stock Medio</label>
                                            <input type="text" class="form-control" name="stock2" value="<?=$parametros_producto["STOCK_MEDIO"];?>" id="stock2" placeholder="EJ. 30" required>
                                        </div>
                                        <div class="form-group mb-4 col-sm-4">
                                            <label for="stock1">Stock Moderado</label>
                                            <input type="text" class="form-control" name="stock3" id="stock3" value="<?=$parametros_producto["STOCK_MODERADO"];?>" placeholder="EJ. 30" required>
                                        </div>
                                        <div class="form-group mb-2 col-sm-12">
                                            <label for="perecedero">Perecedero</label>
                                        </div>
                                        <div class="form-group mb-4 col-sm-12 d-flex aling-items-center">
                                            <label class="switch s-icons s-outline s-outline-info  mr-2">
                                                <?php 
                                                    if($parametros_producto["PERECEDERO"] == 1){
                                                ?>
                                                        <input id="perecedero" name="perecedero" style="display:none;" type="checkbox" checked>
                                                <?php	
                                                    }else{
                                                ?>
                                                        <input id="perecedero" name="perecedero" style="display:none;" type="checkbox">
                                                <?php        
                                                    }
                                                ?>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="form-group mb-2 col-sm-12">
                                            <label for="excento">Exento</label>
                                        </div>
                                        <div class="form-group mb-4 col-sm-12 d-flex aling-items-center">
                                            <label class="switch s-icons s-outline s-outline-info  mr-2">
                                            <?php 
                                                    if($parametros_producto["EXENTO"] == 1){
                                                ?>
                                                <input id="excento" name="excento" style="display:none;" type="checkbox" checked>         
                                                <?php	
                                                    }else{
                                                ?>
                                                        <input id="excento" name="excento" style="display:none;" type="checkbox">
                                                <?php        
                                                    }
                                                ?> 
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="form-group mb-2 col-sm-12">
                                            <label for="estado">Estado</label>
                                        </div>
                                        <div class="form-group mb-4 col-sm-12 d-flex aling-items-center">
                                            <label class="switch s-icons s-outline s-outline-info  mr-2">
                                            <?php 
                                                    if($parametros_producto["ESTADO"] == 1){
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
                                <h3>Imagen</h3>
                                <section>
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Subir imagen referencial del articulo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
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
    <script src="<?=SERVERURL;?>view/assets/plugins/jquery-stepps/jquery.steps.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/components/notification/custom-snackbar.js"></script>
    <script src="<?=SERVERURL;?>view/assets/assets/js/scrollspyNav.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/input-mask/input-mask.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/select2/select2.min.js"></script>
    <script src="<?=SERVERURL;?>view/assets/plugins/file-upload/file-upload-with-preview.min.js"></script>
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
            
        
           
            $('#producto').maxlength({
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
                    if($("#cod_barra").val().length<1 || $("#producto").val().length<1){
                        Snackbar.show({
                            text: 'Complete el codigo de barra y el nombre de producto',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#option_um").val() == null){
                        Snackbar.show({
                            text: 'Seleccione la unidad de medida',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#complemento").val().length<1){
                        Snackbar.show({
                            text: 'El complemento no puede quedae vacío',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#precio_compra").val().length<1  || isNaN($("#precio_compra").val()) || $("#precio_venta").val().length<1  || isNaN($("#precio_venta").val())  || $("#precio_venta_2").val().length<1 || isNaN($("#precio_venta_2").val())  || $("#precio_venta_3").val().length<1  || isNaN($("#precio_venta_3").val()) || $("#precio_venta_4").val().length<1 || isNaN($("#precio_venta_4").val())){
                        Snackbar.show({
                            text: 'Complete los precios de compra y venta',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#stock_1").val().length<1  || isNaN($("#stock_1").val()) || $("#stock_2").val().length<1 || isNaN($("#stock_2").val())  || $("#stock_3").val().length<1  || isNaN($("#stock_3").val()) || $("#stock_4").val().length<1 || isNaN($("#stock_4").val())){
                        Snackbar.show({
                            text: 'Complete los stock 1, 2, 3 ó 4',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }else if($("#medida_1").val().length<1  || $("#medida_2").val().length<1  || $("#medida_3").val().length<1  || $("#medida_4").val().length<1 ){
                        Snackbar.show({
                            text: 'Complete las Medidas 1, 2, 3 ó 4',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }
                }
                if(currentIndex == 1){
                    if($("#option_marca").val() == null){
                        Snackbar.show({
                            text: 'Seleccione una Línea',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }
                    if($("#option_categoria").val() == null){
                        Snackbar.show({
                            text: 'Seleccione una Presentación',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a',
                            pos: 'top-right'
                        });
                        return false;
                    }
                    if($("#stock1").val().length<1 || $("#stock2").val().length<1 || $("#stock3").val().length<1){
                        Snackbar.show({
                            text: 'Complete los diferentes tipos de stock.',
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


/* -------------------------------------------------------------------------- */
/*                             Actualizar Producto                            */
/* -------------------------------------------------------------------------- */

                var Form = new FormData(document.forms.namedItem("formulario_articulo"));
                $.ajax({
                    url: "<?=SERVERURL;?>productos/actualizar_producto/",
                    type: "post",
                    data : Form,
                    processData: false,
                    contentType: false,
                    success: function(data)
                    {
                        if(data == 1){
                            Snackbar.show({
                                text: 'Producto actualizado correctamente',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            var firstUpload = new FileUploadWithPreview('myFirstImage');
                            firstUpload.clearPreviewPanel();
                            $(block).unblock(); 
                            verformulario();
                            location.href ="<?=SERVERURL?>productos/";
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
    </script>
</body>
</html>
