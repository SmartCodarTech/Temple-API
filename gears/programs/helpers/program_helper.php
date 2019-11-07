<?php


#------program Helper Functions--------#

function get_program_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM programs WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n;
}



function get_program_name_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM programs WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->name;
}


function get_programs(){

  global $database;
  $sql = " SELECT * FROM programs";
  $new = $database->query(
                          $sql, 
                          null, 
                          PDO::FETCH_OBJ
  );
  return $new;

}


function get_program_id_by_user($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM students WHERE user_id=:user_id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["user_id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  if(!empty($new)){
  $n = array_shift($new);
  return $n->program;
  }else{

    return "";
  }

}

function get_program_by_user_id($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM students WHERE user_id=:user_id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["user_id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->program;


}

function get_students_in_term_prog($i,$prog){

  

  global $database;
  $sql = " SELECT * FROM students WHERE level=:level AND program=:program";
  $new = $database->query(
                          $sql, 
                          [
                          "level" => $i,
                          "program"=>$prog
                          ], 
                          PDO::FETCH_OBJ
  );
  
  if(!empty($new)){
  return count($new);
  }else{

    return 0;
  }


}


