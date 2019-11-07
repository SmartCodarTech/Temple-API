<?php

  

function get_event_photos(){
  global $database;

   $sql =" SELECT * FROM photos 
                                WHERE 
                                purpose=:purpose";
   $new = $database->query(
                            $sql,
                            ["purpose"=>"Event"],
                            PDO::FETCH_OBJ
   );
   
    return $new;

}


function get_gallery_photos(){
  
   global $database;
   $sql =" SELECT * FROM photos 
                              WHERE 
                              purpose=:purpose";
   $new = $database->query(
                            $sql,
                            ["purpose"=>"Gallery"],
                            PDO::FETCH_OBJ
   );

   return $new;

}

function get_all_photos(){
  
   global $database;
   $sql =" SELECT * FROM photos";
   $new = $database->query(
                            $sql,
                            null,
                            PDO::FETCH_OBJ
   );

   return $new;

}

function get_all_audio(){

   global $database;
   $sql ="SELECT * FROM audio_library";
   $new = $database->query(
                            $sql,
                            null,
                            PDO::FETCH_OBJ
    );

    return $new;


}

function get_all_video(){

   global $database;
   $sql ="SELECT * FROM video_library";
   $new = $database->query(
                            $sql,
                            null,
                            PDO::FETCH_OBJ
    );

    return $new;


}

function get_sermon_photos(){
  
   global $database;
   $sql =" SELECT * FROM photos 
                                WHERE 
                                purpose=:purpose";
   $new = $database->query(
                            $sql,
                            ["purpose"=>"Article"],
                            PDO::FETCH_OBJ
   );
   return $new;

}

function get_image_media_by_id($id){

   $id= $id;
   global $database;
   $sql ="SELECT * FROM photos 
                              WHERE 
                              id=:id";
   $new = $database->query(
                            $sql,
                            ["id"=>$id],
                            PDO::FETCH_OBJ
    );

   if(!empty($new)){$image = array_shift($new); return $image;}else{
    return $new;
   }

}

function get_audio_media_by_id($id){

   $id= $id;
   global $database;
   $sql ="SELECT * FROM audio_library 
                                      WHERE 
                                      id=:id";
   $new = $database->query(
                            $sql,
                            ["id"=>$id],
                            PDO::FETCH_OBJ
   );
   if(!empty($new)){$image = array_shift($new); return $image;}else{
    return $new;
   }

}

function get_video_media_by_id($id){

   $id= $id;
   global $database;
   $sql ="SELECT * FROM video_library 
                                      WHERE 
                                      id=:id";
   $new = $database->query(
                            $sql,
                            ["id"=>$id],
                            PDO::FETCH_OBJ
   );

   if(!empty($new)){$image = array_shift($new); return $image;}else{
    return $new;
   }

}

function get_external_video_media_by_id($id){

   $id= $id;
   global $database;
   $sql ="SELECT * FROM embedded_videos 
                                        WHERE 
                                        id=:id";
   $new = $database->query(
                            $sql,
                            ["id"=>$id],
                            PDO::FETCH_OBJ
   );

   if(!empty($new)){$image = array_shift($new); return $image;}else{
    return $new;
   }

}
function get_videos(){
  
   global $database;
   $sql ="SELECT * FROM videos 
                              WHERE 
                              show=:show";
   $new = $database->query(
                           $sql,
                           ["show"=>"ok"],
                           PDO::FETCH_OBJ
    );
   return $new;

}

function get_other_photos(){

   global $database;
   $sql =" SELECT * FROM photos 
                                WHERE 
                                purpose=:purpose";
   $new = $database->query(
                            $sql,
                            ["purpose"=>"Other"],
                            PDO::FETCH_OBJ
    );
    return $new;

}

function get_photos(){

   global $database;
   $sql =" SELECT * FROM photos 
                                WHERE 
                                purpose=:purpose";
   $new = $database->query(
                            $sql,
                            ["purpose"=>"Sermon"],
                            PDO::FETCH_OBJ
   );
    return $new;

}
