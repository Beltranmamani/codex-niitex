<?php
    
    class ventas extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                              Vista por defecto                             */
/* ========================================================================== */
        
        function render(){
            $this->view->render('ventas/index');
        }
        function v2(){
            $this->view->render('ventas/v2');
        }
        function v3(){
            $this->view->render('ventas/v3');
        }
        public function lista_productos_sucursal_json()
        {
            // if (isset($_POST["id"])) {
                $lista_productos = $this->model->lista_productos_sucursal();
                if ($lista_productos) {
                    echo json_encode($lista_productos->fetchAll(PDO::FETCH_ASSOC));
                }
            // }
        }
            public function lista_almacenes_json()
            {
                if (isset($_POST["sucursal"])) {
                    $sucursal = $_POST["sucursal"];
                    if ($sucursal != "0") {
        
                        $almacenes = $this->model->listar_almacenesXsucursal($sucursal);
                        if ($almacenes) {
                            echo json_encode($almacenes->fetchAll(PDO::FETCH_ASSOC));
                        }
                    } else {
                        echo 0;
                    }
                }
            }
/* ========================================================================== */
/*                Lista de documentos disponibles en el sistema               */
/* ========================================================================== */
        function lista_documentos(){
            $unidades = $this->model->lista_documentos();
            if($unidades){
                $option = "";
                foreach($unidades as $row){
                    if($row['ESTADO']==0){
                        $option .= "<option value='{$row['ID_DOCUMENTO']}' disabled>{$row['DOCUMENTO']}</option>";
                    }else{
                        $option .= "<option value='{$row['ID_DOCUMENTO']}'>{$row['DOCUMENTO']}</option>";
                    }
                }
                return $option;
            }
        }

/* ========================================================================== */
/*                           Vista de punto de venta                          */
/* ========================================================================== */
        function puntoventa(){
            $this->view->lista_documentos = $this::lista_documentos();
            $this->view->lista_metodopago = $this::lista_metodopago();
            $this->view->render('ventas/pos');
        }

