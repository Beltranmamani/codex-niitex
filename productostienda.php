<?php
    class productostienda extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        // View tienda
        function render(){
            $this->view->lista_sucursal = $this->lista_sucursal();
            $this->view->render('productostienda/index');
        }
        function lista_sucursal()
        {
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $presentacion = $this->model->lista_sucursal();
            if ($presentacion) {
                $option = "<option selected value='0' disabled>Seleccionar sucursal</option>";
                foreach ($presentacion as $row) {
                    if($row["ID_SUCURSAL"] ==$id_sucursal){
                        $option .= "<option selected value='{$row['ID_SUCURSAL']}'>{$row['NOMBRE']}</option>";
                    }else{
                        $option .= "<option value='{$row['ID_SUCURSAL']}'>{$row['NOMBRE']}</option>";

                    }
                }
                return $option;
            }
        }
        function establecer_sucursal(){
            if(isset($_POST["id"])){
                $establecer = $this->model->establecer_tienda($_POST["id"]);
                if($establecer){
                    if($establecer->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function agregar_producto_tienda(){
            if(isset($_POST["id_item"])){
                $code = $this->generar_codigo_item();
                $agregar = $this->model->agregar_item_tienda($code,$_POST["id_item"]);
                if($agregar){
                    if($agregar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function generar_codigo_item()
        {
            $cn = mainModel::conectar();
            $numero = $this->model->lista_items_tienda();
            if ($numero) {
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('ITEMS', 6, $numero);
                return $numero+1;
            } else {
                return 0;
            }
        }
        function lista_productos_sucursal(){
            if(isset($_POST["sucursal"])){
                $lista = $this->model->lista_productos_sucursal($_POST["sucursal"]);
                if($lista){
                    $table = "";
                    $n = 1;
                    foreach($lista as $l){
                        $imagen = SERVERURL."archives/assets/productos/{$l['IMAGEN']}";
                        $table .= "
                            <tr>
                                <td>{$n}</td>
                                <td style='font-weight: 600;color: #e2a03f;'>{$l['ARTICULO']}</td>
                                <td><img src='{$imagen}' alt='product' style='width: 80px;'></td>
                                <td style='font-weight: 600;color: #e2a03f;'>{$l['LINEA']}</td>
                                <td style='font-weight: 600;color: #e2a03f;'>{$l['PRESENTACION']}</td>
                                <td>{$l['PRECIO_VENTA_4']}</td>
                                <td>{$l['CANTIDAD']}</td>
                                <td>
                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$l['ID_ITEMS']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
                        ";
                        $n++;
                    }
                    echo $table;
                }
            }
        }
        function eliminar_producto_tienda(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_producto_tienda($_POST["id"]);
                if($eliminar){
                    if($eliminar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function productos_tienda(){
            if(isset($_POST["sucursal"])){
                $productos_busqueda = $this->model->busqueda_items($_POST["sucursal"]);
                if($productos_busqueda){
                    $productos ="";
                    foreach($productos_busqueda as $i){
                        $array = " \"{$i['LINEA']}\"";
                        $productos .= "
                        <tr>
                            <td  style='font-weight: 800;color: #3856ff;'>{$i['BARRA']}</td>
                            <td >
                                <a class='profile-img' href='javascript: void(0);'>
                                    <img src='".SERVERURL."archives/assets/productos/{$i['IMAGEN']}' alt='product' style='width: 50px;'>
                                </a>
                            </td>
                            <td>{$i['ARTICULO']}</td>
                            <td>{$i['LINEA']}</td>
                            <td>{$i['PRESENTACION']}</td>
                            <td>{$i['CANTIDAD']}</td>
                            <td>{$i['PRECIO_VENTA_4']}</td>
                            <td><input type='text' id='txt_{$i['ID_ITEMS']}'class='form-control' placeholdar='% descuento' onkeypress='return check(event)'></td>
                            <td>
                                <button id_item='{$i['ID_ITEMS']}'class='btn btn-success btn_importar mb-2 mr-2 rounded-circle'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-plus'><line x1='12' y1='5' x2='12' y2='19'></line><line x1='5' y1='12' x2='19' y2='12'></line></svg></button>
                            </td>
                        </tr>
                        ";
                    }
                    echo $productos;
                }else{
                    echo 0;
                }
            }
        }
        function recomendados(){
            $tienda = mainModel::parametros_tienda();
            $id_sucursal = $tienda["ID_SUCURSAL"];
            $this->view->id_sucursal = $id_sucursal;
            $this->view->render('productostienda/recomendados');
        }
        function agregar_producto_recomendado(){
            if(isset($_POST["id_item"])){
                $code = $this->generar_codigo_item_recomendado();
                $agregar = $this->model->agregar_item_recomendado($code,$_POST["id_item"],$_POST["desc_item"]);
                if($agregar){
                    if($agregar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function generar_codigo_item_recomendado()
        {
            $cn = mainModel::conectar();
            $numero = $this->model->lista_items_tienda();
            if ($numero) {
                $numero = $numero->rowCount();
                // return mainModel::generar_codigo_aleatorio('RECOMENDADO', 6, $numero);
                return $numero+1;
            } else {
                return 0;
            }
        }
        function lista_productosrecomendados_sucursal(){
            if(isset($_POST["sucursal"])){
                $lista = $this->model->lista_productos_recomendados($_POST["sucursal"]);
                if($lista){
                    $table = "";
                    $n = 1;
                    foreach($lista as $l){
                        $imagen = SERVERURL."archives/assets/productos/{$l['IMAGEN']}";
                        $table .= "
                            <tr>
                                <td>{$n}</td>
                                <td style='font-weight: 600;color: #e2a03f;'>{$l['ARTICULO']}</td>
                                <td><img src='{$imagen}' alt='product' style='width: 80px;'></td>
                                <td style='font-weight: 600;color: #e2a03f;'>{$l['LINEA']}</td>
                                <td style='font-weight: 600;color: #e2a03f;'>{$l['PRESENTACION']}</td>
                                <td>{$l['PRECIO_VENTA_4']}</td>
                                <td>{$l['CANTIDAD']}</td>
                                <td>-{$l['DESCUENTO']}%</td>
                                <td>
                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$l['ID_RECOMENDADOS']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
                        ";
                        $n++;
                    }
                    echo $table;
                }
            }
        }
        function eliminar_productorecomendado_tienda(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_productorecomendado_tienda($_POST["id"]);
                if($eliminar){
                    if($eliminar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
        function cuentabancaria(){
            $this->view->cuenta = mainModel::parametros_cuenta_bancario();
            $this->view->render('productostienda/cuentabancaria');
        }
        function actualizar_cuenta(){
            if(isset($_POST["nro"])){
                $nro = $_POST["nro"];
                $banco = $_POST["banco"];
                $titular = $_POST["titular"];
                $telefono = $_POST["telefono"];
                $correo = $_POST["correo"];
                $update = $this->model->actualizar_cuenta_bancaria($nro,$banco,$titular,$telefono,$correo);
                if($update){
                    if($update->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
       
    }