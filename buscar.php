<?php 
    session_name('BOL_TIENDA');
    session_start();
    $cliente = isset($_SESSION['usuario'])? $_SESSION['usuario']:"none";
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
    <title><?=SISTEMA_NOMBRE?> - Tienda Online</title>
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
    <link rel="stylesheet" href="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.css">
    <link rel="manifest" href="<?=SERVERURL;?>manifest.json">
  </head>
  <body>
    <?php
        require "view/tienda/components/navbar.php";
    ?>
    
    <div class="ps-panel--sidebar" id="cart-mobile">
      <div class="ps-panel__header">
        <h3 _msthash="421083" _msttexthash="321412">Carrito de compras</h3>
      </div>
      <div class="navigation__content">
        <div class="ps-cart--mobile">
          <div class="ps-cart__content">
            <div class="ps-product--cart-mobile">
              <div class="ps-product__thumbnail"><a href="#"><img src="http://localhost/Curso/PRUEBAS/BOLPRESS/view/tienda/assets/img/products/clothing/7.jpg" alt=""></a></div>
              <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html" _msthash="1425047" _msttexthash="926965">Reloj de cuero clásico MVMTH en negro</a>
                <p _msthash="1435265" _msttexthash="418379"><strong _istranslated="1">Vendido por:</strong> TIENDA JOVEN</p><small _msthash="1242904" _msttexthash="63375">1 x $59.99</small>
              </div>
            </div>
          </div>
          <div class="ps-cart__footer">
            <h3><font _mstmutation="1" _msthash="863239" _msttexthash="123435">Sub Total:</font><strong _msthash="1359657" _msttexthash="38480">$59.99</strong></h3>
            <figure><a class="ps-btn" href="shopping-cart.html" _msthash="1294410" _msttexthash="160277">Ver carrito</a><a class="ps-btn" href="checkout.html" _msthash="1294411" _msttexthash="233376">Comprobación</a></figure>
          </div>
        </div>
      </div>
    </div>
    <div class="ps-panel--sidebar" id="navigation-mobile">
      <div class="ps-panel__header">
        <h3 _msthash="653796" _msttexthash="180167">Categorías</h3>
      </div>
      <div class="ps-panel__content">
            <ul class="menu--mobile">
              <?=$this->listar_presentacion?>
            </ul>
      </div>
    </div>
    <div class="navigation--list" _msthidden="4">
      <div class="navigation__content" _msthidden="4"><a class="navigation__item ps-toggle--sidebar" href="#menu-mobile" _msthidden="1"><i class="icon-menu"></i><span _msthash="656513" _msttexthash="45591" _msthidden="1"> Menu</span></a><a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile" _msthidden="1"><i class="icon-list4"></i><span _msthash="656514" _msttexthash="156923" _msthidden="1"> Categories</span></a><a class="navigation__item ps-toggle--sidebar" href="#search-sidebar" _msthidden="1"><i class="icon-magnifier"></i><span _msthash="656515" _msttexthash="74607" _msthidden="1"> Search</span></a><a class="navigation__item ps-toggle--sidebar" href="#cart-mobile" _msthidden="1"><i class="icon-bag2"></i><span _msthash="656516" _msttexthash="44603" _msthidden="1"> Cart</span></a></div>
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
    <div class="ps-breadcrumb">
      <div class="ps-container">
        <ul class="breadcrumb">
          <li><a href="index.html">Inicio</a></li>
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
              <figure>
                <h4 class="widget-title">By Price</h4>
                <div id="nonlinear"></div>
                <p class="ps-slider__meta">Price:<span class="ps-slider__value">$<span class="ps-slider__min"></span></span>-<span class="ps-slider__value">$<span class="ps-slider__max"></span></span></p>
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
              </figure>
              <figure>
                <h4 class="widget-title">By Color</h4>
                            <div class="ps-checkbox ps-checkbox--color color-1 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-1" name="size">
                              <label for="color-1"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-2 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-2" name="size">
                              <label for="color-2"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-3 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-3" name="size">
                              <label for="color-3"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-4 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-4" name="size">
                              <label for="color-4"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-5 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-5" name="size">
                              <label for="color-5"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-6 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-6" name="size">
                              <label for="color-6"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-7 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-7" name="size">
                              <label for="color-7"></label>
                            </div>
                            <div class="ps-checkbox ps-checkbox--color color-8 ps-checkbox--inline">
                              <input class="form-control" type="checkbox" id="color-8" name="size">
                              <label for="color-8"></label>
                            </div>
              </figure>
              <figure class="sizes">
                <h4 class="widget-title">BY SIZE</h4><a href="#">L</a><a href="#">M</a><a href="#">S</a><a href="#">XL</a>
              </figure>
            </aside>
          </div>
          <div class="ps-layout__right">
            <div class="ps-shopping ps-tab-root">
              <div class="ps-shopping__header">
                <p><strong> <?=$this->nro_productos?></strong> Productos encontrados con "<strong><?=$this->search_producto?></strong>" y categoría "<strong><?=$this->search_categoria?></strong>"</p>
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
                <h3>Best Sale Items</h3>
                <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#recommended1"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#recommended1"><i class="icon-chevron-right"></i></a></div>
              </div>
              <div class="ps-block__content">
                <div class="owl-slider" id="recommended1" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/1.jpg" alt=""></a>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$22.99 - $32.99</p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                    <p class="ps-product__price">$22.99 - $32.99</p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/2.jpg" alt=""></a>
                                  <div class="ps-product__badge">-7%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/3.jpg" alt=""></a>
                                  <div class="ps-product__badge">-16%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>02</span>
                                    </div>
                                    <p class="ps-product__price sale">$35.00 <del>$60.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                    <p class="ps-product__price sale">$35.00 <del>$60.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/4.jpg" alt=""></a>
                                  <div class="ps-product__badge">-5%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>23</span>
                                    </div>
                                    <p class="ps-product__price sale">$100.00 <del>$105.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                    <p class="ps-product__price sale">$100.00 <del>$105.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/5.jpg" alt=""></a>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Herschel Leather Duffle Bag In Brown Color</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$125.30</p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Herschel Leather Duffle Bag In Brown Color</a>
                                    <p class="ps-product__price">$125.30</p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/6.jpg" alt=""></a>
                                  <div class="ps-product__badge hot">Hot</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$1025.00 <del>$1422.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                    <p class="ps-product__price sale">$1025.00 <del>$1422.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/best/7.jpg" alt=""></a>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$599.00</p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <p class="ps-product__price">$599.00</p>
                                  </div>
                                </div>
                              </div>
                </div>
              </div>
            </div>
            <div class="ps-block--shop-features">
              <div class="ps-block__header">
                <h3>Recommended Items</h3>
                <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#recommended"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#recommended"><i class="icon-chevron-right"></i></a></div>
              </div>
              <div class="ps-block__content">
                <div class="owl-slider" id="recommended" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/1.jpg" alt=""></a>
                                  <div class="ps-product__badge">-37%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Ciate Palemore Lipstick Bold Red Color</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$42.99 <del>$60.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Ciate Palemore Lipstick Bold Red Color</a>
                                    <p class="ps-product__price sale">$42.99 <del>$60.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/2.jpg" alt=""></a>
                                  <div class="ps-product__badge">-37%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Set 30 Piece Korea StartSkin Natural Mask</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$32.99 <del>$60.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Set 30 Piece Korea StartSkin Natural Mask</a>
                                    <p class="ps-product__price sale">$32.99 <del>$60.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/3.jpg" alt=""></a>
                                  <div class="ps-product__badge">-25%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Baxter Care Hair Kit For Bearded Mens</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>02</span>
                                    </div>
                                    <p class="ps-product__price sale">$93.00 <del>$60.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Baxter Care Hair Kit For Bearded Mens</a>
                                    <p class="ps-product__price sale">$93.00 <del>$60.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/4.jpg" alt=""></a>
                                  <div class="ps-product__badge">-46%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Letter Printed Cushion Cover Cotton</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$13.00 <del>$20.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Letter Printed Cushion Cover Cotton</a>
                                    <p class="ps-product__price sale">$13.00 <del>$20.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/5.jpg" alt=""></a>
                                  <div class="ps-product__badge">-46%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Amcrest Security Camera in White Color</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$13.00 <del>$20.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Amcrest Security Camera in White Color</a>
                                    <p class="ps-product__price sale">$13.00 <del>$20.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/6.jpg" alt=""></a>
                                  <div class="ps-product__badge">-28%</div>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">LG White Front Load Steam Washer</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$1025.00 <del>$1422.00 </del></p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">LG White Front Load Steam Washer</a>
                                    <p class="ps-product__price sale">$1025.00 <del>$1422.00 </del></p>
                                  </div>
                                </div>
                              </div>
                              <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?=SERVERURL?>view/tienda/assets/img/products/shop/recommended/7.jpg" alt=""></a>
                                  <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-placement="top" title="Quick View" data-toggle="modal" data-target="#product-quickview"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><i class="icon-chart-bars"></i></a></li>
                                  </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                  <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <div class="ps-product__rating">
                                                  <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                  </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$599.00</p>
                                  </div>
                                  <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <p class="ps-product__price">$599.00</p>
                                  </div>
                                </div>
                              </div>
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
        <h3>Filter Products</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
      </div>
      <div class="ps-filter__content">
        <aside class="widget widget_shop">
          <h4 class="widget-title">Categories</h4>
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
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-1" name="brand">
                          <label for="brand-1">Adidas (3)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-2" name="brand">
                          <label for="brand-2">Amcrest (1)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-3" name="brand">
                          <label for="brand-3">Apple (2)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-4" name="brand">
                          <label for="brand-4">Asus (19)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-5" name="brand">
                          <label for="brand-5">Baxtex (20)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-6" name="brand">
                          <label for="brand-6">Adidas (11)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-7" name="brand">
                          <label for="brand-7">Casio (9)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-8" name="brand">
                          <label for="brand-8">Electrolux (0)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-9" name="brand">
                          <label for="brand-9">Gallaxy (0)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-10" name="brand">
                          <label for="brand-10">Samsung (0)</label>
                        </div>
                        <div class="ps-checkbox">
                          <input class="form-control" type="checkbox" id="brand-11" name="brand">
                          <label for="brand-11">Sony (0)</label>
                        </div>
          </figure>
          <figure>
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
          </figure>
          <figure>
            <h4 class="widget-title">By Color</h4>
                        <div class="ps-checkbox ps-checkbox--color color-1 ps-checkbox--inline">
                          <input class="form-control" type="checkbox" id="color-1" name="size">
                          <label for="color-1"></label>
                        </div>
                        <div class="ps-checkbox ps-checkbox--color color-2 ps-checkbox--inline">
                          <input class="form-control" type="checkbox" id="color-2" name="size">
                          <label for="color-2"></label>
                        </div>
                        <div class="ps-checkbox ps-checkbox--color color-3 ps-checkbox--inline">
                          <input class="form-control" type="checkbox" id="color-3" name="size">
                          <label for="color-3"></label>
                        </div>
                        <div class="ps-checkbox ps-checkbox--color color-4 ps-checkbox--inline">
                          <input class="form-control" type="checkbox" id="color-4" name="size">
                          <label for="color-4"></label>
                        </div>
                        <div class="ps-checkbox ps-checkbox--color color-5 ps-checkbox--inline">
                          <input class="form-control" type="checkbox" id="color-5" name="size">
                          <label for="color-5"></label>
                        </div>
          </figure>
          <figure class="sizes">
            <h4 class="widget-title">BY SIZE</h4><a href="#">L</a><a href="#">M</a><a href="#">S</a><a href="#">XL</a>
          </figure>
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
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/gmap3.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?=SERVERURL?>view/assets/plugins/shuffle/shuffle.js"></script>
    <!-- custom scripts-->
    <script src="<?=SERVERURL?>view/tienda/assets/js/main.js"></script>
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
        }
        ;

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
      document.addEventListener("DOMContentLoaded", function () {
        window.demo = new Demo(document.querySelector("#grid"));
        if(localStorage.getItem('carrito')){
          carrito = JSON.parse(localStorage.getItem('carrito')|| "[]");
        }
        lista_carrito();
        nro_deseos();
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
        let cantidad_items = carrito.length;
        $("#subtotal_carro").html(sub_total.toFixed(2));
        $("#cantidad_item_carrito").html(cantidad_items);

        
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
        $.post("<?=SERVERURL?>tienda/modal_detalle_producto/",{id_item},function(res){
          $("#detalle_producto_body").html(res);
          let productos = $(".ps-product__images .item");
          if(productos.length>1){
            $('.ps-product--quickview .ps-product__images').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                dots: false,
                arrows: true,
                infinite: false,
                prevArrow: "<a href='#'><i class='fa fa-angle-left'></i></a>",
                nextArrow: "<a href='#'><i class='fa fa-angle-right'></i></a>",
            });
          }
          $("#detalle_producto").modal('show');
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