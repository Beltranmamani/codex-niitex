<?php
    class documentoModel extends mainModel{

/* -------------------------------------------------------------------------- */
/*                              Listas Documento                              */
/* -------------------------------------------------------------------------- */

        function listar_documentos(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_documento");
            return $unidades;
        }

/* -------------------------------------------------------------------------- */
/*                              Agregar Documento                             */
/* -------------------------------------------------------------------------- */

        function agregar_documento($codigo,$documento,$estado){
            $conexion = mainModel::conectar();
            $documento = $conexion->query("INSERT INTO `documento`(`ID_DOCUMENTO`, `DOCUMENTO`, `ESTADO`) VALUES('$codigo','$documento', '$estado')");
            return $documento;
        }

/* -------------------------------------------------------------------------- */
/*                             Consulta Documento                             */
/* -------------------------------------------------------------------------- */

        function consulta_documento($id){
            $conexion = mainModel::conectar();
            $documento = $conexion->query(" SELECT * FROM `vista_documento` WHERE `ID_DOCUMENTO` ='$id'");
            return $documento;
        }

/* -------------------------------------------------------------------------- */
/*                            Actualizar Documento                            */
/* -------------------------------------------------------------------------- */

        function actualizar_documento($p_id_documento,$p_documento,$p_estado){
            $conexion = mainModel::conectar();
            $documento = $conexion->query("UPDATE `documento` SET `documento`= '$p_documento',`ESTADO`= '$p_estado' WHERE `ID_DOCUMENTO`= '$p_id_documento'");
            return $documento;
        }
    }