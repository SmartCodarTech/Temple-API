<?php

class Sun_api_model extends Model {

	protected $table="apps";
    protected static $db_fields = array('id', 'title', 'summary', 'image');

    
    public function create_api(){
	    global $session;
		global $csrf;

if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
         
		// perform validations on the form data
		$required_fields = array( 'company', 'app_version' , 'access_link' ,'components','user_id');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

	 
		if ( empty($errors) ) {
                
                $created_at = strftime("%y-%m-%d %H:%M:%S", time());
                $salt =  ((rand(1,9)*rand(1,9)*rand(1,9))).uniqid(rand(1,9)) . generate_salt();
                $data = uniqid(rand(),true).uniqid(rand(1,9));
                $api = genenrate_password($salt, $data);
             

            $sql ="INSERT INTO apps (company,user_id,app_version, access_link ,components,api,data,salt,created_at) VALUES(:company,:user_id,:app_version ,:access_link ,:components,:api,:data,:salt,:created_at)"; 
			$create = $this->query($sql,array(
			 'company'=>$_POST['company'],
			 'user_id'=>$_POST['user_id'],
			 'app_version'=>$_POST['app_version'],
			 'access_link'=>$_POST['access_link'],
			 'components'=>$_POST['components'],
			 'api'=>$api,
			 'data'=>$data,
			 'salt'=>$salt,
			 'created_at'=>$created_at
			)); 

			if($create)
			{

				 $session->message ("The API Has Been Successfully Saved.");
                                 redirect_to(BASE_URL . "back/addApi");
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "back/addApi");
			}
			
		} else {
			if (count($errors) == 1) {
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/addApi");
			} else {
				$session->message ("There Were Errors . Check Them <br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/addApi");
			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "back/addApi");
	}
	
	

      }else{
   
        $session->message ("Refresh The Page And Try Again. Session Expired");
		redirect_to(BASE_URL . "back/addApi");

      }
      
      } 

       public function create_invoice(){
	    global $session;
		global $csrf;

if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
         
		// perform validations on the form data
		$required_fields = array( 'payment_method', 'notes','purpose');
		
	    	 $upload_dir = ROOT_DIR . "/assets/" . "invoices/" . $session->user_id . "/";
	          if(!file_exists($upload_dir)){

	          	mkdir($upload_dir, 0666, true);
	          }
 
        $allowed_ext = array('pdf');
      
        if(array_key_exists('file',$_FILES) && $_FILES['file']['error'] == 0 ){

	    $pic = $_FILES['file'];

	    if(!in_array(get_extension($pic['name']),$allowed_ext)){
		 $errors[] = "Only  : 'PDF' Are Allowed";
	    }

	    $filename=$pic['name'];
        $ext="." .get_extension($pic['name']);
	
	    }else{

        $session->message ("No PDF Was Selected Or File Is Too Big");
                       redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);
        }

	 
		if ( empty($errors) ) {
                
                $created_at = strftime("%y-%m-%d %H:%M:%S", time());
                $notes =  htmlspecialchars($_POST['notes']);
                $filenames  = uniqid(rand(1, 999999) .time());
      
             

            $sql ="INSERT INTO invoices (payment_method,purpose,user_id,notes,opened,paid,finished,started,start_date,end_date,invoice,created_at) VALUES(:payment_method,:purpose,:user_id,:notes,:opened ,:paid,:finished,:started,:start_date,:end_date,:invoice,:created_at)"; 
			$create = $this->query($sql,array(
			 'payment_method'=>$_POST['payment_method'],
			  'purpose'=>$_POST['purpose'],
			 'user_id'=>$session->user_id,
			 'notes'=>$notes,
			 'opened'=>0,
			 'paid'=>0,
			 'finished'=>0,
			 'started'=>0,
			 'start_date'=>0,
			 'end_date'=>0,
			 'invoice'=>$filename,
			 'created_at'=>$created_at
			)); 

			if($create)
			{

                   if(move_uploaded_file($pic['tmp_name'], $upload_dir.$filenames.$ext)){
				 $session->message ("The Invoice Has Been Successfully Sent.");
                                 redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);
				}else{
                    
                    $session->message ("The Invoice Has Been Successfully Sent. But PDF Wasn't Uploaded");
                                 redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);

				}
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);
			}
			
		} else {
			if (count($errors) == 1) {
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);
			} else {
				$session->message ("There Were Errors . Check Them <br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);
			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);
	}
	
	

      }else{
   
        $session->message ("Refresh The Page And Try Again. Session Expired");
		redirect_to(BASE_URL . "app/sendInvoice/". $session->user_id);

      }
      
      } 
       public function create_invoice_public(){
	    global $session;
		global $csrf;

if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
         
		// perform validations on the form data
		$required_fields = array( 'payment_method', 'notes','purpose');
		
	    	 $upload_dir = ROOT_DIR . "/assets/" . "app_configs/";
	          if(!file_exists($upload_dir)){

	          	mkdir($upload_dir, 0666, true);
	          }
 
        $allowed_ext = array('pdf');
      
        if(array_key_exists('file',$_FILES) && $_FILES['file']['error'] == 0 ){

	    $pic = $_FILES['file'];

	    if(!in_array(get_extension($pic['name']),$allowed_ext)){
		 $errors[] = "Only  : 'PDF' Is Allowed";
	    }

	    $filename=$pic['name'];
        $ext="." .get_extension($pic['name']);
	
	    }else{

        $session->message ("No PDF Was Selected Or File Is Too Big");
                       redirect_to(BASE_URL . "configure");
        }

	 
		if ( empty($errors) ) {
                
                $created_at = strftime("%y-%m-%d %H:%M:%S", time());
                $notes =  htmlspecialchars($_POST['notes']);
                $file = uniqid(time()) . $ext;
             

            $sql ="INSERT INTO app_configs (config,notes,created_at) 
            VALUES(:config,:notes,:created_at)"; 
			$create = $this->query($sql,array(
			 'config'=>	$file,
			 'notes'=>$notes,
			 'created_at'=>$created_at
			)); 

			if($create)
			{

                   if(move_uploaded_file($pic['tmp_name'], $upload_dir.$file)){
				 $session->message ("The Config PDF Has Been Successfully Sent.");
                                 redirect_to(BASE_URL . "app/configure");
				}else{
                    
                    $session->message ("The Config Has Been Successfully Sent. But PDF Wasn't Uploaded");
                                 redirect_to(BASE_URL . "app/configure");

				}
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "app/configure");
			}
			
		} else {
			if (count($errors) == 1) {
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "configure");
			} else {
				$session->message ("There Were Errors . Check Them <br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "app/configure");
			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "app/configure");
	}
	
	

      }else{
   
        $session->message ("Refresh The Page And Try Again. Session Expired");
		redirect_to(BASE_URL . "app/configure");

      }
      
      } 
      
        public function save_api($id){
	    global $session;
		global $csrf;
	    $id =$id;
if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
         
			// perform validations on the form data
		$required_fields = array( 'company', 'app_version' , 'access_link' ,'components','user_id');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

	 
		if ( empty($errors) ) {
			
            $sql ="UPDATE ".$this->table." SET company=:company,app_version=:app_version,access_link=:access_link,components=:components WHERE id = :id"; 
			$update = $this->query($sql,array(
			  'company'=>$_POST['company'],
			 'app_version'=>$_POST['app_version'],
			 'access_link'=>$_POST['access_link'],
			 'components'=>$_POST['components'],
			 'user_id'=>$_POST['user_id'],
			 'id'=>$id)); 

			if($update)
			{
				
				 $session->message ("The Api Has  Been Successfully Saved.");
                                 redirect_to(BASE_URL . "back/editApi/" .$id);
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "back/editApi/" .$id);
			}
			
		} else {
			if (count($errors) == 1) {
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/editApi/" .$id );
			} else {
				$session->message ("There were errors . Check Them <br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/editApi/" .$id);
			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "back/editApi/" .$id);
	}
	
	

      }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "back/editApi/" .$id);

      }
      
      }   

  public function add_series_image($id){
	    global $session;
		global $csrf;
	 $id =$id;
if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
         
		// perform validations on the form data
		$required_fields = array( 'series');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		
	
	 
		if ( empty($errors) ) {

    $sql = "SELECT * FROM photos WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ 
    	$img = array_shift($new); 
    }else{
    	$session->message ("The Photo You Are Looking For Doesnot Exists.");
        redirect_to(BASE_URL . "back/mediaImages/");
    }

        $ser= $_POST['series'];
        $image =$img->image ;
			
            $sql ="UPDATE article_series SET image=:image WHERE id = :id"; 
		    $update = $this->query($sql,array(
			 'image'=>$image,
		      'id'=>$ser)); 

			if($update)
			{
				
				 $session->message ("The Image Has Been Set Successfully.");
                                 redirect_to(BASE_URL . "back/mediaImages/");
				
				
			}else {
				$session->message ("Something Went Wrong");
                                 redirect_to(BASE_URL . "back/mediaImages/");
			}
			
		} else {
			if (count($errors) == 1) {
				$session->message ("There Was An Error.<br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/mediaImages/");
			} else {
				$session->message ("There were errors . Check Them <br/>" . join("<br/>",$errors));
                                 redirect_to(BASE_URL . "back/mediaImages");
			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "back/mediaImages");
	}
	
	

      }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "back/mediaImages");

      }
      
      }   

      

  function get_api(){
  
    $sql = "SELECT * FROM " . $this->table;		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
  }
   function get_invoices(){
  
    $sql = "SELECT * FROM invoices";		
    $new = $this->query($sql,null,PDO::FETCH_OBJ);
    return $new;
      
  }
  
  function find_api($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ return array_shift($new); }else{return $new;}
      
  }
  
  function delete_api($id){
      global $session;
    $id=$id;
    $sql = "DELETE FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id));
     if($new){
     
     $session->message ("Api Was  Deleted");
		redirect_to(BASE_URL . "back/apis");

    }else{

    	$session->message ("Api Was Not Deleted");
		redirect_to(BASE_URL . "back/apis");
    }
      
      
  }

  
}