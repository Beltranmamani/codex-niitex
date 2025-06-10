<?php
    class mainModel{
         function __construct()
        {
            
		}
		public static function cliente($id_cliente){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT cl.*,doc.DOCUMENTO FROM cliente as cl INNER JOIN documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO  WHERE cl.ID_CLIENTE ='$id_cliente'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"RAZON" => $rows["RAZON"],
							"CREDITOS" => 1,
							"LIMITE_CREDITICIO" => $rows["LIMITE_CREDITICIO"],
							"N_CREDITO" => $rows["N_CREDITO"],
							"DOCUMENTO" => $rows["DOCUMENTO"],
							"N_DOCUMENTO" => $rows["N_DOCUMENTO"]
						];
					}
				}
				return $array;

			}
		}
		public static function metodopago_venta($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT m.NAME FROM `ventas` as v INNER JOIN metodopagos as m ON m.ID = v.ID_METODOPAGO WHERE v.ID_VENTA = '$id'"); 
			$BUSCAR = $data->fetchAll(PDO::FETCH_ASSOC)[0];
			return $BUSCAR["NAME"];
		}
        public static function parametros_detalle_preventa($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `detalle_preventa` WHERE `ID_DETALLE` = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_ITEM" => $rows["ID_ITEM"],
							"ID_PRODUCTO" => $rows["ID_PRODUCTO"],
							"PRECIO_1" => $rows["PRECIO_1"],
							"PRECIO_2" => $rows["PRECIO_2"],
							"PRECIO_3" => $rows["PRECIO_3"],
							"PRECIO_4" => $rows["PRECIO_4"],
							"CANTIDAD" => $rows["CANTIDAD"],
							"PERCENT_DESC" => $rows["PERCENT_DESC"],
							"DESCUENTO" => $rows["DESCUENTO"],
							"SUBTOTAL" => $rows["SUBTOTAL"],
							"TOTAL" => $rows["TOTAL"],
							"ESTADO" => $rows["ESTADO"],
							"FECHA_REGISTRO" => $rows["FECHA_REGISTRO"],

						];
					}
				}
				return $array;

			}
		}
		public static function busqueda_item_venta($venta){
			$cn = self::conectar();
            $busqueda = $cn->query("SELECT v.*,ven.PRECIO_RADIO,p.*,lo.NOMBRE as 'LOTE',il.FECHA_VEN FROM detalle_venta as v INNER JOIN items_lote as il On il.ID_ITEM = v.ID_ITEM  INNER JOIN ventas as ven On ven.ID_VENTA = v.ID_VENTA INNER JOIN producto as p ON il.ID_PRODUCTO = p.ID_PRODUCTO inner join lote AS lo ON lo.ID_LOTE = il.ID_LOTE WHERE v.ID_VENTA = '$venta'");
            return $busqueda;
        }
		public  function busqueda_abonos_credito($id){
			$cn = self::conectar();
            $busqueda = $cn->query("SELECT * FROM `cobros_credito` WHERE ID_CREDITO = '$id'");
            return $busqueda;
        }
        public static function parametros_preventa($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `preventa` WHERE `ID_PREVENTA` = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"N_PREVENTA" => $rows["N_PREVENTA"],
							"DIRECCION_FISICA" => $rows["DIRECCION_FISICA"],
							"L1" => $rows["L1"],
							"L2" => $rows["L2"],
							"DESTINO" => $rows["DESTINO"],
							"N_PREVENTA" => $rows["N_PREVENTA"],

						];
					}
				}
				return $array;

			}
		}
        public static function parametros_cliente_tienda($cliente){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `tienda_cliente` WHERE `ID_CLIENTE` = '$cliente'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"NOMBRE" => $rows["NOMBRE"],
							"PERFIL" => $rows["PERFIL"],
							"CORREO" => $rows["CORREO"],
							"TELEFONO" => $rows["TELEFONO"],
							"N_DOCUMENTO" => $rows["N_DOCUMENTO"],
							"ID_DOCUMENTO" => $rows["ID_DOCUMENTO"],
							"FECHA" => $rows["FECHA"],
							"GENERO" => $rows["GENERO"],
							"ESTADO" => $rows["ESTADO"]
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_cliente_pedido($pedido){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT i.*,tc.NOMBRE,tc.TELEFONO,tc.CORREO,dc.DIRECCION,prov.PROVINCIA,dep.DEPARTAMENTO FROM invoice AS i INNER JOIN tienda_cliente as tc ON tc.ID_CLIENTE= i.ID_CLIENTE INNER JOIN direccion_cliente as dc ON dc.ID_DIRECCION = i.ID_DIRECCION INNER JOIN provincia as prov ON prov.ID_PROVINCIA = i.ID_PROVINCIA INNER JOIN departamento as dep ON dep.ID_DEPARTAMENTO = prov.ID_DEPARTAMENTO WHERE i.ID_INVOICE = '$pedido'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_INVOICE" => $rows["ID_INVOICE"],
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"ID_PROVINCIA" => $rows["ID_PROVINCIA"],
							"N_INVOICE" => $rows["N_INVOICE"],
							"ID_DIRECCION" => $rows["ID_DIRECCION"],
							"DIRECCION" => $rows["DIRECCION"],
							"PROVINCIA" => $rows["PROVINCIA"],
							"DEPARTAMENTO" => $rows["DEPARTAMENTO"],
							"NOMBRE" => $rows["NOMBRE"],
							"TELEFONO" => $rows["TELEFONO"],
							"ESTADO" => $rows["ESTADO"],
							"SUBTOTAL" => $rows["SUBTOTAL"],
							"TOTAL" => $rows["TOTAL"],
							"TARIFA" => $rows["TARIFA"],
							"PAGO" => $rows["PAGO"],
							"FECHA" => $rows["FECHA"],
							"CORREO" => $rows["CORREO"],
							
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_tienda(){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT ts.*,suc.MONEDA FROM tienda_sucursal as ts  INNER JOIN sucursal as suc ON ts.ID_SUCURSAL = suc.ID_SUCURSAL WHERE ts.ID_TIENDA = 'TIENDA01'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_SUCURSAL" => $rows["ID_SUCURSAL"],
							"MONEDA" => $rows["MONEDA"],
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_cuenta_bancario(){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `cuenta_bancaria` WHERE 1"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"NRO_CUENTA" => $rows["NRO_CUENTA"],
							"BANCO" => $rows["BANCO"],
							"TITULAR" => $rows["TITULAR"],
							"TELEFONO" => $rows["TELEFONO"],
							"CORREO" => $rows["CORREO"],
							
						];
					}
				}
				return $array;

			}
		}
