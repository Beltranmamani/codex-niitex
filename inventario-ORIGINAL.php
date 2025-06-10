<?php
    class inventario extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        
        function render(){
            $this->view->render('compras/index');
        }

/* ========================================================================== */
/*                              View perecederos                              */
/* ========================================================================== */

        function perecederos(){
            $this->view->render('inventario/perecederos');
        }
        function anular_traspaso(){
            if(isset($_POST["id_traspaso"])){
                $detalle_item = $this->model->detalle_seguimiento_traspaso($_POST["id_traspaso"]);
                if($detalle_item){
                    $apto = true;
                    foreach($detalle_item as $d){
                        if($d["CANTIDAD"]!=$d["STOCK_ACTUAL"]){
                            $apto = false;
                        }
                    }
                    if($apto){
                        $lista_seguimiento = $this->model->lista_seguimientos_traspaso($_POST["id_traspaso"]);
                        if($lista_seguimiento){
                            if($lista_seguimiento->rowCount()>0){
                                foreach($lista_seguimiento as $l){
                                    $eliminar_entrada = $this->model->eliminar_kardex($l['ID_KARDEX_EN']);
                                    if(!$eliminar_entrada){
                                        echo 5;
                                    }
                                    $eliminar_salida = $this->model->eliminar_kardex($l['ID_KARDEX_SA']);
                                    if(!$eliminar_salida){
                                        echo 5;
                                    }
                                    $eliminar_item_lote= $this->model->eliminar_item_lote($l['ID_LOTE']);
                                    if(!$eliminar_item_lote){
                                        echo 5;
                                    }
                                    $devolver_cantidad = $this->model->sumar_cantidad_item_lote($l['ID_ITEM'],$l['CANTIDAD']);
                                    if(!$devolver_cantidad){
                                        echo 5;
                                    }
                                }
                                $anular = $this->model->anular_traspaso($_POST["id_traspaso"]);
                                if($anular){
                                    echo 1;
                                    
                                }
                            }
                        }
                        
                    }else{
                        echo 3;
                    }
                }
                
            }
        }

/* ========================================================================== */
/*                       Lista de productos perecederos                       */
/* ========================================================================== */
        
        function lista_de_perecederos(){
            if(isset($_POST["token"])){
                date_default_timezone_set(ZONEDATE);
                session_name('B_POS');
                session_start();
                $sucursal = $_SESSION["sucursal"];
                $productos = $this->model->lista_percederos($sucursal);
                if($productos){
                    $n = 1;
                    $tabla = "";
                    if($productos->rowCount()>0){
                        foreach($productos as $rows){
                            if($rows["ID_ITEM"] != null){
                                if($rows["CANTIDAD"] >0){
                                    $hoy = date('Y-m-d');
                                    $badge = "";
                                    if($hoy < $rows["FECHA_2"]){
                                        $badge = "<span class='badge badge-success'> {$rows["FECHA_4"]} </span> ";
                        
                                    }else if($hoy >= $rows["FECHA_2"] && $hoy < $rows["FECHA_3"]){
                                        $badge = "<span class='badge badge-warning'> {$rows["FECHA_4"]} </span> ";
                                    }else if($hoy>=$rows["FECHA_3"] && $hoy< $rows["FECHA_4"]){
                                         $badge = "<span class='badge badge-danger'> {$rows["FECHA_4"]} </span> ";
                                    }else if($hoy >=$rows["FECHA_4"] ){
                                       $badge = "<span class='badge badge-dark'> {$rows["FECHA_4"]} </span> ";
                                    }
                                    
                                    $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                    $tabla .="
                                         <tr>
                                            <td>{$n}</td>
                                            <td class='user-name' style='font-weight: 600;color: #ffa42a;'>{$rows["BARRA"]}</td>
                                            <td class='>
                                                <a class='profile-img' href='javascript: void(0);'>
                                                    <img src='{$imagen}' alt='product' style='width: 80px;'>
                                                </a>
                                            </td>
                                            <td>{$rows["ARTICULO"]}</td>
                                            <td>{$rows["LINEA"]}</td>
                                            <td>{$rows["PRESENTACION"]}</td>
                                            <td>{$rows["ALMACEN"]}</td>
                                            <td>{$rows["LOTE"]}</td>
                                            <td class='text-center'>{$badge}</td>
                                            <td class='text-center'>
                                                <button type='button' class='btn btn-secondary mt-3 mb-3 ml-2'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                    <span class='badge badge-light ml-2 mt-1'>{$rows["CANTIDAD"]}</span>
                                                </button>
                                            </td>
                                        </tr>
                                    ";
                                    $n++;
                                }
                            }
                        }
                        echo $tabla;
                    }
                }else{
                    echo 0;
                }
            }else{
                echo "0";
            }
        }

