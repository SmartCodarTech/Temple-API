<?php

 use Engine\Core\Controller ;
 
 class Manage extends Controller{

      /*
    ==== Name Of Gear
    */
    private $gear = "manage";
    
    #-----Index / Home Page -------#

    function index(){

        do_login();
        user_permissions();
        global $wear;
        $template = $this->loadView($wear->back . "/index");
        $template->set("page" , SITE_NAME . " | Manage App");
        $template->render();   

    }
    
    #-----App Info -------#

    function appInfo(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/anole/App_info");
        $template->set("page" , SITE_NAME . " | Application Info");
        $template->render();

    }
    


    #-----General Site Settings -------#

    function generalSettings(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Top Manager");
        $template = $this->loadView($wear->back . "/settings/general");
        $template->set("page" , SITE_NAME . " | Wear Settings");
        $template->render();

    }

    function appSettings(){

        global $wear;
        global $session;
        do_login();
        admin_levels("Top Manager");
        $template = $this->loadView($wear->front . "/members/app_settings");
        $template->set("page" , SITE_NAME . " | Application Settings");
        $template->render();

    }

    #-----Set Editing Mode -------#

    function setEditingMode($status){
        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_settings_model");
        $login->set_mode($status);

    }

    function setDataEntryMode($status){

        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_settings_model");
        $login->set_data_entry($status);
    }


    function setAdvanceStudents($status){

        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_settings_model");
        $login->set_advance_students($status);
    }

    function setRegistrationMode($status){

        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_settings_model");
        $login->set_student_registration($status);

    }

    #-----Components -------#

    function components(){

        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/anole/components");
        $template->set("page" , SITE_NAME . " | Components Installed");
        $template->render();

    }

    #-----Wear Settings-------#
    function wearSettings(){
        global $wear;
        global $session;
        do_login();
        user_permissions();
        $template = $this->loadView($wear->back . "/settings/wear");
        $template->set("page" , SITE_NAME . " | Wear Settings");
        $template->render();
    }
    

    #-----Save Edited Page Element -------#
            function saveEdit()
    {

            $new = $this->loadModel($this->gear,'sun_edit_model');
            $new->save_edited_element();

    }
    


    #-----Uplaod A file-------#
     function editUpload()
    {      
        
            $new = $this->loadModel($this->gear,'sun_edit_model');
            $new->Uploads();     
    
    }

    
    #-----Start Editing-------#
        function enter()
    {
            $new = $this->loadModel($this->gear,'sun_edit_model');
            $new->start();
    }
    

    #-----Stop Editing-------#
    function stop()
    {
            $new = $this->loadModel($this->gear,'sun_edit_model');
            $new->stop();      
    
    }  

 }
