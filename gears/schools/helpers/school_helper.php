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

function get_school_name_by_id($id) 
{
  global $database;
  $id = intval($id);
  $school_id = get_school_id_user($id);

  $sql = " SELECT * FROM schools WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $school_id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->name;
}

function get_school_end_by_id() 
{
  global $database;
  global $session;
  $school_id = get_school_id_user($session->user_id);

  $sql = " SELECT * FROM schools WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $school_id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->school_end;
}


function check_term_end(){

  global $database;
  global $session;
  $school_id = get_school_id_user($session->user_id);
  $sql = " SELECT * FROM schools WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $school_id], 
                          PDO::FETCH_OBJ
  );
  

  if(!empty($new)){

  $n = array_shift($new);
  $term_end = $n->term_end_date;

  $start = \DateTime::createFromFormat('Y-m-d', $term_end);
  $now = strftime("%y-%m-%d", time());
  $end = \DateTime::createFromFormat('Y-m-d',$now);


  if($end > $start){

  return true;

  }else{

    return false;
  }


  }else{

    return false;

  }


}


function get_academic_year_by_id() 
{
  global $database;
  global $session;
  $school_id = get_school_id_user($session->user_id);

  $sql = " SELECT * FROM schools WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $school_id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->academic_year;
}

function get_student_term_stats(){
  
  global $database;
  global $session;
  $school_end = get_school_end_by_id();
  $stats = [];
  for ($i=1; $i <= $school_end ; $i++) { 

  $sql = " SELECT * FROM students WHERE level=:level LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["level" => $i], 
                          PDO::FETCH_OBJ
  );

  $count = count($new);
  $stats[] = "Students In Level " . $i . " : " .$count;


  }


  return $stats;

  
}

function get_student_program_stats(){

  global $database;
  global $session;
  $stats = [];

  $sql = " SELECT * FROM programs";
  $progs = $database->query(
                          $sql, 
                          null, 
                          PDO::FETCH_OBJ
  );
  

 if(!empty($progs)){
  foreach($progs as $prog){ 

  $sql = " SELECT * FROM students WHERE program=:program LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["program" => $prog->id], 
                          PDO::FETCH_OBJ
  );

  $count = count($new);
  $stats[] = "Students Currently In - " . $prog->name . " : " .$count;


  }
  
 }

  return $stats;


}