/* ========================================================================== */
/*                     Vista Nuevo trasopaso de productos                     */
/* ========================================================================== */

        function nuevotraspaso(){
            session_name('B_POS');
            session_start();
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->listar_sucursales = $this->listar_sucursales();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->render('inventario/nuevotraspaso');
        }

/* ========================================================================== */
/*                              Listar sucurales                              */
/* ========================================================================== */

        function listar_sucursales(){
            $sucursal = $this->model->listar_sucursales();
            if($sucursal){
                $option = "";
                foreach($sucursal as $row){
                    if($row["ESTADO"]!=0){
                        $option .= "<option value='{$row['ID_SUCURSAL']}'>{$row['NOMBRE']}</option>";
                    }
                }
                return $option;
            }
        }

/* ========================================================================== */
/*                          Listar items por sucursal                         */
/* ========================================================================== */

        function listaralmacenes(){
            if(isset($_POST["idsucursal"])){
                $sucursal = $_POST["idsucursal"];
                $buscaralmacenes = $this->model->listar_almacenesXsucursal($sucursal);
                if($buscaralmacenes){
                    $option = "<option selected='selected' disabled>Seleccionar...</option>";
                    foreach($buscaralmacenes as $row){
                        if($row["ESTADO"]!=0){
                            $option .= "<option value='{$row['ID_ALMACEN']}'>{$row['NOMBRE']}</option>";
                        }
                    }
                    echo $option;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        }

/* ========================================================================== */
/*                            Listar presentaciones                           */
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
        function agregar_traspaso(){
            if(isset($_POST["almacen"]) && isset($_POST["productos"])){ 
                date_default_timezone_set(ZONEDATE);

                $codigo_usuario =  $_POST["usuario"];
                $codigo_sucursal =  $_POST["sucursal"];
                
                $codigo_traspaso = $this->genera_codigo_traspaso();
                $numero_traspaso = $this->generar_nro_traspaso($codigo_sucursal);
                
                $id_almacen = $_POST["almacen"];
                $motivo = $_POST["motivo"];
                $fecha_registro = date('Y-m-d H:i:s');
                $fecha = date('Y-m-d');
                
                $guardar_traspaso = $this->model->agregar_traspaso($codigo_traspaso,$numero_traspaso,$fecha_registro,$codigo_sucursal,$codigo_usuario,$id_almacen,$motivo,1);
                if($guardar_traspaso){
                    // Recorrer productos
                    $productos = $_POST["productos"];
                    //separo los producto en arreglo
                    $arrayproductos = explode(',',$productos);
                    //cuento la cantidad de productos
                    $n_productos = count($arrayproductos)-1;
                    //recorro el arreglo
                    for($i=0;$i<$n_productos;$i++){
                        $productostring = $arrayproductos[$i];
                        
                        $producto = explode("|",$productostring);
                        $id_item_trasapaso = $producto[0];
                        $producto_stock_trasapaso = $producto[7];
                        $id_producto_trasapaso = $producto[8];
                        $id_lote = $producto[9];
                        $lote = $producto[10];
                        $cantidad_traspaso = $producto[2];
                        $codigo_lote = "";
                        $consultar_lote_almacen = $this->model->consultar_lote($lote, $id_almacen);
                        if($consultar_lote_almacen){
                            if($consultar_lote_almacen->rowCount()>0){
                                foreach($consultar_lote_almacen as $lote_r){
                                    $codigo_lote = $lote_r["ID_LOTE"];
                                }
                            }else{
                                $codigo_lote =  $this->generar_codigo_lote();
                                $guardar_lote = $this->model->agregar_lotes($codigo_lote,$lote,$id_almacen,$fecha,1);
                                if($guardar_lote){
                                    if($guardar_lote->rowCount()>0){
                                
                                    
                                    }
                                }
                            }
                        }
                        
                        $stock_global_producto_traspaso = mainModel::stock_global_producto($id_producto_trasapaso,$codigo_sucursal);
                        
                        $parametros_items_lote = mainModel::parametros_item_lote($id_item_trasapaso);
                        $precio_costo = $parametros_items_lote["PRECIO_COSTO"];
                        $precio_venta_1 = $parametros_items_lote["PRECIO_VENTA_1"];
                        $precio_venta_2 = $parametros_items_lote["PRECIO_VENTA_2"];
                        $precio_venta_3 = $parametros_items_lote["PRECIO_VENTA_3"];
                        $precio_venta_4 = $parametros_items_lote["PRECIO_VENTA_4"];
                        $perecedero = $parametros_items_lote["PERECEDERO"];
                        $fecha_ven = $parametros_items_lote["FECHA_VEN"];
    
                        $id_item_lote = $this->generar_codigo_items_lote();
                        $guardar_producto_lote = $this->model->agregar_productos_lotes($id_item_lote,$id_almacen,$codigo_lote,$id_producto_trasapaso,$precio_costo,$precio_venta_1,$precio_venta_2,$precio_venta_3,$precio_venta_4,$cantidad_traspaso,$perecedero,$fecha_ven,$codigo_usuario);
                        if(!$guardar_producto_lote){
                            echo $id_item_lote;
                        }
                        // Agregar perecedero si esque lo fuese
                        $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                        if($perecedero == 1){
                            $idperecedero = $this->generar_codigo_perecederos();
                            $fecha_items_lote = mainModel::parametros_item_perecedero($id_item_trasapaso);
                            $fecha_1 = $fecha_items_lote["FECHA_1"];
                            $fecha_2 = $fecha_items_lote["FECHA_2"];
                            $fecha_3 = $fecha_items_lote["FECHA_3"];
                            $fecha_4 = $fecha_items_lote["FECHA_4"];
                            $guardar_perecedero = $this->model->agregar_perecedero($idperecedero,$id_item_lote,$id_producto_trasapaso,$id_almacen,$almacen_sucursal["ID_SUCURSAL"],$fecha_1,$fecha_2,$fecha_3,$fecha_4);
                            if(!$guardar_perecedero){
                                echo 4;
                            }
                        }
                        
                        // Agregar detalle de traspaso
                        $id_detalle = $this->genera_codigo_detalle_traspaso();
                        $agregar_detalle = $this->model->agregar_detalle_traspaso($id_detalle,$id_item_trasapaso,$fecha_registro,$codigo_traspaso,$cantidad_traspaso);
                        if(!$agregar_detalle){
                            echo 2;
                        }
                        // Agregar entrada
                        $p_id_entrada = $this->generar_codigo_entradas();
                        
                        $stock_global_entrada = mainModel::stock_global_producto($id_producto_trasapaso,$almacen_sucursal["ID_SUCURSAL"]);
                        $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$codigo_usuario,$id_item_lote,$cantidad_traspaso*$precio_costo,$fecha_registro,2,$cantidad_traspaso,0,$cantidad_traspaso,$stock_global_entrada,"POR TRASPASO #{$numero_traspaso}",NULL);
                        if(!$guardar_kardex_entrada){
                            echo 5;
                        }
                        $p_id_salida = $this->generar_codigo_entradas();
                        $guardar_kardex_salida = $this->model->agregar_kardex($p_id_salida,NULL,$codigo_sucursal,$codigo_usuario,$id_item_trasapaso,$cantidad_traspaso*$precio_costo,$fecha_registro,1,0,$cantidad_traspaso,$producto_stock_trasapaso-$cantidad_traspaso,$stock_global_producto_traspaso-$cantidad_traspaso,"POR TRASPASO #{$numero_traspaso}",NULL);
                        if(!$guardar_kardex_salida){
                            echo 5;
                        }
                        $id_seguimiento = $this->generar_codigo_seguimiento();
                        $guardar_seguimiento = $this->model->agregar_seguimiento_traspaso($id_seguimiento,$codigo_traspaso,$cantidad_traspaso,$id_item_trasapaso,$id_item_lote,0,$p_id_entrada,$p_id_salida);
                        if(!$guardar_seguimiento){
                            echo 5;
                        }
                    
                    }
                    echo "1|".mainModel::encryption($codigo_traspaso);
                }
            }
        }
        function generar_codigo_entradas(){
            $numero = $this->model->Lista_de_kardex();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('KARDEX',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_perecederos(){
            $numero = $this->model->lista_perecederos();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('PERECEDERO',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_seguimiento(){
            $numero = $this->model->lista_seguimientos();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('SEG',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_items_lote(){
            $numero = $this->model->lista_items_lotes();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('ITEM',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_lote(){
            $numero = $this->model->lista_lotes();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('LOTE',6,$numero);
            }else{
                return 0;
            }
        }
        function genera_codigo_traspaso(){ 
            $numero = $this->model->listar_traspasos();
            if($numero){
                $numero = $numero->rowCount()+1;
                $numero = mainModel::generar_codigo_aleatorio("TRASPASO",5,$numero);
                return $numero;
            }else{
                return 0;
            }
        }
        function genera_codigo_detalle_traspaso(){ 
            $numero = $this->model->listar_detalle_traspasos();
            if($numero){
                $numero = $numero->rowCount()+1;
                $numero = mainModel::generar_codigo_aleatorio("DETALLE",5,$numero);
                return $numero;
            }else{
                return 0;
            }
        }
        function generar_nro_traspaso($sucursal){
            $numero = $this->model->listar_traspasosXsucursal($sucursal);
            if($numero){
                $numero = $numero->rowCount()+1;
                if($numero<=9){
                    return "TPS000000".$numero;
                }else if($numero>9 && $numero<=99){
                    return "TPS00000".$numero;
                }else if($numero>99 &&  $numero<=999){
                    return "TPS0000".$numero;
                }else if($numero>999 && $numero<=9999){
                    return "TPS000".$numero;
                }else if($numero>9999 && $numero<=99999){
                    return "TPS00".$numero;
                }
            }else{
                return 0;
            }
        }
        function consultatraspasos(){
            $this->view->render('inventario/consultatraspasos');
        }
        function lista_traspasos(){
            if(isset($_POST["sucursal"])){
                $traspaso = $this->model->buscar_traspaso($_POST["sucursal"]);
                if($traspaso){
                    if($traspaso->rowCount() >0){
                        $lista = "";
                        foreach($traspaso as $t){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($t["ID_TRASPASO"]);
                            $estado = "<span class='badge badge-success'>VIGENTE</span>";
                            $anular = "<a class='dropdown-item btn_anular' id_traspaso='{$t["ID_TRASPASO"]}' traspaso_estado='{$t["ESTADO"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                        Anular Traspaso
                                                    </a>";
                            if($t["ESTADO"]==0){
                                $estado = "<span class='badge badge-danger'>ANULADO</span>";
                                $anular = "";
                            }
                            $lista .= "
                                    <tr>
                                        <td>{$t["N_TRASPASO"]}</td>
                                        <td>{$t["MOTIVO"]}</td>
                                        <td>{$t["FECHA_REGISTRO"]}</td>
                                        <td>{$t["ALMACEN"]}</td>
                                        <td>{$t["SUCURSAL"]}</td>
                                        <td>{$t["NOMBRES"]} {$t["APELLIDOS"]}</td>
                                        <td>{$estado}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
    
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$t["ID_TRASPASO"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Traspaso
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}inventario/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}inventario/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A5)
                                                    </a>
                                                    {$anular}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                ";
                        }
                        echo $lista;

                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function lista_traspasos_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $traspaso = $this->model->buscar_traspaso($_POST["sucursal"]);
                if($traspaso){
                    if($traspaso->rowCount() >0){
                        $lista = "";
                        foreach($traspaso as $t){
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($t["ID_TRASPASO"]);
                            $estado = "<span class='badge badge-success'>VIGENTE</span>";
                            $anular = "<a class='dropdown-item btn_anular' id_traspaso='{$t["ID_TRASPASO"]}' traspaso_estado='{$t["ESTADO"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x-circle'><circle cx='12' cy='12' r='10'></circle><line x1='15' y1='9' x2='9' y2='15'></line><line x1='9' y1='9' x2='15' y2='15'></line></svg>
                                                        Anular Traspaso
                                                    </a>";
                            if($t["ESTADO"]==0){
                                $estado = "<span class='badge badge-danger'>ANULADO</span>";
                                $anular = "";
                            }
                            $lista .= "
                                    <tr>
                                        <td>{$t["N_TRASPASO"]}</td>
                                        <td>{$t["MOTIVO"]}</td>
                                        <td>{$t["FECHA_REGISTRO"]}</td>
                                        <td>{$t["ALMACEN"]}</td>
                                        <td>{$t["SUCURSAL"]}</td>
                                        <td>{$t["NOMBRES"]} {$t["APELLIDOS"]}</td>
                                        <td>{$estado}</td>
                                        <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
    
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$t["ID_TRASPASO"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Traspaso
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}inventario/formatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}inventario/formatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A5)
                                                    </a>
                                                    {$anular}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                ";
                        }
                        echo $lista;

                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function detalletraspaso(){
            if(isset($_POST["id"])){
                $buscar_traspaso  = $this->model->buscar_traspaso_detalle($_POST["id"]);
                if($buscar_traspaso){
                    $response  = "";
                    if($buscar_traspaso->rowCount()>0){
                        foreach($buscar_traspaso as $row){
                            $response .= "{$row["FECHA_REGISTRO"]}|{$row["ALMACEN"]}|{$row["SUCURSAL"]}|{$row["MOTIVO"]}|{$row["NOMBRES"]} {$row["APELLIDOS"]}"; 
                        }
                        echo "1|$response";
                    }
                }else{  
                    echo 0;
                }
            }
        }
        function detalletraspaso_item(){
            if(isset($_POST["id"])){
                $tras = $_POST["id"];
                $buscar_items_tras  = $this->model->buscar_traspaso_items($tras);
                if($buscar_items_tras){
                    $response  = "";
                    if($buscar_items_tras->rowCount()>0){
                        foreach($buscar_items_tras as $row){
                            $fecha_vencimiento = $row["FECHA_VEN"];
                            if($fecha_vencimiento == "0000-00-00"){
                                $fecha_vencimiento = "No caducable";
                            }
                            $response .="
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 700'>{$row['BARRA']}</td>
                                    <td>{$row['ARTICULO']}</td>
                                    <td>{$row['LINEA']}</td>
                                    <td>{$row['PRESENTACION']}</td>
                                    <td>{$row['CANTIDAD']}</td>
                                    <td>{$fecha_vencimiento}</td>
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
        function ajustedeinventarios(){
            $this->view->listar_lineas = $this->listar_lineas();
            $this->view->listar_presentacion = $this->listar_presentacion();
            $this->view->render("inventario/ajusteinventario");
        }

/* ========================================================================== */
/*                       Funcion de ajustar inventarios                       */
/* ========================================================================== */

        function ajustarinventarios(){
            if(isset($_POST["motivo"]) && isset($_POST["productos"])){
                date_default_timezone_set(ZONEDATE);

                $fecha_registro = date('Y-m-d H:i:s');

                session_name("B_POS");
                session_start();

                $codigo_usuario =  $_SESSION["usuario"];
                $codigo_sucursal =  $_SESSION["sucursal"];

                $motivo = $_POST["motivo"];
                $productos = $_POST["productos"];

                $codigo_ajuste = $this->generar_codigo_ajuste();

                $agregar_ajuste = $this->model->agregar_ajuste($codigo_ajuste,$codigo_sucursal,$fecha_registro,$codigo_usuario,$motivo);
                
                if($agregar_ajuste){
                    // Recorrer productos
                    $productos = $_POST["productos"];
                    //separo los producto en arreglo
                    $arrayproductos = explode(',',$productos);
                    //cuento la cantidad de productos
                    $n_productos = count($arrayproductos)-1;
                    //recorro el arreglo
                    for($i=0;$i<$n_productos;$i++){
                        $productostring = $arrayproductos[$i];
                        
                        $producto = explode("|",$productostring);
                        $id_detalle = $this->generar_codigo_detalle_ajuste();
                        $p_id_entrada = $this->generar_codigo_entradas();
                        $id_producto = $producto[0];

                        $parametros_items_lote = mainModel::parametros_item_lote($id_producto);
                        $precio_costo = $parametros_items_lote["PRECIO_COSTO"];
                        $id_producto_real = $parametros_items_lote["ID_PRODUCTO"];
                        
                        $producto_stock = $producto[1];
                        $producto_stock_nuevo = $producto[2];
                        
                        $precio_ajuste = $producto_stock_nuevo*$precio_costo;
                        $guardar_detalle = $this->model->agregar_detalle_ajuste($id_detalle,$codigo_ajuste,$id_producto,$producto_stock,$producto_stock_nuevo);
                        if(!$guardar_detalle){
                            echo 3;
                        }
                        $stock_global_producto = mainModel::stock_global_producto($id_producto_real,$codigo_sucursal);
                        
                        $guardar_kardex_ajuste = $this->model->agregar_kardex($p_id_entrada,NULL,$codigo_sucursal,$codigo_usuario,$id_producto,$precio_ajuste,$fecha_registro,2,$producto_stock_nuevo,0,$producto_stock_nuevo,$stock_global_producto,"AJUSTE DE INVANTARIO",NULL);
                        if(!$guardar_kardex_ajuste){
                            echo 5;
                        }
                    }
                    echo "1|".mainModel::encryption($codigo_ajuste);
                }else{
                    echo 0;
                }
            }
        }
        function generar_codigo_ajuste(){
            $numero = $this->model->Lista_de_ajustes();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('AJUSTE',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_detalle_ajuste(){
            $numero = $this->model->lista_detalle_ajuste();
            if($numero){
                $numero = $numero->rowCount();
                return mainModel::generar_codigo_aleatorio('DETALLE',6,$numero);
            }else{
                return 0;
            }
        }

        function lista_productos(){
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

        function consultaproducto(){
            $this->view->lista_productos = $this->lista_productos();
            $this->view->render('inventario/consultaproducto');
        }



        function lista_movimiento_producto(){
            if(isset($_POST["producto"])){
                date_default_timezone_set(ZONEDATE);
                $producto = $_POST["producto"];
                $sucursal = $_POST["sucursal"];
                $movimiento = $this->model->lista_movimiento_producto($producto,$sucursal);
                if($movimiento){
                    $lista_movimiento = "";
                    $n = 1;
                    foreach($movimiento as $k){
                        if($k["CANTIDAD"]>0){
                            $imagen = SERVERURL."archives/assets/productos/{$k["IMAGEN"]}";
                            $fecha = $k["FECHA_VEN"];
                            if($fecha === "0000-00-00"){
                                $fecha = "<span class='badge badge-info'>NO CADUCABLE</span>";
                            }else{
                                $hoy = date('Y-m-d');
                              
                                if($hoy >= $k["FECHA_VEN"]){
                                    $fecha = "<span class='badge badge-dark'> {$k["FECHA_VEN"]} </span> ";
                                }else{
                                    $fecha = "<span class='badge badge-success'> {$k["FECHA_VEN"]} </span> ";
                                }
                            }
                            $lista_movimiento .= "
                                <tr>
                                    <td>{$n}</td>
                                    <td style='color: #1b55e2;font-weight: 900;'>{$k["BARRA"]}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td class='text-center' style='color: #F76F0B; font-weight: 700;'>{$k["ARTICULO"]}</td>
                                    <td class='text-center' >{$k["PRESENTACION"]}</td>
                                    <td class='text-center' >{$k["LINEA"]}</td>
                                    <td class='text-center' style='color: #16AC7C; font-weight: 700;'>{$k["ALMACEN"]}</td>
                                    <td class='text-center' style='color: #16AC7C; font-weight: 700;'>{$k["LOTE"]}</td>
                                    <td>{$fecha}</td>
                                    <td class='text-center' style='color: #B16412; font-weight: 700;'>{$k["PRECIO_COSTO"]}</td>
                                    <td class='text-center' >{$k["PRECIO_VENTA_1"]}</td>
                                    <td class='text-center' >{$k["PRECIO_VENTA_2"]}</td>
                                    <td class='text-center' >{$k["PRECIO_VENTA_3"]}</td>
                                    <td class='text-center' style='color: #D41745; font-weight: 700;'>{$k["PRECIO_VENTA_4"]}</td>
                                    <td class='text-center'style='color: #1b55e2;font-weight: 700;'>{$k["CANTIDAD"]}</td>
                                   
                                </tr>
                            "; 
                        }
                        $n++;
                    }
                    echo $lista_movimiento;
                }else{
                    echo 0;
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

                $codigo_sucursal =  $_SESSION["sucursal"];

                $buscar_traspaso  = $this->model->buscar_traspaso_detalle($id);
                $response  = "";
                if($buscar_traspaso){
                    if($buscar_traspaso->rowCount()>0){
                        foreach($buscar_traspaso as $row){
                            $response .= "{$row["ID_TRASPASO"]}|{$row["N_TRASPASO"]}|{$row["FECHA_REGISTRO"]}|{$row["ALMACEN"]}|{$row["SUCURSAL"]}|{$row["MOTIVO"]}|{$row["ID_PERSONA"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_traspaso = $response;
                $this->view->id_traspaso = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($codigo_sucursal);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[6]);
                $this->view->lista_items = $this->model->buscar_traspaso_items($id);
                $this->view->render("inventario/formatoA4");
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

                $codigo_sucursal =  $_SESSION["sucursal"];

                $buscar_traspaso  = $this->model->buscar_traspaso_detalle($id);
                $response  = "";
                if($buscar_traspaso){
                    if($buscar_traspaso->rowCount()>0){
                        foreach($buscar_traspaso as $row){
                            $response .= "{$row["ID_TRASPASO"]}|{$row["N_TRASPASO"]}|{$row["FECHA_REGISTRO"]}|{$row["ALMACEN"]}|{$row["SUCURSAL"]}|{$row["MOTIVO"]}|{$row["ID_PERSONA"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_traspaso = $response;
                $this->view->id_traspaso = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($codigo_sucursal);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[6]);
                $this->view->lista_items = $this->model->buscar_traspaso_items($id);
                $this->view->render("inventario/formatoA5");
            }else{
                $this->view->render("error/404");
            }
        }

        function consultaajustes(){   
            $this->view->render('inventario/consultaajustes');
        }

        function lista_ajuste(){
            if(isset($_POST["sucursal"])){
    
                $sucursal = $_POST["sucursal"];
                $ajuste = $this->model->lista_ajuste_sucursal($sucursal);
                if($ajuste){
                    $lista_ajuste = "";
                    foreach($ajuste as $k){
                        $enlace = SERVERURL;
                        $id_encryptado = mainModel::encryption($k["ID_AJUSTE"]);
                            $lista_ajuste .= "
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 900;'>{$k["FECHA_REGISTRO"]}</td>
                                    <td style='color: #F76F0B; font-weight: 700;'>{$k["MOTIVO"]}</td>
                                    <td>{$k["NOMBRE"]}</td>
                                    <td>{$k["NOMBRES"]} {$k["APELLIDOS"]}</td>
                                    <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>
    
                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$k["ID_AJUSTE"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Traspaso
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}inventario/ajusteformatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}inventario/ajusteformatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A5)
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                </tr>
                            "; 
                    }
                    echo $lista_ajuste;
                }else{
                    echo 0;
                }
            }
        }

        function lista_ajuste_fecha(){
            if(isset($_POST["sucursal"])){
                date_default_timezone_set(ZONEDATE);
                $date_1 = date($_POST["fecha_1"]); 
                $date_2 = date($_POST["fecha_2"]);
                $ajuste = $this->model->lista_ajuste_sucursal($_POST["sucursal"]);
                if($ajuste){
                    if($ajuste->rowCount() >0){
                        $lista = "";
                        foreach($ajuste as $a){
                            $fecha = date("Y-m-d",strtotime($a["FECHA_REGISTRO"]));
                            $enlace = SERVERURL;
                            $id_encryptado = mainModel::encryption($a["ID_AJUSTE"]);
                            if($fecha >= $date_1 && $fecha <= $date_2){
                                $lista .= "
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 900;'>{$a["FECHA_REGISTRO"]}</td>
                                    <td style='color: #F76F0B; font-weight: 700;'>{$a["MOTIVO"]}</td>
                                    <td>{$a["NOMBRE"]}</td>
                                    <td>{$a["NOMBRES"]} {$a["APELLIDOS"]}</td>
                                    <td class='text-center'>
                                            <div class='dropdown dropup custom-dropdown-icon'>
                                                <a class='dropdown-toggle ' href='#' role='button' id='dropdownMenuLink-3' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-more-vertical'><circle cx='12' cy='12' r='1'></circle><circle cx='12' cy='5' r='1'></circle><circle cx='12' cy='19' r='1'></circle></svg>
                                                </a>

                                                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink-3' style='will-change: transform;'>
                                                    <a class='dropdown-item btn_detalle' id_c='{$a["ID_AJUSTE"]}' href='javascript:void(0);'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                                            Detalle Traspaso
                                                    </a>
                                                    <a class='dropdown-item' href='{$enlace}inventario/ajusteformatoA4/{$id_encryptado}/' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A4)
                                                    </a>
                                                    <a class='dropdown-item'  href='{$enlace}inventario/ajusteformatoA5/{$id_encryptado}/'  target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-printer'><polyline points='6 9 6 2 18 2 18 9'></polyline><path d='M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2'></path><rect x='6' y='14' width='12' height='8'></rect></svg>
                                                        Imprimir Traspaso (A5)
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                </tr>
                                ";
                            }
                        }
                        echo $lista;

                    }else{
                        echo 2;
                    }
                }else{
                    echo 0;
                }
            }
        }


        function detalleajuste(){
            if(isset($_POST["id"])){
                $buscar_ajuste  = $this->model->buscar_ajuste_detalle($_POST["id"]);
                if($buscar_ajuste){
                    $response  = "";
                    if($buscar_ajuste->rowCount()>0){
                        foreach($buscar_ajuste as $row){
                            $response .= "{$row["FECHA_REGISTRO"]}|{$row["MOTIVO"]}|{$row["NOMBRE"]}|{$row["NOMBRES"]} {$row["APELLIDOS"]}"; 
                        }
                        echo "1|$response";
                    }
                }else{  
                    echo 0;
                }
            }
        }

        function detalleajuste_item(){
            if(isset($_POST["id"])){
                $ajus = $_POST["id"];
                $buscar_items_ajus  = $this->model->buscar_ajuste_items($ajus);
                if($buscar_items_ajus){
                    $response  = "";
                    if($buscar_items_ajus->rowCount()>0){
                        foreach($buscar_items_ajus as $row){
                            $response .="
                                <tr>
                                    <td style='color: #1b55e2;font-weight: 700'>{$row['BARRA']}</td>
                                    <td>{$row['ARTICULO']}</td>
                                    <td>{$row['LINEA']}</td>
                                    <td>{$row['PRESENTACION']}</td>
                                    <td>{$row['STOCK_A']}</td>
                                    <td>{$row['STOCK_N']}</td>
                                    <td>{$row['LOTE']}</td>
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

        function ajusteformatoA4($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);

                $codigo_sucursal =  $_SESSION["sucursal"];

                $buscar_traspaso  = $this->model->buscar_ajuste_detalle($id);
                $response  = "";
                if($buscar_traspaso){
                    if($buscar_traspaso->rowCount()>0){
                        foreach($buscar_traspaso as $row){
                            $response .= "{$row["ID_AJUSTE"]}|{$row["FECHA_REGISTRO"]}|{$row["NOMBRE"]}|{$row["MOTIVO"]}|{$row["ID_PERSONA"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_ajuste = $response;
                $this->view->id_ajuste = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($codigo_sucursal);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->buscar_ajuste_items($id);
                $this->view->render("inventario/ajusteformatoA4");
            }else{
                $this->view->render("error/404");
            }
        }

        function ajusteformatoA5($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $id = mainModel::decryption($id);
                session_name("B_POS");
                session_start();
                date_default_timezone_set(ZONEDATE);

                $codigo_sucursal =  $_SESSION["sucursal"];

                $buscar_traspaso  = $this->model->buscar_ajuste_detalle($id);
                $response  = "";
                if($buscar_traspaso){
                    if($buscar_traspaso->rowCount()>0){
                        foreach($buscar_traspaso as $row){
                            $response .= "{$row["ID_AJUSTE"]}|{$row["FECHA_REGISTRO"]}|{$row["NOMBRE"]}|{$row["MOTIVO"]}|{$row["ID_PERSONA"]}"; 
                        }
                    }
                }else{  
                    echo 0;
                }
                $res_array = explode("|",$response);
                $this->view->parametros_ajuste = $response;
                $this->view->id_ajuste = $id;
                $this->view->parametros_sucursal = mainModel::parametros_sucursal($codigo_sucursal);
                $this->view->parametros_persona = mainModel::parametros_persona($res_array[4]);
                $this->view->lista_items = $this->model->buscar_ajuste_items($id);
                $this->view->render("inventario/ajusteformatoA5");
            }else{
                $this->view->render("error/404");
            }
        }
        function inventariogeneral(){
            $this->view->render("inventario/inventariogeneral");
        }
        function lista_productos_sucursal(){
            if(isset($_POST["sucursal"])){
                $lista_producto = $this->model->listar_item_lote_2($_POST["sucursal"]);
                if($lista_producto){
                    if($lista_producto->rowCount()>0){
                        $tabla = "";
                        $n = 1;
                        foreach($lista_producto as $rows){
                            $almacen_item = $rows["ID_ALMACEN"];
                            $cantidad_item = $rows["CANTIDAD"];
                            $fecha = "";
                            if($cantidad_item>0){

                                    if($rows["FECHA_VEN"] == "0000-00-00"){
                                        $fecha = "<span class='badge badge-dark'>No caducable</span>";
                                    }else{
                                        $fecha = "<span class='badge badge-secondary'>{$rows["FECHA_VEN"]}</span>";
                                    }
                                    $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                    $progress = "";
                                    if($rows["CANTIDAD"]>$rows["STOCK_MEDIO"]){
                                        $progress = "  <td style='color: #27da2c;font-weight: bold;'>
                                                            {$rows['CANTIDAD']}
                                                        </td>
                                                    ";
                                    }else if($rows["CANTIDAD"] > $rows["STOCK_MINIMO"] && $rows["CANTIDAD"] <= $rows["STOCK_MEDIO"]){
                                        $progress = "  <td style='color: #efc11c;font-weight: bold;'>
                                                            {$rows['CANTIDAD']}
                                                        </td>
                                                    ";
                                    }else if($rows["CANTIDAD"] <= $rows["STOCK_MINIMO"]){
                                        $progress = "  <td style='color: #e7515a;font-weight: bold;'>
                                                            {$rows['CANTIDAD']}
                                                        </td>
                                                    ";
                                    }
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
                                            <td style='font-size: 11px; font-weight: 800;color: #ffc107;'>{$rows["LOTE"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_COSTO"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_VENTA_1"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_VENTA_2"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_VENTA_3"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_VENTA_4"]}</td>
                                                {$progress}
                                            <td style='font-size: 11px;'>{$rows["LOTE"]}</td>
                                            <td>{$fecha}</td>
                                            <td>{$rows["ALMACEN"]}</td>
                                        </tr>
                                    ";
                                    $n++;
                                
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
        function lista_productos_sucursal_2(){
            if(isset($_POST["sucursal"])){
                $lista_producto = $this->model->listar_item_lote();
                if($lista_producto){
                    if($lista_producto->rowCount()>0){
                        $tabla = "";
                        $n = 1;
                        foreach($lista_producto as $rows){
                            $almacen_item = $rows["ID_ALMACEN"];
                            $cantidad_item = $rows["CANTIDAD"];
                            $fecha = "";
                            if($cantidad_item>0){
                                if($rows["ID_SUCURSAL"] == $_POST["sucursal"]){
                                    if($rows["FECHA_VEN"] == "0000-00-00"){
                                        $fecha = "<span class='badge badge-dark'>No caducable</span>";
                                    }else{
                                        $fecha = "<span class='badge badge-secondary'>{$rows["FECHA_VEN"]}</span>";
                                    }
                                    $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                    $progress = "";
                                    if($rows["CANTIDAD"]>=$rows["STOCK_MODERADO"]){
                                        $progress = "  <td style='color: #8dbf42;font-weight: bold;'>
                                                            {$rows['CANTIDAD']}
                                                        </td>
                                                    ";
                                    }else if($rows["CANTIDAD"] >= $rows["STOCK_MEDIO"]){
                                        $progress = "  <td style='color: #ffc107;font-weight: bold;'>
                                                            {$rows['CANTIDAD']}
                                                        </td>
                                                    ";
                                    }else{
                                        $progress = "  <td style='color: #e7515a;font-weight: bold;'>
                                                            {$rows['CANTIDAD']}
                                                        </td>
                                                    ";
                                    }
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
                                            <td style='font-size: 11px;'>{$rows["PRECIO_COSTO"]}</td>
                                            <td style='font-size: 11px;'>{$rows["PRECIO_VENTA_4"]}</td>
                                                {$progress}
                                            <td style='font-size: 11px;'>{$rows["LOTE"]}</td>
                                            <td>{$fecha}</td>
                                            <td>{$rows["ALMACEN"]}</td>
                                            <td class='text-center'>
                                                <button id_item='{$rows["ID_ITEM"]}' class='btn btn-success btn_importar mb-2 mr-2 rounded-circle'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-plus'><line x1='12' y1='5' x2='12' y2='19'></line><line x1='5' y1='12' x2='19' y2='12'></line></svg></button>
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
       
    }