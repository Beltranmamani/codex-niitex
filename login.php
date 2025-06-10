<?php
    class login extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        // View Login
        function render(){
            $this->view->render('login/index');
        }
        // View Registrarse
        function registrarse(){
            $this->view->render('login/registrar');
        }
        // Generara Codigo
        function generar_codigo(){
            $cn = mainModel::conectar();
            $numero = $this->model->lista_personas();
            if($numero){
                $numero = $numero->rowCount();
                return $numero+1;
                // return mainModel::generar_codigo_aleatorio('PERSONA',9,$numero);
            }else{
                return 0;
            }
        }
        // Funcion registrar
        function registrar_usuario(){
            if(isset($_POST["nombres"]) && isset($_POST["apellido"])){
                $p_id_persona = $this::generar_codigo();
                $p_nombres = $_POST["nombres"];
                $p_apellidos = $_POST["apellido"];
                $email = $_POST["email"];
                $password = mainModel::encryption($_POST["password"]);
                $p_id_documento = "DOCUMENTO9795051";
                $contar_persona = $this->model->lista_personas();
                date_default_timezone_set(ZONEDATE);
                $fecha_registro = date('Y-m-d');
                if($contar_persona){
                    if($contar_persona->rowCount()>0){
                        echo 2;
                    }else{
                        $guardar_persona = $this->model->guardar_persona($p_id_persona,$p_nombres,$p_apellidos,$p_id_documento,'','','','sin_perfil.png',1);
                        if($guardar_persona){
                            if($guardar_persona->rowCount()>0){
                                $guardar_usuario = $this->model->guardar_usuario('ADMIN01',$email,$password,$p_id_persona,$fecha_registro,1);
                                if($guardar_usuario){
                                    if($guardar_usuario->rowCount()>0){
                                        echo 1;
                                    }else{
                                        echo 0;
                                    }
                                }else{
                                    echo 0;
                                }
                            }else{
                                echo 0;
                            }
                        }else{
                            echo 0;
                        }
                    }
                }else{
                    echo 1;
                }
            }
        }
        // Funcion Iniciar Sesion
        function iniciar_sesion(){
            if(isset($_POST["email"]) && isset($_POST["password"])){
                $email = $_POST["email"];
                $password = mainModel::encryption($_POST["password"]);
                $buscar_usuario = $this->model->buscar_usuario($email,$password);
                if($buscar_usuario){
                    if($buscar_usuario->rowCount()>0){
                        session_name('B_POS');
                        session_start();
                        foreach($buscar_usuario as $row){
                            $_SESSION['usuario'] = $row['ID_USUARIO'];
                            $_SESSION['persona'] = $row['ID_PERSONA'];
                            $_SESSION['nombre_persona'] = $row['NOMBRES'];
                            $_SESSION['apellido_persona'] = $row['APELLIDOS'];
                            $_SESSION['perfil_persona'] = $row['PERFIL'];
                            $_SESSION['direccion_persona'] = $row['DIRECCION'];
                            $_SESSION['telefono_persona'] = $row['TELEFONO'];
                            $_SESSION['numero_doc_persona'] = $row['NUMERO'];
                            $_SESSION['documento_persona'] = $row['DOCUMENTO'];
                            $_SESSION['email'] = $row['EMAIL'];
                            $_SESSION['sucursal'] = 0;
                            $_SESSION['moneda'] = "S/ ";
                            $_SESSION['caja'] = 0;
                            $_SESSION['modulos_access'] = "";
                        }
                       echo 1;
                    }else{  
                        echo 2;
                    }
                }else{
                    echo 0;
                }
            }
        }
        // Funcion Cerrar sesion
        function cerrar_sesion(){
            session_name('B_POS');
            session_start();
            echo '<script> window.location.href="'.SERVERURL.'login/" ;</script>';
            session_destroy();
        }
        function recuperarpassword(){
            $this->view->render("login/recuperar");
        }
        function recovery(){
            if($_POST["email"]){
                $to = 'djcucchi80@gmail.com'; 
                $from = 'djcucchi80@gmail.com'; 
                $fromName = 'SenderName ssa'; 
                
                $subject = "Send HTML Email in PHP by CodexWorld aa"; 
                
                $htmlContent = ' 
                    <html> 
                    <head> 
                        <title>Welcome to CodexWorld</title> 
                    </head> 
                    <body> 
                        <h1>Thanks you for joining with us!</h1> 
                        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                            <tr> 
                                <th>Name:</th><td>CodexWorld</td> 
                            </tr> 
                            <tr style="background-color: #e0e0e0;"> 
                                <th>Email:</th><td>contact@codexworld.com</td> 
                            </tr> 
                            <tr> 
                                <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td> 
                            </tr> 
                        </table> 
                    </body> 
                    </html>'; 
                
                // Set content-type header for sending HTML email 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                
                // Additional headers 
                $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
                $headers .= 'Cc: xxx@gmail.com' . "\r\n"; 
                $headers .= 'Bcc: xxx0@gmail.com' . "\r\n"; 
                
                // Send email 
                if(mail($to, $subject, $htmlContent, $headers)){ 
                    echo 'Email has sent successfully.'; 
                }else{ 
                echo 'Email sending failed.'; 
                }
            }
        }
    }