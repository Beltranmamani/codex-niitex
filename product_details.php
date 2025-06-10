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
    <div class="p-3 bg-white">
        <div class="d-flex align-items-center">
            <a class="font-weight-bold text-success text-decoration-none" href="<?= SERVERURL ?>tienda/grocery/"><i class="icofont-rounded-left back-page"></i> Tienda</a>
            <a class="ml-auto font-weight-bold text-white text-decoration-none" href="fresh_vegan.html"></a>
            <a class="font-weight-bold text-white text-decoration-none ml-2" href="#">/i></a>
            <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
        </div>
    </div>
    <div class="px-3 bg-white pb-3">
        <div class="pt-0">
            <h2 class="font-weight-bold"><?=$pro_array[2]?></h2>
            <p class="font-weight-light text-dark m-0 d-flex align-items-center">
                Precio : <b class="h6 text-dark m-0"><?=$this->moneda?> <?=$pro_array[1]?></b>
            </p>
           
        </div>
    
    </div>
    <div class="osahan-product">
        <div class="product-details">
            <div class="recommend-slider py-1">
                <?=$this->imagenes?>
            </div>
            <div class="details">
                
                <div class="p-3">
                    
                    <p class="font-weight-bold mb-2">Detalles de Producto</p>
                    <p class="text-muted small">
                    <?=$this->caracteristicas?>
                    </p>
                    <p class="font-weight-bold mb-3">Recomendados.</p>
                    <?=$this->lista_recomendados?>
                </div>
            </div>
            <?php
                $producto= $this->producto_detail;
            ?>
            <div class="fixed-bottom pd-f bg-white d-flex align-items-center border-top">
                <a href="javascript:void(0)" id="btn_add_carrito" id_item="<?=$pro_array[0]?>" articulo="<?=$pro_array[2]?>" cantidad="<?=$pro_array[4]?>" precio="<?=$pro_array[1]?>" linea="<?=$pro_array[3]?>" imagen="<?=SERVERURL?>archives/assets/productos/<?=$pro_array[5]?>" precio_venta_1="<?=$producto['PRECIO_VENTA_1']?>" precio_venta_2="<?=$producto['PRECIO_VENTA_2']?>" precio_venta_3="<?=$producto['PRECIO_VENTA_3']?>" precio_venta_4="<?=$producto['PRECIO_VENTA_4']?>" MEDIDA_1="<?=$producto['MEDIDA_1']?>" MEDIDA_2="<?=$producto['MEDIDA_2']?>" MEDIDA_3="<?=$producto['MEDIDA_3']?>" MEDIDA_4="<?=$producto['MEDIDA_4']?>" STOCK_1="<?=$producto['STOCK_1']?>" STOCK_2="<?=$producto['STOCK_2']?>" STOCK_3="<?=$producto['STOCK_3']?>" STOCK_4="<?=$producto['STOCK_4']?>" class="btn-warning btn-block py-3 px-5 h4 m-0 text-center"><i class="icofont-cart"></i></a>
                
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

    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js" ></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js" ></script>

    <script  src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script  src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js" ></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="0f4dd6fabb5551b9bd743a69-|49" defer=""></script>
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
            let cantidad_carrito = 1;
            cantidad_carrito = parseInt(cantidad_carrito);

            let id_item = $(this).attr('id_item');
            let articulo = $(this).attr('articulo');
            let cantidad = $(this).attr('cantidad');
            let precio = $(this).attr('precio');
            let linea = $(this).attr('linea');
            let imagen = $(this).attr('imagen');
            let STOCK_1 = "<?=$producto['STOCK_1']?>";
            let STOCK_2 = "<?=$producto['STOCK_2']?>";
            let STOCK_3 = "<?=$producto['STOCK_3']?>";
            let STOCK_4 = "<?=$producto['STOCK_4']?>";
            let MEDIDA_1 = "<?=$producto['MEDIDA_1']?>";
            let MEDIDA_2 = "<?=$producto['MEDIDA_2']?>";
            let MEDIDA_3 = "<?=$producto['MEDIDA_3']?>";
            let MEDIDA_4 = "<?=$producto['MEDIDA_4']?>";
            let PRECIO_VENTA_1 = "<?=$producto['PRECIO_VENTA_1']?>";
            let PRECIO_VENTA_2 = "<?=$producto['PRECIO_VENTA_2']?>";
            let PRECIO_VENTA_3 = "<?=$producto['PRECIO_VENTA_3']?>";
            let PRECIO_VENTA_4 = "<?=$producto['PRECIO_VENTA_4']?>";
            let PRECIO_ACTIVO = 4;
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
                        'imagen': imagen,
                        'STOCK_1': STOCK_1,
                        'STOCK_2': STOCK_2,
                        'STOCK_3': STOCK_3,
                        'STOCK_4': STOCK_4,
                        'MEDIDA_1': MEDIDA_1,
                        'MEDIDA_2': MEDIDA_2,
                        'MEDIDA_3': MEDIDA_3,
                        'MEDIDA_4': MEDIDA_4,
                        'PRECIO_VENTA_1': PRECIO_VENTA_1,
                        'PRECIO_VENTA_2': PRECIO_VENTA_2,
                        'PRECIO_VENTA_3': PRECIO_VENTA_3,
                        'PRECIO_VENTA_4': PRECIO_VENTA_4,
                        'PRECIO_ACTIVO': PRECIO_ACTIVO,

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


        }


      });
    </script>
</body>

</html>