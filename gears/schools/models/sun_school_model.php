<?php

use Engine\Helpers\Resize;

class Sun_school_model extends Model {
    

	protected $table="schools";
    protected static $db_fields = [
    							   'id',
                                   'name',
                                   'plan_limit', 
                                   'plan_name',
                                   'top_manager_id',
                                   'school_end',
                                   'academic_year',
                                   'term_end_date'
    ];


    /*****************************************
  	*
  	* @ VOID 
  	* Create School.
  	*
  	******************************************/   
    
    public function start(){

      
    }    
     
     /*****************************************
  	*
  	* @ VOID 
  	* save Edited School .
  	*
  	******************************************/

    public function save_school($id){

	global $session;
	global $csrf;
	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'name' => $_POST['name'],
	        		  'school_end' => $_POST['school_end'],
	        		  'academic_year' =>$_POST['academic_year'],
	        		  'term_end_date' =>$_POST['term_end_date']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#
            $valid->field('name')->required()->length(3,150);
            $valid->field('school_end')->required()->length(1,30);
            $valid->field('academic_year')->required()->length(1,30);
            $valid->field('term_end_date')->required();


	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#
		if ( empty($errors) ) {
	
            $sql ="UPDATE schools SET 
            						name=:name,
            						school_end=:school_end,
            						academic_year=:academic_year,
            						term_end_date=:term_end_date
            						WHERE id = :id"; 

			$update = $this->query(
								$sql,
								[
								'name'=>$_POST['name'],
								'school_end'=>$_POST['school_end'],
								'academic_year'=>$_POST['academic_year'],
								'term_end_date'=>$_POST['term_end_date'],
								"id"=>$id
								]
			); 

			if($update)
			{
				
				$session->message ("The School Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "schools/settings/" .$id);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "schools/settings/" .$id);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "schools/settings/" .$id );

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "schools/settings/" .$id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "schools/settings/" .$id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "schools/settings/" .$id);

    }
      
    }  


      
    

    
      /*****************************************
  	*
  	* @ array 
  	* Return array of objects of users .
  	*
  	******************************************/

    function get_users(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
    }


    
      /*****************************************
  	*
  	* @ User Object 
  	* Find School .
  	*
  	******************************************/
    function find_school($id){

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
  	* Delete User From Database .
  	*
  	******************************************/
    function delete_school($id){
      
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