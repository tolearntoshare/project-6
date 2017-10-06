<?php
//---------- Session setup section ------------------------------
session_start(); 


include './config/initializing.core.php';
//---------- db objects ----------------------------------------
$dbobj = new db();
$dbconn = $dbobj->getConnection();
$user = new user($dbconn);

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  
   header('location:login.page.php');
   exit();
}
 else {
 if (!($user->isUserActiveByUserName($_SESSION['username']))) {
        // not active user 
        // redirect to activation 
        header('location:activation.page.php');
    }
}






$page_title='DashBoard for loged in and ACTIVE Users';
include './templates/navigation.template.php';
include './templates/header.php';


echo "HI ".$_SESSION['username'];

if($user->isUserActiveByUserName($_SESSION['username'])){
    
    echo " you are active ";
        echo " Now fill you Application ";
    
    
}
else
{
     echo " you are  NOT active ";
}






include './templates/footer.php';


