<?php

 use Engine\Core\Controller ;
 
 class Programs extends Controller{
    
    /*
    ==== Name Of Controller
    */
    private $gear = "programs";

    /*
    ==== Get All Users
    ==== User Level : Top Admins And Developers
    ==== Returns Array Of Users 
    ==== Wear
    */
    function index(){
        
        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/programs");
        $template->set("page" , SITE_NAME . " | Programs");
        $template->render(); 

    }

    /*
    ==== Dashboard
    ==== Level : Registered Manager
    ==== Object Of User Data 
    ==== Wear
    */

     function editProgram($id){

        global $wear;
        do_login();
         admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/edit_program");
        $login    = $this->loadModel($this->gear,"sun_program_model");
        $program   = $login->find_program($id);
        $template->set("program" , $program);
        $template->set("page" , SITE_NAME . " | Settings");
        $template->render(); 

    }

    function allCourses($id){

        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/courses_in_program");
        $login    = $this->loadModel($this->gear,"sun_program_model");
        $courses   = $login->find_courses($id);
        $template->set("courses" , $courses);
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " | Settings");
        $template->render(); 

    }

    function programList(){
        global $wear;
        do_login();
         admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/all_programs");
        $login    = $this->loadModel($this->gear,"sun_program_model");
        $programs   = $login->get_programs();
        $template->set("programs" , $programs);
        $template->set("page" , SITE_NAME . " | All Programs");
        $template->render(); 

    }

    function addProgram(){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_program_model");
        $login->start();
        
     }

     function saveProgram($id){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_program_model");
        $login->save_program($id);
        
     }

     function deleteProgram($id){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_program_model");
        $login->delete_program($id);
        
     }

    
    
    

 }
