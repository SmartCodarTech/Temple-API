<?php

class Session
{


    private $logged_in=false;
    public  $user_id;
    public  $message;


    
  
    public function Session($db, $gc_maxlifetime = '', $gc_probability = '', $gc_divisor = '', $securityCode = 'eF@0#u^*sZD9!S$%') {
        if($gc_maxlifetime != '' && is_integer($gc_maxlifetime)) {
            @ini_set('session.gc_maxlifetime', $gc_maxlifetime);
        }

        if($gc_probability != '' && is_integer($gc_probability)) {
            @ini_set('session.gc_probability', $gc_probability);
        }

        if($gc_divisor != '' && is_integer($gc_divisor)) {
            @ini_set('session.gc_divisor', $gc_divisor);
        }

        $this->db              = $db;
        $this->sessionLifetime = ini_get('session.gc_maxlifetime');
        $this->securityCode    = $securityCode;

        session_set_save_handler(array(
            &$this,
            'open'
        ), array(
            &$this,
            'close'
        ), array(
            &$this,
            'read'
        ), array(
            &$this,
            'write'
        ), array(
            &$this,
            'destroy'
        ), array(
            &$this,
            'gc'
        ));
        register_shutdown_function('session_write_close');
        session_start();
         $this->check_message();
         $this->check_login();
    }

    public function stop() {
        $this->regenerate_id();
        session_unset();
        session_destroy();      
    }

    public function regenerate_id() {
        $oldSessionID = session_id();
        session_regenerate_id();
        $this->destroy($oldSessionID);
    }

    public function get_users_online() {
        $this->gc($this->sessionLifetime);
        $query  = 'SELECT COUNT(`session_id`) as count FROM `sessions`';
        $result = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        return intval($result["count"]);
    }

    public function open($save_path, $session_name) {
        return true;
    }

    public function close() {
        return true;
    }

    public function read($session_id) {
        $user_agent = md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode);
        $query_time = time();

        try {
            $query    = 'SELECT `session_data` FROM `sessions` WHERE `session_id` = :session_id AND `http_user_agent` = :user_agent AND `session_expire` > :time LIMIT 1';
            $query_do = $this->db->prepare($query);
            $query_do->bindParam(':session_id', $session_id, PDO::PARAM_STR);
            $query_do->bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
            $query_do->bindParam(':time', $query_time, PDO::PARAM_INT);
            $query_do->execute();
            $number = $this->db->query('SELECT FOUND_ROWS()')->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if(!empty($number)) {
            $fields = $query_do->fetch(PDO::FETCH_ASSOC);
            return $fields["session_data"];
        }

        return '';
    }

    public function write($session_id, $session_data) {
        $user_agent     = md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode);
        $session_expire = time() + $this->sessionLifetime;

        try {
            $write_session    = 'INSERT INTO `sessions` (`session_id`, `http_user_agent`, `session_data`, `session_expire`) VALUE(:session_id, :user_agent, :session_data, :session_expire) ON DUPLICATE KEY UPDATE session_data = :session_data, session_expire = :session_expire';
            $write_session_do = $this->db->prepare($write_session);
            $write_session_do->bindParam(':session_id', $session_id, PDO::PARAM_STR);
            $write_session_do->bindParam(':user_agent', $user_agent, PDO::PARAM_STR);
            $write_session_do->bindParam(':session_data', $session_data, PDO::PARAM_LOB);
            $write_session_do->bindParam(':session_expire', $session_expire, PDO::PARAM_INT);
            $confirm = $write_session_do->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if(!empty($confirm)) {
            return true;
        } else {
            return '';
        }

        return false;
    }

    public function destroy($session_id) {
        try {
            $delete_session    = 'DELETE FROM `sessions` WHERE `session_id` = :session_id';
            $delete_session_do = $this->db->prepare($delete_session);
            $delete_session_do->bindParam(':session_id', $session_id, PDO::PARAM_STR);
            $delete_session_do->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if($delete_session_do->rowCount()) {
            return true;
        }

        return false;

    }

    public function gc($maxlifetime) {
        $query_time = time() - $maxlifetime;

        try {
            $gc    = "DELETE FROM `sessions` WHERE `session_expire` < :query_time";
            $gc_do = $this->db->prepare($gc);
            $gc_do->bindParam(':query_time', $query_time, PDO::PARAM_INT);
            $gc_do->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
   //setting login attaemps for the first time login

 
 // setting start and end time for time period give after 5 login attenps
 
 
 
 public function login($user) {
    // database should find user based on email/password
    if($user){
      $this->user_id = $_SESSION['user_id'] = $user['id'];
   
      $this->logged_in = true;
    }
  }
    public function is_logged_in() {
    return $this->logged_in;
    }
    
   
  public function logout() {

    $this->stop();
    $this->logged_in = false;
  }
  
  
    public function message($msg="") {
      if(!empty($msg)) {
        // then this is "set message"
        // make sure you understand why $this->message=$msg wouldn't work
        $_SESSION['message'] = $msg;
      } else {
        // then this is "get message"
            return $this->message;
      }
    }
    
private function check_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->logged_in = true;
    } else {
      unset($this->user_id);
      $this->logged_in = false;
    }
}
private function check_message() {
        // Is there a message stored in the session?
    if(isset($_SESSION['message'])) {
            // Add it as an attribute and erase the stored version
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    } else {
      $this->message = "";
    }
    }  
    
  
    
    

}
global $database;
$session = new session($database->get_connection());
$sessionmessage = $session->message();
