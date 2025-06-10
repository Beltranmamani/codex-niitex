<?php
    class metodopago extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $this->view->render('metodopago/index');
        }
        function listar_metodopago_json(){
            if(isset($_POST["token"])){
                $lista = $this->model->listar_metodopagos();
                
                    if($lista){
                        echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));
                    }else{
                        echo 0;
                    }
                
            }
        }
        function listar_metodopago(){
            if(isset($_POST["token"])){
                $unidades = $this->model->listar_metodopagos();
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
                                <td>{$rows["NAME"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID']}'>
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
            $numero = $this->model->listar_metodopagos();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('metodopago',6,$numero);
            }else{
                return 0;
            }
        }
        function agregar_metodopago(){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $estado = strtoupper($_POST["estado"]);
                $codigo = $this->generar_codigo();
                $metodopago = $this->model->agregar_metodopago($codigo,$nombre,$estado);
                if($metodopago){
                    if($metodopago->rowCount()>0){
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
/*                            formulario metodopago                            */
/* -------------------------------------------------------------------------- */

        function form_metodopago(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_metodopago = $this->model->consulta_metodopago($id);
                if($consultar_metodopago){
                    $formulario = "";
                    if($consultar_metodopago->rowCount()>0){
                        foreach($consultar_metodopago as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                        <div class='row'>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='nombre'>Nombre </label>
                                <input type='text' class='form-control' name='nombre_metodopago' id='nombre_metodopago'  value='{$row["NAME"]}' placeholder='EJ. RUC' required>
                                <input type='hidden' class='form-control' name='id_metodopago' id='id_metodopago' value='{$row["ID"]}' placeholder='EJ. RUC' required>
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
/*                            Actualizar metodopago                            */
/* -------------------------------------------------------------------------- */

        function actualizar_metodopago(){
            if(isset($_POST["id_metodopago"])){
                $id = $_POST["id_metodopago"];
                $nombre = $_POST["nombre_metodopago"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_metodopago = $this->model->actualizar_metodopago($id,$nombre,$estado);
                if($actualizar_metodopago){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }