<?php
//---------- Session setup section ------------------------------
session_start(); 
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    echo " Not allowed to access this";
   var_dump($_SESSION['username']);
   header('location:login.page.php');
   exit();
}


include './config/initializing.core.php';
//---------- db objects ----------------------------------------
$dbobj = new db();
$dbconn = $dbobj->getConnection();
$user = new user($dbconn);


$page_title='Activation';
include './templates/navigation.template.php';

include './templates/header.php';


// if user active 
if(isset($_SESSION['active'])){
     echo "<div class='alert alert-success'> You are already activate your account !"
    . "</div>";
     
   echo  "<a class='btn btn-default' href='dashboard.page.php'> Click here to get beck to your dashboard</a>";

     exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['email'])) {
        // send  activation email 
        if ($user->sendActivationEmail($_SESSION['email'])) {
            echo "<div class='alert alert-success'> Email Sent ! </div>";
        }
        else{
             echo "<div class='alert alert-danger'> Email FAILED TO SEND ! </div>";
        }
    }
    
}



include './templates/activation.template.php';


include './templates/footer.php';


