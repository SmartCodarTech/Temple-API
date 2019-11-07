<?php

class Model {
    private $connection;
    public  $last_query;
    public  $error;
    private $stmt;
    private $connected = false; 
    private $log;
    private $parameters;
        
       /*==  Default Constructor ==*/

        public function __construct()
        {           
            $this->open_connection();
            $this->parameters = array();
        }
    
       /*==  Make Connection To the Database. ==*/

     private function open_connection()
        {
             $dsn = 'mysql:host=' . DB_SERVER .";port=".  DB_PORT  .';dbname=' . DB_NAME;
             $options = array(

               PDO::ATTR_PERSISTENT    => true,
               PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,             
             );

                try{
                    $this->connection = new PDO($dsn, DB_USER , DB_PASS, $options);

                    #Connected
                    $this->connected = true;

                }
 
                # Catch all And Show It
                catch(PDOException $e){
                    echo $e->getMessage();
                }       
        
        }

       /* Get the connection private value For Other Classes That Need It */    
        public function get_connection(){

            return $this->connection;
        }

       /* initialize For Binding */    

        private function initialize($query,$parameters = "")
        {
        # Connect to database
        if(!$this->connected) { $this->open_connection(); }
        try {
                # Prepare query
                $this->stmt = $this->connection->prepare($query);
                
                # Add parameters to the parameter array 
                $this->bindMore($parameters);

                # Bind parameters
                if(!empty($this->parameters)) {
                    foreach($this->parameters as $param)
                    {
                        $parameters = explode("\x7F",$param);
                        $this->stmt->bindParam($parameters[0],$parameters[1]);
                    }       
                }

                # Execute SQL 
                $this->success  = $this->stmt->execute();       
            }
            catch(PDOException $e)
            {
                    # Write into log and display Exception
                    echo $e->getMessage();
                    die();
            }

            # Reset the parameters
            $this->parameters = array();
        }
        
       /**
    *   @void 
    *
    *   Add the parameter to the parameter array
    *   @param string $para  
    *   @param string $value 
    */  
        public function bind($para, $value)
        {   
            $this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . $value;
        }
       /**
    *   @void
    *   
    *   Add more parameters to the parameter array
    *   @param array $parray
    */  
        public function bindMore($parray)
        {
            if(empty($this->parameters) && is_array($parray)) {
                $columns = array_keys($parray);
                foreach($columns as $i => &$column) {
                    $this->bind($column, $parray[$column]);
                }
            }
        }
       /**
    *       If the SQL query  contains a SELECT statement it returns an array containing all of the result set row
    *   If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
    *
    *       @param  string $query
    *   @param  array  $params
    *   @param  int    $fetchmode
    *   @return mixed
    */          
        public function query($query,$params = null,$fetchmode = PDO::FETCH_ASSOC)
        {
            $query = trim($query);

            $this->initialize($query,$params);

            if (stripos($query, 'select') === 0){
                return $this->stmt->fetchAll($fetchmode);
            }
            elseif (stripos($query, 'insert') === 0 ||  stripos($query, 'update') === 0 || stripos($query, 'delete') === 0) {
                return $this->stmt->rowCount(); 
            }   
            else {
                return NULL;
            }
        }       
       /**
    *   Returns an array which represents a column from the result set 
    *
    *   @param  string $query
    *   @param  array  $params
    *   @return array
    */  
        public function column($query,$params = null)
        {
            $this->initialize($query,$params);
            $Columns = $this->stmt->fetchAll(PDO::FETCH_NUM);       
            
            $column = null;

            foreach($Columns as $cells) {
                $column[] = $cells[0];
            }

            return $column;
            
        }   
       /**
    *   Returns an array which represents a row from the result set 
    *
    *   @param  string $query
    *   @param  array  $params
    *       @param  int    $fetchmode
    *   @return array
    */  
        public function row($query,$params = null,$fetchmode = PDO::FETCH_ASSOC)
        {               
            $this->initialize($query,$params);
            return $this->stmt->fetch($fetchmode);          
        }
       /**
    *   Returns the value of one single field/column
    *
    *   @param  string $query
    *   @param  array  $params
    *   @return string
    */  
        public function single($query,$params = null)
        {
            $this->initialize($query,$params);
            return $this->stmt->fetchColumn();
        }
       /**  
    * Writes the log and returns the exception
    *
    * @param  string $message
    * @param  string $sql
    * @return string
    */
    private function ExceptionLog($message , $sql = "")
    {
        $exception  = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= "<br /> You can find the error back in the log.";

        if(!empty($sql)) {
            # Add the Raw SQL to the Log
            $message .= "\r\nRaw SQL : "  . $sql;
        }
            # Write into log
            $this->log->write($message);

        return $exception;
    }  

             
}

$database = new Model();

