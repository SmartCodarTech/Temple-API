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
	        		  'student_id' =>$_POST['student_id']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('level')->required()->length(1,5);
            $valid->field('age')->required()->intRange(2,100);
            $valid->field('student_id')->length(1,11);

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
            							student_id
            							) VALUES( 
	            						:level,
	            						:age,
	            						:user_id,
	            						:school_id,
	            						:student_id
	            						)"; 

			$create = $this->query(
								$sql,
								[
								'level'=>$_POST['level'],
								'age'=>$_POST['age'],
								'user_id'=>$id,
								'student_id'=>$_POST['student_id'],
								'school_id'=> $school_id
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
	        		  'student_id' =>$_POST['student_id']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('level')->required()->length(1,5);
            $valid->field('age')->required()->intRange(2,100);
            $valid->field('student_id')->length(1,11);


	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {
	
            $sql ="UPDATE students SET 
            						level=:level,
            						age=:age,
            						student_id=:student_id
            						WHERE id=:id "; 

			$update = $this->query(
								$sql,
								[
								'level'=>$_POST['level'],
								'age'=>$_POST['age'],
								'student_id'=>$_POST['student_id'],
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