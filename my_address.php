<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
    $cliente = mainModel::parametros_cliente_tienda($_SESSION["usuario"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?= SERVERURL ?>view/newtienda/img/logo.svg">
    <title>Grofar - Online Grocery Supermarket HTML Mobile Template</title>

    <link rel="stylesheet" type="text/css" href="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= SERVERURL ?>view/newtienda/vendor/slick/slick-theme.min.css" />

    <link href="<?= SERVERURL ?>view/newtienda/vendor/icons/icofont.min.css" rel="stylesheet" type="text/css">

    <link href="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?= SERVERURL ?>view/newtienda/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.css">
    <link href="<?= SERVERURL ?>view/newtienda/vendor/sidebar/demo.css" rel="stylesheet">
</head>

<body class="fixed-bottom-padding">
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
        </label>
        <em>Enable Dark Mode!</em>
    </div>
    <div class="osahan-my_address">
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
                <a class="font-weight-bold text-success text-decoration-none" href="<?= SERVERURL ?>tienda/perfil/">
                    <i class="icofont-rounded-left back-page"></i></a>
                <h5 class="font-weight-bold m-0 ml-3">Mis direcciones</h5>
                <button type="button" class="btn btn-outline-success btn-sm ml-auto" data-toggle="modal" data-target="#exampleModal">Agregar</button>
                <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
        <div class="p-3" id="tr_body">
            
        </div>
    </div>

    <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
        <div class="row m-0">
            <a href="<?=SERVERURL?>tienda/grocery/" class="text-dark small col text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-grocery"></i></p>
                Tienda
            </a>
            <a href="<?=SERVERURL?>tienda/cart/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-cart"></i></p>
                Carrito
            </a>
            <a href="<?=SERVERURL?>tienda/pedidos/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-bag"></i></p>
                Mis pedidos
            </a>
            <a href="<?=SERVERURL?>tienda/perfil/" class="text-muted small font-weight-bold col text-decoration-none p-2 selected">
                <p class="h5 m-0"><i class="text-success icofont-user"></i></p>
                Cuenta
            </a>
        </div>
    </div>

    <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center d-flex align-items-center">
                    <div class="w-100 px-3">
                        <i class="icofont-trash text-danger display-1 mb-5"></i>
                        <h6>Are you sure you want to delete this?</h6>
                        <p class="small text-muted m-0">1001 Veterans Blvd</p>
                        <p class="small text-muted m-0">Redwood City, CA 94063</p>
                    </div>
                </div>
                <div class="modal-footer p-0 border-0">
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn btn-danger btn-lg btn-block">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar direccion Delivery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="save">
                        <div class="form-row">
                            <input type="hidden"   value='<?=$cliente["ID_CLIENTE"]?>' name='id'>

                            <div class="col-md-12 form-group">
                                <label class="form-label">Direccion</label>
                                <div class="input-group">
                                    <input placeholder="Direccion"  name="direccion" id="direccion" type="text" class="form-control">
                                    <div class="input-group-append"><button id="button-addon2" type="button" class="btn btn-outline-secondary"><i class="icofont-pin"></i></button></div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer p-0 border-0">
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="col-6 m-0 p-0">
                        <button type="button" id="agregar_direccion" class="btn btn-success btn-lg btn-block">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar direccion Delivery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="save2" id="modal_direccion_detalle">
                        
                    </form>
                </div>
                <div class="modal-footer p-0 border-0">
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="col-6 m-0 p-0">
                        <button type="button" id="update_direccion" class="btn btn-success btn-lg btn-block">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <nav id="main-nav">
        <ul class="second-nav">
    
            <li><a href="<?=SERVERURL?>tienda/grocery/"><i class="icofont-ui-home mr-2"></i> Tienda</a></li>
            <li><a href="<?=SERVERURL?>tienda/pedidos/"><i class="icofont-notification mr-2"></i> Pedidos</a></li>
            <li><a href="<?=SERVERURL?>tienda/direcciones/"><i class="icofont-location-pin mr-2"></i> Direcciones</a></li>
            <li><a href="<?=SERVERURL?>tienda/perfil/"><i class="icofont-list mr-2"></i> Perfil</a></li>
            <li>
                <a href="#"><i class="icofont-search-document mr-2 mr-2"></i> Secciones</a>
                <ul>
                    <?=$this->lista_secciones?>
                 </ul>
             </li>
           

        </ul>
        <ul class="bottom-nav">
            <li class="email">
                <a class="text-success" href="<?=SERVERURL?>tienda/grocery/">
                    <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                    Tienda
                </a>
            </li>
            <li class="github">
                <a href="<?=SERVERURL?>tienda/cart/">
                    <p class="h5 m-0"><i class="icofont-cart"></i></p>
                    Carrito
                </a>
            </li>
        </ul>
    </nav>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js"></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="83aabc39366c634d7d4740b1-|49" defer=""></script>
    <script>
        let carrito = {};
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "3000",
          "timeOut": "5000",
          "extendedTimeOut": "3000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        ;
        document.addEventListener("DOMContentLoaded", function () {
            if(localStorage.getItem('carrito')){
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            }
            lista_carrito();
            nro_deseos();
            direcciones_table();
            $(".header__filter").hide();

        });
         let lista_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
            let cantidad = parseFloat(task.cantidad);
            let precio =  parseFloat(task.precio);
            sub_total += cantidad*precio;
            template += `
                    <div class="ps-product--cart-mobile">
                    <div class="ps-product__thumbnail">
                        <a href="#"><img src="${task.imagen}" alt=""></a>
                    </div>
                    <div class="ps-product__content">
                        <a class="ps-product__remove btn_eliminar_item_carrito" id_item="${task.id_item}">
                        <i class="icon-cross"></i>
                        </a>
                        <a href="product-default.html">${task.articulo}</a>
                        <p><strong>Vendido por:</strong>  ${task.linea}</p>
                        <small> ${task.cantidad} x <?=$this->moneda?> ${task.precio}</small>
                    </div>
                    </div>
                    `
            });
            $('.ps-cart__items').html(template);
            $('#carrito_mobile_items').html(template);
            let cantidad_items = carrito.length;
            $("#subtotal_carro").html(sub_total.toFixed(2));
            $(".precio_carrito_mobile").html("<?=$this->moneda?> "+sub_total.toFixed(2));
            $("#cantidad_item_carrito").html(cantidad_items);
            $("#numero_items_carrito_mobile").html(cantidad_items);

            
        }
        let nro_deseos = () =>{
          let id_usuario = "<?=$_SESSION['usuario']?>";;
          $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
            $("#nro_deseos").html(res);
          });
        }
        $(document).on('submit','#enviar_datos',function(e){
          e.preventDefault();
          var Form = new FormData(document.forms.namedItem("enviar_datos"));
          $.ajax({
              url: "<?=SERVERURL;?>tienda/actualizar_datos_cliente/",
              type: "post",
              data : Form,
              processData: false,
              contentType: false,
              success: function(data)
              {
                if(data==1){
                  toastr["success"]("Tus datos se han actualizado correctamente");
                }else{
                  toastr["error"]("No se ha guardado ningun cambio");
                }
              }
          }); 
        });
        $(document).on('click','#agregar_direccion',function(){
          let dir = $("#direccion").val();
          if(dir.length<=1){
            toastr["error"]("Campo vacio");
          }else{
            var Form = new FormData(document.forms.namedItem("save"));
            $.ajax({
                url: "<?=SERVERURL;?>tienda/agregar_direccion/",
                type: "post",
                data : Form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    if(data==1){
                      toastr["success"]("Direccion agregada");
                      $("#direccion").val("");
                      direcciones_table();
                    }else{
                      toastr["error"]("No se pudo");
                    }
                }
            }); 
          }
        });
        $(document).on('click','#update_direccion',function(){
          let dir = $("#direccion_2").val();
          if(dir.length<=1){
            toastr["error"]("Campo vacio");
          }else{
            var Form = new FormData(document.forms.namedItem("save2"));
            $.ajax({
                url: "<?=SERVERURL;?>tienda/actualizar_direccion/",
                type: "post",
                data : Form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    if(data==1){
                      toastr["success"]("Direccion actualizada");
                      $("#direccion_2").val("");
                      $("#modal_editar_direccion").modal('hide');
                      direcciones_table();
                    }else{
                      toastr["error"]("No se pudo");
                    }
                }
            }); 
          }
        });
        $(document).on('click','.btn_editar',function(){
          let id = $(this).attr('edit');
          $.post("<?=SERVERURL?>tienda/detalle_modal_direccion/",{id},function(res){
                 $("#modal_direccion_detalle").html(res);
            });
        });
        $(document).on('submit','#enviar_documento',function(e){
          e.preventDefault();
          let dir = $("#direccion").val();
          if(dir.length<=1){

          }else{
            var Form = new FormData(document.forms.namedItem("enviar_documento"));
            $.ajax({
                url: "<?=SERVERURL;?>tienda/actualizar_documentos_cliente/",
                type: "post",
                data : Form,
                processData: false,
                contentType: false,
                success: function(data)
                {
                    
                    if(data==1){
                    toastr["success"]("Tus datos se han actualizado correctamente");
                    }else{
                    toastr["error"]("No se ha guardado ningun cambio");
                    }
                }
            }); 
          }
        });
        $(document).on('input','.txtbuscar_producto',function(){
          let valor = $(this).val();
          let elementos = document.querySelectorAll('.nodos_productos_search .ps-product--search-result');
          if(elementos.length>0){
            for (let i = 1; i <= elementos.length; i++) {
              let articulo = $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').attr('articulo');
              let precio = $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').attr('precio');
              articulo = articulo.toLowerCase();
              valor = valor.toLowerCase();
              if(articulo.indexOf(valor)>-1 || precio.indexOf(valor)>-1){
                $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').show();

              }else{
                $('.nodos_productos_search .ps-product--search-result:nth-child('+i+')').hide();
              }

            }
          }
        });
        let direcciones_table = ()=>{
            let id_usuario = "<?=$_SESSION['usuario']?>";;
            $.post("<?=SERVERURL?>tienda/lista_tabla_direccion/",{id_usuario},function(res){
                 $("#tr_body").html(res);
            });
        }
        $(document).on('input','#txt_buscar',function(){
            let valor = $(this).val();
            let elementos = document.querySelectorAll('.navigation__content .ps-product--search-result');
            if(elementos.length>0){
              for (let i = 1; i <= elementos.length; i++) {
                let articulo = $('.navigation__content .ps-product--search-result:nth-child('+i+')').attr('articulo');
                let precio = $('.navigation__content .ps-product--search-result:nth-child('+i+')').attr('precio');
                articulo = articulo.toLowerCase();
                valor = valor.toLowerCase();
                if(articulo.indexOf(valor)>-1 || precio.indexOf(valor)>-1){
                  $('.navigation__content .ps-product--search-result:nth-child('+i+')').show();
    
                }else{
                  $('.navigation__content .ps-product--search-result:nth-child('+i+')').hide();
                }
    
              }
            }
          });
    </script>
</body>

</html>