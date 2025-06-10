<header class="header header--1" data-sticky="true">
    <div class="header__top">
    <div class="ps-container">
        <div class="header__left">
        <div class="menu--product-categories">
            <div class="menu__toggle"><i class="icon-menu"></i><span> Buscar por seccion</span></div>
            <div class="menu__content">
                <ul class="menu--dropdown">
                    <?=$this->lista_secciones?>
                </ul>
            </div>
        </div><a class="ps-logo" href="<?=SERVERURL?>tienda/online/"><img src="<?=SERVERURL?>view/tienda/assets/img/logo_light.png" alt=""></a>
        </div>
        <div class="header__center">
        <form class="ps-form--quick-search" action="<?=SERVERURL?>tienda/buscar" method="get">
            <div class="form-group--icon" style="width: 40%;">
                <i class="icon-chevron-down"></i>
                <select class="form-control" name='categoria'>
                <?=$this->li_presentacion?>
                </select>
            </div>
            <input class="form-control txtbuscar_producto" type="text" name='producto'  placeholder="¿Que estas buscando?..." id="input-search">
            <button type='submit'>Buscar</button>
            <div class="ps-panel--search-result">
                <div class="ps-panel__content nodos_productos_search">
                    <?=$this->lista_buscar_productos?>
                </div>
                
            </div>
        </form>
        </div>
        <div class="header__right">
        <div class="header__actions">
            
            <a class="header__extra" href="<?=SERVERURL?>tienda/wishlist/"><i class="icon-heart"></i><span><i id='nro_deseos'>0</i></span></a>
            <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-cart"></i><span><i id="cantidad_item_carrito">0</i></span></a>
            <div class="ps-cart__content">
                <div class="ps-cart__items">

                </div>
                <div class="ps-cart__footer">
                <h3>Sub Total: <strong> <?=$this->moneda?> <span  id="subtotal_carro">0.00</span></strong></h3>
                <figure><a class="ps-btn" href="<?=SERVERURL?>tienda/carrito/">Ver Carrito</a><a class="ps-btn" href="<?=SERVERURL?>tienda/checkout/" >Finalizar</a></figure>
                </div>
            </div>
            </div>
            <div class="ps-block--user-header">
                <a class="ps-block__left" href="<?=SERVERURL?>tienda/perfil/"><i class="icon-user"></i></a>
                
                <?php 
                    if(!isset($_SESSION["usuario"])){
                    ?>
                    <div class="ps-block__right">
                        <a href="<?=SERVERURL?>tienda/login/">Login</a>
                        <a href="<?=SERVERURL?>tienda/login/">Registrar</a>
                    </div>
                    <?php
                    }
                    ?>
                    
            
                </div>
            <?php 
                if(isset($_SESSION["usuario"])){
            ?>
                <div class="ps-block--user-header">
                    <a class="ps-block__left" href="<?=SERVERURL?>tienda/cerrar_sesion/"><i class="icon-power-switch"></i></a>
    
                </div>
            <?php
                    
                }
            ?>
            </div>
        </div>
    </div>
    </div>
    <nav class="navigation" style="padding: 10px;">
    <div class="ps-container">
        <div class="navigation__left">
        <div class="menu--product-categories">
            <div class="menu__toggle"><i class="icon-menu"></i><span> Buscar por seccion </span></div>
            <div class="menu__content">
                <ul class="menu--dropdown">
                    <?=$this->lista_secciones?>
                </ul>
            </div>
        </div>
        </div>
        <div class="navigation__right">
        
        </div>
    </div>
    </nav>
