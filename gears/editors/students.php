<?php

 use Engine\Core\Controller ;
 
 class Students extends Controller{
    
    /*
    ==== Name Of Controller
    */
    private $gear = "students";

    /*
    ==== Get All students
    ==== User Level : Top Admins And Developers
    ==== Returns Array Of Users 
    ==== Wear
    */
    function index(){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/students");
        $login = $this->loadModel($this->gear, "sun_student_model");
        $students = $login->get_students();
        $template->set("students" , $students);
        $template->set("page" , SITE_NAME . " | Students");
        $template->render(); 
        
    }

    /*
    ==== Dashboard
    ==== Level : Registered Manager
    ==== Object Of User Data 
    ==== Wear
    */

     function profile($id){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/students_profile");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $student = $model->get_student_profile($id);
        $template->set("student",$student);
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " |  Students Profile");
        $template->render(); 

    }

    function newProfile($id){
        
        do_login();
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->start($id);
        
     }

     function saveProfile($id,$user){
        
        do_login();
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->save_profile($id,$user);
        
     }

     function deleteProfile($id){
        
        do_login();
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->delete_profile($id);
        
     }

    
    
    

 }
