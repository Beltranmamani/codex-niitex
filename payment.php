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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <title><?=SISTEMA_NOMBRE?> - Completar pago</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
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
            <li><a href="<?=SERVERURL?>tienda/online/">Home</a></li>
            <li>Payment</li>
          </ul>
        </div>
      </div>
      <section class="ps-section--account ps-checkout">
        <div class="container">
          <div class="ps-section__header">
            <h3>Pago</h3>
          </div>
          <div class="ps-section__content">
            <form class="ps-form--checkout" action="index.html" method="get">
              <div class="ps-form__content">
                <div class="row">
                              <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block--shipping">
                                  <div class="ps-block__panel">
                                    <figure><small>Contacto</small>
                                      <p><a href="#"><span id='email_pedido' class="__cf_email__"></span></a></p>
                                    </figure>
                                    <figure><small>Enviar a</small>
                                    <p id='direccion_pedido'></p>
                                    </figure>
                                  </div>
                                  <h4>Tarifa de envio</h4>
                                  <div class="ps-block__panel">
                                    <figure><small>Tarifa de Envío</small><strong id='tarifa_envio'>00</strong></figure>
                                  </div>
                                  <h4>Metodo de pago</h4>
                                  <div class="ps-block--payment-method">
                                    <div class="alert alert-danger" role="alert" id='alert_danger'>
                                      A simple danger alert—check it out!
                                    </div>
                                    <div class="alert alert-warning" role="alert" id='alert_warning'>
                                      Por ahora tenemos el metodo de deposito a cuenta bancaria. Una vez enviado el pedido recibiras un correo al email con la cual esta cuenta esta asociada con la informacion necesaria.
                                    </div>
                                    <div class="alert alert-success" role="alert" id='alert_success'>
                                      Recibimos tu pedido. En unos momentos te llegara un correo con la información necesaria.
                                    </div>
                                    <div class="form-group submit">
                                      <button type="button" id="btn_pago" class="ps-btn ps-btn--fullwidth">Enviar pedido</button>
                                    </div>
                              
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <div class="ps-block--checkout-order">
                                    <div class="ps-block__content">
                                        <figure>
                                            <figcaption><strong>Producto</strong><strong>Total</strong></figcaption>
                                        </figure>
                                        <figure class="ps-block__items" id="tb_productos_pedido">
                                            
                                        </figure>
                                        <figure>
                                            <figcaption><strong>Subtotal</strong><strong id="c_subtotal">1259.99</strong></figcaption>
                                        </figure>
                                        <figure>
                                            <figcaption><strong>Costo de Envío</strong><strong id="c_envio">20.00</strong></figcaption>
                                        </figure>
                                        <figure>
                                            <figcaption><strong>Total</strong><strong id="c_total">20.00</strong></figcaption>
                                        </figure>

                                    </div>
                                </div>
                              </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    <?php
      require("view/tienda/components/footer.php");
    ?>
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
    <script src="<?=SERVERURL?>view/tienda/assets/js/main.js"></script>
    <script>
        let carrito = {};
        let pedido_cliente = {};
        document.addEventListener("DOMContentLoaded", function () {
            if(localStorage.getItem('carrito')){
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            }
            lista_carrito();
            table_carrito();
            nro_deseos();
            pedido_cliente_array();
            $("#alert_danger").hide();
            $("#alert_success").hide();
            $(".header__filter").hide();
        });
        let nro_deseos = () =>{
          let id_usuario = "<?=$cliente['ID_CLIENTE']?>";
          if(id_usuario === "none"){
            $("#nro_deseos").html(0);
          }else{
            $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
              $("#nro_deseos").html(res);
            })
          }
        }
        let pedido_cliente_array = ()=>{
          pedido_cliente = JSON.parse(localStorage.getItem('cliente_pedido')|| "[]");
          $("#email_pedido").html(pedido_cliente.correo_chek);
          $("#direccion_pedido").html(pedido_cliente.direccion_text_chek);
          $("#tarifa_envio").html("<?=$this->moneda?> "+pedido_cliente.tarifa_chek);
        }
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
                      <a href="#">${task.articulo}</a>
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
        let table_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            if(carrito.length>0){
              carrito.forEach(task => {
                let cantidad = parseFloat(task.cantidad);
                let precio =  parseFloat(task.precio);
                sub_total += cantidad*precio;
                template += `
                <a href="#"><strong>${task.articulo}</strong><span> ${task.cantidad} x <small><?=$this->moneda?> ${task.precio}</small></span></a>
                        `
              });

            }
            let cliente_pedido = JSON.parse(localStorage.getItem('cliente_pedido')|| "[]");
            let tarifa_envio = parseFloat(cliente_pedido.tarifa_chek);
            let total = sub_total + tarifa_envio;
            $('#tb_productos_pedido').html(template);
            $("#c_subtotal").html("<?=$this->moneda?> "+sub_total.toFixed(2));
            $("#c_envio").html("<?=$this->moneda?> "+tarifa_envio.toFixed(2));
            $("#c_total").html("<?=$this->moneda?> "+total.toFixed(2));
            
        }
        $(document).on('click','#btn_pago',function(){
          let carrito = JSON.parse(localStorage.getItem('carrito'));
          let cliente_pedido = JSON.parse(localStorage.getItem('cliente_pedido'));
          $.post("<?=SERVERURL?>tienda/guardar_invoice/",{carrito,cliente_pedido},function(res){
            if(res==1){
              $("#alert_success").fadeIn(100);
    
              localStorage.setItem("carrito", JSON.stringify([]));
              lista_carrito();
              table_carrito();
            }else{
              $("#alert_danger").fadeIn(100);
            }
          });
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