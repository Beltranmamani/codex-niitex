<?php 
    session_name('BOL_TIENDA');
    session_start();
    if(!isset($_SESSION["usuario"])){
        echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
    }
    $cliente = mainModel::parametros_cliente_tienda($_SESSION["usuario"]);
    $pedido = $this->params_pedido;
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

<link rel="<?= SERVERURL ?>view/newtienda/stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
<link rel="<?= SERVERURL ?>view/newtienda/stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />

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
<div class="osahan-status">
<div class="p-3 border-bottom">
<div class="d-flex align-items-center">
<a class="font-weight-bold text-success text-decoration-none" href="progress_order.html">
<i class="icofont-rounded-left back-page"></i></a>
<span class="font-weight-bold ml-3 h6 mb-0">#<?=$pedido["ID_INVOICE"]?></span>
<a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
</div>
</div>

<div class="p-3 status-order border-bottom bg-white">
<p class="small m-0"><i class="icofont-ui-calendar"></i> <?=$pedido["FECHA"]?></p>
</div>
<div class="p-3 border-bottom">
<?php
                                  $estado = "";
                                  if($pedido['ESTADO']==1){
                                      $estado = "PAGO PENDIENTE";
                                  }else if($pedido['ESTADO']==2){
                                      $estado = "PAGO COMPLETADO";
                                  }else if($pedido['ESTADO']==3){
                                      $estado = "ENVIO PENDIENTE";
                                  }else if($pedido['ESTADO']==4){
                                      $estado = "EN ENVIO";
                                  }else if($pedido['ESTADO']==5){
                                      $estado = "ENVIO COMPLETADO";
                                  }else if($pedido['ESTADO']==0){
                                      $estado = "CANCELADO";
                                  }
                                ?>
<h6 class="font-weight-bold">Estado de pedido</h6>
<div class="tracking-wrap">
<div class="my-1 step active">
<span class="icon text-success"><i class="icofont-check-circled"></i></span>
<span class="text small"><?=$estado?></span>
</div>



</div>
</div>

<div class="p-3 border-bottom bg-white">
<h6 class="font-weight-bold">Direccion</h6>
<p class="m-0 small"> <?=$pedido["DIRECCION"]?>, <?=$pedido["PROVINCIA"]?>, <?=$pedido["DEPARTAMENTO"]?></p>
</div>



<div class="p-3 border-bottom bg-white">
<div class="d-flex align-items-center mb-2">
<h6 class="font-weight-bold mb-1">Costo Total</h6>
<h6 class="font-weight-bold ml-auto mb-1"><?=$pedido["TOTAL"]?></h6>
</div>
<p class="m-0 small text-muted">Revisa el detalle de tu pedido en tu correo,<br>Gracias.</p>
</div>
</div>

<div class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center border-top">
<div class="row">
<div class="col selected">
<a href="home.html" class="text-muted small text-decoration-none">
<p class="h4 m-0"><i class="icofont-grocery"></i></p>
Shop
</a>
</div>
<div class="col">
<a href="cart.html" class="text-muted small text-decoration-none">
<p class="h4 m-0"><i class="icofont-cart"></i></p>
Cart
</a>
</div>
<div class="col">
<a href="complete_order.html" class="text-dark small font-weight-bold text-decoration-none">
<p class="h4 m-0"><i class="text-success icofont-bag"></i></p>
My Order
</a>
</div>
<div class="col">
<a href="my_account.html" class="text-muted small text-decoration-none">
<p class="h4 m-0"><i class="icofont-user"></i></p>
Account
</a>
</div>
</div>
</div>
<nav id="main-nav">
        <ul class="second-nav">
    
            <li><a href="<?=SERVERURL?>tienda/grocery/"><i class="icofont-ui-home mr-2"></i> Tienda</a></li>
            <li><a href="<?=SERVERURL?>tienda/pedidos/"><i class="icofont-notification mr-2"></i> Pedidos</a></li>
            <li><a href="<?=SERVERURL?>tienda/direcciones/"><i class="icofont-search-1 mr-2"></i> Direcciones</a></li>
            <li><a href="<?=SERVERURL?>tienda/perfil/"><i class="icofont-list mr-2"></i> Perfil</a></li>

           

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

<script src="<?= SERVERURL ?>view/newtienda/js/osahan.js" ></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="b13af893828b0454dae5ae4a-|49" defer=""></script></body>
</html>