<?php
class caja extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

/* ========================================================================== */
/*                         Vista de asignacion de caja                        */
/* ========================================================================== */

    public function render()
    {
        session_name('B_POS');
        session_start();
        $this->view->lista_usuarios = $this->lista_usuarios($_SESSION["sucursal"]);
        $this->view->render('caja/asignaciondecajas');
    }

/* ========================================================================== */
/*                              Lista de usuarios                             */
/* ========================================================================== */

    public function lista_usuarios($sucursal)
    {
        $usuario = $this->model->lista_usuarios($sucursal);
        if ($usuario) {
            $option = "";
            foreach ($usuario as $rows) {
                $option .= "<option value='{$rows["ID_USUARIO"]}' >{$rows["NOMBRES"]} {$rows["APELLIDOS"]}</option>";
            }
            return $option;
        }
    }

/* ========================================================================== */
/*                        Generar coodigo de asignacion                       */
/* ========================================================================== */

    public function generar_codigo_asignacion()
    {
        $caja = $this->model->lista_de_cajas();
        if ($caja) {
            $caja = $caja->rowCount();
            return $caja+1;
            // return mainModel::generar_codigo_aleatorio('CAJA', 9, $caja);
        }
    }

/* ========================================================================== */
/*                         Funcion guardar asignacion                         */
/* ========================================================================== */

    public function guardar_asignacion()
    {
        if (isset($_POST["persona"]) && isset($_POST["numero_caja"]) && isset($_POST["nombre_caja"])) {
            session_name('B_POS');
            session_start();
            $id_sucursal = $_SESSION["sucursal"];
            $usuario = $_POST["persona"];
            $numero_caja = $_POST["numero_caja"];
            $nombre_caja = $_POST["nombre_caja"];
            $codigo_asignacion = $this->generar_codigo_asignacion();
            $guardar_caja = $this->model->guardar_caja($codigo_asignacion, $usuario, $numero_caja, $nombre_caja, $id_sucursal);
            if ($guardar_caja) {
                if ($guardar_caja->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        }
    }

/* ========================================================================== */
/*                  Lista de cajas disponibles en la sucursal                 */
/* ========================================================================== */

    public function lista_cajas()
    {
        if (isset($_POST["token"])) {
            session_name('B_POS');
            session_start();
            $id_sucursal = $_SESSION["sucursal"];

            $caja = $this->model->lista_de_cajas();
            
            if ($caja) {
                $table = "";
                foreach ($caja as $row) {
                    if ($row["ID_SUCURSAL"] == $id_sucursal) {
                        $imagen = SERVERURL . "archives/avatars/{$row["PERFIL"]}";
                        $table .= "<tr>
                                <td>{$row["NRO_CAJA"]}</td>
                                <td>{$row["NOMBRE_CAJA"]}</td>
                                <td class=''>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 50px; border-radius : 10px;'>
                                    </a>
                                </td>
                                <td>{$row["NOMBRES"]} {$row["APELLIDOS"]}</td>
                                <td class='text-center'>
                                    <button class='btn btn-danger mb-2 btn_eliminar_caja' id_caja='{$row["ID_CAJA"]}' nombre_caja='{$row["NOMBRE_CAJA"]}' >
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 icon'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>";
                    
                }
                
            }
            echo $table;
        }
        }
    }
    
    public function eliminar_caja(){
        if(isset($_POST["id_caja"])){
            $eliminar = $this->model->eliminar_caja($_POST["id_caja"]);
            if($eliminar){
                if($eliminar->rowCount()>0){
                  echo 1;  
                }
            }
        }
    }

/* ========================================================================== */
/*                          Vista de arqueos por caja                         */
/* ========================================================================== */

    public function arqueosporcaja()
    {
        $this->view->render('caja/arqueosporcaja');
    }

/* ========================================================================== */
/*                   Lista de cajas asignada en la sucursal                   */
/* ========================================================================== */

    public function lista_de_cajas_asignadas()
    {
        if (isset($_POST["token"])) {
            session_name('B_POS');
            session_start();
            $sucursal = $_SESSION["sucursal"];
            $usuario = $_SESSION["usuario"];
            $cajas_asignadas = $this->model->lista_cajas_asignadas($usuario, $sucursal);
            if ($cajas_asignadas) {
                $option = "";
                if ($cajas_asignadas->rowCount() > 0) {
                    foreach ($cajas_asignadas as $row) {
                        $option .= "<option value='{$row["ID_CAJA"]}'>{$row["NRO_CAJA"]} | {$row["NOMBRE_CAJA"]}</option>";
                    }
                }
                echo $option;
            } else {
                echo 0;
            }
        }
    }

/* ========================================================================== */
/*                          Generar codigo de arqueo                          */
/* ========================================================================== */

    public function generar_codigo_arqueo()
    {
        $numero = $this->model->lista_de_arqueos();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio("AREQUEO", 4, $numero);
        } else {
            return 0;
        }
    }

/* ========================================================================== */
/*                          Generar codigo movimiento                         */
/* ========================================================================== */

    public function generar_codigo_movimiento()
    {
        $numero = $this->model->lista_de_movimientos();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio("MOVI", 4, $numero);
        } else {
            return 0;
        }
    }
    /* ========================================================================== */
    /*                             Funcion abrir caja                             */
    /* ========================================================================== */
    public function abrir_caja()
    {
        if (isset($_POST["caja"])) {
            date_default_timezone_set(ZONEDATE);
            $codigo_arqueo = $this->generar_codigo_arqueo();
            $caja = $_POST["caja"];
            $date_registro = date('Y-m-d H:i:s');
            $monto_caja = floatval($_POST["monto_caja"]);
            $agregar_arqueo = $this->model->agregar_arqueo($codigo_arqueo, $caja, $monto_caja, 0, 0, 0, 0, 0, 0, '', $date_registro, null, 1);
            if ($agregar_arqueo) {
                session_name("B_POS");
                session_start();
                if ($agregar_arqueo->rowCount() > 0) {
                    $_SESSION["caja"] = $codigo_arqueo;
                    if ($_SESSION["caja"] != "0") {
                        echo 1;
                    } else {
                        echo 2;
                    }
                }
            } else {
                echo 0;
            }
        }
    }

