<?php

class user {

    private $dbconn;
    private $table_name = 'users';
    public $id;
    public $username;
    public $fname;
    public $lname;
    public $joined;
    public $token;
    public $active;
    public $group_id;

    public function __construct($db = 0) {
        $this->dbconn = $db;
    }

    public function isUserValideTologin($inputs) {
        // Return true of false
        // 1- prepare 
        // 2- check 
        // 3- return 

        $sql = "SELECT * FROM " . $this->table_name . " WHERE (username=?) AND (password=?)";
        $query = $this->dbconn->prepare($sql);
        $isok = $query->execute(array($inputs['username'], $inputs['password']));

        $row = $query->rowCount();
        var_dump($row);




        if ($row > 0) {
            // it ok to pull user data and set the class members
            $row = $query->fetch();

            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->fname = $row['fname'];
            $this->lname = $row['lname'];
            $this->joined = $row['joined'];
            $this->active = $row['active'];
            $this->group_id = $row['group_id'];

            return true;
        } else {
            return false;
        }
    }

    public function isUserNameExists($username) {
        // sanitize : done in validation
        // prepare
        // return true or false
        $sql = "SELECT id FROM " . $this->table_name . " WHERE username=?";
        $query = $this->dbconn->prepare($sql);
        $isok = $query->execute(array($username));

        if ($isok) {

            if ($query->rowCount() > 0) {
                var_dump($query->rowCount());
                // is user name exixts ?
                return true;
            } else {
                // is user name exixts ? no return false

                return false;
            }
        } else {
            throw new Exception('Error in DB');
        }
    }

    public function isUserActiveByUserName($username) {
        $sql = "SELECT id FROM " . $this->table_name . " WHERE (username=?) AND (active=1)";
        $query = $this->dbconn->prepare($sql);
        $isok = $query->execute(array($username));
        if ($isok && $query->rowCount() > 0) {
            $this->active = true;
            return true;
        } else {
            return false;
        }
    }

    public function creatNewUser($inputs) {
        // all inputs snitized already

        $this->token = $this->generateToken();

        $sql = "INSERT INTO " . $this->table_name . " (username,fname,lname,password,token) VALUES(?,?,?,?,?)";
        $query = $this->dbconn->prepare($sql);
        $isok = $query->execute(array($inputs['username'], $inputs['fname'], $inputs['lname'], $inputs['password'], $this->token));
       // var_dump($query->errorInfo());
        if ($isok) {
            $this->username = $inputs['username'];
            return true;
        } else {
            return false;
        }
    }

    public function generateToken() {

       // $token = random_bytes(5);
        $token = uniqid('Activation_');
        // var_dump($token);
        //var_dump(base64_decode($token));
        return $token;
        
        
    }

    public function sendActivationEmail($email) {
        // get token of this user
        // prepare emaillink 
        // send it to user
        $sql = "SELECT token FROM " . $this->table_name . " WHERE username=?";
        $query = $this->dbconn->prepare($sql);
        $isok = $query->execute(array($email));

        if ($isok) {
            $row = $query->fetch();
            $token = $row['token'];


            // prepare email elements
            $to = htmlentities(strip_tags(trim($email)));
            $subject = 'Activation Emial from OUR WEBSITE !';
            $message = "Thank you to register in our greate website , to activate : <a href='verifyActivation.page.php?x={$email}&y={$token}'> CLick Here! </a>";
            $from = 'noreplay@myweb.com';

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Create email headers
            $headers .= 'From: ' . $from . "\r\n" .
                    'Reply-To: ' . $from . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();


            // send the activation link to user
            mail($to, $subject, $message, $headers);

            return true;
        } else {

            return false;
        }
    }

    
    public function activationByUserName($username,$token) {
        // sanitize
        // prepare
        // return

        $this->username= htmlentities(strip_tags(trim($username)));
        $this->token=htmlentities(strip_tags(trim($token)));
        
        
        $sql="SELECT id FROM ".$this->table_name ." WHERE (username=?) AND (token=?)";
        $query=$this->dbconn->prepare($sql);
        $isok=$query->execute(array($this->username,$this->token));
        
        echo "User class: isok $isok <br> " ;
        echo "User class: username $this->username <br>" ;
        echo "User class: toekn $this->token <br>" ;
        
    
        
        if($isok && $query->rowCount() > 0){
            return true;
            
        }
        
        return false;
        
        
        
    }
    
    
    public function setUserToBeActiveByUserName($username){
        // sanitization
        // preperation
        // set in db
                       
        $this->username= htmlentities(strip_tags(trim($username)));
        
        $sql='UPDATE '. $this->table_name .' SET active=1 WHERE username=?';
        $query = $this->dbconn->prepare($sql);
        $isok = $query->execute(array($this->username));
        
        if($isok && $query->rowCount() > 0){
            var_dump('this is actication Count'. $query->rowCount() );            
            return true;
        }
        else{
            return false;
        }
        
        
        
    }
}
