<?php

 use Engine\Core\Controller ;
 
 class Schools extends Controller{
    
    /*
    ==== Name Of Controller
    */
    private $gear = "schools";

    /*
    ==== Get All Users
    ==== User Level : Top Admins And Developers
    ==== Returns Array Of Users 
    ==== Wear
    */
    function index(){

        global $wear;
        do_login();
        admin_levels("Top Manager");
        $template = $this->loadView($wear->back . "/members/settings");
        $login = $this->loadModel($this->gear,"sun_school_model");
        $users = $login->get_users();
        $template->set("users" , $users);
        $template->set("page" , SITE_NAME . " | Settings");
        $template->render();
    }

    /*
    ==== Dashboard
    ==== Level : Registered Manager
    ==== Object Of User Data 
    ==== Wear
    */
     function settings($id){

        global $wear;
        do_login();
        admin_levels("Top Manager");
        $template = $this->loadView($wear->front . "/members/settings");
        $login    = $this->loadModel($this->gear,"sun_school_model");
        $school   = $login->find_school($id);
        $template->set("school" , $school);
        $template->set("page" , SITE_NAME . " | Settings");
        $template->render(); 

    }

    function saveSchool($id){
        
        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_school_model");
        $login->save_school($id);
        
     }

     function newUser(){
       
        do_login();
        user_permissions();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->start();
        
     }

     function saveImage($id){
        
        do_login();
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->save_image($id);
        
     }

     function savePassword($id){
        
        do_login();
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->save_password($id);
        
     }

     function deleteUser($id){
        
        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->delete_user($id);
        
     }

    
    
    

 }
