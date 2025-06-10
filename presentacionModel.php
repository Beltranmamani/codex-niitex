<?php
    class presentacionModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                            Listar_Presentaciones                           */
/* -------------------------------------------------------------------------- */

        function listar_presentaciones(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM presentacion ");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                            agregar_presentacion                            */
/* -------------------------------------------------------------------------- */

        function agregar_presentacion($codigo,$presentacion,$estado,$foto){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("INSERT INTO `presentacion`(`ID_PRESENTACION`, `NOMBRE`, `ESTADO`,  `FOTO`) VALUES('$codigo','$presentacion','$estado','$foto')");
            return $presentacion;
        }

/* -------------------------------------------------------------------------- */
/*                            Consulta_Presentacion                           */
/* -------------------------------------------------------------------------- */

        function consulta_presentacion($id){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("SELECT * FROM `vista_presentacion` WHERE `ID_PRESENTACION` = '$id'");
            return $presentacion;
        }

/* -------------------------------------------------------------------------- */
/*                           Actualizar_Presentacion                          */
/* -------------------------------------------------------------------------- */

        function actualizar_presentacion($p_id_presentacion,$p_nombre,$p_estado){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("UPDATE `presentacion` SET `NOMBRE`= '$p_nombre'  ,`ESTADO`= '$p_estado' WHERE `ID_PRESENTACION`= '$p_id_presentacion' ");
            return $presentacion;
        }
        function actualizar_imagen_presentacion($id,$foto){
            $conexion = mainModel::conectar();
            $presentacion = $conexion->query("UPDATE `presentacion` SET `FOTO`= '$foto' WHERE `ID_PRESENTACION`='$id'
            ");
            return $presentacion;
        }
        
    }