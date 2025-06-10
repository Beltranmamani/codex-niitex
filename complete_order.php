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
    <div class="osahan-order">
        <div class="order-menu">
            <h5 class="font-weight-bold p-3 d-flex align-items-center">Pedidos <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a></h5>
            <div class="row m-0 text-center">
                <div class="col pb-2 border-success border-bottom">
                    <a href="javascript:void(0)" class="text-success font-weight-bold text-decoration-none">Mi lista de pedidos</a>
                </div>

            </div>
        </div>
        <div class="order-body px-3 pt-3" id="tr_cliente">
            

        </div>
    </div>

    <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
        <div class="row m-0">
        <a href="<?=SERVERURL?>tienda/grocery/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-grocery"></i></p>
               Tienda
            </a>
            <a href="<?=SERVERURL?>tienda/cart/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class=" icofont-cart"></i></p>
                Carrito
            </a>
            <a href="javascript:void(0)" class="text-dark small col font-weight-bold text-decoration-none p-2 selected">
                <p class="h5 m-0"><i class="text-success  icofont-bag"></i></p>
                Pedidos
            </a>
            <a href="<?=SERVERURL?>tienda/perfil/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-user"></i></p>
                Cuenta
            </a>
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

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="eaf4458f087a88d8982de809-|49" defer=""></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

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

            lista_de_pedidos();
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
        let lista_de_pedidos = () =>{
          let id_usuario = "<?=$_SESSION['usuario']?>";;
          $.post("<?=SERVERURL?>tienda/lista_pedidos_cliente/",{id_usuario},function(res){
            $("#tr_cliente").html(res);
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
        $(document).on('submit','#enviar_documento',function(e){
          e.preventDefault();
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