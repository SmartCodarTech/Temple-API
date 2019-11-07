<?php


#------School Helper Functions--------#

function get_school_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM schools WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n;
}



function get_school_name_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM schools WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->name;
}


function get_school_id_user($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->school_id;


}


