<?php

 use Engine\Core\Controller ;
 
 class App extends Controller{
    
    #-----Gear Name -------#

    private $gear ="app";

    #-----Index / Home Page -------#

    function index(){

        global $wear;
        $template = $this->loadView($wear->front . "/index");
        $template->set("page" , SITE_NAME . " | Home");
        $template->render();   

    }

    
    #-----Configure Page -------#

    function configure(){
        
        global $wear;
        $template = $this->loadView($wear->front . "/configure");
        $template->set("page" , SITE_NAME . " | Configure Your App");
        $template->render(); 
           
    }
    
    #-----Contact Page -------#

    function contact(){

        global $wear;
        $template = $this->loadView($wear->front . "/contact");
        $template->set("page" , SITE_NAME . " | Contact Us");
        $template->render(); 

    }

    function otherApps(){

        global $wear;
        $template = $this->loadView($wear->front . "/other_apps");
        $template->set("page" , SITE_NAME . " | All Our Apps");
        $template->render(); 

    }

    function pricing(){

        global $wear;
        $template = $this->loadView($wear->front . "/pricing");
        $template->set("page" , SITE_NAME . " | Pricing");
        $template->render(); 

    }
    
    #-----Login Page -------#

    function login(){

         global $wear;
        $template = $this->loadView($wear->front . "/login");
        $template->set("page" , SITE_NAME . " | Login");
        $template->render();

    }

    function logout(){

         $model = $this->loadModel("users","sun_user_model");
         $model->logout();

    }

    #----------Request Pages---------#
function websiteChange($id){

        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/webchange");
        $template->set("page" , SITE_NAME . " | Changes To Your Website");
        $template->set("id", $id);
        $template->render();
        
        
    }
 function sendInvoice($id){
    do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/payment");
        $template->set("page" , SITE_NAME . " | Send Us Your Invoice");
        $template->set("id", $id);
        $template->render();
        
    
    }
    function videoResources($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/video_tutorials");
        $template->set("page" , SITE_NAME . " | Send Us Your Invoice");
        $template->set("id", $id);
        $template->render();
        
    
    }
    function addComponent($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/components");
        $template->set("page" , SITE_NAME . " | Create An Invoice To Add Components");
        $template->set("id", $id);
        $template->render();
        
        
    }
    function addHosting($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/hosting");
        $template->set("page" , SITE_NAME . " | Create An Invoice For Hosting");
        $template->set("id", $id);
        $template->render();
        
        
    }
    function customComponent($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/custom_component");
        $template->set("page" , SITE_NAME . " | Create An Invoice To Add Components");
        $template->set("id", $id);
        $template->render();
        
        
    }
    function requestUpdates($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/updates");
        $template->set("page" , SITE_NAME . " | Request App Update");
        $template->set("id", $id);
        $template->render();
        
        
    }

    function newApp($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/new_sun");
        $template->set("page" , SITE_NAME . " | Request New App Creation");
        $template->set("id", $id);
        $template->render();
        
        
    }
    function checkInvoice($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/check_invoice");
        $template->set("page" , SITE_NAME . " | Get Invoice");
        $template->set("id", $id);
        $template->render();
        
        
    }
    function newShop($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/new_shop");
        $template->set("page" , SITE_NAME . " | Request New Shop Creation");
        $template->set("id", $id);
        $template->render();
        
        
    }
    function newEduPlus($id){
        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/requests/new_edu");
        $template->set("page" , SITE_NAME . " | Request New Edu Plus");
        $template->set("id", $id);
        $template->render();
        
        
    }
    
        function newInvoice(){
            do_login();
     
        $login = $this->loadModel($this->gear ,"sun_api_model");
        $login->create_invoice();
        
     }

     function newInvoicePublic(){

          $login = $this->loadModel($this->gear ,"sun_api_model");
        $login->create_invoice_public();

     }
  

 }
