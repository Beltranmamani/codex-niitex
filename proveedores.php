<?php
    class proveedores extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $this->view->lista_documentos = $this::lista_documentos();
            $this->view->render('proveedores/index');
        }
        /*
            ======================================
                      Lista de documentos
            ======================================
        */
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
/*                          Generar codigo proveedor                          */
/* ========================================================================== */
        function generar_codigo(){
            $numero = $this->model->lista_proveedores();
            if($numero){
                $numero = $numero->rowCount()+1;
                // if($numero<9){
                //     return "PROV000000".$numero;
                // }else if($numero<99){
                //     return "PROV00000".$numero;
                // }else if($numero<999){
                //     return "PROV0000".$numero;
                // }if($numero<9999){
                //     return "PROV000".$numero;
                // }if($numero<99999){
                //     return "PROV00".$numero;
                // }
                return $numero;
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                          Funcion guardar proveedor                         */
/* ========================================================================== */

        function nuevoproveedor(){
            if(isset($_POST["razon_social"]) && isset($_POST["nro_documento"])){
                $codigo = $this::generar_codigo();
                $razon = $_POST["razon_social"];
                $tipo_documento = $_POST["tipo_documento"];
                $nro_documento = $_POST["nro_documento"];
                $direccion = $_POST["direccion"];
                $telefono = $_POST["telefono"];
                $correo = $_POST["correo"];
                $nro_cuenta = $_POST["nro_cuenta"];
                $vendedor = $_POST["vendedor"];
                $telefono_vendedor = $_POST["telefono_vendedor"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $guardarproveedor = $this->model->agregar_proveedor($codigo,$razon,$tipo_documento,$nro_documento,$direccion,$telefono,$correo,$nro_cuenta,$vendedor,$telefono_vendedor,$estado);
                if($guardarproveedor){
                    if($guardarproveedor->rowCount()>0){
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
/*                            Lista de proveedores                            */
/* ========================================================================== */

        function listar_proveedores(){
            if(isset($_POST["token"])){
                $unidades = $this->model->lista_proveedores();
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
                                <td class='checkbox-column'> {$n} </td>
                                <td>{$rows["ID_PROVEEDOR"]}</td>
                                <td>{$rows["RAZON"]}</td>
                                <td>{$rows["DOCUMENTO"]} {$rows["N_DOCUMENTO"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["TELEFONO"]}</td>
                                <td>{$rows["CORREO"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_PROVEEDOR']}'>
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

/* -------------------------------------------------------------------------- */
/*                           Formulario de proveedor                          */
/* -------------------------------------------------------------------------- */

function form_proveedor(){
    if(isset($_POST["id"])){    
        $id = $_POST["id"];
        $consultar_proveedor = $this->model->consulta_proveedor($id);
        if($consultar_proveedor){
            $formulario = "";
            if($consultar_proveedor->rowCount()>0){
                foreach($consultar_proveedor as $row){
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
                            <label for='razon_social'>Razon Social</label>
                            <input type='text' class='form-control' id='razon_social' name='razon_social' value='{$row["RAZON"]}' maxlength='100' placeholder='EJ. MI PAISA'>
                            <input type='hidden' class='form-control' id='id_proveedor' name='id_proveedor' value='{$row["ID_PROVEEDOR"]}' maxlength='100' placeholder='EJ. MI PAISA'>
                        </div>
                        <div class='form-group mb-4 col-sm-6'>
                            <label for='tipo_documento'>Tipo de documento</label>
                            <select id='tipo_documento' name='tipo_documento' class='form-control'>
                                <option value=' selected='selected' disabled>Seleccionar...</option> 
                                {$lista_documentos}  
                            </select>
                        </div>
                        <div class='form-group mb-4 col-sm-6'>
                            <label for='nro_documento'>Nro. Documento</label>
                            <input type='text' class='form-control' id='nro_documento' name='nro_documento' value='{$row["N_DOCUMENTO"]}' placeholder='EJ. 1029372912331'>
                        </div>
                        <div class='form-group mb-4 col-sm-12'>
                            <label for='direccion'>Dirección</label>
                            <input type='text' class='form-control' id='direccion' name='direccion' value='{$row["DIRECCION"]}' placeholder='EJ. AV. Los Pedregales #443'>
                        </div>
                        <div class='form-group mb-4 col-sm-6'>
                            <label for='telefono'>Teléfono</label>
                            <input type='text' class='form-control' id='telefono' name='telefono' value='{$row["TELEFONO"]}' placeholder='EJ. 91020239192'>
                        </div>
                        <div class='form-group mb-4 col-sm-6'>
                            <label for='correo'>Correo</label>
                            <input type='text' class='form-control' id='correo' name='correo' value='{$row["CORREO"]}' placeholder='EJ. mipaisa@pais'>
                        </div>
                        <div class='form-group mb-4 col-sm-12'>
                            <label for='nro_cuenta'>Nro. Cuenta bancaria</label>
                            <input type='text' class='form-control' id='nro_cuenta' name='nro_cuenta' value='{$row["CUENTA"]}' placeholder='EJ. 570020039320203'>
                        </div>
                        <div class='form-group mb-4 col-sm-6'>
                            <label for='vendedor'>Vendedor</label>
                            <input type='text' class='form-control' id='vendedor' name='vendedor' value='{$row["VENDEDOR"]}'  placeholder='EJ. FULANITO DE TAL'>
                        </div>
                        <div class='form-group mb-4 col-sm-6'>
                            <label for='telefono_vendedor'>Teléfono Vendedor</label>
                            <input type='text' class='form-control' id='telefono_vendedor' name='telefono_vendedor' value='{$row["V_TELEFONO"]}'  placeholder='EJ. 1929211832'>
                        </div>
                        <div class='form-group mb-2 col-sm-12'>
                            <label for='new-unidad-estado'>Estado</label>
                        </div>
                        <div class='form-group mb-2 col-sm-12 d-flex'>
                            <label class='switch s-icons s-outline s-outline-info  mr-2'>
                                <input id='new-unidad-estado' type='checkbox' name='estado' name='estado' {$estado}>
                                <span class='slider round'></span>
                            </label>
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
/*                           Actualizar presentacion                          */
/* -------------------------------------------------------------------------- */

function actualizar_proveedor(){
    if(isset($_POST["id_proveedor"])){
        $id = $_POST["id_proveedor"];
        $razon = $_POST["razon_social"];
        $tipo_documento= $_POST["tipo_documento"];
        $nro_documento= $_POST["nro_documento"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $cuenta = $_POST["nro_cuenta"];
        $vendedor = $_POST["vendedor"];
        $vtelefono = $_POST["telefono_vendedor"];
        $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
        $estado = $estado == 1? 1:0;
        $actualizar_proveedor = $this->model->actualizar_proveedor($id,$razon,$tipo_documento,$nro_documento,$direccion,$telefono,$correo,$cuenta,$vendedor,$vtelefono,$estado);
        if($actualizar_proveedor){
            echo 1;
        }else{
            echo 0;
        }
    }
}
    }