<?php
    class chatModel extends mainModel{

/* ========================================================================== */
/*                              Lista de usuarios                             */
/* ========================================================================== */

        function lista_usuarios(){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT * FROM vista_usuarios");
            return $usuarios;
        }

        function vista_chat(){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT * FROM vista_chat");
            return $usuarios;
        }
        function agregar_mensaje($p_id_mensaje ,$p_id_me ,$p_id_you ,$p_fecha_registro ,$p_mensaje ){
            $conexion = mainModel::conectar();
            $chat = $conexion->query("INSERT INTO `chat`(`ID_MENSAJE`, `ID_ME`, `ID_YOU`, `FECHA_REGISTRO`, `MENSAJE`) VALUES('$p_id_mensaje' ,'$p_id_me' ,'$p_id_you' ,'$p_fecha_registro' ,'$p_mensaje' )");
            return $chat;
        }
        function buscar_mensajes($p_id_me ,$p_id_you){
            $conexion = mainModel::conectar();
            $chat = $conexion->query(" SELECT * FROM `vista_chat` WHERE (`ID_ME` = '$p_id_me' AND `ID_YOU` = '$p_id_you') OR (`ID_ME` = '$p_id_you' AND `ID_YOU` = '$p_id_me') ORDER BY `FECHA_REGISTRO` ASC");
            return $chat;
        }
    }