/* ========================================================================== */
/*                      Funcion conectar a base de datos                      */
/* ========================================================================== */

        public static function conectar(){
			$cn = new PDO(SGDB,USER,PASS);
            return $cn;
		}

/* ========================================================================== */
/*                       Funcion limiar cadenas de texto                      */
/* ========================================================================== */
        public static function parametros_pago_credito($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT pc.*,cc.N_COTIZACION as 'N_CREDITO', cc.TOTAL,pro.ID_PROVEEDOR,cc.PAGADO,cc.PENDIENTE,com.N_COMPRA, com.ESTADO as 'ESTADO_COMPRA',CONCAT(per.NOMBRES,' ',per.APELLIDOS) as 'VENDEDOR' , pro.RAZON AS 'PROVEEDOR',concat(doc.DOCUMENTO,' : ',pro.N_DOCUMENTO) as 'DOC_PROVEE',caj.NRO_CAJA,caj.NOMBRE_CAJA,pro.DIRECCION FROM pagos_credito as pc INNER JOIN creditos_compra as cc ON cc.ID_CREDITO = pc.ID_CREDITO INNER JOIN compras as com ON com.ID_COMPRA = cc.ID_COMPRA INNER JOIN usuario as usu ON usu.ID_USUARIO = pc.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = usu.ID_PERSONA INNER JOIN proveedor as pro ON pro.ID_PROVEEDOR = com.ID_PROVEEDOR INNER JOIN documento as doc on doc.ID_DOCUMENTO = pro.TIPO_DOCUMENTO INNER JOIN arqueocaja as arc ON arc.ID_ARQUEO = pc.ID_CAJA INNER JOIN caja as caj ON caj.ID_CAJA = arc.ID_CAJA WHERE pc.ID_PAGO = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_PAGO" => $rows["ID_PAGO"],
							"ID_CAJA" => $rows["ID_CAJA"],
							"NRO_CAJA" => $rows["NRO_CAJA"],
							"NOMBRE_CAJA" => $rows["NOMBRE_CAJA"],
							"VENDEDOR" => $rows["VENDEDOR"],
							"PROVEEDOR" => $rows["PROVEEDOR"],
							"ID_PROVEEDOR" => $rows["ID_PROVEEDOR"],
							"ID_USUARIO" => $rows["ID_USUARIO"],
							"ID_SUCURSAL" => $rows["ID_SUCURSAL"],
							"N_CREDITO" => $rows["N_CREDITO"],
							"N_COMPRA" => $rows["N_COMPRA"],
							"TOTAL" => $rows["TOTAL"],
							"PAGADO" => $rows["PAGADO"],
							"PENDIENTE" => $rows["PENDIENTE"],
							"MONTO" => $rows["MONTO"],
							"PAGO_CON" => $rows["PAGO_CON"],
							"CAMBIO" => $rows["CAMBIO"],
							"DOC_PROVEE" => $rows["DOC_PROVEE"],
							"DIRECCION" => $rows["DIRECCION"],
							"FECHA_REGISTRO" => $rows["FECHA_REGISTRO"],
							"PAGADO_AC" => $rows["PAGADO_AC"],
						];
					}
				}
				return $array;

			}
		}
        public static function parametros_libro_venta($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT lv.*,dos.L1,dos.L2,dos.L3,dos.L4 FROM libro_ventas as lv INNER JOIN dosificacion as dos On dos.ID_SUCURSAL = lv.ID_SUCURSAL WHERE lv.ID_VENTA = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"NRO_AUTORIZACION" => $rows["NRO_AUTORIZACION"],
							"CODIGO_CONTROL" => $rows["CODIGO_CONTROL"],
							"FECHA_EMISION" => $rows["FECHA_EMISION"],
							"FECHA_LIMITE" => $rows["FECHA_LIMITE"],
							"L1" => $rows["L1"],
							"L2" => $rows["L2"],
							"L3" => $rows["L3"],
							"L4" => $rows["L4"],
							"TOTAL" => $rows["TOTAL"],
						];
					}
				}
				return $array;

			}
		}
        public static function parametros_libro_compra($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT lv.*,dos.L1,dos.L2,dos.L3,dos.L4 FROM libro_compras as lv INNER JOIN dosificacion as dos On dos.ID_SUCURSAL = lv.ID_SUCURSAL WHERE lv.ID_COMPRA = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"NRO_AUTORIZACION" => $rows["NRO_AUTORIZACION"],
							"CODIGO_CONTROL" => $rows["CODIGO_CONTROL"],
							"FECHA_EMISION" => $rows["FECHA_EMISION"],
							"L1" => $rows["L1"],
							"L2" => $rows["L2"],
							"L3" => $rows["L3"],
							"L4" => $rows["L4"],
							"TOTAL" => $rows["TOTAL"],
							"NRO_FACTURA" => $rows["NRO_FACTURA"],
						];
					}
				}
				return $array;

			}
		}
        public static function parametros_abono_credito($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT cc.*,cre.ID_CLIENTE,ca.NRO_CAJA,ven.N_VENTA,ca.NOMBRE_CAJA,us.ID_PERSONA,cre.NOMBRE_CREDITO,cre.CODIGO_CREDITO,cre.MONTO_CREDITO,cre.MONTO_ABONADO,cre.MONTO_RESTANTE FROM cobros_credito as cc INNER JOIN arqueocaja as ac ON ac.ID_ARQUEO = cc.ID_CAJA INNER JOIN caja as ca ON ca.ID_CAJA = ac.ID_CAJA INNER JOIN credito AS cre ON cre.ID_CREDITO = cc.ID_CREDITO INNER JOIN usuario as us ON us.ID_USUARIO = cc.ID_USUARIO INNER JOIN ventas as ven ON ven.ID_VENTA = cre.ID_VENTA WHERE cc.ID_COBRO = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_COBRO" => $rows["ID_COBRO"],
							"ID_CREDITO" => $rows["ID_CREDITO"],
							"NRO_CAJA" => $rows["NRO_CAJA"],
							"NOMBRE_CAJA" => $rows["NOMBRE_CAJA"],
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"ID_PERSONA" => $rows["ID_PERSONA"],
							"ID_SUCURSAL" => $rows["ID_SUCURSAL"],
							"MONTO_CREDITO" => $rows["MONTO_CREDITO"],
							"MONTO_ABONADO" => $rows["MONTO_ABONADO"],
							"MONTO_RESTANTE" => $rows["MONTO_RESTANTE"],
							"PENDIENTE_AC" => $rows["PENDIENTE_AC"],
							
							"N_VENTA" => $rows["N_VENTA"],
							"CODIGO_CREDITO" => $rows["CODIGO_CREDITO"],
							"NOMBRE_CREDITO" => $rows["NOMBRE_CREDITO"],
							"MONTO" => $rows["MONTO"],
							"PAGO_CON" => $rows["PAGO_CON"],
							"CAMBIO" => $rows["CAMBIO"],
						
							"FECHA_REGISTRO" => $rows["FECHA_REGISTRO"],
						];
					}
				}
				return $array;

			}
		}
        public static function lista_abono_credito($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT cc.*,cre.ID_CLIENTE,ca.NRO_CAJA,ven.N_VENTA,ca.NOMBRE_CAJA,us.ID_PERSONA,cre.NOMBRE_CREDITO,cre.CODIGO_CREDITO,cre.MONTO_CREDITO,cre.MONTO_ABONADO,cre.MONTO_RESTANTE FROM cobros_credito as cc INNER JOIN arqueocaja as ac ON ac.ID_ARQUEO = cc.ID_CAJA INNER JOIN caja as ca ON ca.ID_CAJA = ac.ID_CAJA INNER JOIN credito AS cre ON cre.ID_CREDITO = cc.ID_CREDITO INNER JOIN usuario as us ON us.ID_USUARIO = cc.ID_USUARIO INNER JOIN ventas as ven ON ven.ID_VENTA = cre.ID_VENTA   WHERE cc.ID_CREDITO = '$id'"); 
			return $data;
		}
        public static function clean_string($string){
			$string = trim($string);
			$string = stripslashes($string);
			$string = str_ireplace("<script>","",$string);
			$string = str_ireplace("</script>","",$string);
			$string = str_ireplace("<script src=>","",$string);
			$string = str_ireplace("<script type=>","",$string);
			$string = str_ireplace("SELECT * FROM","",$string);
			$string = str_ireplace("DELETE FROM","",$string);
			$string = str_ireplace("INSERT INTO","",$string);
			$string = str_ireplace("[","",$string);
			$string = str_ireplace("]","",$string);
			$string = str_ireplace("^","",$string);
			$string = str_ireplace("==","",$string);
			$string = str_ireplace(";","",$string);
			$string = str_ireplace("_","",$string);
			return $string;
		}
		public static function permisos_sucursal($usuario,$sucursal){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `usuario_sucursal` WHERE ID_USUARIO = '$usuario' AND ID_SUCURSAL = '$sucursal'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"DASHBOARD" => $rows["DASHBOARD"],
							"POS" => $rows["POS"],
							"CONFIGURACION" => $rows["CONFIGURACION"],
							"SUCURSALES" => $rows["SUCURSALES"],
							"DOCUMENTOS" => $rows["DOCUMENTOS"],
							"COMPROBANTES" => $rows["COMPROBANTES"],
							"PERSONAL" => $rows["PERSONAL"],
							"PRODUCTOS" => $rows["PRODUCTOS"],
							"PRESENTACION" => $rows["PRESENTACION"],
							"UNIDAD_MEDIDA" => $rows["UNIDAD_MEDIDA"],
							"LINEAS" => $rows["LINEAS"],
							"PERCEDEROS" => $rows["PERCEDEROS"],
							"ALMACEN" => $rows["ALMACEN"],
							"PROVEEDORES" => $rows["PROVEEDORES"],
							"COMPRAS" => $rows["COMPRAS"],
							"CONSULTA_COMPRAS" => $rows["CONSULTA_COMPRAS"],
							"HISTORICO_PRECIOS" => $rows["HISTORICO_PRECIOS"],
							"CUENTAS_PAGAR" => $rows["CUENTAS_PAGAR"],
							"REPORTE_COMPRAS" => $rows["REPORTE_COMPRAS"],
							"CREDITOS" => $rows["CREDITOS"],
							"PAGAR_CREDITOS" => $rows["PAGAR_CREDITOS"],
							"CONSULTA_PAGOS" => $rows["CONSULTA_PAGOS"],
							"ASIGNACION_CAJA" => $rows["ASIGNACION_CAJA"],
							"ARQUEOS_CAJA" => $rows["ARQUEOS_CAJA"],
							"MOVIMIENTOS_CAJA" => $rows["MOVIMIENTOS_CAJA"],
							"REPORTE_CAJA" => $rows["REPORTE_CAJA"],
							"COTIZACION" => $rows["COTIZACION"],
							"CONSULTA_COTIZACION" => $rows["CONSULTA_COTIZACION"],
							"REPORTE_COTIZACION" => $rows["REPORTE_COTIZACION"],
							"PREVENTA" => $rows["PREVENTA"],
							"CONSULTA_PREVENTA" => $rows["CONSULTA_PREVENTA"],
							"REPORTE_PREVENTA" => $rows["REPORTE_PREVENTA"],
							"VENTA" => $rows["VENTA"],
							"CLIENTE" => $rows["CLIENTE"],
							"CONSULTA_VENTA" => $rows["CONSULTA_VENTA"],
							"PAGOS_PENDIENTES" => $rows["PAGOS_PENDIENTES"],
							"CUENTAS_COBRAR" => $rows["CUENTAS_COBRAR"],
							"REPORTE_VENTAS" => $rows["REPORTE_VENTAS"],
							"CREDITOS_VENTAS" => $rows["CREDITOS_VENTAS"],
							"ABONAR_CREDITOS" => $rows["ABONAR_CREDITOS"],
							"CONSULTA_ABONO" => $rows["CONSULTA_ABONO"],
							"INVENTARTIO_GENERAL" => $rows["INVENTARTIO_GENERAL"],
							"CONSULTA_PRODUCTOS" => $rows["CONSULTA_PRODUCTOS"],
							"NUEVO_TRASPASO" => $rows["NUEVO_TRASPASO"],
							"AJUSTE_INVENTARIO" => $rows["AJUSTE_INVENTARIO"],
							"CONSULTA_TRASPASO" => $rows["CONSULTA_TRASPASO"],
							"CONSULTA_AJUSTES" => $rows["CONSULTA_AJUSTES"],
							"KARDEX_PRODUCTOS" => $rows["KARDEX_PRODUCTOS"],
							"KARDEX_VALORIZADO" => $rows["KARDEX_VALORIZADO"],
							"KARDEX_GENERAL" => $rows["KARDEX_GENERAL"],
							"PEDIDO_TRASPASO"=> $rows["PEDIDO_TRASPASO"],
							"PEDIDO_TRASPASO_LISTA"=> $rows["PEDIDO_TRASPASO_LISTA"],
							"PEDIDO_TRASPASO_PENDIENTES"=> $rows["PEDIDO_TRASPASO_PENDIENTES"],
							"K_VALO_FECHA" => $rows["K_VALO_FECHA"],
							"FACTURA" => $rows["FACTURA"],
							"TIENDA" => $rows["TIENDA"],
						];
					}
				}
				return $array;

			}
		}
