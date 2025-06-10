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
    <link rel="manifest" href="<?=SERVERURL;?>manifest.json">
  </head>
  <body>
    <?php
        require "view/tienda/components/navbar.php";
    ?>
    <div class="ps-breadcrumb">
        <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href="<?=SERVERURL?>tienda/online/">Inicio</a></li>
            <li>Tienda</li>
        </ul>
        </div>
    </div>

    <div class="ps-page--shop">
      <div class="ps-container">
        <div class="ps-shop-categories">
          <div class="row align-content-lg-stretch">
                        
          </div>
        </div>
        <div class="ps-layout--shop">
          <div class="ps-layout__left">
            <aside class="widget widget_shop">
              <h4 class="widget-title">Categorias</h4>
              <ul class="ps-list--categories">
                <?=$this->listar_presentacion?>
              </ul>
            </aside>
            <aside class="widget widget_shop">
              <h4 class="widget-title">POR MARCA</h4>
            
              <figure class="ps-custom-scrollbar" data-height="250">
                    <?=$this->listar_lineas?>
              </figure>
             
            </aside>
          </div>
          <div class="ps-layout__right">
            <div class="ps-shopping ps-tab-root">
              <div class="ps-shopping__header">
                <p><strong> <?=$this->nro_productos?></strong> Productos encontrados</p>
                <div class="ps-shopping__actions">
                  
                  <div class="ps-shopping__view">
                    <p>View</p>
                    <ul class="ps-tab-list">
                      <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                      <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="ps-tabs">
                <div class="ps-tab active" id="tab-1">
                  <div class="ps-shopping-product">
                    <div class="row" id="grid">
                        <?=$this->producto?>
                      <div class="col-1 my-sizer-element"></div>
                    </div>
                  </div>
                  <div class="ps-pagination">
                    <ul class="pagination">
                      <?=$this->paginacion?>
                    </ul>
                  </div>
                </div>
                <div class="ps-tab" id="tab-2">
                    <div class="ps-shopping-product">
                      <?=$this->producto_detalle?>
                          
                    </div>
                    <div class="ps-pagination">
                      <ul class="pagination">
                        <?=$this->paginacion?>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
            <div class="ps-block--shop-features">
              <div class="ps-block__header">
                <h3>Productos recomendados</h3>
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
    <div class="ps-filter--sidebar">
      <div class="ps-filter__header">
        <h3>Filtro de Productos</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
      </div>
      <div class="ps-filter__content">
        <aside class="widget widget_shop">
          <h4 class="widget-title">Categorias</h4>
            <ul class="ps-list--categories">
            <?=$this->listar_presentacion?>
            </ul>
        </aside>
        <aside class="widget widget_shop">
          <h4 class="widget-title">POR MARCA</h4>
          <form class="ps-form--widget-search" action="do_action" method="get">
            <input class="form-control" type="text" placeholder="">
            <button><i class="icon-magnifier"></i></button>
          </form>
          <figure class="ps-custom-scrollbar" data-height="250">
            <?=$this->listar_lineas_1?>
                        
          </figure>
          <!-- <figure>
            <h4 class="widget-title">By Price</h4>
            <div class="ps-slider" data-default-min="13" data-default-max="1300" data-max="1311" data-step="100" data-unit="$"></div>
            <p class="ps-slider__meta">Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span></p>
          </figure>
          <figure>
            <h4 class="widget-title">By Price</h4>
            <div class="ps-checkbox">
              <input class="form-control" type="checkbox" id="review-1" name="review">
              <label for="review-1"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i></span><small>(13)</small></label>
            </div>
            <div class="ps-checkbox">
              <input class="form-control" type="checkbox" id="review-2" name="review">
              <label for="review-2"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i></span><small>(13)</small></label>
            </div>
            <div class="ps-checkbox">
              <input class="form-control" type="checkbox" id="review-3" name="review">
              <label for="review-3"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(5)</small></label>
            </div>
            <div class="ps-checkbox">
              <input class="form-control" type="checkbox" id="review-4" name="review">
              <label for="review-4"><span><i class="fa fa-star rate"></i><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(5)</small></label>
            </div>
            <div class="ps-checkbox">
              <input class="form-control" type="checkbox" id="review-5" name="review">
              <label for="review-5"><span><i class="fa fa-star rate"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span><small>(1)</small></label>
            </div>
          </figure> -->
          
        </aside>
      </div>
    </div>
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
    <div class="modal fade" id="detalle_producto" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id='detalle_producto_body'>
          
           
          
        </div>
      </div>
    </div>
    <div class="ps-popup" id="subscribe" data-time="500">
        <div class="ps-popup__content bg--cover" data-background="<?=SERVERURL?>view/tienda/assets/img/bg/subscribe.jpg" ><a class="ps-popup__close" href="#"><i class="icon-cross"></i></a>
            <form class="ps-form--subscribe-popup" action="#" method="get">
                <div class="ps-form__content">
                    <h4> <strong id="type_conec"></strong> </h4>
                    <p>Hemos detecado un cambio de red, Revisa tu conexion a internet.</p>
                    
                    
                </div>
            </form>
        </div>
    </div>
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

      var Shuffle = window.Shuffle;
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
      };

      var Demo = function (element) {
        this.shapes = Array.from(document.querySelectorAll(".ps-custom-scrollbar .ps-checkbox input"));
        this.colors = Array.from(document.querySelectorAll(".js-colors button"));

        this.shuffle = new Shuffle(element, {
          easing: "cubic-bezier(0.165, 0.840, 0.440, 1.000)", // easeOutQuart
          sizer: ".my-sizer-element",
        });

        this.filters = {
          shapes: [],
          colors: [],
        };

        this._bindEventListeners();
      };

      /**
      * Bind event listeners for when the filters change.
      */
      Demo.prototype._bindEventListeners = function () {
        this._onShapeChange = this._handleShapeChange.bind(this);
        this._onColorChange = this._handleColorChange.bind(this);

        this.shapes.forEach(function (input) {
          input.addEventListener("change", this._onShapeChange);
        }, this);

        this.colors.forEach(function (button) {
          button.addEventListener("click", this._onColorChange);
        }, this);
      };

      /**
       * Get the values of each checked input.
       * @return {Array.<string>}
       */
      Demo.prototype._getCurrentShapeFilters = function () {
        return this.shapes
          .filter(function (input) {
            return input.checked;
          })
          .map(function (input) {
            return input.value;
          });
      };

      /**
       * Get the values of each `active` button.
       * @return {Array.<string>}
       */
      Demo.prototype._getCurrentColorFilters = function () {
        return this.colors
          .filter(function (button) {
            return button.classList.contains("active");
          })
          .map(function (button) {
            return button.getAttribute("data-value");
          });
      };

      /**
       * A shape input check state changed, update the current filters and filte.r
       */
      Demo.prototype._handleShapeChange = function () {
        this.filters.shapes = this._getCurrentShapeFilters();
        this.filter();
      };

      /**
       * A color button was clicked. Update filters and display.
       * @param {Event} evt Click event object.
       */
      Demo.prototype._handleColorChange = function (evt) {
        var button = evt.currentTarget;

        // Treat these buttons like radio buttons where only 1 can be selected.
        if (button.classList.contains("active")) {
          button.classList.remove("active");
        } else {
          this.colors.forEach(function (btn) {
            btn.classList.remove("active");
          });

          button.classList.add("active");
        }

        this.filters.colors = this._getCurrentColorFilters();
        this.filter();
      };

      /**
       * Filter shuffle based on the current state of filters.
       */
      Demo.prototype.filter = function () {
        if (this.hasActiveFilters()) {
          this.shuffle.filter(this.itemPassesFilters.bind(this));
        } else {
          this.shuffle.filter(Shuffle.ALL_ITEMS);
        }
      };

      /**
       * If any of the arrays in the `filters` property have a length of more than zero,
       * that means there is an active filter.
       * @return {boolean}
       */
      Demo.prototype.hasActiveFilters = function () {
        return Object.keys(this.filters).some(function (key) {
          return this.filters[key].length > 0;
        }, this);
      };

      /**
       * Determine whether an element passes the current filters.
       * @param {Element} element Element to test.
       * @return {boolean} Whether it satisfies all current filters.
       */
      Demo.prototype.itemPassesFilters = function (element) {
        var shapes = this.filters.shapes;
        var colors = this.filters.colors;
        var shape = element.getAttribute("data-shape");
        var color = element.getAttribute("data-color");
        var precio = Math.round(element.getAttribute("data-precio"));
        var nodes = [
          Math.round(document.querySelector('.ps-slider__min')),
          Math.round(document.querySelector('.ps-slider__max')),
        ];
        
        // If there are active shape filters and this shape is not in that array.
        if (shapes.length > 0 && !shapes.includes(shape)) {
          return false;
        }

        // If there are active color filters and this color is not in that array.
        if (colors.length > 0 && !colors.includes(color)) {
          return false;
        }
        return true;
      };
      let carrito = {};
      
      const d = document,w= window, n = navigator;
      function networkStatus(){
        const isOnLine = ()=>{
          if(n.onLine){
            $("#subscribe").addClass('active');
            $("#type_conec").text("EN LINEA");
            $('body').css('overflow', 'hidden');
          }else{
            $("#subscribe").addClass('active');
            $("#type_conec").text("SIN CONEXION A INTERNET");
            $('body').css('overflow', 'hidden');
          }
        }
        w.addEventListener("online",(e)=>isOnLine());
        w.addEventListener("offline",(e)=>isOnLine());
      }
      document.addEventListener("DOMContentLoaded", function () {
        window.demo = new Demo(document.querySelector("#grid"));
        if(localStorage.getItem('carrito')){
          carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
        }
        lista_carrito();
        nro_deseos();
        filterSlider();
        networkStatus();
        
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
      $(document).on('click',".ps-popup__close",function(){
        $('#subscribe').removeClass('active');
            $('body').css('overflow', 'auto');
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