<?php

 use Engine\Core\Controller ;
 
 class Courses extends Controller{
    
    /*
    ==== Name Of Controller
    */
    private $gear = "courses";

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
        $template = $this->loadView($wear->front . "/members/courses");
        $login = $this->loadModel("programs", "sun_program_model");
        $programs = $login->get_programs();
        $template->set("programs" , $programs);
        $template->set("page" , SITE_NAME . " | Courses");
        $template->render(); 
        
    }

    /*
    ==== Dashboard
    ==== Level : Registered Manager
    ==== Object Of User Data 
    ==== Wear
    */

     function editCourse($id){

        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/edit_course");
        $login    = $this->loadModel($this->gear,"sun_course_model");
        $model = $this->loadModel("programs", "sun_program_model");
        $programs = $model->get_programs();
        $template->set("programs" , $programs);
        $course   = $login->find_course($id);
        $template->set("course" , $course);
        $template->set("page" , SITE_NAME . " | Edit Course");
        $template->render(); 

    }

    function courseList(){
        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/all_courses");
        $login    = $this->loadModel($this->gear,"sun_course_model");
        $courses   = $login->get_courses();
        $template->set("courses" , $courses);
        $template->set("page" , SITE_NAME . " | All courses");
        $template->render(); 

    }

    function registeredTermCourses($id){
 

        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/term_courses");
        $login    = $this->loadModel($this->gear,"sun_course_model");
        $courses   = $login->get_term_courses($id);
        $template->set("courses" , $courses);
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " | All courses");
        $template->render(); 


    }

    function registerTerm(){
        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/register_term_courses");
        $model = $this->loadModel("programs", "sun_program_model");
        $programs = $model->get_programs();
        $template->set("programs" , $programs);
        $template->set("page" , SITE_NAME . " | Register Term Courses");
        $template->render(); 
    }

    function setLecturer($course_id){
        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/set_lecturer");
        $model = $this->loadModel("lecturers", "sun_lecturer_model");
        $lecturers = $model->get_lecturers();
        $template->set("lecturers" , $lecturers);
        $template->set("course_id",$course_id);
        $template->set("page" , SITE_NAME . " | Set Lecturer");
        $template->render(); 
    }
    
    function addTermCourses(){

        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_course_model");
        $login->add_term_courses();
    
    }

    function removeLecturer($lec,$course_id){

        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_course_model");
        $login->remove_lecturer($lec,$course_id);
    
    }

    function addLecturer($course_id){

        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_course_model");
        $login->add_lecturer($course_id);
    
    }

    function addCourse(){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_course_model");
        $login->start();
        
     }

     function saveCourse($id){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_course_model");
        $login->save_course($id);
        
     }

     function deleteCourse($id){
        
        do_login();
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_course_model");
        $login->delete_course($id);
        
     }

    
    
    

 }
