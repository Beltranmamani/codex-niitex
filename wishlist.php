<?php 
    session_name('BOL_TIENDA');
    session_start();
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
    <title><?=SISTEMA_NOMBRE?> - Lista de deseos </title>
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
    <div class="ps-page--simple">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="<?=SERVERURL?>tienda/online/">Inicio</a></li>
            <li>Lista de deseos</li>
          </ul>
        </div>
      </div>
      <div class="ps-section--shopping ps-whishlist">
        <div class="container">
          <div class="ps-section__header">
            <h1>Lista de deseos</h1>
          </div>
          <div class="ps-section__content">
            <div class="table-responsive">
              <table class="table ps-table--whishlist">
                <thead>
                  <tr>
                    <th></th>
                    <th>Nombre de Producto</th>
                    <th>Precio Unitario</th>
                    <th>Stock de Stock</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="table_deseos">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php
      require("view/tienda/components/footer.php");
    ?>
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
    <div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
          <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
            <div class="ps-product__header">
              <div class="ps-product__thumbnail" data-vertical="false">
                <div class="ps-product__images" data-arrow="true">
                  <div class="item"><img src="img/products/detail/fullwidth/1.jpg" alt=""></div>
                  <div class="item"><img src="img/products/detail/fullwidth/2.jpg" alt=""></div>
                  <div class="item"><img src="img/products/detail/fullwidth/3.jpg" alt=""></div>
                </div>
              </div>
              <div class="ps-product__info">
                <h1>Marshall Kilburn Portable Wireless Speaker</h1>
                <div class="ps-product__meta">
                  <p>Brand:<a href="shop-default.html">Sony</a></p>
                  <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                  <option value="1">1</option>
                                  <option value="1">2</option>
                                  <option value="1">3</option>
                                  <option value="1">4</option>
                                  <option value="2">5</option>
                                </select><span>(1 review)</span>
                  </div>
                </div>
                <h4 class="ps-product__price">$36.78 – $56.99</h4>
                <div class="ps-product__desc">
                  <p>Sold By:<a href="shop-default.html"><strong> Go Pro</strong></a></p>
                  <ul class="ps-list--dot">
                    <li> Unrestrained and portable active stereo speaker</li>
                    <li> Free from the confines of wires and chords</li>
                    <li> 20 hours of portable capabilities</li>
                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                  </ul>
                </div>
                <div class="ps-product__shopping"><a class="ps-btn ps-btn--black" href="#">Add to cart</a><a class="ps-btn" href="#">Buy Now</a>
                  <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
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
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/gmap3.min.js"></script>
    <script src="<?=SERVERURL?>view/tienda/assets/plugins/toastr/toastr.min.js"></script>
    <!-- custom scripts-->
    <script src="<?=SERVERURL?>view/tienda/assets/js/main.js"></script>
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
          lista_de_deseos();
          $(".header__filter").hide();
        });
        let lista_de_deseos =()=>{
            let id_usuario = "<?=$_SESSION['usuario']?>";;
            $.post("<?=SERVERURL?>tienda/lista_deseos_cliente/",{id_usuario},function(res){
                $("#table_deseos").html(res);
            });
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
            $(".precio_carrito_mobile").html("<?=$this->moneda?>"+sub_total.toFixed(2));
            $("#cantidad_item_carrito").html(cantidad_items);
            $("#numero_items_carrito_mobile").html(cantidad_items);

            
        }
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
        let nro_deseos = () =>{
            let id_usuario = "<?=$_SESSION['usuario']?>";;
            $.post("<?=SERVERURL?>tienda/nro_lista_deseos/",{id_usuario},function(res){
            $("#nro_deseos").html(res);
            })
        }
        $(document).on('click','.btn_eliminar_deseo',function(){
            let id_deseo = $(this).attr('id_deseo');
            $.post("<?=SERVERURL?>tienda/eliminar_deseo/",{id_deseo},function(res){
               if(res==1){
                toastr["success"]("Producto eliminado de la lista de deseos");
                lista_de_deseos();
                nro_deseos();
               }else{
                toastr["error"]("No se pudo eliminar");
               }
            });
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
            toastr["success"]("Producto eliminado correctamente");
            lista_carrito();
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