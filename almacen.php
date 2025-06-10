<?php
    class almacen extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* -------------------------------------------------------------------------- */
/*                         View almacenes por Sucursal                        */
/* -------------------------------------------------------------------------- */

        function render(){
            $this->view->render('almacen/index');
        }

/* -------------------------------------------------------------------------- */
/*                       Lista de Almacenes por Sucursal                      */
/* -------------------------------------------------------------------------- */
function lista_productos_almacen_2(){
    if(isset($_POST["almacen"])){
        $productos = $this->model->lista_items_almacen($_POST["almacen"]);
        if($productos){
            $n = 1;
            $tabla = "";
            if($productos->rowCount()>0){
                foreach($productos as $rows){
                    if($rows["ID_ITEM"] != null){
                        $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                        $progress = "";
                        if($rows["STOCK"]>$rows["STOCK_MEDIO"]){
                            $progress = "  <button type='button' class='btn btn-success mt-3 mb-3 ml-2'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                <span class='badge badge-light ml-2 mt-1'>{$rows['STOCK']}</span>
                                            </button>
                                        ";
                        }else if($rows["STOCK"] > $rows["STOCK_MINIMO"] && $rows["STOCK"] <= $rows["STOCK_MEDIO"]){
                            $progress = "  <button type='button' class='btn btn-warning mt-3 mb-3 ml-2'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                <span class='badge badge-light ml-2 mt-1'>{$rows['STOCK']}</span>
                                            </button>
                                        ";
                        }else if($rows["STOCK"]<=$rows["STOCK_MINIMO"]){
                            $progress = "  <button type='button' class='btn btn-danger mt-3 mb-3 ml-2'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                <span class='badge badge-light ml-2 mt-1'>{$rows['STOCK']}</span>
                                            </button>
                                        ";
                        }
                        $precio_venta = floatval($rows["PRECIO_VENTA_4"]);
                        $precio_costo = floatval($rows["PRECIO_COSTO"]);
                        $stock = floatval($rows["STOCK"]);
                        $inversion = $precio_costo * $stock;
                        $valorizado = $precio_venta * $stock;
                        $ganancia = $valorizado - $inversion; 
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
                                <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                <td>{$rows["LINEA"]}</td>
                                <td>{$rows["PRESENTACION"]}</td>
                               
                                                                                                                                                                                                           
                                <td>{$stock}</td>
                                <td>{$precio_costo}</td>
                                <td>{$inversion}</td>
                                <td>{$precio_venta}</td>
                                <td>{$valorizado}</td>
                                <td>{$ganancia}</td>
                               
                                </tr>
                        ";
                        $n++;
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
        function listar_almacenesXsucursal(){
            if(isset($_POST["token"])){
                session_name('B_POS');
                session_start();
                $p_id_sucursal = $_SESSION["sucursal"];
                $sucursal = $this->model->listar_almacenesXsucursal($p_id_sucursal);
                if($sucursal){
                    $n = 1;
                    $tabla = "";
                    foreach($sucursal as $rows){
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $estado = "<span class='shadow-none badge badge-success'>Vigente</span>";
                        }else{
                            $estado = "<span class='shadow-none badge badge-dark'>Descontinuada</span>";
                        }
                        $tabla .="
                            <tr>
                                <td class='checkbox-column'> $n </td>
                                <td>".$n."</td>
                                <td>{$rows['NOMBRE']}</td>
                                <td>{$rows['DIRECCION']}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <ul class='table-controls'>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_ver' almacen_id='{$rows['ID_ALMACEN']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Ver'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-eye p-1 br-6 mb-1'><path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'></path><circle cx='12' cy='12' r='3'></circle></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_actualizar' almacen_id='{$rows['ID_ALMACEN']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_eliminar' almacen_id='{$rows['ID_ALMACEN']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash p-1 br-6 mb-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        ";
                        $n++;
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }

/* -------------------------------------------------------------------------- */
/*                         Generar códigos de almacén                         */
/* -------------------------------------------------------------------------- */

        function generar_codigo_almacen(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_almacenes();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('ALMACEN',6,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                  Generar códigos de detalle transferencia                  */
/* ========================================================================== */

        function generar_codigo_detalle_transferencia(){
            $cn = mainModel::conectar();
            $numero = $this->model->listastransferencias();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('DETALLE',6,$numero);
            }else{
                return 0;
            }
        }
/* ========================================================================== */
/*                              Agregar almacenes                             */
/* ========================================================================== */
        function agregar_almacen(){
            if(isset($_POST["nombre"])){
                session_name('B_POS');
                session_start();
                $p_id_almacen = $this->generar_codigo_almacen();
                $p_id_sucursal = $_SESSION["sucursal"];
                $p_nombre = $_POST["nombre"];
                $p_direccion = $_POST["direccion"];
                $p_estado = $_POST["estado"];
                $almacen = $this->model->agregar_almacen($p_id_almacen,$p_nombre,$p_direccion,$p_id_sucursal,$p_estado);
                if($almacen){
                    if($almacen->rowCount()>0){
                        $this->actualizacion_de_almacenes();
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                           View productos almacen                           */
/* ========================================================================== */
        function productos($param = null){
            $id = $param[0];
            if(is_string(mainModel::decryption($id))){
                $this->view->idalmacen =$param[0];
                $this->view->nombrealmacen = $this->buscar_almacen(mainModel::decryption($id));
                $this->view->almacen = mainModel::decryption($id);
                $this->view->render('almacen/productos');
            }else{
                $this->view->render('error/404');
            }
        }
/* ========================================================================== */
/*                             Lista de productos                             */
/* ========================================================================== */
        function lista_productos(){
            if(isset($_POST["token"])){
                $presentacion = $this->model->lista_productos();
                if($presentacion){
                    $n = 1;
                    $tabla = "";
                    foreach($presentacion as $rows){
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                            $tabla .="
                                 <tr>
                                    <td>{$n}</td>
                                    <td class='user-name'>{$rows["BARRA"]}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td>{$rows["ARTICULO"]}</td>
                                    <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                    <td>{$rows["LINEA"]}</td>
                                    <td>{$rows["NOMBRE"]}</td>
                                    <td><input type='text' id='txt_{$rows["ID_PRODUCTO"]}' placeholder='Ejm. 10' class='form-control'></td>
                                    <td class='text-center'>
                                        <button value='{$rows["ID_PRODUCTO"]}' perecedero='{$rows["PERECEDERO"]}' class='btn rounded-circle btn_agregar btn-success bs-tooltip' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar a almacén'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-download'><path d='M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4'></path><polyline points='7 10 12 15 17 10'></polyline><line x1='12' y1='15' x2='12' y2='3'></line></svg>
                                        </button>
                                    </td>
                                </tr>
                            ";
                        }
                        $n++;
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                       Lista de productos para compra                       */
/* ========================================================================== */
        function lista_productos_compra(){
            if(isset($_POST["token"])){
                $presentacion = $this->model->lista_productos();
                if($presentacion){
                    $n = 1;
                    $tabla = "";
                    foreach($presentacion as $rows){
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                            $tabla .="
                                 <tr>
                                    <td>{$n}</td>
                                    <td class='user-name'>{$rows["BARRA"]}</td>
                                    <td class='>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 80px;'>
                                        </a>
                                    </td>
                                    <td>{$rows["ARTICULO"]}</td>
                                    <td>{$rows["PRECIO_COSTO"]}</td>
                                    <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                    <td>{$rows["LINEA"]}</td>
                                    <td>{$rows["NOMBRE"]}</td>
                                    <td><input type='text' id='txt_{$rows["ID_PRODUCTO"]}' placeholder='Ejm. 10' class='form-control'></td>
                                    <td class='text-center'>
                                        <button value='{$rows["ID_PRODUCTO"]}' class='btn rounded-circle btn_agregar btn-outline-success bs-tooltip' data-toggle='tooltip' data-placement='top' title='' data-original-title='Agregar a la compra'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-download'><path d='M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4'></path><polyline points='7 10 12 15 17 10'></polyline><line x1='12' y1='15' x2='12' y2='3'></line></svg>
                                        </button>
                                    </td>
                                </tr>
                            ";
                        }
                        $n++;
                    }
                    echo $tabla;
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                          Generar códigos de items                          */
/* ========================================================================== */
        function generar_codigo_item($param){
            $numero = $this->model->lista_items_almacen($param);
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('ITEM',10,$numero);
            }else{
                return 0;
            }
        }
/* ========================================================================== */
/*                        Agregar productos en almacén                        */
/* ========================================================================== */
        function agregar_productos_almacen(){
            if(isset($_POST["id_producto"]) && isset($_POST["cantidad"]) && isset($_POST["almacen"])){
                $p_id_producto = $_POST["id_producto"];
                $p_id_almacen = $_POST["almacen"];
                $p_id_item = $this->generar_codigo_item($p_id_almacen);
                $p_stock = $_POST["cantidad"];
                $guardar = $this->model->agregar_productos_almacen($p_id_item,$p_id_producto,$p_id_almacen,$p_stock);
                if($guardar){
                    if($guardar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                }else{  
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                        Lista de productos en almacén                       */
/* ========================================================================== */

        function lista_productos_almacen(){
            if(isset($_POST["almacen"])){
                $productos = $this->model->lista_items_almacen($_POST["almacen"]);
                if($productos){
                    $n = 1;
                    $tabla = "";
                    if($productos->rowCount()>0){
                        foreach($productos as $rows){
                            if($rows["ID_ITEM"] != null){
                                $imagen = SERVERURL."archives/assets/productos/{$rows["IMAGEN"]}";
                                $progress = "";
                                if($rows["STOCK"]>$rows["STOCK_MEDIO"]){
                                    $progress = "  <button type='button' class='btn btn-success mt-3 mb-3 ml-2'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                        <span class='badge badge-light ml-2 mt-1'>{$rows['STOCK']}</span>
                                                    </button>
                                                ";
                                }else if($rows["STOCK"] > $rows["STOCK_MINIMO"] && $rows["STOCK"] <= $rows["STOCK_MEDIO"]){
                                    $progress = "  <button type='button' class='btn btn-warning mt-3 mb-3 ml-2'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                        <span class='badge badge-light ml-2 mt-1'>{$rows['STOCK']}</span>
                                                    </button>
                                                ";
                                }else if($rows["STOCK"]<=$rows["STOCK_MINIMO"]){
                                    $progress = "  <button type='button' class='btn btn-danger mt-3 mb-3 ml-2'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg> 
                                                        <span class='badge badge-light ml-2 mt-1'>{$rows['STOCK']}</span>
                                                    </button>
                                                ";
                                }
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
                                        <td>{$rows["UNIDAD"]} {$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                        <td>{$rows["LINEA"]}</td>
                                        <td>{$rows["PRESENTACION"]}</td>
                                       
                                        <td>{$rows["PRECIO_VENTA_4"]}</td>
                                        <td>
                                           {$progress}
                                        </td>
                                    </tr>
                                ";
                                $n++;
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

/* -------------------------------------------------------------------------- */
/*                          Lista items por sucursal                          */
/* -------------------------------------------------------------------------- */

        function guardartransferencia(){
            if(isset($_POST["almacen"]) && isset($_POST["data"]) && isset($_POST["idalmacen"])){
                date_default_timezone_set(ZONEDATE);
                session_name('B_POS');
                session_start();
                $usuario = $_SESSION["usuario"];
                $almacen_destino = $_POST["almacen"];
                $almacen_origen = $_POST["idalmacen"];
                $motivo = $_POST["motivo"];
                $productos = $_POST["data"];
                $fecha_registro = date('Y-m-d');
                $id_transferencia = $this::generar_codigo_transferencia();
                $guardar_transferencia = $this->model->guardar_transferencia($id_transferencia,$fecha_registro,$motivo,$almacen_origen,$almacen_destino,$usuario);
                if($guardar_transferencia){
                    if($guardar_transferencia->rowCount()>0){
                        $arrayproductos = explode(',',$productos);
                        $n_productos = count($arrayproductos)-1;
                        for($i=0;$i<$n_productos;$i++){
                            $generar_codigo_item = $this->generar_codigo_item($almacen_destino);
                            $productostring = $arrayproductos[$i];
                            $producto = explode("|",$productostring);
                            $agregar_stock_item = $this->model->agregar_stock_item($producto[1],$almacen_destino,$generar_codigo_item,$producto[3]);
                            if($agregar_stock_item){
                                if($agregar_stock_item->rowCount()>0){
                                    $id_detalle = $this->generar_codigo_detalle_transferencia();
                                    $guardar_detalle_transferencia = $this->model->guardar_detalle_transferencia($id_detalle,$id_transferencia,$producto[1],$producto[3],$producto[2]);
                                    if($guardar_detalle_transferencia){
                                        if($guardar_detalle_transferencia->rowCount()>0){
                                            $restar_stock = $this->model->restar_stock($producto[0],$producto[3]);
                                            if($restar_stock){
                                                if($restar_stock->rowCount()>0){
                                                    echo 1;
                                                }
                                            }else{
                                                echo 0;
                                            }
                                        }else{
                                            echo 0;
                                        }
                                    }else{
                                        echo 0;
                                    }
                                }else{
                                    echo 0;
                                }
                            }else{  
                                echo 0;
                            }
                            
                        }
                    }else{  
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        /*
            ======================================
                    Generar códigos de items
            ======================================
        */
        function generar_codigo_transferencia(){
            $numero = $this->model->listastransferencias();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('TRANSF',10,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                              Buscar almacenes                              */
/* ========================================================================== */

        function buscar_almacen($id){
            $buscaralmacenes = $this->model->buscar_almacen($id);
            if($buscaralmacenes){
                if($buscaralmacenes->rowCount()>0){
                    $option = "";
                    foreach($buscaralmacenes as $row){
                        $option .= "{$row['NOMBRE']}";
                    }
                    return $option;
                }else{
                    return 2;
                }
            }else{
                return 1;
            }
        }
       
/* -------------------------------------------------------------------------- */
/*                            Formulario de almacen                           */
/* -------------------------------------------------------------------------- */

        function form_almacen(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_almacen = $this->model->consulta_almacen($id);
                if($consultar_almacen){
                    $formulario = "";
                    if($consultar_almacen->rowCount()>0){
                        foreach($consultar_almacen as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='nombre'>Nombre</label>
                                    <input type='text' class='form-control' name='nombre_almacen' id='nombre_almacen' value='{$row["NOMBRE"]}' placeholder='EJ. ALMACEN 1' required>
                                    <input type='hidden' class='form-control' name='id_almacen' id='id_almacen' value='{$row["ID_ALMACEN"]}' placeholder='EJ. ALMACEN 1' required>
                                    </div>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='direccion'>Dirección</label>
                                    <input type='text' class='form-control' name='direccion' id='direccion' value='{$row["DIRECCION"]}' placeholder='EJ. AV.LOS GIRASOLES #1017' required>
                                </div>
                                <div class='form-group mb-2 col-sm-12'>
                                    <label for='new-unidad-estado'>Estado</label>
                                </div>
                                <div class='form-group mb-4 col-sm-12 d-flex'>
                                    <label class='switch s-icons s-outline s-outline-info  mr-2'>
                                        <input id='new-unidad-estado' type='checkbox' name='estado' {$estado}>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer md-button'>
                            <button class='btn btn-danger' data-dismiss='modal'><i class='flaticon-cancel-12'></i> Cancelar</button>
                            <button type='submit' id='save_unidad' class='btn btn-success'>Guardar</button>
                        </div>
                            
                            ";
                        }
                        echo $formulario;
                    }   
                }else{
                    echo 0;
                }
            }else{
                echo "no llega";
            }
        }

/* -------------------------------------------------------------------------- */
/*                               Ver de almacen                               */
/* -------------------------------------------------------------------------- */

        function form_veralmacen(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_almacen = $this->model->consulta_almacen($id);
                if($consultar_almacen){
                    $formulario = "";
                    if($consultar_almacen->rowCount()>0){
                        foreach($consultar_almacen as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='nombre'>Nombre</label>
                                    <input type='text' class='form-control' disabled name='nombre_almacen' id='nombre_almacen' value='{$row["NOMBRE"]}' placeholder >
                                    <input type='hidden' class='form-control' name='id_almacen' id='id_almacen' value='{$row["ID_ALMACEN"]}' placeholder='EJ. ALMACEN 1' required>
                                    </div>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='direccion'>Dirección</label>
                                    <input type='text' class='form-control' disabled name='direccion' id='direccion' value='{$row["DIRECCION"]}' placeholder >
                                </div>
                                <div class='form-group mb-2 col-sm-12'>
                                    <label for='new-unidad-estado'>Estado</label>
                                </div>
                                <div class='form-group mb-4 col-sm-12 d-flex'>
                                    <label class='switch s-icons s-outline s-outline-info  mr-2' >
                                        <input id='new-unidad-estado' type='checkbox' name='estado' {$estado} disabled>
                                        <span class='slider round'></span>
                                    </label>
                                </div>
                            </div>
                        </div>     
                            ";
                        }
                        echo $formulario;
                    }   
                }else{
                    echo 0;
                }
            }else{
                echo "no llega";
            }
        }

/* -------------------------------------------------------------------------- */
/*                             Actualizar almacen                             */
/* -------------------------------------------------------------------------- */

        function actualizar_almacen(){
            if(isset($_POST["id_almacen"])){
                $id = $_POST["id_almacen"];
                $nombre = $_POST["nombre_almacen"];
                $direccion = $_POST["direccion"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_almacen = $this->model->actualizar_almacen($id,$nombre,$direccion,$estado);
                if($actualizar_almacen){
                    $this->actualizacion_de_almacenes();
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

/* -------------------------------------------------------------------------- */
/*                              Eliminar almacen                              */
/* -------------------------------------------------------------------------- */

        function eliminar_almacen(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_almacen($_POST["id"]);
                if($eliminar){
                    if($eliminar->rowCount()>0){
                        $this->actualizacion_de_almacenes();
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }

            }
        }

/* ========================================================================== */
/*                     Funcion actualizacion de almacenes                     */
/* ========================================================================== */

        function actualizacion_de_almacenes(){
            if(isset($_SESSION["sucursal"])){
                $sucursal =  $_SESSION["sucursal"];
                $buscaralmacenes = $this->model->listar_almacenesXsucursal($sucursal);
                $almacenes = "";
                if($buscaralmacenes){
                    foreach($buscaralmacenes as $row){
                        $id = mainModel::encryption($row["ID_ALMACEN"]);
                        $almacenes .= "{$id},{$row["NOMBRE"]}"."|";
                    }
                }
                $_SESSION["almacenes"] = $almacenes;
            }else{
                session_name('B_POS');
                session_start();
                $sucursal =  $_SESSION["sucursal"];
                $almacenes = "";
                $buscaralmacenes = $this->model->listar_almacenesXsucursal($sucursal);
                if($buscaralmacenes){
                    foreach($buscaralmacenes as $row){
                        $id = mainModel::encryption($row["ID_ALMACEN"]);
                        $almacenes .= "{$id},{$row["NOMBRE"]}"."|";
                    }
                }
                $_SESSION["almacenes"] = $almacenes;

            }
        }
    }