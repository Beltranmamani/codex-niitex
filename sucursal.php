<?php
class sucursal extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

/* ========================================================================== */
/*                              Vista sucursales                              */
/* ========================================================================== */

    public function render()
    {
        $this->view->render('sucursal/index');
    }

/* ========================================================================== */
/*                      Vista del detalle de la sucursal                      */
/* ========================================================================== */

    public function configuracion()
    {
        session_name('B_POS');
        session_start();
        $this->view->lista_documentos = $this->model->lista_documentos();
        $this->view->parametros_sucursal = mainModel::parametros_sucursal($_SESSION['sucursal']);
        $this->view->render('sucursal/detalle');
    }

/* ========================================================================== */
/*                       Vista de sucursales disponibles                      */
/* ========================================================================== */

    public function sucursales()
    {
        session_name('B_POS');
        session_start();
        $this->view->render('sucursal/sucursales');
    }

/* ========================================================================== */
/*                            Vista nueva susursal                            */
/* ========================================================================== */

    public function nuevosucursal()
    {
        $this->view->lista_documentos = $this::lista_documentos();
        $this->view->render('sucursal/nuevo');
    }

/* ========================================================================== */
/*          Funcion de lista de documentos disponibles en el sistema          */
/* ========================================================================== */

    public function lista_documentos()
    {
        $unidades = $this->model->lista_documentos();
        if ($unidades) {
            $option = "";
            foreach ($unidades as $row) {
                if ($row['ESTADO'] == 0) {
                    $option .= "<option value='{$row['ID_DOCUMENTO']}' disabled>{$row['DOCUMENTO']}</option>";
                } else {
                    $option .= "<option value='{$row['ID_DOCUMENTO']}'>{$row['DOCUMENTO']}</option>";
                }
            }
            return $option;
        }
    }

/* ========================================================================== */
/*            Funcion para generar codigo unico para cada sucursal            */
/* ========================================================================== */

    public function generar_codigo_dosificacion()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->consultar_dosificaciones();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio('DOSIFICACION', 6, $numero);
        } else {
            return 0;
        }
    }
    public function generar_codigo()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_sucursales();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio('SUCURSAL', 6, $numero);
        } else {
            return 0;
        }
    }

/* ========================================================================== */
/*                        Funcion para guardar sucursal                       */
/* ========================================================================== */

    public function guardarsucursal()
    {
        if (isset($_POST["nombre_sucursal"]) && isset($_POST["tipo_documento"])) {
            $codigo = $this::generar_codigo();
            $nombre = $_POST["nombre_sucursal"];
            $tipo_documento = $_POST["tipo_documento"];
            $numero_doc = mainModel::clean_string($_POST["numero_doc"]);
            $iva = number_format(mainModel::clean_string($_POST["iva"]), 2);
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $moneda = $_POST["moneda"];
            $email = $_POST["email"];
            $representante = $_POST["representante"];
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            // IMAGEN LOGO
            $name = $_FILES["file"]['name'];
            $tmp = $_FILES["file"]['tmp_name'];
            $info = new SplFileInfo($_FILES["file"]['name']);
            $extension = $info->getExtension();
            $logosucursal = mainModel::generar_codigo_aleatorio('SUCURSAL', 20, rand(0, 9)) . "." . $extension;
            $guardarsucursal = $this->model->guardarsucursal($codigo, $nombre, $tipo_documento, $numero_doc, $iva, $moneda, $direccion, $telefono, $email, $representante, $logosucursal, $estado);
            if ($guardarsucursal) {
                if ($guardarsucursal->rowCount() > 0) {
                    if (move_uploaded_file($tmp, "archives/assets/sucursales/$logosucursal")) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                    echo 2;
                }
            } else {
                echo 3;
            }

        }
    }

