<?php 



#-------Get Unread Messages -------#

function get_new_messages(){

  	global $database;
    $sql = "SELECT * FROM messages WHERE opened=:opened LIMIT 1";		
    $new = $database->query($sql,array("opened"=>'0'),PDO::FETCH_OBJ);
    if(!empty($new)){

    	return count($new);
    }else{

    	return "0";
    }
     
}

function get_support_count(){

	global $database;
    $sql = "SELECT * FROM support WHERE opened=:opened LIMIT 1";		
    $new = $database->query($sql,array("opened"=>'0'),PDO::FETCH_OBJ);
    if(!empty($new)){

    	return count($new);
    }else{

    	return "0";
    }

}