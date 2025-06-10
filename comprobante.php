<?php
    class comprobante extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                           Vista de comprobantes                            */
/* ========================================================================== */

        function render(){
            $this->view->render('comprobante/index');
        }
 function lista_comprobantes_json(){
            if(isset($_POST["token"])){
                $lista = $this->model->lista_comprobantes();
                if($lista){
                    echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                            Lista de comprobantes                           */
/* ========================================================================== */
function lista_tirajes_json(){
    if(isset($_POST["token"])){
      
        $tiraje = $this->model->lista_tirajes();
        if($tiraje){
            echo json_encode($tiraje->fetchAll(PDO::FETCH_ASSOC));
        }else{
            echo 0;
        }
    }
}
/* ========================================================================== */
/*                            Lista de comprobantes                           */
/* ========================================================================== */

        function lista_comprobantes(){
            if(isset($_POST["token"])){
                $unidades = $this->model->lista_comprobantes();
                if($unidades){
                    $n = 1;
                    $tabla = "";
                    foreach($unidades as $rows){
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $estado = "<span class='shadow-none badge badge-success'>Vigente</span>";
                        }else{
                            $estado = "<span class='shadow-none badge badge-dark'>Descontinuada</span>";
                        }
                        $tabla .="
                            <tr>
                                <td class='checkbox-column'> {$n}</td>
                                <td>{$n}</td>
                                <td>{$rows["COMPROBANTE"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_COMPROBANTE']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'>
                                            <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                        </svg>
                                    </button>
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

/* ========================================================================== */
/*                         Generar codigo comprobante                         */
/* ========================================================================== */

        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->lista_comprobantes();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('COMPRO',6,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                         funcion agregar comprobante                        */
/* ========================================================================== */
        
        function agregar_comprobante(){
            if(isset($_POST["nombre"])){
                $comprobante = strtoupper($_POST["nombre"]);
                $estado = strtoupper($_POST["estado"]);
                $codigo = $this->generar_codigo();
                $comprobante = $this->model->agregar_comprobante($codigo,$comprobante,$estado);
                if($comprobante){
                    if($comprobante->rowCount()>0){
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
/*                       Vista de tiraje de comprobantes                      */
/* ========================================================================== */
        function tiraje(){
            $this->view->lista_comprobantes = $this->lista_comprobantes_select();
            $this->view->render('comprobante/tiraje');
        }

/* ========================================================================== */
/*                     Lista de comprobantes en un select                     */
/* ========================================================================== */
        function lista_comprobantes_select(){
            $comprobantes = $this->model->lista_comprobantes();
            if($comprobantes){
                $option = "";
                foreach($comprobantes as $rows){
                    if($rows["ESTADO"]==0){
                        $option .="
                            <option value='{$rows["ID_COMPROBANTE"]}' disabled>{$rows["COMPROBANTE"]}</option>
                        ";
                    }else{
                        $option .="
                            <option value='{$rows["ID_COMPROBANTE"]}'>{$rows["COMPROBANTE"]}</option>
                        ";
                    }
                }
                return $option;
            }
        }

/* ========================================================================== */
/*                        Guardar tiraje por comprobante                      */
/* ========================================================================== */
        function guardar_tiraje(){
            if(isset($_POST["comprobante"]) && isset($_POST["date_1"])){
                session_name('B_POS');
                session_start();
                $codigo = $this->generar_codigo_tiraje();
                $sucursal = $_SESSION["sucursal"];
                $date_1 = $_POST["date_1"];
                $comprobante = $_POST["comprobante"];
                $n_resolucion_factura = $_POST["n_resolucion_factura"];
                $n_resolucion = $_POST["n_resolucion"];
                $serie = $_POST["serie"];
                $correlativo_del = $_POST["correlativo_del"];
                $correlativo_al = $_POST["correlativo_al"];
                $disponibles = $correlativo_al-$correlativo_del+1;
                $guardar_tiraje = $this->model->guardar_tiraje($codigo,$date_1,$n_resolucion,$n_resolucion_factura,$serie,$correlativo_del,$correlativo_al,$comprobante,$sucursal,$disponibles);
                if($guardar_tiraje){
                    if($guardar_tiraje->rowCount()>0){
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
/*                          Generar codigo de tiraje                          */
/* ========================================================================== */
        function generar_codigo_tiraje(){
            $numero = $this->model->lista_tirajes();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return "TIRA".str_pad("{$numero}",10,"0",STR_PAD_LEFT);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                              Lista de tirajes                              */
/* ========================================================================== */
        function lista_tirajes(){
            if(isset($_POST["token"])){
                $sucursal = $_POST["token"];
                $tiraje = $this->model->lista_tirajes();
                if($tiraje){
                    $n = 1;
                    $tabla = "";
                    foreach($tiraje as $rows){
                        $utilizados =  $rows["HASTA"]-$rows['DISPONIBLES'];
                        if($sucursal == $rows["ID_SUCURSAL"]){
                            $estado = $rows['ESTADO'];
                            if($estado == 1){
                                $estado = "<span style='cursor:pointer' estado='0' id_tiraje='{$rows['ID_TIRAJE']}' class='btn_estado_update shadow-none badge badge-success'>Vigente</span>";
                            }else{
                                $estado = "<span style='cursor:pointer' estado='1' id_tiraje='{$rows['ID_TIRAJE']}' class='btn_estado_update shadow-none badge badge-dark'>Descontinuada</span>";
                            }
                            $tabla .="
                                <tr>
                                    <td class='checkbox-column'> $n </td>
                                    <td>{$n}</td>
                                    <td>{$rows['FECHA_RESOLUCION']}</td>
                                    <td>{$rows['COMPROBANTE']}</td>
                                    <td>{$rows['SERIE']}</td>
                                    <td>{$rows['DISPONIBLES']}</td>
                                    <td>{$utilizados}</td>
                                    <td>{$estado}</td>
                                    <td class='text-center'>
                                    <ul class='table-controls'>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_actualizar' tiraje_id='{$rows['ID_TIRAJE']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_eliminar' tiraje_id='{$rows['ID_TIRAJE']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash p-1 br-6 mb-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg>
                                            </a>
                                        </li>
                                    </ul>
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
     
/* -------------------------------------------------------------------------- */
/*                         Formulario de Comprobante                         */
/* -------------------------------------------------------------------------- */

function form_comprobante(){
    if(isset($_POST["id"])){    
        $id = $_POST["id"];
        $consultar_comprobante = $this->model->consulta_comprobante($id);
        if($consultar_comprobante){
            $formulario = "";
            if($consultar_comprobante->rowCount()>0){
                foreach($consultar_comprobante as $row){
                    $estado = "";
                    if($row["ESTADO"] == 1){
                        $estado .= "checked";
                    }
                    $formulario .= "
                    <div class='modal-body'>
                        <div class='row'>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='new-unidad_name'>Comprobante</label>
                                <input type='text' class='form-control' name='nombre_comprobante' id='nombre_comprobante' value='{$row["COMPROBANTE"]}' placeholder='EJ. TICKET' required>
                                <input type='hidden' class='form-control' name='id_comprobante' id='id_comprobante' value='{$row["ID_COMPROBANTE"]}' placeholder='EJ. TICKET' required>
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
    }
}

/* -------------------------------------------------------------------------- */
/*                           Actualizar comprobante                          */
/* -------------------------------------------------------------------------- */

    function actualizar_comprobante(){
        if(isset($_POST["id_comprobante"])){
            $id = $_POST["id_comprobante"];
            $nombre = $_POST["nombre_comprobante"];
            $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1? 1:0;
            $actualizar_comprobante = $this->model->actualizar_comprobante($id,$nombre,$estado);
            if($actualizar_comprobante){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    function actualizar_estado_tiraje(){
        if(isset($_POST["id"])){
            $id = $_POST["id"];
            $estado = $_POST["estado"];
            $actualizar_comprobante = $this->model->actualizar_estado_tiraje($id,$estado);
            if($actualizar_comprobante){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                            Formulario de tiraje                            */
/* -------------------------------------------------------------------------- */

        function form_tiraje(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_tiraje = $this->model->consulta_tiraje($id);
                if($consultar_tiraje){
                    $formulario = "";
                    if($consultar_tiraje->rowCount()>0){
                        foreach($consultar_tiraje as $row){
                            $lista_comprobante = "";
                            $comprobante = $this->model->lista_comprobantes();
                            foreach($comprobante as $doc){
                                if($doc["ID_COMPROBANTE"] === $row["ID_COMPROBANTE"]){
                                    $lista_comprobante .= "
                                        <option value='{$doc['ID_COMPROBANTE']}' selected='true'>{$doc['COMPROBANTE']}</option>
                                    ";
                                }else{
                                    $lista_comprobante .= "
                                        <option value='{$doc['ID_COMPROBANTE']}'>{$doc['COMPROBANTE']}</option>
                                    ";
                                }
                            }
                            
                            $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-7'>
                                    <label for='comprobante'>Comprobante</label>
                                    <select name='comprobante' id='comprobante' class='form-control' disabled>
                                    {$lista_comprobante}
                                    </select>
                                </div>
                                <div class='form-group mb-4 col-sm-5'>
                                    <label for='date_1'>Fecha Tiraje(*)</label>
                                    <input type='text' name='date_1' id='fecha1_{$id}' value='{$row["FECHA_RESOLUCION"]}' class='form-control'>
                                    <input type='hidden' name='id_tiraje' id='id_tiraje' value='{$row["ID_TIRAJE"]}' class='form-control'>
                                </div>
                                <div class='form-group mb-4 col-sm-8'>
                                    <label for='n_resolucion_factura'>Numero Dosificacion Facturas(*)</label>
                                    <input type='text' name='n_resolucion_factura' placeholder='2019-1-1999999' id='n_resolucion_factura' value='{$row["NRO_RESOLUCION_FAC"]}' class='form-control'>
                                </div>
                                <div class='form-group mb-4 col-sm-6'>
                                    <label for='n_resolucion'>Numero Dosificacion(*)</label>
                                    <input type='text' name='n_resolucion' id='n_resolucion' value='{$row["NRO_RESOLUCION"]}' placeholder='2019-1-1900999' class='form-control'>
                                </div>
                                <div class='form-group mb-4 col-sm-6'>
                                    <label for='serie'>Serie(*)</label>
                                    <input type='text' name='serie' id='serie' placeholder='SERIE A' value='{$row["SERIE"]}' class='form-control'>
                                </div>
                                <div class='form-group mb-4 col-sm-6'>
                                    <label for='correlativo_del'>Del(*)</label>
                                    <input type='text' name='correlativo_del' id='correlativo_del_{$id}'  value='{$row["DESDE"]}' class='form-control'>
                                </div>
                                <div class='form-group mb-4 col-sm-6'>
                                    <label for='correlativo_al'>Al(*)</label>
                                    <input type='text' name='correlativo_al' id='correlativo_al_{$id}' value='{$row["HASTA"]}' class='form-control'>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer md-button'>
                            <button class='btn btn-danger' data-dismiss='modal'><i class='flaticon-cancel-12'></i> Cancelar</button>
                            <button type='submit' class='btn btn-success'>Guardar</button>
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

/* -------------------------------------------------------------------------- */
/*                             Actualizar usuario                            */
/* -------------------------------------------------------------------------- */

        function actualizar_tiraje(){
            if(isset($_POST["id_tiraje"])){
                $id = $_POST["id_tiraje"];
                $date= $_POST["date_1"];
                $rfactura= $_POST["n_resolucion_factura"];
                $resolucion = $_POST["n_resolucion"];
                $serie = $_POST["serie"];
                $cdel = $_POST["correlativo_del"];
                $cal = $_POST["correlativo_al"];
                $disponibles = $cal-$cdel+1;
                $actualizar_tiraje = $this->model->actualizar_tiraje($id,$date,$rfactura,$resolucion,$serie,$cdel,$cal,$disponibles);
                if($actualizar_tiraje){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
        function eliminar_tiraje(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_tiraje($_POST["id"]);
                if($eliminar){
                    if($eliminar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }

            }
        }
    }