<?php
    class chat extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

        function render(){
            $this->view->render('chat/index');
        }
        function users(){
            if(isset($_POST["usuario"])){
                $usuario = $this->model->lista_usuarios();
                if($usuario){
                    $users = "";
                    if($usuario->rowCount()>0){
                        foreach($usuario as $u){
                            $enlace = SERVERURL;
                            if($u["ID_USUARIO"] !== $_POST["usuario"]){
                                $users .="
                                    <div class='person' data-chat='chat_principal' id_usuario='{$u["ID_USUARIO"]}'>
                                        <div class='user-info'>
                                            <div class='f-head'>
                                                <img src='{$enlace}archives/avatars/{$u["PERFIL"]}' alt='avatar'>
                                            </div>
                                            <div class='f-body'>
                                                <div class='meta-info'>
                                                    <span class='user-name' data-name='{$u["NOMBRES"]}'>{$u["NOMBRES"]}</span>
                                                </div>
                                                <span class='preview' style='font-style: italic;'>Escribele un mensaje...</span>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                        }
                        echo $users;
                    }
                }
            }
        }
        function agregar_message(){
            if(isset($_POST["me"]) && isset($_POST["you"])){
                $codigo_mensaje = $this->generar_codigo_mesaje();
                date_default_timezone_set(ZONEDATE);
                $date_registro = date('Y-m-d H:i:s');
                $guardar_mensaje = $this->model->agregar_mensaje($codigo_mensaje ,$_POST["me"] ,$_POST["you"] ,$date_registro ,$_POST["message"] );
                if(!$guardar_mensaje){
                    echo 0;
                }
            }
        }
        function generar_codigo_mesaje(){
            $numero = $this->model->vista_chat();
            if($numero){
                $numero = $numero->rowCount()+1;
                // $numero = mainModel::generar_codigo_aleatorio("SMS",5,$numero);
                return $numero;
            }else{
                return 0;
            }
        }  
        function lista_mensajes(){
            if(isset($_POST["me"])){
                $lista = $this->model->buscar_mensajes($_POST["me"] ,$_POST["you"]);
                if($lista){
                    $sms = "";
                    foreach($lista as $l){
                        if($l["ID_ME"] == $_POST["me"] ){
                            $sms .="
                            <div class='bubble me'>
                                {$l["MENSAJE"]}
                            </div>";
                        }else{
                            $sms .="
                            <div class='bubble you'>
                                {$l["MENSAJE"]}
                            </div>";
                        }
                    }
                    echo $sms;
                }
            }
        }
    }