/* ========================================================================== */
/*                         Funcion encriptar palabras                         */
/* ========================================================================== */

        public static function encryption($string){
			$output = FALSE;
			$key = hash('sha256', SECRET_KEY);
			$iv = substr(hash('sha256', SECRET_IV), 0, 16);
			$output = openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output = base64_encode($output);
			return $output;
		}

/* ========================================================================== */
/*                        Funcion desencriptar palabras                       */
/* ========================================================================== */

		public static function decryption($string){
			$key = hash('sha256', SECRET_KEY);
			$iv = substr(hash('sha256', SECRET_IV), 0, 16);
			$output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

/* ========================================================================== */
/*                      Funcion generar codigo aleatorio                      */
/* ========================================================================== */

		public static function generar_codigo_aleatorio($letra,$longitud,$num){
			for ($i=0; $i < $longitud ; $i++) { 
				$numero = rand(0,9);
				$letra.= $numero;
			}
			return $letra.$num;
		}

/* ========================================================================== */
/*                   Funcion traer parametros de la sucursal                  */
/* ========================================================================== */

		public static function parametros_venta($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM ventas WHERE ID_VENTA ='$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"NRO_FACTURA" => $rows["NRO_FACTURA"],
							"NOMBRE_PROMOTOR" => $rows["NOMBRE_PROMOTOR"],
						
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_sucursal($sucursal){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query(" SELECT*FROM vista_sucursales WHERE ID_SUCURSAL = '$sucursal'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"NOMBRE" => $rows["NOMBRE"],
							"ID_DOCUMENTO" => $rows["ID_DOCUMENTO"],
							"DOCUMENTO" => $rows["DOCUMENTO"],
							"NUMERO" => $rows["NUMERO"],
							"IVA" => $rows["IVA"],
							"DIRECCION" => $rows["DIRECCION"],
							"TELEFONO" => $rows["TELEFONO"],
							"MONEDA" => $rows["MONEDA"],
							"EMAIL" => $rows["EMAIL"],
							"REPRESENTANTE" => $rows["REPRESENTANTE"],
							"LOGO" => $rows["LOGO"],
							"ID_SUCURSAL" => $rows["ID_SUCURSAL"],
							"ESTADO" => $rows["ESTADO"],
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_producto($producto){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `vista_productos` WHERE ID_PRODUCTO = '$producto'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_PRODUCTO" => $rows["ID_PRODUCTO"],
							"BARRA" => $rows["BARRA"],
							"ARTICULO" => $rows["ARTICULO"],
							"ID_PRESENTACION" => $rows["ID_PRESENTACION"],
							"ID_UNIDAD" => $rows["ID_UNIDAD"],
							"ID_LINEA" => $rows["ID_LINEA"],
							"ID_UNIDAD" => $rows["ID_UNIDAD"],
							"COMPLEMENTO" => $rows["COMPLEMENTO"],
							"PRECIO_COSTO" => $rows["PRECIO_COSTO"],
							"PRECIO_VENTA_1" => $rows["PRECIO_VENTA_1"],
							"PRECIO_VENTA_2" => $rows["PRECIO_VENTA_2"],
							"PRECIO_VENTA_3" => $rows["PRECIO_VENTA_3"],
							"PRECIO_VENTA_4" => $rows["PRECIO_VENTA_4"],
							"PRECIO_VENTA_5" => $rows["PRECIO_VENTA_5"],
							"PRECIO_VENTA_6" => $rows["PRECIO_VENTA_6"],
							"PRECIO_VENTA_7" => $rows["PRECIO_VENTA_7"],
							"STOCK_MINIMO" => $rows["STOCK_MINIMO"],
							"STOCK_MEDIO" => $rows["STOCK_MEDIO"],
							"STOCK_MODERADO" => $rows["STOCK_MODERADO"],
							"PERECEDERO" => $rows["PERECEDERO"],
							"EXENTO" => $rows["EXENTO"],
							"ESTADO" => $rows["ESTADO"],
							"IMAGEN" => $rows["IMAGEN"],
							"MEDIDA_1" => $rows["MEDIDA_1"],
							"MEDIDA_2" => $rows["MEDIDA_2"],
							"MEDIDA_3" => $rows["MEDIDA_3"],
							"MEDIDA_4" => $rows["MEDIDA_4"],
							"MEDIDA_5" => $rows["MEDIDA_5"],
							"MEDIDA_6" => $rows["MEDIDA_6"],
							"MEDIDA_7" => $rows["MEDIDA_7"],
							"STOCK_1" => $rows["STOCK_1"],
							"STOCK_2" => $rows["STOCK_2"],
							"STOCK_3" => $rows["STOCK_3"],
							"STOCK_4" => $rows["STOCK_4"],
							"STOCK_5" => $rows["STOCK_5"],
							"STOCK_6" => $rows["STOCK_6"],
							"STOCK_7" => $rows["STOCK_7"],
						];
					}
				}
				return $array;
	
			}
		}
