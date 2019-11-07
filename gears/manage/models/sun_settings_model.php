<?php

use Engine\Helpers\Resize;

class Sun_settings_model extends Model {

	protected $table="settings";
    protected static $db_fields = [
    								'id',
    								'value',
    								'name'
    ];
    
  /*****************************************
  *
  * @ VOID 
  * Set Editing Mode ON Or Off.
  *
  ******************************************/

    public function set_mode($status){
    global $session;
      	
      	if($status == 1){

            $sql ="UPDATE settings SET 
            							value=:value 
            							WHERE 
            							name = :name"; 
		    $update = $this->query(
		    						$sql,
		    						[
									'value'=>"Deactive",
		    						'name'=>"Editing Mode"
		    						]
		    );

		    $session->message ("Editing Mode Deactivated");
		    redirect_to(BASE_URL . "/manage/generalSettings");
         
      	}else{

            $sql ="UPDATE settings SET 
            							value=:value 
            							WHERE 
            							name = :name"; 
		    $update = $this->query(
		    						$sql,
		    						[
		    						'value'=>"Active",
									'name'=>"Editing Mode"
									]
			);

        	$session->message ("You Are Now In Editing Mode");
			redirect_to(BASE_URL . "manage/generalSettings");

      	}


    }

    public function set_data_entry($status){
    global $session;
        
        if($status == 1){

            $sql ="UPDATE settings SET 
                          value=:value 
                          WHERE 
                          name = :name"; 
        $update = $this->query(
                    $sql,
                    [
                  'value'=>"NO",
                  'name'=>"Data Entry"
                    ]
        );

        $session->message ("Datry Entry Deactivated");
        redirect_to(BASE_URL . "manage/appSettings/");
         
        }else{

            $sql ="UPDATE settings SET 
                          value=:value 
                          WHERE 
                          name = :name"; 
        $update = $this->query(
                    $sql,
                    [
                    'value'=>"YES",
                  'name'=>"Data Entry"
                  ]
      );

          $session->message ("You Can Now Add Student Record Data");
      redirect_to(BASE_URL . "manage/appSettings/");

        }


    }


     public function set_student_registration($status){
    global $session;
        
        if($status == 1){

            $sql ="UPDATE settings SET 
                          value=:value 
                          WHERE 
                          name = :name"; 
        $update = $this->query(
                    $sql,
                    [
                  'value'=>"Disallow",
                  'name'=>"Student Registration"
                    ]
        );

        $session->message ("Student Registration Deactivated");
        redirect_to(BASE_URL . "manage/appSettings/");
         
        }else{

            $sql ="UPDATE settings SET 
                          value=:value 
                          WHERE 
                          name = :name"; 
        $update = $this->query(
                    $sql,
                    [
                    'value'=>"Allow",
                  'name'=>"Student Registration"
                  ]
      );

          $session->message ("Students Can Now Register");
      redirect_to(BASE_URL . "manage/appSettings/");

        }


    }
  
    public function set_advance_students($status){
    global $session;

    if(check_term_end()){

        $sql ="SELECT * FROM students 
                                     WHERE
                                     completed=:completed"; 
        $students = $this->query(
                    $sql,
                    [
                     'completed'=> "NO"
                    ], 
                   PDO::FETCH_OBJ
        );
        $count =0;
        foreach ($students as $student) {
        
        if($student->final === "YES"){

        $sql ="UPDATE students SET 
                          level=:level,
                          completed=:completed,
                          completed_academic_year=:completed_academic_year 
                          WHERE 
                          id = :id"; 
        $update = $this->query(
                    $sql,
                    [
                    'level'=>$student->level+1,
                    'completed'=>"YES",
                    'completed_academic_year'=> get_academic_year_by_id(), 
                    'id'=>$student->id
                  ]
        );

       }else{
        
        $program = get_program_by_id($student->program);
        $program_end = $program->end_level;
        $int = $program_end - $student->level;

        if($int == 1){
         
        $sql ="UPDATE students SET 
                          level=:level,
                          final=:final
                          WHERE 
                          id = :id"; 
        $update = $this->query(
                    $sql,
                    [
                    'level'=>$student->level+1,
                    'final'=>"YES",
                    'id'=>$student->id
                  ]
        );


        }else{
        
                $sql ="UPDATE students SET 
                          level=:level
                          WHERE 
                          id = :id"; 
        $update = $this->query(
                    $sql,
                    [
                    'level'=>$student->level+1,
                    'id'=>$student->id
                  ]
        );

        } 


       }
          
        $count++;
        }
        
        $now = strftime("%y-%m-%d", time());
        $end = \DateTime::createFromFormat('y-m-d',$now);
        $end->add(new \DateInterval('P4M6D'));

        $new_term_end_date = $end->format('y-m-d');
        
        $sql ="UPDATE schools SET 
                          term_end_date=:term_end_date
                          WHERE 
                          id = :id"; 
        $update = $this->query(
                    $sql,
                    [
                    'term_end_date'=>$new_term_end_date,
                    'id'=>$student->school_id
                   ]
        );
        
        $session->message ($count . " Students Advanced To The Next Level");
        redirect_to(BASE_URL . "manage/appSettings/");

         

   }else{
        

        $session->message ($count . " This Level / Term / Semester Has Not Ended. You can't Advance Students");
        redirect_to(BASE_URL . "manage/appSettings/");

   }

    }

  /*****************************************
  *
  * @ VOID 
  * Set Maintenace Mode On Or Off
  *
  ******************************************/

    public function set_maintenance($status){
    global $session;
      	
      	if($status == 1){

            $sql ="UPDATE settings SET 
            							value=:value 
            							WHERE 
            							name = :name"; 
		    $update = $this->query(
		    						$sql,
		    						[
									'value'=>"Deactive",
		    						'name'=>"Maintenance Mode"
		    						]
		    );

		    $session->message ("Maintenance Mode Deactivated");
		    redirect_to(BASE_URL . "manage/generalSettings");
         
      	}else{

            $sql ="UPDATE settings SET 
            							value=:value 
            							WHERE 
            							name = :name"; 
		    $update = $this->query(
		    						$sql,
		    						[
									'value'=>"Active",
		    						'name' =>"Maintenance Mode"
		    						]
		    );

            $session->message ("You Are Now In Maintenance Mode");
		    redirect_to(BASE_URL . "manage/generalSettings");

      	}


    }

   /*****************************************
  *
  * @ VOID 
  * Set Email
  *
  ******************************************/

    public function set_email(){
	
	global $session;
	global $csrf;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
		        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'site_email' => $_POST['site_email']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#


        $valid->field('site_email', 'Site Email Address')->required()->email();
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

		if ( empty($errors) ) {

            $sql ="UPDATE settings SET 
            						   value=:value 
            						   WHERE 
            						   name = :name"; 
		    $update = $this->query(
								    $sql,
								    [
									'value'=>$_POST['site_email'],
								    'name'=>"Site Email"
								    ]
			);

		    if($create)
			{
				   $session->message ("Email Upadated");
		           redirect_to(BASE_URL . "back/generalSettings");
            
            }else{

                $session->message ("No Change Made");
		        redirect_to(BASE_URL . "back/generalSettings");

            }

        }else{

            $session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/generalSettings");

        }

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "back/generalSettings");

    }
      
} 
      
        


  
  

}