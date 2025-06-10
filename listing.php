<?php 
    session_name('BOL_TIENDA');
    session_start();
    $cliente = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";
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
    <div class="osahan-listing">
        <div class="p-3">
            <div class="d-flex align-items-center">
                <a class="font-weight-bold text-success text-decoration-none" href="<?=SERVERURL?>tienda/grocery/"><i class="icofont-rounded-left back-page"></i></a><span class="font-weight-bold ml-3 h6 mb-0"><?=$this->categoria?></span>
                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
        <div class="osahan-listing px-3 bg-white">
            <div class="row border-bottom border-top">
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


    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js" type="2341db7e260ade6ea87ff51c-text/javascript"></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js" type="2341db7e260ade6ea87ff51c-text/javascript"></script>

    <script type="2341db7e260ade6ea87ff51c-text/javascript" src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script type="2341db7e260ade6ea87ff51c-text/javascript" src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js" type="2341db7e260ade6ea87ff51c-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="2341db7e260ade6ea87ff51c-|49" defer=""></script>
</body>

</html>