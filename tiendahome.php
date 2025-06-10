<?php 
    session_name('BOL_TIENDA');
    session_start();
    $cliente = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="Jhony Creativo">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>
    <title><?=SISTEMA_NOMBRE?> - Tienda Online</title>
    <link rel="manifest" href="<?=SERVERURL;?>manifest.json">
    <!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet"> -->
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
    
</head>

<body>
    <?php
        require "view/tienda/components/navbar.php";
    ?>
    <div class="ps-breadcrumb">
        <div class="ps-container">
            <ul class="breadcrumb">
                <li><a href="<?=SERVERURL?>tienda/online/">Tienda</a></li>
                <li>Inicio</li>
            </ul>
        </div>
    </div>
    <div class="ps-page--shop">
        <div class="ps-container">
            <div class="ps-shop-banner">
                <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    <a href="#"><img src="<?=SERVERURL?>view/tienda/assets/img/slider/shop-default/1.jpg" alt=""></a>
                    <a href="#"><img src="<?=SERVERURL?>view/tienda/assets/img/slider/shop-default/2.jpg" alt=""></a></div>
            </div>
            
            <div class="ps-layout--shop">
                <div class="ps-layout__left">
                    <aside class="widget widget_shop">
                        <h4 class="widget-title">Categorias</h4>
                        <ul class="ps-list--categories">
                            <?=$this->listar_presentacion?>
                        </ul>
                    </aside>
                    
                </div>
                <div class="ps-layout__right">
                    
                    <div class="ps-block--shop-features">
                        <div class="ps-block__header">
                            <h3>Productos Recomendados</h3>
                            <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#recommended"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#recommended"><i class="icon-chevron-right"></i></a></div>
                        </div>
                        <div class="ps-block__content">
                            <div class="owl-slider" id="recommended" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                            <?=$this->lista_recomendados?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal" id="shop-filter-lastest" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="list-group"><a class="list-group-item list-group-item-action" href="#">Sort by</a><a class="list-group-item list-group-item-action" href="#">Sort by average rating</a><a class="list-group-item list-group-item-action" href="#">Sort by latest</a><a class="list-group-item list-group-item-action" href="#">Sort by price: low to high</a><a class="list-group-item list-group-item-action" href="#">Sort by price: high to low</a><a class="list-group-item list-group-item-action text-center" href="#" data-dismiss="modal"><strong>Close</strong></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!-- <script src="<?=SERVERURL?>view/tienda/assets/plugins/gmap3.min.js"></script> -->
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?=SERVERURL?>view/assets/plugins/shuffle/shuffle.js"></script>
    <!-- custom scripts-->
    <script src="<?=SERVERURL?>view/tienda/assets/js/main.js"></script>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register("./../../sw.js")
            .then(reg => console.log('Registro de SW exitoso', reg))
            .catch(err => console.warn('Error al tratar de registrar el sw', err))
        }
      </script>
    <script>

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

      let carrito = {};
      document.addEventListener("DOMContentLoaded", function () {
        if(localStorage.getItem('carrito')){
          carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
        }
        lista_carrito();
        nro_deseos();
        filterSlider();
      });
      $(document).on('click','.btn_carrito',function(){
        let id_item = $(this).attr('id_item');
        let articulo = $(this).attr('articulo');
        let cantidad = $(this).attr('cantidad');
        let precio = $(this).attr('precio');
        let linea = $(this).attr('linea');
        let imagen = $(this).attr('imagen');

        carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");

        let index = 0;
        let state = false;
        for (var i=0; i<carrito.length; i++) { 
          let id_item_array = carrito[i].id_item;
          if(!state){
            if(id_item_array == id_item){
              index = i;
              state = true;
            }
          }
        }
        if(state){
          let cant_cantidad = parseInt(carrito[index].cantidad);
          let cant_stock = parseInt(carrito[index].stock);
          if(cant_cantidad<cant_stock){
            carrito[index].cantidad = cant_cantidad+1;
            carrito[index].stock = cantidad;
            localStorage.setItem("carrito", JSON.stringify(carrito));
            toastr["success"]("Producto agregado correctamente");

            lista_carrito();
          }else{
            toastr["error"]("Producto con stock insuficiente");
          }

        }else{
          var miProducto = { 
            'id_item': id_item, 
            'articulo': articulo, 
            'cantidad': 1, 
            'stock': cantidad, 
            'linea': linea,
            'precio': precio,
            'imagen': imagen
          };
           carrito.push(miProducto);
           localStorage.setItem("carrito", JSON.stringify(carrito));
           toastr["success"]("Producto agregado correctamente");

           lista_carrito();
        }


      });
      $(document).on('click','.btn_deseo',function(){
        let id_item = $(this).attr('id_item');
        let id_usuario = "<?=$cliente?>";
        if(id_usuario === "none"){
          toastr["error"]("Debes iniciar sesion");
        }else{
          $.post("<?=SERVERURL?>tienda/add_lista_deseos/",{id_item,id_usuario},function(res){
            if(res==1){
              toastr["success"]("Producto agregado a la lista de deseos");
              nro_deseos();
            }else{
              toastr["error"]("El producto ya esta en la lista de deseos");
            }
          })
        }

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
      let nro_deseos = () =>{
        let id_usuario = "<?=$cliente?>";
        if(id_usuario === "none"){
          $("#nro_deseos").html(0);
        }else{
          $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
            $("#nro_deseos").html(res);
          })
        }
      }
      $(document).on('click','.btn_eliminar_item_carrito',function(){
        let id_item = $(this).attr('id_item');

        carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");

        let index = 0;
        let state = false;
        for (var i=0; i<carrito.length; i++) { 
          let id_item_array = carrito[i].id_item;
          if(!state){
            if(id_item_array == id_item){
              index = i;
              state = true;
            }
          }
        }
        if(state){
          carrito.splice(index,1);
          localStorage.setItem("carrito", JSON.stringify(carrito));
          toastr["error"]("Producto eliminado correctamente");
          lista_carrito();
        }
      });
      
      $(document).on('click','.ver_info',function(){
        let id_item = $(this).attr('id_item');
        let producto = "";
        $.ajax({
            type: 'post',
            data: {id_item},
            url: "<?=SERVERURL?>tienda/modal_detalle_producto/",
            success: function( response ) {
              $("#detalle_producto_body").html(response);
              let productos = $(".ps-product__images .item");
              if(productos.length>1){
                $('.ps-product--quickview .ps-product__images').slick({
                    lazyLoad: 'ondemand',
                    autoplay: true,
                    autoplaySpeed: 1000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    dots: false,
                    arrows: true,
                    infinite: true,
                    centerMode: false,
                    variableWidth: false,
                    slidesToShow: 1,
                    prevArrow: "<a href='#'><i class='fa fa-angle-left'></i></a>",
                    nextArrow: "<a href='#'><i class='fa fa-angle-right'></i></a>",
                });
              }
              $("#detalle_producto").modal('show');

            
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
      function filterSlider() {
          var nonLinearSlider = document.getElementById('precio_slider');
          if (typeof nonLinearSlider != 'undefined' && nonLinearSlider != null) {
              noUiSlider.create(nonLinearSlider, {
                  connect: true,
                  behaviour: 'tap',
                  start: [0, 1000],
                  range: {
                      min: 0,
                      '10%': 100,
                      '20%': 200,
                      '30%': 300,
                      '40%': 400,
                      '50%': 500,
                      '60%': 600,
                      '70%': 700,
                      '80%': 800,
                      '90%': 900,
                      max: 1000,
                  },
              });
              var nodes = [
                  document.querySelector('.ps-slider__min'),
                  document.querySelector('.ps-slider__max'),
              ];
              nonLinearSlider.noUiSlider.on('update', function(values, handle) {
                  nodes[handle].innerHTML = Math.round(values[handle]);
                  
              });
          }
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