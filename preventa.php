<?php
    class preventa extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                              Vista por defecto                             */
/* ========================================================================== */
        
        function render(){
            $this->view->lista_documentos = $this->lista_documentos();
            $this->view->render('preventa/index');
            
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
/*                              Guardar preventa                              */
/* ========================================================================== */

        function guardar_preventa(){
            if(isset($_POST["cliente"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $codigo_usuario =  $_SESSION["usuario"];
                $codigo_sucursal =  $_SESSION["sucursal"];
                $fecha_registro = date("Y-m-d h:i:s");
                $codigo_preventa = $this->generar_codigo_preventa();
                $nr_preventa = $this->generar_nro_preventa($codigo_sucursal);
                $codigo_cliente = $_POST["cliente"];
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
                $nrofactura = $_POST["nrofactura"];
                $nombrepromotor = $_POST["nombrepromotor"];
                $observacion = $_POST["observacion"];              
                $destinatario = $_POST["destinatario"];              
                $l1 = $_POST["l1"];              
                $l2 = $_POST["l2"];              
                $direccion_destino = $_POST["direccion_destino"];       
                $guardar_preventa = $this->model->agregar_preventa($codigo_preventa,$nr_preventa,$codigo_sucursal,$codigo_usuario,$codigo_cliente,$suma_price,$cant_iva,$exento_price,$sub_total_price,$retencion_price,$precio_descuento,$descuento_global,$total_price,$n_exento,$precio_radio,$fecha_registro,1,$observacion,$nrofactura,$nombrepromotor,$direccion_destino,$l1,$l2,$destinatario );
                if($guardar_preventa){
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
                        $id_detalle = $this->generar_codigo_detalle_preventa();
                        $p_id_item = $producto[0];
                        $cantidad = $producto[2]; $cantidad = $producto[2] * $producto[13];/// modifica la cantidad aqui de acuerdo a la medida
                        $descuento_producto = $producto[3];
                        $precio_1 = $producto[4];
                        $precio_2 = $producto[5];
                        $precio_3 = $producto[6];
                        $precio_4 = $producto[7];
                        $descuento_produc = $producto[8];
                        $sub_total_producto = $producto[9];
                        $total_producto = $producto[10];
                        $id_producto = $producto[12];
                        $precio_5 = $producto[14];
                        $precio_6 = $producto[15];
                        $precio_7 = $producto[16];
                        $guardar_detalle = $this->model->agregar_detalle_preventa($id_detalle,$codigo_preventa,$p_id_item,$id_producto,$precio_1,$precio_2,$precio_3,$precio_4,$cantidad,$descuento_producto,$descuento_produc,$sub_total_producto,$total_producto,$fecha_registro, 1 ,$precio_5,$precio_6,$precio_7);
                        if(!$guardar_detalle){
                            echo 2;
                        }
                    }
                    echo "1|".mainModel::encryption($codigo_preventa);
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                        Generar codigo de pre ventas                        */
/* ========================================================================== */

        function generar_codigo_preventa(){
            $numero = $this->model->lista_preventa();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('PREVENTA',7,$numero);
            }else{
                return 0;
            }
        } 

/* ========================================================================== */
/*                    Generar codigo de detalle de preventa                   */
/* ========================================================================== */

        function generar_codigo_detalle_preventa(){
            $numero = $this->model->lista_detalle_preventa();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('DETALLE',7,$numero);
            }else{
                return 0;
            }
        } 

/* ========================================================================== */
/*                         Generar numero de preventa                         */
/* ========================================================================== */

        function generar_nro_preventa($sucursal){
            $numero = $this->model->lista_preventas_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<=9){
                //     return "PREV00000".$numero;
                // }else if($numero>9 && $numero<=99){
                //     return "PREV0000".$numero;
                // }else if($numero>99 &&  $numero<=999){
                //     return "PREV000".$numero;
                // }else if($numero>999 && $numero<=9999){
                //     return "PREV00".$numero;
                // }else if($numero>9999 && $numero<=99999){
                //     return "PREV0".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                         Vista consulta de preventas                        */
/* ========================================================================== */

        function consultapreventas(){
            $this->view->render("preventa/consultarpreventas");
        }

/* ========================================================================== */
/*                             Lista de preventas                             */
/* ========================================================================== */

        function lista_preventas(){
            if(isset($_POST["sucursal"])){
                $lista_preventas = $this->model->lista_preventa();
                if($lista_preventas){
                    $tabla = "";
                    $n= 1;
                    foreach($lista_preventas as $lista){
                        if($lista["ID_SUCURSAL"] === $_POST["sucursal"]){
                            $perfil = SERVERURL."archives/avatars/{$lista["PERFIL"]}";
                            $enlace = SERVERURL;
                            $estado = $lista["ESTADO"];
                            $id_encryptado = mainModel::encryption($lista["ID_PREVENTA"]);
                            $procesar = "<a class='dropdown-item ' href='{$enlace}preventa/procesaraventa/{$id_encryptado}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                    Procesar a Venta
                                                </a>";
                            $devolucion = "<a class='dropdown-item ' href='{$enlace}preventa/devolucion/{$id_encryptado}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                    Devolucion
                                                </a>";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> PREVENTA </span>";
                            }else if($estado == 2){
                                $estado = "<span class='badge badge-success'> VENTA </span>";
                                $procesar= "";
                            }else if($estado == 0){
                                $estado = "<span class='badge badge-danger'> ANULADA </span>";
                                $procesar= "";
                            }
                            $tabla .= "
                                <tr>
                                    
                                    <td>{$lista["N_PREVENTA"]}</td>
                                    <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["RAZON"])."</td>
                                    <td>{$lista["FECHA_REGISTRO"]}</td>
                                    <td>{$lista["SUMAS"]}</td>
                                    <td>{$lista["IVA"]}</td>
                                    <td>{$lista["EXENTO"]}</td>
                                    <td>{$lista["SUBTOTAL"]}</td>
                                    <td>{$lista["RETENIDO"]}</td>
                                    <td>{$lista["DESCUENTO"]}</td>
                                    <td style='color: #FF9800;font-weight: 700;'>{$lista["TOTAL"]}</td>
                                    <td>
                                        ".strtoupper($lista["NOMBRES"])." ".strtoupper($lista["APELLIDOS"])."
                                    </td>
                                    <td>
                                       {$estado}
                                    </td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>
    
                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_c='{$lista["ID_PREVENTA"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Preventa
                                                </a>
                                                <a class='dropdown-item btn_enviar' id_v='{$lista["ID_PREVENTA"]}'   url='{$enlace}preventa/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                        Enviar Whatsapp
                                                </a>
                                                {$procesar}
                                                {$devolucion}
                                                <a class='dropdown-item' href='{$enlace}preventa/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (A4)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/ticket/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (ticket)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                   MEMBRETE
                                                </a>
                                                <a class='dropdown-item btn_anular' id_preventa='{$lista["ID_PREVENTA"]}' preventa_estado='{$lista["ESTADO"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                    Anular Preventa
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            ";
                            $n++;
                        }
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }
        function lista_preventas_pendientes(){
            if(isset($_POST["sucursal"])){
                $lista_preventas = $this->model->lista_preventa_pendientes();
                if($lista_preventas){
                    $tabla = "";
                    $n= 1;
                    foreach($lista_preventas as $lista){
                        if($lista["ID_SUCURSAL"] === $_POST["sucursal"]){
                            $perfil = SERVERURL."archives/avatars/{$lista["PERFIL"]}";
                            $enlace = SERVERURL;
                            $estado = $lista["ESTADO"];
                            $id_encryptado = mainModel::encryption($lista["ID_PREVENTA"]);
                            $procesar = "<a class='dropdown-item ' href='{$enlace}preventa/procesaraventa/{$id_encryptado}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                    Procesar a Venta
                                                </a>";
                            $devolucion = "<a class='dropdown-item ' href='{$enlace}preventa/devolucion/{$id_encryptado}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                    Devolucion
                                                </a>";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> PREVENTA </span>";
                            }else if($estado == 2){
                                $estado = "<span class='badge badge-success'> VENTA </span>";
                                $procesar= "";
                            }else if($estado == 0){
                                $estado = "<span class='badge badge-danger'> ANULADA </span>";
                                $procesar= "";
                            }
                            $tabla .= "
                                <tr>
                                    
                                    <td>{$lista["N_PREVENTA"]}</td>
                                    <td>{$lista["DIRECCION_FISICA"]}</td>
                                    <td>{$lista["DESTINO"]}</td>
                                    <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["RAZON"])."</td>
                                    <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["DIRECCION"])."</td>
                                    <td>{$lista["FECHA_REGISTRO"]}</td>
                                    <td>{$lista["SUMAS"]}</td>
                                    <td>{$lista["IVA"]}</td>
                                    <td>{$lista["EXENTO"]}</td>
                                    <td>{$lista["SUBTOTAL"]}</td>
                                    <td>{$lista["RETENIDO"]}</td>
                                    <td>{$lista["DESCUENTO"]}</td>
                                    <td style='color: #FF9800;font-weight: 700;'>{$lista["TOTAL"]}</td>
                                    <td>
                                        ".strtoupper($lista["NOMBRES"])." ".strtoupper($lista["APELLIDOS"])."
                                    </td>
                                    <td>
                                       {$estado}
                                    </td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>
    
                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_c='{$lista["ID_PREVENTA"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Preventa
                                                </a>
                                                <a class='dropdown-item btn_enviar' id_v='{$row["ID_PREVENTA"]}'  telefono='{$row["TELEFONO"]}' url='{$enlace}preventa/formatoA4/{$id_encryptado}/'  href='javascript:void(0);'>
                                                    <svg fill='#888ea8' xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 24 24' width='24px' height='24px'>    <path d='M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z'/></svg>
                                                        Enviar Whatsapp
                                                </a>
                                                {$procesar}
                                                {$devolucion}
                                                <a class='dropdown-item btn_mapa' destino='{$lista["DESTINO"]}' direccion_fisica='{$lista["DIRECCION_FISICA"]}' n_preventa='{$lista["N_PREVENTA"]}' l1='{$lista["L1"]}' l2='{$lista["L2"]}' href='javascript:void(0)' >
                                                <svg viewBox='0 0 24 24' width='24' height='24' stroke='currentColor' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round' class='css-i6dzq1'><path d='M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z'></path><circle cx='12' cy='10' r='3'></circle></svg>
                                                Ver en Mapa
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (A4)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/ticket/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (ticket)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                   MEMBRETE
                                                </a>
                                                <a class='dropdown-item btn_anular' id_preventa='{$lista["ID_PREVENTA"]}' preventa_estado='{$lista["ESTADO"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                    Anular Preventa
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            ";
                            $n++;
                        }
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                         Listar preventas por fecha                         */
/* ========================================================================== */

        function lista_preventa_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_preventas = $this->model->lista_preventa();
                if($lista_preventas){
                    $tabla = "";
                    $n= 1;
                    foreach($lista_preventas as $lista){
                        $fecha_pago = date("Y-m-d",strtotime($lista["FECHA_REGISTRO"]));
                        if($fecha_pago >= $date_1 && $fecha_pago <= $date_2){
                            if($lista["ID_SUCURSAL"] === $_POST["sucursal"]){
                                $perfil = SERVERURL."archives/avatars/{$lista["PERFIL"]}";
                                $enlace = SERVERURL;
                                $estado = $lista["ESTADO"];
                                $id_encryptado = mainModel::encryption($lista["ID_PREVENTA"]);
                                $procesar = "<a class='dropdown-item ' href='{$enlace}preventa/procesaraventa/{$id_encryptado}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                    Procesar a Venta
                                                </a>";
                                $devolucion = "<a class='dropdown-item ' href='{$enlace}preventa/devolucion/{$id_encryptado}'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                Devolucion
                                            </a>";
                                if($estado == 1){
                                    $estado = "<span class='badge badge-info'> PREVENTA </span>";
                                }else if($estado == 2){
                                    $estado = "<span class='badge badge-success'> VENTA </span>";
                                    $procesar =  "";
                                }else if($estado == 0){
                                    $estado = "<span class='badge badge-danger'> ANULADA </span>";
                                    $procesar =  "";
                                }
                                $tabla .= "
                                    <tr>
                                        <td>{$lista["N_PREVENTA"]}</td>
                                        <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["RAZON"])."</td>
                                        <td>{$lista["FECHA_REGISTRO"]}</td>
                                        <td>{$lista["SUMAS"]}</td>
                                        <td>{$lista["IVA"]}</td>
                                        <td>{$lista["EXENTO"]}</td>
                                        <td>{$lista["SUBTOTAL"]}</td>
                                        <td>{$lista["RETENIDO"]}</td>
                                        <td>{$lista["DESCUENTO"]}</td>
                                        <td style='color: #FF9800;font-weight: 700;'>{$lista["TOTAL"]}</td>
                                        <td>
                                            ".strtoupper($lista["NOMBRES"])." ".strtoupper($lista["APELLIDOS"])."
                                        </td>
                                        <td>
                                        {$estado}
                                        </td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
        
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$lista["ID_PREVENTA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Preventa
                                                    </a>
                                                    {$procesar}
                                                    {$devolucion}
                                                    <a class='dropdown-item' href='{$enlace}preventa/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Preventa (A4)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/ticket/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Preventa (ticket)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/formatoA5/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Preventa (A5)
                                                    </a>
                                                    <a class='dropdown-item btn_anular' id_preventa='{$lista["ID_PREVENTA"]}' preventa_estado='{$lista["ESTADO"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                        Anular Preventa
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/membrete/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                       MEMBRETE
                                                    </a>
                                                </div>
                                            </div>
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
            }
        }
        function lista_preventa_fecha_pendientes(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_preventas = $this->model->lista_preventa_pendientes();
                if($lista_preventas){
                    $tabla = "";
                    $n= 1;
                    foreach($lista_preventas as $lista){
                        $fecha_pago = date("Y-m-d",strtotime($lista["FECHA_REGISTRO"]));
                        if($fecha_pago >= $date_1 && $fecha_pago <= $date_2){
                            if($lista["ID_SUCURSAL"] === $_POST["sucursal"]){
                                $perfil = SERVERURL."archives/avatars/{$lista["PERFIL"]}";
                                $enlace = SERVERURL;
                                $estado = $lista["ESTADO"];
                                $id_encryptado = mainModel::encryption($lista["ID_PREVENTA"]);
                                $procesar = "<a class='dropdown-item ' href='{$enlace}preventa/procesaraventa/{$id_encryptado}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                        Procesar a Venta
                                                    </a>";
                                $devolucion = "<a class='dropdown-item ' href='{$enlace}preventa/devolucion/{$id_encryptado}'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-cart'><circle cx='9' cy='21' r='1'></circle><circle cx='20' cy='21' r='1'></circle><path d='M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6'></path></svg>
                                                        Devolucion
                                                    </a>";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> PREVENTA </span>";
                            }else if($estado == 2){
                                $estado = "<span class='badge badge-success'> VENTA </span>";
                                $procesar= "";
                            }else if($estado == 0){
                                $estado = "<span class='badge badge-danger'> ANULADA </span>";
                                $procesar= "";
                            }
                            $tabla .= "
                                <tr>
                                    
                                    <td>{$lista["N_PREVENTA"]}</td>
                                    <td>{$lista["DIRECCION_FISICA"]}</td>
                                    <td>{$lista["DESTINO"]}</td>
                                    <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["RAZON"])."</td>
                                    <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["DIRECCION"])."</td>
                                    <td>{$lista["FECHA_REGISTRO"]}</td>
                                    <td>{$lista["SUMAS"]}</td>
                                    <td>{$lista["IVA"]}</td>
                                    <td>{$lista["EXENTO"]}</td>
                                    <td>{$lista["SUBTOTAL"]}</td>
                                    <td>{$lista["RETENIDO"]}</td>
                                    <td>{$lista["DESCUENTO"]}</td>
                                    <td style='color: #FF9800;font-weight: 700;'>{$lista["TOTAL"]}</td>
                                    <td>
                                        ".strtoupper($lista["NOMBRES"])." ".strtoupper($lista["APELLIDOS"])."
                                    </td>
                                    <td>
                                       {$estado}
                                    </td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>
    
                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_c='{$lista["ID_PREVENTA"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Preventa
                                                </a>
                                                {$procesar}
                                                {$devolucion}
                                                <a class='dropdown-item btn_mapa' destino='{$lista["DESTINO"]}' direccion_fisica='{$lista["DIRECCION_FISICA"]}' n_preventa='{$lista["N_PREVENTA"]}' l1='{$lista["L1"]}' l2='{$lista["L2"]}' href='javascript:void(0)' >
                                                    <svg viewBox='0 0 24 24' width='24' height='24' stroke='currentColor' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round' class='css-i6dzq1'><path d='M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z'></path><circle cx='12' cy='10' r='3'></circle></svg>
                                                    Ver en Mapa
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (A4)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/ticket/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (ticket)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/formatoA5/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Preventa (A5)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}preventa/membrete/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                   MEMBRETE
                                                </a>
                                                <a class='dropdown-item btn_anular' id_preventa='{$lista["ID_PREVENTA"]}' preventa_estado='{$lista["ESTADO"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                    Anular Preventa
                                                </a>
                                            </div>
                                        </div>
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
            }
        }

/* ========================================================================== */
/*                       reporte de preventas por fecha                       */
/* ========================================================================== */

        function reporte_preventa_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_preventas = $this->model->lista_preventa();
                if($lista_preventas){
                    $tabla = "";
                    $n= 1;
                    foreach($lista_preventas as $lista){
                        $fecha_pago = date("Y-m-d",strtotime($lista["FECHA_REGISTRO"]));
                        if($fecha_pago >= $date_1 && $fecha_pago <= $date_2){
                            if($lista["ID_SUCURSAL"] === $_POST["sucursal"]){
                                $perfil = SERVERURL."archives/avatars/{$lista["PERFIL"]}";
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($lista["ID_PREVENTA"]);
                                $estado = $lista["ESTADO"];
                                if($estado == 1){
                                    $estado = "<span class='badge badge-info'> PREVENTA </span>";
                                }else if($estado == 2){
                                    $estado = "<span class='badge badge-success'> VENTA </span>";
                                }else if($estado == 0){
                                    $estado = "<span class='badge badge-danger'> ANULADA </span>";
                                }
                                $id_encryptado = mainModel::encryption($lista["ID_PREVENTA"]);
                                $tabla .= "
                                    <tr>
                                        
                                        <td>{$lista["N_PREVENTA"]}</td>
                                        <td style='color: #3F51B5;font-weight: 700;'>".strtoupper($lista["RAZON"])."</td>
                                        <td>{$lista["FECHA_REGISTRO"]}</td>
                                        <td>{$lista["SUMAS"]}</td>
                                        <td>{$lista["IVA"]}</td>
                                        <td>{$lista["EXENTO"]}</td>
                                        <td>{$lista["SUBTOTAL"]}</td>
                                        <td>{$lista["RETENIDO"]}</td>
                                        <td>{$lista["DESCUENTO"]}</td>
                                        <td style='color: #FF9800;font-weight: 700;'>{$lista["TOTAL"]}</td>
                                        <td>
                                            ".strtoupper($lista["NOMBRES"])." ".strtoupper($lista["APELLIDOS"])."
                                        </td>
                                        <td>
                                        {$estado}
                                        </td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
        
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$lista["ID_PREVENTA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Preventa
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Preventa (A4)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/ticket/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Preventa (ticket)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/formatoA5/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Preventa (A5)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}preventa/membrete/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                       MEMBRETE
                                                    </a>
                                                </div>
                                            </div>
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
            }
        }

/* ========================================================================== */
/*                          Vista preentas por fecha                          */
/* ========================================================================== */

        function preventaporfecha(){
            $this->view->render("preventa/consultaxfechas");
        }

/* ========================================================================== */
/*                        Vista preventas por vendedor                        */
/* ========================================================================== */

        function preventaporvendedor(){
            $this->view->lista_vendedores = $this->lista_personas_option();
            $this->view->render("preventa/consultaxvendedor");
        }

/* ========================================================================== */
/*                       VIsta preventas por vendedores                       */
/* ========================================================================== */

        function preventaporvendedores(){
            $this->view->render("preventa/consultaxvendedores");
        }
        function preventadevolucionesporvendedores(){
            $this->view->render("preventa/consultadevluionesxvendedores");
        }
        function devolucionporvendedores(){
            $this->view->lista_vendedores = $this->lista_personas_option();
            $this->view->render("preventa/consultadevolucionxvendedor");
        }

/* ========================================================================== */
/*                 Lista de personas disponibles en </option>                 */
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
/*                       Lista de preventas por vendedor                      */
/* ========================================================================== */

        function lista_preventa_vendedor(){
            if(isset($_POST["vendedor"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $vendedor = $_POST["vendedor"];
                $lista_detalle = $this->model->lista_detalle_preventa_4($date_1,$date_2,$sucursal,$vendedor );
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $rb_price = $lista["PRECIO_RADIO"]; 
                        $table .= 
                            "<tr>
                                
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
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO_".$rb_price]}</td>
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
        function lista_preventa_vendedor_devolucion(){
            if(isset($_POST["vendedor"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $vendedor = $_POST["vendedor"];
                $lista_detalle = $this->model->lista_detalle_preventa_devolucoion_4($date_1,$date_2,$sucursal,$vendedor );
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $rb_price = $lista["PRECIO_RADIO"]; 
                        $precio = floatval($lista["PRECIO_".$rb_price]);
                        $cantidad = floatval($lista["CANTIDADES"]);
                        $total = number_format(floatval($cantidad*$precio),2);
                        $table .= 
                            "<tr>
                                
                                <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                <td style='font-weight: bold;color: #5c1ac3;'>{$lista["DETALLE"]}</td>
                                <td>{$lista["LOTE"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO_".$rb_price]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                    
                                <td style='font-weight: bold;color: #e2a03f;'>{$total}</td>
                                
                            </tr>";
                        $n++;
                        
                   }
                   echo $table;
                }
            }
        }

/* ========================================================================== */
/*                Reporte de productos vendidos por vendedores                */
/* ========================================================================== */

        function productos_preventas_vendededores(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_preventa_3($date_1,$date_2,$sucursal);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $PERSONA = strtoupper($lista["VENDEDOR"]);
                        $rb_price = $lista["PRECIO_RADIO"]; 
                        $precio = floatval($lista["PRECIO_".$rb_price]);
                        $cantidad = floatval($lista["CANTIDADES"]);
                        $total = number_format(floatval($cantidad*$precio),2);
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
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO_".$rb_price]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                               
                                <td style='font-weight: bold;color: #e2a03f;'>{$total}</td>
                                <td style='font-weight: bold;color: #009688;'>{$lista["STOCK_ACTUAL"]}</td>
                                <td style='font-weight: bold;color: #FF5722;'>{$PERSONA}</td>
                            </tr>";
                        $n++;
                        
                   }
                   echo $table;
                }
            }
        }
        function productos_preventas_vendededores_devoluciones(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_preventa_devolucione_3($date_1,$date_2,$sucursal);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $PERSONA = strtoupper($lista["VENDEDOR"]);
                        $rb_price = $lista["PRECIO_RADIO"]; 
                        $precio = floatval($lista["PRECIO_".$rb_price]);
                        $cantidad = floatval($lista["CANTIDADES"]);
                        $total = number_format(floatval($cantidad*$precio),2);
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
                                <td style='font-weight: bold;color: #5c1ac3;'>{$lista["DETALLE"]}</td>
                                <td>{$lista["LOTE"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO_".$rb_price]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                               
                                <td style='font-weight: bold;color: #e2a03f;'>{$total}</td>
                                <td style='font-weight: bold;color: #009688;'>{$lista["STOCK_ACTUAL"]}</td>
                                <td style='font-weight: bold;color: #FF5722;'>{$PERSONA}</td>
                            </tr>";
                        $n++;
                        
                   }
                   echo $table;
                }
            }
        }

/* ========================================================================== */
/*                         Vista de productos vendidos                        */
/* ========================================================================== */

        function productosprevendidos(){
            $this->view->render("preventa/consultaxproductos");
        }
        function devoluciongeneral(){
            $this->view->render("preventa/consultadevolucionxproductos");
        }

/* ========================================================================== */
/*                       Lista de productos prevendidos                       */
/* ========================================================================== */

        function productos_prevendidos(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_preventa_2($date_1,$date_2,$sucursal);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $rb_price = $lista["PRECIO_RADIO"]; 
                        
                        $table .= 
                            "<tr>
                                
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
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO_".$rb_price]}</td>
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
        function productos_prevendidos_devueltos(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_detalle = $this->model->lista_detalle_preventa_devolucion_2($date_1,$date_2,$sucursal);
                if($lista_detalle){
                    $table = "";
                    $n = 1;
                    foreach($lista_detalle as $lista){
                        $imagen = SERVERURL."archives/assets/productos/{$lista["IMAGEN"]}";
                        $rb_price = $lista["PRECIO_RADIO"]; 
                        $precio = floatval($lista["PRECIO_".$rb_price]);
                        $cantidad = floatval($lista["CANTIDADES"]);
                        $total = number_format(floatval($cantidad*$precio),2);
                        $table .= 
                            "<tr>
                                
                                <td  style='font-weight: bold;color: #1b55e2;'>{$lista["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["ARTICULO"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["LINEA"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRESENTACION"]}</td>
                                <td style='font-weight: bold;color: #5c1ac3;'>{$lista["DETALLE"]}</td>
                                <td>{$lista["LOTE"]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["PRECIO_".$rb_price]}</td>
                                <td style='font-weight: bold;color: #e2a03f;'>{$lista["CANTIDADES"]}</td>
                            
                                <td style='font-weight: bold;color: #e2a03f;'>{$total}</td>
                                
                            </tr>";
                        $n++;
                        
                   }
                   echo $table;
                }
            }
        }

/* ========================================================================== */
/*                            Vista procesar venta                            */
/* ========================================================================== */

        function procesaraventa($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $this->view->id_preventa = mainModel::decryption($id);
                $preventa_info = mainModel::preventa_informacion(mainModel::decryption($id));
                $this->view->lista_documentos = $this::lista_documentos();
                $this->view->preventa_informacion = mainModel::preventa_informacion(mainModel::decryption($id));
                $this->view->datos_cliente = mainModel::cliente_credito_activo($preventa_info["ID_CLIENTE"]);
                $this->view->render("preventa/procesar_a_venta");
            }else{
                $this->view->render("error/404");
            }
        }
        function devolucion($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $this->view->id_preventa = mainModel::decryption($id);
                $preventa_info = mainModel::preventa_informacion(mainModel::decryption($id));
                $this->view->lista_documentos = $this::lista_documentos();
                $this->view->preventa_informacion = mainModel::preventa_informacion(mainModel::decryption($id));
                $this->view->datos_cliente = mainModel::cliente_credito_activo($preventa_info["ID_CLIENTE"]);
                $this->view->render("preventa/devolucion");
            }else{
                $this->view->render("error/404");
            }
        }

/* ========================================================================== */
/*                         Lista de items por preventa                        */
/* ========================================================================== */

        function lista_items_preventa(){
            if(isset($_POST["id_preventa"])){
                $id_preventa = $_POST["id_preventa"];
                $lista_items = $this->model->lista_items_preventa($id_preventa); 
                if($lista_items){
                    if($lista_items->rowCount()>0){
                        $card  = "";
                        foreach($lista_items as $row){ //$PRECIO_RADIO = $row["PRECIO_RADIO"]; echo '<br><br>precio radio = '.$PRECIO_RADIO.'<br>DIVISOR = '.$row[("STOCK_".$PRECIO_RADIO)].'<br>';
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
                            $stock = $row["STOCK_ACTUAL"]+$row["CANTIDAD"]; $precio_radio = $row["PRECIO_RADIO"]; $divisor = $row[("STOCK_".$precio_radio)];
                            $badge_almacen = "<span class='badge w-100 badge-info text-center'> {$row["ALMACEN"]} </span>"; 
                            $card .= "<div class='items new_items' id_item='{$row['ID_ITEM']}' producto_preventa='1' articulo = '{$row["ARTICULO"]}'  stock='{$stock}' producto='{$row["ID_PRODUCTO"]}' almacen='{$row["ID_ALMACEN"]}' id='item_{$row["ID_ITEM"]}' perecedero='{$row['PERECEDERO']}' exento='{$row['EXENTO']}'>
                                <div class='item-content new_item_content'>
                                    <button class='btn btn-outline-danger btn-sm btn_eliminar_producto_prevendido' id_detalle='{$row['ID_DETALLE']}' id_item='{$row['ID_ITEM']}' id_preventa='{$id_preventa}' cantidad_prevendida='{$row["CANTIDAD"]}' ><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></button>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Cantidad</span>
                                    <div class='user-location'>
                                        <input type='text' id='cantidad_{$row["ID_ITEM"]}' value='".(($row["CANTIDAD"])/$divisor)."' class='touchs_cantidad'>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Descuento</span>
                                    <div class='user-location'>
                                        <input type='text' id='descuento_{$row["ID_ITEM"]}' value='{$row["PERCENT_DESC"]}' class='touchs_descuentos touchs'>
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

/* ========================================================================== */
/*                    Funcion eliminar producto prevendido                    */
/* ========================================================================== */

        function eliminar_producto_prevendido(){
            if(isset($_POST["id_item"]) && isset($_POST["id_preventa"]) && isset($_POST["id_detalle"]) && isset($_POST["cantidad_prevendida"])){
                if(mainModel::estado_preventa($_POST["id_preventa"])== 2){
                    echo 3;
                    return false;
                }else{
                    if(mainModel::productos_preventa($_POST["id_preventa"])>1){
                        $eliminar = $this->model->eliminar_detalle_preventa($_POST["id_detalle"],$_POST["id_item"],$_POST["cantidad_prevendida"]);
                        if($eliminar){
                            echo 1;
                        }else{
                            echo 0;
                        }
                    }else{
                        echo 2;
                    }
                }
            }
        }
        function eliminar_producto_prevendido_2(){
            if(isset($_POST["id_item"]) && isset($_POST["id_preventa"]) && isset($_POST["id_detalle"]) && isset($_POST["cantidad_prevendida"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $codigo_usuario =  $_SESSION["caja"];
                if(mainModel::estado_preventa($_POST["id_preventa"])== 2){
                    echo 3;
                    return false;
                }else{
                    $fecha_registro = date("Y-m-d h:i:s");
                    if(mainModel::productos_preventa($_POST["id_preventa"])>1){
                        $PRODUCTO = mainModel::parametros_detalle_preventa($_POST['id_detalle']);
                        $precio_1 = $PRODUCTO['PRECIO_1'];
                        $precio_2 = $PRODUCTO['PRECIO_2'];
                        $precio_3 = $PRODUCTO['PRECIO_3'];
                        $diferencia = $PRODUCTO['DIFERENCIA'];
                        $descuento_producto = $PRODUCTO['PERCENT_DESC'];
                        $descuento_produc = $PRODUCTO['DESCUENTO'];
                        $sub_total_producto = $PRODUCTO['SUBTOTAL'];
                        $total_producto = $PRODUCTO['TOTAL'];
                        $fecha_registro = $PRODUCTO['FECHA_REGISTRO'];
                        $id_producto = $PRODUCTO['ID_PRODUCTO'];
                        $eliminar = $this->model->eliminar_detalle_preventa($_POST["id_detalle"],$_POST["id_item"],$_POST["cantidad_prevendida"]);
                        if($eliminar){
                            $id_detalle = $this->generar_codigo_detalle_preventa();
                            $diferencia = $_POST["cantidad_prevendida"];
                           
                            $devolver_stock = $this->model->devolver_stock_prevendido_detalle($id_detalle,$_POST["id_preventa"] ,$_POST["id_item"] ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto,$fecha_registro,$id_producto,"DEVOLUCION DIRECTA",$codigo_usuario);
                            if(!$devolver_stock){
                                echo 3;
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

/* ========================================================================== */
/*                         Funcion actualizar preventa                        */
/* ========================================================================== */

        function actualizar_preventa(){
            if(isset($_POST["data"])){
                if(mainModel::estado_preventa($_POST["id_preventa"])== 2){
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
                    $actualizar_preventa = $this->model->actualizar_preventa($_POST["id_preventa"] ,$suma_price ,$cant_iva ,$exento_price ,$sub_total_price ,$retencion_price ,$precio_descuento ,$descuento_global ,$total_price ,$n_exento ,$precio_radio ,1 );
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
                            $cantidad = $producto[2]; //die("actualizar EN PRE-VENTA:" .$cantidad );
                            $descuento_producto = $producto[3];
                            $precio_1 = $producto[4];
                            $precio_2 = $producto[5];
                            $precio_3 = $producto[6];
                            $precio_4 = $producto[7];
                            $descuento_produc = $producto[8];
                            $sub_total_producto = $producto[9];
                            $total_producto = $producto[10];
                            if($ver_producto_prevendido == 0){
                                $id_detalle = $this->generar_codigo_detalle_preventa();
                                $id_producto = $producto[12];
                                $guardar_detalle = $this->model->agregar_detalle_preventa($id_detalle,$_POST["id_preventa"],$p_id_item,$id_producto,$precio_1,$precio_2,$precio_3,$precio_4,$cantidad,$descuento_producto,$descuento_produc,$sub_total_producto,$total_producto,$fecha_registro, 1 );
                                if(!$guardar_detalle){
                                    echo 3;
                                }
                            }else{
                                $producto_cantidad_registrada = mainModel::ver_cantidad_item_preventa($_POST["id_preventa"],$p_id_item);
                                if($cantidad!=$producto_cantidad_registrada){
                                    if($cantidad>=$producto_cantidad_registrada){
                                        $diferencia = $cantidad - $producto_cantidad_registrada;
                                        $agregar_stock = $this->model->agregar_stock_prevendido($_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                        if(!$agregar_stock){
                                            echo 3;
                                        }
                                    }else{
                                        $diferencia = $producto_cantidad_registrada-$cantidad;
                                        $devolver_stock = $this->model->devolver_stock_prevendido($_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                        if(!$devolver_stock){
                                            echo 3;
                                        }
                                    }
                                }else{
                                    $actualizar_stock = $this->model->actualizar_stock_prevendido($_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$cantidad ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                    if(!$actualizar_stock){
                                        echo 3;
                                    }
                                }
                            }    
                        }
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            };
        }
        function actualizar_preventa_2(){
            if(isset($_POST["data"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $codigo_usuario =  $_SESSION["caja"];
                if(mainModel::estado_preventa($_POST["id_preventa"])== 2){
                    echo 3;
                    return false;
                }else{

                    date_default_timezone_set(ZONEDATE);
                    $suma_price = $_POST["suma_price"];
                    $observacion = $_POST["observacion"];
                    $cant_iva = $_POST["cant_iva"];
                    $sub_total_price = $_POST["sub_total_price"];
                    $retencion_price = $_POST["retencion_price"];
                    $precio_descuento = $_POST["precio_descuento"];
                    $exento_price = $_POST["exento_price"];
                    $n_exento = $_POST["n_exento"];
                    $descuento_global = $_POST["descuento_global"];
                    $total_price = $_POST["total_price"];               
                    $precio_radio = $_POST["precio_radio"];  
                    $actualizar_preventa = $this->model->actualizar_preventa($_POST["id_preventa"] ,$suma_price ,$cant_iva ,$exento_price ,$sub_total_price ,$retencion_price ,$precio_descuento ,$descuento_global ,$total_price ,$n_exento ,$precio_radio ,1 );
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
                            $id_producto = $producto[12];
                            if($ver_producto_prevendido == 0){
                                $id_detalle = $this->generar_codigo_detalle_preventa();
                                $guardar_detalle = $this->model->agregar_detalle_preventa($id_detalle,$_POST["id_preventa"],$p_id_item,$id_producto,$precio_1,$precio_2,$precio_3,$precio_4,$cantidad,$descuento_producto,$descuento_produc,$sub_total_producto,$total_producto,$fecha_registro, 1 );
                                if(!$guardar_detalle){
                                    echo 3;
                                }
                            }else{
                                $producto_cantidad_registrada = mainModel::ver_cantidad_item_preventa($_POST["id_preventa"],$p_id_item);
                                if($cantidad!=$producto_cantidad_registrada){
                                    if($cantidad>=$producto_cantidad_registrada){
                                        $diferencia = $cantidad - $producto_cantidad_registrada;
                                        $agregar_stock = $this->model->agregar_stock_prevendido($_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                        if(!$agregar_stock){
                                            echo 3;
                                        }
                                    }else{
                                        $id_detalle = $this->generar_codigo_detalle_preventa();
                                        $diferencia = $producto_cantidad_registrada-$cantidad;
                                        $devolver_stock = $this->model->devolver_stock_prevendido_detalle($id_detalle,$_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto,$fecha_registro,$id_producto,$observacion,$codigo_usuario);
                                        if(!$devolver_stock){
                                            echo 3;
                                        }
                                        $diferencia = $producto_cantidad_registrada-$cantidad;
                                        $devolver_stock2 = $this->model->devolver_stock_prevendido($_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$diferencia ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                        if(!$devolver_stock2){
                                            echo 3;
                                        }
                                    }
                                }else{
                                    $actualizar_stock = $this->model->actualizar_stock_prevendido($_POST["id_preventa"] ,$p_id_item ,$precio_1 ,$precio_2 ,$precio_3 ,$precio_4 ,$cantidad ,$descuento_producto ,$descuento_produc ,$sub_total_producto ,$total_producto);
                                    if(!$actualizar_stock){
                                        echo 3;
                                    }
                                }
                            }    
                        }
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            };
        }

/* ========================================================================== */
/*                         Realizar la venta procesada                        */
/* ========================================================================== */

        function hacer_venta(){
            if(isset($_POST["id_preventa"]) && isset($_POST["id_cliente"])){
                session_name('B_POS');
                session_start();
                date_default_timezone_set(ZONEDATE);
                $id_sucursal = $_SESSION["sucursal"];
                $id_caja = $_SESSION["caja"];
                $id_usuario = $_SESSION["usuario"];
                $id_cliente = $_POST["id_cliente"];
                $cliente =  mainModel::parametros_cliente($id_cliente);
                $nit_cliente = $cliente['N_DOCUMENTO'];
                $id_preventa = $_POST["id_preventa"];
                if(mainModel::estado_preventa($id_preventa)== 2){
                    echo 3;
                    return false;
                }else{
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
                    $metodo_pago = $_POST["metodo_pago"];
                    $tipo_pago = $_POST["tipo_pago"];
                    $productos = $_POST["data"];
                    $fecha_limite = $_POST["fecha_limite"];
    
                    $observacion = $_POST["observacion"];
                    $p1 = $_POST["nrofactura"];
                    $p2 = $_POST["nombrepromotor"];
                    $precio_radio = $_POST["precio_radio"];
                     $venta_facturar = $_POST["venta_facturar"];
                    $codigo_credito = $this->generar_codigo_credito();
                    $nro_credito = $this->generar_nro_credito($id_sucursal);
                    $nombre_credito = "POR VENTA #$nro_venta";
    
                    $guardar_venta = $this->model->guardar_venta($codigo_venta,$nro_venta,$date,$metodo_pago,$nro_comprobante,$tipo_comprobante,$suma_price,$cant_iva,$exento_price,$sub_total_price,$retencion_price,$precio_descuento,$descuento_percent,$monto_a_pagar,$n_exento,$efectivo_recibido,$monotodebitado,$tarjeta_debito_credito,$tarjetahabitante,$cambio,$tipo_pago ,$id_cliente,$id_usuario,$id_sucursal,$id_caja,$observacion,$precio_radio,$p1,$p2);
                    if($guardar_venta){
                        if($tipo_pago == 2){
                            $guardar_credito = $this->model->guardar_credito($codigo_credito,$codigo_venta ,$id_sucursal,$id_cliente,$id_usuario,$nro_credito,$nombre_credito,$date_registro,$fecha_limite,$monto_a_pagar,0,$monto_a_pagar,1);
                            if(!$guardar_credito){
                                echo 2;
                            }
                        }
                        $preventa_a_venta = $this->model->preventa_a_venta($id_preventa,2);
                        if(!$preventa_a_venta){
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
                            $p_id_item = $producto[0];
                            $cantidad = $producto[2]; $cantidad = $producto[2] * $producto[10];/// modifica la cantidad aqui de acuerdo a la medida
                            $precio = $producto[4];
                            $descuento_producto = $producto[5];
                            $sub_total_producto_ = $producto[6];
                            $total_producto = $producto[7];
                            $stock = $producto[8];
                            $id_producto = $producto[9];
                            $guardar_detalle = $this->model->agregar_detalle_venta($id_detalle,$p_id_item,$codigo_venta,$cantidad,$precio,$descuento_producto,$sub_total_producto_,$total_producto,$stock);
                            if(!$guardar_detalle){
                                echo 4;
                            }
                            $stock_global = mainModel::stock_global_producto($id_producto,$id_sucursal);
                            $guardar_kardex = $this->model->agregar_kardex($id_salida,$id_caja,$id_sucursal,$id_usuario,$p_id_item,$total_producto,$date,1,0,$cantidad,$stock-$cantidad,$stock_global,$nombre_credito,$codigo_venta);
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

/* ========================================================================== */
/*                          Generar codigo de credito                         */
/* ========================================================================== */

        function generar_codigo_credito(){
            $numero = $this->model->lista_creditos();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('CREDITO',7,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                          Generar numero de credito                         */
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
/*                          Generar codigo de salida                          */
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
/*                     Generar codigo de detalle de venta                     */
/* ========================================================================== */

        function generar_codigo_detalle_venta(){
            $numero = $this->model->lista_detalle_venta();
            if($numero){
                $numero = $numero->rowCount()+1;
                return $numero;
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
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                           Generar codigo de venta                          */
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
/*                            Generar nro de venta                            */
/* ========================================================================== */

        function generar_nro_venta($sucursal){
            $numero = $this->model->lista_ventas_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
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
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                        Generar codigo de comprobante                       */
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
/*                         Mostrar detalle de preventa                        */
/* ========================================================================== */

        function detallepreventa(){
            if(isset($_POST["id"])){
                $buscar_preventa = $this->model->buscar_preventa($_POST["id"]);
                if($buscar_preventa){
                    if($buscar_preventa->rowCount()>0){
                        $preventa = "";
                        foreach($buscar_preventa as $b){
                            $estado = $b["ESTADO"];
                            if($estado == 1){
                                $estado = "PREVENTA";
                            }else if($estado == 2){
                                $estado = "VENTA REALIZADA";
                            }else{
                                $estado = "ANULADA";
                            }
                            $preventa .= "{$b["FECHA_REGISTRO"]}|{$estado}|{$b["RAZON"]}|{$b["DOCUMENTO"]} DE CLIENTE|{$b["N_DOCUMENTO"]}|{$b["NOMBRES"]} {$b["APELLIDOS"]}|{$b["OBSERVACION"]}|{$b["SUMAS"]}|{$b["IVA"]}|{$b["SUBTOTAL"]}|{$b["RETENIDO"]}|{$b["EXENTO"]}|{$b["DESCUENTO"]}|{$b["TOTAL"]}|";
                        }
                        echo "1|$preventa";
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                      Mostrar los items de la preventa                      */
/* ========================================================================== */

        function detallepreventa_item(){
            if(isset($_POST["id"])){
                $id_preventa = $_POST["id"];
                $lista_items = $this->model->lista_items_preventa($id_preventa);
                if($lista_items){
                    if($lista_items->rowCount()>0){
                        $response  = "";
                        foreach($lista_items as $row){
                            $fecha_vencimiento = $row["FECHA_VEN"];
                            if($fecha_vencimiento == "0000-00-00"){
                                $fecha_vencimiento = "No caducable";
                            }
                            $precioradio = $row["PRECIO_RADIO"];
                            $response .="
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 700'>{$row['BARRA']}</td>
                                    <td>{$row['ARTICULO']}</td>
                                    <td>{$row['LINEA']}</td>
                                    <td>{$row['PRESENTACION']}</td>
                                    <td>{$row['CANTIDAD']}</td>
                                    <td>{$row["PRECIO_{$precioradio}"]}</td>
                                    <td>{$row["DESCUENTO"]}</td>
                                    <td>{$fecha_vencimiento}</td>
                                    <td>{$row["TOTAL"]}</td>
                                </tr>
                            
                            ";
                        }
                        echo $response;
                    }
                }
            }
        }

/* ========================================================================== */
/*                               Anular preventa                              */
/* ========================================================================== */

        function anular_preventa(){
            if(isset($_POST["id_preventa"])){
                $anular = $this->model->anular_preventa($_POST["id_preventa"]);
                if($anular){
                    $lista_items = $this->model->lista_items_preventa($_POST["id_preventa"]);
                    if($lista_items){
                        if($lista_items->rowCount()>0){
                            foreach($lista_items as $row){
                                $devolver = $this->model->devolver_cantidad_prevendida($row["ID_ITEM"],$row["CANTIDAD"]);
                                if(!$devolver){
                                    echo 2;
                                }
                            }
                            echo 1;
                        }
                    }
                }
            }
        }

        function membrete($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_preventa  = $this->model->buscar_preventa($id);
                $response  = "";
                if($buscar_preventa){
                    if($buscar_preventa->rowCount()>0){
                        foreach($buscar_preventa as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            $response .= "{$row["FECHA_REGISTRO"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_PREVENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["DESCUENTO_PERCENT"]}|{$row["PROD_EXENTOS"]}|{$row["PRECIO_RADIO"]}|{$row["OBSERVACION"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_preventa = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->lista_items_preventa($id);
                $this->view->render("preventa/membrete");
            }else{
                $this->view->render("error/404");
            }
        }
        function formatoA4($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_preventa  = $this->model->buscar_preventa($id);
                $response  = "";
                if($buscar_preventa){
                    if($buscar_preventa->rowCount()>0){
                        foreach($buscar_preventa as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            $response .= "{$row["FECHA_REGISTRO"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_PREVENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["DESCUENTO_PERCENT"]}|{$row["PROD_EXENTOS"]}|{$row["PRECIO_RADIO"]}|{$row["OBSERVACION"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_preventa = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->lista_items_preventa($id);
                $this->view->render("preventa/formatoA4");
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
                $buscar_preventa  = $this->model->buscar_preventa($id);
                $response  = "";
                if($buscar_preventa){
                    if($buscar_preventa->rowCount()>0){
                        foreach($buscar_preventa as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            $response .= "{$row["FECHA_REGISTRO"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_PREVENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["DESCUENTO_PERCENT"]}|{$row["PROD_EXENTOS"]}|{$row["PRECIO_RADIO"]}|{$row["OBSERVACION"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_preventa = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->lista_items_preventa($id);
                $this->view->render("preventa/ticket");
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
                $buscar_preventa  = $this->model->buscar_preventa($id);
                $response  = "";
                if($buscar_preventa){
                    if($buscar_preventa->rowCount()>0){
                        foreach($buscar_preventa as $row){
                            $tipo_pago = "{$row["ESTADO"]}";
                            $response .= "{$row["FECHA_REGISTRO"]}|{$tipo_pago}|{$row["ID_CLIENTE"]}|{$row["ID_SUCURSAL"]}|{$row["ID_PERSONA"]}|{$row["N_PREVENTA"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["DESCUENTO"]}|{$row["DESCUENTO_PERCENT"]}|{$row["PROD_EXENTOS"]}|{$row["PRECIO_RADIO"]}|{$row["OBSERVACION"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_preventa = $response;
                $this->view->id_venta = $id;
                $this->view->parametros_cliente = mainModel::parametros_cliente($res_array[2]);
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[3]);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->lista_items_preventa($id);
                $this->view->render("preventa/formatoA5");
            }else{
                $this->view->render("error/404");
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

    }