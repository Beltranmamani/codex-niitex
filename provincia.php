<?php
    class provincia extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $this->view->lista_departamento = $this::lista_departamento();
            $this->view->render('provincia/index');
        }

       
    public function lista_departamento()
    {
        $usuario = $this->model->lista_departamento();
        if ($usuario) {
            $option = "";
            foreach ($usuario as $rows) {
                $option .= "<option value='{$rows["ID_DEPARTAMENTO"]}' >{$rows["DEPARTAMENTO"]}</option>";
            }
            return $option;
        }
    }

        function listar_provincia(){
            if(isset($_POST["token"])){
                $unidades = $this->model->listar_provincia();
                if($unidades){
                    $n = 1;
                    $tabla = "";
                    foreach($unidades as $rows){
                        $tabla .="
                            <tr>
                                <td class='checkbox-column'> {$n} </td>
                            
                                <td>{$rows["PROVINCIA"]}</td>
                                <td>{$rows["PRECIO"]}</td>
                                <td>{$rows["DEPARTAMENTO"]}</td>
                                <td class='text-center'>
                                    <button class='btn btn-primary mb-2 mr-2 rounded-circle btn_actualizar' value='{$rows['ID_PROVINCIA']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'>
                                            <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path>
                                        </svg>
                                    </button>

                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$rows['ID_PROVINCIA']}' >
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
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
            $numero = $this->model->listar_provincia();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('PROVINCIA',6,$numero);
            }else{
                return 0;
            }
        }

        public function agregar_provincia(){
        if (isset($_POST["provincia"]) ) {
            $p_id_provincia = $this::generar_codigo();
            $p_provincia = $_POST["provincia"];
            $p_precio = $_POST["precio"];
            $id_departamento = $_POST["departamento"];
            $provincia = $this->model->agregar_provincia($p_id_provincia,$p_provincia,$p_precio,$id_departamento);
            if($provincia){
                if($provincia->rowCount()>0){
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

        function form_provincia(){
            if(isset($_POST["id"])){    
                $id = $_POST["id"];
                $consultar_provincia = $this->model->consulta_provincia($id);
                if($consultar_provincia){
                    $formulario = "";
                    if($consultar_provincia->rowCount()>0){
                        foreach($consultar_provincia as $row){
                            $lista_departamento = "";
                            $departamento = $this->model->lista_departamento();
                            foreach($departamento as $doc){
                                if($doc["ID_DEPARTAMENTO"] === $row["ID_DEPARTAMENTO"]){
                                    $lista_departamento .= "
                                        <option value='{$doc['ID_DEPARTAMENTO']}' selected='true'>{$doc['DEPARTAMENTO']}</option>
                                    ";
                                }else{
                                    $lista_departamento .= "
                                        <option value='{$doc['ID_DEPARTAMENTO']}'>{$doc['DEPARTAMENTO']}</option>
                                    ";
                                }
                            }
                            $formulario .= "
                    
                    <div class='modal-body'>
                        <div class='row'>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='nombre'>Departamento </label>
                                <select id='id_departamento' name='id_departamento' class='form-control'>
                                {$lista_departamento} 
                                </select>
                            </div>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='numero_caja'>Provincia </label>
                                <input type='text' class='form-control' id='provincia' name='provincia' value='{$row["PROVINCIA"]}'  placeholder='Ingrese Provincia'>
                                <input type='hidden' class='form-control' id='id_provincia' name='id_provincia' value='{$row["ID_PROVINCIA"]}'  placeholder='Ingrese Provincia'>
                            </div>
                            <div class='form-group mb-4 col-sm-12'>
                                <label for='nombre_caja'>Tarifa de envio </label>
                                <input type='text' class='form-control' id='precio' name='precio' value='{$row["PRECIO"]}' placeholder='Ingrese Precio'>
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
/*                            Actualizar documento                            */
/* -------------------------------------------------------------------------- */

        function actualizar_provincia(){
            if(isset($_POST["id_provincia"])){
                $id_provincia = $_POST["id_provincia"];
                $provincia = $_POST["provincia"];
                $precio = $_POST["precio"];
                $id_departamento= $_POST["id_departamento"];
                $actualizar_provincia = $this->model->actualizar_provincia($id_provincia,$provincia,$precio,$id_departamento);
                if($actualizar_provincia){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

        function eliminar_provincia(){
            if(isset($_POST["id"])){
                $eliminar = $this->model->eliminar_provincia($_POST["id"]);
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