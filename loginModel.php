<?php
    class loginModel extends mainModel{
        function lista_personas(){
            $conexion = mainModel::conectar();
            $personas = $conexion->query("SELECT * FROM vista_personas");
            return $personas;
        }
        function guardar_persona($p_id_persona,$p_nombres,$p_apellidos,$p_id_documento,$p_numero,$p_direccion,$p_telefono,$p_perfil,$p_estado){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("INSERT INTO `persona`(`ID_PERSONA`, `NOMBRES`, `APELLIDOS`, `ID_DOCUMENTO`, `NUMERO`, `DIRECCION`, `TELEFONO`, `PERFIL`, `ESTADO`) VALUES('$p_id_persona','$p_nombres','$p_apellidos','$p_id_documento','$p_numero','$p_direccion','$p_telefono','$p_perfil','$p_estado')");
            return $persona;
        }
        function guardar_usuario($p_id_usuario,$p_email,$p_password,$p_id_persona,$p_fecha,$p_estado){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("INSERT INTO `usuario`(`ID_USUARIO`, `EMAIL`, `PASSWORD`, `ID_PERSONA`, `FECHA_REGISTRO`, `ESTADO`) VALUES ('$p_id_usuario','$p_email','$p_password','$p_id_persona','$p_fecha','$p_estado')");
            return $persona;
        }
        function buscar_usuario($email,$password){
            $conexion = mainModel::conectar();
            $persona = $conexion->query("  SELECT u.*,p.NOMBRES,p.APELLIDOS,p.PERFIL,p.DIRECCION,p.NUMERO,p.TELEFONO,doc.DOCUMENTO FROM usuario as u INNER JOIN persona as p ON p.ID_PERSONA = u.ID_PERSONA INNER JOIN documento as doc ON doc.ID_DOCUMENTO = p.ID_DOCUMENTO WHERE u.EMAIL = '$email'  AND u.PASSWORD = '$password'  AND u.ESTADO = 1");
            return $persona;
        }
    }