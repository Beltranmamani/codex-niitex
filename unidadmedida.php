<?php
    class unidadmedida extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* ========================================================================== */
/*                              Vista principal                               */
/* ========================================================================== */

        function render(){
            $this->view->render('unidadmedida/index');
        }

/* ========================================================================== */
/*                      Funcion listar unidades de medida                     */
/* ========================================================================== */

        function listar_unidades(){
            if(isset($_POST["token"])){
                $unidades = $this->model->listar_unidades();
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
                                <td class='checkbox-column'>{$n}</td>
                                <td>{$n}</td>
                                <td>{$rows["UNIDAD"]}</td>
                                <td>{$rows["PREFIJO"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_UNIDAD']}'>
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
/*                  Funcion generear codigo unicio de medida                  */
/* ========================================================================== */

        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_unidades();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('UMS',6,$numero);
            }else{
                return 0;
            }
        }

/* ========================================================================== */
/*                        Funcion agregar unidad medida                       */
/* ========================================================================== */

        function agregar_unidad(){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $prefijo = strtoupper($_POST["prefijo"]);
                $estado = strtoupper($_POST["estado"]);
                $codigo = $this->generar_codigo();
                $unidad = $this->model->agregar_unidad($codigo,$nombre,$prefijo,$estado);
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
/*                         Formulario de unidadmedida                         */
/* -------------------------------------------------------------------------- */
        function form_unidadmedida(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_unidad = $this->model->consulta_unidad($id);
                if($consultar_unidad){
                    $formulario = "";
                    if($consultar_unidad->rowCount()>0){
                        foreach($consultar_unidad as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='new-unidad_name'>Unidad de Medida</label>
                                    <input type='text' class='form-control' name='nombre_unidad' id='nombre_unidad' value='{$row["UNIDAD"]}' placeholder='EJ. 1 LIBRA' required>
                                    <input type='hidden' class='form-control' name='id_unidad' id='id_unidad' value='{$row["ID_UNIDAD"]}' placeholder='EJ. CELULARES' required>

                                    </div>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='new-prefijo_name'>Prefijo</label>
                                    <input type='text' class='form-control' name='prefijo' id='prefijo' value='{$row["PREFIJO"]}' placeholder='EJ. 1 LB' required>
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
/*                           Actualizar unidadmedida                          */
/* -------------------------------------------------------------------------- */

        function actualizar_unidad(){
            if(isset($_POST["id_unidad"])){
                $id = $_POST["id_unidad"];
                $unidad = $_POST["nombre_unidad"];
                $prefijo = $_POST["prefijo"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_unidad = $this->model->actualizar_unidad($id,$unidad,$prefijo,$estado);
                if($actualizar_unidad){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

}