/* ========================================================================== */
/*                             Lista de almacenes                             */
/* ========================================================================== */

        function lista_almacenes(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                if($sucursal != "0"){
                    $almacenes = "";
                    $almacenes = $this->model->listar_almacenesXsucursal($sucursal);
                    if($almacenes){
                        $n = 1;
                        $option = "";
                        foreach($almacenes as $row){
                            if($n==1){
                                $n = "selected='selected'";
                            }else{
                                $n = "";
                            }
                            if($row['ESTADO']==0){
                                $option .= "<option {$n} value='{$row['ID_ALMACEN']}' disabled>{$row['NOMBRE']}</option>";
                            }else{
                                $option .= "<option {$n} value='{$row['ID_ALMACEN']}'>{$row['NOMBRE']}</option>";
                            }
                            $n++;
                        }
                        echo $option;
                    }
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
        function lista_metodopago(){
            
            $almacenes = $this->model->listar_metodopagos();
            if($almacenes){
                $n = 1;
                $option = "";
                foreach($almacenes as $row){
                    if($n==1){
                        $n = "selected='selected'";
                    }else{
                        $n = "";
                    }
                    if($row['ESTADO']==0){
                        $option .= "<option {$n} value='{$row['ID']}' disabled>{$row['NAME']}</option>";
                    }else{
                        $option .= "<option {$n} value='{$row['ID']}'>{$row['NAME']}</option>";
                    }
                    $n++;
                }
                return $option;
            }
   
            
        }

/* ========================================================================== */
/*                            Productos de almacen                            */
/* ========================================================================== */

        function productos_almacen(){
            if(isset($_POST["id"])){
                $almacen = $_POST["id"];
                $lista_producto = $this->model->listar_item_lote();
                if($lista_producto){
                    if($lista_producto->rowCount()>0){
                        $tabla = "";
                        $n = 1;
                        foreach($lista_producto as $rows){
                            $almacen_item = $rows["ID_ALMACEN"];
                            $cantidad_item = $rows["CANTIDAD"];
                            $fecha = "";
                            if($almacen == $almacen_item){
                                if($cantidad_item>0){
                                    if($rows["FECHA_VEN"] == "0000-00-00"){
                                        $fecha = "<span class='badge badge-dark'>No caducable</span>";
                                    }else{
                                        $fecha = "<span class='badge badge-secondary'>{$rows["FECHA_VEN"]}</span>";
                                    }
                                    $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                    $tabla .="
                                        <tr>
                                            <td class='user-name' style='font-weight: 800;color: #3856ff;'>{$rows["BARRA"]}</td>
                                            <td class=''>
                                                <a class='profile-img' href='javascript: void(0);'>
                                                    <img src='{$imagen}' alt='product' style='width: 50px;'>
                                                </a>
                                            </td>
                                            <td style='font-size: 11px;'>{$rows["ARTICULO"]}</td>
                                            <td style='font-size: 11px;'>{$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                            <td style='font-size: 11px;'>{$rows["LINEA"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRESENTACION"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_VENTA_4"]}</td>
                                            <td>
                                                <span class='badge badge-info'>{$rows["CANTIDAD"]}</span>
                                            </td>
                                            <td style='font-size: 11px;'>{$rows["LOTE"]}</td>
                                            <td>{$fecha}</td>
                                            <td><input type='text' class='form-control' id='txt_{$rows["ID_ITEM"]}' placeholder='Ej. 12' ></td>
                                            <td class='text-center'>
                                                <button value='{$rows["ID_ITEM"]}' stock='{$rows["CANTIDAD"]}' class='btn rounded-circle btn_agregar btn-outline-success bs-tooltip' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar a la venta'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-download'><path d='M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4'></path><polyline points='7 10 12 15 17 10'></polyline><line x1='12' y1='15' x2='12' y2='3'></line></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    ";
                                    $n++;
                                }
                            } 
                        }
                        echo $tabla;
                    }else{  
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                       Consultar productos para venta                       */
/* ========================================================================== */

        function buscarproducto_venta(){
            if(isset($_POST["id"]) && isset($_POST["cantidad"])){
                $consulta = $this->model->buscar_item($_POST["id"]);
                if($consulta){
                    if($consulta->rowCount()>0){
                        $card  = "";
                        foreach($consulta as $row){
                            $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                            $button = "";
                            if($row['EXENTO']==1){
                                $button .= "
                                    <button class='btn btn-outline-info btn-block'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                        {$row["BARRA"]}
                                    </button>";
                            }else{
                                $button .= "
                                <button class='btn btn-outline-warning btn-block'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                    {$row["BARRA"]}
                                </button>";
                            }
                            $fecha = "";
                            if($row['FECHA_VEN']== "0000-00-00"){
                                $fecha .= "
                                    <span class='badge w-100 badge-dark mt-3 text-center'> No caducable </span>
                                ";
                            }else{
                                $fecha .= "
                                    <span class='badge w-100 badge-secondary mt-3 text-center'> {$row["FECHA_VEN"]} </span>
                                ";
                            }
                            $badge_almacen = "<span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>"; 
                            $card .= "<div class='items new_items' producto_preventa='0' id_item='{$row['ID_ITEM']}' articulo = '{$row["ARTICULO"]}'  stock='{$row["CANTIDAD"]}' producto='{$row["ID_PRODUCTO"]}' almacen='{$row["ID_ALMACEN"]}' id='item_{$row["ID_ITEM"]}' perecedero='{$row['PERECEDERO']}' exento='{$row['EXENTO']}'>
                                                            

                                <div class='item-content new_item_content'>
                                    <button class='btn btn-outline-danger btn-sm btn_eliminar_producto' id_producto='{$row['ID_ITEM']}'  ><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></button>    
                                    <div class='user-profile'>
                                    
                                        <img src='{$imagen}' alt='avatar' style='height: 100px;'>
                                        <div class='user-meta-info'>
                                            <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                            <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                        </div>
                                    </div>
                                    <div class='code-bar'>
                                        {$button}
                                    </div>
                                    <div class='user-email' style='margin-top: 10px;'>
                                        {$badge_almacen}
                                    </div>
                                    <div class='user-email'>
                                        <p class='info-title'>Presentacion: </p>
                                        <p class='usr-email-addr'>{$row["PRESENTACION"]}</p>
                                    </div>
                                    <div class='user-phone'>
                                        <p class='info-title'>UM: </p>
                                        <p class='usr-ph-no'>{$row["COMPLEMENTO"]} {$row["PREFIJO"]}</p>
                                    </div>
                                    <div class='user-location mt-2'>
                                        <div id='iconsAccordion_{$row["ID_PRODUCTO"]}' class='accordion-icons' style='width: -webkit-fill-available;'>
                                            <div class='card'>
                                                <div class='card-header' id='headingOne3_{$row["ID_PRODUCTO"]}'>
                                                    <section class='mb-0 mt-0'>
                                                        <div role='menu' class='' data-toggle='collapse' data-target='#iconAccordionOne_{$row["ID_PRODUCTO"]}' aria-expanded='true' aria-controls='iconAccordionOne_{$row["ID_PRODUCTO"]}'>
                                                            <div class='accordion-icon'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-dollar-sign'><line x1='12' y1='1' x2='12' y2='23'></line><path d='M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6'></path></svg>
                                                                Precios
                                                                <div class='icons'>
                                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-up'><polyline points='18 15 12 9 6 15'></polyline></svg>
                                                                </div>
                                                            </div>
                                                    </section>
                                                </div>
                                        
                                                <div id='iconAccordionOne_{$row["ID_PRODUCTO"]}' class='collapse' aria-labelledby='headingOne3_{$row["ID_PRODUCTO"]}' data-parent='#iconsAccordion_{$row["ID_PRODUCTO"]}' style=''>
                                                    <div class='card-body new_card_body'>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 1</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_1"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_1_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_1"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_1_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_1"]}' medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_1"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 2</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_2"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_2_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_2"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_2_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_2"]}' medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_2"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 3</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_3"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_3_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_3"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_3_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_3"]}' medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_3"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 4</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_4"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_4_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_4"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_4_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_4"]}'  medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_4"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 5</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_5"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_5_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_5"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_5_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_5"]}'  medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_5"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 6</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_6"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_6_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_6"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_6_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_6"]}'  medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_6"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 7</span>
                                                        <span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_7"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_7_{$row["ID_ITEM"]}' value='{$row["PRECIO_VENTA_7"]}' class='touchs_precios'>
                                                            <input type='text' readonly id='medida_7_{$row["ID_ITEM"]}' medida='{$row["MEDIDA_7"]}'  medida_id='medida_select_{$row["ID_ITEM"]}' value='{$row["STOCK_7"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>UNIDAD MEDIDA</span>
                                                    
                                                        <div class='user-location'>
                                                            <input type='text' id='medida_select_{$row["ID_ITEM"]}' value='' class='form-control form-control-sm'>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Cantidad</span>
                                    <div class='user-location'>
                                        <input type='text' id='cantidad_{$row["ID_ITEM"]}' value='{$_POST["cantidad"]}' class='touchs_cantidad'>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento</span>
                                    <div class='user-location'>
                                        <input type='text' id='descuento_{$row["ID_ITEM"]}' value='0.00' class='touchs_descuentos touchs'>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Precio Stock</span>
                                    <div class='user-location'>
                                        <select class='form-control form-control-sm precio_stock' id='precio_stock_{$row["ID_ITEM"]}'>
                                            <option value='1'>{$row["MEDIDA_1"]}</option>
                                            <option value='2'>{$row["MEDIDA_2"]}</option>
                                            <option value='3'>{$row["MEDIDA_3"]}</option>
                                            <option value='4'>{$row["MEDIDA_4"]}</option>
                                            <option value='5'>{$row["MEDIDA_5"]}</option>
                                            <option value='6'>{$row["MEDIDA_6"]}</option>
                                            <option value='7'>{$row["MEDIDA_7"]}</option>
                                        </select>
                                    </div>
                                    <div class='user-location mt-2'>
                                        <span style='font-weight: 700;color: #3b3f5c;'>Descuento</span>
                                        <span style='font-weight: 200;color: #3b3f5c;' id='descuento_producto_{$row["ID_ITEM"]}'>0.00</span>
                                    </div>
                                    <div class='user-location'>
                                        <span style='font-weight: 700;color: #3b3f5c;'>Sub total</span>
                                        <span style='font-weight: 200;color: #3b3f5c;' id='sub_total_producto_{$row["ID_ITEM"]}'>0.00</span>
                                    </div>
                                    <div class='user-location'>
                                        <span style='font-weight: 700;color: #3b3f5c;'>Total</span>
                                        <span style='font-weight: 200;color: #3b3f5c;' id='total_producto_{$row["ID_ITEM"]}'>0.00</span>
                                    </div>
                                    
                                    {$fecha}
                                </div>
                            </div>";
                        }   
                        echo $card;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                       Lista de tirajes de comprobante                      */
/* ========================================================================== */
        function lista_de_tirajes_de_comprobante(){
            if(isset($_POST["token"])){
                $sucursal = $_POST["token"];
                $tiraje = $this->model->lista_tirajes();
                if($tiraje){
                    $n = 1;
                    $option = "<option disabled selected>Seleccionar...</option>";
                    foreach($tiraje as $rows){
                        $disponibles =  $rows['DISPONIBLES'];
                        if($sucursal == $rows["ID_SUCURSAL"] && $disponibles > 0 && $rows["ESTADO"]==1 ){
                            $option .="
                                <option value='{$rows["ID_TIRAJE"]}'>{$rows["COMPROBANTE"]} {$rows["SERIE"]}</option>
                            ";
                        }
                        $n++;
                    }
                    echo $option;
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                        Funcion para guardar la venta                       */
/* ========================================================================== */

        function guardar_venta(){
            if(isset($_POST["id_cliente"])){
                session_name('B_POS');
                session_start();
                date_default_timezone_set(ZONEDATE);
                $id_sucursal = $_SESSION["sucursal"];
                $id_caja = $_SESSION["caja"];
                $id_usuario = $_SESSION["usuario"];
                $id_cliente = $_POST["id_cliente"];
                $medio = $_POST["medio"];
                $cliente =  mainModel::parametros_cliente($id_cliente);
                $nit_cliente = $cliente['N_DOCUMENTO'];
                $date_venta = date('Y-m-d');
                $date = date('Y-m-d H:i:s');
                $date_registro = date('Y-m-d H:i:s');
                $codigo_venta = $this->generar_codigo_venta();
                $nro_venta =  $this->generar_nro_venta($id_sucursal);
                $nro_venta2 =  $this->generar_nro_venta2($id_sucursal);
                $tipo_comprobante = $_POST["tipo_comprobante"];
                $nro_comprobante = $this->generar_nro_comprobante($tipo_comprobante);
                $monto_a_pagar = floatval($_POST["monto_a_pagar"]);
                $cambio = floatval($_POST["cambio"]);
                $efectivo_recibido = floatval($_POST["efectivo_recibido"]);
                $suma_price = floatval($_POST["suma_price"]);                
                $cant_iva = floatval($_POST["cant_iva"]);                
                $retencion_price = floatval($_POST["retencion_price"]);                
                $sub_total_price = floatval($_POST["sub_total_price"]);                
                $descuento_percent = floatval($_POST["descuento_percent"]);                
                $precio_descuento = floatval($_POST["precio_descuento"]);                
                $n_exento = floatval($_POST["n_exento"]);                
                $exento_price = floatval($_POST["exento_price"]);                             
                $tarjetahabitante = $_POST["tarjetahabitante"];
                $tarjeta_debito_credito = $_POST["tarjeta_debito_credito"];
                $monotodebitado = floatval($_POST["monotodebitado"]);                             
                $metodo_pago = $_POST["metodo_pago"];
                $tipo_pago = $_POST["tipo_pago"];
                $productos = $_POST["data"];
                $observacion = $_POST["observacion"];
                 $nrofactura = $_POST["nrofactura"];
                $venta_facturar = $_POST["venta_facturar"];
                $nombrepromotor = $_POST["nombrepromotor"];
                $precio_radio = $_POST["precio_radio"];
                $fecha_limite = $_POST["fecha_limite"];
                $pago_pendiente_check = $_POST["pago_pendiente_check"];
                $codigo_credito = $this->generar_codigo_credito();
                $nro_credito = $this->generar_nro_credito($id_sucursal);
                $nombre_credito = "POR VENTA #$nro_venta";
                $guardar_venta = $this->model->guardar_venta($codigo_venta,$nro_venta,$date,$metodo_pago,$nro_comprobante,$tipo_comprobante,$suma_price,$cant_iva,$exento_price,$sub_total_price,$retencion_price,$precio_descuento,$descuento_percent,$monto_a_pagar,$n_exento,$efectivo_recibido,$monotodebitado,$tarjeta_debito_credito,$tarjetahabitante,$cambio,$tipo_pago ,$id_cliente,$id_usuario,$id_sucursal,$id_caja,$observacion,$precio_radio,$nrofactura,$nombrepromotor,$pago_pendiente_check,0,$medio);
                if($guardar_venta){
                    if($guardar_venta->rowCount()>=0){
                        if($tipo_pago == 2){
                            $guardar_credito = $this->model->guardar_credito($codigo_credito,$codigo_venta ,$id_sucursal,$id_cliente,$id_usuario,$nro_credito,$nombre_credito,$date_registro,$fecha_limite,$monto_a_pagar,0,$monto_a_pagar,1);
                            if(!$guardar_credito){
                                echo 2;
                            }
                        }
                        $productos = $_POST["data"];
                        //separo los producto en arreglo
                        $arrayproductos = explode(',',$productos);
                        //cuento la cantidad de productos
                        $n_productos = count($arrayproductos)-1;
                        //recorro el arreglo
                        for($i=0;$i<$n_productos;$i++){
                            //capturo el string del array que esta en el indice
                            $productostring = $arrayproductos[$i];
                            //separo el string por el | y lo convierto
                            $producto = explode("|",$productostring);
                            //coloco cada variable en su lugar
                            $id_detalle = $this->generar_codigo_detalle_venta();
                            $id_salida = $this->generar_codigo_salida();
                            $p_id_item = $producto[0];
                            $cantidad = $producto[2]; $cantidad = $producto[2] * $producto[10];/// modificar la cantidad aqui de acuerdo a la medida
                            $precio = $producto[4];
                            $descuento_producto = $producto[5];
                            $sub_total_producto_ = $producto[6];
                            $total_producto = $producto[7];
                            $stock = $producto[8]; 
                
                            $medida = "";
                            if(isset($producto[11])&&!empty($producto[11])){
                                $medida = $producto[11];
                            }
                            $producto = $producto[9];
                            $stock_global = mainModel::stock_global_producto($producto,$id_sucursal);
                            $guardar_detalle = $this->model->agregar_detalle_venta($id_detalle,$p_id_item,$codigo_venta,$cantidad,$precio,$descuento_producto,$sub_total_producto_,$total_producto,$stock,$medida);
                            if(!$guardar_detalle){
                                echo 4;
                            }
                            $guardar_kardex = $this->model->agregar_kardex($id_salida,$id_caja,$id_sucursal,$id_usuario,$p_id_item,$total_producto,$date,1,0,$cantidad,$stock-$cantidad,$stock_global-$cantidad,$nombre_credito,$codigo_venta);
                            if(!$guardar_kardex){
                                echo 5;
                            }
                        }
                        
                        if($venta_facturar==1){
                            $respuesta = $this->dosificacion_venta($codigo_venta,$nro_comprobante,$monto_a_pagar,$date_venta,$id_sucursal,$nit_cliente);
                            if($respuesta==1){
                                echo "1|".mainModel::encryption($codigo_venta);
                            }else{
                               echo 2; 
                            }
                        }else{
                            echo "1|".mainModel::encryption($codigo_venta);
                        }
                    }else{
                        echo 2;
                    }
                }else{
                    echo 0;
                }

            }
        }
        public function guardar_venta_v2()
        {
            if (isset($_POST["id_cliente"])) {
                session_name('B_POS');
                session_start();
                date_default_timezone_set(ZONEDATE);
                $id_sucursal = $_SESSION["sucursal"];
                $id_caja = $_SESSION["caja"];
                $id_usuario = $_SESSION["usuario"];
                $id_cliente = $_POST["id_cliente"];
                $date = date('Y-m-d H:i:s');
                $date_registro = date('Y-m-d H:i:s');
                $codigo_venta = $this->generar_codigo_venta();
                $nro_venta = $this->generar_nro_venta($id_sucursal);
                $tipo_comprobante = $_POST["tipo_comprobante"];
                $nro_comprobante = $this->generar_nro_comprobante($tipo_comprobante);
                $monto_a_pagar = floatval($_POST["monto_a_pagar"]);
                $cambio = floatval($_POST["cambio"]);
                $medio = floatval($_POST["medio"]);
                $efectivo_recibido = floatval($_POST["efectivo_recibido"]);
                $suma_price = floatval($_POST["suma_price"]);
                $cant_iva = floatval($_POST["cant_iva"]);
                $retencion_price = floatval($_POST["retencion_price"]);
                $sub_total_price = floatval($_POST["sub_total_price"]);
                $descuento_percent = floatval($_POST["descuento_percent"]);
                $precio_descuento = floatval($_POST["precio_descuento"]);
                $n_exento = floatval($_POST["n_exento"]);
                $exento_price = floatval($_POST["exento_price"]);
                $tarjetahabitante = $_POST["tarjetahabitante"];
                $tarjeta_debito_credito = $_POST["tarjeta_debito_credito"];
                $monotodebitado = floatval($_POST["monotodebitado"]);
                $metodo_pago = $_POST["metodo_pago"];
                $tipo_pago = $_POST["tipo_pago"];
                // $productos = $_POST["cart"];
                $observacion = $_POST["observacion"];
                $nrofactura = $_POST["nro_factura"];
                $nombrepromotor = $_POST["nombrepromotor"];
                $precio_radio = $_POST["precio"];
                $fecha_limite = $_POST["fecha_limite"];
                $CuotaMensual = $_POST["CuotaMensual"];
                $pago_pendiente_check = $_POST["pago_pendiente_check"];
                $nombre_credito = "POR VENTA #$nro_venta";
                $guardar_venta = $this->model->guardar_venta($codigo_venta, $nro_venta, $date, $metodo_pago, $nro_comprobante, $tipo_comprobante, $suma_price, $cant_iva, $exento_price, $sub_total_price, $retencion_price, $precio_descuento, $descuento_percent, $monto_a_pagar, $n_exento, $efectivo_recibido, $monotodebitado, $tarjeta_debito_credito, $tarjetahabitante, $cambio, $tipo_pago, $id_cliente, $id_usuario, $id_sucursal, $id_caja, $observacion, $precio_radio, $nrofactura, $nombrepromotor,$pago_pendiente_check,0,$medio);
                if ($guardar_venta) {
                    if ($guardar_venta->rowCount() >= 0) {
                        $nro_credito = $this->generar_nro_credito($id_sucursal);
                        if ($tipo_pago == 2) {
                            
                                $codigo_credito = $this->generar_codigo_credito();
                                $guardar_credito = $this->model->guardar_credito($codigo_credito, $codigo_venta, $id_sucursal, $id_cliente, $id_usuario, $nro_credito, $nombre_credito, $date_registro, $fecha_limite, $monto_a_pagar, 0, $monto_a_pagar, 1);
                                if (!$guardar_credito) {
                                    echo 2;
                                }
                            
                        }
                        $productos = $_POST["cart"];
                        foreach($productos as $p){
                            // echo $p['articulo']['ARTICULO'];
                        
                        // $productos = $_POST["data"];
                        // //separo los producto en arreglo
                        // $arrayproductos = explode(',', $productos);
                        // //cuento la cantidad de productos
                        // $n_productos = count($arrayproductos) - 1;
                        // //recorro el arreglo
                        // for ($i = 0; $i < $n_productos; $i++) {
                        //     //capturo el string del array que esta en el indice
                        //     $productostring = $arrayproductos[$i];
                        //     //separo el string por el | y lo convierto
                        //     $producto = explode("|", $productostring);
                        //     //coloco cada variable en su lugar
                            $id_detalle = $this->generar_codigo_detalle_venta();
                            $id_salida = $this->generar_codigo_salida();
                        //     $p_id_item = $producto[0];
                            $p_id_item = $p['articulo']['ID_ITEM'];
                            $cantidad = $p['cantidad'];
                            $precio_r = $p['precio_stock'];
                            $equivalente = $p['articulo']['STOCK_'.$precio_r];
                            $medida = $p['articulo']['MEDIDA_'.$precio_r];
                            $cantidad = floatval($cantidad*$equivalente);
                            $precio = $p['precio'];
                            $descuento_producto = $p['descuento'];
                            $sub_total_producto_ = $p['subtotal'];
                            $total_producto = $p['total'];
                            $stock = $p['articulo']['CANTIDAD'];
                        //     $precio = $producto[4];
                        //     $descuento_producto = $producto[5];
                        //     $sub_total_producto_ = $producto[6];
                        
                        //     $stock = $producto[8];
                        //     $producto = $producto[9];
                            $stock_global = mainModel::stock_global_producto($p['articulo']['ID_PRODUCTO'], $id_sucursal);
                            $guardar_detalle = $this->model->agregar_detalle_venta($id_detalle, $p_id_item, $codigo_venta, $cantidad, $precio, $descuento_producto, $sub_total_producto_, $total_producto, $stock,$medida);
                            if (!$guardar_detalle) {
                                echo 4;
                            }
                            $guardar_kardex = $this->model->agregar_kardex($id_salida, $id_caja, $id_sucursal, $id_usuario, $p_id_item, $total_producto, $date, 1, 0, $cantidad, $stock - $cantidad, $stock_global - $cantidad, $nombre_credito, $codigo_venta);
                            if (!$guardar_kardex) {
                                echo 5;
                            }
                        }
                        echo "1|" . mainModel::encryption($codigo_venta);
                    } else {
                        echo 2;
                    }
                } else {
                    echo 0;
                }
    
            }
        }
/* ========================================================================== */
/*                       Funcion generar codigo de venta                      */
/* ========================================================================== */

        function generar_codigo_venta(){
            $numero = $this->model->lista_ventas();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('VENTA',7,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                     Funcion generar codigo de credito                      */
/* ========================================================================== */

        function generar_codigo_credito(){
            $numero = $this->model->lista_creditos();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('CREDITO',7,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                        Funcion generar codigo salida                       */
/* ========================================================================== */

        function generar_codigo_salida(){
            $numero = $this->model->Lista_de_kardex();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('KARDEX',7,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                       Funcion generar numero de venta                      */
/* ========================================================================== */

        function generar_nro_venta($sucursal){
            $numero = $this->model->lista_ventas_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                return $numero;
                // if($numero<=9){
                //     return "V000000".$numero;
                // }else if($numero>9 && $numero<=99){
                //     return "V00000".$numero;
                // }else if($numero>99 &&  $numero<=999){
                //     return "V0000".$numero;
                // }else if($numero>999 && $numero<=9999){
                //     return "V000".$numero;
                // }else if($numero>9999 && $numero<=99999){
                //     return "V00".$numero;
                // }
            }else{
                return 0;
            }
        }
        function generar_nro_venta2($sucursal){
            $numero = $this->model->lista_ventas_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                 Funcion generar nro de salida por sucursal                 */
/* ========================================================================== */

        function generar_nro_salida($sucursal){
            $numero = $this->model->Lista_de_salidas($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<=9){
                //     return "SAL000000".$numero;
                // }else if($numero>9 && $numero<=99){
                //     return "SAL00000".$numero;
                // }else if($numero>99 &&  $numero<=999){
                //     return "SAL0000".$numero;
                // }else if($numero>999 && $numero<=9999){
                //     return "SAL000".$numero;
                // }else if($numero>9999 && $numero<=99999){
                //     return "SAL00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                    Funcion generar codigo detalle venta                    */
/* ========================================================================== */

        function generar_codigo_detalle_venta(){
            $numero = $this->model->lista_detalle_venta();
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<=9){
                //     return "DETA000000".$numero;
                // }else if($numero>9 && $numero<99){
                //     return "DETA00000".$numero;
                // }else if($numero>=99 &&$numero<999){
                //     return "DETA0000".$numero;
                // }else if($numero>=999 && $numero<9999){
                //     return "DETA000".$numero;
                // }else if($numero>=9999 && $numero<99999){
                //     return "DETA00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                      Funcion generar codigo de credito                     */
/* ========================================================================== */

        function generar_nro_credito($sucursal){
            $numero = $this->model->lista_creditos_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<9){
                //     return "CRE000000".$numero;
                // }else if($numero<99){
                //     return "CRE00000".$numero;
                // }else if($numero<999){
                //     return "CRE0000".$numero;
                // }if($numero<9999){
                //     return "CRE000".$numero;
                // }if($numero<99999){
                //     return "CRE00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                    Funcion generar numero de comprobante                   */
/* ========================================================================== */

        function generar_nro_comprobante($tiraje){
            $numero = $this->model->busqueda_tiraje($tiraje);
            if($numero){
               if($numero->rowCount()>0){
                    $hasta = 0;
                    $disponibles = 0;
                    foreach($numero as $row){
                        $hasta = $row["HASTA"];
                        $disponibles = $row["DISPONIBLES"];
                    }
                    $numero = $hasta-$disponibles;
                    return $numero+1;
               }
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                           Vista ventas por fecha                           */
/* ========================================================================== */

        function ventasporfecha(){
            $this->view->render('ventas/ventaporfecha');
        }

/* ========================================================================== */
/*                                Lista de ventas                             */
/* ========================================================================== */

        function lista_ventas(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                $usuario = $_POST["usuario"];
                if($usuario == "ADMIN01"){
                    $lista_compras = $this->model->lista_ventas();
                }else{
                    $lista_compras = $this->model->lista_ventas_usuario($usuario);
                }
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_RESOLUCION"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            $badge_tipo_pago = $row["TIPO_PAGO"];
                            if($badge_tipo_pago == 1){
                                $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo </span>";
                            }else if($badge_tipo_pago == 2){
                                $badge_tipo_pago = "<span class='badge badge-primary'> Tarjeta Credito </span>";
                            }else{
                                $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo & Tarjeta </span>";
                            }
                            $anular = "";
                            if($sucursal == $sucursal_venta){
                                $badge = $row["ESTADO"];
                                if($badge == 1){
                                    $anular = "<a class='dropdown-item btn_anular' id_v='{$row["ID_VENTA"]}' nro_v='{$row["N_VENTA"]}' estado='{$row["ESTADO"]}'arqueo='{$row["ID_ARQUEO"]}' total='{$row["TOTAL"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                        Anular Venta
                                                </a>";
                                    $badge = "<span class='badge badge-success'> Contado </span>";
                                }else if($badge == 2){
                                    $badge = "<span class='badge badge-info'> Credito </span>";
                                }else if($badge == 4){
                                    $badge = "<span class='badge badge-success'> Credito Completado </span>";
                                }else{
                                    $badge = "<span class='badge badge-danger'> Anulado </span>";
                                }
                                $cliente = strtoupper($row["RAZON"]);
                                $table .= "
                                <tr>
                                    <td>{$row["N_VENTA"]}</td>
                                    <td>{$row["COMPROBANTE"]} #{$row["NUMERO_COMPROBANTE"]}</td>
                                    <td>{$fecha_comprobante}</td>
                                    <td class='text-center'>{$badge_tipo_pago}</td>
                                    <td>{$row["DESCUENTO"]}</td>
                                    <td>{$row["TOTAL"]}</td>
                                    <td>{$cliente}</td>
                                    <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                    <td class='text-center'>{$badge}</td>
                                    <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>

                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_v='{$row["ID_VENTA"]}'  href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Venta
                                                </a>
                                                <a class='dropdown-item btn_enviar' id_v='{$row["ID_VENTA"]}'  telefono='{$row["TELEFONO"]}' url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                        Enviar Whatsapp
                                                </a>
                                                {$anular}
                                                <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                {$row["COMPROBANTE"]} (A4)
                                                </a>
                                                <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2)
                                                    </a>
                                                <a class='dropdown-item'  href='{$enlace}ventas/notaVentaExcel/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2) xlsx
                                                    </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                {$row["COMPROBANTE"]} (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        {$row["COMPROBANTE"]} (TICKET)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        FACTURA
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (MEMBRETE)
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function lista_ventas_pagos_pendientes(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                $usuario = $_POST["usuario"];
                // if($usuario == "ADMIN01"){
                    $lista_compras = $this->model->lista_ventas_pagos_pendientes();
                // }else{
                //     $lista_compras = $this->model->lista_ventas_pagos_pendientes_usuario($usuario);
                // }
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_RESOLUCION"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            $badge_tipo_pago = $row["TIPO_PAGO"];
                            if($badge_tipo_pago == 1){
                                $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo </span>";
                            }else if($badge_tipo_pago == 2){
                                $badge_tipo_pago = "<span class='badge badge-primary'> Tarjeta Credito </span>";
                            }else{
                                $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo & Tarjeta </span>";
                            }
                            $anular = "";
                            if($sucursal == $sucursal_venta){
                                $badge = $row["ESTADO"];
                                if($badge == 1){
                                    $anular = "<a class='dropdown-item btn_anular' id_v='{$row["ID_VENTA"]}' nro_v='{$row["N_VENTA"]}' estado='{$row["ESTADO"]}'arqueo='{$row["ID_ARQUEO"]}' total='{$row["TOTAL"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                        Anular Venta
                                                </a>";
                                    $badge = "<span class='badge badge-success'> Contado </span>";
                                }else if($badge == 2){
                                    $badge = "<span class='badge badge-info'> Credito </span>";
                                }else if($badge == 4){
                                    $badge = "<span class='badge badge-success'> Credito Completado </span>";
                                }else{
                                    $badge = "<span class='badge badge-danger'> Anulado </span>";
                                }
                                $badge2 = $row["PAGO_INMEDIATO"];
                                if($badge2 == 1){
                                   
                                    $badge2 = "<span class='badge badge-info'> Pago Pendiente </span>";
                                }else{
                                    $badge2 = "<span class='badge badge-danger'>Pago Inmediato </span>";
                                }
                                $cliente = strtoupper($row["RAZON"]);
                                $pendiente = $row["TOTAL"] - $row["PAGOS_A_VENTA"];
                                $pendiente = sprintf('%0.2f', $pendiente);
                                $table .= "
                                <tr>
                                    <td>{$row["N_VENTA"]}</td>
                                    <td>{$row["COMPROBANTE"]} #{$row["NUMERO_COMPROBANTE"]}</td>
                                    <td>{$fecha_comprobante}</td>
                                    <td class='text-center'>{$badge_tipo_pago}</td>
                                    <td>{$row["DESCUENTO"]}</td>
                                    <td>{$row["TOTAL"]}</td>
                                    <td>{$cliente}</td>
                                    <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                    <td class='text-center'>{$badge}</td>
                                    <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                    <td>{$badge2}</td>
                                    <td>{$row["PAGOS_A_VENTA"]}</td>
                                    <td>{$pendiente}</td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>

                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_v='{$row["ID_VENTA"]}'  href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Venta
                                                </a>
                                                <a class='dropdown-item btn_agregar_pago' id_v='{$row["ID_VENTA"]}' id_v_encrypt='{$id_encryptado}'   pendiente='{$pendiente}'  href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Agregar Pago
                                                </a>
                                                <a class='dropdown-item btn_enviar' id_v='{$row["ID_VENTA"]}'  telefono='{$row["TELEFONO"]}' url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                        Enviar Whatsapp
                                                </a>
                                                {$anular}
                                                <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                {$row["COMPROBANTE"]} (A4)
                                                </a>
                                                <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2)
                                                    </a>
                                                <a class='dropdown-item'  href='{$enlace}ventas/notaVentaExcel/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2) xlsx
                                                    </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                {$row["COMPROBANTE"]} (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        {$row["COMPROBANTE"]} (TICKET)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        FACTURA
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (MEMBRETE)
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function lista_ventas_pagos_pendientes_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $usuario = $_POST["usuario"];
                $sucursal = $_POST["sucursal"];
                if($usuario == "ADMIN01"){
                    $lista_compras = $this->model->lista_ventas_pagos_pendientes();
                }else{
                    $lista_compras = $this->model->lista_ventas_pagos_pendientes_usuario($usuario);
                }
                    
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA_RESOLUCION"]));
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                                $sucursal_venta = $row["ID_SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_RESOLUCION"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $badge_tipo_pago = $row["TIPO_PAGO"];
                                if($badge_tipo_pago == 1){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo </span>";
                                }else if($badge_tipo_pago == 2){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Tarjeta Credito </span>";
                                }else{
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo & Tarjeta </span>";
                                }
                                $anular="";
                                if($sucursal == $sucursal_venta){
                                    $badge = $row["ESTADO"];
                                    if($badge == 1){
                                        $anular = "<a class='dropdown-item btn_anular' id_v='{$row["ID_VENTA"]}' nro_v='{$row["N_VENTA"]}' estado='{$row["ESTADO"]}'arqueo='{$row["ID_ARQUEO"]}' total='{$row["TOTAL"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                            Anular Venta
                                                    </a>";
                                        $badge = "<span class='badge badge-success'> Contado </span>";
                                    }else if($badge == 2){
                                        $badge = "<span class='badge badge-info'> Credito </span>";
                                    }else if($badge == 4){
                                        $badge = "<span class='badge badge-success'> Credito Completado </span>";
                                    }else{
                                        $badge = "<span class='badge badge-danger'> Anulado </span>";
                                    }
                                    $badge2 = $row["PAGO_INMEDIATO"];
                                    if($badge2 == 1){
                                       
                                        $badge2 = "<span class='badge badge-info'> Pago Pendiente </span>";
                                    }else{
                                        $badge2 = "<span class='badge badge-danger'>Pago Inmediato </span>";
                                    }
                                    $cliente = strtoupper($row["RAZON"]);
                                    $pendiente = $row["TOTAL"] - $row["PAGOS_A_VENTA"];
                                    $pendiente = sprintf('%0.2f', $pendiente);
                                    $table .= "
                                    <tr>
                                        <td>{$row["N_VENTA"]}</td>
                                        <td>{$row["COMPROBANTE"]} #{$row["NUMERO_COMPROBANTE"]}</td>
                                        <td>{$fecha_comprobante}</td>
                                        <td class='text-center'>{$badge_tipo_pago}</td>
                                        <td>{$row["DESCUENTO"]}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$cliente}</td>
                                        <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                        <td class='text-center'>{$badge}</td>
                                        <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                        <td>{$badge2}</td>
                                        <td>{$row["PAGOS_A_VENTA"]}</td>
                                        <td>{$pendiente}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>

                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_v='{$row["ID_VENTA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Venta
                                                    </a>
                                                    <a class='dropdown-item btn_agregar_pago' id_v='{$row["ID_VENTA"]}'  id_v_encrypt='{$id_encryptado}'  pendiente='{$pendiente}'  href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                           Agregar Pago
                                                    </a>
                                                    <a class='dropdown-item btn_enviar' id_v='{$row["ID_VENTA"]}' telefono='{$row["TELEFONO"]}'  url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                Enviar Whatsapp
                                        </a>
                                                    {$anular}
                                                    <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A5)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            {$row["COMPROBANTE"]} (TICKET)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            FACTURA
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        {$row["COMPROBANTE"]} (MEMBRETE)
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    ";
                                }
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                          Lista de ventas por fecha                         */
/* ========================================================================== */

        function lista_ventas_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $usuario = $_POST["usuario"];
                $sucursal = $_POST["sucursal"];
                if($usuario == "ADMIN01"){
                    $lista_compras = $this->model->lista_ventas();
                }else{
                    $lista_compras = $this->model->lista_ventas_usuario($usuario);
                }
                    
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA_RESOLUCION"]));
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                                $sucursal_venta = $row["ID_SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_RESOLUCION"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $badge_tipo_pago = $row["TIPO_PAGO"];
                                if($badge_tipo_pago == 1){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo </span>";
                                }else if($badge_tipo_pago == 2){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Tarjeta Credito </span>";
                                }else{
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo & Tarjeta </span>";
                                }
                                $anular="";
                                if($sucursal == $sucursal_venta){
                                    $badge = $row["ESTADO"];
                                    if($badge == 1){
                                        $anular = "<a class='dropdown-item btn_anular' id_v='{$row["ID_VENTA"]}' nro_v='{$row["N_VENTA"]}' estado='{$row["ESTADO"]}'arqueo='{$row["ID_ARQUEO"]}' total='{$row["TOTAL"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                            Anular Venta
                                                    </a>";
                                        $badge = "<span class='badge badge-success'> Contado </span>";
                                    }else if($badge == 2){
                                        $badge = "<span class='badge badge-info'> Credito </span>";
                                    }else if($badge == 4){
                                        $badge = "<span class='badge badge-success'> Credito Completado </span>";
                                    }else{
                                        $badge = "<span class='badge badge-danger'> Anulado </span>";
                                    }
                                    $cliente = strtoupper($row["RAZON"]);
                                    $table .= "
                                    <tr>
                                        <td>{$row["N_VENTA"]}</td>
                                        <td>{$row["COMPROBANTE"]} #{$row["NUMERO_COMPROBANTE"]}</td>
                                        <td>{$fecha_comprobante}</td>
                                        <td class='text-center'>{$badge_tipo_pago}</td>
                                        <td>{$row["DESCUENTO"]}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$cliente}</td>
                                        <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                        <td class='text-center'>{$badge}</td>
                                        <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>

                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_v='{$row["ID_VENTA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Venta
                                                    </a>
                                                    <a class='dropdown-item btn_enviar' id_v='{$row["ID_VENTA"]}' telefono='{$row["TELEFONO"]}'  url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                Enviar Whatsapp
                                        </a>
                                                    {$anular}
                                                    <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A5)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            {$row["COMPROBANTE"]} (TICKET)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            FACTURA
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        {$row["COMPROBANTE"]} (MEMBRETE)
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    ";
                                }
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                        Funcion para detalle de venta                       */
/* ========================================================================== */

        function detalle_venta(){
            if(isset($_POST["id"])){
                $busqueda = $this->model->busqueda_venta($_POST["id"]);
                if($busqueda){
                    $response  = "";
                    if($busqueda->rowCount()>0){
                        foreach($busqueda as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else {
                                $tipo_pago = "CREDITO";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["RAZON"]}|{$row["DOCUMENTO"]}|{$row["N_DOCUMENTO"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}"; 
                        }
                        echo "1|$response";
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                Funcion para los listar los items de la venta               */
/* ========================================================================== */

        function lista_items_venta(){
            if(isset($_POST["id"])){
                $venta = $_POST["id"];
                $items_de_venta  = $this->model->busqueda_item_venta($venta);
                if($items_de_venta){
                    $response  = "";
                    if($items_de_venta->rowCount()>0){
                        foreach($items_de_venta as $row){
                            $response .="
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 700'>{$row['BARRA']}</td>
                                    <td>{$row['ARTICULO']}</td>
                                    <td>{$row['LINEA']}</td>
                                    <td>{$row['PRESENTACION']}</td>
                                    <td>{$row['CANTIDAD']}</td>
                                    <td>{$row['PRECIO']}</td>
                                    <td>{$row['SUBTOTAL']}</td>
                                    <td>{$row['DESCUENTO']}</td>
                                    <td>{$row['TOTAL']}</td>
                                </tr>
                            
                            ";
                        }
                        echo $response;
                    }
                }else{  
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                  Funcion para imprimir venta en fomato A4                  */
/* ========================================================================== */

        function membrete($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_venta($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $metodo_pago = "{$row["TIPO_PAGO"]}";
                            if($metodo_pago == 1){
                                $metodo_pago = "EFECTIVO";
                            }else if($metodo_pago == 2){
                                $metodo_pago = "TARJETA CREDITO/DEBITO";
                            }else if($metodo_pago == 3){
                                $metodo_pago = "EFECTIVO Y TARJETA";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->busqueda_item_venta2($id);
                $this->view->render("ventas/membrete");
            }else{
                $this->view->render("error/404");
            }
        }
        function lista_personas_option(){
            $personas = $this->model->lista_personas();
            if($personas){
                if($personas->rowCount()>0){
                    $option = "";
                    foreach($personas as $rows){
                        if($rows["ESTADO"] != 0){
                            $option .= "
                                    <option value='{$rows["NOMBRES"]} {$rows["APELLIDOS"]}'>".strtoupper($rows["NOMBRES"])." ".strtoupper($rows["APELLIDOS"])."</option>
                                ";
                        }
                    }
                    return $option;
                }
            }
        }
        function formatoA4($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_venta($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $metodo_pago = "{$row["TIPO_PAGO"]}";
                            if($metodo_pago == 1){
                                $metodo_pago = "EFECTIVO";
                            }else if($metodo_pago == 2){
                                $metodo_pago = "TARJETA CREDITO/DEBITO";
                            }else if($metodo_pago == 3){
                                $metodo_pago = "EFECTIVO Y TARJETA";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->busqueda_item_venta2($id);
                $this->view->render("ventas/formatoA4");
                // var_dump($this->view->lista_items->fetchAll());
            }else{
                $this->view->render("error/404");
            }
        }
        function formatoA4v2($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_venta($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $metodo_pago = "{$row["TIPO_PAGO"]}";
                            if($metodo_pago == 1){
                                $metodo_pago = "EFECTIVO";
                            }else if($metodo_pago == 2){
                                $metodo_pago = "TARJETA CREDITO/DEBITO";
                            }else if($metodo_pago == 3){
                                $metodo_pago = "EFECTIVO Y TARJETA";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->busqueda_item_venta2($id);
                $this->view->render("ventas/formatoA4v2");
                // var_dump($this->view->lista_items->fetchAll());
            }else{
                $this->view->render("error/404");
            }
        }


        function formatoA5($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_venta($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $metodo_pago = "{$row["TIPO_PAGO"]}";
                            if($metodo_pago == 1){
                                $metodo_pago = "EFECTIVO";
                            }else if($metodo_pago == 2){
                                $metodo_pago = "TARJETA CREDITO/DEBITO";
                            }else if($metodo_pago == 3){
                                $metodo_pago = "EFECTIVO Y TARJETA";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->busqueda_item_venta2($id);
                $this->view->render("ventas/formatoA5");
            }else{
                $this->view->render("error/404");
            }
        }

        function ticket($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_venta($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $metodo_pago = "{$row["TIPO_PAGO"]}";
                            if($metodo_pago == 1){
                                $metodo_pago = "EFECTIVO";
                            }else if($metodo_pago == 2){
                                $metodo_pago = "TARJETA CREDITO/DEBITO";
                            }else if($metodo_pago == 3){
                                $metodo_pago = "EFECTIVO Y TARJETA";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->busqueda_item_venta2($id);
                $this->view->render("ventas/ticket");
            }else{
                $this->view->render("error/404");
            }
        }
        function ticketAbono($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_abono  = mainModel::parametros_abono_credito($id);

                $this->view->parametros_abono = mainModel::parametros_abono_credito($id);
                $this->view->parametros_cliente = mainModel::parametros_cliente($buscar_abono["ID_CLIENTE"]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($buscar_abono["ID_SUCURSAL"]);
                $this->view->parametros_persona = mainModel::parametros_persona($buscar_abono["ID_PERSONA"]);
                $this->view->render("ventas/ticket_abono");
            }else{
                $this->view->render("error/404");
            }
        }
        
    
        

/* ========================================================================== */
/*                       Lista de productos por sucursal                      */
/* ========================================================================== */
        function lista_productos_sucursal(){
            if(isset($_POST["id"])){
                $lista_productos = $this->model->lista_productos_sucursal();
                if($lista_productos){
                    if($lista_productos->rowCount()>0){
                        $cards = "";
                        foreach($lista_productos as $row){
                            $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                            $sucursal = $row["ID_SUCURSAL"];
                            if($sucursal == $_POST["id"]){
                                if($row["CANTIDAD"] >0){
                                    $exento = $row["EXENTO"];
                                    if($exento){
                                        $exento = "info";
                                    }else{
                                        $exento = "warning";
                                    }
                                    $fecha = "";
                                    if($row["FECHA_VEN"] == "0000-00-00"){
                                        $fecha = "<span class='badge badge-dark w-100 mt-1'>No caducable</span>";
                                    }else{
                                        $fecha = "<span class='badge badge-secondary w-100 mt-1'>{$row["FECHA_VEN"]}</span>";
                                    }
                                    $cards .= "
                                    <div class='items' id='item_{$row["ID_ITEM"]}' articulo='{$row["ARTICULO"]}' linea='{$row["LINEA"]}' presentacion='{$row["PRESENTACION"]}'  stock='{$row["CANTIDAD"]}' producto='{$row["ID_PRODUCTO"]}' exento='{$row["EXENTO"]}' almacen='{$row["ID_ALMACEN"]}' lote='{$row["LOTE"]}' id_lote='{$row["ID_LOTE"]}' >
                                            <div class='item-content'>
                                                <div class='user-profile'>
                                                    <img class='btn_img' id_item='{$row['ID_ITEM']}' src='{$imagen}' alt='avatar' style='height: 100px;'>
                                                    <div class='user-meta-info'>
                                                        <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                                        <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                                    </div>
                                                </div>
                                                <div class='code-bar'>
                                                    
                                                <button class='btn btn-outline-{$exento} btn-block btn_agregar' value='{$row['ID_ITEM']}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                                    {$row["BARRA"]}
                                                </button>
                                                </div>
                                                <div class='user-email' style='margin-top: 10px;'>
                                                    <span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>
                                                </div>
                                                <div class='user-email' style='margin-top: 10px;'>
                                                    <span class='badge w-100 badge-primary text-center'> {$row["LOTE"]} </span>
                                                </div>
                                                <div class='user-email' style='margin: auto;margin-top: 5px;'>
                                                    <p class='usr-email-addr'  style='margin: auto;font-weight: 800;'>{$row["PRESENTACION"]}</p>
                                                </div>
                                                <div class='user-phone'  style='margin:auto' >
                                                    <p class='info-title'>STOCK: </p>
                                                    <p class='usr-ph-no'>{$row["CANTIDAD"]}</p>
                                                </div>
                                                <span style='font-weight: 700;color: #3b3f5c;'>Precio</span>
                                                <div class='user-location'>
                                                    <input type='text' id='PRICE_{$row['ID_ITEM']}' class='touchs' value='{$row["PRECIO_VENTA_4"]}'/>
                                                    <input type='hidden' id='MEDIDA_{$row['ID_ITEM']}' class='' value='{$row["MEDIDA_4"]}'/>
                                                </div>
                                                <span style='font-weight: 700;color: #3b3f5c;'>Descuento (%)</span>
                                                <div class='user-location'>
                                                    <input type='text' id='DESCU_{$row['ID_ITEM']}' class='touchs_discounts' value='0'/>
                                                </div>
                                           
                                                <button class='btn btn-success btn-block mt-2 btn_agregar' value='{$row['ID_ITEM']}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                    Agregar
                                                </button>
                                                {$fecha}
                                            </div>
                                        </div>
                                    ";
                                }
                            }
                        }
                        echo $cards;
                    }
                }
            }
        }

/* ========================================================================== */
/*                       Vista de punto de venta rapido                       */
/* ========================================================================== */

        function pos(){
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->lista_documentos = $this::lista_documentos();
            $this->view->lista_metodopago = $this::lista_metodopago();
            $this->view->render("ventas/pos2");
        }

/* ========================================================================== */
/*                     Lista de presentaciones disponibles                    */
/* ========================================================================== */

        function listar_presentacion(){
            $presentacion = $this->model->listar_presentacion();
            if($presentacion){
                $option = "";
                foreach($presentacion as $row){
                    $option .= "<a class='dropdown-item filtro_categoria' href='javascript:void(0);' id_categoria='{$row['ID_PRESENTACION']}'>{$row["NOMBRE"]}</a>";
                }
                return $option;
            }
        }
        function listar_lineas(){
            $presentacion = $this->model->listar_linea();
            if($presentacion){
                $option = "";
                foreach($presentacion as $row){
                    $option .= "<a class='dropdown-item filtro_lineas' href='javascript:void(0);' id_linea='{$row['ID_LINEA']}'>{$row["LINEA"]}</a>";
                }
                return $option;
            }
        }
/* ========================================================================== */
/*                            Realizar venta simple                           */
/* ========================================================================== */
        function venta_simple(){
            if(isset($_POST["productos"])){
                session_name('B_POS');
                session_start();
                date_default_timezone_set(ZONEDATE);
                $id_sucursal = $_SESSION["sucursal"];
                $id_caja = $_SESSION["caja"];
                $id_usuario = $_SESSION["usuario"];
                $efectivo_recibido = floatval($_POST["efectivo_recibido"]);
                $monto_a_pagar = floatval($_POST["monto_a_pagar"]);
                $cambio_venta = floatval($_POST["cambio_venta"]);
                $cliente = $_POST["cliente"];
                $medio = $_POST["medio"];
                $paramcliente =  mainModel::parametros_cliente($cliente);
                $nit_cliente = $paramcliente['N_DOCUMENTO'];
                $observacion = $_POST["observacion"];
                $nrofactura = $_POST["nrofactura"];
                $nombrepromotor = $_POST["nombrepromotor"];
                $tipo_comprobante = $_POST["tipo_comprobante"];
                $descuento_percent = floatval($_POST["descuento_percent"]);
                $n_exento = $_POST["n_exento"];
                $precio_descuento = floatval($_POST["precio_descuento"]);
                $exento_price = floatval($_POST["exento_price"]);
                $retencion_price = floatval($_POST["retencion_price"]);
                $sub_total_price = floatval($_POST["sub_total_price"]);
                $cant_iva = floatval($_POST["cant_iva"]);
                $suma_price = floatval($_POST["suma_price"]);
                $date = date('Y-m-d H:i:s');
                $date_venta = date('Y-m-d');
                $date_registro = date('Y-m-d H:i:s');
                $codigo_venta = $this->generar_codigo_venta();
                $nro_venta =  $this->generar_nro_venta($id_sucursal);
                $nro_venta2 =  $this->generar_nro_venta2($id_sucursal);
                $detalle = "POR VENTA #{$nro_venta}";
                $venta_facturar = $_POST["venta_facturar"];
                $pago_pendiente_check = $_POST["pago_pendiente_check"];
                $nro_comprobante = $this->generar_nro_comprobante($tipo_comprobante);
                $guardar_venta = $this->model->guardar_venta($codigo_venta,$nro_venta,$date,1,$nro_comprobante,$tipo_comprobante,$suma_price,$cant_iva,$exento_price,$sub_total_price,$retencion_price,$precio_descuento,$descuento_percent,$monto_a_pagar,$n_exento,$efectivo_recibido,""," "," ",$cambio_venta,1 ,$cliente,$id_usuario,$id_sucursal,$id_caja,$observacion,4,$nrofactura,$nombrepromotor,$pago_pendiente_check,0,$medio);
                if($guardar_venta){
                    if($guardar_venta->rowCount()>=0){
                        $productos = $_POST["productos"];
                        //separo los producto en arreglo
                        $arrayproductos = explode(',',$productos);
                        //cuento la cantidad de productos
                        $n_productos = count($arrayproductos)-1;
                        //recorro el arreglo
                        for($i=0;$i<$n_productos;$i++){
                            //capturo el string del array que esta en el indice
                            $productostring = $arrayproductos[$i];
                            //separo el string por el | y lo convierto
                            $producto = explode("|",$productostring);
                            //coloco cada variable en su lugar
                            $id_detalle = $this->generar_codigo_detalle_venta();
                            $id_salida = $this->generar_codigo_salida();
                            $p_id_item = $producto[0];
                            $cantidad = $producto[2];
                            $descuento_producto = $producto[3];
                            $precio = $producto[4];
                            $sub_total_producto_ = $producto[5];
                            $total_producto = $producto[6];
                            $stock = $producto[7];
                            $producto_id = $producto[8];
                            $medida = $producto[9];
                            $stock_global = mainModel::stock_global_producto($producto_id,$id_sucursal);
                            $guardar_detalle = $this->model->agregar_detalle_venta($id_detalle,$p_id_item,$codigo_venta,$cantidad,$precio,$descuento_producto,$sub_total_producto_,$total_producto,$stock,$medida);
                            if(!$guardar_detalle){
                                echo $id_detalle;
                            }
                            $guardar_kardex = $this->model->agregar_kardex($id_salida,$id_caja,$id_sucursal,$id_usuario,$p_id_item,$total_producto,$date,1,0,$cantidad,$stock-$cantidad,$stock_global-$cantidad,$detalle,$codigo_venta);
                            if(!$guardar_kardex){
                                echo 5;
                            }
                        }
                        if($venta_facturar==1){
                            $respuesta = $this->dosificacion_venta($codigo_venta,$nro_comprobante,$monto_a_pagar,$date_venta,$id_sucursal,$nit_cliente);
                            if($respuesta==1){
                                echo "1|".mainModel::encryption($codigo_venta);
                            }else{
                               echo 2; 
                            }
                        }else{
                            echo "1|".mainModel::encryption($codigo_venta);
                        }
                    }else{
                        echo 2;
                    }
                }else{
                    echo 0;
                }

            }
        }

/* ========================================================================== */
/*                         Vista de consulta de ventas                        */
/* ========================================================================== */

        function consultaventas(){
            $this->view->lista_vendedores = $this->lista_personas_option();
            $this->view->render('ventas/consultaventas');
        }

/* ========================================================================== */
/*                Lista de presentaciones de items por sucursal               */
/* ========================================================================== */

        function listar_items_sucursal_presentacion(){
            if(isset($_POST["sucursal"]) && isset($_POST["categoria"])){
                $id_presentacion = $_POST["categoria"];
                if($id_presentacion == "TODO"){
                    $lista_productos = $this->model->lista_productos_sucursal();
                    if($lista_productos){
                        if($lista_productos->rowCount()>0){
                            $cards = "";
                            foreach($lista_productos as $row){
                                $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                                $sucursal = $row["ID_SUCURSAL"];
                                if($sucursal == $_POST["sucursal"]){
                                    if($row["CANTIDAD"] >0){
                                        $exento = $row["EXENTO"];
                                        if($exento){
                                            $exento = "info";
                                        }else{
                                            $exento = "warning";
                                        }
                                        $fecha = "";
                                        if($row["FECHA_VEN"] == "0000-00-00"){
                                            $fecha = "<span class='badge badge-dark w-100 mt-1'>No caducable</span>";
                                        }else{
                                            $fecha = "<span class='badge badge-secondary w-100 mt-1'>{$row["FECHA_VEN"]}</span>";
                                        }
                                        $cards .= "
                                        <div class='items' id='item_{$row["ID_ITEM"]}' articulo='{$row["ARTICULO"]}' linea='{$row["LINEA"]}' presentacion='{$row["PRESENTACION"]}'  stock='{$row["CANTIDAD"]}' producto='{$row["ID_PRODUCTO"]}' exento='{$row["EXENTO"]}' almacen='{$row["ID_ALMACEN"]}'>
                                                <div class='item-content'>
                                                    <div class='user-profile'>
                                                        <img src='{$imagen}' alt='avatar' style='height: 100px;'>
                                                        <div class='user-meta-info'>
                                                            <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                                            <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                                        </div>
                                                    </div>
                                                    <div class='code-bar'>
                                                        
                                                    <button class='btn btn-outline-{$exento} btn-block btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                                        {$row["BARRA"]}
                                                    </button>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-primary text-center'> {$row["LOTE"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin: auto;margin-top: 5px;'>
                                                        <p class='usr-email-addr'  style='margin: auto;font-weight: 800;'>{$row["PRESENTACION"]}</p>
                                                    </div>
                                                    <div class='user-phone'  style='margin:auto' >
                                                        <p class='info-title'>STOCK: </p>
                                                        <p class='usr-ph-no'>{$row["CANTIDAD"]}</p>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Precio</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='PRICE_{$row['ID_ITEM']}' class='touchs' value='{$row["PRECIO_VENTA_4"]}'/>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento (%)</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='DESCU_{$row['ID_ITEM']}' class='touchs_discounts' value='0'/>
                                                    </div>
                                                    <button class='btn btn-success btn-block mt-2 btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                        Agregar
                                                    </button>
                                                    {$fecha}
                                                
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
                            }
                            echo $cards;
                        }
                    }
                }else{
                    $lista_productos = $this->model->lista_productos_sucursal();
                    if($lista_productos){
                        if($lista_productos->rowCount()>0){
                            $cards = "";
                            foreach($lista_productos as $row){
                                $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                                $sucursal = $row["ID_SUCURSAL"];
                                if($sucursal == $_POST["sucursal"] && $row["ID_PRESENTACION"] == $id_presentacion){
                                    if($row["CANTIDAD"] >0){
                                        $exento = $row["EXENTO"];
                                        if($exento){
                                            $exento = "info";
                                        }else{
                                            $exento = "warning";
                                        }
                                        $fecha = "";
                                        if($row["FECHA_VEN"] == "0000-00-00"){
                                            $fecha = "<span class='badge badge-dark w-100 mt-1'>No caducable</span>";
                                        }else{
                                            $fecha = "<span class='badge badge-secondary w-100 mt-1'>{$row["FECHA_VEN"]}</span>";
                                        }
                                        $cards .= "
                                        <div class='items' id='item_{$row["ID_ITEM"]}' articulo='{$row["ARTICULO"]}' linea='{$row["LINEA"]}' presentacion='{$row["PRESENTACION"]}'  stock='{$row["CANTIDAD"]}' producto='{$row["ID_PRODUCTO"]}' exento='{$row["EXENTO"]}' almacen='{$row["ID_ALMACEN"]}'>
                                                <div class='item-content'>
                                                    <div class='user-profile'>
                                                        <img src='{$imagen}' alt='avatar' style='height: 100px;'>
                                                        <div class='user-meta-info'>
                                                            <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                                            <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                                        </div>
                                                    </div>
                                                    <div class='code-bar'>
                                                        
                                                    <button class='btn btn-outline-{$exento} btn-block btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                                        {$row["BARRA"]}
                                                    </button>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-primary text-center'> {$row["LOTE"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin: auto;margin-top: 5px;'>
                                                        <p class='usr-email-addr'  style='margin: auto;font-weight: 800;'>{$row["PRESENTACION"]}</p>
                                                    </div>
                                                    <div class='user-phone'  style='margin:auto' >
                                                        <p class='info-title'>STOCK: </p>
                                                        <p class='usr-ph-no'>{$row["CANTIDAD"]}</p>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Precio</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='PRICE_{$row['ID_ITEM']}' class='touchs' value='{$row["PRECIO_VENTA_4"]}'/>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento (%)</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='DESCU_{$row['ID_ITEM']}' class='touchs_discounts' value='0'/>
                                                    </div>
                                                    <button class='btn btn-success btn-block mt-2 btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                        Agregar
                                                    </button>
                                                    {$fecha}                                                
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
                            }
                            echo $cards;
                        }
                    }
                }
            }
        }
        function listar_items_sucursal_linea(){
            if(isset($_POST["sucursal"]) && isset($_POST["linea"])){
                $id_presentacion = $_POST["linea"];
                if($id_presentacion == "TODO"){
                    $lista_productos = $this->model->lista_productos_sucursal();
                    if($lista_productos){
                        if($lista_productos->rowCount()>0){
                            $cards = "";
                            foreach($lista_productos as $row){
                                $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                                $sucursal = $row["ID_SUCURSAL"];
                                if($sucursal == $_POST["sucursal"]){
                                    if($row["CANTIDAD"] >0){
                                        $exento = $row["EXENTO"];
                                        if($exento){
                                            $exento = "info";
                                        }else{
                                            $exento = "warning";
                                        }
                                        $fecha = "";
                                        if($row["FECHA_VEN"] == "0000-00-00"){
                                            $fecha = "<span class='badge badge-dark w-100 mt-1'>No caducable</span>";
                                        }else{
                                            $fecha = "<span class='badge badge-secondary w-100 mt-1'>{$row["FECHA_VEN"]}</span>";
                                        }
                                        $cards .= "
                                        <div class='items' id='item_{$row["ID_ITEM"]}' articulo='{$row["ARTICULO"]}' linea='{$row["LINEA"]}' presentacion='{$row["PRESENTACION"]}'  stock='{$row["CANTIDAD"]}' producto='{$row["ID_PRODUCTO"]}' exento='{$row["EXENTO"]}' almacen='{$row["ID_ALMACEN"]}'>
                                                <div class='item-content'>
                                                    <div class='user-profile'>
                                                        <img src='{$imagen}' alt='avatar' style='height: 100px;'>
                                                        <div class='user-meta-info'>
                                                            <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                                            <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                                        </div>
                                                    </div>
                                                    <div class='code-bar'>
                                                        
                                                    <button class='btn btn-outline-{$exento} btn-block btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                                        {$row["BARRA"]}
                                                    </button>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-primary text-center'> {$row["LOTE"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin: auto;margin-top: 5px;'>
                                                        <p class='usr-email-addr'  style='margin: auto;font-weight: 800;'>{$row["PRESENTACION"]}</p>
                                                    </div>
                                                    <div class='user-phone'  style='margin:auto' >
                                                        <p class='info-title'>STOCK: </p>
                                                        <p class='usr-ph-no'>{$row["CANTIDAD"]}</p>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Precio</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='PRICE_{$row['ID_ITEM']}' class='touchs' value='{$row["PRECIO_VENTA_4"]}'/>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento (%)</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='DESCU_{$row['ID_ITEM']}' class='touchs_discounts' value='0'/>
                                                    </div>
                                                    <button class='btn btn-success btn-block mt-2 btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                        Agregar
                                                    </button>
                                                    {$fecha}
                                                
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
                            }
                            echo $cards;
                        }
                    }
                }else{
                    $lista_productos = $this->model->lista_productos_sucursal();
                    if($lista_productos){
                        if($lista_productos->rowCount()>0){
                            $cards = "";
                            foreach($lista_productos as $row){
                                $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                                $sucursal = $row["ID_SUCURSAL"]; //
                                if($sucursal == $_POST["sucursal"] && $row["ID_LINEA"] == $id_presentacion){
                                    if($row["CANTIDAD"] >0){
                                        $exento = $row["EXENTO"];
                                        if($exento){
                                            $exento = "info";
                                        }else{
                                            $exento = "warning";
                                        }
                                        $fecha = "";
                                        if($row["FECHA_VEN"] == "0000-00-00"){
                                            $fecha = "<span class='badge badge-dark w-100 mt-1'>No caducable</span>";
                                        }else{
                                            $fecha = "<span class='badge badge-secondary w-100 mt-1'>{$row["FECHA_VEN"]}</span>";
                                        }
                                        $cards .= "
                                        <div class='items' id='item_{$row["ID_ITEM"]}' articulo='{$row["ARTICULO"]}' linea='{$row["LINEA"]}' presentacion='{$row["PRESENTACION"]}'  stock='{$row["CANTIDAD"]}' producto='{$row["ID_PRODUCTO"]}' exento='{$row["EXENTO"]}' almacen='{$row["ID_ALMACEN"]}'>
                                                <div class='item-content'>
                                                    <div class='user-profile'>
                                                        <img src='{$imagen}' alt='avatar' style='height: 100px;'>
                                                        <div class='user-meta-info'>
                                                            <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                                            <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                                        </div>
                                                    </div>
                                                    <div class='code-bar'>
                                                        
                                                    <button class='btn btn-outline-{$exento} btn-block btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                                        {$row["BARRA"]}
                                                    </button>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin-top: 10px;'>
                                                        <span class='badge w-100 badge-primary text-center'> {$row["LOTE"]} </span>
                                                    </div>
                                                    <div class='user-email' style='margin: auto;margin-top: 5px;'>
                                                        <p class='usr-email-addr'  style='margin: auto;font-weight: 800;'>{$row["PRESENTACION"]}</p>
                                                    </div>
                                                    <div class='user-phone'  style='margin:auto' >
                                                        <p class='info-title'>STOCK: </p>
                                                        <p class='usr-ph-no'>{$row["CANTIDAD"]}</p>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Precio</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='PRICE_{$row['ID_ITEM']}' class='touchs' value='{$row["PRECIO_VENTA_4"]}'/>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento (%)</span>
                                                    <div class='user-location'>
                                                        <input type='text' id='DESCU_{$row['ID_ITEM']}' class='touchs_discounts' value='0'/>
                                                    </div>
                                                    <button class='btn btn-success btn-block mt-2 btn_agregar' value='{$row['ID_ITEM']}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                        Agregar
                                                    </button>
                                                    {$fecha}                                                
                                                </div>
                                            </div>
                                        ";
                                    }
                                }
                            }
                            echo $cards;
                        }
                    }
                }
            }
        }

/* ========================================================================== */
/*                          Vista productos vendidos                          */
/* ========================================================================== */

        function productosvendidos(){
            $this->view->lista_productos = $this->lista_productos();
            $this->view->render('ventas/productosvendidos');
        }

        function lista_productos() {
            $productos = "";
            $lista_productos = $this->model->lista_productos();
            if($lista_productos){
                foreach($lista_productos as $producto){
                    $productos .= "
                        <option value='{$producto["ID_PRODUCTO"]}'>{$producto["BARRA"]} | {$producto["ARTICULO"]} | {$producto["LINEA"]} | {$producto["NOMBRE"]}</option>
                    "; 
                }
                return $productos;
            }
        }

        function lista_productos_vendidos(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                if($_POST["producto"]) {
                    $productos = $this->model->productos_vendidos_porfecha_sucursal($_POST["fecha_1"],$_POST["fecha_2"],$_POST["sucursal"], $_POST["producto"]);
                } else {
                    $productos = $this->model->productos_vendidos_porfecha_sucursal($_POST["fecha_1"],$_POST["fecha_2"],$_POST["sucursal"]);
                }
                if($productos){
                    $lista_productos = "";
                    $n = 1;
                    foreach($productos as $p){
                        $imagen = SERVERURL."archives/assets/productos/{$p["IMAGEN"]}";

                        $medida = $p["MEDIDA"];
                        $stock_medida = 1;
                        if($medida == $p["MEDIDA_1"]){
                            $stock_medida = $p["STOCK_1"];
                        }
                        if($medida == $p["MEDIDA_2"]){
                            $stock_medida = $p["STOCK_2"];
                        }
                        if($medida == $p["MEDIDA_3"]){
                            $stock_medida = $p["STOCK_3"];
                        }
                        if($medida == $p["MEDIDA_4"]){
                            $stock_medida = $p["STOCK_4"];
                        }
                        if($medida == $p["MEDIDA_5"]){
                            $stock_medida = $p["STOCK_5"];
                        }
                        if($medida == $p["MEDIDA_6"]){
                            $stock_medida = $p["STOCK_6"];
                        }
                        if($medida == $p["MEDIDA_7"]){
                            $stock_medida = $p["STOCK_7"];
                        }
                        $cantidad = floor($p["VENTAS"]/$stock_medida);

                        $lista_productos .="
                            <tr>
                                <td style='font-weight: bolder;'>{$n}</td>
                                <td style='color: #FF9800;font-weight: bolder;'>{$p["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td style='color: #1b55e2;font-weight: bolder;'>{$p["CLIENTE"]}</td>
                                <td style='color: #1b55e2;font-weight: bolder;'>{$p["N_VENTA"]}</td>
                                <td style='color: #1b55e2;font-weight: bolder;'>{$p["ARTICULO"]}</td>
                                <td style='color: #4CAF50;font-weight: bolder;'>{$p["LINEA"]}</td>
                                <td style='color: #4CAF50;font-weight: bolder;'>{$p["LOTE"]}</td>
                                <td style='font-weight: bolder;'>{$p["FECHA_RESOLUCION"]}</td>
                                <td style='font-weight: bolder;'>{$p["COMPLEMENTO"]} {$p["PREFIJO"]}</td>
                                <td style='color: #FFC107;font-weight: bolder;'>{$cantidad} {$medida}</td>
                                <td style='color: #ff9c7c;font-weight: bolder;'>{$p["PRECIO"]}</td>
                                <td style='color: #ff9c7c;font-weight: bolder;'>{$p["DESCUENTOS"]}</td>
                                <td style='color: #ff9c7c;font-weight: bolder;'>{$p["SUBTOTALES"]}</td>
                                <td style='color: #FF5722;font-weight: bolder;'>{$p["TOTALES"]}</td>
                            </tr>
                        ";
                        $n++;
                        
                    }
                    echo $lista_productos;
                }else{
                    echo 0;
                }
            }
        }

        function anular_venta(){
            if(isset($_POST["id_v"]))
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $id_usuario =  $_SESSION["usuario"];
                $id_caja = $_SESSION["caja"];
                $id_sucursal =  $_SESSION["sucursal"];{
                $date_registro = date('Y-m-d H:i:s');
                $anular = $this->model->anular_venta($_POST["id_v"]);
                $arqueo = $_POST["arqueo"];
                $total = $_POST["total"];
                $estado = $_POST["estado"];
                if($estado == 1){
                    $ac_arqueo = $this->model-> actualizar_arqueo($arqueo,$total);
                    if(!$ac_arqueo){
                        echo 5;
                    }
                }else if($estado == 2){
                    $anular_creditos = $this->model->anular_creditos($_POST["id_v"]);
                    if(!$anular_creditos){
                        echo 4;
                    }
                }
                if($anular){
                    $buscar_items_venta = $this->model->busqueda_item_venta($_POST["id_v"]);
                    if($buscar_items_venta){
                        foreach($buscar_items_venta as $b){
                            $devolver_stock = $this->model->sumar_item_lote($b["ID_ITEM"],$b["CANTIDAD"]);
                            if(!$devolver_stock){
                                echo 3;
                            }
                            $stock_global = mainModel::stock_global_producto($b["ID_PRODUCTO"],$id_sucursal);
                            $id_salida = $this->generar_codigo_salida();
                            $guardar_kardex = $this->model->agregar_kardex($id_salida,$id_caja,$id_sucursal,$id_usuario,$b["ID_ITEM"],$b["TOTAL"],$date_registro,2,$b["CANTIDAD"],0,$b["STOCK_ACTUL"],$stock_global,"POR ANULACION VENTA {$_POST['nro_v']}",$_POST['id_v']);
                            if(!$guardar_kardex){
                                echo 5;
                            }
                           
                        }
                    }
                    echo 1;
                }
                
            }
        }
        function cuentasxcobrar(){
            $this->view->render('ventas/cuentasxcobrar');
        }
        function reporte_cuentas_cobrar_sn_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $lista_creditos = $this->model-> lista_creditos_sucursal($_POST["sucursal"]);
                $date = date("Y-m-d");
                
                if($lista_creditos){
                    $table = "";
                    foreach($lista_creditos as $l){
                            $estado = $l["ESTADO"];
                            $limite = $l["FECHA_LIMITE"];
                            if($date > $l["FECHA_LIMITE"]){
                                $limite = "<span class='badge badge-danger'>{$l["FECHA_LIMITE"]}</span>";
                            }else{
                                $limite = "<span class='badge badge-success'>{$l["FECHA_LIMITE"]}</span>";
                            }
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'>PENDIENTE</span>";
                            }else if($estado == 0){
                                $estado = "<span class='badge badge-success'>PAGADO</span>";
                            }
                            $enlace = SERVERURL;
                            $cliente = strtoupper($l["RAZON"]);
                            $id_encryptado = mainModel::encryption($l["ID_VENTA"]);
                            $table .= "<tr>
                                <td>{$l["CODIGO_CREDITO"]}</td>
                                <td>{$l["FECHA_CREDITO"]}</td>
                                <td>{$l["NOMBRE_CREDITO"]}</td>
                                <td>{$cliente}</td>
                                <td>{$l["DOCUMENTO"]} {$l["N_DOCUMENTO"]}</td>
                                <td>{$l["MONTO_CREDITO"]}</td>
                                <td>{$l["MONTO_ABONADO"]}</td>
                                <td>{$l["MONTO_RESTANTE"]}</td>
                                <td>{$limite}</td>
                                <td>{$estado}</td>
                                <td>{$l["VENDEDOR"]}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>
    
                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle' id_v='{$l["ID_VENTA"]}' href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Venta
                                            </a>
                                            <a class='dropdown-item btn_enviar' id_v='{$l["ID_VENTA"]}' telefono='{$l["TELEFONO"]}'  url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                Enviar Whatsapp
                                        </a>
                                            <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                            VENTA (A4)
                                            </a>
                                            <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                            VENTA (A4 v2)
                                            </a>
                                            <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                            VENTA (A5)
                                            </a>
                                            <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    VENTA (TICKET)
                                            </a>
                                            <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    FACTURA
                                            </a>
                                            <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    VENTA (MEMBRETE)
                                                </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                        
                    }
                    echo $table;
                }
            }
        }
        function reporte_cuentas_cobrar(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date = date("Y-m-d");
                $date_1 = date("Y-m-d",strtotime($_POST["fecha_1"])); 
                $date_2 = date("Y-m-d",strtotime($_POST["fecha_2"]));
                $lista_creditos = $this->model->lista_creditos_fecha_sucursal($_POST["sucursal"],$date_1,$date_2);
                if($lista_creditos){
                    $table = "";
                    foreach($lista_creditos as $l){

                            
                                $estado = $l["ESTADO"];
                                $limite = $l["FECHA_LIMITE"];
                                if($date > $l["FECHA_LIMITE"]){
                                    $limite = "<span class='badge badge-danger'>{$l["FECHA_LIMITE"]}</span>";
                                }else{
                                    $limite = "<span class='badge badge-success'>{$l["FECHA_LIMITE"]}</span>";
                                }
                                if($estado == 1){
                                    $estado = "<span class='badge badge-info'>PENDIENTE</span>";
                                }else if($estado == 0){
                                    $estado = "<span class='badge badge-success'>PAGADO</span>";
                                }
                                $enlace = SERVERURL;
                                $cliente = strtoupper($l["RAZON"]);
                                $id_encryptado = mainModel::encryption($l["ID_VENTA"]);
                                $table .= "<tr>
                                    <td>{$l["CODIGO_CREDITO"]} </td>
                                    <td>{$l["FECHA_CREDITO"]}</td>
                                    <td>{$l["NOMBRE_CREDITO"]}</td>
                                    <td>{$cliente}</td>
                                    <td>{$l["DOCUMENTO"]} {$l["N_DOCUMENTO"]}</td>
                                    <td>{$l["MONTO_CREDITO"]}</td>
                                    <td>{$l["MONTO_ABONADO"]}</td>
                                    <td>{$l["MONTO_RESTANTE"]}</td>
                                    <td>{$limite}</td>
                                    <td>{$estado}</td>
                                    <td>{$l["VENDEDOR"]}</td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>
        
                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_v='{$l["ID_VENTA"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Venta
                                                </a>
                                                <a class='dropdown-item btn_enviar' id_v='{$l["ID_VENTA"]}' telefono='{$l["TELEFONO"]}'  url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                                                                <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>

                                                Enviar Whatsapp
                                        </a>
                                                <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                VENTA (A4)
                                                </a>
                                                <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                VENTA (A4 v2)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                VENTA (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        VENTA (TICKET)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        FACTURA
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    VENTA (MEMBRETE)
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>";
                                
                            
                        
                    }
                    echo $table;
                }
            }
        }
        function listaclientesselect(){
            $unidades = $this->model->lista_clientes();
            if($unidades){
                $n = 1;
                $option = "<option disabled selected>Seleccionar...</option>";
                foreach($unidades as $rows){
                    $razon = strtoupper($rows["RAZON"]);
                    $estado = $rows['ESTADO'];
                    if($estado == 1){
                        $option .="<option value='{$rows["ID_CLIENTE"]}'>{$razon} {$rows["DOCUMENTO"]} {$rows["N_DOCUMENTO"]}</option>";
                    }else{
                        $option .="<option value='{$rows["ID_CLIENTE"]}' disabled>{$razon} {$rows["DOCUMENTO"]} {$rows["N_DOCUMENTO"]}</option>";
                    }
                }
                return $option;
            }
        }
        function abonarcredito(){
            $this->view->lista_clientes = $this->listaclientesselect();
            $this->view->render("ventas/abonarcredito");
        }
        function buscar_credito_cliente(){
            if(isset($_POST["id_cliente"])){
                $lista_creditos = $this->model-> lista_creditos_sucursal($_POST["id_sucursal"]);
                if($lista_creditos){
                    $table = "";
                    foreach($lista_creditos as $row){
                        if($row["ID_CLIENTE"] == $_POST["id_cliente"]){
                            if($row["ESTADO"] == 1){
                                $date = date("Y-m-d");
                                $fechapago = date("Y-m-d",strtotime($row["FECHA_LIMITE"]));
                                $td_fecha = "<td style='color: #FF9800;font-weight: bold;'>{$fechapago}</td>";
                                if($date>$fechapago){
                                    $td_fecha = "<td style='color: #F44336;font-weight: bold;'>{$fechapago}</td>";
                                }
                                $cliente = strtoupper("{$row["RAZON"]}");
                                $table .= "
                                    <tr>
                                        <td style='color: #03A9F4;font-weight: bold;'>{$cliente}</td>
                                        {$td_fecha}
                                        <td style='color: #673AB7;font-weight: bold;'>{$row["CODIGO_CREDITO"]}</td>
                                        <td style='color: #673AB7;font-weight: bold;'>{$row["NOMBRE_CREDITO"]}</td>
                                        <td style='color: #673AB7;font-weight: bold;'>{$row["MONTO_CREDITO"]}</td>
                                        <td style='color: #F44336;font-weight: bold;'>{$row["MONTO_RESTANTE"]}</td>
                                        <td>
                                            <button class='btn btn-success mb-2 mr-2 btn_credito' id_credito='{$row["ID_CREDITO"]}' id_venta='{$row["ID_VENTA"]}'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check-circle'><path d='M22 11.08V12a10 10 0 1 1-5.93-9.14'></path><polyline points='22 4 12 14.01 9 11.01'></polyline></svg>
                                            </button>
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                    }
                    echo $table;
                }
            }
        }
        function infoabonocredito(){
            if(isset($_POST["id_credito"])){
                $informacion = $this->model->informacion_credito($_POST["id_credito"]);
                if($informacion){
                    $detalle = "";
                    foreach($informacion as $i){
                        $detalle .= "{$i["ID_CREDITO"]}|{$i["CODIGO_CREDITO"]}|{$i["NOMBRE_CREDITO"]}|{$i["MONTO_CREDITO"]}|{$i["MONTO_ABONADO"]}|{$i["MONTO_RESTANTE"]}|".strtoupper($i["RAZON"]);
                    }
                    echo "1|$detalle";
                }
            }
        }


        function lista_ventasrepor_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_ventas();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA_RESOLUCION"]));
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                                $sucursal_venta = $row["ID_SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_RESOLUCION"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $badge_tipo_pago = $row["TIPO_PAGO"];
                                if($badge_tipo_pago == 1){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo </span>";
                                }else if($badge_tipo_pago == 2){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Tarjeta Credito </span>";
                                }else{
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo & Tarjeta </span>";
                                }
                                if($sucursal == $sucursal_venta){
                                    $badge = $row["ESTADO"];
                                    if($badge == 1){
                                        $badge = "<span class='badge badge-success'> Contado </span>";
                                    }else if($badge == 2){
                                        $badge = "<span class='badge badge-info'> Credito </span>";
                                    }else if($badge == 4){
                                        $badge = "<span class='badge badge-success'> Credito Completado</span>";
                                    }else{
                                        $badge = "<span class='badge badge-danger'> Anulado </span>";
                                    }
                                    $cliente = strtoupper($row["RAZON"]);
                                    $table .= "
                                    <tr>
                                        <td>{$row["N_VENTA"]}</td>
                                        <td>{$row["COMPROBANTE"]} #{$row["NUMERO_COMPROBANTE"]}</td>
                                        <td>{$fecha_comprobante}</td>
                                        <td class='text-center'>{$badge_tipo_pago}</td>
                                        <td>{$row["DESCUENTO"]}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$cliente}</td>
                                        <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                        <td class='text-center'>{$badge}</td>
                                        <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>

                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_v='{$row["ID_VENTA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Venta
                                                    </a>
                                                    <a class='dropdown-item btn_enviar' id_v='{$row["ID_VENTA"]}' telefono='{$row["TELEFONO"]}'  url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                Enviar Whatsapp
                                        </a>
                                                    <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A5)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            {$row["COMPROBANTE"]} (TICKET)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            FACTURA
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        {$row["COMPROBANTE"]} (MEMBRETE)
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    ";
                                }
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }

        function ventasvendedor(){
            $this->view->render('ventas/ventasvendedor');
        }

        function reporte_ventas_detalle(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_ventas = $this->model->lista_ventas();
                $parametros = mainModel::parametros_sucursal($sucursal);
                $moneda = $parametros["MONEDA"];
                if($lista_ventas){
                    if($lista_ventas->rowCount()>0){
                        $table = "";
                        foreach($lista_ventas as $row){
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA_RESOLUCION"]));
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                                $sucursal_venta = $row["ID_SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_RESOLUCION"];
                                $badge_tipo_pago = $row["TIPO_PAGO"];
                                if($badge_tipo_pago == 1){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo </span>";
                                }else if($badge_tipo_pago == 2){
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Tarjeta Credito </span>";
                                }else{
                                    $badge_tipo_pago = "<span class='badge badge-primary'> Efectivo & Tarjeta </span>";
                                }
                                $lista_items = "";
                                $lista_items_ventas = $this->model->busqueda_item_venta($row["ID_VENTA"]);
                                foreach ($lista_items_ventas as $key => $value) {
                                    $lista_items .= "{$value["ARTICULO"]}, {$value["LINEA"]} - PRECIO. {$moneda} {$value["PRECIO"]} <span style='color:#FF5722;font-weight:bold;'>|</span> ";
                                }
                                if($sucursal == $sucursal_venta){
                                    $badge = $row["ESTADO"];
                                    if($badge == 1){
                                        $badge = "<span class='badge badge-success'> Contado </span>";
                                    }else if($badge == 2){
                                        $badge = "<span class='badge badge-info'> Credito </span>";
                                    }else{
                                        $badge = "<span class='badge badge-danger'> Anulado </span>";
                                    }
                                    $cliente = strtoupper($row["RAZON"]);
                                   $table .= "
                                        <tr>
                                            <td>{$row["N_VENTA"]}</td>
                                            <td>{$row["COMPROBANTE"]} #{$row["NUMERO_COMPROBANTE"]}</td>
                                            <td>{$fecha_comprobante}</td>
                                            <td>{$lista_items}</td>
                                            <td class='text-center'>{$badge_tipo_pago}</td>
                                           
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$cliente}</td>
                                            <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                            <td class='text-center'>{$badge}</td>
                                            <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                            <td class='text-center'>
                                                    <div class='dropdown dropup custom-dropdown-icon'>
                                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                        </a>

                                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                            <a class='dropdown-item btn_detalle' id_v='{$row["ID_VENTA"]}' href='javascript:void(0);'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                    Detalle Venta
                                                            </a>
                                                            <a class='dropdown-item btn_enviar' id_v='{$row["ID_VENTA"]}' telefono='{$row["TELEFONO"]}'  url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                Enviar Whatsapp
                                        </a>
                                                            <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            {$row["COMPROBANTE"]} (A4)
                                                            </a>
                                                            <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    {$row["COMPROBANTE"]} (A4 V2)
                                                    </a>
                                                            <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            {$row["COMPROBANTE"]} (A5)
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                    {$row["COMPROBANTE"]} (TICKET)
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                    FACTURA
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            {$row["COMPROBANTE"]} (MEMBRETE)
                                                        </a>
                                                        </div>
                                                    </div>
                                            </td>
                                        </tr>
                                   ";
                                }
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function reporte_ventas_vendedor(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $productos = $this->model->productos_vendidos_vendedor_porfecha_sucursal($date_1,$date_2,$sucursal);
                if($productos){
                    $lista_productos = "";
                    $n = 1;
                    foreach($productos as $p){
                        $imagen = SERVERURL."archives/assets/productos/{$p["IMAGEN"]}";
                        $lista_productos .="
                            <tr>
                                
                                <td style='color: #FF9800;font-weight: bolder;'>{$p["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td style='color: #1b55e2;font-weight: bolder;'>{$p["ARTICULO"]}</td>
                                <td style='color: #4CAF50;font-weight: bolder;'>{$p["LINEA"]}</td>
                                <td style='font-weight: bolder;'>{$p["FECHA_RESOLUCION"]}</td>
                                <td style='font-weight: bolder;'>{$p["LOTE"]}</td>
                                <td style='font-weight: bolder;'>{$p["COMPLEMENTO"]} {$p["PREFIJO"]} </td>
                                <td style='color: #FFC107;font-weight: bolder;'>{$p["CANT"]}</td>
                                <td style='color: #ff9c7c;font-weight: bolder;'>{$p["PRECIO"]}</td>
                                <td style='color: #ff9c7c;font-weight: bolder;'>{$p["DESCUENTOS"]}</td>
                                <td style='color: #ff9c7c;font-weight: bolder;'>{$p["SUBTOTALES"]}</td>
                                <td style='color: #FF5722;font-weight: bolder;'>{$p["TOTALES"]}</td>
                                <td style='color: #FF5722;font-weight: bolder;'>{$p["VENDEDOR"]}</td>
                            </tr>
                        ";
                        $n++;
                        
                    }
                    echo $lista_productos;
                }else{
                    echo 0;
                }
            }
        }
        function creditoscliente(){
            $this->view->lista_clientes = $this->listaclientesselect();
            $this->view->render('ventas/creditoscliente');
        }
        function creditoshistorial(){
            $this->view->lista_clientes = $this->listaclientesselect();
            $this->view->render('ventas/creditohistorial');
        }

        function reporte_creditos_cliente(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $sucursal = $_POST["sucursal"];
                $date1 = date("Y-m-d",strtotime($_POST["fecha_1"]));
                $date2 = date("Y-m-d",strtotime($_POST["fecha_2"]));
                $date = date("Y-m-d");
                $parametros = mainModel::parametros_sucursal($sucursal);
                $moneda = $parametros["MONEDA"];
                $lista_creditos = $this->model->lista_creditos_cliente($_POST["sucursal"],$_POST["producto"],$date1,$date2);
                if($lista_creditos){
                    $table = "";
                    foreach($lista_creditos as $l){
                        if($date > $l["FECHA_LIMITE"]){
                            $limite = "<span class='badge badge-danger'>{$l["FECHA_LIMITE"]}</span>";
                        }else{
                            $limite = "<span class='badge badge-success'>{$l["FECHA_LIMITE"]}</span>";
                        }
                        $estado = $l["ESTADO"];
                        $limite = $l["FECHA_LIMITE"];
                        if($estado == 1){
                            $estado = "<span class='badge badge-info'>PENDIENTE</span>";
                        }else{
                            $estado = "<span class='badge badge-success'>PAGADO</span>";
                        }
                        $lista_items = "";
                        $lista_items_ventas = $this->model->busqueda_item_venta($l["ID_VENTA"]);
                        foreach ($lista_items_ventas as $key => $value) {
                            $lista_items .= "{$value["ARTICULO"]}, {$value["LINEA"]} - PRECIO. {$moneda} {$value["PRECIO"]} <span style='color:#FF5722;font-weight:bold;'>|</span> ";
                        }
                        $enlace = SERVERURL;
                        $cliente = strtoupper($l["RAZON"]);
                        $id_encryptado = mainModel::encryption($l["ID_VENTA"]);
                        $table .= "<tr>
                            <td>{$l["CODIGO_CREDITO"]}</td>
                            <td>{$l["FECHA_CREDITO"]}</td>
                            <td>{$lista_items}</td>
                            <td>{$l["NOMBRE_CREDITO"]}</td>
                            <td>{$cliente}</td>
                            <td>{$l["DOCUMENTO"]} {$l["N_DOCUMENTO"]}</td>
                            <td>{$l["MONTO_CREDITO"]}</td>
                            <td>{$l["MONTO_ABONADO"]}</td>
                            <td>{$l["MONTO_RESTANTE"]}</td>
                            <td>{$limite}</td>
                            <td>{$estado}</td>
                            <td>{$l["VENDEDOR"]}</td>
                            <td class='text-center'>
                                <div class='dropdown dropup custom-dropdown-icon'>
                                    <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                    </a>

                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                        <a class='dropdown-item btn_detalle' id_v='{$l["ID_VENTA"]}' href='javascript:void(0);'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                Detalle Venta
                                        </a>
                                        <a class='dropdown-item btn_enviar' id_v='{$l["ID_VENTA"]}'   url='{$enlace}ventas/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                Enviar Whatsapp
                                        </a>
                                        <a class='dropdown-item'  href='{$enlace}ventas/formatoA4/{$id_encryptado}/' target='_blank'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                        VENTA (A4)
                                        </a>
                                        <a class='dropdown-item'  href='{$enlace}ventas/formatoA4V2/{$id_encryptado}/' target='_blank'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                        VENTA (A4 v2)
                                        </a>
                                        <a class='dropdown-item' href='{$enlace}ventas/formatoA5/{$id_encryptado}/' target='_blank'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                        VENTA (A5)
                                        </a>
                                        <a class='dropdown-item' href='{$enlace}ventas/ticket/{$id_encryptado}/' target='_blank'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                VENTA (TICKET)
                                        </a>
                                        <a class='dropdown-item' href='{$enlace}ventas/ticketqr/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        FACTURA
                                                </a>
                                        <a class='dropdown-item' href='{$enlace}ventas/membrete/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                VENTA (MEMBRETE)
                                            </a>
                                    </div>
                                </div>
                            </td>
                        </tr>";
                    
                        
                    }
                    echo $table;
                }
            }
        } 
        function generar_codigo_pago(){
            // cambiar funcion
            //$numero = $this->model->lista_pagos_credito();
            $numero = $this->model->lista_pagos_credito_count();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('COBRO',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_movimiento(){
            $numero = $this->model->lista_de_movimientos();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio("MOVI",4,$numero);
            }else{
                return 0; 
            }
        }
        function abono_credito(){
            if(isset($_POST["id_credito"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $codigo_usuario =  $_SESSION["usuario"];
                $id_caja = $_SESSION["caja"];
                $codigo_sucursal =  $_SESSION["sucursal"];

                $date_registro = date('Y-m-d H:i:s');
                $id_credito = $_POST["id_credito"];
                $parametros_credito_venta = mainModel::parametros_credito_venta($id_credito);
                
                $estado = $parametros_credito_venta["ESTADO"];
                if($estado == "1"){

                    $codigo_credito = $parametros_credito_venta["CODIGO_CREDITO"];
                    $id_venta = $parametros_credito_venta["ID_VENTA"];
                    $total = floatval($parametros_credito_venta["MONTO_CREDITO"]);
                    $pagado = floatval($parametros_credito_venta["MONTO_ABONADO"]);
                    $monto_restante = floatval($parametros_credito_venta["MONTO_RESTANTE"]);

                    $monto_abono = floatval($_POST["monto_abono"]);
                    $pago_con = floatval($_POST["pago_con"]);
                    $cambio = floatval($_POST["cambio"]);

                    $credito_pagado = floatval($pagado + $monto_abono);
                    $credito_pendiente = floatval($monto_restante - $monto_abono);
                    if($credito_pagado==$total){
                        $estado = 0;
                        $cambiar_estado = $this->model->cambiar_estado_venta_credito($id_venta);
                        if(!$cambiar_estado){
                            echo 5;
                        }
                    }else{
                        $estado = 1;
                    }
                    $id_pago = $this->generar_codigo_pago();
                    $abono = $this->model->abono_credito_de_venta($id_credito,$credito_pagado,$credito_pendiente,$estado);
                    if($abono){
                        $pago = $this->model->agregar_cobro_credito_de_venta($id_pago,$id_credito,$id_caja,$codigo_usuario,$codigo_sucursal,$monto_abono,$pago_con,$cambio,$date_registro,1,$credito_pendiente);
                        if(!$pago){
                            echo 3;
                        }
                        $codigomovimiento = $this->generar_codigo_movimiento();
                        $guardar_movimiento = $this->model->agregar_movimiento($codigomovimiento,$id_caja,'ABONO',"PAGO DE CREDITO {$codigo_credito}",$monto_abono,1,$date_registro);
                        if(!$guardar_movimiento){
                            echo 4;
                        }
                        echo "1|".mainModel::encryption($id_pago);
                    }
                }else{
                    echo 2;
                }
            }
        }
        function lista_items_venta_card(){
            if(isset($_POST["id_venta"])){
                $buscar_items_venta  = $this->model->busqueda_item_venta($_POST["id_venta"]);
                if($buscar_items_venta){
                    $response  = "";
                    if($buscar_items_venta->rowCount()>0){
                        foreach($buscar_items_venta as $row){
                            $imagen = SERVERURL . "archives/assets/productos/{$row["IMAGEN"]}";
                            $button = "
                            <button class='btn btn-outline-secondary btn-block'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                {$row["BARRA"]}
                            </button>";
                            $response .= "<div class='items' id_producto='{$row['ID_PRODUCTO']}' articulo = '{$row["ARTICULO"]}' id='item_{$row["ID_PRODUCTO"]}'>
                                <div class='item-content'>
                                    <div class='user-profile'>
                                        <img src='{$imagen}' alt='avatar' style='height: 100px;'>
                                        <div class='user-meta-info'>
                                            <p class='user-name' data-name='{$row["ARTICULO"]}' style='font-size: 14px;'>{$row["ARTICULO"]}</p>
                                            <p class='user-work' data-occupation='{$row["LINEA"]}'>{$row["LINEA"]}</p>
                                        </div>
                                    </div>
                                    <div class='code-bar'>
                                        {$button}
                                    </div>
                                    <div class='user-email'>
                                        <p class='usr-email-addr' style='margin: auto;font-weight:900;color: #607D8B;'>{$row["PRESENTACION"]}</p>
                                    </div>
                                    <div class='user-location mt-2'>
                                        <div id='iconsAccordion_{$row["ID_PRODUCTO"]}' class='accordion-icons' style='width: -webkit-fill-available;'>
                                            <div class='card'>
                                                <div class='card-header' id='headingOne3_{$row["ID_PRODUCTO"]}'>
                                                    <section class='mb-0 mt-0'>
                                                        <div role='menu' class='' data-toggle='collapse' data-target='#iconAccordionOne_{$row["ID_PRODUCTO"]}' aria-expanded='true' aria-controls='iconAccordionOne_{$row["ID_PRODUCTO"]}'>
                                                            <div class='accordion-icon'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-dollar-sign'><line x1='12' y1='1' x2='12' y2='23'></line><path d='M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6'></path></svg>
                                                                Precios
                                                                <div class='icons'>
                                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-up'><polyline points='18 15 12 9 6 15'></polyline></svg>
                                                                </div>
                                                            </div>
                                                    </section>
                                                </div>
                                        
                                                <div id='iconAccordionOne_{$row["ID_PRODUCTO"]}' class='collapse' aria-labelledby='headingOne3_{$row["ID_PRODUCTO"]}' data-parent='#iconsAccordion_{$row["ID_PRODUCTO"]}' style=''>
                                                    <div class='card-body'>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>PRECIO VENTA</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>SUBTOTAL</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio1_{$row["ID_PRODUCTO"]}' value='{$row["SUBTOTAL"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>DESCUENTO</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio2_{$row["ID_PRODUCTO"]}' value='{$row["DESCUENTO"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>TOTAL</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio3_{$row["ID_PRODUCTO"]}' value='{$row["TOTAL"]}' class='form-control'>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <span style='font-weight: 700;color: #3b3f5c;'>Cantidad</span>
                                    <div class='user-location'>
                                        <input type='text' id='cantidad_{$row["ID_PRODUCTO"]}' value='{$row["CANTIDAD"]}' class='form-control' disabled>
                                    </div>
                                </div>
                            </div>";
                        }
                        echo $response;
                    }
                }else{  
                    echo 0;
                }
            }
        }
        function consultaabonos(){
            $this->view->render("ventas/consultaabonos");
        }
        function lista_cobros_credito(){
            if(isset($_POST["sucursal"])){
                $lista_cobros = $this->model->lista_cobros_sucursal($_POST["sucursal"]);
                if($lista_cobros){
                    if($lista_cobros->rowCount()>0){
                        $table = "";
                        foreach($lista_cobros as $l){
                            $cliente = strtoupper("{$l["RAZON"]}");
                            $estado = $l["ESTADO_CREDITO"];
                            if($estado == 0){
                                $estado = "<span class='badge badge-success'>Completado</span>";
                            }else{
                                $estado = "<span class='badge badge-info'>Pendiente</span>";
                            }
                            $enlace = SERVERURL;
                            $table .= "
                                <tr>
                                    <td>{$l["FECHA_REGISTRO"]}</td>
                                    <td>{$l["CODIGO_CREDITO"]}</td>
                                    <td>{$l["N_VENTA"]}</td>
                                    <td>{$cliente} {$l["DOCUMENTO"]} {$l["N_DOCUMENTO"]}</td>
                                    <td>{$l["MONTO_CREDITO"]}</td>
                                    <td>{$l["PENDIENTE_AC"]}</td>
                                    <td>{$l["MONTO"]}</td>
                                    <td>{$l["PAGO_CON"]}</td>
                                    <td>{$l["CAMBIO"]}</td>
                                    <td>{$estado}</td>
                                    <td>{$l["VENDEDOR"]}</td>
                                    <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                    <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                    </a>

                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/ticketAbono/".mainModel::encryption($l["ID_COBRO"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                Ticket
                                        </a>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoCliente/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                Historial
                                        </a>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoCliente2/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                Historial 2
                                        </a>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoClienteV2/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                            Historial 3
                                        </a>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoClienteV2XLSX/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                            Historial 3 xlsx
                                        </a>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoClienteV4/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                            Historial 4
                                        </a>
                                        <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoClienteV4XLSX/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                            Historial 4 xlsx
                                        </a>
                                    </div>
                                </div>
                                
                                    </td>
                                </tr>
                            ";
                        }
                        echo $table;
                    }else{
                        echo 2;
                    }

                }else{
                    echo 3;
                }
            }
        }
        function lista_cobros_credito_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_cobros = $this->model->lista_cobros_sucursal($_POST["sucursal"]);
                if($lista_cobros){
                    if($lista_cobros->rowCount()>0){
                        $table = "";
                        foreach($lista_cobros as $l){
                            $cliente = strtoupper("{$l["RAZON"]}");
                            $fecha_comprobante = date("Y-m-d",strtotime($l["FECHA_REGISTRO"]));
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $estado = $l["ESTADO_CREDITO"];
                                if($estado == 0){
                                    $estado = "<span class='badge badge-success'>Completado</span>";
                                }else{
                                    $estado = "<span class='badge badge-info'>Pendiente</span>";
                                }
                                $enlace = SERVERURL;
                                $table .= "
                                    <tr>
                                        <td>{$l["FECHA_REGISTRO"]}</td>
                                        <td>{$l["CODIGO_CREDITO"]}</td>
                                        <td>{$l["N_VENTA"]}</td>
                                        <td>{$cliente} {$l["DOCUMENTO"]} {$l["N_DOCUMENTO"]}</td>
                                        <td>{$l["MONTO_CREDITO"]}</td>
                                        <td>{$l["PENDIENTE_AC"]}</td>
                                        <td>{$l["MONTO"]}</td>
                                        <td>{$l["PAGO_CON"]}</td>
                                        <td>{$l["CAMBIO"]}</td>
                                        <td>{$estado}</td>
                                        <td>{$l["VENDEDOR"]}</td>
                                        <td class='text-center'>
                                         <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
            
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/ticketAbono/".mainModel::encryption($l["ID_COBRO"])."'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Ticket
                                                    </a>
                                                    <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoCliente/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Historial
                                                    </a>
                                                    <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoCliente2/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Historial 2
                                                    </a>
                                                    <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoClienteV2/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Historial 3
                                                    </a>
                                                    <a class='dropdown-item ' target='_blank'  href='{$enlace}ventas/historialCreditoClienteV4/".mainModel::encryption($l["ID_CLIENTE"])."/".mainModel::encryption($_POST["sucursal"])."'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Historial 4
                                                    </a>
                                                
                                                </div>
                                            </div>
                                          
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                        echo $table;
                    }else{
                        echo 2;
                    }

                }else{
                    echo 3;
                }
            }
        }
        function generar_codigo_dosificacion(){
            $numero = $this->model->lista_libro_ventas();
            if($numero){
                $numero = $numero->rowCount()+1;
                return $numero;
                // return mainModel::generar_codigo_aleatorio('LIB',7,$numero);
            }else{
                return 0;
            }
        }
        function dosificacion_venta($codigo_venta,$nro_venta,$monto_a_pagar,$date_venta,$id_sucursal,$nit_cliente){
            require_once "view/assets/plugins/codecontrolfac/ControlCode.php";
            $controlCode = new controlcode();
            date_default_timezone_set('America/La_Paz');
             $consultar = $this->model->consultar_dosificacion($id_sucursal);
             $Llave_autorizacion = '';
    		$FechaLimite = '';
             if($consultar){
                if ($consultar->RowCount() > 0 ) {
    				foreach ($consultar as $rows) {
    					$Llave_autorizacion = $rows["LLAVE"];
    					$Numero_Autorizacion = $rows["NUMERO"];
    					$FechaLimite = $rows["FECHA"];
    					
    					
    				}
    			               
    
    			}
             }
             $date = explode('/', $FechaLimite);
             $FechaLimite = $date[2].''.$date[1].''.$date[0];
             $date_venta= 	str_replace('-','',$date_venta);
             $monto_a_pagar = strval(round($monto_a_pagar));
            $consultalibroventas = $this->model->lista_libro_ventas_sucursal($id_sucursal);
            $nro_dosificaciones = strval($consultalibroventas->rowCount()+1);
            $Codigo_Control= $controlCode->generate($Numero_Autorizacion, $nro_dosificaciones, $nit_cliente, $date_venta, $monto_a_pagar, $Llave_autorizacion);
            $id = $this->generar_codigo_dosificacion();
            $guardar_libro = $this->model->guardar_libro($id,$nro_dosificaciones,$FechaLimite,$Numero_Autorizacion,$Llave_autorizacion,$date_venta,$codigo_venta,$nro_venta,$monto_a_pagar,$Codigo_Control,$id_sucursal);
            if($guardar_libro){
                return 1;
            }else{
                return 2;
            }

        }
        function libroventas(){
            $this->view->render('ventas/libroventas');
        }
        function ventasivalibro(){
            if(isset($_POST['sucursal'])){
                $consultalibroventas = $this->model->lista_libro_ventas_sucursal($_POST['sucursal']);
                if($consultalibroventas){
                    $registros = "";
                    foreach($consultalibroventas as $p){
                        $estado = $p['ESTADO']==1?'V':'A';
                        $subtotal = number_format(round(floatval($p['SUBTOTAL'])+floatval($p['EXENTO'])+floatval($p['IVA']),1,PHP_ROUND_HALF_UP),2);
                        $descuento = number_format(round(floatval($p['DESCUENTO']),1,PHP_ROUND_HALF_UP),2);
                        $sub = number_format(round(floatval($subtotal)-floatval($descuento),1,PHP_ROUND_HALF_UP),2);
                        $iva = number_format(floatval($p['TOTAL'])*0.13,2);
                        $total = number_format(round(floatval($p['TOTAL']),1,PHP_ROUND_HALF_UP),2);
                         $FECHA = substr(utf8_decode($p["FECHA_EMISION"]),6,2)."/".substr(utf8_decode($p["FECHA_EMISION"]),4,2)."/".substr(utf8_decode($p["FECHA_EMISION"]),0,4);
                        $registros .= "
                        <tr>
                            <td>3</td>
                            <td>{$p['NRO_RESOLUCION']}</td>
                            <td>{$FECHA}</td>
                            <td>{$p['NRO_FACTURA']}</td>
                            <td>{$p['NRO_AUTORIZACION']}</td>
                            <td>{$estado}</td>
                            <td>{$p['N_DOCUMENTO']}</td>
                            <td>{$p['RAZON']}</td>
                            <td>{$subtotal}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{$subtotal}</td>
                            <td>{$descuento}</td>
                            <td>{$sub}</td>
                            <td>{$iva}</td>
                            <td>{$p['CODIGO_CONTROL']}</td>
                        </tr>";   
                    }
                    echo $registros;
                }else{
                    echo 0;
                }
            }
        }
        function lista_libroventas_fecha(){
            if(isset($_POST['sucursal'])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $consultalibroventas = $this->model->lista_libro_ventas_fecha_sucursal($_POST['sucursal'],$date_1,$date_2);
                if($consultalibroventas){
                    $registros = "";
                    foreach($consultalibroventas as $p){
                        $estado = $p['ESTADO']==1?'V':'A';
                        $subtotal = number_format(round(floatval($p['SUBTOTAL'])+floatval($p['EXENTO'])+floatval($p['IVA']),1,PHP_ROUND_HALF_UP),2);
                        $descuento = number_format(round(floatval($p['DESCUENTO']),1,PHP_ROUND_HALF_UP),2);
                        $sub = number_format(round(floatval($subtotal)-floatval($descuento),1,PHP_ROUND_HALF_UP),2);
                        $iva = number_format(floatval($p['TOTAL'])*0.13,2);
                        $total = number_format(round(floatval($p['TOTAL']),1,PHP_ROUND_HALF_UP),2);
                        $FECHA = substr(utf8_decode($p["FECHA_EMISION"]),6,2)."/".substr(utf8_decode($p["FECHA_EMISION"]),4,2)."/".substr(utf8_decode($p["FECHA_EMISION"]),0,4);
                        $registros .= "
                        <tr>
                            <td>3</td>
                            <td>{$p['NRO_RESOLUCION']}</td>
                            <td>{$FECHA}</td>
                            <td>{$p['NRO_FACTURA']}</td>
                            <td>{$p['NRO_AUTORIZACION']}</td>
                            <td>{$estado}</td>
                            <td>{$p['N_DOCUMENTO']}</td>
                            <td>{$p['RAZON']}</td>
                            <td>{$subtotal}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{$subtotal}</td>
                            <td>{$descuento}</td>
                            <td>{$sub}</td>
                            <td>{$iva}</td>
                            <td>{$p['CODIGO_CONTROL']}</td>
                        </tr>";   
                    }
                    echo $registros;
                }else{
                    echo 0;
                }
            }
        }
        function ticketqr($param=null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_libro  = $this->model->buscar_libro($id);
                if($buscar_libro->rowCount()>0){
                    $buscar_venta  = $this->model->busqueda_venta($id);
                    $response  = "";
                    if($buscar_venta){
                        if($buscar_venta->rowCount()>0){
                            foreach($buscar_venta as $row){
                                $tipo_pago = "{$row["ESTADO"]}";
                                if($tipo_pago == 1){
                                    $tipo_pago = "CONTADO";
                                }else{
                                    $tipo_pago = "CREDITO";
                                }
                                $metodo_pago = "{$row["TIPO_PAGO"]}";
                                if($metodo_pago == 1){
                                    $metodo_pago = "EFECTIVO";
                                }else if($metodo_pago == 2){
                                    $metodo_pago = "TARJETA CREDITO/DEBITO";
                                }else if($metodo_pago == 3){
                                    $metodo_pago = "EFECTIVO Y TARJETA";
                                }
                                $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}"; 
                            }
                        }
                    }else{  
                        echo 0;
                    }
                    $res_array = explode("|",$response);
                    $this->view->parametros_venta = $response;
                    $this->view->id_venta = $id;
                    $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                    $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                    $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                    $this->view->lista_items = $this->model->busqueda_item_venta($id);
                    $this->view->parametros_libro_venta =  mainModel::parametros_libro_venta($id);
                    $this->view->render("ventas/ticketqr");
                    
                }else{
                    $this->view->render("error/404");
                }
            }else{
                $this->view->render("error/404");
            }
            
            
             
        }
        function qr($param=null){
            require_once("view/assets/plugins/phpqrcode/qrlib.php");

            QRcode::png($param[0]."/".$param[1]."/".$param[2]);
        }
        function validarcodigo(){
            $this->view->render("ventas/validarcodigo");
        }
        function validarcodigocontrol(){
            if(isset($_POST["txt_autorizacion"])&&isset($_POST["txt_total"])&&isset($_POST["txt_dosificacion"])&&isset($_POST["txt_nit"])&&isset($_POST["txt_factura"])){
                 date_default_timezone_set('America/La_Paz');
                require_once "view/assets/plugins/codecontrolfac/ControlCode.php";
                $Numero_Autorizacion = strval($_POST["txt_autorizacion"]);
                $Numero_Factura = strval($_POST["txt_factura"]);
                $Nit_Cliente = strval($_POST["txt_nit"]);
                $Fecha_emision_factura = date("Y/m/d",strtotime($_POST["txt_fecha"]));
                $Fecha_emision_factura= 	strval(str_replace('/','',$Fecha_emision_factura));
                $Total_Transaccion = strval(round($_POST["txt_total"]));
                $Llave_autorizacion =  strval($_POST["txt_dosificacion"]);
                $controlCode = new controlCode(); // instaciamos nuestro objeto para acceder a nuestra funcion
            	$Codigo_Control= $controlCode->generate($Numero_Autorizacion,$Numero_Factura,$Nit_Cliente,$Fecha_emision_factura,$Total_Transaccion,$Llave_autorizacion);
                echo $Codigo_Control;
            }else{
                echo "0";
            }
                
        }
        function historialCreditoClienteV2($param=null){
            if($param==null){
                $this->view->render("error/404");
            }
            $cliente = mainModel::decryption($param[0]);
            $sucursal = mainModel::decryption($param[1]);
            // echo $cliente.PHP_EOL;
            // echo $sucursal.PHP_EOL;
            $lista = $this->model->historial_creditos_cliente($sucursal,$cliente);
            // echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));

            $this->view->parametros_cliente = mainModel::parametros_cliente($cliente);
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($sucursal);
            $this->view->creditos = $lista;
      
            $this->view->render("ventas/historialcredito_v2");
        }
        function historialCreditoClienteV4($param=null){
            if($param==null){
                $this->view->render("error/404");
            }
            $cliente = mainModel::decryption($param[0]);
            $sucursal = mainModel::decryption($param[1]);
            // echo $cliente.PHP_EOL;
            // echo $sucursal.PHP_EOL;
            $lista = $this->model->historial_creditos_cliente($sucursal,$cliente);
            // echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));

            $this->view->parametros_cliente = mainModel::parametros_cliente($cliente);
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($sucursal);
            $this->view->creditos = $lista;
      
            $this->view->render("ventas/historialcredito_v4");
        }

        function historialCreditoClienteV2XLSX($param=null) {
            if($param==null){
                $this->view->render("error/404");
            }
            $cliente = mainModel::decryption($param[0]);
            $sucursal = mainModel::decryption($param[1]);
            // echo $cliente.PHP_EOL;
            // echo $sucursal.PHP_EOL;
            $lista = $this->model->historial_creditos_cliente($sucursal,$cliente);
            // echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));

            $this->view->parametros_cliente = mainModel::parametros_cliente($cliente);
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($sucursal);
            $this->view->creditos = $lista;
      
            $this->view->render("ventas/historialcredito_v2_excel");
        }
        function notaVentaExcel($param=null) {
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_venta  = $this->model->busqueda_venta($id);
                $response  = "";
                if($buscar_venta){
                    if($buscar_venta->rowCount()>0){
                        foreach($buscar_venta as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $metodo_pago = "{$row["TIPO_PAGO"]}";
                            if($metodo_pago == 1){
                                $metodo_pago = "EFECTIVO";
                            }else if($metodo_pago == 2){
                                $metodo_pago = "TARJETA CREDITO/DEBITO";
                            }else if($metodo_pago == 3){
                                $metodo_pago = "EFECTIVO Y TARJETA";
                            }
                            $response .= "{$row["FECHA_RESOLUCION"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_VENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["COMPROBANTE"]}|{$row["NUMERO_COMPROBANTE"]}|{$metodo_pago}|{$row["PAGO_EFECTIVO"]}|{$row["CAMBIO"]}|{$row["PAGO_TARJETA"]}||{$row["NUMERO_TARJETA"]}|{$row["TARJETA_HABITANTE"]}|{$row["OBSERVACION"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_venta = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->busqueda_item_venta2($id);
                $this->view->render("ventas/notaventa_excel");
                // var_dump($this->view->lista_items->fetchAll());
            }else{
                $this->view->render("error/404");
            }
        }
        function historialCreditoClienteV4XLSX($param=null) {
            if($param==null){
                $this->view->render("error/404");
            }
            $cliente = mainModel::decryption($param[0]);
            $sucursal = mainModel::decryption($param[1]);
            // echo $cliente.PHP_EOL;
            // echo $sucursal.PHP_EOL;
            $lista = $this->model->historial_creditos_cliente($sucursal,$cliente);
            // echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));
            $this->view->parametros_cliente = mainModel::parametros_cliente($cliente);
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($sucursal);
            $this->view->creditos = $lista;
            $this->view->render("ventas/historialcredito_v4_excel");
        }
        function historialCreditoCliente($param=null){
            if($param==null){
                $this->view->render("error/404");
            }
            $cliente = mainModel::decryption($param[0]);
            $sucursal = mainModel::decryption($param[1]);
            // echo $cliente.PHP_EOL;
            // echo $sucursal.PHP_EOL;
            $lista = $this->model->historial_creditos_cliente($sucursal,$cliente);
            // echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));

            $this->view->parametros_cliente = mainModel::parametros_cliente($cliente);
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($sucursal);
            $this->view->creditos = $lista;
      
            $this->view->render("ventas/historialcredito");
        }
        function historialCreditoCliente2($param=null){
            if($param==null){
                $this->view->render("error/404");
            }
            $cliente = mainModel::decryption($param[0]);
            $sucursal = mainModel::decryption($param[1]);
            // echo $cliente.PHP_EOL;
            // echo $sucursal.PHP_EOL;
            $lista = $this->model->historial_creditos_cliente($sucursal,$cliente);
            // echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));

            $this->view->parametros_cliente = mainModel::parametros_cliente($cliente);
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($sucursal);
            $this->view->creditos = $lista;
      
            $this->view->render("ventas/historialcredito2");
        }

/* ========================================================================== */
/*           Historial Reportes al Contado y Credito                          */
/* ========================================================================== */
        function reportecc(){
            $this->view->render('ventas/reportecc');
        }
        function consultapagospendientes(){
            $this->view->lista_vendedores = $this->lista_personas_option();
            $this->view->lista_metodopago = $this->lista_metodopago();
            $this->view->render('ventas/consultapagospendientes');
        }

        function listaReportesCC() {
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_ventas_detail();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $key => $row){
                            $sucursal_venta = $row["ID_SUCURSAL"];
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA_RESOLUCION"]));
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_VENTA"]);
                                $sucursal_venta = $row["ID_SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_RESOLUCION"];
                                if($sucursal == $sucursal_venta){
                                    $badge = $row["ESTADO"];
                                    $pago_cuenta = "";
                                    $saldo_pagar = "";
                                    if($badge == 1){
                                        //Monto
                                        $saldo_pagar = $row["TOTAL"];
                                    }else if($badge == 2){
                                        //CREDITO
                                        $pago_cuenta = $row["PAGO_TARJETA"];
                                        $saldo_pagar = floatval($row["TOTAL"]) - floatval($pago_cuenta);
                                    }
                                    $cliente = strtoupper($row["RAZON"]);
                                    /*foreach($lista_items_venta as $key_item => $item) {
                                        $total = "";
                                        if(++$key_item === $count_items) {
                                            $total = $row['TOTAL'];
                                        }
                                        $table .= "
                                            <tr>
                                                <td>{$key}</td>
                                                <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                                <td>{$row["N_VENTA"]}</td>
                                                <td>{$item["CANTIDAD"]}</td>
                                                <td>{$item["TOTAL"]}</td>
                                                <td>{$pago_cuenta}</td>
                                                <td>{$saldo_pagar}</td>
                                                <td>{$total}</td>
                                            </tr>
                                        ";
                                    }*/
                                    $medida = $row["MEDIDA"];
                                    $stock_medida = 0;
                                    if($medida == $row["MEDIDA_1"]){
                                        $stock_medida = $row["STOCK_1"];
                                    }
                                    if($medida == $row["MEDIDA_2"]){
                                        $stock_medida = $row["STOCK_2"];
                                    }
                                    if($medida == $row["MEDIDA_3"]){
                                        $stock_medida = $row["STOCK_3"];
                                    }
                                    if($medida == $row["MEDIDA_4"]){
                                        $stock_medida = $row["STOCK_4"];
                                    }
                                    if($medida == $row["MEDIDA_5"]){
                                        $stock_medida = $row["STOCK_5"];
                                    }
                                    if($medida == $row["MEDIDA_6"]){
                                        $stock_medida = $row["STOCK_6"];
                                    }
                                    if($medida == $row["MEDIDA_7"]){
                                        $stock_medida = $row["STOCK_7"];
                                    }
                                    $cantidad = floor($row["CANTIDAD"]/$stock_medida);
                                    $table .= "
                                        <tr>
                                            <td>{$key}</td>
                                            <td>{$row["RAZON"]}</td>
                                            <td>{$row["N_VENTA"]}</td>
                                            <td>{$cantidad} {$medida}</td>
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$pago_cuenta}</td>
                                            <td>{$saldo_pagar}</td>
                                            <td>{$row["TOTAL"]}</td>
                                        </tr>
                                    ";
                                }
                            }
                        }
                        echo $table;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        public function lista_productos_sucursal_traspaso_json()
        {
            // if (isset($_POST["id"])) {
                $almacen = $_POST["id_almacen"];
                $lista_productos = $this->model->lista_productos_sucursal_almacen_2($almacen);
                if ($lista_productos) {
                    echo json_encode($lista_productos->fetchAll(PDO::FETCH_ASSOC));
                }
            // }
        }
    }

