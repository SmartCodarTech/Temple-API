<?php

use Engine\Helpers\Resize;

class Sun_student_model extends Model {
    

	protected $table="students";
    protected static $db_fields = [
    							   'id',
                                   'name',
                                   'credit_hours', 
                                   'level',
                                   'description',
                                   'learning_objective',
                                   'student_code',
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
	        		  'level' => $_POST['level'],
	        		  'age'  => $_POST['age'],
	        		  'student_id' =>$_POST['student_id'],
	        		  'program' =>$_POST['program'],
                'academic_year' =>$_POST['academic_year']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('level')->required()->length(1,5);
            $valid->field('age')->required()->intRange(2,100);
            $valid->field('student_id')->length(1,11);
            $valid->field('program')->required()->toInt();
            $valid->field('academic_year')->required();

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

			$school_id = get_school_id_user($session->user_id);

            $sql ="INSERT INTO students (
            							level,
            							age,
            							user_id,
            							school_id,
            							student_id,
            							program,
                          academic_year,
                          final,
                          completed
            							) VALUES( 
	            						:level,
	            						:age,
	            						:user_id,
	            						:school_id,
	            						:student_id,
	            						:program,
                          :academic_year,
                          :final,
                          :completed
	            						)"; 

			$create = $this->query(
								$sql,
								[
								'level'=>$_POST['level'],
								'age'=>$_POST['age'],
								'user_id'=>$id,
								'student_id'=>$_POST['student_id'],
                'program'=>$_POST['program'],
								'school_id'=> $school_id,
                'academic_year'=>$_POST['academic_year'],
                'final'=>'NO',
                'completed'=>'NO'
								]
			); 

			if($create)
			{
				
				$session->message ("The Profile Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "students/profile/" . $id);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "students/profile/" . $id);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "students/profile/" . $id);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "students/profile/" . $id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "students/profile/" . $id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "students/profile/" . $id);

    }
    }    

