<?php 

function get_wear_name(){

  global $database;

   $sql =" SELECT * FROM settings WHERE name=:name";
   $new = $database->query($sql,array("name"=>"Wear Front"),PDO::FETCH_OBJ);
    
    if(!empty($new)){ $wear = array_shift($new); return $wear->value;}else{
    	return $new;
    }


}

function get_data_entry(){

  global $database;

   $sql =" SELECT * FROM settings WHERE name=:name";
   $new = $database->query($sql,array("name"=>"Data Entry"),PDO::FETCH_OBJ);
    
    if(!empty($new)){ $wear = array_shift($new); return $wear->value;}else{
      return "NO";
    }


}

function get_registration_mode(){

  global $database;

   $sql =" SELECT * FROM settings WHERE name=:name";
   $new = $database->query($sql,array("name"=>"Student Registration"),PDO::FETCH_OBJ);
    
    if(!empty($new)){ $wear = array_shift($new); return $wear->value;}else{
      return "Disallow";
    }


}


function get_other_wears(){

  global $database;

   $sql =" SELECT * FROM settings WHERE name=:name";
   $new = $database->query($sql,array("name"=>"Wear Front"),PDO::FETCH_OBJ);
    
    if(!empty($new)){ $wear = array_shift($new); return $wear->value;}else{
      return $new;
    }


}

function get_settings(){

  global $database;

   $sql =" SELECT * FROM settings";
   $new = $database->query($sql,null,PDO::FETCH_OBJ);
    	return $new;


}