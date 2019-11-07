<?php

use Engine\Helpers\Resize;

class Sun_lecturer_model extends Model {
    

	protected $table="lecturers";
    protected static $db_fields = [
    							   'id',
                                   'name',
                                   'credit_hours', 
                                   'level',
                                   'description',
                                   'learning_objective',
                                   'lecturer_code',
                                   'program',
                                   'school_id'
    ];


    /*****************************************
  	*
  	* @ VOID 
  	* Create Program.
  	*
  	******************************************/   
    
    public function start($id){

      global $session;
	global $csrf;


    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'qualifications' => $_POST['qualifications']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('qualifications')->required()->length(3,600);

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

			$school_id = get_school_id_user($session->user_id);

            $sql ="INSERT INTO lecturers (
            							qualifications,
            							user_id,
            							school_id
            							) VALUES( 
	            						:qualifications,
	            						:user_id,
	            						:school_id
	            						)"; 

			$create = $this->query(
								$sql,
								[
								'qualifications'=>$_POST['qualifications'],
								'user_id'=>$id,
								'school_id'=> $school_id
								]
			); 

			if($create)
			{
				
				$session->message ("The Profile Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "lecturers/profile/" . $id);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "lecturers/profile/" . $id);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "lecturers/profile/" . $id);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "lecturers/profile/" . $id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "lecturers/profile/" . $id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "lecturers/profile/" . $id);

    }
    }    
     
     /*****************************************
  	*
  	* @ VOID 
  	* save Edited Program .
  	*
  	******************************************/

