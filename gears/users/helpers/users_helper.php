<?php


#------User Helper Functions--------#

function get_user_name_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->first_name . " " . $n->last_name;
}


function get_user_profile($member_id)
{

  global $database;

  $sql = "SELECT * FROM profiles WHERE member_id=:member_id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["member_id" => $member_id], 
                          PDO::FETCH_OBJ
  );

  if (!empty($new)) {

    return array_shift($new);

  } else {

    return $new;

  }

}


function get_user($id) 
{
  global $database;

  $sql = "SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );

  if (!empty($new)) {

    return array_shift($new);

  } else {

    return $new;

  }
}



function get_users() 
{
  global $database;

  $sql = "SELECT * FROM users";
  $new = $database->query(
                          $sql, 
                          null, 
                          PDO::FETCH_OBJ
  );
  
  return $new;
}

#------User Comment  Functions--------#

function get_all_comments($purpose, $item_id) 
{
  global $database;

  $sql = "SELECT * FROM coments WHERE purpose=:purpose AND item_id=:item_id ORDER BY created_at DESC";
  $new = $database->query(
                          $sql, 
                          ["purpose" => $purpose, 
                          "item_id" => $item_id], 
                          PDO::FETCH_OBJ
  );

  return $new;
}

function get_all_user_comments($member_id) {
  
  global $database;

  $sql = "SELECT * FROM coments WHERE member_id=:member_id ORDER BY created_at DESC";
  $new = $database->query(
                          $sql, 
                          ["member_id" => $member_id], 
                          PDO::FETCH_OBJ
  );

  return $new;

}

function get_all_user_comments_count($member_id) {
  
  global $database;

  $sql = "SELECT * FROM coments WHERE member_id=:member_id ORDER BY created_at DESC";
  $new = $database->query(
                          $sql, 
                          ["member_id" => $member_id], 
                          PDO::FETCH_OBJ
  );

  return count($new);
}


function get_all_user_status($member_id) 
{
  global $database;
  $sql = "SELECT * FROM status WHERE member_id=:member_id ORDER BY created_at DESC";
  $new = $database->query(
                          $sql, 
                          ["member_id" => $member_id], 
                          PDO::FETCH_OBJ
  );
  return $new;
}

function get_all_user_status_count($member_id) 
{
  global $database;

  $sql = "SELECT * FROM status WHERE member_id=:member_id ORDER BY created_at DESC";
  $new = $database->query(
                          $sql, 
                          ["member_id" => $member_id], 
                          PDO::FETCH_OBJ
  );

  return count($new);

}

function get_last_impression($member_id) {
  
  global $database;

  $sql = "SELECT * FROM status WHERE member_id=:member_id ORDER BY created_at DESC LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["member_id" => $member_id], 
                          PDO::FETCH_OBJ
  );

  if (!empty($new)) {
    
    $n = array_shift($new);
    
    return $n->status;

  } else {
    
    return "Nothing Posted By This User Yet";

  }

}

function get_member_pics($id) {
  
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );

  $n = array_shift($new);
  return $n->user_pic;
}

function get_user_pics($id) {
  
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );

  $n = array_shift($new);
  return $n->user_pic;
}


function get_first_name_by_id($id) {
  
  global $database;
  $id = intval($id);
  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );

  $n = array_shift($new);
  return $n->first_name;
}

function get_recent_members() {

  global $database;
  $sql = "SELECT * FROM users LIMIT 10";
  $new = $database->query(
                          $sql, 
                          null, 
                          PDO::FETCH_OBJ
  );

  return $new;
}


function get_userImage($id) {

  global $database;
  $new = User::find_by_id($id);
  
  return "content/user_files/" . $id . "/" . $new->user_picture;
}

function get_cur_user() {
  
  global $session;
  global $database;
  $new = $database->row(" SELECT * FROM users WHERE id=:id", array("id" => $session->user_id));
  return $new;

}

function get_all_user_count() {
  
  global $database;
  $new = $database->query("SELECT * FROM users");
  return count($new) - 1;

}
