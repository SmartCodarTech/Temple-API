<?php

use Engine\Helpers\Resize;

class Sun_user_model extends Model {
    

	protected $table="users";
    protected static $db_fields = [
    							   'id',
                                   'password',
                                   'first_name', 
                                   'last_name',
                                   'tel_number',
                                   'email',
                                   'user_type',
                                   'salt',
                                   'user_pic'
    ];
    
    /*****************************************
  	*
  	* @ VOID 
  	* Login User.
  	*
  	******************************************/

    public function login(){

	global $session;
	global $csrf;
	
	if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 

		if (isset($_POST['submit'])) { 
			
			$errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	                  'email' => $_POST['email'],
	                  'password' => $_POST['password']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#

	        $valid->field('email', 'Email Address')->required()->email();
	        $valid->field('password')->required();
	        
	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }

 			#----If No Errors Process Data------#

 			if(empty($errors)){
	              
				$password = trim($_POST['password']);
                $email = trim($_POST['email']);

				#----Check database to see if email exist.

				$find_salt = $this->row("SELECT * FROM users WHERE email=:email", 
					                    array("email"=>"{$email}")
					                    ); 

				#----Generate Password To Check And See-----#

				$password = genenrate_password($find_salt['salt'], $password);

  				$found_user = $this->row("SELECT * FROM users WHERE email=:email".
  					                     " AND password =:password LIMIT 1", 
  					                     array("email"=>"{$email}", 
  					                     "password"=>"{$password}")
  					                     );
	
  				if (!empty($found_user)) {  
	                 if($found_user["is_active"] == 5 ){
            		$session->login($found_user);
	        		redirect_to(BASE_URL . "users/dashboard/");
	                	}else{

	                $session->message ("Access Denied");
		            redirect_to(BASE_URL . "app/login");
	                	}
           
 				} else {
           
                    $session->message ("Wrong Credentials");
		            redirect_to(BASE_URL . "app/login");
			
  				}
  
 
 			}else{
	            
	            #----Errors-------#.

				$session->message("Please Check The Following Fields For 
					              Errors<br/>  " . join("<br/>", $errors)
					              );
				redirect_to(BASE_URL . "app/login");
			
 			}
  
  
		}else{
      
    		$session->message("Submit The form");
	 		redirect_to(BASE_URL . "app/login");	

		}

	}else{
        
        $session->message("Refresh The Form And Try Again.");
        redirect_to(BASE_URL . "app/login");
				
	}	

    }


    /*****************************************
  	*
  	* @ VOID 
  	* Create User.
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
	        		  'first_name' => $_POST['first_name'],
	        		  'last_name' => $_POST['last_name'],
	                  'email' => $_POST['email'],
	                  'gender' => $_POST['gender'],
	                  'user_type' => $_POST['user_type']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#
            $valid->field('first_name','First Name')->required()->length(3,30);
            $valid->field('last_name' ,'Last Name')->required()->length(3,30);
	        $valid->field('email', 'Email Address')->required()->email();
	        $valid->field('gender')->required()->intRange(1,3)->toInt();
	        $valid->field('user_type')->required()->length(1,2)->intRange(1,100)->toInt();
	        
	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	    #---- Check If Email Exists ------#
        $email = $_POST['email'];
    	$q = "SELECT * FROM " . $this->table ." WHERE email=:email LIMIT 1";		
   		$new = $this->query($q,array("email"=>$email),PDO::FETCH_OBJ);
    	$user = array_shift($new);

    	if(!empty($user)){

    	$errors[] = "This Email Address Exist Already. Choose A Different One";

    	}
	 
		if ( empty($errors) ) {
		
            $user_type =$_POST['user_type'] ;
            $school_id = get_school_id_user($session->user_id);
            $salt = generate_salt();
            $password = genenrate_password($salt, $_POST['email'] );
			$created_at = strftime("%y-%m-%d %H:%M:%S", time());

            $sql ="INSERT INTO users (
            						   first_name, 
            						   last_name,
            						   password,
            						   salt,
            						   gender,
            						   email,
            						   user_type,
            						   created_at,
            						   school_id,
            						   user_pic,
            						   is_active
            						   ) 
								VALUES(:first_name,
            						   :last_name,
            						   :password,
            						   :salt,
            						   :gender,
            						   :email,
            						   :user_type,
            						   :created_at,
            						   :school_id,
            						   :user_pic,
            						   :is_active)";

			$create = $this->query($sql,array(
			'first_name'=>$_POST['first_name'],
			'last_name'=>$_POST['last_name'],
			'gender'=>$_POST['gender'],
			'email'=>$_POST['email'],
			'user_type'=>$user_type,
			"salt"=>$salt,
			"password"=>$password,
			"created_at" =>$created_at,
			"school_id" =>$school_id,
			"user_pic"=>"profile_pics.jpg",
			'is_active'=> 5)); 

			if($create)
			{

	

				$session->message ("The User Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "users/manage/");

			}else {

				$session->message ("Something Went Wrong"); 
                redirect_to(BASE_URL . "users/manage/");
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/manage/");

			} else {

				$session->message ("There were errors . Check Them <br/>" .
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/manage/");

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "users/manage/");

	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "users/manage/");

    }
      
    } 

    /*****************************************
  	*
  	* @ VOID 
  	* Signup User.
  	*
  	******************************************/

    public function signup(){
	global $session;
	global $csrf;


    if ($csrf->checkcsrf($_POST['csrf_token'], "Login") && empty($_POST['am']) && empty($_POST['checkbt']) ) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.


		$errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'first_name' => $_POST['first_name'],
	        		  'last_name' => $_POST['last_name'],
	                  'email' => $_POST['email'],
	                  'password' => $_POST['password']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#
            $valid->field('first_name')->required()->length(3,30);
            $valid->field('last_name')->required()->length(3,30);
	        $valid->field('email', 'Email Address')->required()->email();
	        $valid->field('password')->required();
	        
	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	    #---- Check If THe Email Exists Already ------#

    	$q = "SELECT * FROM " . $this->table ." WHERE email=:email LIMIT 1";		
    	$new = $this->query(
				    		$q,
				    		["email"=>$email],
				    		PDO::FETCH_OBJ
		);

    	$user = array_shift($new);

    	if(empty($user)){

	 
		if ( empty($errors) ) {
		    $school_id = get_school_id_user($session->user_id);
            $user_type =2;
            $salt = generate_salt();
            $password = genenrate_password($salt, $_POST['password'] );
			
            $created_at = strftime("%y-%m-%d %H:%M:%S", time());
            $sql ="INSERT INTO users (
            						  first_name, 
            						  last_name,
            						  password,
            						  salt,
            						  tel_number,
            						  email,
            						  user_type,
            						  created_at,
            						  user_pic,
            						  school_id
            						  ) VALUES(
							   		  :first_name, 
							   		  :last_name,
							   		  :password,
							   		  :salt,
							   		  :tel_number,
							   		  :email,
							   		  :user_type,
							   		  :created_at,
							   		  :user_pic,
							   		  :school_id,
							   		  )"; 

			$create = $this->query(
								    $sql,
								    ['first_name'=>$_POST['first_name'],
									'last_name'=>$_POST['last_name'],
									'tel_number'=>0,
									'email'=>$_POST['email'],
									'user_type'=>$user_type,
									"salt"=>$salt,
									"password"=>$password,
									"created_at" =>$created_at,
									"user_pic"=>"profile_pics.jpg",
									"school_id"=>$school_id]
			); 

			if($create)
			{   
				#----Succeful ------#
                create_activity_new_member();
				$session->message ("You Have succesfully Signed Up. Login Now.
				                    Verify Your Account");
                redirect_to(BASE_URL . "app/signup/");	

			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "app/signup/");
			}
			
		} else {
            
            #---- Validation Errors ------#
			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" .
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "app/signup/");

			} else {

				$session->message ("There were errors . Check Them <br/>" .
				                   join("<br/>",$errors));
                redirect_to(BASE_URL . "app/signup/");

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "app/signup/");

	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "app/signup/");

    }

      
    } 
}
      

    /*****************************************
  	*
  	* @ VOID 
  	* Create User Profile.
  	*
  	******************************************/

    public function add_profile($id){
	global $session;
	global $csrf;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		$errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'age' => $_POST['age'],
	        		  'about' => $_POST['about_me'],
	                  'address' => $_POST['address'],
	                  'dateofbirth' => $_POST['date_of_birth']
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#
            $valid->field('age')->required()->length(3,90);
            $valid->field('about')->required()->length(10,400);
	        $valid->field('dateofbirth', 'Date Of Birth')->required()->toDateTime('Y/m/d');
	        $valid->field('address')->required()->length(10,400);
	        
	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	 
		if ( empty($errors) ) {
		
        $q = "SELECT * FROM profiles WHERE member_id=:member_id LIMIT 1";		
        $new = $this->query($q,array("member_id"=>$id),PDO::FETCH_OBJ);
        $user = array_shift($new);

        if(empty($user)){
           
            $id  =$id;
              
            $sql ="INSERT INTO profiles (age, 
            							 about_me,
            							 address,
            							 date_of_birth,
            							 member_id) 
								  VALUES(:age, 
								  		 :about_me,
								  		 :address,
								  		 :date_of_birth,
								  		 :member_id)"; 

			$create = $this->query(
								    $sql,
								    ['age'=>$_POST['age'],
									'about_me'=>$_POST['about_me'],
									'address'=>$_POST['address'],
									'date_of_birth'=>$_POST['date_of_birth'],
									'member_id'=>$id]
			); 


         }else{

            $sql ="UPDATE profiles SET age=:age,
             							about_me=:about_me,
             							address=:address,
             							date_of_birth=:date_of_birth WHERE 
             							member_id = :member_id"; 

			$create = $this->query(
									$sql,
									['age'=>$_POST['age'],
									'about_me'=>$_POST['about_me'],
									'address'=>$_POST['address'],
									'date_of_birth'=>$_POST['date_of_birth'],
									'member_id'=>$id]
			); 

         }
             
			if($create)
			{

				$session->message ("The Profile Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "users/editProfile/" .$id);
				
				
			}else {

				$session->message ("No Change Was Made");
                redirect_to(BASE_URL . "users/editProfile/" .$id);

			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/editProfile/" .$id);

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/editProfile/" .$id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "users/editProfile/" .$id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "users/editProfile/" .$id);

    }
      
    } 
      
     
     /*****************************************
  	*
  	* @ VOID 
  	* save Edited User .
  	*
  	******************************************/

    public function save_user($id){

	global $session;
	global $csrf;
	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		    $errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'first_name' => $_POST['first_name'],
	        		  'last_name' => $_POST['last_name'],
	                  'email' => $_POST['email'],
	                  'gender' => $_POST['gender'],
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#
            $valid->field('first_name')->required()->length(3,30);
            $valid->field('last_name')->required()->length(3,30);
	        $valid->field('email', 'Email Address')->required()->email();
	        $valid->field('gender')->required()->length(1,2);
	        
	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
	    
	     #---- Get User ------#

	    $q = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
	    $new = $this->query($q,array("id"=>$id),PDO::FETCH_OBJ);
	    $user = array_shift($new);
		 
		if ( empty($errors) ) {

		

			$user_type = $user->user_type;
	

            $sql ="UPDATE users SET first_name=:first_name,
            						last_name=:last_name,
            						gender=:gender,
            						email=:email,
            						user_type=:user_type WHERE id = :id"; 

			$update = $this->query(
								$sql,
								['first_name'=>$_POST['first_name'],
								'last_name'=>$_POST['last_name'],
								'gender'=>$_POST['gender'],
								'email'=>$_POST['email'],
								'user_type'=>$user_type,
								"id"=>$id]
								); 

			if($update)
			{
				
				$session->message ("The User Has  Been Successfully Saved.");
                redirect_to(BASE_URL . "users/editUser/" .$id);

				
			}else {

				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "users/editUser/" .$id);
			}
			
		} else {

			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/editUser/" .$id );

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/editUser/" .$id);

			}

		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "users/editUser/" .$id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "users/editUser/" .$id);

    }
      
    }  

  
    /*****************************************
  	*
  	* @ VOID 
  	* save User password .
  	*
  	******************************************/

    public function save_password($id)
    {
	global $session;
	global $csrf;

	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	if (isset($_POST['submit'])) { // Form has been submitted.

		$errors = [];
        
	        #-----Set The Data To be validated ------#

	        $data = [
	        		  'old_password' => $_POST['old_password'],
	        		  'new_password' => $_POST['new_password'],
	                  'confirm_password' => $_POST['confirm_password'],
	        ];
	        
	        #-----Instantiate Validation Class ------#

	        $valid = new Engine\Helpers\InputValidator($data);
	        
	        #-----Start Validation ------#
            $valid->field('old_password', 'Old Password')->required();
            $valid->field('new_password' , 'New Password')->required();
	        $valid->field('confirm_password', 'Confirm Password')->required();
	        
	        #---- Check For any Errors ------#

	        if(!$valid->allValid()) {
	       
	          $errors = $valid->getErrors(); // returns an array of errors indexed by field

	        }
         
        if(trim($_POST['new_password']) != trim($_POST['confirm_password'] )){
         
         $errors[] = "New Passwords Do Not Match. Check It Well";

        }
	  
	    $q = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
	    $new = $this->query(
	    					$q,
	    					["id"=>$id],
	    					PDO::FETCH_OBJ
	    );

	    $user = array_shift($new);
	    $password = genenrate_password($user->salt, 
	    							   trim($_POST['old_password'] ));
    

    	if(trim($password != $user->password)){
         
         $errors[] = "Your Old Password Is Wrong";
     	
     	}
	 
		if ( empty($errors) ) {

			$new_pass = genenrate_password($user->salt, 
										   trim($_POST['new_password'] ));

            $sql ="UPDATE users SET password=:password WHERE id = :id"; 
			$update = $this->query(
									$sql,
									['password'=>$new_pass,
									"id"=>$id]
			); 

			if($update)
			{
				
				$session->message ("Your Password Has Been Changed.");
                redirect_to(BASE_URL . "users/editPassword/" .$id);
				
				
			}else {
				$session->message ("Something Went Wrong");
                redirect_to(BASE_URL . "users/editPassword/" .$id);
			}
			
		} else {
			if (count($errors) == 1) {

				$session->message ("There Was An Error.<br/>" . 
								  join("<br/>",$errors));
                redirect_to(BASE_URL . "users/editPassword/" .$id );

			} else {

				$session->message ("There were errors . Check Them <br/>" . 
								   join("<br/>",$errors));
                redirect_to(BASE_URL . "users/editPassword/" .$id);

			}
		}
		
	
	} else { // Form has not been submitted.
		
		$session->message ("Submit Form ");
		redirect_to(BASE_URL . "users/editPassword/" .$id);
	}
	
	

    }else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "users/editPassword/" .$id);

    }
      
    }   
      
    

    /*****************************************
  	*
  	* @ VOID 
  	* Save User Image .
  	*
  	******************************************/

    public function save_image($id){
	global $session;
	global $csrf;
	$id =$id;

    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) { 
 
	    $errors = array();

		$upload_dir = ROOT_DIR . "/assets/images/users/" . $id."/";
	    $allowed_ext = array('jpg','jpeg','png','gif');

	    if(!file_exists($upload_dir)){

	    	mkdir($upload_dir,0777);
	    }
	      
	    if(array_key_exists('image',$_FILES) && $_FILES['image']['error'] == 0 ){

		$pic = $_FILES['image'];

		if(!in_array(get_extension($pic['name']),$allowed_ext)){
			 $errors[] = "Only  : 'jpg','JPG','jpeg','png','gif' Are Allowed";
		}	

		$filename=$pic['name'];
	    $ext="." .get_extension($pic['name']);
		
		}else{

	     $session->message ("No Image Was Selected. Select An Image");
	     redirect_to(BASE_URL . "users/uploadImage/" .$id);

	    }

	    if(empty($errors)){
	   
	    $sql ="UPDATE users SET user_pic=:user_pic WHERE id = :id"; 
		$update = $this->query($sql,
							   array('user_pic'=>"profile_pic". $ext,"id"=>$id)); 


	      	if(move_uploaded_file($pic['tmp_name'], $upload_dir."profile_pic".$ext)){
				
				$resizeObj = new resize($upload_dir."profile_pic".$ext);
				$resizeObj -> resizeImage(300, 300, "crop");
				$resizeObj -> saveImage($upload_dir."profile_pic".$ext , 100);
					 
			    $session->message ("The Image Has  Been Successfully Saved");
	            redirect_to(BASE_URL . "users/uploadImage/" .$id);

	        }else{

	       	    $session->message ("The Image COuld Not Be Moved");
	            redirect_to(BASE_URL ."users/uploadImage/" .$id);
	        }




	    }else{

	    	$session->message ("There Was An Error" . join("<br/>", $errors));
			redirect_to(BASE_URL . "users/uploadImage/" .$id);
	    }



	}else{
   
        $session->message ("Refresh The Page And Try Again");
		redirect_to(BASE_URL . "users/uploadImage/" .$id);

    }
      
    }   
      
   
      /*****************************************
  	*
  	* @ VOID 
  	* User Log Out .
  	*
  	******************************************/
    public function logout(){
	   
	global $session;
	global $csrf;
	   
	$session->logout();
	$csrf->logout();
    redirect_to(BASE_URL);
	
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
    function get_users_manage(){
  
    $sql = "SELECT * FROM " . $this->table ." WHERE user_type=:user_type ";		
    $new = $this->query(
    					$sql,
    					[
    					"user_type"=>"5"
    					]
    					,PDO::FETCH_OBJ
    );
    return $new;
      
    }

    function get_users_top(){
  
    $sql = "SELECT * FROM " . $this->table ." WHERE user_type=:user_type ";		
    $new = $this->query(
    					$sql,
    					[
    					"user_type"=>"10"
    					]
    					,PDO::FETCH_OBJ
    );
    return $new;
      
    }
    
      /*****************************************
  	*
  	* @ User Object 
  	* Find User .
  	*
  	******************************************/
    function find_user($id){

  	$id=$id;
    $sql = "SELECT * FROM " . $this->table ." WHERE id=:id LIMIT 1";		
    $new = $this->query($sql,array("id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ return array_shift($new); }else{return $new;}
      
    }
    
    /*****************************************
  	*
  	* @ Profile Oject 
  	* User Profile Oject.
  	*
  	******************************************/
    function find_profile($id){

  	$id=$id;
    $sql = "SELECT * FROM profiles WHERE member_id=:member_id LIMIT 1";		
    $new = $this->query($sql,array("member_id"=>$id),PDO::FETCH_OBJ);
    if(!empty($new)){ return array_shift($new); }else{return $new;}
      
    }
     

     /*****************************************
  	*
  	* @ VOID 
  	* Delete User From Database .
  	*
  	******************************************/
    function delete_user($id){
      
    global $session;
    $id= $id;
      
        if(get_user_level($id) === "Developer" || 
      	   get_user_level($id) === "Top Manager" ||
      	   get_user_level($id) === "Editor" || 
      	   $session->user_id == $id){

      	   	if(get_user_level($session->user_id) === "Developer" && $session->user_id != $id){
             
            $email = uniqid("Deactiveate")."@B.com";
            $salt = generate_salt();
            $password = genenrate_password($salt, $email );
            $sql ="UPDATE users SET
            						email=:email,
            						password=:password,
            						salt=:salt,
            						is_active=:is_active
            						WHERE 
            						id = :id"; 

			$update = $this->query(
								$sql,
								[
								'salt'=>$salt,
								'password'=>$password,
								'email'=>$email,
								'is_active'=>1,
								"id"=>$id
								]
								); 

	        if($update){
		  
		       $session->message("The User Has Been Deactivated");
	           redirect_to(BASE_URL. "users/allUsers");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "users/allUsers");

	         }

      	   	}else{


      	   	}

		   $session->message("You Cannot Deactivate This User");
		   redirect_to(BASE_URL. "users/");

	    }else{
            $email = uniqid("Deactiveate")."@B.com";
            $salt = generate_salt();
            $password = genenrate_password($salt, $email );
            $sql ="UPDATE users SET
            						email=:email,
            						password=:password,
            						salt=:salt,
            						is_active=:is_active
            						WHERE 
            						id = :id"; 

			$update = $this->query(
								$sql,
								[
								'salt'=>$salt,
								'password'=>$password,
								'email'=>$email,
								'is_active'=>1,
								"id"=>$id
								]
								); 

	       if($update){
		  
		       $session->message("The User Has Been Deactivated Successfully");
	           redirect_to(BASE_URL. "students");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "students");

	         }
	    
        }

    }

     function activate_user($id){
      
    global $session;
    $id= $id;
      
        if(get_user_level($id) === "Developer" || 
      	   get_user_level($id) === "Top Manager" || 
      	   get_user_level($id) === "Editor" ||
      	   $session->user_id == $id){

      	   	if(get_user_level($session->user_id) === "Developer" && $session->user_id != $id){
             
            $email = uniqid("Deactiveate")."@B.com";
            $salt = generate_salt();
            $password = genenrate_password($salt, $email );
            $sql ="UPDATE users SET
            						email=:email,
            						password=:password,
            						salt=:salt,
            						is_active=:is_active
            						WHERE 
            						id = :id"; 

			$update = $this->query(
								$sql,
								[
								'salt'=>$salt,
								'password'=>$password,
								'email'=>$email,
								'is_active'=>5,
								"id"=>$id
								]
								); 

	        if($update){
		  
		       $session->message("The User Has Been Activated");
	           redirect_to(BASE_URL. "users/allUsers");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "users/allUsers");

	         }

      	   	}else{


      	   	}

		   $session->message("You Cannot Activate This User");
		   redirect_to(BASE_URL. "users/");

	    }else{
            $email = uniqid("Deactiveate")."@B.com";
            $salt = generate_salt();
            $password = genenrate_password($salt, $email );
            $sql ="UPDATE users SET
            						email=:email,
            						password=:password,
            						salt=:salt,
            						is_active=:is_active
            						WHERE 
            						id = :id"; 

			$update = $this->query(
								$sql,
								[
								'salt'=>$salt,
								'password'=>$password,
								'email'=>$email,
								'is_active'=>5,
								"id"=>$id
								]
								); 

	       if($update){
		  
		       $session->message("The User Has Been Activated Successfully");
	           redirect_to(BASE_URL. "students/");
		  
	        }else{
		  
		       $session->message("Something When Wrong");
		       redirect_to(BASE_URL. "students/");

	         }
	    
        }

    }
  

}