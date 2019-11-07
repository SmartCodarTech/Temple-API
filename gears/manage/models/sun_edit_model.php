<?php
use Engine\Helpers\Resize;

class Sun_edit_model extends Model
{
  
  protected $table = "site_data";
  protected static $db_fields = [
                                  'id', 
                                  'part', 
                                  'content'
  ];

  public function save_edited_element() {
  
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'part' => $_POST['part'],
                  'content' => $_POST['content']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('part')->required();

        #----- Use Html Filter To Sanitise Text

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'br');  
        $config->set('Attr.AllowedClasses', '');  
        $config->set('HTML.AllowedAttributes', '');  
        $config->set('AutoFormat.RemoveEmpty', true);  
        $purifier = new HTMLPurifier($config);
        $content = $purifier->purify($_POST['content']);

      if(empty($errors)){

        global $SiteDB;
        $part  = trim($_POST['part']);
       

          
          $check =  $SiteDB->get($part);

       

           if($SiteDB->set($part , $content)){

          echo "Saved Successfully";

             }else{

          echo "Ooop! Error Please.";

             }

     }else{

          echo "Errors : " . join("<br/>", $errors);

     }


  }
  
  function Uploads() {
    global $wear;
    global $session;
    
    if ($_POST['folder'] == "slides/") {
      
      $folder = $_POST['folder'];
      $filename = $_POST['filename'];
      $width = $_POST['width'];
      $height = $_POST['height'];
      
      $upload_dir = WEAR_DIR . $wear->front . "/img/" . $folder;
      
      $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
      
      if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
        $session->message("Wrong HTTP REQUEST");
        redirect_to(BASE_URL);
      }
      
      //Check if The Image was Uploaded And NO Errors
      if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] == 0) {
        
        $pic = $_FILES['image'];
        
        if (!in_array(get_extension($pic['name']), $allowed_ext)) {
          
          $session->message("Wrong File. You can Only Uplad .JPG .JPEG .PNG or .GIF");
          redirect_to(BASE_URL);
        }
        
        //get extention of file
        $ext = "." . get_extension($pic['name']);
        $ext2 = "." . get_extension($filename);
        
        if ($ext != $ext2) {
          
          $session->message("Wrong File. You can Only Upload" . $ext2 . " For This Picture");
          redirect_to(BASE_URL);
        }
        
        // Move the uploaded file from the temporary
        // directory to the uploads folder:
        
        if (move_uploaded_file($pic['tmp_name'], $upload_dir . $filename)) {

         if(isset($_POST['crop'])) {
          $resize = new resize($upload_dir . $filename);
          $resize->resizeImage($width, $height, "crop");
          $resize->saveImage($upload_dir . $filename, 100);
        }
          $session->message("File Uploaded Sucessfully");
          redirect_to(BASE_URL);
        }
      }else{

           $session->message("No Image Was Selected");
          redirect_to(BASE_URL);

      }

    } else {
      
      $folder = $_POST['folder'];
      $filename = $_POST['filename'];
      $width = $_POST['width'];
      $height = $_POST['height'];
      
      $upload_dir = WEAR_DIR . $wear->front . "/img/" . $folder;
      
      $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
      
      if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
        
        $session->message("Wrong HTTP REQUEST");
        redirect_to(BASE_URL);
      }
      
      if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] == 0) {
        
        $pic = $_FILES['image'];
        
        if (!in_array(get_extension($pic['name']), $allowed_ext)) {
          $session->message("Wrong File. YOu can Only Upload .JPG .JPEG .PNG or .GIF");
          redirect_to(BASE_URL);
        }
        
        $ext = "." . get_extension($pic['name']);
        $ext2 = "." . get_extension($filename);
        
        if ($ext != $ext2) {
          
          $session->message("Wrong File. You can Only Upload" . $ext2 . " For This Picture");
          redirect_to(BASE_URL);
        }
     
        // Move the uploaded file from the temporary
        // directory to the uploads folder:
        
        if (move_uploaded_file($pic['tmp_name'], $upload_dir . $filename)) {
        
        if(isset($_POST['crop'])) {
          $resize = new resize($upload_dir . $filename);
          $resize->resizeImage($width, $height, "crop");
          $resize->saveImage($upload_dir . $filename, 100);
        }
          $session->message("File Uploaded Sucessfully");
          redirect_to(BASE_URL);
        }
         }else{

              $session->message("No File Was Selected");
          redirect_to(BASE_URL);

         }
    }


  }
  
  function start() {
    
    global $session;
    
    if ($session->is_logged_in() && (get_user_level($session->user_id) == "Developer" || get_user_level($session->user_id) == "Top Manager")) {
      
      $name = "Editing Mode";
      $sql = "SELECT * FROM settings 
                                    WHERE 
                                    name=:name 
                                    LIMIT 1";
      $new = $this->query(
                          $sql, 
                          [
                          "name" => $name
                          ], 
                          PDO::FETCH_OBJ
      );

      if (!empty($new)) {
        
        $setting = array_shift($new);
        $id = $setting->id;
        $value = "Active";
        $sql = "UPDATE settings SET 
                                    value=:value 
                                    WHERE 
                                    id = :id";
        $update = $this->query(
                                $sql, 
                                [
                                'value' => $value, 
                                'id' => $id
                                ]
        );
        
        if ($update) {
          
          $session->message("You Can Start editing the website now. By Using the buttons. The help Button is bellow");
          redirect_to(BASE_URL);

        } else {

          $session->message("Something went Wrong. Refresh and try again.");
          redirect_to(BASE_URL);

        }

      } else {
        
        redirect_to(BASE_URL);

      }
    }
  }
  
  function stop() {
    
    global $session;
    
    if ($session->is_logged_in() && (get_user_level($session->user_id) == "Developer" || get_user_level($session->user_id) == "Top Manager")) {
      
      $name = "Editing Mode";
      $sql = "SELECT * FROM settings WHERE 
                                          name=:name 
                                          LIMIT 1";
      $new = $this->query(
                          $sql, 
                          [
                          "name" => $name
                          ], 
                          PDO::FETCH_OBJ
      );
      if (!empty($new)) {
        
        $setting = array_shift($new);
        $id = $setting->id;
        $value = "InActive";
        $sql = "UPDATE settings SET value=:value WHERE id = :id";
        $update = $this->query(
                                $sql, 
                                [
                                'value' => $value, 
                                'id' => $id
                                ]
        );
        
        if ($update) {

          $session->message("You Can Start editing the website now. By Using the buttons. The help Button is bellow");
          redirect_to(BASE_URL);

        } else {

          $session->message("Something went Wrong. Refresh and try again.");
          redirect_to(BASE_URL);

        }
      } else {
        
        redirect_to(BASE_URL);

      }
    }
  }
}
