<?php
    class tienda extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->listar_lineas_1 = $this->listar_lineas_1();
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->lista_recomendados = $this->lista_recomendados();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render('tienda/tiendahome');
            
        }
        function grocery(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            $items = $this->model->listar_items_limit8($id_sucursal);

            $this->view->moneda = $moneda;
            $this->view->productos = $items;
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->card_presentacion();
            $this->view->card_promociones = $this->card_promociones();
            $this->view->card_recomendados = $this->card_recomendados();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render('newtienda/home');
        }
        function promotions(){
            $this->view->render('newtienda/promos');

        }
        function search(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            $items = $this->model->listar_items_limit8($id_sucursal);
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->moneda = $moneda;
            $this->view->productos = $items;
            $this->view->listar_presentacion = $this->card_presentacion();
            $this->view->render('newtienda/search');
        }
        function product_details($param=null){
            $tienda = mainModel::parametros_tienda();


            if(is_string(mainModel::decryption($param[0]))){
                $detalle = $this->model->detalle_item_producto(mainModel::decryption($param[0]));
                $producto = "";
                $imagenes = "";
                $caracteristicas = "";
                $producto_detail = [];
                foreach($detalle as $d){
                    $producto_detail = $d;
                    $producto .= "{$d["ID_ITEM"]}|{$d["PRECIO_VENTA_4"]}|{$d["ARTICULO"]}|{$d["LINEA"]}|{$d["CANTIDAD"]}|{$d["IMAGEN"]}"; 
                    $imagenes_query = $this->model->lista_img_productos_producto($d["ID_PRODUCTO"]);
                    $imagen= SERVERURL.'archives/assets/productos/'.$d["IMAGEN"];
                    $imagenes .= "<div class='osahan-slider-item m-2'>
                        <img src='{$imagen}' class='img-fluid mx-auto shadow-sm rounded' alt='Responsive image'>
                    </div>"; 
                    foreach($imagenes_query as $ima){
                        $src_imagen= SERVERURL.'archives/assets/productos/'.$ima["IMG"];
                        $imagenes .="
                        <div class='osahan-slider-item m-2'>
                            <img src='{$src_imagen}' class='img-fluid mx-auto shadow-sm rounded' >
                        </div>
                        ";
                    }
                    $caracteristicas_query = $this->model->lista_caracteristicas_productos_producto($d["ID_PRODUCTO"]);
                            
                    foreach($caracteristicas_query as $car){
                        $caracteristicas .="
                        <li>{$car['CARACTERISTICA']}</li>
                        ";
                    }
                }
                $this->view->moneda = $tienda["MONEDA"];
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->producto = $producto;
                $this->view->producto_detail = $producto_detail;
                $this->view->imagenes = $imagenes;
                $this->view->caracteristicas = $caracteristicas;
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->lista_recomendados = $this->card_recomendados();
                $this->view->render('newtienda/product_details');
            }else{
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->moneda = $tienda["MONEDA"];
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->render('tienda/404');
            }
        }
        function cart(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->render('newtienda/cart');
        }
        function picktoday(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            $items = $this->model->listar_items_limit8($id_sucursal);

            
            $this->view->moneda = $moneda;
            $this->view->productos = $items;
            $this->view->listar_presentacion = $this->card_presentacion();
            $this->view->render('newtienda/picks_today');
        }
        // View Tienda
        function online($param = null){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            $items = $this->model->listar_items($id_sucursal);
            $nro_productos = $items->rowCount();
            $total_pages = ceil($nro_productos  / 12);
            $page = 0;
            if($param == null){
                $star = 0;
                $page = 1;
            }else if(!is_int($param[0])){
                $page = (int)$param[0];
                $star = ($page - 1) * 12;
            }
            
            $nro_pagina = $page;
            $atras = $nro_pagina;
            $adelante = $nro_pagina;
            if($atras>1){
                $n_atras = $page;
                $n_atras--;
                $atras = "<li><a href='".SERVERURL."tienda/online/{$n_atras}'><i class='icon-chevron-left'></i>Atras</a></li>";
            }else{
                $atras = " ";
            }
            if($adelante < $total_pages){
                $n_adelante = $page;
                $n_adelante++;
                $adelante = "<li><a href='".SERVERURL."tienda/online/{$n_adelante}'>Siguiente<i class='icon-chevron-right'></i></a></li>"; 
            }else{
                $adelante = "";
            }
            $items_productos = $this->model->listar_items_page($star,12,$id_sucursal);
            $nro_productos_new = $items_productos->rowCount();
            $productos = "";
            $productos_1 = "";
            if($items_productos){
                foreach($items_productos as $i){
                    $array = " \"{$i['LINEA']}\"";
                    $caracteristicas_query = $this->model->lista_caracteristicas_productos_producto($i["ID_PRODUCTO"]);
                    $caracteristicas = "";
                    foreach($caracteristicas_query as $car){
                        $caracteristicas .="
                        <li>{$car['CARACTERISTICA']}</li>
                        ";
                    }
                    $productos .= "
                    <div data-title='{$i["ARTICULO"]}' data-shape ='{$i['LINEA']}' data-precio ='{$i['PRECIO_VENTA_4']}' class='col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 item_productos' data-groups='[{$array}]' >
                            <div class='ps-product'>
                                <div class='ps-product__thumbnail'>
                                    <a href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>
                                        <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' >
                                    </a>
                                    <ul class='ps-product__actions'>
                                        <li><a href='javascript:void(0)' class='btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$i['PRECIO_VENTA_4']}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar al carrito'><i class='icon-bag2'></i></a></li>
                                        <li><a href='#' data-placement='top' class='ver_info' id_item='{$i['ID_ITEM']}'  title='Quick View' ><i class='icon-eye'></i></a></li>
                                        <li><a href='javascript:void(0)' id_item='{$i['ID_ITEM']}' class='btn_deseo' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar a la lista de deseos'><i class='icon-heart'></i></a></li>
                                        
                                    </ul>
                                </div>
                                <div class='ps-product__container'>
                                    <a class='ps-product__vendor' href='#'>{$i["LINEA"]}</a>
                                    <div class='ps-product__content'>
                                        <a class='ps-product__title' href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                        <p class='ps-product__price'>{$moneda} {$i["PRECIO_VENTA_4"]}</p>
                                    </div>
                                    <div class='ps-product__content hover'>
                                        <a class='ps-product__title picture-item__title' href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                        <p class='ps-product__price'>{$moneda} {$i["PRECIO_VENTA_4"]}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    ";
                    $productos_1 .= "
                    <div class='ps-product ps-product--wide'>
                        <div class='ps-product__thumbnail'><a  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'><img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' alt=''></a>
                        </div>
                        <div class='ps-product__container'>
                            <div class='ps-product__content'>
                                <a class='ps-product__title'  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                <p class='ps-product__vendor'>Vendido por:<a href='#'>{$i["LINEA"]}</a></p>
                                <ul class='ps-product__desc'>
                                    {$caracteristicas}
                                </ul>
                            </div>
                            <div class='ps-product__shopping'>
                                <p class='ps-product__price'>{$moneda} {$i["PRECIO_VENTA_4"]}</p><a class='ps-btn' href='javascript:void(0)' class='btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$i['PRECIO_VENTA_4']}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}'>Agregar al carrito</a>
                                <ul class='ps-product__actions'>
                                <li>
                                    <a href='javascript:void(0)' id_item='{$i['ID_ITEM']}' class='btn_deseo' >
                                        <i class='icon-heart'></i> 
                                            Lista de deseos
                                    </a>
                                    </li>          
                                </ul>
                            </div>
                        </div>
                    </div>
                    ";
                }
            }
            $paginacion = "";
            
            for ($i=1; $i <= $total_pages; $i++) { 
                
                if($i == $nro_pagina){
                    $paginacion .= "
                        <li class='active'><a href='".SERVERURL."tienda/online/{$i}'>{$i}</a></li>
                    
                    ";
                }else{
                    $paginacion .= "
                        <li><a href='".SERVERURL."tienda/online/{$i}'>{$i}</a></li>
                    
                    ";
                }
            }
            
            $paginacion_completo = $atras.$paginacion.$adelante;
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->nro_pagina = $nro_pagina;
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->listar_lineas_1 = $this->listar_lineas_1();
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->lista_recomendados = $this->lista_recomendados();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->nro_productos = $nro_productos_new;
            $this->view->paginacion = $paginacion_completo;
            $this->view->producto = $productos;
            $this->view->producto_detalle = $productos_1;
            $this->view->render('tienda/index');
        }
        function lista_departamentos(){
            $lista_departamento = "";
            $departamento = $this->model->lista_departamento();
            if($departamento){
                $lista_departamento .= "<option value='0' selected='true' disabled>Seleccione un departamento</option>";
                foreach($departamento as $doc){
                    $lista_departamento .= "
                        <option value='{$doc['ID_DEPARTAMENTO']}'>{$doc['DEPARTAMENTO']}</option>
                    ";
                }
            }
            return $lista_departamento;
        }
        function lista_recomendados(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            
            $items = $this->model->lista_productos_recomendados($id_sucursal);
            $productos = "";
            if($items){
                foreach($items as $i){
                    $imagen = SERVERURL."archives/assets/productos/{$i['IMAGEN']}";
                    $descuento_badge = (int)$i['DESCUENTO'];
                    $precio_nuevo = $i['PRECIO_VENTA_4'];
                    $sale = "";
                    $del = "";
                    if($descuento_badge>0){
                        $del = "<del>Bs {$precio_nuevo} </del>";
                        $sale = "sale";
                        $desc = ($precio_nuevo*$descuento_badge/100);
                        $precio_nuevo = $precio_nuevo-$desc;
                        $descuento_badge = " <div class='ps-product__badge'>-{$descuento_badge}%</div>";
                    }else{
                        $descuento_badge = "";
                    }
                    $productos .= "
                    <div class='col-6 col-sm-3 px-2 py-2'>
                        <div class='list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm'>
                            <div class='list-card-image'>
                                <a href='".SERVERURL."tienda/product_details/".mainModel::encryption("{$i['ID_ITEM']}")."' class='text-dark'>
                                    <div class='member-plan position-absolute'><span class='badge m-3 badge-danger'>10%</span></div>
                                    <div class='p-3'>
                                        <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' class='img-fluid item-img w-100 mb-3'>
                                        <h6> {$i["ARTICULO"]}</h6>
                                        <div class='d-flex align-items-center'>
                                            <h6 class='price m-0 text-success'> {$i["PRECIO_VENTA_4"]}</h6>
                                            <a href='cart.html' class='btn btn-success btn-sm ml-auto'>+</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                
                    ";
                }
                return $productos;
            }
        }
        function card_recomendados(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            
            $items = $this->model->lista_productos_recomendados($id_sucursal);
            $productos = "";
            if($items){
                foreach($items as $i){
                    $imagenes_query = $this->model->lista_img_productos_producto($i["ID_PRODUCTO"]);
                    $imagenes = "";
                    foreach($imagenes_query as $ima){
                        $src_imagen= SERVERURL.'archives/assets/productos/'.$ima["IMG"];
                        $imagenes .="
                        <div class='osahan-slider-item m-2 rounded'>
                                <img src='{$src_imagen}' class='img-fluid mx-auto rounded shadow-sm' alt='Responsive image'>
                            </div>
                        ";
                            }
                    $imagen = SERVERURL."archives/assets/productos/{$i['IMAGEN']}";
                    $descuento_badge = (int)$i['DESCUENTO'];
                    $precio_nuevo = $i['PRECIO_VENTA_4'];
                    $sale = "";
                    $del = "";
                    if($descuento_badge>0){
                        $del = "<del>Bs {$precio_nuevo} </del>";
                        $sale = "sale";
                        $desc = ($precio_nuevo*$descuento_badge/100);
                        $precio_nuevo = $precio_nuevo-$desc;
                        $descuento_badge = "                        <div class='m-4 member-plan position-absolute'><span class='badge badge-danger'>{$descuento_badge}%</span></div>";
                    }else{
                        $descuento_badge = "";
                    }
                    $productos .= "
                    <div class='col-12 mb-3'>
                    <a href='".SERVERURL."tienda/product_details/".mainModel::encryption("{$i['ID_ITEM']}")."' class='text-dark text-decoration-none'>
                        <div class='list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm'>
                            {$descuento_badge}
                            <div class='recommend-slider rounded pt-2'>
                                <div class='osahan-slider-item m-2 rounded'>
                                    <img src='{$imagen}' class='img-fluid mx-auto rounded shadow-sm' alt='Responsive image'>
                                </div>
                                {$imagenes}
                            </div>
                            <div class='p-3 position-relative'>
                                <h6 class='mb-1 font-weight-bold text-success'>{$i['ARTICULO']}
                                </h6>
                            
                                <div class='d-flex align-items-center'>
                                    <h6 class='m-0'>{$moneda} {$precio_nuevo} / {$i['PREFIJO']} </h6>
                                    <a href='javascript:void(0)' class='btn btn-success btn-sm ml-auto btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$precio_nuevo}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' data-toggle='tooltip' >+</a>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                    ";
                }

                    // $productos .= "
                    // <div class='col-6 col-sm-3 px-2 py-2'>
                    //     <div class='list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm'>
                    //         <div class='list-card-image'>
                    //             <a href='".SERVERURL."tienda/product_details/".mainModel::encryption("{$i['ID_ITEM']}")."' class='text-dark'>
                    //                 <div class='member-plan position-absolute'><span class='badge m-3 badge-danger'>10%</span></div>
                    //                 <div class='p-3'>
                    //                     <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' class='img-fluid item-img w-100 mb-3'>
                    //                     <h6> {$i["ARTICULO"]}</h6>
                    //                     <div class='d-flex align-items-center'>
                    //                         <h6 class='price m-0 text-success'> {$i["PRECIO_VENTA_4"]}</h6>
                    //                         <a href='cart.html' class='btn btn-success btn-sm ml-auto'>+</a>
                    //                     </div>
                    //                 </div>
                    //             </a>
                    //         </div>
                    //     </div>
                    // </div>
                
                    // ";
            
                return $productos;
            }
        }
        function lista_buscar_productos(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $moneda = $tienda["MONEDA"];
            $items = $this->model->listar_items($id_sucursal);
            $productos = "";
            if($items){
                foreach($items as $i){
                    $imagen = SERVERURL."archives/assets/productos/{$i['IMAGEN']}";
                    $productos .= "
                    <a href='".SERVERURL."tienda/product_details/".mainModel::encryption("{$i['ID_ITEM']}")."' class='text-dark ps-product--search-result' articulo='{$i['ARTICULO']}' precio=''>
                        <div class='d-flex align-items-center border-bottom p-3'>
                            <img style='width:50px' src='{$imagen}' class='img-fluid rounded shadow-sm mr-3'>
                            <span class='font-weight-bold'>
                            {$i['ARTICULO']}
                            </span>
                        </div>
                    </a>
                
                    ";
                }
                return $productos;
            }
        }
        function listar_presentacion()
        {
            $presentacion = $this->model->listar_presentacion();
            if ($presentacion) {
                $option = "";
                foreach ($presentacion as $row) {
                    $option .= "<li class='current-menu-item '>
                            <a href='".SERVERURL."tienda/categoria/{$row['NOMBRE']}' value='{$row['ID_PRESENTACION']}'>{$row['NOMBRE']}</a>
                        </li>";
                }
                return $option;
            }
        }
         function listar_secciones()
        {
            $secciones = $this->model->listar_secciones();
            if ($secciones) {
                $option = "";
                foreach ($secciones as $row) {
                    $presentaciones = $this->model->listar_secciones_presentacion($row['ID_SECCION']);
                    $class_sub_item = "";
                    $megamenu= "";
                    if($presentaciones){
                        if($presentaciones->rowCount()>0){
                            $class_sub_item = "menu-item-has-children has-mega-menu";
                            $li_item  = ""; 
                            foreach($presentaciones as $pre){
                                $li_item .="
                                <li>
                                    <a href='".SERVERURL."tienda/categoria/{$pre['NOMBRE']}'>{$pre['NOMBRE']}</a>
                                </li>
                                ";
                            }
                            $megamenu = "

                                    <ul >
                                        {$li_item}

                                    </ul>";
                        }
                    }
                    $option .= "
                    <li >
                        <a href='#'> {$row['SECCION']}</a>
                        {$megamenu}
                    </li>";
                }
                return $option;
            }
        }
        function li_presentacion()
        {
            $presentacion = $this->model->listar_presentacion();
            if ($presentacion) {
                $option = "<option value='TODO' selected='selected'>Todo</option>";
                foreach ($presentacion as $row) {
                    $option .= "
                        <option class='level-0' value='{$row['NOMBRE']}'>{$row['NOMBRE']}</option>
                    ";
                }
                return $option;
            }
        }
        function card_presentacion()
        {
            $presentacion = $this->model->listar_presentacion();
            $nro_presentacion = $presentacion->rowCount();
            $total_slider = ceil($nro_presentacion  / 6);
            $card = "";
            for($i=0;$i<$total_slider;$i++){
                $card .= " <div class='osahan-slider-item m-2'>
                    <div class='row'>
                ";
                $presentaciones = "";
                    $star = $i * 6;
                    $presentacion_pages = $this->model->listar_presentacion_page($star,6);
                    foreach($presentacion_pages as $pre){
                        $presentaciones.="
                        <div class='col-6'>
                                <div class='bg-white shadow-sm rounded text-center  px-2 py-3 c-it m-2'>
                                <a href='".SERVERURL."tienda/categoria/{$pre['NOMBRE']}'>
                                    <img src='".SERVERURL."archives/assets/categorias/{$pre['FOTO']}' class='img-fluid px-2'>
                                    <p class='m-0 pt-2 text-muted text-center'>{$pre['NOMBRE']}</p>
                                </a>
                            </div>
                        </div>";
                    }
                $card.="{$presentaciones}
                    </div>
                </div>";
            }
            return $card;
            // $nro_pagina = $page;
            // if ($presentacion) {
            //     // $card = "";
            //     // foreach ($presentacion as $row) {
            //     //     $card .= "
            //     //     <div class='osahan-slider-item m-2'>
            //     //         <a href='".SERVERURL."tienda/categoria/{$row['NOMBRE']}'>
            //     //             <img src='".SERVERURL."archives/assets/categorias/{$row['FOTO']}' class='img-categories img-fluid mx-auto rounded'>
            //     //             <p class='m-0 pt-2 text-muted text-center'>{$row['NOMBRE']}</p>
            //     //         </a>
            //     //     </div>
 
            //     //     ";
            //     //     // $card .= "
            //     //     // <div class='col-3 px-2 py-2'>
            //     //     //     <div class='bg-white shadow-sm rounded text-center  px-2 py-3 c-it'>
            //     //     //         <a href='listing.html'>
            //     //     //             <img src='".SERVERURL."archives/assets/categorias/{$row['FOTO']}' class='img-fluid px-2'>
            //     //     //             <p class='m-0 pt-2 text-muted text-center'>{$row['NOMBRE']}</p>
            //     //     //         </a>
            //     //     //     </div>
            //     //     // </div>
            //     //     // ";
            //     // }
            //     return $card;
            // }
        }
        function card_promociones()
        {
            $presentacion = $this->model->listar_promociones();
            if ($presentacion) {
                $card = "";
                foreach ($presentacion as $row) {
                    $card .= "
                    <div class='osahan-slider-item m-2'>
                        <a href='javascript:void(0)'>
                            <img src='".SERVERURL."archives/assets/promociones/{$row['IMAGEN']}' class='img-fluid mx-auto rounded' alt='Responsive image'>
                        </a>
                    </div>
 
                    ";
                    // $card .= "
                    // <div class='col-3 px-2 py-2'>
                    //     <div class='bg-white shadow-sm rounded text-center  px-2 py-3 c-it'>
                    //         <a href='listing.html'>
                    //             <img src='".SERVERURL."archives/assets/categorias/{$row['FOTO']}' class='img-fluid px-2'>
                    //             <p class='m-0 pt-2 text-muted text-center'>{$row['NOMBRE']}</p>
                    //         </a>
                    //     </div>
                    // </div>
                    // ";
                }
                return $card;
            }
        }
        function listar_lineas()
        {
            $presentacion = $this->model->listar_lineas();
            if ($presentacion) {
                $option = "";
                foreach ($presentacion as $row) {
                    $option .= "<div class='ps-checkbox'>
                                <input class='form-control' type='checkbox' value='{$row["LINEA"]}' id='brand-{$row["ID_LINEA"]}' name='brand'>
                                <label for='brand-{$row["ID_LINEA"]}'>{$row["LINEA"]}</label>
                            </div>";
                }
                return $option;
            }
        } function listar_lineas_1()
        {
            $presentacion = $this->model->listar_lineas();
            if ($presentacion) {
                $option = "";
                foreach ($presentacion as $row) {
                    $option .= "<div class='ps-checkbox'>
                                <input class='form-control' type='checkbox' value='{$row["LINEA"]}' id='brand-{$row["ID_LINEA"]}_2' name='brand_2'>
                                <label for='brand-{$row["ID_LINEA"]}_2'>{$row["LINEA"]}</label>
                            </div>";
                }
                return $option;
            }
        }
       

        function login(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];

            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render('newtienda/signin');
        }
        function signup(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];

            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render('newtienda/signup');
        }
        function registrarse(){
            if(isset($_POST["correo_reg"]) && isset($_POST["pass_reg"])){
                $cliente_code = $this->generar_codigo_usuario();
                $numero = $this->model->usuarios_tienda();
                if($numero){
                    $numero = $numero->rowCount()+1;
                }
                $nombre = "$numero";
                $id_documento = "DOCUMENTO9795051";
                $n_documento = "00000000";
                $correo = $_POST["correo_reg"];
                $pass = mainModel::encryption($_POST["pass_reg"]);
                $perfil = "sin_perfil.jpg";
                $telefono = "(001)090 997 ";
                $fecha = "0000-00-00";
                $agregar_cliente = $this->model->agregar_cliente_usuario($cliente_code,$id_documento,$n_documento,$nombre,$correo,$pass,$perfil,$telefono,$fecha,1,1);
                if($agregar_cliente){
                    if($agregar_cliente->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function generar_codigo_usuario(){
            $cn = mainModel::conectar();
            $numero = $this->model->usuarios_tienda();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('USUARIO',6,$numero);
            }else{
                return 0;
            }
        }
        function iniciar_sesion(){
            if(isset($_POST["correo"]) && isset($_POST["pass"])){
                $correo = $_POST["correo"];
                $pass = mainModel::encryption($_POST["pass"]);
                $inicio = $this->model->inicio_sesion_usuario($correo,$pass);
                if($inicio){
                    if($inicio->rowCount()>0){
                        session_name('BOL_TIENDA');
                        session_start();
                        foreach($inicio as $row){
                            $_SESSION['usuario'] = $row['ID_CLIENTE'];
                        }
                       echo 1;

                    }
                }else{
                    echo 0;
                }
            }
        }
        function perfil(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_documento = $this->model->listar_documento();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("newtienda/my_account");
        }
        function editprofile(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_documento = $this->model->listar_documento();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("newtienda/edit_profile");
        }
        function pedidos(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_documento = $this->model->listar_documento();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("newtienda/complete_order");
        }
        function notificaciones(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_documento = $this->model->listar_documento();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("tienda/notificaciones");
        }
        function direcciones(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->listar_documento = $this->model->listar_documento();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("newtienda/my_address");
        }
        function add_lista_deseos(){
            if(isset($_POST['id_item'])){
                $code = $this->generar_codigo_deseos();
                $insertar = $this->model->agregar_deseo_cliente($code,$_POST['id_item'],$_POST['id_usuario']);
                if($insertar){
                    if($insertar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function agregar_direccion(){
            if(isset($_POST['id'])){
                $code = $this->generar_codigo_direccion();
                $insertar = $this->model->agregar_direccion_cliente($code,$_POST['id'],$_POST['direccion']);
                if($insertar){
                    if($insertar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function actualizar_direccion(){
            if(isset($_POST['id_dire'])){
                $actualizar = $this->model->actualizar_direccion_cliente($_POST['id_dire'],$_POST['direccion']);
                if($actualizar){
                    if($actualizar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function detalle_modal_direccion(){
            if(isset($_POST['id'])){
                $detalle = $this->model->detalle_direccion_cliente($_POST['id']);
                if($detalle){
                    $modal = "";
                    foreach($detalle as $d){
                        $modal = " <div class='modal-body'>
                                    <div class='col-md-12 form-group'>
                                            <label class='form-label'>Direccion</label>
                                            <div class='input-group'>
                                            <input type='hidden' class='form-control' value='{$d['ID_DIRECCION']}' name='id_dire' id='id_dire' placeholder='Nueva dirección'>

                                                <input placeholder='Direccion'  value='{$d['DIRECCION']}'  name='direccion' id='direccion_2' type='text' class='form-control'>
                                                <div class='input-group-append'><button id='button-addon2' type='button' class='btn btn-outline-secondary'><i class='icofont-pin'></i></button></div>
                                            </div>
                                        </div>
                                    
                                    </div>";
                    }
                    echo $modal;
                }
            }
        }
        function lista_tabla_direccion(){
            if(isset($_POST['id_usuario'])){
                $consulta = $this->model->lista_direcciones_clientes($_POST['id_usuario']);
                if($consulta){
                    $table = "";
                    $n = 1;
                    foreach($consulta as $c){
                        $table.="
                        <div class='custom-control custom-radio px-0 mb-3 position-relative border-custom-radio'>
                            <input type='radio' id='customRadioInline1' name='customRadioInline1' class='custom-control-input' checked>
                            <label class='custom-control-label w-100' for='customRadioInline1'>
                                <div>
                                    <div class='p-3 bg-white rounded shadow-sm w-100'>
                                        <div class='d-flex align-items-center mb-2'>
                                            <p class='mb-0 h6'>{$c['DIRECCION']}</p>
                                        </div>

                                        <p class='pt-2 m-0 text-right'>
                                        <span class='small'><a href='#' data-toggle='modal' data-target='#exampleModal2' edit='{$c['ID_DIRECCION']}' class='text-decoration-none text-success btn_editar'><i class='icofont-edit'></i> Editar</a></span>
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        ";
                        $n++;
                    }
                    echo $table;
                }
            }
        }
        function lista_option_direccion(){
            if(isset($_POST['id_usuario'])){
                $consulta = $this->model->lista_direcciones_clientes($_POST['id_usuario']);
                if($consulta){
                    $table = "";
                    $n = 1;
                    $table.="<option value='0'>Seleccionar una dirección</option>";
                    foreach($consulta as $c){
                        $table.="
                           <option value='{$c['ID_DIRECCION']}'>{$c['DIRECCION']}</option>
                        ";
                        $n++;
                    }
                    echo $table;
                }
            }
        }
        function generar_codigo_deseos(){
            $cn = mainModel::conectar();
            $numero = $this->model->lista_deseos();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('DESEO',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_direccion(){
            $cn = mainModel::conectar();
            $numero = $this->model->lista_direccion();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('DIRECCION',6,$numero);
            }else{
                return 0;
            }
        }
        function nro_lista_deseos(){
            if(isset($_POST['id_usuario'])){
                $numero = $this->model->lista_deseos_cliente($_POST['id_usuario']);
                if($numero){
                    echo $numero->rowCount();
                }
            }
        }
        function wishlist(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->render("tienda/wishlist");
        }
        function carrito(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->render("tienda/carrito");
        }
        function lista_deseos_cliente(){
            if(isset($_POST['id_usuario'])){
                $tienda = mainModel::parametros_tienda();
            
                $numero = $this->model->lista_deseos_cliente($_POST['id_usuario']);
                if($numero){
                    $productos = "";
                    foreach($numero as $row){
                        $stock = "
                        <td>
                            <span class='ps-tag ps-tag--out-stock'>Sin Stock</span>
                        </td>
                        <td>
                            
                        
                        </td>";
                        if($row["CANTIDAD"]>0){
                            $stock = "
                            <td>
                                <span class='ps-tag ps-tag--in-stock'>En Stock</span>
                            </td>
                            <td>
                                <a href='javascript:void(0)' class='ps-btn btn_carrito'  id_item='{$row['ID_ITEM']}' articulo='{$row['ARTICULO']}' cantidad='{$row['CANTIDAD']}' precio='{$row['PRECIO_VENTA_4']}' linea='{$row['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$row["IMAGEN"]}'>Agregar al carrito</a>
                            
                            </td>";
                        }
                        $productos.="
                        <tr>
                            <td><a href='javascript:void(0)' class='btn_eliminar_deseo' id_deseo='{$row['ID_DESEO']}'><i class='icon-cross'></i></a></td>
                            <td>
                                <div class='ps-product--cart'>
                                    <div class='ps-product__thumbnail'><a  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$row['ID_ITEM']}")."'><img src='".SERVERURL."archives/assets/productos/{$row['IMAGEN']}' alt=''></a></div>
                                    <div class='ps-product__content'><a  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$row['ID_ITEM']}")."'>{$row['ARTICULO']}</a></div>
                                </div>
                            </td>
                            <td class='price'>{$tienda['MONEDA']} <span>{$row['PRECIO_VENTA_4']}</span></td>
                            {$stock}
                        </tr>
                        ";
                    }
                    echo $productos;
                }
            }
        }
        function eliminar_deseo(){
            if(isset($_POST["id_deseo"])){
                $eliminar = $this->model->eliminar_deseo($_POST["id_deseo"]);
                if($eliminar){
                    if($eliminar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function checkout(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->lista_departamentos = $this->lista_departamentos();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("newtienda/checkout");
        }
        function shipping(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->lista_departamentos = $this->lista_departamentos();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("tienda/shipping");
        }
        function success(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->lista_departamentos = $this->lista_departamentos();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("newtienda/successful");
        }
        function payment(){
            $tienda = mainModel::parametros_tienda();
            $this->view->moneda = $tienda["MONEDA"];
            $this->view->lista_secciones = $this->listar_secciones();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->li_presentacion = $this->li_presentacion();
            $this->view->lista_departamentos = $this->lista_departamentos();
            $this->view->lista_buscar_productos = $this->lista_buscar_productos();
            $this->view->render("tienda/payment");
        }
        function cerrar_sesion(){
            session_name('BOL_TIENDA');
            session_start();
            
            echo '<script> window.location.href="'.SERVERURL.'tienda/login/" ;</script>';
            session_destroy();
        }
        function guardar_invoice(){
            if(isset($_POST["carrito"])){
                date_default_timezone_set(ZONEDATE);
                $date = date('Y-m-d H:i:s');
                $carrito = $_POST["carrito"];
                $cliente_pedido = $_POST["cliente_pedido"];
                $provincia_chek = $cliente_pedido["provincia_chek"];
                $direccion_id = $cliente_pedido["direccion_chek"];
                $tarifa_chek = floatval($cliente_pedido["tarifa_chek"]);
                $id_cliente = $cliente_pedido["id_cliente"];
                $nro_invoice = $this->generar_nro_invoice();
                $codigo_invoice = $this->generar_codigo_invoice();
                $subtotal = 0;
                $titulo = "";
                foreach($carrito as $car){
                    $titulo = "{$car['articulo']}";
                    $cantidad = floatval($car["cantidad"]);
                    $precio = floatval($car["precio"]);
                    $subtotal += $precio*$cantidad;
                }
                $total = floatval($tarifa_chek+$subtotal);
                $ingresar = $this->model->agregar_invoice($codigo_invoice,$id_cliente,$provincia_chek,$nro_invoice,$direccion_id,$titulo,$date,$subtotal,$tarifa_chek,$total,"SSASA",1,1);
                if($ingresar){
                    if($ingresar->rowCount()>0){
                        foreach($carrito as $car){
                            $detalle_codigo = $this->generar_codigo_detalle_invoice();
                            $id_item = "{$car['id_item']}";
                            $titulo = "{$car['articulo']}";
                            $p_a = "{$car['PRECIO_ACTIVO']}";
                            $equivalente = $car['STOCK_'.$p_a];
    
                            $cantidad = floatval($car["cantidad"]);
                            $stock_equivalente = floatval($equivalente*$cantidad);
                            $precio = floatval($car["precio"]);
                            $agregar = $this->model->agregar_detalle_invoice($detalle_codigo,$id_item,$codigo_invoice,$stock_equivalente,$precio,$p_a);
                            if(!$agregar){
                                echo 4;
                            }
                        }
                        echo 1;
                        //activar para local y enviar correo en remoto
                        // $this->correo($codigo_invoice);
                    }else{
                        echo 0;
                    }
                }
                // foreach($carrito as $car){
                //     echo 1;
                // }
            }
        }
        function generar_codigo_invoice(){
            $numero = $this->model->lista_invoices();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('PEDIDO',7,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_detalle_invoice(){
            $numero = $this->model->detalle_de_pedidos();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('ITEMS',7,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
        function generar_nro_invoice(){
            $numero = $this->model->lista_invoices();
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<=9){
                //     return "#000000".$numero;
                // }else if($numero>9 && $numero<=99){
                //     return "#00000".$numero;
                // }else if($numero>99 &&  $numero<=999){
                //     return "#0000".$numero;
                // }else if($numero>999 && $numero<=9999){
                //     return "#000".$numero;
                // }else if($numero>9999 && $numero<=99999){
                //     return "#00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                      VISTA DE PRODUCTOS POR CATEGORIA                      */
/* ========================================================================== */

        function categoria($param = null){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            if(is_string($param[0])){
                $moneda = $tienda["MONEDA"];
                $items_productos = $this->model->listar_items_page_categoria(mainModel::clean_string($param[0]),$id_sucursal);
                if($items_productos){
                    $nro = $items_productos->rowCount();
                    $productos = "";
                    $productos_1 = "";
                    if($items_productos){
                        foreach($items_productos as $i){
                            $array = " \"{$i['LINEA']}\"";
                            $caracteristicas_query = $this->model->lista_caracteristicas_productos_producto($i["ID_PRODUCTO"]);
                            $caracteristicas = "";
                            foreach($caracteristicas_query as $car){
                                $caracteristicas .="
                                <li>{$car['CARACTERISTICA']}</li>
                                ";
                            }
                            $productos .= "
                            <div data-title='{$i["ARTICULO"]}' data-shape ='{$i['LINEA']}' class='col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 item_productos' data-groups='[{$array}]' >
                                    <div class='ps-product'>
                                        <div class='ps-product__thumbnail'>
                                            <a  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>
                                                <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' >
                                            </a>
                                            <ul class='ps-product__actions'>
                                                <li><a href='javascript:void(0)' class='btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$i['PRECIO_VENTA_4']}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar al carrito'><i class='icon-bag2'></i></a></li>
                                                <li><a href='#' data-placement='top'  title='Quick View' data-toggle='modal' data-target='#product-quickview'><i class='icon-eye'></i></a></li>
                                                <li><a href='javascript:void(0)' id_item='{$i['ID_ITEM']}' class='btn_deseo' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar a la lista de deseos'><i class='icon-heart'></i></a></li>
                                                
                                            </ul>
                                        </div>
                                        <div class='ps-product__container'>
                                            <a class='ps-product__vendor' href='#'>{$i["LINEA"]}</a>
                                            <div class='ps-product__content'>
                                                <a class='ps-product__title'  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                                <p class='ps-product__price'>{$moneda} {$i['PRECIO_VENTA_4']}</p>
                                            </div>
                                            <div class='ps-product__content hover'>
                                                <a class='ps-product__title picture-item__title'  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                                <p class='ps-product__price'>{$moneda} {$i['PRECIO_VENTA_4']}</p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            ";
                            $productos_1 .= "
                                <div class='ps-product ps-product--wide'>
                                    <div class='ps-product__thumbnail'><a  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'><img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' alt=''></a>
                                    </div>
                                    <div class='ps-product__container'>
                                        <div class='ps-product__content'>
                                            <a class='ps-product__title'  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                            <p class='ps-product__vendor'>Vendido por:<a href='#'>{$i["LINEA"]}</a></p>
                                            <ul class='ps-product__desc'>
                                                {$caracteristicas}
                                            </ul>
                                        </div>
                                        <div class='ps-product__shopping'>
                                            <p class='ps-product__price'>{$moneda} {$i["PRECIO_VENTA_4"]}</p><a class='ps-btn' href='javascript:void(0)' class='btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$i['PRECIO_VENTA_4']}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}'>Agregar al carrito</a>
                                            <ul class='ps-product__actions'>
                                            <li>
                                                <a href='javascript:void(0)' id_item='{$i['ID_ITEM']}' class='btn_deseo' >
                                                    <i class='icon-heart'></i> 
                                                        Lista de deseos
                                                </a>
                                                </li>          
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                ";
                        }
                    }
                    $this->view->moneda = $tienda["MONEDA"];
                    $this->view->nro_productos = $nro;
                    $this->view->categoria = $param[0];
                    $this->view->listar_presentacion = $this->listar_presentacion();
                    $this->view->listar_lineas = $this->listar_lineas();
                    $this->view->lista_secciones = $this->listar_secciones();
                    $this->view->li_presentacion = $this->li_presentacion();
                    $this->view->lista_recomendados = $this->lista_recomendados();
                    $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                    $this->view->productos = $this->model->listar_items_page_categoria(mainModel::clean_string($param[0]),$id_sucursal);
                    $this->view->producto = $productos;
                    $this->view->producto_detalle = $productos_1;
                    $this->view->render('newtienda/listing');
                }
            }else{
                $this->view->moneda = $tienda["MONEDA"];
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->listar_lineas = $this->listar_lineas();
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->render('tienda/404');
            }
        }

/* ========================================================================== */
/*                        DETALLE DE PRODUCTO EN MODAL                        */
/* ========================================================================== */

        function modal_detalle_producto(){
            if(isset($_POST["id_item"])){
                $tienda = mainModel::parametros_tienda();
                $id_sucursal = $tienda["ID_SUCURSAL"];
                $moneda = $tienda["MONEDA"];
                $detalle = $this->model->detalle_item_producto($_POST["id_item"]);
                if($detalle){
                    if($detalle->rowCount()>0){
                        $modal = "";
                        foreach($detalle as $d){
                            $imagen= SERVERURL.'archives/assets/productos/'.$d["IMAGEN"];
                            $caracteristicas_query = $this->model->lista_caracteristicas_productos_producto($d["ID_PRODUCTO"]);
                            $caracteristicas = "";
                            foreach($caracteristicas_query as $car){
                                $caracteristicas .="
                                <li>{$car['CARACTERISTICA']}</li>
                                ";
                            }
                            $imagenes_query = $this->model->lista_img_productos_producto($d["ID_PRODUCTO"]);
                            $imagenes = "";
                            foreach($imagenes_query as $ima){
                                $src_imagen= SERVERURL.'archives/assets/productos/'.$ima["IMG"];
                                $imagenes .="
                                    <div class='item'><img src='{$src_imagen}' alt=''></div>
                                ";
                            }
                            $modal .= "
                            <span class='modal-close' data-dismiss='modal'><i class='icon-cross2'></i></span>
                            <article id='' class='ps-product--detail ps-product--fullwidth ps-product--quickview'>
                                <div class='ps-product__header'>
                                    <div class='ps-product__thumbnail' data-vertical='false'>
                                        <div class='ps-product__images' data-arrow='true'>
                                            <div class='item'><img src='{$imagen}' alt=''></div>
                                            {$imagenes}
                                        </div>
                                    </div>
                                    <div class='ps-product__info'>
                                        <h1>{$d['ARTICULO']}</h1>
                                        <div class='ps-product__meta'>
                                            <p>Marca:<a href='#'>{$d['LINEA']}</a></p>
                                        
                                        </div>
                                        <h4 class='ps-product__price'>{$moneda} {$d['PRECIO_VENTA_4']}</h4>
                                        <div class='ps-product__desc'>
                                            <p>Caracteristicas:</p>
                                            <ul class='ps-list--dot'>
                                                {$caracteristicas}
                                            </ul>
                                        </div>
                                        <div class='ps-product__shopping'>
                                            <a class='ps-btn ps-btn--black btn_carrito'  href='javascript:void(0)' id_item='{$d['ID_ITEM']}' articulo='{$d['ARTICULO']}' cantidad='{$d['CANTIDAD']}' precio='{$d['PRECIO_VENTA_4']}' linea='{$d['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$d["IMAGEN"]}'>Agregar al carrito</a>
                                            <div class='ps-product__actions'>
                                                <a href='javascript:void(0)' id_item='{$d['ID_ITEM']}' class='btn_deseo'><i class='icon-heart'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            ";
                        }
                        echo $modal;
                    }
                }
            }
        }

/* ========================================================================== */
/*                          VISTA DETALLE DE PRODUCTO                         */
/* ========================================================================== */

        function producto($param = null){
            $tienda = mainModel::parametros_tienda();


            if(is_string(mainModel::decryption($param[0]))){
                $detalle = $this->model->detalle_item_producto(mainModel::decryption($param[0]));
                $producto = "";
                $imagenes = "";
                $caracteristicas = "";
                foreach($detalle as $d){
                    $producto .= "{$d["ID_ITEM"]}|{$d["PRECIO_VENTA_4"]}|{$d["ARTICULO"]}|{$d["LINEA"]}|{$d["CANTIDAD"]}|{$d["IMAGEN"]}"; 
                    $imagenes_query = $this->model->lista_img_productos_producto($d["ID_PRODUCTO"]);
                    $imagen= SERVERURL.'archives/assets/productos/'.$d["IMAGEN"];
                    $imagenes .= "<div class='item'><img src='{$imagen}' alt=''></div>"; 
                    foreach($imagenes_query as $ima){
                        $src_imagen= SERVERURL.'archives/assets/productos/'.$ima["IMG"];
                        $imagenes .="
                            <div class='item'><img src='{$src_imagen}' alt=''></div>
                        ";
                    }
                    $caracteristicas_query = $this->model->lista_caracteristicas_productos_producto($d["ID_PRODUCTO"]);
                            
                    foreach($caracteristicas_query as $car){
                        $caracteristicas .="
                        <li>{$car['CARACTERISTICA']}</li>
                        ";
                    }
                }
                $this->view->moneda = $tienda["MONEDA"];
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->producto = $producto;
                $this->view->imagenes = $imagenes;
                $this->view->caracteristicas = $caracteristicas;
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->lista_recomendados = $this->lista_recomendados();
                $this->view->render('tienda/producto');
            }else{
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->moneda = $tienda["MONEDA"];
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->render('tienda/404');
            }
        }

/* ========================================================================== */
/*                           VISTA BUSCAR EN TIENDA                           */
/* ========================================================================== */

        function buscar(){
            
            $tienda = mainModel::parametros_tienda();
            if(isset($_GET["producto"]) && isset($_GET["categoria"])){
                $id_sucursal = $tienda["ID_SUCURSAL"];
                $moneda = $tienda["MONEDA"];
                $categoria = mainModel::clean_string($_GET["categoria"]);
                $producto = mainModel::clean_string($_GET["producto"]);
                if($categoria=="TODO"){
                    $productos_busqueda = $this->model->busqueda_items($id_sucursal,$producto);
                }else{
                    $productos_busqueda = $this->model->busqueda_items_categoria($id_sucursal,$producto,$categoria);
                }
                $nro_productos = $productos_busqueda->rowCount();
                $productos = "";
                $productos_1 = "";
                if($productos_busqueda){
                    foreach($productos_busqueda as $i){
                        $array = " \"{$i['LINEA']}\"";
                        $productos .= "
                        <div data-title='{$i["ARTICULO"]}' data-shape ='{$i['LINEA']}' class='col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 item_productos' data-groups='[{$array}]' >
                                <div class='ps-product'>
                                    <div class='ps-product__thumbnail'>
                                        <a href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>
                                            <img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' >
                                        </a>
                                        <ul class='ps-product__actions'>
                                            <li><a href='javascript:void(0)' class='btn_carrito' id_item='{$i['ID_ITEM']}' articulo='{$i['ARTICULO']}' cantidad='{$i['CANTIDAD']}' precio='{$i['PRECIO_VENTA_4']}' linea='{$i['LINEA']}' imagen='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar al carrito'><i class='icon-bag2'></i></a></li>
                                            <li><a href='#' data-placement='top' class='ver_info' id_item='{$i['ID_ITEM']}'  title='Quick View' ><i class='icon-eye'></i></a></li>
                                            <li><a href='javascript:void(0)' id_item='{$i['ID_ITEM']}' class='btn_deseo' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar a la lista de deseos'><i class='icon-heart'></i></a></li>
                                            
                                        </ul>
                                    </div>
                                    <div class='ps-product__container'>
                                        <a class='ps-product__vendor' href='#'>{$i["LINEA"]}</a>
                                        <div class='ps-product__content'>
                                            <a class='ps-product__title' href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                            <p class='ps-product__price'>{$moneda} {$i["PRECIO_VENTA_4"]}</p>
                                        </div>
                                        <div class='ps-product__content hover'>
                                            <a class='ps-product__title picture-item__title' href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                            <p class='ps-product__price'>{$moneda} {$i["PRECIO_VENTA_4"]}</p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        ";
                        $productos_1 .= "
                        <div class='ps-product ps-product--wide'>
                            <div class='ps-product__thumbnail'><a  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'><img src='".SERVERURL."archives/assets/productos/{$i["IMAGEN"]}' alt=''></a>
                            </div>
                            <div class='ps-product__container'>
                                <div class='ps-product__content'>
                                    <a class='ps-product__title'  href='".SERVERURL."tienda/producto/".mainModel::encryption("{$i['ID_ITEM']}")."'>{$i["ARTICULO"]}</a>
                                    <p class='ps-product__vendor'>Vendido por:<a href='#'>{$i["LINEA"]}</a></p>
                                    <ul class='ps-product__desc'>
                                    <li> Unrestrained and portable active stereo speaker</li>
                                    <li> Free from the confines of wires and chords</li>
                                    <li> 20 hours of portable capabilities</li>
                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                    </ul>
                                </div>
                                <div class='ps-product__shopping'>
                                    <p class='ps-product__price'>$1310.00</p><a class='ps-btn' href='#'>Agregar al carrito</a>
                                    <ul class='ps-product__actions'>
                                    <li><a href='#'><i class='icon-heart'></i> 
                                    Lista de deseos</a></li>          
                                    </ul>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                $this->view->moneda = $tienda["MONEDA"];

                $this->view->nro_productos = $nro_productos;
                $this->view->search_producto = $producto;
                $this->view->search_categoria = $categoria;
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->listar_lineas = $this->listar_lineas();
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->producto = $productos;
                $this->view->producto_detalle = $productos_1;
                $this->view->render('tienda/buscar');
            }else{
                $this->view->moneda = $tienda["MONEDA"];

                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->render('tienda/404');
            }
        }
        function actualizar_datos_cliente(){
            if(isset($_POST["nombre"]) && isset($_POST["id"])){
                $id = $_POST["id"];
                $nombre = $_POST["nombre"];
                $genero = $_POST["genero"];
                $fecha = $_POST["fecha"];
                $telefono = $_POST["telefono"];
                $correo = $_POST["correo"];

                $update = $this->model->datos_cliente_update($id,$nombre,$genero,$fecha,$telefono,$correo);
                if($update){
                    if($update->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function actualizar_documentos_cliente(){
            if(isset($_POST["documento"])){
                $documento = $_POST["documento"];
                $nro = $_POST["nro"];
                $id = $_POST["id"];
                $update = $this->model->documento_cliente_update($id,$documento,$nro);
                if($update){
                    if($update->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function actualizar_password_cliente(){
            if(isset($_POST["password_2"])){
                $password = mainModel::encryption($_POST["password"]);
                $password_2 = mainModel::encryption($_POST["password_2"]);
                $id = $_POST["id"];
                $update = $this->model->password_cliente_update($id,$password,$password_2);
                if($update){
                    if($update->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function actualizar_perfil_cliente(){
            if(isset($_POST["id"])){
                $id = $_POST["id"];
                if ($_FILES["file"]['tmp_name']) {
                    $name = $_FILES["file"]['name'];
                    $tmp = $_FILES["file"]['tmp_name'];
                    $info = new SplFileInfo($_FILES["file"]['name']);
                    $extension = $info->getExtension();
                    $perfil = mainModel::generar_codigo_aleatorio('AVATAR', 20, rand(0, 9)) . "." . $extension;
                    if (move_uploaded_file($tmp, "archives/avatars/$perfil")) {
                        $update = $this->model->perfil_cliente_update($id,$perfil);
                        if($update){
                            if($update->rowCount()>0){
                                echo 1;
                            }else{
                                echo 0;
                            }
                        }
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            }
        }
        function card_cliente(){
            if(isset($_POST["id"])){
                $cliente = mainModel::parametros_cliente_tienda($_POST["id"]);
                $server = SERVERURL;
                $card = "
                    <img src='{$server}archives/avatars/{$cliente['PERFIL']}' alt=''>
                    <figure>
                    <figcaption>{$cliente['NOMBRE']}</figcaption>
                    <p><a href='#'><span class='__cf_email__' >{$cliente['CORREO']}</span></a></p>
                    </figure>
                ";
                echo $card;
            }
        }
        function lista_pedidos_cliente(){
            $tienda = mainModel::parametros_tienda();
            if(isset($_POST["id_usuario"])){
                $id_usuario = $_POST["id_usuario"];
                $lista = $this->model->invoice_lista_cliente($id_usuario);
                if($lista){
                    $table="";
                    foreach($lista as $l){
                        $subtotal = floatval($l['SUBTOTAL']);
                        $tarifa = floatval($l['TARIFA']);
                        $total = number_format($subtotal + $tarifa,2);
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "PAGO PENDIENTE";
                        }else if($l['ESTADO']==2){
                            $estado = "PAGO COMPLETADO";
                        }else if($l['ESTADO']==3){
                            $estado = "ENVIO PENDIENTE";
                        }else if($l['ESTADO']==4){
                            $estado = "EN ENVIO";
                        }else if($l['ESTADO']==5){
                            $estado = "ENVIO COMPLETADO";
                        }else if($l['ESTADO']==0){
                            $estado = "CANCELADO";
                        }
                        $table.="
                        <div class='pb-3'>
                            <a href='".SERVERURL."tienda/pedido/".mainModel::encryption("{$l['ID_INVOICE']}")."' class='text-decoration-none text-dark'>
                                <div class='p-3 rounded shadow-sm bg-white'>
                                    <div class='d-flex align-items-center mb-3'>
                                        <p class='bg-success text-white py-1 px-2 mb-0 rounded small'>{$estado}</p>
                                        <p class='text-muted ml-auto small mb-0'><i class='icofont-clock-time'></i> {$l['FECHA']}</p>
                                    </div>
                                    <div class='d-flex'>
                                        <p class='text-muted m-0'>ID<br>
                                            <span class='text-dark font-weight-bold'>{$l['ID_INVOICE']}</span>
                                        </p>
                                        <p class='text-muted m-0 ml-auto'>Titulo<br>
                                            <span class='text-dark font-weight-bold'>{$l['TITULO']}</span>
                                        </p>
                                        <p class='text-muted m-0 ml-auto'>Total <br>
                                            <span class='text-dark font-weight-bold'>{$tienda['MONEDA']} {$total}</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        ";

                    }
                    echo $table;
                }
            }
        }
        function notificaciones_cliente(){
            if(isset($_POST["id_usuario"])){
                $id_usuario = $_POST["id_usuario"];
                $lista = $this->model->lista_notificaciones_de_cliente($id_usuario);
                if($lista){
                    $table="";
                    foreach($lista as $l){
                        
                        $estado = "";
                        if($l['ESTADO']==1){
                            $estado = "PAGO PENDIENTE";
                        }else if($l['ESTADO']==2){
                            $estado = "PAGO COMPLETADO";
                        }else if($l['ESTADO']==3){
                            $estado = "ENVIO PENDIENTE";
                        }else if($l['ESTADO']==4){
                            $estado = "EN ENVIO";
                        }else if($l['ESTADO']==5){
                            $estado = "ENVIO COMPLETADO";
                        }else if($l['ESTADO']==0){
                            $estado = "CANCELADO";
                        }
                        $table.="
                            <tr>
                                <td>{$l['FECHA']}</td>
                                <td>Tu pedido con codigo #<a href='".SERVERURL."tienda/pedido/".mainModel::encryption("{$l['ID_INVOICE']}")."'>{$l['ID_INVOICE']}</a> fue cambiado de estado a <b>{$estado}</b></td>
                                <td>{$l['TITULO']}</td>
                                <td>{$l['FECHA_2']}</td>
                                <td>{$l['TOTAL']}</td>
                            </tr>
                        ";

                    }
                    echo $table;
                }
            }
        }
        function lista_provincias_departamento(){
            if(isset($_POST["id"])){
                $id = $_POST["id"];
                $update = $this->model->lista_provincias_departamento($id);
                if($update){
                    $provincias = "<option value='0' selected='selected' disabled tarifa='0'>Seleccionar Provincia</option>";
                    foreach($update as $pro){
                        $provincias .= "<option value='{$pro['ID_PROVINCIA']}' tarifa='{$pro['PRECIO']}'>{$pro['PROVINCIA']}</option>";
                    }
                    echo $provincias;
                }
            }
        }
        function pedido($param=null){
            $tienda = mainModel::parametros_tienda();

            if(is_string(mainModel::decryption($param[0]))){
                $pedido = mainModel::decryption($param[0]);
                $this->view->moneda = $tienda["MONEDA"];
                $this->view->listar_presentacion = $this->listar_presentacion();
                $this->view->listar_lineas = $this->listar_lineas();
                $this->view->lista_secciones = $this->listar_secciones();
                $this->view->li_presentacion = $this->li_presentacion();
                $this->view->lista_buscar_productos = $this->lista_buscar_productos();
                $this->view->params_pedido = mainModel::parametros_cliente_pedido($pedido);
                $this->view->productos_pedido = $this->model->detalle_de_pedido($pedido);
                $this->view->render('newtienda/status_onprocess');
            }else{
                echo 0;
            }
        }
        function correo($id){
            $errores = '';
            $enviado = '';
        	$nombre = "Jhonatan";
        	$correo = "jhonycreativo@softsispos.com";
        	$mensaje = "hola como estas";
        	$cuenta = mainModel::parametros_cuenta_bancario();
        
        	if (!empty($nombre)) {
        		$nombre = trim($nombre);
        		$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
        	}else{
        		$errores .= 'Por favor ingresa un nombre <br />';
        	}
        	if (!empty($correo)) {
        		$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        		if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        			$errores .= 'Por favor ingresa un correo valido <br />';
        		}
        	}else{
        			$errores .= 'Por favor ingresa un correo <br />';
        		}
        	
        
        	if(!empty($mensaje)){
        		$mensaje = htmlspecialchars($mensaje);
        		$mensaje = trim($mensaje);
        		$mensaje = stripslashes($mensaje);
        	}else{
        		$errores .= 'Por favor ingresa el mensaje <br />';
        	}
        
        	if (!$errores) {
        		$pedidoID = $id;
        		$param_invoice = mainModel::parametros_cliente_pedido($id);
        		$enviar_a = $param_invoice['CORREO'];
        		
        		$productos_pedido = $this->model->detalle_de_pedido($pedidoID);
        		$asunto = "Confirmacion de Pedido {$param_invoice['FECHA']}";
        		$productos = "";
        		if($productos_pedido){
        		    foreach($productos_pedido as $p){
        		        $cantidad = floatval($p["CANTIDAD"]);
                        $precio = floatval($p["PRECIO"]);
                        $total = $cantidad*$precio;
        		        $productos .= "
        		                <p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'>
        		                    <span style='display:block;font-size:13px;font-weight:normal;'> {$p["BARRA"]} | {$p["ARTICULO"]} | {$p["LINEA"]}</span> 
        		                    {$precio} X {$cantidad}
        		                    <b style='font-size:12px;font-weight:300;'> TOTAL: {$total}</b>
    		                    </p>";
        		    }
        		}
        		$logo = SERVERURL."archives/icons/icon.png";
        		$mensaje_preparado = "
        		    <body style='background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;'>
                      <table style='max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #f44336;'>
                        <thead>
                          <tr>
                            <th style='text-align:left;'><img style='max-width: 50px;' src='{$logo}' alt='BOLPRESS'></th>
                            <th style='text-align:right;font-weight:400;'>{$param_invoice['FECHA']}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style='height:35px;'></td>
                          </tr>
                          <tr>
                            <td colspan='2' style='border: solid 1px #ddd; padding:10px 20px;'>
                                <p style='font-size:14px;margin:0 0 6px 0;'>
                                    <span style='font-weight:bold;display:inline-block;min-width:150px'>Estado de Pedido </span>
                                    <b style='color:#f44336;font-weight:normal;margin:0'>Pago Pendiente</b>
                                </p>
                                <p style='font-size:14px;margin:0 0 6px 0;'>
                                  <span style='font-weight:bold;display:inline-block;min-width:146px'>ID Pedido</span> #{$pedidoID}
                                </p>
                                <p style='font-size:14px;margin:0 0 0 0;'>
                                    <span style='font-weight:bold;display:inline-block;min-width:146px'>Total a Pagar</span> {$param_invoice['TOTAL']}
                                </p>
                            </td>
                          </tr>
                          <tr>
                            <td style='height:35px;'></td>
                          </tr>
                          <tr>
                            <td style='width:50%;padding:20px;vertical-align:top'>
                                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'>
                                    <span style='display:block;font-weight:bold;font-size:13px'>Nombre</span> {$param_invoice['NOMBRE']}
                                </p>
                                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'>
                                    <span style='display:block;font-weight:bold;font-size:13px;'>Email</span> {$enviar_a}</p>
                                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'>
                                    <span style='display:block;font-weight:bold;font-size:13px;'>Telefono</span> {$param_invoice['TELEFONO']}
                                </p>
                               
                            </td>
                            <td style='width:50%;padding:20px;vertical-align:top'>
                                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'>
                                    <span style='display:block;font-weight:bold;font-size:13px;'>Direccion </span> {$param_invoice['DIRECCION']}, {$param_invoice['PROVINCIA']}, {$param_invoice['DEPARTAMENTO']}
                                </p>
                    
                            </td>
                          </tr>
                          <tr>
                            <td colspan='2' style='font-size:20px;padding:30px 15px 0 15px;'>Productos</td>
                          </tr>
                          <tr>
                            <td colspan='2' style='padding:15px;'>
                              {$productos}
                             
                            </td>
                          </tr>
                          <tr>
                            <td colspan='2' style='font-size:20px;padding:30px 15px 0 15px;'>Detalle de Pedido</td>
                          </tr>
                          <tr>
                            <td colspan='2' style='padding:15px;'>
                                <p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'>
        		                    <span style='display:block;font-size:13px;font-weight:normal;'>SUB TOTAL </span> 
        		                    {$param_invoice['SUBTOTAL']}
    		                    </p>
                                <p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'>
        		                    <span style='display:block;font-size:13px;font-weight:normal;'>TARIFA DE ENVIO </span> 
        		                    {$param_invoice['TARIFA']}
    		                    </p>
                                <p style='font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;'>
        		                    <span style='display:block;font-size:13px;font-weight:normal;'>TOTAL </span> 
        		                    {$param_invoice['TOTAL']}
    		                    </p>
                             
                            </td>
                          </tr>
                        </tbody>
                        <tfooter>
                          <tr>
                            <td colspan='2' style='font-size:14px;padding:50px 15px 0 15px;'>
                              <strong style='display:block;margin:0 0 10px 0;'>Pasos para continuar con el pago</strong> 
                              Realice el deposito bancario al N° de cuenta indicado, la constancia del deposito debe enviarse al whatsapp o al correo junto a una foto con el  documento de identidad de la persona responsable.
                              <br>
                              <br>Gracias por confiar en B-POS.
                              <br>
                              <br>
                              <b>Nro de Cuenta Bancaria:</b> {$cuenta['NRO_CUENTA']}<br>
                              <b>Banco:</b> {$cuenta['BANCO']}<br>
                              <b>Titular de la cuenta:</b> {$cuenta['TITULAR']}<br>
                              <b>WhatsApp:</b> {$cuenta['TELEFONO']}<br>
                              <b>Email:</b> {$cuenta['CORREO']}
                            </td>
                          </tr>
                        </tfooter>
                      </table>
                    </body>
        		";
        		

                $encabezados = "MIME-Version: 1.0" . "\r\n";
                $encabezados .= "Content-type:text/html; charset=UTF-8" . "\r\n";
                $encabezados .= 'From: Tienda Online | Grocery<jhonycreativo@softsispos.com>' . "\r\n";
                $mensaje_preparado = wordwrap($mensaje_preparado, 70, "\r\n");
        		mail($enviar_a, $asunto, $mensaje_preparado,$encabezados);
        		
        		
        	}

        }

    }