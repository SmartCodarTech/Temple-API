<?php
class Sun_notify_groups_model extends Model
{
  
  protected $table = "notify_group";
  protected static $db_fields = [
                                  'id', 
                                  'name', 
                                  'locality'
  ];
  

   /*****************************************
  *
  * @ VOID 
  * Create Contact Group In Database.
  *
  ******************************************/

  public function create_group() {
    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {
       
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'name' => $_POST['name'],
                  'locality' => $_POST['locality']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('name')->required()->length(4,60);
        $valid->field('locality')->required()->length(2,3);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

        if (empty($errors)) {

          
          $sql = "INSERT INTO notify_group (
          									name,
          									locality
          									) VALUES(
          									:name,
          									:locality
          									)";
          $create = $this->query(
          						 $sql,
          						 [
          						 'name' => $_POST['name'], 
          						 'locality' => $_POST['locality']
          						 ]
          );
          
          if ($create) {
            
            $session->message("Your Group  Has Been Created");
            redirect_to(BASE_URL . "notify/contactGroups");

          } else {

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "notify/contactGroups");

          }
        } else {

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/contactGroups");

          } else {

            $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/contactGroups");

          }

        }

      } else {
        

        $session->message("Submit Form ");
        redirect_to(BASE_URL . "notify/contactGroups");

      }

    } else {
      
      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "notify/contactGroups");

    }

  }
  

   /*****************************************
  *
  * @ VOID 
  * Save Contact Group In Database.
  *
  ******************************************/


  public function save_group($id) {
    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {
               
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'name' => $_POST['name'],
                  'locality' => $_POST['locality']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('name')->required()->length(4,60);
        $valid->field('locality')->required()->length(2,3);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

        if (empty($errors)) {
          
          $sql = "UPDATE notify_group SET 
          								name=:name,
          								locality=:locality 
          								WHERE 
          								id=:id";
          $create = $this->query(
          						$sql, 
          						[
          						'name' => $_POST['name'], 
          						'locality' => $_POST['locality'], 
          						'id' => $id
          						]
          );
          
          if ($create) {
            
            $session->message("Group  Has Been Saved");
            redirect_to(BASE_URL . "notify/groups");

          } else {

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "notify/groups");

          }

        } else {

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/groups");

          } else {

            $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/groups");

          }
        }

      } else {
        
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "notify/groups");

      }

    } else {
      
      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "notify/groups");

    }

  }
  
  /*****************************************
  *
  * @ VOID 
  * Add Contact To Group.
  *
  ******************************************/

  public function add_to_group($id)
  {
    global $session;
    global $csrf;
    $id = $id;
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {

        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'group_id' => $_POST['group_id']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('group_id')->required()->toInt();
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#
        
        if (empty($errors)) {
          
          $sql = "SELECT * FROM notify_contacts 
          										WHERE id=:id 
          										LIMIT 1";
          $new = $this->query(
          					  $sql, 
          					  ["id" => $id], 
          					  PDO::FETCH_OBJ
          );

          if (!empty($new)) {

            $num = array_shift($new);
            $contact = $num->number;

          } else {

            $session->message("The Contact  You Are Looking For Doesnot Exists.");
            redirect_to(BASE_URL . "notify/");

          }
          
          $ser = $_POST['group_id'];
          $sql = "SELECT * FROM notify_group 
          									WHERE 
          									id=:id 
          									LIMIT 1";
          $art = $this->query(
          					  $sql, 
          					  ["id" => $ser], 
          					  PDO::FETCH_OBJ
          );
          
          if (!empty($art)) {

            $arti = array_shift($art);
            $add = $arti->numbers;

            if (empty($add)) {
              
              $to_add = $id;

            } else {
              
              $holder = explode(",", $arti->numbers);
              if (in_array($id, $holder, strict)) {
                
                $session->message(" Sorry The Contact Exists In This group Already.");
                redirect_to(BASE_URL . "notify/");

              } else {

                $to_add = $arti->numbers . "," . $id;

              }

            }

          } else {

            $session->message("The Group You Are Looking For Doesnot Exists.");
            redirect_to(BASE_URL . "notify/");

          }
          
          $sql = "UPDATE notify_group SET 
          								  numbers=:numbers 
          								  WHERE id = :id";
          $update = $this->query(
          						 $sql, 
          						 [
          						 'numbers' => $to_add, 
          						 'id' => $ser
          						 ]
          );
          
        if ($update) {
            
            $session->message("The Contact  Has Been Added Successfully.");
            redirect_to(BASE_URL . "notify");

          } else {

            $session->message("Something Went Wrong");
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

      } else {
        
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "notify");

      }

    } else {
      
      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "notify");

    }

  }

    function delete_group($id) {
    
    global $session;
    $id = $id;
    $sql = "DELETE FROM notify_group WHERE id=:id LIMIT 1";
    $new = $this->query($sql, array("id" => $id));
    if ($new == 1) {
      
      $session->message("The Group Was  Deleted");
      redirect_to(BASE_URL . "notify/groups");
    } else {
      
      $session->message("The Group Was Not Deleted");
      redirect_to(BASE_URL . "notify/groups");
    }
  }
  

}