    public function save_profile($id,$user){

	global $session;
	global $csrf;
	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'qualifications' => $_POST['qualifications'],
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('qualifications')->required()->length(3,600);


	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {
	
            $sql ="UPDATE lecturers SET 
            						qualifications=:qualifications
            						WHERE id=:id "; 

			$update = $this->query(
								$sql,
								[
								'qualifications'=>$_POST['qualifications'],
								'id'=> $id
								]
			); 

			if($update)
			{
				
				$session->message ("The Profile Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "lecturers/profile/" . $user);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL ."lecturers/profile/" . $user);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."lecturers/profile/" . $user);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."lecturers/profile/" . $user);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "lecturers/profile/" .$user);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "lecturers/profile/" . $user);

    }
      
    }  


         /*****************************************
  	*
  	* @ VOID 
  	* save Student Grade .
  	*
  	******************************************/

    public function save_grade($user_id,$term_course){

	global $session;
	global $csrf;
	$id =$user_id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'course' => $_POST['course'],
	        		  'level' => $_POST['level'],
	        		  'grade' => $_POST['grade'],
	        		  'score' => $_POST['score']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('course')->required()->toInt();
            $valid->field('level')->required()->toInt();
            $valid->field('grade')->required()->length(1,2);
            $valid->field('score')->required();

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

	        $course = $_POST['course'];
	        $level  = $_POST['level'];

            $query ="SELECT * FROM transcripts WHERE 
            						                course_id=:course_id
            						                AND
            						                level=:level
            						                AND 
            						                user_id=:user_id
            						                LIMIT 1 "; 

			$result = $this->query(
								$query,
								[
								'course_id'=>$course,
								'level'=>$level,
								'user_id'=> $id
								],
								PDO::FETCH_OBJ
			); 	

			if(!empty($result)){

            $new = array_shift($result);
            $trans_id = $new->id;

            $sql ="UPDATE transcripts SET 
            						grade=:grade,
            						score=:score
            						WHERE id=:id "; 

			$update = $this->query(
								$sql,
								[
								'grade'=>$_POST['grade'],
								'score'=>$_POST['score'],
								'id'=> $trans_id
								]
			); 

			if($update)
			{
				
				$session->message ("The Student's Grade  Has  Been Successfully Set.");
                redirect_to(BASE_URL . "lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);

				
			}else {

				$session->message ("Something Went Wrong" .$trans_id);
                redirect_to(BASE_URL ."lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);
			}


			}else{

				$session->message ("Transcript Entry Could Not Be found.");
                redirect_to(BASE_URL . "lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);

			}        


			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "lecturers/studentsInCourse/" . $term_course . "/". $_POST['course']);

    }
      
    } 
    
    

          /*****************************************
  	*
  	* @ VOID 
  	* save Student Grade .
  	*
  	******************************************/

    public function save_remarks($id,$course){

	global $session;
	global $csrf;
	$id = (int) $id;
	$course = (int) $course;
	$C =get_course_by_id($course);

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'rate' => $_POST['rate'],
	        		  'reason_for_rate' => $_POST['reason_for_rate'],
	        		  'remarks' => $_POST['remarks'],
	        		  'advice' => $_POST['advice']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('rate')->required()->intRange(1,10)->toInt();
            $valid->field('reason_for_rate')->required()->length(1,1000);
            $valid->field('remarks')->required()->length(1,1000);
            $valid->field('advice' ,"How Student Can Improve")->required()->length(1,1000);;

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

			$created_at = strftime("%y-%m-%d %hh:%mm:%ss", time());

            $sql ="INSERT INTO remarks (
            	                 rate,
            	                 reason_for_rate,
            	                 remarks,
            	                 advice,
            	                 user_id,
            	                 course_id,
            	                 level,
            	                 lecturer_id,
            	                 created_at
            	                 )VALUES(
            					 :rate,
            	                 :reason_for_rate,
            	                 :remarks,
            	                 :advice,
            	                 :user_id,
            	                 :course_id,
            	                 :level,
            	                 :lecturer_id,
            	                 :created_at	
            					 )"; 

			$update = $this->query(
								$sql,
								[
								'rate'=>$_POST['rate'],
								'reason_for_rate'=>$_POST['reason_for_rate'],
								'remarks'=>$_POST['remarks'],
								'advice'=>$_POST['advice'],
								'user_id'=>$id,
								'course_id'=>$course,
								"level"=>$C->level,
            	                'lecturer_id'=>$session->user_id,
								'created_at'=> $created_at
								]
			); 

			if($update)
			{
				
				$session->message ("The Remarks  Have Been Set.");
                redirect_to(BASE_URL . "lecturers/addRemark/" . $id . "/". $course);

				
			}else {

				$session->message ("Something Went Wrong" .$trans_id);
                redirect_to(BASE_URL ."lecturers/addRemark/" . $id . "/". $course);
			}



			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."lecturers/addRemark/" . $id . "/". $course);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."lecturers/addRemark/" . $id . "/". $course);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "lecturers/addRemark/" . $id . "/". $course);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "lecturers/addRemark/" . $id . "/". $course);

    }
      
    } 
    
      
      /*****************************************
  	*
  	* @ array 
  	* Return array of objects of Programs .
  	*
  	******************************************/

    function get_lecturers(){
  
    $sql = "SELECT * FROM users WHERE user_type =:user_type";		
    $new = $this->query(
    					$sql,
    					[
    					"user_type"=>"3"
    					],
    					PDO::FETCH_OBJ
    );
    return $new;
      
    }

    function get_course_results($id){
     
     $academic_year = get_academic_year_by_id();
    $sql = "SELECT * FROM transcripts WHERE 
    										course_id=:course_id 
    										AND
    										academic_year=:academic_year";		
    $new = $this->query(
    					$sql,
    					[
    					"course_id"=>$id,
    					"academic_year"=>$academic_year
    					],
    					PDO::FETCH_OBJ
    );
    return $new;
      
    }

    function get_lecturer_profile($id){

    $sql = "SELECT * FROM lecturers WHERE user_id =:user_id  LIMIT 1";		
    $new = $this->query(
    					$sql,
    					[
    					"user_id"=>$id
    					],
    					PDO::FETCH_OBJ
    );
    return array_shift($new);



    }
    
      /*****************************************
  	*
  	* @ User Object 
  	* Find Program .
  	*
  	******************************************/
    function find_lecturer($id){

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
    function delete_lecturer($id){
      
    global $session;
    $id= $id;
      
        if(get_user_level($id) != "Developer" ){

		   $session->message("You Cannot Delete A Lecturer");
		   redirect_to(BASE_URL. "lecturers/lecturerList");

	    }else{

	       $sql =  "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";
	       $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);

	       if($new){
		  
		       $session->message("The User Has Been Deleted Successfully");
	           redirect_to(BASE_URL. "lecturers/lecturerList");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "lecturers/lecturerList");

	         }
	    
        }

    }
  

}