/* ========================================================================== */
/*                              Lista de arqueos                              */
/* ========================================================================== */

    public function lista_arqueos_caja()
    {
        if (isset($_POST["token"])) {
            session_name("B_POS");
            session_start();
            $arqueos = $this->model->lista_de_arqueos();
            if ($arqueos) {
                $table = "";
                if ($arqueos->rowCount() > 0) {
                    $n = 1;
                    foreach ($arqueos as $row) {
                        if ($_SESSION["usuario"] == $row["ID_USUARIO"] && $_SESSION["sucursal"] == $row["ID_SUCURSAL"]) {
                            $ingreso = $row["INGRESOS"] + $row["MONTOINICIAL"];
                            $fecha_cierre = $row["FECHACIERRE"];
                            if ($fecha_cierre == "0000-00-00 00:00:00") {
                                $fecha_cierre = "Caja Activa";
                            }
                            $enlace = SERVERURL . 'caja/ticket/' . mainModel::encryption($row["ID_ARQUEO"]);
                            $table .= "
                                    <tr>
                                        <td style='font-weight:900;color:#1b55e1;'>{$row["FECHAAPERTURA"]}</td>
                                        <td>{$row["NRO_CAJA"]} : {$row["NOMBRE_CAJA"]}</td>
                                        <td>{$row["VENDEDOR"]}</td>
                                        <td style='font-weight:900;color:#FF9800;'>{$ingreso}</td>
                                        <td style='font-weight:900;color:#8BC34A;'>{$row["INGRESOS"]}</td>
                                        <td style='font-weight:900;color:#F44336;'>{$row["EGRESOS"]}</td>
                                        <td>{$row["CREDITOS"]}</td>
                                        <td>{$row["ABONOS"]}</td>
                                        <td style='font-weight:900;color:#2196F3;'>{$row["DINEROEFECTIVO"]}</td>
                                        <td style='font-weight:900;color:#1b55e2;'>{$fecha_cierre}</td>
                                        <td class='text-center'>
                                            <a href='{$enlace}' target='_blank' class='btn btn-primary mb-2 mr-2'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg></a>
                                        </td>
                                    </tr>";
                            $n++;
                        }
                    }
                }
                echo $table;
            } else {
                echo 0;
            }
        }
    }
    public function lista_arqueos_caja_fecha()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $date_1 = date($_POST["fecha_1"]);
            $date_2 = date($_POST["fecha_2"]);
            session_name("B_POS");
            session_start();
            $arqueos = $this->model->lista_de_arqueos();
            if ($arqueos) {
                $table = "";
                if ($arqueos->rowCount() > 0) {
                    $n = 1;
                    foreach ($arqueos as $row) {
                        if ($_SESSION["usuario"] == $row["ID_USUARIO"] && $_SESSION["sucursal"] == $row["ID_SUCURSAL"]) {
                            $fecha = date("Y-m-d", strtotime($row["FECHAAPERTURA"]));
                            if ($fecha >= $date_1 && $fecha <= $date_2) {
                                $ingreso = $row["INGRESOS"] + $row["MONTOINICIAL"];
                                $fecha_cierre = $row["FECHACIERRE"];
                                if ($fecha_cierre == "0000-00-00 00:00:00") {
                                    $fecha_cierre = "Caja Activa";
                                }
                                $enlace = SERVERURL . 'caja/ticket/' . mainModel::encryption($row["ID_ARQUEO"]);
                                $table .= "
                                        <tr>
                                            <td style='font-weight:900;color:#1b55e1;'>{$row["FECHAAPERTURA"]}</td>
                                            <td>{$row["NRO_CAJA"]} : {$row["NOMBRE_CAJA"]}</td>
                                            <td>{$row["VENDEDOR"]}</td>
                                            <td style='font-weight:900;color:#FF9800;'>{$ingreso}</td>
                                            <td style='font-weight:900;color:#2196F3;'>{$row["INGRESOS"]}</td>
                                            <td style='font-weight:900;color:#F44336;'>{$row["EGRESOS"]}</td>
                                            <td>{$row["CREDITOS"]}</td>
                                            <td>{$row["ABONOS"]}</td>
                                            <td style='font-weight:900;color:#8BC34A;'>{$row["DINEROEFECTIVO"]}</td>
                                            <td style='font-weight:900;color:#1b55e2;'>{$fecha_cierre}</td>
                                            <td class='text-center'>
                                                <a href='{$enlace}' target='_blank' class='btn btn-primary mb-2 mr-2'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg></a>
                                            </td>
                                        </tr>";
                                $n++;
                            }
                        }
                    }
                }
                echo $table;
            } else {
                echo 0;
            }
        }
    }