/* ========================================================================== */
/*                   Funcion traer parametros de la persona                   */
/* ========================================================================== */

		public static function parametros_persona($persona){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query(" SELECT*FROM vista_personas WHERE ID_PERSONA = '$persona'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"NOMBRE" => $rows["NOMBRES"],
							"APELLIDO" => $rows["APELLIDOS"],
							"ID_DOCUMENTO" => $rows["ID_DOCUMENTO"],
							"DOCUMENTO" => $rows["DOCUMENTO"],
							"NUMERO" => $rows["NUMERO"],
							"DIRECCION" => $rows["DIRECCION"],
							"TELEFONO" => $rows["TELEFONO"],
							"PERFIL" => $rows["PERFIL"],
							"ESTADO" => $rows["ESTADO"],
							"ID_PERSONA" => $rows["ID_PERSONA"]
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                   Funcion traer parametros del proveedor                   */
/* ========================================================================== */

		public static function parametros_proveedor($proveedor){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT*FROM vista_proveedores WHERE ID_PROVEEDOR ='$proveedor'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"RAZON" => $rows["RAZON"],
							"DOCUMENTO" => $rows["DOCUMENTO"],
							"N_DOCUMENTO" => $rows["N_DOCUMENTO"],
							"DIRECCION" => $rows["DIRECCION"],
							"TELEFONO" => $rows["TELEFONO"],
							"VENDEDOR" => $rows["VENDEDOR"],
							"V_TELEFONO" => $rows["V_TELEFONO"],
							"CORREO" => $rows["CORREO"],
							"CUENTA" => $rows["CUENTA"]
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                    Funcion traer parametros del cliente                    */
/* ========================================================================== */
		public static function parametros_cliente($cliente){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT cl.*,doc.DOCUMENTO FROM cliente as cl INNER JOIN documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO  WHERE cl.ID_CLIENTE ='$cliente';"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"RAZON" => $rows["RAZON"],
							"DOCUMENTO" => $rows["DOCUMENTO"],
							"N_DOCUMENTO" => $rows["N_DOCUMENTO"],
							"DIRECCION" => $rows["DIRECCION"],
							"TELEFONO" => $rows["TELEFONO"],
							"CORREO" => $rows["CORREO"],
							"NOMBRE" => $rows["NOMBRE"]
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                       Parametros de un item de lotes                       */
/* ========================================================================== */
		/**
		 * Retornar los parametros de un item
		 */
		public static function parametros_item_lote($id_item){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `vista_items` WHERE ID_ITEM = '$id_item'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_PRODUCTO" => $rows["ID_PRODUCTO"],
							"ID_ALMACEN" => $rows["ID_ALMACEN"],
							"PRECIO_COSTO" => $rows["PRECIO_COSTO"],
							"PRECIO_VENTA_1" => $rows["PRECIO_VENTA_1"],
							"PRECIO_VENTA_2" => $rows["PRECIO_VENTA_2"],
							"PRECIO_VENTA_3" => $rows["PRECIO_VENTA_3"],
							"PRECIO_VENTA_4" => $rows["PRECIO_VENTA_4"],
							"PERECEDERO" => $rows["PERECEDERO"],
							"FECHA_VEN" => $rows["FECHA_VEN"]
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                  Parametros de un item de tipo perecedero                  */
/* ========================================================================== */
		/**
		 * Retornar los parametros de el item perecedero
		 */
		public static function parametros_item_perecedero($id_item){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `vista_perecederos` WHERE ID_ITEM = '$id_item'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"FECHA_1" => $rows["FECHA_1"],
							"FECHA_2" => $rows["FECHA_2"],
							"FECHA_3" => $rows["FECHA_3"],
							"FECHA_4" => $rows["FECHA_4"]
							
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                           Informacion del almacen                          */
/* ========================================================================== */
		/**
		 * Retornar la información del almacen
		 */
		public static function almacen_informacion($id_almacen){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `vista_almacenes` WHERE ID_ALMACEN = '$id_almacen'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_SUCURSAL" => $rows["ID_SUCURSAL"]
						];
					}
				}
				return $array;

			}
		}

		public static function preventa_informacion($id_preventa){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT pre.*,per.NOMBRES,per.APELLIDOS,per.PERFIL,cl.RAZON,per.ID_PERSONA,doc.DOCUMENTO,cl.N_DOCUMENTO FROM preventa as pre INNER JOIN usuario AS u ON u.ID_USUARIO = pre.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN cliente as cl ON cl.ID_CLIENTE = pre.ID_CLIENTE INNER JOIN  documento as doc ON doc.ID_DOCUMENTO = cl.TIPO_DOCUMENTO WHERE  pre.ID_PREVENTA = '$id_preventa'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_SUCURSAL" => $rows["ID_SUCURSAL"],
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"SUMAS" => $rows["SUMAS"],
							"IVA" => $rows["IVA"],
							"SUBTOTAL" => $rows["SUBTOTAL"],
							"RETENIDO" => $rows["RETENIDO"],
							"EXENTO" => $rows["EXENTO"],
							"DESCUENTO" => $rows["DESCUENTO"],
							"TOTAL" => $rows["TOTAL"],
							"DESCUENTO_PERCENT" => $rows["DESCUENTO_PERCENT"],
							"PRECIO_RADIO" => $rows["PRECIO_RADIO"],
							"NRO_FACTURA" => $rows["NRO_FACTURA"],
							"NOMBRE_PROMOTOR" => $rows["NOMBRE_PROMOTOR"],
							"PROD_EXENTOS" => $rows["PROD_EXENTOS"]
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                        Creditos de clientes activos                        */
/* ========================================================================== */
		/**
		 * Retornar los creditos activos del cliente
		 */
		public static function cliente_credito_activo($id_cliente){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT COUNT(cr.ESTADO) as 'CREDITOS',cl.RAZON,cl.ID_CLIENTE,cl.LIMITE_CREDITICIO,cl.N_CREDITO,doc.DOCUMENTO,cl.N_DOCUMENTO FROM credito as cr INNER JOIN cliente as cl ON cl.ID_CLIENTE = cr.ID_CLIENTE INNER JOIN documento as doc ON cl.TIPO_DOCUMENTO = doc.ID_DOCUMENTO WHERE cr.ESTADO = 1 AND cr.ID_CLIENTE = '$id_cliente'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"RAZON" => $rows["RAZON"],
							"CREDITOS" => $rows["CREDITOS"],
							"LIMITE_CREDITICIO" => $rows["LIMITE_CREDITICIO"],
							"N_CREDITO" => $rows["N_CREDITO"],
							"DOCUMENTO" => $rows["DOCUMENTO"],
							"N_DOCUMENTO" => $rows["N_DOCUMENTO"]
						];
					}
				}
				return $array;

			}
		}