    function save_resit($id){


  global $session;
  global $csrf;
  $id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
    if (isset($_POST['submit'])) { // Form has been submitted.

        $errors = [];
        
          #-----Set The Data To be validated ------#

          $data = [
                'score' => $_POST['score'],
                'grade'  => $_POST['grade']
          ];
          
          #-----Instantiate Validation Class ------#

          $valid = new Engine\Helpers\InputValidator($data);
          
          #-----Start Validation ------#

            $valid->field('score')->required()->toInt();
            $valid->field('grade')->required()->length(1,2);

          #---- Check For any Errors ------#

          if(!$valid->allValid()) {
         
            $errors = $valid->getErrors(); // returns an array of errors indexed by field

          }
      
       #---- Get User ------#
    if ( empty($errors) ) {
               $created_at = strftime("%y-%m-%d %H:%M:%S",time());
  
            $sql ="UPDATE transcripts SET 
                        score=:score,
                        grade=:grade
                        WHERE id=:id "; 

      $update = $this->query(
                $sql,
                [
                'score'=>$_POST['score'],
                'grade'=>$_POST['grade'],
                'id'=> $id
                ]
      ); 

                  $sql ="INSERT INTO resits_log (
                          transcript_id,
                          saved_by,
                          created_at
                          ) VALUES( 
                          :transcript_id,
                          :saved_by,
                          :created_at
                          )"; 

      $create = $this->query(
                $sql,
                [
                'transcript_id'=>$id,
                'saved_by'=>$session->user_id,
                'created_at'=>$created_at
                ]
      ); 

      if($update)
      {
        
        $session->message ("Record Has Updates");
        redirect_to(BASE_URL . "students/resitUpdate/" . $id);

        
      }else {

        $session->message ("Something Went Wrong");
        redirect_to(BASE_URL ."students/resitUpdate/" . $id);
      }
      
    } else {

      if (count($errors) == 1) {

        $session->message ("There Was An Error.<br/>" . 
                   join("<br/>",$errors));
                redirect_to(BASE_URL ."students/resitUpdate/" . $id);

      } else {

        $session->message ("There were errors . Check Them <br/>" . 
                   join("<br/>",$errors));
                redirect_to(BASE_URL ."students/resitUpdate/" . $id);

      }

    }
    
  
  } else { // Form has not been submitted.
    
    $session->message ("Submit Form ");
    redirect_to(BASE_URL . "students/resitUpdate/" .$id);

  }
  
  

    }else{
   
    $session->message ("Refresh The Page And Try Again");
    redirect_to(BASE_URL . "students/resitUpdate/" . $id);

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
	        		  'level' => $_POST['level'],
	        		  'age'  => $_POST['age'],
	        		  'student_id' =>$_POST['student_id'],
                'academic_year' =>$_POST['academic_year']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('level')->required()->length(1,5);
            $valid->field('age')->required()->intRange(2,100);
            $valid->field('student_id')->required()->length(1,11);
            $valid->field('academic_year')->required();


	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {
	
            $sql ="UPDATE students SET 
            						level=:level,
            						age=:age,
            						student_id=:student_id,
                        academic_year=:academic_year
            						WHERE id=:id "; 

			$update = $this->query(
								$sql,
								[
								'level'=>$_POST['level'],
								'age'=>$_POST['age'],
								'student_id'=>$_POST['student_id'],
                'academic_year'=>$_POST['academic_year'],
								'id'=> $id
								]
			); 

			if($update)
			{
				
				$session->message ("The Profile Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "students/profile/" . $user);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL ."students/profile/" . $user);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."students/profile/" . $user);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL ."students/profile/" . $user);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "students/profile/" .$user);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "students/profile/" . $user);

    }
      
    }  


    function register_course($id, $course_id){

    
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
        redirect_to(BASE_URL . "users/dashboard/");
    }
    

    $stu=$session->user_id;
    $id= $art->id;

    if(!empty($art)){ 

    	$arti = $art;
        $add =$arti->students;

        if(empty($add)){
          
          $to_add = $stu;
           
        }else{
        
          $holder = explode(",", $arti->students);
          if(in_array($stu, $holder)){
           
           $session->message ("Sorry You Have Registered For This Course Already.");
           
           redirect_to(BASE_URL . "users/dashboard/");

          }else{

          $to_add = $arti->students . "," . $stu;

          }
        }


    }else{
    	$session->message ("The Course  You Are Looking For Doesnot Exists.");
        redirect_to(BASE_URL ."users/dashboard/");
    }
    
        
        
			
            $sql ="UPDATE term_courses SET students=:students WHERE id=:id"; 
		    $update = $this->query($sql,array(
			'students'=>$to_add,
		    'id'=>$id)); 

			if($update)
			{

			    $sql = "SELECT * FROM 
			  						  transcripts 
			  						  WHERE 
			  						  user_id=:user_id
			  						  AND
			  						  level=:level
			  						  AND 
			  						  course_id=:course_id
			  						  LIMIT 1";		
			    $trans = $this->query(
			    					$sql,
			    					[
			    					"user_id"=>$stu,
			    					"level"=>$art->level,
			    					"course_id"=>$art->course_id
			    					],
			    					PDO::FETCH_OBJ
			    );

			    if(empty($trans)){

              $school_id = get_school_id_user($session->user_id);
              $academic_year = get_academic_year_by_id();
    		  $created_at = strftime("%y-%m-%d H:mm:ss",time());

              $sql ="INSERT INTO transcripts (
            							name,
            							level,
            							course_code,
            							course,
            							score,
            							grade,
            							program,
            							student_card_id,
            							lecturer,
            							lecturer_id,
            							user_id,
            							rewrite,
            							created_at,
            							academic_year,
            							school_id,
            							final,
            							course_id
            							) VALUES( 
										:name,
            							:level,
            							:course_code,
            							:course,
            							:score,
            							:grade,
            							:program,
            							:student_card_id,
            							:lecturer,
            							:lecturer_id,
            							:user_id,
            							:rewrite,
            							:created_at,
            							:academic_year,
            							:school_id,
            							:final,
            							:course_id
	            						)"; 

			$create = $this->query(
								$sql,
								[
    							"name"=>get_user_name_by_id($stu),
    							"level"=>$art->level,
    							"course_code"=>get_course_code_by_id($art->course_id),
    							"course"=>get_course_name_by_id($art->course_id),
    							"score"=>0,
    							"grade"=>0,
    							"program"=>$art->program,
    							"student_card_id"=>get_student_id_by_user($stu),
    							"lecturer"=>get_lecturers_for_course($art->id),
    							"lecturer_id"=>$art->lecturers,
    							"user_id"=>$stu,
    							"rewrite"=>"NO",
    							"created_at"=>$created_at,
    							"academic_year"=>$academic_year,
    							"school_id"=>$school_id,
    							"final"=>"NO",
    							"course_id"=>$art->course_id
								]
			); 


		}
             
				 $session->message ("You Have Successfully Registered For This Course.");
                 redirect_to(BASE_URL . "users/dashboard/");
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "users/dashboard/");
			}



    }
      

    function save_records($level,$id,$program){

  global $session;
  global $csrf;
  $id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
  if (isset($_POST['submit'])) { // Form has been submitted.

        $errors = [];
        
          #-----Set The Data To be validated ------#

          $data = [
                'academic_year' => $_POST['academic_year'],
                'scores'  => $_POST['scores'],
                'grades' =>$_POST['grades'],
                'course_ids' =>$_POST['course_ids']
          ];
          
          #-----Instantiate Validation Class ------#

          $valid = new Engine\Helpers\InputValidator($data);
          
          #-----Start Validation ------#

            $valid->field('academic_year')->required();
            $valid->field('scores')->required();
            $valid->field('grades')->required();
            $valid->field('course_ids')->required();


          #---- Check For any Errors ------#

          if(!$valid->allValid()) {
         
            $errors = $valid->getErrors(); // returns an array of errors indexed by field

          }

          $courses_taken = explode(",", $_POST['course_ids']);
          $scores = explode(",", $_POST['scores']);
          $grades = explode(",", $_POST['grades']);

          if(count($scores) != count($grades)){

            $errors[] = "The Grade Count And Score Count Are Not The Same. Check Them";
          }

          if(count($courses_taken) != count($scores) || count($courses_taken) != count($grades)){

           $errors[] = "The Scores Or Grades Are Not Up To The Number";


          }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'br');  
        $config->set('Attr.AllowedClasses', '');  
        $config->set('HTML.AllowedAttributes', '');  
        $config->set('AutoFormat.RemoveEmpty', true);  
        $purifier = new HTMLPurifier($config);
      
       #---- Get User ------#
    if ( empty($errors) ) {

          $school_id = $purifier->purify($_POST["academic_year"]);
          $academic_year = get_academic_year_by_id();
          $created_at = strftime("%y-%m-%d H:mm:ss",time());
        $count = count($courses_taken);
        $made =0;
        for ($i=1; $i <= $count ; $i++) { 
            
          
          $sql = "SELECT * FROM 
                      transcripts 
                      WHERE 
                      user_id=:user_id
                      AND
                      level=:level
                      AND 
                      course_id=:course_id
                      LIMIT 1";   
          $find = $this->query(
                    $sql,
                    [
                    "user_id"=>$id,
                    "level"=>$level,
                    "course_id"=>$courses_taken[$i-1]
                    ],
                    PDO::FETCH_OBJ
          );


            if(empty($find)){

              $made++;
              $sql ="INSERT INTO transcripts (
                          name,
                          level,
                          course_code,
                          course,
                          score,
                          grade,
                          program,
                          student_card_id,
                          lecturer,
                          lecturer_id,
                          user_id,
                          rewrite,
                          created_at,
                          academic_year,
                          school_id,
                          final,
                          course_id
                          ) VALUES( 
                    :name,
                          :level,
                          :course_code,
                          :course,
                          :score,
                          :grade,
                          :program,
                          :student_card_id,
                          :lecturer,
                          :lecturer_id,
                          :user_id,
                          :rewrite,
                          :created_at,
                          :academic_year,
                          :school_id,
                          :final,
                          :course_id
                          )"; 
         
      $transy = $this->query(
                $sql,
                [
                  "name"=>get_user_name_by_id($id),
                  "level"=>$level,
                  "course_code"=>get_course_code_by_id($courses_taken[$i-1]),
                  "course"=>get_course_name_by_id($courses_taken[$i-1]),
                  "score"=>$scores[$i-1],
                  "grade"=>$grades[$i-1],
                  "program"=>$purifier->purify($program),
                  "student_card_id"=>get_student_id_by_user($id),
                  "lecturer"=>1,
                  "lecturer_id"=>1,
                  "user_id"=>$id,
                  "rewrite"=>"NO",
                  "created_at"=>$created_at,
                  "academic_year"=>$academic_year,
                  "school_id"=>$school_id,
                  "final"=>"NO",
                  "course_id"=>$courses_taken[$i-1]
                ]
      ); 

      $sq="INSERT INTO records_log (
                          added_by,
                          student_id,
                          created_at,
                          course_id
                          ) VALUES( 
                          :added_by,
                          :student_id,
                          :created_at,
                          :course_id
                          )"; 

      $create = $this->query(
                $sq,
                [
                'added_by'=>$session->user_id,
                'student_id'=>$id,
                'created_at'=>$created_at,
                'course_id'=>$courses_taken[$i-1]
                ]
      ); 

   }else{

    $made = $count - 1;
   }

        }
    
            $session->message ($made . " Records Added For This Student");
            redirect_to(BASE_URL . "students/enterRecords/" . $level ."/" .$id ."/" .$program);
      
    } else {

      if (count($errors) == 1) {

        $session->message ("There Was An Error.<br/>" . 
                   join("<br/>",$errors));
                redirect_to(BASE_URL ."students/enterRecords/" . $level ."/" .$id ."/" .$program);

      } else {

        $session->message ("There were errors . Check Them <br/>" . 
                   join("<br/>",$errors));
                redirect_to(BASE_URL ."students/enterRecords/" . $level ."/" .$id ."/" .$program);

      }

    }
    
  
  } else { // Form has not been submitted.
    
    $session->message ("Submit Form ");
    redirect_to(BASE_URL . "students/enterRecords/" . $level ."/" .$id ."/" .$program);
  }
  
  

    }else{
   
        $session->message ("Refresh The Page And Try Again");
    redirect_to(BASE_URL . "students/enterRecords/" . $level ."/" .$id ."/" .$program);

    }

    }
      
  
      
      /*****************************************
  	*
  	* @ array 
  	* Return array of objects of Programs .
  	*
  	******************************************/

    function get_students(){
  
    $sql = "SELECT * FROM users WHERE user_type =:user_type";		
    $new = $this->query(
    					$sql,
    					[
    					"user_type"=>"2"
    					],
    					PDO::FETCH_OBJ
    );
    return $new;
      
    }

    function get_results($level,$user_id){
    
    $sql = "SELECT * FROM transcripts WHERE level =:level AND user_id=:user_id";		
    $new = $this->query(
    					$sql,
    					[
    					"level"=>$level,
    					"user_id"=>$user_id
    					],
    					PDO::FETCH_OBJ
    );
    return $new;

    }

    function get_student_profile($id){

    $sql = "SELECT * FROM students WHERE user_id =:user_id  LIMIT 1";		
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
    function find_student($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,["id"=>$id],PDO::FETCH_OBJ);
    if(!empty($new)){ 

    	return array_shift($new);
    }else{
    	return $new;
    }
    } 



    function get_record_logs(){
  
    $sql = "SELECT * FROM records_log";   
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
    }

     /*****************************************
  	*
  	* @ VOID 
  	* Delete Program From Database .
  	*
  	******************************************/
    function delete_student($id){
      
    global $session;
    $id= $id;
      
        if(get_user_level($id) != "Developer" ){

		   $session->message("You Cannot Delete A student");
		   redirect_to(BASE_URL. "students/studentList");

	    }else{

	       $sql =  "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";
	       $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);

	       if($new){
		  
		       $session->message("The User Has Been Deleted Successfully");
	           redirect_to(BASE_URL. "students/studentList");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "students/studentList");

	         }
	    
        }

    }
  

}