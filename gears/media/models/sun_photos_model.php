<?php

use Engine\Helpers\Resize;

class Sun_photos_model extends Model {

	protected $table="photos";
    protected static $db_fields = [
    								'id', 
    								'caption', 
    								'image', 
    								'purpose',
    								'created_at'
    ];

  /*****************************************
  *
  * @ VOID 
  * Create New Photo In Database.
  *
  ******************************************/

    public function create_photo(){
	global $session;
	global $csrf;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.		        
        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'caption' => $_POST['caption'],
                  'purpose' => $_POST['purpose']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('caption')->required()->length(4,150);
        $valid->field('purpose')->length(4,20);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- Set Upload Dir ------#
        
        if($_POST['purpose'] == "Gallery"){

		$upload_dir = ROOT_DIR . "/assets/" . "gallery/";

	    }elseif($_POST['purpose'] == "Other"){

        $upload_dir = ROOT_DIR . "/assets/" . "other/";

	    }elseif($_POST['purpose'] == "Article"){

        $upload_dir = ROOT_DIR . "/assets/" . "articles/";

	    }else{

	    	 $upload_dir = ROOT_DIR . "/assets/" . "events/";
	    }
        
        #---- Set Allowed ------#

        $allowed_ext = ['jpg','jpeg','png','gif'];
      
        if(array_key_exists('image',$_FILES) && $_FILES['image']['error'] == 0 ){

	    $pic = $_FILES['image'];

	    if(!in_array(get_extension($pic['name']),$allowed_ext)){
		 $errors[] = "Only  : 'jpg','JPG','jpeg','png','gif' Are Allowed";
	    }

	    $filename=$pic['name'];
        $ext="." .get_extension($pic['name']);
	
	    }else{

        $session->message ("No Image Was Selected Or File Is Too Big");
                       redirect_to(BASE_URL . "media/uploadMedia");
        }
	 
		if ( empty($errors) ) {
                
            $created_at = strftime("%y-%m-%d %H:%M:%S", time());

            $file = $filename;  

            $sql ="INSERT INTO photos (
            							caption,
            							purpose,
            							image,
            							created_at
            							) VALUES(
            							:caption,
            							:purpose,
            							:image,
            							:created_at
            							)"; 
			$create = $this->query(
									$sql,
									[
								    'caption'=>$_POST['caption'],
								    'purpose'=>$_POST['purpose'],
								    'image'=>$filename,
								    'created_at'=>$created_at
								    ]
			); 

			if($create)
			{


				if(move_uploaded_file($pic['tmp_name'], $upload_dir."large/".$filename)){

					if($_POST['purpose'] == "Gallery"){

					 $resizeObj = new resize($upload_dir."large/".$filename);
					 $resizeObj -> resizeImage(350, 350, "crop");
					 $resizeObj -> saveImage($upload_dir.$filename , 100);

					}elseif($_POST['purpose'] == "Other"){

					 $resizeObj = new resize($upload_dir."large/".$filename);
					 $resizeObj -> resizeImage(600, 500, "crop");
					 $resizeObj -> saveImage($upload_dir.$filename , 100);

					 }elseif($_POST['purpose'] == "Article"){
						
					 $resizeObj = new resize($upload_dir."large/".$filename);
					 $resizeObj -> resizeImage(800, 350, "crop");
					 $resizeObj -> saveImage($upload_dir.$filename , 100);
	                     
	                     }else{

                     $resizeObj = new resize($upload_dir."large/".$filename);
				     $resizeObj -> resizeImage(800, 350, "crop");
				     $resizeObj -> saveImage($upload_dir.$filename , 100);

	                     }
					 $session->message ("The Photo Has  Been Successfully Saved.");
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
  * Save Edited Photo In Database.
  *
  ******************************************/
      
        public function save_photo($id){
	    global $session;
		global $csrf;
	    $id =$id;
       if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	    if (isset($_POST['submit'])) { // Form has been submitted.
	        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'caption' => $_POST['caption'],
                  'purpose' => $_POST['purpose']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('caption')->required()->length(4,150);
        $valid->field('purpose')->required()->length(4,20);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }
	 
	
	 
		if ( empty($errors) ) {
			
            $sql ="UPDATE photos SET caption=:caption WHERE id = :id"; 
		    $update = $this->query($sql,array(
			'caption'=>$_POST['caption'],
		    'id'=>$id)); 

			if($update)
			{
				
				 $session->message ("The Photo Has  Been Successfully Saved.");
                                 redirect_to(BASE_URL . "media");
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "media");
			}
			
		} else {
			if (count($errors) == 1) {
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "media");
			} else {
				$session->message ("There were errors . Check Them <br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "media");
			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "media");
	}
	
	

      }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "media");

      }
      
      }   

      
      
   /*****************************************
  *
  * @ Array Of Objects 
  * Array Of Photo Objects From The Database.
  *
  ******************************************/

  function get_photos(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
  }

    /*****************************************
  *
  * @ Object 
  * Returns a photo object From The Database.
  *
  ******************************************/
  
  function find_photo($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ return array_shift($new); }else{return $new;}
      
  }

  /*****************************************
  *
  * @ VOID 
  * Delete Photo From Database & system.
  *
  ******************************************/
  
    function delete_photo($id,$purpose){
    	
    global $session;
    $id=$id;
    $find = $this->find_photo($id);
    $sql = "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query(
    					$sql,
    					["id"=>$id]
    );
    
	    if($new){
	     
	     if($purpose == "Gallery"){

			$upload_dir = ROOT_DIR . "/assets/" . "gallery/";
			unlink($upload_dir.$find->image);
			unlink($upload_dir."large/".$find->image);

		    }elseif($purpose == "Event"){

	         $upload_dir = ROOT_DIR . "/assets/" . "events/";
	         unlink($upload_dir.$find->image);
			unlink($upload_dir."large/".$find->image);

		    }elseif($purpose == "Other"){

	        $upload_dir = ROOT_DIR . "/assets/" . "other/";
	        unlink($upload_dir.$find->image);
			unlink($upload_dir."large/".$find->image);

		    }else{

		    $upload_dir = ROOT_DIR . "/assets/" . "articles/";
	        unlink($upload_dir.$find->image);
			unlink($upload_dir."large/".$find->image);

		    }

		    $session->message("The Image Was Deleted");
	        redirect_to(BASE_URL."media");

	    }else{
	     
	     $session->message("The Image Was Not Deleted");
	     redirect_to(BASE_URL."media");

	    }
      
      
    }
  

}