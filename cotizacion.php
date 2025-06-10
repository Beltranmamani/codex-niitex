<?php
    class cotizacion extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                          Vista de nueva cotizacion                         */
/* ========================================================================== */

        function render(){
            $this->view->lista_documentos = $this::lista_documentos();
            $this->view->render('cotizacion/index');
        }
        
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
/*                        Funcion de guardar cotizacion                       */
/* ========================================================================== */

        function guardar_cotizacion(){
            if(isset($_POST["id_cliente"])){
                session_name('B_POS');
                session_start();
                date_default_timezone_set(ZONEDATE);

/* ------------------ Precios recibidos desde la cotización ----------------- */
                
                $suma_price = floatval($_POST["suma_price"]);
                $cant_iva = floatval($_POST["cant_iva"]);
                $sub_total_price = floatval($_POST["sub_total_price"]);
                $retencion_price = floatval($_POST["retencion_price"]);
                $exento_price = floatval($_POST["exento_price"]);
                $n_exento = floatval($_POST["n_exento"]);
                $monto_a_pagar = floatval($_POST["monto_a_pagar"]);
                $descuento_percent = floatval($_POST["descuento_percent"]);
                $precio_descuento = floatval($_POST["precio_descuento"]);

/* ---------------------------- Datos del cliente --------------------------- */
                $id_cliente = $_POST["id_cliente"];

/* -------------------- Datos del vendedor y la sucursal -------------------- */
                $usuario = $_SESSION["usuario"];
                $sucursal = $_SESSION["sucursal"];

/* ------------------------- Datos de la cotizacion ------------------------- */
                $codigo_cotizacion = $this->generar_codigo_cotizacion();
                $nro_cotizacion = $this->generar_numero_cotizacion($sucursal);
                $date = date('Y-m-d H:i:s');
                $tipo_pago = $_POST["tipo_pago"];
                $tipo_entrega = $_POST["tipo_entrega"];
                $precio_radio = $_POST["precio_radio"];
                $nrofactura = $_POST["nrofactura"];
                $nombrepromotor = $_POST["nombrepromotor"];

                $guardar_cotizacion = $this->model->guardar_cotizacion(
                    $codigo_cotizacion,$nro_cotizacion,$date,$tipo_pago,$tipo_entrega,$suma_price,$cant_iva,$exento_price,
                    $sub_total_price,$retencion_price,$precio_descuento,$descuento_percent,$monto_a_pagar,$n_exento,1,$id_cliente,$usuario,$sucursal,$precio_radio,$nrofactura,$nombrepromotor
                );
                if($guardar_cotizacion){
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
                        $id_detalle = $this->generar_codigo_detalle_cotizacion();

                        $p_id_item = $producto[0];
                        $cantidad = $producto[2]; 
                        $cantidad = $producto[2] * $producto[14];/// modifica la cantidad aqui de acuerdo a la medida
                        $descuento_percent = $producto[3];
                        $precio = $producto[4];
                        $descuento_producto = $producto[5];
                        $sub_total_producto_ = $producto[6];
                        $total_producto = $producto[7];
                        $precio_1 = $producto[10];
                        $precio_2 = $producto[11];
                        $precio_3 = $producto[12];
                        $precio_4 = $producto[13];
                        $medida = $producto[15];
                        $precio_radio = $producto[16];
                        $precio_5 = $producto[17];
                        $precio_6 = $producto[18];
                        $precio_7 = $producto[19];
                        $guardar_detalle = $this->model->guardar_detalle_cotizacion($id_detalle,$p_id_item,$codigo_cotizacion,$cantidad,$precio,$descuento_producto,$sub_total_producto_,$total_producto,$descuento_percent,$precio_1,$precio_2,$precio_3,$precio_4,$medida,$precio_radio,$precio_5,$precio_6,$precio_7);
                        if(!$guardar_detalle){
                            echo 2;
                        }
                    }
                    echo "1|".mainModel::encryption($codigo_cotizacion);
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                       Generar codigo de la cotizacion                      */
/* ========================================================================== */

        function generar_codigo_cotizacion(){
            $numero = $this->model->lista_cotizaciones();
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<9){
                //     return "COTI000000".$numero;
                // }else if($numero<99){
                //     return "COTI00000".$numero;
                // }else if($numero<999){
                //     return "COTI0000".$numero;
                // }if($numero<9999){
                //     return "COTI000".$numero;
                // }if($numero<99999){
                //     return "COTI00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                   Generar codigo de detalle de cotizacion                  */
/* ========================================================================== */

        function generar_codigo_detalle_cotizacion(){
            $numero = $this->model->lista_detalle_cotizacion(); 
            if($numero){
                $numero = $numero->rowCount()+1; 
                // return "DETA".str_pad($numero, 16, "0", STR_PAD_LEFT);
                return $numero;
            }else{ 
                return 0;
            }
        }

/* ========================================================================== */
/*                        Generar numero de cotizacion                        */
/* ========================================================================== */

        function generar_numero_cotizacion($sucursal){
            $numero = $this->model->lista_cotizaciones_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<9){
                //     return "COT000000".$numero;
                // }else if($numero<99){
                //     return "COT00000".$numero;
                // }else if($numero<999){
                //     return "COT0000".$numero;
                // }if($numero<9999){
                //     return "COT000".$numero;
                // }if($numero<99999){
                //     return "COT00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                        Vista consultar cotizaciones                        */
/* ========================================================================== */

        function consultacotizacion(){
            $this->view->render("cotizacion/consultacotizacion");
        }
        
/* ========================================================================== */
/*                            Lista de cotizaciones                           */
/* ========================================================================== */

        function lista_cotizaciones(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                $lista_cotizaciones = $this->model->lista_cotizaciones_sucursal($sucursal);
                if($lista_cotizaciones){
                    if($lista_cotizaciones->rowCount()>0){
                        $table = "";
                        foreach($lista_cotizaciones as $row){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_COTIZACION"]);
                            $fecha_cotizacion = $row["FECHA"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            $badge = $row["TIPO_PAGO"];
                            if($badge == 1){
                                $badge = "<span class='badge badge-success'> Contado </span>";
                            }else{
                                $badge = "<span class='badge badge-info'> Credito </span>";
                            }
                            $procesar = "<a class='dropdown-item' href='{$enlace}cotizacion/procesarVenta/{$id_encryptado}/' >
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>                                                       
                                Procesar a venta
                            </a>";
                            $estado = $row["ESTADO"];
                            $anular = "";
                            if($estado == "1"){
                                $anular = " <a class='dropdown-item btn_anular' id_cotizacion='{$row["ID_COTIZACION"]}' href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                    Anular Cotizacion
                                            </a>";
                                $estado = "<span class='badge badge-info'> COTIZACION </span>";
                            }else if($estado == "0"){
                                $estado = "<span class='badge badge-danger'> ANULADO </span>";
                                $procesar = "";
                            }else{
                                $estado = "<span class='badge badge-success'> VENTA </span>";
                                $procesar = "";
                            }
                            $badge_tipo_entrega = $row["TIPO_ENTREGA"];
                            if($badge_tipo_entrega == 1){
                                $badge_tipo_entrega = "<span class='badge badge-primary'> Inmediata </span>";
                            }else{
                                $badge_tipo_entrega = "<span class='badge badge-primary'> Por envio </span>";
                            }
                            $vendedor = strtoupper("{$row["NOMBRES"]} {$row["APELLIDOS"]}");
                            $table .= "
                            <tr>
                                <td>{$row["CODIGO_COTIZACION"]}</td>
                                <td>{$fecha_cotizacion}</td> 
                                <td class='text-center'>{$badge}</td>
                                <td style='font-weight: bold;color: #2196F3;'>{$row["TOTAL"]}</td>
                                <td>{$row["RAZON"]}</td>
                                <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                <td class='text-center'>{$badge_tipo_entrega}</td>
                                <td style='font-weight: bold;color: #FF9800;'>{$vendedor}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <div class='dropdown dropup custom-dropdown-icon'>
                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                        </a>

                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                            <a class='dropdown-item btn_detalle' id_c='{$row["ID_COTIZACION"]}' href='javascript:void(0);'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Cotización
                                            </a>
                                            {$procesar}
                                            <a class='dropdown-item btn_enviar' id_v='{$row["ID_COTIZACION"]}'  telefono='{$row["TELEFONO"]}' url='{$enlace}cotizacion/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                        Enviar Whatsapp
                                                </a>
                                            <a class='dropdown-item' href='{$enlace}cotizacion/formatoA4/{$id_encryptado}/' target='_blank' >
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    COTIZACION (A4)
                                            </a>
                                            <a class='dropdown-item' href='{$enlace}cotizacion/formatoA5/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    COTIZACION (A5)
                                            </a>
                                            <a class='dropdown-item' href='{$enlace}cotizacion/membrete/{$id_encryptado}/' target='_blank'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    MEMBRETE
                                            </a>
                                           {$anular}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            ";
                            
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
/*                       Lista de cotizaciones por fecha                      */
/* ========================================================================== */

        function lista_cotizaciones_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_cotizaciones = $this->model->lista_cotizaciones_sucursal($sucursal);
                if($lista_cotizaciones){
                    if($lista_cotizaciones->rowCount()>0){
                        $table = "";
                        foreach($lista_cotizaciones as $row){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_COTIZACION"]);
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA"]));
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $fecha_cotizacion = $row["FECHA"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $badge = $row["TIPO_PAGO"];
                                if($badge == 1){
                                    $badge = "<span class='badge badge-success'> Contado </span>";
                                }else{
                                    $badge = "<span class='badge badge-info'> Credito </span>";
                                }
                                $procesar = "<a class='dropdown-item' href='{$enlace}cotizacion/procesarVenta/{$id_encryptado}/' >
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>                                                       
                                    Procesar a venta
                                </a>";
                                $estado = $row["ESTADO"];
                                $anular = "";
                                if($estado == "1"){
                                    $anular = " <a class='dropdown-item btn_anular' id_cotizacion='{$row["ID_COTIZACION"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                        Anular Cotizacion
                                                </a>";
                                    $estado = "<span class='badge badge-info'> COTIZACION </span>";
                                }else if($estado == "0"){
                                    $estado = "<span class='badge badge-danger'> ANULADO </span>";
                                    $procesar = "";
                                }else{
                                    $estado = "<span class='badge badge-success'> VENTA </span>";
                                    $procesar = "";
                                }
                                $badge_tipo_entrega = $row["TIPO_ENTREGA"];
                                if($badge_tipo_entrega == 1){
                                    $badge_tipo_entrega = "<span class='badge badge-primary'> Inmediata </span>";
                                }else{
                                    $badge_tipo_entrega = "<span class='badge badge-primary'> Por envio </span>";
                                }
                                $vendedor = strtoupper("{$row["NOMBRES"]} {$row["APELLIDOS"]}");
                                $table .= "
                                <tr>
                                    <td>{$row["CODIGO_COTIZACION"]}</td>
                                    <td>{$fecha_cotizacion}</td> 
                                    <td class='text-center'>{$badge}</td>
                                    <td style='font-weight: bold;color: #2196F3;'>{$row["TOTAL"]}</td>
                                    <td>{$row["RAZON"]}</td>
                                    <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                    <td class='text-center'>{$badge_tipo_entrega}</td>
                                    <td style='font-weight: bold;color: #FF9800;'>{$vendedor}</td>
                                    <td class='text-center'>{$estado}</td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>

                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_c='{$row["ID_COTIZACION"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Cotización
                                                </a>
                                                {$procesar}
                                                <a class='dropdown-item btn_enviar' id_v='{$row["ID_COTIZACION"]}'  telefono='{$row["TELEFONO"]}' url='{$enlace}cotizacion/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                        Enviar Whatsapp
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}cotizacion/formatoA4/{$id_encryptado}/' target='_blank' >
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        COTIZACION (A4)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}cotizacion/formatoA5/{$id_encryptado}/'  target='_blank' >
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        COTIZACION (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}cotizacion/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        MEMBRETE
                                                </a>
                                                {$anular}
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

/* ========================================================================== */
/*                        Vista cotizaciones por fecha                        */
/* ========================================================================== */

        function cotizacionporfecha(){            
            $this->view->render("cotizacion/cotizacionxfecha");
        }

/* ========================================================================== */
/*                      Reporte de cotizaciones por fecha                     */
/* ========================================================================== */

        function reporte_cotizaciones_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_cotizaciones = $this->model->lista_cotizaciones_sucursal($sucursal);
                if($lista_cotizaciones){
                    if($lista_cotizaciones->rowCount()>0){
                        $table = "";
                        foreach($lista_cotizaciones as $row){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_COTIZACION"]);
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA"]));
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $fecha_cotizacion = $row["FECHA"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $badge = $row["TIPO_PAGO"];
                                if($badge == 1){
                                    $badge = "<span class='badge badge-success'> Contado </span>";
                                }else{
                                    $badge = "<span class='badge badge-info'> Credito </span>";
                                }
                                $badge_tipo_entrega = $row["TIPO_ENTREGA"];
                                if($badge_tipo_entrega == 1){
                                    $badge_tipo_entrega = "<span class='badge badge-primary'> Inmediata </span>";
                                }else{
                                    $badge_tipo_entrega = "<span class='badge badge-primary'> Por envio </span>";
                                }
                                $estado = $row["ESTADO"];
                               
                                if($estado == "1"){
                                    
                                    $estado = "<span class='badge badge-info'> COTIZACION </span>";
                                }else if($estado == "0"){
                                    $estado = "<span class='badge badge-danger'> ANULADO </span>";
                                   
                                }else{
                                    $estado = "<span class='badge badge-success'> VENTA </span>";
                                    
                                }
                                $table .= "
                                <tr>
                                    <td>{$row["CODIGO_COTIZACION"]}</td>
                                    <td>{$fecha_cotizacion}</td> 
                                    <td class='text-center'>{$badge}</td>
                                    <td>{$row["TOTAL"]}</td>
                                    <td>{$row["RAZON"]}</td>
                                    <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                    <td class='text-center'>{$badge_tipo_entrega}</td>
                                    <td class='text-center'>{$estado}</td>
                                    <td>
                                        <div class='d-flex'>
                                            <div class='usr-img-frame mr-2 rounded-circle'>
                                                <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}'>
                                            </div>
                                            <p class='align-self-center mb-0'>{$row["NOMBRES"]}</p>
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>

                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_c='{$row["ID_COTIZACION"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Cotización
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}cotizacion/formatoA4/{$id_encryptado}/' target='_blank' >
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        COTIZACION (A4)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}cotizacion/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        COTIZACION (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}cotizacion/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        MEMBRETE
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

/* ========================================================================== */
/*                        Funcion detalle de cotizacion                       */
/* ========================================================================== */

        function detalle_cotizacion(){
            if(isset($_POST["id"])){
                $cotizacion = $_POST["id"];
                $buscar_compra  = $this->model->detalle_cotizacion($cotizacion);
                if($buscar_compra){
                    $response  = "";
                    if($buscar_compra->rowCount()>0){
                        foreach($buscar_compra as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $response .= "{$row["FECHA"]}|{$tipo_pago}|{$row["RAZON"]}|{$row["DOCUMENTO"]}|{$row["N_DOCUMENTO"]}|{$row["CODIGO_COTIZACION"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}"; 
                        }
                        echo "1|$response";
                    }
                }else{  
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                   Funcion lista de items en la cotizacion                  */
/* ========================================================================== */

        function detallecotizacion_item(){
            if(isset($_POST["id"])){
                $cotizacion = $_POST["id"];
                $buscar_items_cotizacion  = $this->model->detalle_items_cotizacion($cotizacion);
                if($buscar_items_cotizacion){
                    $response  = "";
                    if($buscar_items_cotizacion->rowCount()>0){
                        foreach($buscar_items_cotizacion as $row){
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
/*                      Imprimir cotizacion en formato A4                     */
/* ========================================================================== */

        function formatoA4($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_cotizacion  = $this->model->detalle_cotizacion($id);
                $response  = "";
                if($buscar_cotizacion){
                    if($buscar_cotizacion->rowCount()>0){
                        foreach($buscar_cotizacion as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $tipo_entrega = "{$row["TIPO_ENTREGA"]}";
                            if($tipo_entrega == 1){
                                $tipo_entrega = "INMEDIATA";
                            }else{
                                $tipo_entrega = " POR ENVIO";
                            }
                            $response .= "{$row["FECHA"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["CODIGO_COTIZACION"]}|{$tipo_entrega}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_cotizacion = $response;
                $this->view->id_cotizacion = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->detalle_items_cotizacion($id);
                $this->view->render("cotizacion/formatoA4");
            }else{
                $this->view->render("error/404");
            }
        }
        function membrete($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_cotizacion  = $this->model->detalle_cotizacion($id);
                $response  = "";
                if($buscar_cotizacion){
                    if($buscar_cotizacion->rowCount()>0){
                        foreach($buscar_cotizacion as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $tipo_entrega = "{$row["TIPO_ENTREGA"]}";
                            if($tipo_entrega == 1){
                                $tipo_entrega = "INMEDIATA";
                            }else{
                                $tipo_entrega = " POR ENVIO";
                            }
                            $response .= "{$row["FECHA"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["CODIGO_COTIZACION"]}|{$tipo_entrega}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_cotizacion = $response;
                $this->view->id_cotizacion = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->detalle_items_cotizacion($id);
                $this->view->p_cotizacion = mainModel::parametros_cotizacion($id);
                $this->view->render("cotizacion/membrete");
            }else{
                $this->view->render("error/404");
            }
        }

/* ========================================================================== */
/*                      Imprimir cotizacion en formato A5                     */
/* ========================================================================== */

        function formatoA5($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_cotizacion  = $this->model->detalle_cotizacion($id);
                $response  = "";
                if($buscar_cotizacion){
                    if($buscar_cotizacion->rowCount()>0){
                        foreach($buscar_cotizacion as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $tipo_entrega = "{$row["TIPO_ENTREGA"]}";
                            if($tipo_entrega == 1){
                                $tipo_entrega = "INMEDIATA";
                            }else{
                                $tipo_entrega = " POR ENVIO";
                            }
                            $response .= "{$row["FECHA"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["CODIGO_COTIZACION"]}|{$tipo_entrega}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["PRECIO_RADIO"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_cotizacion = $response;
                $this->view->id_cotizacion = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->detalle_items_cotizacion($id);
                $this->view->render("cotizacion/formatoA5");
            }else{
                $this->view->render("error/404");
            }
        }

/* ========================================================================== */
/*                       Vista de productos cotizacidos                       */
/* ========================================================================== */

        function productoscotizados(){
            $this->view->render("cotizacion/productoscotizados");
        }

/* ========================================================================== */
/*                        Lista de productos cotizados                        */
/* ========================================================================== */

        function productos_cotizados(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_cotizacion();
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $fecha_comprobante = date($lista["FECHA"]);
                        if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                            if($lista["ID_SUCURSAL"] == $sucursal){
                                $table .= 
                                    "<tr>
                                        <td>{$n}</td>
                                        <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                        <td class='>
                                            <a class='profile-img' href='javascript: void(0);'>
                                                <img src='{$imagen}' alt='product' style='width: 80px;'>
                                            </a>
                                        </td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                        <td>{$lista["LOTE"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDAD"]}</td>
                                        <td>{$lista["SUBTOTAL"]}</td>
                                        <td>{$lista["DESCUENTO"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["TOTAL"]}</td>
                                        <td style='font-weight: bold;color: #1b55e2;'>{$lista["FECHA"]}</td>
                                    </tr>";
                                $n++;
                            }
                        }
                   }
                   echo $table;
                }
            }
        }
        function productos_cotizados_2(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_cotizacion_2($date_1,$date_2,$sucursal);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $fecha_comprobante = date($lista["FECHA"]);

                            $table .= 
                                "<tr>
                                    <td>{$n}</td>
                                    <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["LOTE"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                                    <td>{$lista["SUBTOTALES"]}</td>
                                    <td>{$lista["DESCUENTOS"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["TOTALES"]}</td>
                                    
                                </tr>";
                            $n++;
                        
                       
                   }
                   echo $table;
                }
            }
        }
        function productos_cotizados_3(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $vendedor = $_POST["vendedor"];
                $lista_detalle = $this->model->lista_detalle_cotizacion_3($date_1,$date_2,$sucursal,$vendedor);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $fecha_comprobante = date($lista["FECHA"]);

                            $table .= 
                                "<tr>
                                    <td>{$n}</td>
                                    <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                     <td style='font-weight: bold;color: #e2a03f;'>{$lista["LOTE"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                                    <td>{$lista["SUBTOTALES"]}</td>
                                    <td>{$lista["DESCUENTOS"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["TOTALES"]}</td>
                                    
                                </tr>";
                            $n++;
                        
                       
                   }
                   echo $table;
                }
            }
        }
        function productos_cotizados_4(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_cotizacion_4($date_1,$date_2,$sucursal);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $fecha_comprobante = date($lista["FECHA"]);

                            $table .= 
                                "<tr>
                                    <td>{$n}</td>
                                    <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["LOTE"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                                    <td>{$lista["SUBTOTALES"]}</td>
                                    <td>{$lista["DESCUENTOS"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["TOTALES"]}</td>
                                    <td style='font-weight: bold;color: #e2a03f;'>{$lista["STOCK_ACTUAL"]}</td>
                                    <td style='font-weight: bold;color: #28a745;'>".strtoupper($lista["VENDEDOR"])."</td>
                                    
                                    
                                </tr>";
                            $n++;
                        
                       
                   }
                   echo $table;
                }
            }
        }

/* ========================================================================== */
/*                     Vista de cotizaciones por vendedor                     */
/* ========================================================================== */
        function cotizacionporvendedor(){
            $this->view->lista_vendedores = $this->lista_personas_option();
            $this->view->render("cotizacion/cotizacionxvendedor");
        }

/* ========================================================================== */
/*                  Lista de vendedores en <option></option>                  */
/* ========================================================================== */

        function lista_personas_option(){
            $personas = $this->model->lista_personas();
            if($personas){
                if($personas->rowCount()>0){
                    $option = "";
                    foreach($personas as $rows){
                        if($rows["ESTADO"] != 0){
                            $option .= "
                                    <option value='{$rows["ID_PERSONA"]}'>{$rows["NOMBRES"]} {$rows["APELLIDOS"]} | {$rows["DOCUMENTO"]} {$rows["NUMERO"]}</option>
                                ";
                        }
                    }
                    return $option;
                }
            }
        }

/* ========================================================================== */
/*                    Reporte de cotizaciones por vendedor                    */
/* ========================================================================== */

        function lista_cotizaciones_vendedor(){
            if(isset($_POST["vendedor"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $vendedor = $_POST["vendedor"];
                $lista_cotizaciones = $this->model->lista_cotizaciones_sucursal($sucursal);
                if($lista_cotizaciones){
                    if($lista_cotizaciones->rowCount()>0){
                        $table = "";
                        foreach($lista_cotizaciones as $row){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_COTIZACION"]);
                            $fecha_comprobante = date("Y-m-d",strtotime($row["FECHA"]));
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                if($row["ESTADO"] =! 0){
                                    if($row["ID_PERSONA"] == $vendedor){
                                        $fecha_cotizacion = $row["FECHA"];
                                        $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                        $badge = $row["TIPO_PAGO"];
                                        if($badge == 1){
                                            $badge = "<span class='badge badge-success'> Contado </span>";
                                        }else{
                                            $badge = "<span class='badge badge-info'> Credito </span>";
                                        }
                                        $badge_tipo_entrega = $row["TIPO_ENTREGA"];
                                        if($badge_tipo_entrega == 1){
                                            $badge_tipo_entrega = "<span class='badge badge-primary'> Inmediata </span>";
                                        }else{
                                            $badge_tipo_entrega = "<span class='badge badge-primary'> Por envio </span>";
                                        }
                                        $table .= "
                                            <tr>
                                                <td>{$row["CODIGO_COTIZACION"]}</td>
                                                <td>{$fecha_cotizacion}</td> 
                                                <td class='text-center'>{$badge}</td>
                                                <td>{$row["TOTAL"]}</td>
                                                <td>{$row["RAZON"]}</td>
                                                <td>{$row["DOCUMENTO"]} {$row["N_DOCUMENTO"]}</td>
                                                <td class='text-center'>{$badge_tipo_entrega}</td>
                                                <td>
                                                    <div class='d-flex'>
                                                        <div class='usr-img-frame mr-2 rounded-circle'>
                                                            <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}'>
                                                        </div>
                                                        <p class='align-self-center mb-0'>{$row["NOMBRES"]}</p>
                                                    </div>
                                                </td>
                                                <td class='text-center'>
                                                    <div class='dropdown dropup custom-dropdown-icon'>
                                                        <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                        </a>
    
                                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                            <a class='dropdown-item btn_detalle' id_c='{$row["ID_COTIZACION"]}' href='javascript:void(0);'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                    Detalle Cotización
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}cotizacion/formatoA4/{$id_encryptado}/' target='_blank' >
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                    COTIZACION (A4)
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}cotizacion/formatoA5/{$id_encryptado}/' target='_blank'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                    COTIZACION (A5)
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}cotizacion/membrete/{$id_encryptado}/' target='_blank'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                    MEMBRETE
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            ";
                                    }
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
/*                     Vista de cotizacion oor proveedores                    */
/* ========================================================================== */

        function cotizacionporvendedores(){
            $this->view->render("cotizacion/cotizacionxvendedores");
        }

/* ========================================================================== */
/*                Lista de reporte de cotizaciones por vendedor               */
/* ========================================================================== */

        function productos_vendededores(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_cotizacion();
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $fecha_comprobante = date($lista["FECHA"]);
                        if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                            if($lista["ID_SUCURSAL"] == $sucursal){
                                $PERSONA = strtoupper($lista["NOMBRES"])." ".strtoupper($lista["APELLIDOS"]);
                                $table .= 
                                    "<tr>
                                        <td>{$n}</td>
                                        <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                        <td class='>
                                            <a class='profile-img' href='javascript: void(0);'>
                                                <img src='{$imagen}' alt='product' style='width: 80px;'>
                                            </a>
                                        </td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                        <td>{$lista["LOTE"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDAD"]}</td>
                                        <td>{$lista["SUBTOTAL"]}</td>
                                        <td>{$lista["DESCUENTO"]}</td>
                                        <td style='font-weight: bold;color: #e2a03f;'>{$lista["TOTAL"]}</td>
                                        <td style='font-weight: bold;color: #1b55e2;'>{$lista["FECHA"]}</td>
                                        <td style='font-weight: bold;color: #009688;'>{$lista["STOCK_ACTUAL"]}</td>
                                        <td style='font-weight: bold;color: #FF5722;'>{$PERSONA}</td>
                                    </tr>";
                                $n++;
                            }
                        }
                   }
                   echo $table;
                }
            }
        }
        function eliminar_cotizacion(){
            if(isset($_POST["id_cotizacion"])){
                $eliminar = $this->model->cotizacion_a_venta($_POST["id_cotizacion"],0);
                if($eliminar){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
        function procesarVenta($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                
                date_default_timezone_set(ZONEDATE);
                $cotizacion_info = mainModel::parametros_cotizacion($id);
                $this->view->id_cotizacion  = $id;
                $this->view->detalle_cotizacion  = mainModel::parametros_cotizacion($id);
                $this->view->datos_cliente = mainModel::cliente($cotizacion_info["ID_CLIENTE"]);

                $this->view->render("cotizacion/procesar");
            }    
        }
        function actualizar_cotizacion(){
            if(isset($_POST["data"])){
                if(mainModel::estado_cotizacion($_POST["id_cotizacion"])== 2){
                    echo 3;
                    return false;
                }else{
                    date_default_timezone_set(ZONEDATE);
                    $suma_price = $_POST["suma_price"];
                    $cant_iva = $_POST["cant_iva"];
                    $sub_total_price = $_POST["sub_total_price"];
                    $retencion_price = $_POST["retencion_price"];
                    $precio_descuento = $_POST["precio_descuento"];
                    $exento_price = $_POST["exento_price"];
                    $n_exento = $_POST["n_exento"];
                    $descuento_global = $_POST["descuento_global"];
                    $total_price = $_POST["total_price"];               
                    $precio_radio = $_POST["precio_radio"];  
                    $actualizar_preventa = $this->model->actualizar_cotizacion($_POST["id_cotizacion"] ,$suma_price ,$cant_iva ,$exento_price ,$sub_total_price ,$retencion_price ,$precio_descuento ,$descuento_global ,$total_price ,$n_exento ,$precio_radio ,1 );
                    if($actualizar_preventa){
                        $productos = $_POST["data"];
                        //separo los producto en arreglo
                        $arrayproductos = explode(',',$productos);
                        //cuento la cantidad de productos
                        $n_productos = count($arrayproductos)-1;
                        //recorro el arreglo
                        $fecha_registro = date("Y-m-d h:i:s");
                        for($i=0;$i<$n_productos;$i++){
                            //capturo el string del array que esta en el indice
                            $productostring = $arrayproductos[$i];
                            //separo el string por el | y lo convierto
                            $producto = explode("|",$productostring);
                            // Ver si ya esta en la preventa o no
                            $ver_producto_prevendido = $producto[13];
                            $p_id_item = $producto[0];
                            $cantidad = $producto[2];
                            $descuento_producto = $producto[3];
                            $precio_1 = $producto[4];
                            $precio_2 = $producto[5];
                            $precio_3 = $producto[6];
                            $precio_4 = $producto[7];

                            $descuento_produc = $producto[8];
                            $sub_total_producto = $producto[9];
                            $total_producto = $producto[10];
                            $id_detalle = $this->generar_codigo_detalle_cotizacion();
                            if($ver_producto_prevendido == 0){
                                $id_producto = $producto[12];
                                $medida= $producto[15];
                                $pr = $producto[16];
                                $precio_5 = $producto[17];
                                $precio_6 = $producto[18];
                                $precio_7 = $producto[19];
                                // echo "$id_detalle,$p_id_item,{$_POST['id_cotizacion']},$cantidad,$precio_1,$descuento_producto,$sub_total_producto,$total_producto,$descuento_producto,$precio_1,$precio_2,$precio_3,$precio_4,$medida,$pr<br>";
                                // echo "p_id_detalle,p_id_item,p_id_cotizacion,p_cantidad,p_precio,p_descuento,p_subtotal,p_total,descuento_percent,p1,p2,p3,p4,medida,precio_radio<br>";
                                $guardar_detalle = $this->model->guardar_detalle_cotizacion($id_detalle,$p_id_item,$_POST["id_cotizacion"],$cantidad,$precio_1,$descuento_producto,$sub_total_producto,$total_producto,$descuento_producto,$precio_1,$precio_2,$precio_3,$precio_4,$medida,$pr,$precio_5,$precio_6,$precio_7);
                                if(!$guardar_detalle){
                                    echo "Error al guardar detalle de cotizacion";
                                }
                            }else{
                                // $actualizar_stock = $this->model->actualizar_stock_cotizado($_POST["id_cotizacion"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$cantidad ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                // if(!$actualizar_stock){
                                //     echo 3;
                                // }
                                // $producto_cantidad_registrada = mainModel::ver_cantidad_item_cotizacion($_POST["id_cotizacion"],$p_id_item);
                                // if($cantidad!=$producto_cantidad_registrada){
                                //     if($cantidad>=$producto_cantidad_registrada){
                                //         $diferencia = $cantidad - $producto_cantidad_registrada;
                                //         $agregar_stock = $this->model->agregar_stock_cotizado($_POST["id_cotizacion"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                //         if(!$agregar_stock){
                                //             echo 3;
                                //         }
                                //     }else{
                                //         $diferencia = $producto_cantidad_registrada-$cantidad;
                                //         $devolver_stock = $this->model->devolver_stock_cotizado($_POST["id_cotizacion"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                //         if(!$devolver_stock){
                                //             echo 3;
                                //         }
                                //     }
                                // }else{
                                //     $actualizar_stock = $this->model->actualizar_stock_cotizado($_POST["id_cotizacion"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$cantidad ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                //     if(!$actualizar_stock){
                                //         echo 3;
                                //     }
                                // }
                            }    
                        }
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            };
        }
        function lista_items_cotizacion(){
            if(isset($_POST["id_cotizacion"])){
                $id_cotizacion = $_POST["id_cotizacion"];
                $lista_items = $this->model->detalle_items_cotizacion($id_cotizacion);
                if($lista_items){
                    if($lista_items->rowCount()>0){
                        $card  = "";
                        foreach($lista_items as $row){
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
                            $stock = $row["STOCK_ACTUAL"];
                            
                            $precio_radio = $row["PRECIO_RADIO"];
						/*	if ( $row["PRECIO"] == $row["PRECIO_1"] ) $precio_radio = 1;
							if ( $row["PRECIO"] == $row["PRECIO_2"] ) $precio_radio = 2;
							if ( $row["PRECIO"] == $row["PRECIO_3"] ) $precio_radio = 3;
							if ( $row["PRECIO"] == $row["PRECIO_4"] ) $precio_radio = 4;  /**/							
							$divisor = $row[("STOCK_".$precio_radio)];
                            $cantidad = $row["CANTIDAD"]/ $divisor;
                            $badge_almacen = "<span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>"; 
                            $card .= "<div class='items new_items' id_item='{$row['ID_ITEM']}' producto_preventa='1' articulo = '{$row["ARTICULO"]}'  stock='{$stock}' producto='{$row["ID_PRODUCTO"]}' almacen='{$row["ID_ALMACEN"]}' id='item_{$row["ID_ITEM"]}' perecedero='{$row['PERECEDERO']}' exento='{$row['EXENTO']}'>
                                <div class='item-content new_item_content'>
                                    <button class='btn btn-outline-danger btn-sm btn_eliminar_producto_prevendido' id_detalle='{$row['ID_DETALLE']}' id_item='{$row['ID_ITEM']}' id_cotizacion='{$id_cotizacion}' cantidad_prevendida='{$row["CANTIDAD"]}' ><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></button>
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
                                        <p class='usr-ph-no'>{$row["UNIDAD"]} {$row["COMPLEMENTO"]} {$row["PREFIJO"]}</p>
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
                                                            <input type='text' id='precio_1_{$row["ID_ITEM"]}' value='{$row["PRECIO_1"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_1_{$row["ID_ITEM"]}' value='{$row["STOCK_1"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 2</span>
														<span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_2"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_2_{$row["ID_ITEM"]}' value='{$row["PRECIO_2"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_2_{$row["ID_ITEM"]}' value='{$row["STOCK_2"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 3</span>
														<span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_3"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_3_{$row["ID_ITEM"]}' value='{$row["PRECIO_3"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_3_{$row["ID_ITEM"]}' value='{$row["STOCK_3"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 4</span>
														<span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_4"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_4_{$row["ID_ITEM"]}' value='{$row["PRECIO_4"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_4_{$row["ID_ITEM"]}' value='{$row["STOCK_4"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 5</span>
														<span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_5"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_5_{$row["ID_ITEM"]}' value='{$row["PRECIO_5"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_5_{$row["ID_ITEM"]}' value='{$row["STOCK_5"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 6</span>
														<span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_6"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_6_{$row["ID_ITEM"]}' value='{$row["PRECIO_6"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_6_{$row["ID_ITEM"]}' value='{$row["STOCK_6"]}' class='new_stock_medida'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 7</span>
														<span style='font-weight: 700;color: #3b3f5c;' class='new_label' >{$row["MEDIDA_7"]}</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_7_{$row["ID_ITEM"]}' value='{$row["PRECIO_7"]}' class='touchs_precios'>
															<input type='text' readonly id='medida_7_{$row["ID_ITEM"]}' value='{$row["STOCK_7"]}' class='new_stock_medida'>
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
                                        <input type='text' id='cantidad_{$row["ID_ITEM"]}' value='{$cantidad}' class='touchs_cantidad'>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento</span>
                                    <div class='user-location'>
                                        <input type='text' id='descuento_{$row["ID_ITEM"]}' value='{$row["PERCENT_DESC"]}' class='touchs_descuentos touchs'>
                                    </div>
                                
                                    <input type='hidden' id='precio_radio_{$row["ID_ITEM"]}' class='pr_text' value='{$row["PRECIO_RADIO"]}' >
                           
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
                                        <span style='font-weight: 200;color: #3b3f5c;' id='descuento_producto_{$row["ID_ITEM"]}'>{$row["DESCUENTO"]}</span>
                                    </div>
                                    <div class='user-location'>
                                        <span style='font-weight: 700;color: #3b3f5c;'>Sub total</span>
                                        <span style='font-weight: 200;color: #3b3f5c;' id='sub_total_producto_{$row["ID_ITEM"]}'>{$row["SUBTOTAL"]}</span>
                                    </div>
                                    <div class='user-location'>
                                        <span style='font-weight: 700;color: #3b3f5c;'>Total</span>
                                        <span style='font-weight: 200;color: #3b3f5c;' id='total_producto_{$row["ID_ITEM"]}'>{$row["TOTAL"]}</span>
                                    </div>
                                    
                                    {$fecha}
                                </div>
                            </div>";
                        }
                        echo $card;
                    }
                }
            }
        }
        function generar_codigo_credito(){
            $numero = $this->model->lista_creditos();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('CREDITO',7,$numero);}
                return $numero+1;
            }else{
                return 0;
            }
        }
        function generar_codigo_venta(){
            $numero = $this->model->lista_ventas();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('VENTA',7,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
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
        function generar_codigo_salida(){
            $numero = $this->model->Lista_de_kardex();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('KARDEX',7,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
        function hacer_venta(){
            if(isset($_POST["id_cotizacion"]) && isset($_POST["id_cliente"])){
                session_name('B_POS');
                session_start();
                date_default_timezone_set(ZONEDATE);
                $id_sucursal = $_SESSION["sucursal"];
                $id_caja = $_SESSION["caja"];
                $id_usuario = $_SESSION["usuario"];
                $id_cliente = $_POST["id_cliente"];
                $cliente =  mainModel::parametros_cliente($id_cliente);
                $nit_cliente = $cliente['N_DOCUMENTO'];
                $id_cotizacion = $_POST["id_cotizacion"];
                if(mainModel::estado_cotizacion($id_cotizacion)== 2){
                    echo 3;
                    return false;
                }else{$date_venta = date('Y-m-d');
                    $date_venta = date('Y-m-d');
                    $date = date('Y-m-d H:i:s');
                    $date_registro = date('Y-m-d H:i:s');
                    $codigo_venta = $this->generar_codigo_venta();
                    $nro_venta =  $this->generar_nro_venta($id_sucursal);
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
                    $p2 = $_POST["nombrepromotor"];                             
                    $p1 =$_POST["nrofactura"];                             
                    $metodo_pago = $_POST["metodo_pago"];
                    $tipo_pago = $_POST["tipo_pago"];
                    $productos = $_POST["data"];
                    $fecha_limite = $_POST["fecha_limite"];
    
                    $observacion = $_POST["observacion"];
                    $precio_radio = $_POST["precio_radio"];
    
                    $codigo_credito = $this->generar_codigo_credito();
                    $nro_credito = $this->generar_nro_credito($id_sucursal);
                    $nombre_credito = "POR VENTA #$nro_venta";
                     $venta_facturar = $_POST["venta_facturar"];
                    $guardar_venta = $this->model->guardar_venta($codigo_venta,$nro_venta,$date,$metodo_pago,$nro_comprobante,$tipo_comprobante,$suma_price,$cant_iva,$exento_price,$sub_total_price,$retencion_price,$precio_descuento,$descuento_percent,$monto_a_pagar,$n_exento,$efectivo_recibido,$monotodebitado,$tarjeta_debito_credito,$tarjetahabitante,$cambio,$tipo_pago ,$id_cliente,$id_usuario,$id_sucursal,$id_caja,$observacion,$precio_radio,$p1,$p2);
                    if($guardar_venta){
                        if($tipo_pago == 2){
                            $guardar_credito = $this->model->guardar_credito($codigo_credito,$codigo_venta ,$id_sucursal,$id_cliente,$id_usuario,$nro_credito,$nombre_credito,$date_registro,$fecha_limite,$monto_a_pagar,0,$monto_a_pagar,1);
                            if(!$guardar_credito){
                                echo 2;
                            }
                        }
                        $cotizacion_a_venta = $this->model->cotizacion_a_venta($id_cotizacion,2);
                        if(!$cotizacion_a_venta){
                            echo 6;
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
                            $p_id_item = $producto[0]; //echo 'CANTIDAD_ORIGINAL= '.$producto[2].' CANTIDAD_MEDIDA= '.$producto[10];die;
                            $cantidad = $producto[2]; $cantidad = $producto[2] * $producto[10];/// modifica la cantidad aqui de acuerdo a la medida
                            $precio = $producto[4];
                            $descuento_producto = $producto[5];
                            $sub_total_producto_ = $producto[6];
                            $total_producto = $producto[7];
                            $stock = $producto[8];
                            $id_producto = $producto[9];      
                            $diferencia = $stock-$cantidad;
                            $medida = $producto[11];
                            $item_actualizado = $this->model->actualizar_catidad_lote($p_id_item,$diferencia);
                            if(!$item_actualizado){
                                echo 4;
                            }
                            $guardar_detalle = $this->model->agregar_detalle_venta($id_detalle,$p_id_item,$codigo_venta,$cantidad,$precio,$descuento_producto,$sub_total_producto_,$total_producto,$stock,$medida);
                            if(!$guardar_detalle){
                                echo 4;
                            }
                            $stock_global = mainModel::stock_global_producto($id_producto,$id_sucursal);
                            $guardar_kardex = $this->model->agregar_kardex($id_salida,$id_caja,$id_sucursal,$id_usuario,$p_id_item,$total_producto,$date,1,0,$cantidad,$diferencia,$stock_global,$nombre_credito,$codigo_venta);
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
                        echo "no se hizo la venta";
                    }
                }
            }else{
                echo "aa";
            }
        }
        function eliminar_producto_cotizacion(){
            if(isset($_POST["id_item"]) && isset($_POST["id_cotizacion"]) && isset($_POST["id_detalle"])){
                if(mainModel::estado_cotizacion($_POST["id_cotizacion"])== 2){
                    echo 3;
                    return false;
                }else{
                    if(mainModel::productos_cotizacion($_POST["id_cotizacion"])>1){
                        $eliminar = $this->model->eliminar_detalle_cotizacion($_POST["id_detalle"]);
                        if($eliminar){
                            if($eliminar->rowCount()>0){
                                echo 1;
                            }else{
                                echo 0;
                            }
                        }else{
                            echo 0;
                        }
                    }else{
                        echo 2;
                    }
                }
            }
        }
         function generar_codigo_dosificacion(){
            $numero = $this->model->lista_libro_ventas();
            if($numero){
                $numero = $numero->rowCount()+1;
                // return mainModel::generar_codigo_aleatorio('LIB',7,$numero);
                return $numero;
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
    }