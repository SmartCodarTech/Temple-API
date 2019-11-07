<?php
class Sun_messages_model extends Model
{
  
  protected $table = "messages";
  protected static $db_fields = [
                                  'id', 
                                  'name', 
                                  'email', 
                                  'subject', 
                                  'message', 
                                  'created_at', 
                                  'opened'
  ];

  
  /*****************************************
  *
  * @ VOID 
  * Create User Sent Messages In Database.
  *
  ******************************************/

  public function create_message()
  {

    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {
        
        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'name' => $_POST['name'],
                  'email' => $_POST['email'],
                  'subject' => $_POST['subject'],
                  'message' => $_POST['message']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('name')->required()->length(4,60);
        $valid->field('email', 'Email Address')->required()->email();
        $valid->field('subject')->required()->length(3,150);
        $valid->field('message')->required()->length(10,500);

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'br');  
        $config->set('Attr.AllowedClasses', '');  
        $config->set('HTML.AllowedAttributes', '');  
        $config->set('AutoFormat.RemoveEmpty', true);  
        $purifier = new HTMLPurifier($config);

        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

        if (empty($errors)) {
          
          #---- Obtain Current Time ------#

          $created_at = strftime("%y-%m-%d %H:%M:%S", time());
          
          #---- Clean And Insert Into THe Database------#

          $name = $purifier->purify($_POST['name']);
          $message = $purifier->purify($_POST['message']);
          $subject = $purifier->purify($_POST['subject']);

          $sql = "INSERT INTO " . $this->table . " (name,email,message,subject,opened,created_at) 
                  VALUES(:name,:email,:message,:subject,:opened,:created_at)";
          $create = $this->query( 
                                  $sql, 
                                  ['name' => $name, 
                                  'email' => $_POST['email'], 
                                  'opened' => "0", 
                                  'message' => $message, 
                                  'subject' => $subject, 
                                  'created_at' => $created_at]
          );
          
          if ($create) {

            #---- Successful ------#

            $session->message("Your Message Has Been Sent. Thank You");
            redirect_to(BASE_URL . "app/contact");

          } else {

            #---- Couldnt Be saved------#

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "app/contact");

          }

        } else {
             
             #---- Valiiidation Errors------#

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "app/contact");

          } else {

            $session->message("There were errors.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "app/contact");

          }

        }

      } else {
         
        
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "app/contact");

      }

    } else {
      
      #---- Wrong CSRF Key------#

      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "app/contact");
    }

  }

  /*****************************************
  *
  * @ VOID 
  * Send Support.
  *
  ******************************************/

  public function send_support()
  {

    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {
        
        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'subject' => $_POST['subject'],
                  'type' => $_POST['type'],
                  'message' => $_POST['message']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('subject')->required()->length(4,150);
        $valid->field('type')->required()->length(5,150);
        $valid->field('message')->required()->length(10,600);

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'br');  
        $config->set('Attr.AllowedClasses', '');  
        $config->set('HTML.AllowedAttributes', '');  
        $config->set('AutoFormat.RemoveEmpty', true);  
        $purifier = new HTMLPurifier($config);

        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

        if (empty($errors)) {
          
          #---- Obtain Current Time ------#

          $created_at = strftime("%y-%m-%d %H:%M:%S", time());
          
          #---- Clean And Insert Into THe Database------#

          $type = $purifier->purify($_POST['type']);
          $message = $purifier->purify($_POST['message']);
          $subject = $purifier->purify($_POST['subject']);

          $sql = "INSERT INTO  support (
                                                    type,
                                                    user_id,
                                                    opened,
                                                    message,
                                                    subject,
                                                    created_at
                                                    ) VALUES(
                                                    :type,
                                                    :user_id,
                                                    :opened,
                                                    :message,
                                                    :subject,
                                                    :created_at
                                                    )";
          $create = $this->query( 
                                  $sql, 
                                  [
                                  'type' => $type, 
                                  'user_id' => $session->user_id, 
                                  'opened' => "0", 
                                  'message' => $message, 
                                  'subject' => $subject, 
                                  'created_at' => $created_at
                                  ]
          );
          
          if ($create) {

            #---- Successful ------#

            $session->message("Your Message Has Been Sent. Thank You");
            redirect_to(BASE_URL . "messages/support");

          } else {

            #---- Couldnt Be saved------#

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "messages/support");

          }

        } else {
             
             #---- Valiiidation Errors------#

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "messages/support");

          } else {

            $session->message("There were errors.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "messages/support");

          }

        }

      } else {
         
        
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "messages/support");

      }

    } else {
      
      #---- Wrong CSRF Key------#

      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "messages/support");
    }

  }

   public function send_notice($id)
  {

    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {
        
        
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'subject' => $_POST['subject'],
                  'message' => $_POST['message']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('subject')->required()->length(4,150);
        $valid->field('message')->required()->length(10,600);

        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'br');  
        $config->set('Attr.AllowedClasses', '');  
        $config->set('HTML.AllowedAttributes', '');  
        $config->set('AutoFormat.RemoveEmpty', true);  
        $purifier = new HTMLPurifier($config);

        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        #---- If No Errors Process The Data ------#

        if (empty($errors)) {
          
          #---- Obtain Current Time ------#

          $created_at = strftime("%y-%m-%d %H:%M:%S", time());
          
          #---- Clean And Insert Into THe Database------#

          $message = $purifier->purify($_POST['message']);
          $subject = $purifier->purify($_POST['subject']);

          $sql = "INSERT INTO  inbox (
                                                    sent_by,
                                                    user_id,
                                                    opened,
                                                    message,
                                                    subject,
                                                    created_at
                                                    ) VALUES(
                                                    :sent_by,
                                                    :user_id,
                                                    :opened,
                                                    :message,
                                                    :subject,
                                                    :created_at
                                                    )";
          $create = $this->query( 
                                  $sql, 
                                  [
                                  'sent_by' => $session->user_id, 
                                  'user_id' => $id, 
                                  'opened' => "0", 
                                  'message' => $message, 
                                  'subject' => $subject, 
                                  'created_at' => $created_at
                                  ]
          );
          
          if ($create) {

            #---- Successful ------#

            $session->message("The Message Has Been Sent");
            redirect_to(BASE_URL . "messages/newMessage/" .$id);

          } else {

            #---- Couldnt Be saved------#

            $session->message("Something Went Wrong");
            redirect_to(BASE_URL . "messages/newMessage/" .$id);

          }

        } else {
             
             #---- Valiiidation Errors------#

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "messages/newMessage/" .$id);

          } else {

            $session->message("There were errors.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "messages/newMessage/" .$id);

          }

        }

      } else {
         
        
        $session->message("Submit Form ");
        redirect_to(BASE_URL . "messages/newMessage/" .$id);

      }

    } else {
      
      #---- Wrong CSRF Key------#

      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "messages/newMessage/" .$id);
    }

  }


  /*****************************************
  *
  * @ VOID 
  * Mark Messages Are Opened.
  *
  ******************************************/

  function mark_message($id)
  {
    
    global $session;
    $sql = "UPDATE messages SET opened=:opened WHERE id = :id";
    $new = $this->query($sql, ["opened" => "1", "id" => $id], PDO::FETCH_OBJ);
    if ($new) {
      
      $session->message("The Message Was Marked");
      redirect_to(BASE_URL . "messages");
    } else {
      
      $session->message("The Message Was Not Marked");
      redirect_to(BASE_URL . "messages");
    }

  }
  

  /*****************************************
  *
  * @ VOID 
  * Send Email Reply To Messages.
  *
  ******************************************/

  function reply_message()
  {

    global $session;
    global $csrf;
    
    if ($csrf->checkcsrf($_POST['csrf_token'], "Login")) {
      
      if (isset($_POST['submit'])) {
         
        $errors = [];
        
        #-----Set The Data To be validated ------#

        $data = [
                  'email' => $_POST['email'],
                  'subject' => $_POST['subject'],
                  'message' => $_POST['message']
        ];
        
        #-----Instantiate Validation Class ------#

        $valid = new Engine\Helpers\InputValidator($data);
        
        #-----Start Validation ------#

        $valid->field('email', 'Email Address')->required()->email();
        $valid->field('subject')->required()->length(3,150);
        $valid->field('message')->required()->length(10,500);
        
        #---- Check For any Errors ------#

        if(!$valid->allValid()) {
       
          $errors = $valid->getErrors(); // returns an array of errors indexed by field

        }

        
        if (empty($errors)) {
          
          #---- Get Site Email  ------#

          $sql = "SELECT * FROM settings WHERE name=:name LIMIT 1";
          $new = $this->query(
                              $sql, 
                              ["name" => "Site Email"], 
                              PDO::FETCH_OBJ
          );

          if (!empty($new)) {
            $n = array_shift($new);
            $e = $n->value;
          } else {
            $e = "noreply@" . SITE_NAME;
          }


          #---- New Php Mailer------#

          $mail = new PHPMailer();
          
          #---- Set who the message is to be sent from ------#

          $mail->setFrom($e, $together);
          
          #---- Set an alternative reply-to address ------#

          $mail->addReplyTo($e, $together);
          
          #---- Set who the message is to be sent to ------#

          $mail->addAddress($_POST['email'], 'Liberty As');
          
          #---- Set the subject line ------#

          $mail->Subject = $_POST['subject'];
          
          #---- Message ------#

          $mail->AltBody = $_POST['message'];
          
          #---- Send Email  ------#

          if ($mail->send()) {
            
            $session->message("Reply Sent");
            redirect_to(BASE_URL . "messages");

          } else {
            
            $session->message("Mail Not Sent.");
            redirect_to(BASE_URL . "messages");

          }

        } else {

          #---- Validation Errors ------#

          if (count($errors) == 1) {

            $session->message("There Was An Error.<br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "messages");

          } else {

            $session->message("There were errors . Check Them <br/>" . join("<br/>", $errors));
            redirect_to(BASE_URL . "messages");

          }
        }

      } else {
        
        $session->message("Submit The Form");
        redirect_to(BASE_URL . "messages");

      }
    } else {
      
      #---- SWrong Csrf Token  ------#

      $session->message("Refresh The Page And Try Again");
      redirect_to(BASE_URL . "messages");

    }
  }



  /*****************************************
  *
  * @ array 
  * Return Object arrays of messages.
  *
  ******************************************/


  function get_messages() 
  {
    
    $sql = "SELECT * FROM " . $this->table;
    $new = $this->query($sql, null, PDO::FETCH_OBJ);
    return $new;
  }

    function get_inbox($id) 
  {
    
    $id = $id;
    $sql = "SELECT * FROM inbox WHERE user_id=:user_id";
    $new = $this->query($sql, array("user_id" => $id), PDO::FETCH_OBJ);
    return $new;
  }

      function get_support() 
  {

    $sql = "SELECT * FROM support ORDER BY created_at DESC";
    $new = $this->query($sql, null, PDO::FETCH_OBJ);
    return $new;
  }
  

  /*****************************************
  *
  * @ Object
  * One Message Object.
  *
  ******************************************/

  function find_message($id) 
  {
    
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
  * @ VOID 
  * Delete Messages.
  *
  ******************************************/

  function delete_message($id) 
  {

    global $session;
    $id = $id;
    $sql = "DELETE FROM " . $this->table . " WHERE id=:id LIMIT 1";
    $new = $this->query($sql, array("id" => $id));
    if ($new == 1) {
      $session->message("The message Was  Deleted");
      redirect_to(BASE_URL . "messages/externalMessages");
    } else {
      
      $session->message("The message Was Not Deleted");
      redirect_to(BASE_URL . "messages/externalMessages");
    }

  }

    function delete_inbox($id) 
  {

    global $session;
    $id = $id;
    $sql = "DELETE FROM inbox WHERE id=:id LIMIT 1";
    $new = $this->query($sql, array("id" => $id));
    if ($new == 1) {
      $session->message("The message Was  Deleted");
      redirect_to(BASE_URL . "messages/inbox".$session->user_id);
    } else {
      
      $session->message("The message Was Not Deleted");
      redirect_to(BASE_URL . "messages/inbox" .$session->user_id);
    }

  }

  

}
