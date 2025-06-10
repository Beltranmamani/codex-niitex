<?php
    class provinciaModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                              Listas Documento                              */
/* -------------------------------------------------------------------------- */
function lista_departamento(){
    $conexion = mainModel::conectar();
    $usuarios = $conexion->query("SELECT * FROM departamento");
    return $usuarios;
}


        function listar_provincia(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT p.*,d.DEPARTAMENTO FROM provincia as p INNER JOIN departamento as d ON d.ID_DEPARTAMENTO = p.ID_DEPARTAMENTO");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                              Agregar Documento                             */
/* -------------------------------------------------------------------------- */

        function agregar_provincia($p_id_provincia,$p_provincia,$p_precio,$id_departamento){
            $conexion = mainModel::conectar();
            $provincia = $conexion->query(" INSERT INTO `provincia`(`ID_PROVINCIA`, `PROVINCIA`, `PRECIO`, `ID_DEPARTAMENTO`) VALUES ('$p_id_provincia','$p_provincia','$p_precio','$id_departamento')");
            return $provincia;
        }

/* -------------------------------------------------------------------------- */
/*                             Consulta Documento                             */
/* -------------------------------------------------------------------------- */

        function consulta_provincia($id){
            $conexion = mainModel::conectar();
            $provincia = $conexion->query("SELECT * FROM `provincia` WHERE `ID_PROVINCIA` ='$id'");
            return $provincia;
        }

/* -------------------------------------------------------------------------- */
/*                            Actualizar Documento                            */
/* -------------------------------------------------------------------------- */

        function actualizar_provincia($p_id_provincia,$p_provincia,$p_precio,$id_departamento){
            $conexion = mainModel::conectar();
            $provincia = $conexion->query("UPDATE `provincia` SET `PROVINCIA`= '$p_provincia',`PRECIO`= '$p_precio',`ID_DEPARTAMENTO`= '$id_departamento' WHERE `ID_PROVINCIA`= '$p_id_provincia'");
            return $provincia;
        }

        
        function eliminar_provincia($p_id_provincia){
            $conexion = mainModel::conectar();
            $provincia = $conexion->query(" DELETE FROM `provincia` WHERE `ID_PROVINCIA` = '$p_id_provincia'");
            return $provincia;
        }
    }