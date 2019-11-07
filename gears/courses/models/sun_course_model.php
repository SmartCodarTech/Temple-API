<?php

use Engine\Helpers\Resize;

class Sun_course_model extends Model {
    

	protected $table="courses";
    protected static $db_fields = [
    							   'id',
                                   'name',
                                   'credit_hours', 
                                   'level',
                                   'description',
                                   'learning_objective',
                                   'course_code',
                                   'program',
                                   'school_id'
    ];


    /*****************************************
  	*
  	* @ VOID 
  	* Create Program.
  	*
  	******************************************/   
    
    public function start(){

      global $session;
	global $csrf;


    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'name' => $_POST['name'],
	        		  'level' => $_POST['level'],
	        		  'course_code' => $_POST['course_code'],
	        		  'description' => $_POST['description'],
	        		  'learning_objective' => $_POST['learning_objective'],
	        		  'credit_hours' => $_POST['credit_hours'],
	        		  'program'=>$_POST['program']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('name')->required()->length(3,250);
            $valid->field('level')->required()->length(1,30)->toInt();
            $valid->field('course_code')->required();
            $valid->field('description')->required()->length(3,500);
            $valid->field('learning_objective')->required()->length(3,500);
            $valid->field('credit_hours')->required()->toInt();
            $valid->field('program')->required()->toInt();

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

			$school_id = get_school_id_user($session->user_id);

            $sql ="INSERT INTO courses (
            							name,
            							level,
            							course_code,
            							description,
            							learning_objective,
            							credit_hours,
            							program,
            							school_id
            							) VALUES( 
	            						:name,
	            						:level,
	            						:course_code,
	            						:description,
	            						:learning_objective,
	            						:credit_hours,
	            						:program,
	            						:school_id
	            						)"; 

			$create = $this->query(
								$sql,
								[
								'name'=>$_POST['name'],
								'level'=>$_POST['level'],
								'course_code'=>$_POST['course_code'],
								'description'=>$_POST['description'],
								'learning_objective'=>$_POST['learning_objective'],
								'credit_hours'=>$_POST['credit_hours'],
								'program'=>$_POST['program'],
								'school_id'=> $school_id
								]
			); 

