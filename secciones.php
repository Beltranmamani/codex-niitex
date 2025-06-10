<?php
    class secciones extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        // View secciones
        function render(){
            $this->view->listar_presentacion = $this::listar_presentacion();
            $this->view->render('secciones/index');
        }
        function agregar_seccion(){
            if(isset($_POST["nombre"])){
                $nombre = strtoupper($_POST["nombre"]);
                $estado = strtoupper($_POST["estado"]);
                $codigo = $this->generar_codigo();
                $seccion = $this->model->agregar_seccion($codigo,$nombre,$estado);
                if($seccion){
                    if($seccion->rowCount()>0){
                        echo 1;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_seccion();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('SECCION',6,$numero);
            }else{
                return 0;
            }
        }
        function generar_codigo_presentaciones(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_seccion_presentacion();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('PRES',6,$numero);
            }else{
                return 0;
            }
        }
        function listar_seccion(){
            if(isset($_POST["token"])){
                $lista = $this->model->listar_seccion();
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
                                <td>{$rows["SECCION"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_SECCION']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'>
                                            <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                        </svg>
                                    </button>
                                    <button class='btn btn-success mb-2 mr-2 rounded-circle btn_categorias' value='{$rows['ID_SECCION']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-list'><line x1='8' y1='6' x2='21' y2='6'></line><line x1='8' y1='12' x2='21' y2='12'></line><line x1='8' y1='18' x2='21' y2='18'></line><line x1='3' y1='6' x2='3.01' y2='6'></line><line x1='3' y1='12' x2='3.01' y2='12'></line><line x1='3' y1='18' x2='3.01' y2='18'></line></svg>
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
        function listar_presentacion()
        {
            $presentacion = $this->model->listar_presentacion();
            if ($presentacion) {
                $option = "";
                foreach ($presentacion as $row) {
                    $option .= "<option value='{$row['ID_PRESENTACION']}'>{$row['NOMBRE']}</option>";
                }
                return $option;
            }
        }
        function agregar_presentacion_seccion(){
            if(isset($_POST["id"])){
                $codigo = $this->generar_codigo_presentaciones();
                $presentacion = $this->model->agregar_seccion_presentacion($codigo,$_POST["id"],$_POST["presentacion"]);
                if($presentacion){
                    if($presentacion->rowCount()>0){
                        echo 1;
                    }else{
                        echo 3;
                    }
                }else{
                    echo 2;
                }
            }
        }
        function lista_presentacion_seccion(){
            if($_POST["id_seccion"]){
                $lista = $this->model->consulta_seccion_presentacion($_POST["id_seccion"]);
                if($lista){
                    if($lista->rowCount()>0){
                        $table = "";
                        $n=1;
                        foreach($lista as $t){
                            $table.= "
                            <tr>
                                <td>{$n}</td>
                                <td>{$t["PRESENTACION"]}</td>
                                <td class='text-center'>
                                    <button type = 'button' class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$t['ID_PRESENTACIONES']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
                            ";
                            $n++;
                        }
                        echo $table;
                    }else{
                        echo 3;
                    }
                }else{
                    echo 2;
                }
            }
        }

        function form_seccion(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_seccion = $this->model->consulta_seccion($id);
                if($consultar_seccion){
                    $formulario = "";
                    if($consultar_seccion->rowCount()>0){
                        foreach($consultar_seccion as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                            <div class='row'>
                                <div class='form-group mb-4 col-sm-12'>
                                    <label for='new-unidad_name'>Sección</label>
                                    <input type='text' class='form-control' name='nombre_seccion' id='nombre_seccion' value='{$row["SECCION"]}'>
                                    <input type='hidden' class='form-control' name='id_seccion' id='id_seccion' value='{$row["ID_SECCION"]}'>
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

        function actualizar_seccion(){
            if(isset($_POST["id_seccion"])){
                $id = $_POST["id_seccion"];
                $nombre = $_POST["nombre_seccion"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_seccion = $this->model->actualizar_seccion($id,$nombre,$estado);
                if($actualizar_seccion){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

        function eliminar_presentacion(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_presentacion($_POST["id"]);
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