/* ========================================================================== */
/*                         Funcion lista de sucursales                        */
/* ========================================================================== */

    public function lista_sucursales()
    {
        if (isset($_POST["token"])) {
            $presentacion = $this->model->lista_sucursales();
            if ($presentacion) {
                $n = 1;
                $tabla = "";
                foreach ($presentacion as $rows) {
                    $imagen = SERVERURL . "archives/assets/sucursales/{$rows["LOGO"]}";
                    $enlace = SERVERURL;
                    $estado = $rows['ESTADO'];
                    $id_sucursal = mainModel::encryption($rows["ID_SUCURSAL"]);
                    if ($estado == 1) {
                        $estado = "<span class='shadow-none badge badge-success'>Vigente</span>";
                    } else {
                        $estado = "<span class='shadow-none badge badge-dark'>Descontinuada</span>";
                    }
                    $tabla .= "
                             <tr>
                                <td class='checkbox-column'> $n </td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td class='user-name'>{$rows["NOMBRE"]}</td>
                                <td>{$rows["DOCUMENTO"]} {$rows["NUMERO"]}</td>
                                <td>{$rows["MONEDA"]}</td>
                                <td>{$rows["IVA"]} %</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["TELEFONO"]}</td>
                                <td>{$rows["REPRESENTANTE"]}</td>
                                <td>{$estado}</td>
                                <td class='text-center'>
                                <ul class='table-controls'>
                                <li>
                                    <a href='{$enlace}sucursal/versucursal/{$id_sucursal}' class='bs-tooltip btn_actualizar'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href='{$enlace}sucursal/dosificacion/{$id_sucursal}' class='bs-tooltip btn_actualizar'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Dosificacion'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text p-1 br-6 mb-1'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href='#' class='bs-tooltip btn_eliminar' id_sucursal='{$rows["ID_SUCURSAL"]}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar'>
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
/*               Funcion para mostrar las sucursales disponibles              */
/* ========================================================================== */

    public function lista_sucurales_disponibles()
    {
        if (isset($_POST["token"])) {
            session_name('B_POS');
            session_start();
            $usuario = $_SESSION["usuario"];
            if ($usuario == "ADMIN01") {
                $sucursales = $this->model->lista_sucursales();
                if ($sucursales) {
                    $tabla = "";
                    foreach ($sucursales as $rows) {
                        $imagen = SERVERURL . "archives/assets/sucursales/{$rows["LOGO"]}";
                        $estado = $rows['ESTADO'];
                        if ($estado == 1) {
                            $estado = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-log-in t-icon t-hover-icon btn_sucursal' sucursal='{$rows['ID_SUCURSAL']}' logo='{$imagen}' nombre = '{$rows['NOMBRE']}'><path d='M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4'></path><polyline points='10 17 15 12 10 7'></polyline><line x1='15' y1='12' x2='3' y2='12'></line></svg>";
                        } else {
                            $estado = "";
                        }
                        $tabla .= "
                            <tr>
                                <td>
                                        <div class='usr-img-frame mr-2 rounded-circle' style='width:100px;margin: 0;margin-bottom: 70px;background-color: #fff;'>
                                            <img alt='avatar' class='img-fluid rounded-circle' src='{$imagen}' style='width: auto;'>
                                        </div>

                                </td>
                                <td>{$rows["NOMBRE"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["TELEFONO"]}</td>
                                <td class=' text-center'>
                                    $estado
                                </td>
                            </tr>
                            ";
                    }
                    echo $tabla;
                } else {
                    echo 0;
                }
            } else {
                $sucursales = $this->model->lista_sucursales_usuario($_SESSION["usuario"]);
                if ($sucursales) {
                    $tabla = "";
                    foreach ($sucursales as $rows) {
                        $imagen = SERVERURL . "archives/assets/sucursales/{$rows["LOGO"]}";
                        $estado = $rows['ESTADO'];
                        if ($estado == 1) {
                            $estado = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-log-in t-icon t-hover-icon btn_sucursal' sucursal='{$rows['ID_SUCURSAL']}' logo='{$imagen}' nombre = '{$rows['NOMBRE']}'><path d='M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4'></path><polyline points='10 17 15 12 10 7'></polyline><line x1='15' y1='12' x2='3' y2='12'></line></svg>";
                        } else {
                            $estado = "";
                        }
                        $tabla .= "
                            <tr>
                                <td>
                                        <div class='usr-img-frame mr-2 rounded-circle'  style='width:100px;margin: 0;margin-bottom: 70px; background-color: #fff;'>
                                            <img alt='avatar' class='img-fluid rounded-circle' src='{$imagen}' style='width: auto;'>
                                        </div>

                                </td>
                                <td>{$rows["NOMBRE"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["TELEFONO"]}</td>
                                <td class=' text-center'>
                                    $estado
                                </td>
                            </tr>
                            ";
                    }
                    echo $tabla;
                } else {
                    echo 0;
                }
            }
        }
    }

/* ========================================================================== */
/*                      Funcion para seleccionar sucursal                     */
/* ========================================================================== */

    public function seleccionar_sucursal()
    {
        if (isset($_POST["sucursal"])) {
            session_name('B_POS');
            session_start();
            date_default_timezone_set(ZONEDATE);
            $date_registro = date('Y-m-d H:i:s');
            $_SESSION["sucursal"] = $_POST["sucursal"];
            $_SESSION["logo_sucursal"] = $_POST["logo"];
            $_SESSION["nombre_sucursal"] = $_POST["nombre"];
            $sucursal_busqueda = mainModel::parametros_sucursal($_SESSION["sucursal"]);
            $_SESSION["moneda"] = $sucursal_busqueda["MONEDA"];
            $_SESSION["iva"] = $sucursal_busqueda["IVA"];
            $sucursal = $_SESSION["sucursal"];
            $usuario = $_SESSION["usuario"];
            if ($sucursal != "0") {
                $almacenes = "";
                $buscaralmacenes = $this->model->listar_almacenesXsucursal($sucursal);
                if ($buscaralmacenes) {
                    foreach ($buscaralmacenes as $row) {
                        $id = mainModel::encryption($row["ID_ALMACEN"]);
                        $almacenes .= "{$id},{$row["NOMBRE"]}" . "|";
                    }
                }
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $codigo_bitacora = $this->generar_codigo_bitacora();
                $nro_ip = $this->get_cliente_ip();
                $navegador = $this->getBrowser($user_agent);
                $guardar_bitacora = $this->model->guardarbitacora($codigo_bitacora,$usuario,$sucursal,$date_registro,$nro_ip,$navegador);
                if(!$guardar_bitacora){
                    echo 4;
                }
                $_SESSION["almacenes"] = $almacenes;
                if($usuario == "ADMIN01"){
                    $array = [
                        "DASHBOARD" => 1,
                        "POS" => 1,
                        "CONFIGURACION" => 1,
                        "SUCURSALES" => 1,
                        "DOCUMENTOS" => 1,
                        "COMPROBANTES" => 1,
                        "PERSONAL" => 1,
                        "PRODUCTOS" => 1,
                        "PRESENTACION" => 1,
                        "UNIDAD_MEDIDA" => 1,
                        "LINEAS" => 1,
                        "PERCEDEROS" => 1,
                        "ALMACEN" => 1,
                        "PROVEEDORES" => 1,
                        "COMPRAS" => 1,
                        "CONSULTA_COMPRAS" => 1,
                        "HISTORICO_PRECIOS" => 1,
                        "CUENTAS_PAGAR" => 1,
                        "REPORTE_COMPRAS" => 1,
                        "CREDITOS" => 1,
                        "PAGAR_CREDITOS" => 1,
                        "CONSULTA_PAGOS" => 1,
                        "ASIGNACION_CAJA" => 1,
                        "ARQUEOS_CAJA" => 1,
                        "MOVIMIENTOS_CAJA" => 1,
                        "REPORTE_CAJA" => 1,
                        "COTIZACION" => 1,
                        "CONSULTA_COTIZACION" => 1,
                        "REPORTE_COTIZACION" => 1,
                        "PREVENTA" => 1,
                        "CONSULTA_PREVENTA" => 1,
                        "REPORTE_PREVENTA" => 1,
                        "VENTA" => 1,
                        "CLIENTE" => 1,
                        "CONSULTA_VENTA" => 1,
                        "CUENTAS_COBRAR" => 1,
                        "REPORTE_VENTAS" => 1,
                        "CREDITOS_VENTAS" => 1,
                        "ABONAR_CREDITOS" => 1,
                        "CONSULTA_ABONO" => 1,
                        "INVENTARTIO_GENERAL" => 1,
                        "CONSULTA_PRODUCTOS" => 1,
                        "NUEVO_TRASPASO" => 1,
                        "AJUSTE_INVENTARIO" => 1,
                        "CONSULTA_TRASPASO" => 1,
                        "CONSULTA_AJUSTES" => 1,
                        "KARDEX_PRODUCTOS" => 1,
                        "KARDEX_VALORIZADO" => 1,
                        "KARDEX_GENERAL" => 1,
                        "K_VALO_FECHA" => 1,
                        "TIENDA" => 1,
                        "FACTURA" => 1,
                        "PEDIDO_TRASPASO"=> 1,
                        "PEDIDO_TRASPASO_LISTA"=> 1,
                        "PAGOS_PENDIENTES"=> 1,
                        "PEDIDO_TRASPASO_PENDIENTES"=> 1
                    ];
                    $_SESSION["modulos_access"] =  $array;
                }else{
                    $_SESSION["modulos_access"] = mainModel::permisos_sucursal($usuario,$sucursal);
                }
                $buscar_caja = $this->model->buscar_caja($usuario, $sucursal);
                if ($buscar_caja) {
                    if ($buscar_caja->rowCount() > 0) {
                        foreach ($buscar_caja as $row) {
                            $_SESSION["caja"] = "{$row['ID_ARQUEO']}";
                        }
                    }
                }
                echo 1;
            } else {
                echo 0;
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                            Actualizar sucursales                           */
/* -------------------------------------------------------------------------- */

    public function actualizar_sucursal()
    {
        if (isset($_POST["nombre_sucursal"]) && isset($_POST["tipo_documento"])) {
            $logosucursal = "";
            $codigo = $_POST["id_sucursal"];
            $nombre = $_POST["nombre_sucursal"];
            $tipo_documento = $_POST["tipo_documento"];
            $numero_doc = mainModel::clean_string($_POST["numero_doc"]);
            $iva = number_format(mainModel::clean_string($_POST["iva"]), 2);
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $moneda = $_POST["moneda"];
            $email = $_POST["email"];
            $representante = $_POST["representante"];
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            if ($_FILES["file"]['tmp_name']) {
                $name = $_FILES["file"]['name'];
                $tmp = $_FILES["file"]['tmp_name'];
                $info = new SplFileInfo($_FILES["file"]['name']);
                $extension = $info->getExtension();
                $logosucursal = mainModel::generar_codigo_aleatorio('SUCURSAL', 20, rand(0, 9)) . "." . $extension;
                if ($_FILES["file"]['tmp_name']) {
                    if (move_uploaded_file($tmp, "archives/assets/sucursales/$logosucursal")) {
                        $actualizar_sucursal_con_foto = $this->model->actualizar_sucursal_with_logo($codigo, $nombre, $tipo_documento, $numero_doc, $iva, $moneda, $direccion, $telefono, $email, $representante, $logosucursal, $estado);
                        if ($actualizar_sucursal_con_foto) {
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
                $actualizar_sucursal_sin_foto = $this->model->actualizar_sucursal_without_logo($codigo, $nombre, $tipo_documento, $numero_doc, $iva, $moneda, $direccion, $telefono, $email, $representante, $estado);
                if ($actualizar_sucursal_sin_foto) {
                    echo 1;
                } else {
                    echo "0";
                }
            }
        }
    }

/* ========================================================================== */
/*                                Ver Sucursal                                */
/* ========================================================================== */

    public function versucursal($param = null)
    {
        if ($param == null) {
            $this->view->render("error/404");
        } else if (!is_string(mainModel::decryption($param[0]))) {
            $this->view->render("error/404");
        } else {
            $this->view->lista_documentos = $this->model->lista_documentos();
            $this->view->parametros_sucursal = mainModel::parametros_sucursal(mainModel::decryption($param[0]));
            $this->view->render('sucursal/editar_sucursal');
        }
    }
    public function dosificacion($param = null)
    {
        if ($param == null) {
            $this->view->render("error/404");
        } else if (!is_string(mainModel::decryption($param[0]))) {
            $this->view->render("error/404");
        } else {
            $this->view->lista_documentos = $this->model->lista_documentos();
            $this->view->parametros_sucursal = mainModel::parametros_sucursal(mainModel::decryption($param[0]));
            $this->view->render('sucursal/dosificacion');
        }
    }

/* -------------------------------------------------------------------------- */
/*                             Formulario Sucursal                            */
/* -------------------------------------------------------------------------- */
    public function form_sucursal()
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $consultar_sucursal = $this->model->consulta_sucursal($id);
            if ($consultar_sucursal) {
                $formulario = "";
                if ($consultar_sucursal->rowCount() > 0) {
                    foreach ($consultar_sucursal as $row) {
                        $estado = "INACTIVO";
                        if ($row["ESTADO"] == 1) {
                            $estado = "ACTIVO";
                        }
                        $enlace = SERVERURL;
                        $formulario .= "
                            <div class='widget-content widget-content-area'>
                                <div class='d-flex justify-content-between'>
                                    <h3 class=''>Info</h3>
                                    <a class='mt-2 edit-profile'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-bookmark'><path d='M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z'></path></svg>
                                    </a>
                                </div>
                                <div class='text-center user-info'>
                                    <img src='{$enlace}archives/assets/sucursales/{$row["LOGO"]}' alt='Foto referencial del producto' style='width: 40%;'>
                                    <p class=''>{$row["NOMBRE"]}</p>
                                </div>
                                <div class='user-info-list'>
                                    <div class=''>
                                    <div class='row layout-top-spacing justify-content-md-center'>
                                                <ul class='contacts-block list-unstyled'>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-map-pin'><path d='M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z'></path><circle cx='12' cy='10' r='3'></circle></svg> {$row["DIRECCION"]}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-briefcase'><rect x='2' y='7' width='20' height='14' rx='2' ry='2'></rect><path d='M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16'></path></svg>{$row["DOCUMENTO"]} {$row["NUMERO"]}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user'><path d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'></path><circle cx='12' cy='7' r='4'></circle></svg> {$row["REPRESENTANTE"]}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-mail'><path d='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'></path><polyline points='22,6 12,13 2,6'></polyline></svg> {$row["EMAIL"]}
                                                    </li>
                                                    <li class='contacts-block__item'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-phone'><path d='M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z'></path></svg>{$row["TELEFONO"]}
                                                    </li>
                                                    <li class='contacts-block__item'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-power'><path d='M18.36 6.64a9 9 0 1 1-12.73 0'></path><line x1='12' y1='2' x2='12' y2='12'></line></svg> {$estado}
                                                    </li>
                                                </ul>
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

    public function eliminar_sucursal()
    {
        if (isset($_POST["id"])) {
            $eliminar = $this->model->eliminar_sucursal($_POST["id"]);
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
    public function cambiarsucursal()
    {
        session_name('B_POS');
        session_start();
        $_SESSION['sucursal'] = 0;
        $_SESSION['moneda'] = "S/ ";
        $_SESSION['caja'] = 0;

        $this->view->render('sucursal/sucursales');
    }
    public function obtenerIP()
    {
        $this->view->render('sucursal/obtenerIP');
    }
    public function generar_codigo_bitacora()
    {
        $numero = $this->model->lista_bitacora();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio('BITA', 6, $numero);
        } else {
            return 0;
        }
    }
    public function getBrowser($user_agent)
    {

        if (strpos($user_agent, 'MSIE') !== false) {
            return 'Internet explorer';
        } elseif (strpos($user_agent, 'Edge') !== false) //Microsoft Edge
        {
            return 'Microsoft Edge';
        } elseif (strpos($user_agent, 'Trident') !== false) //IE 11
        {
            return 'Internet explorer';
        } elseif (strpos($user_agent, 'Opera Mini') !== false) {
            return "Opera Mini";
        } elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== false) {
            return "Opera";
        } elseif (strpos($user_agent, 'Firefox') !== false) {
            return 'Mozilla Firefox';
        } elseif (strpos($user_agent, 'Chrome') !== false) {
            return 'Google Chrome';
        } elseif (strpos($user_agent, 'Safari') !== false) {
            return "Safari";
        } else {
            return 'Otros';
        }

    }
    public function get_cliente_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
    public function dosificar_sucursal(){
        if(isset($_POST['id_sucursal'])){
            $id_sucursal = $_POST['id_sucursal'];
            $llave = $_POST['llave'];
            $numero = $_POST['numero'];
            $date = $_POST['date'];
            $l1 = $_POST['l1'];
            $l2 = $_POST['l2'];
            $l3 = $_POST['l3'];
            $l4 = $_POST['l4'];
            $consultar = $this->model->consultar_dosificacion($id_sucursal);
            if($consultar){
                if($consultar->rowCount()>0){
                    $id_dosificacion = $consultar->fetchColumn(0);
                    $actualizar = $this->model->actualizar_dosificacion($id_dosificacion,$llave,$numero,$date,$l1,$l2,$l3,$l4,$id_sucursal);
                    
                    if($actualizar){
                        if($actualizar->rowCount()>0){
                            echo 1;
                        }else{
                            echo 2;
                        }
                    }
                }else{
                    $id_dosificacion = $this->generar_codigo_dosificacion();
                    $agregar = $this->model->agregar_dosificacion($id_dosificacion,$llave,$numero,$date,$l1,$l2,$l3,$l4,$id_sucursal);
                    if($agregar){
                        if($agregar->rowCount()>0){
                            echo 1;
                        }else{
                            echo 2;
                        }
                    }
                }
            }
            
        }
    }
    
    public function dosificacion_sucursal(){
        if(isset($_POST["id"])){
             $consultar = $this->model->consultar_dosificacion($_POST["id"]);
             if($consultar){
                $array=[];
                if ($consultar->RowCount() > 0 ) {
					foreach ($consultar as $rows) {
						$array = [
							"LLAVE" => $rows["LLAVE"],
							"ID_CAJA" => $rows["ID_CAJA"],
							"FECHA" => $rows["FECHA"],
							"NUMERO" => $rows["NUMERO"],
							"L1" => $rows["L1"],
							"L3" => $rows["L3"],
							"L2" => $rows["L2"],
							"L4" => $rows["L4"]
						];
					}
				    echo json_encode($array);
				}else{
				    $array = [
							"LLAVE" => '',
							"ID_CAJA" => '',
							"FECHA" => '',
							"NUMERO" => '',
							"L1" => '',
							"L3" => '',
							"L2" => '',
							"L4" => '',
						];
					echo json_encode($array);
				}
             }
        }
    }
}
