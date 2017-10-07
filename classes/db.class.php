<?php

class db{

    //db members
    private $host;
    private $dbname;
    private $username;
    private $password;
    
    public $dbconn;
    public $status;

    
    public function __construct() {
       // the require paramaters to start db connnection
       $this->host = '127.0.0.1';
        $this->dbname = 'loginsystem';
        $this->username = 'root';
        $this->password = '';
        $this->status = 0;
        $this->dbconn=0;
   

    }

    
    public function getConnection() {
                         
        try {
            
            // [1-] new PDO always return null if not success
            $this->dbconn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            
            if (!is_null($this->dbconn)) {
                /*
                echo "<div class='alert alert-success alert-dismissable'>"
                . " You are connected NOW .."
                . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> </div></br>";
              */
                
            // [2-] Get connection status ($this->dbconn return null if unsccessfull )
                $this->status= $this->dbconn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
                
            // [3-] set Fetch Mode - Error Mode - 
               $this->dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

               
            // Error Mode ::  this by default is silent you need change it in production 
               //$this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               /*
                echo "<div class='alert alert-success alert-dismissable'>"
                . " serer data .. $this->status"
                . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> </div></br>";
                 */
                
                return $this->dbconn;
                
            } else {
                echo "<div class='alert alert-danger'>"
                . " Our server Busy Now try again later.. </div></br>";
                return false;
            }
            
        } catch (PDOException $ex) {
            var_dump($ex);
            echo "<div class='alert alert-danger'>"
            . " <strong> PDO </strong> Our server Busy Now try again later.. </div></br>";
            return false;
        }
    }

    
    // This need valid
    // getConnection() function to work
      public function getStatus(){
            // you cant call this function without valid connection 
            // so always check if ther is a connection exsist (not null)
            if(is_null($this->dbconn)){
                echo "<div class='alert alert-danger'>"
            . " <strong> getStatus() </strong> Our server Busy Now try again later.. </div></br>";
                
                
            }
            else{
            echo " Status is : " . $this->dbconn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            }
            
       
    }

    
    
    // Destructor Must be Public as well
    public function __destruct() {
        // no need to put anything here 
        // you may want to log some action here !
    }

}