</header>
<header class="header header--mobile header--mobile-categories" data-sticky="true">
    <nav class="navigation--mobile">
    <div class="navigation__left">
        <a class="header__back" href="<?=SERVERURL?>tienda/online/">
            <i class="icon-chevron-left"></i>
            <strong>Tienda</strong>
        </a>
    </div>
    <div class="navigation__right">
        <div class="header__actions">
        <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-cart"></i><span><i id='numero_items_carrito_mobile'>0</i></span></a>
            <div class="ps-cart__content">
            <div class="ps-cart__items">
                
            </div>
            <div class="ps-cart__footer">
                <h3>Sub Total:<strong class='precio_carrito_mobile'>0.00</strong></h3>
                <figure>
                    <a class="ps-btn" href="<?=SERVERURL?>tienda/carrito/">Ver Carrito</a>
                    <a class="ps-btn" href="<?=SERVERURL?>tienda/checkout/">Finalizar</a>
                </figure>
            </div>
            </div>
        </div>
        <div class="ps-block--user-header">
             <a class="ps-block__left" href="<?=SERVERURL?>tienda/perfil/"><i class="icon-user"></i></a>
            <?php 
                if(!isset($_SESSION["usuario"])){
                ?>
                <div class="ps-block__right">
                    <a href="<?=SERVERURL?>tienda/login/">Login</a>
                    <a href="<?=SERVERURL?>tienda/login/">Register</a>
                </div>
                <?php
                }
            ?>
        </div>
        <?php 
                if(isset($_SESSION["usuario"])){
            ?>
                <div class="ps-block--user-header">
                    <a class="ps-block__left" href="<?=SERVERURL?>tienda/cerrar_sesion/"><i class="icon-power-switch"></i></a>
    
                </div>
            <?php
                    
                }
            ?>
        </div>
    </div>
    </nav>
    <div class="header__filter" >
        <button class="ps-shop__filter-mb" id="filter-sidebar" style="width: 100%;margin: auto;">
            <i class="icon-equalizer"></i><span>Filtro</span>
        </button>
        
    </div>
</header>

<div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
    <h3 _msthash="421083" _msttexthash="321412">Carrito de compras</h3>
    </div>
    <div class="navigation__content">
    <div class="ps-cart--mobile">
        <div class="ps-cart__content" id='carrito_mobile_items'>
           
        </div>
        <div class="ps-cart__footer">
            <h3><font _mstmutation="1" _msthash="863239" _msttexthash="123435">Sub Total:</font><strong _msthash="1359657" _msttexthash="38480" class='precio_carrito_mobile'>0.00</strong></h3>
            <figure>
                <a class="ps-btn" href="<?=SERVERURL?>tienda/carrito/" _msthash="1294410" _msttexthash="160277">Ver carrito</a>
                <a class="ps-btn" href="<?=SERVERURL?>tienda/checkout/" _msthash="1294411" _msttexthash="233376">Finalizar</a>
            </figure>
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
    <div class="navigation__content" _msthidden="4">
        <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile" _msthidden="1">
            <i class="icon-menu"></i>
            <span _msthash="656513" _msttexthash="45591" _msthidden="1"> Menu</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile" _msthidden="1">
            <i class="icon-list4"></i>
            <span _msthash="656514" _msttexthash="156923" _msthidden="1"> Categorias</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar" _msthidden="1">
            <i class="icon-magnifier"></i>
            <span _msthash="656515" _msttexthash="74607" _msthidden="1"> Buscar</span>
        </a>
        <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile" _msthidden="1">
            <i class="icon-cart"></i>
            <span _msthash="656516" _msttexthash="44603" _msthidden="1"> Carrito</span>
        </a>
    </div>
</div>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
    <form class="ps-form--search-mobile" action="<?=SERVERURL?>tienda/buscar" method="get">
        <div class="form-group--nest">
            <input type="hidden" name='categoria' value='TODO' >
            <input class="form-control" type="text" id='txt_buscar' name='producto' placeholder="Buscar algo...">
            <button><i class="icon-magnifier"></i></button>
        </div>
    </form>
    </div>
    <div class="navigation__content" style='padding:20px'>
        <?=$this->lista_buscar_productos?>
    </div><div class="navigation__content"></div>
</div>
<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
    <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
                <ul class="menu--mobile">
                    <li class="menu-item-has-children has-mega-menu"><a href="<?=SERVERURL?>tienda/online/">Tienda</a>
                                
                    </li>
                   
                    <li class="menu-item-has-children has-mega-menu"><a href="<?=SERVERURL?>tienda/login/">Login</a>
                    
                    <li class="menu-item-has-children has-mega-menu"><a href="<?=SERVERURL?>tienda/perfil/">Cuenta</a>
                    
                    </li>
                </ul>
    </div>
</div>
