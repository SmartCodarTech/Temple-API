<?php

use Engine\Helpers\Resize;

class Sun_video_library_model extends Model {

	protected $table="video_library";
    protected static $db_fields = [
    								'id', 
    								'caption', 
    								'video', 
    								'created_by',
    								'created_at'
    ];

    /*****************************************
    *
    * @ VOID 
    * Create Video File.
    *
    ******************************************/

    public function create_video(){
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

        #---- Upload Video File ------#
        

	    $upload_dir = ROOT_DIR . "/assets/" . "videos/";

        $allowed_ext = array('mp4','flv');
      
        if(array_key_exists('image',$_FILES) && $_FILES['image']['error'] == 0 ){

	    $pic = $_FILES['image'];

	    if(!in_array(get_extension($pic['name']),$allowed_ext)){
		 $errors[] = "Only  : 'MP4','FLV' Are Allowed";
	    }

	    $filename=$pic['name'];
        $ext="." .get_extension($pic['name']);
	
	    }else{

        $session->message ("No Video Was Selected Or File Is Too Big");
                       redirect_to(BASE_URL . "back/mediaAddImage");
        }
	 
		if ( empty($errors) ) {
                
            $created_at = strftime("%y-%m-%d %H:%M:%S", time());

            $file = $filename;  

            $sql ="INSERT INTO video_library (caption,
            								  created_by,
            								  video,
            								  created_at
            								  ) VALUES(
            								  :caption,
									   		  :created_by,
									   		  :video,
									   		  :created_at
									   		  )"; 

			$create = $this->query(
									$sql,
									[
								    'caption'=>$_POST['caption'],
								    'created_by'=>$_POST['created_by'],
								    'video'=>$filename,
								    'created_at'=>$created_at
								    ]
			); 

			if($create)
			{


				if(move_uploaded_file($pic['tmp_name'], $upload_dir.$filename)){
			
				 	$session->message ("The video  Has  Been Successfully Saved.");
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
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                redirect_to(BASE_URL . "media/uploadMedia");
			} else {
				$session->message ("There were errors . Check Them <br/>" . join("<br/>",$errors));
                redirect_to(BASE_URL . "media/uploadMedia");
			}

		}
		
	
	} else { // Form has not been submitted.
		
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
    * Save Edited File.
    *
    ******************************************/

    public function save_video($id){
    global $session;
	global $csrf;
    $id =$id;
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

        #---- Process If No Errors ------#

	    if ( empty($errors) ) {
		
        $sql ="UPDATE video_library SET 
        								caption=:caption,
        								created_by=:created_by 
        								WHERE 
        								id = :id"; 
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
			
			 $session->message ("The video Has  Been Successfully Saved.");
                             redirect_to(BASE_URL . "back/mediaVideos");
			
		}else {

			$session->message ("Something Went Wrong");
                             redirect_to(BASE_URL . "back/mediaVideos");
		}
		
	} else {

		if (count($errors) == 1) {

			$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                             redirect_to(BASE_URL . "back/mediaVideos");

		} else {

			$session->message ("There were errors . Check Them <br/>" . join("<br/>",$errors));
                             redirect_to(BASE_URL . "back/mediaVideos");
		}

	}
	

} else { // Form has not been submitted.
	
	$session->message ("Submit Form ");
	redirect_to(BASE_URL . "back/mediaVideos");
}



  }else{

    $session->message ("Refresh The Page And Try Again");
	redirect_to(BASE_URL . "back/mediaVideos");

  }
  
  }   

      
      
      /*****************************************
    *
    * @ Array Of Objects 
    *Array Of Videos
    *
    ******************************************/

  function get_videos(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
  }
  
    /*****************************************
    *
    * @ Object 
    * Video Object
    *
    ******************************************/

  function find_video($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ return array_shift($new); }else{return $new;}
      
  }

     /*****************************************
    *
    * @ VOID 
    * Delete Video.
    *
    ******************************************/
  function delete_video($id,$purpose){
      global $session;
    $id=$id;
    $find = $this->find_video($id);
    $sql = "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id));
    
    if($new){
     
     // need to implement the deleting of all video files assoiated
    	//with this post. 
     
		$upload_dir = ROOT_DIR . "/assets/" . "videos/";
		unlink($upload_dir.$find->video);
	
	

	    $session->message("The Video Was Deleted");
        redirect_to(BASE_URL."media/videos");

    }else{
     
     $session->message("The Video Was Not Deleted");
     redirect_to(BASE_URL."media/videos");

    }
      
      
  }
  

}