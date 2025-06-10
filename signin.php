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

    <div class="osahan-signin">
        <div class="border-bottom p-3 d-flex align-items-center">
            <a class="font-weight-bold text-success text-decoration-none" href="account-setup.html"><i class="icofont-rounded-left back-page"></i></a>
            <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
        </div>
        <div class="p-3">
            <h2 class="my-0">Bienvenido!</h2>
            <p class="small">Inicia sesion para continuar.</p>
            <form action="get_started.html" id="login-form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input placeholder="Enter Email" id="correo" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input placeholder="Enter Password" id="pass" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" id="btn_log" class="btn btn-success btn-lg rounded btn-block">Iniciar Sesion</button>
            </form>
        </div>
    </div>

    <div class="osahan-fotter fixed-bottom">
        <a href="<?=SERVERURL?>tienda/signup/" class="btn btn-block btn-lg bg-white">No tienes una cuenta? Registrate</a>
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
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="158cf87fd9a90680accc0755-|49" defer=""></script>
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
            // window.demo = new Demo(document.querySelector("#grid"));
            if(localStorage.getItem('carrito')){
                carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            }
            lista_carrito();
            // nro_deseos();
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
                      <small> ${task.cantidad} x $ ${task.precio}</small>
                    </div>
                  </div>
                  `
          });
          $('.ps-cart__items').html(template);
          $('#carrito_mobile_items').html(template);
          let cantidad_items = carrito.length;
          $("#subtotal_carro").html(sub_total.toFixed(2));
          $(".precio_carrito_mobile").html("Bs."+sub_total.toFixed(2));
          $("#cantidad_item_carrito").html(cantidad_items);
          $("#numero_items_carrito_mobile").html(cantidad_items);

          
        }
        $(document).on('click','#btn_reg',function(){
            let correo_reg = $("#correo_reg").val();
            let pass_reg = $("#pass_reg").val();
            if(correo_reg.length == 0 || pass_reg.length == 0){
                toastr["error"]("Complete todos los campos");

            }else{
                $.post("<?=SERVERURL?>tienda/registrarse/",{correo_reg,pass_reg},function(res){
                    if(res==1){
                        toastr["success"]("Su registro se realizo correctamente");
                        $("#correo_reg").val("");
                        $("#pass_reg").val("");
                    }else{
                        toastr["error"]("No se pudo registrar");
                    }
                });
            }
        });
        $(document).on('submit','#login-form',function(e){
            e.preventDefault()
            let correo = $("#correo").val();
            let pass = $("#pass").val();
            if(correo.length == 0 || pass.length == 0){
                toastr["error"]("Complete todos los campos");

            }else{
                $.post("<?=SERVERURL?>tienda/iniciar_sesion/",{correo,pass},function(res){
                    if(res==1){
                      toastr["success"]("Inicio de sesion correcta");
                      location.href="<?=SERVERURL?>tienda/grocery/";
                    }else{
                      toastr["error"]("No se pudo iniciar sesion");
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
          $(document).on('change','#mostrar',function(){
                if( $('#mostrar').prop('checked') ) {
                    $("#pass").attr('type','text');
                }else{
                    $("#pass").attr('type','password');
                }
           
          });
          $(document).on('change','#mostrar2',function(){
                if( $('#mostrar2').prop('checked') ) {
                    $("#pass_reg").attr('type','text');
                }else{
                    $("#pass_reg").attr('type','password');
                }
           
          });
    </script>
</body>

</html>