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
    <title><?=SISTEMA_NOMBRE?> - Envio de Pedido</title>
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


    <div class="ps-panel--sidebar" id="cart-mobile">
      <div class="ps-panel__header">
        <h3>Shopping Cart</h3>
      </div>
      <div class="navigation__content">
        <div class="ps-cart--mobile">
          <div class="ps-cart__content">
            <div class="ps-product--cart-mobile">
              <div class="ps-product__thumbnail"><a href="#"><img src="img/products/clothing/7.jpg" alt=""></a></div>
              <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                <p><strong>Sold by:</strong>  YOUNG SHOP</p><small>1 x $59.99</small>
              </div>
            </div>
          </div>
          <div class="ps-cart__footer">
            <h3>Sub Total:<strong>$59.99</strong></h3>
            <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
          </div>
        </div>
      </div>
    </div>
    <div class="ps-panel--sidebar" id="navigation-mobile">
      <div class="ps-panel__header">
        <h3>Categories</h3>
      </div>
      <div class="ps-panel__content">
                    <ul class="menu--mobile">
                      <li class="current-menu-item "><a href="#">Hot Promotions</a>
                      </li>
                      <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">Consumer Electronic</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                          <div class="mega-menu__column">
                            <h4>Electronic<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="#">Home Audio &amp; Theathers</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">TV &amp; Videos</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Camera, Photos &amp; Videos</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Cellphones &amp; Accessories</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Headphones</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Videosgames</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Wireless Speakers</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Office Electronic</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="#">Digital Cables</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Audio &amp; Video Cables</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Batteries</a>
                                          </li>
                                        </ul>
                          </div>
                        </div>
                      </li>
                      <li class="current-menu-item "><a href="#">Clothing &amp; Apparel</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Home, Garden &amp; Kitchen</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Health &amp; Beauty</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Yewelry &amp; Watches</a>
                      </li>
                      <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">Computer &amp; Technology</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                          <div class="mega-menu__column">
                            <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="#">Computer &amp; Tablets</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Laptop</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Monitors</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Networking</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Drive &amp; Storages</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Computer Components</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Security &amp; Protection</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Gaming Laptop</a>
                                          </li>
                                          <li class="current-menu-item "><a href="#">Accessories</a>
                                          </li>
                                        </ul>
                          </div>
                        </div>
                      </li>
                      <li class="current-menu-item "><a href="#">Babies &amp; Moms</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Sport &amp; Outdoor</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Phones &amp; Accessories</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Books &amp; Office</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Cars &amp; Motocycles</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Home Improments</a>
                      </li>
                      <li class="current-menu-item "><a href="#">Vouchers &amp; Services</a>
                      </li>
                    </ul>
      </div>
    </div>
    <div class="navigation--list">
      <div class="navigation__content"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a><a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a><a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a><a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-bag2"></i><span> Cart</span></a></div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
      <div class="ps-panel__header">
        <form class="ps-form--search-mobile" action="index.html" method="get">
          <div class="form-group--nest">
            <input class="form-control" type="text" placeholder="Search something...">
            <button><i class="icon-magnifier"></i></button>
          </div>
        </form>
      </div>
      <div class="navigation__content"></div>
    </div>
    <div class="ps-panel--sidebar" id="menu-mobile">
      <div class="ps-panel__header">
        <h3>Menu</h3>
      </div>
      <div class="ps-panel__content">
                    <ul class="menu--mobile">
                      <li class="menu-item-has-children"><a href="index.html">Home</a><span class="sub-toggle"></span>
                                    <ul class="sub-menu">
                                      <li class="current-menu-item "><a href="index.html">Marketplace Full Width</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-2.html">Home Auto Parts</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-10.html">Home Technology</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-9.html">Home Organic</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-3.html">Home Marketplace V1</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-4.html">Home Marketplace V2</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-5.html">Home Marketplace V3</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-6.html">Home Marketplace V4</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-7.html">Home Electronic</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-8.html">Home Furniture</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-kids.html">Home Kids</a>
                                      </li>
                                      <li class="current-menu-item "><a href="homepage-photo-and-video.html">Home photo and picture</a>
                                      </li>
                                      <li class="current-menu-item "><a href="home-medical.html">Home Medical</a>
                                      </li>
                                    </ul>
                      </li>
                      <li class="menu-item-has-children has-mega-menu"><a href="shop-default.html">Shop</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                          <div class="mega-menu__column">
                            <h4>Catalog Pages<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="shop-default.html">Shop Default</a>
                                          </li>
                                          <li class="current-menu-item "><a href="shop-default.html">Shop Fullwidth</a>
                                          </li>
                                          <li class="current-menu-item "><a href="shop-categories.html">Shop Categories</a>
                                          </li>
                                          <li class="current-menu-item "><a href="shop-sidebar.html">Shop Sidebar</a>
                                          </li>
                                          <li class="current-menu-item "><a href="shop-sidebar-without-banner.html">Shop Without Banner</a>
                                          </li>
                                          <li class="current-menu-item "><a href="shop-carousel.html">Shop Carousel</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Product Layout<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="product-default.html">Default</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-extend.html">Extended</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-full-content.html">Full Content</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-box.html">Boxed</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-sidebar.html">Sidebar</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-default.html">Fullwidth</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Product Types<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="product-default.html">Simple</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-default.html">Color Swatches</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-image-swatches.html">Images Swatches</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-countdown.html">Countdown</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-multi-vendor.html">Multi-Vendor</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-instagram.html">Instagram</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-affiliate.html">Affiliate</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-on-sale.html">On sale</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-video.html">Video Featured</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-groupped.html">Grouped</a>
                                          </li>
                                          <li class="current-menu-item "><a href="product-out-stock.html">Out Of Stock</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Woo Pages<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="shopping-cart.html">Shopping Cart</a>
                                          </li>
                                          <li class="current-menu-item "><a href="checkout.html">Checkout</a>
                                          </li>
                                          <li class="current-menu-item "><a href="whishlist.html">Whishlist</a>
                                          </li>
                                          <li class="current-menu-item "><a href="compare.html">Compare</a>
                                          </li>
                                          <li class="current-menu-item "><a href="order-tracking.html">Order Tracking</a>
                                          </li>
                                          <li class="current-menu-item "><a href="my-account.html">My Account</a>
                                          </li>
                                          <li class="current-menu-item "><a href="checkout-2.html">Checkout 2</a>
                                          </li>
                                          <li class="current-menu-item "><a href="shipping.html">Shipping</a>
                                          </li>
                                          <li class="current-menu-item "><a href="payment.html">Payment</a>
                                          </li>
                                          <li class="current-menu-item "><a href="payment-success.html">Payment Success</a>
                                          </li>
                                        </ul>
                          </div>
                        </div>
                      </li>
                      <li class="menu-item-has-children has-mega-menu"><a href="#">Pages</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                          <div class="mega-menu__column">
                            <h4>Basic Page<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="about-us.html">About Us</a>
                                          </li>
                                          <li class="current-menu-item "><a href="contact-us.html">Contact</a>
                                          </li>
                                          <li class="current-menu-item "><a href="faqs.html">Faqs</a>
                                          </li>
                                          <li class="current-menu-item "><a href="comming-soon.html">Comming Soon</a>
                                          </li>
                                          <li class="current-menu-item "><a href="404-page.html">404 Page</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Vendor Pages<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="become-a-vendor.html">Become a Vendor</a>
                                          </li>
                                          <li class="current-menu-item "><a href="vendor-store.html">Vendor Store</a>
                                          </li>
                                          <li class="current-menu-item "><a href="vendor-dashboard-free.html">Vendor Dashboard Free</a>
                                          </li>
                                          <li class="current-menu-item "><a href="vendor-dashboard-pro.html">Vendor Dashboard Pro</a>
                                          </li>
                                          <li class="current-menu-item "><a href="store-list.html">Store List</a>
                                          </li>
                                          <li class="current-menu-item "><a href="store-list.html">Store List 2</a>
                                          </li>
                                          <li class="current-menu-item "><a href="store-detail.html">Store Detail</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Account Pages<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="user-information.html">User Information</a>
                                          </li>
                                          <li class="current-menu-item "><a href="addresses.html">Addresses</a>
                                          </li>
                                          <li class="current-menu-item "><a href="invoices.html">Invoices</a>
                                          </li>
                                          <li class="current-menu-item "><a href="invoice-detail.html">Invoice Detail</a>
                                          </li>
                                          <li class="current-menu-item "><a href="notifications.html">Notifications</a>
                                          </li>
                                        </ul>
                          </div>
                        </div>
                      </li>
                      <li class="menu-item-has-children has-mega-menu"><a href="#">Blogs</a><span class="sub-toggle"></span>
                        <div class="mega-menu">
                          <div class="mega-menu__column">
                            <h4>Blog Layout<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="blog-grid.html">Grid</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-list.html">Listing</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-small-thumb.html">Small Thumb</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-left-sidebar.html">Left Sidebar</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-right-sidebar.html">Right Sidebar</a>
                                          </li>
                                        </ul>
                          </div>
                          <div class="mega-menu__column">
                            <h4>Single Blog<span class="sub-toggle"></span></h4>
                                        <ul class="mega-menu__list">
                                          <li class="current-menu-item "><a href="blog-detail.html">Single 1</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-detail-2.html">Single 2</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-detail-3.html">Single 3</a>
                                          </li>
                                          <li class="current-menu-item "><a href="blog-detail-4.html">Single 4</a>
                                          </li>
                                        </ul>
                          </div>
                        </div>
                      </li>
                    </ul>
      </div>
    </div>
    <main class="ps-page--my-account">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="<?=SERVERURL?>tienda/online/">Tienda</a></li>
            <li><a href="#">Pedido</a></li>
            
          </ul>
        </div>
      </div>
      <section class="ps-section--account ps-checkout">
        <div class="container">
          <div class="ps-section__header">
            <h3>Información de envío</h3>
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
                        <figure><small>Envío a</small>
                            <p id='direccion_pedido'></p>
                            
                        </figure>
                        </div>
                        <h4>Monto de envío</h4>
                        <div class="ps-block__panel">
                        <figure><small>Tarifa de envio</small><strong id="tarifa_envio"></strong></figure>
                        </div>
                        <div class="ps-block__footer"><a href="<?=SERVERURL?>tienda/checkout/"><i class="icon-arrow-left mr-2"></i> Editar mi información </a><a class="ps-btn" href="<?=SERVERURL?>tienda/payment">Continuar con el pago</a></div>
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
            pedido_cliente_array();
            $(".header__filter").hide();
        });
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
          $(".precio_carrito_mobile").html("<?=$this->moneda?>"+sub_total.toFixed(2));
          $("#cantidad_item_carrito").html(cantidad_items);
          $("#numero_items_carrito_mobile").html(cantidad_items);

          
        }
         let table_carrito = ()=>{
            carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
            let template = '';
            let sub_total = 0;
            carrito.forEach(task => {
            let cantidad = parseFloat(task.cantidad);
            let precio =  parseFloat(task.precio);
            sub_total += cantidad*precio;
            template += `
            <a href="#"><strong>${task.articulo}</strong><span> ${task.cantidad} x <small><?=$this->moneda?> ${task.precio}</small></span></a>
                    `
            });
            let cliente_pedido = JSON.parse(localStorage.getItem('cliente_pedido')|| "[]");
            let tarifa_envio = parseFloat(cliente_pedido.tarifa_chek);
            let total = sub_total + tarifa_envio;
            $('#tb_productos_pedido').html(template);
            $("#c_subtotal").html("<?=$this->moneda?> "+sub_total.toFixed(2));
            $("#c_envio").html("<?=$this->moneda?> "+tarifa_envio.toFixed(2));
            $("#c_total").html("<?=$this->moneda?> "+total.toFixed(2));
            
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