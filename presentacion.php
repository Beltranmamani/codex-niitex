<?php
    class presentacion extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* -------------------------------------------------------------------------- */
/*                      Vista principal de presentaciones                     */
/* -------------------------------------------------------------------------- */

        function render(){
            $this->view->render('presentacion/index');
        }
        function listar_presentaciones_json(){
            if(isset($_POST["token"])){
                $presentacion = $this->model->listar_presentaciones();
                if($presentacion){
                    echo json_encode($presentacion->fetchAll(PDO::FETCH_ASSOC));
                }else{
                    echo 0;
                }
            }
        }

/* -------------------------------------------------------------------------- */
/*                     Lista de presentaciones disponibles                    */
/* -------------------------------------------------------------------------- */

        function listar_presentaciones(){
            if(isset($_POST["token"])){
                $presentacion = $this->model->listar_presentaciones();
                if($presentacion){
                    $n = 1;
                    $tabla = "";
                    foreach($presentacion as $rows){
                        $estado = $rows['ESTADO'];
                        if($estado == 1){
                            $estado = "<span class='shadow-none badge badge-success'>Vigente</span>";
                        }else{
                            $estado = "<span class='shadow-none badge badge-dark'>Descontinuada</span>";
                        }
                        $imagen = SERVERURL . "archives/assets/categorias/{$rows["FOTO"]}";
                        $tabla .="
                            <tr>
                                <td class='checkbox-column'> {$n }</td>
                                <td>{$n}</td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>{$rows["NOMBRE"]}</td>
                                <td class='text-center'>{$estado}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_PRESENTACION']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'>
                                            <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                        </svg>
                                    </button>
                                    <button class='btn btn-success mb-2 mr-2 rounded-circle btn_imagen' value='{$rows['ID_PRESENTACION']}'>
                                       <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-image p-1 br-6 mb-1'><rect x='3' y='3' width='18' height='18' rx='2' ry='2'></rect><circle cx='8.5' cy='8.5' r='1.5'></circle><polyline points='21 15 16 10 5 21'></polyline></svg>  
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
/*                    Generar codigo unico de presentacion                    */
/* -------------------------------------------------------------------------- */

        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->listar_presentaciones();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('PRES',6,$numero);
            }else{
                return 0;
            }
        }

/* -------------------------------------------------------------------------- */
/*                        Funcioon agregar presentacion                       */
/* -------------------------------------------------------------------------- */

        function agregar_presentacion(){
            if(isset($_POST["nombre"])){
                $nombre = $_POST["nombre"];
                $estado = 1;
                $fotoproducto = "";
                if ($_FILES["file"]['tmp_name']) {
                    $name = $_FILES["file"]['name'];
                    $tmp = $_FILES["file"]['tmp_name'];
                    $info = new SplFileInfo($_FILES["file"]['name']);
                    $extension = $info->getExtension();
                    $fotoproducto = mainModel::generar_codigo_aleatorio('CATEGORIA', 20, rand(0, 9)) . "." . $extension;
                } else {
                    $fotoproducto = "empty_producto.png";
                }
                $codigo = $this->generar_codigo();
                $unidad = $this->model->agregar_presentacion($codigo,$nombre,$estado,$fotoproducto);
                if($unidad){
                    if($unidad->rowCount()>0){
                        if ($_FILES["file"]['tmp_name']) {
                            if (move_uploaded_file($tmp, "archives/assets/categorias/$fotoproducto")) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                        } else {
                            echo 1;
                        }
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }
        function actualizar_imagen(){
            if(isset($_POST["id"])){
                $nombre = $_POST["id"];
                $estado = 1;
                $fotoproducto = "";
                if ($_FILES["file"]['tmp_name']) {
                    $name = $_FILES["file"]['name'];
                    $tmp = $_FILES["file"]['tmp_name'];
                    $info = new SplFileInfo($_FILES["file"]['name']);
                    $extension = $info->getExtension();
                    $fotoproducto = mainModel::generar_codigo_aleatorio('CATEGORIA', 20, rand(0, 9)) . "." . $extension;
                } else {
                    $fotoproducto = "empty_producto.png";
                }
                $codigo = $this->generar_codigo();
                $unidad = $this->model->actualizar_imagen_presentacion($_POST["id"],$fotoproducto);
                if($unidad){
                    if($unidad->rowCount()>0){
                        if ($_FILES["file"]['tmp_name']) {
                            if (move_uploaded_file($tmp, "archives/assets/categorias/$fotoproducto")) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                        } else {
                            echo 1;
                        }
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            }
        }

/* -------------------------------------------------------------------------- */
/*                         Formulario de presentacion                         */
/* -------------------------------------------------------------------------- */

        function form_presentacion(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_presentacion = $this->model->consulta_presentacion($id);
                if($consultar_presentacion){
                    $formulario = "";
                    if($consultar_presentacion->rowCount()>0){
                        foreach($consultar_presentacion as $row){
                            $estado = "";
                            if($row["ESTADO"] == 1){
                                $estado .= "checked";
                            }
                            $formulario .= "
                            <div class='modal-body'>
                                <div class='row'>
                                    <div class='form-group mb-4 col-sm-12'>
                                        <label for='nombre_presentacion'>Presentación</label>
                                        <input type='text' class='form-control' name='nombre_presentacion' id='nombre_presentacion' value='{$row["NOMBRE"]}' placeholder='EJ. CELULARES' required>
                                        <input type='hidden' class='form-control' name='id_presentacion' id='ID_presentacion' value='{$row["ID_PRESENTACION"]}' placeholder='EJ. CELULARES' required>
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
                                <button type='submit' id='save_presentacion' class='btn btn-success'>Guardar</button>
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

        function actualizar_presentacion(){
            if(isset($_POST["id_presentacion"])){
                $id = $_POST["id_presentacion"];
                $nombre = $_POST["nombre_presentacion"];
                $estado = filter_input(INPUT_POST,'estado',FILTER_VALIDATE_BOOLEAN,FILTER_SANITIZE_MAGIC_QUOTES);
                $estado = $estado == 1? 1:0;
                $actualizar_presentacion = $this->model->actualizar_presentacion($id,$nombre,$estado);
                if($actualizar_presentacion){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }