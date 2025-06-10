<?php
class personal extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

/* ========================================================================== */
/*                              Vista de personas                             */
/* ========================================================================== */

    public function personas()
    {
        $this->view->render('personal/persona');
    }

/* ========================================================================== */
/*                           Vista de nueva persona                           */
/* ========================================================================== */

    public function nuevapersonas()
    {
        $this->view->lista_documentos = $this::lista_documentos();
        $this->view->render('personal/nuevapersona');
    }

/* ========================================================================== */
/*                       Lista de documentos disponibles                      */
/* ========================================================================== */

    public function lista_documentos()
    {
        $unidades = $this->model->lista_documentos();
        if ($unidades) {
            $option = "";
            foreach ($unidades as $row) {
                if ($row['ESTADO'] == 0) {
                    $option .= "<option value='{$row['ID_DOCUMENTO']}' disabled>{$row['DOCUMENTO']}</option>";
                } else {
                    $option .= "<option value='{$row['ID_DOCUMENTO']}'>{$row['DOCUMENTO']}</option>";
                }
            }
            return $option;
        }
    }

/* ========================================================================== */
/*                          Generar codigo de persona                         */
/* ========================================================================== */

    public function generar_codigo()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista_personas();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio('PERSONA', 9, $numero);
        } else {
            return 0;
        }
    }

