<?php
class Sun_notify_model extends Model
{
  
  protected $table = "notify_contacts";
  protected static $db_fields = [
                                  'id', 
                                  'fullname', 
                                  'ghana', 
                                  'number', 
                                  'notes'
  ];


  /*****************************************
  *
  * @ VOID 
  * Create Contact In Database.
  *
  ******************************************/

  public function create_contact() 
  {
    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {

        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'fullname' => $_POST['fullname'],
                  'number' => $_POST['number'],
                  'notes' => $_POST['notes'],
                  'ghana' => $_POST['ghana']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('fullname', 'Full Name')->required()->length(4,90);
        $valid->field('number')->required()->length(8,11);
        $valid->field('notes')->required()->length(3,300);
        $valid->field('ghana','Number Locality')->required()->length(2,3);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#
        
        if (empty($errors)) {
          
          #---- If Insert Into The Database ------#

          $sql = "INSERT INTO notify_contacts (
                                                notes,
                                                fullname,
                                                number,
                                                ghana
                                              ) VALUES(
                                                :notes,
                                                :fullname,
                                                :number,
                                                :ghana
                                              )";
          $create = $this->query(
                                  $sql, 
                                  [
                                  'notes' => $_POST['notes'],
                                   'fullname' => $_POST['fullname'], 
                                   'number' => $_POST['number'], 
                                   'ghana' => $_POST['ghana']
                                  ]
          );
          
          if ($create) {
            
            $session->message("Your Contact Has Been Added");
            redirect_to(BASE_URL . "notify/addContacts");

          } else {

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "notify/addContacts");

          }

        } else {

           #---- Validation Errors ------#

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/addContacts");

          } else {

            $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/addContacts");

          }

        }
      } else {

        $session->message("Submit Form ");
        redirect_to(BASE_URL . "notify/addContacts");

      }

    } else {
      
      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "notify/addContacts");

    }

  }

  /*****************************************
  *
  * @ VOID 
  * Save Edited Contact In Database.
  *
  ******************************************/
  
  public function save_contact($id)
  {
    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {

          $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'fullname' => $_POST['fullname'],
                  'number' => $_POST['number'],
                  'notes' => $_POST['notes'],
                  'ghana' => $_POST['ghana']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('fullname', 'Full Name')->required()->length(4,90);
        $valid->field('number')->required()->length(8,11);
        $valid->field('notes')->required()->length(3,300);
        $valid->field('ghana','Number Locality')->required()->length(2,3);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }


        if (empty($errors)) {
          
          $sql = "UPDATE notify_contacts SET 
                                         notes=:notes,
                                         fullname=:fullname,
                                         number=:number,
                                         ghana=:ghana 
                                         WHERE 
                                         id=:id";
          $create = $this->query(
                                  $sql, 
                                  [
                                  'notes' => $_POST['notes'], 
                                  'fullname' => $_POST['fullname'], 
                                  'number' => $_POST['number'], 
                                  'ghana' => $_POST['ghana'], 
                                  'id' => $id]
          );
          
          if ($create) {
            
            $session->message("Your Contact Has Been Updated");
            redirect_to(BASE_URL . "notify/");

          } else {

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "notify/");

          }

        } else {

          if (count($errors) == 1) {
            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/");
          } else {
            $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/");
          }

        }

      } else {
       
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "notify/");

      }
    } else {
      
      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "notify/");

    }
  }
  



  /*****************************************
  *
  * @ Array Contact Objects 
  * Save Edited Contact In Database.
  *
  ******************************************/

  function get_notify_contacts() {
    
    $sql = "SELECT * FROM " . $this->table;
    $new = $this->query($sql, null, PDO::FETCH_OBJ);
    return $new;

  }
  
  /*****************************************
  *
  * @Contact Object 
  * Save Edited Contact In Database.
  *
  ******************************************/

  function get_contact_groups() {
    
    $sql = "SELECT * FROM notify_group";
    $new = $this->query($sql, null, PDO::FETCH_OBJ);
    return $new;

  }
  
  function find_message($id) {
    
    $id = $id;
    $sql = "SELECT * FROM " . $this->table . " WHERE id=:id LIMIT 1";
    $new = $this->query($sql, array("id" => $id), PDO::FETCH_OBJ);
    if (!empty($new)) {
      return array_shift($new);
    } else {
      return $new;
    }
  }
  

  /*****************************************
  *
  * @Void 
  * Save Edited Contact In Database.
  *
  ******************************************/

  function delete_contact($id) {
    
    global $session;
    $id = $id;
    $sql = "DELETE FROM " . $this->table . " WHERE id=:id LIMIT 1";
    $new = $this->query($sql, array("id" => $id));
    if ($new == 1) {
      
      $session->message("The Contact Was  Deleted");
      redirect_to(BASE_URL . "notify");
    } else {
      
      $session->message("The Contact Was Not Deleted");
      redirect_to(BASE_URL . "notify");
    }
  }
  
  
  /*****************************************
  *
  * @Void 
  * Send Message To Number.
  *
  ******************************************/

  function send_single() {
    
    global $session;
    
    // perform validations on the form data
    $errors = array();
    $required_fields = array('message', 'number', 'ghana');
    $errors = array_merge($errors, check_required_fields($required_fields, $_POST));
    
    if (!is_numeric($_POST['number'])) {
      
      $errors[] = " Wrong number Format ";
    }
    
    if (empty($errors)) {
      
      $message = trim(htmlentities($_POST['message']));
      $number = trim(htmlentities($_POST['number']));
      $locality = trim(htmlentities($_POST['ghana']));
      $length = get_msg_length($message);
      $create = send_single_msg($number, $locality, $message);
      
      if ($create) {
        
        $session->message("Message Has Been Sent");
        redirect_to(BASE_URL . "notify");

      } else {

        $session->message("You Dont Have Credits / Gateway Has Halted");
        redirect_to(BASE_URL . "notify");

      }

    } else {

      if (count($errors) == 1) {

        $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
        redirect_to(BASE_URL . "notify");

      } else {

        $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
        redirect_to(BASE_URL . "notify");

      }
    }
  }
  

  /*****************************************
  *
  * @Void 
  * Send Message To Group.
  *
  ******************************************/

  function send_to_group() {
    
    global $session;
    
    // perform validations on the form data
    $errors = array();
    $required_fields = array('message', 'group_id', 'sender_id');
    $errors = array_merge($errors, check_required_fields($required_fields, $_POST));
    
    if (empty($errors)) {
      
      $message = trim(htmlentities($_POST['message']));
      $group = trim(htmlentities($_POST['group_id']));
      $sender_id = trim(htmlentities($_POST['sender_id']));
      $length = get_msg_length($message);
      $create = send_group_msg($group, $sender_id, $message, $length);
      
      $session->message($create);
      redirect_to(BASE_URL . "notify/sendMessage");

    } else {

      if (count($errors) == 1) {

        $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
        redirect_to(BASE_URL . "notify/sendMessage");

      } else {

        $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
        redirect_to(BASE_URL . "notify/sendMessage");

      }
    }
  }
}