/* ========================================================================== */
/*                         Vista movimientos por caja                         */
/* ========================================================================== */
    public function movimientosporcaja()
    {
        $this->view->lista_metodo = $this->lista_metodopago();
        $this->view->render('caja/movimientosporcaja');
    }

/* ========================================================================== */
/*                     Funcion guardar movimiento de caja                     */
/* ========================================================================== */

    public function guardar_movimiento()
    {
        if (isset($_POST["monto"])) {
            session_name("B_POS");
            session_start();
            date_default_timezone_set(ZONEDATE);
            $date_registro = date('Y-m-d H:i:s');
            $codigo = $this->generar_codigo_movimiento();
            $caja = $_SESSION["caja"];
            $monto = floatval($_POST["monto"]);
            $descripcion = $_POST["descripcion"];
            $movimiento = $_POST["movimiento"];
            $arqueo = mainModel::parametros_arqueo($caja);
            $montoinicial = $arqueo["MONTOINICIAL"];
            $ingresos = $arqueo["INGRESOS"];
            $egresos = $arqueo["EGRESOS"];
            $total_caja = floatval(($montoinicial + $ingresos)-$egresos);
            if($monto>$total_caja && $movimiento == "EGRESO"){
                echo 6;
            }else{
                $medio = $_POST["medio"];
                $guardar_movimiento = $this->model->agregar_movimiento($codigo, $caja, $movimiento, $descripcion, $monto, $medio, $date_registro);
                if ($guardar_movimiento) {
                    $url_movimiento = SERVERURL . "caja/movimiento/" . $codigo;
                    echo "1|$url_movimiento";
                } else {
                    echo 0;
                }
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
    public function guardar_movimiento_venta()
    {
        if (isset($_POST["monto"])) {
            session_name("B_POS");
            session_start();
            date_default_timezone_set(ZONEDATE);
            $date_registro = date('Y-m-d H:i:s');
            $codigo = $this->generar_codigo_movimiento();
            $caja = $_SESSION["caja"];
            $monto_recibido = floatval($_POST["monto"]);
            $monto = floatval($_POST["MONTO_PAGO"]);
            $monto_cambio = floatval($_POST["MONTO_CAMBIO"]);
            $arqueo = mainModel::parametros_arqueo($caja);
            $descripcion = "PAGO DE VENTA";
            $id_venta = $_POST["VENTA_ID"];
            $ingresos = $arqueo["INGRESOS"];
            $movimiento = "INGRESO";
            $arqueo = mainModel::parametros_arqueo($caja);
            $montoinicial = $arqueo["MONTOINICIAL"];
            $egresos = $arqueo["EGRESOS"];
            $total_caja = floatval(($montoinicial + $ingresos)-$egresos);
            if($monto>$total_caja && $movimiento == "EGRESO"){
                echo 6;
            }else{
                $medio = $_POST["medio"];
                $guardar_movimiento = $this->model->agregar_movimiento($codigo, $caja, $movimiento, $descripcion, $monto, $medio, $date_registro);
                if ($guardar_movimiento) {
                    $actualizar_venta = $this->model->venta_pago_pendiente_actualizar($id_venta, $monto, $monto_recibido,$monto_cambio,$medio);
                    if ($actualizar_venta) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            }
        }
    }
    public function lista_movimientos_de_caja()
    {
        if (isset($_POST["token"])) {
            session_name("B_POS");
            session_start();
            $movimientos = $this->model->lista_de_movimientos();
            if ($movimientos) {
                $table = "";
                if ($movimientos->rowCount() > 0) {
                    $n = 1;
                    foreach ($movimientos as $row) {
                        if ($_SESSION["caja"] == $row["ID_ARQUEO"]) {
                            $badge_movimiento = $row["TIPOMOVIMIENTO"];
                            if ($badge_movimiento == "EGRESO") {
                                $badge_movimiento = "<span class='badge badge-danger'>{$row["TIPOMOVIMIENTO"]}</span>";
                            } else if ($badge_movimiento == "INGRESO") {
                                $badge_movimiento = "<span class='badge badge-success'>{$row["TIPOMOVIMIENTO"]}</span>";
                            } else if ($badge_movimiento == "CREDITO") {
                                $badge_movimiento = "<span class='badge badge-warning'>{$row["TIPOMOVIMIENTO"]}</span>";
                            } else {
                                $badge_movimiento = "<span class='badge badge-dark'>{$row["TIPOMOVIMIENTO"]}</span>";
                            }
                            $url_movimiento = SERVERURL . "caja/movimiento/" . $row["ID_MOVIMIENTO"];
                            $table .= "
                                        <tr>
                                            <td style='font-weight: bold;color: #1b55e1;'>{$row["FECHAMOVIMIENTO"]}</td>
                                            <td>{$row["NRO_CAJA"]} : {$row["NOMBRE_CAJA"]}</td>
                                            <td>{$row["VENDEDOR"]}</td>
                                            <td>{$row["DESCRIPCIONMOVIMIENTO"]}</td>
                                            <td>{$badge_movimiento}</td>
                                            <td>{$row["MONTOMOVIMIENTO"]}</td>
                                            <td class='text-center'>
                                                <ul class='table-controls'>
                                                    <li>
                                                        <a href='javascript:void(0);' class='bs-tooltip btn_ver' movimiento_id='{$row['ID_MOVIMIENTO']}'   data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-eye p-1 br-6 mb-1'><path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'></path><circle cx='12' cy='12' r='3'></circle></svg>                                            </a>
                                                    </li>
                                                    <li>
                                                        <a href='$url_movimiento' class='bs-tooltip ' movimiento_id='{$row['ID_MOVIMIENTO']}'   data-toggle='tooltip' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file'><path d='M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z'></path><polyline points='13 2 13 9 20 9'></polyline></svg>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>";
                            $n++;
                        }
                    }
                }
                echo $table;
            } else {
                echo 0;
            }
        }
    }

    public function form_vermovimiento()
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $consultar_movimiento = $this->model->consulta_movimiento($id);
            if ($consultar_movimiento) {
                $formulario = "";
                if ($consultar_movimiento->rowCount() > 0) {
                    foreach ($consultar_movimiento as $row) {
                        $medio_pago = $this->retornar_metodo_pago($row["CODMEDIOPAGO"]);
                        $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='movimiento'>Tipo Movimiento (*) </label>
                                    <input type='text' value='{$row["TIPOMOVIMIENTO"]}' class='form-control' disabled>
                                </div>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='monto'>Monto Movimiento (*) </label>
                                    <input type='text' class='form-control' value='{$row["MONTOMOVIMIENTO"]}' id='monto' name='monto' placeholder='Ingrese el monto' disabled >
                                </div>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='descripcion'>Descripcion (*)</label>
                                    <input type='text' class='form-control' value='{$row["DESCRIPCIONMOVIMIENTO"]}' id='descripcion' name='descripcion' placeholder='Ingrese la Descripción' disabled>
                                </div>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='medio'>Medio de Pago (*)</label>
                                    <input type='text' value='{$medio_pago}' class='form-control' disabled>

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
    public function retornar_metodo_pago($param)
    {
        $busqueda = $this->model->consulta_metodopago($param);
        $buscar = $busqueda->fetch(PDO::FETCH_ASSOC);
        return $buscar["NAME"];
    }
    public function arqueosporfecha()
    {
        $this->view->render("caja/arqueosxfecha");
    }
    public function arqueos_por_fecha()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $date_1 = date($_POST["fecha_1"]);
            $date_2 = date($_POST["fecha_2"]);
            $lista = $this->model->lista_de_arqueos_sucursal($_POST["sucursal"]);
            if ($lista) {
                $table = "";
                foreach ($lista as $l) {
                    $fecha_aper = date("Y-m-d", strtotime($l["FECHAAPERTURA"]));
                    $fecha_cierre = $l["FECHACIERRE"];
                    if ($fecha_cierre == "0000-00-00 00:00:00") {
                        $fecha_cierre = "CAJA ACTIVA";
                    }
                    $comentarios = $l["COMENTARIOS"];
                    if (empty($comentarios)) {
                        $comentarios = "SIN COMENTARIOS";
                    }
                    if ($fecha_aper >= $date_1 && $fecha_aper <= $date_2) {
                        $table .= "
                                <tr>
                                    <td>{$l["FECHAAPERTURA"]}</td>
                                    <td>{$l["NRO_CAJA"]} : {$l["NOMBRE_CAJA"]}</td>
                                    <td>{$l["VENDEDOR"]}</td>
                                    <td>{$fecha_cierre}</td>
                                    <td>{$l["MONTOINICIAL"]}</td>
                                    <td>{$l["INGRESOS"]}</td>
                                    <td>{$l["EGRESOS"]}</td>
                                    <td>{$l["CREDITOS"]}</td>
                                    <td>{$l["ABONOS"]}</td>
                                    <td>{$l["DINEROEFECTIVO"]}</td>
                                    <td>{$l["DIFERENCIA"]}</td>
                                    <td>{$comentarios}</td>
                                </tr>
                            ";
                    }
                }
                echo $table;
            }
        }
    }
    public function movimientosporfecha()
    {
        $this->view->render("caja/movimientosporfecha");
    }
    public function movimientos_por_fecha()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $date_1 = date($_POST["fecha_1"]);
            $date_2 = date($_POST["fecha_2"]);
            $lista = $this->model->lista_de_movimiento_sucursal($_POST["sucursal"]);
            if ($lista) {
                $table = "";
                foreach ($lista as $l) {
                    $fecha_aper = date("Y-m-d", strtotime($l["FECHAMOVIMIENTO"]));
                    $medio = $this->retornar_metodo_pago($l["CODMEDIOPAGO"]);
                    if ($fecha_aper >= $date_1 && $fecha_aper <= $date_2) {
                        $table .= "
                                <tr>
                                    <td>{$l["FECHAMOVIMIENTO"]}</td>
                                    <td>{$l["NRO_CAJA"]} : {$l["NOMBRE_CAJA"]}</td>
                                    <td>{$l["VENDEDOR"]}</td>
                                    <td>{$l["TIPOMOVIMIENTO"]}</td>
                                    <td>{$l["MONTOMOVIMIENTO"]}</td>
                                    <td>{$l["DESCRIPCIONMOVIMIENTO"]}</td>
                                    <td>{$medio}</td>

                                </tr>
                            ";
                    }
                }
                echo $table;
            }
        }
    }
    public function caja_movimientos_por_fecha()
    {
        if (isset($_POST["caja"]) && isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $date_1 = date($_POST["fecha_1"]);
            $date_2 = date($_POST["fecha_2"]);
            session_name("B_POS");
            session_start();
            $movimientos = $this->model->lista_de_movimientos();
            if ($movimientos) {
                $table = "";
                if ($movimientos->rowCount() > 0) {
                    $n = 1;
                    foreach ($movimientos as $row) {
                        if ($_SESSION["caja"] == $row["ID_ARQUEO"]) {
                            $fecha = date("Y-m-d", strtotime($row["FECHAMOVIMIENTO"]));
                            if ($fecha >= $date_1 && $fecha <= $date_2) {
                                $badge_movimiento = $row["TIPOMOVIMIENTO"];
                                if ($badge_movimiento == "EGRESO") {
                                    $badge_movimiento = "<span class='badge badge-danger'>{$row["TIPOMOVIMIENTO"]}</span>";
                                } else if ($badge_movimiento == "INGRESO") {
                                    $badge_movimiento = "<span class='badge badge-success'>{$row["TIPOMOVIMIENTO"]}</span>";
                                } else if ($badge_movimiento == "CREDITO") {
                                    $badge_movimiento = "<span class='badge badge-warning'>{$row["TIPOMOVIMIENTO"]}</span>";
                                } else {
                                    $badge_movimiento = "<span class='badge badge-dark'>{$row["TIPOMOVIMIENTO"]}</span>";
                                }
                                $url_movimiento = SERVERURL . "caja/movimiento/" . $row["ID_MOVIMIENTO"];
                                $table .= "
                                        <tr>
                                            <td style='font-weight: bold;color: #1b55e1;'>{$row["FECHAMOVIMIENTO"]}</td>
                                            <td>{$row["NRO_CAJA"]} : {$row["NOMBRE_CAJA"]}</td>
                                            <td>{$row["VENDEDOR"]}</td>
                                            <td>{$row["DESCRIPCIONMOVIMIENTO"]}</td>
                                            <td>{$badge_movimiento}</td>
                                            <td>{$row["MONTOMOVIMIENTO"]}</td>
                                            <td class='text-center'>
                                                <ul class='table-controls'>
                                                    <li>
                                                        <a href='javascript:void(0);' class='bs-tooltip btn_ver' movimiento_id='{$row['ID_MOVIMIENTO']}'   data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-eye p-1 br-6 mb-1'><path d='M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'></path><circle cx='12' cy='12' r='3'></circle></svg>                                            </a>
                                                    </li>
                                                    <li>
                                                        <a href='$url_movimiento' class='bs-tooltip ' movimiento_id='{$row['ID_MOVIMIENTO']}'   data-toggle='tooltip' target='_blank'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file'><path d='M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z'></path><polyline points='13 2 13 9 20 9'></polyline></svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>";
                                $n++;
                            }
                        }
                    }
                }
                echo $table;
            } else {
                echo 0;
            }
        }
    }
    public function formulario_cerrar_arqueo(){
        if(isset($_POST["caja"])){
            $detalle = $this->model->detalle_de_arqueos($_POST["caja"]);
            if($detalle){
                $form = "";
                if($detalle->rowCount()>0){
                    foreach($detalle as $d){
                        $estimado = floatval(((($d["MONTOINICIAL"]+$d["INGRESOS"])-$d["EGRESOS"])+$d["ABONOS"]-$d["CREDITOS"]));
                        $form .= "<div class='modal-body'>
                        <div class='row'>
                            <div class='col-sm-6'>
                                <div class='row'>
                                    <div class='form-group mb-4 col-sm-4'>
                                        <label for='monto_caja_cierre'>Inicial </label>
                                        <input type='text' class='form-control' disabled id='monto_caja_cierre' name='monto_caja_cierre' value='{$d["MONTOINICIAL"]}' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-4'>
                                        <label for='ingreso_caja_cierre'> Ingresos </label>
                                        <input type='text' class='form-control' disabled id='ingreso_caja_cierre' name='ingreso_caja_cierre'  value='{$d["INGRESOS"]}' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-4'>
                                        <label for='egreso_caja_cierre'> Egreso </label>
                                        <input type='text' class='form-control' disabled id='egreso_caja_cierre' name='egreso_caja_cierre' value='{$d["EGRESOS"]}' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-4'>
                                        <label for='creditos'> Créditos </label>
                                        <input type='text' class='form-control' disabled id='creditos' name='creditos'  value='{$d["CREDITOS"]}' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-8'>
                                        <label for='abonos'> Abonos de Créditos </label>
                                        <input type='text' class='form-control' disabled id='abonos' name='abonos'  value='{$d["ABONOS"]}' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='estimado'> Estimado en Caja </label>
                                        <input type='text' class='form-control' disabled id='estimado' name='estimado' value='{$estimado}' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='efectivo'> Efectivo Disponible </label>
                                        <input type='text' class='form-control'  id='efectivo' name='efectivo' placeholder='100.00'>
                                    </div>                          
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <div class='row'>
                                    <div class='form-group mb-4 col-sm-4'>
                                        <label for='diferencia'> Diferencia </label>
                                        <input type='text' class='form-control' id='diferencia' name='diferencia' placeholder='100.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-8'>
                                        <label for='nombre_caja'> Nombre de Caja  </label>
                                        <input type='text' class='form-control' disabled id='nombre_caja' name='nombre_caja' value='{$d["NRO_CAJA"]} : {$d["NOMBRE_CAJA"]}' placeholder='Ingrese Monto inicial'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-12'>
                                        <label for='egreso_caja_cierre'> Observacion  </label>
                                        <textarea name= 'observacion' class='form-control' id='observacion' cols='10' rows='5'></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class='modal-footer md-button'>
                        <button class='btn btn-danger' data-dismiss='modal'><i class='flaticon-cancel-12'></i> Cancelar</button>
                        <button type='submit' class='btn btn-success'>Guardar</button>
                    </div>";
                    }
                }
                echo $form;
            }
        }
    }
    public function cerrarcajaarqueo(){
        if(isset($_POST["caja"])){
            date_default_timezone_set(ZONEDATE);
            $date =date('Y-m-d H:i:s');
            $cierre = $this->model->cerrar_cajar($_POST["caja"],floatval($_POST["efectivo"]),floatval($_POST["diferencia"]),$_POST["observacion"],$date);
            if($cierre){
                if($cierre->rowCount()>0){
                    session_name("B_POS");
                    session_start();
                    $_SESSION["caja"] = 0;
                    echo 1;
                }
            }
        }   
    }
    function ticket($param = null){
        $id = $param[0];
        if(is_string(mainModel::decryption($id))){
            $id = mainModel::decryption($id);
            session_name("B_POS");
            session_start();
            date_default_timezone_set(ZONEDATE);
            $buscar_venta  = $this->model->lista_de_arqueos_1($id);
            $response  = "";
            if($buscar_venta){
                if($buscar_venta->rowCount()>0){
                    foreach($buscar_venta as $row){
                        $response .= "{$row["FECHAAPERTURA"]}|{$row["FECHACIERRE"]}|{$row["NRO_CAJA"]}|{$row["NOMBRE_CAJA"]}|{$row["MONTOINICIAL"]}|{$row["ID_SUCURSAL"]}|{$row["INGRESOS"]}|{$row["EGRESOS"]}|{$row["CREDITOS"]}|{$row["ABONOS"]}|{$row["DINEROEFECTIVO"]}|{$row["DIFERENCIA"]}|{$row["COMENTARIOS"]}|{$row["VENDEDOR"]}|{$row["NRO_CAJA"]}|{$row["NOMBRE_CAJA"]}"; 
                    }
                }
            }else{  
                echo 0;
            }
            $res_array = explode("|",$response);
            $this->view->parametros_venta = $response;
            $this->view->id_venta = $id;
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($res_array[5]);
            $this->view->render("caja/ticket");
        }else{
            $this->view->render("error/404");
        }
    }
    function movimiento($param = null){
        $id = $param[0];
        if(is_string($id)){
          
            $mov = $this->model->consulta_movimiento($id);
            //ejecutar
            
            $mov = $mov->fetch(PDO::FETCH_ASSOC);
            $mov = (object)$mov;
            $this->view->parametros = $mov;
            $this->view->tipomovimiento = $this->retornar_metodo_pago($mov->CODMEDIOPAGO);
            // print_r($mov);
            // session_name("B_POS");
            // session_start();
            // date_default_timezone_set(ZONEDATE);
            // $buscar_venta  = $this->model->lista_de_arqueos_1($id);
            // $response  = "";
            // if($buscar_venta){
            //     if($buscar_venta->rowCount()>0){
            //         foreach($buscar_venta as $row){
            //             $response .= "{$row["FECHAAPERTURA"]}|{$row["FECHACIERRE"]}|{$row["NRO_CAJA"]}|{$row["NOMBRE_CAJA"]}|{$row["MONTOINICIAL"]}|{$row["ID_SUCURSAL"]}|{$row["INGRESOS"]}|{$row["EGRESOS"]}|{$row["CREDITOS"]}|{$row["ABONOS"]}|{$row["DINEROEFECTIVO"]}|{$row["DIFERENCIA"]}|{$row["COMENTARIOS"]}|{$row["VENDEDOR"]}|{$row["NRO_CAJA"]}|{$row["NOMBRE_CAJA"]}"; 
            //         }
            //     }
            // }else{  
            //     echo 0;
            // }
            // $res_array = explode("|",$response);
            // $this->view->parametros_venta = $response;
            // $this->view->id_venta = $id;
            $this->view->parametros_sucursal = mainModel::parametros_sucursal($mov->ID_SUCURSAL);
            $this->view->render("caja/movimiento");
        }else{
            $this->view->render("error/404");
        }
    }
}
