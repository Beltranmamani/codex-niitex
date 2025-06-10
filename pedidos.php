<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
    $cliente = mainModel::parametros_cliente_tienda($_SESSION["usuario"]);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <title><?=SISTEMA_NOMBRE?> - Pedidos</title>
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/owl-carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/css/style.css">
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.css">
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>
    <link rel="manifest" href="<?=SERVERURL;?>manifest.json">

  </head>
  <body>
    <?php
        require "view/tienda/components/navbar.php";
    ?>

    <main class="ps-page--my-account">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="<?=SERVERURL?>tienda/online/">Inicio</a></li>
            <li>Informacion de usuario</li>
          </ul>
        </div>
      </div>
      <section class="ps-section--account">
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="ps-section__left">
                  <aside class="ps-widget--account-dashboard">
                    <div class="ps-widget__header"><img src="<?=SERVERURL?>archives/avatars/<?=$cliente["PERFIL"]?>" alt="">
                      <figure>
                        <figcaption><?=$cliente["NOMBRE"]?></figcaption>
                        <p><a href="#"><span class="__cf_email__" ><?=$cliente["CORREO"]?></span></a></p>
                      </figure>
                    </div>
                    <div class="ps-widget__content">
                      <ul>
                        <li >
                          <a href="<?=SERVERURL?>tienda/perfil/"><i class="icon-user"></i> Mi cuenta</a>
                        </li>
                        <li><a href="<?=SERVERURL?>tienda/notificaciones/"><i class="icon-alarm-ringing"></i> Notificaciones</a></li>
                        <li class="active"><a href="#"><i class="icon-papers"></i> Pedidos</a></li>
                        <li><a href="<?=SERVERURL?>tienda/direcciones/"><i class="icon-map-marker"></i> Direcciones</a></li>
                        <li><a href="<?=SERVERURL?>tienda/wishlist/"><i class="icon-heart"></i> Mi lista de deseos</a></li>
                        <li><a href="<?=SERVERURL?>tienda/cerrar_sesion/"><i class="icon-power-switch"></i>Cerrar Sesión</a></li>
                      </ul>
                    </div>
                  </aside>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="ps-section__right">
                <div class="ps-section--account-setting">
                    <div class="ps-section__header">
                        <h3>Mis Pedidos</h3>
                    </div>
                    <div class="ps-section__content">
                        <div class="table-responsive">
                            <table class="table ps-table ps-table--invoices">
                                <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Titulo</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id='tr_cliente'>
                                    <tr>
                                        <td><a href="invoice-detail.html">500884010</a></td>
                                        <td><a href="product-default.html">Marshall Kilburn Portable Wireless Speaker</a></td>
                                        <td>20-1-2020</td>
                                        <td>42.99</td>
                                        <td>Successful delivery</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </section>
      
    </main>
    <?php
      require("view/tienda/components/footer.php");
    ?>
    <div id="back2top"><i class="icon icon-arrow-up"></i></div>
    <div class="ps-site-overlay"></div>
    <div id="loader-wrapper">
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
      <div class="ps-search__content">
        <form class="ps-form--primary-search" action="do_action" method="post">
          <input class="form-control" type="text" placeholder="Search for...">
          <button><i class="aroma-magnifying-glass"></i></button>
        </form>
      </div>
    </div>
    <div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
          <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
            <div class="ps-product__header">
              <div class="ps-product__thumbnail" data-vertical="false">
                <div class="ps-product__images" data-arrow="true">
                  <div class="item"><img src="img/products/detail/fullwidth/1.jpg" alt=""></div>
                  <div class="item"><img src="img/products/detail/fullwidth/2.jpg" alt=""></div>
                  <div class="item"><img src="img/products/detail/fullwidth/3.jpg" alt=""></div>
                </div>
              </div>
              <div class="ps-product__info">
                <h1>Marshall Kilburn Portable Wireless Speaker</h1>
                <div class="ps-product__meta">
                  <p>Brand:<a href="shop-default.html">Sony</a></p>
                  <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                  <option value="1">1</option>
                                  <option value="1">2</option>
                                  <option value="1">3</option>
                                  <option value="1">4</option>
                                  <option value="2">5</option>
                                </select><span>(1 review)</span>
                  </div>
                </div>
                <h4 class="ps-product__price">$36.78 – $56.99</h4>
                <div class="ps-product__desc">
                  <p>Sold By:<a href="shop-default.html"><strong> Go Pro</strong></a></p>
                  <ul class="ps-list--dot">
                    <li> Unrestrained and portable active stereo speaker</li>
                    <li> Free from the confines of wires and chords</li>
                    <li> 20 hours of portable capabilities</li>
                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                  </ul>
                </div>
                <div class="ps-product__shopping"><a class="ps-btn ps-btn--black" href="#">Add to cart</a><a class="ps-btn" href="#">Buy Now</a>
                  <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/jquery.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/nouislider/nouislider.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/popper.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/masonry.pkgd.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/isotope.pkgd.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/jquery.matchHeight-min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/slick/slick/slick.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/slick-animation.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/sticky-sidebar/dist/sticky-sidebar.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/select2/dist/js/select2.full.min.js"></script>
    <!-- custom scripts-->
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/js/main.js"></script>
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