			if($create)
			{
				
				$session->message ("The Course Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "courses/");

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "courses/");
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "courses/");

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "courses/");

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "courses/");
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "courses/");

    }
    }    
     
     /*****************************************
  	*
  	* @ VOID 
  	* save Edited Program .
  	*
  	******************************************/

    public function save_course($id){

	global $session;
	global $csrf;
	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'name' => $_POST['name'],
	        		  'level' => $_POST['level'],
	        		  'course_code' => $_POST['course_code'],
	        		  'description' => $_POST['description'],
	        		  'learning_objective' => $_POST['learning_objective'],
	        		  'credit_hours' => $_POST['credit_hours'],
	        		  'program'=>$_POST['program']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('name')->required()->length(3,250);
            $valid->field('level')->required()->length(1,30)->toInt();
            $valid->field('course_code')->required();
            $valid->field('description')->required()->length(3,500);
            $valid->field('learning_objective')->required()->length(3,500);
            $valid->field('credit_hours')->required()->toInt();
            $valid->field('program')->required()->toInt();

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {
	
            $sql ="UPDATE courses SET 
            						name=:name,
            						level=:level,
            						course_code=:course_code,
            						description=:description,
            						learning_objective=:learning_objective,
            						credit_hours=:credit_hours,
            						program=:program
            						WHERE id=:id "; 

			$update = $this->query(
								$sql,
								[
								'name'=>$_POST['name'],
								'level'=>$_POST['level'],
								'course_code'=>$_POST['course_code'],
								'description'=>$_POST['description'],
								'learning_objective'=>$_POST['learning_objective'],
								'credit_hours'=>$_POST['credit_hours'],
								'program'=>$_POST['program'],
								'id'=> $id
								]
			); 

			if($update)
			{
				
				$session->message ("The Course Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "courses/editCourse/" .$id);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "courses/editCourse/" .$id);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "courses/editCourse/" .$id );

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "courses/editCourse/" .$id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "courses/editCourse/" .$id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "courses/editCourse/" .$id);

    }
      
    }  

     

         /*****************************************
  	*
  	* @ VOID 
  	* Add Term Courses.
  	*
  	******************************************/

    public function add_term_courses(){

	global $session;
	global $csrf;


    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'term' => $_POST['term'],
	        		  'program' => $_POST['program']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('term')->required()->length(1,11)->toInt();
            $valid->field('program')->required()->length(1,22)->toInt();


	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

    		$term =  $_POST['term'];
    		$program =$_POST['program'];
    		$academic_year = get_academic_year_by_id();
    		$created_at = strftime("%y-%m-%d H:mm:ss",time());
            $school_id = get_school_id_user($session->user_id);
               
            $sql = " SELECT * FROM courses WHERE level=:level AND program=:program AND school_id=:school_id";
			$course_data = $this->query(
				                      $sql, 
				                      [
				                      "level" => $term,
				                      "program" => $program,
				                      "school_id" =>$school_id
				                      ], 
				                      PDO::FETCH_OBJ
			);

			if(!empty($course_data)){
                  
               $add =0;
               $msg="";
               foreach ($course_data as $course) {

            $sql = " SELECT * FROM term_courses WHERE course_id=:course_id AND school_id=:school_id";
			$check = $this->query(
				                      $sql, 
				                      [
				                      "course_id" => $course->id,
				                      "school_id" =>$course->school_id
				                      ], 
				                      PDO::FETCH_OBJ
			);
               	if(empty($check)){

                $sql ="INSERT INTO term_courses (
            							course_id,
            							level,
            							academic_year,
            							created_at,
            							school_id,
            							program
            							) VALUES( 
            							:course_id,
            							:level,
            							:academic_year,
            							:created_at,
            							:school_id,
            							:program
	            						)"; 

			    $create = $this->query(
								$sql,
								[
								'course_id'=>$course->id,
								'level'=>$course->level,
								'academic_year'=>$academic_year,
								'created_at'=> $created_at,
								'school_id' =>$school_id,
								'program' => $program
								]
			    );

			    $add++;

			   }else{

			   	$msg = " - Courses Have Been Added Already";

			   }

               }
                 
                $session->message ( $add ." - Courses Added To List " .$msg);
                redirect_to(BASE_URL . "courses/registerTerm");

			}else{


            	$session->message ("No courses To Add");
                redirect_to(BASE_URL . "courses/registerTerm");

			}

			if($update)
			{
				
				$session->message ("The Course Has  Been Successfully Saved.");
                redirect_to(BASE_URL ."courses/registerTerm");

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "courses/registerTerm");
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "courses/registerTerm" );

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "courses/registerTerm");

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "courses/registerTerm");
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "courses/registerTerm");

    }
      
    } 
      
    
    function add_lecturer($course_id){

    
    global $session;

  	$sql = "SELECT * FROM 
  						  term_courses 
  						  WHERE 
  						  course_id=:course_id 
  						  LIMIT 1";		
    $new = $this->query(
    					$sql,
    					[
    					"course_id"=>$course_id
    					],
    					PDO::FETCH_OBJ
    );

    if(!empty($new)){ 

    	$art = array_shift($new); 
    	$id= $art->id;

    }else{
    	$session->message ("The Course You Are Looking For Doesnot Exists. Or Access Denied");
        redirect_to(BASE_URL . "courses/registeredTermCourses");
    }
    

    $lec=$_POST['lecturer'];
    $id= $art->id;

    if(!empty($art)){ 

    	$arti = $art;
        $add =$arti->lecturers;

        if(empty($add)){
          
          $to_add = $lec;
           
        }else{
        
          $holder = explode(",", $arti->lecturers);
          if(in_array($lec, $holder)){
           
           $session->message ("Sorry You Have Added This Lecturer For This Course Already.");
           
           redirect_to(BASE_URL . "courses/registeredTermCourses");

          }else{

          $to_add = $arti->lecturers . "," . $lec;

          }
        }


    }else{
    	$session->message ("The Course  You Are Looking For Doesnot Exists.");
        redirect_to(BASE_URL ."courses/registeredTermCourses");
    }
    
        
        
			
            $sql ="UPDATE term_courses SET lecturers=:lecturers WHERE id=:id"; 
		    $update = $this->query($sql,array(
			'lecturers'=>$to_add,
		    'id'=>$id)); 

			if($update)
			{


				 $session->message ("You Have Successfully Set Lecturer For This Course.");
                 redirect_to(BASE_URL . "courses/registeredTermCourses");
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "courses/registeredTermCourses");
			}



    }

    

    function remove_lecturer($lec,$course_id){
    
     global $session;

  	$sql = "SELECT * FROM 
  						  term_courses 
  						  WHERE 
  						  course_id=:course_id 
  						  LIMIT 1";		
    $new = $this->query(
    					$sql,
    					[
    					"course_id"=>$course_id
    					],
    					PDO::FETCH_OBJ
    );

    if(!empty($new)){ 

    	$art = array_shift($new); 
    	$id= $art->id;

    }else{

    	$session->message ("The Course You Are Looking For Doesnot Exists. Or Access Denied");
        redirect_to(BASE_URL . "courses/registeredTermCourses");
    }


    if(!empty($art)){ 

    	$arti = $art;
        $add =$arti->lecturers;

        if(empty($add)){
          
          $to_add = " ";
           
        }else{
        
          $holder = explode(",", $arti->lecturers);
          $adds =[];
          $to_add="";
          
          if(!in_array($lec, $holder)){
           
           $session->message ("Sorry This Lecturer Is Not In the List.");
           
           redirect_to(BASE_URL . "courses/registeredTermCourses");

          }else{

          	foreach ($holder as $hold) {
          		
          		if($hold != $lec){
                 $adds[] = $hold; 
          		}

          	}

          	$to_add = implode(",", $adds);

          

          }


        }


    }else{
    	$session->message ("The Course  You Are Looking For Doesnot Exists.");
        redirect_to(BASE_URL ."courses/registeredTermCourses");
    }



    $sql ="UPDATE term_courses SET lecturers=:lecturers WHERE id=:id"; 
		    $update = $this->query($sql,array(
			'lecturers'=>$to_add,
		    'id'=>$id)); 

			if($update)
			{


				 $session->message ("You Have Successfully Set Lecturer For This Course.");
                 redirect_to(BASE_URL . "courses/registeredTermCourses");
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "courses/registeredTermCourses");
			}

    }
      
      /*****************************************
  	*
  	* @ array 
  	* Return array of objects of Programs .
  	*
  	******************************************/

    function get_courses(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
    }

    function get_term_courses($id){
  
    $sql = "SELECT * FROM term_courses WHERE program=:program";		
    $new = $this->query($sql,
    	[
         "program"=>$id 
    	],PDO::FETCH_OBJ);
    return $new;
      
    }
    
      /*****************************************
  	*
  	* @ User Object 
  	* Find Program .
  	*
  	******************************************/
    function find_course($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,["id"=>$id],PDO::FETCH_OBJ);
    if(!empty($new)){ 

    	return array_shift($new);
    }else{
    	return $new;
    }
    } 

     /*****************************************
  	*
  	* @ VOID 
  	* Delete Program From Database .
  	*
  	******************************************/
    function delete_course($id){
      
    global $session;
    $id= $id;
      
        if(get_user_level($id) != "Developer" ){

		   $session->message("You Cannot Delete A School");
		   redirect_to(BASE_URL. "courses/courseList");

	    }else{

	       $sql =  "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";
	       $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);

	       if($new){
		  
		       $session->message("The User Has Been Deleted Successfully");
	           redirect_to(BASE_URL. "courses/courseList");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "courses/courseList");

	         }
	    
        }

    }
  

}