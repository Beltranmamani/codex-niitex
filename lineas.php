<?php
    class lineas extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                               Vista principal                              */
/* ========================================================================== */

        function render(){
            $this->view->render('lineas/index');
        }
        function listar_lineas_json(){
            if(isset($_POST["token"])){
                $lista = $this->model->listar_lineas();
                if($lista){
                    echo json_encode($lista->fetchAll(PDO::FETCH_ASSOC));
                }else{
                    echo 0;
                }
            }
        }
/* ========================================================================== */
/*                            Funcion listar lineas                           */
/* ========================================================================== */

        function listar_lineas(){
            if(isset($_POST["token"])){
                $lista = $this->model->listar_lineas();
                if($lista){
                    $n = 1;
                    $tabla = "";
                    foreach($lista as $rows){
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $estado = "<span class='shadow-none badge badge-success'>Vigente</span>";
                        }else{
                            $estado = "<span class='shadow-none badge badge-dark'>Descontinuada</span>";
                        }
                        $tabla .="
                            <tr>
                                <td class='checkbox-column'>{$n}</td>
                                <td>{$n}</td>
                                <td>{$rows["LINEA"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_LINEA']}'>
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
/*                     Funcion generar codigo para lineas                     */
/* ========================================================================== */

        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_lineas();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('LIN',6,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                          Funcion de agregar lineas                         */
/* ========================================================================== */

        function agregar_linea(){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $estado = strtoupper($_POST["estado"]);
                $codigo = $this->generar_codigo();
                $unidad = $this->model->agregar_linea($codigo,$nombre,$estado);
                if($unidad){
                    if($unidad->rowCount()>0){
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
/*                              Formulario_Lineas                             */
/* -------------------------------------------------------------------------- */

        function form_lineas(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_lineas = $this->model->consulta_linea($id);
                if($consultar_lineas){
                    $formulario = "";
                    if($consultar_lineas->rowCount()>0){
                        foreach($consultar_lineas as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='new-unidad_name'>Marca</label>
                                    <input type='text' class='form-control' name='nombre_linea' id='nombre_linea' value='{$row["LINEA"]}' placeholder='EJ. SAMSUNG' required>
                                    <input type='hidden' class='form-control' name='id_linea' id='id_linea' value='{$row["ID_LINEA"]}' required>
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
                            <button type='sumit' id='save_unidad' class='btn btn-success'>Guardar</button>
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
/*                              Actualizar_Lineas                             */
/* -------------------------------------------------------------------------- */

        function actualizar_linea(){
            if(isset($_POST["id_linea"])){
                $id = $_POST["id_linea"];
                $nombre = $_POST["nombre_linea"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_linea = $this->model->actualizar_linea($id,$nombre,$estado);
                if($actualizar_linea){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

    }