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
    <div class="osahan-account">
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="font-weight-bold m-0">Mi cuenta</h5>
                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>
        <div class="p-4 profile text-center border-bottom">
            <img src="<?= SERVERURL ?>archives/avatars/sin_perfil.png" class="img-fluid rounded-pill">
            <h6 class="font-weight-bold m-0 mt-2"><?=$cliente["NOMBRE"]?></h6>
            <p class="small text-muted"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="442d25292b37252c252a042329252d286a272b29"></a></p>
            <a href="<?= SERVERURL ?>tienda/editprofile/" class="btn btn-success btn-sm"><i class="icofont-pencil-alt-5"></i> Editar Perfil</a>
        </div>
        <div class="account-sections">
            <ul class="list-group">

                <a href="<?= SERVERURL ?>tienda/direcciones/" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex align-items-center p-3">
                        <i class="icofont-address-book osahan-icofont bg-dark"></i>Mis direcciones
                        <span class="badge badge-success p-1 badge-pill ml-auto"><i class="icofont-simple-right"></i></span>
                    </li>
                </a>

                <a href="<?= SERVERURL ?>tienda/cerrar_sesion/" class="text-decoration-none text-dark">
                    <li class="border-bottom bg-white d-flex  align-items-center p-3">
                        <i class="icofont-lock osahan-icofont bg-danger"></i> Logout
                    </li>
                </a>
            </ul>
        </div>
    </div>

    <div class="osahan-menu-fotter fixed-bottom bg-white text-center border-top">
        <div class="row m-0">
        <a href="<?=SERVERURL?>tienda/grocery/" class="text-muted col small text-decoration-none p-2">
                <p class="h5 m-0"><i class="icofont-grocery"></i></p>
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
            <a href="javascript:void(0)" class="ttext-dark small col font-weight-bold text-decoration-none p-2 selected">
                <p class="h5 m-0"><i class="text-success icofont-user"></i></p>
                Cuenta
            </a>
        </div>
    </div>
    <nav id="main-nav">
        <ul class="second-nav">
            <li><a href="index.html"><i class="icofont-smart-phone mr-2"></i> Splash</a></li>
            <li>
                <a href="#"><i class="icofont-login mr-2"></i> Authentication</a>
                <ul>
                    <li> <a href="account-setup.html">Account Setup</a></li>
                    <li><a href="signin.html">Sign in</a></li>
                    <li><a href="signup.html">Sign up</a></li>
                    <li><a href="verification.html">Verification</a></li>
                </ul>
            </li>
            <li><a href="get_started.html"><i class="icofont-check-circled mr-2"></i> Get Started</a></li>
            <li><a href="landing.html"><i class="icofont-paper-plane mr-2"></i> Landing</a></li>
            <li><a href="home.html"><i class="icofont-ui-home mr-2"></i> Homepage</a></li>
            <li><a href="notification.html"><i class="icofont-notification mr-2"></i> Notification</a></li>
            <li><a href="search.html"><i class="icofont-search-1 mr-2"></i> Search</a></li>
            <li><a href="listing.html"><i class="icofont-list mr-2"></i> Listing</a></li>
            <li><a href="picks_today.html"><i class="icofont-flash mr-2"></i> Trending</a></li>
            <li><a href="recommend.html"><i class="icofont-like mr-2"></i> Recommend</a></li>
            <li><a href="fresh_vegan.html"><i class="icofont-badge mr-2"></i> Most Popular</a></li>
            <li><a href="product_details.html"><i class="icofont-search-document mr-2"></i> Product Details</a></li>
            <li><a href="cart.html"><i class="icofont-cart mr-2"></i> Cart</a></li>
            <li><a href="order_address.html"><i class="icofont-location-pin mr-2"></i> Order Address</a></li>
            <li><a href="delivery_time.html"><i class="icofont-ui-calendar mr-2"></i> Delivery Time</a></li>
            <li><a href="order_payment.html"><i class="icofont-money mr-2"></i> Order Payment</a></li>
            <li><a href="checkout.html"><i class="icofont-checked mr-2"></i> Checkout</a></li>
            <li><a href="successful.html"><i class="icofont-gift mr-2"></i> Successful</a></li>
            <li>
                <a href="#"><i class="icofont-sub-listing mr-2"></i> My Order</a>
                <ul>
                    <li><a href="complete_order.html">Complete Order</a></li>
                    <li><a href="status_complete.html">Status Complete</a></li>
                    <li><a href="progress_order.html">Progress Order</a></li>
                    <li><a href="status_onprocess.html">Status on Process</a></li>
                    <li><a href="canceled_order.html">Canceled Order</a></li>
                    <li><a href="status_canceled.html">Status Canceled</a></li>
                    <li><a href="review.html">Review</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icofont-ui-user mr-2"></i> My Account</a>
                <ul>
                    <li> <a href="my_account.html">My Account</a></li>
                    <li><a href="edit_profile.html">Edit Profile</a></li>
                    <li><a href="change_password.html">Change Password</a></li>
                    <li><a href="deactivate_account.html">Deactivate Account</a></li>
                    <li><a href="my_address.html">My Address</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icofont-page mr-2"></i> Pages</a>
                <ul>
                    <li> <a href="promos.html">Promos</a></li>
                    <li><a href="promo_details.html">Promo Details</a></li>
                    <li><a href="terms_conditions.html">Terms & Conditions</a></li>
                    <li><a href="privacy.html">Privacy</a></li>
                    <li><a href="terms&conditions.html">Conditions</a></li>
                    <li> <a href="help_support.html">Help Support</a></li>
                    <li> <a href="help_ticket.html">Help Ticket</a></li>
                    <li> <a href="refund_payment.html">Refund Payment</a></li>
                    <li> <a href="faq.html">FAQ</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icofont-link mr-2"></i> Navigation Link Example</a>
                <ul>
                    <li>
                        <a href="#">Link Example 1</a>
                        <ul>
                            <li>
                                <a href="#">Link Example 1.1</a>
                                <ul>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Link Example 1.2</a>
                                <ul>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Link Example 2</a></li>
                    <li><a href="#">Link Example 3</a></li>
                    <li><a href="#">Link Example 4</a></li>
                    <li data-nav-custom-content>
                        <div class="custom-message">
                            You can add any custom content to your navigation items. This text is just an example.
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="bottom-nav">
            <li class="email">
                <a class="text-success" href="home.html">
                    <p class="h5 m-0"><i class="icofont-home text-success"></i></p>
                    Home
                </a>
            </li>
            <li class="github">
                <a href="cart.html">
                    <p class="h5 m-0"><i class="icofont-cart"></i></p>
                    CART
                </a>
            </li>
            <li class="ko-fi">
                <a href="help_ticket.html">
                    <p class="h5 m-0"><i class="icofont-headphone"></i></p>
                    Help
                </a>
            </li>
        </ul>
    </nav>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="vendor/jquery/jquery.min.js" ></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script  src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="0458fc15a26c8179ffdb7fab-|49" defer=""></script>
</body>

</html>