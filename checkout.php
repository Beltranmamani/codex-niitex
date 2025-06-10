<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
    $cliente = mainModel::parametros_cliente_tienda($_SESSION["usuario"]);
    $cliente_1 = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";

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
    <div class="osahan-checkout">
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
                <a class="font-weight-bold text-success text-decoration-none" href="<?=SERVERURL?>tienda/cart/">
                    <i class="icofont-rounded-left back-page"></i></a>
                <h6 class="font-weight-bold m-0 ml-3">Checkout</h6>
                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
    </div>
    <div class="address p-3 bg-white">
        <h6 class="m-0 text-dark d-flex align-items-center">Correo Electronico </h6>
    </div>
    <div class="p-3">
        <div class="form-group__content">
            <input id="correo_chek" class="form-control"disabled  value='<?=$cliente["CORREO"]?>' type="email">
        </div>
    </div>
    <div class="address p-3 bg-white">
        <h6 class="m-0 text-dark d-flex align-items-center">Direcciones </h6>
    </div>
    <div class="p-3">
        <select name="lista_direccion_option" id="lista_direccion_option"  class="form-control">
                                             
        </select> 
    </div>
    <div class="address p-3 bg-white">
        <h6 class="m-0 text-dark d-flex align-items-center">Departamento </h6>
    </div>
    <div class="p-3">
        <div class="form-group__content">
            <select name="departamento" id="departamento" class="form-control">
            <?=$this->lista_departamentos?>    
            </select>                                        
        </div>
    </div>
    <div class="address p-3 bg-white">
        <h6 class="m-0 text-dark d-flex align-items-center">Provincia </h6>
    </div>
    <div class="p-3">
        <div class="form-group__content">
            <select name="provincia" id="provincia" disabled class="form-control">
                
            </select>                                        
                                                
        </div>
    </div>
    <div class="address p-3 bg-white">
        <h6 class="m-0 text-dark">Metodo de pago</h6>
    </div>
    <div class="p-3">
        <a href="#" class="text-success text-decoration-none w-100">
            <div class="d-flex align-items-center">
                <i class="icofont-credit-card"></i> <span class="ml-3">Deposio bancario</span> <i class="icofont-rounded-right ml-auto"></i>
            </div>
        </a>
    </div>

    <div class="address p-3 bg-white">
        <h6 class="text-dark m-0">Total</h6>
    </div>
    <div class="p-3">
        <div class="clearfix">
            <input type="hidden" value="0" id="costo_tarifa">
            <input type="hidden" name="" id="id_provincia">
            <p class="mb-1 text-muted">Items Total <span class="float-right text-dark" id="subtotal_pedido">0</span></p>
            <p class="mb-1 text-muted">Monto de envio <span class="float-right text-dark" id="subtotal_envio">0</span></p>
            <hr>
            <h6 class="font-weight-bold mb-0">TOTAL A PAGAR <span class="float-right" id="total_pedido">0</span></h6>
        </div>
    </div>

    <div class="fixed-bottom">
        <a href="javascript:void(0)" class="btn btn-success btn-block" id="btn_verificacion" >Realizar pedido</a>
    </div>
    <nav id="main-nav">
        <ul class="second-nav">
            <li><a href="index.html"><i class="icofont-smart-phone mr-2"></i> Splash</a></li>
            <li>
                <a href="#"><i class="icofont-login mr-2"></i> Authentication</a>
                <ul>
                    <li> <a href="account-setup.html">Account Setup</a></li>
                    <li><a href="signin.html">Sign in</a></li>
                    <li><a href="signup.html">Sign up</a></li>
                    <li><a href="verification.html">Verification</a></li>
                </ul>
            </li>
            <li><a href="get_started.html"><i class="icofont-check-circled mr-2"></i> Get Started</a></li>
            <li><a href="landing.html"><i class="icofont-paper-plane mr-2"></i> Landing</a></li>
            <li><a href="home.html"><i class="icofont-ui-home mr-2"></i> Homepage</a></li>
            <li><a href="notification.html"><i class="icofont-notification mr-2"></i> Notification</a></li>
            <li><a href="search.html"><i class="icofont-search-1 mr-2"></i> Search</a></li>
            <li><a href="listing.html"><i class="icofont-list mr-2"></i> Listing</a></li>
            <li><a href="picks_today.html"><i class="icofont-flash mr-2"></i> Trending</a></li>
            <li><a href="recommend.html"><i class="icofont-like mr-2"></i> Recommend</a></li>
            <li><a href="fresh_vegan.html"><i class="icofont-badge mr-2"></i> Most Popular</a></li>
            <li><a href="product_details.html"><i class="icofont-search-document mr-2"></i> Product Details</a></li>
            <li><a href="cart.html"><i class="icofont-cart mr-2"></i> Cart</a></li>
            <li><a href="order_address.html"><i class="icofont-location-pin mr-2"></i> Order Address</a></li>
            <li><a href="delivery_time.html"><i class="icofont-ui-calendar mr-2"></i> Delivery Time</a></li>
            <li><a href="order_payment.html"><i class="icofont-money mr-2"></i> Order Payment</a></li>
            <li><a href="checkout.html"><i class="icofont-checked mr-2"></i> Checkout</a></li>
            <li><a href="successful.html"><i class="icofont-gift mr-2"></i> Successful</a></li>
            <li>
                <a href="#"><i class="icofont-sub-listing mr-2"></i> My Order</a>
                <ul>
                    <li><a href="complete_order.html">Complete Order</a></li>
                    <li><a href="status_complete.html">Status Complete</a></li>
                    <li><a href="progress_order.html">Progress Order</a></li>
                    <li><a href="status_onprocess.html">Status on Process</a></li>
                    <li><a href="canceled_order.html">Canceled Order</a></li>
                    <li><a href="status_canceled.html">Status Canceled</a></li>
                    <li><a href="review.html">Review</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icofont-ui-user mr-2"></i> My Account</a>
                <ul>
                    <li> <a href="my_account.html">My Account</a></li>
                    <li><a href="edit_profile.html">Edit Profile</a></li>
                    <li><a href="change_password.html">Change Password</a></li>
                    <li><a href="deactivate_account.html">Deactivate Account</a></li>
                    <li><a href="my_address.html">My Address</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icofont-page mr-2"></i> Pages</a>
                <ul>
                    <li> <a href="promos.html">Promos</a></li>
                    <li><a href="promo_details.html">Promo Details</a></li>
                    <li><a href="terms_conditions.html">Terms & Conditions</a></li>
                    <li><a href="privacy.html">Privacy</a></li>
                    <li><a href="terms&conditions.html">Conditions</a></li>
                    <li> <a href="help_support.html">Help Support</a></li>
                    <li> <a href="help_ticket.html">Help Ticket</a></li>
                    <li> <a href="refund_payment.html">Refund Payment</a></li>
                    <li> <a href="faq.html">FAQ</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icofont-link mr-2"></i> Navigation Link Example</a>
                <ul>
                    <li>
                        <a href="#">Link Example 1</a>
                        <ul>
                            <li>
                                <a href="#">Link Example 1.1</a>
                                <ul>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Link Example 1.2</a>
                                <ul>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Link Example 2</a></li>
                    <li><a href="#">Link Example 3</a></li>
                    <li><a href="#">Link Example 4</a></li>
                    <li data-nav-custom-content>
                        <div class="custom-message">
                            You can add any custom content to your navigation items. This text is just an example.
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="bottom-nav">
            <li class="email">
                <a class="text-success" href="home.html">
                    <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                    Home
                </a>
            </li>
            <li class="github">
                <a href="cart.html">
                    <p class="h5 m-0"><i class="icofont-cart"></i></p>
                    CART
                </a>
            </li>
            <li class="ko-fi">
                <a href="help_ticket.html">
                    <p class="h5 m-0"><i class="icofont-headphone"></i></p>
                    Help
                </a>
            </li>
        </ul>
    </nav>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js"></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="52f3f8a7d4c689c9c144721c-|49" defer=""></script>
    <script>    
        let carrito = {};
        let pedido_cliente = {};
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
            table_carrito();
            nro_deseos();
            direccion_lista();
            pedido_cliente_array();
            $(".header__filter").hide();

        });
         let lista_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
                let cantidad = parseFloat(task.cantidad);

                let select_1 = '';
                let precio = parseFloat(task.precio);
                if(task.PRECIO_ACTIVO == 1 || task.PRECIO_ACTIVO == "1"){
                    select_1 = 'selected';
                    precio = parseFloat(task.PRECIO_VENTA_1);
                }
                let select_2 = '';
                if(task.PRECIO_ACTIVO == 2 || task.PRECIO_ACTIVO == "2"){
                    select_2 = 'selected';
                    precio = parseFloat(task.PRECIO_VENTA_2);
        
                }
                let select_3 = '';
                if(task.PRECIO_ACTIVO == 3 || task.PRECIO_ACTIVO == "3"){
                    select_3 = 'selected';
                    precio = parseFloat(task.PRECIO_VENTA_3);
                }
                let select_4 = '';
                if(task.PRECIO_ACTIVO == 4 || task.PRECIO_ACTIVO == "4"){
                    select_4 = 'selected';
                    precio = parseFloat(task.PRECIO_VENTA_4);
                }
        

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
                        <a href="#">${task.articulo}</a>
                        <p><strong>Vendido por:</strong>  ${task.linea}</p>
                        <small> ${task.cantidad} x <?=$this->moneda?> ${task.precio}</small>
                    </div>
                    </div>
                    `
            });
            let costo = parseFloat($('#costo_tarifa').val());

            $('#subtotal_envio').html(costo.toFixed(2));
            $('.ps-cart__items').html(template);
            $('#carrito_mobile_items').html(template);
            let cantidad_items = carrito.length;
            $("#subtotal_carro").html(sub_total.toFixed(2));
            let total = sub_total+costo;
            $(".precio_carrito_mobile").html("<?=$this->moneda?>"+sub_total.toFixed(2));
            $("#total_pedido").html(total.toFixed(2));
            $("#cantidad_item_carrito").html(cantidad_items);
            $("#numero_items_carrito_mobile").html(cantidad_items);


            
        }
         let pedido_cliente_array = ()=>{
            pedido_cliente = JSON.parse(localStorage.getItem('cliente_pedido')|| "[]");
            $('#costo_tarifa').val(pedido_cliente.tarifa_chek);
            lista_carrito();
         }
         let table_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
            let cantidad = parseFloat(task.cantidad);
            let precio = parseFloat(task.precio);
            if(task.PRECIO_ACTIVO == 1){
                select_1 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_1);
            }
            let select_2 = '';
            if(task.PRECIO_ACTIVO == 2){
                select_2 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_2);
    
            }
            let select_3 = '';
            if(task.PRECIO_ACTIVO == 3){
                select_3 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_3);
            }
            let select_4 = '';
            if(task.PRECIO_ACTIVO == 4){
                select_4 = 'selected';
                precio = parseFloat(task.PRECIO_VENTA_4);
            }
       
            sub_total += cantidad*precio;
            template += `
                    <tr>
                        <td><a href="#">${task.articulo} ×  ${task.cantidad}</a>
                            <p>Vendido por:<strong>${task.linea}</strong></p>
                        </td>
                        <td><?=$this->moneda?> ${task.precio}</td>
                    </tr>
        
                    `
            });
            $('#tb_productos_pedido').html(template);
            $("#subtotal_pedido").html(sub_total.toFixed(2));
            
        }
        let nro_deseos = () =>{
          let id_usuario = "<?=$cliente_1?>";
          if(id_usuario === "none"){
            $("#nro_deseos").html(0);
          }else{
            $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
              $("#nro_deseos").html(res);
            });
          }
        }
        let direccion_lista = () =>{
          let id_usuario = "<?=$cliente_1?>";
          if(id_usuario === "none"){
            $("#nro_deseos").html(0);
          }else{
            $.post("<?=SERVERURL?>tienda/lista_option_direccion/",{id_usuario},function(res){
              $("#lista_direccion_option").html(res);
            });
          }
        }
        $(document).on('click','#btn_verificacion',function(){
            let provincia = $("#provincia").val();
            let direccion = $("#lista_direccion_option").val();
            if(provincia==0||provincia==null){
              toastr["error"]("Seleccione una provincia");
            }else{
              if(direccion==0||direccion==null){
                toastr["error"]("Seleccione una direccion");
              }else{
                let direccion_text = $("#lista_direccion_option option:selected").html();
                let tarifa = $("#provincia option:selected").attr('tarifa');
                let nombre_chek = $("#nombre_chek").val();
                let correo_chek = $("#correo_chek").val();
                let direccion_chek = $("#lista_direccion_option").val();
                let telefono_chek = $("#telefono_chek").val();
                let info_check = $("#info_check").val();
                let pedido = {
                    'id_cliente' : "<?=$_SESSION["usuario"]?>",
                    'nombre_chek' :nombre_chek,
                    'correo_chek' :correo_chek,
                    'provincia_chek' :provincia,
                    'tarifa_chek' : tarifa,
                    'direccion_chek' :direccion_chek,
                    'direccion_text_chek' :direccion_text,
                    'telefono_chek' :telefono_chek,
                    'info_check' :info_check
                }
                localStorage.setItem("cliente_pedido", JSON.stringify(pedido));
                let carrito = JSON.parse(localStorage.getItem('carrito'));
                let cliente_pedido = JSON.parse(localStorage.getItem('cliente_pedido'));
                $.post("<?=SERVERURL?>tienda/guardar_invoice/",{carrito,cliente_pedido},function(res){
                    if(res==1){
                        localStorage.setItem("carrito", JSON.stringify([]));
                        location.href = "<?=SERVERURL?>tienda/success/";
                    }else{
                        alert("No se pudo registrar tu pedido");
                    
                    }
                });
              }

            }
        });
        $(document).on('change','#departamento',function(){
            let id = $(this).val();
            $.post("<?=SERVERURL?>tienda/lista_provincias_departamento/",{id},function(res){
              $("#provincia").html(res);
              $("#provincia").prop('disabled', false);
            });
        });
        $(document).on('change','#provincia',function(){
            let tarifa = $("#provincia option:selected").attr('tarifa');
            $("#costo_tarifa").val(tarifa);
            lista_carrito();
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