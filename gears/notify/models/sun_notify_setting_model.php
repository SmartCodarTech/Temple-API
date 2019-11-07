<?php
class Sun_notify_setting_model extends Model
{
  
  protected $table = "notify_settings";
  protected static $db_fields = [
                                  'id', 
                                  'name', 
                                  'value'
  ];



  /*****************************************
  *
  * @ VOID 
  * Save Setting In Database.
  *
  ******************************************/
  public function save_setting() 
  {
    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {

        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'value' => $_POST['value'],
                  'name' => $_POST['name']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('value')->required()->length(1,11);
        $valid->field('name')->required()->length(4,40);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#
        
        if (empty($errors)) {
          
          $sql = "UPDATE notify_settings SET 
          									value=:value 
          									WHERE 
          									name=:name";
          $create = $this->query(
          						$sql, 
          						[
          						'value' => $_POST['value'], 
          						'name' => $_POST['name']
          						]
          );
          
          if ($create) {
            
            $session->message("Setting Upated");
            redirect_to(BASE_URL . "notify/settings");

          } else {

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "notify/settings");

          }

        } else {

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/settings");

          } else {

            $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "notify/settings");
            
          }

        }

      } else {
        
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "notify/settings");

      }

    } else {
      
      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "notify/settings");

    }

  }

}