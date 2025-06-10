<?php
    class backup extends Controller{

        function __construct()
        {
            parent::__construct();        
        }
        function backup(){
                    
            $bd="bpos_oficial"; //parametro obligatorio 
            // $bd="bolivia_bpos_optica"; //parametro obligatorio 
            // Tipo de compresion. 
            // Puede ser "zip", "gz", "bz2", o false (sin comprimir)
            $compresion = "false";
            // Determina si será borrada el objeto (si existe) cuando  restauremos .           
            $drop = "true";
            $DELIMITER = "$$"; //valor predeterminadotrue;
            $SoloTablas= "true";
            $EstructuraBD="true";
            $InsertDatos= "true";
            $CreateDataBase = isset($_GET['CreateDataBase']) && ($_GET['CreateDataBase']=="true")  ? true : false;
            if ( empty($_GET["tablas"]))
                    $tablas = false; //un array con las tablas de la bd que se desean copiar.
            else{
                    $tablas =explode(",",$_GET["tablas"]);
                    foreach($tablas as $num => $tabla) $tablas[$num] =trim($tabla);
            }
            //--------------------- PARAMETRIZACION: -------------------------------------------------------------------- 


            //las Views de la bd que se desean copiar en el orden adecuado. Puede atacar a una tabla que liste en el orden deseado las views para tener encuenta las dependencias  
            $viewSQL  = "SHOW FULL TABLES FROM `".$bd."` WHERE Table_Type='VIEW';"; //SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :database AND TABLE_NAME = :table
            $tablaSQL = "SHOW FULL TABLES FROM $bd WHERE Table_Type='BASE TABLE';"; //SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :database AND TABLE_NAME = :table
            //set_time_limit(300); //alarga el timeout


            // CONEXION 
            ///$conexion = new mysqli($host, $usuario, $passwd, $bd);

        //     $conexion = new mysqli('localhost','root','','bolivia_bpos_optica',3306) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error);
            $conexion = new mysqli('localhost','root','','bpos_oficial',3306) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error);
            if ($conexion->connect_errno) {
                printf("No se puede conectar con el servidor MySQL: %s\n", $conexion->connect_error);
                exit();
            }
            //SET NAMES
            $consulta="SHOW CREATE DATABASE `".$bd."`;";
            $respuesta = $conexion->query($consulta)or die("No se puede ejecutar la consulta: $consulta MySQL: \n". $conexion->error);
            if ($fila = $respuesta->fetch_array(MYSQLI_NUM)) {//CREATE DATABASE `kk` /*!40100 DEFAULT CHARACTER SET latin1 */
                    $s= stristr($fila[1]," SET ");
                    $z=explode(" ",$s);
                    $SetNames="/*!40101 SET NAMES ".$z[2]." */;";
            }else $SetNames="/*!40101 SET NAMES utf8 */;";
            $respuesta->free();


            // Se busca las tablas en la base de datos 
            if (empty ($tablas) ) {
                $respuesta = $conexion->query($tablaSQL)or die("No se puede ejecutar la consulta: $tablaSQL MySQL: \n". $conexion->error);
                    while ($fila = $respuesta->fetch_array(MYSQLI_NUM)) {
                                    $tablas[] = $fila[0];
                    }
                    $respuesta->free();
            }


            /* Se crea la cabecera del archivo */
            $info['dumpversion'] = "2.15";
            date_default_timezone_set("America/La_Paz");
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $info['fecha'] = date ("d-m-Y");
            $info['hora'] = date('h:i:s A');
            $info['mysqlver'] = $conexion->server_info;
            $info['phpver'] = phpversion ();
            ob_start ();
            $representacion = ob_get_contents ();
            ob_end_clean  ();
            preg_match_all ('/(\[\d+\] => .*)\n/', $representacion, $matches);
            $info['tablas'] = implode (";  ", $tablas);


            $FicheroOUT=$bd."_backup_".$info['fecha'].".sql"; //Este es el nombre del archivo a generar 
            $dump = <<<EOT
            # +===================================================================
            # | Generado el {$info['fecha']} a las {$info['hora']} 
            # | Servidor: {$_SERVER['HTTP_HOST']}
            # | MySQL Version: {$info['mysqlver']}
            # | PHP Version: {$info['phpver']}
            # | Base de datos: '$bd'
            # | Tablas: {$info['tablas']}
            # +-------------------------------------------------------------------
            # Si tienen tablas con relacion y no estan en orden dara problemas al recuperar datos. Para evitarlo:
            SET FOREIGN_KEY_CHECKS=0; 
            SET time_zone = '+00:00';
            SET sql_mode = ''; 


            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8 */;


            EOT;


            if ($CreateDataBase && $EstructuraBD)
            $dump .= <<<EOT


            CREATE DATABASE IF NOT EXISTS `$bd`;
            
            USE `$bd`;


            EOT;


            foreach ($tablas as $tabla) {
                    $drop_table_query = "";
                $create_table_query = "";
                $insert_into_query = "";
                    if ($EstructuraBD){
                            // Se halla el query que será capaz vaciar la tabla. 
                            if ($drop) {
                                    $drop_table_query = "DROP TABLE IF EXISTS `".$tabla."`;";
                            } else {
                                    $drop_table_query = "# No especificado DROP.";
                            }
                    
                            // Se halla el query que será capaz de recrear la estructura de la tabla. 
                            $create_table_query = "";
                            $consulta = "SHOW CREATE TABLE `".$tabla."`;";
                            $respuesta = $conexion->query($consulta) or die("No se puede ejecutar la consulta: $consulta MySQL: ". $conexion->error);
                            while ($fila = $respuesta->fetch_array(MYSQLI_NUM)) {
                                    $create_table_query = $fila[1].";";
                            }
                            $respuesta->free();
                            $dump .= <<<EOT
            # | Vaciado de tabla '$tabla'
            # +-------------------------------------
            $drop_table_query


            # | Estructura de la tabla '$tabla'
            # +-------------------------------------
            $create_table_query
                            
            EOT;
                    }
                    // Se generan los INSERT de los datos. 
                    if ($InsertDatos && ($tabla != "audittrail")){//no salvamos datos de audittrail
                                    $insert_into_query = "";
                                    $consulta = "SELECT * FROM `".$tabla."`;";
                                    $respuesta = $conexion->query($consulta) or die("No se puede ejecutar la consulta: $consulta MySQL: ". $conexion->error);
                                    if ($fila = $respuesta->fetch_array(MYSQLI_ASSOC)){ //generar una sola vez la cabecera del insert
                                            foreach ($fila  as $columna  => $valor){
                                                    $campos[] = "`".$conexion->real_escape_string($columna)."`";
                                            }
                                            $insertSQLHead="\r\nCOMMIT;\r\nINSERT IGNORE INTO `$tabla` (" . implode(", ", $campos) . ") VALUES ";
                                            unset ($campos);
                                            $x=1;
                                            do {
                                                    foreach ($fila  as $columna  => $valor) {
                                                            if ( gettype ($valor) == "NULL" ) {
                                                                    $values[] = "NULL";
                                                            } else {
                                                                    $values[] = "'".$conexion->real_escape_string($fila[$columna])."'"; //guardar cada valor de campo
                                                            }
                                                    }
                                                    $regs[] ="\r\n      (" . implode(", ", $values) . ")"; //meter en un array todos los valores de cada registro entre () y separado por ,
                                                    unset ($values);
                                                    if ($x++ == 300) {
                                                            $insert_into_query .= $insertSQLHead . implode(", ", $regs) . ";"; //generar un insert cada 300 registros
                                                            unset ($regs);
                                                            $x=1;
                                                    }
                                            } while ($fila = $respuesta->fetch_array(MYSQLI_ASSOC)) ;
                                            if ($x==1)         {
                                                    $insert_into_query .= "\r\nCOMMIT;\r\n";
                                            } else {
                                                    $insert_into_query .= $insertSQLHead.implode (", ", $regs).";\r\nCOMMIT;\r\n";
                                                    unset ($regs);
                                            }   
                                    }
                                    $respuesta->free();
                                    $dump .= "
            # | Carga de datos de la tabla '$tabla'
            # +-------------------------------------
            $insert_into_query
            ";
                    } // insert
            }
            if (!$SoloTablas && $EstructuraBD) {
            // copiar ROUTINAS (PROCEDURE o FUNCTION  (se funde con un array de Views para evitar posibles dependencias en la restaruación (una vista basada en otra)
            // tanto de otras routinas como de vistas no creadas).
            // Falla si hay una function o un procedure que se llame igual que una vista.
                $arrRoutinasViews =array();
                    //$arraySQL=array("SELECT `ROUTINE_TYPE`as `Type`,`ROUTINE_SCHEMA` as `Db`, `ROUTINE_NAME` AS `Name` FROM INFORMATION_SCHEMA.`ROUTINES` WHERE INFORMATION_SCHEMA.ROUTINES.`ROUTINE_SCHEMA` LIKE '". $bd ."';");
                    $arraySQL=array("SHOW FUNCTION STATUS where Db like '". $bd ."';","SHOW PROCEDURE STATUS where Db like '". $bd ."';");
                    foreach ($arraySQL as $sql) {
                            $routinasSQL = $conexion->query($sql) or die("No se puede ejecutar la consulta: $sql MySQL: ". $conexion->error);
                            while ($routina = $routinasSQL->fetch_array(MYSQLI_ASSOC)) {
                                    $nombre="`".$routina["Db"]."`.`".$routina["Name"]."`";
                                    $sql='SHOW CREATE '.$routina["Type"].' '.$nombre;
                                    $routinaDDL = $conexion->query($sql) or die("No se puede ejecutar la consulta: $sql MySQL: ". $conexion->error);
                                    $rowDDL = $routinaDDL->fetch_array(MYSQLI_BOTH);
                                    $codigo="CREATE ".stristr($rowDDL[2],$routina["Type"]);
                                    $arrRoutinasViews[$nombre]= "\r\n\r\n";
                                    if ($drop) $arrRoutinasViews[$nombre].="DROP ".$routina["Type"]." IF EXISTS ".$nombre. ";\r\n";
                                    if ($DELIMITER==";") 
                                            $arrRoutinasViews[$nombre].="\r\n".$codigo.";\r\n# ------------------------------------------------------------------------------------------";        
                                    else
                                            $arrRoutinasViews[$nombre].="DELIMITER ".$DELIMITER."\r\n".$codigo."\r\n".$DELIMITER."\r\nDELIMITER ;\r\n# ------------------------------------------------------------------------------------------";        
                                    $routinaDDL->free();
                            }
                            $routinasSQL->free();
                    }
            //VIEWs 
                    $respuesta = $conexion->query($viewSQL) or die("No se puede ejecutar la consulta: MySQL: $viewSQL ". $conexion->error);
                    while ($fila = $respuesta->fetch_array(MYSQLI_NUM)) {
                    $consulta ="SHOW CREATE VIEW `".$bd."`.`".$fila[0]."`;";
                            $respuestaView = $conexion->query($consulta) or die("No se puede ejecutar la consulta: $consulta MySQL: ". $conexion->error);
                            $filaView = $respuestaView->fetch_array(MYSQLI_NUM);
                            // vamos a eliminar lo que hay entre CREATE y VIEW para evitar que falle pq los usuarios creadores no existan en la máquina de restaruación 
                            $codigo="CREATE ".stristr($filaView[1],"View");
                            $arrRoutinasViews[$fila[0]]="\r\n";
                            if ($drop) $arrRoutinasViews[$fila[0]].="DROP VIEW IF EXISTS `".$bd."`.`".$fila[0]."`;\r\n";
                            $arrRoutinasViews[$fila[0]].=$codigo."; \r\n";
                            $respuestaView->free();
                    }
                    $respuesta->free();


                    // cargar VIEWs y ROUTINAS de modo que evite las dependencias en restauración:
                    // cada elemento busca si está contenido en la definición de otros pendientes de definir en cuyo caso espera a definir primero los que él depende.
                    $ciclos=0;
                    while ((count($arrRoutinasViews)>0)&& (++$ciclos<30)){
                            foreach($arrRoutinasViews as $indice => $valor){ 
                                    $encontrado=false;
                                    foreach($arrRoutinasViews as $key => $val) {//buscar en los restantes
                                            if ($indice != $key) {
                                                    if (stripos($valor,"`".$key."`") !== false){ // lo ponemos entre "`" para garantizar que no es un prefijo de otra palabra. Esto obliga que las definiciones usen esta nomenclatura.
                                                            $encontrado=true;
                                                            break;
                                                    }    
                                            }
                                    }
                                    if (!$encontrado){ //imprimirlo y borrar elemento de array
                                            $dump .= $valor; 
                                            unset($arrRoutinasViews[$indice]);
                                    }
                            }
                    }
                    if ($ciclos>=30) {
                            echo "SET NEW='Superados 30 ciclos en busqueda de dependencias jerarquicas (quizas hay dependencias circulares mutuas)';";
                            $FicheroOUT="ERROR_bucle_$bd.sql";
                    }


                    //TRIGGERs. Al estar al final no hay problema de que dependa de funciones o vistas, pues a estas alturas de restaruaciónya estarán creadas.
                    $consulta = "SHOW FULL TRIGGERS FROM `".$bd."`;"; //SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :database AND TABLE_NAME = :table
                    $respuesta = $conexion->query($consulta) or die ("No se puede ejecutar la consulta: $consulta MySQL:". $conexion->error); 
                    while ($fila = $respuesta->fetch_array(MYSQLI_NUM)) {
                            if ($drop) $dump .="\r\nDROP TRIGGER IF EXISTS `".$bd."`.`".$fila[0]."`;\r\n";
                            if ($DELIMITER!=";")         $dump .="\r\nDELIMITER $DELIMITER\r\n";
                            $dump .= "Create trigger `".$bd."`.`".$fila[0]."`  ".$fila[4]." ".$fila[1]." ON `".$fila[2]."` \r\n";
                            $dump .= "      for each row \r\n";
                            $dump .= $fila[3];
                            if ($DELIMITER!=";")         $dump .="\r\n".$DELIMITER."\r\nDELIMITER  ";
                            $dump .=";\r\n";
                    }
                    $respuesta->free();
            } // not $SoloTablas

                // Obtener procedimientos almacenados
                $procedureSQL = "SHOW PROCEDURE STATUS WHERE Db = '$bd';";
                $procedureResult = $conexion->query($procedureSQL) or die("Error al obtener procedimientos almacenados: " . $conexion->error);

                while ($procedureRow = $procedureResult->fetch_array(MYSQLI_ASSOC)) {
                $procedureName = $procedureRow["Name"];
                $procedureDDL = "SHOW CREATE PROCEDURE `$bd`.`$procedureName`;";
                $procedureResultDDL = $conexion->query($procedureDDL) or die("Error al obtener la definición del procedimiento almacenado: " . $conexion->error);
                $procedureRowDDL = $procedureResultDDL->fetch_array(MYSQLI_NUM);

                // Agregar la definición del procedimiento almacenado al dump
                $dump .= "\r\n# | Definición del procedimiento almacenado '$procedureName'\r\n";
                $dump .= $procedureRowDDL[2] . ";\r\n";
                }

                $procedureResult->free();

                // Obtener vistas
                $viewSQL = "SHOW FULL TABLES FROM `$bd` WHERE Table_Type='VIEW';";
                $viewResult = $conexion->query($viewSQL) or die("Error al obtener vistas: " . $conexion->error);

                while ($viewRow = $viewResult->fetch_array(MYSQLI_NUM)) {
                $viewName = $viewRow[0];
                $viewDDL = "SHOW CREATE VIEW `$bd`.`$viewName`;";
                $viewResultDDL = $conexion->query($viewDDL) or die("Error al obtener la definición de la vista: " . $conexion->error);
                $viewRowDDL = $viewResultDDL->fetch_array(MYSQLI_NUM);

                // Agregar la definición de la vista al dump
                $dump .= "\r\n# | Definición de la vista '$viewName'\r\n";
                $dump .= $viewRowDDL[1] . ";\r\n";
                }

                $viewResult->free();

            //cerramos la conexión con la BBDD
            $conexion->close();
            
            /* Envio */
            if ( !headers_sent () ) {
                header ("Pragma: no-cache");
                header ("Expires: 0");
                header ("Content-Transfer-Encoding: binary");
                switch ($compresion) {
                    case "zip":
                                    $enzipado = new ZipArchive();
                                    if ($enzipado->open($FicheroOUT.".zip", ZIPARCHIVE::CREATE )!==TRUE)         exit("No se pudo abrir el archivo\n");
                                    $enzipado->addFromString($FicheroOUT, $dump);
                                    $enzipado->close();
                    header ("Content-Disposition: attachment; filename=$FicheroOUT.zip");
                    header ("Content-type: application/zip");
                            header("Cache-Control: no-cache, must-revalidate"); 
                            header("Expires: 0");
                    readfile($FicheroOUT.".zip");
                            unlink($FicheroOUT.".zip");
                    break;
                
                case "gz":
                    header ("Content-Disposition: attachment; filename=$FicheroOUT.gz");
                    header ("Content-type: application/x-gzip");
                    echo  gzencode ($dump, 9);
                    break;
                case "bz2": 
                    header ("Content-Disposition: attachment; filename=$FicheroOUT.bz2");
                    header ("Content-type: application/x-bzip2");
                    echo  bzcompress ($dump, 9);
                    break;
                default:
                    header ("Content-Disposition: attachment; filename=$FicheroOUT");
                    header ("Content-type: application/force-download");
                    echo  $dump;
                }
            } else {
                echo  "<b>ATENCION: Probablemente ha ocurrido un error de envio de headers</b><br />\r\n <pre>\r\n $dump\r\n </pre>";
            }
        }
        function restore(){
            $this->view->render('backup/restore');
        }
        function restaurar(){
            $files_post = $_FILES['file'];
            $files = array();
            $file_count = count($files_post['name']);
            $n = intval($file_count);
            $file_keys = array_keys($files_post);
            
            for ($i=0; $i < $file_count; $i++) 
            { 
                foreach ($file_keys as $key) 
                {
                    $files[$i][$key] = $files_post[$key][$i];
                }
            }
            foreach ($files as $fileID => $file)
            {
                $strSQLs = file_get_contents($file['tmp_name']);
                unlink($strSQLs);
                //  Elimina lineas vacias o que empiezan por -- #   //   o entre /* y */
                // Elimna los espacios en blanco entre ; y \r\n
                // handle DOS and Mac encoded linebreaks
                    $strSQLs=preg_replace("/\r\n$/","\n",$strSQLs);
                    $strSQLs=preg_replace("/\r$/","\n",$strSQLs);
                    $strSQLs = trim(preg_replace('/ {2,}/', ' ', $strSQLs));    // ----- remove multiple spaces ----- 
                    $strSQLs = str_replace("\r","",$strSQLs);                     //los \r\n los dejamos solo en \n
                    $lines=explode("\n",$strSQLs);
                    $strSQLs = array();
                    $in_comment = false;
                    foreach ($lines as $key => $line){
                        $line=trim($line); //preg_replace("#.*/#","",$line)
                        $ignoralinea=(( "#" == $line[0] ) || ("--" == substr($line,0,2)) || (!$line) || ($line==""));
                        if (!$ignoralinea){
                            //Eliminar comentarios que empiezan por /* y terminan por */    
                            if( preg_match("/^\/\*/", ($line)) )       $in_comment = true;
                            if( !$in_comment )     $strSQLs[] = $line ;
                            if( preg_match("/\*\//", ($line)) )      $in_comment = false;
                        }
                    }
                    unset($lines);
                    // Particionar en sentencias
                    $IncludeDelimiter=false;
                    $delimiter=";";
                    $delimiterLen= 1;
                    $sql="";
                    // CONEXION 
                    $conexion = new mysqli('localhost','root','','bolivia_bpos_optica',3306) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error);

                    $NumLin=0;
                    foreach ($strSQLs as $key => $line){

                        if ("DELIMITER" == substr($line,0,9)){  //empieza por DELIMITER
                            $D=explode(" ",$line);
                            $delimiter= $D[1];
                            $delimiterLen= strlen($delimiter);
                            $sql=($IncludeDelimiter)? $line ."\n" : "";
                        }elseif (substr($line,-1*$delimiterLen) == $delimiter) { //hemos alcanzado el  Delimiter
                                if (($NumLinea++ % 100)==0) {// ver con que base de datos estamos para poder reconectar caso de error
                                    $respuesta = $conexion->query("select database() as db");
                                    $row = $respuesta->fetch_array(MYSQLI_NUM);
                                    $db=$row[0];
                                }
                                $sql .= ($IncludeDelimiter)? $line : substr($line,0,-1*$delimiterLen);
                                $respuesta = $conexion->query($sql);
                                if ($respuesta) echo "";
                                
                                else {
                                echo "";
                                if (!$conexion->ping() ){ 

                                    $conexion = new mysqli('localhost','root','','prueba',3306) or die ("No se puede conectar con el servidor MySQL: %s\n". $conexion->connect_error);
                                    $respuesta = $conexion->query($sql);
                                    if ($respuesta) echo "<br>$NumLinea REEJECUTADO:  ". str_replace("\n"," ",substr($sql,0,130))."...";
                                    else echo "<br><b><u>$NumLinea REPITE-E R R O R: ".$conexion->errno." :</u></b>". $conexion->error ." ====> ". substr($sql,0,1022)."...";
                                }
                            }    

                            $sql="";
                        } else { 
                            $sql .= $line ."\n";
                        }
                    }
                    $conexion->close();    
                    }
            
        }
    }

/* -------------------------------------------------------------------------- */
/*                         View almacenes por Sucursal                        */
/* -------------------------------------------------------------------------- */
