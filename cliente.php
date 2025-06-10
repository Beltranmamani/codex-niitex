<?php
    class cliente extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function lista_clientes_json(){
            if(isset($_POST["token"])){
                $unidades = $this->model->lista_clientes();
                if($unidades){
                  echo json_encode($unidades->fetchAll(PDO::FETCH_ASSOC));
                   
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                                Vista cliente                               */
/* ========================================================================== */
        function render()
        {
            $this->view->lista_documentos = $this::lista_documentos();
            $this->view->render('cliente/index');
        }

/* ========================================================================== */
/*                Lista de documentos disponibles en el sistema               */
/* ========================================================================== */
        function lista_documentos(){
            $documentos = $this->model->lista_documentos();
            if($documentos){
                $option = "";
                foreach($documentos as $row){
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
/*                               Guardar Cliente                              */
/* ========================================================================== */
        function guardar_cliente(){
            if(isset($_POST["razon_social"]) && isset($_POST["nro_documento"])){
                $codigo = $this->generar_codigo();
                $razon = mainModel::clean_string($_POST["razon_social"]);
                $nro_documento = mainModel::clean_string($_POST["nro_documento"]);
                $tipo_documento = mainModel::clean_string($_POST["tipo_documento"]);
                $limite_crediticio = mainModel::clean_string($_POST["limite_crediticio"]);
                $limite_crediticio = floatval($limite_crediticio);
                $creditos_activos = mainModel::clean_string($_POST["creditos_activos"]);
                $direccion = mainModel::clean_string($_POST["direccion"]);
                $telefono = mainModel::clean_string($_POST["telefono"]);
                $correo = mainModel::clean_string($_POST["correo"]);
                $nombre = mainModel::clean_string($_POST["nombre"]);
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $guardar_cliente = $this->model->guardar_cliente($codigo,$razon,$tipo_documento,$nro_documento,$limite_crediticio,$creditos_activos,$direccion,$telefono,$correo,$estado,$nombre);
                if($guardar_cliente){
                    if($guardar_cliente->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{

                }
            }
        }
/* ========================================================================== */
/*                         Generara codigo del cliente                        */
/* ========================================================================== */
        function generar_codigo(){
            $numero = $this->model->lista_clientes();
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<9){
                //     return "CL000000".$numero;
                // }else if($numero<99){
                //     return "CL00000".$numero;
                // }else if($numero<999){
                //     return "CL0000".$numero;
                // }if($numero<9999){
                //     return "CL000".$numero;
                // }if($numero<99999){
                //     return "CL00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }
/* ========================================================================== */
/*                              Lista de clientes                             */
/* ========================================================================== */
        function listar_clientes(){
            if(isset($_POST["token"])){
                $unidades = $this->model->lista_clientes();
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
                        $cliente = mainModel::cliente_credito_activo($rows["ID_CLIENTE"]);
                        $tabla .="
                            <tr>
                                <td>{$rows["ID_CLIENTE"]}</td>
                                <td>{$rows["RAZON"]}</td>
                                <td>{$rows["DOCUMENTO"]} {$rows["N_DOCUMENTO"]}</td>
                                <td>{$rows["LIMITE_CREDITICIO"]}</td>
                                <td>{$rows["N_CREDITO"]}</td>
                                <td>{$cliente["CREDITOS"]}</td>
                                <td>{$rows["TELEFONO"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["CORREO"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows["ID_CLIENTE"]}'>
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
/*                         Lista de clientes en select                        */
/* ========================================================================== */

        function listaclientesselect(){
            if(isset($_POST["tocken"])){
                $unidades = $this->model->lista_clientes();
                if($unidades){
                    $n = 1;
                    $option = "<option disabled selected>Seleccionar...</option>";
                    foreach($unidades as $rows){
                        $razon = strtoupper($rows["RAZON"]);
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $option .="<option value='{$rows["ID_CLIENTE"]}'>{$razon} {$rows["DOCUMENTO"]} {$rows["N_DOCUMENTO"]}</option>";
                        }else{
                            $option .="<option value='{$rows["ID_CLIENTE"]}' disabled>{$razon} {$rows["DOCUMENTO"]} {$rows["N_DOCUMENTO"]}</option>";
                        }
                    }
                    echo $option;
                }else{
                    echo 0;
                }
            }
        }

/* ========================================================================== */
/*                 Buscar cliente del select de procesar venta                */
/* ========================================================================== */

function buscarcliente_select(){
    if(isset($_POST["id"])){
        $id_cliente = $_POST["id"];
        $numero_creditos =  1;
        $limite_crediticio = 0;
        $creditos = 0;
        $consultar_cliente = $this->model->consulta_cliente($id_cliente);
        if($consultar_cliente){
            if($consultar_cliente->rowCount()>0){
                foreach($consultar_cliente as $row){
                    $numero_creditos =  $row["N_CREDITO"];
                    $limite_crediticio = $row["LIMITE_CREDITICIO"];
                    $creditos = 0;
                }
            }   
        }
        $buscar = $this->model->buscar_cliente_credito_activo($id_cliente);
        if($buscar){
            if($buscar->rowCount()>0){
                $respuesta = "";
                foreach($buscar as $row){
                    if($row['LIMITE_CREDITICIO']!=NULL || $row['LIMITE_CREDITICIO']!='' ){
                        $limite_crediticio = $row['LIMITE_CREDITICIO'];
                    }
                    if($row['N_CREDITO']!=NULL || $row['N_CREDITO']!='' ){
                        $numero_creditos = $row['N_CREDITO'];
                    }
                    if($row['CREDITOS']!=NULL || $row['CREDITOS']!='' ){
                        $creditos = $row['CREDITOS'];
                    }
                    $respuesta .= "{$id_cliente}|{$limite_crediticio}|{$numero_creditos}|{$creditos}|";
                }
                echo $respuesta;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }
}
        function guardar_cliente_2(){
            if(isset($_POST["razon_social"]) && isset($_POST["nro_documento"])){
                $codigo = $this->generar_codigo();
                $razon = mainModel::clean_string($_POST["razon_social"]);
                $nro_documento = mainModel::clean_string($_POST["nro_documento"]);
                $tipo_documento = mainModel::clean_string($_POST["tipo_documento"]);
                $limite_crediticio = mainModel::clean_string($_POST["limite_crediticio"]);
                $limite_crediticio = floatval($limite_crediticio);
                $creditos_activos = mainModel::clean_string($_POST["creditos_activos"]);
                $direccion = mainModel::clean_string($_POST["direccion"]);
                $telefono = mainModel::clean_string($_POST["telefono"]);
                $correo = mainModel::clean_string($_POST["correo"]);
                $nombre = mainModel::clean_string($_POST["nombre"]);
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $guardar_cliente = $this->model->guardar_cliente($codigo,$razon,$tipo_documento,$nro_documento,$limite_crediticio,$creditos_activos,$direccion,$telefono,$correo,$estado,$nombre);
                if($guardar_cliente){
                    if($guardar_cliente->rowCount()>0){
                        if(!empty($_POST['direccion_destino'])&&!empty($_POST['l1'])&&!empty($_POST['l2'])){
                            $guardar_direccion_cliente = $this->model->guardar_direccion_cliente($codigo,$_POST['direccion_destino'],$_POST['l1'],$_POST['l2']);
                            if($guardar_direccion_cliente){
                                if($guardar_direccion_cliente->rowCount()>0){
                                    echo 1;
                                }else{
                                    echo 0;
                                }
                            }else{
                                echo 0;
                            }
                        }else{
                            echo 1;
                        }
                    }else{
                        echo 0;
                    }
                }else{

                }
            }
        }
         function guardar_2(){
            if(isset($_POST["NOMBRE"]) && isset($_POST["N_DOCUMENTO"])){
                $codigo = $this->generar_codigo();
                $razon = mainModel::clean_string($_POST["RAZON"]);
                $nro_documento = mainModel::clean_string($_POST["N_DOCUMENTO"]);
                $tipo_documento = mainModel::clean_string($_POST["TIPO_DOCUMENTO"]);
                $limite_crediticio = mainModel::clean_string($_POST["LIMITE_CREDITICIO"]);
                $limite_crediticio = floatval($limite_crediticio);
                $creditos_activos = mainModel::clean_string($_POST["N_CREDITO"]);
                $direccion = mainModel::clean_string($_POST["DIRECCION"]);
                $telefono = mainModel::clean_string($_POST["TELEFONO"]);
                $correo = mainModel::clean_string($_POST["CORREO"]);
                $nombre = mainModel::clean_string($_POST["NOMBRE"]);
                $estado = 1;
                $guardar_cliente = $this->model->guardar_cliente($codigo,$razon,$tipo_documento,$nro_documento,$limite_crediticio,$creditos_activos,$direccion,$telefono,$correo,$estado,$nombre);
                if($guardar_cliente){
                    if($guardar_cliente->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{

                }
            }
        }
/* -------------------------------------------------------------------------- */
/*                             Formulario Cliente                             */
/* -------------------------------------------------------------------------- */

        function form_cliente(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_cliente = $this->model->consulta_cliente($id);
                if($consultar_cliente){
                    $formulario = "";
                    if($consultar_cliente->rowCount()>0){
                        foreach($consultar_cliente as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $lista_documentos = "";
                            $documentos = $this->model->lista_documentos();
                            foreach($documentos as $doc){
                                if($doc["ID_DOCUMENTO"] === $row["TIPO_DOCUMENTO"]){
                                    $lista_documentos .= "
                                        <option value='{$doc['ID_DOCUMENTO']}' selected='true'>{$doc['DOCUMENTO']}</option>
                                    ";
                                }else{
                                    $lista_documentos .= "
                                        <option value='{$doc['ID_DOCUMENTO']}'>{$doc['DOCUMENTO']}</option>
                                    ";
                                }
                            }
                            $formulario .= "
                            <div class='modal-body'>
                                <div class='row'>
                                    <div class='form-group mb-4 col-sm-12'>
                                        <label for='razon_social'>Nombre o Razon Social (*)</label>
                                        <input type='text' class='form-control' name='razon' id='razon' value='{$row["RAZON"]}'  maxlength='100' placeholder='EJ. MI PAISA'>
                                        <input type='hidden' class='form-control' name='id_cliente' id='id_cliente' value='{$row["ID_CLIENTE"]}' maxlength='100' placeholder='EJ. MI PAISA'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-12'>
                                        <label for='nombre_1'>Nombre </label>
                                        <input type='text' class='form-control' name='nombre' id='nombre_1' value='{$row["NOMBRE"]}'  maxlength='100' placeholder='EJ. MI PAISA'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='tipo_documento'>Tipo de documento(*)</label>
                                        <select id='tipo_documento' name='tipo_documento' class='form-control'>
                                            {$lista_documentos}  
                                        </select>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='nro_documento'>Nro. Documento(*)</label>
                                        <input type='text' class='form-control' id='nro_documento' name='nro_documento' value='{$row["N_DOCUMENTO"]}' placeholder='EJ. 1029372912331'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='limite_crediticio'>Litimite Crediticio(*)</label>
                                        <input type='text' class='form-control' id='limite_crediticio' name='limite_crediticio' value='{$row["LIMITE_CREDITICIO"]}' placeholder='EJ. 120.00'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='creditos_activos'>Creditos activos(*)</label>
                                        <input type='text' class='form-control' id='creditos_activos' name='creditos_activos' value='{$row["N_CREDITO"]}' placeholder='EJ. 2'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-12'>
                                        <label for='direccion'>Dirección</label>
                                        <input type='text' class='form-control' id='direccion' name='direccion'value='{$row["DIRECCION"]}'  placeholder='EJ. AV. Los Pedregales #443'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='telefono'>Teléfono o celular</label>
                                        <input type='text' class='form-control' id='telefono' name='telefono' value='{$row["TELEFONO"]}'  placeholder='EJ. 91020239192'>
                                    </div>
                                    <div class='form-group mb-4 col-sm-6'>
                                        <label for='correo'>Correo</label>
                                        <input type='text' class='form-control' id='correo' name='correo' value='{$row["CORREO"]}' placeholder='EJ. mipaisa@pais'>
                                    </div>
                                    <div class='form-group mb-2 col-sm-12'>
                                        <label for='new-unidad-estado'>Estado</label>
                                    </div>
                                    <div class='form-group mb-2 col-sm-12 d-flex'>
                                        <label class='switch s-icons s-outline s-outline-info  mr-2'>
                                            <input id='new-unidad-estado' type='checkbox' name='estado' {$estado}>
                                            <span class='slider round'></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer md-button'>
                                <button class='btn btn-danger' data-dismiss='modal'><i class='flaticon-cancel-12'></i> Cancelar</button>
                                <button type='submit' class='btn btn-primary'>Guardar</button>
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
/*                             Actualizar cliente                             */
/* -------------------------------------------------------------------------- */

        function actualizar_cliente(){
            if(isset($_POST["id_cliente"])){
                $id = $_POST["id_cliente"];
                $razon = $_POST["razon"];
                $tipo_documento= $_POST["tipo_documento"];
                $nro_documento= $_POST["nro_documento"];
                $limite = $_POST["limite_crediticio"];
                $creditos = $_POST["creditos_activos"];
                $direccion = $_POST["direccion"];
                $telefono = $_POST["telefono"];
                $correo = $_POST["correo"];
                $nombre = $_POST["nombre"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_cliente = $this->model->actualizar_cliente($id,$razon,$tipo_documento,$nro_documento,$limite,$creditos,$direccion,$telefono,$correo,$estado,$nombre);
                if($actualizar_cliente){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }