<?php 
    session_name('BOL_TIENDA');
    session_start();
    $cliente = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";
    
    $parametrosproducto = $this->producto;
    $pro_array = explode("|",$parametrosproducto);
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
    <meta name="description" content="<?=$pro_array[2]?>|<?=$pro_array[3]?>">
    <title><?=SISTEMA_NOMBRE?> - Tienda Online</title>
    <link href="<?=SERVERURL;?>view/assets/assets/img/favicon.ico" rel="icon" type="image/x-icon"/>

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
        <div class="ps-container"></div>
    </div>
    <div class="ps-page--product">
        <div class="container">
            <div class="ps-product--detail ps-product--full-content">
                <div class="ps-product__top">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="true">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="true">
                                    <?=$this->imagenes?>
                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                <?=$this->imagenes?>
                            </div>
                        </div>
                        <div class="ps-product__info">
                            <h1><?=$pro_array[2]?></h1>
                            <div class="ps-product__meta">
                                <p>Marca:<a href="#"><?=$pro_array[3]?></a></p>
                                
                            </div>
                            <div class="ps-product__desc">
                                <ul class="ps-list--dot">
                                    <?=$this->caracteristicas?>
                                </ul>
                            </div>
                            
                            <div class="ps-product__sharing"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                    <div class="ps-product__price-right">
                        <h4 class="ps-product__price"><?=$this->moneda?> <?=$pro_array[1]?></h4>
                       
                        <div class="ps-product__shopping">
                            <figure>
                                <figcaption>Cantidad</figcaption>
                                <div class="form-group--number">
                                    <button class="up btn_up">+</button>
                                    <button class="down btn_down">-</button>
                                    <input class="form-control" type="text" id='txt_cantidad' cantidad='<?=$pro_array[4]?>' onkeypress="return check(event)" value="1">
                                </div>
                            </figure>
                            <a class="ps-btn ps-btn--gray" href="javascript:void(0)" id="btn_add_carrito" id_item="<?=$pro_array[0]?>" articulo="<?=$pro_array[2]?>" cantidad="<?=$pro_array[4]?>" precio="<?=$pro_array[1]?>" linea="<?=$pro_array[3]?>" imagen="<?=SERVERURL?>archives/assets/productos/<?=$pro_array[5]?>" >Agregar al carrito</a>
                            <div class="ps-product__actions">
                                <a href="javascript:void(0)" id="btn_add_deseo" id_item="<?=$pro_array[0]?>"><i class="icon-heart"></i> Agregar a la lista de deseos</a>
                            </div>
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
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <!-- custom scripts-->
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
        };
        document.addEventListener("DOMContentLoaded", function () {
            // window.demo = new Demo(document.querySelector("#grid"));
            if(localStorage.getItem('carrito')){
                carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            }
            lista_carrito();
            nro_deseos();
            $(".header__filter").hide();
        });
        $(document).on('click','.btn_up',function(){
            let cantidad = $("#txt_cantidad").val();
            let stock = $("#txt_cantidad").attr('cantidad');
            cantidad = parseInt(cantidad);
            stock = parseInt(stock);
            cantidad++;
            if(cantidad>stock){
                return false;
            }else{
                $("#txt_cantidad").val(cantidad);
            }
        });
        $(document).on('click','.btn_down',function(){
            let cantidad = $("#txt_cantidad").val();
            cantidad = parseInt(cantidad);
            if(cantidad==1){
                $("#txt_cantidad").val(1);
                return false;
            }else{
                cantidad--;
                $("#txt_cantidad").val(cantidad);
            }
        });
        function check(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patron de entrada, en este caso solo acepta numeros y letras
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
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
        $(document).on('click','#btn_add_carrito',function(){
            let cantidad_carrito = $("#txt_cantidad").val();
            cantidad_carrito = parseInt(cantidad_carrito);

            let id_item = $(this).attr('id_item');
            let articulo = $(this).attr('articulo');
            let cantidad = $(this).attr('cantidad');
            let precio = $(this).attr('precio');
            let linea = $(this).attr('linea');
            let imagen = $(this).attr('imagen');
            cantidad = parseInt(cantidad);
            if(cantidad_carrito>cantidad){
                toastr["error"]("Producto con stock insuficiente");
            }else{

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
                    let nueva_cantidad = cantidad_carrito+cant_cantidad;

                    let cant_stock = parseInt(carrito[index].stock);
                    if(nueva_cantidad<cant_stock){
                        carrito[index].cantidad = nueva_cantidad;
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
                        'cantidad': cantidad_carrito, 
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

            }
        });
        $(document).on('click','#btn_add_deseo',function(){
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