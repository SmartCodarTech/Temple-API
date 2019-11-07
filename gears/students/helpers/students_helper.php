<?php


#------student Helper Functions--------#

function get_student_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM students WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  if(!empty($new)){
  $n = array_shift($new);
  return $n;
  }else{

    return '';
  }
}

function get_student_by_user_id($id) 
{
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
  return $n;
  }else{

    return '';
  }
}

function get_students_count(){

  global $database;
  $sql = " SELECT * FROM students";
  $new = $database->query(
                          $sql, 
                          null, 
                          PDO::FETCH_OBJ
  );
  
  
  return count($new);
}

function student_completed($id){


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

  if($n->completed === "YES"){
  return true;

  }else{

  return false;
  
  }

  }else{

    return false;

  }


}
function get_student_id_by_user($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM students WHERE user_id=:user_id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["user_id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->student_id;
}

function get_student_name_by_id($id) 
{
  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          [
                          "id" => $id
                          ], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->name;
}


function get_student_id_user($id){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM users WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->student_id;


}

function get_students_courses($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM students WHERE user_id=:user_id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          [
                          "user_id" => $id
                          ], 
                          PDO::FETCH_OBJ
  );
  
  if(!empty($new)){

    $stu = array_shift($new);
    $term = $stu->level;
    $program = $stu->program;

    $sql = " SELECT * FROM term_courses WHERE 
                                              level=:level 
                                              AND
                                              program=:program";
    $courses = $database->query(
                            $sql, 
                            [
                            "level" => $term,
                            "program"=>$program
                            ], 
                            PDO::FETCH_OBJ
    );

    return $courses;

  }else{

    return "";

  }

}

function course_registered($id,$course){


  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM term_courses WHERE id=:id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          [
                          "id"=>$course
                          ], 
                          PDO::FETCH_OBJ
  );

  if(!empty($new)){

    $course = array_shift($new);
    $stus = explode(",", $course->students);
    if(in_array($id, $stus)){
    
    
    return true;

    }else{


    return false;
    }

  }else{

    return false;
  }


}

function get_student_level_by_user_id($id){

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
  return $n->level;
  }else{
    return 0;
  }

}
function get_student_program_by_user_id($id){

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

function get_student_academic_year_by_user_id($id){

  global $database;
  $id = intval($id);

  $sql = " SELECT * FROM students WHERE user_id=:user_id LIMIT 1";
  $new = $database->query(
                          $sql, 
                          ["user_id" => $id], 
                          PDO::FETCH_OBJ
  );
  
  $n = array_shift($new);
  return $n->academic_year;


}

function overall_level($user_id,$level){



}

function course_grades($id,$level){

  global $database;
  $id = intval($id);

  $sql = "SELECT * FROM transcripts WHERE 
                                          user_id=:user_id 
                                          AND
                                          level=:level";
  $new = $database->query(
                          $sql, 
                          [
                          "user_id" => $id,
                          "level"=>$level
                          ], 
                          PDO::FETCH_OBJ
  );
  
  return $new;

}

function get_over_term_perf($id,$level){


  global $database;
  $id = intval($id);

  $sql = "SELECT * FROM transcripts WHERE 
                                          user_id=:user_id 
                                          AND
                                          level=:level";
  $new = $database->query(
                          $sql, 
                          [
                          "user_id" => $id,
                          "level"=>$level
                          ], 
                          PDO::FETCH_OBJ
  );
  
  if(!empty($new)){
      
      $cnt = count($new);
      $amt=0;
      foreach ($new as $value) {
        
        $amt += $value->score;

      }
      $mark = $cnt * 100;
      $ans = ($amt / $mark) * 100;
      return $ans;

  }else{

    return 0;
  }



}

function get_remarks_pref($id,$level){

  global $database;
  $id = intval($id);

  $sql = "SELECT * FROM remarks WHERE 
                                          user_id=:user_id 
                                          AND
                                          level=:level";
  $new = $database->query(
                          $sql, 
                          [
                          "user_id" => $id,
                          "level"=>$level
                          ], 
                          PDO::FETCH_OBJ
  );


return $new;

}

function get_highest_term_score($id,$level){
  
  $grades = course_grades($id,$level);

   if(!empty($grades)){
     
     $container = 0;

     foreach ($grades as $grade) {
       
       if($grade->score > $container){

        $container = $grade->score;
       }


     }

     return $container;


   }else{

    return 0;
   }

}

function get_lowest_term_score($id,$level){
  
  $grades = course_grades($id,$level);

   if(!empty($grades)){
     
     $container = 0;

     foreach ($grades as $grade) {
       
       if($container == 0){

        $container = $grade->score;

       }elseif($container < $grade->score){
            
            $container = $container;
 
       }elseif($container > $grade->score){

             $container = $grade->score;

       }else{



       }


     }

     return $container;


   }else{

    return 0;
   }

}


function get_student_for_level($program,$academic_year){
    global $database;
  
$sql = "SELECT * FROM students WHERE program=:program
                                     AND
                                     academic_year=:academic_year";
$new = $database->query(
                          $sql, 
                          [
                          "program"=>$program,
                          "academic_year"=>$academic_year
                          ], 
                          PDO::FETCH_OBJ
  );

$classmates = []; 
 if(!empty($new)){

 foreach ($new as $key) {
    
     $classmates[] = $key->user_id;
 }

  
  return $classmates;

 }else{
  
  return "";

 }


}

function get_all_failed_courses($user_id){


    global $database;
  
$sql = "SELECT * FROM transcripts WHERE user_id=:user_id
                                     AND
                                     grade=:grade";
$new = $database->query(
                          $sql, 
                          [
                          "user_id"=>$user_id,
                          "grade"=>"F"
                          ], 
                          PDO::FETCH_OBJ
  );

 if(!empty($new)){

  return $new;

 }else{
  
  return "";

 }



}

function get_failed_courses(){


    global $database;
  
$sql = "SELECT * FROM transcripts WHERE
                                     grade=:grade";
$new = $database->query(
                          $sql, 
                          [
                          "grade"=>"F"
                          ], 
                          PDO::FETCH_OBJ
  );

 if(!empty($new)){

  return $new;

 }else{
  
  return "";

 }



}