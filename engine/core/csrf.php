<?php
namespace Engine\Core;

class Csrf 
{

   public  $proccess='none'; // proccess page the script is good for
   public  $life = 720; // minutes for which key is good
   private $table = 'tokens';
   private $token; // session id of user
   
   public function __construct() 
   {
      $token = session_id();
      $this->token  = preg_replace('/[^a-z0-9]+/i','',$token);
   }
      
   public function csrfkey() 
   {

      global $database;
      $key = md5(microtime() . $this->token . rand());
      $stamp = time() + (60 * $this->life);
      $q = $database->query(
                             "INSERT INTO $this->table ( 
                             token,
                             tokenkey,
                             stamp,
                             proccess
                             ) VALUES (
                             :token,
                             :tokenkey,
                             :stamp,
                             :proccess)",
                             ["token"=>"{$this->token}",
                              "tokenkey"=>"{$key}",
                              "stamp"=>"{$stamp}",
                              "proccess"=>"{$this->proccess}"]
      );

      return $key;

   }
      
   public function checkcsrf($key,$proccess) 
   {

      global $database;
      $this->cleanOld();
      $cleanKey = preg_replace('/[^a-z0-9]+/','',$key);
      if (strcmp($key,$cleanKey) != 0) {
         return false;
         } else {
            $proccess = $proccess;
         $q = $database->row(
                              "SELECT id FROM $this->table WHERE  
                              tokenkey=:tokenkey AND 
                              proccess=:proccess",
                              ["tokenkey"=>"{$cleanKey}",
                              "proccess"=>"{$proccess}"]
         );

         $valid = $q['id'];
            
         if (! isset($valid)) {

            return false;

            } else {

            $q = $database->query(
                                  "DELETE FROM $this->table WHERE id=:id",
                                  ["id"=>"{$valid}"]
            );

            return true;

            }
         }
      }
      
   private function cleanOld() {
      // remove expired keys
      global $database;
      $exp = time();
      $q = $database->query(
                              "DELETE FROM $this->table WHERE stamp=:stamp",
                              ["stamp"=>"{$exp}"]
      );

      return true;
      
      }
      
   public function logout() {
    
      global $database;
      $args  = $this->token;
      $q = $database->query("DELETE FROM $this->table WHERE token=:token",array("token"=>"{$args}"));
      return true;
    
   }




   }

 $csrf = new Csrf();