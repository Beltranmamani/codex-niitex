<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
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
        <link rel="manifest" href="<?=SERVERURL;?>manifest.json">
    <style>

    </style>
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

    <div class="osahan-home-page">
        <div class="border-bottom p-3">
            <div class="title d-flex align-items-center">
                <a href="home.html" class="text-decoration-none text-dark d-flex align-items-center">
                    <img class="osahan-logo mr-2" src="<?= SERVERURL ?>view/newtienda/img/logo.svg">
                    <h4 class="font-weight-bold text-success m-0">B-POS</h4>
                </a>
                <p class="ml-auto m-0">
                    
                </p>
                <a class="toggle ml-3" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
            <a href="<?=SERVERURL?>tienda/search/" class="text-decoration-none">
                <div class="input-group mt-3 rounded shadow-sm overflow-hidden bg-white">
                    <div class="input-group-prepend">
                        <button class="border-0 btn btn-outline-secondary text-success bg-white"><i class="icofont-search"></i></button>
                    </div>
                    <input type="text" class="shadow-none border-0 form-control pl-0" placeholder="Buscar.." aria-label="" aria-describedby="basic-addon1">
                </div>
            </a>
        </div>

        <div class="osahan-body">
           
            <!-- CATEGORIAS -->
            <div class="py-3 bg-white osahan-promos shadow-sm">
                <div class="d-flex align-items-center px-3 mb-2">
                    <h6 class="m-0">¿Que es lo que busca?</h6>
                </div>
                <div class="promo-slider">
                <?=$this->listar_presentacion?>

                 
                </div>
            </div>
            <div class="mt-3 py-3 bg-white osahan-promos shadow-sm">
                <div class="d-flex align-items-center px-3 mb-2">
                    <h6 class="m-0">Promociones para ti</h6>
                </div>
                <div class="promo-slider">
                    <?=$this->card_promociones?>
                </div>
            </div>
            <!-- PRODUCTOS -->
            <div class="title d-flex align-items-center mb-3 mt-3 px-3">
                <h6 class="m-0">Elija Hoy</h6>
                <a class="ml-auto text-success" href="<?=SERVERURL?>/tienda/picktoday/">Ver mas</a>
            </div>

            <div class="pick_today px-3">
                <div class="row">
                <?php
                    $items = $this->productos;
                    foreach($items as $i){
                        $detalle_stock = "STOCK_1='{$i['STOCK_1']}' STOCK_2='{$i['STOCK_2']}' STOCK_3='{$i['STOCK_3']}' STOCK_4='{$i['STOCK_4']}' ";
                        $detalle_medida = "MEDIDA_1='{$i['MEDIDA_1']}' MEDIDA_2='{$i['MEDIDA_2']}' MEDIDA_3='{$i['MEDIDA_3']}' MEDIDA_4='{$i['MEDIDA_4']}' ";
                        $detalle_precio = "PRECIO_VENTA_1='{$i['PRECIO_VENTA_1']}' PRECIO_VENTA_2='{$i['PRECIO_VENTA_2']}' PRECIO_VENTA_3='{$i['PRECIO_VENTA_3']}' PRECIO_VENTA_4='{$i['PRECIO_VENTA_4']}' ";
                        $detalle_general = "{$detalle_stock} {$detalle_medida} {$detalle_precio}";
                        echo "<div class='col-6 col-sm-3 px-2 py-2'>
                        <div class='list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm'>
                            <div class='list-card-image'>
                                <a href='".SERVERURL."tienda/product_details/".mainModel::encryption("{$i['ID_ITEM']}")."' class='text-dark'>
                                    <div class='p-3'>
                                        <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' class='img-fluid item-img w-100 mb-3'>
                                        <h6> {$i["ARTICULO"]}</h6>
                                        <div class='d-flex align-items-center'>
                                            <h6 class='price m-0 text-success'>".$this->moneda." {$i["PRECIO_VENTA_4"]}/{$i["PREFIJO"]}</h6>
                                            <a href='javascript:void(0)' class='btn btn-success btn-sm ml-auto btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$i['PRECIO_VENTA_4']}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' $detalle_general data-toggle='tooltip' >+</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>";
                        
                    }
                ?>
                </div>
            </div>

            <div class="title d-flex align-items-center p-3">
                <h6 class="m-0">Recomendado para ti </h6>
            </div>

            <div class="osahan-recommend px-3">
                <div class="row">
                   <?=$this->card_recomendados?>
                </div>
            </div>
        </div>
    </div>

    <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
        <div class="row m-0">
            <a href="javascript:void(0)" class="text-dark small col font-weight-bold text-decoration-none p-2 selected">
                <p class="h5 m-0"><i class="text-success icofont-grocery"></i></p>
               Tienda
            </a>
            <a href="<?=SERVERURL?>tienda/cart/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-cart"></i></p>
                Carrito
            </a>
            <a href="<?=SERVERURL?>tienda/pedidos/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-bag"></i></p>
                Pedidos
            </a>
            <a href="<?=SERVERURL?>tienda/perfil/" class="text-muted small col text-decoration-none p-2">
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

    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js" ></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js" ></script>

    <script  src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script  src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js" ></script>
        <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("./../../sw.js")
        .then(reg => console.log('Registro de SW exitoso', reg))
        .catch(err => console.warn('Error al tratar de registrar el sw', err))
    }
  </script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="8ed20f8cf5e96546ee706a2f-|49" defer=""></script>
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
     $(document).on('click','.btn_carrito',function(){
        let id_item = $(this).attr('id_item');
        let articulo = $(this).attr('articulo');
        let cantidad = $(this).attr('cantidad');
        let precio = $(this).attr('precio');
        let linea = $(this).attr('linea');
        let imagen = $(this).attr('imagen');
        let STOCK_1 = $(this).attr('stock_1');
        let STOCK_2 = $(this).attr('stock_2');
        let STOCK_3 = $(this).attr('stock_3');
        let STOCK_4 = $(this).attr('stock_4');
        let MEDIDA_1 = $(this).attr('medida_1');
        let MEDIDA_2 = $(this).attr('medida_2');
        let MEDIDA_3 = $(this).attr('medida_3');
        let MEDIDA_4 = $(this).attr('medida_4');
        let PRECIO_VENTA_1 = $(this).attr('precio_venta_1');
        let PRECIO_VENTA_2 = $(this).attr('precio_venta_2');
        let PRECIO_VENTA_3 = $(this).attr('precio_venta_3');
        let PRECIO_VENTA_4 = $(this).attr('precio_venta_4');

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
            'PRECIO_ACTIVO': 4,
          };
           carrito.push(miProducto);
           localStorage.setItem("carrito", JSON.stringify(carrito));


        }


      });
      </script>
</body>

</html>