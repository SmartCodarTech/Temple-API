<?php

 use Engine\Core\Controller ;
 
 class Users extends Controller{
    
    /*
    ==== Name Of Controller
    */
    private $gear = "users";

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
        $template = $this->loadView($wear->back . "/users");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $users = $login->get_users();
        $template->set("users" , $users);
        $template->set("page" , SITE_NAME . " | All Users");
        $template->render();
    }
    
    function allUsers(){

        global $wear;
        do_login();
        admin_levels("Top Manager");
        $template = $this->loadView($wear->front . "/members/all_users");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $users = $login->get_users_manage();
        $tops = $login->get_users_top();
        $template->set("users" , $users);
        $template->set("tops" , $tops);
        $template->set("page" , SITE_NAME . " | All Users");
        $template->render();
    }
    /*
    ==== Dashboard
    ==== Level : Registered Manager
    ==== Object Of User Data 
    ==== Wear
    */
     function dashboard(){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/dashboard");
        $template->set("page" , SITE_NAME . " | Profile");
        $template->render(); 

    }

    function profileInfo($id){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/profileinfo");
        $login = $this->loadModel($this->gear, "sun_user_model");
        $user = $login->find_user($id);
        $template->set("user" , $user);
        $template->set("page" , SITE_NAME . " | Profile");
        $template->render(); 

    }



    function manage(){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/manage");
        $template->set("page" , SITE_NAME . " | Manage Access");
        $template->render(); 

    }


    /*
    ==== Edit Profile
    ==== Level : Member
    ==== Edits Profile
    ==== Void
    */

    function editUser($id){

        global $wear;
        do_login();
         admin_levels("Editor");
        $template = $this->loadView($wear->front. "/members/edit_user");
        $model = $this->loadModel($this->gear,"sun_user_model");
        $user = $model->find_user($id);
        $template->set("user" , $user);
        $template->set("page" , SITE_NAME . " | Editing user");
        $template->render();    
        
    }

    function editPassword($id){

        do_login();
        global $wear;
        $template = $this->loadView($wear->front . "/members/change_password");
        $model = $this->loadModel($this->gear,"sun_user_model");
        $user = $model->find_user($id);
        $template->set("user" , $user);
        $template->set("page" , SITE_NAME . " | Edit Password");
        $template->render();
            
    }

    function uploadImage($id){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/upload_image");
        $model = $this->loadModel($this->gear,"sun_user_model");
        $user = $model->find_user($id);
        $template->set("user" , $user);
        $template->set("page" , SITE_NAME . " | Upload Your Image");
        $template->render();   
        
    }

    function allMembers(){

        global $wear;
        do_login();
         admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/all_members");
        $model = $this->loadModel($this->gear,"sun_user_model");
        $users = $model->get_users();
        $template->set("users" , $users);
        $template->set("page" , SITE_NAME . " | Upload Your Image");
        $template->render();

    }


    
    function addUser(){

        global $wear;
        do_login();
         admin_levels("Editor");
        global $session;
        $template = $this->loadView($wear->back . "/add_user");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $id =$session->user_id;
        $user = $login->find_user($id);
        $template->set("user" , $user);
        $template->set("page" , SITE_NAME . " | Add User");
        $template->render();

    }


    /*
    ==== Login User
    ==== Level : Member
    ==== Redirects To User Page
    ==== Void
    */
    function login(){

        $model=$this->loadModel($this->gear, "sun_user_model");
        $model->login(); 

    }


    
    function saveUser($id){
        
        do_login();
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->save_user($id);
        
    }
    function signup(){

        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->signup();
        
    }
     
     function addUserProfile($id){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->add_profile($id);
        
     }

     function newUser(){
       
        do_login();
         admin_levels("Editor");
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

    function activateUser($id){
        
        do_login();
        admin_levels("Top Manager");
        $login = $this->loadModel($this->gear,"sun_user_model");
        $login->activate_user($id);
        
     }

    
    
    

 }
