<?php
 
 use Engine\Core\Controller ;
 
 class Error extends Controller{
    
    
    function index(){
        global $wear;
        $template = $this->loadView($wear->front . "/error");
        $template->set("page" , SITE_NAME . " | Error 404");
        $template->render();
        
        
    }
    
    
    
    

 }
