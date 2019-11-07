<?php

function get_text_units() {
  
  global $database;
  $sql = "SELECT * FROM notify_settings WHERE name=:name LIMIT 1";
  $query = $database->query($sql, array('name' => 'Credits'), PDO::FETCH_OBJ);
  
  if (!empty($query)) {
    
    $credits = array_shift($query);
    return $credits->value;
  } else {
    
    return 0;
  }
}

function get_setting_id($name) {
  
  global $database;
  $sql = "SELECT * FROM notify_settings WHERE name=:name LIMIT 1";
  $query = $database->query($sql, array('name' => $name), PDO::FETCH_OBJ);
  
  if (!empty($query)) {
    
    $credits = array_shift($query);
    return $credits->id;
  } else {
    
    return 0;
  }
}

function get_notify_setting($name) {
  
  global $database;
  $sql = "SELECT * FROM notify_settings WHERE name=:name LIMIT 1";
  $query = $database->query($sql, array('name' => $name), PDO::FETCH_OBJ);
  
  if (!empty($query)) {
    
    $credits = array_shift($query);
    return $credits->value;
  } else {
    
    return 0;
  }
}

function get_msg_length($message) {
  
  $length = strlen($message);
  
  if ($length <= 160) {
    
    return 1;
  } elseif ($length > 160 && $length <= 256) {
    
    return 2;
  } elseif ($length > 256 && $length <= 365) {
    
    return 3;
  } elseif ($length > 365 && $length <= 465) {
    
    return 4;
  } else {
    
    return 5;
  }
}

function get_notify_contact_groups() {
  
  global $database;
  $sql = "SELECT * FROM notify_group";
  $query = $database->query($sql, null, PDO::FETCH_OBJ);
  
  if (!empty($query)) {
    
    return $query;
  } else {
    
    return "";
  }
}

function send_single_msg($number, $locality, $message, $length) {
  global $database;
  $login_phone = '0202809455';
  $login_password = 'addsonyk800';
  $limit = get_text_units();
  if ($locality === "YES") {
    $phone = $number;
    
    $url = "http://www.nasaramobile.com/sms/api.php?phone=$login_phone&&password=$login_password&&sender_id=$sender_id&&to=$phone&&message=" . urlencode($message) . "";
    
    //send message and get response
    $response = file_get_contents($url);
    if ($response == '1801') {
      
      $left = $limit - $length;
      $sql = "UPDATE notify_settings SET value=:value WHERE id=:id";
      $query = $database->query($sql, array('value' => $left, 'id' => get_setting_id("Credits")), PDO::FETCH_OBJ);
      
      return true;
    } elseif ($response == '1802') {
      
      return false;
    }
  } else {
    
    //other gateway logic
    
    
  }
}

function send_group_msg($group, $sender_id, $message, $length) {
  global $database;
  $login_phone = '0202809455';
  $login_password = 'addsonyk800';
  
  //get The group
  if (empty($group) || empty($sender_id) || empty($message)) {
    
    return " Group / Sender Id / Message Cannot Be Empty";
  } else {
    
    //get the group
    $sql = "SELECT * FROM notify_group WHERE id=:id LIMIT 1";
    $query = $database->query($sql, array("id" => $group), PDO::FETCH_OBJ);
    if (!empty($query)) {
      
      $g = array_shift($query);
      if ($g->locality === "YES") {
        
        // get all the numbers
        $contacts = explode(",", $g->numbers);
        $numbers = array();
        $notify = get_all_notify_contacts();
        
        if (!empty($notify)) {
          
          foreach ($notify as $note) {
            
            if (in_array($note->id, $contacts)) {
              
              $numbers[] = $note->number;
            }
          }
          
          // check if the numbers are populated
          if (!empty($numbers)) {
            
            //count the number of numbers
            $count = count($numbers);
            $send_error = 0;
            $limit = get_text_units();
            $sent = 0;
            $number_count = 0;
            
            foreach ($numbers as $number) {
              
              $phone = "0" . $number;
              
              //send the message here and upon the response
              //you can either check on the errors and the subtract from it.
              if ($sent < $limit) {
                
                $url = "http://www.nasaramobile.com/sms/api.php?phone=$login_phone&&password=$login_password&&sender_id=$sender_id&&to=$phone&&message=" . urlencode($message) . "";
                
                //send message and get response
                $response = file_get_contents($url);
                if ($response == '1801') {
                  
                  $sent+= $length;
                  $number_count++;
                } elseif ($response == '1802') {
                  
                  $send_error++;
                }
              } else {
                
                $left = $limit - $sent;
                $sql = "UPDATE notify_settings SET value=:value WHERE id=:id";
                $query = $database->query($sql, array('value' => $left, 'id' => get_setting_id("Credits")));
                return $sent . "Messages Sent To " . $number_count . " Numbers<br/> " . " SMS Credits Is left With " . $left . "<br/>Messages Not Sent " . $send_error;
              }
            }
            
            $left = $limit - $sent;
            $sql = "UPDATE notify_settings SET value=:value WHERE id=:id";
            $query = $database->query($sql, array('value' => $left, 'id' => get_setting_id("Credits")));
            return $sent . "Messages Sent To " . $number_count . " Numbers<br/> " . " SMS Credits Is left With " . $left . "<br/>Messages Not Sent " . $send_error;
          } else {
            
            return "No Numbers In This Group Yet";
          }
        } else {
          
          return "No Contacts Created";
        }
      } else {
        
        //foreign logic
        
        
      }
    } else {
      
      return "Group Does Not Exist";
    }
  }
}

function get_all_notify_contacts() {
  global $database;
  $sql = "SELECT * FROM notify_contacts";
  $query = $database->query($sql, null, PDO::FETCH_OBJ);
  return $query;
}

