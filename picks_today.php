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

<body>
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
            <i class="icofont-moon"></i>
        </label>
        <em>Enable Dark Mode!</em>
    </div>
    <div class="picks-today">
        <div class="p-3 border-bottom">
            <div class="d-flex align-items-center">
                <a class="font-weight-bold text-success text-decoration-none" href="<?= SERVERURL ?>tienda/grocery/">
                    <i class="icofont-rounded-left back-page"></i></a>
                <span class="font-weight-bold ml-3 h6 mb-0">Eligir Hoy</span>
                <a class="toggle ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>
            </div>
        </div>

        <div class="pick_today px-3 pb-3">
        <div class="row">
                <?php
                    $items = $this->productos;
                    foreach($items as $i){
                        echo "<div class='col-6 col-sm-3 px-2 py-2'>
                        <div class='list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm'>
                            <div class='list-card-image'>
                                <a href='product_details.html' class='text-dark'>
                                    <div class='member-plan position-absolute'><span class='badge m-3 badge-danger'>10%</span></div>
                                    <div class='p-3'>
                                        <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' class='img-fluid item-img w-100 mb-3'>
                                        <h6>{$i["ARTICULO"]}</h6>
                                        <div class='d-flex align-items-center'>
                                            <h6 class='price m-0 text-success'>$0.8/kg</h6>
                                            <a href='cart.html' class='btn btn-success btn-sm ml-auto'>+</a>
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

    <script src="<?= SERVERURL ?>view/newtienda/vendor/jquery/jquery.min.js" type="a973643ad4fc012918a4a9ec-text/javascript"></script>
    <script src="<?= SERVERURL ?>view/newtienda/vendor/bootstrap/js/bootstrap.bundle.min.js" type="a973643ad4fc012918a4a9ec-text/javascript"></script>

    <script type="a973643ad4fc012918a4a9ec-text/javascript" src="<?= SERVERURL ?>view/newtienda/vendor/slick/slick.min.js"></script>

    <script type="a973643ad4fc012918a4a9ec-text/javascript" src="<?= SERVERURL ?>view/newtienda/vendor/sidebar/hc-offcanvas-nav.js"></script>

    <script src="<?= SERVERURL ?>view/newtienda/js/osahan.js" type="a973643ad4fc012918a4a9ec-text/javascript"></script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="a973643ad4fc012918a4a9ec-|49" defer=""></script>
</body>

</html>