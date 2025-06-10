<?php
class productos extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /* ========================================================================== */
    /*                               Vista principal                              */
    /* ========================================================================== */

    function render()
    {
        $this->view->render('productos/index');
    }

    /* ========================================================================== */
    /*                          Vista de nuevo producto                           */
    /* ========================================================================== */

    function nuevoproducto()
    {
        $this->view->listar_unidades = $this::listar_unidades();
        $this->view->listar_presentacion = $this::listar_presentacion();
        $this->view->listar_linea = $this::listar_linea();
        $this->view->render('productos/nuevo');
    }

    /* ========================================================================== */
    /*                   Funcion para generar codigo de producto                  */
    /* ========================================================================== */

    function generar_codigo()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_productos();
        if ($numero) {
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('PRODUC', 6, $numero);
        } else {
            return 0;
        }
    }

    /* ========================================================================== */
    /*           Funcion para listar las unidades de medidad disponibles          */
    /* ========================================================================== */

    function listar_unidades()
    {
        $unidades = $this->model->listar_unidades();
        if ($unidades) {
            $option = "";
            foreach ($unidades as $row) {
                $option .= "<option value='{$row['ID_UNIDAD']}'>{$row['UNIDAD']} - {$row['PREFIJO']}</option>";
            }
            return $option;
        }
    }

    /* ========================================================================== */
    /*             Funcion para listar las presentaciones disponibles             */
    /* ========================================================================== */

    function listar_presentacion()
    {
        $presentacion = $this->model->listar_presentacion();
        if ($presentacion) {
            $option = "";
            foreach ($presentacion as $row) {
                $option .= "<option value='{$row['ID_PRESENTACION']}'>{$row['NOMBRE']}</option>";
            }
            return $option;
        }
    }

    /* ========================================================================== */
    /*                 Funcion para listar las lineas disponibles                 */
    /* ========================================================================== */

    function listar_linea()
    {
        $linea = $this->model->listar_linea();
        if ($linea) {
            $option = "";
            foreach ($linea as $row) {
                $option .= "<option value='{$row['ID_LINEA']}'>{$row['LINEA']}</option>";
            }
            return $option;
        }
    }

    /* ========================================================================== */
    /*                        Funcion para guardar producto                       */
    /* ========================================================================== */

    function guardarproducto()
    {
        if (isset($_POST["code_barra"]) && isset($_POST["producto"])) {

            $barra = mainModel::clean_string($_POST["code_barra"]);
            $buscar_barra = $this->model->buscar_codigo_barra($barra);
            if ($buscar_barra) {
                if ($buscar_barra->rowCount() > 0) {
                    echo 2;
                } else {
                    $codigo_producto =  $this::generar_codigo();
                    $producto = mainModel::clean_string($_POST["producto"]);
                    $presentacion = mainModel::clean_string($_POST["presentacion"]);
                    $linea = mainModel::clean_string($_POST["linea"]);
                    $unidad = mainModel::clean_string($_POST["unidad"]);
                    $complemento = mainModel::clean_string($_POST["complemento"]);
                    $precio_compra = floatval(mainModel::clean_string($_POST["precio_compra"]));
                    $precio_venta_1 = floatval(mainModel::clean_string($_POST["precio_venta"]));
                    $precio_venta_2 = floatval(mainModel::clean_string($_POST["precio_venta_2"]));
                    $precio_venta_3 = floatval(mainModel::clean_string($_POST["precio_venta_3"]));
                    $precio_venta_4 = floatval(mainModel::clean_string($_POST["precio_venta_4"]));
                    $stock1 = mainModel::clean_string($_POST["stock1"]);
                    $stock2 = mainModel::clean_string($_POST["stock2"]);
                    $stock3 = mainModel::clean_string($_POST["stock3"]);
                    $perecedero = filter_input(INPUT_POST, 'perecedero', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
                    $perecedero = $perecedero == 1 ? 1 : 0;
                    $excento = filter_input(INPUT_POST, 'excento', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
                    $excento = $excento == 1 ? 1 : 0;
                    $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
                    $estado = $estado == 1 ? 1 : 0;
                    $fotoproducto = "";
                    if ($_FILES["file"]['tmp_name']) {
                        $name = $_FILES["file"]['name'];
                        $tmp = $_FILES["file"]['tmp_name'];
                        $info = new SplFileInfo($_FILES["file"]['name']);
                        $extension = $info->getExtension();
                        $fotoproducto = mainModel::generar_codigo_aleatorio('PRODUCTO', 20, rand(0, 9)) . "." . $extension;
                    } else {
                        $fotoproducto = "empty_producto.png";
                    }
                    $agregar_producto = $this->model->agregar_producto($codigo_producto, $barra, $producto, $presentacion, $linea, $unidad, $complemento, $precio_compra, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $stock1, $stock2, $stock3, $perecedero, $excento, $estado, $fotoproducto);
                    if ($agregar_producto) {
                        if ($agregar_producto->rowCount() > 0) {
                            if ($_FILES["file"]['tmp_name']) {
                                if (move_uploaded_file($tmp, "archives/assets/productos/$fotoproducto")) {
                                    echo 1;
                                } else {
                                    echo 0;
                                }
                            } else {
                                echo 1;
                            }
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 3;
                    }
                }
            } else {
                echo 0;
            }
        }
    }

    /* ========================================================================== */
    /*                             Lista de productos                             */
    /* ========================================================================== */

    function lista_productos()
    {
        if (isset($_POST["token"])) {
            $presentacion = $this->model->lista_productos();
            if ($presentacion) {
                $n = 1;
                $tabla = "";
                foreach ($presentacion as $rows) {
                    $estado = $rows['ESTADO'];
                    if ($estado == 1) {
                        $estado = "<span class='shadow-none badge badge-success'>Vigente</span>";
                    } else {
                        $estado = "<span class='shadow-none badge badge-dark'>Descontinuada</span>";
                    }
                    $imagen = SERVERURL . "archives/assets/productos/{$rows["IMAGEN"]}";
                    $enlace = SERVERURL;
                    $id_producto = mainModel::encryption($rows["ID_PRODUCTO"]);
                    $tabla .= "
                             <tr>
                                <td class='checkbox-column'> $n </td>
                                <td class='user-name'>{$rows["BARRA"]}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>{$rows["ARTICULO"]}</td>
                                <td>{$rows["COMPLEMENTO"]} {$rows["PREFIJO"]}</td>
                                <td>{$rows["LINEA"]}</td>
                                <td>{$rows["NOMBRE"]}</td>
                                <td>{$rows["PRECIO_COSTO"]}</td>
                                <td>{$rows["PRECIO_VENTA_4"]}</td>
                                <td>
                                    <div class='d-flex'>
                                        <div class=' align-self-center d-m-success  mr-1 data-marker'></div>
                                        $estado
                                    </div>
                                </td>
                                <td class='text-center'>
                                <ul class='table-controls'>
                                    <li>
                                            <a href='{$enlace}productos/caracteristicasproducto/{$id_producto}' class='bs-tooltip btn_actualizar'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Caracteristicas'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-list'><line x1='8' y1='6' x2='21' y2='6'></line><line x1='8' y1='12' x2='21' y2='12'></line><line x1='8' y1='18' x2='21' y2='18'></line><line x1='3' y1='6' x2='3.01' y2='6'></line><line x1='3' y1='12' x2='3.01' y2='12'></line><line x1='3' y1='18' x2='3.01' y2='18'></line></svg>                                            </a>
                                        </li>
                                        <li>
                                            <a href='{$enlace}productos/imagenesproducto/{$id_producto}' class='bs-tooltip btn_actualizar'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Imagenes'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image p-1 br-6 mb-1'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg>                                        
                                            </a>
                                        </li>
                                        <li>
                                            <a href='{$enlace}productos/verproductos/{$id_producto}' class='bs-tooltip btn_actualizar'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href='#' class='bs-tooltip btn_eliminar' id_producto='{$rows["ID_PRODUCTO"]}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar'>
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
            } else {
                echo 0;
            }
        }
    }

    /* ========================================================================== */
    /*                       Consultar producto para compra                       */
    /* ========================================================================== */

    function buscarproducto_compra()
    {
        if (isset($_POST["id_producto"]) && isset($_POST["cantidad"])) {
            $consulta = $this->model->consultar_producto($_POST["id_producto"]);
            if ($consulta) {
                if ($consulta->rowCount() > 0) {
                    $card  = "";
                    foreach ($consulta as $row) {
                        $imagen = SERVERURL . "archives/assets/productos/{$row["IMAGEN"]}";
                        $button = "";
                        if ($row['EXENTO'] == 1) {
                            $button .= "
                                    <button class='btn btn-outline-secondary btn-block'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                        {$row["BARRA"]}
                                    </button>";
                        } else {
                            $button .= "
                                <button class='btn btn-outline-warning btn-block'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                    {$row["BARRA"]}
                                </button>";
                        }
                        $fecha = "";
                        if ($row['PERECEDERO'] == 1) {
                            $fecha .= "
                                <div class='user-location mt-2'>
                                    <div id='iconsAccordion2_{$row["ID_PRODUCTO"]}' class='accordion-icons' style='width: -webkit-fill-available;'>
                                        <div class='card'>
                                            <div class='card-header' id='headingOne3_{$row["ID_PRODUCTO"]}'>
                                                <section class='mb-0 mt-0'>
                                                    <div role='menu' class='' data-toggle='collapse' data-target='#iconAccordionTwo_{$row["ID_PRODUCTO"]}' aria-expanded='true' aria-controls='iconAccordionTwo_{$row["ID_PRODUCTO"]}'>
                                                        <div class='accordion-icon'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'><rect x='3' y='4' width='18' height='18' rx='2' ry='2'></rect><line x1='16' y1='2' x2='16' y2='6'></line><line x1='8' y1='2' x2='8' y2='6'></line><line x1='3' y1='10' x2='21' y2='10'></line></svg>
                                                            Fechas
                                                            <div class='icons'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-up'><polyline points='18 15 12 9 6 15'></polyline></svg>
                                                            </div>
                                                        </div>
                                                </section>
                                            </div>
                                    
                                            <div id='iconAccordionTwo_{$row["ID_PRODUCTO"]}' class='collapse' aria-labelledby='headingOne3_{$row["ID_PRODUCTO"]}' data-parent='#iconsAccordion2_{$row["ID_PRODUCTO"]}' style=''>
                                                <div class='card-body'>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Fecha 1</span>
                                                    <div class='user-location'>
                                                        <input type='date' id='fecha_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_COSTO"]}' class='form-control'>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Fecha 2</span>
                                                    <div class='user-location'>
                                                        <input type='date' id='fecha2_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_2"]}' class='form-control'>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Fecha 3</span>
                                                    <div class='user-location'>
                                                        <input type='date' id='fecha3_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_3"]}' class='form-control'>
                                                    </div>
                                                    <span style='font-weight: 700;color: #3b3f5c;'>Fecha 4</span>
                                                    <div class='user-location'>
                                                        <input type='date' id='fecha4_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_4"]}' class='form-control'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                        $card .= "<div class='items' id_producto='{$row['ID_PRODUCTO']}' articulo = '{$row["ARTICULO"]}' id='item_{$row["ID_PRODUCTO"]}' exento='{$row['EXENTO']}'  presentacion='{$row['ID_PRESENTACION']}' perecedero='{$row['PERECEDERO']}'>
                                <div class='item-content'>
                                    <button class='btn btn-outline-danger btn-sm btn_eliminar_producto_compra' id_producto='{$row['ID_PRODUCTO']}'  ><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></button>

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
                                        <p class='info-title'>Presentacion: </p>
                                        <p class='usr-email-addr'>{$row["NOMBRE"]}</p>
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
                                                    <div class='card-body'>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Costo</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_COSTO"]}' class='touchs_precios'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 1</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio1_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_1"]}' class='touchs_precios'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 2</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio2_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_2"]}' class='touchs_precios'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 3</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio3_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_3"]}' class='touchs_precios'>
                                                        </div>
                                                        <span style='font-weight: 700;color: #3b3f5c;'>Precio Venta 4</span>
                                                        <div class='user-location'>
                                                            <input type='text' id='precio4_{$row["ID_PRODUCTO"]}' value='{$row["PRECIO_VENTA_4"]}' class='touchs_precios'>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>Cantidad</span>
                                    <div class='user-location'>
                                        <input type='text' id='cantidad_{$row["ID_PRODUCTO"]}' value='{$_POST["cantidad"]}' class='touchs_cantidad'>
                                    </div>
                                    <span style='font-weight: 700;color: #3b3f5c;'>LOTE</span>
                                    <div class='user-location'>
                                        <input type='text' id='loteproducto_{$row["ID_PRODUCTO"]}' value='' class='form-control'>
                                    </div>
                                    
                                    {$fecha}
                                </div>
                            </div>";
                    }
                    echo $card;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        }
    }

    /* ========================================================================== */
    /*                         Buscar producto for modal1                         */
    /* ========================================================================== */

    function buscar_producto_for_modal_1()
    {
        if (isset($_POST["id_producto"])) {
            session_name('B_POS');
            session_start();
            $usuario = $_SESSION['usuario'];
            $consulta = $this->model->consultar_producto($_POST["id_producto"]);
            if ($consulta) {
                if ($consulta->rowCount() > 0) {
                    foreach ($consulta as $row) {
                        $producto = $_POST["id_producto"];
                        $precio_costo = $row["PRECIO_COSTO"];
                        $precio_venta_1 = $row["PRECIO_VENTA_1"];
                        $precio_venta_2 = $row["PRECIO_VENTA_2"];
                        $precio_venta_3 = $row["PRECIO_VENTA_3"];
                        $precio_venta_4 = $row["PRECIO_VENTA_4"];
                        $id_almacen = $_POST["almacen"];
                        $cantidad = $_POST["cantidad"];
                        $lote = 'INVENTARIO INICIAL';
                        $codigo_lote = "";
                        $consultar_lote_almacen = $this->model->consultar_lote($lote, $id_almacen);
                        if ($consultar_lote_almacen) {
                            if ($consultar_lote_almacen->rowCount() > 0) {
                                foreach ($consultar_lote_almacen as $row) {
                                    $codigo_lote = "{$row["ID_LOTE"]}";
                                }
                                $codigo_item_lote = $this->generar_codigo_items_lote();
                                $guardar_item = $this->model->agregar_productos_lotes($codigo_item_lote, $id_almacen, $codigo_lote, $producto, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $cantidad, 0, NULL, $usuario);
                                if ($guardar_item) {
                                    if ($guardar_item->rowCount() > 0) {
                                        echo 1;
                                    } else {
                                        echo 2;
                                    }
                                } else {
                                    echo 9;
                                }
                                $fecha_registro = date('Y-m-d H:i:s');
                                // Agregar entrada
                                $p_id_entrada = $this->generar_codigo_entradas();
                                $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                                $stock_global_entrada = mainModel::stock_global_producto($producto,$almacen_sucursal["ID_SUCURSAL"]);
                                $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$usuario,$codigo_item_lote,$cantidad*$precio_costo,$fecha_registro,2,$cantidad,0,$cantidad,$stock_global_entrada,"INVENTARIO INICIAL",NULL);
                                if(!$guardar_kardex_entrada){
                                    echo 5;
                                }
                            } else {
                                $codigo_lote = $this->generar_codigo_lote();
                                date_default_timezone_set(ZONEDATE);
                                $fecha_registro = date('Y-m-d');
                                $guardar_lote = $this->model->agregar_lotes($codigo_lote, $lote, $id_almacen, $fecha_registro, 1);
                                if ($guardar_lote) {
                                    if ($guardar_lote->rowCount() > 0) {
                                        $codigo_item_lote = $this->generar_codigo_items_lote();
                                        $guardar_item = $this->model->agregar_productos_lotes($codigo_item_lote, $id_almacen, $codigo_lote, $producto, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $cantidad, 0, NULL, $usuario);
                                        if ($guardar_item) {
                                            if ($guardar_item->rowCount() > 0) {
                                                echo 1;
                                            } else {
                                                echo 2;
                                            }
                                        } else {
                                            echo 9;
                                        }
                                        $fecha_registro = date('Y-m-d H:i:s');
                                        // Agregar entrada
                                        $p_id_entrada = $this->generar_codigo_entradas();
                                        $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                                        $stock_global_entrada = mainModel::stock_global_producto($producto,$almacen_sucursal["ID_SUCURSAL"]);
                                        $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$usuario,$codigo_item_lote,$cantidad*$precio_costo,$fecha_registro,2,$cantidad,0,$cantidad,$stock_global_entrada,"INVENTARIO INICIAL",NULL);
                                        if(!$guardar_kardex_entrada){
                                            echo 5;
                                        }
                                    }
                                } else {
                                    echo 0;
                                }
                            }
                        } else {
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

    /* ========================================================================== */
    /*                         Buscar producto for modal2                         */
    /* ========================================================================== */

    function buscar_producto_for_modal_2()
    {
        if (isset($_POST["id_producto"])) {
            session_name('B_POS');
            session_start();
            $usuario = $_SESSION['usuario'];
            $sucursal = $_SESSION["sucursal"];
            $consulta = $this->model->consultar_producto($_POST["id_producto"]);
            if ($consulta) {
                if ($consulta->rowCount() > 0) {
                    $card  = "";
                    foreach ($consulta as $row) {
                        $imagen = SERVERURL . "archives/assets/productos/{$row["IMAGEN"]}";
                        $button = "";
                        $card .= "
                                <div class='form-group'>
                                    <div class='items' id_producto='{$row['ID_PRODUCTO']}' id='item_{$row["ID_PRODUCTO"]}' exento='{$row['EXENTO']}' perecedero='{$row['PERECEDERO']}'>
                                        <div class='item-content'>
                                            <div class='user-profile text-center' style='margin: auto;'>
                                                <img src='{$imagen}' alt='avatar' style='height: 100px;margin: auto;box-shadow: 0 0px 0.9px rgba(0, 0, 0, 0.07), 0 0px 7px rgb(0 0 0 / 32%);border-radius: 10px;'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label style='margin-bottom: 0;'>Nombre producto</label>
                                <div class='form-group'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg>
                                    <input type='text' class='form-control mb-2' value='{$row["ARTICULO"]}' disabled>
                                    <input type='hidden' class='form-control mb-2' value='{$row["ID_PRODUCTO"]}' name='producto'>
                                    <input type='hidden' class='form-control mb-2' value='{$row["PRECIO_COSTO"]}' name='precio_costo'>
                                    <input type='hidden' class='form-control mb-2' value='{$row["PRECIO_VENTA_1"]}' name='precio_venta_1'>
                                    <input type='hidden' class='form-control mb-2' value='{$row["PRECIO_VENTA_2"]}' name='precio_venta_2'>
                                    <input type='hidden' class='form-control mb-2' value='{$row["PRECIO_VENTA_3"]}' name='precio_venta_3'>
                                    <input type='hidden' class='form-control mb-2' value='{$row["PRECIO_VENTA_4"]}' name='precio_venta_4'>
                                    <input type='hidden' class='form-control mb-2' value='{$_POST["almacen"]}' name='almacen'>
                                    <input type='hidden' class='form-control mb-2' value='{$usuario}' name='usuario'>
                                    <input type='hidden' class='form-control mb-2' value='{$sucursal}' name='sucursal'>
                                </div>
                                <label style='margin-bottom: 0;'>Cantidad</label>
                                <div class='form-group'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg>
                                <input type='text' class='form-control mb-2' value='{$_POST["cantidad"]}' id='txt_cantidad_detalle2' name='cantidad'>
                                </div>
                                <label style='margin-bottom: 0;'>Fecha 1</label>
                                <div class='form-group'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'><rect x='3' y='4' width='18' height='18' rx='2' ry='2'></rect><line x1='16' y1='2' x2='16' y2='6'></line><line x1='8' y1='2' x2='8' y2='6'></line><line x1='3' y1='10' x2='21' y2='10'></line></svg>
                                    <input type='date' class='form-control mb-2' value='' id='fecha_1' name='fecha_1'>
                                </div>
                                <label style='margin-bottom: 0;'>Fecha 2</label>
                                <div class='form-group'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'><rect x='3' y='4' width='18' height='18' rx='2' ry='2'></rect><line x1='16' y1='2' x2='16' y2='6'></line><line x1='8' y1='2' x2='8' y2='6'></line><line x1='3' y1='10' x2='21' y2='10'></line></svg>
                                    <input type='date' class='form-control mb-2' value='' id='fecha_2' name='fecha_2'>
                                </div>
                                <label style='margin-bottom: 0;'>Fecha 3</label>
                                <div class='form-group'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'><rect x='3' y='4' width='18' height='18' rx='2' ry='2'></rect><line x1='16' y1='2' x2='16' y2='6'></line><line x1='8' y1='2' x2='8' y2='6'></line><line x1='3' y1='10' x2='21' y2='10'></line></svg>
                                    <input type='date' class='form-control mb-2' value='' id='fecha_3' name='fecha_3'>
                                </div>
                                <label style='margin-bottom: 0;'>Fecha 4</label>
                                <div class='form-group'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'><rect x='3' y='4' width='18' height='18' rx='2' ry='2'></rect><line x1='16' y1='2' x2='16' y2='6'></line><line x1='8' y1='2' x2='8' y2='6'></line><line x1='3' y1='10' x2='21' y2='10'></line></svg>
                                    <input type='date' class='form-control mb-2' value='' id='fecha_4' name='fecha_4'>
                                </div>
                                <button type='submit' class='btn btn-primary mt-2 mb-2 btn-block'>AGREGAR</button>
                            ";
                    }
                    echo $card;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        }
    }
    function generar_codigo_entradas(){
        $numero = $this->model->lista_kardex();
        if($numero){
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('KARDEX',6,$numero);
        }else{
            return 0;
        }
    }
    /* ========================================================================== */
    /*                     Funcion agregar productos por lote                     */
    /* ========================================================================== */

    function agregar_producto_lote()
    {
        if (isset($_POST["producto"]) && isset($_POST["almacen"])) {
            date_default_timezone_set(ZONEDATE);
            $fecha_registro = date('Y-m-d H:i:s');

            $id_almacen = $_POST["almacen"];
            $producto = $_POST["producto"];
            $cantidad = $_POST["cantidad"];
            $precio_costo = $_POST['precio_costo'];
            $precio_venta_1 = $_POST['precio_venta_1'];
            $precio_venta_2 = $_POST['precio_venta_2'];
            $precio_venta_3 = $_POST['precio_venta_3'];
            $precio_venta_4 = $_POST['precio_venta_4'];
            $usuario = $_POST['usuario'];
            $lote = 'INVENTARIO INICIAL';
            $codigo_lote = "";
            $consultar_lote_almacen = $this->model->consultar_lote($lote, $id_almacen);
            if ($consultar_lote_almacen) {
                if ($consultar_lote_almacen->rowCount() > 0) {
                    foreach ($consultar_lote_almacen as $row) {
                        $codigo_lote = "{$row["ID_LOTE"]}";
                    }
                    $codigo_item_lote = $this->generar_codigo_items_lote();
                    $guardar_item = $this->model->agregar_productos_lotes($codigo_item_lote, $id_almacen, $codigo_lote, $producto, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $cantidad, 0, NULL, $usuario);
                    if ($guardar_item) {
                        if ($guardar_item->rowCount() > 0) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 9;
                    }
                    $fecha_registro = date('Y-m-d H:i:s');
                    // Agregar entrada
                    $p_id_entrada = $this->generar_codigo_entradas();
                    $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                    $stock_global_entrada = mainModel::stock_global_producto($producto,$almacen_sucursal["ID_SUCURSAL"]);
                    $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$usuario,$codigo_item_lote,$cantidad*$precio_costo,$fecha_registro,2,$cantidad,0,$cantidad,$stock_global_entrada,"INVENTARIO INICIAL",NULL);
                    if(!$guardar_kardex_entrada){
                        echo 5;
                    }
                } else {
                    $codigo_lote = $this->generar_codigo_lote();
                    date_default_timezone_set(ZONEDATE);
                    $fecha_registro = date('Y-m-d');
                    $guardar_lote = $this->model->agregar_lotes($codigo_lote, $lote, $id_almacen, $fecha_registro, 1);
                    if ($guardar_lote) {
                        if ($guardar_lote->rowCount() > 0) {
                            $codigo_item_lote = $this->generar_codigo_items_lote();
                            $guardar_item = $this->model->agregar_productos_lotes($codigo_item_lote, $id_almacen, $codigo_lote, $producto, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $cantidad, 0, NULL, $usuario);
                            if ($guardar_item) {
                                if ($guardar_item->rowCount() > 0) {
                                    echo 1;
                                } else {
                                    echo 2;
                                }
                            } else {
                                echo 9;
                            }
                            $fecha_registro = date('Y-m-d H:i:s');
                            // Agregar entrada
                            $p_id_entrada = $this->generar_codigo_entradas();
                            $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                            $stock_global_entrada = mainModel::stock_global_producto($producto,$almacen_sucursal["ID_SUCURSAL"]);
                            $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$usuario,$codigo_item_lote,$cantidad*$precio_costo,$fecha_registro,2,$cantidad,0,$cantidad,$stock_global_entrada,"INVENTARIO INICIAL",NULL);
                            if(!$guardar_kardex_entrada){
                                echo 5;
                            }
                        }
                    } else {
                        echo 0;
                    }
                }
            } else {
                echo 0;
            }
        }
    }

    /* ========================================================================== */
    /*                            Genererar codigo lote                           */
    /* ========================================================================== */

    function generar_codigo_lote()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_lotes();
        if ($numero) {
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('LOTE', 6, $numero);
        } else {
            return 0;
        }
    }

    /* ========================================================================== */
    /*                        Generar codigo item por lote                        */
    /* ========================================================================== */

    function generar_codigo_items_lote()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_items_lotes();
        if ($numero) {
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('ITEM', 6, $numero);
        } else {
            return 0;
        }
    }

    /* ========================================================================== */
    /*                        Generar codigo de perecederos                       */
    /* ========================================================================== */

    function generar_codigo_perecederos()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_perecederos();
        if ($numero) {
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('PERECEDERO', 6, $numero);
        } else {
            return 0;
        }
    }

    /* ========================================================================== */
    /*                   Agregar productos con lote y perecedero                  */
    /* ========================================================================== */

    function agregar_producto_lote_perecedero()
    {
        if (isset($_POST["producto"]) && isset($_POST["almacen"])) {
            date_default_timezone_set(ZONEDATE);
            date_default_timezone_set(ZONEDATE);
            $id_almacen = $_POST["almacen"];
            $sucursal = $_POST["sucursal"];
            $producto = $_POST["producto"];
            $cantidad = $_POST["cantidad"];
            $precio_costo = $_POST['precio_costo'];
            $precio_venta_1 = $_POST['precio_venta_1'];
            $precio_venta_2 = $_POST['precio_venta_2'];
            $precio_venta_3 = $_POST['precio_venta_3'];
            $precio_venta_4 = $_POST['precio_venta_4'];
            $fecha_1 = date($_POST['fecha_1']);
            $fecha_2 = date($_POST['fecha_2']);
            $fecha_3 = date($_POST['fecha_3']);
            $fecha_4 = date($_POST['fecha_4']);
            $usuario = $_POST['usuario'];
            $lote = 'INVENTARIO INICIAL';
            $codigo_lote = "";
            $consultar_lote_almacen = $this->model->consultar_lote($lote, $id_almacen);
            if ($consultar_lote_almacen) {
                if ($consultar_lote_almacen->rowCount() > 0) {
                    foreach ($consultar_lote_almacen as $row) {
                        $codigo_lote = "{$row["ID_LOTE"]}";
                    }
                    $codigo_item_lote = $this->generar_codigo_items_lote();
                    $guardar_item = $this->model->agregar_productos_lotes($codigo_item_lote, $id_almacen, $codigo_lote, $producto, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $cantidad, 1, $fecha_4, $usuario);
                    if ($guardar_item) {
                        if ($guardar_item->rowCount() > 0) {
                            $id_perecedero = $this->generar_codigo_perecederos();
                            $guardar_perecedero = $this->model->agregar_perecedero($id_perecedero, $codigo_item_lote, $producto, $id_almacen, $sucursal, $fecha_1, $fecha_2, $fecha_3, $fecha_4);
                            if ($guardar_perecedero) {
                                if ($guardar_perecedero->rowCount() > 0) {
                                    echo 1;
                                } else {
                                    echo 2;
                                }
                            } else {
                                echo 0;
                            }
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 9;
                    }
                    // Agregar entrada
                    $fecha_registro = date('Y-m-d H:i:s');
                    $p_id_entrada = $this->generar_codigo_entradas();
                    $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                    $stock_global_entrada = mainModel::stock_global_producto($producto,$almacen_sucursal["ID_SUCURSAL"]);
                    $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$usuario,$codigo_item_lote,$cantidad*$precio_costo,$fecha_registro,2,$cantidad,0,$cantidad,$stock_global_entrada,"INVENTARIO INICIAL",NULL);
                    if(!$guardar_kardex_entrada){
                        echo 5;
                    }
                } else {
                    $codigo_lote = $this->generar_codigo_lote();
                    $fecha_registro = date('Y-m-d');
                    $guardar_lote = $this->model->agregar_lotes($codigo_lote, $lote, $id_almacen, $fecha_registro, 1);
                    if ($guardar_lote) {
                        if ($guardar_lote->rowCount() > 0) {
                            $codigo_item_lote = $this->generar_codigo_items_lote();
                            $guardar_item = $this->model->agregar_productos_lotes($codigo_item_lote, $id_almacen, $codigo_lote, $producto, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $cantidad, 1, $fecha_4, $usuario);
                            if ($guardar_item) {
                                if ($guardar_item->rowCount() > 0) {
                                    $id_perecedero = $this->generar_codigo_perecederos();
                                    $guardar_perecedero = $this->model->agregar_perecedero($id_perecedero, $codigo_item_lote, $producto, $id_almacen, $sucursal, $fecha_1, $fecha_2, $fecha_3, $fecha_4);
                                    if ($guardar_perecedero) {
                                        if ($guardar_perecedero->rowCount() > 0) {
                                            echo 1;
                                        } else {
                                            echo 2;
                                        }
                                    } else {
                                        echo 0;
                                    }
                                } else {
                                    echo 0;
                                }
                            } else {
                                echo 0;
                            }
                            // Agregar entrada
                            $fecha_registro = date('Y-m-d H:i:s');
                            $p_id_entrada = $this->generar_codigo_entradas();
                            $almacen_sucursal = mainModel::almacen_informacion($_POST["almacen"]);
                            $stock_global_entrada = mainModel::stock_global_producto($producto,$almacen_sucursal["ID_SUCURSAL"]);
                            $guardar_kardex_entrada = $this->model->agregar_kardex($p_id_entrada,NULL,$almacen_sucursal["ID_SUCURSAL"],$usuario,$codigo_item_lote,$cantidad*$precio_costo,$fecha_registro,2,$cantidad,0,$cantidad,$stock_global_entrada,"INVENTARIO INICIAL",NULL);
                            if(!$guardar_kardex_entrada){
                                echo 5;
                            }
                        }
                    } else {
                        echo 0;
                    }
                }
            } else {
                echo 0;
            }
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                             vista ver producto                             */
    /* -------------------------------------------------------------------------- */
    function verproductos($param = null)
    {
        if ($param ==  null) {
            $this->view->render("error/404");
        } else if (!is_string(mainModel::decryption($param[0]))) {
            $this->view->render("error/404");
        } else {
            $this->view->lista_unidades = $this->model->listar_unidades();
            $this->view->listar_linea = $this->model->listar_linea();
            $this->view->lista_presentacion = $this->model->listar_presentacion();
            $this->view->parametros_producto = mainModel::parametros_producto(mainModel::decryption($param[0]));
            $this->view->render("productos/editar");
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                         Funcion actualizar producto                        */
    /* -------------------------------------------------------------------------- */

    function actualizar_producto()
    {
        if (isset($_POST["code_barra"]) && isset($_POST["producto"])) {
            $fotoproducto = "";
            $codigo = $_POST["id_producto"];
            $code_barra =  mainModel::clean_string($_POST["code_barra"]);
            $producto =  mainModel::clean_string($_POST["producto"]);
            $complemento =  mainModel::clean_string($_POST["complemento"]);
            $unidad =  mainModel::clean_string($_POST["unidad"]);
            $precio_compra = floatval($_POST["precio_compra"]);
            $precio_venta = floatval($_POST["precio_venta"]);
            $precio_venta_2 = floatval($_POST["precio_venta_2"]);
            $precio_venta_3 = floatval($_POST["precio_venta_3"]);
            $precio_venta_4 = floatval($_POST["precio_venta_4"]);
            $linea = mainModel::clean_string($_POST["linea"]);
            $presentacion = mainModel::clean_string($_POST["presentacion"]);
            $stock1 = mainModel::clean_string($_POST["stock1"]);
            $stock2 = mainModel::clean_string($_POST["stock2"]);
            $stock3 = mainModel::clean_string($_POST["stock3"]);
            $perecedero = filter_input(INPUT_POST, 'perecedero', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $perecedero = $perecedero == 1 ? 1 : 0;
            $excento = filter_input(INPUT_POST, 'excento', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $excento = $excento == 1 ? 1 : 0;
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            if ($_FILES["file"]['tmp_name']) {
                $name = $_FILES["file"]['name'];
                $tmp = $_FILES["file"]['tmp_name'];
                $info = new SplFileInfo($_FILES["file"]['name']);
                $extension = $info->getExtension();
                $fotoproducto = mainModel::generar_codigo_aleatorio('PRODUCTO', 20, rand(0, 9)) . "." . $extension;
                if ($_FILES["file"]['tmp_name']) {
                    if (move_uploaded_file($tmp, "archives/assets/productos/$fotoproducto")) {
                        $actualizar_producto_con_foto = $this->model->actualizar_producto_with_photo($codigo, $code_barra, $producto, $presentacion, $linea, $unidad, $complemento, $precio_compra, $precio_venta, $precio_venta_2, $precio_venta_3, $precio_venta_4, $stock1, $stock2, $stock3, $perecedero, $excento, $estado, $fotoproducto);
                        if ($actualizar_producto_con_foto) {
                            echo 1;
                        } else {
                            echo 0;
                        }
                    } else {
                        echo 2;
                    }
                } else {
                    echo 1;
                }
            } else {
                $actualizar_producto_sin_foto = $this->model->actualizar_producto_without_photo($codigo, $code_barra, $producto, $presentacion, $linea, $unidad, $complemento, $precio_compra, $precio_venta, $precio_venta_2, $precio_venta_3, $precio_venta_4, $stock1, $stock2, $stock3, $perecedero, $excento, $estado);
                if ($actualizar_producto_sin_foto) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }

    /* ========================================================================== */
    /*                             Formulario Producto                            */
    /* ========================================================================== */
    function form_producto()
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $consultar_producto = $this->model->consulta_producto($id);
            if ($consultar_producto) {
                $formulario = "";
                if ($consultar_producto->rowCount() > 0) {
                    foreach ($consultar_producto as $row) {
                        $estado = "INACTIVO";
                        if ($row["ESTADO"] == 1) {
                            $estado = "ACTIVO";
                        }
                        $perecedero = "NO PERECEDERO";
                        if ($row["PERECEDERO"] == 1) {
                            $perecedero = "PERECEDERO";
                        }
                        $enlace = SERVERURL;
                        $formulario .= "
                            <div class='widget-content widget-content-area'>
                                <div class='d-flex justify-content-between'>
                                    <h3 class=''>Info</h3>
                                    <a class='mt-2 edit-profile'> 
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-archive'><polyline points='21 8 21 21 3 21 3 8'></polyline><rect x='1' y='3' width='22' height='5'></rect><line x1='10' y1='12' x2='14' y2='12'></line></svg>
                                    </a>
                                </div>
                                <div class='text-center user-info'>
                                    <img src='{$enlace}archives/assets/productos/{$row["IMAGEN"]}' alt='Foto referencial del producto' style='width: 40%;'>
                                    <p class=''>{$row["ARTICULO"]}</p>
                                </div>
                                <div class='user-info-list'>
                                    <div class=''>
                                    <div class='row layout-top-spacing justify-content-md-center'>
                                            <div class='col-5'>
                                                <ul class='contacts-block list-unstyled'>
                                                    <li class='contacts-block__item'>     
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-grid'><rect x='3' y='3' width='7' height='7'></rect><rect x='14' y='3' width='7' height='7'></rect><rect x='14' y='14' width='7' height='7'></rect><rect x='3' y='14' width='7' height='7'></rect></svg> {$row["BARRA"]}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-clipboard'><path d='M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2'></path><rect x='8' y='2' width='8' height='4' rx='1' ry='1'></rect></svg>{$row["PRECIO_COSTO"]} - P.COMPRA
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-shopping-bag'><path d='M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z'></path><line x1='3' y1='6' x2='21' y2='6'></line><path d='M16 10a4 4 0 0 1-8 0'></path></svg> {$row["PRECIO_VENTA_4"]} - P.VENTA 4
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-box'><path d='M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z'></path><polyline points='3.27 6.96 12 12.01 20.73 6.96'></polyline><line x1='12' y1='22.08' x2='12' y2='12'></line></svg> {$row["NOMBRE"]}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-tag'><path d='M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z'></path><line x1='7' y1='7' x2='7.01' y2='7'></line></svg> {$row["LINEA"]}
                                                    </li>   
                                                </ul>
                                            </div>
                                            <div class='col-5'>
                                                <ul class='contacts-block list-unstyled'>
                                                    <li class='contacts-block__item'>     
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-package'><line x1='16.5' y1='9.4' x2='7.5' y2='4.21'></line><path d='M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z'></path><polyline points='3.27 6.96 12 12.01 20.73 6.96'></polyline><line x1='12' y1='22.08' x2='12' y2='12'></line></svg> {$row["STOCK_MINIMO"]} - STOCK MIN.
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-package'><line x1='16.5' y1='9.4' x2='7.5' y2='4.21'></line><path d='M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z'></path><polyline points='3.27 6.96 12 12.01 20.73 6.96'></polyline><line x1='12' y1='22.08' x2='12' y2='12'></line></svg> {$row["STOCK_MEDIO"]} - STOCK MED.
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-package'><line x1='16.5' y1='9.4' x2='7.5' y2='4.21'></line><path d='M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z'></path><polyline points='3.27 6.96 12 12.01 20.73 6.96'></polyline><line x1='12' y1='22.08' x2='12' y2='12'></line></svg> {$row["STOCK_MODERADO"]} - STOCK MOD.
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-calendar'><rect x='3' y='4' width='18' height='18' rx='2' ry='2'></rect><line x1='16' y1='2' x2='16' y2='6'></line><line x1='8' y1='2' x2='8' y2='6'></line><line x1='3' y1='10' x2='21' y2='10'></line></svg> {$perecedero}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-power'><path d='M18.36 6.64a9 9 0 1 1-12.73 0'></path><line x1='12' y1='2' x2='12' y2='12'></line></svg> {$estado}
                                                    </li>     
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                                        
                            ";
                    }
                    echo $formulario;
                }
            } else {
                echo 0;
            }
        }
    }

    /* -------------------------------------------------------------------------- */
    /*                              Eliminar Producto                             */
    /* -------------------------------------------------------------------------- */

    function eliminar_producto()
    {
        if (isset($_POST["id"])) {
            $eliminar = $this->model->eliminar_producto($_POST["id"]);
            if ($eliminar) {
                if ($eliminar->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        }
    }
    function plantilla_excel(){
        $this->view->presentaciones =  $this->model->listar_presentacion();
        $this->view->lineas =  $this->model->listar_linea();
        $this->view->unidades =  $this->model->listar_unidades();
        $this->view->render("productos/plantilla_excel");
    }
    function exceltomysql(){
        include 'view/assets/plugins/simplexlsx/simplexlsx.class.php';
        $files_post = $_FILES['file'];
        $files = array();
        $file_count = count($files_post['name']);
        $n = intval($file_count);
        $file_keys = array_keys($files_post);
        
        for ($i=0; $i < $file_count; $i++) 
        { 
            foreach ($file_keys as $key) 
            {
                $files[$i][$key] = $files_post[$key][$i];
            }
        }
        foreach ($files as $fileID => $file)
        {
            $fileContent = file_get_contents($file['tmp_name']);
            $info = new SplFileInfo($file['name']);
            $extension = $info->getExtension();
            $name = mainModel::generar_codigo_aleatorio('EXCEL',7,rand(1,9)).".".$extension;
            file_put_contents("archives/documents/$name", $fileContent);
            $xlsx = new SimpleXLSX("archives/documents/$name");
            $agregados = 0;
            foreach ($xlsx->rows() as $fields)
            {
                // $id = $this->generar_codigo();
                $codigo_producto =  $this::generar_codigo();
                $codigo_barra = $fields[0];
                if(!empty($codigo_barra) && $codigo_barra != "CODIGO_BARRA"){
                    $nombre_producto = $fields[1];
                    $presentacion = mainModel::retornar_codigo_presentacion($fields[2]);
                    $linea = mainModel::retornar_codigo_linea($fields[3]);
                    $unidad_medida = explode(" - ",$fields[4]);
                    $codigo_unidad = mainModel::retornar_codigo_unidad($unidad_medida[0],$unidad_medida[1]);
                    $complemento = $fields[5];
                    $precio_costo = $fields[6];
                    $precio_venta_1 = $fields[7];
                    $precio_venta_2 = $fields[8];
                    $precio_venta_3 = $fields[9];
                    $precio_venta_4 = $fields[10];
                    $stock_minimo = $fields[11];
                    $stock_medio = $fields[12];
                    $stock_moderado = $fields[13];
                    $perecedero = $fields[14];
                    if($perecedero == "PERECEDERO"){
                        $perecedero = 1;
                    }else{
                        $perecedero = 0;
                    }

                    $exento = $fields[15];
                    if($exento == "EXENTO"){
                        $exento = 1;
                    }else{
                        $exento = 0;
                    }
                    $agregar_producto = $this->model->agregar_producto($codigo_producto, $codigo_barra, $nombre_producto, $presentacion, $linea, $codigo_unidad, $complemento, $precio_costo, $precio_venta_1, $precio_venta_2, $precio_venta_3, $precio_venta_4, $stock_minimo, $stock_medio, $stock_moderado, $perecedero, $exento, 1, "empty_producto.png");
                    if($agregar_producto){
                        $agregados++;
                    }
                }
                
            }
            echo "1|$agregados";
        }
    }
        function imagenesproducto($param = null)
    {
        if ($param ==  null) {
            $this->view->render("error/404");
        } else if (!is_string(mainModel::decryption($param[0]))) {
            $this->view->render("error/404");
        } else {
            $this->view->id_producto = mainModel::decryption($param[0]);
            $this->view->lista_unidades = $this->model->listar_unidades();
            $this->view->listar_linea = $this->model->listar_linea();
            $this->view->lista_presentacion = $this->model->listar_presentacion();
            $this->view->parametros_producto = mainModel::parametros_producto(mainModel::decryption($param[0]));
            $this->view->render("productos/imagenes");
        }
    }
    function caracteristicasproducto($param = null)
    {
        if ($param ==  null) {
            $this->view->render("error/404");
        } else if (!is_string(mainModel::decryption($param[0]))) {
            $this->view->render("error/404");
        } else {
            $this->view->id_producto = mainModel::decryption($param[0]);
            $this->view->lista_unidades = $this->model->listar_unidades();
            $this->view->listar_linea = $this->model->listar_linea();
            $this->view->lista_presentacion = $this->model->listar_presentacion();
            $this->view->parametros_producto = mainModel::parametros_producto(mainModel::decryption($param[0]));
            $this->view->render("productos/caracteristicas");
        }
    }
    function generar_codigo_imagen()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_img_productos();
        if ($numero) {
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('PRODUCTO', 6, $numero);
        } else {
            return 0;
        }
    }
    function generar_codigo_caracteristica()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_caracteristica_productos();
        if ($numero) {
            $numero = $numero->rowCount();
            return mainModel::generar_codigo_aleatorio('CARACTE', 6, $numero);
        } else {
            return 0;
        }
    }
    function agregar_imagenes_producto(){
        if(isset($_POST["id_producto"])){
            
            if ($_FILES["file"]['tmp_name']) {
                $name = $_FILES["file"]['name'];
                $tmp = $_FILES["file"]['tmp_name'];
                $info = new SplFileInfo($_FILES["file"]['name']);
                $extension = $info->getExtension();
                $fotoproducto = mainModel::generar_codigo_aleatorio('PRODUCTO', 20, rand(0, 9)) . "." . $extension;
                if ($_FILES["file"]['tmp_name']) {
                    if (move_uploaded_file($tmp, "archives/assets/productos/$fotoproducto")) {
                        $codigo = $this->generar_codigo_imagen();
                        $agregar_imagen_producto = $this->model->agregar_imagen_producto($codigo, $_POST["id_producto"], $fotoproducto);
                        if ($agregar_imagen_producto) {
                            echo 1;
                        } else {
                            echo 0;
                        }
                    } else {
                        echo 2;
                    }
                }
            }
        }
    }
    function agregar_caracteristicas(){
        if(isset($_POST["id_producto"])){
            $codigo = $this->generar_codigo_caracteristica();
            $agregar =  $this->model->agregar_caracteristica_producto($codigo,$_POST["id_producto"],$_POST["caracteristica"]);
            if($agregar){
                if($agregar->rowCount()>0){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }
    function actualizar_caracteristica(){
        if(isset($_POST["id_caracteristica"])){
            $id = $_POST["id_caracteristica"];
            $nombre = $_POST["caracteristica"];
            $actualizar_caracteristica = $this->model->actualizar_caracteristica($id,$nombre);
            if($actualizar_caracteristica){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    function lista_imagenes_productos(){
        if(isset($_POST["id"])){
            $lista = $this->model->lista_img_productos_producto($_POST["id"]);
            if($lista){
                $n = 1;
                $tabla = "";
                foreach ($lista as $rows) {
                    $imagen = SERVERURL . "archives/assets/productos/{$rows["IMG"]}";
                    $id_producto = mainModel::encryption($rows["ID_PRODUCTO"]);
                    $tabla .= "
                             <tr>
                                <td class='checkbox-column'> $n </td>
                                
                                <td class=''>
                                    <a class='profile-img' href='javascript: void(0);'>
                                    <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>
                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$rows['ID_IMG']}' img='{$rows['IMG']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
                        ";
                    $n++;
                }
                echo $tabla;
            }
        }
    }
    function caracteristicas_producto(){
        if(isset($_POST["id"])){
            $lista = $this->model->lista_caracteristicas_productos_producto($_POST["id"]);
            if($lista){
                $n = 1;
                $tabla = "";
                foreach ($lista as $rows) {
                    $tabla .= "
                             <tr>
                                <td class='checkbox-column'> $n </td>
                                
                                <td class=''>
                                    {$rows['CARACTERISTICA']}
                                </td>
                                <td>
                                <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_CARACTERISTICA']}'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'>
                                    <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                </svg>
                            </button>
                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$rows['ID_CARACTERISTICA']}' >
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
                        ";
                    $n++;
                }
                echo $tabla;
            }
        }
    }

    function form_caracteristica(){
        if(isset($_POST["id"])){    
            $id = $_POST["id"];
            $consultar_provincia = $this->model->consulta_caracteristica($id);
            if($consultar_provincia){
                $formulario = "";
                if($consultar_provincia->rowCount()>0){
                    foreach($consultar_provincia as $row){
                        
                        $formulario .= "
                        <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Agregar caracteristica</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <svg aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'><line x1='18' y1='6' x2='6' y2='18'></line><line x1='6' y1='6' x2='18' y2='18'></line></svg>
                        </button>
                    </div>
                    <div class='modal-body text-left'>
                        <div class='form-row'>
                            <div class='col-md-12 mb-4'>
                                <label for='caracteristica'>Caracteristica</label>
                                <textarea class='form-control'  name='caracteristica' id='caracteristica' cols='20' rows='10'>{$row["CARACTERISTICA"]}</textarea>
                                <input type='hidden' name='id_caracteristica' id='id_caracteristica' value='{$row["ID_CARACTERISTICA"]}' cols='20' rows='10'></input>
                                <input type='hidden' class='form-control' name='id_producto' id='id_producto' value='{$row["ID_PRODUCTO"]}'>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-primary'>
                            Actualizar
                        </button>
                    </div>
                        
                        ";
                    }
                    echo $formulario;
                }   
            }else{
                echo 0;
            }
        }
    }

    function eliminar_caracteristica(){
        if(isset($_POST["id"])){
            $eliminar = $this->model->eliminar_caracteristica($_POST["id"]);
            if($eliminar){
                if($eliminar->rowCount()>0){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }


    function eliminar_imagen(){
        if(isset($_POST["img"])){
            $filename = "archives/assets/productos/{$_POST['img']}";
            if(file_exists($filename)){
               $eliminar = unlink($filename);
                if($eliminar){
                    $eliminar_img = $this->model->eliminar_imagen($_POST["id"]);
                    if($eliminar_img){
                        echo 1;
                    }
                }
            }else{
                echo 0;
            }
        }
    }
}
