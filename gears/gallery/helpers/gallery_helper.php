<?php 

function get_gallery_groups(){
  global $database;

   $sql =" SELECT * FROM gallery_groupings";
   $new = $database->query(
                            $sql,
                            null,
                            PDO::FETCH_OBJ
   );
   
    return $new;

}

function get_gallery(){
  global $database;

   $sql =" SELECT * FROM gallery";
   $new = $database->query(
                            $sql,
                            null,
                            PDO::FETCH_OBJ
    );
   
    return $new;

}

function get_gallery_by_group_id($id){
   global $database;

   $sql =" SELECT * FROM gallery 
                                WHERE
                                gallery_group:=gallery_group";
   $new = $database->query(
                            $sql,
                            [
                            "gallery_group"=>$id
                            ],
                            PDO::FETCH_OBJ
    );
   
    return $new;


}

function hypen_group_name($name){

$array =  explode(" ", $name);
$new_name = "";
foreach ($array as $key) {
	$new_name .= "-".$key;
}

return $new_name;

}

function get_group_name_by_id($id){
  global $database;
   $id = $id;
   $sql =" SELECT * FROM gallery_groupings 
                                          WHERE 
                                          id=:id 
                                          LIMIT 1";
   $new = $database->query(
                            $sql,
                            ["id"=>$id],
                            PDO::FETCH_OBJ
   );

   if(!empty($new)){

   $group = array_shift($new);
   return $group->name;

   }else{

   	return " ";
    
   }

}