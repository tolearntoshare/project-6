<?php

class db {
    
    private static $instance=null;
    private $dbconn;
    public $status;
    public $counter=0;
    
    
    private $host;
    private $dbname;
    private $username;
    private $password;
    
     
    private function __construct() {
        try {
            
            //these values will be pulled from
            // './config/initializing.core.php'
            // you need spl_autload_register() at the top of any 
            // page called this page to pull required pages
           
            
            $this->host='127.0.0.1';//$GLOBALS['config']['mysql']['host'];
            $this->dbname='loginsystem';//$GLOBALS['config']['mysql']['dbname'];
            $this->username='root';//;$GLOBALS['config']['mysql']['username'];
            $this->password='';//$GLOBALS['config']['mysql']['password'];
            
            
             // [1-] new PDO always return null if not success
            $this->dbconn=new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            if(!is_null( $this->dbconn)){
                echo "Constructor ,, dbconn is not null"; 
                // set fecth mode
                // set error mode
             $this->status= $this->dbconn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
             $this->dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
             $this->counter += 1;
            }
                        
            
            
        } catch (PDOException $e) {
            
            // die and log that in system 
            // Also send email to your website admin 
           error_log("========= Big trouble, we're all out of FOOs!==========", 1,
              "aaalqudah@uod.edu.sa");
              error_log($e->getMessage());
            
            echo "<div class='alert alert-danger'>"
                . " Our server Busy Now try again later.. </div></br>";
               
            die();
        }
        
       
    }
    
    
    public static function  getInstance(){
        
        if(!self::$instance){
            // create object for this class
            // this will call the __constructor
            // the try cath will be in constructor 
            self::$instance=new db(); 
            return self::$instance;

          }
        
        else{
            
            return self::$instance;
           
        }
        
        
    }
    
    
    public function getConnection(){
        // if not initilizeed will return null
        // initilized in getinstance()
        return $this->dbconn;
        
    }
    
    
    public function getStatus() {
        if (isset($this->dbconn)) {
           return $this->status;

        } else {
            return false;
        }
    }

    
    public function getCount() {
        if (isset($this->dbconn)) {
           return $this->counter;

        } else {
            return 0; 
        }
    }
    
    
    public function __destruct(){
        
    }
    

}


//  how to call singlton class 
$obj=db::getInstance();
$dbconn=$obj->getConnection();


