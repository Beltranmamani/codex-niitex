<?php
    class notPage extends Controller{
        function __construct()
        {
            parent::__construct();        
        }
        function render(){
            $this->view->render('error/404');
        }
        
    }