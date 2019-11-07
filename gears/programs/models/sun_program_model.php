<?php

use Engine\Helpers\Resize;

class Sun_program_model extends Model {
    

	protected $table="programs";
    protected static $db_fields = [
    							   'id',
                                   'name',
                                   'end_level', 
                                   'years',
                                   'description',
                                   'remarks',
                                   'certificate',
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
	        		  'end_level' => $_POST['end_level'],
	        		  'years' => $_POST['years'],
	        		  'description' => $_POST['description'],
	        		  'remarks' => $_POST['remarks'],
	        		  'certificate' => $_POST['certificate'],
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('name')->required()->length(3,250);
            $valid->field('end_level')->required()->length(1,30)->toInt();
            $valid->field('years')->required()->length(1,20);
            $valid->field('description')->required()->length(3,500);
            $valid->field('remarks')->required()->length(3,500);
            $valid->field('certificate')->required()->length(3,500);

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {

			$school_id = get_school_id_user($session->user_id);

            $sql ="INSERT INTO programs (
            							name,
            							end_level,
            							years,
            							description,
            							remarks,
            							certificate,
            							school_id
            							) VALUES( 
	            						:name,
	            						:end_level,
	            						:years,
	            						:description,
	            						:remarks,
	            						:certificate,
	            						:school_id
	            						)"; 

			$create = $this->query(
								$sql,
								[
								'name'=>$_POST['name'],
								'end_level'=>$_POST['end_level'],
								'years'=>$_POST['years'],
								'description'=>$_POST['description'],
								'remarks'=>$_POST['remarks'],
								'certificate'=>$_POST['certificate'],
								'school_id'=> $school_id
								]
			); 

			if($create)
			{
				
				$session->message ("The Program Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "programs/");

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "programs/");
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "programs/");

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "programs/");

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "programs/");
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "programs/");

    }
    }    
     
     /*****************************************
  	*
  	* @ VOID 
  	* save Edited Program .
  	*
  	******************************************/

    public function save_program($id){

	global $session;
	global $csrf;
	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'name' => $_POST['name'],
	        		  'end_level' => $_POST['end_level'],
	        		  'years' => $_POST['years'],
	        		  'description' => $_POST['description'],
	        		  'remarks' => $_POST['remarks'],
	        		  'certificate' => $_POST['certificate'],
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

            $valid->field('name')->required()->length(3,250);
            $valid->field('end_level')->required()->length(1,30)->toInt();
            $valid->field('years')->required()->length(1,20);
            $valid->field('description')->required()->length(3,500);
            $valid->field('remarks')->required()->length(3,500);
            $valid->field('certificate')->required()->length(3,500);

	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {
	
            $sql ="UPDATE programs SET 
            						name=:name,
            						end_level=:end_level,
            						years=:years,
            						description=:description,
            						remarks=:remarks,
            						certificate=:certificate
            						WHERE id = :id"; 

			$update = $this->query(
								$sql,
								[
								'name'=>$_POST['name'],
								'end_level'=>$_POST['end_level'],
								'years'=>$_POST['years'],
								'description'=>$_POST['description'],
								'remarks'=>$_POST['remarks'],
								'certificate'=>$_POST['certificate'],
								'id'=> $id
								]
			); 

			if($update)
			{
				
				$session->message ("The Program Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "programs/editProgram/" .$id);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "programs/editProgram/" .$id);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "programs/editProgram/" .$id );

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "programs/editProgram/" .$id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "programs/editProgram/" .$id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "programs/editProgram/" .$id);

    }
      
    }  


      
    
      
      /*****************************************
  	*
  	* @ array 
  	* Return array of objects of Programs .
  	*
  	******************************************/

    function get_programs(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
    }
    
      /*****************************************
  	*
  	* @ User Object 
  	* Find Program .
  	*
  	******************************************/
    function find_program($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,["id"=>$id],PDO::FETCH_OBJ);
    if(!empty($new)){ 

    	return array_shift($new);
    }else{
    	return $new;
    }
    } 
     


         function find_courses($id){

  	$id=$id;
    $sql = "SELECT * FROM courses WHERE program=:program";		
    $new = $this->query($sql,["program"=>$id],PDO::FETCH_OBJ);
 
    	return $new;
    }
     /*****************************************
  	*
  	* @ VOID 
  	* Delete Program From Database .
  	*
  	******************************************/
    function delete_program($id){
      
    global $session;
    $id= $id;
      
        if(get_user_level($id) != "Developer" ){

		   $session->message("You Cannot Delete A School");
		   redirect_to(BASE_URL. "schools/settings/");

	    }else{

	       $sql =  "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";
	       $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);

	       if($new){
		  
		       $session->message("The User Has Been Deleted Successfully");
	           redirect_to(BASE_URL. "users/");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "users/");

	         }
	    
        }

    }
  

}