<?php 

class Wear{
  
      
        public $front;
        public $back;
        

        public function __construct() {
		
 
        $this->front = $this->get_front();
        $this->back  = $this->get_back();

		 
	   }

        private function get_front(){
            global $database;
           
	    if(!empty($database)){
        
        $name = "Wear Front";
        $sql = "SELECT value FROM settings WHERE name=:name LIMIT 1";       
        $new = $database->query($sql,array("name"=>$name),PDO::FETCH_OBJ);
        if(!empty($new)){

            $dress = array_shift($new);

            return $dress->value;
         
            
          }else{
             
              return "Sun";

          }

	    }else{
		 return "Sun";
	    }
            
        }
        
        //get the name of the admin dress
        private function get_back(){
     global $database;    
        if(!empty($database)){
        
        $name = "Wear Back";
        $sql = "SELECT value FROM settings WHERE name=:name LIMIT 1";       
        $new = $database->query($sql,array("name"=>$name),PDO::FETCH_OBJ);
        if(!empty($new)){

            $dress = array_shift($new);

            return $dress->value;
         
            
          }else{
             
              return "SunPlus";

          }

        }else{
         return "SunPlus";
        }
        }
   
     // in dress functions
     public  function get_css(){
  
        return BASE_URL."wear/".$this->front."/"."css/";
  
     }

    public  function get_image(){
  
    return  BASE_URL."wear/".$this->front."/"."img/";
  
    }

    public  function get_js(){
  
    return  BASE_URL."wear/".$this->front."/"."js/";
  
    }
     // in Admin dress functions
     public  function get_cssAdmin(){
  
      return BASE_URL."wear/".$this->back."/"."css/";
  
     }

     public  function get_imageAdmin(){
  
    return  BASE_URL."wear/".$this->back."/"."img/";
  
     }

     public  function get_jsAdmin(){
  
    return  BASE_URL."wear/".$this->back."/"."js/";
  
    }

    public  function get_dressFunction(){
  
    return  BASE_URL."wear/".$this->front."/" ."functions.php";
  
    }
        
}

$wear =  new Wear;