<?php

// This class Will not acccess DB 
// It jsut prepare the inputs to be save for DB

class validationAndSanitize {

    //put your code here

    public $inputs, $errors = array();

    public function __construct() {
        
    }

    public function checkEmail() {
        // NULL if the variable_name variable is not set
        // $email=filter_input(INPUT_POST, $param, FILTER_VALIDATE_EMAIL);
        // this MUST be IN  $_POST[] else it will give you NULL 
        if (is_null($inputs['email']) || !isset($inputs['email'])) {
            $errors[] = 'Email Required';
        } else { // throw new exception should be 
            $inputs['email'] = filter_var($inputs['email'], FILTER_VALIDATE_EMAIL);
        }
    }

    // this is a place for SQL injection
    // you need REG EXPRESSiOn for this field 
    // Salt +  hash them after that
    // https://stackoverflow.com/questions/5386206/proper-way-to-sanitize-a-password

    public function passwordComlexity($password) {
        $notes = array();
        
        if (!empty($password))
            {

            $uppercase = preg_match('@[A-Z]@', $_POST['password']);
            $lowercase = preg_match('@[a-z]@', $_POST['password']);
            $number = preg_match('@[0-9]@', $_POST['password']);


            if (!$uppercase) {

                $notes[] = 'Upper case requiresd';
            }
            if (!$lowercase) {
                $notes[] = 'Lower case required';
            }
            if (!$number) {
                $notes[] = 'Number  required';
            }
            if (strlen($_POST['password']) < 8) {
                $notes[] = 'Length must be > 8 chars';
            }
        }
        
       else{
         $notes[]='Password is Required !';
               
       }     
        return array($notes);
    }
    
    
    
    public function passwordMatch($password1, $password2){
        //Returns < 0 if str1 is less than str2;
        // > 0 if str1 is greater than str2,
        //  and 0 if they are equal
        // check if exixt
      
        
        $ismatch = strcmp($password1, $password2);
        if ($ismatch == 0) {
            return true;
        } else {
            return false;
        }
    }

    
    
    
    public function loginFormValidationAndSanitized() {

        $inputs = array();
        $errors = array();

        if (!isset($_POST['username']) || is_null($_POST['username']) || empty($_POST['username'])) {

            // error
            $errors[] = 'username is required!';
        } else {
            // sanitize

            $inputs['username'] = htmlentities(strip_tags(trim($_POST['username'])));
        }


        if (!isset($_POST['password']) || is_null($_POST['password']) || empty($_POST['password'])) {

            // error
            $errors[] = 'password is required!';
        } else {
            // sanitize

            $inputs['password'] = $_POST['password'];
        }




        // always this will be return
        return array($inputs, $errors);
    }

    
    
    public function registrationFormValidationAndSanitization() {

        $errors = array();
        $inputs = array();
        $notes = array();


        // user name
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            $errors[] = 'Username is Required';
        } else {
            $temp = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
            if ($temp) {
                $inputs['username'] = $_POST['username'];
            } else {
                $errors[] = 'Username is Not valide email !';
            }
        }

            // fname
        if(!isset($_POST['fname']) || empty($_POST['fname']) ){
           $errors[] = 'fname is Required'; 
        }
        else
        {
            $inputs['fname']= htmlentities(strip_tags(trim($_POST['fname'])));
            
        }
        
       // fname
        if(!isset($_POST['lname']) || empty($_POST['lname']) ){
            $errors[] = 'lname is Required'; 
        }
        else
        {   $inputs['lname']= htmlentities(strip_tags(trim($_POST['lname'])));
            
        }
        
        
        
        
        
        // password match
        if ($this->passwordMatch($_POST['password'], $_POST['repassword'])) {
             // password Complexity requiremnts
            $notes= array();
            list($notes) = $this->passwordComlexity($_POST['password']);
            if ($notes) {
                $errors['passwordRequirments'] = 'Password Did not meet Complexity Requiremnts';
            } else {
                $inputs['password'] = $_POST['password'];
            }
                    
        } else {
            $errors[] = 'Password did Not match';
        }




       
        
        
        

        // function returns
        return array($inputs, $errors, $notes);
    }

}
