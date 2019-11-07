<?php

 use Engine\Core\Controller ;
 
 class Lecturers extends Controller{
    
    /*
    ==== Name Of Controller
    */
    private $gear = "lecturers";

    /*
    ==== Get All Lecturers
    ==== User Level : Top Admins And Developers
    ==== Returns Array Of Users 
    ==== Wear
    */
    function index(){

        global $wear;
        do_login();
         admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/lecturers");
        $login = $this->loadModel($this->gear, "sun_lecturer_model");
        $lecturers = $login->get_lecturers();
        $template->set("lecturers" , $lecturers);
        $template->set("page" , SITE_NAME . " | lecturers");
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
         admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/lecturers_profile");
        $model    = $this->loadModel($this->gear,"sun_lecturer_model");
        $lecturer = $model->get_lecturer_profile($id);
        $template->set("lecturer" , $lecturer);
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " | Lecturer Profile");
        $template->render(); 

    }

    function studentsInCourse($id,$course){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/lecturers_students");
        $template->set("id",$id);
        $template->set("course",$course);
        $template->set("page" , SITE_NAME . " | Lecturer Profile");
        $template->render();

    }

    function gradeStudent($stu,$course,$level,$program,$term_course){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/grade_student");
        $template->set("id",$stu);
        $template->set("course",$course);
        $template->set("level",$level);
        $template->set("program",$program);
        $template->set("term_course",$term_course);
        $template->set("page" , SITE_NAME . " | Grade Student");
        $template->render();

    }

    function addRemark($stu,$course){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/lecturer_add_remark");
        $template->set("id",$stu);
        $template->set("course",$course);
        $template->set("page" , SITE_NAME . " | Grade Student");
        $template->render();

    }

    function viewCourseResults($course){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/course_results");
        $model    = $this->loadModel($this->gear,"sun_lecturer_model");
        $results = $model->get_course_results($course);
        $template->set("results" , $results);
        $template->set("course",$course);
        $template->set("page" , SITE_NAME . " | View Course Results");
        $template->render();

    }

    function newProfile($id){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_lecturer_model");
        $login->start($id);
        
     }

     function saveGrade($id,$term_course){

        do_login();
        $login = $this->loadModel($this->gear,"sun_lecturer_model");
        $login->save_grade($id,$term_course);

     }

    function saveRemarks($id,$course){

        do_login();
        $login = $this->loadModel($this->gear,"sun_lecturer_model");
        $login->save_remarks($id,$course);

     }

     function saveProfile($id,$user){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_lecturer_model");
        $login->save_profile($id,$user);
        
     }

     function deleteProfile($id){
        
        do_login();
         admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_lecturer_model");
        $login->delete_profile($id);
        
     }

    
    
    

 }
