<?php
class promociones extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /* ========================================================================== */
    /*                               Vista principal                              */
    /* ========================================================================== */

    function render()
    {
        $this->view->render('promociones/index');
    }

    /* ========================================================================== */
    /*                   Funcion para generar codigo de producto                  */
    /* ========================================================================== */

    function generar_codigo()
    {
        $cn = mainModel::conectar();
        $numero = $this->model->lista();
        if ($numero) {
            $numero = $numero->rowCount();
            return $numero+1;
            // return mainModel::generar_codigo_aleatorio('PROMO', 6, $numero);
        } else {
            return 0;
        }
    }




    function guardarpromo()
    {

        $fotoproducto = "";
        if ($_FILES["file"]['tmp_name']) {
            $name = $_FILES["file"]['name'];
            $tmp = $_FILES["file"]['tmp_name'];
            $info = new SplFileInfo($_FILES["file"]['name']);
            $extension = $info->getExtension();
            $fotoproducto = mainModel::generar_codigo_aleatorio('PROMO', 20, rand(0, 9)) . "." . $extension;
        } else {
            $fotoproducto = "empty_producto.png";
        }
        $codigo =  $this::generar_codigo();
        $agregar_producto = $this->model->agregar_promo($codigo, $fotoproducto);
        if ($agregar_producto) {
            if ($agregar_producto->rowCount() > 0) {
                if ($_FILES["file"]['tmp_name']) {
                    if (move_uploaded_file($tmp, "archives/assets/promociones/$fotoproducto")) {
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
    function listar(){
        if(isset($_POST["id"])){
            $lista = $this->model->lista();
            if($lista){
                $n = 1;
                $tabla = "";
                foreach ($lista as $rows) {
                    $imagen = SERVERURL . "archives/assets/promociones/{$rows["IMAGEN"]}";
                    $id_producto = mainModel::encryption($rows["ID"]);
                    $tabla .= "
                             <tr>
                                <td class='checkbox-column'> $n </td>
                                
                                <td class=''>
                                    <a class='profile-img' href='javascript: void(0);'>
                                    <img src='{$imagen}' alt='product' style='width: 80px;'>
                                    </a>
                                </td>
                                <td>
                                    <button class='btn btn-danger mb-2 mr-2 rounded-circle btn_eliminar' value='{$rows['ID']}' img='{$rows['IMAGEN']}'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>
                                    </button>
                                </td>
                            </tr>
                        ";
                    $n++;
                }
                echo $tabla;
            }
        }
    }
    function eliminar_imagen(){
        if(isset($_POST["img"])){
            $filename = "archives/assets/promociones/{$_POST['img']}";
            if(file_exists($filename)){
               $eliminar = unlink($filename);
                if($eliminar){
                    $eliminar_img = $this->model->eliminar_imagen($_POST["id"]);
                    if($eliminar_img){
                        echo 1;
                    }
                }
            }else{
                echo 0;
            }
        }
    }
}
