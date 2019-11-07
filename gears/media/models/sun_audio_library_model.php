<?php

use Engine\Helpers\Resize;

class Sun_audio_library_model extends Model {

	protected $table="audio_library";
    protected static $db_fields = array('id', 
    									'caption', 
    									'audio', 
    									'created_by',
    									'created_at'
    									);

    /*****************************************
    *
    * @ VOID 
    * Create Audio File.
    *
    ******************************************/

    public function create_audio(){
	global $session;
	global $csrf;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.
	        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'caption' => $_POST['caption'],
                  'created_by' => $_POST['created_by']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('caption')->required()->length(4,300);
        $valid->field('created_by', 'Created By')->required()->length(4,200);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

	    $upload_dir = ROOT_DIR . "/assets/" . "audio/";

        $allowed_ext = array('mp3','ogg','wave');
      
        if(array_key_exists('image',$_FILES) && $_FILES['image']['error'] ==0){

	    	$pic = $_FILES['image'];

	    	if(!in_array(get_extension($pic['name']),$allowed_ext)){
		 	
		 		$errors[] = "Only  : 'MP3','OGG','WAVE' Are Allowed";
	    	
	    	}

	    	$filename=$pic['name'];
        	$ext="." .get_extension($pic['name']);

        	if ($_FILES["image"]["size"] > 15242880) {

		     	$session->message (" File Is Too Big");
             	redirect_to(BASE_URL . "media/uploadMedia");
             	
	        }
	
	    }else{

        	$session->message ("No Audio Was Selected ");
            redirect_to(BASE_URL . "media/uploadMedia");
        }
	 
		if ( empty($errors) ) {
                
            $created_at = strftime("%y-%m-%d %H:%M:%S", time());
			$file = $filename;  

            $sql ="INSERT INTO audio_library (
            								  caption,
            								  created_by,
            								  audio,created_at
            								  )VALUES(
            								  :caption,
									   		  :created_by,
									   		  :audio,
									   		  :created_at
									   		  )"; 

			$create = $this->query(
									$sql,
									[
									'caption'=>$_POST['caption'],
									'created_by'=>$_POST['created_by'],
									'audio'=>$filename,
									'created_at'=>$created_at
									]
			); 

			if($create)
			{


				if(move_uploaded_file($pic['tmp_name'], $upload_dir.$filename)){
			
					$session->message ("The Audio  Has  Been Successfully Saved.");
                    redirect_to(BASE_URL . "media/uploadMedia");

				}else{

					$session->message ("Entry Made, File Was Not Saved");
                    redirect_to(BASE_URL . "media/uploadMedia");

				}
				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "media/uploadMedia");
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" .
									join("<br/>",$errors));
                redirect_to(BASE_URL . "media/uploadMedia");

			} else {

				$session->message ("There were errors . Check Them <br/>" .
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "media/uploadMedia");

			}
		}
		
	
	} else { 
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "media/uploadMedia");
	}
	
    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "media/uploadMedia");

    }
      
    } 



    /*****************************************
    *
    * @ VOID 
    * Save Edited Audio File.
    *
    ******************************************/
      
    public function save_audio($id){
	global $session;
	global $csrf;
	$id =$id;

	if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { 
    
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'caption' => $_POST['caption'],
                  'created_by' => $_POST['created_by']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('caption')->required()->length(4,300);
        $valid->field('created_by', 'Created By')->required()->length(4,200);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#
	 
		if ( empty($errors) ) {
			
            $sql ="UPDATE audio_library SET
            								caption=:caption,
            								created_by=:created_by 
            								WHERE id = :id"; 
		    $update = $this->query(
								    $sql,
									[
									'caption'=>$_POST['caption'],
									'created_by'=>$_POST['created_by'],
								    'id'=>$id
								    ]
			); 

			if($update)
			{
				
				 $session->message ("The Audio Has  Been Successfully Saved.");
                 redirect_to(BASE_URL . "audio");
				
				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "audio");
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                redirect_to(BASE_URL . "audio");

			} else {
				$session->message ("There were errors. <br/>" . join("<br/>",$errors));
                redirect_to(BASE_URL . "audio");
			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "audio");
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "audio");

    }
      
    }   

    /*****************************************
    *
    * @ array of Objects 
    * Array Of Audio File Objects.
    *
    ******************************************/
    function get_audios(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
    }
    
    /*****************************************
    *
    * @ Object 
    * Audoio Oject From Audio Library.
    *
    ******************************************/
    function find_audio($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ return array_shift($new); }else{return $new;}
      
    }
    
    /*****************************************
    *
    * @ VOID 
    * Delete Audio File
    *
    ******************************************/
    function delete_audio($id){
    global $session;
    $id=$id;
    $find = $this->find_audio($id);
    $sql = "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id));
    
    if($new){
     
     // need to implement the deleting of all audio files assoiated
    	//with this post. 
     
		$upload_dir = ROOT_DIR . "/assets/" . "audio/";
		unlink($upload_dir.$find->audio);
	
	    $session->message("The Audio Was Deleted");
        redirect_to(BASE_URL."media/audio");

    }else{
     
     $session->message("The Audio Was Not Deleted");
     redirect_to(BASE_URL."media/audio");

    }
      
      
    }
  

}