/* ========================================================================== */
/*                           Funcion guardar persona                          */
/* ========================================================================== */

    public function guardarpersona()
    {
       if (isset($_POST["nombre"]) && isset($_POST["apellidos"])) {
            $p_id_persona = $this::generar_codigo();
            $p_nombres = $_POST["nombre"];
            $p_apellidos = $_POST["apellidos"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $tipo_documento = $_POST["tipo_documento"];
            $numero_doc = mainModel::clean_string($_POST["numero_doc"]);
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            $perfil_usuario = "";
            if ($_FILES["file"]['tmp_name']) {
                $tmp = $_FILES["file"]['tmp_name'];
                $info = new SplFileInfo($_FILES["file"]['name']);
                $extension = $info->getExtension();
                $perfil_usuario = mainModel::generar_codigo_aleatorio('PERFIL', 20, rand(0, 9)) . "." . $extension;

            }else{
                $perfil_usuario = "sin_perfil.png";
            }
            $guardar_persona = $this->model->guardar_persona($p_id_persona, $p_nombres, $p_apellidos, $tipo_documento, $numero_doc, $direccion, $telefono, $perfil_usuario, $estado);
            if ($guardar_persona) {
                if ($guardar_persona->rowCount() > 0) {
                    if ($_FILES["file"]['tmp_name']) {
                        if (move_uploaded_file($tmp, "archives/avatars/$perfil_usuario")) {
                            echo 1;
                        } else {
                            echo 0;
                        }
                    } else {
                        echo 1;
                    }
                } else {
                    echo 2;
                }
            } else {
                echo 3;
            }
        }
    }

/* ========================================================================== */
/*                              Lista de personas                             */
/* ========================================================================== */

    public function lista_personas()
    {
        if (isset($_POST["token"])) {
            $personas = $this->model->lista_personas();
            if ($personas) {
                $n = 1;
                $tabla = "";
                foreach ($personas as $rows) {
                    $estado = $rows['ESTADO'];
                    if ($estado == 1) {
                        $estado = "<span class='shadow-none badge badge-success'>Activo</span>";
                    } else {
                        $estado = "<span class='shadow-none badge badge-dark'>Inactivo</span>";
                    }
                    $enlace = SERVERURL;
                    $id_persona = mainModel::encryption($rows["ID_PERSONA"]);
                    $imagen = SERVERURL . "archives/avatars/{$rows["PERFIL"]}";
                    $tabla .= "
                             <tr>
                                <td class='checkbox-column'> $n </td>
                                <td class='>
                                    <a class='profile-img' href='javascript: void(0);'>
                                        <img src='{$imagen}' alt='product' style='width: 50px; border-radius : 10px;'>
                                    </a>
                                </td>
                                <td class='user-name'>{$rows["NOMBRES"]} {$rows["APELLIDOS"]}</td>
                                <td>{$rows["DOCUMENTO"]} {$rows["NUMERO"]}</td>
                                <td>{$rows["DIRECCION"]}</td>
                                <td>{$rows["TELEFONO"]}</td>
                                <td>
                                    <div class='d-flex'>
                                        <div class=' align-self-center d-m-success  mr-1 data-marker'></div>
                                        $estado
                                    </div>
                                </td>
                                <td class='text-center'>
                                <ul class='table-controls'>
                                <li>
                                    <a href='{$enlace}personal/verpersona/{$id_persona}' class='bs-tooltip btn_actualizar'  data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                                    </a>
                                </li>
                                <li>
                                    <a href='#' class='bs-tooltip btn_eliminar' id_persona='{$rows["ID_PERSONA"]}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash p-1 br-6 mb-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg>
                                    </a>
                                </li>
                            </ul>
                                </td>
                            </tr>
                        ";
                    $n++;
                }
                echo $tabla;
            } else {
                echo 0;
            }
        }
    }

/* ========================================================================== */
/*                          Funcion lista de usuarios                         */
/* ========================================================================== */

    public function lista_usuarios()
    {
        if (isset($_POST["token"])) {
            $usuario = $this->model->lista_usuarios();
            if ($usuario) {
                $n = 1;
                $tabla = "";
                foreach ($usuario as $rows) {
                    if ($rows["ID_USUARIO"] != "ADMIN01") {
                        $estado = $rows['ESTADO'];
                        if ($estado == 1) {
                            $estado = "<span class='shadow-none badge badge-success'>Activo</span>";
                        } else {
                            $estado = "<span class='shadow-none badge badge-dark'>Inactivo</span>";
                        }
                        $imagen = SERVERURL . "archives/avatars/{$rows["PERFIL"]}";
                        $tabla .= "
                                 <tr>
                                    <td class='checkbox-column'> $n </td>
                                    <td class='text-center'>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 50px; border-radius : 10px;'>
                                        </a>
                                    </td>
                                    <td class='user-name'>{$rows["NOMBRES"]}</td>
                                    <td class='user-name'> {$rows["APELLIDOS"]}</td>
                                    <td>{$rows["EMAIL"]}</td>
                                    <td>{$rows["FECHA_REGISTRO"]}</td>
                                    <td class='text-center'>
                                        <div class='d-flex'>
                                            <div class=' align-self-center d-m-success  mr-1 data-marker'></div>
                                            $estado
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                    <ul class='table-controls'>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_actualizar' usuario_id='{$rows['ID_USUARIO']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Editar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 p-1 br-6 mb-1'><path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href='javascript:void(0);' class='bs-tooltip btn_eliminar' usuario_id='{$rows['ID_USUARIO']}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Eliminar'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash p-1 br-6 mb-1'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path></svg>
                                            </a>
                                        </li>
                                    </ul>
                                    </td>
                                </tr>
                            ";
                        $n++;
                    }
                }
                echo $tabla;
            } else {
                echo 0;
            }
        }
    }

/* ========================================================================== */
/*                               Vista usuarios                               */
/* ========================================================================== */

    public function usuarios()
    {
        $this->view->personas = $this->lista_personas_option();
        $this->view->render("personal/usuarios");
    }

/* ========================================================================== */
/*                         Lista de persones en option                        */
/* ========================================================================== */

    public function lista_personas_option()
    {
        $personas = $this->model->lista_personas();
        if ($personas) {
            if ($personas->rowCount() > 0) {
                $option = "";
                foreach ($personas as $rows) {
                    if ($rows["ESTADO"] != 0) {
                        $option .= "
                                    <option value='{$rows["ID_PERSONA"]}'>{$rows["NOMBRES"]} {$rows["APELLIDOS"]} | {$rows["DOCUMENTO"]} {$rows["NUMERO"]}</option>
                                ";
                    }
                }
                return $option;
            }
        }
    }
    public function lista_usuario_option()
    {
        $usuarios = $this->model->lista_usuarios();
        if ($usuarios) {
            if ($usuarios->rowCount() > 0) {
                $option = "";
                foreach ($usuarios as $rows) {
                    if ($rows["ESTADO"] != 0 && $rows["ID_USUARIO"] != "ADMIN01") {
                        $option .= "
                                    <option value='{$rows["ID_USUARIO"]}'>{$rows["EMAIL"]} - {$rows["NOMBRES"]} </option>
                                ";
                    }
                }
                return $option;
            }
        }
    }
    public function lista_sucursales_option()
    {
        $sucursales = $this->model->lista_sucursales();
        if ($sucursales) {
            if ($sucursales->rowCount() > 0) {
                $option = "";
               
                foreach ($sucursales as $rows) {
                    if ($rows["ESTADO"] != 0) {
                        $option .= "
                                    <option value='{$rows["ID_SUCURSAL"]}' selected>{$rows["NOMBRE"]}</option>
                                ";
                    }
                }
                return $option;
            }
        }
    }

/* ========================================================================== */
/*                      Funcion generar codigo de usuario                     */
/* ========================================================================== */

    public function generar_codigo_usuario()
    {
        $personas = $this->model->lista_personas();
        if ($personas) {
            $personas = $personas->rowCount();
            return $personas+1;
            // return mainModel::generar_codigo_aleatorio('USUARIO', 9, $personas);
        }
    }

/* ========================================================================== */
/*                           Funcion guardar usuario                          */
/* ========================================================================== */

    public function guardar_usuario()
    {
        if (isset($_POST["persona"]) && isset($_POST["correo"]) && isset($_POST["password"])) {
            $codigo_usuario = $this->generar_codigo_usuario();
            $persona = mainModel::clean_string($_POST["persona"]);
            $correo = $_POST["correo"];
            $password = mainModel::encryption(mainModel::clean_string($_POST["password"]));
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            date_default_timezone_set(ZONEDATE);
            $fecha_registro = date('Y-m-d');
            $guardar_usuario = $this->model->guardar_usuario($codigo_usuario, $correo, $password, $persona, $fecha_registro, $estado);
            if ($guardar_usuario) {
                if ($guardar_usuario->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                           Formulario de personal                           */
/* -------------------------------------------------------------------------- */

    public function form_usuario()
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $consultar_usuario = $this->model->consulta_usuario($id);
            if ($consultar_usuario) {
                $formulario = "";
                if ($consultar_usuario->rowCount() > 0) {
                    foreach ($consultar_usuario as $row) {
                        $estado = "";
                        if ($row["ESTADO"] == 1) {
                            $estado .= "checked";
                        }
                        $name_persona = "";
                        $personas = $this->model->lista_personas();
                        foreach ($personas as $doc) {
                            if ($doc["ID_PERSONA"] === $row["ID_PERSONA"]) {
                                $name_persona .= "{$row["NOMBRES"]} {$row["APELLIDOS"]}";
                            }
                        }
                        $formulario .= "
                                <div class='modal-body'>
                                    <div class='row'>
                                        <div class='form-group mb-4 col-sm-12'>
                                            <label for='nombre'>Persona </label>
                                            <input type='text' value='{$name_persona}' class='form-control' disabled/>
                                        </div>
                                        <div class='form-group mb-4 col-sm-12'>
                                            <label for='nombre'>Correo </label>
                                            <input type='email' class='form-control' id='correo' name='correo' value='{$row["EMAIL"]}' placeholder='correoexample@gmail.com' required>
                                            <input type='hidden' class='form-control' id='id_usuario' name='id_usuario' value='{$row["ID_USUARIO"]}' placeholder='correoexample@gmail.com' required>
                                        </div>
                                        <div class='form-group mb-4 col-sm-12'>
                                            <label for='nombre'>Password </label>
                                            <input type='password' class='form-control' id='password' value='' name='password' placeholder='PASSWORD...'>
                                        </div>
                                        <div class='form-group mb-2 col-sm-12'>
                                            <label for='estado'>Estado</label>
                                        </div>
                                        <div class='form-group mb-4 col-sm-12 d-flex'>
                                            <label class='switch s-icons s-outline s-outline-info  mr-2'>
                                                <input id='estado' name='estado' type='checkbox' name='estado' {$estado}>
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
            } else {
                echo 0;
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                             Actualizar usuario                            */
/* -------------------------------------------------------------------------- */

    public function actualizar_usuario()
    {
        if (isset($_POST["id_usuario"])) {
            $id = $_POST["id_usuario"];
            $correo = $_POST["correo"];
            $password = $_POST["password"];
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            if ($password == "") {
                $actualizar_usuario = $this->model->actualizar_usuario_without_password($id, $correo, $estado);
                if ($actualizar_usuario) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                $password = mainmodel::encryption($_POST["password"]);
                $actualizar_usuario = $this->model->actualizar_usuario_with_password($id, $correo, $password, $estado);
                if ($actualizar_usuario) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }

    public function actualizar_cuenta()
    {
        if (isset($_POST["id_usuario"])) {
            $id = $_POST["id_usuario"];
            $correo = $_POST["correo"];
            $password = $_POST["password"];
            if ($password == "") {
                $actualizar_usuario = $this->model->actualizar_usuario_without_password($id, $correo, 1);
                if ($actualizar_usuario) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                $password = mainmodel::encryption($_POST["password"]);
                $actualizar_usuario = $this->model->actualizar_usuario_with_password($id, $correo, $password, 1);
                if ($actualizar_usuario) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                              Eliminar usuario                              */
/* -------------------------------------------------------------------------- */

    public function eliminar_usuario()
    {
        if (isset($_POST["id"])) {
            $eliminar = $this->model->eliminar_usuario($_POST["id"]);
            if ($eliminar) {
                if ($eliminar->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }

        }
    }

/* -------------------------------------------------------------------------- */
/*                                 Ver Persona                                */
/* -------------------------------------------------------------------------- */

    public function verpersona($param = null)
    {
        if ($param == null) {
            $this->view->render("error/404");
        } else if (!is_string(mainModel::decryption($param[0]))) {
            $this->view->render("error/404");
        } else {
            $this->view->lista_documentos = $this->model->lista_documentos();
            $this->view->parametros_persona = mainModel::parametros_persona(mainModel::decryption($param[0]));
            $this->view->render("personal/editarpersona");
        }
    }

    public function miperfil()
    {
        session_name('B_POS');
        session_start();
        // Validar no existe una sesion
        if (!isset($_SESSION["usuario"])) {
            echo '<script> window.location.href="' . SERVERURL . 'login/" ;</script>';
        }
        $id_persona = $_SESSION["persona"];
        $this->view->lista_documentos = $this->model->lista_documentos();
        $this->view->parametros_persona = mainModel::parametros_persona($id_persona);
        $this->view->render("personal/perfil");

    }
    public function micuenta()
    {
        session_name('B_POS');
        session_start();
        // Validar no existe una sesion
        if (!isset($_SESSION["usuario"])) {
            echo '<script> window.location.href="' . SERVERURL . 'login/" ;</script>';
        }
        $id_persona = $_SESSION["persona"];
        $id_usuario = $_SESSION["usuario"];
        $this->view->personas = $this->lista_personas_option();
        $this->view->parametros_persona = mainModel::parametros_persona($id_persona);
        $this->view->parametros_usuario = mainModel::parametros_usuario($id_usuario);
        $this->view->render("personal/configuracion");

    }

/* -------------------------------------------------------------------------- */
/*                             Actualizar Persona                             */
/* -------------------------------------------------------------------------- */

    public function actualizar_persona()
    {
        if (isset($_POST["nombre"]) && isset($_POST["apellidos"])) {
            $perfil_usuario = "";
            $id_persona = $_POST["id_persona"];
            $nombres = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $tipo_documento = $_POST["tipo_documento"];
            $numero_doc = mainModel::clean_string($_POST["numero_doc"]);
            $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_SANITIZE_MAGIC_QUOTES);
            $estado = $estado == 1 ? 1 : 0;
            if ($_FILES["file"]['tmp_name']) {

                $name = $_FILES["file"]['name'];
                $tmp = $_FILES["file"]['tmp_name'];
                $info = new SplFileInfo($_FILES["file"]['name']);
                $extension = $info->getExtension();
                $perfil_usuario = mainModel::generar_codigo_aleatorio('PERFIL', 20, rand(0, 9)) . "." . $extension;
                if ($_FILES["file"]['tmp_name']) {
                    if (move_uploaded_file($tmp, "archives/avatars/$perfil_usuario")) {
                        $actualizar_persona_con_foto = $this->model->actualizar_persona_with_photo($id_persona, $nombres, $apellidos, $tipo_documento, $numero_doc, $direccion, $telefono, $perfil_usuario, $estado);
                        if ($actualizar_persona_con_foto) {
                            echo 1;
                        } else {
                            echo 0;
                        }
                    } else {
                        echo 2;
                    }
                } else {
                    echo 1;
                }
            } else {
                $actualizar_persona_sin_foto = $this->model->actualizar_persona_without_photo($id_persona, $nombres, $apellidos, $tipo_documento, $numero_doc, $direccion, $telefono, $estado);

                if ($actualizar_persona_sin_foto) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }
    public function actualizar_miperfil()
    {
        if (isset($_POST["nombre"]) && isset($_POST["apellidos"])) {
            $perfil_usuario = "";
            $id_persona = $_POST["id_persona"];
            $nombres = $_POST["nombre"];
            $apellidos = $_POST["apellidos"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $tipo_documento = $_POST["tipo_documento"];
            $numero_doc = mainModel::clean_string($_POST["numero_doc"]);
            $estado = 1;
            if ($_FILES["file"]['tmp_name']) {

                $name = $_FILES["file"]['name'];
                $tmp = $_FILES["file"]['tmp_name'];
                $info = new SplFileInfo($_FILES["file"]['name']);
                $extension = $info->getExtension();
                $perfil_usuario = mainModel::generar_codigo_aleatorio('PERFIL', 20, rand(0, 9)) . "." . $extension;
                if ($_FILES["file"]['tmp_name']) {
                    if (move_uploaded_file($tmp, "archives/avatars/$perfil_usuario")) {
                        $actualizar_persona_con_foto = $this->model->actualizar_persona_with_photo($id_persona, $nombres, $apellidos, $tipo_documento, $numero_doc, $direccion, $telefono, $perfil_usuario, $estado);
                        if ($actualizar_persona_con_foto) {
                            echo 1;
                        } else {
                            echo 0;
                        }
                    } else {
                        echo 2;
                    }
                } else {
                    echo 1;
                }
            } else {
                $actualizar_persona_sin_foto = $this->model->actualizar_persona_without_photo($id_persona, $nombres, $apellidos, $tipo_documento, $numero_doc, $direccion, $telefono, $estado);

                if ($actualizar_persona_sin_foto) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                             Formulario Persona                             */
/* -------------------------------------------------------------------------- */

    public function form_persona()
    {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $consultar_persona = $this->model->consulta_persona($id);
            if ($consultar_persona) {
                $formulario = "";
                if ($consultar_persona->rowCount() > 0) {
                    foreach ($consultar_persona as $row) {
                        $estado = "INACTIVO";
                        if ($row["ESTADO"] == 1) {
                            $estado = "ACTIVO";
                        }
                        $persona = $row["NOMBRES"] . " " . $row["APELLIDOS"];
                        $enlace = SERVERURL;
                        $formulario .= "
                                    <div class='widget-content widget-content-area'>
                                        <div class='d-flex justify-content-between'>
                                            <h3 class=''>Info</h3>
                                            <a class='mt-2 edit-profile'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user'><path d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'></path><circle cx='12' cy='7' r='4'></circle></svg>
                                            </a>
                                        </div>
                                        <div class='text-center user-info'>
                                            <img src='{$enlace}archives/avatars/{$row["PERFIL"]}' alt='Foto referencial del producto' style='width: 40%;'>
                                            <p class=''>{$persona}</p>
                                        </div>
                                        <div class='user-info-list'>
                                            <div class=''>
                                            <div class='row layout-top-spacing justify-content-md-center'>
                                                        <ul class='contacts-block list-unstyled'>
                                                            <li class='contacts-block__item'>
                                                                 <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-credit-card'><rect x='1' y='4' width='22' height='16' rx='2' ry='2'></rect><line x1='1' y1='10' x2='23' y2='10'></line></svg>{$row["DOCUMENTO"]} - {$row["NUMERO"]}
                                                            </li>
                                                            <li class='contacts-block__item'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-map-pin'><path d='M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z'></path><circle cx='12' cy='10' r='3'></circle></svg> {$row["DIRECCION"]}
                                                            </li>
                                                            <li class='contacts-block__item'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-phone'><path d='M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z'></path></svg> {$row["TELEFONO"]}
                                                            </li>
                                                            <li class='contacts-block__item'>
                                                                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-power'><path d='M18.36 6.64a9 9 0 1 1-12.73 0'></path><line x1='12' y1='2' x2='12' y2='12'></line></svg>{$estado}
                                                            </li>
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    ";
                    }
                    echo $formulario;
                }
            } else {
                echo 0;
            }
        }
    }

/* -------------------------------------------------------------------------- */
/*                              Eliminar Persona                              */
/* -------------------------------------------------------------------------- */

    public function eliminar_persona()
    {
        if (isset($_POST["id"])) {
            $eliminar = $this->model->eliminar_persona($_POST["id"]);
            if ($eliminar) {
                if ($eliminar->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }

        }
    }
    public function historial()
    {
        $this->view->render('personal/historial');
    }
    public function bitacora_de_sesiones()
    {
        if (isset($_POST["sucursal"])) {
            $lista_bitacora = $this->model->lista_bitacora($_POST["sucursal"]);
            if ($lista_bitacora) {
                $table = "";
                foreach ($lista_bitacora as $l) {
                    $table .= "<tr>
                        <td style='font-weight: 900;color: #1b55e2;'>{$l["FECHA"]}</td>
                        <td style='font-weight: 900;color: #8dbf42;'>{$l["PERSONA"]}</td>
                        <td style='font-weight: 900;color: #000;'>{$l["EMAIL"]}</td>
                        <td style='font-weight: 900;color: #e2a03f;'>{$l["SUCURSAL"]}</td>
                        <td style='font-weight: 900;color: #000;'>{$l["IP_PC"]}</td>
                        <td style='font-weight: 900;color: #1b55e2;'>{$l["NAVEGADOR"]}</td>
                    </tr>";
                }
                echo $table;
            }
        }
    }
    public function bitacora_fechas()
    {
        if (isset($_POST["sucursal"])) {
            date_default_timezone_set(ZONEDATE);
            $date_1 = date($_POST["fecha_1"]);
            $date_2 = date($_POST["fecha_2"]);
            $lista_bitacora = $this->model->lista_bitacora($_POST["sucursal"]);
            if ($lista_bitacora) {
                $table = "";
                foreach ($lista_bitacora as $l) {
                    $fecha = date("Y-m-d", strtotime($l["FECHA"]));
                    if ($fecha >= $date_1 && $fecha <= $date_2) {
                        $table .= "<tr>
                            <td style='font-weight: 900;color: #1b55e2;'>{$l["FECHA"]}</td>
                            <td style='font-weight: 900;color: #8dbf42;'>{$l["PERSONA"]}</td>
                            <td style='font-weight: 900;color: #000;'>{$l["EMAIL"]}</td>
                            <td style='font-weight: 900;color: #e2a03f;'>{$l["SUCURSAL"]}</td>
                            <td style='font-weight: 900;color: #000;'>{$l["IP_PC"]}</td>
                            <td style='font-weight: 900;color: #1b55e2;'>{$l["NAVEGADOR"]}</td>
                        </tr>";
                    }
                }
                echo $table;
            }
        }
    }
    public function usuariosxsucursal(){
        $this->view->lista_usuario = $this->lista_usuario_option();
        $this->view->lista_sucursal = $this->lista_sucursales_option();
        $this->view->render("personal/usuarioxsucursal");
    }
    public function agregarusuarioasucursal(){
        if(isset($_POST["usuario"])){
            $agregar = $this->model->agregar_usuario_sucursal($_POST["usuario"],$_POST["sucursal"]);
            if($agregar){
                if($agregar->rowCount()>0){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }
    function lista_usuarios_sucursal(){
        if(isset($_POST["token"])){
            $usuario = $this->model->lista_usuarios_sucursales();
            if ($usuario) {
                $n = 1;
                $tabla = "";
                foreach ($usuario as $rows) {
                    if ($rows["ID_USUARIO"] != "ADMIN01") {
                        $estado = $rows['ESTADO'];
                        if ($estado == 1) {
                            $estado = "<button class='shadow-none badge badge-success btn_estado' id_user='{$rows["ID_PERMISO"]}' estado='0'>Activo</button>";
                        } else {
                            $estado = "<button class='shadow-none badge badge-dark btn_estado' id_user='{$rows["ID_PERMISO"]}' estado='1'>Inactivo</button>";
                        }
                        $imagen = SERVERURL . "archives/avatars/{$rows["PERFIL"]}";
                        $logo = SERVERURL . "archives/assets/sucursales/{$rows["LOGO"]}";
                        $tabla .= "
                                 <tr>
                                    <td class='checkbox-column'> $n </td>
                                    <td class='text-center'>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$imagen}' alt='product' style='width: 50px; border-radius : 10px;'>
                                        </a>
                                    </td>
                                    <td class='user-name'>{$rows["NOMBRES"]}</td>
                                    <td class='user-name'> {$rows["APELLIDOS"]}</td>
                                    <td>{$rows["EMAIL"]}</td>
                                    <td>{$rows["SUCURSAL"]}</td>
                                    <td>
                                        <a class='profile-img' href='javascript: void(0);'>
                                            <img src='{$logo}' alt='product' style='width: 50px; border-radius : 10px;'>
                                        </a>
                                    </td>
                                    <td class='text-center'>
                                        <div class='d-flex'>
                                            <div class=' align-self-center d-m-success  mr-1 data-marker'></div>
                                            $estado
                                        </div>
                                    </td>
                                    <td class='text-center'>
                                        <button class='btn btn-primary btn_detalle' id_user='{$rows["ID_PERMISO"]}'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-list'><line x1='8' y1='6' x2='21' y2='6'></line><line x1='8' y1='12' x2='21' y2='12'></line><line x1='8' y1='18' x2='21' y2='18'></line><line x1='3' y1='6' x2='3.01' y2='6'></line><line x1='3' y1='12' x2='3.01' y2='12'></line><line x1='3' y1='18' x2='3.01' y2='18'></line></svg>
                                        </button>
                                    </td>
                                </tr>
                            ";
                        $n++;
                    }
                }
                echo $tabla;
            } else {
            }
        }
    }
    function cambiar_estado_acceso(){
        if(isset($_POST["id_user"])){
            $cambiar = $this->model->cambiar_estado_acceso($_POST["id_user"],$_POST["estado"]);
            if($cambiar){
                if($cambiar->rowCount()>0){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }
    function cambiar_estado_tabla(){
        if(isset($_POST["tabla"])){
            $cambiar_estado = $this->model->cambiar_estado_tabla($_POST["tabla"],$_POST["id_permiso"],$_POST["estado"]);
            if($cambiar_estado){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    function modulos_permisos(){
        if(isset($_POST["id_user"])){
            $permiso = $this->model->usuarios_sucursal($_POST["id_user"]);
            if($permiso){
                if($permiso->rowCount()>0){
                    $table = "";
                    foreach($permiso as $p){
                        $DASHBOARD = $p["DASHBOARD"] == 1 ? "checked ":" ";
                        $POS = $p["POS"] == 1 ? "checked":"";
                        $CONFIGURACION = $p["CONFIGURACION"] == 1 ? "checked":"";
                        $SUCURSALES = $p["SUCURSALES"] == 1 ? "checked":"";
                        $DOCUMENTOS = $p["DOCUMENTOS"] == 1 ? "checked":"";
                        $COMPROBANTES = $p["COMPROBANTES"] == 1 ? "checked":"";
                        $PERSONAL = $p["PERSONAL"] == 1 ? "checked":"";
                        $PRODUCTOS = $p["PRODUCTOS"] == 1 ? "checked":"";
                        $PRESENTACION = $p["PRESENTACION"] == 1 ? "checked":"";
                        $UNIDAD_MEDIDA = $p["UNIDAD_MEDIDA"] == 1 ? "checked":"";
                        $LINEAS = $p["LINEAS"] == 1 ? "checked":"";
                        $PERCEDEROS = $p["PERCEDEROS"] == 1 ? "checked":"";
                        $ALMACEN = $p["ALMACEN"] == 1 ? "checked":"";
                        $PROVEEDORES = $p["PROVEEDORES"] == 1 ? "checked":"";
                        $COMPRAS = $p["COMPRAS"] == 1 ? "checked":"";
                        $CONSULTA_COMPRAS = $p["CONSULTA_COMPRAS"] == 1 ? "checked":"";
                        $HISTORICO_PRECIOS = $p["HISTORICO_PRECIOS"] == 1 ? "checked":"";
                        $CUENTAS_PAGAR = $p["CUENTAS_PAGAR"] == 1 ? "checked":"";
                        $REPORTE_COMPRAS = $p["REPORTE_COMPRAS"] == 1 ? "checked":"";
                        $CREDITOS = $p["CREDITOS"] == 1 ? "checked":"";
                        $PAGAR_CREDITOS = $p["PAGAR_CREDITOS"] == 1 ? "checked":"";
                        $CONSULTA_PAGOS = $p["CONSULTA_PAGOS"] == 1 ? "checked":"";
                        $ASIGNACION_CAJA = $p["ASIGNACION_CAJA"] == 1 ? "checked":"";
                        $ARQUEOS_CAJA = $p["ARQUEOS_CAJA"] == 1 ? "checked":"";
                        $MOVIMIENTOS_CAJA = $p["MOVIMIENTOS_CAJA"] == 1 ? "checked":"";
                        $REPORTE_CAJA = $p["REPORTE_CAJA"] == 1 ? "checked":"";
                        $COTIZACION = $p["COTIZACION"] == 1 ? "checked":"";
                        $CONSULTA_COTIZACION = $p["CONSULTA_COTIZACION"] == 1 ? "checked":"";
                        $REPORTE_COTIZACION = $p["REPORTE_COTIZACION"] == 1 ? "checked":"";
                        $PREVENTA = $p["PREVENTA"] == 1 ? "checked":"";
                        $CONSULTA_PREVENTA = $p["CONSULTA_PREVENTA"] == 1 ? "checked":"";
                        $REPORTE_PREVENTA = $p["REPORTE_PREVENTA"] == 1 ? "checked":"";
                        $VENTA = $p["VENTA"] == 1 ? "checked":"";
                        $CLIENTE = $p["CLIENTE"] == 1 ? "checked":"";
                        $CONSULTA_VENTA = $p["CONSULTA_VENTA"] == 1 ? "checked":"";
                        $CUENTAS_COBRAR = $p["CUENTAS_COBRAR"] == 1 ? "checked":"";
                        $REPORTE_VENTAS = $p["REPORTE_VENTAS"] == 1 ? "checked":"";
                        $CREDITOS_VENTAS = $p["CREDITOS_VENTAS"] == 1 ? "checked":"";
                        $PAGOS_PENDIENTES = $p["PAGOS_PENDIENTES"] == 1 ? "checked":"";
                        $ABONAR_CREDITOS = $p["ABONAR_CREDITOS"] == 1 ? "checked":"";
                        $CONSULTA_ABONO = $p["CONSULTA_ABONO"] == 1 ? "checked":"";
                        $INVENTARTIO_GENERAL = $p["INVENTARTIO_GENERAL"] == 1 ? "checked":"";
                        $CONSULTA_PRODUCTOS = $p["CONSULTA_PRODUCTOS"] == 1 ? "checked":"";
                        $NUEVO_TRASPASO = $p["NUEVO_TRASPASO"] == 1 ? "checked":"";
                        $AJUSTE_INVENTARIO = $p["AJUSTE_INVENTARIO"] == 1 ? "checked":"";
                        $CONSULTA_TRASPASO = $p["CONSULTA_TRASPASO"] == 1 ? "checked":"";
                        $CONSULTA_AJUSTES = $p["CONSULTA_AJUSTES"] == 1 ? "checked":"";
                        $KARDEX_PRODUCTOS = $p["KARDEX_PRODUCTOS"] == 1 ? "checked":"";
                        $KARDEX_VALORIZADO = $p["KARDEX_VALORIZADO"] == 1 ? "checked":"";
                        $KARDEX_GENERAL = $p["KARDEX_GENERAL"] == 1 ? "checked":"";
                        $K_VALO_FECHA = $p["K_VALO_FECHA"] == 1 ? "checked":"";
                        $FACTURA = $p["FACTURA"] == 1 ? "checked":"";
                        $TIENDA = $p["TIENDA"] == 1 ? "checked":"";
                        $PEDIDO_TRASPASO = $p["PEDIDO_TRASPASO"] == 1 ? "checked":"";
                        $PEDIDO_TRASPASO_LISTA = $p["PEDIDO_TRASPASO_LISTA"] == 1 ? "checked":"";
                        $PEDIDO_TRASPASO_PENDIENTES = $p["PEDIDO_TRASPASO_PENDIENTES"] == 1 ? "checked":"";
                        $table .= "
                        <table class='table table-bordered table-striped mb-4'>
                            <tbody>
                                <!-- Modulo Dashboard -->
                                <tr class='table-default'>               
                                    <td >
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-primary'>
                                            <input type='checkbox' class='new-control-input' {$DASHBOARD} tabla='DASHBOARD' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Dashboard
                                            </label>
                                        </div>
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <!-- Modulo POS -->
                                <tr class='table-default'>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-primary'>
                                            <input type='checkbox' class='new-control-input' {$POS} tabla='POS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> POS
                                            </label>
                                        </div>
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <!-- Modulo Administracion -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                             Administración
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_administracion' {$CONFIGURACION} tabla='CONFIGURACION' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Configuración
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_administracion' {$SUCURSALES} tabla='SUCURSALES' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Sucursal
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_administracion' {$DOCUMENTOS} tabla='DOCUMENTOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Documento
                                            </label>
                                        </div>
                                    </td>

                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_administracion' {$COMPROBANTES} tabla='COMPROBANTES' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Comprobantes
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_administracion' {$PERSONAL} tabla='PERSONAL' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Personal
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modulo Producto -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                            Producto
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_producto' {$PRODUCTOS} tabla='PRODUCTOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Productos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_producto' {$PRESENTACION} tabla='PRESENTACION' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Presentación
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_producto' {$UNIDAD_MEDIDA} tabla='UNIDAD_MEDIDA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Unidad de Medida
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_producto' {$LINEAS} tabla='LINEAS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Lineas
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_producto' {$PERCEDEROS} tabla='PERCEDEROS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Perecederos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_producto' {$ALMACEN} tabla='ALMACEN' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Almacén
                                            </label>
                                        </div>
                                    </td>
                                    <td colspan='4'></td>
                                </tr>
                                <!-- Modulo Compras -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                            Compras
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$PROVEEDORES} tabla='PROVEEDORES' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Proveedores
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$COMPRAS} tabla='COMPRAS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Compras
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$CONSULTA_COMPRAS} tabla='CONSULTA_COMPRAS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta Compras
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$HISTORICO_PRECIOS} tabla='HISTORICO_PRECIOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Historico de Precios
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$CUENTAS_PAGAR} tabla='CUENTAS_PAGAR' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Cuentas por pagar
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$REPORTE_COMPRAS} tabla='REPORTE_COMPRAS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Reporte de Compras
                                            </label>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$CREDITOS} tabla='CREDITOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Creditos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$PAGAR_CREDITOS} tabla='PAGAR_CREDITOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Pagar Creditos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_compras' {$CONSULTA_PAGOS} tabla='CONSULTA_PAGOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span>Consultar de Pagos
                                            </label>
                                        </div>
                                    </td>
                                    <td colspan='5'></td>
                                </tr>
                                <!-- Modulo Caja -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                             Caja
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_caja' {$ASIGNACION_CAJA} tabla='ASIGNACION_CAJA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Asignación de cajas
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_caja' {$ARQUEOS_CAJA} tabla='ARQUEOS_CAJA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Arqueos de cajas
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_caja' {$MOVIMIENTOS_CAJA} tabla='MOVIMIENTOS_CAJA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Movimientos de cajas
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_caja' {$REPORTE_CAJA} tabla='REPORTE_CAJA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Reporte de cajas
                                            </label>
                                        </div>
                                    </td>
                                <td colspan='4'></td>
                                    
                                </tr>
                                <!-- Modulo Cotizacion -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                Cotización
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_cotizacion' {$COTIZACION} tabla='COTIZACION' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Cotización
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_cotizacion' {$CONSULTA_COTIZACION} tabla='CONSULTA_COTIZACION' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta de Cotización
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_cotizacion' {$REPORTE_COTIZACION} tabla='REPORTE_COTIZACION' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Reporte de Cotizaciones
                                            </label>
                                        </div>
                                    </td>
                                <td colspan='5'></td>
                                    
                                </tr>
                                <!-- Modulo Preventa -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                Preventa
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_preventa' {$PREVENTA} tabla='PREVENTA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Preventa
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_preventa' {$CONSULTA_PREVENTA} tabla='CONSULTA_PREVENTA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta de Preventa
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_preventa' {$REPORTE_PREVENTA} tabla='REPORTE_PREVENTA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Reporte de Preventa
                                            </label>
                                        </div>
                                    </td>
                                <td colspan='5'></td>
                                    
                                </tr>
                                <!-- Modulo Venta -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                Venta
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$VENTA} tabla='VENTA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Nueva venta
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$CLIENTE} tabla='CLIENTE' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Clientes
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$CONSULTA_VENTA} tabla='CONSULTA_VENTA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta ventas
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$CUENTAS_COBRAR} tabla='CUENTAS_COBRAR' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Cuentas por cobrar
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$REPORTE_VENTAS} tabla='REPORTE_VENTAS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Reporte de ventas
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$CREDITOS_VENTAS} tabla='CREDITOS_VENTAS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Creditos
                                            </label>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$ABONAR_CREDITOS} tabla='ABONAR_CREDITOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Abonar Credito
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$CONSULTA_ABONO} tabla='CONSULTA_ABONO' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta de abonos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_venta'  {$PAGOS_PENDIENTES} tabla='PAGOS_PENDIENTES' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Pagos pendientes
                                            </label>
                                        </div>
                                    </td>
                                    <td colspan='4'></td>
                                </tr>
                                <!-- Modulo Inventario -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                Inventario
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$INVENTARTIO_GENERAL} tabla='INVENTARTIO_GENERAL' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Inventario General
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$CONSULTA_PRODUCTOS} tabla='CONSULTA_PRODUCTOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta de productos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$NUEVO_TRASPASO} tabla='NUEVO_TRASPASO' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Nuevo traspaso
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$AJUSTE_INVENTARIO} tabla='AJUSTE_INVENTARIO' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Ajuste de inventario
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$CONSULTA_TRASPASO} tabla='CONSULTA_TRASPASO' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta de traspasos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$CONSULTA_AJUSTES} tabla='CONSULTA_AJUSTES' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Consulta de ajustes
                                            </label>
                                        </div>
                                    </td>
                                    
                                </tr>
                                  <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$PEDIDO_TRASPASO} tabla='PEDIDO_TRASPASO' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Nuevo Pedidos Traspaso
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$PEDIDO_TRASPASO_LISTA} tabla='PEDIDO_TRASPASO_LISTA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Pedidos Traspasos 
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_inventario'  {$PEDIDO_TRASPASO_PENDIENTES} tabla='PEDIDO_TRASPASO_PENDIENTES' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Pedidos Traspasos Pendientes
                                            </label>
                                        </div>
                                    </td>
                                   
                                    
                                </tr>
                                <!-- Modulo Kardex -->
                                <tr class='table-default'>
                                    <td class='text-primary' style='
                                    font-weight: 800;
                                '>
                                Kardex
                                    </td>
                                    <td colspan='7'></td>
                                </tr>
                                <tr >
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_kardex' {$KARDEX_PRODUCTOS} tabla='KARDEX_PRODUCTOS' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Kardex de productos
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_kardex' {$KARDEX_VALORIZADO} tabla='KARDEX_VALORIZADO' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Kardex valorizado
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_kardex' {$KARDEX_GENERAL} tabla='KARDEX_GENERAL' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Kardex general
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_kardex' {$K_VALO_FECHA} tabla='K_VALO_FECHA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> Kardex Val. x fecha
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_kardex' {$FACTURA} tabla='FACTURA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span> FACTURA
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='n-chk'>
                                            <label class='new-control new-checkbox checkbox-dark'>
                                            <input type='checkbox' class='new-control-input ch_kardex' {$TIENDA} tabla='TIENDA' id_permiso='{$p["ID_PERMISO"]}'>
                                            <span class='new-control-indicator'></span>TIENDA
                                            </label>
                                        </div>
                                    </td>
                                    <td colspan='3'></td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                        "; 
                    }
                    echo $table;
                }else{
                    echo 0;
                }
            }
        }
    }
}
