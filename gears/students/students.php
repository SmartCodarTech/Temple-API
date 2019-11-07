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
        admin_levels("Editor");
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
        $login = $this->loadModel("programs", "sun_program_model");
        $programs = $login->get_programs();
        $template->set("programs" , $programs);
        $template->set("page" , SITE_NAME . " |  Students Profile");
        $template->render(); 

    }

    function recordLogs(){

        global $wear;
        do_login();
        admin_levels("Top Manager");
        $template = $this->loadView($wear->front . "/members/record_logs");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $logs = $model->get_record_logs();
        $template->set("logs",$logs);
        $template->set("page" , SITE_NAME . " |  Record Logs");
        $template->render(); 

    }

    function resitUpdate($id){

        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/resit_update");
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " |  Update Resit Scores");
        $template->render(); 

    }

    function completed($id){

        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/completed");
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " |  View Completed Student Details");
        $template->render(); 

    }

    function failedCourses(){

        global $wear;
        do_login();
        $template = $this->loadView($wear->front . "/members/failed_courses");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $template->set("page" , SITE_NAME . " |  Failed Courses");
        $template->render(); 

    }

    function failed(){

        global $wear;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/failed");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $template->set("page" , SITE_NAME . " |  Failed Courses");
        $template->render(); 

    }

    function checkResults($id){

        global $wear;
        global $session;
        do_login();
        if(get_user_level($session->user_id) == "Student" && $id != $session->user_id){
             
             $session->message("You Can't Acess This Page");
             redirect_to(BASE_URL. "users/dashboard");
        }
        $template = $this->loadView($wear->front . "/members/check_results");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $student = $model->get_student_profile($id);
        $template->set("student",$student);
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " |  Check Student's Results");
        $template->render(); 

    }

    function recordsEntry($id,$program){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/records_entry");
        $template->set("id",$id);
        $template->set("program",$program);
        $template->set("page" , SITE_NAME . " |  Check Student's Results");
        $template->render(); 

    }

    function enterRecords($level,$id,$program){

        global $wear;
        global $session;
        do_login();
        admin_levels("Editor");
        $template = $this->loadView($wear->front . "/members/enter_records");
        $template->set("id",$id);
        $template->set("program",$program);
        $template->set("level",$level);
        $template->set("page" , SITE_NAME . " |  Enter Student's Records");
        $template->render(); 

    }

    function performance($id){

        global $wear;
        global $session;
        do_login();
        if(get_user_level($session->user_id) == "Student" && $id != $session->user_id){
             
             $session->message("You Can't Acess This Page");
             redirect_to(BASE_URL. "users/dashboard");
        }
        $template = $this->loadView($wear->front . "/members/students_performance");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $student = $model->get_student_profile($id);
        $template->set("student",$student);
        $template->set("id",$id);
        $template->set("page" , SITE_NAME . " |  Check Student's Performance");
        $template->render(); 

    }

    function termResults($level,$user_id){

        global $wear;
        global $session;
        do_login();
         if(get_user_level($session->user_id) == "Student" && $user_id != $session->user_id){
             
             $session->message("You Can't Acess This Page");
             redirect_to(BASE_URL. "users/dashboard");
        }
        $template = $this->loadView($wear->front . "/members/view_results");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $student = $model->get_student_profile($user_id);
        $template->set("student",$student);
        $template->set("id",$user_id);
        $template->set("level",$level);
        $results = $model->get_results($level,$user_id);
        $template->set("results" , $results);
        $template->set("page" , SITE_NAME . " |  Check Student's Results");
        $template->render(); 

    }

    function performanceData($level,$user_id){

        global $wear;
         global $session;
        do_login();
        if(get_user_level($session->user_id) == "Student" && $user_id != $session->user_id){
             
             $session->message("You Can't Acess This Page");
             redirect_to(BASE_URL. "users/dashboard");
        }
        $template = $this->loadView($wear->front . "/members/performance_data");
        $model    = $this->loadModel($this->gear,"sun_student_model");
        $template->set("id",$user_id);
        $template->set("level",$level);
        $template->set("page" , SITE_NAME . " | Performance Data");
        $template->render(); 

    }

    function newProfile($id){
        
        do_login();
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->start($id);
        
     }
     function registerCourse($id,$course_id){
        
        do_login();
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->register_course($id,$course_id);
        
     }

     function saveProfile($id,$user){
        
        do_login();
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->save_profile($id,$user);
        
     }

     function saveResit($id){
        
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->save_resit($id);

     }

      function saveRecords($level,$id,$program){


        do_login();
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->save_records($level,$id,$program);

    }

     function deleteProfile($id){
        
        do_login();
        admin_levels("Editor");
        $login = $this->loadModel($this->gear,"sun_student_model");
        $login->delete_profile($id);
        
     }

    
    
    

 }