/* ========================================================================== */
/*                        Stock globlal de un producto                        */
/* ========================================================================== */
		/**
		 * Retornar el stock global de productos
		 */
		public static function stock_global_producto($producto,$sucursal){
			$cn = self::conectar();
			$stock = 0;
			$data = $cn->query("SELECT SUM(CANTIDAD)AS 'STOCK' FROM vista_items WHERE ID_PRODUCTO = '$producto'  AND ID_SUCURSAL = '$sucursal'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$stock = $rows["STOCK"];
					}
				}
				return $stock;

			}
		}

/* ========================================================================== */
/*                             ESTADO DE PREVENTA                             */
/* ========================================================================== */
		/**
		 * Retornar estado de preventa
		 */
		public static function estado_preventa($id_preventa){
			$cn = self::conectar();
			$estado = 0;
			$data = $cn->query("SELECT ESTADO FROM `preventa` WHERE ID_PREVENTA = '$id_preventa'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$estado = $rows["ESTADO"];
					}
				}
				return $estado;

			}
		}

/* ========================================================================== */
/*                      Cantidad de productos en preventa                     */
/* ========================================================================== */
		/**
		 * Retornar la cantidad de productos en preventa
		 */
		public static function productos_preventa($id_preventa){
			$cn = self::conectar();
			$cantidad = 0;
			$data = $cn->query("SELECT COUNT(ID_PREVENTA) as 'CANTIDAD' FROM `detalle_preventa` WHERE `ID_PREVENTA` = '$id_preventa'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$cantidad = $rows["CANTIDAD"];
					}
				}
				return $cantidad;

			}
		}

