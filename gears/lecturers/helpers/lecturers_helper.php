<?php


#------lecturers Helper Functions--------#

function get_lecturers_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM lecturerss WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n;
}



function get_lecturers_name_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM lecturerss WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->name;
}


function get_lecturers_id_user($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->lecturers_id;


}

function get_lecturers_courses($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM term_courses WHERE lecturers IN (:lecturers)";
  $new = $database->query(
                          $sql, 
                          [
                          "lecturers" => $id
                          ], 
                          PDO::FETCH_OBJ
  );
  return $new;

}


function get_lecturers_students($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM term_courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  if(!empty($n->students)){

    $stu = explode(",", $n->students);
    return $stu;

  }else{
 

    return "";
  }



}

function get_lecturers_for_course($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM term_courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  if(!empty($n->lecturers)){

    $stu = explode(",", $n->lecturers);
    $lecs ="";

    foreach ($stu as $stud) {
      $lecs .= get_user_name_by_id($stud) ." - ";
    }
    return $lecs;

  }else{
 

    return "";
  }

}
