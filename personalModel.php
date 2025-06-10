<?php
    class personalModel extends mainModel{

/* ========================================================================== */
/*                             Lista de documentos                            */
/* ========================================================================== */

        function lista_documentos(){
            $conexion = mainModel::conectar();
            $documentos = $conexion->query("SELECT * FROM vista_documento");
            return $documentos;
        }

/* ========================================================================== */
/*                              Lista de usuarios                             */
/* ========================================================================== */

        function lista_usuarios(){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT * FROM vista_usuarios");
            return $usuarios;
        }
        function lista_sucursales(){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("SELECT * FROM vista_sucursales");
            return $sucursal;
        }
        function lista_bitacora($sucursal){
            $conexion = mainModel::conectar();
            $bitacora = $conexion->query("SELECT bi.*,u.EMAIL,CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'PERSONA',su.NOMBRE as 'SUCURSAL' FROM bitacora as bi INNER JOIN usuario as u ON bi.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = bi.ID_SUCURSAL WHERE su.ID_SUCURSAL = '$sucursal'");
            return $bitacora;
        }

/* ========================================================================== */
/*                              Lista de personas                             */
/* ========================================================================== */

        function lista_personas(){
            $conexion = mainModel::conectar();
            $personas = $conexion->query("SELECT * FROM vista_personas");
            return $personas;
        }

/* ========================================================================== */
/*                          Funcion guaradar persona                          */
/* ========================================================================== */

        function guardar_persona($p_id_persona,$p_nombres,$p_apellidos,$p_id_documento,$p_numero,$p_direccion,$p_telefono,$p_perfil,$p_estado){
            $conexion = mainModel::conectar();
            $persona = $conexion->query(" INSERT INTO `persona`(`ID_PERSONA`, `NOMBRES`, `APELLIDOS`, `ID_DOCUMENTO`, `NUMERO`, `DIRECCION`, `TELEFONO`, `PERFIL`, `ESTADO`) VALUES('$p_id_persona','$p_nombres','$p_apellidos','$p_id_documento','$p_numero','$p_direccion','$p_telefono','$p_perfil','$p_estado')");
            return $persona;
        }

/* ========================================================================== */
/*                           Funcion guardar usuario                          */
/* ========================================================================== */

        function guardar_usuario($p_id_usuario,$p_email,$p_password,$p_id_persona,$p_fecha,$p_estado){
            $conexion = mainModel::conectar();
            $persona = $conexion->query(" INSERT INTO `usuario`(`ID_USUARIO`, `EMAIL`, `PASSWORD`, `ID_PERSONA`, `FECHA_REGISTRO`, `ESTADO`) VALUES ('$p_id_usuario','$p_email','$p_password','$p_id_persona','$p_fecha','$p_estado')");
            return $persona;
        }

/* -------------------------------------------------------------------------- */
/*                              Consulta Usuario                              */
/* -------------------------------------------------------------------------- */

        function consulta_usuario($id){
            $conexion = mainModel::conectar();
            $usuario = $conexion->query(" SELECT * FROM `vista_usuarios` WHERE `ID_USUARIO`='$id'");
            return $usuario;
        }

/* -------------------------------------------------------------------------- */
/*                             Actualizar Usuario                             */
/* -------------------------------------------------------------------------- */

        function actualizar_usuario_with_password($p_id_usuario,$p_email,$p_password,$p_estado){
            $conexion = mainModel::conectar();
            $usuario = $conexion->query(" UPDATE `usuario` SET `EMAIL`= '$p_email',`PASSWORD`= '$p_password',`ESTADO`= '$p_estado' WHERE `ID_USUARIO`= '$p_id_usuario'");
            return $usuario;
        }
        function actualizar_usuario_without_password($p_id_usuario,$p_email,$p_estado){
            $conexion = mainModel::conectar();
            $usuario = $conexion->query(" UPDATE `usuario` SET `EMAIL`= '$p_email',`ESTADO`= '$p_estado' WHERE `ID_USUARIO`= '$p_id_usuario'");
            return $usuario;
        }

/* -------------------------------------------------------------------------- */
/*                              Eliminar Usuario                              */
/* -------------------------------------------------------------------------- */

        function eliminar_usuario($p_id_usuario){
            $conexion = mainModel::conectar();
            $usuario = $conexion->query("DELETE FROM `usuario` WHERE `ID_USUARIO` = '$p_id_usuario' ");
            return $usuario;
        }

/* -------------------------------------------------------------------------- */
/*                             Actualizar Persona                             */
/* -------------------------------------------------------------------------- */

        function actualizar_persona_with_photo($id_persona,$nombres,$apellidos,$tipo_documento,$numero_doc,$direccion,$telefono,$perfil_usuario,$estado){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("UPDATE `persona` SET `NOMBRES`= '$nombres',`APELLIDOS`= '$apellidos',`ID_DOCUMENTO`= '$tipo_documento',`NUMERO`= '$numero_doc',`DIRECCION`= '$direccion',`TELEFONO`=  '$telefono',`PERFIL`= '$perfil_usuario',`ESTADO`= '$estado' WHERE `ID_PERSONA`= '$id_persona'");
            return $persona;
        }
        function actualizar_persona_without_photo($id_persona,$nombres,$apellidos,$tipo_documento,$numero_doc,$direccion,$telefono,$estado){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("UPDATE `persona` SET `NOMBRES`= '$nombres',`APELLIDOS`= '$apellidos',`ID_DOCUMENTO`= '$tipo_documento',`NUMERO`= '$numero_doc',`DIRECCION`= '$direccion',`TELEFONO`=  '$telefono',`ESTADO`= '$estado' WHERE `ID_PERSONA`= '$id_persona'");
            return $persona;
        }

/* -------------------------------------------------------------------------- */
/*                              Consulta Persona                              */
/* -------------------------------------------------------------------------- */

        function consulta_persona($id){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("SELECT * FROM  `vista_personas` WHERE `ID_PERSONA` = '$id'");
            return $persona;
        }

/* -------------------------------------------------------------------------- */
/*                              Eliminar Persona                              */
/* -------------------------------------------------------------------------- */

        function eliminar_persona($p_id_persona){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("DELETE FROM `persona` WHERE `ID_PERSONA` = '$p_id_persona'");
            return $persona;
        }
        function agregar_usuario_sucursal($id_usuario,$id_sucursal){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("INSERT INTO `usuario_sucursal`(`ID_USUARIO`, `ID_SUCURSAL`, `ESTADO`)VALUES('$id_usuario','$id_sucursal',1)");
            return $persona;
        }
        function lista_usuarios_sucursales(){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT us.*,u.EMAIL,p.NOMBRES,p.APELLIDOS,p.PERFIL,su.NOMBRE as 'SUCURSAL',su.LOGO FROM usuario_sucursal as us INNER JOIN usuario as u ON us.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as p ON p.ID_PERSONA = u.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = us.ID_SUCURSAL");
            return $usuarios;
        }
        function cambiar_estado_acceso($id,$estado){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("UPDATE `usuario_sucursal` SET `ESTADO` = '$estado' WHERE `ID_PERMISO` = '$id';");
            return $usuarios;
        }
        function usuarios_sucursal($permiso){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("SELECT us.*,u.EMAIL,p.NOMBRES,p.APELLIDOS,p.PERFIL,su.NOMBRE as 'SUCURSAL',su.LOGO FROM usuario_sucursal as us INNER JOIN usuario as u ON us.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as p ON p.ID_PERSONA = u.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = us.ID_SUCURSAL WHERE us.ID_PERMISO = '$permiso'");
            return $usuarios;
        }
        function cambiar_estado_tabla($tabla,$id_permiso,$estado){
            $conexion = mainModel::conectar();
            $usuarios = $conexion->query("UPDATE `usuario_sucursal` SET `{$tabla}` = '$estado' WHERE ID_PERMISO = '$id_permiso'");
            return $usuarios;
        }
    }