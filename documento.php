<?php
    class documento extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $this->view->render('documento/index');
        }
        function listar_documento_json(){
            if(isset($_POST["token"])){
                $lista = $this->model->listar_documentos();
                
                    if($lista){
                        echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));
                    }else{
                        echo 0;
                    }
                
            }
        }
        function listar_documento(){
            if(isset($_POST["token"])){
                $unidades = $this->model->listar_documentos();
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
                                <td>{$n}</td>
                                <td>{$rows["DOCUMENTO"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_DOCUMENTO']}'>
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
        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_documentos();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('DOCUMENTO',6,$numero);
            }else{
                return 0;
            }
        }
        function agregar_documento(){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $estado = strtoupper($_POST["estado"]);
                $codigo = $this->generar_codigo();
                $documento = $this->model->agregar_documento($codigo,$nombre,$estado);
                if($documento){
                    if($documento->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* -------------------------------------------------------------------------- */
/*                            formulario documento                            */
/* -------------------------------------------------------------------------- */

        function form_documento(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_documento = $this->model->consulta_documento($id);
                if($consultar_documento){
                    $formulario = "";
                    if($consultar_documento->rowCount()>0){
                        foreach($consultar_documento as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                        <div class='row'>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='nombre'>Nombre </label>
                                <input type='text' class='form-control' name='nombre_documento' id='nombre_documento'  value='{$row["DOCUMENTO"]}' placeholder='EJ. RUC' required>
                                <input type='hidden' class='form-control' name='id_documento' id='id_documento' value='{$row["ID_DOCUMENTO"]}' placeholder='EJ. RUC' required>
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
/*                            Actualizar documento                            */
/* -------------------------------------------------------------------------- */

        function actualizar_documento(){
            if(isset($_POST["id_documento"])){
                $id = $_POST["id_documento"];
                $nombre = $_POST["nombre_documento"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_documento = $this->model->actualizar_documento($id,$nombre,$estado);
                if($actualizar_documento){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }