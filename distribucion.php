<?php
    class distribucion extends Controller{
        function __construct()
        {
            parent::__construct();        
        }

/* -------------------------------------------------------------------------- */
/*                         View almacenes por Sucursal                        */
/* -------------------------------------------------------------------------- */

        function render(){
            $this->view->render('distribucion/zonas');
        }
        function lista_distribucion(){
            if(isset($_POST['token'])){
                $preventa = $this->model->listar_preventas();
                $preventas = [];
                foreach($preventa as $p){
                    $preventas[] = [
                        "id" => $p['ID_PREVENTA'],
                        "log" => $p['L1'],
                        "lat" => $p['L2'],
                        "direccion" => $p['DIRECCION_FISICA'],
                        "preventa" => $p['N_PREVENTA'],
                        "destinatario" => $p['DESTINO'],
                    ];
                }
                echo json_encode($preventas);
            }
        }
        function entregaspendientes(){
            $this->view->render('distribucion/entregas');
        }
        function vermapa($param = null){
            $id = mainModel::decryption($param[0]);
            $preventa = mainModel::parametros_preventa($id);
            $this->view->preventa = $preventa;
            $this->view->render('distribucion/mapa');
        }
    }