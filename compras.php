<?php
    class compras extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                        Vista de principal de compras                       */
/* ========================================================================== */

        function render(){
            $this->view->lista_comprobantes = $this->lista_comprobantes();
            $this->view->lista_almacenes = $this->lista_almacenes();
            $this->view->lista_proveedores = $this->lista_proveedores();
            $this->view->render('compras/index');
        }

/* ========================================================================== */
/*                             Lista comprobantes                             */
/* ========================================================================== */

        function lista_comprobantes(){
            $comprobantes = $this->model->lista_comprobantes();
            if($comprobantes){
                $option = "";
                foreach($comprobantes as $row){
                    if($row['ESTADO']==0){
                        $option .= "<option value='{$row['ID_COMPROBANTE']}' disabled>{$row['COMPROBANTE']}</option>";
                    }else{
                        $option .= "<option value='{$row['ID_COMPROBANTE']}'>{$row['COMPROBANTE']}</option>";
                    }
                }
                return $option;
            }
        }

/* ========================================================================== */
/*                               Lista almacenes                              */
/* ========================================================================== */

        function lista_almacenes(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                if($sucursal != "0"){
                    $almacenes = "";
                    $almacenes = $this->model->listar_almacenesXsucursal($sucursal);
                    if($almacenes){
                        $option = "<option value='0' selected='selected' disabled>Seleccionar...</option>";
                        foreach($almacenes as $row){
                            if($row['ESTADO']==0){
                                $option .= "<option value='{$row['ID_ALMACEN']}' disabled>{$row['NOMBRE']}</option>";
                            }else{
                                $option .= "<option value='{$row['ID_ALMACEN']}'>{$row['NOMBRE']}</option>";
                            }
                        }
                        echo $option;
                    }
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                              Lista proveedores                             */
/* ========================================================================== */

        function lista_proveedores(){
            $proveeopres = $this->model->listar_proveedores();
            if($proveeopres){
                $option = "<option disabled selected>Seleccionar proveedor</option>";
                foreach($proveeopres as $row){
                    if($row['ESTADO']==0){
                        $option .= "<option value='{$row['ID_PROVEEDOR']}' disabled>{$row['RAZON']}</option>";
                    }else{
                        $option .= "<option value='{$row['ID_PROVEEDOR']}'>{$row['RAZON']}</option>";
                    }
                }
                return $option;
            }
        }

/* ========================================================================== */
/*                            Generar codigo compra                           */
/* ========================================================================== */

        function generar_codigo_compra(){
            $numero = $this->model->listar_compras();
            if($numero){
                $numero = $numero->rowCount()+1;
                // $numero = mainModel::generar_codigo_aleatorio("COMPRA",5,$numero);
                return $numero;
            }else{
                return 0;
            }
        }   

/* ========================================================================== */
/*                    Generar numero de compra por sucursal                   */
/* ========================================================================== */

        function generar_nro_venta($sucursal){
            $numero = $this->model->lista_compras_sucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<=9){
                //     return "C000000".$numero;
                // }else if($numero>9 && $numero<=99){
                //     return "C00000".$numero;
                // }else if($numero>99 &&  $numero<=999){
                //     return "C0000".$numero;
                // }else if($numero>999 && $numero<=9999){
                //     return "C000".$numero;
                // }else if($numero>9999 && $numero<=99999){
                //     return "C00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                          Generar numero de credito                         */
/* ========================================================================== */

        function generar_nro_credito($sucursal){
            $numero = $this->model->compras_creditos();
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<=9){
                //     return "CRED000000".$numero;
                // }else if($numero>9 && $numero<=99){
                //     return "CRED00000".$numero;
                // }else if($numero>99 &&  $numero<=999){
                //     return "CRED0000".$numero;
                // }else if($numero>999 && $numero<=9999){
                //     return "CRED000".$numero;
                // }else if($numero>9999 && $numero<=99999){
                //     return "CRED00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                           Generar codigo de lote                           */
/* ========================================================================== */ 

        function generar_codigo_lote(){
            $numero = $this->model->lista_lotes();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('LOTE',6,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                           Generar codigo_credito                           */
/* ========================================================================== */

        function generar_codigo_credito(){
            $numero = $this->model->lista_creditos_de_compra();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('CREDITO',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                             Generar codigo item                            */
/* ========================================================================== */

        function generar_codigo_items_lote(){
            $numero = $this->model->lista_items_lotes();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('ITEM',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                        Generar codigo de perecederos                       */
/* ========================================================================== */

        function generar_codigo_perecederos(){
            $numero = $this->model->lista_perecederos();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('PERECEDERO',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                          Generar codigo de kardex                          */
/* ========================================================================== */

        function generar_codigo_entradas(){
            $numero = $this->model->Lista_de_kardex();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('KARDEX',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }
/* ========================================================================== */
/*                               Guardar Compra                               */
/* ========================================================================== */
        
        function realizarcompra(){
            if(isset($_POST["almacen"]) && isset($_POST["proveedor"]) && isset($_POST["comprobante"]) && isset($_POST["data"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $codigo_usuario =  $_SESSION["usuario"];
                $id_caja = $_SESSION["caja"];
                $codigo_sucursal =  $_SESSION["sucursal"];
                $codigo_almacen =  $_POST["almacen"];
                $codigo_proveedor =  $_POST["proveedor"];
                $codigo_comprobante =  $_POST["comprobante"];
                $fechacomprobante =  $_POST["fechacomprobante"];
                $fecha_credito =  $_POST["fecha_credito"];
                $nr_comprobante =  $_POST["nr_comprobante"];
                $sumas =  $_POST["sumas"];
                $iva =  $_POST["iva"];
                $comprobante_texto =  $_POST["comprobante_texto"];
                $p_descripcion = "POR COMPRA $comprobante_texto #$nr_comprobante";
                $subtotal =  $_POST["subtotal"];
                $retencion =  $_POST["retencion"];
                $exento_total =  $_POST["exento_total"];
                $productos_exentos =  $_POST["productos_exentos"];
                $pago =  $_POST["pago"];
                $total =  $_POST["total"];
                $arqueo = mainModel::parametros_arqueo($id_caja);
                $montoinicial = $arqueo["MONTOINICIAL"];
                $ingresos = $arqueo["INGRESOS"];
                $egresos = $arqueo["EGRESOS"];

                $codigo_lote =  $this->generar_codigo_lote();
                $nombre_lote =  $_POST["nombre_lote"];
                $facturar_compra =  $_POST["compra_facturar"];
                $codigo_control =  $_POST["codigo_control"];
                $nro_factura =  $_POST["nro_factura"];
                $nro_autorizacion =  $_POST["nro_autorizacion"];
                $descuento_compra =  $_POST["descuento_compra"];
                $codigo_compra =  $this->generar_codigo_compra();
                $nro_compra =  $this->generar_nro_venta($codigo_sucursal);
                $date = date('Y-m-d');
                $date_registro = date('Y-m-d H:i:s');
                $guardar_lote = $this->model->agregar_lotes($codigo_lote,$nombre_lote,$codigo_almacen,$date,1);
                if($guardar_lote){
                    if($guardar_lote->rowCount()>0){
                        $guardar_compra = $this->model-> realizarcompra($codigo_compra,$date_registro,$codigo_proveedor,$codigo_almacen,$pago,$codigo_comprobante,$nr_comprobante,$fechacomprobante,$sumas,$iva,$subtotal,$exento_total,$retencion,$productos_exentos,$total,$codigo_usuario,$codigo_lote,1,$nro_compra,$id_caja);
                        if($guardar_compra){
                            if($guardar_compra->rowCount()>0){
                                if($pago == "2" || $pago == 2){
                                    $code_credito = $this->generar_codigo_credito();
                                    $n_credito = $this->generar_nro_credito($codigo_sucursal);
                                    $guardar_credito = $this->model->agregar_credito($code_credito,$codigo_compra,$total,0,$total,$fecha_credito,1,$n_credito);
                                    if(!$guardar_credito){
                                        echo "No se pudo agregar credito";
                                    }
                                }
                                    //todos los productos de caja
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
                                    $id_item = $this->generar_codigo_items_lote();
                                    $p_id_producto = $producto[0];
                                    $perecedero = $producto[1];
                                    $cantidad = $producto[4];
                                    $precio = $producto[5];
                                    $precio_1 = $producto[6];
                                    $precio_2 = $producto[7];
                                    $precio_3 = $producto[8];
                                    $precio_4 = $producto[9];
                                    $fecha_vencimiento = "";
                                    $lote = $producto[11];
                                    $precio_5 = $producto[12];
                                    $precio_6 = $producto[13];
                                    $precio_7 = $producto[14];
                                    $codigo_lote =  $this->generar_codigo_lote();
                                    $guardar_lote = $this->model->agregar_lotes($codigo_lote,$lote,$codigo_almacen,$date,1);

                                    if($perecedero == 0){
                                        $fecha_vencimiento = NULL;
                                        $guardar_producto_lote = $this->model->agregar_productos_lotes($id_item,$codigo_almacen,$codigo_lote,$p_id_producto,$precio,$precio_1,$precio_2,$precio_3,$precio_4,$cantidad,$perecedero,NULL,$codigo_usuario,$precio_5,$precio_6,$precio_7);
                                        if($guardar_producto_lote){
                                            
                                        }
                                    }else{
                                        $fecha_perecedera = $producto[10];
                                        $arrayfecha = explode('/',$fecha_perecedera);
                                        $fecha_1 = $arrayfecha[0];
                                        $fecha_2 = $arrayfecha[1];
                                        $fecha_3 = $arrayfecha[2];
                                        $fecha_4 = $arrayfecha[3];
                                        $fecha_vencimiento = $fecha_4; 
                                        $idperecedero = $this->generar_codigo_perecederos();
                                        $guardar_producto_lote = $this->model->agregar_productos_lotes($id_item,$codigo_almacen,$codigo_lote,$p_id_producto,$precio,$precio_1,$precio_2,$precio_3,$precio_4,$cantidad,$perecedero,$fecha_4,$codigo_usuario,$precio_5,$precio_6,$precio_7);
                                        if($guardar_producto_lote){
                                            $guardar_perecedero = $this->model->agregar_perecedero($idperecedero,$id_item,$p_id_producto,$codigo_almacen,$codigo_sucursal,$fecha_1,$fecha_2,$fecha_3,$fecha_4);
                                            
                                        }
                                    }
                                    
                                    $guardar_producto_compra = $this->model->agregar_productos_compra($id_item,$codigo_almacen,$codigo_lote,$p_id_producto,$precio,$precio_1,$precio_2,$precio_3,$precio_4,$cantidad,$perecedero,$codigo_compra,$fecha_vencimiento,$precio_5,$precio_6,$precio_7);
                                    if($guardar_producto_compra){
                                        
                                    }else{
                                        
                                    }
                                    $p_id_entrada = $this->generar_codigo_entradas();
                                    $p_mes = date("Y-m");
                                    $stock_global = mainModel::stock_global_producto($p_id_producto,$codigo_sucursal);
                                    $guardar_kardex = $this->model->agregar_kardex($p_id_entrada,$id_caja,$codigo_sucursal,$codigo_usuario,$id_item,$cantidad*$precio,$date_registro,2,$cantidad,0,$cantidad,$stock_global,"POR COMPRA #{$nro_compra}",$codigo_compra);
                                    if(!$guardar_kardex){
                                        echo 5;
                                    }
                                    // $guardar_entrada = $this->model->agregar_entrada($p_id_entrada,$p_mes,$date,$p_descripcion,$cantidad,$precio,$precio_1,$precio_2,$precio_3,$precio_4,$p_id_producto,$codigo_compra);
                                }
                                if($facturar_compra=="1"){
                                   $guardar = $this->guardar_libro_compra($codigo_sucursal,$codigo_compra,$nro_factura,$total,$codigo_control,$nro_autorizacion,$date,$descuento_compra);
                                   if($guardar == 1){
                                       echo "1|".mainModel::encryption($codigo_compra);
                                   }else{
                                       echo 2;
                                   }
                                }else{
                                    
                                    echo "1|".mainModel::encryption($codigo_compra);
                                }
                            }else{
                                echo 4;    
                            }
                        }else{
                            echo 2;
                        }
                    }else{
                        echo 3;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                           Vista compras por fecha                          */
/* ========================================================================== */

        function comprasporfecha(){
            $this->view->render('compras/comprasxfecha');
        }

/* ========================================================================== */
/*                           Lista compras por fecha                          */
/* ========================================================================== */

        function lista_compras_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_compras_2($date_1,$date_2,$sucursal);
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["SUCURSAL"];
                            $fecha_comprobante = date($row["FECHA_COMPROBANTE"]);
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $tipo_pago = $row["TIPO_PAGO"];
                                if($tipo_pago == 1){
                                    $tipo_pago = "<span class='badge badge-success'>CONTADO</span>";
                                }else{
                                    $tipo_pago = "<span class='badge badge-primary'>CREDITO</span>";
                                }
                                if($estado == 1){
                                    $estado = "<span class='badge badge-success'> Vigente </span>";
                                }else{
                                    $estado = "<span class='badge badge-danger'> Anulada </span>";
                                }
                                 $anular = "";
                                if($row["TIPO_PAGO"]==1&&$row["ESTADO"]){
                                    $anular = "<a class='dropdown-item btn_anular' id_c='{$row["ID_COMPRA"]}' numero_compra='{$row["N_COMPRA"]}' total='{$row["TOTAL"]}' id_arqueo='{$row["ID_ARQUEO"]}' estado='{$row["ESTADO"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                        Anular Compra
                                                    </a>";
                                }
                                    
                                if($row["TIPO_PAGO"]==4){
                                    $estado = "<span class='badge badge-primary'> Credito completado </span>";
                                }else if($row["TIPO_PAGO"]==2){
                                    $estado = "<span class='badge badge-warning'> Credito pendiente </span>";
                                }
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                    $table .= "
                                    <tr>
                                        <td>{$row["N_COMPRA"]}</td>
                                        <td>{$row["COMPROBANTE"]}</td>
                                        <td>{$row["N_COMPROBANTE"]}</td>
                                        <td class='text-center'>{$fecha_comprobante}</td>
                                        <td>{$row["LOTE"]}</td>
                                        <td class='text-center'>{$row["ALMACEN"]}</td>
                                        <td style='color: #8BC34A;font-weight: bold;'>{$row["RAZON"]}</td>
                                        <td>{$tipo_pago}</td>
                                        <td style='color: #FF5722;font-weight: bold;'>{$row["TOTAL"]}</td>
                                        <td>{$estado}</td>
                                        <td style='color: #FF9800;font-weight: bold;'>{$row["PERSONA"]}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>

                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                        Detalle Compra
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A4)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A5)
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
/*                        Reporte de compras por fecha                        */
/* ========================================================================== */

        function reporte_compras_fecha(){
            if(isset($_POST["fecha_1"]) && isset($_POST["fecha_2"]) && isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_compras_2($date_1,$date_2,$sucursal);
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["SUCURSAL"];
                            $fecha_comprobante = date($row["FECHA_COMPROBANTE"]);
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            
                            $tipo_pago = $row["TIPO_PAGO"];
                            if($tipo_pago == 1){
                                $tipo_pago = "<span class='badge badge-success'>CONTADO</span>";
                            }else{
                                $tipo_pago = "<span class='badge badge-primary'>CREDITO</span>";
                            }
                            if($estado == 1){
                                $estado = "<span class='badge badge-success'> Vigente </span>";
                            }else{
                                $estado = "<span class='badge badge-danger'> Anulado </span>";
                            }
                            
                            if($row["TIPO_PAGO"]==4){
                                $estado = "<span class='badge badge-primary'> Credito completado </span>";
                            }else if($row["TIPO_PAGO"]==2){
                                $estado = "<span class='badge badge-warning'> Credito pendiente </span>";
                            }
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                               $table .= "
                                    <tr>
                                        <td>{$row["N_COMPRA"]}</td>
                                        <td>{$row["COMPROBANTE"]}</td>
                                        <td>{$row["N_COMPROBANTE"]}</td>
                                        <td>{$fecha_comprobante}</td>
                                        <td>{$row["LOTE"]}</td>
                                        <td>{$row["ALMACEN"]}</td>
                                        <td>{$row["RAZON"]}</td>
                                        <td>{$tipo_pago}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$estado}</td>
                                        <td>
                                            <div class='d-flex'>
                                                <div class='usr-img-frame mr-2 rounded-circle'>
                                                    <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                </div>
                                                <p class='align-self-center mb-0'>{$row["PERSONA"]}</p>
                                            </div>
                                        </td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>

                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Compra
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A5)
                                                    </a>
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
/*                              Lista de compras                              */
/* ========================================================================== */

        function lista_compras(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_compras();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = $row["TIPO_PAGO"];
                            if($tipo_pago == 1){
                                $tipo_pago = "<span class='badge badge-success'>CONTADO</span>";
                            }else{
                                $tipo_pago = "<span class='badge badge-primary'>CREDITO</span>";
                            }
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-success'> Vigente </span>";
                            }else{
                                $estado = "<span class='badge badge-danger'> Anulada </span>";
                            }
                            $anular = "";
                            if($row["TIPO_PAGO"]==1&&$row["ESTADO"]){
                                $anular = "<a class='dropdown-item btn_anular' id_c='{$row["ID_COMPRA"]}' numero_compra='{$row["N_COMPRA"]}' total='{$row["TOTAL"]}' id_arqueo='{$row["ID_ARQUEO"]}' estado='{$row["ESTADO"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                    Anular Compra
                                                </a>";
                            }
                            if($row["TIPO_PAGO"]==4){
                                $estado = "<span class='badge badge-primary'> Credito completado </span>";
                            }else if($row["TIPO_PAGO"]==2){
                                $estado = "<span class='badge badge-warning'> Credito pendiente </span>";
                            }
                            if($sucursal == $sucursal_compra){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                $table .= "
                                <tr>
                                    <td>{$row["N_COMPRA"]}</td>
                                    <td>{$row["COMPROBANTE"]}</td>
                                    <td>{$row["N_COMPROBANTE"]}</td>
                                    <td class='text-center'>{$fecha_comprobante}</td>
                                    <td>{$row["LOTE"]}</td>
                                    <td class='text-center'>{$row["ALMACEN"]}</td>
                                    <td style='color: #8BC34A;font-weight: bold;'>{$row["RAZON"]}</td>
                                    <td>{$tipo_pago}</td>
                                    <td style='color: #FF5722;font-weight: bold;'>{$row["TOTAL"]}</td>
                                    <td>{$estado}</td>
                                    <td style='color: #FF9800;font-weight: bold;'>{$row["PERSONA"]}</td>
                                    <td class='text-center'>
                                        <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                            </a>

                                            <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                    Detalle Compra
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Compra (A4)
                                                </a>
                                                <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                    Imprimir Compra (A5)
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
/*                              Detalle de compra                             */
/* ========================================================================== */

        function detallecompra(){
            if(isset($_POST["id"])){
                $compra = $_POST["id"];
                $buscar_compra  = $this->model->detalle_compra($compra);
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
                            $response .= "{$row["FECHA_COMPRA"]}|{$tipo_pago}|{$row["RAZON"]}|{$row["DOCUMENTO"]}|{$row["N_DOCUMENTO"]}|{$row["N_COMPROBANTE"]}|{$row["COMPROBANTE"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}"; 
                        }
                        echo "1|$response";
                    }
                }else{  
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                   Lista de items del detalle de la compra                  */
/* ========================================================================== */

        function detallecompra_item(){
            if(isset($_POST["id"])){
                $compra = $_POST["id"];
                $buscar_items_compra  = $this->model->detalle_item_compra($compra);
                if($buscar_items_compra){
                    $response  = "";
                    if($buscar_items_compra->rowCount()>0){
                        foreach($buscar_items_compra as $row){
                            $fecha_vencimiento = $row["FECHA_VENCIMIENTO"];
                            if($fecha_vencimiento == "0000-00-00"){
                                $fecha_vencimiento = "No caducable";
                            }
                            $importe = floatval($row['CANTIDAD']*$row['PRECIO_COSTO']);
                            $response .="
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 700'>{$row['BARRA']}</td>
                                    <td>{$row['ARTICULO']}</td>
                                    <td>{$row['LINEA']}</td>
                                    <td>{$row['PRESENTACION']}</td>
                                    <td>{$row['CANTIDAD']}</td>
                                    <td>{$row['PRECIO_COSTO']}</td>
                                    <td>{$fecha_vencimiento}</td>
                                    <td>{$importe}</td>
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
/*                        Imprimir compra en formato A4                       */
/* ========================================================================== */

        function formatoA4($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_compra  = $this->model->detalle_compra($id);
                $response  = "";
                if($buscar_compra){
                    if($buscar_compra->rowCount()>0){
                        foreach($buscar_compra as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $response .= "{$row["SUCURSAL"]}|{$row["ID_PROVEEDOR"]}|{$row["ID_PERSONA"]}|{$row["FECHA_COMPRA"]}|{$tipo_pago}|{$row["RAZON"]}|{$row["DOCUMENTO"]}|{$row["N_DOCUMENTO"]}|{$row["N_COMPROBANTE"]}|{$row["COMPROBANTE"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["N_COMPRA"]}"; 
                        }
                    }
                }
                $res_array = explode("|",$response);
                $this->view->parametros_compra = $response;
                $this->view->id_compra = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[0]);
                $this->view->parametros_proveedor =mainModel::parametros_proveedor($res_array[1]);
                $this->view->parametros_persona =mainModel::parametros_persona($res_array[2]);
                $this->view->lista_items =$this->model->detalle_item_compra($id);
                $this->view->render("compras/formatoA4");
            }else{
                $this->view->render("error/404");
            }
        }

/* ========================================================================== */
/*                        Imprimir compra en formato A5                       */
/* ========================================================================== */

        function formatoA5($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_compra  = $this->model->detalle_compra($id);
                $response  = "";
                if($buscar_compra){
                    if($buscar_compra->rowCount()>0){
                        foreach($buscar_compra as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $response .= "{$row["SUCURSAL"]}|{$row["ID_PROVEEDOR"]}|{$row["ID_PERSONA"]}|{$row["FECHA_COMPRA"]}|{$tipo_pago}|{$row["RAZON"]}|{$row["DOCUMENTO"]}|{$row["N_DOCUMENTO"]}|{$row["N_COMPROBANTE"]}|{$row["COMPROBANTE"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["N_COMPRA"]}"; 
                        }
                    }
                }
                $res_array = explode("|",$response);
                $this->view->parametros_compra = $response;
                $this->view->id_compra = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[0]);
                $this->view->parametros_proveedor =mainModel::parametros_proveedor($res_array[1]);
                $this->view->parametros_persona =mainModel::parametros_persona($res_array[2]);
                $this->view->lista_items =$this->model->detalle_item_compra($id);
                $this->view->render("compras/formatoA5");
            }else{
                $this->view->render("error/404");
            }
        }

/* ========================================================================== */
/*                           Vista consulta compras                           */
/* ========================================================================== */
        function consultacompras(){
            $this->view->render('compras/consultacompras');
        }

/* ========================================================================== */
/*                           Vista cuentas por pagar                          */
/* ========================================================================== */

        function cuentasporpagar(){
            $this->view->render('compras/cuentasporpagar');
        }

/* ========================================================================== */
/*                        Lista de la cuentas por pagar                       */
/* ========================================================================== */

        function lista_cuentas_por_pagar(){
            if(isset($_POST["sucursal"])){
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_compras();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = $row["TIPO_PAGO"];
                            if($tipo_pago == 2){
                                $tipo_pago = "CREDITO";
                                $estado = $row["ESTADO"];
                                $sucursal_compra = $row["SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                if($estado == 1){
                                    $estado = "<span class='badge badge-success'> Vigente </span>";
                                }else{
                                    $estado = "<span class='badge badge-danger'> Anulada </span>";
                                }
                                if($sucursal == $sucursal_compra){
                                    $enlace = SERVERURL;
                                    $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                    $table .= "
                                    <tr>
                                        <td>{$row["COMPROBANTE"]}</td>
                                        <td>{$row["N_COMPROBANTE"]}</td>
                                        <td>{$fecha_comprobante}</td>
                                        <td>{$row["LOTE"]}</td>
                                        <td>{$row["ALMACEN"]}</td>
                                        <td>{$row["RAZON"]}</td>
                                        <td>{$tipo_pago}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$estado}</td>
                                        <td>{$row["PERSONA"]}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                            <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
                                                
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Compra
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A4)
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A5)
                                                            </a>
                                                    <a class='dropdown-item' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>                                                         
                                                        Anular Compra
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
                    }
                }
            }
        }

/* ========================================================================== */
/*                          View Historico de preciso                         */
/* ========================================================================== */

        function historicoprecios(){
            $this->view->lista_productos = $this->lista_productos();
            $this->view->render('compras/historicodeprecios');
        }

/* ========================================================================== */
/*                       Lista de productos en un option                      */
/* ========================================================================== */

        function lista_productos(){
            $lista = $this->model->lista_productos();
            if($lista){
                $option = "<option disabled selected>Seleccionar Producto ...</option>";
                if($lista->rowCount()>0){
                    foreach($lista as $row){
                        $option .= "
                            <option value='{$row["ID_PRODUCTO"]}' >{$row["BARRA"]} | {$row["ARTICULO"]} | {$row["LINEA"]}</option>
                        ";
                    }
                }
                return $option;
            }else{
                return false;
            }
        }

/* ========================================================================== */
/*                 Lista de historico de precios por producto                 */
/* ========================================================================== */

        function lista_historico_precios_producto(){
            if(isset($_POST["producto"])){
                $producto =  $_POST["producto"];
                $sucursal =  $_POST["sucursal"];
                $lista_historicos = $this->model->lista_historicos();
                if($lista_historicos){
                    if($lista_historicos->rowCount()>0){
                        $table = "";
                        $n = 1;
                        foreach($lista_historicos as $row){
                            if($row["ID_PRODUCTO"] == $producto && $row["ID_SUCURSAL"] == $sucursal){
                                $imagen = SERVERURL."archives/assets/productos/{$row["IMAGEN"]}";
                                $table .= "
                                <tr>
                                    <td>{$n}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td>{$row["ARTICULO"]}</td>
                                    <td>{$row["LINEA"]}</td>
                                    <td>{$row["PRESENTACION"]}</td>
                                    <td>{$row["RAZON"]}</td>
                                    <td style='color: #8BC34A;font-weight: bold;'>{$row["PRECIO_COSTO"]}</td>
                                    <td>{$row["FECHA_COMPRA"]}</td>
                                </tr>";
                                $n++;
                            }
                        }
                        echo $table;
                    }else{
                        echo 2;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                         Vista compras por proveedor                        */
/* ========================================================================== */
        function comprasporproveedor(){
            $this->view->listaproveedores = $this->lista_proveedores();
            $this->view->render('compras/comprasxproveedor');
        }

/* ========================================================================== */
/*                       Lista de compras pro proveedor                       */
/* ========================================================================== */

        function lista_compras_proveedor(){
            if(isset($_POST["proveedor"])){
                $proveedor =  $_POST["proveedor"];
                $sucursal =  $_POST["sucursal"];
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_compras = $this->model->lista_compras();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = $row["TIPO_PAGO"];
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                                $estado = $row["ESTADO"];
                                $sucursal_compra = $row["SUCURSAL"];
                                $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                if($estado == 1){
                                    $estado = "<span class='badge badge-success'> Vigente </span>";
                                }else{
                                    $estado = "<span class='badge badge-danger'> Anulada </span>";
                                }
                                if($sucursal == $sucursal_compra && $row["ID_PROVEEDOR"]==$proveedor){
                                    $fecha_comprobante = date($row["FECHA_COMPROBANTE"]);
                                    if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                        $enlace = SERVERURL;
                                        $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                        $table .= "
                                            <tr>
                                                <td>{$row["N_COMPRA"]}</td>
                                                <td>{$row["COMPROBANTE"]}</td>
                                                <td>{$row["N_COMPROBANTE"]}</td>
                                                <td>{$fecha_comprobante}</td>
                                                <td>{$row["LOTE"]}</td>
                                                <td>{$row["ALMACEN"]}</td>
                                                <td>{$row["RAZON"]}</td>
                                                <td>{$tipo_pago}</td>
                                                <td>{$row["TOTAL"]}</td>
                                                <td>{$estado}</td>
                                                <td>
                                                    <div class='d-flex'>
                                                        <div class='usr-img-frame mr-2 rounded-circle'>
                                                            <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                        </div>
                                                        <p class='align-self-center mb-0'>{$row["PERSONA"]}</p>
                                                    </div>
                                                </td>
                                                <td class='text-center'>
                                                    <div class='dropdown dropup custom-dropdown-icon'>
                                                        <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                        </a>
    
                                                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                            <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                    Detalle Compra
                                                            </a>
                                                            <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                Imprimir Compra (A4)
                                                            </a>
                                                            <a class='dropdown-item'  href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                                Imprimir Compra (A5)
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
/*                        Vista de compras por detalle                        */
/* ========================================================================== */

        function compraspordetalle(){
            $this->view->render('compras/comprasxdetalle');
        }

/* ========================================================================== */
/*                   Funcion reporte de compras con detalle                   */
/* ========================================================================== */

        function reporte_compras_detalle(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $sucursal = $_POST["sucursal"];
                $lista_compras = $this->model->lista_compras();
                $parametros = mainModel::parametros_sucursal($sucursal);
                $moneda = $parametros["MONEDA"];
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $estado = 1;
                            $sucursal_compra = $row["SUCURSAL"];
                            $fecha_comprobante = date($row["FECHA_COMPROBANTE"]);
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                                $tipo_pago = $row["TIPO_PAGO"];
                                if($tipo_pago == 1){
                                    $tipo_pago = "CONTADO";
                                }else{
                                    $tipo_pago = "CREDITO";
                                }
                                if($estado == 1){
                                    $estado = "<span class='badge badge-success'> Vigente </span>";
                                }
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                $lista_items = "";
                                $lista_items_compras = $this->model->lista_items_compra();
                                foreach ($lista_items_compras as $key => $value) {
                                    if($value["ID_COMPRA"] == $row["ID_COMPRA"]){
                                        $lista_items .= "CANT. {$value["CANTIDAD"]} - {$value["ARTICULO"]}, {$value["LINEA"]} - PRECIO. {$moneda} {$value["PRECIO_COSTO"]} <span style='color:#FF5722;font-weight:bold;'>|</span> ";
                                    }
                                }
                                if($sucursal == $sucursal_compra){
                                   $table .= "
                                        <tr>
                                            <td>{$row["N_COMPRA"]}</td>
                                            <td>{$row["COMPROBANTE"]} {$row["N_COMPROBANTE"]}</td>
                                            <td>{$fecha_comprobante}</td>
                                            <td>{$lista_items}</td>
                                            <td>{$tipo_pago}</td>
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$estado}</td>
                                            <td>
                                                <div class='d-flex'>
                                                    <div class='usr-img-frame mr-2 rounded-circle'>
                                                        <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                    </div>
                                                    <p class='align-self-center mb-0'>{$row["PERSONA"]}</p>
                                                </div>
                                            </td>
                                            <td class='text-center'>
                                                <div class='dropdown dropup custom-dropdown-icon'>
                                                    <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                    </a>
    
                                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                        <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                Detalle Compra
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A4)
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A5)
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
/*                        Vista creditos por proveedor                        */
/* ========================================================================== */

        function creditosporproveedor(){
            $this->view->listaproveedores = $this->lista_proveedores();
            $this->view->render("compras/creditosxproveedor");
        }

/* ========================================================================== */
/*                          vista creditos por fecha                          */
/* ========================================================================== */

        function creditosporfecha(){
            $this->view->listaproveedores = $this->lista_proveedores();
            $this->view->render("compras/creditosxfecha");
        }

/* ========================================================================== */
/*                         vista creditos por detalle                         */
/* ========================================================================== */

        function creditospordetalle(){
            $this->view->listaproveedores = $this->lista_proveedores();
            $this->view->render("compras/creditosxdetalle");
        }

/* ========================================================================== */
/*                       Reporte creditos por proveedor                       */
/* ========================================================================== */

        function reporte_creditos_proveedor(){
            if(isset($_POST["proveedor"])){
                $proveedor =  $_POST["proveedor"];
                $sucursal =  $_POST["sucursal"];
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_compras = $this->model->lista_creditos_de_compra();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = "CREDITO";
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> Pendiente </span>";
                            }else{
                                $estado = "<span class='badge badge-success'> Completado </span>";
                            }
                            $fecha_pago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                            $badge_pago = "";
                            if(date("Y-m-d")>$fecha_pago){
                                $badge_pago = "<span class='badge badge-danger'> {$fecha_pago} </span>";
                            }else{
                                $badge_pago = "<span class='badge badge-success'> {$fecha_pago} </span>";
                            }
                            if($sucursal == $sucursal_compra && $row["ID_PROVEEDOR"]==$proveedor){
                                if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                    $enlace = SERVERURL;
                                    $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                    $table .= "
                                        <tr>
                                            <td>{$row["N_COTIZACION"]}</td>
                                            <td>{$row["N_COMPRA"]}</td>
                                            <td>{$fecha_comprobante}</td>
                                            <td>{$row["RAZON"]}</td>
                                            <td>{$tipo_pago}</td>
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$row["PAGADO"]}</td>
                                            <td>{$row["PENDIENTE"]}</td>
                                            <td>{$badge_pago}</td>
                                            <td>{$estado}</td>
                                            <td>
                                                <div class='d-flex'>
                                                    <div class='usr-img-frame mr-2 rounded-circle'>
                                                        <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                    </div>
                                                    <p class='align-self-center mb-0'>{$row["NOMBRES"]}</p>
                                                </div>
                                            </td>
                                            <td class='text-center'>
                                                <div class='dropdown dropup custom-dropdown-icon'>
                                                    <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                    </a>
        
                                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                        <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                Detalle Compra
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A4)
                                                        </a>
                                                        <a class='dropdown-item'  href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A5)
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
/*                         Reporte creditos por fecha                         */
/* ========================================================================== */
        function lista_de_creditos_pagar(){
            if(isset($_POST["sucursal"])){
                $sucursal =  $_POST["sucursal"];

                $lista_compras = $this->model->lista_creditos_de_compra();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = "CREDITO";
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> Pendiente </span>";
                            }else{
                                $estado = "<span class='badge badge-success'> Completado </span>";
                            }
                            $fecha_pago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                            $badge_pago = "";
                            if(date("Y-m-d")>$fecha_pago){
                                $badge_pago = "<span class='badge badge-danger'> {$fecha_pago} </span>";
                            }else{
                                $badge_pago = "<span class='badge badge-success'> {$fecha_pago} </span>";
                            }
                            if($sucursal == $sucursal_compra){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                $table .= "
                                    <tr>
                                        <td>{$row["N_COTIZACION"]}</td>
                                        <td>{$row["N_COMPRA"]}</td>
                                        <td>{$fecha_comprobante}</td>
                                        <td>{$row["RAZON"]}</td>
                                        <td>{$tipo_pago}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$row["PAGADO"]}</td>
                                        <td>{$row["PENDIENTE"]}</td>
                                        <td>{$badge_pago}</td>
                                        <td>{$estado}</td>
                                        <td>
                                            <div class='d-flex'>
                                                <div class='usr-img-frame mr-2 rounded-circle'>
                                                    <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                </div>
                                                <p class='align-self-center mb-0'>{$row["NOMBRES"]}</p>
                                            </div>
                                        </td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
    
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Compra
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A4)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A5)
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
        function reporte_creditos_fecha(){
            if(isset($_POST["sucursal"])){
                $sucursal =  $_POST["sucursal"];
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_compras = $this->model->lista_creditos_de_compra();
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = "CREDITO";
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> Pendiente </span>";
                            }else{
                                $estado = "<span class='badge badge-success'> Completado </span>";
                            }
                            $fecha_pago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                            $badge_pago = "";
                            if(date("Y-m-d")>$fecha_pago){
                                $badge_pago = "<span class='badge badge-danger'> {$fecha_pago} </span>";
                            }else{
                                $badge_pago = "<span class='badge badge-success'> {$fecha_pago} </span>";
                            }
                            if($sucursal == $sucursal_compra){
                                if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                    $enlace = SERVERURL;
                                    $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                    $table .= "
                                        <tr>
                                            <td>{$row["N_COTIZACION"]}</td>
                                            <td>{$row["N_COMPRA"]}</td>
                                            <td>{$fecha_comprobante}</td>
                                            <td>{$row["RAZON"]}</td>
                                            <td>{$tipo_pago}</td>
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$row["PAGADO"]}</td>
                                            <td>{$row["PENDIENTE"]}</td>
                                            <td>{$badge_pago}</td>
                                            <td>{$estado}</td>
                                            <td>
                                                <div class='d-flex'>
                                                    <div class='usr-img-frame mr-2 rounded-circle'>
                                                        <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                    </div>
                                                    <p class='align-self-center mb-0'>{$row["NOMBRES"]}</p>
                                                </div>
                                            </td>
                                            <td class='text-center'>
                                                <div class='dropdown dropup custom-dropdown-icon'>
                                                    <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                    </a>
        
                                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                        <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                Detalle Compra
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A4)
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A5)
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
/*                          Reporte creditos detalle                          */
/* ========================================================================== */

        function reporte_creditos_detalle(){
            if(isset($_POST["sucursal"])){
                $sucursal =  $_POST["sucursal"];
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_compras = $this->model->lista_creditos_de_compra();
                $parametros = mainModel::parametros_sucursal($sucursal);
                $moneda = $parametros["MONEDA"];
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = "CREDITO";
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> Pendiente </span>";
                            }else{
                                $estado = "<span class='badge badge-success'> Completado </span>";
                            }
                            $fecha_pago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                            $badge_pago = "";
                            if(date("Y-m-d")>$fecha_pago){
                                $badge_pago = "<span class='badge badge-danger'> {$fecha_pago} </span>";
                            }else{
                                $badge_pago = "<span class='badge badge-success'> {$fecha_pago} </span>";
                            }
                            $lista_items = "";
                            $lista_items_compras = $this->model->lista_items_compra();
                            foreach ($lista_items_compras as $key => $value) {
                                if($value["ID_COMPRA"] == $row["ID_COMPRA"]){
                                    $lista_items .= "CANT. {$value["CANTIDAD"]} - {$value["ARTICULO"]}, {$value["LINEA"]} - PRECIO. {$moneda} {$value["PRECIO_COSTO"]} <br> <hr>";
                                }
                            }
                            if($sucursal == $sucursal_compra){
                                if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                    $enlace = SERVERURL;
                                    $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                    $table .= "
                                        <tr>
                                            <td>{$row["N_COTIZACION"]}</td>
                                            <td>{$row["N_COMPRA"]}</td>
                                            <td>{$row["RAZON"]}</td>
                                            <td>{$lista_items}</td>
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$row["PAGADO"]}</td>
                                            <td>{$row["PENDIENTE"]}</td>
                                            <td>{$badge_pago}</td>
                                            <td>{$estado}</td>
                                            <td>
                                                <div class='d-flex'>
                                                    <div class='usr-img-frame mr-2 rounded-circle'>
                                                        <img alt='perfil' class='img-fluid rounded-circle' src='{$perfil}' style='width:100%'>
                                                    </div>
                                                    <p class='align-self-center mb-0'>{$row["NOMBRES"]}</p>
                                                </div>
                                            </td>
                                            <td class='text-center'>
                                                <div class='dropdown dropup custom-dropdown-icon'>
                                                    <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                    </a>
        
                                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                        <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                Detalle Compra
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A4)
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A5)
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
/*                        Reporte de cuentas por pagar                        */
/* ========================================================================== */

        function reporte_cuentas_pagar(){
            if(isset($_POST["sucursal"])){
                $sucursal =  $_POST["sucursal"];
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $lista_compras = $this->model->lista_creditos_de_compra();
                $parametros = mainModel::parametros_sucursal($sucursal);
                $moneda = $parametros["MONEDA"];
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = "CREDITO";
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> Pendiente </span>";
                            }else{
                                $estado = "<span class='badge badge-success'> Completado </span>";
                            }
                            $fecha_pago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                            $badge_pago = "";
                            if(date("Y-m-d")>$fecha_pago){
                                $badge_pago = "<span class='badge badge-danger'> {$fecha_pago} </span>";
                            }else{
                                $badge_pago = "<span class='badge badge-success'> {$fecha_pago} </span>";
                            }
                            if($sucursal == $sucursal_compra){
                                if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                    $enlace = SERVERURL;
                                    $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                    $table .= "
                                        <tr>
                                            <td>{$row["N_COTIZACION"]}</td>
                                            <td>{$row["N_COMPRA"]}</td>
                                            <td>{$row["FECHA_COMPROBANTE"]}</td>
                                            <td>{$row["RAZON"]}</td>
                                            <td>{$row["TOTAL"]}</td>
                                            <td>{$row["PAGADO"]}</td>
                                            <td>{$row["PENDIENTE"]}</td>
                                            <td>{$badge_pago}</td>
                                            <td>{$estado}</td>
                                            <td style='color: #FF9800;font-weight: bold;'>{$row["NOMBRES"]}</td>
                                            <td class='text-center'>
                                                <div class='dropdown dropup custom-dropdown-icon'>
                                                    <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                    </a>
        
                                                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                        <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                                Detalle Compra
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A4)
                                                        </a>
                                                        <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                            Imprimir Compra (A5)
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
                        echo "";
                    }
                }else{
                    echo "0";
                }
            }
        }
        function reporte_cuentas_pagar_lista(){
            if(isset($_POST["sucursal"])){
                $sucursal =  $_POST["sucursal"];
                date_default_timezone_set(ZONEDATE);
   
                $lista_compras = $this->model->lista_creditos_de_compra();
                $parametros = mainModel::parametros_sucursal($sucursal);
                $moneda = $parametros["MONEDA"];
                if($lista_compras){
                    if($lista_compras->rowCount()>0){
                        $table = "";
                        foreach($lista_compras as $row){
                            $tipo_pago = "CREDITO";
                            $estado = $row["ESTADO"];
                            $sucursal_compra = $row["ID_SUCURSAL"];
                            $fecha_comprobante = $row["FECHA_COMPROBANTE"];
                            $perfil = SERVERURL."archives/avatars/{$row["PERFIL"]}";
                            if($estado == 1){
                                $estado = "<span class='badge badge-info'> Pendiente </span>";
                            }else{
                                $estado = "<span class='badge badge-success'> Completado </span>";
                            }
                            $fecha_pago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                            $badge_pago = "";
                            if(date("Y-m-d")>$fecha_pago){
                                $badge_pago = "<span class='badge badge-danger'> {$fecha_pago} </span>";
                            }else{
                                $badge_pago = "<span class='badge badge-success'> {$fecha_pago} </span>";
                            }
                            if($sucursal == $sucursal_compra){
                                $enlace = SERVERURL;
                                $id_encryptado = mainModel::encryption($row["ID_COMPRA"]);
                                $table .= "
                                    <tr>
                                        <td>{$row["N_COTIZACION"]}</td>
                                        <td>{$row["N_COMPRA"]}</td>
                                        <td>{$row["FECHA_COMPROBANTE"]}</td>
                                        <td>{$row["RAZON"]}</td>
                                        <td>{$row["TOTAL"]}</td>
                                        <td>{$row["PAGADO"]}</td>
                                        <td>{$row["PENDIENTE"]}</td>
                                        <td>{$badge_pago}</td>
                                        <td>{$estado}</td>
                                        <td style='color: #FF9800;font-weight: bold;'>{$row["NOMBRES"]}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
    
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$row["ID_COMPRA"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Compra
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A4)
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}compras/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Compra (A5)
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
                        echo "";
                    }
                }else{
                    echo "0";
                }
            }
        }

/* ========================================================================== */
/*                                Anular compra                               */
/* ========================================================================== */

        function anular_compra(){
            if(isset($_POST["id_c"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $evaluar_productos = $this->model->detalle_productos_compra($_POST["id_c"]);
                if($evaluar_productos){
                    $apto = true;
                    foreach($evaluar_productos as $p){
                        if($p["STOCK_LOTE"]!=$p["STOCK_COMPRA"]){
                            $apto = false;
                        }
                    }
                    if($apto){
                        $codigo_usuario =  $_SESSION["usuario"];
                        $id_caja = $_SESSION["caja"];
                        $codigo_sucursal =  $_SESSION["sucursal"];
                        $date_registro = date('Y-m-d H:i:s');
                        $total = floatval($_POST["total"]);
                        $id_arqueo = $_POST["id_arqueo"];
                        $anular = $this->model->anular_compra($_POST["id_c"]);
                        if($anular){
                            if($anular->rowCount()>0){
                                $buscar_items_compra  = $this->model->detalle_item_compra($_POST["id_c"]);
                                if($buscar_items_compra->rowCount()>0){
                                    foreach($buscar_items_compra as $row){
                                        $id_item = $row["ID_ITEM"];
                                        $cantidad_item = $row["CANTIDAD"];
        
                                        $id_producto = $row["ID_PRODUCTO"];
        
                                        $devolver = $this->model->devolver_producto_compra($row["ID_ITEM"],$row["CANTIDAD"]);
                                        if(!$devolver){
                                            echo 4;
                                        }
                                        $p_id_entrada = $this->generar_codigo_entradas();
                                        
                                        $p_mes = date("Y-m");
                                        
                                        $stock_global = mainModel::stock_global_producto($id_producto,$codigo_sucursal);
        
                                        if($anular){
                                            $guardar_kardex = $this->model->agregar_kardex($p_id_entrada,$id_caja,$codigo_sucursal,$codigo_usuario,$row["ID_ITEM"],$row["PRECIO_COSTO"]*$row["CANTIDAD"],$date_registro,1,0,$row["CANTIDAD"],0,$stock_global,"COMPRA #{$_POST["numero_compra"]} ANULADA",NULL);
                                            if(!$guardar_kardex){
                                                echo 5;
                                            }
                                        }
                                    }
                                }
                                echo 1;
                            }
                        }else{
                            
                        }
                    }else{
                        echo 3;
                    }

            }
                
            }
        }

/* ========================================================================== */
/*                             View Pagar creditos                            */
/* ========================================================================== */

        function pagarcreditos(){
            $this->view->listaproveedores = $this->lista_proveedores();
            $this->view->render('compras/pagarcreditos');
        }

        function buscar_credito_proveedor(){
            if($_POST["id_proveedor"]){
                date_default_timezone_set(ZONEDATE);
                $id_proveedor = $_POST["id_proveedor"];
                $sucursal = $_POST["sucursal"];
                $lista_creditos = $this->model->lista_creditos_de_compra();
                if($lista_creditos){
                    $table = "";
                    foreach($lista_creditos as $row){
                        if($row["ID_SUCURSAL"] == $sucursal){
                            if($row["ID_PROVEEDOR"] == $id_proveedor){
                                if($row["ESTADO"] == 1){
                                    $date = date("Y-m-d");
                                    $fechapago = date("Y-m-d",strtotime($row["FECHA_PAGO"]));
                                    $td_fecha = "<td style='color: #FF9800;font-weight: bold;'>{$fechapago}</td>";
                                    if($date>$fechapago){
                                        $td_fecha = "<td style='color: #F44336;font-weight: bold;'>{$fechapago}</td>";
                                    }
                                    $proveedor = strtoupper("{$row["RAZON"]}");
                                    $table .= "
                                        <tr>
                                            <td style='color: #03A9F4;font-weight: bold;'>{$proveedor}</td>
                                            {$td_fecha}
                                            <td style='color: #673AB7;font-weight: bold;'>{$row["N_COMPRA"]}</td>
                                            <td style='color: #673AB7;font-weight: bold;'>{$row["TOTAL"]}</td>
                                            <td style='color: #F44336;font-weight: bold;'>{$row["PENDIENTE"]}</td>
                                            <td>
                                                <button class='btn btn-success mb-2 mr-2 btn_credito' id_credito='{$row["ID_CREDITO"]}' id_compra='{$row["ID_COMPRA"]}'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check-circle'><path d='M22 11.08V12a10 10 0 1 1-5.93-9.14'></path><polyline points='22 4 12 14.01 9 11.01'></polyline></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    ";
                                }
                            }
                        }
                    }
                    echo $table;
                }
            }
        }

        function infopagocredito(){
            if(isset($_POST["id_credito"])){
                $buscar_credito = $this->model->buscar_credito_de_compra($_POST["id_credito"]);
                if($buscar_credito){
                    $detalle = "";
                    foreach($buscar_credito as $b){
                        $detalle .= "{$b["ID_CREDITO"]}|{$b["N_COTIZACION"]}|{$b["N_COMPRA"]}|{$b["TOTAL"]}|{$b["PAGADO"]}|{$b["PENDIENTE"]}|{$b["RAZON"]}";
                    }
                    echo "1|$detalle";
                }else{
                    echo 0;
                }
            }
        }

        function generar_codigo_pago(){
            $numero = $this->model->lista_de_pagos_credito();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('PAGO',6,$numero);
                return $numero+1;
            }else{
                return 0;
            }
        }

        function generar_codigo_movimiento(){
            $numero = $this->model->lista_de_movimientos();
            if($numero){
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio("MOVI",4,$numero);
                return $numero+1;
            }else{
                return 0; 
            }
        }

        function pago_cuentas_pagar(){
            if(isset($_POST["id_credito"])){
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $codigo_usuario =  $_SESSION["usuario"];
                $id_caja = $_SESSION["caja"];
                $codigo_sucursal =  $_SESSION["sucursal"];

                $date_registro = date('Y-m-d H:i:s');
                $id_credito = $_POST["id_credito"];
                $parametros_credito_compra = mainModel::parametros_credito_compra($id_credito);

                $estado = $parametros_credito_compra["ESTADO"];
                if($estado == "1"){

                    $n_credito = $parametros_credito_compra["N_COTIZACION"];
                    $id_compra = $parametros_credito_compra["ID_COMPRA"];
                    $total = floatval($parametros_credito_compra["TOTAL"]);
                    $pagado = floatval($parametros_credito_compra["PAGADO"]);
                    $pendiente = floatval($parametros_credito_compra["PENDIENTE"]);

                    $monto_abono = floatval($_POST["monto_abono"]);
                    $pago_con = floatval($_POST["pago_con"]);
                    $cambio = floatval($_POST["cambio"]);

                    $credito_pagado = floatval($pagado + $monto_abono);
                    $credito_pendiente = floatval($pendiente - $monto_abono);

                    if($credito_pagado==$total){
                        $estado = 0;
                        $cambiar_estado = $this->model->cambiar_estado_compra_pagado($id_compra);
                        if(!$cambiar_estado){
                            echo 5;
                        }
                    }else{
                        $estado = 1;
                    }
                    $id_pago = $this->generar_codigo_pago();
                    $abono = $this->model->abono_credito_de_compra($id_credito,$credito_pagado,$credito_pendiente,$estado);
                    if($abono){
                        $pago = $this->model->agregar_pago_credito($id_pago,$id_credito,$id_caja,$codigo_usuario,$codigo_sucursal,$monto_abono,$pago_con,$cambio,$date_registro,1,$credito_pendiente);
                        if(!$pago){
                            echo 3;
                        }
                        
                        echo "1|".mainModel::encryption($id_pago);
                    }
                }else{
                    echo 2;
                }
            }
        }

        function lista_items_compra(){
            if(isset($_POST["id_compra"])){
                $buscar_items_compra  = $this->model->detalle_item_compra($_POST["id_compra"]);
                if($buscar_items_compra){
                    $response  = "";
                    if($buscar_items_compra->rowCount()>0){
                        foreach($buscar_items_compra as $row){
                            $imagen = SERVERURL . "archives/assets/productos/{$row["IMAGEN"]}";
                            $button = "
                            <button class='btn btn-outline-secondary btn-block'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                {$row["BARRA"]}
                            </button>";
                            $response .= "<div class='items' id_producto='{$row['ID_PRODUCTO']}' articulo = '{$row["ARTICULO"]}' id='item_{$row["ID_PRODUCTO"]}' perecedero='{$row['PERECEDERO']}'>
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
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Costo</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_COSTO"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 1</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio1_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_1"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 2</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio2_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_2"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 3</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio3_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_3"]}' class='form-control'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 4</span>
                                                        <div class='user-location'>
                                                            <input disabled type='text' id='precio4_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_4"]}' class='form-control'>
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
        function pagosrealizados(){
            $this->view->render('compras/pagos_realizados');
        }
        function lista_pagos_credito(){
            if(isset($_POST["sucursal"])){
                $pagos = $this->model->lista_pagos_credito();
                if($pagos){
                    $table = "";
                    foreach($pagos as $p){
                        if($p["ID_SUCURSAL"] == $_POST["sucursal"]){
                            $estado = $p["ESTADO_COMPRA"];
                            if($estado==4){
                                $estado = "<span class='badge badge-success'>COMPLETADO</span>";
                            }else{
                                $estado = "<span class='badge badge-warning'>PENDIENTE</span>";
                            }
                            $enlace = SERVERURL;
                            $table .= "
                                <tr>
                                    <td style='color: #2196f3;font-weight: bold;'>{$p["FECHA_REGISTRO"]}</td>
                                    <td>{$p["N_CREDITO"]}</td>
                                    <td>{$p["N_COMPRA"]}</td>
                                    <td style='color: #9C27B0;font-weight: bold;'>{$p["PROVEEDOR"]}</td>
                                    <td  style='color: #009688;font-weight: bold;'>{$p["TOTAL"]}</td>
                                    <td  style='color: #2196f3;font-weight: bold;'>{$p["PAGADO_AC"]}</td>
                                    <td  style='color: #8dbf42;font-weight: bold;'>{$p["MONTO"]}</td>
                                    <td>{$p["PAGO_CON"]}</td>
                                    <td>{$p["CAMBIO"]}</td>
                                    <td>{$estado}</td>
                                    <td  style='color: #e2a03f;font-weight: bold;'>{$p["VENDEDOR"]}</td>
                                    <td class='text-center'>
                                        <a href='{$enlace}compras/ticketpago/".mainModel::encryption($p["ID_PAGO"])."' target='_blank' class='btn btn-primary mb-2 mr-2'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg></a>
                                    </td>
                                </tr>
                            ";
                        }
                    }
                    echo $table;
                }
            }
        }
        function lista_pagos_credito_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $pagos = $this->model->lista_pagos_credito();
                if($pagos){
                    $table = "";
                    foreach($pagos as $p){
                        if($p["ID_SUCURSAL"] == $_POST["sucursal"]){
                            $fecha_comprobante = date("Y-m-d",strtotime($p["FECHA_REGISTRO"]));
                            if($fecha_comprobante >= $date_1 && $fecha_comprobante <= $date_2){
                                $estado = $p["ESTADO_COMPRA"];
                                if($estado==1){
                                    $estado = "<span class='badge badge-success'>COMPLETADO</span>";
                                }else{
                                    $estado = "<span class='badge badge-warning'>PENDIENTE</span>";
                                }
                                $enlace = SERVERURL;
                                $table .= "
                                    <tr>
                                        <td style='color: #2196f3;font-weight: bold;'>{$p["FECHA_REGISTRO"]}</td>
                                        <td>{$p["N_CREDITO"]}</td>
                                        <td>{$p["N_COMPRA"]}</td>
                                        <td style='color: #9C27B0;font-weight: bold;'>{$p["PROVEEDOR"]}</td>
                                        <td  style='color: #009688;font-weight: bold;'>{$p["TOTAL"]}</td>
                                        <td  style='color: #2196f3;font-weight: bold;'>{$p["PENDIENTE"]}</td>
                                        <td  style='color: #8dbf42;font-weight: bold;'>{$p["MONTO"]}</td>
                                        <td>{$p["PAGO_CON"]}</td>
                                        <td>{$p["CAMBIO"]}</td>
                                        <td>{$estado}</td>
                                        <td  style='color: #e2a03f;font-weight: bold;'>{$p["VENDEDOR"]}</td>
                                        <td class='text-center'>
                                            <a href='{$enlace}compras/ticketpago/".mainModel::encryption($p["ID_PAGO"])."' target='_blank' class='btn btn-primary mb-2 mr-2'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg></a>
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
            }
        }
        function ticketpago($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $pago = mainModel::parametros_pago_credito(mainModel::decryption($id));
                $this->view->parametros_pago_credito = mainModel::parametros_pago_credito(mainModel::decryption($id));
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($pago['ID_SUCURSAL']);
                $this->view->render('compras/ticket_pago');
            }
        }
        function dosificacion_compra($codigo_compra,$nro_factura,$monto_a_pagar,$date_compra,$id_sucursal,$codigo_control,$nro_autorizacion){
            

        }
        function codigo_libro_sucursal($id){
            $numero = $this->model->lista_libro_compra_sucursal($id);
            if($numero){
                $numero = $numero->rowCount()+1;
                return $numero;
            }else{
                return 0;
            }
        }
        function generar_codigo_libro(){
            $numero = $this->model->lista_libro_compra();
            if($numero){
                $numero = $numero->rowCount()+1;
                // return "L".str_pad($numero, 6, "0",STR_PAD_LEFT);
                return $numero;
            }else{
                return 0;
            }
        }
        function librocompra(){
            $this->view->render('compras/librocompras');
        }
        function guardar_libro_compra($id_sucursal,$codigo_compra,$nro_compra,$total,$codigo_control,$Numero_Autorizacion,$date_compra,$descuento_compra){
            $id = $this->generar_codigo_libro();
            $total = strval(round($total));
            $nro_dosificaciones = $this->codigo_libro_sucursal($id_sucursal);
            $guardar_libro = $this->model->guardar_libro($id,$nro_dosificaciones,$date_compra,$Numero_Autorizacion,$Llave_autorizacion,$date_compra,$codigo_compra,$nro_compra,$total,$codigo_control,$id_sucursal,$descuento_compra);
            if($guardar_libro){
                return 1;
            }else{
                return 2;
            }
        }
         function compraivalibro(){
            if(isset($_POST['sucursal'])){
                $consultalibroventas = $this->model->lista_libro_compra_sucursal($_POST['sucursal']);
                if($consultalibroventas){
                    $registros = "";
                    foreach($consultalibroventas as $p){
                        $descuento = number_format(floatval($p['DESCUENTO']),2);
                        $total = number_format(floatval($p['TOTAL']),2);
                        $importecreditofiscal = number_format(floatval($p['TOTAL'])-floatval($p['DESCUENTO']),2);
                        $impuesto = number_format((floatval($p['TOTAL'])-floatval($p['DESCUENTO']))*0.13,2);
                        $estado = $p['ESTADO']==1?'V':'A';
                        $dia = date("d/m/Y",strtotime($p['FECHA_EMISION']));
                        
                        $registros .= "
                        <tr>
                            <td>1</td>
                            <td>{$p['NRO']}</td>
                            <td>{$dia}</td>
                            <td>{$p['N_DOCUMENTO']}</td>
                            <td>{$p['RAZON']}</td>
                            <td>{$p['NRO_FACTURA']}</td>
                            <td>0</td>
                            <td>{$p['NRO_AUTORIZACION']}</td>
                            <td>{$total}</td>
                            <td>{$total}</td>
                            <td>{$total}</td>
                            <td>{$descuento}</td>
                            <td>{$importecreditofiscal}</td>
                            <td>{$impuesto}</td>
                            <td>{$p['CODIGO_CONTROL']}</td>
                            <td>1</td>
                        </tr>";   
                    }
                    echo $registros;
                }else{
                    echo 0;
                }
            }
        }
         function compraivalibrofecha(){
            if(isset($_POST['sucursal'])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $consultalibroventas = $this->model->lista_libro_compra_fecha_sucursal($_POST['sucursal'],$date_1,$date_2);
                if($consultalibroventas){
                    $registros = "";
                    foreach($consultalibroventas as $p){
                        $descuento = number_format(floatval($p['DESCUENTO']),2);
                        $total = number_format(floatval($p['TOTAL']),2);
                        $importecreditofiscal = number_format(floatval($p['TOTAL'])-floatval($p['DESCUENTO']),2);
                        $impuesto = number_format((floatval($p['TOTAL'])-floatval($p['DESCUENTO']))*0.13,2);
                        $estado = $p['ESTADO']==1?'V':'A';
                        $dia = date("d/m/Y",strtotime($p['FECHA_EMISION']));
                        
                        $registros .= "
                        <tr>
                            <td>1</td>
                            <td>{$p['NRO']}</td>
                            <td>{$dia}</td>
                            <td>{$p['N_DOCUMENTO']}</td>
                            <td>{$p['RAZON']}</td>
                            <td>{$p['NRO_FACTURA']}</td>
                            <td>0</td>
                            <td>{$p['NRO_AUTORIZACION']}</td>
                            <td>{$total}</td>
                            <td>{$total}</td>
                            <td>{$total}</td>
                            <td>{$descuento}</td>
                            <td>{$importecreditofiscal}</td>
                            <td>{$impuesto}</td>
                            <td>{$p['CODIGO_CONTROL']}</td>
                            <td>1</td>
                        </tr>";   
                    }
                    echo $registros;
                }else{
                    echo 0;
                }
            }
        }
          function formatoA4Facturada($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);
                $buscar_compra  = $this->model->detalle_compra($id);
                $response  = "";
                if($buscar_compra){
                    if($buscar_compra->rowCount()>0){
                        foreach($buscar_compra as $row){
                            $tipo_pago = "{$row["TIPO_PAGO"]}";
                            if($tipo_pago == 1){
                                $tipo_pago = "CONTADO";
                            }else{
                                $tipo_pago = "CREDITO";
                            }
                            $response .= "{$row["SUCURSAL"]}|{$row["ID_PROVEEDOR"]}|{$row["ID_PERSONA"]}|{$row["FECHA_COMPRA"]}|{$tipo_pago}|{$row["RAZON"]}|{$row["DOCUMENTO"]}|{$row["N_DOCUMENTO"]}|{$row["N_COMPROBANTE"]}|{$row["COMPROBANTE"]}|{$row["SUMAS"]}|{$row["IVA"]}|{$row["SUBTOTAL"]}|{$row["RETENIDO"]}|{$row["EXENTO"]}|{$row["TOTAL"]}|{$row["N_COMPRA"]}"; 
                        }
                    }
                }
                $res_array = explode("|",$response);
                $this->view->parametros_compra = $response;
                $this->view->id_compra = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[0]);
                $this->view->parametros_proveedor =mainModel::parametros_proveedor($res_array[1]);
                $this->view->parametros_persona =mainModel::parametros_persona($res_array[2]);
                $this->view->lista_items =$this->model->detalle_item_compra($id);
                $this->view->parametros_libro_compra =  mainModel::parametros_libro_compra($id);
                $this->view->render("compras/formatoA4facturada");
            }else{
                $this->view->render("error/404");
            }
        }
    }