<?php


// Note: this class for sanitize ONLY
// You need to check if isset() before send it to us.

class sanitize {    
    
    public function text($param) {
        //to konw more about this function plz review
        //  http://php.net/manual/en/function.htmlentities.php
        
        return htmlentities(strip_tags(trim($param)),ENT_QUOTES,'utf-8');
       
    }
    
    
    
    
    
    
    
    public function email($param) {
          
         // NULL if the variable_name variable is not set
        // $email=filter_input(INPUT_POST, $param, FILTER_VALIDATE_EMAIL);
        // this MUST be IN  $_POST[] else it will give you NULL 
                            
          
         $email=filter_var($param, FILTER_VALIDATE_EMAIL);
          
         if(!is_null($email)){
             return $email;
         }
         else
         { // throw new exception should be 
             return false;
         }
    
    }
        
    
    
    // this is a place for SQL injection
    // you need REG EXPRESSiOn for this field 
    // Salt +  hash them after that
    // https://stackoverflow.com/questions/5386206/proper-way-to-sanitize-a-password

    public function password($param) {

        if (empty($param)) {
            return 'empty';
        } else {

            $uppercase = preg_match('@[A-Z]@', $param);
            $lowercase = preg_match('@[a-z]@', $param);
            $number = preg_match('@[0-9]@', $param);

            
            if(!$uppercase){return 'Upper case requiresd';}
            if(!$lowercase){return 'LOwer case requiresd';}
            if(!$number){return 'Number  requiresd';}
            if(strlen($param) < 8){return 'Length must be > 8 chars';}
            
                  
            
            return $param;
        }
    }
    
    
   
    public function passwordMatch($password1,$password2){
         //Returns < 0 if str1 is less than str2;
        // > 0 if str1 is greater than str2,
        //  and 0 if they are equal
        $ismatch = strcmp($password1, $password2);
        if($ismatch == 0){
            return true;
        }
        else
        {
            return false;
        }
        
        
    }
    

}




