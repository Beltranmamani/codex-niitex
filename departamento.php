<?php
    class departamento extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $this->view->render('departamento/index');
        }
        function listar_departamento(){
            if(isset($_POST["token"])){
                $unidades = $this->model->listar_departamento();
                if($unidades){
                    $n = 1;
                    $tabla = "";
                    foreach($unidades as $rows){
                        $tabla .="
                            <tr>
                                <td class='checkbox-column'> {$n} </td>
                                <td>{$n}</td>
                                <td>{$rows["DEPARTAMENTO"]}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_DEPARTAMENTO']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'>
                                            <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                        </svg>
                                    </button>
                                    </button>
                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' departamento_id='{$rows['ID_DEPARTAMENTO']}' >
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
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
            $numero = $this->model->listar_departamento();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('DEPARTAMENTO',6,$numero);
            }else{
                return 0;
            }
        }
        function agregar_departamento(){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $codigo = $this->generar_codigo();
                $departamento = $this->model->agregar_departamento($codigo,$nombre);
                if($departamento){
                    if($departamento->rowCount()>0){
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

        function form_departamento(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_departamento = $this->model->consulta_departamento($id);
                if($consultar_departamento){
                    $formulario = "";
                    if($consultar_departamento->rowCount()>0){
                        foreach($consultar_departamento as $row){
                            $formulario .= "
                            <div class='modal-body'>
                        <div class='row'>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='nombre'>Nombre </label>
                                <input type='text' class='form-control' name='nombre' id='nombre'  value='{$row["DEPARTAMENTO"]}'>
                                <input type='hidden' class='form-control' name='id_departamento' id='id_departamento' value='{$row["ID_DEPARTAMENTO"]}'>
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

        function actualizar_departamento(){
            if(isset($_POST["id_departamento"])){
                $id = $_POST["id_departamento"];
                $nombre = $_POST["nombre"];
                $actualizar_departamento = $this->model->actualizar_departamento($id,$nombre);
                if($actualizar_departamento){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

        function eliminar_departamento(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_departamento($_POST["id"]);
                if($eliminar){
                    if($eliminar->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }
            }
        }
    }