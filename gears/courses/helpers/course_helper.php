<?php


#------course Helper Functions--------#

function get_course_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n;
}

function get_courses(){

  global $database;

  $sql = " SELECT * FROM courses";
  $new = $database->query(
                          $sql, 
                          null, 
                          PDO::FETCH_OBJ
  );
  
  ;
  return $new;

}

function get_course_name_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->name;
}

function get_course_code_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->course_code;
}

function get_course_level_by_id($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->level;


}

function get_course_program_by_id($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->program;


}

function get_course_id_user($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->course_id;


}


function get_courses_for_level_program($program,$level){

  global $database;


  $sql = " SELECT * FROM courses WHERE 
                                      program=:program 
                                      AND
                                      level=:level
                                      ";
  $new = $database->query(
                          $sql, 
                          [
                          "program" => $program,
                          "level"=>$level
                          ], 
                          PDO::FETCH_OBJ
  );
  
  return $new;

}



