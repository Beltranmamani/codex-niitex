<?php
    class sucursalModel extends mainModel{
        // Lista de documentos
        function lista_documentos(){
            $conexion = mainModel::conectar();
            $unidades = $conexion->query("SELECT * FROM vista_documento");
            return $unidades;
        }
        // Lista de sucursales
        function lista_sucursales(){
            $conexion = mainModel::conectar();
            $sucursales = $conexion->query("SELECT * FROM vista_sucursales");
            return $sucursales;
        }
        function lista_sucursales_usuario($usuario){
            $conexion = mainModel::conectar();
            $sucursales = $conexion->query("SELECT us.*,s.DIRECCION,s.LOGO,s.NOMBRE,s.TELEFONO FROM usuario_sucursal as us INNER JOIN sucursal as s ON s.ID_SUCURSAL = us.ID_SUCURSAL WHERE us.ID_USUARIO = '$usuario' AND us.ESTADO = 1");
            return $sucursales;
        }
        function lista_bitacora(){
            $conexion = mainModel::conectar();
            $bitacora = $conexion->query("SELECT bi.*,u.EMAIL,CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'PERSONA',su.NOMBRE as 'SUCURSAL' FROM bitacora as bi INNER JOIN usuario as u ON bi.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN sucursal as su ON su.ID_SUCURSAL = bi.ID_SUCURSAL");
            return $bitacora;
        }
        // Funcion guardar sucursal
        function guardarsucursal($p_id_sucursal,$p_nombre,$p_id_documento,$p_numero,$p_iva,$p_moneda,$p_direccion,$p_telefono,$p_email,$p_representante,$p_logo,$p_estado){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("INSERT INTO `sucursal`(`ID_SUCURSAL`, `NOMBRE`, `ID_DOCUMENTO`, `NUMERO`, `IVA`, `MONEDA`, `DIRECCION`, `TELEFONO`, `EMAIL`, `REPRESENTANTE`, `LOGO`,`ESTADO`) VALUES('$p_id_sucursal','$p_nombre','$p_id_documento','$p_numero','$p_iva','$p_moneda','$p_direccion','$p_telefono','$p_email','$p_representante','$p_logo','$p_estado')");
            return $sucursal;
        }
        function guardarbitacora($p_id_bitacora,$p_id_usuario,$p_id_sucursal,$p_fecha,$p_ip_pc,$p_navegador){
            $conexion = mainModel::conectar();
            $bitacora = $conexion->query(" INSERT INTO `bitacora`(`ID_BITACORA`, `ID_USUARIO`, `ID_SUCURSAL`, `FECHA`, `IP_PC`, `NAVEGADOR`) VALUES('$p_id_bitacora','$p_id_usuario','$p_id_sucursal','$p_fecha','$p_ip_pc','$p_navegador')");
            return $bitacora;
        }
        // Lista de almacenes por sucursal
        function listar_almacenesXsucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $almacenes = $conexion->query("SELECT a.* FROM almacen as a WHERE a.ID_SUCURSAL ='$p_id_sucursal'");
            return $almacenes;
        }
        function buscar_caja($usuario,$sucursal){
            $conexion = mainModel::conectar();
            $caja = $conexion->query("SELECT a.*,c.ID_USUARIO,c.ID_SUCURSAL,c.NRO_CAJA,c.NOMBRE_CAJA, CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' FROM arqueocaja as a INNER JOIN caja as c ON a.ID_CAJA = c.ID_CAJA INNER JOIN usuario as usu ON usu.ID_USUARIO = c.ID_USUARIO INNER JOIN persona as per ON usu.ID_PERSONA = per.ID_PERSONA WHERE c.ID_USUARIO = '$usuario'  AND c.ID_SUCURSAL = '$sucursal'  AND a.STATUSARQUEO = 1");
            return $caja;
        }

/* -------------------------------------------------------------------------- */
/*                             Actualizar Sucursal                            */
/* -------------------------------------------------------------------------- */

        function actualizar_sucursal_with_logo($codigo,$nombre,$tipo_documento,$numero_doc,$iva,$moneda,$direccion,$telefono,$email,$representante,$logosucursal,$estado){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("UPDATE `sucursal` SET `NOMBRE`= '$nombre',`ID_DOCUMENTO`= '$tipo_documento',`NUMERO`= '$numero_doc',`IVA`= '$iva',`MONEDA`= '$moneda',`DIRECCION`= '$direccion',`TELEFONO`=  '$telefono',`EMAIL`= '$email',`REPRESENTANTE`= '$representante',`LOGO`= '$logosucursal',`ESTADO`= '$estado' WHERE `ID_SUCURSAL`= '$codigo'");
            return $sucursal;
        }
    
        function actualizar_sucursal_without_logo($codigo,$nombre,$tipo_documento,$numero_doc,$iva,$moneda,$direccion,$telefono,$email,$representante,$estado){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("UPDATE `sucursal` SET `NOMBRE`= '$nombre',`ID_DOCUMENTO`= '$tipo_documento',`NUMERO`= '$numero_doc',`IVA`= '$iva',`MONEDA`= '$moneda',`DIRECCION`= '$direccion',`TELEFONO`=  '$telefono',`EMAIL`= '$email',`REPRESENTANTE`= '$representante',`ESTADO`= '$estado' WHERE `ID_SUCURSAL`= '$codigo'");
            return $sucursal;
        }

/* -------------------------------------------------------------------------- */
/*                              Consulta Surcusal                             */
/* -------------------------------------------------------------------------- */

        function consulta_sucursal($id){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query(" SELECT * FROM  `vista_sucursales` WHERE `ID_SUCURSAL` ='$id'");
            return $sucursal;
        }
        
        function eliminar_sucursal($p_id_sucursal){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("DELETE FROM `sucursal` WHERE `ID_SUCURSAL` ='$p_id_sucursal'");
            return $sucursal;
        }
        function consultar_dosificacion($id){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("SELECT * FROM `dosificacion` WHERE ID_SUCURSAL = '$id'");
            return $sucursal;
        }
        function agregar_dosificacion($id,$llave,$numero,$date,$l1,$l2,$l3,$l4,$id_s){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("INSERT INTO `dosificacion` (`ID_DOSIFICACION`, `LLAVE`, `FECHA`, `NUMERO`, `L1`, `L2`, `L3`, `L4`, `ID_SUCURSAL`) VALUES('$id','$llave','$date','$numero','$l1','$l2','$l3','$l4','$id_s')");
            return $sucursal;
        }
        function actualizar_dosificacion($id,$llave,$numero,$date,$l1,$l2,$l3,$l4,$id_s){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("UPDATE `dosificacion` SET `LLAVE`='$llave',`FECHA`='$date',`NUMERO`='$numero',`L1`='$l1',`L2`='$l2',`L3`='$l3',`L4`='$l4',`ID_SUCURSAL`='$id_s' WHERE `ID_DOSIFICACION`='$id'");
            return $sucursal;
        }
        function consultar_dosificaciones(){
            $conexion = mainModel::conectar();
            $sucursal = $conexion->query("SELECT * FROM `dosificacion`");
            return $sucursal;
        }
    }