/* ========================================================================== */
/*                     Ver cantidad de un item de preventa                    */
/* ========================================================================== */

		public static function ver_cantidad_item_preventa($preventa,$item){
			$cn = self::conectar();
			$detalle = 0;
			$data = $cn->query("SELECT dp.*,pre.PRECIO_RADIO,lt.NOMBRE as 'LOTE' ,concat_ws(' ',per.NOMBRES,per.APELLIDOS)as 'VENDEDOR',per.ID_PERSONA,prod.BARRA,prod.ARTICULO,prod.IMAGEN,unid.UNIDAD,unid.PREFIJO,il.CANTIDAD as 'STOCK_ACTUAL',prod.PERECEDERO,prod.EXENTO,prod.COMPLEMENTO,lin.LINEA,pres.NOMBRE as 'PRESENTACION',pre.ID_SUCURSAL,il.FECHA_VEN,il.ID_ALMACEN,alm.NOMBRE as 'ALMACEN' FROM detalle_preventa as dp INNER JOIN preventa as pre ON pre.ID_PREVENTA = dp.ID_PREVENTA INNER JOIN items_lote as il ON il.ID_ITEM = dp.ID_ITEM INNER JOIN lote as lt ON lt.ID_LOTE = il.ID_LOTE INNER JOIN usuario as u ON pre.ID_USUARIO = u.ID_USUARIO INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA INNER JOIN producto as prod ON prod.ID_PRODUCTO = dp.ID_PRODUCTO INNER JOIN linea as lin ON lin.ID_LINEA = prod.ID_LINEA INNER JOIN presentacion as pres ON pres.ID_PRESENTACION = prod.ID_PRESENTACION INNER JOIN almacen as alm ON alm.ID_ALMACEN = il.ID_ALMACEN INNER JOIN unidad_medida as unid ON unid.ID_UNIDAD = prod.ID_UNIDAD WHERE pre.ID_PREVENTA = '$preventa' AND dp.ID_ITEM = '$item'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$detalle = $rows["CANTIDAD"];
					}
				}
				return $detalle;

			}
		}
		public static function retornar_codigo_presentacion($presentacion){
			$cn = self::conectar();
			$codigo = 0;
			$data = $cn->query("SELECT * FROM `vista_presentacion` WHERE NOMBRE = '$presentacion'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$codigo = $rows["ID_PRESENTACION"];
					}
				}
				return $codigo;

			}
		}
		public static function retornar_codigo_linea($linea){
			$cn = self::conectar();
			$codigo = 0;
			$data = $cn->query("SELECT * FROM `vista_lineas` WHERE LINEA = '$linea'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$codigo = $rows["ID_LINEA"];
					}
				}
				return $codigo;

			}
		}
		public static function retornar_codigo_unidad($unidad,$prefijo){
			$cn = self::conectar();
			$codigo = 0;
			$data = $cn->query("SELECT * FROM `vista_unidades_medida` WHERE UNIDAD = '$unidad' AND PREFIJO = '$prefijo'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$codigo = $rows["ID_UNIDAD"];
					}
				}
				return $codigo;

			}
		}

/* ========================================================================== */
/*                            Parametros de usuario                           */
/* ========================================================================== */

		public static function parametros_usuario($usuario){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query(" SELECT * FROM `vista_usuarios` WHERE ID_USUARIO = '$usuario'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"EMAIL" => $rows["EMAIL"],
							"PASSWORD" => $rows["PASSWORD"]
						];
					}
				}
				return $array;

			}
		}
		public static function estado_cotizacion($id_cotizacion){
			$cn = self::conectar();
			$estado = 0;
			$data = $cn->query("SELECT ESTADO FROM `cotizacion` WHERE ID_COTIZACION = '$id_cotizacion'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$estado = $rows["ESTADO"];
					}
				}
				return $estado;

			}
		}
		public static function parametros_credito_compra($credito){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT c.*,cm.FECHA_COMPROBANTE,cm.N_COMPRA,a.ID_SUCURSAL,p.ID_PROVEEDOR,p.RAZON,per.NOMBRES,per.PERFIL,cm.ESTADO AS 'ESTADO_COMPRA' FROM creditos_compra as c INNER JOIN compras as cm ON cm.ID_COMPRA = c.ID_COMPRA INNER JOIN almacen as a ON cm.ID_ALMACEN = a.ID_ALMACEN INNER JOIN proveedor as p ON p.ID_PROVEEDOR = cm.ID_PROVEEDOR INNER JOIN usuario as us ON us.ID_USUARIO = cm.ID_USUARIO INNER JOIN persona as per ON us.ID_PERSONA = per.ID_PERSONA WHERE c.ID_CREDITO = '$credito'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_COMPRA" => $rows["ID_COMPRA"],
							"ESTADO" => $rows["ESTADO"],
							"TOTAL" => $rows["TOTAL"],
							"PAGADO" => $rows["PAGADO"],
							"PENDIENTE" => $rows["PENDIENTE"],
							"N_COTIZACION" => $rows["N_COTIZACION"]
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_credito_venta($credito){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `vista_credito` WHERE ID_CREDITO = '$credito'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_VENTA" => $rows["ID_VENTA"],
							"ESTADO" => $rows["ESTADO"],
							"MONTO_CREDITO" => $rows["MONTO_CREDITO"],
							"MONTO_ABONADO" => $rows["MONTO_ABONADO"],
							"MONTO_RESTANTE" => $rows["MONTO_RESTANTE"],
							"CODIGO_CREDITO" => $rows["CODIGO_CREDITO"],
							"NOMBRE_CREDITO" => $rows["NOMBRE_CREDITO"],
							"ID_VENTA" => $rows["ID_VENTA"]
						];
					}
				}
				return $array;

			}
		}
		public static function parametros_arqueo($arqueo){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT * FROM `arqueocaja` WHERE ID_ARQUEO = '$arqueo'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"MONTOINICIAL" => $rows["MONTOINICIAL"],
							"INGRESOS" => $rows["INGRESOS"],
							"EGRESOS" => $rows["EGRESOS"]
						];
					}
				}
				return $array;

			}
		}
		public static function productos_cotizacion($id_cotizacion){
			$cn = self::conectar();
			$cantidad = 0;
			$data = $cn->query("SELECT COUNT(ID_COTIZACION) as 'CANTIDAD' FROM `detalle_cotizacion` WHERE `ID_COTIZACION` = '$id_cotizacion'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$cantidad = $rows["CANTIDAD"];
					}
				}
				return $cantidad;

			}
		}
		public static function parametros_cotizacion($id){
			$cn = self::conectar();
			$array = [];
			$data = $cn->query("SELECT*FROM cotizacion WHERE ID_COTIZACION = '$id'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$array = [
							"ID_COTIZACION" => $rows["ID_COTIZACION"],
							"SUMAS" => $rows["SUMAS"],
							"IVA" => $rows["IVA"],
							"EXENTO" => $rows["EXENTO"],
							"SUBTOTAL" => $rows["SUBTOTAL"],
							"RETENIDO" => $rows["RETENIDO"],
							"DESCUENTO" => $rows["DESCUENTO"],
							"DESCUENTO_PERCENT" => $rows["DESCUENTO_PERCENT"],
							"PRECIO_RADIO" => $rows["PRECIO_RADIO"],
							"PROD_EXENTOS" => $rows["PROD_EXENTOS"],
							"ID_CLIENTE" => $rows["ID_CLIENTE"],
							"ID_USUARIO" => $rows["ID_USUARIO"],
							"NRO_FACTURA" => $rows["NRO_FACTURA"],
							"NOMBRE_PROMOTOR" => $rows["NOMBRE_PROMOTOR"],
							"TOTAL" => $rows["TOTAL"]
						];
					}
				}
				return $array;

			}
		}
		public static function ver_cantidad_item_cotizacion($cotizacion,$item){
			$cn = self::conectar();
			$detalle = 0;
			$data = $cn->query("SELECT d.*,p.ARTICULO,p.IMAGEN,l.CANTIDAD as 'STOCK_ACTUAL',p.BARRA,li.LINEA,pre.NOMBRE as 'PRESENTACION' ,l.ID_PRODUCTO,l.FECHA_VEN,l.ID_ALMACEN,alm.NOMBRE as 'ALMACEN',l.PRECIO_VENTA_1,l.PRECIO_VENTA_2,l.PRECIO_VENTA_3,l.PRECIO_VENTA_4,p.PERECEDERO,p.EXENTO,p.COMPLEMENTO,um.UNIDAD,um.PREFIJO, cot.ID_SUCURSAL,cot.FECHA,lot.NOMBRE as 'LOTE',per.NOMBRES,per.APELLIDOS FROM detalle_cotizacion as d INNER JOIN items_lote as l ON l.ID_ITEM = d.ID_ITEM INNER JOIN producto as p ON l.ID_PRODUCTO = p.ID_PRODUCTO INNER JOIN linea as li ON li.ID_LINEA = p.ID_LINEA INNER JOIN presentacion as pre ON pre.ID_PRESENTACION = p.ID_PRESENTACION INNER JOIN cotizacion as cot ON cot.ID_COTIZACION = d.ID_COTIZACION INNER JOIN lote as lot ON l.ID_LOTE = lot.ID_LOTE INNER JOIN usuario as u ON u.ID_USUARIO = cot.ID_USUARIO INNER JOIN unidad_medida as um ON um.ID_UNIDAD = p.ID_UNIDAD INNER JOIN almacen as alm ON alm.ID_ALMACEN = l.ID_ALMACEN INNER JOIN persona as per ON per.ID_PERSONA = u.ID_PERSONA WHERE d.ID_COTIZACION = '$cotizacion'  AND d.ID_ITEM = '$item'"); 
			if($data){
				if ($data->RowCount() > 0 ) {
					foreach ($data as $rows) {
						$detalle = $rows["STOCK_ACTUAL"];
					}
				}
				return $detalle;

			}
		}
    }